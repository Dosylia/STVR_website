{{-- The players on one drawing: one group each, placed by a CSS transform so the page can glide it when the player
     moves (site.js, public server), keyed by the connection's random id. $slug says which drawing this is, and only
     its players are drawn; $glow is the id of that drawing's own glow gradient (a gradient inside a hidden tab may
     not paint in another tab's map). --}}
<g class="map__players" data-map="{{ $slug }}" data-glow="{{ $glow }}">
    @foreach (array_values(array_filter($players, fn ($p) => ($p['map'] ?? null) === $slug)) as $i => $player)
        @include('art.map-player', ['player' => $player, 'i' => $i, 'glow' => $glow])
    @endforeach
</g>
