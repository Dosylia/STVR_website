@extends('layouts.app')
@php use App\Support\Nav; @endphp

@section('title', __('download.meta.title'))
@section('description', __('download.meta.description'))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            @include('partials.kicker', ['text' => __('download.hero.kicker')])
            <h1>{{ __('download.hero.title') }}</h1>
            <p class="hero__lede">{{ __('download.hero.lede') }}</p>
        </div>
    </div>
</section>

{{-- ======================================================= the build ==== --}}
<section class="section section--tight">
    <div class="shell">

        <div class="release reveal">
            @include('art.seal', ['class' => 'seal'])

            <div>
                <p class="release__tag">{{ $release->tag ?: __('download.release.current') }}</p>
                <div class="release__meta">
                    @if ($release->live)
                        <span class="pill pill--live"><span class="pill__dot"></span>{{ __('download.release.live_label') }}</span>
                        @if ($release->publishedAt)
                            <span>{{ __('download.release.published', ['date' => $release->publishedAt->isoFormat('LL')]) }}</span>
                        @endif
                        @if ($release->downloads() > 0)
                            <span>{{ __('download.release.downloads', ['count' => \Illuminate\Support\Number::format($release->downloads(), locale: app()->getLocale())]) }}</span>
                        @endif
                    @else
                        <span class="pill pill--gold">{{ __('download.state.fallback_title') }}</span>
                    @endif
                    <a href="{{ Nav::link('releases') }}" rel="noopener">{{ __('download.release.mirror') }}</a>
                </div>
            </div>
        </div>

        @unless ($release->live)
            <p class="notice" style="margin-top:1.4rem">
                {{ $release->exists() ? __('download.state.fallback_body') : __('download.state.none_body') }}
            </p>
        @endunless

        {{-- The launcher first: the way in for nearly everyone. The button downloads the launcher from this site
             (its copy of the newest GitHub release); until there is one it says so and leads nowhere. --}}
        <article class="tablet asset asset--lead reveal" style="margin-top:2.2rem">
            <div class="asset__head">
                <h2 class="asset__title">{{ __('download.assets.launcher.title') }}</h2>
                @if ($launcher && $launcher->humanSize())
                    <span class="asset__size">{{ $launcher->humanSize() }}</span>
                @endif
            </div>
            {{-- Version and date from the GitHub release the site copied the file from, like the mod's line above, and
                 the hub's count. Any one of them is reason enough for the line. --}}
            @if ($launcherBuild && ($launcherBuild->version || $launcherBuild->publishedAt || $launcherDownloads))
                <p class="release__meta asset__release">
                    @if ($launcherBuild->version)
                        <span>{{ __('download.assets.launcher.version', ['version' => $launcherBuild->version]) }}</span>
                    @endif
                    @if ($launcherBuild->publishedAt)
                        <span>{{ __('download.assets.launcher.updated', ['date' => $launcherBuild->published()->isoFormat('LL')]) }}</span>
                    @endif
                    {{-- All versions together, as the hub counts downloads from this site (App\Support\HubStats). --}}
                    @if ($launcherDownloads)
                        <span>{{ trans_choice('download.assets.launcher.downloads', $launcherDownloads, ['count' => \Illuminate\Support\Number::format($launcherDownloads, locale: app()->getLocale())]) }}</span>
                    @endif
                </p>
            @endif
            {{-- Which setups it handles, as tags beside "start here": the first
                 thing a modder wants to know is whether it fits theirs. --}}
            <div class="asset__tags">
                <span class="pill pill--gold">{{ __('download.assets.launcher.meta') }}</span>
                <span class="asset__works">{{ __('download.assets.launcher.works_with') }}</span>
                @foreach (__('download.assets.launcher.setups') as $setup)
                    <span class="pill pill--live">@include('partials.icon', ['name' => 'check', 'class' => 'pill__icon']){{ $setup }}</span>
                @endforeach
            </div>
            <p>{{ __('download.assets.launcher.body') }}</p>
            @if ($launcher)
                <a class="btn btn--forge" href="{{ $launcher->url }}" download rel="noopener">
                    @include('partials.icon', ['name' => 'download'])
                    {{ __('download.assets.download_cta') }}
                </a>
            @else
                <span class="btn btn--forge btn--off" aria-disabled="true">
                    @include('partials.icon', ['name' => 'download'])
                    {{ __('download.assets.launcher.soon') }}
                </span>
                <p class="asset__soon">{{ __('download.assets.launcher.soon_note') }}</p>
            @endif

            {{-- The release's own notes from GitHub, as written (in English). --}}
            @if ($launcherBuild && filled($launcherBuild->notes))
                <details class="asset__notes">
                    <summary>{{ $launcherBuild->version ? __('download.assets.launcher.notes', ['version' => $launcherBuild->version]) : __('download.assets.launcher.notes_no_version') }}</summary>
                    <div class="entry__body">
                        {!! \Illuminate\Support\Str::markdown($launcherBuild->notes, ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}
                        @if (__('download.assets.launcher.notes_lang'))
                            <p class="asset__notes-lang">{{ __('download.assets.launcher.notes_lang') }}</p>
                        @endif
                    </div>
                </details>
            @endif
        </article>

        {{-- The launcher is not code-signed, so Windows warns on its first run. Said before it happens, with what to
             press, so the warning reads as expected rather than as a sign of malware. --}}
        @if ($launcher)
            <div class="smartscreen reveal">
                <div class="smartscreen__text">
                    <p class="inscription">{{ __('download.smartscreen.label') }}</p>
                    <h3>{{ __('download.smartscreen.title') }}</h3>
                    <p>{{ __('download.smartscreen.body') }}</p>
                    <ol class="smartscreen__steps">
                        <li>{!! __('download.smartscreen.step1', ['more' => '<strong>'.e(__('download.smartscreen.more')).'</strong>']) !!}</li>
                        <li>{!! __('download.smartscreen.step2', ['run' => '<strong>'.e(__('download.smartscreen.run')).'</strong>']) !!}</li>
                    </ol>
                    <p class="smartscreen__why">{{ __('download.smartscreen.why') }}</p>
                </div>
                {{-- A drawing of the two moments, in the site's own style: not a copy of Windows. --}}
                <div class="smartscreen__art" aria-hidden="true">
                    <div class="sswin">
                        <p class="sswin__title">{{ __('download.smartscreen.dialog') }}</p>
                        <span class="sswin__line"></span><span class="sswin__line sswin__line--short"></span>
                        <span class="sswin__link is-pointed">{{ __('download.smartscreen.more') }}</span>
                        <span class="sswin__n">1</span>
                    </div>
                    <div class="sswin">
                        <p class="sswin__title">{{ __('download.smartscreen.dialog') }}</p>
                        <span class="sswin__line"></span><span class="sswin__line sswin__line--short"></span>
                        <span class="sswin__buttons"><span class="sswin__btn is-pointed">{{ __('download.smartscreen.run') }}</span><span class="sswin__btn sswin__btn--ghost"></span></span>
                        <span class="sswin__n">2</span>
                    </div>
                </div>
            </div>
        @endif

        <p class="inscription" style="margin-top:2.6rem">{{ __('download.assets.by_hand') }}</p>

        {{-- Three cards, but only for the files that actually exist in the
             release. An empty "Server" slot would promise a download that is
             not there, which is worse than not mentioning it. --}}
        <div class="assets">
            @foreach (['full', 'patch', 'server'] as $kind)
                @php $asset = $release->asset($kind); @endphp
                @continue(! $asset && $kind === 'server')

                <article class="tablet asset reveal">
                    <div class="asset__head">
                        <h2 class="asset__title">{{ __("download.assets.{$kind}.title") }}</h2>
                        @if ($asset && $asset->humanSize())
                            <span class="asset__size">{{ $asset->humanSize() }}</span>
                        @endif
                    </div>
                    <span class="pill" style="align-self:flex-start;margin-bottom:.9rem">{{ __("download.assets.{$kind}.meta") }}</span>
                    <p>{{ __("download.assets.{$kind}.body") }}</p>
                    <a class="btn btn--ghost"
                       href="{{ $asset?->url ?: $release->landingUrl() }}"
                       @if ($asset) download @endif rel="noopener">
                        @include('partials.icon', ['name' => 'download'])
                        {{ __('download.assets.download_cta') }}
                    </a>
                </article>
            @endforeach
        </div>

        @if ($release->live && filled($release->notes))
            <details class="faq__q reveal" style="margin-top:2.5rem;border:1px solid var(--stone-800);border-radius:var(--radius);padding:0 1.2rem">
                <summary>{{ __('download.release.notes') }}</summary>
                <div class="faq__a entry__body">{!! \Illuminate\Support\Str::markdown($release->notes, ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}</div>
            </details>
        @endif
    </div>
</section>

{{-- ==================================================== requirements ==== --}}
<section class="section section--lift">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('download.requires.label') }}</p>
        <h2>{{ __('download.requires.title') }}</h2>
        <p class="lede">{{ __('download.requires.lede') }}</p>

        <ul class="reqs reveal" style="margin-top:2rem">
            @foreach (__('download.requires.items') as $item)
                <li class="reqs__item reqs__item--{{ $item['state'] }}">
                    <span class="reqs__mark" aria-hidden="true">{{ $item['state'] === 'required' ? '✦' : '✧' }}</span>
                    <span class="reqs__head">
                        <span class="reqs__name">{{ __($item['name'], ['version' => config('stvr.facts.game_version')]) }}</span>
                        <span class="reqs__state">{{ __('site.misc.'.$item['state']) }}</span>
                    </span>
                    <span class="reqs__note">{{ $item['note'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>

{{-- ====================================================== after that ==== --}}
<section class="section">
    <div class="shell">
        <p class="inscription">{{ __('download.next.label') }}</p>
        <h2>{{ __('download.next.title') }}</h2>

        <div class="grid grid--3" style="margin-top:2.5rem">
            @foreach ([['install', 'book', Nav::url('install')], ['host', 'server', Nav::url('host')], ['issues', 'bug', Nav::link('issues')]] as [$key, $icon, $url])
                <article class="tablet reveal">
                    <span class="tablet__rune" aria-hidden="true">@include('partials.icon', ['name' => $icon, 'class' => 'tablet__svg'])</span>
                    <h3>{{ __("download.next.{$key}.title") }}</h3>
                    <p>{{ __("download.next.{$key}.body") }}</p>
                    <a class="btn btn--ghost btn--small" href="{{ $url }}" style="margin-top:1.2rem" rel="noopener">{{ __("download.next.{$key}.cta") }}</a>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ========================================================== trust ===== --}}
<section class="section section--lift">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('download.safety.label') }}</p>
        <h2>{{ __('download.safety.title') }}</h2>
        <p class="lede" style="max-width:none">{{ __('download.safety.body') }}</p>
        <div class="btn-row" style="margin-top:1.8rem">
            <a class="btn btn--ghost" href="{{ Nav::link('github') }}" rel="noopener">
                @include('partials.icon', ['name' => 'github'])
                {{ __('download.safety.cta') }}
            </a>
        </div>
    </div>
</section>

@include('partials.community')

@include('partials.closer', [
    'title'        => __('install.hero.title'),
    'body'         => __('download.next.install.body'),
    'primary'      => __('download.next.install.cta'),
    'primaryUrl'   => Nav::url('install'),
    'secondary'    => __('download.next.host.cta'),
    'secondaryUrl' => Nav::url('host'),
])

@endsection
