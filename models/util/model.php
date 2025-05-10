<?php

namespace App\models\util;

abstract class Model
{
    abstract function save();

    public function get($nameProp)
    {
        return $this->{$nameProp};
    }

    public function set($nameProp, $value)
    {
        $this->{$nameProp} = $value;
    }
}
