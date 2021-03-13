<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable=[
        'name',
        'description',
        'image',
        'starting_price',
        'max_price',
        'category_id',
        'seller_id',
        'deleted_at'
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
   
    public function auction(){
        return $this->hasOne('App\Models\Auction');
    }
    public function seller(){
        return $this->belongsTo('App\Models\User');
    }
}
