<?php 
class HomeModels{
    public function __construct()
    {
        //echo  "mensaje desde el modelo home";
    }

    public function getCarrito($params){
        return "carrito No. ".$params;
    }
}

?>