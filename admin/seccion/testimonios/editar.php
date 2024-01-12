<?php
include '../../bd.php';

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_testimonios` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $opinion = $registro["opinion"];
    $nombre = $registro["nombre"];
}

if($_POST){
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"]:"";
    $opinion = (isset($_POST["opinion"])) ? $_POST["opinion"]:"";
    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"]:"";

    $sentencia = $conexion->prepare("UPDATE `tbl_testimonios` 
                                        SET opinion=:opinion, nombre=:nombre
                                        WHERE id=:id");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":opinion", $opinion);
    $sentencia->bindParam(":nombre", $nombre);

    $sentencia->execute();

    header("Location: index.php");

    /* echo "<pre>";
    var_dump($_POST);
    echo "</pre>"; */
}

include '../../templates/header.php';
?>

<br>
<div class="card">
	<div class="card-header">Testimonios</div>
	<div class="card-body">

		<form action="" method="post">
			<div class="mb-3">
				<label for="txtID" class="form-label">ID</label>
				<input type="text" value="<?php echo $txtID;?>" class="form-control" name="txtID" id="txtID" aria-describedby="helpId" readonly>
			</div>

			<div class="mb-3">
				<label for="opinion" class="form-label">Opinión: </label>
				<input type="text" value="<?php echo $opinion;?>" class="form-control" name="opinion" id="opinion" aria-describedby="helpId" placeholder="Ingresa la opinión" required>
			</div>

			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre: </label>
				<input type="text" value="<?php echo $nombre;?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingresa el Nombre" required>
			</div>

			<button type="submit" class="btn btn-success">Modificar Testimonio</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

		</form>
	</div>
	<div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php' ?>