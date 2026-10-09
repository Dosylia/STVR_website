@extends('layouts.app')
@php
    use App\Support\Nav;
    $legal = (array) config('stvr.legal');
    $discord = Nav::link('discord');
    // Copy is written by us; only facts from config go in, each escaped.
    $link = fn (?string $url, string $text) => $url ? '<a href="'.e($url).'" rel="noopener">'.e($text).'</a>' : e($text);
    $fill = fn (string $text) => strtr($text, [
        ':name'    => e($legal['publisher'] ?? ''),
        ':host'    => e($legal['host_name'] ?? ''),
        ':discord' => $link($discord, __('legal.discord')),
        ':privacy' => $link(Nav::url('privacy'), __('legal.privacy_link')),
    ]);
@endphp

@section('title', __('legal.meta.title'))
@section('description', __('legal.meta.description'))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            @include('partials.kicker', ['text' => __('legal.hero.kicker')])
            <h1>{{ __('legal.hero.title') }}</h1>
            <p class="hero__lede">{{ __('legal.hero.lede') }}</p>
        </div>
    </div>
</section>

{{-- Publisher and host come from config('stvr.legal'). A line whose value is
     empty is left out rather than shown as a gap or a placeholder. --}}
<section class="section section--tight">
    <div class="shell shell--narrow">
        <p class="inscription">I</p>
        <h2>{{ __('legal.publisher.title') }}</h2>
        <div class="entry__body prose" style="margin-top:1.4rem">
            <p>{!! $fill(__('legal.publisher.body')) !!}</p>
            <p>{!! $fill(__('legal.publisher.director')) !!}</p>
            @if (filled($legal['address'] ?? '') || filled($legal['email'] ?? '') || filled($legal['phone'] ?? ''))
                <ul>
                    @if (filled($legal['address'] ?? ''))
                        <li>{{ __('legal.publisher.address') }} {{ $legal['address'] }}</li>
                    @endif
                    @if (filled($legal['email'] ?? ''))
                        <li>{{ __('legal.publisher.email') }} <a href="mailto:{{ $legal['email'] }}">{{ $legal['email'] }}</a></li>
                    @endif
                    @if (filled($legal['phone'] ?? ''))
                        <li>{{ __('legal.publisher.phone') }} {{ $legal['phone'] }}</li>
                    @endif
                </ul>
            @endif
            @if ($discord)
                <p>{!! $fill(__('legal.publisher.community')) !!}</p>
            @endif
        </div>
    </div>
</section>

<section class="section section--lift section--tight">
    <div class="shell shell--narrow">
        <p class="inscription">II</p>
        <h2>{{ __('legal.host.title') }}</h2>
        <div class="entry__body prose" style="margin-top:1.4rem">
            <p>{!! $fill(__('legal.host.body')) !!}</p>
            @if (filled($legal['host_address'] ?? '') || filled($legal['host_phone'] ?? ''))
                <ul>
                    @if (filled($legal['host_address'] ?? ''))
                        <li>{{ __('legal.host.address') }} {{ $legal['host_address'] }}</li>
                    @endif
                    @if (filled($legal['host_phone'] ?? ''))
                        <li>{{ __('legal.host.phone') }} {{ $legal['host_phone'] }}</li>
                    @endif
                </ul>
            @endif
            <p>{{ __('legal.host.services') }}</p>
        </div>
    </div>
</section>

@foreach (__('legal.sections') as $s => $section)
    <section class="section {{ $s % 2 ? 'section--lift' : '' }} section--tight">
        <div class="shell shell--narrow">
            <p class="inscription">{{ ['III', 'IV', 'V', 'VI', 'VII', 'VIII'][$s] ?? $s + 3 }}</p>
            <h2>{{ $section['title'] }}</h2>
            <div class="entry__body prose" style="margin-top:1.4rem">
                @foreach ($section['body'] as $paragraph)
                    <p>{!! $fill($paragraph) !!}</p>
                @endforeach
            </div>
        </div>
    </section>
@endforeach

@endsection
