<?php
session_start();
    require("conection/conexion.php");
    $sentencia=$bd->query("SELECT * FROM usuarios");
    $consult=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['envi'])){
        $cedu=$_SESSION['cedu'];
        $nueva=$_GET['nuev'];
        $val=$_GET['valid'];
        $pass_cifrado=password_hash($val,PASSWORD_DEFAULT,array("valid"=>12));
    
        try{
            $sql="UPDATE usuarios SET clave=:cla WHERE id_usu=:ce";
            $result=$bd->prepare($sql);
            $result->execute(array(":ce"=>$cedu,":cla"=>$pass_cifrado));
            echo"<script>alert('se actualizaron la clave correctamente')</script>";
            echo"<script>window.location='index.php'</script>";
    
        }catch (Exception $th) {
            echo"No se pudo actualizar";
        }
        finally{
            $bd=null;
        }
    }


?>