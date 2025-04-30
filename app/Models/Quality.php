<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quality extends Model
{
    use HasFactory;

    protected $table = 'quality_control';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'banner_image',
        'description',
        'short_description',
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
