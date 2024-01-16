<?php 
include '../../bd.php';

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_menu` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $ingredientes = $registro["ingredientes"];
    $foto = $registro["foto"];
    $precio = $registro["precio"];
}

if($_POST){
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"]:"";

    $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"]:"";
    $ingredientes = (isset($_POST["ingredientes"])) ? $_POST["ingredientes"]:"";
    $precio = (isset($_POST["precio"])) ? $_POST["precio"]:"";

    $sentencia = $conexion->prepare("UPDATE `tbl_menu` 
                                    SET 
                                        nombre=:nombre,
                                        ingredientes=:ingredientes,
                                        precio=:precio
                                    WHERE id=:id");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":ingredientes", $ingredientes);
    $sentencia->bindParam(":precio", $precio);

    $sentencia->execute();

    //Actualización de la foto
    $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"]:"";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if($foto!=""){
        $fechaFoto = new DateTime();
		$nombreFoto = $fechaFoto->getTimestamp()."_".$foto;

        move_uploaded_file($tmp_foto,"../../../images/menu/" . $nombreFoto);

        $sentencia = $conexion->prepare("SELECT * from `tbl_menu` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $registroFoto = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registroFoto['foto'])){
            if(file_exists("../../../images/menu/" . $registroFoto['foto'])){
                unlink("../../../images/menu/" . $registroFoto['foto']);
            }
        }

        $sentencia = $conexion->prepare("UPDATE `tbl_menu` 
                                    SET 
                                        foto=:foto
                                    WHERE id=:id");

        $sentencia->bindParam(":id", $txtID);
        $sentencia->bindParam(":foto", $nombreFoto);

        $sentencia->execute();
    }

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
                <label for="txtID" class="form-label">ID</label>
                <input type="text" value="<?php echo $txtID;?>" class="form-control" name="txtID" id="txtID" readonly>
            </div>

			<div class="mb-3">
                <label for="foto" class="form-label">Foto</label> <br>
                <img width="50" src="../../../images/menu/<?php echo $foto;?>" alt="foto_platillo">
				<input type="file" class="form-control" name="foto" id="foto" placeholder="Selecciona una imagen" aria-describedby="fileHelpId">
			</div>

			<div class="mb-3">
				<label for="nombre" class="form-label">Nombre del Platillo: </label>
				<input type="text" value="<?php echo $nombre;?>" required class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingresa el nombre del platillo">
			</div>

			<div class="mb-3">
				<label for="ingredientes" class="form-label">Ingredientes del Platillo: </label>
				<input type="text" value="<?php echo $ingredientes;?>" required class="form-control" name="ingredientes" id="ingredientes" aria-describedby="helpId" placeholder="Ingresa los ingredientes del platillo (separados por coma)">
			</div>

			<div class="mb-3">
				<label for="precio" class="form-label">Precio: </label>
				<input type="text" value="<?php echo $precio;?>" required class="form-control" name="precio" id="precio" aria-describedby="helpId" placeholder="Ingresa el nombre del cocinero">
			</div>

			<button type="submit" class="btn btn-success">Modificar Platillo</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
		</form>
	</div>

	<div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php' ?>