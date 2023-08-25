<?php
    require("../../conection/conexion.php");

    $id=         $_POST['cod'];
    $nomb=         $_POST['nombre'];
    $apel=         $_POST['apellido'];
    $tel=         $_POST['tel'];
    $dir=          $_POST['dir'];


    try {
        $sql="UPDATE clientes SET nombre=:nom, apellido=:ape, tel=:tele, direccion=:dir WHERE id_cliente=:id";
        $resulta=$bd->prepare($sql);
        $resulta->execute(array(":id"=>$id, ":nom"=>$nomb, ":ape" => $apel, ":tele" => $tel,":dir"=>$dir));
        echo"<script>alert('se actualizaron los datos')</script>";
        echo"<script>window.location='index.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
        echo"No se pudo actualizar";
    }finally{
        $bd=null;
    }
?>