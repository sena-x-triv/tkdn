<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UsesUlid;

class Project extends Model
{
    use HasFactory, UsesUlid;

    protected $fillable = [
        'name',
        'status',
        'start_date',
        'end_date',
        'description',
        'location',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
} 