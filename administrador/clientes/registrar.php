<?php
    require("../../conection/conexion.php");

    if(isset($_POST['bt'])){
		$idu=               $_POST['cod'];
        $nombre=          $_POST['nomb'];
        $apellido=           $_POST['apellido'];
		$tel=               $_POST['tel'];
        $dir=               $_POST['dir'];

		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql1="INSERT INTO clientes (id_cliente, nombre, apellido, tel, direccion) values (?, ?, ?, ?, ?)";
		$resultado=$bd->prepare($sql1);//$base es el nombre de la conexión
		$resultado->execute(array($idu,$nombre,$apellido,$tel,$dir));
        echo"<script>alert('Se registraron los datos correctament')</script>";
        echo"<script>window.location='index.php'</script>";
	}

	    ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/res_clientes.css">
    <title>Registrar</title>
</head>
<body>
    <div id="res">
        <div id="h2"><h2 id="h2_1">Registro de clientes</h2></div>
    <form method="post">
        <div id="lab1"><label>Cedula:</label></div>
        <input id="inp1" name="cod" type="text" placeholder="Ingrese cedula">
        <div id="lab2"><label>Nombre:</label></div>
        <input id="inp2" name="nomb" type="text" placeholder="Ingrese nombre">
        <div id="lab3"><label>Apellido:</label></div>
        <input id="inp3" name="apellido" type="text" placeholder="Ingrese apellido">
        <div id="lab4"><label>Telefono:</label></div>
        <input id="inp4" name="tel" type="text" placeholder="Ingrese un telefono">
        <div id="lab5"><label>Direccion:</label></div>
        <input id="inp5" name="dir" type="text" placeholder="Ingrese una direccion">
        <input id="bot" type="submit" name="bt" value="Registrar">
    </form>
    </div>
</body>
</html>