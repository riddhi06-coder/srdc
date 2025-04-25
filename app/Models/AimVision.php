<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AimVision extends Model
{
    use HasFactory;

    protected $table = 'about_aimvision';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'title',
        'image',
        'description',
        'vision_title',
        'vision_image',
        'vision_description',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
