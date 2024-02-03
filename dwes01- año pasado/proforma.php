<style>
table {font-family: helvetica; border-spacing:0px}
td, th {border:  1px solid;
      padding: 10px;
      min-width: 200px;
      background: white;
      box-sizing: border-box;
      text-align: left;
}

thead th {
  background: hsl(20, 50%, 70%);
}

tfoot {
  bottom: 0;
  z-index: 2;
}

tfoot td {
  background: hsl(20, 50%, 70%);
}

</style>
<H2>Cliente:<?=$pedido['cliente']?></H2>
<H2>Fecha de entrega:<?=$pedido['fecha_entrega']?></H2>
<table>
<thead>
  <tr>
    <th>Cod.</th>
    <th>Descripción<br></th>
    <th>Precio unidad<br></th>
    <th>Coste unidad</th>
    <th>Precio<br></th>
  </tr>
</thead>
<tbody>
<?php foreach($pedido['lineas'] as $linea): ?>
  <tr>
    <td><?=$linea['producto'] ?></td>
    <td><?=$linea['unidades'] ?></td>
    <td><?=$linea['coste_unidad'] ?></td>
    <td><?=$linea['descripcion'] ?></td>
    <td><?=$linea['coste_linea'] ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
<tfoot>
    <tr>
        <td colspan='4'>Total:</td>
        <td><?=$pedido['total'];?></td>
    </tr>   
    <tr>
        <td colspan='4'>Iva:</td>
        <td>21%</td>
    </tr>   
    <tr>
        <td colspan='4'>Total con IVA:</td>
        <td><?=$pedido['total']*1.21;?></td>
    </tr>   
</tfoot>
</table>
<A href="pedido.php">Generar un nuevo pedido</A>