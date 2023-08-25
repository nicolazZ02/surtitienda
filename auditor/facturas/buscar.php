<?php
        session_start();
       
?>

<?php
    require_once("../../conection/conexion.php");

    $cedu1=$_SESSION['cedu'];
    $nombre1=$_SESSION['nomb'];
    $apellido=$_SESSION['apel'];
    $tipo=$_SESSION['tipo'];
    $tip=$_SESSION['tip'];


    $sentencia1="SELECT * FROM facturas,usuarios,clientes,estados WHERE facturas.id_usu=usuarios.id_usu  and facturas.id_cliente=clientes.id_cliente and facturas.id_esta=estados.id_esta ";
    $resultado=$bd->prepare($sentencia1);
    $resultado->execute();


    $registros=3;//indica que se van a ver 3 registro por págin
    
    $total=$resultado->rowCount();
   // echo $total;
   $paginas=$total/4;
   $paginas=ceil($paginas);



 
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
    <link rel="stylesheet" href="../../css/audi.css">
    <title>Facturas</title>
</head>
<body>

<div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom border-warning">
        <?php
                  
                    ?>    
        <div class="container-fluid">
                <a href="index.php" class="navbar-brand">Surtitienda</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="MenuNavegacion" class="collapse navbar-collapse">
                    <ul class="nav nav-tabs ms-3">
                        <li class="nav-item"><a id="ini" class="nav-link" href="../index.php">Inicio</a></li>
                        <li class="nav-item"><a id="ini" class="nav-link  active" href="facturas/factu.php">Ver facturas</a></li>
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
    <form action="buscar.php" method="post">
    <input class="buscar"  type="search" name="buscar"  id="" placeholder="Buscar"> <a href="#"><button id="but" class="btn btn-primary">Busca </button></a> 
    
    <table  class="table">
        <tr>
            <th class="bg-primary" scope="col">Codigo</th>
            <th class="bg-primary" scope="col">Cliente</th>
            <th class="bg-primary" scope="col">Fecha</th>
            <th class="bg-primary" scope="col">Vendedor</th>
            <th class="bg-primary" scope="col">Valor total</th>
            <th class="bg-primary" scope="col">Estado Factura</th>
            <th class="bg-primary" scope="col">Accion</th>
          
        </tr>
        <?php
                $buscar=$_POST['buscar'];
                $cons="SELECT * FROM facturas,clientes,usuarios,estados WHERE n_factu=:ced and facturas.id_cliente=clientes.id_cliente and facturas.id_usu=usuarios.id_usu and facturas.id_esta=estados.id_esta";
                $select=$bd->prepare($cons);
                $select->execute(array(":ced"=>$buscar));
     
            foreach ($select as $move) {



        ?>
            <tr>
                <td><?php echo $move->n_factu?></td>
                <td><?php echo $move->nombre?> <?php echo $move->apellido?></td>
                <td><?php echo $move->fecha_creacion?></td>
                <td><?php echo $move->nombre_usuario?> <?php echo $move->apellido_usuario?> </td>
                <td><?php echo $move->valor_total?></td>
                <td><?php echo $move->estado?></td>
                
                <td><a id="q1" class="btn btn-success mx-5" href="modificar.php?id=<?php echo $move->n_factu?> & nomb=<?php echo $move->nombre_usuario?>"><img class="mi" src="../../img/modi2.png" alt=""></a></td>
            
            
            </tr>
        <?php
        }
        ?>
    </div>
    </table>

    </form>




</body>
</html>