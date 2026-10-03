<?php

namespace App\Support;

/**
 * One published build, however we came to know about it.
 *
 * `live` is the honest bit: false means GitHub had nothing to give us and the
 * visitor is looking at the fallback from config. The download panel says so
 * rather than dressing a placeholder up as a release.
 */
final class Release
{
    /** @param  array<int, ReleaseAsset>  $assets */
    public function __construct(
        public readonly ?string $tag,
        public readonly ?string $name,
        public readonly ?\DateTimeImmutable $publishedAt,
        public readonly ?string $url,
        public readonly ?string $notes,
        public readonly array $assets = [],
        public readonly bool $live = false,
    ) {
    }

    public static function empty(): self
    {
        return new self(null, null, null, null, null, [], false);
    }

    /** Is there anything at all to offer the visitor? */
    public function exists(): bool
    {
        return $this->tag !== null || $this->url !== null;
    }

    public function asset(string $kind): ?ReleaseAsset
    {
        foreach ($this->assets as $asset) {
            if ($asset->kind === $kind) {
                return $asset;
            }
        }

        return null;
    }

    public function full(): ?ReleaseAsset
    {
        return $this->asset('full');
    }

    public function patch(): ?ReleaseAsset
    {
        return $this->asset('patch');
    }

    public function server(): ?ReleaseAsset
    {
        return $this->asset('server');
    }

    /** Total downloads across every asset. Only meaningful for a live release. */
    public function downloads(): int
    {
        return array_sum(array_map(fn (ReleaseAsset $a) => $a->downloads, $this->assets));
    }

    /** The one link that is always safe to send someone to. */
    public function landingUrl(): string
    {
        return $this->url
            ?: (config('stvr.github.fallback.url') ?: config('stvr.links.releases'));
    }
}
