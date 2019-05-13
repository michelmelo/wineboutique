<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordNotification;
use App\Notifications\MailVarifyNotification;

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

    public function favoriteWines()
    {
        return $this->belongsToMany(Wine::class, 'favorite_wines', 'user_id', 'wine_id')->withTimeStamps();
    }

    public function winesRating()
    {
        return $this->belongsToMany(Wine::class, 'wine_ratings', 'user_id', 'wine_id')->withTimeStamps()->withPivot('rating');
    }

    public function wineriesRating()
    {
        return $this->belongsToMany(Wine::class, 'winery_ratings', 'user_id', 'winery_id')->withTimeStamps()->withPivot('rating');
    }

    public function cart()
    {
        return $this->belongsToMany(Wine::class, 'cart_user')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

      public function sendPasswordResetNotification($token)
   {
      $this->notify(new MailResetPasswordNotification($token));
   }

      public function sendVarifyNotification()
   {
      $this->notify(new MailVarifyNotification());
   }
}
