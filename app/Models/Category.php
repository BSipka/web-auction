<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'category_name',
        'description',
       
    ];

    public function items(){
        return $this->belongsToMany('App\Models\Item');
    }
}
