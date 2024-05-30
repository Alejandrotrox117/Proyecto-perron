<<<<<<< HEAD
<?php headerAdmin($data); ?>
   <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa-solid fa-users-gear"></i> <?= $data['page_title'] ?></h1>
          <p>Start a beautiful journey here</p>
=======
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
>>>>>>> Richard
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
<<<<<<< HEAD
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">Roles de usuarios</div>
=======
      <!-- Cuerpo principal de la tabla-->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaRoles">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Descripción</th>
                      <th>Estatus</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
>>>>>>> Richard
          </div>
        </div>
      </div>
    </main>
    <?php footerAdmin($data); ?>