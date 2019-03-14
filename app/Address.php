<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'name',
        'address_1',
        'address_2',
        'city',
        'postal_code',
        'region_id',
        'default'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($address) {
            if($address->default) {
                $address->user->addresses()->update([
                    'default' => false
                ]);
            }
        });
    }

    public function setDefaultAttribute($value)
    {
        $this->attributes['default'] = ($value === 'true' || $value ? true : false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
