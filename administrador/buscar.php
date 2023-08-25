<?php
    session_start();
    
    $id=$_SESSION['cedu'];
    include_once("../conection/conexion.php");

    $sentencia1="SELECT * FROM usuarios,tipo_usu WHERE usuarios.id_tip_usu=tipo_usu.id_tip_usu";
    $resultado=$bd->prepare($sentencia1);
    $resultado->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles2.css">
    <title>Usuarios</title>
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page"  href="usuarios.php">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Ver facturas</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Crear facturas</a></li>
                    </ul>
                </div>
            </div>
            <div id="es"><a id="ses" href="../includes/salir.php"> Cerrar sesion </a></div>
        </nav>
    </div>

    
            <div id="nim">
            <a href="registrar.php"><button type="button" class="btn btn-primary">Registrar</button></a>
            </div>

        <form method="post"action="buscar.php">
        <input class="buscar"  type="search" name="buscar"  id="" placeholder="Buscar"> <a href="#"><button class="btn btn-primary">Busca</button></a> <br> <br>
        <div id="tag">
            <center>
        <table  class="table">
        <tr>
            <th class="bg-success" scope="col">Codigo</th>
            <th class="bg-secondary" scope="col">Tipo usuario</th>
            <th class="bg-success" scope="col">Usuario</th>
            <th class="bg-secondary" scope="col">Nombre</th>
            <th class="bg-success" scope="col">Apellido</th>
            <th class="bg-secondary" scope="col">Correo</th>
            <th class="bg-success" scope="col">Clave</th>
            <th class="bg-secondary" scope="col">Accion</th>
            <th class="bg-secondary" scope="col"></th>
        </tr>
        <?php
            $buscar=$_POST['buscar'];
            $cons="SELECT * FROM usuarios,tipo_usu WHERE id_usu=:ced or tip_usu=:tip and usuarios.id_tip_usu=tipo_usu.id_tip_usu";
            $select=$bd->prepare($cons);
            $select->execute(array(":ced"=>$buscar, ":tip"=>$buscar));
            foreach ($select as $move) {
        ?>
            <tr>
                <td><?php echo $move->id_usu;?></td>
                <td><?php echo $move->tip_usu?></td>
                <td><?php echo $move->usuario?></td>
                <td><?php echo $move->nombre_usuario?></td>
                <td><?php echo $move->apellido_usuario?></td>
                <td><?php echo $move->correo?></td>
                <td><?php echo /*$heren->passeord*/"XXXX"?></td>
                <td><a id="q1" class="btn btn-success mx-5" href="eliminar.php?id=<?php echo $move->id_usu?> & nomb=<?php echo $move->nombre_usuario?>"><img class="mi" src="../img/bote1.png" alt=""></a></td>
                <td><a id="q2" class="btn btn-success" href="modificar.php?id=<?php echo $move->id_usu?> & nomb=<?php echo $move->nombre_usuario?>"><img class="mi" src="../img/modi2.png" alt=""></a></td>
            
            </tr>
        <?php
        }
        ?>
    </div>
    </table>
    </form>
</body>
</html>