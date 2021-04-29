<?php

use Illuminate\Database\Seeder;
use App\User;

class UserNotRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'amar',
            'email' => 'amar@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'wirahadi',
            'email' => 'wirahadi@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'kusuma',
            'email' => 'kusuma@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'bayu',
            'email' => 'bayu@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'lala',
            'email' => 'lala@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'zeze',
            'email' => 'zeze@mail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
