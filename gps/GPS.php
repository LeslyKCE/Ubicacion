<?php
date_default_timezone_set('America/Lima');
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "geolocalizacion";

// Obtener las coordenadas enviadas mediante POST
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
//var_dump($longitud);

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

$cod_alquiler="AL00011";

$query_u2 = mysqli_query($conn, "SELECT * FROM alquiler WHERE cod_alquiler='$cod_alquiler' and estado=1 limit 1");

$totalRows_u2 = mysqli_num_rows($query_u2);

$id_alquiler="";
foreach($query_u2 as $c){
    $id_alquiler=$c['id_alquiler'];
}

$fechaActual = date('Y-m-d H:i:s');
echo $fechaActual;

// Insertar las coordenadas en la tabla de la base de datos
$sql = "INSERT INTO alquiler_ubicaciones (lat, lng, id_alquiler,cod_alquiler, estado, fec_reg) VALUES ('$latitud', '$longitud', '$id_alquiler','$cod_alquiler', '1', '$fechaActual')";

if ($conn->query($sql) === TRUE) {
    echo "Coordenadas insertadas correctamente";
} else {
    echo "Error al insertar las coordenadas: " . $conn->error;
} 

// Cerrar la conexión a la base de datos
$conn->close();
?>