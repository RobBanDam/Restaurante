<?php 
include "../../bd.php";

$sentencia = $conexion->prepare("SELECT * from `tbl_banners`");
$sentencia -> execute();
$listaBanners = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

include "../../templates/header.php"; 
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
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Enlace</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php foreach ($listaBanners as $key => $value) { ?>
                            <tr class="">
                                <td scope="row"><?php echo $value['id'];?></td>
                                <td><?php echo $value['titulo'];?></td>
                                <td><?php echo $value['descripcion'];?></td>
                                <td><?php echo $value['link'];?></td>
                                <td>
                                    <a name="" id="" class="btn btn-info" href="editar.php" role="button">Editar</a>
                                    <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include "../../templates/footer.php"; ?>