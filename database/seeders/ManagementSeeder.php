<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Author;
use App\Models\Country;
use App\Models\Publisher;
use App\Models\Tag;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $management = new Artist();
        $management->name = 'blank';
        $management->meta = 'null';
        $management->artistCode = Str::uuid();
        $management->save();
        $management = new Author();
        $management->name = 'blank';
        $management->meta = 'null';
        $management->authorCode = Str::uuid();
        $management->save();
        $management = new Country();
        $management->name = 'South Korea';
        $management->countryCode = Str::uuid();
        $management->shortName = "Kr";
        $management->cid = 'default';
        $management->countryCode = 82;
        $management->save();
        $management = new Publisher();
        $management->name = 'kakao page';
        $management->pubCode = Str::uuid();
        $management->save();


        //Tag for categories
        $management = new Tag();
        $management->name = 'action';
        $management->tagCode= Str::uuid();
        $management->svg= '/defaults/action.svg';
        $management->save();

        $management = new Tag();
        $management->name = 'adventure';
        $management->tagCode = Str::uuid();
        $management->svg= '/defaults/action.svg';
        $management->save();
        $management = new Tag();
        $management->name = 'martial arts';
        $management->svg= '/defaults/action.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'reincarnation';
        $management->svg= '/defaults/action.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'romance';
        $management->svg= '/defaults/action.svg';
        $management->tagCode = Str::uuid();
        $management->save();
    }
}
