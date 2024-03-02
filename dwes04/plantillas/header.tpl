<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title}</title>
    <style>
        h1 {
            text-align: center;
        }

        form.nuevoTaller {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: large;
            font-weight: bold;
        }

        form {
            font-size: large;
            font-weight: bold;
        }

        input,
        select {
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            text-align: center;
            padding: 4px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ffc5c5;
        }

        label {
            font-weight: 800;
        }

        form input[type="submit"] {
            background-color: #08fb2c;
            color: black;
            padding: 6px 10px;
            text-align: center;
            font-weight: 800;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: black solid 1px;
        }

        form button[type="submit"] {
            background-color: #ff0e0e;
            color: black;
            font-weight: 800;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: black solid 1px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        form input.eliminar {
            background-color: #ff0e0e;
            color: black;
            font-weight: 800;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: black solid 1px;
        }

        form input.eliminar:hover,
        button.eliminar:hover {
            background-color: #7d0101;
            color: white;
        }

        form button#editar {
            background-color: #f0f00f;
            color: black;
            font-weight: 800;
            padding: 6px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            border: black solid 1px;
        }

        form button#editar:hover {
            background-color: #7d7d01;
            color: white;
        }

        a {
            color: #041681;
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>