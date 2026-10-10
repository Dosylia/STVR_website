@extends('layouts.app')
@php use App\Support\Nav; @endphp

@section('title', $entry->title.' · '.__('site.meta.suffix'))
@section('description', $entry->summary ?: __('devlog.meta.description'))

@push('head')
    <script type="application/ld+json">{!! \App\Support\StructuredData::post($entry) !!}</script>
@endpush

@section('body')

<article>
    <header class="section section--tight" style="padding-top:clamp(8rem,14vw,11rem)">
        <div class="shell shell--narrow">
            <a class="meta" href="{{ Nav::url('devlog') }}" style="text-decoration:none">← {{ __('devlog.entry.back') }}</a>

            <h1 style="margin-top:1.4rem">{{ $entry->title }}</h1>

            <div class="post__meta" style="margin-top:1.2rem">
                <time class="post__date" datetime="{{ $entry->date->format('Y-m-d') }}">
                    {{ __('devlog.entry.written', ['date' => $entry->date->isoFormat('LL')]) }}
                </time>
                @foreach ($entry->tags as $tag)
                    <span class="tag">{{ $tag }}</span>
                @endforeach
                <span class="meta">{{ __('site.misc.min_read', ['count' => $entry->readingMinutes()]) }}</span>
            </div>

            @unless ($entry->translated)
                {{-- Better to say so than to let someone wonder why the German
                     page is in English. --}}
                <p class="notice" style="margin-top:1.6rem">{{ __('site.misc.not_translated') }}</p>
            @endunless

            <div class="rule" aria-hidden="true"><span class="rule__mark"></span></div>
        </div>
    </header>

    <div class="shell shell--narrow">
        <div class="entry__body prose">{!! $entry->html() !!}</div>

        <nav class="pager" aria-label="{{ __('site.nav.devlog') }}">
            @if ($older)
                <a class="pager__link" href="{{ Nav::url('devlog', null, ['slug' => $older->slug]) }}">
                    <span class="pager__dir">← {{ __('devlog.entry.older') }}</span>
                    <span class="pager__title">{{ $older->title }}</span>
                </a>
            @endif
            @if ($newer)
                <a class="pager__link pager__link--next" href="{{ Nav::url('devlog', null, ['slug' => $newer->slug]) }}">
                    <span class="pager__dir">{{ __('devlog.entry.newer') }} →</span>
                    <span class="pager__title">{{ $newer->title }}</span>
                </a>
            @endif
        </nav>
    </div>
</article>

@include('partials.closer', [
    'title'      => __('home.cta.title'),
    'body'       => __('home.cta.body'),
    'primary'    => __('home.cta.primary'),
    'primaryUrl' => Nav::url('download'),
])

@endsection
