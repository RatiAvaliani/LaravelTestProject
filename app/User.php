<?php

namespace App;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

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

    /**
     * @param null $password
     * @return null
     */
    public function setPasswordAttribute($password=null) {
        if (is_null($password)) return null;
        $this->attributes['password'] = bcrypt($password);
    }

    public static function requestCount () {
        $userId = Auth::user()->id;
        $user_info = \DB::getPDO()->prepare('SELECT requests_count FROM users WHERE id = :id');
        $user_info->bindParam(':id', $userId);
        $user_info->execute();
        return $user_info->fetch()['requests_count'];
    }
}
