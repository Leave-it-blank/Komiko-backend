<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Support\MediaStream;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Chapter;
use App\Models\Page;
use Predis\Command\Redis\APPEND;

class DownloadComicController extends Controller
{
    function viewHome(Comic $comic)
    {
        ini_set('max_execution_time', 300000);
        $zip = MediaStream::create($comic->titleSlug . '.zip');
        $vols = $comic->volumes;
        foreach ($vols as $vol) {
            $chapters = Chapter::where('volume_id', $vol->id)->get();
            foreach ($chapters as $ch) {
                $pages = Page::where('chapter_id', $ch->id)->get();

                foreach ($pages as $page) {
                    $media = $page->getMedia('page');
                    $media[0]->setCustomProperty('zip_filename_prefix', $comic->titleSlug . "/volume_" . $vol->number . "/chapter_" . $ch->number . "/");
                    $media[0]->save();
                    $zip->addMedia($media[0]);
                }
            }
        }
        //dd($zip);
        return $zip;
    }
    function downloadALL()
    {
        $comics = Comic::all();
        $a = "";
        foreach ($comics as $comic) {
            $a = $a . "<a href=\"https://api.lynxscans.com/api/download/" . $comic->titleSlug . "\" >" . $comic->title . "\n <br> </br>";
        }
        return $a;
    }
}
