<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>RESULTADOS</h1>
<?php
    include "mdl_cliente.php";
    $cli = new Cliente();
    $oculto=$_REQUEST['oculto'];
    switch ($oculto) {
        case 'iniciar':
            $email = $_REQUEST['mail'];
            $contraseña = $_REQUEST['contraseña'];
            $cli->inicializarSesion($email,$contraseña);
            $cli->validarIngreso();
            break;
        case 'registrar':
            $nombre = $_REQUEST['nombre'];
            $email = $_REQUEST['email'];
            $contraseña = $_REQUEST['contraseña'];
            $tipo = $_REQUEST['tipo'];
            $cli->inicializarCliente($nombre,$contraseña,$email,$tipo);
            $cli->registrarCliente();
            break;
    }
?>
</body>
</html>
