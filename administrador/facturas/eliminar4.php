<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/styles4.css">
	<meta charset="utf-8">
	<title>Eliminar</title>
</head>
<body>
    <div id="dav">
<?php
session_start();
include("../../conection/conexion.php");
            $sql = "SELECT * FROM detalle_factu";
            $resultado3=$bd->prepare($sql);
            $resultado3->execute(array());
            $registro1=$resultado3->fetch(PDO::FETCH_ASSOC);
            $numede=$registro1['id_detal'];
           

    $id=$_GET["id"];

echo "Se va a eliminar la factura numero " . $id . " Si está seguro presione el Botón Eliminar, de lo contrario presione volver";
        if(isset($_POST['elimina'])){

            $sql="DELETE FROM detalle_factu WHERE n_factu=:cod ";
            $resultado=$bd->prepare($sql);
            $resultado->execute(array(":cod"=>$id));

            $bd->query("DELETE  FROM facturas WHERE n_factu='$id'");

            $bd->query("DELETE FROM detalle_factu WHERE id_detal='$numede'");
            echo'<script>alert("Se borro la factura numero '.$id.' con exito")</script>';
            echo"<script>window.location='factu.php'</script>";
        }
        ?>
            <form method="post">
                <td><input id="bot1" type="submit" name="elimina" id="elimina" value="Eliminar"></td>
                <td><a href="factu.php"><input id="bot2" type="button" name="volver" id="elimina" value="Volver"></a></td>
            </form>
</div>
</body>
</html>