<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
        	'firstname'=>'LaraBank',
        	'middlename'=>'',
        	'lastname'=>'Admin',
        	'email' => 'admin@gmail.com',
        	'username' => 'admin',
        	'password' => bcrypt('Password1'),
			    'avatar' => URL::to('/')."/uploads/avatar/avatar.png",
          'email_verified_at' => time(),
        ]);
        $admin->assignRole('admin');

        // $user = User::create([
        // 	'firstname'=>'John',
        // 	'middlename'=>'Doe',
        // 	'lastname'=>'Jane',
        // 	'email' => 'johndoe@larabank.dev',
        // 	'username' => 'johndoe',
        // 	'password' => bcrypt('Password1'),
		// 	    'avatar' => URL::to('/')."/uploads/avatar/avatar.png",
        //   'email_verified_at' => time(),
        // ]);
        // $user->assignRole('users');

    }
}
