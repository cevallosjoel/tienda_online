<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="__user-avatar" src="<?= media();?>/images/avatar.ico" alt="User Image">
    <div>
      <p class="app-sidebar__user-name text-dark"><?= $_SESSION['userData']['nombres']; ?></p>
      <p class="app-sidebar__user-designation text-dark"><?= $_SESSION['userData']['nombrerol']; ?></p>
    </div>
  </div>
  <ul class="app-menu">
  <?php if(!empty($_SESSION['permisos'][1]['r'])){ ?>
    <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
                <i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
    <?php } ?>
    <?php if(!empty($_SESSION['permisos'][2]['r'])){ ?>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="fa-solid fa-user app-menu__icon"></i><span class="app-menu__label"> Usuarios</span><i class="treeview-indicator bi bi-chevron-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon bi bi-circle-fill"></i> Usuarios</a></li>
        <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon bi bi-circle-fill"></i> Roles</a></li>
      </ul>
    </li>
    <?php } ?>
    <li><a class="app-menu__item" href="<?= base_url(); ?>/clientes"><i class="fa-solid fa-users app-menu__icon"></i><span class="app-menu__label"> Clientes</span></a></li>
    <li><a class="app-menu__item" href="<?= base_url(); ?>/productos"><i class="fa-brands fa-product-hunt app-menu__icon"></i><span class="app-menu__label"> Productos</span></a></li>
    <li><a class="app-menu__item" href="<?= base_url(); ?>/pedidos"><i class="fa-solid fa-truck app-menu__icon"></i><span class="app-menu__label"> Pedidos</span></a></li>

  </ul>
</aside>