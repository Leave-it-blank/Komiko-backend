<?php

namespace App\Http\Controllers\Backend\Management;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    use AuthorizesRequests;

    public function viewTags()
    {
        $this->authorize('view management',    Auth::user());
        return Inertia::render('Backend/Management/Tags/ViewTags', [
            'tags' => Tag::orderBy('name', 'asc')->get()->toArray(),
        ]);
    }

    public function storeTags(Request $request)
    {
        $this->authorize('handle management',    Auth::user());
        $tagdata =  $this->validate($request, [
            'name' => 'required|min:2|max:255|string',
            'svg' => 'mimes:svg|required',

        ]);
        $uid = Str::uuid();
        try {
            $tag = Tag::create([
                'name' => $tagdata["name"],
                'tagCode' => $uid
            ]);
        } catch (\Exception $e) {
            Redirect::route('admin.management.tags')->with('error', 'Tag not created');
            throw $e;
        }
        try {

            $extension = $tagdata["svg"]->extension();
            //storeAs('public/images/', $this->svg->getClientOriginalName());
            $tagdata["svg"]->storeAs('/storage/svg/', $uid . '.' . $extension);
            $thumbnail_url = '/storage/svg/' . $uid . '.' . $extension;
            /*                 $tag->addMediaFromDisk($thumbnail_url)
                    ->withResponsiveImages()
                    ->toMediaCollection('tag'); */
            $tag->update(['svg' => $thumbnail_url]);
            return   Redirect::route('admin.management.tags')->with('message', 'Tag Successfully Created.');
        } catch (\Exception $e) {
            //return dd($e);
            // $this->emit('Danger_alert',   'Image upload failed~');
            // $this->error = 'Image upload failed~';
            $tag->delete();
            throw $e;
            return  Redirect::route('admin.management.tags')->with('error', 'Tag not created');
        }
    }
    public function deleteTag(Tag $tag)
    {
        $this->authorize('handle management',    Auth::user());
        try {
            $tag->delete();
            return redirect()->back()->with('error', 'Deleted Successfully.');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
