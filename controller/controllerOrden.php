<?php

namespace App\controllers;

use App\models\entities\Orden;

class controllerOrden
{

    public function saveNewOrden($resquest)
    {
        $model = new Orden();
        $model->set('fecha', $resquest['fecha']);
        $model->set('total', $resquest['total']);
        $model->set('idMesa', $resquest['idMesa']);

        return $model->save() ? 'yes' : 'not';
    }

    public function updateOrden($resquest)
    {
        $model = new Orden();
        $model->set('id', $resquest['id']);
        $model->set('total', $resquest['total']);
        $resConsul = $model->update();
        return $resConsul ? 'yes' : 'not';
    }

    public function removeOrden($id)
    {
        $model = new Orden();
        $model->set('id', $id);
        if (empty($model->find())) {
            return "empty";
        }
        $resConsul =  $model->delete();
        return $resConsul;
    }
    public function procesarOrden()
    {
        return empty($_POST['id'])
            ? $this->saveNewOrden($_POST)
            : $this->updateOrden($_POST);
    }

    public function filtarPorfechas($fechaInicio, $fechaFin)
    {
        $model = new Orden();
        $cats = [];
        $cats = $model->obtenerOrdenesPorFecha($fechaInicio, $fechaFin);
        return $cats;
    }
    public function getAllOrdenes()
    {
        $model = new Orden();
        $cats = $model->all();
        return $cats;
    }
}
