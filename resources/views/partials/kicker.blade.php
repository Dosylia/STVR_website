{{-- The line above a page title, set like an epigraph: italic, after a short
     gold rule. A " · " in the copy becomes the lozenge from the sigil's crown,
     so the separator is this site's own mark rather than a typed dot. --}}
@php
    $tag = $tag ?? 'p';
    $parts = array_values(array_filter(array_map('trim', explode('·', (string) $text)), 'strlen'));
@endphp
<{{ $tag }} class="hero__kicker">@foreach ($parts as $i => $part)@if ($i)<span class="hero__kicker-mark" aria-hidden="true"></span><span class="sr-only">, </span>@endif<span>{{ $part }}</span>@endforeach</{{ $tag }}>
