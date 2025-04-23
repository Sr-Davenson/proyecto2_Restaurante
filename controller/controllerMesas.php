<?php
namespace App\controllers;

use App\models\entities\Mesas;

class controllerMesas {
    
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

    // public function getPerson($id)
    // {
    //     $model = new Categoria();
    //     $model->set('id', $id);
    //     return $model->find();
    // }
}
