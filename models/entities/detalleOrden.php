<?php

namespace App\models\entities;

use App\models\util\Model;
use App\models\conexDB\ConexDB;



class DetalleOrden extends Model {
    private $table = "detalle_orden";

    public $id;
    public $orden_id;
    public $plato_id;
    public $cantidad;
    public $precio_unitario;

    // Métodos abstractos declarados pero no implementados
    public function save() {
        $conexDb = new ConexDB();
        $query = "INSERT INTO " . $this->table . " (id, quantity, price, idOrden, idDish) 
                  VALUES ('".$this->id."','".$this->cantidad."','".$this->precio_unitario."','".$this->orden_id."','".$this->plato_id."')";
        $stmt = $conexDb->exeSQL($query);
        return $stmt;
    }
    public function update() {}
    public function delete() {}
    public function exist($nameProp) {}


    public function getDetallesPorOrden($orden_id) {
        $conexDb =new  ConexDB();
        $query = "INSERT INTO" . $this->table . "( idOrden)
                VALUES ('".$this ->orden_id."')";
        $stmt = $conexDb->exeSQL($query);
        return $stmt;
    }

    
}