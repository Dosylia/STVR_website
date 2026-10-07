<?php

namespace Tests\Unit;

use App\Support\LauncherDownload;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LauncherDownloadTest extends TestCase
{
    private const EXE = 'urSovngarde_0.2.0_x64-setup.exe';

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        Storage::fake('local');
        config()->set('stvr.launcher.repo', 'someone/the-launcher');
        config()->set('stvr.launcher.token', 'read-only-token');
    }

    private function released(): void
    {
        Http::fake([
            'api.github.com/repos/someone/the-launcher/releases/latest' => Http::response([
                'tag_name' => 'launcher-v0.2.0',
                'body' => 'Hosting password.',
                'published_at' => '2026-10-07T20:00:00Z',
                'assets' => [
                    ['id' => 1, 'name' => self::EXE, 'size' => 3],
                    ['id' => 2, 'name' => self::EXE.'.sig', 'size' => 9],
                ],
            ]),
            'api.github.com/repos/someone/the-launcher/releases/assets/1' => Http::response('EXE'),
            'api.github.com/repos/someone/the-launcher/releases/assets/2' => Http::response("SIGNATURE\n"),
            'api.github.com/*' => Http::response([], 404),
        ]);
    }

    public function test_the_newest_release_is_copied_in_and_served_from_here(): void
    {
        $this->released();

        $build = app(LauncherDownload::class)->current();

        $this->assertSame(self::EXE, $build->name);
        $this->assertSame('0.2.0', $build->version);
        $this->assertSame('SIGNATURE', $build->signature);
        Http::assertSent(fn ($request) => $request->hasHeader('Authorization', 'Bearer read-only-token'));

        $url = route('launcher.file', ['name' => self::EXE]);
        $this->get('/en/download')->assertOk()->assertSee($url)->assertDontSee('Not released yet');

        $file = $this->get('/downloads/launcher/'.self::EXE);
        $file->assertOk()->assertDownload(self::EXE);
        $this->assertSame('EXE', $file->streamedContent());

        $this->getJson('/downloads/launcher/latest.json')->assertOk()->assertExactJson([
            'version' => '0.2.0',
            'notes' => 'Hosting password.',
            'pub_date' => '2026-10-07T20:00:00Z',
            'platforms' => ['windows-x86_64' => ['signature' => 'SIGNATURE', 'url' => $url]],
        ]);
    }

    public function test_the_copy_is_served_when_github_is_unreachable(): void
    {
        $this->released();
        app(LauncherDownload::class)->current();

        Cache::flush();
        Http::fake(fn () => throw new \RuntimeException('connection refused'));

        $this->assertSame(self::EXE, app(LauncherDownload::class)->current()?->name);
    }

    public function test_nothing_released_says_so(): void
    {
        Http::fake(['api.github.com/*' => Http::response([], 404)]);

        $this->assertNull(app(LauncherDownload::class)->current());
        $this->get('/en/download')->assertOk()->assertSee('Not released yet');
        $this->get('/downloads/launcher/latest.json')->assertNotFound();
    }

    public function test_only_the_stored_launcher_can_be_downloaded(): void
    {
        $this->released();
        app(LauncherDownload::class)->current();
        Storage::disk('local')->put('launcher-notes.txt', 'private');

        $this->get('/downloads/launcher/'.self::EXE.'.sig')->assertNotFound();
        $this->get('/downloads/launcher/other_0.1.0_x64-setup.exe')->assertNotFound();
        $this->get('/downloads/launcher/..%2Flauncher-notes.txt')->assertNotFound();
    }
}
