<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $cargo = $_POST['cargo'];
    $correo = $_POST['correo_electronico'];
    $edad = $_POST['edad'];
    $fecha = $_POST['fecha_ingreso'];

    $stmt = $conn->prepare("INSERT INTO empleado (nombre, cargo, correo_electronico, edad, fecha_ingreso) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $nombre, $cargo, $correo, $edad, $fecha);

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
    <title>Agregar Empleado</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1 style="text-align:center;">Agregar Nuevo Empleado</h2>
    <form action="create.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="cargo" placeholder="Cargo" required>
        <input type="email" name="correo_electronico" placeholder="Correo electrónico" required>
        <input type="number" name="edad" placeholder="Edad">
        <input type="date" name="fecha_ingreso" required>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>
