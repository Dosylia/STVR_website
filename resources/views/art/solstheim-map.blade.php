{{--
    Solstheim, drawn for this site.

    Our own stylised drawing, like the Skyrim one beside it (skyrim-map.blade.php), accurate enough to say "near
    Raven Rock" and no more: the north under snow, the south under ash, Lake Fjalding and the Moesring range in the
    middle, and across the water to the south, Red Mountain, as you see it from the coast. The places are put by eye
    from the game's world; the page's two calibration points for this drawing (config stvr.public_server.maps,
    DLC2SolstheimWorld) are Raven Rock's dock and Skaal Village.

    Place names come from lang/*/public.php (map.solstheim), so each language reads its own.

    $players: the public server's players, each with 'map', 'point' and the rest; only those on 'solstheim' are drawn.
--}}
@php
    $players = $players ?? [];
    $places = [
        // key => [x, y, settlement?, label anchor]
        'raven_rock'    => [640, 498, true,  'end'],
        'skaal_village' => [735, 200, true,  'end'],
        'thirsk'        => [318, 196, true,  'start'],
        'tel_mithryn'   => [748, 392, true,  'end'],
        'karstaag'      => [440, 118, false, 'middle'],
        'miraak'        => [498, 300, false, 'middle'],
        'frostmoth'     => [548, 538, false, 'end'],
        'kolbjorn'      => [700, 468, false, 'start'],
    ];
    $coast = 'M232 336 L236 312 L250 300 L246 276 L258 250 L278 226 L272 206 L296 186 L318 172 L334 150 L362 136 L380 116
              L404 110 L424 98 L446 100 L466 88 L490 94 L508 86 L522 100 L540 92 L560 98 L584 90 L604 104 L626 108
              L646 124 L668 128 L690 148 L700 168 L722 176 L746 196 L754 220 L770 236 L776 262 L792 284 L786 312
              L792 338 L780 364 L776 392 L764 414 L760 440 L740 462 L728 484 L704 500 L686 520 L660 526 L640 542
              L612 548 L590 560 L566 554 L540 556 L518 542 L494 540 L474 524 L452 516 L432 496 L404 484 L388 462
              L362 446 L344 424 L318 412 L300 390 L276 380 L262 362 L244 356 Z';
@endphp
<svg class="map" viewBox="0 0 1000 640" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="solMapTitle">
    <title id="solMapTitle">{{ __('public.map.title_solstheim') }}</title>
    <defs>
        <radialGradient id="solSea" cx="50%" cy="0%" r="90%">
            <stop offset="0%" stop-color="#101820"/>
            <stop offset="100%" stop-color="#090c10"/>
        </radialGradient>
        <linearGradient id="solLand" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#1c2129"/>
            <stop offset="55%" stop-color="#171b21"/>
            <stop offset="100%" stop-color="#1b1714"/>
        </linearGradient>
        {{-- The south of the island lies under ash from Red Mountain. --}}
        <linearGradient id="solAsh" x1="0" y1="0" x2="0" y2="1">
            <stop offset="45%" stop-color="#3a2e24" stop-opacity="0"/>
            <stop offset="80%" stop-color="#3a2e24" stop-opacity=".45"/>
        </linearGradient>
        <radialGradient id="solGlow">
            <stop offset="0%" stop-color="#3fd6a4" stop-opacity=".55"/>
            <stop offset="100%" stop-color="#3fd6a4" stop-opacity="0"/>
        </radialGradient>
        <clipPath id="solIsland"><path d="{{ $coast }}"/></clipPath>
    </defs>

    <rect width="1000" height="640" fill="url(#solSea)"/>

    <g fill="none" stroke="#1d2a33" stroke-width="1" stroke-linecap="round">
        <path d="M120 80 q20 -6 40 0 t40 0"/>
        <path d="M820 70 q20 -6 40 0 t40 0"/>
        <path d="M110 520 q20 -6 40 0 t40 0"/>
        <path d="M840 520 q20 -6 40 0 t40 0"/>
    </g>
    <text class="map__sea" x="500" y="48" text-anchor="middle">{{ __('public.map.sea') }}</text>

    {{-- Red Mountain, on Vvardenfell, across the water to the south-east --}}
    <g class="map__distant">
        <path d="M800 640 L858 574 L872 582 L884 568 L940 640 Z" fill="#1d1a19" stroke="#4a3a33" stroke-width="1.2"/>
        <path d="M872 582 C868 560 880 548 874 528" fill="none" stroke="#5a4a42" stroke-width="1.2" stroke-dasharray="2 4" opacity=".7"/>
        <text class="map__peak" x="870" y="618" text-anchor="middle">{{ __('public.map.red_mountain') }}</text>
    </g>

    {{-- islets off the north and west coasts --}}
    <g fill="#191d24" stroke="#6b5a2a" stroke-width="1" stroke-linejoin="round">
        <path d="M612 74 L630 70 L640 78 L626 84 Z"/>
        <path d="M352 96 L364 90 L372 98 L360 104 Z"/>
        <path d="M206 300 L218 292 L226 302 L214 310 Z"/>
        <path d="M808 330 L820 324 L826 336 L814 340 Z"/>
    </g>

    {{-- the island, its ash, and the snow line --}}
    <path d="{{ $coast }}" fill="url(#solLand)" stroke="#6b5a2a" stroke-width="1.6" stroke-linejoin="round"/>
    <rect x="200" y="80" width="620" height="490" fill="url(#solAsh)" clip-path="url(#solIsland)"/>
    <path d="M250 330 C320 300 420 316 500 296 S660 300 790 286" fill="none" stroke="#3a404b" stroke-width="1" stroke-dasharray="4 5" clip-path="url(#solIsland)"/>

    {{-- Lake Fjalding, frozen, and a stream to the north coast --}}
    <ellipse cx="530" cy="168" rx="46" ry="16" transform="rotate(-6 530 168)" fill="#1a2a32" stroke="#2c4a57" stroke-width="1"/>
    <path d="M520 152 C518 132 528 114 524 98" fill="none" stroke="#24414d" stroke-width="1.5" stroke-linecap="round"/>

    {{-- the Moesring mountains and the island's ridges --}}
    <g fill="none" stroke="#4b505b" stroke-width="1.2" stroke-linejoin="round" stroke-linecap="round">
        @foreach ([[380,282],[404,268],[428,286],[396,312],[600,250],[624,262],[312,300],[660,420],[620,446],[470,470],[420,430]] as [$mx, $my])
            <path d="M{{ $mx - 10 }} {{ $my + 6 }} L{{ $mx }} {{ $my - 8 }} L{{ $mx + 10 }} {{ $my + 6 }}"/>
        @endforeach
    </g>

    {{-- the places --}}
    @foreach ($places as $key => [$tx, $ty, $settlement, $anchor])
        <g class="map__town {{ $settlement ? 'map__town--capital' : '' }}">
            <path d="M{{ $tx }} {{ $ty - ($settlement ? 6 : 4) }} L{{ $tx + ($settlement ? 6 : 4) }} {{ $ty }} L{{ $tx }} {{ $ty + ($settlement ? 6 : 4) }} L{{ $tx - ($settlement ? 6 : 4) }} {{ $ty }} Z"/>
            <text x="{{ $tx + ($anchor === 'start' ? 11 : ($anchor === 'end' ? -11 : 0)) }}"
                  y="{{ $ty + ($anchor === 'middle' ? 20 : 4) }}"
                  text-anchor="{{ $anchor }}">{{ __("public.map.solstheim.{$key}") }}</text>
        </g>
    @endforeach

    @include('art.map-players', ['players' => $players, 'slug' => 'solstheim', 'glow' => 'solGlow'])

    <g transform="translate(60 590)" class="map__north">
        <path d="M0 -18 L6 0 L0 -4 L-6 0 Z" fill="#c0982c"/>
        <text x="0" y="14" text-anchor="middle">N</text>
    </g>
</svg>
