<?php 
include "../../bd.php";


	if($_POST){
		$titulo = (isset($_POST['titulo'])) ? $_POST['titulo']:"";
		$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion']:"";
		$linkfb = (isset($_POST['linkfb'])) ? $_POST['linkfb']:"";
		$linkig = (isset($_POST['linkig'])) ? $_POST['linkig']:"";
		$linkedin = (isset($_POST['linkedin'])) ? $_POST['linkedin']:"";

		$foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"]:"";
		$fechaFoto = new DateTime();
		$nombreFoto = $fechaFoto->getTimestamp()."_".$foto;

		$tmp_foto = $_FILES["foto"]["tmp_name"];

		if($tmp_foto!=""){
			move_uploaded_file($tmp_foto,"../../../images/colabs/" . $nombreFoto);
		}

		$sentencia = $conexion->prepare("INSERT INTO `tbl_colaboradores` (`id`, `titulo`, `descripcion`, `linkfb`, `linkig`, `linkedin`, `foto`) 
		VALUES (NULL, :titulo, :descripcion, :linkfb, :linkig, :linkedin, :foto);");

		$sentencia->bindParam(":foto", $nombreFoto);
		$sentencia->bindParam(":titulo", $titulo);
		$sentencia->bindParam(":descripcion", $descripcion);
		$sentencia->bindParam(":linkfb", $linkfb);
		$sentencia->bindParam(":linkig", $linkig);
		$sentencia->bindParam(":linkedin", $linkedin);

		$sentencia->execute();

		header("Location: index.php");
	}

	/* echo "<pre>";
	var_dump($_POST);
	echo "</pre>"; */

	include "../../templates/header.php"; 
?>

<br>
<div class="card">
	<div class="card-header">Colaborador</div>
	<div class="card-body">

		<form action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="foto" class="form-label">Foto: </label>
				<input type="file" class="form-control" name="foto" id="foto" placeholder="Selecciona una imagen" aria-describedby="fileHelpId">
			</div>

			<div class="mb-3">
				<label for="titulo" class="form-label">Nombre: </label>
				<input type="text" required class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Ingresa el nombre del cocinero">
			</div>

			<div class="mb-3">
				<label for="descripcion" class="form-label">Descripción: </label>
				<input type="text" required class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Ingresa la descripción del Chef">
			</div>

			<h6> -- Social Media -- </h6>

			<div class="mb-3">
				<label for="linkfb" class="form-label">Facebook:</label>
				<input type="text" class="form-control" name="linkfb" id="linkfb" aria-describedby="helpId" placeholder="Ingresa su Fb">
			</div>

			<div class="mb-3">
				<label for="linkig" class="form-label">Instagram:</label>
				<input type="text" class="form-control" name="linkig" id="linkig" aria-describedby="helpId" placeholder="Ingresa el Instagram">
			</div>

			<div class="mb-3">
				<label for="linkedin" class="form-label">LinkedIn</label>
				<input type="text" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Ingresa su LinkedIn">
			</div>

			<button type="submit" class="btn btn-success">Agregar Colaborador</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

		</form>

	</div>
	<div class="card-footer text-muted"></div>
</div>


<?php include "../../templates/footer.php"; ?>