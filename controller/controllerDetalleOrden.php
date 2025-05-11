<?php

namespace App\controllers;

use App\models\entities\DetalleOrden;

class controllerDetalleOrden
{
    public function saveNewDetalleOrden($platosSeleccionados, $cantidad, $idOrden)
    {
        $totalOrden = 0;

        foreach ($platosSeleccionados as $idPlato) {
            $model = new DetalleOrden();

            $cantidadPlato = isset($cantidad[$idPlato]) ? intval($cantidad[$idPlato]) : 0;
            $precioUnitario = $model->obtenerPrecio($idPlato);
            $subtotal = $cantidadPlato * $precioUnitario;

            $model->set('cantidad', $cantidadPlato);
            $model->set('precio', $precioUnitario);
            $model->set('idOrden', $idOrden);
            $model->set('idPlato', $idPlato);

            if ($model->save()) {
                $totalOrden += $subtotal;
            }
        }

        return $totalOrden;
    }
        public function getAllDetalleOrden($idOrden)
    {
        $model = new DetalleOrden();
        $model->set('idOrder', $idOrden);
        return $model->all($idOrden);
    }
    
}
