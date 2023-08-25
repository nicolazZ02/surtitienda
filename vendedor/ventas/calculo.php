


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/calculo.css">
    <title>Calculo</title>
</head>
<body>


    <?php
    	session_start();
        include("../../conection/conexion.php");
            
        $idc=$_GET['id'];

        $doc=$_SESSION['ide'];
        $contador=$_GET['can'];
        $nombre=$_GET['nomb'];
        $total=$_GET['tot'];
        $cedu1=$_SESSION['cedu'];
        $nombre1=$_SESSION['nomb'];





   


    ?>
        <form action="verventa.php" method="gets">
<center>
    <div id="div">
        <div id="div2"><h2>Cambio</h2></div>

        <label>Devueltas en efectivo:</label>
        <input type="number" name="efectivo" class="form-control" value="<?php echo (int)$total?>" readonly>
        <input type="number" name="pesos" class="form-control">
        <input type="submit" name="calculo" id="btn1" class="btn btn-primary" value="Calcular">
    </div>    
</center>
</form>


   
</body>
</html>