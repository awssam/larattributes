<?php

namespace Larattributes\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeDatetime extends Model
{

    // protected $fillable = [];
    public $timestamps = false;

	/**
     * Get the Model that owns the AttributeDatetime.
     */
    public function attributableModel()
    {
        return $this->belongsTo(AttributableModel::class);
    }

}
