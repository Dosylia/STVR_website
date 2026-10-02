{{--
    The six goals as a star map.

    Skyrim's own progression screen is a night sky, so an ordered list of six
    things to fix can be one too. Purely decorative — aria-hidden, and every
    goal is written out properly in the cards below, in order, where a screen
    reader and a phone both get the whole thing.
--}}
@props(['goals' => []])
<div class="constellation" aria-hidden="true">
    <svg viewBox="0 0 1000 260" xmlns="http://www.w3.org/2000/svg" focusable="false">
        <defs>
            <radialGradient id="starGlow" cx="50%" cy="50%" r="50%">
                <stop offset="0%"   stop-color="#efcb63" stop-opacity=".55"/>
                <stop offset="100%" stop-color="#efcb63" stop-opacity="0"/>
            </radialGradient>
            <radialGradient id="starGlowHot" cx="50%" cy="50%" r="50%">
                <stop offset="0%"   stop-color="#e5602e" stop-opacity=".6"/>
                <stop offset="100%" stop-color="#e5602e" stop-opacity="0"/>
            </radialGradient>
        </defs>

        {{-- the line that joins them, drawn first so the stars sit on top --}}
        <path d="M80 168 L252 72 L430 148 L598 60 L772 142 L930 86"
              fill="none" stroke="#c0982c" stroke-width="1" opacity=".3"
              stroke-dasharray="4 7" class="constellation__line"/>

        @php
            $points = [[80,168],[252,72],[430,148],[598,60],[772,142],[930,86]];
        @endphp

        @foreach ($points as $i => [$x, $y])
            @php $state = $goals[$i]['state'] ?? 'later'; @endphp
            <g class="constellation__star constellation__star--{{ $state }}" style="--i:{{ $i }}">
                <circle cx="{{ $x }}" cy="{{ $y }}" r="46"
                        fill="url(#{{ $state === 'active' ? 'starGlowHot' : 'starGlow' }})"/>
                <circle cx="{{ $x }}" cy="{{ $y }}" r="{{ $state === 'active' ? 7 : 5 }}"
                        fill="{{ $state === 'active' ? '#ffb79b' : ($state === 'next' ? '#efcb63' : '#8a93a6') }}"/>
                {{-- four-point glint --}}
                <path d="M{{ $x }} {{ $y - 16 }} L{{ $x + 3 }} {{ $y }} L{{ $x }} {{ $y + 16 }} L{{ $x - 3 }} {{ $y }} Z
                         M{{ $x - 16 }} {{ $y }} L{{ $x }} {{ $y - 3 }} L{{ $x + 16 }} {{ $y }} L{{ $x }} {{ $y + 3 }} Z"
                      fill="{{ $state === 'active' ? '#ffd9c6' : '#efcb63' }}"
                      opacity="{{ $state === 'later' ? '.25' : '.6' }}"/>
                <text x="{{ $x }}" y="{{ $y + 42 }}" text-anchor="middle"
                      font-family="Cinzel, serif" font-size="15" font-weight="700"
                      fill="{{ $state === 'later' ? '#4d5668' : '#c4baa0' }}">{{ $i + 1 }}</text>
            </g>
        @endforeach
    </svg>
</div>
