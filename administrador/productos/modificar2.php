<?php

session_start();
require("../../conection/conexion.php");



        $modi= $_GET['id'];
        $_SESSION['cedu']=$modi;
    
    try {
        $sql="SELECT * FROM productos,proveedor WHERE cod_product= :co and productos.nit=proveedor.nit";
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
                    <label id="lab1">Proveedor</label>
                    <div>
                    <input type="text" id="inp2" readonly name="nombre" value="<?php echo $editar['nit'] ?>">
                    </div>
                    <label id="lab1">Nombre producto</label>
                    <div>
                    <input type="text" id="inp3" name="nombre_p" value="<?php echo $editar['nombre_p'] ?>">
                    </div>
                    <label id="lab1">Precio</label>
                    <div>
                    <input type="text" id="inp4" name="precio" value="<?php echo $editar['precio'] ?>">
                    </div>
                    <label id="lab1">Existencia</label>
                    <div>
                    <input type="text" id="inp4" name="exis" value="<?php echo $editar['cantidadp'] ?>" readonly>
                    </div>
                    <label id="lab1">Nueva cantidad</label>
                    <div>
                        <input id="inp4" type="number" name="nuevo">
                    </div>
                    <label id="lab1">Fecha ingreso</label>
                    <div>
                    <input type="date" id="inp4" name="fecha" value="<?php echo $editar['fecha_ingres'] ?>">
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