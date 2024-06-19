<?php 
    headerAdmin($data); 
    getModal('modalUsuarios', $data);
  
?>


   <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa-solid fa-users-gear"></i> <?= $data['page_title'] ?>
          <button class="btn btn-primary" type="button" onclick="OpenModalUser();">
            <i class="fa-solid fa-plus"></i> Agregar</button>
        </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/roles"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
      <!-- Cuerpo principal de la tabla-->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaUsuarios">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Identificacion</th>
                      <th>Nombres</th>
                      <th>Apellidos</th>
                      <th>Telefono</th>
                      <th>email</th>
                      <th>password</th>
                      <th>Rif</th>
                      <th>Nombre Fiscal</th>
                      <th>Direccion</th>
                      <th>Toke</th>
                      <th>Rol</th>
                      <th>Creando en</th>
                      <th>Estado</th>
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