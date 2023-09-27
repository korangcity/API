<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

//use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $connection="mongodb";

    protected $fillable=[
        'name',
        'price',
        'inventory'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
