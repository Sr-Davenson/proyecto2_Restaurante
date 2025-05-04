
<?php

namespace App\controllers;
use App\models\entities\Orden;
use App\models\entities\Plato;

class controllerOrdenes
{
    public function saveNewOrden($request)
    {
        $model = new Orden();
        
        // Asignar valores a la orden
        $model->set('fecha', $request['fechaOrden']);
        $model->set('mesa_id', $request['idMesa']);
        
        // Procesar el detalle de la orden
        $detalleOrden = [];
        $total = 0;

        foreach ($request['platos'] as $platoItem) {
            $plato = new Plato();
            $platoInfo = $plato->getPlato($platoItem['idPlato']); // Obtener el precio del plato

            if ($platoInfo) {
                $cantidad = intval($platoItem['cantidad']);
                $precioUnitario = floatval($platoInfo->precio);
                
                $detalleOrden[] = [
                    'plato_id' => $platoItem['idPlato'],
                    'cantidad' => $cantidad,
                    'precio' => $precioUnitario
                ];

                // Calcular el total de la orden
                $total += $cantidad * $precioUnitario;
            }
        }

        // Asignar el total calculado
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