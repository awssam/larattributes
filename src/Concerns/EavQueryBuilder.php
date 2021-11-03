<?php

namespace Larattributes\Concerns;
use Larattributes\Supports\EavSupport;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Larattributes\Models\Attribute;



class EavQueryBuilder 
{


    // queryBuilder is "Illuminate\Database\Eloquent\Builder"
    // queryBuilder is "Illuminate\Database\Query\Builder" 
    // this class function could be called from the Service provider Builder::macro using an QueryBuilder instance or from Model scope using EloquentBuilder

    public static function withAttributes($builder,$attributes){
        $builderInstance = get_class($builder);
        if($builderInstance == QueryBuilder::class){
            $models = EavSupport::getModels();
            foreach ($models as $model_) {
                if($model_['table_name'] == $builder->from){
                    $instance = $model_['model_name']; // must be fixed
                }
            }
            $query = $builder;
            $builder = new EloquentBuilder($query);
            $builder->setModel(new $instance); // change 3
        }elseif ($builderInstance == EloquentBuilder::class){ 
            $query = $builder->getQuery();
            $instance = get_class($builder->getModel()); 

        }
        $query = ($query->columns) ? $query : $query->addSelect($query->from.'.*');

        
        $joins = [];
        $existedJoins = [];
        if(is_array($query->joins))
        foreach ($query->joins as $join) {
            $existedJoins[] = $join->table;
        }
        if(is_array($attributes)){
            $model_attributes = self::loadEavAttributes($instance);  // change 2
            
            foreach ($attributes as $attribute) {
                if ($model_attributes)
                foreach ($model_attributes as $model_attribute) {

                    if($model_attribute['code_name'] == $attribute || $attributes[0] == 'eav'){

                        if(array_key_exists($model_attribute['type'], $joins)){
                            $joins[$model_attribute['type']]['addSelect'][] = [
                                'code_name' => $model_attribute['code_name'],
                                'field_name' => $model_attribute['field_name']
                            ];
                        }else{
                            $joins[$model_attribute['type']] = [
                                'attributable_model_id' => $model_attribute['attributable_model_id'],
                                'table' =>EavSupport::getTable($model_attribute['type']),
                                'addSelect' =>[
                                    [
                                        'code_name' => $model_attribute['code_name'],
                                        'field_name' => $model_attribute['field_name']
                                    ]
                                ]
                            ];
                        }
                    }
                }
            }
            $key_nm = $query->from.'.id';
            foreach ($joins as $class => $one_join) {
                if(!in_array($one_join['table'],$existedJoins))
                $query->join($one_join['table'], function($join) use ($one_join,$key_nm){
                    $join->on($key_nm, '=', $join->table.'.entity_id')
                        ->where($join->table.'.attributable_model_id', '=', $one_join['attributable_model_id']);
                });
                foreach ($one_join['addSelect'] as $key => $column) {
                    $query->addSelect(array($one_join['table'].'.'.$column['field_name']. ' as '. $column['code_name']));
                }
            }
        }



        return $builder;


    }


    /**
     * loadEavAttributes will fetch all attributes objects of the current attributable class.
     * @return Array Attribute  
     */
    protected static function loadEavAttributes($class)
    {   
        $model_nam = EavSupport::registerModel($class);
        try {
            return Attribute::query()->select('field_name','code_name','type','attributable_model_id')->where('attributable_model_id',$model_nam)->get()->toArray();
        } catch (Exception $e) { /* looks empty no fields exists */ }
        return [];
    }


}
