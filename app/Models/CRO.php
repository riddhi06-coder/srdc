<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRO extends Model
{
    use HasFactory;

    protected $table = 'cro';
    public $timestamps = false;

    protected $fillable = [
        'banner_title',
        'banner_image',
        'description',
        'image',
        'vision_image',
        'section_title',
        'section_description',
        'section_description1',
        'section_title1',
        'image3',
        'section_description2',
        'section_description3',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
