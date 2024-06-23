<?php

// Función para validar un campo
function validarCampo($campo, $valor, $regex) {
  if (preg_match($regex, $valor)) {
    return true;
  } else {
    return false;
  }
}

// Expresiones regulares
const REGEX_ROL_ID = '/^\d+$/';
const REGEX_NOMBRES = '/^[a-zA-Z\s]+$/';
const REGEX_DESCRIPCION = '/.*/';
const REGEX_ESTATUS = '/^\d+$/';

// Función para validar un formulario
function validarFormulario($datos, $reglas) {
  $valido = true;
  foreach ($reglas as $campo => $regex) {
    if (!isset($datos[$campo]) || !validarCampo($campo, $datos[$campo], $regex)) {
      $valido = false;
      break;
    }
  }
  return $valido;
}

?>