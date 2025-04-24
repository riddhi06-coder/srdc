<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeOffer extends Model
{
    use HasFactory;

    protected $table = 'we_offer';
    public $timestamps = false;

    protected $fillable = [
        'heading',
        'title',
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
