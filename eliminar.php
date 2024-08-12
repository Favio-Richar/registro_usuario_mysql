<?php
include "controladores/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    
    $consulta = $conexion->prepare("DELETE FROM persona WHERE id_usuario = ?");
    $consulta->bind_param("i", $id_usuario);

    if ($consulta->execute()) {
        header("Location: registros.php?mensaje=Registro eliminado correctamente");
        exit();
    } else {
        echo "Error al eliminar el registro: " . $conexion->error;
    }
}
?>
