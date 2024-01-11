<?php 
include "../../bd.php";

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_banners` WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $titulo = $registro["titulo"];
    $descripcion = $registro["descripcion"];
    $link = $registro["link"];
}

if($_POST){
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"]:"";
    $titulo = (isset($_POST["titulo"])) ? $_POST["titulo"]:"";
    $descripcion = (isset($_POST["descripcion"])) ? $_POST["descripcion"]:"";
    $link = (isset($_POST["link"])) ? $_POST["link"]:"";

    $sentencia = $conexion->prepare("UPDATE `tbl_banners` 
                                        SET titulo=:titulo, descripcion=:descripcion, link=:link
                                        WHERE id=:id");

    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":link", $link);

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
    <div class="card-header">Banners</div>
    <div class="card-body">

        <form action="" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">ID: </label>
                <input type="text" value="<?php echo $txtID;?>" class="form-control" name="txtID" id="txtID" readonly>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título: </label>
                <input type="text" value="<?php echo $titulo;?>" class="form-control" name="titulo" id="titulo"  placeholder="Escriba el título del banner">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción: </label>
                <input type="text" value="<?php echo $descripcion;?>" class="form-control" name="descripcion" id="descripcion"  placeholder="Escribe la descripción del banner">
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" value="<?php echo $link;?>" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Escriba el enlace" />
            </div>

            <button type="submit" class="btn btn-success">Modificar Banner</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php'; ?>