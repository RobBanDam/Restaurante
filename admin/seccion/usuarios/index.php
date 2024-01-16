<?php 
include '../../bd.php';

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET["txtID"])) ? $_GET["txtID"]:"";
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    
    $sentencia->execute();

    header("Location: index.php");
}

	$sentencia = $conexion->prepare("SELECT * from `tbl_usuarios`");
	$sentencia->execute();
	$listaUsuario = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include '../../templates/header.php'; 
?>
<!-- INSERT INTO `restaurante`.`tbl_usuarios` (`id`, `usuario`, `password`, `correo`) VALUES ('1', 'admin', '123456', 'admin@admin.com');
 -->
<br>

<div class="card">
	<div class="card-header">
		<a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Usuario</a>
	</div>

	<div class="card-body">
		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Usuario</th>
						<th scope="col">Password</th>
						<th scope="col">Correo</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($listaUsuario as $usuario) {?>
						<tr>
							<td><?php echo $usuario['id']; ?></td>
							<td><?php echo $usuario['usuario']; ?></td>
							<td>*********</td>
							<td><?php echo $usuario['correo']; ?></td>
							<td>
								<a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $usuario['id']; ?>" role="button">Eliminar</a>
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