<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    use HasFactory;

    public function coldstore()
    {
        return $this->belongsTo(Coldstore::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function additiveStore()
    {
        return $this->belongsToMany(AdditiveStore::class);
    }

    protected $fillable = ['product', 'quantity'];
}
