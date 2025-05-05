<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'section_title',
        'cas_no',
        'mol_wt',
        'applications_section_title',
        'application_names',
        'images',
        'document',
        'created_at',
        'created_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
