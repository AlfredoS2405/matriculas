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

<?php ?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Calificaciones<small class="text-warning"> </small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="index.php">Vista General </a></li>
    <li class="breadcrumb-item" aria-current="page">Calificaciones </a></li>
  </ol>
</nav>
<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label for="grado">Grado:</label>
      <select class="form-control" id="grado" onchange="showTableByGrado(this.value)">
        <option value="">Seleccionar Grado</option>
        <option value="1">Primero</option>
        <option value="2">Segundo</option>
        <option value="3">Tercero</option>
      </select>
    </div>
  </div>
</div>
<div id="tabla-estudiantes"></div>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/8f14fbbd6d.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  function showTableByGrado(grado) {
    $.ajax({
      url: 'show_table.php',
      type: 'POST',
      data: {grado: grado},
      success: function(response) {
        $('#tabla-estudiantes').html(response);
      }
    });
  }

  function confirmationDelete(anchor) {
    var conf = confirm('Estás seguro que deseas eliminar este registro, esta opción es irreversible');
    if(conf)
      window.location = anchor.attr("href");
  }
</script>
</body>
</html>

