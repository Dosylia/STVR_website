@php
    use App\Support\Nav;
    $links = Nav::links();
@endphp

<header class="masthead" id="masthead">
    <div class="shell masthead__inner">

        <a class="wordmark" href="{{ Nav::url('home') }}">
            @include('art.sigil', ['class' => 'wordmark__sigil', 'title' => config('stvr.name')])
            <span class="wordmark__text">
                <span class="wordmark__a"><em class="wordmark__ur">{{ __('site.brand_a') }}</em>{{ __('site.brand_b') }}</span>
                <span class="wordmark__b">{{ __('site.tagline') }}</span>
            </span>
        </a>

        <nav class="nav" id="nav" aria-label="{{ __('site.nav.menu') }}">
            @foreach (Nav::MENU as $item)
                <a class="nav__link"
                   href="{{ Nav::url($item) }}"
                   @if (($page ?? '') === $item) aria-current="page" @endif>{{ __("site.nav.{$item}") }}</a>
            @endforeach
        </nav>

        <div class="masthead__actions">
            {{-- The switcher keeps you on the page you are reading. Sending
                 someone to the home page because they wanted German is the
                 commonest way a multilingual site insults its own visitors. --}}
            <div class="lang" id="lang">
                <button class="lang__toggle" type="button" id="langToggle"
                        aria-expanded="false" aria-controls="langMenu"
                        aria-label="{{ __('site.lang.change') }}">
                    <span class="lang__rune" aria-hidden="true">{{ $alternates[app()->getLocale()]['rune'] ?? 'ᛝ' }}</span>
                    <span>{{ $alternates[app()->getLocale()]['short'] ?? strtoupper(app()->getLocale()) }}</span>
                    @include('partials.icon', ['name' => 'chevron', 'class' => 'lang__chev'])
                </button>
                <ul class="lang__menu" id="langMenu" role="list">
                    @foreach ($alternates as $alt)
                        <li>
                            <a class="lang__item" href="{{ $alt['url'] }}" lang="{{ $alt['tag'] }}"
                               hreflang="{{ $alt['tag'] }}"
                               @if ($alt['current']) aria-current="true" @endif>
                                <span class="lang__rune" aria-hidden="true">{{ $alt['rune'] }}</span>
                                {{ $alt['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a class="btn btn--forge btn--small masthead__cta" href="{{ Nav::url('download') }}">
                @include('partials.icon', ['name' => 'download'])
                {{ __('site.cta.download') }}
            </a>

            <button class="burger" type="button" id="burger" aria-expanded="false" aria-controls="nav"
                    aria-label="{{ __('site.nav.menu') }}">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</header>
