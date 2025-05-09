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

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO order_details (quantity, price, idOrder, idDish) VALUES ('" . $this->cantidad . "', '" . $this->precio . "', '" . $this->idOrden . "','" . $this->idPlato . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function update()
{
    $conexDb = new ConexDB();
    $sql = "UPDATE orders SET quantity='" . $this->cantidad . "', price=" . $this->precio . ", idOrder=" . $this->idOrden. ", idDish=" . $this->idPlato. " WHERE id=" . $this->id;
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
    public function exist($namePlato)
    {
        // $conexDb = new ConexDB();
        // $sql = "SELECT id FROM dishes WHERE LOWER(description) = LOWER('$namePlato')";
        // $res = $conexDb->exeSQL($sql);
        // return ($res->num_rows > 0);
    }
}
