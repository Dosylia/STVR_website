@extends('layouts.app')
@php
    use App\Support\Nav;
    use Illuminate\Support\Carbon;
    $locale = app()->getLocale();
    $when = fn (?string $iso, string $format) => $iso ? Carbon::parse($iso)->locale($locale)->isoFormat($format) : null;
    // Three states: no status at all (not open yet), a status that says offline, and online.
    $open = $status['live'] && $status['name'];
    // The words the page's script needs to redraw the roster and the count (site.js, public server).
    $i18n = [
        'inside'  => __('public.who.inside'),
        'areas'   => __('public.map.areas'),
        'updated' => __('public.status.updated'),
        'hidden1' => trans_choice('public.who.hidden', 1, ['count' => ':count']),
        'hidden'  => trans_choice('public.who.hidden', 2, ['count' => ':count']),
    ];
@endphp

@section('title', __('public.meta.title'))
@section('description', __('public.meta.description'))

@push('head')
    {{-- Until the server is switched on (config stvr.public_server.enabled) the page exists for review only. --}}
    @unless (config('stvr.public_server.enabled'))
        <meta name="robots" content="noindex">
    @endunless
@endpush

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            @include('partials.kicker', ['text' => __('public.hero.kicker')])
            <h1>{{ __('public.hero.title') }}</h1>
            <p class="hero__lede">{{ __('public.hero.lede') }}</p>
        </div>
    </div>
</section>

@if ($status['sample'])
    <div class="shell"><p class="notice" style="margin-top:2rem">{{ __('public.closed.sample') }}</p></div>
@endif

@unless ($open)
    {{-- ======================================================== not open ==== --}}
    <section class="section">
        <div class="shell shell--narrow center">
            <p class="inscription inscription--center">{{ __('public.status.label') }}</p>
            <h2>{{ __('public.closed.title') }}</h2>
            <p class="lede" style="margin-inline:auto">{{ __('public.closed.body') }}</p>
            <div class="btn-row btn-row--center" style="margin-top:2rem">
                <a class="btn btn--ghost" href="{{ Nav::url('host') }}">{{ __('public.closed.cta') }}</a>
            </div>
        </div>
    </section>
