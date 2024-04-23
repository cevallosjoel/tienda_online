<?php

use LDAP\Result;

class Mysql extends Conexion
{
    private $conexion;
    private $strquery;
    private $arrValues;

    function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    public function insert(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;

        $insert = $this->conexion->prepare($this->strquery);
        $resInsert = $insert->execute($this->arrValues);

        if ($resInsert) {
            return $this->conexion->lastInsertId();
        } else {
            return 0; // O cualquier valor que desees usar para indicar un error
        }
    }
    //Busca un registro
    public function select(string $query, array $params = [])
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute($params);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    //Actualiza registros
    public function update(string $query, array $arrValues)
    {
        $this->strquery = $query;
        $this->arrValues = $arrValues;
        $update = $this->conexion->prepare($this->strquery);
        $resExecute = $update->execute($this->arrValues);
        return $resExecute;
    }
    //Devuelve todos los registros
    public function select_all(string $query, array $params = [])
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $result->execute($params);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    //Eliminar un registros
    public function delete(string $query)
    {
        $this->strquery = $query;
        $result = $this->conexion->prepare($this->strquery);
        $del = $result->execute();
        return $del;
    }
}
