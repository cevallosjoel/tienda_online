<!-- Modal -->
<div class="modal" id="modalFormRol" >
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h1 class="modal-title fs-4" id="titleModal"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title">
                            <div class="title-body">
                                <form id="formRol" name="formRol">
                                <input type="hidden" id="idRol" name="idRol" value="">
                                    <div class="mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input class="form-control" type="text" id="txtNombre" name="txtNombre" placeholder="Ingresar el Nombre" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="4" placeholder="Descripción del rol" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="exampleSelect1">Estado</label>
                                        <select class="seleccion2" id="listStatus" name="listStatus" required>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>

                                    <div class="d-flex">
                                        <button type="button" class="btn form-control btn-white btn-lg me-1 border btn_usu" data-bs-dismiss="modal">
                                        <i class="fa-solid fa-circle-xmark"></i><br> Cancelar
                                        </button>
                                        <button id="btnActionForm" type="submit" class="btn form-control border btn-primary btn-lg btn_usu">
                                            <span id="btnText">Guardar</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
