<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Item (One-to-Many)
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
