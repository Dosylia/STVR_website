#!/usr/bin/env bash
# -----------------------------------------------------------------------------
# Deploy the site.
#
#   ./deploy.sh              build and start
#   ./deploy.sh --pull       git pull first
#
# Safe to run repeatedly. The app image is rebuilt, the public assets are
# republished into the volume nginx reads, and the caches are rebuilt by the
# container's own entrypoint.
# -----------------------------------------------------------------------------
set -euo pipefail

cd "$(dirname "$0")"

COMPOSE="docker compose -f compose.prod.yml"

if [[ "${1:-}" == "--pull" ]]; then
    echo "→ pulling"
    git pull --ff-only
fi

if [[ ! -f .env ]]; then
    echo "No .env. Copy .env.example to .env and set APP_KEY and APP_URL first." >&2
    exit 1
fi

if ! grep -qE '^APP_KEY=.+' .env; then
    echo "APP_KEY is empty in .env. Generate one with:" >&2
    echo "  $COMPOSE run --rm app php artisan key:generate --show" >&2
    exit 1
fi

echo "→ building"
$COMPOSE build

echo "→ starting"
$COMPOSE up -d --remove-orphans

echo "→ up"
$COMPOSE ps
