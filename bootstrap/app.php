<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Every web request learns its language from the first URL segment.
        $middleware->web(append: [SetLocale::class]);

        // PHP-FPM is only reachable from the nginx container on the internal
        // network, so the forwarded headers it sees are our own. Honouring them
        // is what makes canonical URLs, hreflang tags and redirects come out as
        // https:// behind a TLS terminator, without pretending every request is
        // https, which is what forcing the scheme outright used to do here and
        // which breaks a plain-http deployment.
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
