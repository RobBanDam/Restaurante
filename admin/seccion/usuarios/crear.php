<?php
include '../../bd.php';

if($_POST){
    $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"]:"";
    $password = (isset($_POST["password"])) ? $_POST["password"]:"";
	$password = md5($password);
    $correo = (isset($_POST["correo"])) ? $_POST["correo"]:"";

    $sentencia = $conexion->prepare("INSERT INTO `tbl_usuarios` (`id`, `usuario`, `password`, `correo`)
    VALUES (NULL, :usuario, :password, :correo);");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);

    $sentencia->execute();

    header("Location: index.php");
}

/* echo "<pre>";
var_dump($_POST);
echo "</pre>"; */

include '../../templates/header.php';
?>
<br>

<div class="card">
	<div class="card-header">Agregar Colaborador</div>

	<div class="card-body">
		<form action="" method="post">

			<div class="mb-3">
				<label for="usuario" class="form-label">Nombre de Usuario:</label>
				<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingresa el Usuario" required>
			</div>

			<div class="mb-3">
				<label for="password" class="form-label">Password: </label>
				<input type="password" class="form-control" name="password" id="password" placeholder="Ingresa el password" required>
			</div>

			<div class="mb-3">
				<label for="correo" class="form-label">Correo:</label>
				<input type="email" class="form-control" name="correo" id="correo" placeholder="Ejemplo: abc@mail.com" required>
			</div>

			<button type="submit" class="btn btn-success">Crear Usuario</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

		</form>
	</div>

	<div class="card-footer text-muted"></div>
</div>


<?php include '../../templates/footer.php'; ?>