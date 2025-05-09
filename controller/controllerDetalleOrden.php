<?php

namespace App\controllers;
<<<<<<< HEAD

use App\models\entities\DetalleOrden;

class controllerDetalleOrden
{

    public function saveNewDetalleOrden($resquest)
    {
        $model = new DetalleOrden();
        $model->set('cantidad', $resquest['quantity']);
        $model->set('precio', $resquest['price']);
        $model->set('idOrden', $resquest['idOrder']);
        $model->set('idPlato', $resquest['idDish']);
        return $model->save() ? 'yes' : 'not';
    }

    public function updateDetalleOrden($resquest)
    {
        $model = new DetalleOrden();
        $model->set('cantidad', $resquest['quantity']);
        $model->set('precio', $resquest['price']);
        $model->set('idOrden', $resquest['idOrder']);
        $model->set('idPlato', $resquest['idDish']);
        $resConsul = $model->update();
        return $resConsul ? 'yes' : 'not';
    }
    public function procesarDetalleOrden($pos)
    {
        // $pos['nameCat'] = $nameCat;
        return empty($pos['id'])
            ? $this->saveNewDetalleOrden($pos)
            : $this->updateDetalleOrden($pos);
    }
}
=======
use App\models\entities\DetalleOrden;

class ControllerDetalleOrden {

    public function __construct() {
    }

    public function registrarDetalleOrden($orden_id, $plato_id, $cantidad, $precio_unitario) {
        $detalleOrden = new DetalleOrden();
        $detalleOrden->orden_id = $orden_id;
        $detalleOrden->plato_id = $plato_id;
        $detalleOrden->cantidad = $cantidad;
        $detalleOrden->precio_unitario = $precio_unitario;
      
        return $detalleOrden->save();
    }

    public function obtenerDetallesPorOrden($orden_id) {
        $detalleOrden = new DetalleOrden();
        return $detalleOrden->getDetallesPorOrden($orden_id);
    }
}
?>
>>>>>>> ff3284fade6d1d116e68d8ed07622d4832619967
