<?php

namespace App\Http\Middleware;

use App\Support\Nav;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The language is the first URL segment and nothing else — no session, no
 * cookie, no sniffing on every request. One URL, one language, shareable,
 * cacheable, and indexable. The only negotiation happens once, at "/".
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (Nav::supports($locale)) {
            app()->setLocale($locale);
        } else {
            app()->setLocale(Nav::fallback());
        }

        return $next($request);
    }
}
