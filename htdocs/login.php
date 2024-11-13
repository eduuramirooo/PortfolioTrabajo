<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include_once("conectar.php");
        $conectar = new Conectar("localhost", "root", "", "portfolio");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordQ=$conectar->recibir_datos("SELECT password FROM users WHERE username='$username'");
        if(password_verify($password, $passwordQ[0]['password'])){
            $_SESSION['username'] = $username;
            echo "Welcome $username";
            header("Location: index.php");
        }else{
            echo "User or password incorrect";
        }
    }
?>

<form action="login.php" method="post" id="loginForm">
    <h3>Please log-in</h3>
    <label for="username">User</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" required>
    <button href="#" onclick="document.getElementById('loginForm').submit()" type="submit">Enviar</button>
</form>