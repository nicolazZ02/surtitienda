<?php
    require("../../conection/conexion.php");

    $id=         $_POST['cod'];
    $nomb_c=         $_POST['nombre_c'];
    $fech=          $_POST['fecha'];
    $vend=         $_POST['vendedor'];
    $val=          $_POST['valt'];


    try {
        $sql="UPDATE facturas SET id_cliente=:nc, fecha_creacion=:fech, id_usu=:ven, valor_total=:tot WHERE n_factu=:id";
        $resulta=$bd->prepare($sql);
        $resulta->execute(array(":id"=>$id, ":nc" => $nomb_c, ":fech" => $fech, ":ven" => $vend, ":tot"=>$val));
        echo"<script>alert('se actualizaron los datos')</script>";
        echo"<script>window.location='factu.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
        echo"No se pudo actualizar";
    }finally{
        $bd=null;
    }
?>