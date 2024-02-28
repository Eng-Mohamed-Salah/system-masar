<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaneServices extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'plane_services';
    protected $fillable = ['title', 'cost', 'customService'];
    protected $casts = [
        'customService' => 'array',
    ];

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class);
    }

}
