<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test.php" method="POST">
    <input type="number" name="ingreso" required> Inserte el Ingreso <br>
    <input type="number" name="integrantes" required> integrantes de la Familia <br>
    <input type="submit" name="bt1">


    </form>
</body>
</html>

<?php
if(isset($_POST["bt1"])){

$_POST["ingreso"]=$ingreso;
$_POST["integrantes"]=$integrantes;
echo $ingreso;



}


?>