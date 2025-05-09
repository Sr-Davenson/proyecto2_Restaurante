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
        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
{
    $conexDb = new ConexDB();
    $sql = "UPDATE orders SET dateOrder='" . $this->fecha . "', total=" . $this->total . ", idTable=" . $this->idMesa. " WHERE id=" . $this->id;
    $resConsul = $conexDb->exeSQL($sql);
    $conexDb->closeDB();
    
    return $resConsul;
}

    public function delete()
    {
        $conexDb = new ConexDB();
        $sql = "DELETE FROM orders WHERE id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    // public function findName()
    // {
    //     $conexDb = new ConexDB();
    //     $sql = "SELECT * FROM orders WHERE LOWER(description) LIKE LOWER('%{$this->descrip}%')";
    //     $resConsul = $conexDb->exeSQL($sql);
    //     $platos = [];

    //     if ($resConsul->num_rows > 0) {
    //         while ($row = $resConsul->fetch_assoc()) {
    //             $plato = new Plato();
    //             $plato->set('id', $row['id']);
    //             $plato->set('descrip', $row['description']);
    //             $plato->set('precio', $row['price']);
    //             $plato->set('idCat', $row['idCategory']);
    //             $platos[] = $plato;
    //         }
    //     }

    //     return $platos;
    // }
    public function find()
    {
        $conexDb = new ConexDB();
        $sql = "select * from orders where id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $orden = null;
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $orden = new Orden();
                $orden->set('id', $row['id']);
                $orden->set('fecha', $row['dateOrder']);
                $orden->set('total', $row['total']);
                $orden->set('idMesa', $row['idTable']);
                break;
            }
        }
        $conexDb->closeDB();
        return $orden;
    }
    public function exist($namePlato)
    {
        // $conexDb = new ConexDB();
        // $sql = "SELECT id FROM dishes WHERE LOWER(description) = LOWER('$namePlato')";
        // $res = $conexDb->exeSQL($sql);
        // return ($res->num_rows > 0);
    }
}
