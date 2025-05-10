<?php

namespace App\controllers;


class controllerValidaciones
{

    public function formatoTextos($text)
    {
        $convertText = ucfirst(strtolower(trim($_POST[$text])));
        return $convertText;
    }
}
