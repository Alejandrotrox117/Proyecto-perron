<?php 
 include '../models/db.php';

     $db = new Database();
     $productos = $db->sqlQuery("SELECT * FROM productos ");
     
?>