<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable=[
        'name',
        'description',
        
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }
}
