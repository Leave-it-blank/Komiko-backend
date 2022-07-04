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

    public function createVolume(Comic $comic ,Request $request )
    {

       // dd($comic);
        $volume_c =  $this->validate($request, [
            'name' => 'required|min:2|max:255|string',
            //  'upload_date' => 'string',
            'number' => 'required|min:1|max:4000|int',
        ]);


     //   $this->authorize('comic_management_create',  User::class);
        try {
            $volume = Volume::create([
                'name' => $volume_c["name"],
                'number' => $volume_c["number"],
                'comic_id' => $comic->id
            ]);
            $volume->save();
            Redirect::route('comics_management.comics.view',   $comic->id);

        }
        catch(\Exception $e){
           //     $this->emit('Danger_alert',   'Something went wrong~ Try again~');
             //   $this->error = 'Something went wrong! try again~';
             // dd($e);
             throw $e;
            }
        //$this->reset();

    }

}
