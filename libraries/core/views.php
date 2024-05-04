<?php 
class Views{
    public function getView($controller,$view){
    $controller = get_class($controller);
    //Validamos que el archivo inicial sea el inicio
        if($controller=="Home"){
            $view = VIEWS."/".$view.".php";
        }else{
            //Si no es el inicio en el caso contrario sigue con otro controlador
            $view = VIEWS.$controller."/".$view.".php";
        }
        //requerimos el archivo
        require_once($view);
    }
}

    

?>