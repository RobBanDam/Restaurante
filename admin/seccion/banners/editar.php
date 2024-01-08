<?php include '../../templates/header.php'; ?>
<br>

<div class="card">
    <div class="card-header">Banners</div>
    <div class="card-body">

        <form action="" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título: </label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Escriba el título del banner">
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción: </label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Escribe la descripción del banner">
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Link</label>
                <input type="text" class="form-control" name="link" id="link" aria-describedby="helpId" placeholder="Escriba el enlace" />
            </div>

            <button type="submit" class="btn btn-success">Crear Banner</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include '../../templates/footer.php'; ?>