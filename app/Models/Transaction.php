<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    // Relasi ke Item (Many-to-One)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relasi ke Supplier (Many-to-One)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
