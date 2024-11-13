<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include_once("conectar.php");
        $conectar = new Conectar("localhost", "root", "", "portfolio");
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $conectar->hacer_consulta("INSERT INTO users (nombre, username, password) VALUES (?,?,?)", "sss", [$name, $username, $password]);
        if($conectar){
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.php");
        }else{
            
        }
    }
?>
<form id="registerForm" action="register.php" method="POST">
    <h3>Please register</h3>
    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>
    <label for="username">User</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password</label>
    <input type="text" name="password" required>
    <a href="#" onclick="document.getElementById('registerForm').submit();">Enviar</a>
</form>