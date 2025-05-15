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
        $model->set('idMesa', $request['idMesa']);
        $orden = $model->save();
        return $orden;
    }

    public function updateOrden($totalOrden, $orderID,$estado)
    {
        $model = new Orden();
        $model->set('id', $orderID);
        $model->set('total', $totalOrden);
        $model->set('estado', $estado);
        $resConsul = $model->update($totalOrden, $orderID,$estado);
        return $resConsul ? 'yes' : 'not';
    }

    public function filtrarPorfechas($fechaInicio, $fechaFin,$estado)
    {
        $model = new Orden();
        $ordenes = [];
        $ordenes = $model->obtenerOrdenesPorFecha($fechaInicio, $fechaFin,$estado);
        return $ordenes;
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
                echo '<h1>Resultado de la operación</h1>';
                echo 'Orden no encontrada';
                echo '<div class="botones">';
                echo '<a href="../Actions/searchOrdenActiva.php">Ir a inicio</a>';
                echo '</div>';
                exit();
            }
        }
    }

     public function anular($id)
    {
        $model = new Orden();
        $model->set('id', $id);
        $resConsul = $model->cancelled($id);
        return $resConsul ? 'yes' : 'not';
    }
}
