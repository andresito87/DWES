<H1>Listado de impresoras</H1>
<table>
<tr>
<th>ID</th>
<th>Marca</th>
<th>Modelo</th>
<th>Tipo</th>
</tr>
{foreach $impresoras as $impresora}
    <tr>
        <td>{$impresora->id}</td>
        <td>{$impresora->marca}</td>
        <td>{$impresora->modelo}</td>
        <td>{$impresora->tipo}</td>
    </tr>
{/foreach}
</table>
<a href="index.php?accion=form_crear_impresora">Crear Impresora</A>