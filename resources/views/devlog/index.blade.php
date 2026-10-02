@extends('layouts.app')
@php use App\Support\Nav; @endphp

@section('title', __('devlog.meta.title'))
@section('description', __('devlog.meta.description'))

@section('body')

<section class="hero hero--page">
    <div class="hero__scene">@include('art.scene', ['crop' => 'xMidYMin'])</div>
    <div class="shell">
        <div class="hero__inner">
            <p class="hero__kicker">{{ __('devlog.hero.kicker') }}</p>
            <h1>{{ __('devlog.hero.title') }}</h1>
            <p class="hero__lede">{{ __('devlog.hero.lede') }}</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="shell shell--narrow">
        @if (count($entries))
            <div class="posts">
                @foreach ($entries as $entry)
                    <a class="post reveal" href="{{ Nav::url('devlog', null, ['slug' => $entry->slug]) }}">
                        <div class="post__meta">
                            <time class="post__date" datetime="{{ $entry->date->format('Y-m-d') }}">
                                {{ $entry->date->format('j F Y') }}
                            </time>
                            @foreach ($entry->tags as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                            <span class="meta" style="margin-left:auto">{{ __('site.misc.min_read', ['count' => $entry->readingMinutes()]) }}</span>
                        </div>
                        <h2>{{ $entry->title }}</h2>
                        <p>{{ $entry->summary }}</p>
                    </a>
                @endforeach
            </div>
        @else
            <div class="tablet tablet--flat center">
                <h2>{{ __('devlog.empty.title') }}</h2>
                <p>{{ __('devlog.empty.body') }}</p>
                <a class="btn btn--ghost btn--small" href="{{ Nav::link('github') }}" rel="noopener" style="margin-top:1.2rem">
                    @include('partials.icon', ['name' => 'github'])
                    {{ __('devlog.empty.cta') }}
                </a>
            </div>
        @endif
    </div>
</section>

@include('partials.closer', [
    'title'      => __('roadmap.hero.title'),
    'body'       => __('roadmap.hero.lede'),
    'primary'    => __('site.nav.roadmap'),
    'primaryUrl' => Nav::url('roadmap'),
])

@endsection
