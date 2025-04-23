<?php
namespace App\controllers;

use App\models\entities\Categoria;

class controllerCategorias {
    
    public function searchCategoria($search)
    {
        $model = new Categoria();
        $model->set('nombre', $search);
        $cat = $model->findName();
        if (empty($cat)) {
            return null;
        }
        return $cat;
    } 

    // public function getPerson($id)
    // {
    //     $model = new Categoria();
    //     $model->set('id', $id);
    //     return $model->find();
    // }
}
