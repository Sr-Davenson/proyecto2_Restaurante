<?php

namespace App\controllers;

use App\models\entities\Categoria;

class controllerCategorias
{

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
        $model->set('id', $id);
        if (empty($model->find())) {
            return "empty";
        }
        $resConsul =  $model->delete();
        return $resConsul ? 'yes' : 'not';
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
}
