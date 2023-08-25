<?php
    session_start();
    

    include_once("../../conection/conexion.php");

    $cedu1=$_SESSION['cedu'];
    $nombre1=$_SESSION['nomb'];
    $apellido=$_SESSION['apel'];
    $tipo=$_SESSION['tipo'];
    $tip=$_SESSION['tip'];

    $sentencia1="SELECT MAX(n_factu) as last_id FROM facturas ";
    $resultado=$bd->prepare($sentencia1);
    $resultado->execute(array());
	$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	$id=$registro['last_id'];


	$sql="SELECT * FROM facturas,clientes,usuarios WHERE n_factu=:ce and facturas.id_cliente=clientes.id_cliente and facturas.id_usu=usuarios.id_usu ";
	$det=$bd->prepare($sql);
	$det->execute(array(":ce"=>$id));

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/verven.css">
    <title>Facturas</title>
</head>
<body>

    </div>
    <form method="post" > 

	<center>
		<div id="real">
        <h4	id="h4">Factura Realizada</h4>
		</div>
		</center>
            <center>
            <table  class="table">
                    <tr>
                        <th class="bg-success" scope="col">Numero factura</th>
                        <th class="bg-secondary" scope="col">Cliente</th>
                        <th class="bg-success" scope="col">Fecha</th>
                        <th class="bg-secondary" scope="col">Vendedor</th>
                        <th class="bg-success" scope="col">Valor total</th>
                        <th class="bg-secondary" scope="col">Ver factura</th>
                        <th class="bg-success" scope="col">Imprimir</th>
                    </tr>
                    <?php
                        foreach ($det as $move) {
                    ?>
                    <tr>
                        <td><?php echo $move->n_factu;?></td>
                        <td><?php echo $move->nombre?> <?php echo $move->apellido?></td>
                        <td><?php echo $move->fecha_creacion?></td>
                        <td><?php echo $move->nombre_usuario?> <?php echo $move->apellido_usuario?></td>
                        <td><?php echo $move->valor_total?></td>
						

                        <td><a title="ver factura" id="q1" class="btn btn-success mx-5" href="ver.php?id=<?php echo $move->n_factu?>  &cedula=<?php echo $move->id_usu?> &tot=<?php echo $move->valor_total ?> "><img class="mi" src="../../img/vision2.png" alt=""></a></td>
                        <td><a id="q2" type='button' class="btn btn-primary mx-5" onclick='window.print("ver.php");'> <img src="../../img/impre5.png" class="mi" alt="Impresora"></a></td>
                    </tr>
                    <?php
                        }
                    ?>
					
            </table>  
			<a href="../index.php"><button class="button" type="button"><span class="text">Ir al principio</span> <i class="ri-check-line icon"></i></button></a>
        </div>
    </form>
</body>
</html>