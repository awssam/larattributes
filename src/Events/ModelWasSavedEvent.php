<?php

namespace Larattributes\Events;

use Illuminate\Database\Eloquent\Model;
use Larattributes\Supports\EavSupport;

class ModelWasSavedEvent
{

    public function saved(Model $entity): void
    {
        $trash = $this->prepareTrashed($entity);
        $to_save = $this->__prepareEntityAttributesForSaving($trash,$entity);
        $this->saveEntityAttributes($to_save);
    }


    public function saving(Model $entity)
    {
        $this->removeEavAttributesFromModelBeforSaving($entity);
    }


    public function updating(Model $entity)
    {
        $entity->trashedEav = $entity->getAttributes();
        $trash = $this->prepareTrashed($entity);
        $to_save = $this->__prepareEntityAttributesForSaving($trash,$entity);
        $this->updateEntityAttributes($to_save);
        $this->removeEavAttributesFromModelBeforSaving($entity);
        $entity->trashedEav = [];
    }




    private function prepareTrashed(Model $entity)
    {
        $trash = [];
        foreach ($entity->trashedEav as $key => $value) {
            foreach ($entity::loadEavAttributes() as $eavAttribute) {
                if($key == $eavAttribute['code_name']){
                    $trashedEav = new \stdClass();
                    $trashedEav->field_name = $eavAttribute['field_name'];
                    $trashedEav->value = $value;
                    $trashedEav->code_name = $value;
                    $trashedEav->type = $eavAttribute['type'];
                    $trash[] = $trashedEav;
                }
            }
        }
        return $trash;
    }
    private function removeEavAttributesFromModelBeforSaving(Model $entity)
    {
        foreach ($entity->trashedEav as $key => $value) {
            foreach ($entity::loadEavAttributes() as $attribute) {
                if($key == $attribute['code_name']){
                    $entity->offsetUnset($key);
                }
            }
        }
    }


    private function __prepareEntityAttributesForSaving($eavAttributes,$entity)
    {
        $array = [];
        foreach ($eavAttributes as $eavAttribute) {
            $array[$eavAttribute->type][$eavAttribute->field_name] = $eavAttribute->value;
            $array[$eavAttribute->type]['entity_id'] = $entity->id;
            $array[$eavAttribute->type]['attributable_model_id'] = EavSupport::registerModel(get_class($entity));
        }
        return $array;
    }

    private function saveEntityAttributes($entityAttributes)
    {
        foreach ($entityAttributes as $handlerType => $data) {
            $class = EavSupport::getModelHandler($handlerType);
            if($class){
                $class->unguard(true);
                $class::create($data);
            }
        }
    }

    private function updateEntityAttributes($entityAttributes)
    {
        foreach ($entityAttributes as $handlerType => $data) {
            $class = EavSupport::getModelHandler($handlerType);
            if($class){
                $class->unguard(true);
                $class::where([['entity_id','=',$data['entity_id']],['attributable_model_id','=',$data['attributable_model_id']]])->update($data);
            }
        }
    }

}
