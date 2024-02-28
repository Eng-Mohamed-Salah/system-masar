<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'clients';
    protected $fillable = ['name', 'email', 'phone', 'address', 'image'];

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class);
    }
}
