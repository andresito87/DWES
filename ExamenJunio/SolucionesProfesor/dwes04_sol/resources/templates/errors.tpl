{if isset($errores) && count($errores)>0}
    <H2>{$contexto|default:""|escape}</H2>
    <ul class='errores'>
        {foreach $errores as $error}
            <li>{$error|escape}</li>
        {/foreach}
    </ul>
{/if}