<?php

namespace App\Http\Controllers;

use App\Support\Devlog;
use App\Support\HubStats;
use App\Support\LauncherDownload;
use App\Support\Nav;
use App\Support\PublicServer;
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
        private readonly LauncherDownload $launcher,
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
            'launcherBuild' => $this->launcher->current(),
            'entries' => $this->devlog->latest(app()->getLocale(), 3),
            'shots'   => $this->shots->all(),
        ]);
    }

    public function download(): View
    {
        $build = $this->launcher->current();

        return $this->page('pages.download', 'download', [
            'release'  => $this->releases->latest(),
            'launcher' => $this->launcher->asset(),
            'launcherBuild' => $build,
            // The count sits on the launcher's card: with no launcher to download, the hub is not asked.
            'launcherDownloads' => $build ? HubStats::launcherDownloads() : null,
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

    public function privacy(): View
    {
        return $this->page('pages.privacy', 'privacy');
    }

    public function publicServer(PublicServer $server): View
    {
        return $this->page('pages.public', 'public', [
            'status' => $server->status(),
        ]);
    }

    /** What the page needs to redraw itself, and nothing else. */
    public function publicServerStatus(PublicServer $server): \Illuminate\Http\JsonResponse
    {
        $s = $server->status();

        return response()->json([
            'online'    => $s['online'],
            'count'     => $s['count'],
            'max'       => $s['max'],
            'hidden'    => $s['hidden'],
            'maps'      => $s['maps'],
            'updatedAt' => $s['updatedAt'],
            'players'   => array_map(fn ($p) => [
                'id'      => $p['id'],
                'name'    => $p['name'],
                'where'   => $p['where'],
                'map'     => $p['map'],
                'area'    => $p['area'],
                'point'   => $p['point'],
                'heading' => $p['heading'],
            ], $s['players']),
        ])->header('Cache-Control', 'public, max-age=5');
    }

    public function legal(): View
    {
        return $this->page('pages.legal', 'legal');
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
