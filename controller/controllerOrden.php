<?php

namespace App\controllers;

use App\models\entities\Orden;

class controllerOrden
{

    public function saveNewOrden($resquest)
    {
        $model = new Orden();
        $model->set('fecha', $resquest['dateOrder']);
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
    public function procesarOrden($fecha,$pos)
    {
        if (empty($fecha)) {
            echo '<p class="msg-error">La fecha no puede estar vacia</p>';
            echo '<a class="botones" href="../inicio.php">Ir a inicio</a>';
            exit();
        } 
        return empty($pos['id'])
        ? $this->saveNewOrden($pos)
        : $this->updateOrden($pos);
    }
}
