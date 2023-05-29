<?php 
  $corepage = explode('/', $_SERVER['PHP_SELF']);
    $corepage = end($corepage);
    if ($corepage!=='index.php') {
      if ($corepage==$corepage) {
        $corepage = explode('.', $corepage);
       header('Location: index.php?page='.$corepage[0]);
     }
    }

  if (isset($_POST['addstudent'])) {
  	$name = $_POST['name'];
  	$pcontact = $_POST['pcontact'];
  	$class = $_POST['class'];

  	$query = "INSERT INTO `student_info`(`name`, `class`, `pcontact`) VALUES ('$name', '$class', '$pcontact');";
  	if (mysqli_query($db_con,$query)) {
  		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
  		
  	}else{
  		$datainsert['inserterror']= '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
  	}
  }
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i>  Registrar Estudiante</h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
     <li class="breadcrumb-item" aria-current="page"><a href="index.php">Vista General </a></li>
     <li class="breadcrumb-item active" aria-current="page">Agregar Estudiante</li>
  </ol>
</nav>

<div class="row">
	
<div class="col-sm-6">
		<?php if (isset($datainsert)) {?>
	<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="2000">
	  <div class="toast-header">
	    <strong class="mr-auto">Student Insert Alert</strong>
	    <small><?php echo date('d-M-Y'); ?></small>
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <div class="toast-body">
	    <?php 
	    	if (isset($datainsert['insertsucess'])) {
	    		echo $datainsert['insertsucess'];
	    	}
	    	if (isset($datainsert['inserterror'])) {
	    		echo $datainsert['inserterror'];
	    	}
	    ?>
	  </div>
	</div>
		<?php } ?>
	<form enctype="multipart/form-data" method="POST" action="">
		<div class="form-group">
		    <label for="name">Nombre de Estudiante</label>
		    <input name="name" type="text" class="form-control" id="name" value="<?= isset($name)? $name: '' ; ?>" required="">
	  	</div>
	
	  	
	  	<div class="form-group">
		    <label for="pcontact">Teléfono de Contacto</label>
		    <input name="pcontact" type="text" class="form-control" id="pcontact" pattern="[0-9]{10}" value="<?= isset($pcontact)? $pcontact: '' ; ?>" placeholder="+81........." required="">
	  	</div>
	  	<div class="form-group">
		    <label for="class">Grado Estudiantil</label>
		    <select name="class" class="form-control" id="class" required="">
		    	<option>Selecciona</option>
		    	<option value="Primero">Primero</option>
		    	<option value="Segundo">Segundo</option>
		    	<option value="Tercero">Tercero</option>
		 
		    </select>
	  	</div>
	  	
	  	<div class="form-group text-center">
		    <input name="addstudent" value="Agregar Estudiante" type="submit" class="btn btn-danger">
	  	</div>
	 </form>
</div>
</div>