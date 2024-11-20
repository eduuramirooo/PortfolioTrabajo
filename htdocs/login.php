<?php
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include_once("conectar.php");
        $conectar = new Conectar("localhost", "root", "", "portfolio");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordQ=$conectar->recibir_datos("SELECT password, id FROM users WHERE username='$username'");
        if($passwordQ && password_verify($password, $passwordQ[0]['password'])){
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $passwordQ[0]['id'];
            $_SESSION['iniciado'] = true;
            $selectPortfolio = $conectar->recibir_datos("SELECT id FROM port WHERE id_usuario = ".$_SESSION['id']);
            if($selectPortfolio[0]['id'] != null){
                $_SESSION['idPortfolio'] = $selectPortfolio[0]['id'];
                header("Location: index.php?corr=1");
            }else{
                header("Location: index.php");
            }
        }else{
            echo "User or password incorrect";
            header("Location: index.php");
        }
    }
?>

<form action="login.php" method="post" id="loginForm">
    <h3>Please log-in</h3>
    <label for="username">User</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <button type="submit">Enviar</button>
    <a href="index.php?id=1">Register</a>
</form>