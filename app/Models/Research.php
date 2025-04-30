<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $table = 'research';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'banner_image',
        'description',
        'infra_heading',
        'infra_image',
        'infra_description',
        'innovation_heading',
        'innovation_image_1',
        'innovation_image_2',
        'innovation_image_3',
        'innovation_description',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
