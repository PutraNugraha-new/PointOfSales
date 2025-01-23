<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Item (One-to-Many)
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // Relasi ke Transactions (One-to-Many)
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
