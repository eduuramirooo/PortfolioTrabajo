

<?php
        include_once("conectar.php");
        $conectar = new Conectar("localhost", "root", "", "portfolio");
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        //Iniciamos la conexion con la BBDD
        //Recogemos los datos del formulario
        $nombreP=$_GET['nombreP']??null;

    }
   

?>

<div class="container-fav">
<h2>Bienvenido a el gestor de Portfolios de Eduardo</h2>
<p>Para poder acceder a la aplicacion, por favor, inicie sesion</p>
<p>Puede mirar algunos de los porfolios creados por los usuarios o buscar alguno en concreto</p>

    <label for="Select">Selecciona el portfolio que quieres ver</label><br>    
<select name="Select" id="gotoPS">
    <option value="0">Selecciona un portfolio</option>
    <?php
     $query = $conectar->recibir_datos("SELECT * FROM head where id_portfolio > 3");
    foreach($query as $row){
        echo "<option value='".$row['id']."'>".$row['name']."</option>";
    }
    ?>
</select> <br>
    <a id="gotoP" href="">Ver Portfolio</a>

<?php
include_once("fav.php");
    $query = $conectar->recibir_datos("SELECT * FROM port WHERE activo = 1 limit 3");
if($query){
    echo"<h1>Portfolios</h1>";
    echo "<div class='portfolios'>";
    foreach($query as $row){
        $getDatos = $conectar->recibir_datos("SELECT h.name, h.img, e.company, e.fechaE FROM head h INNER JOIN linea_experiencia e ON h.id_portfolio = e.id_portfolio WHERE h.id_portfolio = ".$row['id']." limit 3");
        if($getDatos){
            foreach($getDatos as $rows){
                echo "<div class='portfolioPreview'><a href='index.php?portfolio=".$row['id']."' > ";
                echo "<img src='".$rows['img']."' alt='".$rows['name']."'>
                <div class='info'>";
                echo "<h2>".$rows['name']."</h2>";
                echo "<h4>".$rows['company']."-".$rows['fechaE']."</h4>";
                echo " </div></div></a>";
            }
           
       }
    }
    echo "</div></div>";
}
?>