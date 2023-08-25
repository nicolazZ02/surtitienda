<?php
    include("../../conection/conexion.php");


    $id=$_GET["id"];
    if (isset($_GET['ced'])) {
        $doc=$_GET['ced'];
        $nom=$_GET['nomb'];
        $ape=$_GET['apel'];
        $efectivo= $_GET['efectivo'];
    }
    $borrar=("DELETE FROM detalle_tempo WHERE id_detal=?");
    $sentencia=$bd->prepare($borrar);
    $sentencia->execute(array($id));

    header("Location: detal_tempo.php?id=$doc &nomb=$nom &apel=$ape &efectivo=$efectivo");
?>