<?php
    require("../../conection/conexion.php");




    try {
        $sql="UPDATE facturas SET id_esta=:tip WHERE n_factu=:id";
        $resulta=$bd->prepare($sql);
        $resulta->execute(array(":id"=>$id, ":tip" => $tip));

        $sql2="SELECT * FROM detalle_factu";
        $del=$bd->prepare($sql2);
        $del->execute();
        $registro1=$del->fetch(PDO::FETCH_ASSOC);
        $numede=$registro1['id_detal'];

            $sql="DELETE FROM detalle_factu WHERE n_factu=:cod ";
            $resultado=$bd->prepare($sql);
            $resultado->execute(array(":cod"=>$id));

            $bd->query("DELETE FROM detalle_factu WHERE id_detal='$numede' and n_factu='$id'");

                

        echo"<script>alert('se actualizaron los datos')</script>";
        echo"<script>window.location='factu.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
        echo"No se pudo actualizar";
    }finally{
        $bd=null;
    }
?>