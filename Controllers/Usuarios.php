<?php

	class Usuarios extends Controllers{
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

    public function Usuarios()
    {
        $data['page_id'] = 1;
        $data['tag_page'] = "usuarios";
        $data['page_title'] = "Usuarios";
        $data['page_name'] = "usuarios";
        $data['page_functions_js'] = "functions_usuarios.js";
        $this->views->getView($this, "usuarios", $data);
    }
    public function setUsuario(){
        if($_POST){
            
            if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) || empty($_POST['txtEmail']) || empty($_POST['listRolid']) || empty($_POST['listStatus']) )
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{ 
                $idUsuario = intval($_POST['idUsuario']);
                $strIdentificacion = strClean($_POST['txtIdentificacion']);
                $strNombre = ucwords(strClean($_POST['txtNombre']));
                $strApellido = ucwords(strClean($_POST['txtApellido']));
                $intTelefono = intval(strClean($_POST['txtTelefono']));
                $strEmail = strtolower(strClean($_POST['txtEmail']));
                $intTipoId = intval(strClean($_POST['listRolid']));
                $intStatus = intval(strClean($_POST['listStatus']));

                if($idUsuario == 0)
                {
                    $option = 1;
                    $strPassword =  empty($_POST['txtPassword']) ? hash("SHA256",passGenerator()) : hash("SHA256",$_POST['txtPassword']);
                    $request_user = $this->model->insertUsuario($strIdentificacion,
                                                                        $strNombre, 
                                                                        $strApellido, 
                                                                        $intTelefono, 
                                                                        $strEmail,
                                                                        $strPassword, 
                                                                        $intTipoId, 
                                                                        $intStatus );
                }else{
                    $option = 2;
                    $strPassword =  empty($_POST['txtPassword']) ? "" : hash("SHA256",$_POST['txtPassword']);
                    $request_user = $this->model->updateUsuario($idUsuario,
                                                                $strIdentificacion, 
                                                                $strNombre,
                                                                $strApellido, 
                                                                $intTelefono, 
                                                                $strEmail,
                                                                $strPassword, 
                                                                $intTipoId, 
                                                                $intStatus);

                }

                if($request_user > 0 )
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_user == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! el email o la identificación ya existe, ingrese otro.');		
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function getUsuarios()
    {
        $arrData = $this->model->selectUsuarios();
        for ($i=0; $i < count($arrData); $i++) {

            if($arrData[$i]['status'] == 1)
            {
                $arrData[$i]['status'] = '<span class="me-1 badge bg-success">Activo</span>';
            }else{
                $arrData[$i]['status'] = '<span class="me-1 badge bg-danger">Inactivo</span>';
            }

            $arrData[$i]['options'] = '<div class="text-center">
            <button class="btn btn-warning rounded-start  btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver usuario"> <i class="bi bi-eye-fill"></i></button>
            <button class="btn btn-primary  rounded-start  btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idpersona'].')" title="Editar usuario"><i class="bi bi-pencil"></i></button>
            <button class="btn btn-danger rounded-start  btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar usuario"><i class="bi bi-trash-fill"></i></button>
            </div>';
        }
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function getUsuario(int $idpersona){
        
        $idusuario = intval($idpersona);
        if($idusuario > 0)
        {
            $arrData = $this->model->selectUsuario($idusuario);
            if(empty($arrData))
            {
                $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
            }else{
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function delUsuario()
    {
        if($_POST){
            $intIdpersona = intval($_POST['idUsuario']);
            $requestDelete = $this->model->deleteUsuario($intIdpersona);
            if($requestDelete)
            {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el usuario');
            }else{
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el usuario.');
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }


    public function perfil(){
        $data['page_tag'] = "Perfil";
        $data['page_title'] = "Perfil de usuario";
        $data['page_name'] = "perfil";
        $data['page_functions_js'] = "functions_usuarios.js";
        $this->views->getView($this,"perfil",$data);
    }

    public function putPerfil(){
        if($_POST){
            if(empty($_POST['txtIdentificacion']) || empty($_POST['txtNombre']) || empty($_POST['txtApellido']) || empty($_POST['txtTelefono']) )
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                $idUsuario = $_SESSION['idUser'];
                $strIdentificacion = strClean($_POST['txtIdentificacion']);
                $strNombre = strClean($_POST['txtNombre']);
                $strApellido = strClean($_POST['txtApellido']);
                $intTelefono = intval(strClean($_POST['txtTelefono']));
                $strPassword = "";
                if(!empty($_POST['txtPassword'])){
                    $strPassword = hash("SHA256",$_POST['txtPassword']);
                }
                $request_user = $this->model->updatePerfil($idUsuario,
                                                            $strIdentificacion, 
                                                            $strNombre,
                                                            $strApellido, 
                                                            $intTelefono, 
                                                            $strPassword);
                if($request_user)
                {
                    sessionUser($_SESSION['idUser']);
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }

    public function putDFical(){
        if($_POST){
            if(empty($_POST['txtDni']) || empty($_POST['txtNombreFiscal']) || empty($_POST['txtDirFiscal']) )
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                $idUsuario = $_SESSION['idUser'];
                $strDni = strClean($_POST['txtDni']);
                $strNomFiscal = strClean($_POST['txtNombreFiscal']);
                $strDirFiscal = strClean($_POST['txtDirFiscal']);
                $request_datafiscal = $this->model->updateDataFiscal($idUsuario,
                                                                    $strDni,
                                                                    $strNomFiscal, 
                                                                    $strDirFiscal);
                if($request_datafiscal)
                {
                    sessionUser($_SESSION['idUser']);
                    $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible actualizar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
