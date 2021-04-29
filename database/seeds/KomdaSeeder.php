<?php

use Illuminate\Database\Seeder;
use App\Models\Komda;
class KomdaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Komda::create([
           'name' => 'Pekalongan',
           'deskripsi' => 'Jawa Tengah'
        ]);

        Komda::create([
            'name' => 'Jakarta',
            'deskripsi' => 'Jawa Barat'
         ]);
    }
}
