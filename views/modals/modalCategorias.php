<!-- Modal -->
<div class="modal fade" id="modalFormCategorias" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <h3 class="tile-title"></h3>
          <div class="tile-body">
        <form id="formCategorias" name="formCategorias" class="form-horizontal">
          <input type="hidden" id="foto_actual" name="foto_actual" value="">
          <input type="hidden" id="foto_remove" name="foto_remove" value="0">
          <p class="text-primary">Los campos con asteriscos(<span class="required">*</span>)</p>
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" id="idCategoria" name="idCategoria" value="">
              <div class="form-group">
                  <label class="control-label">Nombre <span class="required">*</span></label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre de la Categoria" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción <span class="required">*</span></label>
                  <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Descripcion de la Categoria" required="">
                </div>
                <div class="form-group">
                  <label for="exampleSelect1">Estado <span class="required">*</span></label>
                  <select class="form-control" id="listEstatus" name="listEstatus" required="">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                </div>
            </div>
            <div class="col-md-6">
            <div class="photo">
              <label for="foto">Foto (570x380)</label>
              <div class="prevPhoto">
                <span class="delPhoto notBlock">X</span>
                <label for="foto"></label>
                <div>
                  <img id="img" src="<?= media(); ?>/img/uploads/categorias.png">
                </div>
              </div>
              <div class="upimg">
                <input type="file" name="foto" id="foto">
              </div>
              <div id="form_alert"></div>
            </div>
          </div>
          </div>
      </div>
      <div class="tile-footer">
        <button class="btn btn-primary" id="btnActionForm" type="submit" name="enviar">
          <i class="fa fa-fw fa-lg fa-check-circle" id="btnText"></i>
        </button>
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-secondary" href="#" data-dismiss="modal">
          <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar
          </button>
        </form>
      </div>
    </div>
     </div>
      </div>  
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalViewCategoria" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos de la categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
          <tbody>
            <tr>
              <td>ID:</td>
              <td id="celId"></td>
            </tr>
            <tr>
              <td>Nombres:</td>
              <td id="celNombre"></td>
            </tr>
            <tr>
              <td>Descripción:</td>
              <td id="celDescripcion"></td>
            </tr>
            <tr>
              <td>Estado:</td>
              <td id="celEstado"></td>
            </tr>
            <tr>
              <td>Foto:</td>
              <td id="imgCategoria"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>