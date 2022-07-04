<?php

namespace App\Http\Controllers\Backend\ComicsManagement;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Author;
use App\Models\Comic;
use App\Models\Country;
use App\Models\Publisher;
use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Chapter;
use App\Models\Volume;
class ComicsController extends Controller
{
    use AuthorizesRequests;
    public function getComics()
    {
        //return 'hi';
        return Inertia::render('Backend/ComicsManagement/Comics/ComicsList', [
            'comics' => Comic::all()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'editUrl'=> 'comics_management.comics.edit',
                    'viewUrl'=> 'comics_management.comics.view',
                    'isHidden' => $comic->isHidden,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,
                ];
            })->toArray(),

        ]);
    }

    public function createComics()
    {
        //return 'hi';
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/CreateComic', [
            'tags' => Tag::all()->map(function ($e) {
                return [
                    'id' => $e->id,
                    'name' => $e->name,
                ];
            })->toArray(),

            'countries' => Country::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),

            'publishers' => Publisher::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'authors' => Author::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'artists' => Artist::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
        ]);
    }

    public function storeComic(Request $request)
    {

         $comic =  $this->validate($request, [
            'title' => 'required|min:2|max:255|string',
            //  'upload_date' => 'string',
            'desc' => 'required|min:20|max:4000|string',
            'isHidden' => 'bool|required',
            'isLocked' => 'bool|required',
            'isMature' => 'bool|required',
            'thumb' => 'mimes:jpg,png,jpeg,gif|required|dimensions:min_width=230,min_height=350, max_width=450,max_height=650',
            'author' => 'int|required',
            'artist' => 'int|required',
            'publisher' => 'int|required',
            'country' => 'int|required',
            'tags' => 'array|nullable'
        ]);
      //dd($comic);


        $uid = Str::uuid();
        try{

            $Tcomic = Comic::create([
                'title' => $comic["title"],
                //'upload_date' => 'string',
                'description' => $comic["desc"],
                'isHidden' => $comic["isHidden"],
                'isLocked' => $comic["isLocked"],
                'isMature' => $comic["isMature"],
                //'thumbnail_url' => $this->thumbnail_url,
                'author_id' => $comic["author"],
                'artist_id' => $comic["artist"],
                'publisher_id' => $comic["publisher"],
                'country_id' => $comic["country"],
                'uid' => $uid,

            ]);
            $Tcomic->save();
            $Tcomic->tags()->attach($comic["tags"]);
            Cache::flush();

        }
        catch(\Exception $e){
            //$this->emit('Danger_alert',   'Something went wrong~ Try again~');
            //$this->error = 'Error Creating comic, validation issue most likely. Contact @leaveitblank';

            throw $e;
            // return dd($e);
        }
        try{
            $extension = $comic["thumb"]->extension();
            //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
            $comic["thumb"]->storeAs('/public/temp/cover/', $uid.'.'.$extension);
            $thumbnail_url = '/public/temp/cover/'.$uid.'.'.$extension;
            $Tcomic->addMediaFromDisk($thumbnail_url)
                ->toMediaCollection('thumbnail');
            $Tcomic->save();

             return redirect(route('comics_management.comics'));

        }
        catch(\Exception $e){
            //return dd($e);
           // $this->emit('Danger_alert',   'Image upload failed~');
           // $this->error = 'Image upload failed~';
            $Tcomic->delete();
            throw $e;
        }

    }



    public function editComics(Comic $comic)
    {
        //return 'hi';
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/EditComic', [
            'tags' => Tag::all()->map(function ($e) {
                return [
                    'id' => $e->id,
                    'name' => $e->name,
                ];
            })->toArray(),

            'countries' => Country::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),

            'publishers' => Publisher::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'authors' => Author::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'artists' => Artist::all()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'comic' => $comic->toArray(),
            'comic_tags' => $comic->tags->pluck('id')
        ]);
    }

    public function editStoreComic(Comic $comic,Request $request )
    {

         // dd($comic);
         $valcomic =  $this->validate($request, [
            'title' => 'required|min:2|max:255|string',
            //  'upload_date' => 'string',
            'desc' => 'required|min:20|max:4000|string',
            'isHidden' => 'bool|required',
            'isLocked' => 'bool|required',
            'isMature' => 'bool|required',
            'thumb' => 'mimes:jpg,png,jpeg,gif|dimensions:min_width=230,min_height=350, max_width=450,max_height=650|nullable',
            'author' => 'int|required',
            'artist' => 'int|required',
            'publisher' => 'int|required',
            'country' => 'int|required',
            'tags' => 'array|nullable'
        ]);

        try{

            $comic->update([
                'title' => $valcomic["title"],
                //'upload_date' => 'string',
                'description' => $valcomic["desc"],
                'isHidden' => $valcomic["isHidden"],
                'isLocked' => $valcomic["isLocked"],
                'isMature' => $valcomic["isMature"],
                //'thumbnail_url' => $this->thumbnail_url,
                'author_id' => $valcomic["author"],
                'artist_id' => $valcomic["artist"],
                'publisher_id' => $valcomic["publisher"],
                'country_id' => $valcomic["country"],

            ]);

            $comic->tags()->sync($valcomic["tags"]);
            Cache::flush();

        }
        catch(\Exception $e){
            //$this->emit('Danger_alert',   'Something went wrong~ Try again~');
            //$this->error = 'Error Creating comic, validation issue most likely. Contact @leaveitblank';

            throw $e;
            // return dd($e);
        }
        if($request->hasFile('thumb')){
            try{
                $imagecomic = $comic->getFirstMedia('thumbnail');
                if(!$imagecomic == null){
                    $imagecomic->delete();
                }

                $extension = $valcomic["thumb"]->extension();
                //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
                $valcomic["thumb"]->storeAs('/public/temp/cover/', $comic->uid.'.'.$extension);
                $thumbnail_url = '/public/temp/cover/'.$comic->uid.'.'.$extension;
                $comic->addMediaFromDisk($thumbnail_url)
                    ->toMediaCollection('thumbnail');
                //$comic->save();

                 return redirect(route('comics_management.comics'));

            }
            catch(\Exception $e){
                //return dd($e);
               // $this->emit('Danger_alert',   'Image upload failed~');
               // $this->error = 'Image upload failed~';
                //$Tcomic->delete();
               // $Tcomic->getFirstMedia('thumbnail')->delete();
                throw $e;
            }

        }else {
            return redirect(route('comics_management.comics'));
        }


    }

    public function viewComics(Comic $comic)
    {

        $volume = Volume::Where('comic_id', $comic->id)->get();
        //dd( $volume->chapters());
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/viewComic', [
            'comic' => [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'editUrl'=> 'comics_management.comics.edit',
                    'viewUrl'=> 'comics_management.comics.view',
                    'isHidden' => $comic->isHidden,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at, ],

                'Volumes' => $volume->toArray() ]);
    }


}
