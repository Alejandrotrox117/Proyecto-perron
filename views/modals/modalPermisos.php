<!-- Modal PERMISOS-->
<div class="modal fade bd-example-modal-xl" id="modalPermisos" tabindex="-1" role="dialog"
  aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleModal">Permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="col-md-12">
          <div class="tile">
            <!--  Almacenamos el id del rol seleccionado-->
            <form action="" id="formPermisos" name="formPermisos">
              <input type="hidden" id="rolId" name="rolId" value="<?= $data['rolId']; ?>" required="">

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Modulo</th>
                      <th>Ver</th>
                      <th>Crear</th>
                      <th>Actualizar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $modulo = $data['modulo'];
                    for ($i = 0; $i < count($modulo); $i++) {
                      $permiso = $modulo[$i]['permiso'];

                      // Verificar si los permisos están activados o desactivados
                      $rCheck = isset($permiso['lectura']) && $permiso['lectura'] == 1 ? " checked " : "";
                      $wCheck = isset($permiso['escritura']) && $permiso['escritura'] == 1 ? " checked " : "";
                      $uCheck = isset($permiso['actualizar']) && $permiso['actualizar'] == 1 ? " checked " : "";
                      $dCheck = isset($permiso['eliminar']) && $permiso['eliminar'] == 1 ? " checked " : "";

                      $idmod = $modulo[$i]['moduloId'];
                      ?>
                      <tr>
                        <td>
                          <?= $no; ?>
                          <input type="hidden" name="modulo[<?= $i; ?>][moduloId]" value="<?= $idmod ?>" required>
                        </td>
                        <td>
                          <?= $modulo[$i]['titulo']; ?>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][lectura]" <?= $rCheck ?>>
                              <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][escritura]" <?= $wCheck ?>>
                              <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][actualizar]" <?= $uCheck ?>>
                              <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulo[<?= $i; ?>][eliminar]" <?= $dCheck ?>>
                              <span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
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
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary" id="btnGuardarPermiso"><i
                class="fa fa-fw fa-lg fa-check-circle"></i> Guardar</button>

            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"
                aria-hidden="true"></i>Salir</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>