<?php 
include '../../bd.php';

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
    $foto = $registro["foto"];
    $linkfb = $registro["linkfb"];
    $linkig = $registro["linkig"];
    $linkedin = $registro["linkedin"];
}

if($_POST){
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"]:"";

    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"]:"";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"]:"";
    $linkfb = (isset($_POST["linkfb"])) ? $_POST["linkfb"]:"";
    $linkig = (isset($_POST["linkig"])) ? $_POST["linkig"]:"";
    $linkedin = (isset($_POST["linkedin"])) ? $_POST["linkedin"]:"";

    $sentencia = $conexion->prepare("UPDATE `tbl_colaboradores` 
                                    SET 
                                        titulo=:titulo,
                                        descripcion=:descripcion,
                                        linkfb=:linkfb,
                                        linkig=:linkig,
                                        linkedin=:linkedin
                                    WHERE id=:id");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":linkfb", $linkfb);
    $sentencia->bindParam(":linkig", $linkig);
    $sentencia->bindParam(":linkedin", $linkedin);

    $sentencia->execute();

    //Actualización de la foto
    $foto = (isset($_FILES['foto']["name"])) ? $_FILES['foto']["name"]:"";
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if($foto!=""){
        $fechaFoto = new DateTime();
		$nombreFoto = $fechaFoto->getTimestamp()."_".$foto;

        move_uploaded_file($tmp_foto,"../../../images/colabs/" . $nombreFoto);

        $sentencia = $conexion->prepare("SELECT * from `tbl_colaboradores` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $registroFoto = $sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registroFoto['foto'])){
            if(file_exists("../../../images/colabs/" . $registroFoto['foto'])){
                unlink("../../../images/colabs/" . $registroFoto['foto']);
            }
        }

        $sentencia = $conexion->prepare("UPDATE `tbl_colaboradores` 
                                    SET 
                                        foto=:foto
                                    WHERE id=:id");

        $sentencia->bindParam(":id", $txtID);
        $sentencia->bindParam(":foto", $nombreFoto);

        $sentencia->execute();
    }

    header("Location: index.php");
}

include '../../templates/header.php'
?>

<br>
<div class="card">
	<div class="card-header">Colaborador</div>
	<div class="card-body">

		<form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID: </label>
                <input type="text" value="<?php echo $txtID;?>" class="form-control" name="txtID" id="txtID" readonly>
            </div>

			<div class="mb-3">
                <label for="foto" class="form-label">Foto: </label> <br>
                <img width="50" src="../../../images/colabs/<?php echo $foto;?>" alt="foto_colaborador">
				<input type="file" class="form-control" name="foto" id="foto" placeholder="Selecciona una imagen" aria-describedby="fileHelpId">
			</div>

			<div class="mb-3">
				<label for="titulo" class="form-label">Nombre: </label>
				<input type="text" value="<?php echo $titulo;?>" required class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Ingresa el nombre del cocinero">
			</div>

			<div class="mb-3">
				<label for="descripcion" class="form-label">Descripción: </label>
				<input type="text" value="<?php echo $descripcion;?>" required class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Ingresa la descripción del Chef">
			</div>

			<h6> -- Social Media -- </h6>

			<div class="mb-3">
				<label for="linkfb" class="form-label">Facebook:</label>
				<input type="text" value="<?php echo $linkfb;?>" class="form-control" name="linkfb" id="linkfb" aria-describedby="helpId" placeholder="Ingresa su Fb">
			</div>

			<div class="mb-3">
				<label for="linkig" class="form-label">Instagram:</label>
				<input type="text" value="<?php echo $linkig;?>" class="form-control" name="linkig" id="linkig" aria-describedby="helpId" placeholder="Ingresa el Instagram">
			</div>

			<div class="mb-3">
				<label for="linkedin" class="form-label">LinkedIn</label>
				<input type="text" value="<?php echo $linkedin;?>" class="form-control" name="linkedin" id="linkedin" aria-describedby="helpId" placeholder="Ingresa su LinkedIn">
			</div>

			<button type="submit" class="btn btn-success">Modificar Colaborador</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

		</form>

	</div>
	<div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php'; ?>