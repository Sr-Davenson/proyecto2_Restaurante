<?php

namespace App\models\entities;

use App\models\util\Model;
use App\models\conexDB\ConexDB;

class DetalleOrden extends Model
{
    protected $id = null;
    protected $cantidad = null;
    protected $precio = null;
    protected $idOrden = null;
    protected $idPlato = null;

    public function obtenerPrecio($idPlato)
    {
        $conexDb = new ConexDB();
        $sqlPrecio = "SELECT price FROM dishes WHERE id = $idPlato";
        $result = $conexDb->exeSQL($sqlPrecio);
        $row = $result->fetch_assoc();
        $precioUnitario = $row['price'];
        return $precioUnitario;
    }

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO order_details (quantity, price, idOrder, idDish) VALUES ('" . $this->cantidad . "', '" . $this->precio . "', '" . $this->idOrden . "','" . $this->idPlato . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }
}
