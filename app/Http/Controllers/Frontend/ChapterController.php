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
use Session;
use App\Models\Tag;

class ChapterController extends Controller
{
    public function viewChapterReader( $uid, Chapter $chapter)
    {
          if($uid == Session::getId()){

           return Inertia::render('Frontend/Comics/Reader/ViewChapter', [
            'chapter' => $chapter,
             'pages' => $chapter->pages->map(function ($page)
             {
               return [ 'page_url' => $page->getPage()];
             }),
            ]);
          }
        return 'request expired, please go back to homepage.';
    }
}
