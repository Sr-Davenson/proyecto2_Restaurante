<?php

namespace App\models\entities;

use App\models\util\Model;
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
                $cat->set('id', $row['id']);
                $cat->set('nombre', $row['name']);
                array_push($categorias, $cat);
            }
        }
        $conexDb->closeDB();
        return $categorias;
    }
    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO categories (name) VALUES ('" . $this->nombre . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
    {
        $conexDb = new ConexDB();
        $sql = "UPDATE categories SET name='" . $this->nombre . "' WHERE id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function delete()
    {
        $conexDb = new ConexDB();
        $sql = "DELETE FROM categories WHERE id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function confirmDelete($id)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT COUNT(*) as total FROM dishes WHERE idCategory = $id";
        $result = $conexDb->exeSQL($sql);
        $row = $result->fetch_assoc();
        if ($row['total'] > 0) {
            return true;
        }
        return false;
    }
    public function findName()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM categories WHERE LOWER(name) LIKE LOWER('%{$this->nombre}%')";
        $resConsul = $conexDb->exeSQL($sql);
        $categorias = [];

        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $cat = new Categoria();
                $cat->set('id', $row['id']);
                $cat->set('nombre', $row['name']);
                $categorias[] = $cat;
            }
        }

        return $categorias;
    }

    public function find()
    {
        $conexDb = new ConexDB();
        $sql = "select * from categories where id=" . $this->id;
        $resConsul = $conexDb->exeSQL($sql);
        $cat = null;
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $cat = new Categoria();
                $cat->set('id', $row['id']);
                $cat->set('nombre', $row['name']);
                break;
            }
        }
        $conexDb->closeDB();
        return $cat;
    }
    public function exist($nameCat)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT id FROM categories WHERE LOWER(name) = LOWER('$nameCat')";
        $res = $conexDb->exeSQL($sql);
        return ($res->num_rows > 0);
    }
    public function existId($id)
    {
        $conexDb = new ConexDB();
        $sql = "SELECT id FROM categories WHERE id = $id";
        $res = $conexDb->exeSQL($sql);
        if ($row = $res->fetch_assoc()) {
            return $row['id'];
        }

        return false;
    }
}
