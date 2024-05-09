<?php

#DataBase Methods

    function addCliente()
    {

        $query = "INSERT INTO `cliente`(`clienteId`, `usuario`, `nombre`, `apellido`, `fecha_nacimiento`, `email`, `telefono`, `registro` ) VALUES ('" . $this->cedula . "','" . $this->usuario . "','" . $this->nombre . "','" . $this->lastname . "','" . $this->birth . "','" . $this->email . "','" . $this->phone . "','" . $this->fecha . "' )";

        $send = $this->database->handleQuery($query);

        if (isset($send)) {
            return 1;
        } else {
            return 0;
        }
    }


?>