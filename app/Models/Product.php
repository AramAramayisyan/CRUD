<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'description',
        'is_featured',
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
