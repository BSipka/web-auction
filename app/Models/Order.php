<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'seller_id',
        'to',
        'shipper_id',
        'payment_id',
        'item_id',
    ];

    public function from(){
        return $this->belongsTo('App\Models\User');
    }

    public function to(){
        return $this->belongsTo('App\Models\User');
    }

    public function details(){
        return $this->hasOne('App\Models\OrderDetails');
    }

    public function payment(){
        return $this->hasOne('App\Models\Payment');
    }

    public function shipper(){
        return $this->hasOne('App\Models\Shipper');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }

    public function order_details(){
        return $this->hasOne('App\Models\OrderDetails');
    }

}
