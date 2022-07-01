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
            'title' => 'required|min:2|max:255',
            //  'upload_date' => 'string',
            'desc' => 'required|min:20|max:4000',
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

            $newComic = Comic::create([
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
            $newComic->save();
            $newComic->tags()->attach($comic["tags"]);
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
            $newComic->addMediaFromDisk($thumbnail_url)
                ->toMediaCollection('thumbnail');
            $newComic->save();

             return redirect(route('comics_management.comics'));

        }
        catch(\Exception $e){
            //return dd($e);
           // $this->emit('Danger_alert',   'Image upload failed~');
           // $this->error = 'Image upload failed~';
            $newComic->delete();
            throw $e;
        }

    }
}
