<?php
// Obtener el grado enviado por POST
$grado = $_POST['grado'];

// Definir las materias según el grado seleccionado
if ($grado == '1') {
  $materias = ['espanol', 'matematicas', 'ciencias', 'geografia', 'edfisica', 'artes', 'ingles'];
  $db_table = 'calprimero';
} elseif ($grado == '2') {
  $materias = ['espanol', 'matematicas', 'ciencias',  'edfisica', 'artes', 'ingles', 'fcye'];
  $db_table = 'calsegundo';
} elseif ($grado == '3') {
  $materias = ['espanol', 'matematicas', 'ciencias',  'edfisica', 'artes', 'ingles', 'fcye'];
  $db_table = 'caltercero';
}

// Incluir el archivo de conexión a la base de datos
require_once 'db_con.php';

// Establecer la conexión a la base de datos
$db_con = mysqli_connect(DBHOST, DBUSER, '', DBNAME);

// Verificar si la conexión fue exitosa
if (!$db_con) {
  die('Error al conectar a la base de datos: ' . mysqli_connect_error());
}

// Generar la tabla con las materias correspondientes al grado seleccionado
echo '<table class="table table-striped table-hover table-bordered" id="data">';
echo '<thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          ';
foreach ($materias as $materia) {
  echo '<th scope="col">'.ucwords($materia).'</th>';
}
echo '<th scope="col">Acción</th>
      </tr>
      </thead>';
echo '<tbody>';

// Obtener los datos de la tabla de calificaciones
$query = mysqli_query($db_con, "SELECT * FROM `$db_table`;");
while ($result = mysqli_fetch_array($query)) { 
  // Obtener el ID de las tres bases de datos
  $id_student = $result['id_student'];

  $idQuery = mysqli_query($db_con, "SELECT id_student FROM calprimero WHERE id_student = '$id_student';");
  $idResult = mysqli_fetch_array($idQuery);

  if (empty($idResult)) {
    $idQuery = mysqli_query($db_con, "SELECT id_student FROM calsegundo WHERE id_student = '$id_student';");
    $idResult = mysqli_fetch_array($idQuery);
  }

  if (empty($idResult)) {
    $idQuery = mysqli_query($db_con, "SELECT id_student FROM caltercero WHERE id_student = '$id_student';");
    $idResult = mysqli_fetch_array($idQuery);
  }

  echo '<tr id_student="row_'.$id_student.'">
          <td>'.$id_student.'</td>';
  foreach ($materias as $materia) {
    echo '<td>'.$result[$materia].'</td>';
  }
  echo '<td>
          <a class="btn btn-xs btn-warning" href="index.php?page=editing&id='.base64_encode($id_student).'">
            <i class="fa fa-edit"></i>
          </a>
          &nbsp; 
          <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="index.php?page=delete&id='.base64_encode($id_student).'">
            <i class="fas fa-trash-alt"></i>
          </a>
        </td>
        </tr>';
}
echo '</tbody>';
echo '</table>';
?>
