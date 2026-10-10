<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Tells the hub (~/dev/urSovngarde-hub, POST /stats) that a launcher was
 * downloaded from this site, or that an installed launcher asked whether there
 * is an update. The hub's panel shows the numbers.
 *
 * Only an event name and a version go out, never anything about the visitor.
 * It is sent after the response, so a slow or unreachable hub can never hold up
 * a download, and a failure is dropped: a missed count is not worth an error.
 */
final class HubStats
{
    // Link previews, crawlers and scripts are not people downloading a launcher.
    private const NOT_A_PERSON = '/bot|crawl|spider|slurp|preview|facebookexternalhit|curl|wget|python|httpclient|go-http|java\//i';

    public static function launcherDownload(Request $request, ?string $version): void
    {
        if (self::counts($request) && ! self::resumed($request)) {
            self::later('launcherDownload', $version);
        }
    }

    public static function updateCheck(Request $request): void
    {
        if (self::counts($request)) {
            self::later('updateCheck', null);
        }
    }

    /**
     * How many times the launcher has been downloaded from this site, all time, as the hub counts it (GET
     * /stats/public), for the download card. Null when the hub cannot be reached, and the card then simply shows
     * no count.
     *
     * Fresh for ten minutes. After that the copy is still served, and the hub is asked again once the response has
     * gone out, by one request at a time (Cache::flexible), so neither a slow hub nor a crowd arriving at expiry holds
     * a page up. A page waits for the hub only when there is no copy at all: the first visit after the cache is
     * cleared, or after a day without a visit.
     */
    public static function launcherDownloads(): ?int
    {
        $url = rtrim((string) config('stvr.hub.url'), '/');

        if ($url === '') {
            return null;
        }

        $count = Cache::flexible('stvr.hub.downloads', [600, 86400], function () use ($url) {
            try {
                $response = Http::timeout(3)->acceptJson()->get("{$url}/stats/public");
                $n = $response->successful() ? $response->json('launcherDownloads') : null;

                return is_int($n) && $n >= 0 ? $n : false;
            } catch (\Throwable) {
                return false;
            }
        });

        return is_int($count) ? $count : null;
    }

    /** A real GET from something that is not a bot. HEAD asks about the file without taking it. */
    private static function counts(Request $request): bool
    {
        return $request->isMethod('GET') && ! preg_match(self::NOT_A_PERSON, (string) $request->userAgent());
    }

    /** A download picked up part way (a Range that does not start at 0) was counted when it began. */
    private static function resumed(Request $request): bool
    {
        $range = (string) $request->header('Range', '');

        return $range !== '' && ! preg_match('/^bytes=0-/', $range);
    }

    private static function later(string $event, ?string $version): void
    {
        $url = rtrim((string) config('stvr.hub.url'), '/');
        $key = (string) config('stvr.hub.site_key');

        if ($url === '' || $key === '') {
            return;
        }

        // After the response is sent. For a download that is after the file has gone out, so a download given up
        // half way usually ends the request before this runs and is not counted.
        app()->terminating(function () use ($url, $key, $event, $version) {
            try {
                Http::withToken($key)->timeout(3)->post("{$url}/stats", array_filter([
                    'event'   => $event,
                    'version' => $version,
                ]));
            } catch (\Throwable $e) {
                Log::info('stvr: hub stat not sent', ['event' => $event, 'error' => $e->getMessage()]);
            }
        });
    }
}
