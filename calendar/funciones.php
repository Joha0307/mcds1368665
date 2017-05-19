<?php

$conn = mysqli_connect("localhost", "root", "", "centrovacacional");

// Create connection
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$method = $_POST["method"];

switch ($method) {

    case "insertar": insertar($conn);
        break;
    case "editar": editar($conn);
        break;
    case "eliminar": eliminar($conn);
        break;
    case "cargar": cargar($conn);
        break;
    case "listar": listar($conn);
        break;
}

function insertar($conn) {

    $nombre = $_POST["nombre"];
    $capacidad = $_POST["capacidad"];



    $sql = "INSERT INTO reserva (nombre, capacidad, disponibilidad)
	VALUES ('{$nombre}', {$capacidad}, 1)";



    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Tu referencia no se encuentra registrada, intenta de nuevo";
// echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function editar($conn) {

    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $capacidad = $_POST["capacidad"];





    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE reserva set nombre = '{$nombre}', capacidad = {$capacidad}
        where id={$id}
    
";


    if ($conn->query($sql) === TRUE) {
        echo "Editado correactamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function eliminar($conn) {


    $id = $_POST["id"];



    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "delete from reserva where id={$id}";


    $result = mysqli_query($conn, $sql);


    if ($conn->query($sql) === TRUE) {
        echo "elimino";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function cargar($conn) {

    $id = $_POST["id"];
    


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select * from reserva where id={$id}";


    $result = mysqli_query($conn, $sql);


    while ($row = mysqli_fetch_assoc($result)) {

        $info = implode(",", $row);
    }

    echo $info;
}

function listar($conn) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select * from reserva";


    $result = mysqli_query($conn, $sql);

    $info = "<table class=\"table\">
                        <tr>
                            <th>Nombre</th>
                            <th>capacidad</th>
                            <th>disponibilidad</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>";


    while ($row = mysqli_fetch_assoc($result)) {

        $info .= "<tr>
                            <th>{$row["nombre"]}</th>
                            <th>{$row["capacidad"]}</th>
                            <th>{$row["disponibilidad"]}</th>
                            <th><input type=\"button\" id=\"cargar\" name=\"cargar\" value=\"editar\" onclick=\"cargar({$row["id"]})\"></th>   
                            <th><input type=\"button\" value=\"eliminar\" onclick=\"eliminar({$row["id"]})\"></th>   

                        </tr>";
    }

    $info .= "</table>";

    echo $info;
}

$conn->close();
?>

