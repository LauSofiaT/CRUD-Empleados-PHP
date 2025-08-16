<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM empleado WHERE id_empleado = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $empleado = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $correo = $_POST['correo_electronico'];
    $edad = $_POST['edad'];
    $fecha = $_POST['fecha_ingreso'];

    $stmt = $conn->prepare("UPDATE empleado SET nombre=?, cargo=?, correo_electronico=?, edad=?, fecha_ingreso=? WHERE id_empleado=?");
    $stmt->bind_param("sssisi", $nombre, $cargo, $correo, $edad, $fecha, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 class="titulo-form">Editar Empleado</h1>
    <div class="form-container">
        
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $empleado['id_empleado']; ?>">
            <input type="text" name="nombre" value="<?php echo $empleado['nombre']; ?>" required>
            <input type="text" name="cargo" value="<?php echo $empleado['cargo']; ?>" required>
            <input type="email" name="correo_electronico" value="<?php echo $empleado['correo_electronico']; ?>" required>
            <input type="number" name="edad" value="<?php echo $empleado['edad']; ?>">
            <input type="date" name="fecha_ingreso" value="<?php echo $empleado['fecha_ingreso']; ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    </div>
</body>
</html>
