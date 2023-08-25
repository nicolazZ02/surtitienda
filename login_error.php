<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/38ff45606a.js" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>
    <title>Error de sesion</title>
</head>
<body>
    <form action="../includes/inicio.php" method="post">
        <div class="overlay">
            <!-- LOGN IN FORM by Omar Dsoky -->
            <!--   con = Container  for items in the form-->
            <div class="con">
                <!--     Start  header Content  -->
                <header class="head-form">
                    <h2>Inicio Sesion</h2>
                    <!--     A welcome message or an explanation of the login form -->
                    <p>Inicia aqui usando tu usuario y contraseña</p>
                    <h1>Error de sesion</h1>
                </header>
                <!--     End  header Content  -->
                <br>
                <div class="field-set">
     
                    <!--   user name -->
                        <span class="input-item">
                            <i class="fa fa-user-circle"></i>
                        </span>
                    <!--   user name Input-->
                    <input  class="form-input" name="usu" id="txt-input" type="text" placeholder="Usuario" required>
     
                    <br>
     
                    <!--   Password -->
     
                    <span class="input-item">
                        <i class="fa fa-key"></i>
                    </span>
                    <!--   Password Input-->
                    <input class="form-input" name="pwd" type="password" placeholder="Contraseña" id="pwd"  name="password" required>
     
                    <!--      Show/hide password  -->
                    <span>
                        <i class="fa fa-eye" aria-hidden="true"  type="button" id="eye"></i>
                    </span>
     
     
                        <br>
                    <!--buttons -->
                    <!--button LogIn -->
                    <button name="bot" type="submit" class="log-in"> Iniciar sesion </button>
                </div>
  
                <!--other buttons -->
                <div class="other">
                    <!--forgot Password button-->
                        <a href="valida_cor.html"><button type="button" id="olv" class="btn submits frgt-pass">¿Olvido su contraseña?</button></a>
                        <!--Sign Up button -->
                         <a href="#"><button type="button" id="resg" class="btn submits sign-up">Registrarse
                        <!--Sign Up font icon -->
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                            </button></a>
                    <!--End Other the Division -->
                </div>
     
            <!--   End Conrainer  -->
            </div>
  
            <!-- End Form -->

        </div>
    </form>
</body>
</html>



