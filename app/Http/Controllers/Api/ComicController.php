<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Comic;
use App\Models\Volume;
use App\Models\Chapter;
use Session;
use App\Models\Tag;
use COM;

 
 
 
use App\Models\Page;
 
 
use Jaybizzle\LaravelCrawlerDetect\Facades\LaravelCrawlerDetect as Crawler;

class ComicController extends Controller
{
    public function viewComic(Comic  $comic)
    {
        Cache::flush();
        views($comic)
            ->cooldown(now()->addSeconds(2))
            ->collection('comics_homepage_view')
            ->record();
        //  Cache::forget('ads_comic');
        $ads_comic =  cache()->remember('api_ads_comic', now()->addMinutes(30), function () {
            $ads_above_comment = \App\Helpers\Advertisement::comicAboveComments();
            $ads_below_desc = \App\Helpers\Advertisement::comicBelowDescription();
            $ads_inside_content = \App\Helpers\Advertisement::comicInsideContent();
            $ads_below_content = \App\Helpers\Advertisement::comicBelowContent();
            $ads_below_title = \App\Helpers\Advertisement::comicBelowTitle();

            return [
                'ads_above_comment' => $ads_above_comment,
                'ads_below_desc' => $ads_below_desc,
                'ads_inside_content' => $ads_inside_content,
                'ads_below_content' => $ads_below_content,
                'ads_below_title' => $ads_below_title,

            ];
        });
       // Cache::forget('comic_' . $comic->titleSlug);

        $data =  cache()->remember('api_comic_' . $comic->titleSlug, now()->addMinutes(2), function () use ($comic) {
            $first_ch = null;
            if ($comic->volumes->count() != 0) {
                if($comic->volumes->first()->chapters->count()){
                $first_ch = ['comicSlug' => $comic->titleSlug, 'volumeNumber' => $comic->volumes->first()->number, 'chapterNumber' => $comic->volumes->first()->chapters->sortBy('number')->first()->number];
                }
            }

            $volume =  $comic->volumes->map(function ($volume) {
                return [
                    'chapters' => $volume->chapters->map(function ($c) {
                        return [
                            "number" => $c->number,
                            "name" => $c->name,
                            "id" => $c->id,
                            "url" => 'reader.chapter.view',
                        ];
                    })->sortBy('number') ->reverse()
                    ->values() ,
                    'name' => $volume->name,
                    'number' => $volume->number,
                    'id' => $volume->id,
                    'chapters_exist' => $volume->chapters->count() > 0

                ];
            }) ->reverse()
            ->values();

       
            $thumb =  $comic->getFirstMediaUrl('thumbnail');
 

            $comic_tags = $comic->tags->map(function ($tag) {

                return [

                    'name' => $tag->name,
                    'svg' => $tag->number,
                    'tagCode' => $tag->tagCode

                ];
            });
            $slug = $comic->titleSlug;

            $author = $comic->author->name;

            $artist = $comic->artist->name;

            $publisher = $comic->publisher->name;
            $data = array(
                [
                    "volumes" => $volume,
                    "thumb" => $thumb,
                    "first_ch" => $first_ch,
                    "comic_tags" => $comic_tags,
                    "author" => $author,
                    "artist" => $artist,
                    "publisher" => $publisher,
                    "slug" => $slug,
                ]
            );
            return $data;
        });
        //  return dd($data);
        return   [

            'comic' =>  [
                'id' => $comic->id,
                'title' => $comic->title,
                'viewUrl' => route('reader.comic.view', $comic->titleSlug),
                'description' => $comic->description,
                'created_at' => $comic->created_at,
                'updated_at' => $comic->updated_at,
                'isMature' => $comic->isMature,
                'isLocked' => $comic->isLocked,
                'author' => $data["0"]["author"],
                'artist' => $data["0"]["artist"],
                'publisher' => $data["0"]["publisher"],
                'tags' => $data["0"]["comic_tags"],
                'first_ch' => $data["0"]["first_ch"],
                'thumb' =>  $data["0"]["thumb"],
                 
                'volumes' => $data["0"]["volumes"],
                "titleSlug" => $data["0"]["slug"],

            ],   
            'ads_comic' => $ads_comic,

        ] ;
    }

    public function viewChapter(Comic $comic, Volume $volume, Chapter $chapter)
    {
        $crawler = false;
        views($chapter)
            ->cooldown(now()->addSeconds(2))
            ->collection('comics_chapter_view')
            ->record();
        if(Crawler::isCrawler()) {
                // true if crawler user agent detected
                $crawler = true;
              }

        $data =  cache()->remember('api_comic_' . $comic->titleSlug . $volume->id . $chapter->id, now()->addMinutes(2), function () use ($chapter, $volume, $comic) {
            $pages =  Page::where('chapter_id', $chapter->id)->orderBy('fileName', 'asc')->with('media')->get();

            $nch = Chapter::where('number', '>', $chapter->number)->where('volume_id', $volume->id)->orderBy('number', 'asc')->first();
            $pch = Chapter::where('number', '<', $chapter->number)->where('volume_id', $volume->id)->orderBy('number', 'desc')->first();

            $nextChapter = null;
            $previousChapter = null;
            if ($nch != null) {
                $nextChapter =  ['comic' => $comic->titleSlug, 'volume' =>  $nch->volume->number, 'chapter' => $nch->number];
            }
            if ($pch != null) {
                $previousChapter   =  ['comic' => $comic->titleSlug, 'volume' =>  $pch->volume->number, 'chapter' => $pch->number];
            }
            $pages_data = $pages->map(function ($page) {
                return [
                    "id" => $page->id,
                    "fileName" => $page->fileName,
                    "thumb" => $page->getFirstMediaUrl('page'),
                     
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
        //Cache::forget('ads_reader');
        $ads_reader =  cache()->remember('api_ads_reader', now()->addMinutes(30), function () {
            $ads_reader_above_content = \App\Helpers\Advertisement::readerAboveContent();
            $ads_reader_below_content = \App\Helpers\Advertisement::readerBelowContent();
            $ads_reader_inside_content = \App\Helpers\Advertisement::readerInsideContent();


            return [
                'ads_reader_inside_content' => $ads_reader_inside_content,
                'ads_reader_below_content' => $ads_reader_below_content,
                'ads_reader_above_content' => $ads_reader_above_content,
            ];
        });


        return  [
            "pages" =>   $data["0"]["pages_data"],
            "ch_id" => $chapter->id,
            "ch_name" => $chapter->name,
            "ch_isLocked" => $chapter->isLocked,
            "ch_no" => $chapter->number,

            "comic_titleSlug" => $comic->titleSlug,
            "comic_title" => $comic->title,
            "comic_ID" => $comic->id,

            "vol_no" => $volume->number,
            "vol_ID" => $volume->id,
            
            "nextCh" =>  $data["0"]["nextChapter"],
            "prevCh" => $data["0"]["previousChapter"],
            'ads_reader' => $ads_reader,
            'crawler_detected' => $crawler,

        ] ;
    }
}
