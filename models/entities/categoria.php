<?php

namespace App\models\util;

use App\models\conexDB\ConexDB;

class Categoria extends Model
{
    protected $id = null;
    protected $nombre = '';

    public function all()
    {
        $conexDb = new ConexDB();
        $sql = "select * from categories";
        $resConsul = $conexDb->exeSQL($sql);
        $categorias = [];
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $cat = new Categoria();
                $cat ->set('id', $row['id']);
                $cat->set('name', $row['name']);
                array_push($categorias, $cat);
            }
        }
        $conexDb->closeDB();
        return $categorias;
    }

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "insert into categories (name) values ";
        $sql .= "('" . $this->nombre . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
    {
        $conexDb = new ConexDB();
        $sql = "update categories set ";
        $sql .= "name='" . $this->nombre . "',";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function delete()
    {
        $conexDb = new ConexDB();
        $sql = "delete from categories where id=" . $this->id;
        $res = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $res;
    }
}
