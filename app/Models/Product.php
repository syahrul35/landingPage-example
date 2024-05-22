<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCategory',
        'productName',
        'productImage',
        'description',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCategory');
    }
}
