<?php 
$user=  $_SESSION['user_login'];
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }
?>
<h1 class="text-primary"><i class="fas fa-user"></i>  Perfil de Usuario</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Vista General </a></li>
     <li class="breadcrumb-item active" aria-current="page">Perfil de Usuario</li>
  </ol>
</nav>
<?php 
  $query = mysqli_query($db_con, "SELECT * FROM `users` WHERE `username` ='$user';");
  $row = mysqli_fetch_array($query);

 ?>
<div class="row">
  <div class="col-sm-6">
    <table class="table table-bordered">
      <tr>
        <td>ID de Usuario</td>
        <td><?php echo $row['id']; ?></td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td><?php echo ucwords($row['name']); ?></td>
      </tr>
      <tr>
        <td>Correo</td>
        <td><?php echo $row['email']; ?></td>
      </tr>
      <tr>
        <td>Usuario</td>
        <td><?php echo ucwords($row['username']); ?></td>
      </tr>
      <tr>
        <td>Estado</td>
        <td><?php echo ucwords($row['status']); ?></td>
      </tr>
      <tr>
        <td>Fecha de Registro</td>
        <td><?php echo $row['datetime']; ?></td>
      </tr>
    </table>
    <a class="btn btn-warning pull-right" href="index.php?page=edit-user&id=<?php echo base64_encode($row['id']); ?>">Editar Perfil</a>
    </div></div>

