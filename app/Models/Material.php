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
        'code',
        'name',
        'specification',
        'category_id',
        'brand',
        'tkdn',
        'price',
        'unit',
        'link',
        'price_inflasi',
        'description',
        'location',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
} 