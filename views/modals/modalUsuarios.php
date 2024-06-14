<!-- Modal -->
<div class="modal fade" id="modalFormUser" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="formUsuarios" name="formUsuarios" class="form-horizontal">
          <input type="hidden" id="UsuarioId" name="UsuarioId" value="">
          <p class="text-primary">Todos los campos son obligatorios.</p>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtIdentificacion">Identificación</label>
              <input type="text" class="form-control" id="txtIdentificacion" name="txtIdentificacion" required="">
            </div>


          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtnombres">Nombres</label>
              <input type="text" class="form-control" id="txtnombres" name="txtnombres" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtApellidos">Apellidos</label>
              <input type="text" class="form-control" id="txtApellidos" name="txtApellidos" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtTelefonos">Telefono</label>
              <input type="text" class="form-control" id="txtTelefonos" name="txtTelefonos" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtEmail">Email</label>
              <input type="text" class="form-control" id="txtEmail" name="txtEmail" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtRif">Rif</label>
              <input type="text" class="form-control" id="txtRif" name="txtRif" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtNameF">Nombre Fiscar</label>
              <input type="text" class="form-control" id="txtNameF" name="txtNameF" required="">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="txtToken">Token</label>
              <input type="text" class="form-control" id="txtToken" name="txtToken" required="">
            </div>
            <div class="form-group col-md-6">
              <label for="txtpassword">Contraseña</label>
              <input type="password" class="form-control" id="txtpassword" name="txtpassword" required="">
            </div>
          </div>
          <div class="form-row">
           
            <div class="form-group col-md-6">
              <label for="listRolid">Rol</label>
              <select  class="form-control" id="listRolid" name="listRolid" required=""></select>
            </div>
            <div class="form-group col-md-6">
              <label for="txtstatus">Rol</label>
              <select  class="form-control" id="txtstatus" name="txtstatus" required="">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
              </select>
            </div>
          </div>
          <div class="tile-footer">
      <button class="btn btn-primary" type="submit" id="btnActionForm">
        <i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Guardar</span>
      </button>

      &nbsp;&nbsp;&nbsp;
      <button class="btn btn-danger" href="#" data-dismiss="modal">
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

