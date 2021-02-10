<?php


namespace App\Extensions;


trait Searchable
{

    public function scopeSearch($query, $text)
    {
        if($this->existsSortable()){
            $query->whereRaw(
                "MATCH(" . implode(',',$this->{$this->getPropertyName()}) . ") AGAINST(? IN BOOLEAN MODE)",
                [$text .'*']
            );
        }
        return $query;

    }

    protected function existsSortable()
    {
        return property_exists($this, $this->getPropertyName()) &&
            is_array($this->{$this->getPropertyName()}) &&
            count($this->{$this->getPropertyName()}) > 0;
    }

    protected function getPropertyName()
    {
        return 'searchable';
    }

}
