<?php

namespace App\Http\Controllers;

use App\Support\Devlog;
use App\Support\Nav;
use App\Support\ReleaseService;
use App\Support\Shots;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(
        private readonly ReleaseService $releases,
        private readonly Devlog $devlog,
        private readonly Shots $shots,
    ) {
    }

    /** "/" belongs to no language, so it only ever redirects. */
    public function root(Request $request)
    {
        $locale = Nav::negotiate($request->header('Accept-Language'));

        return redirect(Nav::url('home', $locale), 302);
    }

    public function home(): View
    {
        return $this->page('pages.home', 'home', [
            'release' => $this->releases->latest(),
            'entries' => $this->devlog->latest(app()->getLocale(), 3),
            'shots'   => $this->shots->all(),
        ]);
    }

    public function download(): View
    {
        return $this->page('pages.download', 'download', [
            'release' => $this->releases->latest(),
        ]);
    }

    public function install(): View
    {
        return $this->page('pages.install', 'install', [
            'release' => $this->releases->latest(),
        ]);
    }

    public function host(): View
    {
        return $this->page('pages.host', 'host');
    }

    public function faq(): View
    {
        return $this->page('pages.faq', 'faq');
    }

    public function roadmap(): View
    {
        return $this->page('pages.roadmap', 'roadmap');
    }

    /**
     * Everything a layout needs that is not specific to one page: which page we
     * are on (so the nav can mark it and the switcher can stay put) and the
     * list of equivalent URLs in the other languages.
     */
    private function page(string $view, string $key, array $data = []): View
    {
        return view($view, array_merge([
            'page'       => $key,
            'alternates' => Nav::alternates($key),
        ], $data));
    }
}
