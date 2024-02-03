<?php
include_once('lib/fpedidos.php');
include_once('etc/conf.php');
$pedido=[];
$pedido[]=['producto'=>'A01','unidades'=>2];
$pedido[]=['producto'=>'A02','unidades'=>4];
$pedido[]=['producto'=>'B02','unidades'=>2];
$pedido[]=['producto'=>'B12','unidades'=>2];
$pedido[]=['producto'=>'C01','unidades'=>6];
$pedido[]=['producto'=>'A06','unidades'=>0];

$total=costePedido($pedido,$productos);
?>
<H1>Datos del pedido</H1>
<pre>
<code>
$pedido[]=['producto'=>'A01','unidades'=>2];
$pedido[]=['producto'=>'A02','unidades'=>4];
$pedido[]=['producto'=>'B02','unidades'=>2];
$pedido[]=['producto'=>'B12','unidades'=>2];
$pedido[]=['producto'=>'C01','unidades'=>6];
$pedido[]=['producto'=>'A06','unidades'=>0];
</code>
</pre>
<H1>Coste del pedido: <?=$total?>

<ul>
<?php foreach ($pedido as $linea): ?>
    <li> Código: <?=$linea['producto']?>
        <ul>
            <li><?=$linea['descripcion']?></li>
            <li>Unidades: <?=$linea['unidades']?></li>
            <li>Coste línea pedido: <?=$linea['unidades']?>*<?=$linea['coste_unidad']?>€=<?=$linea['coste_linea']?>€</li>
        </ul>
    </li>

<?php endforeach; ?>
</ul>