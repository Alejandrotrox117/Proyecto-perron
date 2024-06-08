<!-- Modal -->
<div class="modal fade" id="modals_productos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <form id="formProductos" name="formProductos" class="form-horizontal">
          <p class="text-primary">Los campos con asteriscos(<span class="required">*</span>)</p>
          <div class="row">
            <div class="col-md-6">
              <input type="hidden" id="idProducto" name="idProducto" value="">
              <div class="form-group">
                  <label class="control-label">Nombre <span class="required">*</span></label>
                  <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del Productos" required="">
                </div>
                <div class="form-group">
                  <label class="control-label">Descripción <span class="required">*</span></label>
                  <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" placeholder="Descripcion del Productos" required="">
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
