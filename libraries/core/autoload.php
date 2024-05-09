<?php 
 //clases de manera automatica
 spl_autoload_register(function($class){
    //validar si el archivo existe
     if(file_exists("libraries/".'core/'.$class.'.php')){
         require_once("libraries/".'core/'.$class.'.php');
     }
 });
?>