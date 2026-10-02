<!doctype html>
<html lang="{{ $alternates[app()->getLocale()]['tag'] ?? app()->getLocale() }}">
<head>
    @include('partials.head')
    @stack('head')
</head>
<body>
    <a class="skip" href="#content">{{ __('site.misc.skip') }}</a>

    @include('partials.masthead')

    <main id="content">
        @yield('body')
    </main>

    @include('partials.footer')

    <script src="@assetv('assets/js/site.js')" defer></script>
    @stack('scripts')
</body>
</html>
