<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <header>
        <img src="./img/logo.png" alt="logo">
    </header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Portfolio Edu</title>
</head>
<body>
<?php
    if(isset($_SESSION['username'])){
        include_once("home.php");
    }
    else{
        include_once("login.php");
    }

?>
    
</body>
</html>
