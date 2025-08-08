<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Worker extends Model
{
    use HasFactory, UsesUlid;
    
    protected $table = 'workers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'code', 'name', 'unit', 'category_id', 'price', 'tkdn', 'location',
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