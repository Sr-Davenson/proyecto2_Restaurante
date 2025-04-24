<?php

namespace App\models\util;

abstract class Model
{
    // abstract function all();
    abstract function save();
    abstract function update();
    abstract function delete();
    abstract function exist($nameProp);

    public function get($nameProp)
    {
        return $this->{$nameProp};
    }

    public function set($nameProp, $value)
    {
        $this->{$nameProp} = $value;
    }
}
