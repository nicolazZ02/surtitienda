<?php
    session_start();
    include('../../conection/conexion.php');


    $sel="SELECT * FROM clientes";
    $con=$bd->prepare($sel);
    $con->execute();


?>


<?php
    $id=$_SESSION['cedu'];
    $nombre1=$_SESSION['nomb'];
    $apellido=$_SESSION['apel'];

    $consulta="SELECT *, productos.cantidadp AS cantidadN,detalle_tempo.cantidad FROM detalle_tempo,productos WHERE detalle_tempo.cod_product=productos.cod_product ";
    $mandar=$bd->query($consulta);
    $mandar->execute(array());

    $res="SELECT * FROM productos";
    $data = $bd->prepare($res);
    $data->execute(array());




    if (!isset($_POST['agregar']) and !isset($_POST['product'])) {

        
        $cedu=$_SESSION['ide'];
        $nomb=$_SESSION['name'];
        $ape=$_SESSION['last'];

            
            
           

           
        }else {
            
            $cedu=$_SESSION['ide'];
            $nomb=$_SESSION['name'];
            $ape=$_SESSION['last'];

                 
        }


        if (isset($_POST['agregar'])) {

           
            $cedu=$_SESSION['ide'];
            $nomb=$_SESSION['name'];
            $ape=$_SESSION['last'];

            
           
           

            $nombre = $_POST['product'];
            $precio = $_POST['price'];
            $cantidad = $_POST['cand'];
        
        
                $sql1="INSERT INTO detalle_tempo (cod_product,id_usu,cantidad,valor_venta) values (?,?, ?,?)";
                $resultado=$bd->prepare($sql1);//$base es el nombre de la conexión
                $resultado->execute(array($nombre,$id,$cantidad,$precio));
                
                header("Location:detal_tempo.php?id=$cedu &nomb=$nombrec &apel=$apel &nombv=$nombrev  &doc= $id");
        }



?>



<!DOCTYPE html>
<html lang="en" class="wrapper" id="pages">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/tempo.css">

    <title>Prodcutos</title>
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
                        <li class="nav-item"><a class="nav-link" href="../usuarios.php">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="../clientes/index.php">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="../productos/index.php">Productos</a></li>
                        <li class="nav-item"><a class="nav-link" href="../proveedores/prove.php">Proveedores</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../ventas/vent.php">Crear venta</a></li>
                        <li class="nav-item"><a class="nav-link" href="../facturas/factu.php">Ver facturas</a></li>
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
  
    <div id="page" class="wrapper">

   

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="row g-3">

        <table class="table" >
            <h4 id="h4_1">Productos a comprar</h4>
            <th class="bg-primary bg-bordered" scope="col">Code</th>



            <th class="bg-primary" scope="col">Nombre</th>
            <th class="bg-primary" scope="col">Precio</th>
            <th class="bg-primary" scope="col">Cantidad</th>
            <th class="bg-primary" scope="col"></th>
            <th class="bg-primary" scope="col">Accion</th>
            <th class="bg-primary" scope="col"></th>



            <?php

            /* var_dump($arrDatos);*/
            //Recorremos todos los resultados, ya no hace falta invocar más a fetchAll como si fuera fetch.../
            $conta=0;
            $total=0;
            foreach ($mandar as $muestra) {

                if ($_SESSION['cedu'] == $muestra->id_usu and $muestra ->valor_venta ) {

                $total =$total + $muestra->valor_venta * $muestra->cantidad;

                                                   
                
                    ?>
                    <tr>
                        
                        <input type="hidden" value="<?php $muestra->cod_product?>" name="cod" readonly>
                        <?php $cod=$muestra->cod_product?>
                        
                        <td> <?php echo $muestra->id_detal ?> </td>
                        <?php $codi=$muestra->id_detal;?>
                        <td> <?php echo $muestra->nombre_p ?> </td>
                        <td> <?php echo $muestra->valor_venta ?> </td>
                        <td> <?php echo $muestra->cantidad ?> </td>
                        <td><?php $conta=$conta+1;?></td>
                        <td>
                            <a href="eliminar.php?id=<?php echo $muestra->id_detal?> &ced=<?php echo $cedu?> &nombr=<?php echo $nomb?> &apel=<?php echo $ape?>" name="eli" class="btn btn-primary">
                                eliminar
                            </a>
                        </td>
                    </tr>
                    <?php

                        }
                    }
                    ?>

            <tfoot>
                <tr>               
                   
                        
                        <th class="text-right" colspan="2">Gran total</th>
                        <th><?php echo $total ?></th>
                        
                      

                </tr>
            </tfoot>
                
        </table>
        <div id="edd">
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <div id="form-control1">
                <select  id="in1" class="form-control"  name="product">
                    <option>Seleccione el producto</option>
                    <?php
                    foreach ($data as $valor) {
                        ?>

                        <?php

                    ?>
                        
                    <option data-typeid="<?php echo $valor->precio ?>" value="<?php echo $valor->cod_product ?>"><?php echo $valor->nombre_p?></option>

                    <?php
                    } ?>

                </select>

                </div>
                <div id="form-control2">
            <input type="number" id="in2" value=""  class="form-control col-auto mx-5"  name="price" placeholder="Precio" readonly>
            <script type="text/javascript">
                $(document).on('change', 'select.form-control', function() {
                var r = $('select.form-control option[value="' + $(this).val() + '"]').attr("data-typeid")
                $("#in2").val(r)
            });
            </script>
                </div>
                <div id="form-control3">
        <input type="number"  name="cand" id="in3" placeholder="Cantidad"  class="form-control col-auto mx-5 " >
        </div>


        <div id="bot">
        <a href="detal_tempo.php?id=<?php echo $cod?> &ced=<?php echo $cedu?> &can=<?php echo $conta?> &tot=<?php echo $total?> &nomb=<?php echo $nomb?> &ape=<?php echo $ape?>">
            <input id="boto1" type="submit" name="agregar" class="btn btn-primary  col-auto mx-5 " value="Agregar" style="width: 10rem;">
            </a></div>
            
            <a id="boto2" href="venta.php?id=<?php echo $cod?> &ced=<?php echo $cedu?> &can=<?php echo $conta?> &tot=<?php echo $total?> &nomb=<?php echo $nomb?> &ape=<?php echo $ape?>" ><button type="button" class="boton cinco"  name="" value="Vender">
            <div class="icono">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
					</svg>
				</div>
                <span>Vender</span>  
            </button></a>
            
    </form>
    
        </div>

</body>
</html>