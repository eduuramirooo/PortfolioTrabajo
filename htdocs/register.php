    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            include_once("conectar.php");
            $conectar = new Conectar("localhost", "root", "", "portfolio");
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
             $consultaQ=$conectar->hacer_consulta("SELECT * FROM users WHERE username = ?", "s", [$username]);
             if ($consultaQ){
                 echo "<script>document.getElementById('errorLog').innerHTML='User already exists'</script>";
                 exit;
                }else{

               $conectar->hacer_consulta("INSERT INTO users (nombre, username, password) VALUES (?,?,?)", "sss", [$name, $username, $password]);
                if($conectar){
                    session_start();
                    $_SESSION['username'] = $username;

                    header("Location: index.php");
                }
        }}
    ?>
    <form id="registerForm" action="register.php" method="POST" style="margin-top: 20px;">
        <h3>Please register</h3>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required maxlength="20">
        <label for="username">User</label>
        <input type="text" name="username" id="username" required maxlength="30">
        <label for="password">Password</label>
        <input type="password" name="password" required>
        <p id="errorLog"></p>
        <button type="submit">Enviar</button>
        <a href="index.php?id=2">Salir</a>
    </form>