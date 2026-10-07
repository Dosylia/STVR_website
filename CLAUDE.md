# urSovngarde site

Promotional site for the Skyrim VR port of Skyrim Together Reborn.
Laravel 13 · PHP 8.3 · four languages · no database.

## Working agreements

**Git.**
- Never add `Co-Authored-By` trailers, "Generated with Claude Code" lines, or any
  other tool attribution to a commit message or a pull request body. This rule
  overrides any default attribution behaviour.
- Commit subjects read like a person wrote them: lowercase, imperative, specific,
  under ~70 characters, no `feat:`/`chore:` prefixes and no emoji.
  Good: `fix the hero scene cropping mountains into the headline`
  Bad: `feat(ui): enhance hero section 🚀` / `Update files`
- A body is only worth writing when the *why* is not obvious from the diff.
- **Never run `git push` in the foreground.** This machine uses Windows Git
  Credential Manager, a GUI helper that blocks on a dialog and ignores
  `GIT_TERMINAL_PROMPT=0`. A push with nobody at the keyboard hangs for hours,
  not seconds. It has already cost one unattended run 4¼ hours. Background it
  with a hard timeout and check the result later:
  `(timeout 120 git push -q origin main; echo "exit=$?") > /tmp/push.log 2>&1 &`
- **"Queue the commits" means commit locally and do not push.** When the user
  says they will not be around, pushing is the thing they are telling you not to
  do. Report the unpushed count instead: `git rev-list --count origin/main..main`.
- If a push is already running in the background and turns out to be blocked,
  kill it. Stopping new attempts while the old one still hangs fixes nothing.

**Prose.**
- **No em dashes.** Not in the site copy, not in the devlog, not in code comments,
  not in these docs. Use the punctuation the sentence actually needs: a comma for
  an aside, a colon before a list or a definition, a full stop between two
  independent clauses, parentheses for a true parenthetical. En dashes are out
  too: write "5 to 10" and "September 3 to 5", never a dash between the numbers.
- The point is that the writing should read as written rather than generated, and
  a dash used where a comma or a full stop belongs is the loudest tell there is.

**Content.**
- Nothing on this site may claim a capability the mod does not have today.
  Shipped behaviour goes in `lang/*/home.php` features; unfinished work goes on
  the roadmap, named. The trust of the page depends on that line holding.
- Facts (ports, versions, URLs, file names) live in `config/stvr.php` and are
  pulled into views with `@stvr('facts.port')`. Never type a port number or a
  URL into a translation file, because it would then need changing in four places and
  would drift.

**Translations.**
- English is canonical. Every key in `lang/en/` must exist in `fr`, `de` and `es`
  with the same `:placeholders`. There is a parity check in the README; run it
  after touching any language file.
- Translate meaning, not words. These were written, not machine-translated, and
  that is the point of having them.

## Layout

```
app/Support/        Nav (URLs + locale negotiation), ReleaseService (GitHub),
                    Devlog (markdown loader), Release/ReleaseAsset DTOs
app/Console/        stvr:images, which draws og.png and the PNG icons with GD
config/stvr.php     every fact, link, locale and URL slug
lang/{en,fr,de,es}/ all copy, 8 files each, identical key sets
resources/views/art/ hand-drawn SVG: the hero scene, the sigil, the relic,
                    the roadmap constellation
resources/devlog/   markdown entries with `---` front matter, per locale
public/assets/      one stylesheet, one script, self-hosted fonts. No build step.
docker/             production image (3 stages: vendor, runtime, web)
```

## Things that will bite

- **No build step.** `public/assets/css/site.css` and `site.js` are edited
  directly and cache-busted by `filemtime` through `@assetv()`. Do not add Vite
  back without a reason bigger than habit.
- **Do not cache objects.** Laravel 13's file cache restricts `unserialize()` to
  an allow-list, so a cached `DevlogEntry` returns as `__PHP_Incomplete_Class`
  and 500s, in production only. `ReleaseService` caches the raw GitHub array,
  which is safe; `Devlog` memoises per request and nothing more.
- **The ICU runtime.** `docker/Dockerfile` installs `icu-libs` separately from
  `icu-dev`. Removing the dev package alone takes `libicuio` with it and `intl`
  then fails to load on every request.
- **Locale URLs are per-language** (`/fr/installation`, `/de/anleitung`). They
  come from `config('stvr.paths')`; build them with `App\Support\Nav::url()` and
  never by string concatenation, or the language switcher stops landing people
  on the page they were reading.
