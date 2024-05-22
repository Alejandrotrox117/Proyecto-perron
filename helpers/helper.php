<?php  

    function base_url(){
        return BASE_URL;
    }

    function dep($data){
        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;
    }

    function strClean($str){
        $string = preg_replace('/[^A-Za-z0-9]/', ' ', $str);
        $string = trim($string);//Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string);
        $string = str_ireplace("<script>", "", $string);
        $string = str_ireplace("</script>", "", $string);
        $string = str_ireplace("<script src", "", $string);
        $string = str_ireplace("<script type=", "", $string);
        $string = str_ireplace("SELECT * FROM", "", $string);
        $string = str_ireplace("DELETE FROM", "", $string);
        $string = str_ireplace("INSERT INTO", "", $string);
        $string = str_ireplace("DROP TABLE", "", $string);
        $string = str_ireplace("OR '1'='1", "", $string);
        $string = str_ireplace('OR "1"="1"', "", $string);
        $string = str_ireplace('OR  ́1 ́= ́1', "", $string);
        $string = str_ireplace("is NULL; --", "", $string);
        $string = str_ireplace("is NULL; --", "", $string);
        $string = str_ireplace("LIKE '", "", $string);
        $string = str_ireplace('LIKE "', "", $string);
        $string = str_ireplace("LIKE  ́", "", $string);
        $string = str_ireplace("OR 'a'='a", "", $string);
        $string = str_ireplace('OR "a"="a', "", $string);
        $string = str_ireplace("OR  ́a ́= ́a", "", $string);
        $string = str_ireplace("OR  ́a ́= ́a", "", $string);
        $string = str_ireplace("--", "", $string);
        $string = str_ireplace("^", "", $string);
        $string = str_ireplace("[", "", $string);
        $string = str_ireplace("]", "", $string);
        $string = str_ireplace("==", "", $string);
        return $string;
    }


    //Genera una contraseña de 12 caracteres
     function passGenerator($length = 12){
        $pass = "";
        $longitudPass = $length;
        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena = strlen($caracteres);
        for($i = 1; $i <= $longitudPass; $i++){
            $pass .= $caracteres[rand(0, $longitudCadena - 1)];
        }
        return $pass;
    }
        

     function token(){
        $r1 = bin2hex(random_bytes(10));
        $r2 = bin2hex(random_bytes(10));
        $r3 = bin2hex(random_bytes(10));
        $r4 = bin2hex(random_bytes(10));
        $token = $r1 . '-' . $r2 . '-' . $r3 . '-' . $r4;
        return $token;
    }



     function formatMoney($cantidad){
        $cantidad = number_format($cantidad, 2, SPD, "");
        return $cantidad;
    }

?>