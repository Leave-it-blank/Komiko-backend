<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Comic;
use App\Models\Country;
class HomapageController extends Controller
{

    public function viewHomepage()
    {
        return Inertia::render('Frontend/HomePage', [
            'comics' => Comic::orderBy('updated_at', 'asc')->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'viewUrl' => 'comics_management.comics.view',
                    'isHidden' => $comic->isHidden,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,
                    'thumb' => $comic->getFullThumbnailOptimizedUrl()
                ];
            })->toArray(),

        ]);
    }
}
