<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Advertisements;
use App\Models\Advertisement;
class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   Advertisement::insert(Advertisements::GLOBAL);
        Advertisement::insert(Advertisements::HOMEPAGE);
        Advertisement::insert(Advertisements::COMIC_DETAIL);
    }
}
