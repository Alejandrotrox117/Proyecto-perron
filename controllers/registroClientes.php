<?php
require_once('../models/usuarios.php');
require_once('../models/clientes.php');


if (isset($_POST['btn'])) {
    $submit = $_POST['btn'];
    $cedula = $_POST['cedula'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['email'];
    $telefono = $_POST['telefono'];
  }


?>