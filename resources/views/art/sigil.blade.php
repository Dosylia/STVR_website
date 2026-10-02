{{--
    The mark.

    Deliberately *not* the Skyrim dragon emblem: that one belongs to Bethesda,
    and a fan project that leans on someone else's trademark for its identity
    has no identity. This is its own device — a stave flanked by two wings, ringed
    in iron, with a gold lozenge set at the crown. Two wings because the whole
    point of the mod is that there are two of you.
--}}
@props(['class' => '', 'title' => null])
<svg class="{{ $class }}" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"
     @if($title) role="img" aria-label="{{ $title }}" @else aria-hidden="true" focusable="false" @endif>
    <g fill="none" stroke="var(--gold, #c0982c)">
        <circle cx="24" cy="24" r="21.5" stroke-width="1.6"/>
        <circle cx="24" cy="24" r="18"   stroke-width=".7" opacity=".45"/>
    </g>

    {{-- the crown lozenge, set into the ring --}}
    <path d="M24 .6 L27.4 4 L24 7.4 L20.6 4 Z" fill="var(--gold, #c0982c)"/>

    <g fill="var(--ember-hot, #e5602e)">
        {{-- stave --}}
        <path d="M24 11 L26.6 24 L24 38.5 L21.4 24 Z"/>
        {{-- wings --}}
        <path d="M21.6 19.4 C15 15.4 10.4 19.6 10.2 27.6 C13.4 23 17 21.6 21.6 23.4 Z"/>
        <path d="M26.4 19.4 C33 15.4 37.6 19.6 37.8 27.6 C34.6 23 31 21.6 26.4 23.4 Z"/>
        {{-- lower barbs --}}
        <path d="M22.1 28.6 C17.9 31.4 16.4 35.4 17.8 39.4 C19.1 35.1 20.4 32.8 22.9 31.6 Z" opacity=".82"/>
        <path d="M25.9 28.6 C30.1 31.4 31.6 35.4 30.2 39.4 C28.9 35.1 27.6 32.8 25.1 31.6 Z" opacity=".82"/>
    </g>

    {{-- Masser and Secunda, small, where a seal would carry its date --}}
    <circle cx="18.4" cy="42.2" r="1.7" fill="var(--parchment, #ece3cf)" opacity=".75"/>
    <circle cx="29.6" cy="42.2" r="1.1" fill="var(--parchment, #ece3cf)" opacity=".5"/>
</svg>
