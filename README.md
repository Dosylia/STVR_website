# urSovngarde website

The promotional site for [urSovngarde](https://github.com/Dosylia/SkyrimTogetherVR),
a VR port of Skyrim Together Reborn.

Laravel 13 on PHP 8.3. Four languages. No database, no queue, no build step.
Seven pages, served as cached Blade, with one cached call to the GitHub API.

---

## Running it locally

The site is a service in the shared dev stack (`~/docker/docker-compose.yml`):

```bash
cd ~/docker
docker compose up -d stvr nginx
```

Then add `stvr.missnovation.loc` to the Windows hosts file
(`C:\Windows\System32\drivers\etc\hosts`, as Administrator) on the existing
`missnovation.loc` line, and open **http://stvr.missnovation.loc**.
HTTPS works too; the certificate is in `~/docker/data/ssl/`.

Nothing needs installing on the host. Run artisan through the container:

```bash
docker exec -w /var/www/stvr dev_stvr php artisan view:clear
```

### After editing a language file or a view

```bash
docker exec -w /var/www/stvr dev_stvr php artisan optimize:clear
docker exec -w /var/www/stvr dev_stvr php artisan stvr:lang-check
```

`stvr:lang-check` fails on a key missing from a language, a lost `:placeholder`,
a devlog entry not yet translated, or an em or en dash anywhere in the copy.

### Before a deploy

```bash
docker exec -w /var/www/stvr dev_stvr php artisan test
```

The tests find every page in `config/stvr.php` and every devlog entry and load
each one in every language: a page that throws, a raw translation key, an
unfilled placeholder, a date in English on a French page or broken structured
data fails here instead of in production. They do it twice: before anything is
released, and with a release, a launcher and a download count to show.

No test reaches the network, whatever `.env` holds: a request to GitHub or the
hub that the test has not faked throws (`tests/TestCase.php`), so a test that
needs an answer fakes it.

---

## How it is put together

| Where | What |
|---|---|
| `config/stvr.php` | Every fact the site states: ports, versions, URLs, locales, URL slugs. Nothing factual belongs anywhere else. |
| `lang/{en,fr,de,es}/` | All copy. Eight files per language, identical key sets. English is canonical. |
| `app/Support/Nav.php` | Builds every internal URL and negotiates the language at `/`. |
| `app/Support/ReleaseService.php` | Reads the newest GitHub release, caches it, falls back when there is none. |
| `app/Support/Devlog.php` | Loads markdown entries from `resources/devlog/<locale>/`. |
| `app/Support/Shots.php` | Reads `public/media/shots/`; the home page gallery falls back to the illustration when it is empty. |
| `resources/views/art/` | The illustrations, as hand-written SVG. |
| `public/assets/` | One stylesheet, one script, self-hosted fonts. Edited directly. |

### Why there is no build step

The site is text and SVG. A bundler would add a toolchain, a lockfile and a CI
step to minify ~40 KB of CSS that gzip already handles. `@assetv()` appends the
file's modification time as a cache key, so an edit reaches everyone on the next
request and nginx can still cache the files for a year.

---

## The download panel

It reads `https://api.github.com/repos/<repo>/releases/latest` and fills itself
in: version, date, file sizes, download counts, and a button per asset. Assets
are classified by filename through `config('stvr.asset_kinds')`, which matches
what `make-release.ps1` emits:

| File | Shown as |
|---|---|
| `SkyrimTogetherVR-<version>.zip` | Full package |
| `SkyrimTogetherVR-<version>-update.zip` | Update only |
| anything with `server` in the name | Server |

**Until a release is tagged**, the panel shows the fallback from `.env`
(`STVR_FALLBACK_*`) and says plainly that the build lives on the releases page.
Publishing a release is all it takes to light the panel up:

```bash
gh release create v0.1.0-vr \
  build/release/SkyrimTogetherVR-*.zip \
  --title "v0.1.0-vr" --notes "..."
```

The response is cached for `STVR_RELEASE_CACHE_MINUTES` (30 by default), so the
unauthenticated rate limit of 60 requests an hour is never a concern. To see a
new release immediately:

```bash
docker exec -w /var/www/stvr dev_stvr php artisan cache:clear
```

---

## Adding a devlog entry

One markdown file per entry, named `YYYY-MM-DD-slug.md`, in
`resources/devlog/en/`:

```markdown
---
title: What broke, and what it was
date: 2026-10-05
summary: One sentence. It is the card text on the index and the meta description.
tags: crashes, vr
---

The body, in markdown.
```

The English folder is the canonical list. A translation is the same filename
under `resources/devlog/fr/` (or `de`, `es`); without one, readers get the
English text and a visible note saying so, rather than a missing entry.

---

## Adding screenshots

Drop image files into `public/media/shots/`. They appear on the home page, in
order, with no code change and no deploy:

```
public/media/shots/01-two-on-the-road.jpg
public/media/shots/02-riften-market.webp
```

The leading number orders them; the rest of the name becomes the slug. `.jpg`,
`.jpeg`, `.png`, `.webp` and `.avif` all work, and about 1600px wide is plenty.
The first image is given double width on a wide screen, so put the best one
first.

Captions are optional. To add one, use the slug in every language file:

```php
// lang/en/shots.php
'captions' => [
    'riften-market' => 'Two players, one market, and nobody has fallen through the floor yet.',
],
```

Without a caption the slug becomes the alt text and no caption is drawn.

**With the folder empty** the section shows the illustrated scene instead and
still reads as finished, which is why it could ship before there was anything
to put in it.

---

## Translations

English is the source. Everything else must match it key for key, placeholder
for placeholder. The check:

```bash
docker exec -w /var/www/stvr dev_stvr php -r '
function flat(array $a, string $p = ""): array {
    $o = [];
    foreach ($a as $k => $v) {
        $key = $p === "" ? (string) $k : "$p.$k";
        $o = is_array($v) ? array_merge($o, flat($v, $key)) : $o + [$key => $v];
    }
    return $o;
}
$files = ["site","home","download","install","host","faq","roadmap","devlog","shots","privacy"];
$bad = 0;
foreach ($files as $f) {
    $en = flat(require "lang/en/$f.php");
    foreach (["fr","de","es"] as $l) {
        $t = flat(require "lang/$l/$f.php");
        foreach (array_keys(array_diff_key($en, $t)) as $k) { echo "MISSING $l/$f: $k\n"; $bad++; }
        foreach (array_keys(array_diff_key($t, $en)) as $k) { echo "EXTRA   $l/$f: $k\n"; $bad++; }
        foreach ($en as $k => $v) {
            if (!isset($t[$k]) || !is_string($v)) continue;
            preg_match_all("/:[a-z_]+/", $v, $a);
            preg_match_all("/:[a-z_]+/", (string) $t[$k], $b);
            if ($d = array_diff($a[0], $b[0])) { echo "PLACEHOLDER $l/$f: $k lost ".implode(",", $d)."\n"; $bad++; }
        }
    }
}
echo $bad ? "$bad problems\n" : "all four locales agree\n";
'
```

URL slugs are per-language (`/fr/installation`, `/de/anleitung`,
`/es/instalacion`) and live in `config('stvr.paths')`. Always build links with
`App\Support\Nav::url('install')`. That is what lets the language switcher put
a reader on the same page in their language instead of back on the home page.

---

## Images

`og.png` and the PNG icons are drawn by an artisan command, from the same
palette as the stylesheet:

```bash
docker exec -w /var/www/stvr dev_stvr php artisan stvr:images
```

It needs the TTFs in `storage/app/fonts/` (Cinzel and Spectral, SIL OFL). The
output is committed, so a fresh clone has a working share card without running
anything. The favicon is `public/favicon.svg`, written by hand.

---

## Deploying

A self-contained two-container stack, independent of the dev environment:

```bash
cp .env.example .env
docker compose -f compose.prod.yml run --rm app php artisan key:generate --show   # paste into .env
$EDITOR .env        # set APP_KEY and APP_URL
./deploy.sh
```

`docker/Dockerfile` builds three stages:

1. **vendor**: Composer, `--no-dev`, optimised classmap. Discarded.
2. **runtime**: `php:8.3-fpm-alpine` with the app baked in, running as
   `www-data`. Only `storage/` is writable.
3. **web**: `nginx:stable-alpine` with `public/` copied in from the same build,
   so the server and the assets can never be from different commits.

TLS is left to whatever sits in front. The vhost reads `X-Forwarded-Proto` and
passes it to PHP, so canonical URLs, hreflang tags and redirects come out as
`https://` behind a terminator without the app pretending every request is
secure. There is a commented certbot service in `compose.prod.yml` if you would
rather it handled the certificate itself.

### Things that will bite

- **Do not cache objects.** Laravel 13's file cache restricts `unserialize()` to
  an allow-list, so a cached `DevlogEntry` comes back as
  `__PHP_Incomplete_Class` and 500s, in production only, which is the worst
  place to find out. `ReleaseService` caches the raw GitHub array; `Devlog`
  memoises per request and nothing more.
- **ICU.** The Dockerfile installs `icu-libs` separately from `icu-dev` and only
  deletes the latter. Dropping `icu-dev` on its own takes `libicuio` with it and
  `intl` then fails to load on every request.

---

## Licence and attribution

The site is part of the urSovngarde project and inherits its
[GPL-3.0](https://www.gnu.org/licenses/gpl-3.0.en.html) licence.

The multiplayer this promotes is
[Skyrim Together Reborn](https://github.com/tiltedphoques/TiltedEvolution) by
Tilted Phoques. Fonts are Cinzel and Spectral (SIL Open Font License 1.1),
self-hosted, so the site makes no third-party request and needs no cookie
banner.

An unofficial fan project. Not affiliated with, endorsed by, or connected to
Bethesda Softworks or ZeniMax Media.
