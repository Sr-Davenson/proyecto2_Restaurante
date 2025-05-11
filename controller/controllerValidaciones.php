<?php

namespace App\controllers;


class controllerValidaciones
{

    public function formatoTextos($text)
    {
        $convertText = ucfirst(strtolower(trim($text)));
        return $convertText;
    }
}
