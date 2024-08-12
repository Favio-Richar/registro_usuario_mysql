<?php
include "controladores/conexion.php";

if (isset($_GET['id_usuario'])) {
    $id_usuario = $_GET['id_usuario'];

    // Obtener los datos actuales del registro
    $consulta = $conexion->prepare("SELECT * FROM persona WHERE id_usuario = ?");
    $consulta->bind_param("i", $id_usuario);
    $consulta->execute();
    $resultado = $consulta->get_result();
    $persona = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $nombre1 = $_POST['nombre1'];
    $nombre2 = $_POST['nombre2'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $documento = $_POST['documento'];

    // Actualizar el registro en la base de datos
    $actualizar = $conexion->prepare("UPDATE persona SET nombre1 = ?, nombre2 = ?, apellido1 = ?, apellido2 = ?, documento = ? WHERE id_usuario = ?");
    $actualizar->bind_param("sssssi", $nombre1, $nombre2, $apellido1, $apellido2, $documento, $id_usuario);

    if ($actualizar->execute()) {
        header("Location: registros.php?mensaje=Registro actualizado correctamente");
        exit();
    } else {
        echo "Error al actualizar el registro: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>Editar Registro</h2>
                <form action="editar.php" method="POST">
                    <input type="hidden" name="id_usuario" value="<?php echo $persona['id_usuario']; ?>">
                    <div class="mb-3">
                        <label for="nombre1" class="form-label">Primer Nombre</label>
                        <input type="text" class="form-control" id="nombre1" name="nombre1" value="<?php echo $persona['nombre1']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre2" class="form-label">Segundo Nombre</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre2" value="<?php echo $persona['nombre2']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="apellido1" class="form-label">Primer Apellido</label>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?php echo $persona['apellido1']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido2" class="form-label">Segundo Apellido</label>
                        <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?php echo $persona['apellido2']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="documento" class="form-label">Número de Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento" value="<?php echo $persona['documento']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <a href="registros.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>
