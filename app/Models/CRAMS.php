<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRAMS extends Model
{
    use HasFactory;

    protected $table = 'crams';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_title',
        'image',
        'description',
        'vision_image',
        'image3',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
