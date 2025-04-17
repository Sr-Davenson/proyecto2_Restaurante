<?php
namespace App\models\conexDB;

use mysqli;

class ConexDB {
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dataBase = '';
    private $conex = null;

    public function __construct(){
        $this->conex = new mysqli(
            $this->host,
            $this->user,
            $this->password,
            $this->dataBase
        );
    }

    public function closeDB(){
        $this->conex->close();
    }

    public function exeSQL($sql){
        return $this->conex->query($sql);
    }


}
