<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'komda',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'pengurus',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'anggota',
            'guard_name' => 'web'
        ]);
    }
}
