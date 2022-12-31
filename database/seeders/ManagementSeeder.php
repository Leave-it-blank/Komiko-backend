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
        $management = new Country();
        $management->name = 'Russia';
        $management->countryCode = Str::uuid();
        $management->shortName = "ru";
        $management->cid = 'default';
        $management->countryCode = 7;
        $management->save();
        $management = new Country();
        $management->name = 'Japan';
        $management->countryCode = Str::uuid();
        $management->shortName = "jp";
        $management->cid = 'default';
        $management->countryCode = 81;
        $management->save();
        $management = new Country();
        $management->name = 'china';
        $management->countryCode = Str::uuid();
        $management->shortName = "ch";
        $management->cid = 'default';
        $management->countryCode = 86;
        $management->save();
        $management = new Country();
        $management->name = 'french';
        $management->countryCode = Str::uuid();
        $management->shortName = "fr";
        $management->cid = 'default';
        $management->countryCode = 33;
        $management->save();
        $management = new Country();
        $management->name = 'vietnam';
        $management->countryCode = Str::uuid();
        $management->shortName = "vn";
        $management->cid = 'default';
        $management->countryCode = 84;
        $management->save();
        $management = new Country();
        $management->name = 'india';
        $management->countryCode = Str::uuid();
        $management->shortName = "in";
        $management->cid = 'default';
        $management->countryCode = 91;
        $management->save();

        $management = new Publisher();
        $management->name = 'kakao page';
        $management->pubCode = Str::uuid();
        $management->save();
        $management = new Publisher();
        $management->name = 'Naver';
        $management->pubCode = Str::uuid();
        $management->save();
        $management = new Publisher();
        $management->name = 'ac.qq';
        $management->pubCode = Str::uuid();
        $management->save();
        $management = new Publisher();
        $management->name = 'other';
        $management->pubCode = Str::uuid();
        $management->save();


        //Tag for categories
        $management = new Tag();
        $management->name = 'action';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/action.svg';
        $management->save();

        $management = new Tag();
        $management->name = 'adventure';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/adventure.svg';
        $management->save();
        $management = new Tag();
        $management->name = 'comedy';
        $management->svg = '/defaults/comedy.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'horror';
        $management->svg = '/defaults/horror.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'romance';
        $management->svg = '/defaults/romance.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'fantasy';
        $management->svg = '/defaults/fantasy.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'mature';
        $management->svg = '/defaults/mature.svg';
        $management->tagCode = Str::uuid();
        $management->save();
        $management = new Tag();
        $management->name = 'historic';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/action.svg';
        $management->save();
        $management = new Tag();
        $management->name = 'medival';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/action.svg';
        $management->save();
        $management = new Tag();
        $management->name = 'mecha';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/action.svg';
        $management->save();
        $management = new Tag();
        $management->name = 'school';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/action.svg';
        $management->save();
        $management = new Tag();
        $management->name = 'futuristic';
        $management->tagCode = Str::uuid();
        $management->svg = '/defaults/action.svg';
        $management->save();
    }
}
