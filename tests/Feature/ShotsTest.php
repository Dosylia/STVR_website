<?php

namespace Tests\Feature;

use App\Support\Shots;
use Tests\TestCase;

class ShotsTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->directory = public_path('media/shots');
        $this->cleanup();
    }

    protected function tearDown(): void
    {
        $this->cleanup();
        parent::tearDown();
    }

    public function test_the_home_page_falls_back_to_the_illustration_when_there_are_none(): void
    {
        $this->get('/en')
            ->assertOk()
            ->assertSee('shot--art', false)
            ->assertDontSee('class="shots"', false);
    }

    public function test_dropping_a_file_in_is_the_whole_workflow(): void
    {
        $this->write('02-riften-market.png');
        $this->write('01-two-on-the-road.png');

        $shots = app(Shots::class)->all();

        $this->assertCount(2, $shots);

        // The leading number orders them and is then stripped from the slug.
        $this->assertSame('two-on-the-road', $shots[0]['slug']);
        $this->assertSame('riften-market', $shots[1]['slug']);

        // No caption configured: the slug becomes readable alt text instead.
        $this->assertNull($shots[0]['caption']);
        $this->assertSame('two on the road', $shots[0]['alt']);

        $this->get('/en')
            ->assertOk()
            ->assertSee('class="shots"', false)
            ->assertSee('media/shots/01-two-on-the-road.png', false)
            ->assertDontSee('shot--art', false);
    }

    public function test_a_configured_caption_is_used_for_the_text_and_the_alt(): void
    {
        $this->write('01-riften-market.png');

        app('translator')->addLines(
            ['shots.captions.riften-market' => 'Two players, one market.'],
            'en',
        );

        $shot = app(Shots::class)->all()[0];

        $this->assertSame('Two players, one market.', $shot['caption']);
        $this->assertSame('Two players, one market.', $shot['alt']);
    }

    private function write(string $name): void
    {
        if (! is_dir($this->directory)) {
            mkdir($this->directory, 0775, true);
        }

        // A one-pixel PNG is enough; nothing here reads the pixels.
        file_put_contents(
            $this->directory.'/'.$name,
            base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg=='),
        );
    }

    private function cleanup(): void
    {
        foreach (glob($this->directory.'/*.png') ?: [] as $file) {
            @unlink($file);
        }
    }
}
