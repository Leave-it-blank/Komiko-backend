<?php

namespace App\Http\Controllers\Backend\Management;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
class CarouselController extends Controller
{
    use AuthorizesRequests;
    public function viewCarousel()
    {
        $this->authorize('view management',    Auth::user());
        return Inertia::render('Backend/Management/Carousels/ViewCarousels', [
            'carousels' => Carousel::orderBy('position', 'asc')->get(),
        ]);
    }

    public function createCarousel()
    {
        $this->authorize('handle management',    Auth::user());
        return Inertia::render('Backend/Management/Carousels/Actions/CreateCarousel');
    }
    public function storeCarousel(Request $request)
    {
        $this->authorize('handle management',    Auth::user());
        $carousel =  $this->validate($request, [
            'name' => 'required|min:2|max:255|string',
            //  'upload_date' => 'string',
            'url' => 'required|min:2|max:400|string',
            'is_enabled' => 'bool|required',
            'position' => 'int|required',
            'thumb' => 'mimes:jpg,png,jpeg,gif|required|dimensions:min_width=1130,min_height=400, max_width=550,max_height=1150',
        ]);
        $uid = Str::uuid();
        try {

            $Tcarousel = Carousel::create([
                'name' => $carousel["name"],
                //'upload_date' => 'string',
                'url' => $carousel["url"],
                'is_enabled' => $carousel["is_enabled"],
                'position' => $carousel["position"],

            ]);
            $Tcarousel->save();

            Cache::flush();
        } catch (\Exception $e) {
            //$this->emit('Danger_alert',   'Something went wrong~ Try again~');
            //$this->error = 'Error Creating comic, validation issue most likely. Contact @leaveitblank';

            throw $e;
            // return dd($e);
        }
        try {
            $extension = $carousel["thumb"]->extension();
            //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
            $carousel["thumb"]->storeAs('/public/temp/carousel/', $uid . '.' . $extension);
            $carouseURL = '/public/temp/carousel/' . $uid . '.' . $extension;
            $Tcarousel->addMediaFromDisk($carouseURL)
                ->withResponsiveImages()
                ->toMediaCollection('carousels');
            $Tcarousel->save();

            return redirect(route('admin.management.carousel'))->with('message', 'Created Successfully.');
        } catch (\Exception $e) {
            //return dd($e);
            // $this->emit('Danger_alert',   'Image upload failed~');
            // $this->error = 'Image upload failed~';
            $Tcarousel->delete();
            throw $e;
        }

    }

    public function deleteCarousel(Carousel $carousel)
    {
        $this->authorize('handle management',    Auth::user());
       try{
        $carousel->delete();
        return redirect(route('admin.management.carousel'))->with('error', 'Deleted Successfully.');
       }catch( \Exception $e){
            throw $e;
       }
    }
    public function updateStoreCarousel(Carousel $carousel, Request $request)
    {
        $this->authorize('handle management',    Auth::user());
        $Tcarousel =  $this->validate($request, [
            'name' => 'required|min:2|max:255|string',
            //  'upload_date' => 'string',
            'url' => 'required|min:2|max:400|string',
            'is_enabled' => 'bool|required',
            'position' => 'int|required',
            'thumb' => 'mimes:jpg,png,jpeg,gif|dimensions:min_width=1130,min_height=400, max_width=550,max_height=1150|nullable',
        ]);


        try {

            $carousel->update([
                'name' => $Tcarousel["name"],
                //'upload_date' => 'string',
                'url' => $Tcarousel["url"],
                'is_enabled' => $Tcarousel["is_enabled"],
                'position' => $Tcarousel["position"],
            ]);

            Cache::flush();
        } catch (\Exception $e) {
            //$this->emit('Danger_alert',   'Something went wrong~ Try again~');
            //$this->error = 'Error Creating comic, validation issue most likely. Contact @leaveitblank';

            throw $e;
            // return dd($e);
        }
        if ($request->hasFile('thumb')) {
            try {
                $imagecomic = $carousel->getFirstMedia('carousels');
                if (!$imagecomic == null) {
                    $imagecomic->delete();
                }

                $extension = $Tcarousel["thumb"]->extension();
                //storeAs('public/images/', $this->thumbnail->getClientOriginalName());
                $Tcarousel["thumb"]->storeAs('/public/temp/cover/', $carousel->uid . '.' . $extension);
                $thumbnail_url = '/public/temp/cover/' . $carousel->uid . '.' . $extension;
                $carousel->addMediaFromDisk($thumbnail_url)
                    ->withResponsiveImages()
                    ->toMediaCollection('carousels');
                //$comic->save();

                return redirect(route('admin.management.carousel'))->with('message', 'Updated Successfully.');
            } catch (\Exception $e) {
                //return dd($e);
                // $this->emit('Danger_alert',   'Image upload failed~');
                // $this->error = 'Image upload failed~';
                //$Tcomic->delete();
                // $Tcomic->getFirstMedia('thumbnail')->delete();
                throw $e;
            }
        } else {
            return redirect(route('admin.management.carousel'))->with('message', 'Updated Successfully.');
        }
    }

    public function editCarousel(Carousel $carousel)
    {
        $this->authorize('handle management',    Auth::user());
        return Inertia::render('Backend/Management/Carousels/Actions/EditCarousel', [
            'carousel' => $carousel
        ]);
    }
}
