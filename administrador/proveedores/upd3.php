<?php
    require("../../conection/conexion.php");

    $id=         $_POST['cod'];
    $nomb=         $_POST['nombre'];
    $tel=         $_POST['tel'];
    $dir=          $_POST['dir'];


    try {
        $sql="UPDATE proveedor SET nombre=:nom, telefono=:tele, direccion=:dir WHERE nit=:id";
        $resulta=$bd->prepare($sql);
        $resulta->execute(array(":id"=>$id, ":nom"=>$nomb, ":tele" => $tel,":dir"=>$dir));
        echo"<script>alert('se actualizaron los datos')</script>";
        echo"<script>window.location='prove.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
        echo"No se pudo actualizar";
    }finally{
        $bd=null;
    }
?>