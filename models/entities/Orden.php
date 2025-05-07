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
        $sql = "INSERT INTO orders (fecha, mesa_id, total) VALUES ('{$this->fecha}', '{$this->mesa_id}', '{$this->total}')";
        $resConsul = $conexDb->exeSQL($sql);
        
        if ($resConsul) {
            $orden_id = $conexDb->exeSQL("SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];
            foreach ($this->detalle as $plato) {
                $sqlDetalle = "INSERT INTO order_details (orden_id, plato_id, cantidad, precio_unitario) 
                               VALUES ('{$orden_id}', '{$plato['plato_id']}', '{$plato['cantidad']}', '{$plato['precio']}')";
                $conexDb->exeSQL($sqlDetalle);
            }
        }

        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
    {
        $conexDb = new ConexDB();
        $sql = "UPDATE orders SET fecha='{$this->fecha}', mesa_id={$this->mesa_id}, total={$this->total} WHERE id={$this->id}";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function delete()
    {
        $conexDb = new ConexDB();
        $sql = "DELETE FROM orders WHERE id={$this->id}";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function exist($idOrden)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT id FROM orders WHERE id={$idOrden}";
        $res = $conexDb->exeSQL($sql);
        return ($res->num_rows > 0);
    }

    public function find()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM orders WHERE id={$this->id}";
        $resConsul = $conexDb->exeSQL($sql);
        $orden = null;

        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $orden = new Orden();
                $orden->set('id', $row['id']);
                $orden->set('fecha', $row['fecha']);
                $orden->set('mesa_id', $row['mesa_id']);
                $orden->set('total', $row['total']);
                break;
            }
        }
        $conexDb->closeDB();
        return $orden;
    }

    public function all()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM orders";
        $resConsul = $conexDb->exeSQL($sql);
        $ordenes = [];

        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $orden = new Orden();
                $orden->set('id', $row['id']);
                $orden->set('fecha', $row['fecha']);
                $orden->set('mesa_id', $row['mesa_id']);
                $orden->set('total', $row['total']);
                $ordenes[] = $orden;
            }
        }
        $conexDb->closeDB();
        return $ordenes;
    }
}
