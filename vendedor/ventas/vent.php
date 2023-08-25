<?php
    session_start();
    require("../../conection/conexion.php");
    $id=$_SESSION['cedu'];
    $nombre=$_SESSION['nomb'];
    $apellido=$_SESSION['apel'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/bus_c.css">
    <title>Ventas</title>
</head>
<body>
<div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom border-warning">
            <div class="container-fluid">
                <a href="index.php" class="navbar-brand">Surtitienda</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="MenuNavegacion" class="collapse navbar-collapse">
                    <ul class="nav nav-tabs ms-3">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link"></a></li>
                        <li class="nav-item"><a class="nav-link" ></a></li>
                        <li class="nav-item"><a class="nav-link" </a></li>
                        <li class="nav-item"><a class="nav-link" ></a></li>
                        <li class="nav-item"><a class="nav-link active" href="../ventas/vent.php">Crear venta</a></li>
                        <li class="nav-item"><a class="nav-link" href="../facturas/factu.php">Ver facturas</a></li>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <p id="p">Bienvenido(a) <?php echo $nombre ?>  <?php echo $apellido ?></p>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                                <li><a class="dropdown-item"  href="../../includes/salir.php">Cerrar sesion</a></li>
                                </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">

    <div id="date" bgcolor="orange">
			<tr>
	
		<h3 id="h3">VENDER</h3>

		<div id="tab" align="center" border="1" bordercolor="red">
		
			<tr><td id="td"  colspan="3"><h4 id="h4_1">Datos del Cliente</h4></td></tr>
            <label id="de">Identificación:</label>
			<tr><td ><input id="inp" type="number" name="ide"><input id="but" class="btn btn-primary" type="submit" name="buscar" value="Buscar"></td>
    </div>
        <table id="dev">
        <?php
        require("../../conection/conexion.php");
        if (isset($_GET['buscar'])) {
            $busqueda=$_GET['ide'];
            $sql="SELECT * FROM clientes WHERE id_cliente=:id";
            $result=$bd->prepare($sql);
            $result->execute(array(":id"=>$busqueda));
                if ($resg = $result->fetch(PDO::FETCH_ASSOC)) {
                    $ced=$_GET['ide'];
                    $_SESSION['ide']=$ced;
                    $nomb=$resg['nombre'];
                    $_SESSION['name']=$nomb;
                    $ape= $resg['apellido'];
                    $_SESSION['last']=$ape;
                    $tel= $resg['tel'];
                    $nombre=$_SESSION['nomb'];
                    $apellido=$_SESSION['apel'];
?>                
        </form>
        
            <form method="get">
                    <td><label id="lab1">Nombre:</label></td>
                    <td><input id="nom1" type="text" name="nombre" readonly value="<?php echo $nomb?>"></td>
                    <td><label id="lab2">Apellido:</label></td>
                    <td><input id="nom2" type="text" name="apel" readonly value="<?php echo $ape?>"></td>
                    <td><label id="lab3">Identificación:</label></td>
                    <td><input id="nom3" type="text" name="ide" readonly value="<?php echo $ced?>"></td>
                    <td><label id="lab4">Vendedor:</label></td>
                    <td><input id="nom4" type="text" name="ven" readonly value="<?php echo $nombre?> <?php echo $apellido?>"></td></table>

                
<?php
                }else {
                   header('Location:../clientes/clientes.php');
                }
        }
        ?>
        <br>
        <table id="ini">
       
           
                <tr>
                <a href="detal_tempo.php?id=<?php echo $ced ?> &nomb=<?php echo $nomb ?> &apel=<?php echo $ape?> &nombven=<?php echo $nombre ?> &doc=<?php echo $id ?>"><button type="button" class="boton cinco" name="cargar">
                    <div class="icono">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
					</svg>
				</div>
                <span>Iniciar Venta</span>    
            </button></a></tr>
            
        <?php

        ?>
         </table>
        
        
       
        </form>
        
    </form>

</body>
</html>