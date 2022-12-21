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

    $pages =  Page::where('chapter_id', $chapter->id)->orderBy('fileName', 'asc')->get();

    return Inertia::render('Frontend/Comics/Reader/ViewChapter', [
      "pages" => $pages->map(function ($page) {
        return [
          "id" => $page->id,
          "fileName" => $page->fileName,
          "chapter_id" => $page->chapter_id,
          "chapter" => $page->chapter,
          "url" => $page->getFirstMediaUrl('page'),
        ];
      }),
      "chapter" => $chapter,
      "volume" => $volume,
      "comic" => $comic,
      "nextChapter" => Chapter::where('number', '>', $chapter->number)->where('volume_id', $volume->id)->orderBy('id', 'asc')->first(),
      "previousChapter" => Chapter::where('number', '<', $chapter->number)->where('volume_id', $volume->id)->orderBy('id', 'desc')->first(),
    ]);
  }
}
