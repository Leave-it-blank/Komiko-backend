<?php

namespace App\Http\Controllers\Backend\ComicsManagement;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Comic;
use App\Models\Page;
use App\Models\Volume;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
class ChaptersController extends Controller
{

    use AuthorizesRequests;
    public function uploadChapter(Chapter $chapter, Request $request)
    {
       // $this->authorize('handle comic management',    Auth::user());
        $valcomic =  $this->validate($request, [
            'file' => 'mimes:jpg,png,jpeg,gif',
        ]);
/*         $page = Page::create([
            'fileName' => $valcomic["file"]->getClientOriginalName(),
            'fileSize' => 0,
            'fileUrl' => '$thumbnail_url',
            'chapter_id' => $chapter->id
        ]); */


        if ($request->hasFile('file')) {
            try {

                $extension = $valcomic["file"]->getClientOriginalName();
                //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
                $valcomic["file"]->storeAs('/public/temp/comic/' ,$extension);
                $thumbnail_url = '/public/temp/comic/' . $extension;
                $page = Page::create([
                    'fileName' => $extension,
                    'fileSize' => $valcomic["file"]->getSize(),
                    'fileUrl' => $thumbnail_url,
                    'chapter_id' => $chapter->id
                ]);
                $page->addMediaFromDisk($thumbnail_url)
                    ->toMediaCollection('page');
                //$comic->save();

                return response(  201);
            } catch (\Exception $e) {
                //return dd($e);
                // $this->emit('Danger_alert',   'Image upload failed~');
                // $this->error = 'Image upload failed~';
                //$Tcomic->delete();
                // $Tcomic->getFirstMedia('thumbnail')->delete();

                throw $e;
                return response( 403);
            }
            return response(  200);
        }

        return response( 400);
    }

    public function storeChapter(Volume $volume, Request $request)
    {
        $this->authorize('handle comic management',    Auth::user());
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
          return   Redirect::route('comics_management.volume.view',   $volume->id)->with('message', 'Chapter Successfully Created.');
        }
        catch(\Exception $e){
               // $this->emit('Danger_alert',   'Something went wrong~ Try again~');
             //   $this->error = 'Something went wrong! try again~';
                //  return dd($e);
                Redirect::route('comics_management.volume.view',   $volume->id)->with('error', 'Chapter Not Created.');
                throw $e;
            }
        //$this->reset();
    }

    public function createVolumeStore(Comic $comic ,Request $request )
    {
        $this->authorize('handle comic management',    Auth::user());
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
           return Redirect::route('comics_management.comics.view',   $comic->id)->with('message', 'Volume Successfully Created.');

        }
        catch(\Exception $e){
           //     $this->emit('Danger_alert',   'Something went wrong~ Try again~');
             //   $this->error = 'Something went wrong! try again~';
              //dd($e);
              Redirect::route('comics_management.comics.view',   $comic->id)->with('error', 'Volume Not Created.');
             throw $e;
            }
        //$this->reset();

    }
    public function viewVolume(Volume $volume)
    {
        $this->authorize('view comic management',    Auth::user());
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

            'chapters' =>   Chapter::Where('volume_id', $volume->id)->orderBy('name', 'desc')->get()->map(function ($chapter) {
                return [
                'id' => $chapter->id,
                'name' => $chapter->name,
                'number' => $chapter->number,
                'isLocked' => $chapter->isLocked,
                'editUrl' => 'comics_management.chapter.view',
                'viewUrl' => 'comics_management.chapter.view',
                'createdAt' => $chapter->created_at,
                'updatedAt' => $chapter->updated_at,
                ];
            })->toArray(),

        ]);
    }
    public function deleteChapter(Chapter $chapter)
    {
        $this->authorize('handle comic management',    Auth::user());
       // dd($chapter);
       try{
        $chapter->delete();
         return redirect()->back()->with('error', 'Deleted Successfully.');
       }catch( \Exception $e){
            throw $e;
       }
    }
    public function deleteVolume(Volume $volume)
    {
        $this->authorize('handle comic management',    Auth::user());
       try{
        $volume->delete();
        return redirect()->back()->with('error', 'Deleted Successfully.');
       }catch( \Exception $e){
            throw $e;
       }
    }
    public function deletePage(Page $page)
    {
        $this->authorize('handle comic management',    Auth::user());
      //  dd($page);
       try{
        $page->delete();
        return redirect()->back()->with('error', 'Deleted Successfully.');
       }catch( \Exception $e){
            throw $e;
       }
    }

    public function viewChapter(Chapter $chapter)
    {
        $this->authorize('view comic management',    Auth::user());
        return Inertia::render('Backend/ComicsManagement/Chapters/Actions/viewChapter', [
            'chapter' => [
                'id' => $chapter->id,
                'name' => $chapter->title,
                'number' => $chapter->number,
                'createdAt' => $chapter->created_at,
                'updatedAt' => $chapter->updated_at,
                'comic_title' => $chapter->volume->comic->title,
                'volume_id' => $chapter->volume_id,
                'volume_number' => $chapter->volume->number
            ],

            'pages' =>   Page::Where('chapter_id', $chapter->id)->orderBy('fileName', 'asc')->get()->map(function ($page) {
                return [
                'id' => $page->id,
                'fileName' => $page->fileName,
                'fileSize' => $page->fileSize,
                'viewUrl' => route('comics_management.page.view', $page),
                'createdAt' => $page->created_at,
                'updatedAt' => $page->updated_at,
                ];
            })->toArray(),
            'crftoken' => csrf_token()

        ]);
    }

    public function viewPage(Page $page)
    {
        return redirect($page->getFirstMediaUrl('page'));
    }

}
