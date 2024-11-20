<?php
    session_start();
    $idW = $_GET['id']?? null;
    $corr = $_GET['corr'] ?? null;
    $do= $_GET['do'] ?? null;
    $iniciado = false;
    if(isset($_SESSION['username']) && $_SESSION['username'] != null){
        $iniciado=true;

    }
    include_once("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    if(isset($_SESSION["username"])){
        $idQuery = $conectar->recibir_datos("SELECT id FROM users WHERE username = '".$_SESSION['username']."'");
        $_SESSION['id'] = $idQuery[0]['id'];
        $id = $_SESSION['id'];
        
        
            }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <header>
            <?php
                if($iniciado){
                    echo "<a href='logout.php'><img src='./img/logo.png' alt='logo'></a>";
                }else{
                   echo" <img src='./img/logo.png' alt='logo'>";    
                }
            ?>
    

    </header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Portfolio Edu</title>
</head>
<body>
<?php
    if(isset($_SESSION['username']) && $_SESSION['username'] != null){
        if($corr!=1){
            $idPortfolio = $conectar->recibir_datos("SELECT id FROM port WHERE id_usuario = $id");
            if(!$idPortfolio){
                include_once("home.php");
            }else{
                $_SESSION['idPortfolio'] = $idPortfolio[0]['id'];
                header("Location: index.php?corr=1");
            }
            // include_once("home.php");

        }else{
            include_once("ver_portfoliosUser.php");
        }

    }
    else{
        if($idW == 1){
            include_once("register.php");
        }else if($idW == 2){
            include_once("login.php");
        }else{  
            include_once("login.php");
        }
    }

?>
    
</body>
</html>
