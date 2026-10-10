<?php

namespace Tests\Feature;

use App\Console\Commands\LangCheck;
use App\Support\Nav;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class LocalisationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Pages ask GitHub and the hub for releases and counts; a test asks nobody.
        Http::fake(['*' => Http::response(null, 404)]);
    }

    /**
     * The invariant that keeps four languages honest, through the same command
     * a person runs (php artisan stvr:lang-check): every English key in every
     * language with the same :placeholders and nothing extra, every devlog entry
     * translated, no dashes. The files are found, not listed, so a new language
     * file is checked the day it is added.
     */
    public function test_every_language_is_in_step_with_english(): void
    {
        $this->assertSame([], (new LangCheck())->problems());
    }

    // Raw keys, unfilled placeholders and dates in the wrong language are looked for on the rendered pages, in
    // tests/Feature/PagesTest.php, which loads each page once and checks everything on it.

    public function test_each_page_declares_every_language_as_an_alternate(): void
    {
        $body = $this->get(Nav::url('roadmap', 'de'))->getContent();

        foreach (Nav::locales() as $locale) {
            $this->assertStringContainsString(
                'hreflang="'.$locale.'" href="'.Nav::url('roadmap', $locale).'"',
                $body,
            );
        }

        $this->assertStringContainsString('hreflang="x-default"', $body);
        $this->assertStringContainsString('<link rel="canonical" href="'.Nav::url('roadmap', 'de').'"', $body);
    }
}
