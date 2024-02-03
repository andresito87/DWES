<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "

http://www.w3.org/TR/html4/loose.dtd">

<!-- Desarrollo Web en Entorno Servidor -->

<!-- Tema 2 : Características del Lenguaje PHP -->

<!-- Ejemplo: Mostrar fecha en varios idiomas -->

<html>

<head>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Fechas</title>

</head>

<body>

    <h1>Mostrar fecha en varios idiomas</h1>

    <?php
    include 'elegirIdioma.php';

    function prompt($mensajeElegirIdioma)
    {
        echo ("<script type='text/javascript'> var respuesta = prompt('" . $mensajeElegirIdioma . "'); </script>");

        echo "<script type='text/javascript'>
        var respuesta = prompt('" . $mensajeElegirIdioma . "');
        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'elegirIdioma.php', true);
        xhttp.setRequestHeader('Content-type', 'application/json');
        
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState === 4 && xhttp.status === 200) {
                console.log('Respuesta del servidor: ' + xhttp.responseText);
                // Puedes manejar la respuesta del servidor aquí
            }
        };
        
        var data = JSON.stringify({ respuesta: respuesta });
        xhttp.send(data);
    </script>";
    }


    $mensajeElegirIdioma = "Ingresa un idioma: espanol o ingles";
    prompt($mensajeElegirIdioma);

    $mensaje = calcularFechaEn();
    print $mensaje;


    ?>

</body>

</html>