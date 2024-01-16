<?php 
include '../../bd.php';

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";
	
	//Borrado de img
	$sentencia = $conexion->prepare("SELECT * from `tbl_menu` WHERE id=:id");
	$sentencia->bindParam(":id", $txtID);
	$sentencia->execute();

	$registroFoto = $sentencia->fetch(PDO::FETCH_LAZY);

	if(isset($registroFoto['foto'])){
		if(file_exists("../../../images/menu/" . $registroFoto['foto'])){
			unlink("../../../images/menu/" . $registroFoto['foto']);
		}
	}

	//Borrar registros en tbl_menu
    $sentencia = $conexion->prepare("DELETE FROM tbl_menu WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    header("Location: index.php");
}

//INSERT INTO `restaurante`.`tbl_menu` (`id`, `nombre`, `ingredientes`, `foto`, `precio`) VALUES ('1', 'Cochinita Pibil', 'Cerdo, Achiote, Naranja', 'foto.jpg', '100');

$sentencia = $conexion->prepare("SELECT * from `tbl_menu`");
$sentencia -> execute();
$listaMenu = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

include '../../templates/header.php';
?>

<br>

<div class="card">
	<div class="card-header">
		<a name="" id="" class="btn btn-primary" href="crear.php" role="button">Menú de Comida</a>
	</div>

	<div class="card-body">
		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombre</th>
						<th scope="col">Ingredientes</th>
						<th scope="col">Foto del Platillo</th>
						<th scope="col">Precio</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($listaMenu as $key => $value) {?>
						<tr>
							<td><?php echo $value['id'];?></td>
							<td><?php echo $value['nombre'];?></td>
							<td><?php echo $value['ingredientes'];?></td>
							<td>
								<img src="../../../images/menu/<?php echo $value['foto']; ?>" width="50" class="img-fluid rounded-top" alt="imagen_Platillo" />
							</td>
							<td>$<?php echo $value['precio'];?></td>
							<td>
								<a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['id'];?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['id'];?>" role="button">Eliminar</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>

	<div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php' ?>