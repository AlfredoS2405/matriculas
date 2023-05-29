<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
  $corepage = end($corepage);
  if ($corepage !== 'index.php') {
    if ($corepage == $corepage) {
      $corepage = explode('.', $corepage);
      header('Location: index.php?page='.$corepage[0]);
    }
  }
?>
<h1 class="text-primary"><i class="fas fa-users"></i> Todos los Estudiantes<small class="text-warning"> </small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="index.php">Vista General</a></li>
    <li class="breadcrumb-item active" aria-current="page">Listado Estudiantes</li>
  </ol>
</nav>
<?php if(isset($_GET['delete']) || isset($_GET['edit'])) {?>
  <div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
    <div class="toast-header">
      <strong class="mr-auto">Insertar Estudiantes</strong>
      <small><?php echo date('d-M-Y'); ?></small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?php 
        if (isset($_GET['delete'])) {
          if ($_GET['delete'] == 'success') {
            echo "<p style='color: green; font-weight: bold;'>Estudiante eliminado exitósamente</p>";
          }  
        }
        if (isset($_GET['delete'])) {
          if ($_GET['delete'] == 'error') {
            echo "<p style='color: red'; font-weight: bold;>Estudiante no eliminado</p>";
          }  
        }
        if (isset($_GET['edit'])) {
          if ($_GET['edit'] == 'success') {
            echo "<p style='color: green; font-weight: bold; '>Estudiante eliminado exitósamente</p>";
          }  
        }
        if (isset($_GET['edit'])) {
          if ($_GET['edit'] == 'error') {
            echo "<p style='color: red; font-weight: bold;'>Estudiante no editado</p>";
          }  
        }
      ?>
    </div>
  </div>
<?php } ?>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Grado</th>
      <th scope="col">Contacto</th>
      <th scope="col">Situación</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      $query = mysqli_query($db_con, 'SELECT * FROM `student_info` ORDER BY `student_info`.`datetime` DESC;');
      $i = 1;
      while ($result = mysqli_fetch_array($query)) { 
        $situacion = $result['situacion'];
        $situacionColor = '';
        if ($situacion == 'verde') {
          $situacionColor = '#A8E6A0';
        } elseif ($situacion == 'amarillo') {
          $situacionColor = '#FFED86';
        } elseif ($situacion == 'rojo') {
          $situacionColor = '#FF8D8D';
        }
    ?>
      <tr id="row_<?php echo $result['id']; ?>" style="background-color: <?php echo $situacionColor; ?>">
        <?php 
        echo '<td>'.$result['id'].'</td>
          <td>'.ucwords($result['name']).'</td>
          <td>'.ucwords($result['class']).'</td>
          <td>'.$result['pcontact'].'</td>
          <td>'.$situacion.'</td>
          <td>
            <a class="btn btn-xs btn-warning" href="index.php?page=editstudent&id='.base64_encode($result['id']).'">
              <i class="fa fa-edit"></i></a>

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="index.php?page=delete&id='.base64_encode($result['id']).'">
             <i class="fas fa-trash-alt"></i></a></td>';?>
      </tr>  
     <?php $i++;} ?>
  </tbody>
</table>
<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('Estás seguro que deseas eliminar este registro, esta opción es irreversible');
    if(conf)
      window.location = anchor.attr("href");
  }
</script>
