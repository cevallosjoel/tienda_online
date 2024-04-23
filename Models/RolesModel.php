<?php
class RolesModel extends Mysql
{
    public $intIdrol;
    public $strRol;
    public $strDescripcion;
    public $intStatus;

    function __construct()
    {
        parent::__construct();
    }
    public function selectRoles()
    {
        //Exraemos los roles
        $sql = "SELECT * FROM rol WHERE status !=0";
        $request = $this->select_all($sql);
        return $request;
    }
    public function selectRol(int $idrol)
    {
        $this->intIdrol = $idrol;
        $sql = "SELECT * FROM rol WHERE idrol = ?";
        $request = $this->select($sql, [$this->intIdrol]);
        return $request;
    }

    public function insertRol(string $rol, string $descripcion, int $status)
    {
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM rol WHERE nombrerol = ?";
        $request = $this->select($sql, [$this->strRol]);

        if (!empty($request)) {
            return "exist";
        } else {
            $query_insert = "INSERT INTO rol (nombrerol, descripcion, status) VALUES (?, ?, ?)";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            return $this->insert($query_insert, $arrData);
        }
    }

    public function updateRol(int $idrol, string $rol, string $descripcion, int $status){
        $this->intIdrol = $idrol;
        $this->strRol = $rol;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $status;

        $sql = "SELECT * FROM rol WHERE nombrerol = '$this->strRol' AND idrol != $this->intIdrol";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $sql = "UPDATE rol SET nombrerol = ?, descripcion = ?, status = ? WHERE idrol = $this->intIdrol ";
            $arrData = array($this->strRol, $this->strDescripcion, $this->intStatus);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }

    public function deleteRol(int $idrol)
		{
			$this->intIdrol = $idrol;
			$sql = "SELECT * FROM persona WHERE rolid = $this->intIdrol";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE rol SET status = ? WHERE idrol = $this->intIdrol ";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}
}
