<?php 
headerAdmin($data);
getModal('ModalsRol', $data);
?>
<div id="contentAjax"></div> 
 
<main class="app-content">

    <div class="app-title">
        <div>
            <h1 class="fw-bold"><i class="fa-solid fa-user-gear"></i> <?= $data['page_title'] ?>
                <button class="btn btn-primary bi_icon justify-content-md-end" type="button" onclick="openModal();"><i class="fa-solid fa-circle-plus"></i> Nuevo</button>
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
            <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tableRoles">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Status</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php footerAdmin($data); ?>