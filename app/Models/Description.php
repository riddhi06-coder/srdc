<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table = 'home_desc';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'description',
        'section_heading',
        'section_description',
        'about_no',
        'about_description',
        'advantage_heading',
        'advantage_description',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
