<?php

namespace App\Console\Commands;

use App\Support\Nav;
use Illuminate\Console\Command;

/**
 * The checks CLAUDE.md asks for after touching any language file, in one
 * command: every English key exists in every language with the same
 * :placeholders and nothing extra, every devlog entry is translated, and no
 * copy carries an em or en dash. Exits non-zero on any problem, so it can gate
 * a deploy; tests/Feature/LocalisationTest.php runs it too.
 *
 *     php artisan stvr:lang-check
 */
class LangCheck extends Command
{
    protected $signature = 'stvr:lang-check';

    protected $description = 'Check the four languages for missing keys, lost placeholders, untranslated devlog entries and dashes';

    public function handle(): int
    {
        $problems = $this->problems();

        foreach ($problems as $problem) {
            $this->line("  {$problem}");
        }

        if ($problems === []) {
            $this->info('All languages in step: keys, placeholders, devlog entries, no dashes.');

            return self::SUCCESS;
        }

        $this->error(count($problems).' problem'.(count($problems) === 1 ? '' : 's').'.');

        return self::FAILURE;
    }

    /** @return list<string> */
    public function problems(): array
    {
        $problems = [];
        $fallback = Nav::fallback();
        $others = array_values(array_diff(Nav::locales(), [$fallback]));

        foreach (glob(lang_path("{$fallback}/*.php")) ?: [] as $path) {
            $file = basename($path);
            $english = self::flatten(require $path);

            foreach ($others as $locale) {
                $other = lang_path("{$locale}/{$file}");

                if (! is_file($other)) {
                    $problems[] = "lang/{$locale}/{$file} is missing";

                    continue;
                }

                $translated = self::flatten(require $other);

                foreach (array_keys(array_diff_key($english, $translated)) as $key) {
                    $problems[] = "lang/{$locale}/{$file}: missing {$key}";
                }
                foreach (array_keys(array_diff_key($translated, $english)) as $key) {
                    $problems[] = "lang/{$locale}/{$file}: {$key} is not in English";
                }
                foreach ($english as $key => $value) {
                    if (isset($translated[$key]) && self::placeholders($value) !== self::placeholders($translated[$key])) {
                        $problems[] = "lang/{$locale}/{$file}: {$key} does not have the same placeholders";
                    }
                }
            }
        }

        foreach (glob(resource_path("devlog/{$fallback}/*.md")) ?: [] as $path) {
            foreach ($others as $locale) {
                if (! is_file(resource_path("devlog/{$locale}/".basename($path)))) {
                    $problems[] = "resources/devlog/{$locale}/".basename($path).' is not translated';
                }
            }
        }

        // CLAUDE.md, "Prose": no em dashes and no en dashes, in any language.
        $copy = array_merge(glob(lang_path('*/*.php')) ?: [], glob(resource_path('devlog/*/*.md')) ?: []);
        foreach ($copy as $path) {
            foreach (file($path) as $n => $line) {
                if (preg_match('/[\x{2013}\x{2014}]/u', $line)) {
                    $problems[] = str_replace(base_path().'/', '', $path).':'.($n + 1).' has a dash';
                }
            }
        }

        return $problems;
    }

    /** @return array<string, string> */
    public static function flatten(array $input, string $prefix = ''): array
    {
        $flat = [];

        foreach ($input as $key => $value) {
            $path = $prefix === '' ? (string) $key : "{$prefix}.{$key}";
            $flat = is_array($value) ? array_merge($flat, self::flatten($value, $path)) : $flat + [$path => (string) $value];
        }

        return $flat;
    }

    /**
     * The :placeholders in one string, sorted. Public for the page tests, which look for any of them left unfilled.
     *
     * @return list<string>
     */
    public static function placeholders(string $text): array
    {
        preg_match_all('/:[a-z_]+/', $text, $m);
        $found = $m[0];
        sort($found);

        return $found;
    }
}
