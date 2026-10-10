<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Draws the raster images the site cannot express as SVG: the Open Graph card
 * and the PNG icons.
 *
 *     php artisan stvr:images
 *
 * They are generated rather than committed as binaries because they are derived
 * from the same mark and the same palette as everything else. Change the gold
 * in one place and re-run this, instead of reopening an editor nobody has.
 *
 * Open Graph has to be a PNG: Slack, Discord, Facebook and X all ignore an SVG
 * in og:image, which is exactly where a link to this site will be pasted.
 */
class MakeImages extends Command
{
    protected $signature = 'stvr:images';
    protected $description = 'Generate the Open Graph card and the PNG icons';

    private string $cinzel;
    private string $cinzelLight;
    private string $spectral;

    public function handle(): int
    {
        $this->cinzel      = storage_path('app/fonts/Cinzel-700.ttf');
        $this->cinzelLight = storage_path('app/fonts/Cinzel-400.ttf');
        $this->spectral    = storage_path('app/fonts/Spectral-400.ttf');

        foreach ([$this->cinzel, $this->cinzelLight, $this->spectral] as $font) {
            if (! is_file($font)) {
                $this->error("Missing font: {$font}");

                return self::FAILURE;
            }
        }

        $this->card();
        $this->icon(512, public_path('icon-512.png'));
        $this->icon(192, public_path('icon-192.png'));
        $this->icon(180, public_path('apple-touch-icon.png'));

        $this->info('Images written to public/.');

        return self::SUCCESS;
    }

    /* ---------------------------------------------------------------- card */

    private function card(): void
    {
        [$w, $h] = [1200, 630];
        $im = imagecreatetruecolor($w, $h);
        imagealphablending($im, true);

        $this->skyGradient($im, $w, $h);
        $this->stars($im, $w);
        $this->aurora($im, $w, $h);
        $this->ranges($im, $w, $h);
        $this->figures($im, $w, $h);
        $this->cardText($im, $w, $h);

        imagepng($im, public_path('og.png'), 8);
        imagedestroy($im);
    }

    private function skyGradient($im, int $w, int $h): void
    {
        // Same three stops as the hero's sky gradient, sampled per row.
        $stops = [[0.0, 5, 7, 14], [0.46, 10, 17, 32], [0.74, 18, 34, 55], [1.0, 29, 49, 70]];

        for ($y = 0; $y < $h; $y++) {
            $t = $y / ($h - 1);
            [$r, $g, $b] = $this->sample($stops, $t);
            imagefilledrectangle($im, 0, $y, $w, $y, imagecolorallocate($im, $r, $g, $b));
        }
    }

    /** @param array<int, array{0: float, 1: int, 2: int, 3: int}> $stops */
    private function sample(array $stops, float $t): array
    {
        for ($i = 0; $i < count($stops) - 1; $i++) {
            [$a, $ar, $ag, $ab] = $stops[$i];
            [$b, $br, $bg, $bb] = $stops[$i + 1];

            if ($t >= $a && $t <= $b) {
                $k = $b > $a ? ($t - $a) / ($b - $a) : 0;

                return [
                    (int) round($ar + ($br - $ar) * $k),
                    (int) round($ag + ($bg - $ag) * $k),
                    (int) round($ab + ($bb - $ab) * $k),
                ];
            }
        }

        return array_slice($stops[count($stops) - 1], 1);
    }

    private function stars($im, int $w): void
    {
        // Seeded so the card is byte-identical on every regeneration. Otherwise
        // every run is a diff and the file churns in git for no reason.
        mt_srand(20260926);

        for ($i = 0; $i < 90; $i++) {
            $x = mt_rand(0, $w);
            $y = mt_rand(0, 330);
            $o = mt_rand(25, 90);
            $c = imagecolorallocatealpha($im, 255, 255, 255, (int) round(127 * (1 - $o / 100)));
            imagefilledellipse($im, $x, $y, mt_rand(1, 3), mt_rand(1, 3), $c);
        }
    }

