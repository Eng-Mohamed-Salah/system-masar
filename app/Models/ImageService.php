<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageService extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'image_services';

    protected $fillable = ['image400x800', 'image800x400', 'image400x400', 'image800x800'];

}