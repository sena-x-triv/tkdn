<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Equipment extends Model
{
    use HasFactory, UsesUlid;

    protected $table = 'equipment';

    protected $fillable = [
        'code',
        'name',
        'category_id',
        'tkdn',
        'period',
        'price',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
