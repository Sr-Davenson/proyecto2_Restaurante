<?php

namespace App\models\entities;

use App\models\util\Model;
use App\models\conexDB\ConexDB;

class Orden extends Model
{
    protected $id = null;
    protected $fecha = null;
    protected $total = null;
    protected $idMesa = null;

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO orders (dateOrder,total,idTable) VALUES ('" . $this->fecha . "', '" . $this->total . "', '" . $this->idMesa . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $id = $conexDb->lastInsertId();
        $conexDb->closeDB();
        return $id;
    }


    public function update($orderID, $totalOrden)
    {
        $conexDb = new ConexDB();
        $sql = "UPDATE orders SET total = $totalOrden WHERE id = $orderID";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function exist()
    {
        $conexDb = new ConexDB();
        $sql = "select * from orders where id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        if ($resConsul->num_rows > 0) {
            return true;
        }
        return false;
    }

    public function obtenerOrdenesPorFecha($fechaInicio, $fechaFin)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM orders WHERE dateOrder BETWEEN '$fechaInicio 00:00:00' AND '$fechaFin 23:59:59' 
        ORDER BY dateOrder DESC";
        $resConsul = $conexDb->exeSQL($sql);
        $ordens = [];
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $orden = new Orden();
                $orden->set('id', $row['id']);
                $orden->set('fecha', $row['dateOrder']);
                $orden->set('total', $row['total']);
                $orden->set('idMesa', $row['idTable']);
                $ordens[] = $orden;
            }
        }
        $conexDb->closeDB();

        return  $ordens;
    }
}
