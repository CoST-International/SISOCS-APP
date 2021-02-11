<?php if(!empty($Contratos)){?>
	<table border="1">
		<tr>
		<th colspan="8">Lista de Contrataciones</th>
		</tr>
		<tr>
		<th>Código de Contratación</th>
		<th>Número del contrato</th>
		<th>Título del contrato</th>
		<th>Precio del contrato Lps</th>
		<th>Fecha de inicio</th>
		<th>Fecha de finalización</th>
		<th>Duración del contrato</th>
		</tr>

<?php foreach($Contratos as $data){?>
	<tr>
		<td><?php echo CHtml::link(CHtml::encode($data->idContratacion), array('viewcontrato', 'id'=>$data->idContratacion)); ?></td>
		<td><?php echo $data->ncontrato;?></td>
		<td><?php echo $data->titulocontrato;?></td>
		<td><?php echo $data->precio;?></td>
		<td><?php echo $data->fechainicio;?></td>
		<td><?php echo $data->fechafinal;?></td>
		<td><?php echo $data->duracioncontrato;?></td>		
	</tr>
<?php }?>
	</table>
	<?php }else{ }?>