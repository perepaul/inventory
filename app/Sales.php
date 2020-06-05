<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = ['reference_no','payment_method_id', 'status', 'discount', 'total'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale_items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function formatDate($format = 'd M, Y')
    {
        return  \Carbon\Carbon::parse($this->attributes['created_at'])->format($format);
    }
}
