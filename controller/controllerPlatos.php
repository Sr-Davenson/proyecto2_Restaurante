<?php

namespace App\controllers;

use App\models\entities\Plato;

class controllerPlatos
{

    public function saveNewPlato($resquest)
    {
        $model = new Plato();
        $model->set('descrip', $resquest['descripPlato']);
        $model->set('precio', $resquest['precioPlato']);
        $model->set('idCat', $resquest['idCat']);

        return $model->save() ? 'yes' : 'not';
    }

    public function updatePlato($resquest)
    {
        $model = new Plato();
        $model->set('id', $resquest['idPlato']);
        $model->set('descrip', $resquest['descripPlato']);
        $model->set('precio', $resquest['precioPlato']);
        $model->set('idCat', $resquest['idCat']);
        $resConsul = $model->update();
        return $resConsul ? 'yes' : 'not';
    }

    public function removePlato($id)
    {
        $model = new Plato();
        $model->set('id', $id);
        if (empty($model->find())) {
            return "empty";
        }
        $resConsul =  $model->delete();
        return $resConsul ? 'yes' : 'not';
    }

    public function searchPlato($search)
    {
        $model = new Plato();
        $model->set('descrip', $search);
        $platos = $model->findName();
        if (empty($platos)) {
            return [];
        }
        return $platos;
    }


    public function getPlato($id)
    {
        $model = new Plato();
        $model->set('id', $id);
        return $model->find();
    }
    public function platoExiste($nameCat)
    {
        $model = new Plato();
        if ($model->exist($nameCat) == $nameCat) {
            return true;
        }
        return false;
    }
    public function procesarPlato($descripPlato, $pos)
    {
        if (empty($descripPlato)) {
            echo '<p class="msg-error"El nombre no puede estar vacío o contener solo espacios.</p>';
            echo '<a class="botones" href="../AdminPlatos.php">Ir a inicio</a>';
            exit();
        }

        return empty($pos['idPlato'])
            ? $this->saveNewPlato($pos)
            : $this->updatePlato($pos);
    }
    public function getAllPlatos()
{
    $model = new Plato();
    return $model->all();
}

}
