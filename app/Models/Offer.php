<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable=[
        'user_id',
        'seller_id',
        'item_id',
        'auction_id',
        'bid'
    ];

    public function auction(){
        return $this->belongsTo('App\Models\Auction');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function seller(){
        return $this->belongsTo('App\Models\User');
    }

    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
   
   

    
    
    
}