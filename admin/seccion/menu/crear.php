<?php
include '../../bd.php';

	if($_POST) {
		$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : "";
		$ingredientes = (isset($_POST['ingredientes'])) ? $_POST['ingredientes'] : "";
		$precio = (isset($_POST['precio'])) ? $_POST['precio'] : "";

		$foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"] : "";
		$fechaFoto = new DateTime();
		$nombreFoto = $fechaFoto->getTimestamp() . "_" . $foto;

		$tmp_foto = $_FILES["foto"]["tmp_name"];

		if ($tmp_foto != "") {
			move_uploaded_file($tmp_foto, "../../../images/menu/" . $nombreFoto);
		}

		$sentencia = $conexion->prepare("INSERT INTO `tbl_menu` (`id`, `nombre`, `ingredientes`, `precio`, `foto`) 
			VALUES (NULL, :nombre, :ingredientes, :precio, :foto);");

		$sentencia->bindParam(":foto", $nombreFoto);
		$sentencia->bindParam(":nombre", $nombre);
		$sentencia->bindParam(":ingredientes", $ingredientes);
		$sentencia->bindParam(":precio", $precio);

		$sentencia->execute();

		header("Location: index.php");
}

include '../../templates/header.php';
?>

<br>

<div class="card">
	<div class="card-header">Menú de Comida</div>

	<div class="card-body">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="foto" class="form-label">Foto: </label>
				<input type="file" class="form-control" name="foto" id="foto" placeholder="Selecciona una imagen">
			</div>

			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre del Platillo: </label>
				<input type="text" required class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del platillo">
			</div>

			<div class="mb-3">
				<label for="ingredientes" class="form-label">Ingredientes: </label>
				<input type="text" required class="form-control" name="ingredientes" id="ingredientes" placeholder="Ingresa los ingredientes (separados por coma)">
			</div>

			<div class="mb-3">
				<label for="precio" class="form-label">Precio: </label>
				<input type="text" required class="form-control" name="precio" id="precio" placeholder="Ingresa el precio del platillo">
			</div>

			<button type="submit" class="btn btn-success">Agregar Platillo</button>
			<a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

		</form>
	</div>

	<div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php' ?>