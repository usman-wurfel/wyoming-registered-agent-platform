<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [

                'name'=>'Admin',
                'email'=>'admin@domain.com',
                'is_admin'=>'1',
                'password'=> bcrypt('12345607'),

        ];

        User::create($user);
    }
}
