<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'career_page_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_image',
        'banner_title',
        'section_title',
        'description',
        'section_title1',
        'names',
        'images',
        'descriptions',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
