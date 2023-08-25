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
include("../../conection/conexion.php");
$id=$_GET["id"];
$nombre=$_GET["nomb"];
echo "Se va a eliminar el producto " . $nombre,  " Si está seguro presione el Botón Eliminar, de lo contrario presione volver";
        if(isset($_POST['elimina'])){
        $bd->query("DELETE FROM productos WHERE cod_product='$id'");
        echo'<script>alert("Se borro el usuario '.$nombre.' con exito")</script>';
        echo"<script>window.location='index.php'</script>";
        }
        ?>
            <form method="post">
                <td><input id="bot1" type="submit" name="elimina" id="elimina" value="Eliminar"></td>
                <td><a href="index.php"><input id="bot2" type="button" name="volver" id="elimina" value="Volver"></a></td>
            </form>
</div>
</body>
</html>