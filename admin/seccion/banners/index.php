<?php include "../../templates/header.php"; ?>
<br>

<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registros </a>

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
                    <tr class="">
                        <td scope="row">R1C1</td>
                        <td>R1C2</td>
                        <td>R1C3</td>
                        <td>R1C3</td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <tr class="">
                        <td scope="row">Item</td>
                        <td>Item</td>
                        <td>Item</td>
                        <td>Item</td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include "../../templates/footer.php"; ?>