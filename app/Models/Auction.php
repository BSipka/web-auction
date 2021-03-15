<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable=[
        'item_id',
        'sold_to',
        'sold_at',
        'canceled_at',
        'largest_bid',
    ];

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
    
    public function offers(){
        return $this->hasMany('App\Models\Offer');
    }
    public function buyer(){
        return $this->hasOne('App\Models\User');
    }
}
