@php
    use App\Support\Nav;
@endphp

<footer class="footer">
    <div class="shell">
        <div class="footer__top">

            <div class="footer__about">
                <a class="wordmark" href="{{ Nav::url('home') }}">
                    @include('art.sigil', ['class' => 'wordmark__sigil'])
                    <span class="wordmark__text">
                        <span class="wordmark__a">{{ __('site.brand_a') }} {{ __('site.brand_b') }} <em class="wordmark__vr">{{ __('site.brand_c') }}</em></span>
                        <span class="wordmark__b">{{ __('site.tagline') }}</span>
                    </span>
                </a>
                <p>{{ __('home.hero.lede') }}</p>
            </div>

            <div class="footer__col">
                <h4>{{ __('site.footer.project') }}</h4>
                <ul class="footer__list">
                    @foreach (['download', 'install', 'host'] as $item)
                        <li><a href="{{ Nav::url($item) }}">{{ __("site.nav.{$item}") }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer__col">
                <h4>{{ __('site.nav.devlog') }}</h4>
                <ul class="footer__list">
                    @foreach (['roadmap', 'devlog', 'faq'] as $item)
                        <li><a href="{{ Nav::url($item) }}">{{ __("site.nav.{$item}") }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer__col">
                <h4>{{ __('site.footer.community') }}</h4>
                <ul class="footer__list">
                    <li><a href="{{ Nav::link('github') }}" rel="noopener">{{ __('site.cta.github') }}</a></li>
                    @if ($discord = Nav::link('discord'))
                        <li><a href="{{ $discord }}" rel="noopener">{{ __('site.cta.discord') }}</a></li>
                    @endif
                    @if ($nexus = Nav::link('nexus'))
                        <li><a href="{{ $nexus }}" rel="noopener">{{ __('site.cta.nexus') }}</a></li>
                    @endif
                    <li><a href="{{ Nav::link('issues') }}" rel="noopener">{{ __('site.cta.issues') }}</a></li>
                </ul>
            </div>
        </div>

        {{-- The small print is not decorative. A fan project that leans on a
             publisher's trademark needs to say plainly that it is not them, and
             a GPL fork needs to credit what it forked. --}}
        <div class="footer__fine">
            <p>{!! __('site.footer.upstream', [
                'reborn' => '<a href="'.e(Nav::link('upstream')).'" rel="noopener">Skyrim Together Reborn</a>',
            ]) !!}</p>
            <p>{!! __('site.footer.licence', [
                'licence' => '<a href="'.e(Nav::link('licence')).'" rel="noopener">'.e(config('stvr.facts.licence')).'</a>',
            ]) !!}</p>
            <p>{{ __('site.footer.built') }}</p>
            <p><strong>{{ __('site.footer.rights') }}</strong></p>
        </div>
    </div>
</footer>
