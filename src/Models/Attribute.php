<?php

namespace Larattributes\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{

    protected $fillable = ['attributable_model_id','display_name','slug','field_name','code_name','type'];

	/**
     * Get the Model that owns the Attribute.
     */
    public function attributableModel()
    {
        return $this->belongsTo(AttributableModel::class);
    }

}
