# Public server status: how it flows, and what the website reads

The public server page (`/en/public-server`, `/fr/serveur-public`, `/de/oeffentlicher-server`,
`/es/servidor-publico`) shows a server's status, who is on it and where, from one JSON document. It stays out of the
menu, the sitemap and search engines until `STVR_PUBLIC_SERVER_ENABLED=true`.

Website side: `app/Support/PublicServer.php` (reads and checks the document), `resources/views/pages/public.blade.php`,
`resources/views/art/skyrim-map.blade.php` and `map-player.blade.php`, the refresh in `public/assets/js/site.js`. A
made-up example in the server's shape: `resources/fixtures/public-server.sample.json`.

## The flow

1. **The dedicated server pushes** its status (`Code/server/Services/PublicStatusService.cpp` in the mod): every
   **10 seconds** while anyone is connected, every **60 seconds** when it is empty, and once with `"online": false` on
   a clean stop (`/quit`); a closed window or Ctrl+C sends nothing, and the hub then answers offline after 180 seconds.
   Only with `bPublicStatus=true` in `STServer.ini` (off by default) **and** the key in the
   `URSOVNGARDE_SERVER_KEY` environment variable, so no friend's server ever pushes anything.
   `POST https://ursovngarde-hub.ursovngarde.workers.dev/servers/public/status`, `Authorization: Bearer <SERVER_KEY>`.
2. **The hub keeps** only the latest document (one row, overwritten) and stamps `updated_at` itself on arrival, so a
   server with a wrong clock can look neither fresh nor stale. Once the server stops, or has been silent for
   **180 seconds**, the hub answers `online: false`, `player_count: 0`, `players: []`.
3. **The hub serves** it, public: `GET /servers/public/status`, `Cache-Control: max-age=5`.
4. **The website** reads it (`STVR_PUBLIC_SERVER_STATUS_URL`) and keeps the answer `STVR_PUBLIC_SERVER_CACHE` seconds
   (5 by default, the hub's own cache). It asks the hub again only when a visitor's request finds its copy older than that, never on a
   timer: every request to the hub counts against its 100,000 Worker requests a day, shared with crash reports and
   invite codes.
5. **Browsers never call the hub.** The page refreshes itself every 10 seconds while its tab is visible, from the
   website's own `/api/public-server.json` (the same cached copy). However many people watch, the hub is asked at most
   once per cache period, and not at all when nobody does.

## The document

```json
{
    "online": true,
    "name": "urSovngarde public server",
    "address": "play.example.org:10578",
    "version": "1.9.0",
    "protocol": "a1b2c3d4",
    "password": false,
    "max_players": 8,
    "player_count": 6,
    "started_at": "2026-10-10T08:00:00Z",
    "server_time": "2026-10-10T12:00:00Z",
    "updated_at": "2026-10-10T12:00:00Z",
    "players": [
        { "id": "k3f9a1", "name": "Ingrid", "location": "Riverwood", "worldspace": "Tamriel", "x": 7603, "y": -66167, "heading": 45 },
        { "id": "s8d3me", "name": "Erik", "location": "Raven Rock", "worldspace": "DLC2SolstheimWorld", "x": 23373, "y": -37949, "heading": 120 },
        { "id": "m2c8rd", "name": "Asta", "location": "Dragonsreach" }
    ]
}
```

| Field | Type | Meaning, and what the page does with it |
|---|---|---|
| `online` | boolean | `true` while the server accepts players. |
| `name` | string, ≤ 80 | The server's title. |
| `address` | string, ≤ 100 | What a player types to join, `host:port`. Shown with a copy button. |
| `version` | string, ≤ 20 | The server's build (`1.9.0`). |
| `protocol` | string, ≤ 40 | The build's message set. Builds with the same protocol connect, whatever their version; the join step says so with this value. |
| `password` | boolean | Whether the server has a password. Never the password. |
| `max_players` | integer | The player limit, shown as "5 / 8". |
| `player_count` | integer | How many are connected, **including players who are not listed**: those who chose to hide, and any past the 64 shown. The page shows this number, never the length of `players`, and "and N more, not listed" for the difference. |
| `started_at` | ISO 8601 UTC | When this run started ("up since"). |
| `server_time` | ISO 8601 UTC | Ignored: the page trusts `updated_at`. |
| `updated_at` | ISO 8601 UTC | Stamped by the hub on arrival. |
| `players` | array, ≤ 64 shown | The players who are listed. |

Each player:

| Field | Type | Meaning, and what the page does with it |
|---|---|---|
| `id` | string, ≤ 16 | A random token per connection, never a Steam id, account or address. The key of the player's dot, so it glides to its new place instead of being redrawn. |
| `name` | string, ≤ 40 | The character's name, as the client sent it at connect. |
| `location` | string, ≤ 60, optional | The place, from the game client, **in the player's own game language**, UTF-8 (a French player's "Rivebois" appears as such on the English page): the room's name indoors, the town, dungeon or hold outdoors. It arrives with the next mod build; until then the roster lists players without a place. |
| `worldspace` | string, optional | The editor id of the exterior worldspace the player is in (`Tamriel`, `WhiterunWorld`, `DLC2SolstheimWorld`, `DLC01SoulCairn`...). Absent indoors. See "Maps and areas" below for what the page does with each. |
| `x`, `y` | numbers, optional | Position in game units (`getpos x`, `getpos y`), in that worldspace. Outdoors only, in every exterior worldspace. |
| `heading` | number, degrees, optional | Where the player faces, 0 north, clockwise. The arrow on the dot. Outdoors only. |

