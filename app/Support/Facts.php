<?php

namespace App\Support;

use Illuminate\Support\Carbon;

/**
 * The facts from config('stvr.facts') as :placeholders, for copy that is read
 * out of a translation array and so never passes through __()'s own replace.
 * A date is written the way the page's language writes dates ("9 octobre
 * 2026", "9. Oktober 2026"), so the translation files never carry one.
 */
final class Facts
{
    public static function all(): array
    {
        $f = (array) config('stvr.facts', []);
        $date = fn (string $iso) => Carbon::parse($iso)->locale(app()->getLocale())->isoFormat('LL');

        return [
            'port'         => (string) ($f['port'] ?? ''),
            'protocol'     => (string) ($f['protocol'] ?? ''),
            'relay_since'  => isset($f['relay_since']) ? $date($f['relay_since']) : '',
            'relay_min'    => (string) ($f['relay_min_launcher'] ?? ''),
            'vortex_min'   => (string) ($f['vortex_mod_min'] ?? ''),
            'invite_hours' => (string) ($f['invite_hours'] ?? ''),
            'max_players'  => (string) ($f['max_players'] ?? ''),
        ];
    }

    /** Puts the facts into a piece of copy. Longest names first, so :port never eats :portable. */
    public static function fill(string $text, array $extra = []): string
    {
        $pairs = [];
        foreach (array_merge(self::all(), $extra) as $key => $value) {
            $pairs[':'.$key] = (string) $value;
        }
        uksort($pairs, fn ($a, $b) => strlen($b) <=> strlen($a));

        return strtr($text, $pairs);
    }
}
