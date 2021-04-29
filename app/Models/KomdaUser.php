<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomdaUser extends Model
{
    protected $table = 'komda_user';
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
