<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function tagView(Tag $tag)
    {
         return 200;
    }
}
