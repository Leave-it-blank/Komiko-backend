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
        views($chapter)
            ->collection('comics_chapter_view')
            ->record();
        $data =  cache()->remember('comic_' . $comic->titleSlug . $volume->id . $chapter->id, now()->addMinutes(2), function () use ($chapter, $volume, $comic) {
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
            $pages_data = $pages->map(function ($page) {
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
            });
            $data = array(
                [
                    "pages_data" => $pages_data,
                    "nextChapter" => $nextChapter,
                    "previousChapter" => $previousChapter,
                ]
            );
            return $data;
        });
        Cache::forget('ads_reader');
        $ads_reader =  cache()->remember('ads_reader', now()->addMinutes(30), function () {
            $ads_reader_above_content = \App\Helpers\Advertisement::readerAboveContent();
            $ads_reader_below_content = \App\Helpers\Advertisement::readerBelowContent();
            $ads_reader_inside_content = \App\Helpers\Advertisement::readerInsideContent();


            return [
                'ads_reader_inside_content' => $ads_reader_inside_content,
                'ads_reader_below_content' => $ads_reader_below_content,
                'ads_reader_above_content' => $ads_reader_above_content,
            ];
        });


        return Inertia::render('Frontend/Comics/Reader/ViewChapter', [
            "pages" =>   $data["0"]["pages_data"],
            "chapter" => $chapter,
            "ctitle" => $comic->title,
            "cdesc" => $comic->description,
            "c_vol_no" => $volume->number,
            "c_chap_no" => $chapter->number,
            "nextChapter" =>  $data["0"]["nextChapter"],
            "previousChapter" => $data["0"]["previousChapter"],
            "home" => route('reader.comic.view', ['comic' => $comic->titleSlug]),
            'ads_reader' => $ads_reader,

        ]);
    }
}
