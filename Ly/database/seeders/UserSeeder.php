<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(10)->create();


        $user = new User;
        $user->name = 'secret';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('12345678');
        $user->save();
        $user->assignRole('management');
        $user->assignRole('Admin');

        $user = new User;
        $user->name = 'secretuser';
        $user->email = 'user@user.com';
        $user->password = bcrypt('12345678');
        $user->save();
       $user->assignRole('ContentManager');
       $user->assignRole('Super-Admin');
    }
}
