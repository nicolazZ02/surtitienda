
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<link rel="stylesheet" href="../../css/styles09.css">
	<title>Ver Matricula</title>
</head>
<body>
	<form method="get">
	<table id="tab_1">
		
	<tr><td><table align="center">
		<tr>
            
			<td colspan="3"><div id="des"><label id="jim"><b> SURTITIENDA</b></div></td></tr>
	
	        <td colspan="3"><div id="des_2"><label id="jim"><b>Productos baratos y faciles de comprar</b></label></td></tr>
	        <?php
	        require("../../conection/conexion.php");

            $modi=$_GET['id'];
            $ced=$_GET['cedula'];
            $total=$_GET['tot'];
			session_start();
			
			$ape=$_SESSION['apel'];
			$nombre1=$_SESSION['nomb'];

	        //consuta el último número de matricula generado
	        $sql = "SELECT * FROM facturas WHERE n_factu=:co";
            $resultado=$bd->prepare($sql);
    		$resultado->execute(array(":co"=>$modi));
    		$registro=$resultado->fetch(PDO::FETCH_ASSOC);
    		$numvent=$registro["n_factu"];
    		//consulta los datos  de la última matricula generada
    		$sql="SELECT  * FROM facturas where n_factu=:nm";
        	$resultado=$bd->prepare($sql);
        	$resultado->execute(array(":nm"=>$numvent));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	   		$idc=$registro['id_cliente'];
	   		$date=$registro['fecha_creacion'];
	   		$usuario=$registro['id_usu'];
	   		//consultar datos del estudiante que corresponde a la última matricula generada
	   		$sql="SELECT * from clientes where id_cliente=:id";
	   		$resultado=$bd->prepare($sql);
	   		$resultado->execute(array(":id"=>$idc));
	   		$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	   		
	        ?>
	
		<tr>
			<td id="o" colspan="2"><td><b id="codm">Matricula N° <?php echo $numvent ?></b></td></td></tr>
			<td id="te" colspan="2"><td><b id="fecha">Fecha <?php echo $date ?></b></td></td></tr>
			<tr><td id="" colspan="2"><h3>DATOS DEL CLIENTE</h3></td></tr>
			<tr><td id="" colspan="2">Identificación: <?php echo $registro['id_cliente']?></td></tr>
			<tr><td id="">Nombre: <?php echo $registro['nombre']?></td><td>Apellido: <?php echo $registro['apellido']?></td></tr>
			

			<?php 
			$sql="SELECT  * from usuarios where id_usu=:iu";
			$resultado=$bd->prepare($sql);
        	$resultado->execute(array(":iu"=>$usuario));
	   		$registrou=$resultado->fetch(PDO::FETCH_ASSOC);
	   		$vendedor=$registrou['nombre_usuario'];
	   		?>
	   		<tr><td>Vendedor: <?php echo $nombre1 ?> <?php echo $ape ?></td></tr>
			
		    </table>
			<h4 align="center">DETALLE DE VENTA</h4>
			
			<table id="tab" align="center" border="" bordercolor="#9b9b9b">
			<th>Código</th>
			<th>Productos</th>
            <th>Valor venta</th>
            <th>Cantidad</th>
            <th>Precio total</th>
			<tr>
			<?php
			//consulta a la tabla detallefactura
			$registrosdet=$bd->query("SELECT * from detalle_factu where n_factu=$numvent ")->fetchALL(PDO::FETCH_OBJ);
			
			foreach ($registrosdet as $factu) :?> 
				<td><?php echo $factu->n_factu;?></td>
				<?php
				$codigom=$factu->n_factu;
			
			
			
			//consulto el nombre de la materia en la tabla materia
			$sql="SELECT cantidad,valor_venta,nombre_p, precio  from detalle_factu,productos where n_factu=:co and detalle_factu.cod_product=productos.cod_product";
			$resultado=$bd->prepare($sql);
			$resultado->execute(array(":co"=>$codigom));
			$registrom=$resultado->fetch(PDO::FETCH_ASSOC);
			
			?>

			<td><?php echo $registrom['nombre_p'];?></td>            
            <td><?php echo $registrom['valor_venta'];?></td>
            <td><?php echo $registrom['cantidad'];?></td>
            <td><?php echo $total?></td>
			<?php
			
			?>
			</div></td></tr>
			
			<?php
			endforeach;
	
				?>
			</table>
			<tr><td align="center">
			<input id="bot1" type='button' onclick='window.print();' value='Imprimir'>
			
			<a href="../../fpdf/fpdf.php"><input id="bot2" type="button" name="pdf"  value="Ver pdf"></a>
			<a href="../index.php?ced=<?php echo $ced?> & nomb=<?php echo $nombre1?>"><input id="bot3" type="button" name="vuelve" value="Volver al inicio"></a></td></tr>
	
</td>
</tr>
</table>	
</form>
</body>
</html>