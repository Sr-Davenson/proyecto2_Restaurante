<<<<<<< HEAD
<?php

namespace App\models\entities;

use App\models\conexDB\ConexDB;

class Orden
{
    private $db;

    public function __construct()
    {
        $this->db = new ConexDB();
    }

    public function getMesas()
    {
        return $this->db->exeSQL("SELECT * FROM mesas")->fetch_all(MYSQLI_ASSOC);
    }

    public function getPlatos()
    {
        return $this->db->exeSQL("SELECT * FROM platos")->fetch_all(MYSQLI_ASSOC);
    }

    public function saveOrden($fecha, $mesa_id, $platos)
    {
        $sql = "INSERT INTO orders (fecha, mesa_id, total) VALUES ('$fecha', '$mesa_id', 0)";
        $res = $this->db->exeSQL($sql);

        if ($res) {
            $orden_id = $this->db->exeSQL("SELECT LAST_INSERT_ID()")->fetch_assoc()['LAST_INSERT_ID()'];
            
            foreach ($platos as $plato) {
                $sqlDetalle = "INSERT INTO order_details (orden_id, plato_id, cantidad, precio_unitario) 
                               VALUES ('$orden_id', '{$plato['idPlato']}', '{$plato['cantidad']}', '{$plato['precio']}')";
                $this->db->exeSQL($sqlDetalle);
            }
        }

        return $orden_id ?? false;
    }
}
=======
>>>>>>> 70cdb19 (Guardando cambios)
