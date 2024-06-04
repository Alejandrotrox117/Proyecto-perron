
<!-- Modal -->
<div class="modal fade" id="modalFormRol" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="tile">
          <div class="tile-body">
            <form id="formRol" name="formRol">
              <input type="hidden" id="idRol" name="idRol" value="">
            <div class="form-group">
                <label class="control-label">Nombre del Rol</label>
                <input class="form-control" id="txtRol" name="txtRol" type="text" required="" >
              </div>
              <div class="form-group">
                <label class="control-label">Descripción</label>
                <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" required="" >
              </div>
              <div class="form-group">
                <label for="exampleSelect1">Estado</label>
                <select class="form-control" id="listEstatus" name="listEstatus" required="" >
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
          </div>
      </div>
      <div class="tile-footer">
        <button class="btn btn-primary" type="submit" id="btnActionForm">
          <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span>
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