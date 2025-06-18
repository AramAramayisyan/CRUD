<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'type_id',
        'name',
        'description',
    ];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
