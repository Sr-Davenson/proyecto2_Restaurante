<?php
namespace App\controllers;

use App\models\util\Fecha;

class ControllerFechas {
    
    public function calcSaludo()
    {
        $f = new Fecha();
        $hora = strtotime($f->hoy());
        $horaManInicio = strtotime("06:00");
        $horaManFin = strtotime("12:00");
        $horaTarInicio = strtotime("12:00");
        $horaTarFin = strtotime("18:00");

        if ($hora >= $horaManInicio && $hora < $horaManFin) {
            return 1;
        } elseif($hora >= $horaTarInicio && $hora < $horaTarFin){
            return 2;
        } else{
            return 3;
        }
    }
}
