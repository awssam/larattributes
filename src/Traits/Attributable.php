<?php

namespace Larattributes\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

use Larattributes\Models\Attribute;
use Larattributes\Supports\EavSupport;
use Larattributes\Concerns\EavBuilder;
use Larattributes\Concerns\EavQueryBuilder;
use Larattributes\Events\ModelWasSavedEvent;


trait Attributable
{

    use EavBuilder;

    public $trashedEav = [];

    private $trashedJoins = [];

    private $modelAttribute;

    public function __construct(array $attributes = array())
    {   
        $this->trashedEav = $attributes;
        parent::__construct($attributes);
    }


    public static function bootAttributable()
    {
        static::saving(ModelWasSavedEvent::class.'@saving');
        static::updating(ModelWasSavedEvent::class.'@updating');
        static::saved(ModelWasSavedEvent::class.'@saved');
    }

    /**
     * createAttribute will create a new attribut to this class if not existed before
     * @return Instance of Attribute | Boolean 
     */
    public static function createAttribute($attribute_name,$attribute_type){
        // $key = 'attributes-'.Str::slug(str_replace(['\\','/'], ' ', self::class));
        $reflectionClass = explode('\\', self::class);
        $slug = Str::slug($attribute_name.' '.end($reflectionClass),'-');
        $attribute = Attribute::where('slug','=',$slug)->first();
        $type = get_class(EavSupport::getModelHandler($attribute_type,self::class));

        $field_name = EavSupport::addColumn($attribute_type);
        $model_nam = EavSupport::registerModel(self::class);
        if(!$attribute){
            // Cache::forget($key);
            return Attribute::create([
                'attributable_model_id' => $model_nam,
                'slug' => $slug,
                'field_name' => $field_name,
                'code_name' => $attribute_name,
                'display_name' => $attribute_name,
                'type' => $type
            ]);
        }
        return $attribute;

    }


    /**
     * loadEavAttributes will fetch all attributes objects of the current attributable class.
     * @return Array Attribute  
     */
    protected static function loadEavAttributes()
    {   
        $model_nam = EavSupport::registerModel(self::class);
        try {
            return Attribute::query()->select('field_name','code_name','type','attributable_model_id')->where('attributable_model_id',$model_nam)->get()->toArray();
        } catch (Exception $e) { /* looks empty no fields exists */ }
        return [];
    }



    public function scopeWithAttributes($query,...$attributes){
        // dd($attributes);
        if(count($attributes) == 0) $attributes[] = 'eav';
        elseif(is_array($attributes[0])) $attributes = $attributes[0];
        return EavQueryBuilder::withAttributes($query,$attributes);
    }


}


