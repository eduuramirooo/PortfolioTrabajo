<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //Iniciamos la conexion con la BBDD
        include_once("conectar.php");
        $conectar = new Conectar("localhost", "root", "", "portfolio");
        //Recogemos los datos del formulario
        $username = $_POST['username'];
        $password = $_POST['password'];
        //Buscamos el usuario en la BBDD
        $passwordQ=$conectar->recibir_datos("SELECT password, id FROM users WHERE username='$username'");
        //Comprobamos si la contraseña es correcta
        if($passwordQ && password_verify($password, $passwordQ[0]['password'])){
            //Si es correcta, iniciamos la sesion y redirigimos a la pagina principal
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $passwordQ[0]['id'];
            $_SESSION['iniciado'] = true;
            //Comprobamos si el usuario tiene un portfolio
            $selectPortfolio = $conectar->recibir_datos("SELECT id FROM port WHERE id_usuario = ".$_SESSION['id']);
            if($selectPortfolio[0]['id'] != null){
                //Si tiene un portfolio, lo guardamos en la sesion y redirigimos a la pagina principal
                $_SESSION['idPortfolio'] = $selectPortfolio[0]['id'];
                header("Location: index.php?corr=1");
            }else{
                header("Location: index.php?corr=1");
            }
        }else{
            echo "User or password incorrect";
            header("Location: index.php");
        }
    }
?>
<form action="login.php" method="post" id="loginForm" class="loginForm">
    <h3>Please log-in</h3>
    <label for="username">User</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <button type="submit">Enviar</button>
    <a href="index.php?id=1">Register</a>
</form>