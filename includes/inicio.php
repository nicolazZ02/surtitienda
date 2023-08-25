<?php
    session_start();
    require("../conection/conexion.php");

    if (!isset($_POST['usu']) || !isset($_POST['bot'])) {
        header("Location: ../index.php");
    }
    elseif (isset($_POST['bot'])) {
        try {
            $inicio= htmlentities(addslashes($_POST['usu']));
            $clave= htmlentities(addslashes($_POST['pwd']));
            $conta=0;

            $sentencia="SELECT * FROM usuarios,tipo_usu WHERE usuario=:usu and usuarios.id_tip_usu=tipo_usu.id_tip_usu";
            $select=$bd->prepare($sentencia);
            $select->execute(array(":usu"=>$inicio));
            
            if ($les=$select->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($clave, $les['clave'])) {
                    
                    $id=      $les['id_usu'];
                    $usu=     $les['usuarios'];
                    $con=     $les['clave'];
                    $nombre=  $les['nombre_usuario'];
                    $apellido= $les['apellido_usuario'];
                    $add=  $les['id_tip_usu'];
                    $tip=      $les['tip_usu'];
                    //variables Globales
                    $_SESSION['cedu']=$id;
                    $_SESSION['usuario']=$usu;
                    $_SESSION['clave']=$con;
                    $_SESSION['nomb']=$nombre;
                    $_SESSION['apel']=$apellido;
                    $_SESSION['tipo']=$add;
                    $_SESSION['tip']=$tip;
                        $conta++;
                }
            }
            if ($conta>0) {
                if ($_SESSION['tipo']==1) {
                    header("Location: ../administrador/index.php");
                }
                else if ($_SESSION['tipo']==2) {
                    header("Location: ../vendedor/index.php");
                }
                else if ($_SESSION['tipo']==3) {
                    header("Location: ../auditor/index.php");
                }
                else if ($_SESSION['tipo']==4) {
                    header("Location: ../bodega/index.php");
                }
            }
            else {
                require("../login_error.php");
            }
            $select->closecursor();
            $bd->exec("set character set utf8");
            
        } catch (Exception $th) {
            die("Error".$th->getMessage());
        }
    }
?>

