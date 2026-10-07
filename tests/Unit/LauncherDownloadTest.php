<?php

namespace Tests\Unit;

use App\Support\LauncherDownload;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LauncherDownloadTest extends TestCase
{
    private string $folder;

    private bool $madeDownloads = false;

    protected function setUp(): void
    {
        parent::setUp();
        Http::fake(['api.github.com/*' => Http::response([], 404)]);
        $this->folder = 'downloads/launcher-test-'.getmypid();
        config()->set('stvr.launcher.folder', $this->folder);
        // The tests run as root in the container: a downloads folder made here would be root's, and the real one
        // could then not be created beside it. Whatever the test makes, it takes away.
        $this->madeDownloads = ! is_dir(public_path('downloads'));
        File::ensureDirectoryExists(public_path($this->folder));
    }

    protected function tearDown(): void
    {
        File::deleteDirectory(public_path($this->folder));
        if ($this->madeDownloads) {
            File::deleteDirectory(public_path('downloads'));
        }
        parent::tearDown();
    }

    public function test_the_button_downloads_the_file_in_the_folder(): void
    {
        file_put_contents(public_path($this->folder.'/urSovngarde_0.1.0_x64-setup.exe'), str_repeat('x', 3_527_022));
        file_put_contents(public_path($this->folder.'/urSovngarde_0.2.0_x64-setup.exe'), str_repeat('x', 3_600_000));
        file_put_contents(public_path($this->folder.'/readme.txt'), 'not a launcher');

        $launcher = app(LauncherDownload::class)->current();

        $this->assertSame('urSovngarde_0.2.0_x64-setup.exe', $launcher->name);
        $this->assertStringEndsWith('/'.$this->folder.'/urSovngarde_0.2.0_x64-setup.exe', $launcher->url);
        $this->assertSame('3.4 MB', $launcher->humanSize());
        $this->get('/en/download')
            ->assertOk()
            ->assertSee($this->folder.'/urSovngarde_0.2.0_x64-setup.exe')
            ->assertDontSee('Not released yet');
    }

    public function test_an_empty_folder_says_not_released_yet(): void
    {
        $this->assertNull(app(LauncherDownload::class)->current());
        $this->get('/en/download')->assertOk()->assertSee('Not released yet');
    }
}
