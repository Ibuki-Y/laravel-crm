<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'memo',
        'price',
        'is_selling',
    ];

    public function purchases() {
        return $this->belongsToMany(Purchase::class)
            ->withPivot('quantity');
    }
}
