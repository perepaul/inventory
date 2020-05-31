<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = ['reference_no', 'status', 'discount', 'total'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale_items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
