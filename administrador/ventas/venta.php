<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="icon" href="../../img/logo.png">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="../../css/alerta.css">

	<title>Matricular</title>
</head>
<body>


<?php 
	session_start();
	include("../../conection/conexion.php");

    $sql3="SELECT max(id_esta) as last_id FROM estados ";
    $sel=$bd->prepare($sql3);
    $sel->execute(array());
    $estado=$sel->fetch(PDO::FETCH_ASSOC);
    $esta=$estado['last_id'];
  

	
   	$idc=$_GET['id'];

	$doc=$_SESSION['ide'];
	$contador=$_GET['can'];
    $nombre=$_GET['nomb'];
    $total=$_GET['tot'];
	$cedu1=$_SESSION['cedu'];
    $nombre1=$_SESSION['nomb'];
	?>

	<div id="dav">

	<?php
	?>
	<div id="cab"><h2 id="h2">Confimar Venta</h2></div>
	<?php
    echo "El usuario $nombre1 con numero de cedula $cedu1 va hacer una venta con un numero de $contador productos, se hara a nombre de $nombre, si está seguro presione <kbd>Si</kbd> de lo contrario presione <kbd>Volver</kbd>";
    if(isset($_POST['si'])){
        
	$sql='INSERT INTO facturas (id_cliente, id_usu, valor_total,id_esta) values (:ie, :iu, :tot,:esta)';
	$resultado=$bd->prepare($sql);
	$resultado->execute(array(":ie"=>$doc,":iu"=>$cedu1, ":tot"=>$total, ":esta"=>$esta));
	//consultar el número de matricula generado
	$sql = "SELECT MAX(n_factu) as last_id FROM facturas";
    $resultado=$bd->prepare($sql);
    $resultado->execute(array());
    $registro=$resultado->fetch(PDO::FETCH_ASSOC);
    $numventa=$registro['last_id'];
	
   

	//ingresar el número de matricula en la tabla detalletemp
	$sql="UPDATE detalle_tempo SET n_factu='$numventa'";
	$resultado=$bd->prepare($sql); 
    $resultado->execute(array());

    // copia todos los registrso de detalletemp en detalle
    $sql="INSERT into detalle_factu (n_factu,cod_product,id_usu,cantidad,valor_venta) select n_factu,cod_product,id_usu,cantidad,valor_venta from detalle_tempo";
    $resultado=$bd->prepare($sql);
    $resultado->execute(array());


    $pro=$bd->query("SELECT * FROM detalle_tempo WHERE n_factu=$numventa")->fetchALL(PDO::FETCH_OBJ);
                        
    foreach ($pro as $temp):
        $codp= $temp->cod_product;
        $_SESSION['codi']=$codp;
        $cantp= $temp->cantidad;

        $sql1="SELECT * FROM productos WHERE cod_product=:cod";
        $existencia=$bd->prepare($sql1);
        $existencia->execute(array(":cod"=>$codp));
        $exist=$existencia->fetch(PDO::FETCH_ASSOC);
        $antes=$exist['cantidadp'];
  
        $actual=$antes - $cantp;
            
        $sql2="UPDATE productos SET cantidadp=:qu WHERE cod_product=:co";
        $resultado=$bd->prepare($sql2); 
        $resultado->execute(array(":co"=>$codp,":qu"=>$actual));                                
    endforeach;


    //borra todos los regisros de la tabla detalletemp
    $sql="DELETE from detalle_tempo WHERE id_usu=:ed";
	$resultado=$bd->prepare($sql); 
    $resultado->execute(array(":ed"=>$cedu1));
	header("Location:verventa.php");
	
	}

?>
<form  name="form1" method="post" action=" ">
		<table border="0" align="center">
		</tr>
			
		<td><td><input id="bot1" type="submit" name="si"  value="Si">
		<a href="detal_tempo.php?id=<?php echo $doc?> &nomb=<?php echo $nombre?> &ape=<?php echo $nombre?>"><input id="bot2" type="button" name="vuelve" value="Volver"></a></td></tr>

		</table>
</div>
</form>
</body>
</html>