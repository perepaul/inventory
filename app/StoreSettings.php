<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreSettings extends Model
{
    protected $fillable = [
        'title',
        'firstname',
        'lastname',
        'bussiness_name',
        'currency_text',
        'currency_sym',
        'phone_1',
        'phone_2',
        'store_logo',
        'address',
        'country',
        'state',
        'city',
        'zip',
    ];
}
