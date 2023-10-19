
<?php

  date_default_timezone_set("America/Santiago");

  $fecha = date('Y-m-d');
  $hora = date('H:i:s');
  $conexion = mysqli_connect('localhost','root','','eva');
  

  $sql = "INSERT INTO maquina (dia, hora, uso_energia, horas_uso) 
          VALUES('".$fecha."',
                 '".$hora."',
                 '".$_GET['uso_energia']."',
                 '".$_GET['horas_uso']."'
                 )";

  $res = mysqli_query($conexion, $sql);
?>
