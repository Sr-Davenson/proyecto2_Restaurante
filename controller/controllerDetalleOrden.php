<?php

namespace App\controllers;

use App\models\entities\DetalleOrden;

class controllerDetalleOrden
{

    public function saveNewDetalleOrden($resquest)
    {
        $model = new DetalleOrden();
        $model->set('cantidad', $resquest['quantity']);
        $model->set('precio', $resquest['price']);
        $model->set('idOrden', $resquest['idOrder']);
        $model->set('idPlato', $resquest['idDish']);
        return $model->save() ? 'yes' : 'not';
    }

    public function updateDetalleOrden($resquest)
    {
        $model = new DetalleOrden();
        $model->set('cantidad', $resquest['quantity']);
        $model->set('precio', $resquest['price']);
        $model->set('idOrden', $resquest['idOrder']);
        $model->set('idPlato', $resquest['idDish']);
        $resConsul = $model->update();
        return $resConsul ? 'yes' : 'not';
    }
    public function procesarDetalleOrden($pos)
    {
        // $pos['nameCat'] = $nameCat;
        return empty($pos['id'])
            ? $this->saveNewDetalleOrden($pos)
            : $this->updateDetalleOrden($pos);
    }
}
