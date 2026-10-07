@extends('layouts.app')
@php use App\Support\Nav; @endphp

@section('title', __('home.meta.title'))
@section('description', __('home.meta.description'))

@section('body')

{{-- ============================================================ hero ==== --}}
<section class="hero">
    <div class="hero__scene">@include('art.scene')</div>
    <canvas class="hero__snow" id="snow" aria-hidden="true"></canvas>

    <div class="shell">
        <div class="hero__inner">
            <p class="hero__kicker">{{ __('home.hero.kicker') }}</p>
            <h1>{{ __('home.hero.title') }}</h1>
            <p class="hero__lede">{{ __('home.hero.lede') }}</p>

            <div class="btn-row">
                <a class="btn btn--forge" href="{{ Nav::url('download') }}">
                    @include('partials.icon', ['name' => 'download'])
                    {{ __('home.hero.primary') }}
                </a>
                <a class="btn btn--ghost" href="{{ Nav::url('install') }}">
                    @include('partials.icon', ['name' => 'book'])
                    {{ __('home.hero.secondary') }}
                </a>
            </div>
        </div>
    </div>

    <p class="hero__caption">{{ __('home.hero.caption') }}</p>
</section>

{{-- ====================================================== stat band ==== --}}
<section class="band">
    <div class="shell">
        <div class="band__grid">
            <div class="band__cell">
                <p class="band__label">{{ __('home.stats.version_label') }}</p>
                <p class="band__value">{{ $release->tag ?: ($release->exists() ? __('home.stats.version_rolling') : __('home.stats.version_none')) }}</p>
                <p class="band__note">
                    @if ($release->live && $release->publishedAt)
                        {{ $release->publishedAt->format('j F Y') }}
                    @else
                        <a href="{{ Nav::link('releases') }}" rel="noopener">{{ __('download.release.mirror') }}</a>
                    @endif
                </p>
            </div>
            <div class="band__cell">
                <p class="band__label">{{ __('home.stats.port_label') }}</p>
                <p class="band__value band__value--mono">@stvr('facts.protocol') @stvr('facts.port')</p>
                <p class="band__note">{{ __('home.stats.port_note') }}</p>
            </div>
            <div class="band__cell">
                <p class="band__label">{{ __('home.stats.game_label') }}</p>
                <p class="band__value">{{ __('home.stats.game_value', ['version' => config('stvr.facts.game_version')]) }}</p>
                <p class="band__note">{{ __('home.stats.game_note') }}</p>
            </div>
            <div class="band__cell">
                <p class="band__label">{{ __('home.stats.price_label') }}</p>
                <p class="band__value">{{ __('home.stats.price_value') }}</p>
                <p class="band__note">{{ __('home.stats.price_note') }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ==================================================== what it is ===== --}}
<section class="section">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('home.plain.label') }}</p>
        <h2>{{ __('home.plain.title') }}</h2>
        <div class="reveal prose">
            <p class="lede" style="max-width:none">{{ __('home.plain.body') }}</p>
            <p>{{ __('home.plain.body2') }}</p>
        </div>
    </div>
</section>

