<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Comic;
use App\Models\Volume;
use App\Models\Chapter;
use App\Models\Page;
use Session;
use App\Models\Tag;

class ChapterController extends Controller
{
    public function viewChapterReader(Comic $comic, Volume $volume, Chapter $chapter)
    {

        $pages =  Page::where('chapter_id', $chapter->id)->orderBy('fileName', 'asc')->with('media')->get();

        $nch = Chapter::where('number', '>', $chapter->number)->where('volume_id', $volume->id)->orderBy('id', 'asc')->first();
        $pch = Chapter::where('number', '<', $chapter->number)->where('volume_id', $volume->id)->orderBy('id', 'desc')->first();

        $nextChapter = null;
        $previousChapter = null;
        if ($nch != null) {
            $nextChapter =  route('reader.chapter.view', ['comic' => $comic->titleSlug, 'volume' =>  $nch->volume->number, 'chapter' => $nch->number]);
        }
        if ($pch != null) {
            $previousChapter   =  route('reader.chapter.view', ['comic' => $comic->titleSlug, 'volume' =>  $pch->volume->number, 'chapter' => $pch->number]);
        }


        return Inertia::render('Frontend/Comics/Reader/ViewChapter', [
            "pages" => $pages->map(function ($page) {
                return [
                    "id" => $page->id,
                    "fileName" => $page->fileName,
                    "url" => $page->getFirstMediaUrl('page'),
                    "thumb" => $page->getMedia('page')->map(function ($media) {
                        return [
                            'id' => $media->id,
                            'responsive' => $media()->attributes(['class' => 'w-full'])->toHtml(),
                            'alt' => $media->name,

                        ];
                    }),
                ];
            }),
            "chapter" => $chapter,
            "ctitle" => $comic->title,
            "c_vol_no" => $volume->number,
            "c_chap_no" => $chapter->number,
            "nextChapter" =>  $nextChapter,
            "previousChapter" => $previousChapter,
            "home" => route('reader.comic.view', ['comic' => $comic->titleSlug]),
        ]);
    }
}
