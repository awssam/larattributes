<?php

namespace Larattributes\Concerns;
use Larattributes\Supports\EavSupport;
use Illuminate\Database\Eloquent\Model;


trait EavBuilder
{


  public function __call($method, $parameters)
    {   
         if($method == 'whereAttribute' || $method == 'where' || $method == 'orWhere'){
            return self::caller($this,$parameters,$method);
         }


        if (in_array($method, ['increment', 'decrement'])) {
            return $this->$method(...$parameters);
        }

        if ($resolver = (static::$relationResolvers[get_class($this)][$method] ?? null)) {
            return $resolver($this);
        }

        return $this->forwardCallTo($this->newQuery(), $method, $parameters);
    }


    public static function caller(Model $instance,$parameters,$method)
    {          

        if($method == 'whereAttribute') $method = 'where';
        $query = ($instance->getQuery()->columns) ? $instance->getQuery() : $instance->getQuery()->addSelect($instance->getTable().'.*');

        if(EavSupport::getType($parameters) == 'value'){
            if($parameters[0] == $instance->getKeyName())
                $parameters[0] = $instance->getTable().'.'.$parameters[0];

                $attributes = self::loadEavAttributes();
                foreach ($attributes as $key => $attribute) {
                    if($attribute['code_name'] == $parameters[0]){
                        $parameters[0] = EavSupport::getTable($attribute['type']).'.'.$attribute['field_name'];
                        $tb = $instance->getTable();
                        $key_nm = $instance->getKeyName();
                        $query->join(EavSupport::getTable($attribute['type']), function($join) use ($attribute,$tb,$key_nm){
                            $join->on($tb.'.'.$key_nm, '=', $join->table.'.entity_id')
                            ->where($join->table.'.attributable_model_id', '=', $attribute['attributable_model_id']);
                            }
                        );
                        $query->addSelect(array(EavSupport::getTable($attribute['type']).'.'.$attribute['field_name'].' as '.$attribute['code_name']));
                    }
                }
                return $instance->forwardCallTo($query, $method, $parameters);
            
        }
    }


    //not used
    public function whereAttribute___($attribute_column, $operator = null, $value = null, $boolean = 'and'){
        $attributes = parent::loadEavAttributes();
        if(is_string($attribute_column))
        foreach ($attributes as $key => $attribute) {
            if($attribute['code_name'] == $attribute_column){
                // dd(self::hasJoin(parent::getQuery(),EavSupport::getTable($attribute['type'])));
                $attribute_column = EavSupport::getTable($attribute['type']).'.'.$attribute['field_name'] ;
            }
        }
        
        if(is_string($attribute_column)){
            return self::where($attribute_column, $operator, $value, $boolean);
        }
        if(is_array($attribute_column)){
            return $this->addArrayOfWhereAttributes($attribute_column);
        }
        return $this;
    }

}
