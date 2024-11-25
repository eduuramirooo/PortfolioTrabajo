<?php 
      echo "<script> document.addEventListener(\"DOMContentLoaded\",()=>{
        const portfolio = document.querySelector(\".portfolioE\");
        setTimeout(()=>{
           portfolio.classList.add('visible');
        },300); });
    </script>";
    $id=$_SESSION['id'];
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
         echo "<h1>Portfolio/CV edit</h1>";
         // echo "<a href='index.php?portfolio=".$portfolio."&editar=true'>Editar</a>";
         echo "<div class='portfolioE'>";
         echo "<form action='editarP.php' method='POST' class='formIE'>";
         foreach($queryH as $row){
            echo "<div class='headA'>";
            echo "<div id='input'> <img src='".$row['img']."'><input type='file' name='img' value='".$row['img']." ' class='fileIE'> </div>";
            echo "<div class='social'>
            <p>Redes Sociales</p>";
            foreach($querySocial as $rowS){
                    echo "<label for='github'>GitHub</label>";
                    echo"<input type='text' name='github' value='".$rowS['github']." ' class='inputIE'>";
                    echo "<label for='twitter'>Twitter</label>";
                    echo "<input type='text' name='twitter' value='".$rowS['twitter']." ' class='inputIE'>";
                     echo "<label for='email'>Email</label>";
                    echo "<input type='text' name='email' value='".$rowS['email']." ' class='inputIE'>";
                    echo "<label for='tel'>Teléfono</label>";
                    echo "<input type='text' name='tel' value='".$rowS['tel']." ' class='inputIE'>";
            }    }
            echo"</div></div><hr>";
            echo "<div class='infoE'>";
            echo "<div class='infoHead'>";
            echo "<label for='name'>Nombre</label>";
            echo "<input type='text' name='name' value='".$row['name']." ' class='inputIE'>";
            echo "<label for='apellido'>Apellido</label>";
            echo "<input type='text' name='apellido' value='".$row['apellido']." ' class='inputIE'>";
            echo "<label for='apellido2'>Segundo Apellido</label>";
            echo "<input type='text' name='apellido2' value='".$row['apellido2']." ' class='inputIE'>";
            echo "<label for='anio'>Año</label>";
            echo "<input type='text' name='anio' value='".$row['anio']." ' class='inputIE'>";
            echo "</div>";
            echo "<div class='bloqueBajo'>
            <div class='experiencia'>
            <p>Experiencia</p>";
            foreach($queryE as $row){
                echo "<label for='company'>Compañía</label>";
                echo "<input type='text' name='company' value='".$row['company']." ' class='inputIE'>";
                echo "<label for='position'>Posición</label>";
                echo "<input type='text' name='position' value='".$row['position']." ' class='inputIE'>";
                echo "<label for='fechaE'>Fecha de Entrada</label>";
                echo "<input type='text' name='fechaE' value='".$row['fechaE']." ' class='inputIE'>";
                echo "<label for='fechaS'>Fecha de Salida</label>";
                echo "<input type='text' name='fechaS' value='".$row['fechaS']." ' class='inputIE'>";
                echo "<label for='experience'>Experiencia</label>";
                echo "<input type='text' name='experience' value='".$row['experience']." ' class='inputIE'>";
            }
            echo"</div></div></div>";
            echo "<input type='submit' value='Guardar' class='btnIE'>";
            echo "</div></form>";
         }
      
    ?>