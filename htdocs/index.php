<?php
    include_once("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    session_start();
    //Cambiar a Register
    $idW = $_GET['id']?? null;
    $corr = $_GET['corr'] ?? null;
    $do= $_GET['do'] ?? null;
    $portfolio= $_GET['portfolio'] ??null;
    $iniciado = false;
    
    if(isset($_SESSION['username']) && $_SESSION['username'] != null){
        $idQuery = $conectar->recibir_datos("SELECT id FROM users WHERE username = '".$_SESSION['username']."'");
        $_SESSION['id'] = $idQuery[0]['id'];
        $id = $_SESSION['id'];
        $iniciado=true;

    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <header>
            <?php
                if($iniciado){
                    echo "<a href='logout.php'><img src='./img/logo.png' alt='logo'></a>";
                    echo "<div class='grid3'>";
                    echo "<a href='index.php?corr=1'>Home</a>";
                    echo "<a href='index.php?corr=2'>Agregar Porfolio</a>";
                    echo "<a href='logout.php'>Log-Out</a></div>";

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
    if($iniciado){
        if(isset($portfolio)){
            $_SESSION['idPortfolio']=$portfolio;
            include_once("portfolio.php");
        }else if($corr!=1){
            $portfolio= $_GET['portfolio'] ??null;
            $idPortfolio = $conectar->recibir_datos("SELECT id FROM port WHERE id_usuario = $id");
            if(!$idPortfolio){
            }else{
                    if($corr==2){
                        include_once("form.php");
                        exit;
                    }
                $_SESSION['idPortfolio'] = $idPortfolio[0]['id'];
                header("Location: index.php?corr=1");
            }
             include_once("home.php");

        }else{
            
            echo $portfolio ;
            include_once("ver_portfoliosUser.php");
        }
        

    }
    else{
        // Si no está registrado vemos si quiere iniciar sesion o registrarse
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
