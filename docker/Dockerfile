# =============================================================================
# Skyrim Together VR: production image
# -----------------------------------------------------------------------------
# Two stages. The first one has Composer and is thrown away; the second is the
# thing that ships, and it has no package manager, no Composer, no Node and no
# source history in it.
#
# The site has no database, no queue and no scheduler: it is seven pages, four
# languages, markdown devlog entries and one cached call to the GitHub API. That
# is why this image is as small as it is, and why there is no worker service in
# the compose file to wonder about later.
# =============================================================================

# ---- stage 1: dependencies --------------------------------------------------
FROM composer:2 AS vendor

WORKDIR /app

# Copy only what affects the dependency graph first, so a change to a Blade
# template does not re-resolve every package.
COPY composer.json composer.lock ./

RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction \
        --no-progress

COPY . .

RUN composer dump-autoload --optimize --classmap-authoritative --no-dev


# ---- stage 2: runtime -------------------------------------------------------
FROM php:8.3-fpm-alpine AS runtime

# intl for locale-aware dates; opcache because every request renders Blade.
#
# icu-libs and icu-data-full are runtime dependencies and must survive; only the
# headers are build-only. Deleting icu-dev without pinning the runtime takes
# libicuio with it, and the image then starts with "Unable to load dynamic
# library 'intl'" on every single request.
RUN apk add --no-cache icu-libs icu-data-full \
    && apk add --no-cache --virtual .build-deps icu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j"$(nproc)" intl opcache \
    && apk del --no-network .build-deps

COPY docker/php.ini /usr/local/etc/php/conf.d/99-stvr.ini

WORKDIR /var/www/html

COPY --from=vendor --chown=www-data:www-data /app /var/www/html

# Laravel writes to exactly two places. Nothing else in the image needs to be
# writable, and keeping it that way is most of the hardening this needs.
RUN mkdir -p storage/framework/{cache,sessions,views} storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache \
    && rm -rf /var/www/html/docker /var/www/html/tests

COPY --chmod=755 docker/entrypoint.sh /usr/local/bin/entrypoint

USER www-data

EXPOSE 9000

ENTRYPOINT ["entrypoint"]
CMD ["php-fpm"]


# ---- stage 3: the web server ------------------------------------------------
# nginx serves public/ straight off disk, so it needs those files, and it is a
# different container from PHP-FPM, so it cannot see the app image's filesystem.
#
# Baking them into the nginx image is the one arrangement with no moving parts:
# no shared volume to go stale after a rebuild, no sidecar container copying
# files at start-up, and the two images are built from the same commit by
# construction. The earlier version of this used a named volume and a one-shot
# copy container, and it silently served last week's stylesheet.
FROM nginx:stable-alpine AS web

COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=vendor /app/public /var/www/html/public

RUN chown -R nginx:nginx /var/www/html/public
