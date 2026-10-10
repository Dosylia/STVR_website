@extends('layouts.app')
@php use App\Support\Nav; $port = config('stvr.facts.port'); @endphp

@section('title', __('install.meta.title'))
@section('description', __('install.meta.description'))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            @include('partials.kicker', ['text' => __('install.hero.kicker')])
            <h1>{{ __('install.hero.title') }}</h1>
            <p class="hero__lede">{{ __('install.hero.lede') }}</p>
        </div>
    </div>
</section>

{{-- ==================================================== prerequisites ==== --}}
{{-- ===================================================== the easy way ==== --}}
<section class="section section--lift">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('install.launcher.label') }}</p>
        <h2>{{ __('install.launcher.title') }}</h2>
        <p class="lede">{{ __('install.launcher.lede') }}</p>

        <ol class="steps reveal" style="margin-top:2rem">
            @foreach (__('install.launcher.steps') as $step)
                <li class="steps__item">
                    <p class="steps__title">{{ $step['title'] }}</p>
                    <p class="steps__body">{{ $step['body'] }}</p>
                </li>
            @endforeach
        </ol>

        <div class="btn-row" style="margin-top:2rem">
            <a class="btn btn--forge" href="{{ Nav::url('download') }}">
                @include('partials.icon', ['name' => 'download'])
                {{ __('install.launcher.cta') }}
            </a>
        </div>
    </div>
</section>

<section class="section">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('site.misc.step', ['n' => 1]) }}</p>
        <h2>{{ __('install.prereq.title') }}</h2>
        <p class="lede">{{ __('install.prereq.lede') }}</p>

        <ul class="reqs reveal" style="margin-top:2rem">
            @foreach (__('install.prereq.items') as $item)
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

        <p class="notice" style="margin-top:2rem">{!! __('install.prereq.ugrids') !!}</p>
    </div>
</section>

{{-- ========================================================= methods ==== --}}
<section class="section section--lift">
    <div class="shell">
        <p class="inscription">{{ __('site.misc.step', ['n' => 2]) }}</p>
        <h2>{{ __('install.methods.title') }}</h2>
        <p class="lede">{{ __('install.methods.lede') }}</p>

        <div data-tabs style="margin-top:2.5rem">
            <div class="tabs__list" role="tablist" aria-label="{{ __('install.methods.title') }}">
                @foreach (['mo2', 'vortex', 'manual'] as $i => $method)
                    <button class="tabs__tab" type="button" role="tab"
                            data-tab="{{ $method }}"
                            id="tab-{{ $method }}"
                            aria-controls="panel-{{ $method }}"
                            aria-selected="{{ $i === 0 ? 'true' : 'false' }}">
                        {{ __("install.methods.{$method}.label") }}
                    </button>
                @endforeach
            </div>

            @foreach (['mo2', 'vortex', 'manual'] as $i => $method)
                <div class="tabs__panel" role="tabpanel"
                     data-panel="{{ $method }}"
                     id="panel-{{ $method }}"
                     aria-labelledby="tab-{{ $method }}"
                     @if ($i !== 0) hidden @endif>

                    <p class="tabs__note">{{ __("install.methods.{$method}.note") }}</p>

                    <ol class="steps">
                        @foreach (__("install.methods.{$method}.steps") as $step)
                            <li class="steps__item">
                                <p class="steps__title">{{ $step['title'] }}</p>
                                <p class="steps__body">{!! $step['body'] !!}</p>
                            </li>
                        @endforeach
                    </ol>

                    @if (is_array(__("install.methods.{$method}.warnings")))
                        <ul class="notes">
                            @foreach (__("install.methods.{$method}.warnings") as $warning)
                                <li>{!! $warning !!}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========================================================= connect ==== --}}
<section class="section">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('site.misc.step', ['n' => 3]) }}</p>
        <h2>{{ __('install.connect.title') }}</h2>
        <p class="lede">{{ __('install.connect.lede') }}</p>

        <div class="stack reveal" style="--gap:1.4rem;margin-top:2rem">
            <p class="notice">{{ __('install.connect.launcher') }}</p>
            <p>{!! __('install.connect.easy') !!}</p>
            <p>{!! __('install.connect.manual', ['path' => '<code>'.e(config('stvr.facts.connect_file')).'</code>']) !!}</p>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>{{ __('install.connect.table.who') }}</th>
                            <th>{{ __('install.connect.table.line1') }}</th>
                            <th>{{ __('install.connect.table.line2') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ __('install.connect.table.host') }}</td>
                            <td><code>{{ __('install.connect.table.host1', ['port' => $port]) }}</code></td>
                            <td>{{ __('install.connect.table.pass') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('install.connect.table.friend') }}</td>
                            <td><code>{{ __('install.connect.table.friend1', ['port' => $port]) }}</code></td>
                            <td>{{ __('install.connect.table.none') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="copyline">
                <pre class="copyline__code" id="connectSample">127.0.0.1:{{ $port }}</pre>
                <button class="copyline__btn" type="button" data-copy="connectSample"
                        data-copied="{{ __('site.cta.copied') }}">{{ __('site.cta.copy') }}</button>
            </div>

            <p class="notice">{!! __('install.connect.warning') !!}</p>
        </div>
    </div>
</section>

{{-- =================================================== first session ==== --}}
<section class="section section--lift">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('site.misc.step', ['n' => 4]) }}</p>
        <h2>{{ __('install.first.title') }}</h2>

        <ol class="steps reveal" style="margin-top:2rem">
            @foreach (__('install.first.steps') as $step)
                <li class="steps__item">
                    <p class="steps__title">{{ $step['title'] }}</p>
                    <p class="steps__body">{!! __($step['body'], ['key' => config('stvr.facts.toggle_key')]) !!}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>

{{-- ========================================================= updating ==== --}}
<section class="section">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('install.update.label') }}</p>
        <h2>{{ __('install.update.title') }}</h2>
        <p>{!! __('install.update.body') !!}</p>
        <p class="notice">{!! __('install.update.warn') !!}</p>
    </div>
</section>

{{-- ====================================================== troubles ====== --}}
<section class="section section--lift">
    <div class="shell shell--narrow">
        <p class="inscription">{{ __('install.trouble.label') }}</p>
        <h2>{{ __('install.trouble.title') }}</h2>
        <p class="lede">{{ __('install.trouble.lede') }}</p>

        <div class="faq reveal" style="margin-top:2rem">
            @foreach (__('install.trouble.items') as $i => $item)
                <details class="faq__q" @if ($i === 0) open @endif>
                    <summary>{{ $item['q'] }}</summary>
                    <div class="faq__a"><p>{!! $item['a'] !!}</p></div>
                </details>
            @endforeach
        </div>
    </div>
</section>

@include('partials.community')

@include('partials.closer', [
    'title'      => __('install.cta.title'),
    'body'       => __('install.cta.body'),
    'primary'    => __('install.cta.primary'),
    'primaryUrl' => Nav::url('host'),
])

@endsection
