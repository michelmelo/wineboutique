<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellerPreregistration extends Model
{
    use SoftDeletes;
    protected $guarded = [];
//    [
//        'firstName',
//        'lastName',
//        'companyName',
//        'email',
//        'phone',
//        'job',
//        'brands',
//        'licenses',
//        'shipping',
//        'status',
//    ];
}
