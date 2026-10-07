@extends('layouts.app')
@php
    use App\Support\Nav;
    $port = config('stvr.facts.port');
    $protocol = config('stvr.facts.protocol');
@endphp

@section('title', __('host.meta.title'))
@section('description', __('host.meta.description'))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            <p class="hero__kicker">{{ __('host.hero.kicker') }}</p>
            <h1>{{ __('host.hero.title') }}</h1>
            <p class="hero__lede">{{ __('host.hero.lede') }}</p>
        </div>
    </div>
</section>

{{-- ======================================================== starting ==== --}}
<section class="section">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('host.start.label') }}</p>
        <h2>{{ __('host.start.title') }}</h2>

        <ol class="steps reveal" style="margin-top:2rem">
            @foreach (__('host.start.steps') as $step)
                <li class="steps__item">
                    <p class="steps__title">{{ $step['title'] }}</p>
                    <p class="steps__body">{!! $step['body'] !!}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ====================================================== reachable ==== --}}
<section class="section section--lift">
    <div class="shell">
        <p class="inscription">{{ __('host.reach.label') }}</p>
        <h2>{{ __('host.reach.title') }}</h2>
        <p class="lede">{{ __('host.reach.lede') }}</p>

        <div class="grid grid--2" style="margin-top:2.5rem;align-items:start">
            <article class="tablet tablet--flat reveal">
                <span class="tablet__rune" aria-hidden="true">ᚨ</span>
                <h3>{{ __('host.reach.forward.label') }}</h3>
                <p>{!! __('host.reach.forward.body', ['protocol' => $protocol, 'port' => $port]) !!}</p>
                <p style="margin-top:1.2rem"><strong>{{ __('host.reach.forward.rule') }}</strong></p>
                <div class="copyline" style="margin-top:.7rem">
                    <pre class="copyline__code" id="fwRule">{{ __('host.reach.forward.cmd', ['port' => $port]) }}</pre>
                    <button class="copyline__btn" type="button" data-copy="fwRule"
                            data-copied="{{ __('site.cta.copied') }}">{{ __('site.cta.copy') }}</button>
                </div>
            </article>

            <article class="tablet tablet--flat reveal">
                <span class="tablet__rune" aria-hidden="true">ᛟ</span>
                <h3>{{ __('host.reach.vpn.label') }}</h3>
                <p>{!! __('host.reach.vpn.body') !!}</p>
            </article>
        </div>

        <p class="notice" style="margin-top:1.8rem">{!! __('host.reach.self', ['port' => $port]) !!}</p>
    </div>
</section>

{{-- ======================================================== settings ==== --}}
<section class="section">
    <div class="shell">
        <p class="inscription">{{ __('host.settings.label') }}</p>
        <h2>{{ __('host.settings.title') }}</h2>
        <p class="lede">{!! __('host.settings.lede') !!}</p>

        <div class="table-wrap reveal" style="margin-top:2rem">
            <table>
                <thead>
                    <tr>
                        <th>{{ __('host.settings.head.setting') }}</th>
                        <th>{{ __('host.settings.head.default') }}</th>
                        <th>{{ __('host.settings.head.what') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (__('host.settings.rows') as $row)
                        <tr>
                            <td>{{ $row['k'] }}</td>
                            <td>{{ __($row['v'], ['port' => $port]) }}</td>
                            <td>{{ $row['d'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- =========================================================== rules ==== --}}
<section class="section section--lift">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('host.rules.label') }}</p>
        <h2>{{ __('host.rules.title') }}</h2>

        <div class="grid grid--2" style="margin-top:2rem">
            @foreach (__('host.rules.items') as $rule)
                <article class="tablet reveal">
                    <h3>{{ $rule['title'] }}</h3>
                    <p>{{ $rule['body'] }}</p>
                </article>
            @endforeach
        </div>

        <div class="rule" aria-hidden="true"><span class="rule__mark"></span></div>

        <h3>{{ __('host.linux.title') }}</h3>
        <p>{{ __('host.linux.body') }}</p>
    </div>
</section>

@include('partials.community')

@include('partials.closer', [
    'title'        => __('host.cta.title'),
    'body'         => __('host.cta.body'),
    'primary'      => __('host.cta.primary'),
    'primaryUrl'   => Nav::url('install'),
    'secondary'    => __('host.cta.secondary'),
    'secondaryUrl' => Nav::url('download'),
])

@endsection
