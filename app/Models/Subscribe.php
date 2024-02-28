<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscribe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['start_data', 'end_data', 'notes', 'client_id', 'plane_service_id', 'complete'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // دالة لاسترجاع بيانات الخطة المرتبطة بالاشتراك
    public function planeService()
    {
        return $this->belongsTo(PlaneServices::class);
    }
}
