<?php

namespace App\models\entities;

use App\models\util\Model;
use App\models\conexDB\ConexDB;

class Plato extends Model
{
    protected $id = null;
    protected $descrip = '';
    protected $precio = null;
    protected $idCat = null;

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO dishes (description, price, idCategory) VALUES ('" . $this->descrip . "', '" . $this->precio . "', '" . $this->idCat . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
{
    $conexDb = new ConexDB();
    $sql = "UPDATE dishes SET description='" . $this->descrip . "', price=" . $this->precio . ", idCategory=" . $this->idCat . " WHERE id=" . $this->id;
    $resConsul = $conexDb->exeSQL($sql);
    $conexDb->closeDB();
    
    return $resConsul;
}

    public function delete()
    {
        $conexDb = new ConexDB();
        $sql = "DELETE FROM dishes WHERE id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function findName()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM dishes WHERE LOWER(description) LIKE LOWER('%{$this->descrip}%')";
        $resConsul = $conexDb->exeSQL($sql);
        $platos = [];

        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $plato = new Plato();
                $plato->set('id', $row['id']);
                $plato->set('descrip', $row['description']);
                $plato->set('precio', $row['price']);
                $plato->set('idCat', $row['idCategory']);
                $platos[] = $plato;
            }
        }

        return $platos;
    }
    public function find()
    {
        $conexDb = new ConexDB();
        $sql = "select * from dishes where id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $plato = null;
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $plato = new Plato();
                $plato->set('id', $row['id']);
                $plato->set('descrip', $row['description']);
                $plato->set('precio', $row['price']);
                $plato->set('idPlato', $row['idCategory']);
                break;
            }
        }
        $conexDb->closeDB();
        return $plato;
    }
    public function exist($namePlato)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT id FROM dishes WHERE LOWER(description) = LOWER('$namePlato')";
        $res = $conexDb->exeSQL($sql);
        return ($res->num_rows > 0);
    }
}
