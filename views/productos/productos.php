<?php 
    headerAdmin($data); 
    getModal('modalProductos', $data);
?>
   <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fas fa-box-tissue"></i> <?= $data['page_title'] ?>
          <button class="btn btn-primary" type="button" onclick="OpenModalProductos();">
            <i class="fa-solid fa-plus"></i> Agregar</button>
        </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>/productos"><?= $data['page_title'] ?></a></li>
        </ul>
      </div>
      <!-- Cuerpo principal de la tabla-->
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tablaProductos">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Stock</th>
                      <th>Precio</th>
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