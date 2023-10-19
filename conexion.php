<?php

class BaseDatos{
    protected $conexion;
    
    public function __construct(){
        $this->conexion = mysqli_connect("localhost", "root", "", "eva");
        if(mysqli_connect_errno()){
            echo "Error al conectar con la base de datos: " . mysqli_connect_error();
            exit();
        }
    }
    
    public function desconectar(){
        if(isset($this->conexion)){
            mysqli_close($this->conexion);
        }
    }
    
    public function consulta($sql){
        $resultado = mysqli_query($this->conexion, $sql);
        return $resultado;
    }
    
    public function affected(){
        if(mysqli_affected_rows($this->conexion) > 0){
            return 1;
        }else{
            return 0;
        }
    }
}


    
    ?>