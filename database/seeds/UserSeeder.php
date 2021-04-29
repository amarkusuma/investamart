<?php

use Illuminate\Database\Seeder;
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
        $superadmin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $superadmin->assignRole('superadmin');

        $komda = User::create([
            'name' => 'Komda',
            'email' => 'komda@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $komda->assignRole('komda');

        $pengurus = User::create([
            'name' => 'Pengurus',
            'email' => 'pengurus@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $pengurus->assignRole('pengurus');

        $anggota = User::create([
            'name' => 'anggota',
            'email' => 'anggota@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $anggota->assignRole('anggota');
    }
}
