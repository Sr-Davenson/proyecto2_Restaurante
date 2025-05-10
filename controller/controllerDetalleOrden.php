<?php

namespace App\controllers;

use App\models\entities\DetalleOrden;

class controllerDetalleOrden
{
    public function saveNewDetalleOrden($platosSeleccionados, $request)
    {
        $totalOrden = 0;

        foreach ($platosSeleccionados as $idPlato) {
            $model = new DetalleOrden();

            $cantidad = intval($request['cantidad'][$idPlato]);
            $precioUnitario = $model->obtenerPrecio($idPlato);
            $subtotal = $cantidad * $precioUnitario;

            $model->set('cantidad', $cantidad);
            $model->set('precio', $precioUnitario);
            $model->set('idOrden', $request['idOrden']);
            $model->set('idPlato', $idPlato);

            if ($model->save()) {
                $totalOrden += $subtotal;
            }
        }

        return $totalOrden;
    }
}
