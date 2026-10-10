# Public server status: what the website needs

For whoever builds the mod and hub side of the public server. The website's page is built and waiting
(`/en/public-server`, `/fr/serveur-public`, `/de/oeffentlicher-server`, `/es/servidor-publico`). It reads one JSON
document and draws the status, the player list and a map from it. Nothing on the site claims the server exists until
this document is live and `STVR_PUBLIC_SERVER_ENABLED=true` is set.

Website side: `app/Support/PublicServer.php` (reads and checks the document), `resources/views/pages/public.blade.php`,
`resources/views/art/skyrim-map.blade.php`. A made-up example: `resources/fixtures/public-server.sample.json`.

## Where the document comes from (recommended)

The dedicated server should not serve HTTP itself: it would need a second port opened, and it can sit behind the relay.
Instead:

1. **The server pushes** its status to the hub every 30 seconds, and once when it stops (`"online": false`):
   `POST https://ursovngarde-hub.ursovngarde.workers.dev/servers/public/status`, body = the document below,
   `Authorization: Bearer <SERVER_KEY>`. `SERVER_KEY` is a new hub secret, held only by the public server's machine
   and Cloudflare. Not the upload key: every launcher carries that one.
2. **The hub keeps** the latest document in its Durable Object (one row, overwritten) and stamps `updated_at` itself on
   arrival, so a server with a wrong clock cannot look fresh or stale.
3. **The hub serves** it, public and read-only: `GET /servers/public/status`, with `Cache-Control: max-age=15`.
4. **The website** reads that URL (`STVR_PUBLIC_SERVER_STATUS_URL`) and caches it for 30 seconds.

The hub endpoints are not written yet. They are small and follow the pattern of `POST /stats`, which the website already
uses.

## The document

```json
{
    "online": true,
    "name": "urSovngarde public server",
    "address": "play.example.org:10578",
    "version": "1.9.0",
    "password": false,
    "max_players": 8,
    "started_at": "2026-10-10T08:00:00Z",
    "updated_at": "2026-10-10T12:00:00Z",
    "players": [
        { "name": "Ingrid", "location": "Riverwood", "worldspace": "Tamriel", "x": 7603, "y": -66167 },
        { "name": "Asta", "location": "Dragonsreach", "worldspace": "WhiterunWorld" }
    ]
}
```

| Field | Type | Meaning |
|---|---|---|
| `online` | boolean | `true` while the server accepts players. Send `false` when stopping. |
| `name` | string, ≤ 80 | Shown as the server's title. |
| `address` | string, ≤ 100 | What a player types to join: `host:port`. Shown with a copy button. |
| `version` | string, ≤ 20 | The server's build, as the download page names it (`1.9.0`). |
| `password` | boolean | Whether `sPassword` is set. Never the password. |
| `max_players` | integer | The server's player limit. |
| `started_at` | ISO 8601 UTC | When this run of the server started. |
| `updated_at` | ISO 8601 UTC | When this status was made. Stamped by the hub on arrival. |
| `players` | array, ≤ 64 shown | One entry per player connected right now. |

Each player:

| Field | Type | Meaning |
|---|---|---|
| `name` | string, ≤ 40 | The **character's name**, as set in game. Never a Steam name, account or address. |
| `location` | string, ≤ 60, optional | The current location's display name, in English (`Riverwood`, `Dragonsreach`, `Falkreath Hold`). Indoors, the interior's name. |
| `worldspace` | string, optional | The worldspace's editor ID. Only `Tamriel` is drawn on the map. Any other (an interior, `WhiterunWorld`, `Solstheim`) lists the player as indoors, without a dot. |
| `x`, `y` | numbers, optional | The player's position in game units, as the console's `getpos x` and `getpos y` give it. |

Rules the website applies, so the sender does not have to:

- A document whose `updated_at` is more than **180 seconds** old shows the server as offline. Keep pushing every 30
  seconds; a crashed server goes offline on the page within three minutes without anyone doing anything.
- Unknown fields are ignored. Missing optional fields are fine. Strings are trimmed and cut to the lengths above.
- A player without a `name` is skipped.

## The map

Our own drawing of Skyrim (not the game's map), 1000 by 640. A position is placed on it from two calibration points in
`config/stvr.php` (`public_server.map`): Whiterun's main gate and Windhelm's bridge. **Their in-game positions there are
estimates.** Please stand at both places in game, read `getpos x` and `getpos y`, and send the four numbers; the dots
are only as right as those.

## Privacy: before the page is switched on

The page shows, to anyone on the internet, which characters are on the server and roughly where. Before
`STVR_PUBLIC_SERVER_ENABLED=true`:

- The server should send only character names, and the website's privacy page (`lang/*/privacy.php`, four languages)
  needs a section saying the public server's page lists character names and places, live, and keeps nothing.
- Worth deciding: a server setting to leave positions out (`x`, `y` absent = listed without a dot), and whether a
  player can hide from the list.

## Joining

Today the page tells players to paste the address into the launcher's Join ("or an address"), or into connect.txt. If
the launcher later gets a link that joins in one click (for example `ursovngarde://join?address=...`), the page can
add a Join button; it does not show one until that exists.

## Switching it on

1. Hub: the two endpoints above, `npx wrangler secret put SERVER_KEY`, deploy.
2. Server: push the document every 30 seconds.
3. Website `.env`: `STVR_PUBLIC_SERVER_STATUS_URL=https://ursovngarde-hub.ursovngarde.workers.dev/servers/public/status`,
   check the page, then `STVR_PUBLIC_SERVER_ENABLED=true` (adds it to the menu, the sitemap and search engines).

On a development machine, `STVR_PUBLIC_SERVER_STATUS_URL=sample` shows the made-up server from the fixture. It is
refused in production.
