<?php
    session_start();
    

    include_once("../../conection/conexion.php");

    $cedu1=$_SESSION['cedu'];
    $nombre1=$_SESSION['nomb'];
    $apellido=$_SESSION['apel'];
    $tipo=$_SESSION['tipo'];
    $tip=$_SESSION['tip'];


?>

<?php
    $sentencia="SELECT * FROM facturas,clientes,usuarios WHERE facturas.id_cliente=clientes.id_cliente and facturas.id_usu=usuarios.id_usu";
    $resultado=$bd->prepare($sentencia);
    $resultado->execute();
    
        $registros=3;//indica que se van a ver 3 registro por págin
    
        $total=$resultado->rowCount();
       // echo $total;
       $paginas=$total/4;
       $paginas=ceil($paginas);
      //echo $paginas;
    
        
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
    <link rel="stylesheet" href="../../css/admin.css">
    <title>Facturas</title>
</head>
<body>
<div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom border-warning">
        <?php
                    if (!$_GET){
                        header("Location:factu.php?pagina=1");
                    }
                    if ($_GET['pagina']>$paginas|| $_GET['pagina']<=0) {
                        header("Location:factu.php?pagina=1");
                    }

                    $iniciar=($_GET['pagina']-1)*$registros;
                    //echo $iniciar;

                    $sen="SELECT * FROM facturas,clientes,usuarios,estados WHERE  facturas.id_cliente=clientes.id_cliente and facturas.id_usu=usuarios.id_usu  and facturas.id_esta=estados.id_esta LIMIT :iniciar,:nregistros";
                    $fell=$bd->prepare($sen);
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
                        <li class="nav-item"><a class="nav-link" href="../index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="../usuarios.php">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="../clientes/index.php">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="../productos/index.php">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="../proveedores/prove.php">Proveedores</a></li>
                        <li class="nav-item"><a class="nav-link" href="../ventas/vent.php">Crear venta</a></li>
                        <li class="nav-item"><a class="nav-link active" href="facturas/factu.php">Ver facturas</a></li>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <p id="p">Bienvenido(a) <?php echo $nombre1 ?>  <?php echo $apellido ?></p>
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
    <form method="post" action="buscar3.php"> 


        <input class="buscar"  type="search" name="buscar"  id="" placeholder="Buscar"> <a href="#"><button id="but" class="btn btn-primary">Busca </button></a> <br> <br>
        <div id="tag">
            <center>
            <table  class="table">
                    <tr>
                        <th class="bg-success" scope="col">Numero factura</th>
                        <th class="bg-secondary" scope="col">Cliente</th>
                        <th class="bg-success" scope="col">Fecha</th>
                        <th class="bg-secondary" scope="col">Vendedor</th>
                        <th class="bg-success" scope="col">Valor total</th>
                        <th class="bg-primary" scope="col">Estado Factura</th>
                        <th class="bg-secondary" scope="col">Accion</th>
                        <th class="bg-secondary" scope="col"></th>
                        <th class="bg-secondary" scope="col"></th>
                    </tr>
                    <?php
                        foreach ($camb as $move) {
                    ?>
                    <tr>
                        <td><?php echo $move->n_factu;?></td>
                        <td><?php echo $move->nombre?> <?php echo $move->apellido?></td>
                        <td><?php echo $move->fecha_creacion?></td>
                        <td><?php echo $move->nombre_usuario?> <?php echo $move->apellido_usuario?></td>
                        <td><?php echo $move->valor_total?></td>
                        <td><?php echo $move->estado?></td>
                        <td><a id="q1" class="btn btn-success mx-5" href="eliminar4.php?id=<?php echo $move->n_factu?>  &cedula=<?php echo $move->id_usu?> "><img class="mi" src="../../img/bote1.png" alt=""></a></td>
                        <td><a id="q2" class="btn btn-success" href="modificar4.php?id=<?php echo $move->n_factu?>" ><img class="mi" src="../../img/modi2.png" alt=""></a></td>
                        <td><a id="q2" class="btn btn-success mx-5" href="ver.php?id=<?php echo $move->n_factu?> &cedula=<?php echo $move->id_cliente?> &tot=<?php echo $move->valor_total?>" ><img class="mi" src="../../img/vision2.png" alt=""></a></td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>    
        </div>
    </form>
    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?php  echo $_GET['pagina']<=1? 'disabled' : '' ?> ">
        <a class="page-link" href="factu.php?pagina=<?php echo $_GET['pagina']-1 ?>">Anterior</a>
    </li>
    <?php
        for($i=0; $i<$paginas; $i++):?>
            <li class="page-item <?php echo $_GET ['pagina']==$i+1? 'active': ''?>">
                <a class="page-link" 
                href="factu.php?pagina=<?php echo $i+1?>">
                <?php echo $i+1?></a>
            </li>
            <?php endfor?>


    <li class="page-item <?php  echo $_GET['pagina']>=$paginas? 'disabled' : '' ?> "><a class="page-link" href="factu.php?pagina=<?php echo $_GET['pagina']+1 ?>">Next</a></li>
  </ul>
</nav>
</body>
</html>