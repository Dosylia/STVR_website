{{-- The closing call to action. Every page ends with one, and no two pages end
     with the same one — the install guide sends you to hosting, hosting sends
     you back to the download. --}}
@props(['title', 'body', 'primary', 'primaryUrl', 'secondary' => null, 'secondaryUrl' => null])
<section class="closer">
    <div class="shell">
        <div class="rule" aria-hidden="true"><span class="rule__mark"></span></div>
        <h2>{{ $title }}</h2>
        <p class="lede">{{ $body }}</p>
        <div class="btn-row btn-row--center">
            <a class="btn btn--forge" href="{{ $primaryUrl }}">
                @include('partials.icon', ['name' => 'arrow'])
                {{ $primary }}
            </a>
            @if ($secondary)
                <a class="btn btn--ghost" href="{{ $secondaryUrl }}">{{ $secondary }}</a>
            @endif
        </div>
    </div>
</section>
