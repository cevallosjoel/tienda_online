var tableUsuarios;
document.addEventListener('DOMContentLoaded', function () {

    tableUsuarios = $('#tableUsuarios').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.4/i18n/es-ES.json",
        },
        "ajax": {
            "url": " " + base_url + "/Usuarios/getUsuarios",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idpersona" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "email_user" },
            { "data": "telefono" },
            { "data": "nombrerol" },
            { "data": "status" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Esportar a Excel",
                "className": "btn btn-success"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Esportar a PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Esportar a CSV",
                "className": "btn btn-info"
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });

    var formUsuario = document.querySelector("#formUsuario");
    formUsuario.onsubmit = function (e) {
        e.preventDefault();
        var strIdentificacion = document.querySelector('#txtIdentificacion').value;
        var strNombre = document.querySelector('#txtNombre').value;
        var strApellido = document.querySelector('#txtApellido').value;
        var strEmail = document.querySelector('#txtEmail').value;
        var intTelefono = document.querySelector('#txtTelefono').value;
        var intTipousuario = document.querySelector('#listRolid').value;
        var strPassword = document.querySelector('#txtPassword').value;

        if (strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '') {
            Swal.fire("Atención", "Todos los campos son obligatorios.", "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) {
            if (elementsValid[i].classList.contains('is-invalid')) {
                Swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
                return false;
            }
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Usuarios/setUsuario';
        var formData = new FormData(formUsuario);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                    $('#modalFormUsuario').modal("hide");
                    formUsuario.reset();
                    Swal.fire("Usuarios", objData.msg, "success");
                    tableUsuarios.api().ajax.reload();
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            }
        }

    }

    //Actualizar Perfil
    if (document.querySelector("#formPerfil")) {
        let formPerfil = document.querySelector("#formPerfil");
        formPerfil.onsubmit = function (e) {
            e.preventDefault();
            let strIdentificacion = document.querySelector('#txtIdentificacion').value;
            let strNombre = document.querySelector('#txtNombre').value;
            let strApellido = document.querySelector('#txtApellido').value;
            let intTelefono = document.querySelector('#txtTelefono').value;
            let strPassword = document.querySelector('#txtPassword').value;
            let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;

            if (strIdentificacion == '' || strApellido == '' || strNombre == '' || intTelefono == '') {
                Swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            if (strPassword != "" || strPasswordConfirm != "") {
                if (strPassword != strPasswordConfirm) {
                    Swal.fire("Atención", "Las contraseñas no son iguales.", "info");
                    return false;
                }
                if (strPassword.length < 5) {
                    Swal.fire("Atención", "La contraseña debe tener un mínimo de 5 caracteres.", "info");
                    return false;
                }
            }

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    Swal.fire("Atención", "Por favor verifique los campos en rojo.", "error");
                    return false;
                }
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/putPerfil';
            let formData = new FormData(formPerfil);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        Swal.fire({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
    //Actualizar Datos Fiscales
    if (document.querySelector("#formDataFiscal")) {
        let formDataFiscal = document.querySelector("#formDataFiscal");
        formDataFiscal.onsubmit = function (e) {
            e.preventDefault();
            let strDnit = document.querySelector('#txtDni').value;
            let strNombreFiscal = document.querySelector('#txtNombreFiscal').value;
            let strDirFiscal = document.querySelector('#txtDirFiscal').value;

            if (strDnit == '' || strNombreFiscal == '' || strDirFiscal == '') {
                Swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Usuarios/putDFical';
            let formData = new FormData(formDataFiscal);
            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState != 4) return;
                if (request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormPerfil').modal("hide");
                        Swal.fire({
                            title: "",
                            text: objData.msg,
                            type: "success",
                            confirmButtonText: "Aceptar",
                            closeOnConfirm: false,
                        }, function (isConfirm) {
                            if (isConfirm) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire("Error", objData.msg, "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    }
}, false);


window.addEventListener('load', function () {
    fntRolesUsuario();
    /*fntViewUsuario();
    fntEditUsuario();
    fntDelUsuario();*/
}, false);

function fntRolesUsuario() {
    var ajaxUrl = base_url + '/Roles/getSelectRoles';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listRolid').innerHTML = request.responseText;
            document.querySelector('#listRolid').value = 1;
            $('.seleccion2').select2();
        }
    }

}

function fntViewUsuario(idpersona) {
    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                var estadoUsuario = objData.data.status == 1 ?
                    '<span class="me-1 badge bg-success">Activo</span>' :
                    '<span class="me-1 badge bg-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.identificacion;
                document.querySelector("#celNombre").innerHTML = objData.data.nombres;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.email_user;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.nombrerol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
                $('#modalViewUser').modal('show');
            } else {
                Swal.fire("Error", objData.msg, "error");
            }
        }
    }
}

function fntEditUsuario(idpersona) {
    document.querySelector('#titleModal').innerHTML = "<i class='fa-solid fa-pen-to-square'></i> Actualizar Usuario";
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var idpersona = idpersona;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Usuarios/getUsuario/' + idpersona;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);

            if (objData.status) {
                document.querySelector("#idUsuario").value = objData.data.idpersona;
                document.querySelector("#txtIdentificacion").value = objData.data.identificacion;
                document.querySelector("#txtNombre").value = objData.data.nombres;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtEmail").value = objData.data.email_user;
                document.querySelector("#listRolid").value = objData.data.idrol;
                $('.seleccion2').select2();

                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }
                $('.seleccion2').select2();
            }
        }
        $('#modalFormUsuario').modal('show');
        initSelect2();
    }
}

function fntDelUsuario(idpersona) {
    var idUsuario = idpersona;
    Swal.fire({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url + '/Usuarios/delUsuario/';
            var strData = "idUsuario=" + idUsuario;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Swal.fire("Eliminar!", objData.msg, "success");
                        // Recargar la tabla de usuarios y volver a inicializar las funciones necesarias
                        tableUsuarios.api().ajax.reload(function () {
                            // Llamada recursiva para reasignar el evento de eliminación
                        });
                    } else {
                        Swal.fire("Atención!", objData.msg, "error");
                    }
                }
            }
        }
    });
}



function openModal() {
    document.querySelector('#idUsuario').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModal').innerHTML = "<i class='fa-solid fa-circle-plus'></i> Nuevo Usuario";
    document.querySelector("#formUsuario").reset();
    $('#modalFormUsuario').modal('show');
    initSelect2(); // Inicializa Select2 después de que se muestre el modal
}

// Función para inicializar Select2
function initSelect2() {
    $('.seleccion2').select2({
        placeholder: 'Seleccionar',
        allowClear: true,
        dropdownParent: $('#modalFormUsuario')
        // Aquí puedes agregar más opciones según tus necesidades
    });
}