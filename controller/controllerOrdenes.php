<?php

namespace App\controllers;

use App\models\entities\Orden;
use App\controllers\controllerPlatos;

class controllerOrdenes
{
    public function saveNewOrden($request)
    {
        $model = new Orden();
        
        $model->set('fecha', $request['fechaOrden']);
        $model->set('mesa_id', $request['idMesa']);
        
        $detalleOrden = [];
        $total = 0;

        foreach ($request['platos'] as $platoItem) {
            $platoController = new controllerPlatos();
            $platoInfo = $platoController->getPlato($platoItem['idPlato']); 

            if ($platoInfo) {
                $cantidad = intval($platoItem['cantidad']);
                $precioUnitario = floatval($platoInfo->get('precio'));
                
                $detalleOrden[] = [
                    'plato_id' => $platoItem['idPlato'],
                    'cantidad' => $cantidad,
                    'precio' => $precioUnitario
                ];

                $total += $cantidad * $precioUnitario;
            }
        }

        $model->set('total', $total);
        $model->set('detalle', $detalleOrden);

        return $model->save() ? 'yes' : 'not';
    }

    public function getAllOrdenes()
    {
        $model = new Orden();
        return $model->all();
    }

    public function getOrden($id)
    {
        $model = new Orden();
        $model->set('id', $id);
        return $model->find();
    }

    public function removeOrden($id)
    {
        $model = new Orden();
        $model->set('id', $id);

        if (empty($model->find())) {
            return "empty";
        }

        return $model->delete() ? 'yes' : 'not';
    }
}
