<?php if(!empty($Proyectos)){?>
	<table border="1">
		<tr>
		<th colspan="5">Lista de Proyectos</th>
		</tr>
		<tr>
		<th>Código del Proyecto</th>
		<th>Nombre del Proyecto</th>
		<th>Presupuesto</th>
		<th>Fecha de Creación</th>
		</tr>

<?php foreach($Proyectos as $data){?>
	<tr>
		<td><?php echo CHtml::link(CHtml::encode($data->idProyecto), array('viewproyecto', 'id'=>$data->idProyecto)); ?></td>
		<td><?php echo $data->nombre_proyecto;?></td>
		<td><?php echo number_format($data->presupuesto,2,'.',',');?></td>	
		<td><?php echo $data->fechacreacion;?></td>	
	</tr>
<?php }?>
	</table>
	<?php }else{ }?>