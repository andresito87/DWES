<p>Fecha y hora del documento:
    <?php
    //Muestra la fecha de modificación del archivo en formato dd/mm/aaaa
    echo date("d/m/Y h:m", filemtime("footer.php"));
    ?>
</p>