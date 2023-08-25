<?php

session_start();
require("../../conection/conexion.php");


        $sql3="SELECT * FROM estados WHERE id_esta=1 ";
        $sel=$bd->prepare($sql3);
        $sel->execute(array());
        $estado=$sel->fetch(PDO::FETCH_ASSOC);
        $esta=$estado['id_esta'];

        $modi= $_GET['id'];
        $nueva= $_GET['canti'];
        $codi=$_GET['codp'];
        $detal=$_GET['idd'];
        $canti=$_GET['cantp'];
        

        $tot=$canti + $nueva;




    
    try {   
        


        
        $sql1="UPDATE  facturas SET id_esta=:can WHERE n_factu=:de";
        $res=$bd->prepare($sql1);
        $res->execute(array(":de"=>$modi, ":can" => $esta));




        $sql1="UPDATE  productos SET cantidadp=:can WHERE cod_product=:de";
        $res=$bd->prepare($sql1);
        $res->execute(array(":de"=>$codi, ":can" => $tot));



        echo"<script>alert('se anulo correctamente')</script>";
        echo"<script>window.location='factu.php'</script>";

        $resulta->closeCursor();
    } catch (Exception $th) {
    echo"No se pudo actualizar";
}finally{
    $bd=null;
}

?>