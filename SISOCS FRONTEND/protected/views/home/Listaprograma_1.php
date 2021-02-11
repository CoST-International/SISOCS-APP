<?php if(!empty($Programas)){?>
	<table border="1">
		<tr>
		<th colspan="8">Lista de Programas</th>
		</tr>
		<tr>
		<th>Código del Programa</th>
		<th>Nombre del Programa</th>
		<th>Descripción</th>
		<th>Costo estimado Lps</th>
		<th>Fecha de aprobacion</th>
		</tr>

<?php foreach($Programas as $data){?>
	<tr>
		<td><?php echo CHtml::link(CHtml::encode($data->programa), array('viewprograma', 'id'=>$data->idPrograma)); ?></td>
		<td><?php echo $data->nombreprograma;?></td>
		<td><?php echo $data->descripcion;?></td>
		<td><?php echo number_format($data->costoesti,2,'.',',');?></td>
		<td><?php echo $data->fechaapro;?></td>	
	</tr>
<?php }?>
	</table>
	<?php }else{ }?>