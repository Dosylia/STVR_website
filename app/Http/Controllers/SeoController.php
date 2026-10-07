<?php

namespace App\Http\Controllers;

use App\Support\Devlog;
use App\Support\Nav;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function __construct(private readonly Devlog $devlog)
    {
    }

    public function robots(): Response
    {
        $body = implode("\n", [
            'User-agent: *',
            'Allow: /',
            '',
            'Sitemap: '.url('/sitemap.xml'),
            '',
        ]);

        return response($body, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    /**
     * Every page in every language, each one declaring the others as hreflang
     * alternates. Without that, four languages of near-identical pages look
     * like duplicate content instead of one site that speaks four languages.
     */
    public function sitemap(): Response
    {
        $fallback = Nav::fallback();

        $targets = array_map(
            fn (string $page) => ['page' => $page, 'params' => []],
            array_merge(['home'], Nav::MENU, ['privacy']),
        );

        foreach ($this->devlog->all($fallback) as $entry) {
            $targets[] = ['page' => 'devlog', 'params' => ['slug' => $entry->slug]];
        }

        // Built as a string rather than through SimpleXMLElement: the xhtml:link
        // alternates need a real namespace prefix, and SimpleXML writes those
        // back out as redundant default-namespace declarations on every node.
        $lines = [
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">',
        ];

        foreach ($targets as $target) {
            $alternates = Nav::alternates($target['page'], $target['params']);

            foreach ($alternates as $self) {
                $lines[] = '  <url>';
                $lines[] = '    <loc>'.e($self['url']).'</loc>';
                $lines[] = '    <changefreq>'.($target['page'] === 'home' ? 'weekly' : 'monthly').'</changefreq>';
                $lines[] = '    <priority>'.($target['page'] === 'home' ? '1.0' : '0.7').'</priority>';

                foreach ($alternates as $alt) {
                    $lines[] = '    <xhtml:link rel="alternate" hreflang="'.e($alt['tag']).'" href="'.e($alt['url']).'"/>';
                }

                $lines[] = '    <xhtml:link rel="alternate" hreflang="x-default" href="'
                    .e($alternates[$fallback]['url'] ?? $self['url']).'"/>';
                $lines[] = '  </url>';
            }
        }

        $lines[] = '</urlset>';

        return response(implode("\n", $lines), 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
