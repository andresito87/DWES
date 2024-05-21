<?php

// Manejo de archivos, apertura, lectura y escritura
function fileGetContents(string $filename) : string|false
{
    $buffer = '';
    $fp = fopen($filename, 'r');

    try {
        while (! feof($fp)) {
            $buffer .= fread($fp, 4096) . '<BR>';
        }
    } catch (Exception $e) {
        $buffer = false;
    } finally {
        fclose($fp);
    }

    return $buffer;
}

$listado = fileGetContents('listado.txt');

echo "Mostrando el contenido de un archivo con una funcion: " . $listado;

class MultiFile
{
    private array $handles = [];

    public function open(
        string $filename,
        string $mode = 'w',
        bool $use_include_path = false,
        $context = null
    ) : mixed {
        $fp = fopen($filename, $mode, $use_include_path, $context);

        if ($fp !== false) {
            $this->handles[] = $fp;
        }

        return $fp;
    }

    public function write(string $data, ?int $length = null) : int|false
    {
        $success = true;
        $bytes = 0;

        foreach ($this->handles as $fp) {
            $out = fwrite($fp, $data, $length);
            if ($out === false) {
                $success = false;
            } else {
                $bytes = $out;
            }
        }

        return $success ? $bytes : false;
    }

    public function close() : bool
    {
        $return = true;

        foreach ($this->handles as $fp) {
            $return = $return && fclose($fp);
        }

        return $return;
    }
}

$writer = new MultiFile();
// modo añadir texto
$writer->open('listado.txt', 'a');
// modo escribir de nuevo
//$writer->open('listado.txt', 'w');

$writer->write("Añadiendo al archivo\nUn saludo.\n");

$writer->close();