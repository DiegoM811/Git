<?php
require_once("conexion.php");
$conexion = new basedatos();

$date = isset($_GET['date']) ? $_GET['date'] : '';
$startHour = isset($_GET['start']) ? $_GET['start'] : '';
$endHour = isset($_GET['end']) ? $_GET['end'] : '';
$query = "SELECT dia, hora, uso_energia, horas_uso FROM maquina";
if (!empty($startHour) && !empty($endHour)) {
  $query .= " WHERE hora >= '$startHour' AND hora <= '$endHour'";
}
$query .= " LIMIT 10";
$sql = $conexion->consulta($query);
$data = $sql->fetch_all(MYSQLI_ASSOC);


$totalRows = $conexion->consulta("SELECT COUNT(*) as total FROM maquina")->fetch_assoc()['total'];
$totalPages = ceil($totalRows / 10);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Datos</title>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
  <div class="container">

    <form method="GET">

      <label for="date">Fecha:</label>
      <input type="date" id="date" name="date" required value="<?php echo $date; ?>">
      <label for="start">Hora de inicio:</label>
      <input type="time" id="start" name="start" value="<?php echo $startHour; ?>" placeholder="HH-MM-SS">
      <label for="end">Hora de fin:</label>
      <input type="time" id="end" name="end" value="<?php echo $endHour; ?>">
      <button type="submit" name="submit" <?php empty($date) ? 'disabled' : ''; ?>>Calcular</button>
    </form>
    
    <table>
      <thead>
        <tr>
          <th>Día</th>
          <th>Hora</th>
          <th>Promedio de Consumo Por hora</th>
          <th>Tiempo de uso por Hora</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $row): ?>
          <tr>
            <td><?php echo $row['dia']; ?></td>
            <td><?php echo $row['hora']; ?></td>
            <td><?php echo $row['uso_energia']." A"; ?></td>
            <td><?php echo $row['horas_uso']." Hora"; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?date=<?php echo $date; ?>&start=<?php echo $startHour; ?>&end=<?php echo $endHour; ?>&page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>"><?php echo $i; ?></a>
      <?php endfor; ?>
    </div>
    
    <?php if (!empty($startHour) && !empty($endHour) && !empty($date)): ?>
      <?php
        $sumaEnergia = $conexion->consulta("SELECT SUM(uso_energia) as total FROM maquina WHERE hora >= '$startHour' AND hora <= '$endHour' AND dia = '$date'")->fetch_assoc()['total'];
      ?>
      <table class="pagination">
        <tr>
          <th>Total de Energía Utilizada entre las horas <?php echo $startHour ?> y <?php echo $endHour ?> de la fecha <?php echo $date ?> </th>
        </tr>
        <tr>
          <td><?php
          if($sumaEnergia>0) {
            
        
          echo $sumaEnergia." A"; 
        }else 
        echo "0 A"?></td>
        </tr>
      </table>
    <?php endif; ?>
  </div>
</body>
</html>
