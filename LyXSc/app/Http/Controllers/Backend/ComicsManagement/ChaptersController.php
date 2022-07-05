<?php

namespace App\Http\Controllers\Backend\ComicsManagement;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Volume;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
class ChaptersController extends Controller
{

    use AuthorizesRequests;
    public function uploadChapter()
    {
        return Inertia::render('Backend/ComicsManagement/Chapters/Actions/UploadChapter', [
            'comics' => Comic::all()->map(function ($e) {
                return [
                    'id' => $e->id,
                    'name' => $e->title,
                ];
            })->toArray(),
        ]);
    }

    public function storeChapter(Comic $comic, Request $request)
    {
        dd($comic);
        $request;
        # code...
    }

    public function createVolumeStore(Comic $comic ,Request $request )
    {

       //  dd($request);
        $volume_c =  $this->validate($request, [
            'name' => 'required|min:1|max:255|string',
            //  'upload_date' => 'string',
            'number' => 'required|min:0|max:4000|int',
        ]);
       // dd($volume_c);

     //   $this->authorize('comic_management_create',  User::class);
        try {
            $volume = Volume::create([
                'name' => $volume_c["name"],
                'number' => $volume_c["number"],
                'comic_id' => $comic->id
            ]);
           // $volume->save();
           //redirect('welcome');
           return Redirect::route('comics_management.comics.view',   $comic->id);

        }
        catch(\Exception $e){
           //     $this->emit('Danger_alert',   'Something went wrong~ Try again~');
             //   $this->error = 'Something went wrong! try again~';
              //dd($e);
              Redirect::route('comics_management.comics.view',   $comic->id);
             throw $e;
            }
        //$this->reset();

    }
    public function viewVolume(Volume $volume)
    {
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/viewComic', [
            'volume' => [
                'id' => $volume->id,
                'title' => $volume->title,
                'isHidden' => $volume->isHidden,
                'isMature' => $volume->isMature,
                'isLocked' => $volume->isLocked,
                'createdAt' => $volume->created_at,
                'updatedAt' => $volume->updated_at,
            ],

            'chapters' =>   Volume::Where('comic_id', $volume->id)->get()->map(function ($chapter) {
                return [
                    'id' => $chapter->id,
                'name' => $chapter->name,
                'number' => $chapter->number,
                'isLocked' => $chapter->isLocked,
                'editUrl' => 'comics_management.volume.view',
                'viewUrl' => 'comics_management.volume.view',
                'createdAt' => $chapter->created_at,
                'updatedAt' => $chapter->updated_at,
                ];
            })->toArray(),

        ]);
    }

}
