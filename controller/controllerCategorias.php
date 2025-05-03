<?php

namespace App\controllers;

use App\models\entities\Categoria;

class controllerCategorias
{

    public function getAllCategorias()
    {
        $model = new Categoria();
        $cats = $model->all();
        return $cats;
    }

    public function saveNewCategoria($resquest)
    {
        $model = new Categoria();
        $model->set('nombre', $resquest['nameCat']);
        $resConsul = $model->save();
        return $resConsul ? 'yes' : 'not';
    }

    public function updateCategoria($resquest)
    {
        $model = new Categoria();
        $model->set('id', $resquest['idCat']);
        $model->set('nombre', $resquest['nameCat']);
        $resConsul = $model->update();
        return $resConsul ? 'yes' : 'not';
    }

    public function removeCategoria($id)
    {
        $model = new Categoria();
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

    public function searchCategoria($search)
    {
        $model = new Categoria();
        $model->set('nombre', $search);
        $cats = $model->findName();
        if (empty($cats)) {
            return [];
        }
        return $cats;
    }

    public function getCategoria($id)
    {
        $model = new Categoria();
        $model->set('id', $id);
        return $model->find();
    }

    public function searchNameCategoria($id)
    {
        $model = new Categoria();
        $model->set('id', $id);
        return $model->find();
    }
    public function categoriaExiste($nameCat)
    {
        $model = new Categoria();
        if ($model->exist($nameCat) == $nameCat) {
            return true;
        }
        return false;
    }
    public function procesarCategoria($nameCat, $pos)
    {
        if (empty($nameCat)) {
            echo '<p class="msg-error">El nombre no puede estar vacío o contener solo espacios</p>';
            echo '<a class="botones" href="../AdminCategoria.php">Ir a inicio</a>';
            exit();
        }
        if ($this->categoriaExiste($nameCat)) {
            echo '<p class="msg-error">El nombre <b>' . $nameCat . '</b> ya está registrado. Ingresa otro.</p>';
            echo '<a class="botones" href="../AdminCategoria.php">Ir a inicio</a>';
            exit();
        }
        $pos['nameCat'] = $nameCat;
        return empty($datos['idCat'])
            ? $this->saveNewCategoria($pos)
            : $this->updateCategoria($pos);
    }
}
