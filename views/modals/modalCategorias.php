<!-- Modal -->
<div class="modal fade" id="modalFormCategorias" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Nueva Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <h3 class="tile-title">Registrar Categorias</h3>
          <div class="tile-body">
        <form id="formCategorias" name="formCategotias" class="form-horizontal">
          <input type="hidden" id="idUsuario" name="idUsuario" value="">
          <p class="text-primary">Los campos con asteriscos(<span class="required">*</span>)</p>
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" id="idCategoria" name="idCategoria" value="">
              <div class="form-group">
                  <label class="control-label">Nombre <span class="required">*</span></label>
                  <input class="form-control" id="txtRol" name="txtRol" type="text" placeholder="Nombre de la Categoria" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción <span class="required">*</span></label>
                  <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Descripcion de la Categoria" required="">
                </div>
                <div class="form-group">
                  <label for="exampleSelect1">Estado <span class="required">*</span></label>
                  <select class="form-control" id="listStatus" name="listStatus" required="">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
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
                  <img id="img" src="<?= media(); ?>/img/categorias.png">
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
      </div>
      <div class="tile-footer">
        <button class="btn btn-primary" type="submit">
          <i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar
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