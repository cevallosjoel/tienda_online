<?php

class Roles extends Controllers
{
    protected $views; // Definir explícitamente la propiedad

    public function __construct()
    {
        parent::__construct();
        session_start();
        if(empty($_SESSION['login']))
        {
            header('Location: '.base_url().'/login');
        }
        getPermisos(2);
    }

    public function Roles()
    {
        $data['page_id'] = 3;
        $data['tag_page'] = "Roles Usuario";
        $data['page_name'] = "rol_usuario";
        $data['page_title'] = "Rol Usuario";
        $data['page_functions_js'] = "functions_roles.js";
        $this->views->getView($this, "roles", $data);
    }

    public function getRoles()
    {
        $arrData = $this->model->selectRoles();
        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['status'] == 1) {
                $arrData[$i]['status'] = '<span class="me-1 badge bg-success">Activo</span>';
            } else {
                $arrData[$i]['status'] = '<span class="me-1 badge bg-danger">Inactivo</span>';
            }
            $arrData[$i]['options'] = '<div class="text-center ">
                <button class="btn btn-warning rounded-start btnPermisosRol" onclick="fntPermisos(event)" fntPermisos data-rl="' . $arrData[$i]['idrol'] . '" title="Permiso rol">
                <i class="fa-solid fa-toggle-on"></i>
                </button>
                <button class="btn btn-primary rounded-start" onclick="fntEditRol(event)" data-rl="' . $arrData[$i]['idrol'] . '" title="Editar rol">
                <i class="bi bi-pencil"></i>
                </button>

                <button class="btn btn-danger rounded-start btnDelRol" onclick="fntDelRol(event)" data-rl="' . $arrData[$i]['idrol'] . '" title="Eliminar rol">
                <i class="bi bi-trash-fill"></i>
                </button>
            </div>';
        }
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function getSelectRoles()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectRoles();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['idrol'] . '">' . $arrData[$i]['nombrerol'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }
    public function getRol(int $idrol)
    {
        $intIdrol = intval(strClean($idrol));
        if ($intIdrol > 0) {
            $arrData = $this->model->selectRol($intIdrol);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            } else {
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die(); // Moví el die dentro del if para que solo se ejecute si $intIdrol > 0
    }

    public function setRol()
    {
        $intIdrol = intval($_POST['idRol']);
        $strRol = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = strClean($_POST['listStatus']);

        if ($intIdrol == 0) {
            // Crear
            $request_rol = $this->model->insertRol($strRol, $strDescripcion, $intStatus);
            $option = 1;
        } else {
            // Actualizar
            $request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescripcion, $intStatus);
            $option = 2;
        }

        if ($request_rol === "exist") {
            $arrResponse = ['status' => false, 'msg' => '¡Atención! El Rol ya existe.'];
        } elseif ($request_rol > 0) {
            if ($option == 1) {
                $arrResponse = ['status' => true, 'msg' => 'Datos guardados correctamente.'];
            } else {
                $arrResponse = ['status' => true, 'msg' => 'Datos Actualizados correctamente.'];
            }
        } else {
            $arrResponse = ['status' => false, 'msg' => 'No es posible almacenar los datos.'];
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function delRol()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idrol = filter_input(INPUT_POST, 'idrol', FILTER_SANITIZE_NUMBER_INT);
            if ($idrol === false) {
                echo json_encode(['status' => false, 'msg' => 'Parámetros inválidos.'], JSON_UNESCAPED_UNICODE);
                die();
            }

            $idrol = intval($idrol);
            $requestDelete = $this->model->deleteRol($idrol);
            switch ($requestDelete) {
                case 'ok':
                    echo json_encode(['status' => true, 'msg' => 'Se ha eliminado el Rol'], JSON_UNESCAPED_UNICODE);
                    break;
                case 'exist':
                    echo json_encode(['status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.'], JSON_UNESCAPED_UNICODE);
                    break;
                default:
                    echo json_encode(['status' => false, 'msg' => 'Error al eliminar el Rol.'], JSON_UNESCAPED_UNICODE);
            }
        }
        die();
    }
}
