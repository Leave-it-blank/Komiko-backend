<?php

namespace App\Http\Controllers\Backend\Management;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;
class CarouselController extends Controller
{
    public function viewCarousel()
    {
        return Inertia::render('Backend/Management/Carousels/ViewCarousels', [
            'carousels' => Carousel::all(),
        ]);
    }

    public function createCarousel()
    {
        return Inertia::render('Backend/Management/Carousels/Actions/CreateCarousel');
    }
    public function storeCarousel(Request $request)
    {
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
                ->toMediaCollection('carousels');
            $Tcarousel->save();

            return redirect(route('admin.management.carousel'));
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
       try{
        $carousel->delete();
        return redirect()->back();
       }catch( \Exception $e){
            throw $e;
       }
    }
    public function updateStoreCarousel(Carousel $carousel, Request $request)
    {
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
                    ->toMediaCollection('carousels');
                //$comic->save();

                return redirect(route('admin.management.carousel'));
            } catch (\Exception $e) {
                //return dd($e);
                // $this->emit('Danger_alert',   'Image upload failed~');
                // $this->error = 'Image upload failed~';
                //$Tcomic->delete();
                // $Tcomic->getFirstMedia('thumbnail')->delete();
                throw $e;
            }
        } else {
            return redirect(route('admin.management.carousel'));
        }
    }

    public function editCarousel(Carousel $carousel)
    {
        return Inertia::render('Backend/Management/Carousels/Actions/EditCarousel', [
            'carousel' => $carousel
        ]);
    }
}
