<?php
include '../../bd.php';

$sentencia = $conexion->prepare("SELECT * from `tbl_colaboradores`");
$sentencia->execute();
$listaColaboradores = $sentencia->fetchAll(PDO::FETCH_ASSOC);

/* echo "<pre>";
var_dump($listaColaboradores);
echo "</pre>"; */

/* INSERT INTO `restaurante`.`tbl_colaboradores` (`id`, `titulo`, `descripcion`, `linkfb`, `linkig`, `linkedin`, `foto`) VALUES ('2', 'Cosme Fulanito', 'Gastrónomo, experto en vinos y licores.', 'https://facebook.com/CosmeFulanito/', 'https://facebook.com/CosmeFulanito/', 'https://facebook.com/CosmeFulanito/', 'foto.jpg');
 */

include '../../templates/header.php';
?>

<br>

<div class="card">
	<div class="card-header">
		<a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros</a>
	</div>
	<div class="card-body">

		<div class="table-responsive-sm">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Nombre del Chef</th>
						<th scope="col">Foto</th>
						<th scope="col">Descripción</th>
						<th scope="col">Redes Sociales</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($listaColaboradores as $key => $value) { ?>
						<tr class="">
							<td scope="row"><?php echo $value['id']; ?></td>
							<td><?php echo $value['titulo']; ?></td>
							<td>
								<img src="../../../images/colabs/<?php echo $value['foto']; ?>" width="50" class="img-fluid rounded-top" alt="imagen_Colaborador" />
							</td>
							<td><?php echo $value['descripcion']; ?></td>
							<td>
								<?php echo $value['linkfb']; ?> <br>
								<?php echo $value['linkig']; ?> <br>
								<?php echo $value['linkedin']; ?> <br>
							</td>
							<td>
								<a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $value['id']; ?>" role="button">Editar</a>
								<a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $value['id']; ?>" role="button">Eliminar</a>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

	</div>
	<div class="card-footer text-muted"></div>
</div>


<?php include '../../templates/footer.php' ?>;