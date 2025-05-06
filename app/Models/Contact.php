<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact_details';
    public $timestamps = false;

    protected $fillable = [
        'address',
        'location',
        'email',
        'contact',
        'company_description',
        'platforms',
        'social_urls',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
