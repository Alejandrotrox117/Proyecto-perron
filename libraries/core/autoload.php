<?php 
 //clases de manera automatica
 spl_autoload_register(function($class){
    //validar si el archivo existe
     if(file_exists(LIBS.'core/'.$class.'.php')){
         require_once(LIBS.'core/'.$class.'.php');
     }
 });
?>