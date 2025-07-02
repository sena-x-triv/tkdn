<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Material extends Model
{
    use HasFactory, UsesUlid;

    protected $table = 'material';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'specification',
        'type',
        'brand',
        'tkdn',
        'price',
        'unit',
        'link',
        'description',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
} 