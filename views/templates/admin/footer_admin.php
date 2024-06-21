<!-- URL base para usarlo en javascript -->
<script>
  const base_url = "<?= base_url(); ?>";
</script>
<!-- Essential javascripts for application to work-->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/popper.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.min.js"></script>
    <script src="<?= media(); ?>/js/main.js"></script>
    <script src="<?= media(); ?>/js/functions_admin.js"></script>
    <script type="module" src="<?= media(); ?>/js/functions_Roles.js"></script>
    <script src="<?= media(); ?>/js/functions_usuarios.js"></script>
    <script src="<?= media(); ?>/js/functions_categorias.js"></script>
    <script src="<?= media(); ?>/js/functions_productos.js"></script>
    <script type="module" src="<?= media(); ?>/js/functions_permisos.js"></script>
    <script src="<?= media(); ?>/js/fontawesome.js" crossorigin="anonymous"></script>
  
    <script src="<?= media(); ?>/js/plugins/pace.min.js"></script>
   <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/sweetalert.min.js"></script>

    <!-- Libreria de edicion en textareas-->
    <script type="text/javascript" src="<?= media(); ?>/js/tinymce/tinymce.min.js"></script>
    
    <!-- Data table plugin-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/dataTables.bootstrap.min.js"></script>
  </body>
</html>