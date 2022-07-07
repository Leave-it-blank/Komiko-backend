<?php

namespace App\Http\Controllers\Backend\ComicsManagement;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
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

    public function storeChapter(Volume $volume, Request $request)
    {
        $chapterdata =  $this->validate($request, [
            'name' => 'required|min:1|max:255|string',
            //  'upload_date' => 'string',
            'number' => 'required|min:0|max:4000|int',
            'isLocked' => 'required|boolean'
        ]);
        //$this->authorize('comic_management_create',  User::class);
        try {
            $chapter = Chapter::create([
                'name' => $chapterdata["name"],
                'number' => $chapterdata["number"],
                'isLocked' => $chapterdata["isLocked"],
                'volume_id' => $volume->id
            ]);
          return   Redirect::route('comics_management.volume.view',   $volume->id);
        }
        catch(\Exception $e){
               // $this->emit('Danger_alert',   'Something went wrong~ Try again~');
             //   $this->error = 'Something went wrong! try again~';
                //  return dd($e);
                Redirect::route('comics_management.volume.view',   $volume->id);
                throw $e;
            }
        //$this->reset();
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
        return Inertia::render('Backend/ComicsManagement/Volumes/Actions/viewVolume', [
            'volume' => [
                'id' => $volume->id,
                'name' => $volume->title,
                'number' => $volume->number,
                'createdAt' => $volume->created_at,
                'updatedAt' => $volume->updated_at,
                'comic_title' => $volume->comic->title,
                'comic_id' => $volume->comic_id
            ],

            'chapters' =>   Chapter::Where('volume_id', $volume->id)->get()->map(function ($chapter) {
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
    public function deleteChapter(Chapter $chapter)
    {
       // dd($chapter);
       try{
        $chapter->delete();
         return redirect()->back();
       }catch( \Exception $e){
            throw $e;
       }
    }
    public function deleteVolume(Volume $volume)
    {
       try{
        $volume->delete();
        return redirect()->back();
       }catch( \Exception $e){
            throw $e;
       }
    }

}
