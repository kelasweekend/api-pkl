<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily_reports extends Model
{
    protected $table = 'daily_reports';
    protected $fillable = [
        'user_id',
        'work_place_id',
        'value', 'date', 'name', 'description',
        'is_active', 'createdby', 'created', 'updatedby',
        'updated', 'is_approve'
    ];
}
