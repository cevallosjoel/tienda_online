<!-- Modal -->
<div class="modal" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h1 class="modal-title fs-4" id="titleModal"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
      <div class="modal-body">
        <form id="formUsuario" name="formUsuario" class="form-horizontal">
          <input type="hidden" id="idUsuario" name="idUsuario" value="">
          <p class="text-primary">Todos los campos son obligatorios.</p>

          <div class="row mb-3">
            <div class="form-group col-md-12">
              <label for="txtIdentificacion ">Identificación</label>
              <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-group col-md-6">
              <label for="txtNombre">Nombres</label>
              <input type="text" class="form-control valid validText" id="txtNombre" name="txtNombre" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtApellido">Apellidos</label>
              <input type="text" class="form-control valid validText" id="txtApellido" name="txtApellido" required="">
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-group col-md-6">
              <label for="txtTelefono">Teléfono</label>
              <input type="text" class="form-control valid validNumber" id="txtTelefono" name="txtTelefono" required="" onkeypress="return controlTag(event);">
            </div>
            <div class="form-group col-md-6">
              <label for="txtEmail">Email</label>
              <input type="email" class="form-control valid validEmail" id="txtEmail" name="txtEmail" required="">
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-group col-md-6">
              <label for="listRolid">Tipo usuario</label>
              <select class="seleccion2" id="listRolid" name="listRolid" required>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="listStatus">Status</label>
              <select class="seleccion2" id="listStatus" name="listStatus" required>
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-group col-md-6">
              <label for="txtPassword">Password</label>
              <input type="password" class="form-control" id="txtPassword" name="txtPassword">
            </div>
          </div>
          <div class="btn-group d-flex">
            <button class="btn btn-white btn-lg me-1 border btn_usu" type="button" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> <br>Cancelar</button>
            <button id="btnActionForm" class="btn btn-primary btn-lg me-1 border btn_usu" type="submit"><i class="fa-solid fa-circle-check"></i><br><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewUser" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal"><i class="fa-solid fa-address-card"></i> Datos del usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>Identificación:</td>
              <td id="celIdentificacion">654654654</td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre">Jacob</td>
            </tr>
            <tr>
              <td>Apellidos:</td>
              <td id="celApellido">Jacob</td>
            </tr>
            <tr>
              <td>Teléfono:</td>
              <td id="celTelefono">Larry</td>
            </tr>
            <tr>
              <td>Email (Usuario):</td>
              <td id="celEmail">Larry</td>
            </tr>
            <tr>
              <td>Tipo Usuario:</td>
              <td id="celTipoUsuario">Larry</td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado">Larry</td>
            </tr>
            <tr>
              <td>Fecha registro:</td>
              <td id="celFechaRegistro">Larry</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="d-grid gap-2">
      <button class="btn btn-white btn-lg  border" type="button" data-bs-dismiss="modal"><i class="fa-solid fa-circle-xmark"></i> <br>Cancelar</button>
      </div>
    </div>
  </div>
</div>

