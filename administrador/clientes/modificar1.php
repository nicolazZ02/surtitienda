<?php

session_start();
require("../../conection/conexion.php");



        $modi= $_GET['id'];
        $_SESSION['cedu']=$modi;
    
    try {
        $sql="SELECT * FROM clientes WHERE id_cliente= :co";
        $result=$bd->prepare($sql);
        $result->execute(array(":co" => $modi));    
        
        
        
        if ($editar=$result-> fetch(PDO::FETCH_ASSOC)){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../../css/styles5.css">
                <title>Editar</title>
            </head>
            <body>
            <center>
            <div id="cod">
                <div>
                    <a href="index.php" class="close" title="close">x</a>
                    <div id="cab">
                        <span>Actualizar</span>
                    </div>
                </div>
                <form action="upd.php" method="POST">
                    <label id="lab1">Codigo</label>
                    <div>
                        <input type="text" id="inp1" readonly name="cod" value="<?php echo $modi?>">
                    </div>
                    <label id="lab1">Nombre</label>
                    <div>
                    <input type="text" id="inp2" name="nombre" value="<?php echo $editar['nombre'] ?>">
                    </div>
                    <label id="lab1">Apellido</label>
                    <div>
                    <input type="text" id="inp3" name="apellido" value="<?php echo $editar['apellido'] ?>">
                    </div>
                    <label id="lab1">Telefono</label>
                    <div>
                    <input type="text" id="inp4" name="tel" value="<?php echo $editar['tel'] ?>">
                    </div>
                    <label id="lab1">Correo</label>
                    <div>
                    <input type="text" id="inp4" name="dir" value="<?php echo $editar['direccion'] ?>">
                    </div>
                    <input type="submit" id="bot" name="modi" value="modificar">
                    <input type="hidden" name="formreg" value="1">
                 </form>
                </div>
            </center>
            </body>
            </html>

            <?php
        }else{
            echo"No existe";
        }
       


        $result->closeCursor();
        
    }catch(Exception $e) {
        die("Error: ". $e->GetMessage());
    }finally{
        $bd=null;
    }
?>