<?php
// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username,  $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consultar el campo 'id' en la tabla 'student_info'
    $sql = "SELECT * FROM student_info WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos obtenidos
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . "<br>";
            echo "Nombre: " . $row["name"] . "<br>";
            echo "Email: " . $row["email"] . "<br>";
            echo "Username: " . $row["username"] . "<br>";
            echo "Estado: " . $row["status"] . "<br>";
            echo "Fecha y hora: " . $row["datetime"] . "<br>";
            // Agrega más campos si es necesario
        }
    } else {
        echo "No se encontraron resultados";
    }

    $conn->close();
}
?>
