{{--
    The object that turns on the loading screen.

    Skyrim's loading screens are a single artefact turning slowly beside a line
    of advice, and it is the most recognisable piece of the game's interface that
    is not a logo. Borrowed knowingly.

    It is two drawings, not one. The chain stays where it hangs and the whole
    thing sways a degree or two from the top, while the medallion turns on its
    bail through a shallow arc in real perspective. A flat drawing spun a full
    360 degrees goes edge-on and then shows its mirrored back, which is what
    makes that kind of animation look like a sticker on a stick. Kept inside
    about 30 degrees it never gives the trick away, and the sheen sliding
    across the metal does the rest of the work of making it read as solid.
--}}
<div class="relic">
    <svg class="relic__chain" viewBox="0 0 120 170" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
        <defs>
            <linearGradient id="relicChain" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%"   stop-color="#efcb63"/>
                <stop offset="45%"  stop-color="#c0982c"/>
                <stop offset="100%" stop-color="#7a5f16"/>
            </linearGradient>
        </defs>
        <path d="M60 8 C 28 8, 14 34, 24 58" fill="none" stroke="url(#relicChain)" stroke-width="3" stroke-linecap="round" stroke-dasharray="5 2.2" opacity=".8"/>
        <path d="M60 8 C 92 8, 106 34, 96 58" fill="none" stroke="url(#relicChain)" stroke-width="3" stroke-linecap="round" stroke-dasharray="5 2.2" opacity=".8"/>
        <path d="M24 58 Q 36 62, 54 61 M96 58 Q 84 62, 66 61" fill="none" stroke="url(#relicChain)" stroke-width="2" stroke-linecap="round" opacity=".55"/>
    </svg>

    <svg class="relic__body" viewBox="0 0 120 170" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
        <defs>
            <linearGradient id="relicMetal" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%"   stop-color="#efcb63"/>
                <stop offset="45%"  stop-color="#c0982c"/>
                <stop offset="100%" stop-color="#7a5f16"/>
            </linearGradient>
            <radialGradient id="relicStone" cx="38%" cy="32%" r="70%">
                <stop offset="0%"   stop-color="#5fe3b6"/>
                <stop offset="55%"  stop-color="#2a9e78"/>
                <stop offset="100%" stop-color="#0d3b2d"/>
            </radialGradient>
            <radialGradient id="relicHalo">
                <stop offset="0%"   stop-color="#3fd6a4" stop-opacity=".55"/>
                <stop offset="100%" stop-color="#3fd6a4" stop-opacity="0"/>
            </radialGradient>
            <radialGradient id="relicFace" cx="40%" cy="35%" r="75%">
                <stop offset="0%"   stop-color="#1a1f28"/>
                <stop offset="100%" stop-color="#0a0c10"/>
            </radialGradient>
            <linearGradient id="relicSheen" x1="0" y1="0" x2="1" y2="0">
                <stop offset="0%"   stop-color="#fff4d0" stop-opacity="0"/>
                <stop offset="50%"  stop-color="#fff4d0" stop-opacity=".42"/>
                <stop offset="100%" stop-color="#fff4d0" stop-opacity="0"/>
            </linearGradient>
            <clipPath id="relicClip"><circle cx="60" cy="110" r="44.5"/></clipPath>
        </defs>

        {{-- bail --}}
        <path d="M54 58 h12 l4 9 h-20 z" fill="url(#relicMetal)"/>
        <circle cx="60" cy="61" r="3.2" fill="none" stroke="url(#relicMetal)" stroke-width="1.6"/>

        {{-- the rim's thickness: a darker ring set behind and slightly off --}}
        <circle cx="61.2" cy="111.2" r="42" fill="none" stroke="#4a3a0e" stroke-width="5"/>

        {{-- medallion --}}
        <circle cx="60" cy="110" r="42" fill="url(#relicFace)" stroke="url(#relicMetal)" stroke-width="5"/>
        <circle cx="60" cy="110" r="33" fill="none" stroke="url(#relicMetal)" stroke-width="1.2" opacity=".5"/>

        {{-- knotwork inside: three interlocked arcs --}}
        <g fill="none" stroke="url(#relicMetal)" stroke-width="2.4" stroke-linecap="round" opacity=".9">
            <path d="M60 84 C 44 94, 44 116, 60 126 C 76 116, 76 94, 60 84 Z"/>
            <path d="M38 100 C 54 92, 72 104, 74 122 C 56 124, 40 116, 38 100 Z" opacity=".65"/>
            <path d="M82 100 C 66 92, 48 104, 46 122 C 64 124, 80 116, 82 100 Z" opacity=".65"/>
        </g>

        {{-- the stone, with a glow that breathes behind it --}}
        <circle class="relic__halo" cx="60" cy="110" r="20" fill="url(#relicHalo)"/>
        <circle cx="60" cy="110" r="9" fill="url(#relicStone)"/>
        <circle cx="57" cy="106" r="2.6" fill="#d8fff0" opacity=".65"/>

        {{-- studs on the rim --}}
        <g fill="url(#relicMetal)">
            <circle cx="60" cy="72"  r="2.6"/>
            <circle cx="60" cy="148" r="2.6"/>
            <circle cx="22" cy="110" r="2.6"/>
            <circle cx="98" cy="110" r="2.6"/>
        </g>

        {{-- light catching the face as it turns --}}
        <g clip-path="url(#relicClip)">
            <g transform="rotate(18 60 110)">
                <rect class="relic__sheen" x="-10" y="40" width="34" height="140" fill="url(#relicSheen)"/>
            </g>
        </g>
    </svg>
</div>
