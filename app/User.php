<?php

namespace App;

use App\Models\Komda;
use App\Models\KomdaUser;
use App\Models\Pengurus;
use App\Models\Anggota;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function komda()
    {
        return $this->belongsTo(Komda::class);
    }

    public function komda_user()
    {
        return $this->hasOne(KomdaUser::class);
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class);
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class);
    }
}
