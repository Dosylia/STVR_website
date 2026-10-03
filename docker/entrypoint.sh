#!/bin/sh
# -----------------------------------------------------------------------------
# Warms Laravel's caches at container start rather than at image build.
#
# The caches bake in environment values, and the environment is not known until
# the container runs. An image built with the wrong APP_URL would hand every
# visitor absolute links to the wrong hostname, including the hreflang tags,
# which is a slow and confusing way to lose a search ranking.
# -----------------------------------------------------------------------------
set -e

cd /var/www/html

if [ -z "${APP_KEY}" ]; then
    echo "stvr: APP_KEY is not set. Generate one with 'php artisan key:generate --show' and put it in the environment." >&2
    exit 1
fi

php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "stvr: caches warmed, starting $*"

exec "$@"
