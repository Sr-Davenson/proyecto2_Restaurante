<?php

namespace App\controllers;

use App\models\entities\Mesas;

class controllerMesas
{

    public function saveNewMesas($resquest)
    {
        $model = new Mesas();
        $model->set('nombre', $resquest['nameMesa']);
        $resConsul = $model->save();
        return $resConsul ? 'yes' : 'not';
    }

    public function updateMesas($resquest)
    {
        $model = new Mesas();
        $model->set('id', $resquest['idMesa']);
        $model->set('nombre', $resquest['nameMesa']);
        $resConsul = $model->update();
        return $resConsul ? 'yes' : 'not';
    }

    public function removeMesas($id)
    {
        $model = new Mesas();
        $model->set('id', $id);
        if (empty($model->find())) {
            return "empty";
        }
        $resConsul =  $model->delete();
        return $resConsul ? 'yes' : 'not';
    }

    public function searchMesa($search)
    {
        $model = new Mesas();
        $model->set('nombre', $search);
        $mesa = $model->findName();
        if (empty($mesa)) {
            return null;
        }
        return $mesa;
    }

    public function getMesa($id)
    {
        $model = new Mesas();
        $model->set('id', $id);
        return $model->find();
    }
}
