<?php 
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
  if ($corepage == $corepage) {
    $corepage = explode('.', $corepage);
    header('Location: index.php?page='.$corepage[0]);
  }
}

$id = base64_decode($_GET['id']);
$query = "SELECT id, class FROM student_info WHERE id = '$id'";
$result = mysqli_query($db_con, $query);
$row = mysqli_fetch_assoc($result);




//$row = base64_decode($_GET['class']);
// Obtener el ID del estudiante a editar
if (isset($_POST['updatecalif'])) {
  //$id = $_POST['id_student']
  $materia1 = $_POST['materia1'];
  $materia2 = $_POST['materia2'];
  $materia3 = $_POST['materia3'];
  $materia4 = $_POST['materia4'];
  $materia5 = $_POST['materia5'];
  $materia6 = $_POST['materia6'];
  $materia7 = $_POST['materia7'];

  if ($row['class'] == 'Primero') {
    $query1 = "UPDATE calprimero SET espanol='$materia1', matematicas='$materia2', ciencias = '$materia3', geografia = '$materia4', edfisica = '$materia5', artes = '$materia6', ingles = '$materia7' WHERE `id_student`= '$id'";
  } elseif ($row['class'] == 'Segundo') {
    $query1 = "UPDATE calsegundo SET espanol='$materia1', matematicas='$materia2', ciencias = '$materia3', fcye = '$materia4', edfisica = '$materia5', artes = '$materia6', ingles = '$materia7' WHERE `id_student`= '$id'";
  } elseif ($row['class'] == 'Tercero') {
    $query1 = "UPDATE caltercero SET espanol='$materia1', matematicas='$materia2', ciencias = '$materia3', fcye = '$materia4', edfisica = '$materia5', artes = '$materia6', ingles = '$materia7' WHERE `id_student`= '$id'";
  }

  if (mysqli_query($db_con, $query1)) {
    $datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
    header('Location: index.php?page=all-student&edit=success');
  } else {
    header('Location: index.php?page=all-student&edit=error');
  }
}

// Obtener la información del estudiante y sus calificaciones
$query = "SELECT id, class FROM student_info WHERE id = '$id'";
$result = mysqli_query($db_con, $query);
$row = mysqli_fetch_assoc($result);

