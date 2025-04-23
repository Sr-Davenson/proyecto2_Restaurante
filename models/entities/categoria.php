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
        $sql = "SELECT * FROM categories";
        $resConsul = $conexDb->exeSQL($sql);
        $categorias = [];
        
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $cat = new Categoria();
                $cat->set('id', $row['id']);
                $cat->set('nombre', $row['name']); // Unificación de nombres
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
        $res = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $res;
    }

    public function findName()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT * FROM categories WHERE LOWER(name) LIKE LOWER('%{$this->nombre}%')";
        $res = $conexDb->exeSQL($sql);
        $cat = null;
        
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $cat = new Categoria();
                $cat->set('id', $row['id']);
                $cat->set('nombre', $row['name']); // Manteniendo la consistencia
                break;
            }
        }
        
        return $cat;
    }
}