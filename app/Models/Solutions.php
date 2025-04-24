<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solutions extends Model
{
    use HasFactory;

    protected $table = 'solutions';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'image',
        'products',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