    /**
     * The aurora is painted on its own layer and blurred to death, because GD
     * has no gradient fill and no feGaussianBlur, and thirty passes of its 3x3
     * kernel is the cheapest thing that looks like light rather than like paint.
     */
    /**
     * The aurora is painted on its own layer and blurred hard, because GD has no
     * gradient fill and no feGaussianBlur.
     *
     * Drawn as vertical curtains along a wandering baseline rather than as a
     * horizontal ribbon: a real aurora hangs, and a ribbon reads as a racing
     * stripe. Each curtain fades out downwards, and the whole layer goes through
     * thirty passes of GD's 3x3 blur, which is the cheapest thing that looks
     * like light instead of like paint.
     */
    private function aurora($im, int $w, int $h): void
    {
        $layer = imagecreatetruecolor($w, $h);
        imagefilledrectangle($layer, 0, 0, $w, $h, imagecolorallocate($layer, 0, 0, 0));

        $bands = [
            ['y' => 118, 'amp' => 38, 'wave' => 300, 'drop' => 150, 'rgb' => [63, 214, 164], 'phase' => 0.0],
            ['y' => 164, 'amp' => 52, 'wave' => 420, 'drop' => 120, 'rgb' => [58, 163, 214], 'phase' => 1.9],
            ['y' =>  86, 'amp' => 30, 'wave' => 540, 'drop' =>  92, 'rgb' => [138, 104, 212], 'phase' => 3.4],
        ];

        foreach ($bands as $band) {
            [$r, $g, $b] = $band['rgb'];

            for ($x = 0; $x < $w; $x++) {
                $top = $band['y'] + (int) round(sin($x / $band['wave'] + $band['phase']) * $band['amp']);

                // Curtains ripple: the drop varies along the band, and some
                // columns are brighter than their neighbours.
                $ripple = (sin($x / 37 + $band['phase']) + sin($x / 91)) * 0.5;
                $drop   = (int) round($band['drop'] * (0.55 + 0.45 * (0.5 + 0.5 * $ripple)));
                $peak   = 0.45 + 0.55 * (0.5 + 0.5 * sin($x / 160 + $band['phase'] * 2));

                for ($d = 0; $d < $drop; $d++) {
                    $fade = (1 - $d / $drop) ** 1.25 * $peak;
                    $y = $top + $d;

                    if ($y < 0 || $y >= $h || $fade <= 0.02) {
                        continue;
                    }

                    imagesetpixel($layer, $x, $y, imagecolorallocate(
                        $layer,
                        (int) round($r * $fade),
                        (int) round($g * $fade),
                        (int) round($b * $fade),
                    ));
                }
            }
        }

        for ($i = 0; $i < 30; $i++) {
            imagefilter($layer, IMG_FILTER_GAUSSIAN_BLUR);
        }

        imagecopymerge($im, $layer, 0, 0, 0, 0, $w, $h, 88);
        imagedestroy($layer);
    }

    /**
     * Three ridges. The point numbers look arbitrary because they are: evenly
     * spaced peaks of equal height read as a sawtooth graph, and the fix is to
     * make no two spans the same width or the same height.
     */
    /**
     * Three ridges. The point numbers look arbitrary because they are: evenly
     * spaced peaks of equal height read as a sawtooth graph, so no two spans
     * share a width or a height and two of them are deliberately long and flat.
     *
     * The tall peak sits right of centre, outside the shadow wash. A snowcap in
     * the darkened half reads as a white triangle floating in a black sky.
     */
    private function ranges($im, int $w, int $h): void
    {
        $far = [0, 492, 58, 448, 132, 470, 196, 414, 268, 452, 340, 430, 392, 458,
                468, 422, 540, 456, 586, 436, 668, 470, 736, 428, 790, 452, 866, 416,
                928, 448, 1004, 426, 1072, 462, 1136, 436, 1200, 458,
                1200, 630, 0, 630];
        imagefilledpolygon($im, $far, imagecolorallocate($im, 36, 51, 69));

        $mid = [0, 556, 92, 524, 184, 540, 248, 496, 318, 528, 396, 508, 452, 534,
                528, 500, 604, 530, 676, 486, 742, 512, 806, 376, 876, 498, 946, 524,
                1024, 494, 1098, 528, 1160, 506, 1200, 520,
                1200, 630, 0, 630];
        imagefilledpolygon($im, $mid, imagecolorallocate($im, 19, 29, 41));

        // Snow, hung off the actual apex and only a little brighter than the rock
        // it sits on, which is what snow at that distance looks like.
        imagefilledpolygon(
            $im,
            [806, 376, 826, 430, 816, 422, 806, 436, 795, 422, 788, 428, 798, 400],
            imagecolorallocate($im, 118, 138, 158),
        );

        $near = [0, 604, 148, 590, 262, 600, 398, 580, 520, 594, 662, 572, 788, 588,
                 918, 566, 1040, 582, 1148, 564, 1200, 576,
                 1200, 630, 0, 630];
        imagefilledpolygon($im, $near, imagecolorallocate($im, 6, 8, 12));

        // A wash over the left half so the wordmark never has to fight a ridge.
        for ($x = 0; $x < 820; $x++) {
            $strength = (1 - $x / 820) ** 1.3;
            imagefilledrectangle($im, $x, 0, $x, $h,
                imagecolorallocatealpha($im, 4, 6, 10, 127 - (int) round(86 * $strength)));
        }
    }

