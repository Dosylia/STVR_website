<?php

namespace Tests\Unit;

use App\Support\ReleaseService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ReleaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_a_published_release_fills_the_panel_in(): void
    {
        Http::fake(['api.github.com/*' => Http::response([
            'tag_name' => 'v0.2.0-vr',
            'name' => 'v0.2.0-vr',
            'published_at' => '2026-10-02T12:00:00Z',
            'html_url' => 'https://github.com/Dosylia/SkyrimTogetherVR/releases/tag/v0.2.0-vr',
            'body' => 'Notes.',
            'assets' => [
                ['name' => 'SkyrimTogetherVR-0.2.0.zip',        'browser_download_url' => 'https://example/full.zip',  'size' => 431_000_000, 'download_count' => 12],
                ['name' => 'SkyrimTogetherVR-0.2.0-update.zip', 'browser_download_url' => 'https://example/patch.zip', 'size' => 5_200_000,   'download_count' => 30],
                ['name' => 'SkyrimTogetherServer-0.2.0.zip',    'browser_download_url' => 'https://example/srv.zip',   'size' => 18_000_000,  'download_count' => 3],
            ],
        ])]);

        $release = app(ReleaseService::class)->latest();

        $this->assertTrue($release->live);
        $this->assertSame('v0.2.0-vr', $release->tag);
        $this->assertSame(45, $release->downloads());

        // The narrow "-update.zip" rule has to win over the catch-all ".zip",
        // or the update and the full package swap places.
        $this->assertSame('https://example/full.zip', $release->full()->url);
        $this->assertSame('https://example/patch.zip', $release->patch()->url);
        $this->assertSame('https://example/srv.zip', $release->server()->url);

        $this->assertSame('411 MB', $release->full()->humanSize());
        $this->assertSame('5.0 MB', $release->patch()->humanSize());
    }

    public function test_a_repository_with_no_releases_falls_back_quietly(): void
    {
        // GitHub answers 404 for /releases/latest when nothing is tagged. That
        // is the normal state of this repo today, not an error.
        Http::fake(['api.github.com/*' => Http::response([], 404)]);

        config()->set('stvr.github.fallback.url', 'https://github.com/x/y/releases/latest');
        config()->set('stvr.github.fallback.tag', '');

        $release = app(ReleaseService::class)->latest();

        $this->assertFalse($release->live);
        $this->assertTrue($release->exists());
        $this->assertSame('https://github.com/x/y/releases/latest', $release->landingUrl());
    }

    public function test_github_being_unreachable_does_not_break_the_page(): void
    {
        Http::fake(fn () => throw new \RuntimeException('connection refused'));

        $release = app(ReleaseService::class)->latest();

        $this->assertFalse($release->live);
        $this->assertNotEmpty($release->landingUrl());
    }

    public function test_the_download_page_renders_without_a_release(): void
    {
        Http::fake(['api.github.com/*' => Http::response([], 404)]);

        $this->get('/en/download')->assertOk()->assertSee('Take the launcher');
    }

    public function test_the_download_page_names_the_version_when_there_is_one(): void
    {
        // Separate test rather than a second fake in the previous one:
        // Http::fake() merges stubs instead of replacing them, so a second call
        // for the same URL pattern never wins.
        Http::fake(['api.github.com/*' => Http::response([
            'tag_name' => 'v1.0.0-vr',
            'published_at' => '2026-10-02T12:00:00Z',
            'html_url' => 'https://example/release',
            'assets' => [['name' => 'SkyrimTogetherVR-1.0.0.zip', 'browser_download_url' => 'https://example/f.zip', 'size' => 1024 * 1024, 'download_count' => 1]],
        ])]);

        $this->get('/en/download')->assertOk()->assertSee('v1.0.0-vr');
    }
}
