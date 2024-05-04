<?php 
    require_once("config/config.php");
    $url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
    $arrUrl = explode('/', $url);
    $controller = $arrUrl[0];
    $method = $arrUrl[0];
    $params = "";

    if(!empty($arrUrl[1])){
        if($arrUrl[1] != ""){
            $method = $arrUrl[1];
        }
    }

    if(!empty($arrUrl[2])){
        if($arrUrl[2] != ""){
            for($i = 2; $i < count($arrUrl); $i++){
                $params .= $arrUrl[$i].",";
            }
            $params = trim($params, ',');
        }
    }

    //clases de manera automatica
    spl_autoload_register(function($class){
       //validar si el archivo existe
        if(file_exists(LIBS.'core/'.$class.'.php')){
            require_once(LIBS.'core/'.$class.'.php');
        }
    });

    //load
    $controllerFile = 'controllers/'.$controller.'.php';
    //validar si existe el controlador
    if(file_exists($controllerFile)){
        require_once($controllerFile);
        //instanciar el controlador
        $controller = new $controller();
        //validar si existe el metodo y recibe un parametro 
        if(method_exists($controller, $method)){
            $controller->{$method}($params);
        }else{
            echo "Metodo no existe";
        }
    }else{ 
        echo "Controlador no existe";
    }
    // echo "<br>";
    // echo "controlador:".$controller;
    // echo "<br>";
    // echo "metodo: ".$method;
    // echo "<br>";
    // echo "parametros: ".$params;

?>