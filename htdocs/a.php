<?php
$file = __DIR__ . "\\imagenes\\test.txt";
if (file_put_contents($file, "Prueba de escritura") !== false) {
    echo "PHP tiene permisos para escribir en la carpeta.";
} else {
    echo "PHP no tiene permisos para escribir en la carpeta.";
}
?>