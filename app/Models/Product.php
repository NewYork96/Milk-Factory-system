<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function additive()
    {
        return $this->belongsToMany(Additive::class);
    }

    protected $fillable = ['product', 'size', 'best_before'];

}
