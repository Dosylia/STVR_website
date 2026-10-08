{{--
    The release seal.

    A pool of wax with the sigil pressed into it, the way a letter that matters
    is closed. It used to be a scalloped polygon with the version number in it,
    which read as a sticker and said the version twice, since the heading
    beside it already does. Now it carries the mark and nothing else.

    The outline is a circle bent by a few overlapping waves, with two places
    where the wax ran further, so it looks poured rather than cut. The press is
    a ring and a lowered field; the mark is drawn three times, a dark copy
    below and to the right and a light one above and to the left, so it reads
    as raised out of the wax under a light from the top left.
--}}
@props(['class' => ''])
<svg class="{{ $class }}" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
    <defs>
        <radialGradient id="sealWax" cx="38%" cy="32%" r="75%">
            <stop offset="0%"   stop-color="#c9482f"/>
            <stop offset="45%"  stop-color="#9c2c1c"/>
            <stop offset="100%" stop-color="#5a150c"/>
        </radialGradient>
        <radialGradient id="sealField" cx="42%" cy="38%" r="70%">
            <stop offset="0%"   stop-color="#a93522"/>
            <stop offset="100%" stop-color="#6e1b10"/>
        </radialGradient>
        <radialGradient id="sealShine" cx="34%" cy="26%" r="34%">
            <stop offset="0%"   stop-color="#ffd9c4" stop-opacity=".42"/>
            <stop offset="100%" stop-color="#ffd9c4" stop-opacity="0"/>
        </radialGradient>

        {{-- The sigil's stave, wings and barbs, without its ring: the press is the ring. --}}
        <g id="sealMark">
            <path d="M24 11 L26.6 24 L24 38.5 L21.4 24 Z"/>
            <path d="M21.6 19.4 C15 15.4 10.4 19.6 10.2 27.6 C13.4 23 17 21.6 21.6 23.4 Z"/>
            <path d="M26.4 19.4 C33 15.4 37.6 19.6 37.8 27.6 C34.6 23 31 21.6 26.4 23.4 Z"/>
            <path d="M22.1 28.6 C17.9 31.4 16.4 35.4 17.8 39.4 C19.1 35.1 20.4 32.8 22.9 31.6 Z"/>
            <path d="M25.9 28.6 C30.1 31.4 31.6 35.4 30.2 39.4 C28.9 35.1 27.6 32.8 25.1 31.6 Z"/>
            <circle cx="18.4" cy="42.2" r="1.5"/>
            <circle cx="29.6" cy="42.2" r="1"/>
        </g>
    </defs>

    {{-- the poured wax, with a lighter lip where it thins at the edge --}}
    <path fill="url(#sealWax)" stroke="#d65a3e" stroke-opacity=".35" stroke-width="1.2"
          d="M110.7 60.0 C111.2 62.8 109.9 65.9 109.0 68.6 C108.1 71.4 106.7 74.0 105.3 76.5 C103.9 79.0 102.2 81.2 100.7 83.5 C99.2 85.8 97.6 87.8 96.4 90.6 C95.3 93.3 95.6 98.0 93.8 100.3 C91.9 102.5 88.5 103.6 85.4 104.1 C82.4 104.5 78.5 102.8 75.6 102.8 C72.7 102.9 70.4 104.1 67.8 104.4 C65.2 104.7 62.6 104.6 60.0 104.6 C57.4 104.6 54.8 104.4 52.2 104.3 C49.5 104.2 46.6 104.6 44.0 104.0 C41.4 103.3 39.3 101.4 36.7 100.4 C34.0 99.4 30.9 99.1 28.1 98.0 C25.3 96.9 21.7 95.9 19.9 93.7 C18.0 91.5 17.7 87.7 17.0 84.8 C16.4 81.9 16.1 78.9 15.9 76.1 C15.7 73.2 15.9 70.5 15.9 67.8 C15.9 65.1 16.4 62.6 16.1 60.0 C15.8 57.4 14.2 54.6 14.3 51.9 C14.4 49.3 15.8 46.7 16.8 44.3 C17.9 41.8 19.7 39.9 20.5 37.2 C21.3 34.4 20.3 30.3 21.6 27.8 C22.9 25.3 25.8 23.6 28.2 22.1 C30.7 20.6 33.7 20.0 36.2 18.8 C38.8 17.7 41.1 16.1 43.7 15.3 C46.3 14.4 49.1 14.6 51.8 13.7 C54.6 12.8 57.2 10.6 60.0 9.9 C62.8 9.3 66.2 8.7 68.9 9.6 C71.6 10.5 73.9 13.7 76.2 15.5 C78.5 17.4 80.6 19.0 82.6 20.9 C84.5 22.7 86.2 24.8 88.0 26.7 C89.8 28.5 91.3 30.3 93.3 32.1 C95.2 33.8 98.1 35.0 99.7 37.1 C101.3 39.1 101.8 41.9 102.9 44.4 C104.1 46.8 105.2 49.2 106.5 51.8 C107.8 54.4 110.3 57.2 110.7 60.0 Z"/>

    {{-- the press: a raised ring pushed up around a lowered field --}}
    <circle cx="61.2" cy="61.2" r="34" fill="none" stroke="#3d0d07" stroke-opacity=".55" stroke-width="3"/>
    <circle cx="59.4" cy="59.4" r="34" fill="none" stroke="#ff9d7e" stroke-opacity=".28" stroke-width="2"/>
    <circle cx="60" cy="60" r="32.5" fill="url(#sealField)"/>
    <circle cx="60" cy="60" r="27.5" fill="none" stroke="#3d0d07" stroke-opacity=".3" stroke-width=".8" stroke-dasharray="1.4 2.2"/>

    {{-- the mark, raised: shadow, light, then the wax itself --}}
    <g transform="translate(60 61) scale(1.32) translate(-24 -26)">
        <use href="#sealMark" transform="translate(.9 1)" fill="#2e0904" fill-opacity=".85"/>
        <use href="#sealMark" transform="translate(-.6 -.6)" fill="#ffc2a8" fill-opacity=".75"/>
        <use href="#sealMark" fill="#a8341f"/>
    </g>

    {{-- light on the wax --}}
    <ellipse cx="46" cy="36" rx="26" ry="18" fill="url(#sealShine)"/>
</svg>