// Obtener las calificaciones del estudiante
$calificaciones = array();
if ($row['class'] == 'Primero') {
  $calificaciones_query = "SELECT * FROM calprimero WHERE id_student = '$id'";
  $calificaciones_result = mysqli_query($db_con, $calificaciones_query);
  $calificaciones_row = mysqli_fetch_assoc($calificaciones_result);
  $classp = 'calprimero';
} elseif ($row['class'] == 'Segundo') {
  $calificaciones_query = 'SELECT * FROM `calsegundo` WHERE `id_student` = $id';
  $calificaciones_result = mysqli_query($db_con, $calificaciones_query);
  $calificaciones_row = mysqli_fetch_assoc($calificaciones_result);
  $classp = 'calsegundo';
} elseif ($row['class'] == 'Tercero') {
  $calificaciones_query = 'SELECT * FROM `caltercero` WHERE `id_student` = $id';
  $calificaciones_result = mysqli_query($db_con, $calificaciones_query);
  $calificaciones_row = mysqli_fetch_assoc($calificaciones_result);
  $classp = 'caltercero';
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Calificaciones</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="text-primary"><i class="fas fa-user-plus"></i> Editar Calificaciones<small class="text-warning"></small></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Vista General</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar Calificaciones</li>
      </ol>
    </nav>
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
          <label for="id">ID:</label>
          <input type="text" class="form-control" id="id" value="<?php echo $row['id']; ?>" readonly="readonly">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h3>Calificaciones:</h3>
        <form method="POST" action="" >
          <input type="hidden" name="id" value="<?php echo $calificaciones_row['id_student']; ?>">
          
          <?php if ($row['class'] == 'Primero'): ?>
            <div class="form-group">
              <label for="materia1">Español:</label>
              <input type="text" class="form-control" id="materia1" name="materia1" value="<?php echo $calificaciones_row['espanol']; ?>">
            </div>
            <div class="form-group">
              <label for="materia2">Matematicas:</label>
              <input type="text" class="form-control" id="materia2" name="materia2" value="<?php echo $calificaciones_row['matematicas']; ?>">
            </div>
            <div class="form-group">
              <label for="materia3">Ciencias:</label>
              <input type="text" class="form-control" id="materia3" name="materia3" value="<?php echo $calificaciones_row['ciencias']; ?>">
            </div>
            <div class="form-group">
              <label for="materia4">Geografia:</label>
              <input type="text" class="form-control" id="materia4" name="materia4" value="<?php echo $calificaciones_row['geografia']; ?>">
            </div>
            <div class="form-group">
              <label for="materia5">Ed Fisica:</label>
              <input type="text" class="form-control" id="materia5" name="materia5" value="<?php echo $calificaciones_row['edfisica']; ?>">
            </div>
            <div class="form-group">
              <label for="materia6">Artes:</label>
              <input type="text" class="form-control" id="materia6" name="materia6" value="<?php echo $calificaciones_row['artes']; ?>">
            </div>
            <div class="form-group">
              <label for="materia7">Ingles:</label>
              <input type="text" class="form-control" id="materia7" name="materia7" value="<?php echo $calificaciones_row['ingles']; ?>">
            </div>
          <?php elseif ($row['class'] == 'Segundo'): ?>
            <div class="form-group">
              <label for="materia1">Español:</label>
              <input type="text" class="form-control" id="materia1" name="materia1" value="<?php echo $calificaciones_row['espanol']; ?>">
            </div>
            <div class="form-group">
              <label for="materia2">Matematicas:</label>
              <input type="text" class="form-control" id="matematicas" name="matematicas" value="<?php echo $calificaciones_row['matematicas']; ?>">
            </div>
            <div class="form-group">
              <label for="materia3">Ciencias:</label>
              <input type="text" class="form-control" id="ciencias" name="ciencias" value="<?php echo $calificaciones_row['ciencias']; ?>">
            </div>
            <div class="form-group">
              <label for="materia4">Ed Fisica:</label>
              <input type="text" class="form-control" id="edfisica" name="edfisica" value="<?php echo $calificaciones_row['edfisica']; ?>">
            </div>
            <div class="form-group">
              <label for="materia5">Artes:</label>
              <input type="text" class="form-control" id="artes" name="artes" value="<?php echo $calificaciones_row['artes']; ?>">
            </div>
            <div class="form-group">
              <label for="materia6">Ingles:</label>
              <input type="text" class="form-control" id="ingles" name="ingles" value="<?php echo $calificaciones_row['ingles']; ?>">
            </div>
            <div class="form-group">
              <label for="materia7">Fcye:</label>
              <input type="text" class="form-control" id="fcye" name="fcye" value="<?php echo $calificaciones_row['fcye']; ?>">
            </div>
          <?php elseif ($row['class'] == 'Tercero'): ?>
            <div class="form-group">
              <label for="materia1">Español:</label>
              <input type="text" class="form-control" id="espanol" name="espanol" value="<?php echo $calificaciones_row['espanol']; ?>">
            </div>
            <div class="form-group">
              <label for="materia2">Matematicas:</label>
              <input type="text" class="form-control" id="matematicas" name="matematicas" value="<?php echo $calificaciones_row['matematicas']; ?>">
            </div>
            <div class="form-group">
              <label for="materia3">Ciencias:</label>
              <input type="text" class="form-control" id="ciencias" name="ciencias" value="<?php echo $calificaciones_row['ciencias']; ?>">
            </div>
            <div class="form-group">
              <label for="materia4">Ed Fisica:</label>
              <input type="text" class="form-control" id="edfisica" name="edfisica" value="<?php echo $calificaciones_row['edfisica']; ?>">
            </div>
            <div class="form-group">
              <label for="materia5">Artes:</label>
              <input type="text" class="form-control" id="artes" name="artes" value="<?php echo $calificaciones_row['artes']; ?>">
            </div>
            <div class="form-group">
              <label for="materia6">Ingles:</label>
              <input type="text" class="form-control" id="ingles" name="ingles" value="<?php echo $calificaciones_row['ingles']; ?>">
            </div>
            <div class="form-group">
              <label for="materia7">Fcye:</label>
              <input type="text" class="form-control" id="fcye" name="fcye" value="<?php echo $calificaciones_row['fcye']; ?>">
            </div>
          <?php endif; ?>

          <button name="updatecalif" type="submit" class="btn btn-primary">Guardar Calificaciones</button>
        </form>
      </div>
    </div>
  </div>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/8f14fbbd6d.js" crossorigin="anonymous"></script>
</body>
</html>