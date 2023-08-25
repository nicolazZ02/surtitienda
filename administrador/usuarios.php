<?php
    session_start();
    

    include_once("../conection/conexion.php");

    $cedu1=$_SESSION['cedu'];
    $nombre1=$_SESSION['nomb'];
    $apellido=$_SESSION['apel'];
    $tipo=$_SESSION['tipo'];
    $tip=$_SESSION['tip'];


    $sentencia="SELECT * FROM usuarios,tipo_usu WHERE usuarios.id_tip_usu=tipo_usu.id_tip_usu";
    $resultado=$bd->prepare($sentencia);
    $resultado->execute();

    $registros=3;//indica que se van a ver 3 registro por págin
    
    $total=$resultado->rowCount();
   // echo $total;
   $paginas=$total/4;
   $paginas=ceil($paginas);
?>
    <script src="../js/app.js"></script>
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
        
        <?php
                    if (!$_GET){
                        header("Location:usuarios.php?pagina=1");
                    }
                    if ($_GET['pagina']>$paginas|| $_GET['pagina']<=0) {
                        header("Location:usuarios.php?pagina=1");
                    }

                    $iniciar=($_GET['pagina']-1)*$registros;
                    //echo $iniciar;

                    $sentencia1="SELECT * FROM usuarios,tipo_usu WHERE usuarios.id_tip_usu=tipo_usu.id_tip_usu LIMIT :iniciar,:nregistros";
                    $fell=$bd->prepare($sentencia1);
                    $fell->bindParam(":iniciar",$iniciar,PDO::PARAM_INT);
                    $fell->bindParam(":nregistros",$registros,PDO::PARAM_INT);
                    $fell->execute();

                    $camb=$fell->fetchAll();
                    ?>
        
        <div class="container-fluid">
                <a href="index.php" class="navbar-brand">Surtitienda</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="MenuNavegacion" class="collapse navbar-collapse">
                    <ul class="nav nav-tabs ms-3">
                        <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" href="usuarios.php">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="clientes/index.php">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="productos/index.php">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="proveedores/prove.php">Proveedores</a></li>
                        <li class="nav-item"><a class="nav-link" href="ventas/vent.php">Crear venta</a></li>
                        <li class="nav-item"><a class="nav-link" href="facturas/factu.php">Ver facturas</a></li>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <p id="p">Bienvenido(a) <?php echo $nombre1 ?>  <?php echo $apellido ?></p>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <li><a class="dropdown-item" href="#">Mi perfil</a></li>
                                <li><a class="dropdown-item"  href="../includes/salir.php">Cerrar sesion</a></li>
                                </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div id="nim">
            <a href="registrar.php"><button type="button" class="btn btn-primary">Registrar</button></a>
            </div>

        <form method="post" action="buscar.php"> 


        <input class="buscar"  type="search" name="buscar"  id="" placeholder="Buscar"> <a href="#"><button id="but" class="btn btn-primary">Busca </button></a> <br> <br>
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
            foreach ($camb as $move) {
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


    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?php  echo $_GET['pagina']<=1? 'disabled' : '' ?> ">
        <a class="page-link" href="usuarios.php?pagina=<?php echo $_GET['pagina']-1 ?>">Anterior</a>
    </li>
    <?php
        for($i=0; $i<$paginas; $i++):?>
            <li class="page-item <?php echo $_GET ['pagina']==$i+1? 'active': ''?>">
                <a class="page-link" 
                href="usuarios.php?pagina=<?php echo $i+1?>">
                <?php echo $i+1?></a>
            </li>
            <?php endfor?>


    <li class="page-item <?php  echo $_GET['pagina']>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="usuarios.php?pagina=<?php echo $_GET['pagina']+1 ?>">Next</a></li>
  </ul>
</nav>

</body>
</html>