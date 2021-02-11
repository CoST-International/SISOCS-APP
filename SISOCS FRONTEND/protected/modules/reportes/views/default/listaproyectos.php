<?php if($Factura2!==null){?>
	<table border="1">
		<tr>
		<th colspan="4">Detalle de Facturas</th>
		</tr>
		<tr>
		<th>N factura</th>
		<th>Orden</th>
		<th>Fecha</th>
		<th>Hora</th>
		<th>Impuesto</th>
		<th>Total</th>
		</tr>

<?php foreach($Factura2 as $data){?>
	<tr>
		<td><?php echo $data->id;?></td>
		<td><?php echo $data->idorden;?></td>
		<td><?php echo $data->fecha;?></td>
		<td><?php echo $data->hora;?></td>
		<td><?php echo $data->impuesto;?></td>
		<td><?php echo $data->total;?></td>


	</tr>
<?php }?>
	<tr>

	</table>
	<?php }else{ echo "El registro no se encuentra";}?>
