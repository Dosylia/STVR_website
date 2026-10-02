<?php

namespace Tests\Feature;

use App\Support\Nav;
use Tests\TestCase;

class LocalisationTest extends TestCase
{
    private const FILES = ['site', 'home', 'download', 'install', 'host', 'faq', 'roadmap', 'devlog', 'shots'];

    /**
     * The invariant that keeps four languages honest: every key English has,
     * the others have too. Without this, a new section ships translated into
     * one language and renders as `home.steps.label` in the other three.
     */
    public function test_every_language_has_every_english_key(): void
    {
        foreach (self::FILES as $file) {
            $english = $this->flatten(require lang_path("en/{$file}.php"));

            foreach (['fr', 'de', 'es'] as $locale) {
                $translated = $this->flatten(require lang_path("{$locale}/{$file}.php"));

                $this->assertSame(
                    [],
                    array_keys(array_diff_key($english, $translated)),
                    "Keys missing from lang/{$locale}/{$file}.php",
                );

                $this->assertSame(
                    [],
                    array_keys(array_diff_key($translated, $english)),
                    "Keys in lang/{$locale}/{$file}.php that English does not have",
                );
            }
        }
    }

    public function test_placeholders_survive_translation(): void
    {
        foreach (self::FILES as $file) {
            $english = $this->flatten(require lang_path("en/{$file}.php"));

            foreach (['fr', 'de', 'es'] as $locale) {
                $translated = $this->flatten(require lang_path("{$locale}/{$file}.php"));

                foreach ($english as $key => $value) {
                    if (! is_string($value) || ! isset($translated[$key])) {
                        continue;
                    }

                    preg_match_all('/:[a-z_]+/', $value, $expected);
                    preg_match_all('/:[a-z_]+/', (string) $translated[$key], $actual);

                    $this->assertSame(
                        [],
                        array_values(array_diff($expected[0], $actual[0])),
                        "lang/{$locale}/{$file}.php [{$key}] lost a placeholder",
                    );
                }
            }
        }
    }

    public function test_no_page_renders_a_raw_translation_key(): void
    {
        foreach (Nav::locales() as $locale) {
            foreach (array_merge(['home'], Nav::MENU) as $page) {
                $body = $this->get(Nav::url($page, $locale))->getContent();

                $this->assertDoesNotMatchRegularExpression(
                    '/\b(site|home|download|install|host|faq|roadmap|devlog)\.[a-z_]+\.[a-z_.]+/',
                    strip_tags($body),
                    "A raw translation key leaked onto {$locale}/{$page}",
                );
            }
        }
    }

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

    /** @return array<string, mixed> */
    private function flatten(array $input, string $prefix = ''): array
    {
        $flat = [];

        foreach ($input as $key => $value) {
            $path = $prefix === '' ? (string) $key : "{$prefix}.{$key}";

            if (is_array($value)) {
                $flat = array_merge($flat, $this->flatten($value, $path));
            } else {
                $flat[$path] = $value;
            }
        }

        return $flat;
    }
}
