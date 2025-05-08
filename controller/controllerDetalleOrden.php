<?php

namespace App\controllers;
use App\models\entities\DetalleOrden;

class ControllerDetalleOrden {

    public function __construct() {
    }

    public function registrarDetalleOrden($orden_id, $plato_id, $cantidad, $precio_unitario) {
        $detalleOrden = new DetalleOrden();
        $detalleOrden->orden_id = $orden_id;
        $detalleOrden->plato_id = $plato_id;
        $detalleOrden->cantidad = $cantidad;
        $detalleOrden->precio_unitario = $precio_unitario;
      
        return $detalleOrden->save();
    }

    public function obtenerDetallesPorOrden($orden_id) {
        $detalleOrden = new DetalleOrden();
        return $detalleOrden->getDetallesPorOrden($orden_id);
    }
}
?>