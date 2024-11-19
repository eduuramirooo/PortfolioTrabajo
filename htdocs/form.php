<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $apellido2 = $_POST['2apellido'];
    $anio= $_POST['yearBirth'];
    $id= $_SESSION['id'];
    include_once("conectar.php");
    $conectar = new Conectar("localhost", "root", "", "portfolio");
    $imagen = $_FILES['image']['name'];

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
            $ruta = __DIR__ . "/imagenes/";
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
                $query = $conectar->hacer_consulta("INSERT INTO head (img, name, apellido, apellido2,anio, id_usuario) VALUES (?,?,?,?,?,?)", "sssssi", [$ruta_final, $nombre, $apellido, $apellido2,$anio, $id]);
                if ($query) {
                    echo "Imagen subida y guardada correctamente";
                } else {
                    echo "Error al guardar la imagen en la base de datos";
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
}
?>
