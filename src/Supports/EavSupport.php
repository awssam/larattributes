<?php

namespace Larattributes\Supports;

// use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

use Larattributes\Models\AttributableModel;
use Larattributes\Models\Attribute;
use Larattributes\Models\AttributeText;
use Larattributes\Models\AttributeVarchar;
use Larattributes\Models\AttributeInteger;
use Larattributes\Models\AttributeDecimal;
use Larattributes\Models\AttributeDatetime;

class EavSupport
{


    /**
     * EavSupport::getModelHandler(type,$class) will fetch the needed model for the type u seted using the type and the class caller attributable.
     * @return AttributeValue[TYPE] Model | mixed  
     */
	public static function getModelHandler($handlerType)
	{
        switch ($handlerType) {
            case 'Larattributes\Models\AttributeText':
            case AttributeText::class:
            case 'text':
                return new AttributeText();
                break;
            case 'Larattributes\Models\AttributeVarchar':
            case AttributeVarchar::class:
            case 'varchar':
                return new AttributeVarchar();
                break;
            case 'Larattributes\Models\AttributeInteger':
            case AttributeInteger::class:
            case 'integer':
                return new AttributeInteger();
                break;
            case 'Larattributes\Models\AttributeDecimal':
            case AttributeDecimal::class:
            case 'decimal':
                return new AttributeDecimal();
                break;
            case 'Larattributes\Models\AttributeDateTime':
            case AttributeDateTime::class:
            case 'date-time':
            case 'datetime':
                return new AttributeDatetime();
                break;
        }
	}

    public static function getTable($handlerType,$class_name = false)
    {   
        if(self::getModelHandler($handlerType))
            return self::getModelHandler($handlerType)->getTable();
        
    }


    public static function registerModel($class_name,$table_name = null)
    {     
     // dd($class_name);
        if(!$table_name) {
            $table_name = new $class_name();
            $table_name = $table_name->getTable();
        }

        $attr = AttributableModel::firstOrCreate(['model_name' => $class_name,'table_name' => $table_name]);
        return $attr->id;
    }

    public static function getModels()
    {   
        return AttributableModel::all()->toArray();
    }


    public static function filterType($attributes)
    {   if(!is_array($attributes)) return ucfirst(gettype($attributes));
        if(count($attributes)) return (gettype($attributes[0]) == 'string') ? "Array" : 'Nested';
    }

    
    public static function getLastUsedColumn($handlerType)
    {
        try {
            $data = Attribute::where([['type','=',get_class(self::getModelHandler($handlerType))]])->orderBy('id', 'desc')->firstOrFail();
            return $data->field_name;
        } catch (\Exception $e) { /* no need to catch anything */}
        return false;
    }

    public static function addColumn($handlerType)
    {
        $col = self::getLastUsedColumn($handlerType);
        if($col === false) { 
            $col = 'v_0';
        }else{
            $col = explode('_',$col);
            $col = 'v_'.(intval($col[1]) + 1);
        }
        switch ($handlerType) {
            case 'integer': self::_addInteger($col,$handlerType);break;
            case 'varchar': self::_addVarchar($col,$handlerType);break;
            case 'decimal': self::_addDecimal($col,$handlerType);break;
            case 'datetime': self::_addDatetime($col,$handlerType);break;
            case 'text': self::_addText($col,$handlerType);break;
        }
        return $col;
    }

    protected static function _addInteger($column_name,$handlerType){Schema::table(self::getTable($handlerType), function($table) use ($column_name) { $table->integer($column_name);});}
    protected static function _addVarchar($column_name,$handlerType){Schema::table(self::getTable($handlerType), function($table) use ($column_name) { $table->string($column_name);});}
    protected static function _addDecimal($column_name,$handlerType){Schema::table(self::getTable($handlerType), function($table) use ($column_name) { $table->decimal($column_name,10,4);});}
    protected static function _addDatetime($column_name,$handlerType){Schema::table(self::getTable($handlerType), function($table) use ($column_name) { $table->dateTime($column_name);});}
    protected static function _addText($column_name,$handlerType){Schema::table(self::getTable($handlerType), function($table) use ($column_name) { $table->text($column_name);});}

    public static function getType($parameters)
    {
        if(is_array($parameters)){
            if(is_array($parameters[0])){
                if(is_array($parameters[0][0])){
                    return 'nested';
                }return 'array';
            }return 'value';
        }
        return false;
    }


}