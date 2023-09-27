<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Relations\HasMany;

//use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $connection="mongodb";
    protected $fillable=[
        'user_id',
        'products_count',
        'total_price'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