@else
    {{-- ========================================================== status ==== --}}
    <section class="section">
        <div class="shell">
            <div class="grid grid--2" style="align-items:start;gap:clamp(1.5rem,4vw,3rem)">

                <article class="tablet server reveal" id="publicServer"
                         data-feed="{{ route('public.status') }}"
                         data-online="{{ $status['online'] ? '1' : '0' }}"
                         data-every="10"
                         data-locale="{{ $locale }}"
                         data-i18n="{{ json_encode($i18n) }}">
                    <p class="server__state {{ $status['online'] ? 'is-online' : 'is-offline' }}">
                        <span class="server__dot" aria-hidden="true"></span>
                        {{ $status['online'] ? __('public.status.online') : __('public.status.offline') }}
                    </p>
                    <h2 class="server__name">{{ $status['name'] }}</h2>

                    @if ($status['online'])
                        <p class="server__count">
                            <span class="server__count-n" data-count>{{ $status['count'] }}</span>
                            @if ($status['max'])
                                <span class="server__count-of">/ {{ $status['max'] }}</span>
                            @endif
                            <span class="server__count-label">{{ __('public.status.players') }}</span>
                        </p>
                    @else
                        <p>{{ __('public.status.offline_body') }}</p>
                    @endif

                    <dl class="server__facts">
                        @if ($status['address'])
                            <div>
                                <dt>{{ __('public.status.address') }}</dt>
                                <dd>
                                    <div class="copyline">
                                        <pre class="copyline__code" id="serverAddress">{{ $status['address'] }}</pre>
                                        <button class="copyline__btn" type="button" data-copy="serverAddress"
                                                data-copied="{{ __('site.cta.copied') }}">{{ __('site.cta.copy') }}</button>
                                    </div>
                                </dd>
                            </div>
                        @endif
                        @if ($status['version'])
                            <div><dt>{{ __('public.status.version') }}</dt><dd class="mono">{{ $status['version'] }}</dd></div>
                        @endif
                        @if ($status['protocol'])
                            <div><dt>{{ __('public.status.protocol') }}</dt><dd class="mono">{{ $status['protocol'] }}</dd></div>
                        @endif
                        <div><dt>{{ __('public.status.password') }}</dt><dd>{{ $status['password'] ? __('public.status.password_yes') : __('public.status.password_no') }}</dd></div>
                        @if ($status['startedAt'])
                            <div><dt>{{ __('public.status.up_since') }}</dt><dd>{{ $when($status['startedAt'], 'LLL') }}</dd></div>
                        @endif
                    </dl>

                    {{-- The launcher's own link: it opens the launcher, which asks before it joins. --}}
                    @if ($status['online'] && $status['address'])
                        <div class="server__join">
                            <a class="btn btn--forge" href="ursovngarde://join?address={{ $status['address'] }}">
                                @include('partials.icon', ['name' => 'arrow'])
                                {{ __('public.join.button') }}
                            </a>
                            <p class="server__join-note">{{ __('public.join.button_note') }}</p>
                        </div>
                    @endif

                    @if ($status['updatedAt'])
                        <p class="server__updated" data-updated>{{ __('public.status.updated', ['time' => $when($status['updatedAt'], 'LLL')]) }}</p>
                    @endif
                </article>

                <div>
                    <p class="inscription">{{ __('public.join.label') }}</p>
                    <h2>{{ __('public.join.title') }}</h2>
                    <ol class="steps reveal" style="margin-top:1.6rem">
                        @foreach (__('public.join.steps') as $step)
                            <li class="steps__item">
                                <p class="steps__title">{{ $step['title'] }}</p>
                                <p class="steps__body">{{ strtr($step['body'], [':version' => $status['version'] ?? '?', ':protocol' => $status['protocol'] ?? '?']) }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================================================= who + map ==== --}}
    @if ($status['online'])
        <section class="section section--lift">
            <div class="shell">
                <div class="where">
                    <div class="where__list">
                        <p class="inscription">{{ __('public.who.label') }}</p>
                        <h2>{{ __('public.who.title') }}</h2>

                        <ul class="roster reveal" data-roster @unless ($status['players']) hidden @endunless>
                                @foreach ($status['players'] as $player)
                                    <li class="roster__item" data-id="{{ $player['id'] }}">
                                        <span class="roster__rune" aria-hidden="true">{{ mb_strtoupper(mb_substr($player['name'], 0, 1)) }}</span>
                                        <span class="roster__name">{{ $player['name'] }}</span>
                                        <span class="roster__where">
                                            {{ implode(' · ', array_filter([
                                                $player['where'],
                                                $player['area'] ? __('public.map.areas.'.$player['area']) : null,
                                                $player['point'] || $player['area'] ? null : __('public.who.inside'),
                                            ])) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        <p class="roster__hidden" data-hidden @unless ($status['hidden']) hidden @endunless>{{ trans_choice('public.who.hidden', $status['hidden'], ['count' => $status['hidden']]) }}</p>
                        <p class="roster__note" data-note @unless ($status['players']) hidden @endunless>{{ __('public.who.note') }}</p>
                        <p class="roster__note">{{ __('public.who.hide') }}</p>
                        <p class="lede" data-none @if ($status['players']) hidden @endif>{{ __('public.who.none') }}</p>
                    </div>

                    <figure class="where__map reveal">
                        <p class="inscription">{{ __('public.map.label') }}</p>
                        {{-- One drawing per worldspace worth drawing, as tabs (the install page's), each with how many players
                             are there; the page opens on the busiest. site.js keeps the counts and the dots current. --}}
                        <div data-tabs class="maps">
                            <div class="tabs__list maps__tabs" role="tablist" aria-label="{{ __('public.map.switch') }}">
                                @foreach ($status['maps'] as $slug => $n)
                                    <button class="tabs__tab" type="button" role="tab" data-tab="{{ $slug }}"
                                            id="map-tab-{{ $slug }}" aria-controls="map-{{ $slug }}"
                                            aria-selected="{{ $slug === $status['openMap'] ? 'true' : 'false' }}">
                                        {{ __('public.map.areas.'.$slug) }}
                                        <span class="maps__count" data-map-count="{{ $slug }}">{{ $n }}</span>
                                    </button>
                                @endforeach
                            </div>
                            @foreach ((array) config('stvr.public_server.maps') as $map)
                                <div class="maps__panel" role="tabpanel" data-panel="{{ $map['slug'] }}"
                                     id="map-{{ $map['slug'] }}" aria-labelledby="map-tab-{{ $map['slug'] }}"
                                     @if ($map['slug'] !== $status['openMap']) hidden @endif>
                                    <div class="where__scroll">@include($map['view'], ['players' => $status['players']])</div>
                                </div>
                            @endforeach
                        </div>
                        <figcaption>{{ __('public.map.note', ['seconds' => 10]) }}</figcaption>
                    </figure>
                </div>
            </div>
        </section>
    @endif

    {{-- =========================================================== rules ==== --}}
    <section class="section section--tight">
        <div class="shell shell--narrow">
            <p class="inscription">{{ __('public.rules.label') }}</p>
            <h2>{{ __('public.rules.title') }}</h2>
            <ul class="notes" style="margin-top:1.4rem">
                @foreach (__('public.rules.items') as $rule)
                    <li>{{ $rule }}</li>
                @endforeach
            </ul>
        </div>
    </section>
@endunless

@include('partials.community')

@include('partials.closer', [
    'title'        => __('public.cta.title'),
    'body'         => __('public.cta.body'),
    'primary'      => __('public.cta.primary'),
    'primaryUrl'   => Nav::url('host'),
    'secondary'    => __('public.cta.secondary'),
    'secondaryUrl' => Nav::url('download'),
])

@endsection
