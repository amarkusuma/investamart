<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = ['user_id', 'komda_id'];

    public function komda()
    {
        return $this->belongsTo(Komda::class, 'komda_id');
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
