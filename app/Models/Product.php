<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //protected $table = 'products';
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category','product_categories');
    }
}