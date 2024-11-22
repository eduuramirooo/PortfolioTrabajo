
<?php
    echo "<script> document.addEventListener(\"DOMContentLoaded\",()=>{
        const portfolio = document.querySelector(\".portfolio\");
        setTimeout(()=>{
           portfolio.classList.add('visible');
        },300); });
    </script>";
$id= $_SESSION['id'];
    include_once ("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $portfolio= $_SESSION['idPortfolio'] ;
    if($conectar){
        $queryH = $conectar->recibir_datos("SELECT * FROM head WHERE id_portfolio = $portfolio LIMIT 1");
        if($queryH == null){
            header("Location: index.php");
        }
        $queryE = $conectar->recibir_datos("SELECT * FROM linea_experiencia WHERE id_portfolio = $portfolio");
        $querySocial = $conectar->recibir_datos("SELECT * FROM social WHERE id_portfolio = $portfolio");
        echo "<h1>Portfolio/CV</h1>";
        echo "<div class='portfolio'>";
        foreach($queryH as $row){
            echo"<div class='headA'>";
            echo "<img src='".$row['img']."' alt='".$row['name']."'  >";
            echo "<div class='social'>
            <p>Redes Sociales</p>";
            foreach($querySocial as $rowS){
                    echo "<a href='https://github.com/".$rowS['github']."'><img src='./img/github-svgrepo-com.svg' alt='GitHub' id='github'></a>";
                    echo "<a href='https://twitter.com/".$rowS['twitter']."'><img src='./img/x-social-media-round-icon.svg' id='twitter'><a>";
                    echo "<a href ='mailto:".$rowS['email']."'><img src='./img/mail-forward.svg' id='email'></a>";
                    echo $rowS['tel'];
            }    }

            
            echo"</div></div><hr>";
            echo "<div class='infoHead'>";
            echo "<h2>".$row['name']."</h2>";
            echo "<h2>".$row['apellido']."</h2>";
            echo "<h2>".$row['apellido2']."</h2>";
            echo "<h2>".$row['anio']."</h2>";
            echo "</div><hr>
            <div class='bloqueBajo'>
            <div class='experiencia'>
            <p>Experiencia</p>";
            foreach($queryE as $row){
                echo "<h3>".$row['company']."-".$row['position']."</h3>";
                echo "<h3>".$row['fechaE']." ".$row['fechaS']."</h3>";
                echo "<h3>".$row['experience']."</h3>";
            }
            echo"</div>";
            
        }
        echo "</div>";
    
  
?>