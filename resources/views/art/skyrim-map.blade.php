{{--
    Skyrim, drawn for this site.

    Not the game's map: that is Bethesda's art. This is our own stylised
    drawing, in the site's ink and gold, accurate enough to say "near Riverwood"
    and no more. The coast, the hold borders, the rivers and the towns are
    placed by eye from the game's world. The public server page draws its
    players on top, through App\Support\PublicServer::point(), whose two
    calibration points are two towns drawn here (Whiterun and Windhelm).

    City names come from lang/*/public.php, so each language reads its own
    (Blancherive, Weißlauf, Carrera Blanca).

    $players: list of ['id', 'name', 'point' => [x, y] on this drawing's 1000
    by 640 grid, 'heading' => degrees or null].
--}}
@php
    $players = $players ?? [];
    $towns = [
        // key => [x, y, capital?, label anchor]
        'solitude'   => [255, 150, true,  'end'],
        'morthal'    => [335, 212, true,  'start'],
        'dawnstar'   => [522, 122, true,  'middle'],
        'winterhold' => [772, 118, true,  'middle'],
        'windhelm'   => [790, 250, true,  'start'],
        'whiterun'   => [478, 322, true,  'start'],
        'markarth'   => [118, 334, true,  'start'],
        'falkreath'  => [332, 508, true,  'middle'],
        'riften'     => [802, 522, true,  'end'],
        'riverwood'  => [440, 420, false, 'end'],
        'helgen'     => [512, 508, false, 'start'],
        'ivarstead'  => [640, 470, false, 'start'],
    ];
@endphp
<svg class="map" viewBox="0 0 1000 640" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="mapTitle">
    <title id="mapTitle">{{ __('public.map.title_svg') }}</title>
    <defs>
        <radialGradient id="mapSea" cx="50%" cy="0%" r="90%">
            <stop offset="0%" stop-color="#101820"/>
            <stop offset="100%" stop-color="#090c10"/>
        </radialGradient>
        <linearGradient id="mapLand" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#1a1f27"/>
            <stop offset="100%" stop-color="#13171d"/>
        </linearGradient>
        <radialGradient id="mapGlow">
            <stop offset="0%" stop-color="#3fd6a4" stop-opacity=".55"/>
            <stop offset="100%" stop-color="#3fd6a4" stop-opacity="0"/>
        </radialGradient>
    </defs>

    <rect width="1000" height="640" fill="url(#mapSea)"/>

    {{-- the sea, and a few lines of swell --}}
    <g fill="none" stroke="#1d2a33" stroke-width="1" stroke-linecap="round">
        <path d="M120 70 q20 -6 40 0 t40 0"/>
        <path d="M380 46 q20 -6 40 0 t40 0"/>
        <path d="M640 40 q20 -6 40 0 t40 0"/>
        <path d="M860 60 q20 -6 40 0 t40 0"/>
    </g>
    <text class="map__sea" x="560" y="56" text-anchor="middle">{{ __('public.map.sea') }}</text>

    {{-- the land --}}
    <path fill="url(#mapLand)" stroke="#6b5a2a" stroke-width="1.6" stroke-linejoin="round"
          d="M58 318 L66 276 L84 236 L104 206 L132 182 L160 166 L196 160 L222 150 L240 132 L252 112 L262 128
             L276 136 L292 118 L310 104 L334 110 L352 98 L380 102 L404 86 L428 92 L452 104 L474 100 L494 112
             L508 132 L516 104 L534 86 L560 92 L590 84 L616 92 L644 80 L672 90 L700 98 L724 88 L748 92 L760 112
             L776 96 L798 84 L826 92 L852 104 L874 126 L888 154 L904 176 L914 206 L930 234 L926 268 L940 300
             L950 342 L948 384 L942 426 L944 470 L934 516 L918 556 L890 584 L852 600 L810 598 L770 590 L730 596
             L688 590 L646 600 L604 594 L560 586 L516 594 L470 600 L424 596 L380 590 L336 578 L292 568 L252 552
             L214 532 L180 506 L146 476 L118 444 L94 410 L74 372 L62 344 Z"/>

    {{-- hold borders --}}
    <g fill="none" stroke="#3a404b" stroke-width="1" stroke-dasharray="4 5">
        <path d="M208 146 L230 246 L196 300 L210 384 L250 440 L262 556"/>
        <path d="M230 246 L300 262 L404 248 L430 160 L436 96"/>
        <path d="M404 248 L560 236 L620 196 L640 92"/>
        <path d="M620 196 L700 176 L712 96"/>
        <path d="M560 236 L590 300 L640 380 L700 400 L940 400"/>
        <path d="M250 440 L420 452 L470 540 L462 600"/>
        <path d="M420 452 L560 430 L640 380"/>
        <path d="M700 176 L760 200 L930 232"/>
    </g>

    {{-- rivers: the Karth to Solitude, the White River from Whiterun to Windhelm, the Treva --}}
    <g fill="none" stroke="#24414d" stroke-width="1.6" stroke-linecap="round" opacity=".9">
        <path d="M120 338 C160 300 190 260 210 220 S240 170 255 150"/>
        <path d="M486 330 C520 300 556 272 600 262 S700 250 744 256 S780 254 790 250"/>
        <path d="M560 470 C600 440 640 420 690 400 S760 330 790 262"/>
    </g>
    {{-- lakes: Ilinalta and Honrich --}}
    <g fill="#16262e" stroke="#24414d" stroke-width="1">
        <ellipse cx="392" cy="478" rx="30" ry="12" transform="rotate(-12 392 478)"/>
        <ellipse cx="770" cy="548" rx="26" ry="10" transform="rotate(8 770 548)"/>
    </g>

    {{-- mountains: the southern ranges, the Reach, and the Throat of the World --}}
    <g fill="none" stroke="#4b505b" stroke-width="1.2" stroke-linejoin="round" stroke-linecap="round">
        @foreach ([[150,250],[178,282],[150,398],[186,430],[268,520],[298,540],[460,556],[500,566],[580,556],[620,548],[700,560],[860,470],[880,420],[900,360],[870,560]] as [$mx, $my])
            <path d="M{{ $mx - 10 }} {{ $my + 6 }} L{{ $mx }} {{ $my - 8 }} L{{ $mx + 10 }} {{ $my + 6 }}"/>
        @endforeach
    </g>
    <g stroke-linejoin="round">
        <path d="M528 430 L566 362 L604 430 Z" fill="#20252e" stroke="#6b6f78" stroke-width="1.4"/>
        <path d="M556 380 L566 362 L576 380 L570 376 L566 382 L561 377 Z" fill="#c9ced6" opacity=".75"/>
    </g>
    <text class="map__peak" x="566" y="448" text-anchor="middle">{{ __('public.map.throat') }}</text>

    {{-- towns --}}
    @foreach ($towns as $key => [$tx, $ty, $capital, $anchor])
        <g class="map__town {{ $capital ? 'map__town--capital' : '' }}">
            <path d="M{{ $tx }} {{ $ty - ($capital ? 6 : 4) }} L{{ $tx + ($capital ? 6 : 4) }} {{ $ty }} L{{ $tx }} {{ $ty + ($capital ? 6 : 4) }} L{{ $tx - ($capital ? 6 : 4) }} {{ $ty }} Z"/>
            <text x="{{ $tx + ($anchor === 'start' ? 11 : ($anchor === 'end' ? -11 : 0)) }}"
                  y="{{ $ty + ($anchor === 'middle' ? 20 : 4) }}"
                  text-anchor="{{ $anchor }}">{{ __("public.map.towns.{$key}") }}</text>
        </g>
    @endforeach

    {{-- players: one group each, placed by a CSS transform so the page can glide it when the player moves
         (site.js, public server). Keyed by the connection's random id. --}}
    <g class="map__players">
        @foreach ($players as $i => $player)
            @if ($player['point'])
                @include('art.map-player', ['player' => $player, 'i' => $i])
            @endif
        @endforeach
    </g>

    {{-- north --}}
    <g transform="translate(60 590)" class="map__north">
        <path d="M0 -18 L6 0 L0 -4 L-6 0 Z" fill="#c0982c"/>
        <text x="0" y="14" text-anchor="middle">N</text>
    </g>
</svg>
