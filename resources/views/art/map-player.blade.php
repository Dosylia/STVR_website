{{-- One player on the public server's map. Drawn around 0,0 and moved into place by a CSS transform, which site.js
     changes when the player moves. The arrow shows where they face (0 = north, clockwise). The same markup is built in
     site.js for players who arrive while the page is open. --}}
@php [$px, $py] = $player['point']; @endphp
<g class="map__player" data-id="{{ $player['id'] }}" style="transform: translate({{ $px }}px, {{ $py }}px)">
    <circle r="16" fill="url(#{{ $glow }})"/>
    <path class="map__heading" d="M0 -12 L3.6 -6 L-3.6 -6 Z" @if ($player['heading'] === null) hidden @endif
          style="transform: rotate({{ (int) ($player['heading'] ?? 0) }}deg)"/>
    <circle r="4.5" fill="#3fd6a4" stroke="#07080a" stroke-width="1.5"/>
    <text y="{{ -15 - ($i % 2) * 11 }}" text-anchor="middle">{{ $player['name'] }}</text>
</g>
