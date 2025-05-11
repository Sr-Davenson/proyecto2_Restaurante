<?php

namespace App\controllers;

use App\models\entities\Orden;

class controllerOrden
{

    public function saveNewOrden($request, $totalOrden)
    {
        $model = new Orden();
        $model->set('fecha', $request['fecha']);
        $model->set('total', $totalOrden);
        $model->set('idMesa', $request['idMesa']);
        $a = $model->save();
        return $a;
    }

    public function updateOrden($totalOrden, $orderID)
    {
        $model = new Orden();
        $model->set('id', $orderID);
        $model->set('total', $totalOrden);
        $resConsul = $model->update($totalOrden, $orderID);
        return $resConsul ? 'yes' : 'not';
    }

    public function filtarPorfechas($fechaInicio, $fechaFin)
    {
        $model = new Orden();
        $cats = [];
        $cats = $model->obtenerOrdenesPorFecha($fechaInicio, $fechaFin);
        return $cats;
    }
    public function getOrden($id)
    {
        $model = new Orden();
        $model->set('id', $id);
        return $model->find();
    }
    public function idExiste($id)
    {
        $model = new Orden();
        if ($id != null) {
            if ($model->existId($id) == false) {
                echo 'Orden no encontrada';
                echo '<a href="../Actions/searchOrdenActiva.php">Ir a inicio</a>';
                exit();
            }
        }
    }
}
