{{--
    The Soul Cairn, drawn for this site.

    Not a country but a plane of Oblivion, so not drawn like the other two maps: no sea and no coast, a violet void
    with islands of grey ground broken across it, soul lights drifting, the Boneyard's walled keep behind its barrier,
    and the spires of the Reaper's Lair. Placed by eye and the least certain of the three drawings; its two
    calibration points (config stvr.public_server.maps, DLC01SoulCairn) are where you arrive and the Boneyard's gate,
    and the dots are only as right as those two readings.

    Place names come from lang/*/public.php (map.soul_cairn).

    $players: the public server's players; only those on 'soul_cairn' are drawn.
--}}
@php
    $players = $players ?? [];
    $places = [
        // key => [x, y, label anchor]
        'arrival'  => [300, 470, 'start'],
        'boneyard' => [520, 200, 'middle'],
        'reaper'   => [770, 330, 'end'],
    ];
@endphp
<svg class="map" viewBox="0 0 1000 640" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="scMapTitle">
    <title id="scMapTitle">{{ __('public.map.title_soul_cairn') }}</title>
    <defs>
        <radialGradient id="scVoid" cx="50%" cy="45%" r="75%">
            <stop offset="0%" stop-color="#1b1428"/>
            <stop offset="100%" stop-color="#07060b"/>
        </radialGradient>
        <linearGradient id="scGround" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#211d2b"/>
            <stop offset="100%" stop-color="#16131d"/>
        </linearGradient>
        <radialGradient id="scMist">
            <stop offset="0%" stop-color="#8a68d4" stop-opacity=".22"/>
            <stop offset="100%" stop-color="#8a68d4" stop-opacity="0"/>
        </radialGradient>
        <radialGradient id="scGlow">
            <stop offset="0%" stop-color="#3fd6a4" stop-opacity=".55"/>
            <stop offset="100%" stop-color="#3fd6a4" stop-opacity="0"/>
        </radialGradient>
    </defs>

    <rect width="1000" height="640" fill="url(#scVoid)"/>
    <ellipse cx="520" cy="300" rx="420" ry="230" fill="url(#scMist)"/>

    {{-- the ground: one broken mass and the islands torn from it --}}
    <g fill="url(#scGround)" stroke="#5a4a78" stroke-width="1.4" stroke-linejoin="round">
        <path d="M232 486 L248 440 L282 410 L300 370 L346 344 L372 300 L418 270 L430 222 L470 176 L520 150 L574 164
                 L612 196 L660 210 L706 246 L744 268 L796 286 L824 324 L808 366 L768 392 L716 404 L676 436 L620 450
                 L572 482 L512 500 L456 520 L396 530 L330 528 L270 516 Z"/>
        <path d="M150 300 L178 276 L214 284 L226 314 L196 336 L160 330 Z"/>
        <path d="M840 160 L874 146 L902 166 L890 196 L852 198 Z"/>
        <path d="M660 540 L700 526 L738 540 L726 566 L682 570 Z"/>
        <path d="M318 150 L346 136 L372 150 L360 174 L330 176 Z"/>
    </g>

    {{-- cracks across the ground --}}
    <g fill="none" stroke="#3a3150" stroke-width="1" stroke-linecap="round">
        <path d="M330 470 L380 430 L410 440 L460 400"/>
        <path d="M600 300 L640 330 L700 330"/>
        <path d="M470 260 L500 300 L480 340"/>
    </g>

    {{-- the barrier around the Boneyard, and its keep --}}
    <circle cx="520" cy="200" r="58" fill="none" stroke="#8a68d4" stroke-width="1.2" stroke-dasharray="3 5" opacity=".7"/>
    <path d="M500 182 L540 182 L548 200 L540 218 L500 218 L492 200 Z" fill="#2b2538" stroke="#7a6aa0" stroke-width="1.2"/>

    {{-- the spires of the Reaper's Lair --}}
    <g fill="#241f30" stroke="#7a6aa0" stroke-width="1.1" stroke-linejoin="round">
        <path d="M778 330 L784 300 L790 330 Z"/>
        <path d="M790 334 L798 296 L806 334 Z"/>
        <path d="M766 336 L771 312 L776 336 Z"/>
    </g>

    {{-- the way in: the portal where you arrive --}}
    <ellipse cx="300" cy="470" rx="12" ry="16" fill="none" stroke="#9fd3cf" stroke-width="1.4" opacity=".75"/>

    {{-- soul lights --}}
    <g fill="#c9b8f0">
        @foreach ([[260,200,.5],[420,120,.4],[640,110,.45],[900,260,.35],[880,420,.4],[560,580,.35],[200,560,.4],[120,420,.3],[730,180,.5],[380,380,.3]] as [$lx, $ly, $lo])
            <circle cx="{{ $lx }}" cy="{{ $ly }}" r="2" opacity="{{ $lo }}"/>
        @endforeach
    </g>

    {{-- the places --}}
    @foreach ($places as $key => [$tx, $ty, $anchor])
        <g class="map__town map__town--capital">
            <text x="{{ $tx + ($anchor === 'start' ? 18 : ($anchor === 'end' ? -18 : 0)) }}"
                  y="{{ $ty + ($anchor === 'middle' ? -70 : 4) }}"
                  text-anchor="{{ $anchor }}">{{ __("public.map.soul_cairn.{$key}") }}</text>
        </g>
    @endforeach

    @include('art.map-players', ['players' => $players, 'slug' => 'soul_cairn', 'glow' => 'scGlow'])
</svg>
