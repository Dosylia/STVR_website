{{-- Discord and support, side by side. Shown where people either get stuck
     (install, hosting) or have just been given something for free (home,
     download). Each panel exists only when its link is set in .env, and the
     section disappears entirely when neither is. --}}
@php
    use App\Support\Nav;
    $discord = Nav::link('discord');
    $support = Nav::link('support');
@endphp
@if ($discord || $support)
<section class="section section--tight">
    <div class="shell">
        <div class="community {{ $discord && $support ? '' : 'community--single' }} reveal">
            @if ($discord)
                <div class="community__panel community__panel--discord">
                    @include('partials.icon', ['name' => 'discord', 'class' => 'community__glyph'])
                    <p class="inscription">{{ __('site.community.label') }}</p>
                    <h2 class="community__title">{{ __('site.community.discord_title') }}</h2>
                    <p class="community__body">{{ __('site.community.discord_body') }}</p>
                    <a class="btn community__btn community__btn--discord" href="{{ $discord }}" rel="noopener">
                        @include('partials.icon', ['name' => 'discord'])
                        {{ __('site.community.discord_cta') }}
                    </a>
                </div>
            @endif
            @if ($support)
                <div class="community__panel community__panel--support">
                    @include('partials.icon', ['name' => 'heart', 'class' => 'community__glyph'])
                    <p class="inscription">{{ __('site.cta.support') }}</p>
                    <h2 class="community__title">{{ __('site.community.support_title') }}</h2>
                    <p class="community__body">{{ __('site.community.support_body') }}</p>
                    <a class="btn btn--forge community__btn" href="{{ $support }}" rel="noopener">
                        @include('partials.icon', ['name' => 'heart'])
                        {{ __('site.community.support_cta') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
