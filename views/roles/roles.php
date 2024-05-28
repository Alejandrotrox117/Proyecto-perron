<?php headerAdmin($data); 
  getModal('modals_roles', $data);
?>
   <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa-solid fa-users-gear"></i> <?= $data['page_title'] ?>
          <button class="btn btn-primary" type="button" onclick="OpenModal();">
            <i class="fa-solid fa-plus"></i> Agregar</button>
        </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Roles de usuarios</div>
          </div>
        </div>
      </div>
    </main>
    <?php footerAdmin($data); ?>