    /**
     * The two of you.
     *
     * Drawn at roughly twice the size the composition "wants", because this card
     * is read as a 500px-wide thumbnail in a chat window: at the elegant size the
     * figures were twelve pixels tall and the picture became a landscape.
     */
    private function figures($im, int $w, int $h): void
    {
        // Torch glow as a real radial falloff. GD's 3x3 blur has an effective
        // radius of about four pixels however many times you run it, so blurring
        // an 86-pixel disc gives you an 86-pixel disc with soft corners, which
        // is how the first attempt at this put an orange rectangle on the card.
        $this->glow($im, 1004, 554, 120, [232, 128, 56], 0.60);
        $this->glow($im, 1004, 554, 42,  [255, 206, 150], 0.72);

        imagefilledellipse($im, 1004, 554, 10, 10, imagecolorallocate($im, 255, 240, 212));

        // Silhouettes last, so they read against the light rather than under it.
        $dark = imagecolorallocate($im, 2, 4, 7);
        $this->figure($im, 960, 582, $dark, false);
        $this->figure($im, 1048, 576, $dark, true);
    }

    /**
     * Additive radial light. Reads each pixel in the bounding box and adds the
     * colour back scaled by a smooth falloff, so the light sits on top of the
     * mountains instead of replacing them.
     *
     * @param  array{0: int, 1: int, 2: int}  $rgb
     */
    private function glow($im, int $cx, int $cy, int $radius, array $rgb, float $peak): void
    {
        [$lr, $lg, $lb] = $rgb;

        $maxX = imagesx($im) - 1;
        $maxY = imagesy($im) - 1;

        for ($y = max(0, $cy - $radius); $y <= min($maxY, $cy + $radius); $y++) {
            for ($x = max(0, $cx - $radius); $x <= min($maxX, $cx + $radius); $x++) {
                $d = sqrt(($x - $cx) ** 2 + ($y - $cy) ** 2);

                if ($d > $radius) {
                    continue;
                }

                $k = (1 - $d / $radius) ** 2.2 * $peak;
                $rgbAt = imagecolorat($im, $x, $y);

                imagesetpixel($im, $x, $y, imagecolorallocate(
                    $im,
                    min(255, (($rgbAt >> 16) & 0xFF) + (int) round($lr * $k)),
                    min(255, (($rgbAt >> 8) & 0xFF)  + (int) round($lg * $k)),
                    min(255, ($rgbAt & 0xFF)         + (int) round($lb * $k)),
                ));
            }
        }
    }

    private function figure($im, int $x, int $y, int $colour, bool $armRaised): void
    {
        imagefilledellipse($im, $x, $y - 56, 20, 22, $colour);                       // head
        imagefilledpolygon($im, [                                                    // torso + cloak
            $x - 15, $y, $x - 11, $y - 46, $x + 11, $y - 46, $x + 15, $y,
        ], $colour);
        imagefilledrectangle($im, $x - 11, $y, $x - 3, $y + 34, $colour);            // legs
        imagefilledrectangle($im, $x + 3, $y, $x + 11, $y + 34, $colour);

        if ($armRaised) {
            imagefilledpolygon($im, [$x + 9, $y - 42, $x + 16, $y - 45, $x + 46, $y - 90, $x + 38, $y - 95], $colour);
        } else {
            imagefilledpolygon($im, [$x - 11, $y - 42, $x - 16, $y - 40, $x - 22, $y - 6, $x - 15, $y - 6], $colour);
        }
    }

    /**
     * The name on two lines, the short part in gold above the long one: "UR",
     * then "SOVNGARDE". The gold accent the first card gave "VR" stays on the
     * part of the name that is ours.
     */
    private function cardText($im, int $w, int $h): void
    {
        $parchment = imagecolorallocate($im, 236, 227, 207);
        $gold      = imagecolorallocate($im, 192, 152, 44);
        $mist      = imagecolorallocate($im, 164, 174, 190);
        $faint     = imagecolorallocate($im, 106, 116, 132);

        $x = 76;

        imagettftext($im, 16, 0, $x, 136, $gold, $this->cinzelLight, 'CO-OP FOR SKYRIM VR');

        imagettftext($im, 72, 0, $x, 246, $gold, $this->cinzel, 'UR');

        imagettftext($im, 72, 0, $x, 338, $parchment, $this->cinzel, 'SOVNGARDE');

        imagefilledrectangle($im, $x, 378, $x + 148, 380, $gold);

        imagettftext($im, 22, 0, $x, 436, $mist, $this->spectral, 'Your modlist, your save, your server,');
        imagettftext($im, 22, 0, $x, 474, $mist, $this->spectral, 'and someone else actually in the room.');

        imagettftext($im, 13, 0, $x, 556, $faint, $this->cinzelLight, 'FREE   ·   OPEN SOURCE   ·   GPLv3');
    }

    /* --------------------------------------------------------------- icons */

