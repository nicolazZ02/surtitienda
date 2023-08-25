<?php
    require("../conection/conexion.php");

    $id=         $_POST['cod'];
    $nomb=         $_POST['nombre'];
    $apel=         $_POST['apellido'];
    $usu=          $_POST['usua'];
    $core=         $_POST['email'];
    $tip=          $_POST['tip'];


    try {
        $sql="UPDATE usuarios SET id_tip_usu=:tip, usuario=:us, nombre_usuario=:nom, apellido_usuario=:ape, correo=:ema WHERE id_usu=:id";
        $resulta=$bd->prepare($sql);
        $resulta->execute(array(":id"=>$id, ":tip" => $tip, ":us" => $usu, ":nom" => $nomb, ":ape" => $apel, ":ema"=>$core));
        echo"<script>alert('se actualizaron los datos')</script>";
        echo"<script>window.location='usuarios.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
        echo"No se pudo actualizar";
    }finally{
        $bd=null;
    }
?>