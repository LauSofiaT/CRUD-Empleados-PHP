<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("DELETE FROM empleado WHERE id_empleado = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar: " . $stmt->error;
    }
    $stmt->close();
}
?>
