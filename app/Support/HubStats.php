<?php

namespace App\Support;

use Illuminate\Http\Request;
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
