<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    protected $fillable=[
        'name',
        'phone_number',
        
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Order');
    }
}
