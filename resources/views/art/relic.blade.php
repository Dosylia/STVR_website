{{--
    The object that turns on the loading screen.

    Skyrim's loading screens are a single artefact rotating slowly beside a line
    of advice, and it is the most recognisable piece of the game's interface that
    is not a logo. Borrowed knowingly. The rotation is a CSS rotateY on a flat
    drawing, so it goes edge-on at 90 degrees exactly the way a real flat object
    would — which is why it reads as three-dimensional despite being nothing of
    the kind.
--}}
<svg viewBox="0 0 120 170" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
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
    </defs>

    {{-- chain --}}
    <path d="M60 8 C 28 8, 14 34, 24 58" fill="none" stroke="url(#relicMetal)" stroke-width="3" stroke-linecap="round" opacity=".85"/>
    <path d="M60 8 C 92 8, 106 34, 96 58" fill="none" stroke="url(#relicMetal)" stroke-width="3" stroke-linecap="round" opacity=".85"/>

    {{-- bail --}}
    <path d="M52 56 h16 l4 10 h-24 z" fill="url(#relicMetal)"/>

    {{-- medallion --}}
    <circle cx="60" cy="110" r="42" fill="#11141a" stroke="url(#relicMetal)" stroke-width="5"/>
    <circle cx="60" cy="110" r="33" fill="none" stroke="url(#relicMetal)" stroke-width="1.2" opacity=".55"/>

    {{-- knotwork inside: three interlocked arcs --}}
    <g fill="none" stroke="url(#relicMetal)" stroke-width="2.4" stroke-linecap="round" opacity=".9">
        <path d="M60 84 C 44 94, 44 116, 60 126 C 76 116, 76 94, 60 84 Z"/>
        <path d="M38 100 C 54 92, 72 104, 74 122 C 56 124, 40 116, 38 100 Z" opacity=".65"/>
        <path d="M82 100 C 66 92, 48 104, 46 122 C 64 124, 80 116, 82 100 Z" opacity=".65"/>
    </g>

    {{-- the stone --}}
    <circle cx="60" cy="110" r="9" fill="url(#relicStone)"/>
    <circle cx="57" cy="106" r="2.6" fill="#d8fff0" opacity=".65"/>

    {{-- studs on the rim --}}
    <g fill="url(#relicMetal)">
        <circle cx="60" cy="72"  r="2.6"/>
        <circle cx="60" cy="148" r="2.6"/>
        <circle cx="22" cy="110" r="2.6"/>
        <circle cx="98" cy="110" r="2.6"/>
    </g>
</svg>
