<?php

namespace App\Http\Controllers;

use App\Support\Devlog;
use App\Support\Nav;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    /**
     * The devlog as an Atom feed, one per language, for readers who would rather be told than come and look. Every
     * entry in full, newest first; written with XMLWriter so that a title or a summary can never break the XML.
     *
     * Readers poll it, so it carries a Last-Modified (the entry files', Devlog::lastModified) and a reader that
     * already has this version is answered 304 before a single entry is read or converted. A change to the feed's
     * own title or subtitle reaches readers with the next entry.
     */
    public function feed(Request $request): Response
    {
        $locale = app()->getLocale();
        $response = response('', 200, ['Content-Type' => 'application/atom+xml; charset=UTF-8'])->setCache([
            'private' => true, 'max_age' => 3600, 'last_modified' => $this->devlog->lastModified($locale),
        ]);

        if ($response->isNotModified($request)) {
            return $response;
        }

        $entries = $this->devlog->all($locale);
        $self = route("{$locale}.devlog.feed");
        $updated = $entries ? $entries[0]->date->format(DATE_ATOM) : now()->format(DATE_ATOM);

        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElementNs(null, 'feed', 'http://www.w3.org/2005/Atom');
        $xml->writeAttribute('xml:lang', $locale);
        $xml->writeElement('title', __('devlog.meta.title'));
        $xml->writeElement('subtitle', __('devlog.meta.description'));
        $xml->writeElement('id', $self);
        $xml->writeElement('updated', $updated);
        $xml->startElement('link');
        $xml->writeAttribute('rel', 'self');
        $xml->writeAttribute('href', $self);
        $xml->endElement();
        $xml->startElement('link');
        $xml->writeAttribute('rel', 'alternate');
        $xml->writeAttribute('href', Nav::url('devlog', $locale));
        $xml->endElement();
        $xml->startElement('author');
        $xml->writeElement('name', config('stvr.name'));
        $xml->endElement();

        foreach ($entries as $entry) {
            $url = Nav::url('devlog', $locale, ['slug' => $entry->slug]);
            // An entry with no translation yet is the English original: its xml:lang says so, and it opens with the
            // note its page shows, in the feed's language.
            $note = $entry->translated
                ? ''
                : '<p lang="'.$locale.'"><em>'.e(__('site.misc.not_translated')).'</em></p>';
            $xml->startElement('entry');
            if (! $entry->translated) {
                $xml->writeAttribute('xml:lang', Nav::fallback());
            }
            $xml->writeElement('title', $entry->title);
            $xml->writeElement('id', $url);
            $xml->startElement('link');
            $xml->writeAttribute('href', $url);
            $xml->endElement();
            $xml->writeElement('updated', $entry->date->format(DATE_ATOM));
            $xml->writeElement('published', $entry->date->format(DATE_ATOM));
            $xml->writeElement('summary', $entry->summary);
            foreach ($entry->tags as $tag) {
                $xml->startElement('category');
                $xml->writeAttribute('term', $tag);
                $xml->endElement();
            }
            $xml->startElement('content');
            $xml->writeAttribute('type', 'html');
            $xml->text($note.$entry->html());
            $xml->endElement();
            $xml->endElement();
        }

        $xml->endElement();

        return $response->setContent($xml->outputMemory());
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
