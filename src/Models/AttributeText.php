<?php

namespace Larattributes\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeText extends Model
{

    // protected $fillable = [];
    public $timestamps = false;

	/**
     * Get the Model that owns the AttributeText.
     */
    public function attributableModel()
    {
        return $this->belongsTo(AttributableModel::class);
    }
    
}
