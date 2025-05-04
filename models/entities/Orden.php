<?php

namespace App\models\entities;

use App\models\util\Model;
use App\models\conexDB\ConexDB;

class Orden extends Model
{
    protected $id = null;
    protected $fecha = '';
    protected $mesa_id = null;
    protected $total = 0;
    protected $detalle = []; // Array con los platos solicitados

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO orders (fecha, mesa_id, total) VALUES ('" . $this->fecha . "', '" . $this->mesa_id . "', '" . $this->total . "')";
        $resConsul = $conexDb->exeSQL($sql);
        
        if ($resConsul) {
            $orden_id = $conexDb->getLastInsertedId(); // Obtener ID de la orden creada
            foreach ($this->detalle as $plato) {
                $sqlDetalle = "INSERT INTO order_details (orden_id, plato_id, cantidad, precio_unitario) 
                               VALUES ('" . $orden_id . "', '" . $plato['plato_id'] . "', '" . $plato['cantidad'] . "', '" . $plato['precio'] . "')";
                $conexDb->exeSQL($sqlDetalle);
            }
        }

        $conexDb->closeDB();
        return $resConsul;
    }
}