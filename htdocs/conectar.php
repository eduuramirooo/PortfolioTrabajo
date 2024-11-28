<?php
class Conectar{
    private $conexion;
    function __construct($servidor, $usuario, $contrasena, $bbdd)
    {
        $this->conexion = new mysqli($servidor, $usuario, $contrasena, $bbdd);
    }
    function hacer_consulta($consulta, $tipos, $variables){
        $sentencia = $this->conexion->prepare($consulta);
        if ($sentencia === false) {
            throw new Exception("Error in prepare: " . $this->conexion->error);
        }
        $array_completo = array_merge([$tipos],$variables);
        $referencias = [];
        foreach($array_completo as $clave => $valor){
            $referencias[$clave] = &$array_completo[$clave];
        }
        call_user_func_array([$sentencia, 'bind_param'],$referencias);
        if (!$sentencia->execute()) {
            throw new Exception("Error in execute: " . $sentencia->error);
        }
    }
    function recibir_datos($consulta){
        $sentencia = $this->conexion->query($consulta);
        if ($sentencia === false) {
            throw new Exception("Error in query: " . $this->conexion->error);
        }
        $filas = [];
        while( $row = $sentencia->fetch_assoc()){
            $filas[] = $row;
        }
        return $filas;
    }
    public function prepare($query) {
        return $this->conexion->prepare($query);
    }
    function hacer_consultaS ($consulta){
        $sentencia = $this->conexion->query($consulta);
        if ($sentencia === false) {
            throw new Exception("Error in query: " . $this->conexion->error);
        }
        $filas = [];
        while( $row = $sentencia->fetch_assoc()){
            $filas[] = $row;
        }
        return $filas;
    }
}
?>