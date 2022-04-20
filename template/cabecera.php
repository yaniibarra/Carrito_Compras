 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/estilos.css">
     <title>Sitio Web 2022</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
     <link rel="stylesheet" href="./css/bootstrap.min.css"/>

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"   integrity="sha384-q8i/X       +965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2  +9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3  +MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

 </head>
 <body>

 <div class="container-fluid">


 

    <!-- BARRA NAVEGACIÓN -->
     <div class="bg-light">
		<nav class="navbar navbar-expand-xl navbar-dark bg-dark border-3 border-bottom ">
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
				<ul class="navbar-nav ms-4">
					<li class="nav-item">
                        <a class="nav-link active" href="index.php">Inicio</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="productos.php">Catalogo</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="MostrarCarrito.php">Ver...carrito
                             
                    <?php //echo (empty($_SESSION['carrito']))? 0 : count($_SESSION['carrito']);?>
                    
                        </a>
                    </li>
 
					<li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>
                    
                   
               
			</div>
		</nav>
	</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> 
<!-- contenido del menu para poner elementos-->
<div class="container">
    <br/>
<!-- todo lo que nosotros vamos a manejar estara aqui en el centro -->
<!-- diseño para poder bajar y dividir nuestro template -->
    <div class="row">

