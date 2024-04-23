<?php 

	class Permisos extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function getPermisosRol($idrol)
{
    // Convertir el valor de $idrol a entero
    $rolid = intval($idrol);

    // Verificar si $rolid es mayor que 0
    if($rolid > 0)
    {
        // Obtener los módulos
        $arrModulos = $this->model->selectModulos();

        // Obtener los permisos del rol
        $arrPermisosRol = $this->model->selectPermisosRol($rolid);

        // Definir permisos por defecto
        $arrPermisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);

        // Crear un array para almacenar los datos del rol
        $arrPermisoRol = array('idrol' => $rolid);

        // Verificar si hay permisos asociados al rol
        if(empty($arrPermisosRol))
        {
            // Si no hay permisos, asignar permisos por defecto a cada módulo
            for ($i=0; $i < count($arrModulos); $i++) { 
                $arrModulos[$i]['permisos'] = $arrPermisos;
            }
        }
        else
        {
            // Si hay permisos, asignar los permisos correspondientes a cada módulo
            for ($i=0; $i < count($arrModulos); $i++) {
                $arrPermisos = array('r' => $arrPermisosRol[$i]['r'], 
                                     'w' => $arrPermisosRol[$i]['w'], 
                                     'u' => $arrPermisosRol[$i]['u'], 
                                     'd' => $arrPermisosRol[$i]['d'] 
                                    );
                if($arrModulos[$i]['idmodulo'] == $arrPermisosRol[$i]['moduloid'])
                {
                    $arrModulos[$i]['permisos'] = $arrPermisos;
                }
            }
        }

        // Agregar los módulos y permisos al array de datos del rol
        $arrPermisoRol['modulos'] = $arrModulos;

        // Generar el HTML del modal (si es necesario)
        $html = getModal("modalPermisos", $arrPermisoRol);
        //dep($arrPermisoRol);
    }
    // Finalizar el script
    die();
}

		public function setPermisos()
		{
			if($_POST)
			{
				$intIdrol = intval($_POST['idrol']);
				$modulos = $_POST['modulos'];

				$this->model->deletePermisos($intIdrol);
				foreach ($modulos as $modulo) {
					$idModulo = $modulo['idmodulo'];
					$r = empty($modulo['r']) ? 0 : 1;
					$w = empty($modulo['w']) ? 0 : 1;
					$u = empty($modulo['u']) ? 0 : 1;
					$d = empty($modulo['d']) ? 0 : 1;
					$requestPermiso = $this->model->insertPermisos($intIdrol, $idModulo, $r, $w, $u, $d);
				}
				if($requestPermiso > 0)
				{
					$arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.');
				}else{
					$arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>