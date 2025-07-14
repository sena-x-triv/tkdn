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
        'name',
        'tkdn',
        'period',
        'price',
        'description',
    ];
}