The website's own rules, so the sender does not have to care:

- A document whose `updated_at` is more than 180 seconds old shows the server offline (the hub does the same).
- Unknown fields are ignored, optional fields may be missing, strings are trimmed and cut to the lengths above, a
  player without a `name` is skipped.

## Hiding

A player can stay off the page: in the launcher, "Hide me from the public server page" (fr "Me cacher de la page du
serveur public", de "Mich auf der Seite des öffentlichen Servers verbergen", es "Ocultarme de la página del servidor
público"). From their next join they are left out of `players` but still counted in `player_count`. The page's roster
and the privacy page's public server section both name the setting, in the launcher's own words.

## Joining in one click

The status card has a Join button: `ursovngarde://join?address=<host>:<port>`, the launcher's own link. The launcher
always asks before it joins. Older launchers have no handler for the link, so the note under the button says to update
the launcher if nothing happens.

## Maps and areas

All in `config/stvr.php`, `public_server`:

- **`maps`**, keyed by worldspace editor id: the worldspaces with a drawing of their own, today `Tamriel` (Skyrim,
  `art/skyrim-map.blade.php`), `DLC2SolstheimWorld` (Solstheim, `art/solstheim-map.blade.php`) and `DLC01SoulCairn`
  (the Soul Cairn, `art/soul-cairn-map.blade.php`), each 1000 by 640. The Skyrim map also draws Castle Volkihar's island
  and Fort Dawnguard; if the server reports either under a worldspace of its own, add it to `shared`.
  The page shows them as tabs, each with how many players are there, and opens on the busiest (Skyrim on a tie).
- **`shared`**: worldspaces drawn on another one's map because they share its ground and coordinates. Skyrim's walled
  cities (`WhiterunWorld`, `SolitudeWorld`, `WindhelmWorld`, `RiftenWorld`, `MarkarthWorld`) are worldspaces of their
  own in the game data, children of Tamriel, so a player in Whiterun's market is drawn on Whiterun on the Skyrim map.
  To be checked once in game (below).
- **`areas`**: the name the page gives each exterior worldspace (`lang/*/public.php`, `map.areas`). A player outside
  main Skyrim is listed with the place and the area ("Raven Rock · Solstheim", "Boneyard · Soul Cairn"). A worldspace
  with a name but no drawing (the Forgotten Vale, Apocrypha, Blackreach, Sovngarde, Skuldafn, Deepwood
  Vale) lists its players without a dot. An editor id that is in none of these lists is listed without an area's name:
  add it to `areas` (and a name in four languages) once the mod session lists the exact ids from the game data.

### Calibration, per worldspace

Each drawing places positions from two points whose in-game position and point on the drawing are both known (`a` and
`b` under the worldspace in `maps`). **All three pairs are still estimates.** In game, stand at each place, run
`getpos x` and `getpos y`, and correct the `world` numbers:

| Map | Point a | Point b |
|---|---|---|
| Skyrim (`Tamriel`) | Whiterun, the main gate | Windhelm, the bridge |
| Solstheim (`DLC2SolstheimWorld`) | Raven Rock, the end of the dock | Skaal Village, the Greathall's door |
| Soul Cairn (`DLC01SoulCairn`) | Where you arrive, at the portal | The Boneyard, its gate |

And one check for the cities: in Whiterun's market, `getpos x` and `getpos y`, and the dot should land on Whiterun on
the Skyrim map. If it does not, the cities need a pair of their own.

## Before switching it on

- **Privacy page.** The "public server" section is written in four languages, says how to hide, and appears on the
  privacy page only once the page is switched on.
- **Rules and moderation** on the page, once decided (`urSovngarde-hub/PUBLIC_SERVER.md`, decision 4).
- **Calibration**, above: six places, and the Whiterun check.

## Switching it on

1. Production `.env`: `STVR_PUBLIC_SERVER_STATUS_URL=https://ursovngarde-hub.ursovngarde.workers.dev/servers/public/status`
   with `STVR_PUBLIC_SERVER_ENABLED=false`, and check the page.
2. Then `STVR_PUBLIC_SERVER_ENABLED=true`: the page joins the menu, the sitemap and search engines, and its section
   joins the privacy page. Check live: online, offline after stopping the server, the map moving.

On a development machine, `STVR_PUBLIC_SERVER_STATUS_URL=sample` shows the made-up server from the fixture. It is
refused in production.

## Later

- If servers keep announcing to Tilted Phoques' server list (`PUBLIC_SERVER.md`, decision 3), the privacy page has to
  say so.