{{-- ====================================================== features ===== --}}
<section class="section section--lift">
    <div class="shell">
        <div class="center" style="margin-bottom:clamp(2.5rem,6vw,4rem)">
            <p class="inscription inscription--center">{{ __('home.features.label') }}</p>
            <h2>{{ __('home.features.title') }}</h2>
            <p class="lede">{{ __('home.features.lede') }}</p>
        </div>

        <div class="grid grid--3">
            @foreach (__('home.features.items') as $i => $feature)
                <article class="tablet reveal" style="transition-delay:{{ $i * 70 }}ms">
                    <span class="tablet__rune" aria-hidden="true">{{ $feature['rune'] }}</span>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['body'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<div class="shell"><div class="rule" aria-hidden="true"><span class="rule__mark"></span></div></div>

{{-- ========================================================= shots ====== --}}
{{-- The gallery exists whether or not there are screenshots yet. With none it
     shows the illustration instead, which is a composition rather than a gap.
     The section was designed to work empty, because for a while it will be. --}}
<section class="section section--tight">
    <div class="shell">
        <p class="inscription">{{ __('shots.label') }}</p>
        <h2>{{ __('shots.title') }}</h2>
        <p class="lede">{{ __('shots.lede') }}</p>

        @if (count($shots))
            <div class="shots" style="margin-top:2.5rem">
                @foreach ($shots as $i => $shot)
                    <figure class="shot reveal{{ $i === 0 ? ' shot--lead' : '' }}" style="transition-delay:{{ $i * 60 }}ms">
                        <img src="{{ $shot['url'] }}" alt="{{ $shot['alt'] }}"
                             loading="lazy" decoding="async" width="1600" height="900">
                        @if ($shot['caption'])
                            <figcaption>{{ $shot['caption'] }}</figcaption>
                        @endif
                    </figure>
                @endforeach
            </div>
        @else
            <figure class="shot shot--art reveal" style="margin-top:2.5rem">
                <div class="shot__frame">@include('art.scene')</div>
                <figcaption>{{ __('home.hero.caption') }}</figcaption>
            </figure>
        @endif
    </div>
</section>

{{-- ================================================ loading screen ===== --}}
<section class="section section--tight">
    <div class="shell">
        <div class="tips reveal" id="tips">
            <div class="tips__relic">@include('art.relic')</div>
            <div class="tips__text">
                <p class="inscription">{{ __('home.tips.label') }}</p>
                <p class="tips__line" id="tipLine">{{ __('home.tips.items')[0] }}</p>
            </div>
        </div>
    </div>
    <script type="application/json" id="tipData">@json(__('home.tips.items'))</script>
</section>

<div class="shell"><div class="rule" aria-hidden="true"><span class="rule__mark"></span></div></div>

{{-- ========================================================== steps ===== --}}
<section class="section">
    <div class="shell">
        <div class="grid grid--2" style="align-items:start;gap:clamp(2rem,6vw,4.5rem)">
            <div>
                <p class="inscription">{{ __('home.steps.label') }}</p>
                <h2>{{ __('home.steps.title') }}</h2>
                <p class="lede">{{ __('home.steps.lede') }}</p>
                <div class="btn-row" style="margin-top:1.8rem">
                    <a class="btn btn--ghost" href="{{ Nav::url('install') }}">
                        @include('partials.icon', ['name' => 'arrow'])
                        {{ __('home.steps.cta') }}
                    </a>
                </div>
            </div>

            <ol class="steps reveal">
                @foreach (__('home.steps.items') as $step)
                    <li class="steps__item">
                        <p class="steps__title">{{ $step['title'] }}</p>
                        <p class="steps__body">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>

{{-- ====================================================== community ===== --}}
@include('partials.community')

{{-- ========================================================= honest ===== --}}
<section class="section section--lift">
    <div class="shell shell--narrow center">
        <p class="inscription inscription--center">{{ __('home.honest.label') }}</p>
        <h2>{{ __('home.honest.title') }}</h2>
        <p class="lede">{{ __('home.honest.body') }}</p>
        <div class="btn-row btn-row--center" style="margin-top:2rem">
            <a class="btn btn--ghost" href="{{ Nav::url('roadmap') }}">{{ __('home.honest.cta_roadmap') }}</a>
            <a class="btn btn--ghost" href="{{ Nav::url('devlog') }}">{{ __('home.honest.cta_devlog') }}</a>
        </div>
    </div>
</section>

{{-- ========================================================= devlog ===== --}}
@if (count($entries))
<section class="section">
    <div class="shell">
        <p class="inscription">{{ __('home.devlog.label') }}</p>
        <h2>{{ __('home.devlog.title') }}</h2>

        <div class="posts" style="margin-top:2.5rem">
            @foreach ($entries as $entry)
                <a class="post reveal" href="{{ Nav::url('devlog', null, ['slug' => $entry->slug]) }}">
                    <div class="post__meta">
                        <time class="post__date" datetime="{{ $entry->date->format('Y-m-d') }}">
                            {{ $entry->date->format('j M Y') }}
                        </time>
                        @foreach (array_slice($entry->tags, 0, 3) as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    <h3>{{ $entry->title }}</h3>
                    <p>{{ $entry->summary }}</p>
                </a>
            @endforeach
        </div>

        <div class="btn-row" style="margin-top:2rem">
            <a class="btn btn--ghost btn--small" href="{{ Nav::url('devlog') }}">{{ __('home.devlog.cta') }}</a>
        </div>
    </div>
</section>
@endif

@include('partials.closer', [
    'title'        => __('home.cta.title'),
    'body'         => __('home.cta.body'),
    'primary'      => __('home.cta.primary'),
    'primaryUrl'   => Nav::url('download'),
    'secondary'    => __('home.cta.secondary'),
    'secondaryUrl' => Nav::url('install'),
])

@endsection
