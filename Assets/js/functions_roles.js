var tableRoles;
document.addEventListener('DOMContentLoaded', function() {

    tableRoles = $('#tableRoles').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/2.0.4/i18n/es-ES.json",
        },
        "ajax": {
            "url": " " + base_url + "/Roles/getRoles",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idrol" },
            { "data": "nombrerol" },
            { "data": "descripcion" },
            { "data": "status" },
            { "data": "options" }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [
            [0, "desc"]
        ]
    });
    //NUEVO ROL
    var formRol = document.querySelector("#formRol");
    if (formRol) {
        formRol.addEventListener("submit", function(event) {
            event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

            var intIdRol = document.querySelector('#idRol').value;
            var strNombre = document.querySelector('#txtNombre').value;
            var strDescripcion = document.querySelector('#txtDescripcion').value;
            var intStatus = document.querySelector('#listStatus').value;

            if (strNombre == '' || strDescripcion == '' || intStatus == '') {
                Swal.fire("Atención", "Todos los campos son obligatorios.", "error");
                return false;
            }

            var request = new XMLHttpRequest();
            var ajaxUrl = base_url + '/Roles/setRol';
            var formData = new FormData(formRol);

            request.open("POST", ajaxUrl, true);
            request.send(formData);

            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        $('#modalFormRol').modal('hide');
                        formRol.reset();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: "success",
                            title: objData.msg
                        });
                        tableRoles.api().ajax.reload(function() {
                            fntEditRol();
                            fntDelRol();
                            fntPermisos();
                        });
                    } else {
                        Swal.fire("Error", objData.msg, "error");
                    }
                }
            }
        });
        $('.seleccion2').select2();
        initSelect2();
    }

});

$("#tableRoles").DataTable();

function openModal() {

    document.querySelector('#idRol').value = "";
    document.querySelector('#btnText').innerHTML = "<i class='fa-solid fa-circle-check xl'></i><br> Guardar";
    document.querySelector('#titleModal').innerHTML = "<i class='fa-solid fa-circle-plus'></i> Registrar Nuevo Rol";
    document.querySelector("#formRol").reset();
    $('#modalFormRol').modal('show');
    initSelect2(); // Inicializa Select2 después de que se muestre el modal

}
window.addEventListener('load', function() {
    fntEditRol();
    fntDelRol();
    fntPermisos();
}, false);

function fntEditRol(event) {
    // Verificar si el evento no es undefined o null
    if (event && event.currentTarget) {
        var button = event.currentTarget;
        var idrol = button.getAttribute("data-rl");
        var ajaxUrl = base_url + '/Roles/getRol/' + idrol;

        fetch(ajaxUrl, {
                method: 'GET'
            })
            .then(response => response.json())
            .then(objData => {
                if (objData.status) {

                    document.querySelector('#btnText').innerHTML = "<i class='fa-solid fa-arrows-rotate'></i> Actualizar";
                    document.querySelector('#titleModal').innerHTML = "<i class='fa-solid fa-pen-to-square'></i> Actualizar Rol";
                    document.querySelector("#idRol").value = objData.data.idrol;
                    document.querySelector("#txtNombre").value = objData.data.nombrerol;
                    document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                    var listStatus = document.querySelector("#listStatus");
                    listStatus.value = objData.data.status;

                    // Disparar evento de cambio para actualizar la interfaz de usuario del cuadro de selección si es necesario
                    var changeEvent = new Event('change');
                    listStatus.dispatchEvent(changeEvent);

                    $('#modalFormRol').modal('show');
                } else {
                    Swal.fire("Error", objData.msg, "error");
                }
            })
            .catch(error => {
                Swal.fire("Error", "Ocurrió un error al obtener los datos del rol.", "error");
            });
    }
}

function fntDelRol(event) {
    // Verificar si el evento no es undefined o null
    if (event && event.currentTarget) {
        var button = event.currentTarget;
        var idrol = button.getAttribute("data-rl");
        Swal.fire({
            title: "Eliminar Rol",
            text: "¿Realmente quiere eliminar el Rol?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, eliminar!",
            cancelButtonText: "No, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = base_url + '/Roles/delRol/';
                var strData = "idrol=" + idrol;
                request.open("POST", ajaxUrl, true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strData);
                request.onreadystatechange = function() {
                    if (request.readyState == 4 && request.status == 200) {
                        var objData = JSON.parse(request.responseText);
                        if (objData.status) {
                            Swal.fire("Eliminar!", objData.msg, "success");
                            tableRoles.api().ajax.reload(function() {
                                fntEditRol();
                                fntDelRol();
                                fntPermisos();

                            });
                        } else {
                            Swal.fire("Atención!", objData.msg, "error");
                        }
                    }
                }
            }
        });
    }
}

function fntPermisos(event) {
    // Verificar si el evento no es undefined o null
    if (event && event.currentTarget) {
        var button = event.currentTarget;
        var idrol = button.getAttribute("data-rl");

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url + '/Permisos/getPermisosRol/' + idrol;
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                var contentAjax = document.querySelector('#contentAjax');
                if (contentAjax) {
                    contentAjax.innerHTML = request.responseText;
                    var modalPermisos = document.querySelector('.modalPermisos');
                    if (modalPermisos) {
                        $(modalPermisos).modal('show');
                        var formPermisos = document.querySelector('#formPermisos');
                        if (formPermisos) {
                            formPermisos.addEventListener('submit', fntSavePermisos, false);
                        }
                    } else {
                        console.error('Error: No se pudo encontrar el modal');
                    }
                } else {
                    console.error('Error: No se pudo encontrar el contenedor para cargar los permisos');
                }
            }
        }
    }
}

function fntSavePermisos(event) {
    event.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url + '/Permisos/setPermisos/';
    var formElement = document.querySelector("#formPermisos");
    var formData = new FormData(formElement);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: objData.msg
                }).then((result) => {
                    $('#modalPermisos').modal('hide'); // Cerrar el modal
                    tableRoles.api().ajax.reload(); // Recargar la tabla
                });
            } else {
                Swal.fire("Error", objData.msg, "error");
            }
        }
    }
}

// Función para inicializar Select2 dentro del modal
function initSelect2() {
    $('.seleccion2').select2({
        placeholder: 'Seleccionar',
        allowClear: true,
        dropdownParent: $('#modalFormRol')
        // Aquí puedes agregar más opciones según tus necesidades
    });
}
