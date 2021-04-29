<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Komda extends Model
{
    protected $table = 'komda';

    protected $fillable = ['name', 'deskripsi'];

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function komda_user()
    {
        return $this->hasMany(KomdaUser::class);
    }
}
