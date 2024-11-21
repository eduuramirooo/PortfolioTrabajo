<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    session_start();
    //Consulta para saber id portfolio
    
    $consultaPortfolio = $conectar->hacer_consultaS("SELECT id FROM port ORDER BY id DESC LIMIT 1", "", "");
    if ($consultaPortfolio) {
      $idPortfolio = $consultaPortfolio[0]['id'] + 1;
    } else {
      $idPortfolio = 1;
    }
    $_SESSION['idPortfolio'] = $idPortfolio;
    // Datos personales
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $apellido2 = $_POST['2apellido'];
    $anio= $_POST['yearBirth'];
    $id= $_SESSION['id'];
    $imagen = $_FILES['image']['name'];
    // Ahora voy a cambiar el nombre a la imagen
    $imagen="upload".$id.".jpg";
    if (isset($imagen) && $imagen != "") {
        $tipo = $_FILES['image']['type'];
        $tamanio = $_FILES['image']['size'];
        $temp = $_FILES['image']['tmp_name'];

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
            if (move_uploaded_file($temp, $ruta_final)) { // Cambiar a move_uploaded_file
                chmod($ruta_final, 0777);

                // Guardar en la base de datos
                $query = $conectar->hacer_consulta("INSERT INTO head (img, name, apellido, apellido2,anio, id_usuario, id_portfolio) VALUES (?,?,?,?,?,?, ?)", "sssssii", [$ruta_final, $nombre, $apellido, $apellido2,$anio, $id, $idPortfolio]);
                if ($query) {
                    echo "Imagen subida y guardada correctamente";
                } else {
                  $queryPortfolio = $conectar->hacer_consulta("INSERT INTO port (id_usuario) VALUES (?)", "i", [$id]);
                  header("Location: index.php?corr=1");

                }
            } else {
                echo "Error al mover el archivo";
            }
        } else {
            echo "El archivo es demasiado grande";
        }
    } else {
        echo "No se seleccionó ningún archivo";
    }
    //Laboral Experience--
    $workstation= $_POST["workstation"];
    $positionC= $_POST["positionC"];
    $fechaE = date("Y-m-d", strtotime($_POST["fechaE"]));
    $fechaS = date("Y-m-d", strtotime($_POST["fechaS"]));
    $explained= $_POST["explained"];
    $queryInsert = $conectar->hacer_consulta("INSERT INTO linea_experiencia (company, position, fechaE, fechaS, experience, id_portfolio) VALUES (?,?,?,?,?,?)", "sssssi", [$workstation, $positionC, $fechaE, $fechaS, $explained, $idPortfolio]);
    
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    var current_fs, next_fs, previous_fs;
    var left, opacity, scale;
    var animating;

    $(".next").click(function () {
      if (animating) return false;
      animating = true;

      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      // Activar el siguiente paso en la barra de progreso
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

      // Mostrar el siguiente fieldset
      next_fs.show();
      // Animar
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now, mx) {
            scale = 1 - (1 - now) * 0.2;
            left = now * 50 + "%";
            opacity = 1 - now;
            current_fs.css({
              transform: "scale(" + scale + ")",
              position: "absolute",
            });
            next_fs.css({ left: left, opacity: opacity });
          },
          duration: 800,
          complete: function () {
            current_fs.hide();
            animating = false;
          },
          easing: "swing",
        }
      );
    });

    $(".previous").click(function () {
      if (animating) return false;
      animating = true;

      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();

      // Desactivar el paso actual en la barra de progreso
      $("#progressbar li")
        .eq($("fieldset").index(current_fs))
        .removeClass("active");

      // Mostrar el fieldset anterior
      previous_fs.show();

      // Animar
      current_fs.animate(
        { opacity: 0 },
        {
          step: function (now, mx) {
            scale = 0.8 + (1 - now) * 0.2;
            left = (1 - now) * 50 + "%";
            opacity = 1 - now;
            current_fs.css({ left: left });
            previous_fs.css({
              transform: "scale(" + scale + ")",
              opacity: opacity,
            });
          },
          duration: 800,
          complete: function () {
            current_fs.hide();
            animating = false;
          },
          easing: "swing",
        }
      );
    });
  });
</script>





<form id="msform" method="POST" action="form.php"  enctype="multipart/form-data">
  <ul id="progressbar">
    <li class="active">Personal Details</li>
    <li>Photo</li>
    <li>Social Profiles</li>
    <li>Laboral Experience</li>
    <li>Contact</li>
  </ul>
  <fieldset>
    <h2 class="fs-title">Create your CV</h2>
    <h3 class="fs-subtitle">Tell us more about u</h3>
    <input type="text" name="nombre" placeholder="Nombre"/>
    <input type="text" name="apellido" placeholder="Last Name " />
    <input type="text" name="2apellido" placeholder="Second Name" />
    <input type="text" name="yearBirth" placeholder="Year of birth"  maxlength="4"/>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
    <fieldset>
    <h2 class="fs-title">Personal Details</h2>
    <h3 class="fs-subtitle">Upload a photo for your CV</h3>
    <input type="file" name="image" class="img-upload" >
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Social Network</h2>
    <h3 class="fs-subtitle">Write your social networks</h3>
    <input type="text" name="twitter" placeholder="Twitter" />
    <input type="text" name="instagram" placeholder="Instagram" />
    <!-- <input type="text" name="gplus" placeholder="Google Plus" /> -->
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Laboral Experience</h2>
    <h3 class="fs-subtitle">Tell us more about ur laboral Experience</h3>
    <input type="text" name="workstation" placeholder="Company" maxlength="50"/>
    <input type="text" name="positionC" placeholder="Position in the company" maxlength="50"/>
    <input type="date" name="fechaE" />
    <input type="date" name="fechaS"  />
    <input type="textarea" name="explained" placeholder="Explain your experience">
    <p id="mensajeErr"></p>
    <!-- <input type="text" name="gplus" placeholder="Google Plus" /> -->
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Contact</h2>
    <h3 class="fs-subtitle"></h3>
    <input type="text" name="fname" placeholder="Telephone" />
    <input type="email" name="email" placeholder="Email" />
    <input type="text" name="phone" placeholder="Phone" />
    <!-- <textarea name="address" placeholder="Address"></textarea> -->
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input href="form.php" class="submit action-button" type="submit" value="Enviar"/>
  </fieldset>
</form>


<script>
  function validarFechas() {
    var fechaE = $("input[name='fechaE']").val();
    var fechaS = $("input[name='fechaS']").val();
    var mensajeErr = $("#mensajeErr");
    var next = $("fieldset").find(".next");

    if (fechaE && fechaS && new Date(fechaE) >= new Date(fechaS)) {
      next.prop("disabled", true);
      mensajeErr.text("La fecha de salida debe ser más tarde que la de entrada");
    } else {
      mensajeErr.text("");
      next.prop("disabled", false);
    }
  }

  // Validar cuando cambie la fecha de entrada
  $("input[name='fechaE']").on("change", validarFechas);

  // Validar cuando cambie la fecha de salida
  $("input[name='fechaS']").on("change", validarFechas);
</script>

