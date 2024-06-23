<!-- Modal -->
<div class="modal fade" id="modalFormRol" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel">
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
              <div class="form-group">
                <input type="hidden" id="rolId" name="rolId" value="">
                <label class="form-control-label" for="txtRol">Nombre del Rol</label>
                <input class="form-control" id="txtRol" name="txtRol" type="text">
                <div id="error-txtRol-vacio" class="form-control-feedback text-danger" style="display: none;">El campo nombre es obligatorio.</div>
                <div id="error-txtRol-formato" class="form-control-feedback text-danger" style="display: none;">El nombre debe contener solo letras y espacios.</div>
              </div>
              <div class="form-group">
                <label class="form-control-label" for="txtDescripcion">Descripción</label>
                <input class="form-control" id="txtDescripcion" name="txtDescripcion" type="text" >
                <div id="error-txtDescripcion-vacio" class="form-control-feedback text-danger" style="display: none;">El campo descripción es obligatorio.</div>
                <div id="error-txtDescripcion-formato" class="form-control-feedback text-danger" style="display: none;">La descripción debe contener solo letras, números y algunos símbolos.</div>
              </div>
              <div class="form-group">
                <label class="form-control-label" for="listEstatus">Estado</label>
                <select class="form-control" id="listEstatus" name="listEstatus" >
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
          </div>
        </div>
        <div class="tile-footer">
          <button class="btn btn-primary" type="submit" id="btnActionForm" name="btnActionForm">
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
