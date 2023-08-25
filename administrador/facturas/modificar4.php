<?php

session_start();
require("../../conection/conexion.php");



        $modi= $_GET['id'];
        
    try {
        $sql="SELECT * FROM facturas,clientes,usuarios WHERE n_factu=:co and facturas.id_cliente=clientes.id_cliente and facturas.id_usu=usuarios.id_usu";
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
                    <a href="factu.php" class="close" title="close">x</a>
                    <div id="cab">
                        <span>Actualizar</span>
                    </div>
                </div>
                <form action="upd4.php" method="POST">
                    <label id="lab1">Numero factura</label>
                    <div>
                        <input type="text" id="inp1" readonly name="cod" value="<?php echo $modi?>">
                    </div>

                    <label id="lab1">Cliente</label>
                    <div>
                    <input type="text" id="inp2" name="nombre_c" value="<?php echo $editar['id_cliente'] ?>" readonly>
                    </div>
                    <label id="lab1">Fecha</label>
                    <div>
                    <input type="date" id="inp3" name="fecha" value="<?php echo $editar['fecha_creacion']?>">
                    </div>
                    <label id="lab1">Vendedor</label>
                    <div>
                    <input type="text" id="inp4" name="vendedor" value="<?php echo $editar['id_usu'] ?>" readonly>
                    </div>
                    <label id="lab1">Valor total</label>
                    <div>
                    <input type="number" id="inp4" name="valt" value="<?php echo $editar['valor_total'] ?>">
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