<?php

namespace App\models\util;

class Fecha
{
    public function hoy()
    {
        date_default_timezone_set("America/Bogota");
        return date("H:i");
    }
}
