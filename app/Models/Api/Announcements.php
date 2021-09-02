<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcements extends Model
{
    use HasFactory;

    protected $table = 'announcements';
    protected $fillable = [
        'announcement_id',
        'study_program_id',
        'date', 'value', 'name', 'description',
        'is_active', 'createdby', 'created', 'updatedby',
        'updated'
    ];
}
