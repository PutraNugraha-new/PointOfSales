<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Category (One-to-Many)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Supplier (Many-to-One)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke Transactions (One-to-Many)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
