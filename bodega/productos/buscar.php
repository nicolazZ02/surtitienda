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

    $sql="SELECT * FROM productos,proveedor WHERE productos.nit=proveedor.nit";
    $result=$bd->prepare($sql);
    $result->execute();



 
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
    <link rel="stylesheet" href="../../css/bodega.css">
    <title>Productos</title>
</head>
<body>
<div class="container-fluid">
        <nav class="navbar navbar-expand-md navbar-light border-3 border-bottom border-warning">

            <div class="container-fluid">
                <a href="../index.php" class="navbar-brand">Surtitienda</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#MenuNavegacion">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="MenuNavegacion" class="collapse navbar-collapse">
                    <ul class="nav nav-tabs ms-3">
                        <li class="nav-item"><a id="ini" class="nav-link" href="../index.php">Inicio</a></li>
                        <li class="nav-item"><a id="ini" class="nav-link active" href="productos/product.php">Ver productos</a></li>
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
    <div>
            <div id="nim">
            <a href="registrar.php"><button type="button" id="voz" class="btn btn-primary">Registrar</button></a>
            </div>

            <form action="buscar.php" method="post">
            <input class="buscar"  type="search" name="buscar"  id="" placeholder="Buscar"> <a href="#"><button id="but" class="btn btn-primary">Busca </button></a> <br> <br>
    <table class="table">
        <tr>
            <th class="bg-primary">Codigo</th>
            <th class="bg-primary">Proveedor</th>
            <th class="bg-primary">Producto</th>
            <th class="bg-primary">Precio</th>
            <th class="bg-primary">Existencia</th>
            <th class="bg-secondary">Fecha de ingreso</th>
            <th class="bg-primary">Accion</th>
        </tr>
        <?php

                    $buscar=$_POST['buscar'];
                    $sentencia2="SELECT * FROM productos,proveedor WHERE cod_product=:co and productos.nit=proveedor.nit";
                    $res=$bd->prepare($sentencia2);
                    $res->execute(array(":co"=>$buscar));
                foreach ($res as $product) {
                ?>
        <tr>

                    <td><?php echo $product->cod_product?></td>
                    <td><?php echo $product->nombre?></td>
                    <td><?php echo $product->nombre_p?></td>
                    <td><?php echo $product->precio?></td>
                    <td><?php echo $product->cantidadp?></td>
                    <td><?php echo $product->fecha_ingres?></td>
                    <td><a id="q1" title="editar" class="btn btn-success mx-5" href="modificar2.php?id=<?php echo $product->cod_product?> & nomb=<?php echo $product->nit?>"><img class="mi" src="../../img/modi2.png" alt=""></a></td>
                  <?php 
                }
            ?>  

        </tr>
    </table>
    </form>
    </div>

</body>
</html>