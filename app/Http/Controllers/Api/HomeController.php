<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
 
use App\Models\Carousel;
 
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Comic;
use App\Models\Volume;
use App\Models\Chapter;
use Session;
use Illuminate\Support\Collection;
use App\Enums\Advertisements;
use Illuminate\Pagination\Paginator;
use App\Models\Advertisement as AdvertModel;
use Response;
class HomeController extends Controller
{
   public function viewHome()
   {
    // Cache::flush();

    $ads_home =  cache()->remember('ads_homepage_api', now()->addMinutes(30), function () {
        $ads_above_rec = \App\Helpers\Advertisement::aboveRecommended();
        $ads_below_rec = \App\Helpers\Advertisement::belowRecommended();

        return [
            'above_rec' => $ads_above_rec,
            'below_rec' => $ads_below_rec,
        ];
    });


    //Latests
    $latest = cache()->remember('latest_comics_api', now()->addMinutes(2), function () {
        return  Chapter::with('volume', 'volume.comic', 'volume.comic.media')->whereHas('volume.comic', function ($c) {
            $c->where('isHidden', false);
        })->orderBy('updated_at', 'desc')->take(10)->get()->map(function ($chapter) {
            return [
                'comic_id' => $chapter->volume->comic->id,
                'ch_number' => $chapter->number,
                'vol_number' => $chapter->volume->number,
                'ch_name' => $chapter->name,
                'comic_title' => $chapter->volume->comic->title,
                'comic_viewUrl' => route('reader.comic.view', $chapter->volume->comic->titleSlug),
                'ch_viewUrl' =>  route('reader.chapter.view', ['comic' => $chapter->volume->comic->titleSlug, 'volume' => $chapter->volume->number, 'chapter' => $chapter->number]),
                'comic_titleslug' => $chapter->volume->comic->titleSlug,
                'comic_isMature' => $chapter->volume->comic->isMature,
                'comic_isLocked' => $chapter->volume->comic->isLocked,
                'comic_createdAt' => $chapter->volume->comic->created_at,
                'comic_updatedAt' => $chapter->volume->comic->updated_at,
                'comic_type' => $chapter->volume->comic->type,
                'comic_choice' => $chapter->volume->comic->choice,
                'comic_thumb' => $chapter->volume->comic->getFirstMediaUrl('thumbnail') 

            ];
        })->toArray();
    });
  

    $carousel = cache()->remember('carousel_api', now()->addMinutes(20), function () {
        return  Carousel::where('is_enabled', true)->orderBy('position', 'asc')->get()->map(function ($carousel) {
            return [

                'img' => $carousel-> getFirstMediaUrl('carousel') ,
                'position' => $carousel->position,
                'url' => $carousel->url
            ];
        });
    });
    //recommended HOT UPDATES
    $recommended = cache()->remember('hot_updates_api', now()->addMinutes(5), function () {
        return  Comic::where('isHidden', false)->with('media')->withCount('chapters')->orderByViews('asc')->take(10)->get()->map(function ($comic) {
            return [
                'comic_id' => $comic->id,
                'comic_title' => $comic->title,
                'comic_viewUrl' => route('reader.comic.view', $comic->titleSlug),
                'comic_titleslug' => $comic->titleSlug,
                'comic_isMature' => $comic->isMature,
                'comic_isLocked' => $comic->isLocked,
                'comic_createdAt' => $comic->created_at,
                'comic_updatedAt' => $comic->updated_at,
                'comic_type' => $comic->type,
                'comic_choice' => $comic->choice,
                'comic_thumb' => $comic->getFirstMediaUrl('thumbnail') ,
                'ch_count' => $comic->chapters_count,


            ];
        })->toArray();
    });

   
    return [
      
            'latest' => $latest,
            'recommended' =>   $recommended,
            'slider' =>   $carousel,
            'ads' => $ads_home,
    
    ];
     
}



public function viewLatest()
{
        $data = Chapter::with('volume', 'volume.comic', 'volume.comic.media')->whereHas('volume.comic', function ($c) {
            $c->where('isHidden', false);
        })->orderBy('updated_at', 'desc')->get()
        ->map(function ($chapter) {
            return [
                    'ch_id' =>$chapter->id,
                    'ch_number' =>$chapter->number,
                    'ch_created_at' =>$chapter->created_at,

                    'vol_id' =>$chapter->volume->id,
                    'vol_number' =>$chapter->volume->number,
                    'vol_created_at' =>$chapter->volume->created_at,

                    'comic_id' => $chapter->volume->comic->id,
                    'comic_title' => $chapter->volume->comic->title,
                    'comic_titleSlug' => $chapter->volume->comic->titleSlug,
                    'comic_choice' =>$chapter->volume->comic->choice,
                    'comic_type' => $chapter->volume->comic->type,
                    'comic_isMature' => $chapter->volume->comic->isMature,
                    'comic_status' => $chapter->volume->comic->status,
                    'comic_thumb' => $chapter->volume->comic->getFirstMediaUrl('thumbnail'),
                    
            ];
        });
        $data = $data->paginate(15);
        $data->withPath('');
    return   [
        'chapters' =>  $data ,
    ];
}

public function viewComics()
{  
        $data = Comic::where('isHidden', false)->with('media')->withCount('chapters')->orderBy('title')->get()->map(function ($comic) {
            return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'titleSlug' => $comic->titleSlug,
                     
                    'created_at' =>$comic->created_at,
                    'choice' =>$comic->choice,
                    'chapterCount' =>$comic->chapters_count,
                    'type' => $comic->type,
                    'isMature' => $comic->isMature,
                    'status' => $comic->status,
                    'thumb' => $comic->getFirstMediaUrl('thumbnail'),
                    
            ];
        });
        $data = $data->paginate(15);
        $data->withPath('');
    return   [
        'comics' => $data  ,
    ] ;
}
}
