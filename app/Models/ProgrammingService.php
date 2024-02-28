<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgrammingService extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'programming_services';
    protected $fillable = ['title', 'descriptions', 'image'];

}
