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
use Illuminate\Support\Facades\Auth;
class ComicsController extends Controller
{
    use AuthorizesRequests;
    public function getComics()
    {

        $this->authorize('view comic management',    Auth::user());
        //return 'hi';
        return Inertia::render('Backend/ComicsManagement/Comics/ComicsList', [
            'comics' => Comic::orderBy('title', 'asc')->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'editUrl' => 'comics_management.comics.edit',
                    'viewUrl' => 'comics_management.comics.view',
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
        $this->authorize('handle comic management',    Auth::user());
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/CreateComic', [
            'tags' => Tag::orderBy('name', 'asc')->get()->map(function ($e) {
                return [
                    'id' => $e->id,
                    'name' => $e->name,
                ];
            })->toArray(),

            'countries' => Country::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),

            'publishers' => Publisher::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'authors' => Author::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'artists' => Artist::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
        ]);
    }

    public function storeComic(Request $request)
    {
        $this->authorize('handle comic management', Auth::user());
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
        try {

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
        } catch (\Exception $e) {
            //$this->emit('Danger_alert',   'Something went wrong~ Try again~');
            //$this->error = 'Error Creating comic, validation issue most likely. Contact @leaveitblank';

            throw $e;
            // return dd($e);
        }
        try {
            $extension = $comic["thumb"]->extension();
            //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
            $comic["thumb"]->storeAs('/public/temp/cover/', $uid . '.' . $extension);
            $thumbnail_url = '/public/temp/cover/' . $uid . '.' . $extension;
            $Tcomic->addMediaFromDisk($thumbnail_url)
                ->withResponsiveImages()
                ->toMediaCollection('thumbnail');
            $Tcomic->save();

            return redirect(route('comics_management.comics'))->with('message', 'Created Successfully.');
        } catch (\Exception $e) {
            //return dd($e);
            // $this->emit('Danger_alert',   'Image upload failed~');
            // $this->error = 'Image upload failed~';
            $Tcomic->delete();
            throw $e;
            return redirect(route('comics_management.comics'))->with('error', 'Unable to Create.');
        }
    }



    public function editComics(Comic $comic)
    {
        $this->authorize('handle comic management',    Auth::user());
        //return 'hi';
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/EditComic', [
            'tags' => Tag::orderBy('name', 'asc')->get()->map(function ($e) {
                return [
                    'id' => $e->id,
                    'name' => $e->name,
                ];
            })->toArray(),

            'countries' => Country::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),

            'publishers' => Publisher::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'authors' => Author::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'artists' => Artist::orderBy('name', 'asc')->get()->map(function ($d) {
                return [
                    'id' => $d->id,
                    'name' => $d->name,
                ];
            })->toArray(),
            'comic' => $comic->toArray(),
            'comic_tags' => $comic->tags->pluck('id')
        ]);
    }

    public function editStoreComic(Comic $comic, Request $request)
    {

        $this->authorize('handle comic management',    Auth::user());
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

        try {

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
        } catch (\Exception $e) {
            //$this->emit('Danger_alert',   'Something went wrong~ Try again~');
            //$this->error = 'Error Creating comic, validation issue most likely. Contact @leaveitblank';

            throw $e;
            // return dd($e);
        }
        if ($request->hasFile('thumb')) {
            try {
                $imagecomic = $comic->getFirstMedia('thumbnail');
                if (!$imagecomic == null) {
                    $imagecomic->delete();
                }

                $extension = $valcomic["thumb"]->extension();
                //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
                $valcomic["thumb"]->storeAs('/public/temp/cover/', $comic->uid . '.' . $extension);
                $thumbnail_url = '/public/temp/cover/' . $comic->uid . '.' . $extension;
                $comic->addMediaFromDisk($thumbnail_url)
                    ->withResponsiveImages()
                    ->toMediaCollection('thumbnail');
                //$comic->save();

                return redirect(route('comics_management.comics.view', $comic->id))->with('message', 'Updated Successfully.');
            } catch (\Exception $e) {
                //return dd($e);
                // $this->emit('Danger_alert',   'Image upload failed~');
                // $this->error = 'Image upload failed~';
                //$Tcomic->delete();
                // $Tcomic->getFirstMedia('thumbnail')->delete();
                throw $e;

            }
        } else {
            return redirect(route('comics_management.comics.view', $comic->id))->with('message', 'Updated Successfully.');
        }
    }

    public function viewComics(Comic $comic)
    {

        $this->authorize('view comic management',    Auth::user());
      //  $volume = Volume::Where('comic_id', $comic->id)->get();
        //dd( $volume );
        return Inertia::render('Backend/ComicsManagement/Comics/Actions/viewComic', [
            'comic' => [
                'id' => $comic->id,
                'title' => $comic->title,
                'isHidden' => $comic->isHidden,
                'isMature' => $comic->isMature,
                'isLocked' => $comic->isLocked,
                'createdAt' => $comic->created_at,
                'updatedAt' => $comic->updated_at,
            ],

            'volumes' =>   Volume::Where('comic_id', $comic->id)->orderBy('number', 'desc')->get()->map(function ($volume) {
                return [
                    'id' => $volume->id,
                'name' => $volume->name,
                'number' => $volume->number,
                'editUrl' => 'comics_management.volume.view',
                'viewUrl' => 'comics_management.volume.view',
                'createdAt' => $volume->created_at,
                'updatedAt' => $volume->updated_at,
                ];
            })->toArray(),

        ]);
    }
}
