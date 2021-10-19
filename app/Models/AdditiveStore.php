<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditiveStore extends Model
{
    use HasFactory;

    protected $fillable =['quantity'];


    public function additive()
    {
        return $this->belongsTo(Additive::class);
    }

    public function productStore()
    {
        return $this->belongsToMany(ProductStore::class);
    }

    public function dryStore()
    {
        return $this->belongsTo(DryStore::class);
    }

}

