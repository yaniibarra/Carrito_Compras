<?php 
session_start();
if(!isset($_SESSION['user'])){
echo "redirigir al login ... no hay usuario";
  //header("Location:..index.php");
}{
print_r($_SESSION['user']);

}
  


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

<?php $url="http://".$_SERVER['HTTP_HOST']."/SitioWeb2022" ?>



<div class="container-fluid">
    <!-- BARRA NAVEGACIÓN -->
    <div class="bg-light">
		<nav class="navbar navbar-expand-xl navbar-light bg-light border-3 border-bottom ">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Britania muebles y carpinteria</a>
                <button type="button"
                    class="navbar-toggler"
                    data-bs-toggle="collapse"
                    data-bs-target="#MenuNavegacion">
                        <span class="navbar-toggler-icon"></span>
                </button>
            </div>

			<div id="MenuNavegacion" class="collapse navbar-collapse">
				<ul class="navbar-nav ms-3">
					<li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url;?>/admin/inicioo.php">Inicio</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>/admin/seccion/nuevoproducto.php">Catálogo</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>/admin/seccion/cerrar.php">Cerrar </a>
                    </li>
          <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url;?>">Sitio</a>
                    </li>
                   
               
			</div>
		</nav>
	</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

  <div class="container">
    <br/>
      <div class="row">
    