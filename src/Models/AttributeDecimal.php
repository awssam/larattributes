<?php

namespace Larattributes\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeDecimal extends Model
{

    // protected $fillable = [];
    public $timestamps = false;

	/**
     * Get the Model that owns the AttributeVarchar.
     */
    public function attributableModel()
    {
        return $this->belongsTo(AttributableModel::class);
    }
    
}
