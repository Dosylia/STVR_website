<?php

namespace Tests\Feature;

use App\Support\Nav;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    public function test_the_root_redirects_to_a_language(): void
    {
        $this->get('/')->assertRedirect(Nav::url('home', 'en'));
    }

    public function test_the_root_honours_the_browsers_language(): void
    {
        foreach (['de-DE,de;q=0.9' => 'de', 'es-ES,es;q=0.9' => 'es', 'fr-FR,fr;q=0.8' => 'fr'] as $header => $expected) {
            $this->withHeader('Accept-Language', $header)
                ->get('/')
                ->assertRedirect(Nav::url('home', $expected));
        }
    }

    public function test_an_unsupported_language_falls_back_to_english(): void
    {
        $this->withHeader('Accept-Language', 'ja-JP,ja;q=0.9')
            ->get('/')
            ->assertRedirect(Nav::url('home', 'en'));
    }

    public function test_every_page_answers_in_every_language(): void
    {
        foreach (Nav::locales() as $locale) {
            foreach (array_merge(['home'], Nav::MENU) as $page) {
                $url = Nav::url($page, $locale);

                $this->get($url)
                    ->assertOk()
                    ->assertSee('<html lang="'.$locale.'"', false);
            }
        }
    }

    public function test_pages_use_the_translated_slug(): void
    {
        // The whole point of per-language slugs: /fr/installation exists and
        // /fr/install does not.
        $this->get('/fr/installation')->assertOk();
        $this->get('/fr/install')->assertNotFound();
        $this->get('/de/anleitung')->assertOk();
        $this->get('/es/hoja-de-ruta')->assertOk();
    }

    public function test_an_unknown_path_is_a_404_rather_than_the_home_page(): void
    {
        $this->get('/en/nonsense')->assertNotFound();
        $this->get('/zz')->assertNotFound();
        $this->get('/en/devlog/no-such-entry')->assertNotFound();
    }

    public function test_a_devlog_entry_renders_and_links_its_translations(): void
    {
        $response = $this->get('/en/devlog');
        $response->assertOk();

        $slug = '2026-09-30-hips-cross-the-wire';

        $this->get("/en/devlog/{$slug}")->assertOk()->assertSee('Hips cross the wire');

        // The same entry under a French URL, still reachable by the same slug.
        $this->get("/fr/journal/{$slug}")->assertOk();
    }

    public function test_robots_and_sitemap(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertSee('Sitemap:', false);

        $sitemap = $this->get('/sitemap.xml');
        $sitemap->assertOk()->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $xml = $sitemap->getContent();

        foreach (Nav::locales() as $locale) {
            $this->assertStringContainsString(Nav::url('install', $locale), $xml);
        }

        $this->assertStringContainsString('hreflang="x-default"', $xml);
    }
}
