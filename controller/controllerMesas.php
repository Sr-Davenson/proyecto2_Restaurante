<?php

namespace App\controllers;

use App\models\entities\Mesas;

class controllerMesas
{
    public function getAllMesas()
    {
        $model = new Mesas();
        $mesas = $model->all();
        return $mesas;
    }

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
        if (empty($id)) {
            header("Location: ../AdminMesas.php");
            exit();
        }
        $model = new Mesas();
        if ($model->confirmDelete($id) == false) {
            $model->set('id', $id);

            if (empty($model->find())) {
                return "empty";
            }
            $resConsul = $model->delete();
            return $resConsul ? '1' : '2';
        } else {
            return 3;
        }
    }

    public function searchMesa($search)
    {
        $model = new Mesas();
        $model->set('nombre', $search);
        $mesas = $model->findName();
        if (empty($mesas)) {
            return [];
        }
        return $mesas;
    }
    public function getMesa($id)
    {
        $model = new Mesas();
        $model->set('id', $id);
        return $model->find();
    }
    public function mesaExiste($nameMesa)
    {
        $model = new Mesas();
        if ($model->exist($nameMesa) == $nameMesa) {
            return true;
        }
        return false;
    }
    public function idExiste($id)
    {
        $model = new Mesas();
        if ($id != null) {
            if ($model->existId($id) == false) {
                echo '<h1>Resultado de la operación</h1>';
                echo 'Mesa no encontrada';
                echo '<div class= "botones">';
                echo '<a href="../Actions/searchMesa.php">Ir a inicio</a>';
                echo '</div>';
                exit();
            }
        }
    }
    public function searchNameMesa($id)
    {
        $model = new Mesas();
        $model->set('id', $id);
        return $model->find();
    }
    public function procesarMesa($nameMesa, $pos)
    {
        if (empty($nameMesa)) {
            echo '<p class="msg-error">El nombre no puede estar vacío o contener solo espacios</p>';
            echo '<a class="botones" href="../AdminMesas.php">Ir a inicio</a>';
            exit();
        }
        if ($this->mesaExiste($nameMesa) == true) {
            echo '<p class="msg-error">La mesa <b>' . $nameMesa . '</b> ya está registrada. Ingresa otra</p>';
            echo '<a class="botones" href="../AdminMesas.php">Ir a inicio</a>';
            exit();
        }
        $pos['nameMesa'] = $nameMesa;
        return empty($pos['idMesa'])
            ? $this->saveNewMesas($_POST)
            : $this->updateMesas($_POST);
    }
}
