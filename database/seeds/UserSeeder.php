<?php

use App\Models\KomdaUser;
use Illuminate\Database\Seeder;
use App\User;
use App\Models\Pengurus;
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

        KomdaUser::create([
            'user_id' => $komda->id,
            'komda_id' => 1
         ]);

        $pengurus = User::create([
            'name' => 'Pengurus',
            'email' => 'pengurus@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $pengurus->assignRole('pengurus');

        $komda->assignRole('komda');

        $pengurus2 = User::create([
            'name' => 'Pengurus2',
            'email' => 'pengurus2@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $pengurus2->assignRole('pengurus');

        Pengurus::create([
           'jabatan' => 'Web Dev',
           'user_id' => $pengurus->id,
           'komda_id' => 1,
        ]);

        Pengurus::create([
            'jabatan' => 'Admin',
            'user_id' => $pengurus2->id,
            'komda_id' => 2,
         ]);

        $anggota = User::create([
            'name' => 'anggota',
            'email' => 'anggota@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $anggota->assignRole('anggota');
    }
}
