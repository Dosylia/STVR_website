<?php

namespace App\Providers;

use App\Support\Devlog;
use App\Support\Nav;
use App\Support\ReleaseService;
use App\Support\Shots;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ReleaseService::class);
        $this->app->singleton(Devlog::class);
        $this->app->singleton(Shots::class);
    }

    public function boot(): void
    {
        /**
         * @stvr('facts.port') — a fact from config, escaped, in the middle of a
         * sentence. Keeps port numbers and version strings out of 4 × n
         * translation files, where they would drift apart within a month.
         */
        Blade::directive('stvr', fn ($expression) => "<?php echo e(config('stvr.'.{$expression})); ?>");

        /** @nav('install') — a URL for the current language. */
        Blade::directive('nav', fn ($expression) => "<?php echo e(\App\Support\Nav::url({$expression})); ?>");

        /**
         * @assetv('assets/css/site.css') — the asset URL with ?v=<mtime>.
         *
         * nginx serves these immutable for a month, so without a cache key an
         * edit to the stylesheet reaches nobody who has already visited. The
         * file's own modification time is the key: nothing to remember, nothing
         * to bump by hand, and it changes exactly when the file does.
         */
        Blade::directive('assetv', function ($expression) {
            return "<?php echo e(\App\Support\Nav::asset({$expression})); ?>";
        });
    }
}
