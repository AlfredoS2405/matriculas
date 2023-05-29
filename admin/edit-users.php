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

  if (isset($_POST['updatestudent'])) {
    $name = $_POST['name'];
    $roll = $_POST['id'];
    $pcontact = $_POST['pcontact'];
    $class = $_POST['class'];
    $situacion = $_POST['situacion'];

    $query = "UPDATE `student_info` SET `name`='$name',`id`='$id',`class`='$class',`pcontact`='$pcontact',`situacion`='$situacion' WHERE `id`= $id";
    if (mysqli_query($db_con, $query)) {
      $datainsert['insertsucess'] = '<p style="color: green;">Student Updated!</p>';
      if (!empty($_FILES['photo']['name'])) {
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo);
        unlink('images/'.$oldPhoto);
      } 
      header('Location: index.php?page=all-student&edit=success');
    } else {
      header('Location: index.php?page=all-student&edit=error');
    }
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Editar Información de Estudiante<small class="text-warning"> </small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Vista General</a></li>
     <li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los Estudiantes </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>

<?php
  if (isset($id)) {
    $query = "SELECT `id`, `name`, `class`, `pcontact`, `situacion`, `datetime` FROM `student_info` WHERE `id`=$id";
    $result = mysqli_query($db_con, $query);
    $row = mysqli_fetch_array($result);
  }
?>
<div class="row">
  <div class="col-sm-6">
    <form enctype="multipart/form-data" method="POST" action="">
      <div class="form-group">
        <label for="name">Nombre de Estudiante</label>
        <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
      </div>
      <div class="form-group">
        <label for="id">Número de Matrícula</label>
        <input name="id" type="text" class="form-control" pattern="[0-9]{6}" id="id" value="<?php echo $row['id']; ?>" required="">
      </div>

      <div class="form-group">
        <label for="pcontact">Número de Contacto</label>
        <input name="pcontact" type="text" class="form-control" id="pcontact" value="<?php echo $row['pcontact']; ?>" pattern="[0-9]{10}" placeholder="+57..." required="">
      </div>
      <div class="form-group">
        <label for="class">Grado</label>
        <select name="class" class="form-control" id="class" required="" value="">
          <option>Select</option>
          <option value="Primero" <?= $row['class']=='Primero'? 'selected':'' ?>>Primero</option>
          <option value="Segundo" <?= $row['class']=='Segundo'? 'selected':'' ?>>Segundo</option>
          <option value="Tercero" <?= $row['class']=='Tercero'? 'selected':'' ?>>Tercero</option>
        </select>
      </div>
      <div class="form-group">
        <label for="situacion">Situación</label>
        <select name="situacion" class="form-control" id="situacion">
          <option value="verde" <?= $row['situacion']=='verde'? 'selected':'' ?>>Verde</option>
          <option value="amarillo" <?= $row['situacion']=='amarillo'? 'selected':'' ?>>Amarillo</option>
          <option value="rojo" <?= $row['situacion']=='rojo'? 'selected':'' ?>>Rojo</option>
        </select>
      </div>
      
      <div class="form-group text-center">
        <input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-danger">
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('Estás seguro que deseas eliminar este registro, esta opción es irreversible');
    if (conf)
      window.location = anchor.attr("href");
  }
</script>
