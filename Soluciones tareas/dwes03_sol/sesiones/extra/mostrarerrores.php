    <?php if(isset($errores) && is_array($errores) && $errores): ?>
    <H3>Errores de la última operación:</H3>    
    <UL>
    <?php array_walk($errores, function ($e){echo '<LI>'.$e.'</LI>'; }); ?>
    </UL>
    <?php endif; ?>