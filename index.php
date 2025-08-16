<?php
include("db.php"); // Conexión a la base de datos

// Consulta a la tabla empleado
$sql = "SELECT * FROM empleado ORDER BY id_empleado DESC";
$result = $conn->query($sql);
?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Lista de Empleados</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Correo Electrónico</th>
            <th>Edad</th>
            <th>Fecha de Ingreso</th>
            <th>Acciones</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row['id_empleado']."</td>
                        <td>".$row['nombre']."</td>
                        <td>".$row['cargo']."</td>
                        <td>".$row['correo_electronico']."</td>
                        <td>".$row['edad']."</td>
                        <td>".$row['fecha_ingreso']."</td>
                        <td>
                            <a href='update.php?id=".$row['id_empleado']."' class='boton boton-editar'>Editar</a>
                            <a href='delete.php?id=".$row['id_empleado']."' class='boton boton-eliminar'>Eliminar</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay empleados registrados</td></tr>";
        }
        ?>
    </table>

    <div style="text-align: center; margin-top: 20px;">
        <a href="create.php" class="boton-agregar">+ Agregar Empleado</a>
    </div>

</body>
</html>

<?php $conn->close(); ?>
