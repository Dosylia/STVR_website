@extends('layouts.app')
@php
    use App\Support\Nav;
    $days = (int) config('stvr.reports.keep_days');
    $discord = Nav::link('discord');
    $discordText = e(__('privacy.discord'));
    // The copy is HTML written by us, like the FAQ answers; only the two facts
    // are put in here, never anything a visitor typed.
    $fill = fn (string $text) => \App\Support\Facts::fill($text, [
        'days'    => $days,
        'discord' => $discord ? '<a href="'.e($discord).'" rel="noopener">'.$discordText.'</a>' : $discordText,
    ]);
@endphp

@section('title', __('privacy.meta.title'))
@section('description', __('privacy.meta.description', ['days' => $days]))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            @include('partials.kicker', ['text' => __('privacy.hero.kicker')])
            <h1>{{ __('privacy.hero.title') }}</h1>
            <p class="hero__lede">{{ __('privacy.hero.lede') }}</p>
        </div>
    </div>
</section>

@foreach (__('privacy.sections') as $s => $section)
    <section class="section {{ $s % 2 ? 'section--lift' : '' }} section--tight">
        <div class="shell shell--narrow">
            <p class="inscription">{{ ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'][$s] ?? $s + 1 }}</p>
            <h2>{{ $section['title'] }}</h2>

            <div class="entry__body prose" style="margin-top:1.4rem">
                @foreach ($section['body'] ?? [] as $paragraph)
                    <p>{!! $fill($paragraph) !!}</p>
                @endforeach

                @if (! empty($section['items']))
                    <ul>
                        @foreach ($section['items'] as $item)
                            <li>{!! $fill($item) !!}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </section>
@endforeach

@endsection
