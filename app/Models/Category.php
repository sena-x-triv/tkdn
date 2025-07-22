<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Category extends Model
{
    use HasFactory, UsesUlid;

    protected $fillable = [
        'name',
        'code',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
} 