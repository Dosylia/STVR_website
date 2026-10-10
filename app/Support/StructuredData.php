<?php

namespace App\Support;

/**
 * The JSON-LD the pages carry, built here rather than in the views. Blade reads
 * '@context' inside a template as its own @context directive and pastes PHP
 * into the JSON, which is how the live site came to serve structured data that
 * no search engine could parse. In a class the string is just a string.
 */
final class StructuredData
{
    /**
     * Every page: the site itself and the mod as a piece of software, in one
     * graph. alternateName carries the project's earlier name, which is still
     * the name of its GitHub repository and of the mod's own launcher, and so
     * what a good share of people will type.
     */
    public static function site(string $description, string $url, array $alternates): string
    {
        $home = $alternates[app()->getLocale()]['url'] ?? $url;

        return self::encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'WebSite',
                    '@id' => url('/').'#website',
                    'name' => config('stvr.name'),
                    'alternateName' => 'Skyrim Together VR',
                    'url' => url('/'),
                    'inLanguage' => array_column($alternates, 'tag'),
                ],
                [
                    '@type' => 'SoftwareApplication',
                    '@id' => url('/').'#mod',
                    'name' => config('stvr.name'),
                    'alternateName' => ['Skyrim Together VR', 'SkyrimTogetherVR'],
                    'applicationCategory' => 'GameApplication',
                    'applicationSubCategory' => 'Multiplayer mod for Skyrim VR',
                    'operatingSystem' => 'Windows',
                    'description' => $description,
                    'url' => $home,
                    'image' => url('/og.png'),
                    'license' => config('stvr.links.licence'),
                    'isAccessibleForFree' => true,
                    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
                    'sameAs' => array_values(array_filter([
                        Nav::link('github'),
                        Nav::link('discord'),
                        Nav::link('nexus'),
                    ])),
                    'isBasedOn' => Nav::link('upstream'),
                ],
            ],
        ]);
    }

    /** One devlog entry, as an article: in English when it has no translation yet, whatever the page's language. */
    public static function post(DevlogEntry $entry): string
    {
        return self::encode([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $entry->title,
            'description' => $entry->summary,
            'datePublished' => $entry->date->format('Y-m-d'),
            'inLanguage' => $entry->translated ? app()->getLocale() : Nav::fallback(),
            'url' => Nav::url('devlog', null, ['slug' => $entry->slug]),
            'publisher' => ['@type' => 'Organization', 'name' => config('stvr.name')],
        ]);
    }

    /** The FAQ page's questions and answers, tags stripped. */
    public static function faq(array $groups): string
    {
        return self::encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($groups)->flatMap(fn ($g) => $g['items'])->map(fn ($i) => [
                '@type' => 'Question',
                'name' => strip_tags($i['q']),
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags(Facts::fill($i['a']))],
            ])->values()->all(),
        ]);
    }

    private static function encode(array $data): string
    {
        // JSON_HEX_TAG so a "</script>" in any copy can never close the tag early.
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG);
    }
}
