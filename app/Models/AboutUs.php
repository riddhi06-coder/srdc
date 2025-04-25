<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_details';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'about_image',
        'experience',
        'exp_title',
        'description',
        'section_title',
        'years_json',
        'titles_json',
        'descriptions_json',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
