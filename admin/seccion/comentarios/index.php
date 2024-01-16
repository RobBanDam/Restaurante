<?php 
include '../../bd.php';

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";
    $sentencia = $conexion->prepare("DELETE FROM tbl_comentarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    
    $sentencia->execute();

    header("Location: index.php");
}

	$sentencia = $conexion->prepare("SELECT * from `tbl_comentarios`");
	$sentencia->execute();
	$listaComentario = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include '../../templates/header.php'; 
?>
<!-- INSERT INTO `restaurante`.`tbl_comentarios` (`id`, `nombre`, `correo`, `mensaje`) VALUES ('1', 'Admin', 'admin@admin.com', 'Este mensaje es de prueba');
 -->
<br>

<div class="card">
	<div class="card-header">Bandeja de Comentarios</div>

	<div class="card-body">
		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombre</th>
						<th scope="col">Correo</th>
						<th scope="col">Mensaje</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($listaComentario as $comentario) { ?>
						<tr>
							<td><?php echo $comentario['id'];?></td>
							<td><?php echo $comentario['nombre'];?></td>
							<td><?php echo $comentario['correo'];?></td>
							<td><?php echo $comentario['mensaje'];?></td>
							<td>
								<a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $comentario['id']; ?>" role="button">Eliminar</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>

	<div class="card-footer text-muted"></div>
</div>


<?php include '../../templates/footer.php'; ?>