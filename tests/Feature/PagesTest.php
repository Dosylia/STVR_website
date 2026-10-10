<?php

namespace Tests\Feature;

use App\Console\Commands\LangCheck;
use App\Support\Devlog;
use App\Support\Nav;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Every page the site has, found rather than listed: each path in
 * config('stvr.paths') and each devlog entry, in every language. A page that
 * throws (as the download page did once, over a date) fails here before it
 * reaches anyone, and so does one that leaks a translation key, leaves a
 * placeholder unfilled or writes a French page's date in English.
 */
class PagesTest extends TestCase
{
    /** Responses a test wants for given URLs; everything else, GitHub and the hub included, answers 404. */
    private array $answers = [];

    protected function setUp(): void
    {
        parent::setUp();
        Http::fake(function ($request) {
            foreach ($this->answers as $prefix => $body) {
                if (str_starts_with($request->url(), $prefix)) {
                    return Http::response($body);
                }
            }

            return Http::response(null, 404);
        });
    }

    /** The site before anything is out, and with everything out: what the sweep below loads each page in. */
    public static function states(): array
    {
        return ['nothing released yet' => [false], 'everything released' => [true]];
    }

    /**
     * Each page once per language, with everything checked on that one load: it answers, says which language it is
     * in, shows no raw translation key, no :placeholder left unfilled and no date in English on a page that is not,
     * and its structured data parses. In both states, because each one shows copy the other does not: the fallbacks
     * before a release, and after it the release and launcher lines, their dates, the download count and the map.
     */
    #[DataProvider('states')]
    public function test_every_page_comes_out_whole_in_every_language(bool $released): void
    {
        Storage::fake('local');
        config(['stvr.public_server.enabled' => $released, 'stvr.public_server.status_url' => $released ? 'sample' : '']);

        if ($released) {
            $this->releaseEverything();
        }

        // A key as __() prints one it cannot find: one of our files, then one level or more. Not straight after a
        // dot, a slash, an @ or a hyphen, where it would be part of a host name or an address.
        $files = collect(glob(lang_path('en/*.php')))->map(fn ($path) => basename($path, '.php'))->implode('|');
        $rawKey = "/(?<![\\w.\\/@-])({$files})\\.[a-z_][a-z0-9_]*(\\.[a-z0-9_]+)*/u";

        // Every name the copy uses as a :placeholder, read from the files the way stvr:lang-check reads them.
        $names = collect(glob(lang_path('en/*.php')))
            ->flatMap(fn ($path) => LangCheck::flatten(require $path))
            ->flatMap(fn ($text) => LangCheck::placeholders($text))
            ->map(fn ($placeholder) => substr($placeholder, 1))
            ->unique()
            ->implode('|');
        $unfilled = "/(?<![\\w:\\/]):({$names})\\b/u";

        // A date written in English: "October 2, 2026" and "Oct 2, 2026" as Carbon writes them, "2 October 2026" and
        // "2 Oct 2026" as format() does. Not a month name alone, because "Mar" is also the sea on the Spanish map.
        // The other languages never match: their months are in lower case, or follow a day with a dot ("2. Mai").
        $month = 'January|February|March|April|May|June|July|August|September|October|November|December'
            .'|Jan|Feb|Mar|Apr|Jun|Jul|Aug|Sept|Sep|Oct|Nov|Dec';
        $englishDate = "/\\b({$month})\\.? \\d{1,2}, \\d{4}\\b|\\b\\d{1,2} ({$month})\\.? \\d{4}\\b/u";

        foreach (Nav::locales() as $locale) {
            $urls = array_map(fn ($page) => Nav::url($page, $locale), array_keys((array) config('stvr.paths')));
            foreach (app(Devlog::class)->all($locale) as $entry) {
                $urls[] = Nav::url('devlog', $locale, ['slug' => $entry->slug]);
            }

            foreach ($urls as $url) {
                $body = $this->get($url)->assertOk()->assertSee('<html lang="'.$locale.'"', false)->getContent();
                $text = strip_tags($body);

                $this->assertDoesNotMatchRegularExpression($rawKey, $text, "A raw translation key on {$url}");
                $this->assertDoesNotMatchRegularExpression($unfilled, $text, "An unfilled placeholder on {$url}");
                if ($locale !== 'en') {
                    $this->assertDoesNotMatchRegularExpression($englishDate, $text, "A date in English on {$url}");
                }

                // Blade once read '@context' in a template as its own directive and served PHP inside the JSON-LD.
                preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $body, $blocks);
                $this->assertNotEmpty($blocks[1], "No structured data on {$url}");
                foreach ($blocks[1] as $json) {
                    $data = json_decode($json, true);
                    $this->assertIsArray($data, "Invalid JSON-LD on {$url}");
                    $this->assertSame('https://schema.org', $data['@context'] ?? null, "Broken @context on {$url}");
                }
            }
        }
    }

    public function test_each_language_has_a_valid_devlog_feed(): void
    {
        foreach (Nav::locales() as $locale) {
            $response = $this->get(route("{$locale}.devlog.feed"));
            $response->assertOk()->assertHeader('Content-Type', 'application/atom+xml; charset=UTF-8');

            $feed = simplexml_load_string($response->getContent());
            $this->assertNotFalse($feed, "The {$locale} feed is not XML");
            $this->assertSame(count(app(Devlog::class)->all($locale)), count($feed->entry));
        }

        $this->assertStringContainsString('application/atom+xml', $this->get(Nav::url('faq', 'de'))->getContent());

        // A reader polling with the date it last saw is told nothing has changed, and is not sent the feed again.
        $modified = $this->get(route('fr.devlog.feed'))->headers->get('Last-Modified');
        $this->assertNotNull($modified);
        $this->get(route('fr.devlog.feed'), ['If-Modified-Since' => $modified])->assertNoContent(304);
    }

    public function test_the_public_server_page_stays_hidden_until_it_is_switched_on(): void
    {
        config(['stvr.public_server.enabled' => false, 'stvr.public_server.status_url' => '']);

        $page = $this->get(Nav::url('public', 'en'));
        $page->assertOk()->assertSee('noindex', false);
        $this->assertStringNotContainsString(Nav::url('public', 'en'), $this->get('/sitemap.xml')->getContent());
        $this->assertStringNotContainsString('href="'.Nav::url('public', 'en').'"', $this->get(Nav::url('home', 'en'))->getContent());

        config(['stvr.public_server.enabled' => true]);

        $this->assertStringContainsString(Nav::url('public', 'en'), $this->get('/sitemap.xml')->getContent());
        $this->assertStringContainsString('href="'.Nav::url('public', 'en').'"', $this->get(Nav::url('home', 'en'))->getContent());
        $this->get(Nav::url('public', 'en'))->assertDontSee('noindex', false);
    }

    public function test_the_public_server_page_draws_players_from_a_status(): void
    {
        config(['stvr.public_server.status_url' => 'sample']);

        $body = $this->get(Nav::url('public', 'fr'))->assertOk()->getContent();

        // Eight of the nine listed players have a dot: four outdoors in Tamriel, one in Whiterun's own worldspace and one in
        // Fort Dawnguard's courtyard (both drawn on Skyrim's map), one near Raven Rock (Solstheim's), one in the Boneyard
        // (the Soul Cairn's). Indoors has none.
        $this->assertSame(8, substr_count($body, 'class="map__player"'));
        $this->assertMatchesRegularExpression('#data-map="soul_cairn".*?data-id="c1z0ny"#s', $body, 'Siv is on the Soul Cairn\'s map');
        preg_match('#data-map="skyrim".*?</g>\s*(?=\s*<g transform)#s', $body, $skyrim);
        $this->assertSame(6, substr_count($skyrim[0] ?? '', 'class="map__player"'), 'Six dots on Skyrim, the city and the courtyard included');
        $this->assertStringContainsString('data-id="s8d3me"', $body);
        $this->assertMatchesRegularExpression('#data-map="solstheim".*?data-id="s8d3me"#s', $body, 'Erik is on Solstheim\'s map');
        $this->assertMatchesRegularExpression('#data-tab="skyrim"[^>]*aria-selected="true"#', $body, 'The busier map opens first');
        $this->assertMatchesRegularExpression('#data-map-count="solstheim">1<#', $body);
        $this->assertStringContainsString('Blancherive', $body);
        $this->assertStringContainsString('href="ursovngarde://join?address=203.0.113.10:10578"', $body, 'The launcher\'s join link');
        $this->assertStringContainsString('Me cacher de la page du serveur public', $body, 'How to stay off the page, in the launcher\'s words');
    }

    public function test_a_stale_status_shows_the_server_offline(): void
    {
        config(['stvr.public_server.status_url' => 'https://hub.test/servers/public/status']);
        $this->answers['https://hub.test/'] = [
            'online' => true, 'name' => 'Old', 'updated_at' => now()->subMinutes(10)->toIso8601String(),
            'players' => [['name' => 'Ingrid', 'worldspace' => 'Tamriel', 'x' => 7603, 'y' => -66167]],
        ];

        $body = $this->get(Nav::url('public', 'en'))->assertOk()->getContent();

        $this->assertStringContainsString('is-offline', $body);
        $this->assertStringNotContainsString('map__player', $body);
    }

    public function test_the_status_route_gives_the_page_what_it_redraws(): void
    {
        config(['stvr.public_server.status_url' => 'sample']);

        $json = $this->getJson('/api/public-server.json')->assertOk()->json();

        $this->assertTrue($json['online']);
        $this->assertSame(10, $json['count'], 'player_count, hidden players included');
        $this->assertSame(1, $json['hidden']);
        $this->assertCount(9, $json['players']);
        $this->assertSame(['skyrim' => 6, 'solstheim' => 1, 'soul_cairn' => 1], $json['maps']);
        $this->assertSame(['id', 'name', 'where', 'map', 'area', 'point', 'heading'], array_keys($json['players'][0]));

        $byName = array_column($json['players'], null, 'name');
        $this->assertNull($byName['Asta']['point'], 'Indoors: no dot');
        $this->assertNull($byName['Asta']['heading']);
        $this->assertSame(['skyrim', null], [$byName['Brynja']['map'], $byName['Brynja']['area']], 'A walled city is Skyrim');
        $this->assertSame(['solstheim', 'solstheim'], [$byName['Erik']['map'], $byName['Erik']['area']]);
        $this->assertSame(['soul_cairn', 'soul_cairn'], [$byName['Siv']['map'], $byName['Siv']['area']]);

        // The fixed spots the server sends for the courtyards land on the places drawn for them: the calibration
        // points are those exact positions.
        $this->assertSame([906, 474], $byName['Vald']['point'], 'Fort Dawnguard\'s courtyard, on the fort');
        $this->assertSame(['skyrim', null], [$byName['Vald']['map'], $byName['Vald']['area']]);
        $this->assertSame([520, 218], $byName['Siv']['point'], 'The Boneyard, at the Soul Cairn\'s door into it');
    }

    public function test_the_public_server_section_of_the_privacy_page_waits_for_the_switch(): void
    {
        config(['stvr.public_server.enabled' => false]);
        $this->get(Nav::url('privacy', 'en'))->assertOk()->assertDontSee('The public server');

        config(['stvr.public_server.enabled' => true]);
        $this->get(Nav::url('privacy', 'en'))->assertOk()->assertSee('The public server');
    }

    /** A release of the mod and a launcher, each with its date, and a download count from the hub. */
    private function releaseEverything(): void
    {
        $this->answers['https://api.github.com/repos/'.config('stvr.github.repo').'/releases/latest'] = [
            'tag_name' => 'v1.9.0',
            'published_at' => '2026-10-02T12:00:00Z',
            'html_url' => 'https://github.com/Dosylia/SkyrimTogetherVR/releases/tag/v1.9.0',
            'body' => 'Notes.',
            'assets' => [
                ['name' => 'urSovngarde-v1.9.0.zip', 'browser_download_url' => 'https://example.test/full.zip', 'size' => 431_000_000, 'download_count' => 12],
                ['name' => 'urSovngarde-v1.9.0-update.zip', 'browser_download_url' => 'https://example.test/patch.zip', 'size' => 5_200_000, 'download_count' => 30],
                ['name' => 'urSovngarde-v1.9.0-server.zip', 'browser_download_url' => 'https://example.test/server.zip', 'size' => 18_000_000, 'download_count' => 3],
            ],
        ];

        config(['stvr.hub.url' => 'https://hub.test']);
        $this->answers['https://hub.test/stats/public'] = ['launcherDownloads' => 1234];

        $exe = 'urSovngarde_0.2.0_x64-setup.exe';
        Storage::disk('local')->put("launcher/{$exe}", 'EXE');
        Storage::disk('local')->put("launcher/{$exe}.sig", 'SIGNATURE');
        Storage::disk('local')->put("launcher/{$exe}.json", (string) json_encode([
            'notes' => 'Hosting password.',
            'published_at' => '2026-10-07T20:00:00Z',
        ]));
    }
}
