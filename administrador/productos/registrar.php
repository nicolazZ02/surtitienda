<?php
    require("../../conection/conexion.php");

    if(isset($_POST['bt'])){
		$idu=               $_POST['cod'];
		$nit=            $_POST['nit'];
        $nombre=          $_POST['nombre'];
        $precio=           $_POST['precio'];
		$ex=               $_POST['exist'];
 

		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql1="INSERT INTO productos (cod_product, nit, nombre_p, precio, cantidadp) values (?, ?, ?, ?, ?)";
		$resultado=$bd->prepare($sql1);//$base es el nombre de la conexión
		$resultado->execute(array($idu, $nit, $nombre, $precio, $ex));
        echo"<script>alert('Se registraron los datos correctamente')</script>";
        echo"<script>window.location='index.php'</script>";
	}

	    ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/res_product.css">
    <title>Registrar</title>
</head>
<body>
    <div id="res">
        <div id="h2"><h2 id="h2_1">Registro de usuarios</h2></div>
    <form method="post">
        <input  name="cod" type="hidden" placeholder="Ingrese codigo">
        <div id="lab1"><label>NIT:</label></div>
        <input id="inp1" name="nit" type="number" placeholder="Ingrese NIT">
        <div id="lab2"><label>Nombre producto:</label></div>
        <input id="inp2" name="nombre" type="text" placeholder="Ingrese nombre del producto">
        <div id="lab3"><label>Precio:</label></div>
        <input id="inp3" name="precio" type="number" placeholder="Ingrese el precio">
        <div id="lab4"><label>Existencia:</label></div>
        <input id="inp4" name="exist" type="number" placeholder="Ingrese la existencia">
       
        
        <input id="bot" type="submit" name="bt" value="Registrar">
    </form>
    </div>
</body>
</html>