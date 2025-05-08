<?php

namespace App\controllers;

use App\models\entities\Orden;

class controllerOrdenes
{
    public function __construct()
    {
    }

    // Obtener todas las mesas disponibles (Validación incluida)
    public function obtenerMesas()
    {
        $ordenModel = new Orden();
        $mesas = $ordenModel->getMesas();

        if (empty($mesas)) {
            return array("error" => "No hay mesas disponibles.");
        }

        return $mesas;
    }

    // Obtener todos los platos disponibles (Validación incluida)
    public function obtenerPlatos()
    {
        $ordenModel = new Orden();
        $platos = $ordenModel->getPlatos();

        if (empty($platos)) {
            return array("error" => "No hay platos disponibles.");
        }

        return $platos;
    }

    // Registrar una nueva orden (Validaciones incluidas)
    public function registrarOrden($fechaOrden, $idMesa, $platos)
    {
        if (empty($fechaOrden) || empty($idMesa) || empty($platos)) {
            return array("error" => "Todos los campos son obligatorios.");
        }

        if (!is_numeric($idMesa)) {
            return array("error" => "El ID de la mesa debe ser numérico.");
        }

        // Crear instancia del modelo y registrar la orden
        $ordenModel = new Orden();
        $idOrden = $ordenModel->saveOrden($fechaOrden, $idMesa, $platos);

        if ($idOrden) {
            return array("success" => "Orden registrada correctamente.", "orden_id" => $idOrden);
        } else {
            return array("error" => "Error al registrar la orden.");
        }
    }
}

