<?php

namespace App\models\entities;

use App\models\util\Model;
use App\models\conexDB\ConexDB;

class Mesas extends Model
{
    protected $id = null;
    protected $nombre = '';

    public function all()
    {
        $conexDb = new ConexDB();
        $sql = "select * from restaurant_tables";
        $resConsul = $conexDb->exeSQL($sql);
        $mesas = [];
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $mesa = new Mesas();
                $mesa->set('id', $row['id']);
                $mesa->set('nombre', $row['name']);
                array_push($mesas, $mesa);
            }
        }
        $conexDb->closeDB();
        return $mesas;
    }

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO restaurant_tables (name) VALUES ('" . $this->nombre . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
    {
        $conexDb = new ConexDB();
        $sql = "UPDATE restaurant_tables SET name='" . $this->nombre . "' WHERE id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function delete()
    {
        $conexDb = new ConexDB();
        $sql = "DELETE FROM restaurant_tables WHERE id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function findName()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM restaurant_tables WHERE LOWER(name) LIKE LOWER('%{$this->nombre}%')";
        $resConsul = $conexDb->exeSQL($sql);
        $mesas = [];

        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $mesa = new Mesas();
                $mesa->set('id', $row['id']);
                $mesa->set('nombre', $row['name']);
                $mesas[] = $mesa;
            }
        }
        return $mesas;
    }

    public function find()
    {
        $conexDb = new ConexDB();
        $sql = "select * from restaurant_tables where id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $mesa = null;
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $mesa = new Mesas();
                $mesa->set('id', $row['id']);
                $mesa->set('nombre', $row['name']);
                break;
            }
        }
        $conexDb->closeDB();
        return $mesa;
    }
    public function exist($nameMesa)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT id FROM restaurant_tables WHERE LOWER(name) = LOWER('$nameMesa')";
        $res = $conexDb->exeSQL($sql);
        return ($res->num_rows > 0);
    }
    public function confirmDelete($id)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT COUNT(*) as total FROM orders WHERE idTable = $id";
        $result = $conexDb->exeSQL($sql);
        $row = $result->fetch_assoc();
        if ($row['total'] > 0) {
            return true;
        }
        return false;
    }
}
