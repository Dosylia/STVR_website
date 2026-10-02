{{--
    The hero scene.

    Drawn rather than photographed: there is no screenshot of two players that
    would survive being stretched across a 4K header, and a stock mountain would
    announce that nobody made anything. Every layer is one path, so the whole
    thing is about 9 KB of markup, scales to any size, needs no network request
    and recolours from the same custom properties as the rest of the site.

    Read bottom-up in z-order: sky, stars, moons, aurora, far range, mid range
    with the tall peak, the dragon, the near ridge, pines, and — the point of the
    whole illustration — two figures, not one.
--}}
@props(['crop' => 'xMidYMid'])
<svg class="scene" viewBox="0 0 1600 900" preserveAspectRatio="{{ $crop }} slice"
     xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true" focusable="false">
    <defs>
        <linearGradient id="sky" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%"   stop-color="#05070e"/>
            <stop offset="42%"  stop-color="#0a1120"/>
            <stop offset="72%"  stop-color="#122237"/>
            <stop offset="100%" stop-color="#1d3146"/>
        </linearGradient>

        <linearGradient id="auroraA" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%"   stop-color="#3fd6a4" stop-opacity="0"/>
            <stop offset="30%"  stop-color="#3fd6a4" stop-opacity=".55"/>
            <stop offset="62%"  stop-color="#3aa3d6" stop-opacity=".42"/>
            <stop offset="100%" stop-color="#8a68d4" stop-opacity="0"/>
        </linearGradient>
        <linearGradient id="auroraB" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%"   stop-color="#8a68d4" stop-opacity="0"/>
            <stop offset="38%"  stop-color="#3aa3d6" stop-opacity=".38"/>
            <stop offset="75%"  stop-color="#3fd6a4" stop-opacity=".3"/>
            <stop offset="100%" stop-color="#3fd6a4" stop-opacity="0"/>
        </linearGradient>

        <linearGradient id="far" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%"   stop-color="#2a3d55"/>
            <stop offset="100%" stop-color="#16222f"/>
        </linearGradient>
        <linearGradient id="mid" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%"   stop-color="#1b2a3a"/>
            <stop offset="100%" stop-color="#0c131b"/>
        </linearGradient>
        <linearGradient id="nearRidge" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%"   stop-color="#0a0e14"/>
            <stop offset="100%" stop-color="#05070a"/>
        </linearGradient>

        <linearGradient id="haze" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%"   stop-color="#1a3048" stop-opacity="0"/>
            <stop offset="55%"  stop-color="#1a3048" stop-opacity=".40"/>
            <stop offset="100%" stop-color="#1a3048" stop-opacity="0"/>
        </linearGradient>

        <radialGradient id="torch" cx="50%" cy="50%" r="50%">
            <stop offset="0%"   stop-color="#ffcf9a" stop-opacity=".72"/>
            <stop offset="36%"  stop-color="#e5602e" stop-opacity=".34"/>
            <stop offset="100%" stop-color="#e5602e" stop-opacity="0"/>
        </radialGradient>

        <radialGradient id="masser" cx="38%" cy="33%" r="72%">
            <stop offset="0%"   stop-color="#f2e4cb"/>
            <stop offset="68%"  stop-color="#cbb79a"/>
            <stop offset="100%" stop-color="#9c876c"/>
        </radialGradient>
        <radialGradient id="glow" cx="50%" cy="50%" r="50%">
            <stop offset="0%"   stop-color="#9fd3cf" stop-opacity=".30"/>
            <stop offset="100%" stop-color="#9fd3cf" stop-opacity="0"/>
        </radialGradient>

        <filter id="soft" x="-30%" y="-80%" width="160%" height="260%">
            <feGaussianBlur stdDeviation="26"/>
        </filter>
        <filter id="softer" x="-30%" y="-80%" width="160%" height="260%">
            <feGaussianBlur stdDeviation="44"/>
        </filter>
    </defs>

    {{-- sky --}}
    <rect width="1600" height="900" fill="url(#sky)"/>

    {{-- stars: hand-placed rather than random, so the sky is the same sky every
         visit and nothing twinkles where a headline will sit --}}
    <g fill="#ffffff" class="scene__stars">
        <circle cx="120"  cy="92"  r="1.5" opacity=".85"/><circle cx="268" cy="54"  r="1"   opacity=".6"/>
        <circle cx="392"  cy="128" r="1.3" opacity=".7"/> <circle cx="505" cy="71"  r="1"   opacity=".5"/>
        <circle cx="612"  cy="160" r="1.6" opacity=".8"/> <circle cx="742" cy="96"  r="1.1" opacity=".6"/>
        <circle cx="858"  cy="48"  r="1.4" opacity=".75"/><circle cx="963" cy="138" r="1"   opacity=".5"/>
        <circle cx="1086" cy="80"  r="1.7" opacity=".9"/> <circle cx="1198" cy="42" r="1.2" opacity=".65"/>
        <circle cx="1310" cy="150" r="1"   opacity=".5"/> <circle cx="1424" cy="88" r="1.5" opacity=".8"/>
        <circle cx="1534" cy="36"  r="1.1" opacity=".6"/> <circle cx="72"   cy="212" r="1.2" opacity=".55"/>
        <circle cx="324"  cy="244" r="1"   opacity=".45"/><circle cx="676"  cy="256" r="1.3" opacity=".6"/>
        <circle cx="1012" cy="228" r="1"   opacity=".45"/><circle cx="1366" cy="268" r="1.2" opacity=".55"/>
        <circle cx="178"  cy="330" r="1"   opacity=".35"/><circle cx="880"  cy="318" r="1.1" opacity=".4"/>
        <circle cx="1472" cy="352" r="1"   opacity=".35"/>
    </g>

    {{-- Masser and Secunda. Skyrim has two moons; drawing one would be the
         single fastest way to tell an Elder Scrolls player that nobody looked. --}}
    <g class="scene__moons">
        <circle cx="1268" cy="178" r="150" fill="url(#glow)"/>
        <circle cx="1268" cy="178" r="62"  fill="url(#masser)"/>
        <g fill="#8d7a61" opacity=".55">
            <ellipse cx="1248" cy="160" rx="15" ry="12"/>
            <ellipse cx="1288" cy="196" rx="10" ry="8"/>
            <ellipse cx="1256" cy="208" rx="7"  ry="6"/>
            <ellipse cx="1296" cy="152" rx="6"  ry="5"/>
        </g>
        <circle cx="1402" cy="96" r="60" fill="url(#glow)"/>
        <circle cx="1402" cy="96" r="24" fill="#d8ccb6" opacity=".85"/>
        <ellipse cx="1395" cy="90" rx="6" ry="5" fill="#a8988a" opacity=".4"/>
    </g>

    {{-- aurora --}}
    <g class="scene__aurora" filter="url(#soft)">
        <path class="scene__veil scene__veil--a"
              d="M-120 236 C 220 130, 470 300, 760 206 C 1050 112, 1320 268, 1760 158 L1760 330 C1320 430, 1050 286, 760 376 C470 466, 220 300, -120 404 Z"
              fill="url(#auroraA)"/>
    </g>
    <g class="scene__aurora" filter="url(#softer)">
        <path class="scene__veil scene__veil--b"
              d="M-120 366 C 260 272, 520 424, 820 338 C 1120 252, 1380 390, 1760 290 L1760 414 C1380 508, 1120 374, 820 456 C520 538, 260 400, -120 492 Z"
              fill="url(#auroraB)"/>
    </g>

    {{-- Haze on the horizon. Without it the ranges stack like cut paper; with
         it the far one sits behind the near one. --}}
    <rect x="0" y="520" width="1600" height="260" fill="url(#haze)"/>

    {{-- far range: low, gentle, and dim. Its job is depth, not drama. --}}
    <path fill="url(#far)" opacity=".42"
          d="M0 678 L96 632 L164 656 L252 604 L328 640 L404 616 L486 652 L556 622
             L642 658 L712 626 L796 660 L870 630 L952 662 L1030 634 L1114 664
             L1190 638 L1272 668 L1352 640 L1436 666 L1520 642 L1600 664
             L1600 900 L0 900 Z"/>

    {{-- mid range. The massif between 640 and 1000 is the Throat of the World:
         broad shoulders rather than a spike, because a thin triangle with a white
         tip reads as a rocket, which the first draft of this drawing did. --}}
    <path fill="url(#mid)"
          d="M0 744 L104 704 L186 726 L268 684 L348 716 L424 690 L506 722 L580 696
             L646 668 L704 622 L762 578 L812 556 L868 592 L918 640 L974 682 L1030 706
             L1106 678 L1182 712 L1256 686 L1338 718 L1414 694 L1498 724 L1600 702
             L1600 900 L0 900 Z"/>

    {{-- snow, the same hue as the rock it sits on and only a little lighter --}}
    <path fill="#8ea3b8" opacity=".55"
          d="M812 556 L844 616 L828 606 L812 622 L794 606 L780 614 L790 592 Z"/>
    <path fill="#8ea3b8" opacity=".3" d="M704 622 L728 660 L716 654 L704 666 L692 654 L682 660 Z"/>

    {{-- near ridge --}}
    <path fill="url(#nearRidge)"
          d="M0 826 C 180 798, 330 820, 492 800 C 654 780, 772 808, 912 790
             C 1052 772, 1190 800, 1330 784 C 1448 770, 1544 792, 1600 782
             L1600 900 L0 900 Z"/>

    {{-- The two of you, on that ridge. Everything above is scenery. --}}
    <g class="scene__pair">
        {{-- the torch first, so the silhouettes read against it --}}
        <circle cx="1176" cy="772" r="54" fill="url(#torch)"/>
        <circle cx="1176" cy="772" r="5" fill="#ffe9c0"/>

        <g fill="#04060a">
            {{-- standing, cloaked --}}
            <path d="M1134 800
                     c -5 -11 -3 -24 4 -31 l 1 -20 a 11 11 0 1 1 16 0 l 2 19
                     c 8 4 13 13 14 24 l 4 38 l -11 1 l -3 -25 l -3 35 l -9 0 l -1 -32
                     l -3 32 l -9 0 l -2 -41 z"/>
            {{-- arm raised, pointing out across the valley --}}
            <path d="M1208 798
                     c -5 -10 -2 -22 6 -29 l 1 -19 a 10 10 0 1 1 15 0 l 1 17
                     c 6 3 10 9 12 16 l 21 -32 l 8 5 l -25 41 l 3 36 l -10 1 l -3 -23
                     l -3 32 l -9 0 l -1 -31 l -3 31 l -9 0 l -2 -39 z"/>
        </g>
    </g>

    {{-- foreground, nearly black, to seat the whole thing --}}
    <path fill="#030508"
          d="M0 868 C 210 854, 400 872, 600 858 C 800 844, 960 866, 1160 852
             C 1340 840, 1480 860, 1600 850 L1600 900 L0 900 Z"/>

    {{-- pines along the foreground --}}
    <g fill="#020406" class="scene__pines">
        <path d="M78 862 l11 -40 l11 40 z M76 876 l13 -34 l13 34 z"/>
        <path d="M152 858 l9 -32 l9 32 z"/>
        <path d="M268 866 l12 -42 l12 42 z M266 878 l14 -34 l14 34 z"/>
        <path d="M352 860 l8 -30 l8 30 z"/>
        <path d="M454 866 l10 -36 l10 36 z"/>
        <path d="M536 860 l9 -32 l9 32 z M534 872 l11 -30 l11 30 z"/>
        <path d="M648 862 l8 -28 l8 28 z"/>
        <path d="M742 858 l10 -36 l10 36 z"/>
        <path d="M1402 856 l9 -34 l9 34 z M1400 868 l11 -30 l11 30 z"/>
        <path d="M1488 852 l8 -28 l8 28 z"/>
        <path d="M1556 858 l10 -36 l10 36 z"/>
    </g>

    {{-- A dragon, far enough away to be a rumour, crossing in front of Masser.
         Drawn as body, tail and two wings rather than as one blob: the first
         version of this was a single path and it read as a thrown starfish. --}}
    <g class="scene__dragon" opacity=".62">
        <g transform="translate(1238 268) scale(1.05)" fill="#05080d">
            {{-- body, neck and tail --}}
            <path d="M-74 2 C-64 -5 -55 -8 -46 -3 C-30 4 -14 7 2 5
                     C 22 3 44 9 70 22 C 48 11 26 7 8 9
                     C -2 10 -12 11 -22 9 C-42 6 -60 6 -74 2 Z"/>
            {{-- head horns --}}
            <path d="M-50 -4 L-58 -14 L-44 -7 Z"/>
            {{-- far wing, behind the body --}}
            <path d="M-10 5 C 0 -8 14 -19 31 -23 C 25 -12 17 -4 6 5 Z" opacity=".55"/>
            {{-- near wing --}}
            <path d="M-17 3 C -7 -19 12 -36 36 -42 C 29 -25 21 -11 9 3 Z"/>
            {{-- tail fluke --}}
            <path d="M70 22 L84 18 L74 28 Z"/>
        </g>
    </g>
</svg>
