<?php

namespace App\Http\Controllers;

use App\Support\Devlog;
use App\Support\Nav;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DevlogController extends Controller
{
    public function __construct(private readonly Devlog $devlog)
    {
    }

    public function index(): View
    {
        return view('devlog.index', [
            'page'       => 'devlog',
            'alternates' => Nav::alternates('devlog'),
            'entries'    => $this->devlog->all(app()->getLocale()),
        ]);
    }

    public function show(string $slug): View
    {
        $entry = $this->devlog->find(app()->getLocale(), $slug);

        if ($entry === null) {
            throw new NotFoundHttpException();
        }

        $entries = $this->devlog->all(app()->getLocale());
        $index = array_search($entry, $entries, true);

        return view('devlog.show', [
            'page'       => 'devlog',
            // The slug is the same in every language, so an entry read in French
            // has a real German counterpart to offer rather than a dead link.
            'alternates' => Nav::alternates('devlog', ['slug' => $slug]),
            'entry'      => $entry,
            'newer'      => $index > 0 ? $entries[$index - 1] : null,
            'older'      => $entries[$index + 1] ?? null,
        ]);
    }
}
