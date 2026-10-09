@extends('layouts.app')
@php use App\Support\Nav; @endphp

@section('title', __('faq.meta.title'))
@section('description', __('faq.meta.description'))

@push('head')
    {{-- An FAQ page is one of the few places structured data genuinely earns its
         bytes: these answers show up directly in search results. --}}
    <script type="application/ld+json">{!! \App\Support\StructuredData::faq(__('faq.groups')) !!}</script>
@endpush

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            @include('partials.kicker', ['text' => __('faq.hero.kicker')])
            <h1>{{ __('faq.hero.title') }}</h1>
            <p class="hero__lede">{{ __('faq.hero.lede') }}</p>
        </div>
    </div>
</section>

@foreach (__('faq.groups') as $g => $group)
    <section class="section {{ $g % 2 ? 'section--lift' : '' }} section--tight">
        <div class="shell shell--narrow">
            {{-- Roman numerals for the group index: the heading already says what the
                 group is, and a repeat of it in small caps above would say it twice. --}}
            <p class="inscription">{{ ['I', 'II', 'III', 'IV', 'V', 'VI'][$g] ?? $g + 1 }}</p>
            <h2>{{ $group['title'] }}</h2>

            <div class="faq reveal" style="margin-top:1.6rem">
                @foreach ($group['items'] as $item)
                    <details class="faq__q">
                        <summary>{{ $item['q'] }}</summary>
                        <div class="faq__a"><p>{!! \App\Support\Facts::fill($item['a']) !!}</p></div>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
@endforeach

@include('partials.closer', [
    'title'      => __('faq.cta.title'),
    'body'       => __('faq.cta.body'),
    'primary'    => __('faq.cta.primary'),
    'primaryUrl' => Nav::link('issues'),
])

@endsection
