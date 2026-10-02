@extends('layouts.app')
@php use App\Support\Nav; $goals = __('roadmap.constellation.goals'); @endphp

@section('title', __('roadmap.meta.title'))
@section('description', __('roadmap.meta.description'))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            <p class="hero__kicker">{{ __('roadmap.hero.kicker') }}</p>
            <h1>{{ __('roadmap.hero.title') }}</h1>
            <p class="hero__lede">{{ __('roadmap.hero.lede') }}</p>
        </div>
    </div>
</section>

{{-- ======================================================== the six ==== --}}
<section class="section">
    <div class="shell">
        <p class="inscription">{{ __('roadmap.constellation.label') }}</p>
        <h2>{{ __('roadmap.constellation.title') }}</h2>
        <p class="lede">{{ __('roadmap.constellation.lede') }}</p>

        @include('art.constellation', ['goals' => $goals])

        <div class="legend">
            @foreach (['active', 'next', 'later'] as $state)
                <span class="legend__key">
                    <span class="legend__dot legend__dot--{{ $state }}"></span>
                    {{ __("roadmap.constellation.legend.{$state}") }}
                </span>
            @endforeach
        </div>

        <ol class="stack" style="--gap:1rem;list-style:none;margin:0;padding:0">
            @foreach ($goals as $goal)
                <li class="goal goal--{{ $goal['state'] }} reveal">
                    <span class="goal__star" aria-hidden="true">{{ $goal['n'] }}</span>
                    <div>
                        <div class="goal__head">
                            <h3>{{ $goal['title'] }}</h3>
                            <span class="pill {{ $goal['state'] === 'active' ? 'pill--ember' : ($goal['state'] === 'next' ? 'pill--gold' : '') }}">
                                {{ __("roadmap.constellation.legend.{$goal['state']}") }}
                            </span>
                        </div>
                        <p>{{ $goal['body'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- =================================================== known issues ==== --}}
<section class="section section--lift">
    <div class="shell">
        <p class="inscription">{{ __('roadmap.issues.label') }}</p>
        <h2>{{ __('roadmap.issues.title') }}</h2>
        <p class="lede">{{ __('roadmap.issues.lede') }}</p>

        <div class="grid grid--2" style="margin-top:2.5rem;align-items:start">
            @foreach (__('roadmap.issues.items') as $issue)
                <article class="tablet reveal">
                    <h3>{{ $issue['title'] }}</h3>
                    <p>{!! $issue['body'] !!}</p>
                </article>
            @endforeach
        </div>

        <div class="tablet tablet--quiet tablet--flat reveal" style="margin-top:1.8rem">
            <h3>{{ __('roadmap.issues.report.title') }}</h3>
            <p>{!! __('roadmap.issues.report.body') !!}</p>
            <a class="btn btn--ghost btn--small" href="{{ Nav::link('issues') }}" rel="noopener" style="margin-top:1.2rem">
                @include('partials.icon', ['name' => 'bug'])
                {{ __('roadmap.issues.report.cta') }}
            </a>
        </div>
    </div>
</section>

{{-- ========================================================== done ===== --}}
<section class="section">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('roadmap.done.label') }}</p>
        <h2>{{ __('roadmap.done.title') }}</h2>
        <p class="lede">{{ __('roadmap.done.lede') }}</p>

        <ul class="reqs reveal" style="margin-top:2rem">
            @foreach (__('roadmap.done.items') as $item)
                <li class="reqs__item">
                    <span class="reqs__mark" style="color:var(--aurora-a);grid-row:1" aria-hidden="true">✓</span>
                    <span class="reqs__note" style="color:var(--parchment-2)">{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</section>

@include('partials.closer', [
    'title'      => __('roadmap.cta.title'),
    'body'       => __('roadmap.cta.body'),
    'primary'    => __('roadmap.cta.primary'),
    'primaryUrl' => Nav::url('devlog'),
])

@endsection
