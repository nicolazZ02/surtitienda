<?php
    require("../conection/conexion.php");

    if(isset($_POST['bt'])){
		$idu=               $_POST['cod'];
		$tipo=            $_POST['tipo'];
        $_SESSION['type']=$tipo;
        $nombre=          $_POST['nomb'];
        $apellido=           $_POST['apellido'];

		$password=          $_POST['clave'];
		$pass_cifrado=password_hash($password,PASSWORD_DEFAULT,array("clave"=>12));//encripta lo que hay en la variable password
		$ema=               $_POST['correo'];
        $usu=               $_POST['usuario'];

		?>
		<input type="number" name="idd" value="<?php echo $idu?>">
		<?php 
		$sql1="INSERT INTO usuarios (id_usu, id_tip_usu, usuario, nombre_usuario, apellido_usuario, correo, clave) values (?, ?, ?, ?, ?, ?, ?)";
		$resultado=$bd->prepare($sql1);//$base es el nombre de la conexión
		$resultado->execute(array($idu,$tipo,$usu,$nombre,$apellido,$ema,$pass_cifrado));
        echo"<script>alert('Se registraron los datos correctament')</script>";
        echo"<script>window.location='usuarios.php'</script>";
	}

	    ?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles3.css">
    <title>Registrar</title>
</head>
<body>
    <div id="res">
        <div id="h2"><h2 id="h2_1">Registro de usuarios</h2></div>
    <form method="post">
        <div id="lab1"><label>Cedula:</label></div>
        <input id="inp1" name="cod" type="text" placeholder="Ingrese cedula">
        <div id="lab2"><label>Nombre:</label></div>
        <input id="inp2" name="nomb" type="text" placeholder="Ingrese nombre">
        <div id="lab3"><label>Apellido:</label></div>
        <input id="inp3" name="apellido" type="text" placeholder="Ingrese apellido">
        <div id="lab4"><label>Usuario:</label></div>
        <input id="inp4" name="usuario" type="text" placeholder="Ingrese usuario">
        <div id="lab5"><label>Correo:</label></div>
        <input id="inp5" name="correo" type="text" placeholder="Ingrese correo">
        <div id="lab6"><label>Contraseña:</label></div>
        <input id="inp6" name="clave" type="password" placeholder="Ingrese contraseña">
        <div id="lab7"><label>Tipo de usuario:</label></div>
        <select id="inp7" name="tipo" id="" scope="col">
            <option value="text">Seleccione</option>
        <?php
		    $sql= "SELECT * FROM tipo_usu"; 
		    $resultado=$bd->prepare($sql);
		    $resultado->execute(array());
		    while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
		    ?> 
                <option value="<?php echo($registro['id_tip_usu'])?>" > <?php echo($registro['tip_usu'])?>
            <?php 
                }
            ?>
        </select>
        <input id="bot" type="submit" name="bt" value="Registrar">
    </form>
    </div>
</body>
</html>