<?php

namespace Larattributes\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeInteger extends Model
{

    // protected $fillable = [];
    public $timestamps = false;

	/**
     * Get the Model that owns the AttributeInteger.
     */
    public function attributableModel()
    {
        return $this->belongsTo(AttributableModel::class);
    }
    
}
