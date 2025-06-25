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
        'name', 'unit', 'price', 'tkdn',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
} 