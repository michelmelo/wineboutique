<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    public static $types = [
        'seller' => 'SELLER',
        'customer' => 'CUSTOMER'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'phone',
        'city',
        'location',
        'type',
        'birthday'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function winery()
    {
        return $this->hasOne(Winery::class);
    }

    public function isSeller()
    {
        return $this->type===self::$types['seller'];
    }
}