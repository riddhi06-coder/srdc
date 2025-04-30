<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    use HasFactory;

    protected $table = 'manufacturing';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'banner_image',

        'section1_heading',
        'infra_image',
        'description',

        'infra_heading',
        'innovation_image_3',
        'infra_description',

        'innovation_image_1',
        'innovation_description',

        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
