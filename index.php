<?php
	include "admin/bd.php";

	$sentencia = $conexion->prepare("SELECT * FROM tbl_banners ORDER BY id DESC limit 1");
	$sentencia -> execute();
	$listaBanners = $sentencia->fetchAll(PDO::FETCH_ASSOC);

	$sentencia = $conexion->prepare("SELECT * FROM tbl_colaboradores order by id desc limit 3");
	$sentencia -> execute();
	$listaColabs = $sentencia->fetchAll(PDO::FETCH_ASSOC);

	$sentencia = $conexion->prepare("SELECT * FROM tbl_testimonios order by id desc limit 3");
	$sentencia -> execute();
	$listaTestimonio = $sentencia->fetchAll(PDO::FETCH_ASSOC);

	$sentencia = $conexion->prepare("SELECT * FROM tbl_menu order by id desc limit 4");
	$sentencia -> execute();
	$listaMenu = $sentencia->fetchAll(PDO::FETCH_ASSOC);

	if($_POST){
		//echo "<pre>"; var_dump($_POST); echo "</pre>";
		$nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
		$correo = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
		$mensaje = filter_var($_POST["mensaje"], FILTER_SANITIZE_STRING);

		if($nombre && $correo && $mensaje){
			$sql = "INSERT INTO `tbl_comentarios` (`id`, `nombre`, `correo`, `mensaje`) 
					VALUES 
						(NULL, :nombre, :correo, :mensaje);";
			
			$resultado = $conexion->prepare($sql);
			$resultado -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$resultado -> bindParam(':correo', $correo, PDO::PARAM_STR);
			$resultado -> bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
			$resultado->execute();
		}
		header("Location: index.php");
	}
?>


<!doctype html>
<html lang="es">

<head>
	<title>Restaurante</title>
	<!-- Required meta tags -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

	<!-- Bootstrap CSS v5.2.1 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	<!-- <style>
		body {
			overflow: hidden;
		}
	</style> -->
</head>

<body>

	<!-- Navegación -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="navbar-brand" href="#inicio"><i class="fas fa-utensils"> </i> Restaurante x100pre</a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="nav navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#menu">Menú del día</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#chefs">Chefs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#testimonios">Testimoniales</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#contacto">Contacto</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#horario">Horarios</a>
					</li>
				</ul>
			</div>

		</div>
	</nav>

	<!-- img de Fondo -->
	<section id="inicio" class="container-fluid p-0">
		<div class="banner-img" style="position: relative; background:url(images/img1.jpeg) center/cover no-repeat; height:400px">
			<div class="banner-text" style="position:absolute; top:50%; left:50%; transform:translate(-50%, 60%); text-align: center; color:#fff">

			<?php foreach($listaBanners as $banner) {?>
				<h1>Bienvenido a <?php echo $banner['titulo'];?></h1>
				<p><?php echo $banner['descripcion'];?></p>
				<a href="<?php echo $banner['link'];?>" class="btn btn-primary">Ver Menú</a>
			<?php } ?>

			</div>
		</div>
	</section>

	<!-- Sección "Bienvenid@ a tu Menú Virtual"-->
	<section id="id" class="container mt-4 text-center">
		<div class="jumbotron bg-dark text-white">
			<br>
			<h2>¡Bienvenid@ a tu Menú Virtual!</h2>
			<p>Descubre una experiencia culinaria única</p>
			<br>
		</div>
	</section>

	<!-- Sección "Chefs"-->
	<section id="chefs" class="container mt-4 text-center">
		<h2>Nuestros Expertos en la Cocina</h2>
		<div class="row">
			<?php foreach($listaColabs as $colab) {?>
				<div class="col-md-4">
					<div class="card">
						<img src="images/colabs/<?php echo $colab["foto"];?>" alt="Imagen Chef" class="card-img-top" style="object-fit: cover;">
						<div class="card-body">
							<h5 class="card-title"><?php echo $colab['titulo'];?></h5>
							<p class="card-text"><?php echo $colab['descripcion'];?></p>
							<div class="social-icons mt-3">
								<a href="<?php echo $colab['linkfb'];?>" class="text-dark me-3"><i class="fab fa-facebook"></i></a>
								<a href="<?php echo $colab['linkedin'];?>" class="text-dark me-3"><i class="fab fa-linkedin"></i></a>
								<a href="<?php echo $colab['linkig'];?>" class="text-dark me-3"><i class="fab fa-instagram"></i></a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</section>

	<!-- Testimonios -->
	<section id="testimonios" class="bg-light py-5">
		<div class="container">
			<h2 class="mb-4 text-center">Testimonios</h2>
			<div class="row">
				<?php foreach($listaTestimonio as $testimonio) {?>
					<div class="col-md-6 d-flex">
						<div class="card md-4 w-100">
							<div class="card-body">
								<p class="card-text"><?php echo $testimonio['opinion']; ?></p>
							</div>
							<div class="card-footer text-muted"><?php echo $testimonio['nombre']; ?></div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<!-- Menú -->
	<main id="menu" class="container mt-4">
		<h2 class="text-center">Menú (Nuestras Recomendaciones)</h2>
		<br>
		<div class="row row-cols-1 row-cols-md-4 g-4">
			<?php foreach($listaMenu as $menu) { ?>
				<div class="col d-flex">
					<div class="card bg-transparent border-success h-100">
						<img src="images/menu/<?php echo $menu['foto'];?>" alt="imagen de comida" class="card-img-top" style="height: 15rem; object-fit: cover;">
						<div class="card-body" style="width: 80rem;">
							<h5 class="card-title"><?php echo $menu['nombre'];?></h5>
							<p class="card-text"><?php echo $menu['ingredientes'];?></p>
							<p class="card-text">$<?php echo $menu['precio'];?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			
		</div>
	</main>

	<!-- Contacto -->
	<section id="contacto" class="container mt-4">
		<h2 class="text-center">Contáctanos</h2>
		<h5>Estamos aquí para servirte</h5>

		<form action="?" method="post">
			<div class="mb-3">
				<label for="nombre">Nombre: </label><br>
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aquí tu Nombre" required><br>
				<label for="correo">Correo Electrónico: </label><br>
				<input type="email" class="form-control" id="correo" name="correo" placeholder="Ejemplo@ejemplo.com" required><br>
				<label for="mensaje">Mensaje: </label><br>
				<textarea id="mensaje" class="form-control" name="mensaje" rows="6" cols="50"></textarea><br>
			</div>
			<input type="submit" class="btn btn-primary" value="Enviar Mensaje">
		</form>
		<br>
	</section>
	
	<!-- Seccion de horarios -->
	<div id="horario" class="text-center bg-light p-4">
		<h3 class="mb4">Horario de Atención</h3>

		<div>
			<p><strong>Lunes a Viernes</strong></p>
			<p>8:00 a.m. - 10:00 p.m.</p>
		</div>

		<div>
			<p><strong>Sábado</strong></p>
			<p>10:00 a.m. - 10:00 p.m.</p>
		</div>

		<div>
			<p><strong>Domingo</strong></p>
			<p>9:00 a.m. - 7:00 p.m.</p>
		</div>
	</div>

	<footer class="bg-dark text-light text-center py-2">
		<p>Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
	</footer>

	<!-- Bootstrap JavaScript Libraries -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>