<?php
    require("../../conection/conexion.php");

    if(isset($_POST['bt'])){
		$idu=               $_POST['nit'];
		$nombre=            $_POST['nombre'];
        $tel=          $_POST['tel'];
        $dir=           $_POST['dir'];

		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql1="INSERT INTO proveedor (nit, nombre, telefono, direccion) values (?, ?, ?, ?)";
		$resultado=$bd->prepare($sql1);//$base es el nombre de la conexión
		$resultado->execute(array($idu, $nombre, $tel, $dir));
        echo"<script>alert('Se registraron los datos correctament')</script>";
        echo"<script>window.location='prove.php'</script>";
	}

	    ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/resg_pro.css">
    <title>Registrar</title>
</head>
<body>
    <div id="res">
        <div id="h2"><h2 id="h2_1">Registro de proveedores</h2></div>
    <form method="post">
        <input name="nit" type="hidden" placeholder="Ingrese NIT">
        <div id="lab1"><label>Nombre proveedor:</label></div>
        <input id="inp1" name="nombre" type="text" placeholder="Ingrese del proveedor">
        <div id="lab2"><label>Telefono:</label></div>
        <input id="inp2" name="tel" type="number" placeholder="Ingrese telefono">
        <div id="lab3"><label>Direccion:</label></div>
        <input id="inp3" name="dir" type="text" placeholder="Ingrese direccion">
        
        <input id="bot" type="submit" name="bt" value="Registrar">
    </form>
    </div>
</body>
</html>