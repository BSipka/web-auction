<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable=[
        'order_id',
        'amount',
        'quantity',
    ];

    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
}
