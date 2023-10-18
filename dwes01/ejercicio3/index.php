<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respira - Formulario (Parte 1)</title>
</head>

<body>
    <div>
        <form action="form2.php" method="post">
            <label>Indica el código postal de la zona donde vives: <input name="codigo_postal" type="text"
                    value="" /></label>
    </div>
    <BR>
    <div>
        <label for="sexo">Selecciona tu sexo:</label>
        <select id="sexo" name="sexo">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
            <option value="O">Otro</option>
            <option value="N" default>Prefiero no decirlo</option>
        </select>
    </div>
    <BR>
    <div>
        <label for="curso">Curso:</label>
        <select id="curso" name="curso">
            <option value="1ESO">1º ESO</option>
            <option value="2ESO">2º ESO</option>
            <option value="3ESO">3º ESO</option>
        </select>
    </div>
    <BR>
    <div>
        Indica que rama de 4º de la ESO que te gustaría coger:<BR><BR>

        <input type="radio" name="rama" value="BCH"> Enseñanzas orientadas hacia Bachillerato.<BR>
        <input type="radio" name="rama" value="FP"> Enseñanzas orientadas hacia Formación Profesional.<BR>
    </div>
    <BR>
    <input type="submit" name="Siguiente" value="Siguiente"><BR><BR><BR>
</body>

</html>