<!-- Modal -->
<div class="modal fade modalPermisos" id="modalPermisos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header headerRegister">
                <h1 class="modal-title fs-4" id="titleModal"><i class="fa-solid fa-sliders"></i> Permisos de rol de Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                    <div class="tile-title">
                        <form id="formPermisos" name="formPermisos">
                            <input type="hidden" id="idrol" name="idrol" value="<?= $data['idrol']; ?>" required="">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="tableRoles">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Módulo</th>
                                            <th>Ver</th>
                                            <th>Crear</th>
                                            <th>Actualizar</th>
                                            <th>Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $modulos = $data['modulos'];
                                        for ($i = 0; $i < count($modulos); $i++) {

                                            $permisos = $modulos[$i]['permisos'];
                                            $rCheck = $permisos['r'] == 1 ? " checked " : "";
                                            $wCheck = $permisos['w'] == 1 ? " checked " : "";
                                            $uCheck = $permisos['u'] == 1 ? " checked " : "";
                                            $dCheck = $permisos['d'] == 1 ? " checked " : "";

                                            $idmod = $modulos[$i]['idmodulo'];
                                        ?>
                                            <tr>
                                                <td>
                                                    <?= $no; ?>
                                                    <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>
                                                </td>
                                                <td>
                                                    <?= $modulos[$i]['titulo']; ?>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label class="toggle">
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][r]" <?= $rCheck ?>>
                                                            <span class="button-indecator" data-toggle-on="<i class='fas fa-toggle-on'></i> ON" data-toggle-off="<i class='fas fa-toggle-off'></i> OFF">

                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label class="toggle">
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][w]" <?= $wCheck ?>>
                                                            <span class="button-indecator" data-toggle-on="<i class='fas fa-toggle-on'></i> ON" data-toggle-off="<i class='fas fa-toggle-off'></i> OFF">

                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label class="toggle">
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][u]" <?= $uCheck ?>>
                                                            <span class="button-indecator" data-toggle-on="<i class='fas fa-toggle-on'></i> ON" data-toggle-off="<i class='fas fa-toggle-off'></i> OFF">

                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="toggle-flip">
                                                        <label class="toggle">
                                                            <input type="checkbox" name="modulos[<?= $i; ?>][d]" <?= $dCheck ?>>
                                                            <span class="button-indecator" data-toggle-on="<i class='fas fa-toggle-on'></i> ON" data-toggle-off="<i class='fas fa-toggle-off'></i> OFF">

                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex">
                                <button type="button" class="btn form-control btn-white btn-lg me-1 border boton" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-circle-xmark"></i> <br>Cancelar
                                </button>
                                <button id="btnActionForm" type="submit" class="btn form-control border btn-primary boton btn-lg"><i class="fa-solid fa-circle-check"></i></i><br>
                                    <span id="btnText">Guardar</span>
                                </button>
                            </div>


                        </form>
                    </div>
               
            </div>
        </div>