    /**
     * The sigil (resources/views/art/sigil.blade.php) as a square PNG. The SVG favicon is the real one; these exist
     * for the platforms that still want a raster (iOS home screen, Android install prompt, older Windows pinning).
     *
     * GD draws without anti-aliasing, so the icon is drawn at SS times its size and scaled down, which smooths every
     * edge. Rings are a filled disc with a smaller one of the background inside (stacked outlines left visible
     * bands), and the wings and barbs follow the sigil's own curves, flattened into many points, rather than a rough
     * polygon. Opacities are the vector's: the inner ring at .45, the moons at .75 and .5, the barbs at .82.
     */
    private function icon(int $size, string $path): void
    {
        $ss = 4;
        $big = $size * $ss;
        $k = $big / 48;

        $im = imagecreatetruecolor($big, $big);
        imagealphablending($im, true);

        $bg = [11, 13, 17];
        $color = function (array $rgb, float $opacity = 1.0) use ($im, $bg) {
            // Mixed with the background by hand: the result is flattened onto it anyway.
            return imagecolorallocate($im, ...array_map(fn ($c, $b) => (int) round($b + ($c - $b) * $opacity), $rgb, $bg));
        };
        $gold = [192, 152, 44];
        $ember = [229, 96, 46];
        $pale = [236, 227, 207];

        imagefilledrectangle($im, 0, 0, $big, $big, $color($bg));

        $ring = function (float $r, float $stroke, array $rgb, float $opacity) use ($im, $k, $color, $bg) {
            $c = (int) round(24 * $k);
            imagefilledellipse($im, $c, $c, (int) round(2 * ($r + $stroke / 2) * $k), (int) round(2 * ($r + $stroke / 2) * $k), $color($rgb, $opacity));
            imagefilledellipse($im, $c, $c, (int) round(2 * ($r - $stroke / 2) * $k), (int) round(2 * ($r - $stroke / 2) * $k), $color($bg));
        };
        $ring(21.5, 1.6, $gold, 1.0);
        $ring(18, .7, $gold, .45);

        $poly = fn (array $pts, int $c) => imagefilledpolygon($im, array_map(fn ($v) => (int) round($v * $k), $pts), $c);

        $poly([24, 0.6, 27.4, 4, 24, 7.4, 20.6, 4], $color($gold));          // crown lozenge
        $poly([24, 11, 26.6, 24, 24, 38.5, 21.4, 24], $color($ember));       // stave

        // Wings and barbs, the sigil's paths: out along one cubic curve and back along a second, then closed.
        // [start, control, control, tip, control, control, end, opacity]
        $curves = [
            [[21.6, 19.4], [15, 15.4], [10.4, 19.6], [10.2, 27.6], [13.4, 23], [17, 21.6], [21.6, 23.4], 1.0],
            [[26.4, 19.4], [33, 15.4], [37.6, 19.6], [37.8, 27.6], [34.6, 23], [31, 21.6], [26.4, 23.4], 1.0],
            [[22.1, 28.6], [17.9, 31.4], [16.4, 35.4], [17.8, 39.4], [19.1, 35.1], [20.4, 32.8], [22.9, 31.6], .82],
            [[25.9, 28.6], [30.1, 31.4], [31.6, 35.4], [30.2, 39.4], [28.9, 35.1], [27.6, 32.8], [25.1, 31.6], .82],
        ];
        foreach ($curves as [$p0, $a1, $a2, $tip, $b1, $b2, $end, $opacity]) {
            $pts = array_merge($this->cubic($p0, $a1, $a2, $tip), $this->cubic($tip, $b1, $b2, $end), $end);
            $poly($pts, $color($ember, $opacity));
        }

        imagefilledellipse($im, (int) round(18.4 * $k), (int) round(42.2 * $k), (int) round(3.4 * $k), (int) round(3.4 * $k), $color($pale, .75));
        imagefilledellipse($im, (int) round(29.6 * $k), (int) round(42.2 * $k), (int) round(2.2 * $k), (int) round(2.2 * $k), $color($pale, .5));

        $out = imagecreatetruecolor($size, $size);
        imagecopyresampled($out, $im, 0, 0, 0, 0, $size, $size, $big, $big);
        imagepng($out, $path, 8);
        imagedestroy($im);
        imagedestroy($out);
    }

    /** A cubic Bézier as a flat list of points (x, y, x, y...), without its last point. */
    private function cubic(array $p0, array $p1, array $p2, array $p3, int $steps = 24): array
    {
        $out = [];
        for ($i = 0; $i < $steps; $i++) {
            $t = $i / $steps;
            $u = 1 - $t;
            foreach ([0, 1] as $axis) {
                $out[] = $u ** 3 * $p0[$axis] + 3 * $u ** 2 * $t * $p1[$axis] + 3 * $u * $t ** 2 * $p2[$axis] + $t ** 3 * $p3[$axis];
            }
        }

        return $out;
    }
}
