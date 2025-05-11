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

    public function all($idOrden)
    {
        $conexDb = new ConexDB();
        $sql = "select * from order_details where idOrder=" . $idOrden;
        $resConsul = $conexDb->exeSQL($sql);
        $detallOrdenes = [];
        if ($resConsul->num_rows > 0) {
            while ($row = $resConsul->fetch_assoc()) {
                $detallOrden = new DetalleOrden();
                $detallOrden->set('id', $row['id']);
                $detallOrden->set('cantidad', $row['quantity']);
                $detallOrden->set('precio', $row['price']);
                $detallOrden->set('idOrden', $row['idOrder']);
                $detallOrden->set('idPlato', $row['idDish']);
                array_push($detallOrdenes, $detallOrden);
            }
        }
        $conexDb->closeDB();
        return $detallOrdenes;
    }

    public function save()
    {
        $conexDb = new ConexDB();
        $sql = "INSERT INTO order_details (quantity, price, idOrder, idDish) VALUES ('" . $this->cantidad . "', '" . $this->precio . "', '" . $this->idOrden . "','" . $this->idPlato . "')";
        $resConsul = $conexDb->exeSQL($sql);
        $conexDb->closeDB();
        return $resConsul;
    }

    public function obtenerPrecio($idPlato)
    {
        $conexDb = new ConexDB();
        $sqlPrecio = "SELECT price FROM dishes WHERE id = $idPlato";
        $result = $conexDb->exeSQL($sqlPrecio);
        $row = $result->fetch_assoc();
        $precioUnitario = $row['price'];
        return $precioUnitario;
    }

    public function rankingPlatos()
    {
        $conexDb = new ConexDB();
        $sql = "SELECT p.nombre, SUM(d.cantidad) AS total_vendido
            FROM order_details d
            JOIN platos p ON d.idPlato = p.id
            GROUP BY p.id
            ORDER BY total_vendido DESC
            LIMIT 10";

        $res = $conexDb->exeSQL($sql);
        $ranking = [];

        while ($row = $res->fetch_assoc()) {
            $ranking[] = [
                'nombre' => $row['nombre'],
                'total_vendido' => $row['total_vendido']
            ];
        }

        return $ranking;
    }
}
