<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = ['jabatan', 'user_id', 'komda_id'];

    public function komda()
    {
        return $this->belongsTo(Komda::class, 'komda_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
