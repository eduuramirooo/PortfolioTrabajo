<?php
function checkImg($imagen, $id, $idPortfolio, $nombre, $apellido, $apellido2, $anio){
      include_once("conectar.php");
      $conectar = new Conectar("localhost", "root", "", "portfolio");

      $imagen="upload".$id."-".$idPortfolio.".jpg";
      if (isset($imagen) && $imagen != "") {
          $tipo = $_FILES['img']['type'];
          $tamanio = $_FILES['img']['size'];
          $temp = $_FILES['img']['tmp_name'];
  
          $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
          if (!in_array($tipo, $allowed_types)) {
              echo "El archivo no es una imagen válida";
              exit;
          }
  
          if ($tamanio < 1000000) {
              $ruta =  "./img/subidas/";
              if (!file_exists($ruta)) {
                  if (!mkdir($ruta, 0777, true)) {
                      echo "Error al crear el directorio";
                      exit;
                  }
              }
  
              $ruta_final = $ruta . basename($imagen);
              if (move_uploaded_file($temp, $ruta_final)) { 
                  chmod($ruta_final, 0777);
                  $query = $conectar->hacer_consulta("INSERT INTO head (img, name, apellido, apellido2,anio, id_usuario, id_portfolio) VALUES (?,?,?,?,?,?, ?)", "sssssii", [$ruta_final, $nombre, $apellido, $apellido2,$anio, $id, $idPortfolio]);
                if (!$query) {
                    $queryPortfolio = $conectar->hacer_consulta("INSERT INTO port (id_usuario) VALUES (?)", "i", [$id]);
                    header("Location: index.php?corr=1");
                }

    }}
  }}
  ?>