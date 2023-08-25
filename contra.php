<?php
    require('conection/conexion.php');

    if(isset($_POST["valid"])){

        try{
        
        $correo=		htmlentities(addslashes($_POST["email"]));
        $num=			htmlentities(addslashes($_POST["num"]));

        $sql="SELECT * FROM usuarios WHERE correo=:co or id_usu=:nu";
        $result=$bd->prepare($sql);
        $result->execute(array(":co"=>$correo, ":nu"=>$num));
        if ($registro=$result->fetch(PDO::FETCH_ASSOC)) {
            if($correo== $registro['correo']){
                ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=, initial-scale=1.0">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
                    <!-- JavaScript Bundle with Popper -->
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

                    <link rel="stylesheet" href="css/cambiar.css">
                    <title>Cambiar clave</title>
                </head>
                <body>
                    <div id="vi" >
                    <div id="rep">
                        <span>Actualizar</span>
                    </div>
                    <form action="editar.php" method="get">
                        <input type="password" class="form-control" id="inp1" name="nuev" placeholder="nueva contraseña">
                        <input type="password" class="form-control" id="inp2" name="valid" placeholder="confirme contraseña">
                        <input type="submit" id="boton" name="envi" value="Cambiar" />
                        <input type="hidden" name="MM_update" value="formu" />
                    </form>
                    </div>
                </body>
                </html>

                <?php
        }
    }
    
    }catch(Exception $e){
        die("error" . $e->getMessage());
    }
}

?>