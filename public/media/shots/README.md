# Screenshots

Drop image files in this folder and they appear on the home page, in order, with
no code change and no deploy step.

**Naming:** `NN-slug.ext` — the number orders them, the slug names them.

```
01-two-on-the-road.jpg
02-riften-market.jpg
03-dragon-at-the-throat.webp
```

`.jpg`, `.jpeg`, `.png`, `.webp` and `.avif` all work. Aim for about 1600px wide;
anything much larger is bandwidth nobody asked for.

**Captions** are optional. To add one, put it under the slug in every language:

```php
// lang/en/shots.php
'captions' => [
    'riften-market' => 'Two players, one market, and nobody has fallen through the floor yet.',
],
```

Without a caption the image stands on its own, and the slug becomes its alt text.

**With this folder empty**, the home page shows the illustrated scene instead and
reads as finished either way — which is the point. Nothing here is required.
