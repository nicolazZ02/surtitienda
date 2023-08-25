<?php
    $clave="";
    $usu="root";
    $bd="surtitienda";

    try {
        $bd=new PDO('mysql:host=localhost;dbname='.$bd,$usu,$clave);
        $bd->query("set names utf8;");
        $bd->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    } catch (\Throwable $th) {
        echo"Ocurrio un error con la conexion:".$th->getMessage();
    }
?>