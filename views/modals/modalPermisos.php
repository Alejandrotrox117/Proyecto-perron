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
              <input type="hidden" id="idRol" name="idRol" value="<?= $data['rolId']; ?>" required="">

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Modulo</th>
                      <th>Ver</th>
                      <th>Crear</th>
                      <th>Actualizar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $n = 1;
                    $modulos = $data['modulos'];
                    // Obtenemos permisos para la tabla
                    for ($i = 0; $i < count($modulos); $i++) {
                      $modulo = $modulos[$i];
                      $idmod = isset($modulo['idmodulo']) ? $modulo['idmodulo'] : '';

                      // Verificamos si el módulo tiene permisos definidos
                      if (isset($modulo['permisos'])) {
                        $permisos = $modulo['permisos'];
                        $lecturaChecked = isset($permisos['lectura']) && $permisos['lectura'] == 1 ? 'checked' : '';
                        $escrituraChecked = isset($permisos['escritura']) && $permisos['escritura'] == 1 ? 'checked' : '';
                        $actualizacionChecked = isset($permisos['actualizar']) && $permisos['actualizar'] == 1 ? 'checked' : '';
                        $eliminacionChecked = isset($permisos['eliminar']) && $permisos['eliminar'] == 1 ? 'checked' : '';
                      } else {
                        // Si no hay permisos definidos, asignamos valores por defecto
                        $lecturaChecked = '';
                        $escrituraChecked = '';
                        $actualizacionChecked = '';
                        $eliminacionChecked = '';
                      }
                      ?>
                      <tr>
                       
                          <input type="hidden" name="modulos[<?= $i; ?>][idmodulo]" value="<?= $idmod ?>" required>

                        
                        <td><?= $modulos[$i]['titulo']; ?>
                        </td>

                        <td>
                          <div class="toggle-flip ">
                            <label>
                              <input type="checkbox" name="modulos[<?= $i; ?>][lectura]" <?= $lecturaChecked; ?>><span
                                class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulos[<?= $i; ?>][escritura]" <?= $escrituraChecked; ?>><span
                                class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulos[<?= $i; ?>][actualizar]" <?= $actualizacionChecked; ?>><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                        <td>
                          <div class="toggle-flip">
                            <label>
                              <input type="checkbox" name="modulos[<?= $i; ?>][eliminar]" <?= $eliminacionChecked; ?>><span
                                class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                            </label>
                          </div>
                        </td>
                      </tr>
                      <?php

                      $n++;
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