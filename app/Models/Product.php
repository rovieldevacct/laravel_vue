<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'description'];
    public function category(): HasOne
    {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
        // return $this->belongsTo(ProductCategory::class, 'id', 'category_id');
    }
}
