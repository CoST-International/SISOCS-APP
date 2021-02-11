<?php if ($model !== null):?>
<table border="1">
	<tr>
	
	</tr>SOPTRAVI, Sistema SISOCS	</tr>
 	<tr>Reporte de Gestión de Invitaciones y Calificaciones</tr>
	<tr>
		<th width="90px">
		      Codigo de calificación		</th>
 		<th width="90px">
		      Nombre	Proyecto	</th>
 		<th width="80px">
		      Numero de proceso		</th>
 		<th >
		      Proceso Evaluación		</th>
 		<th width="80px">
		      Fecha Actualización		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->idCalificacion; ?>
		</td>
       		<td>
			<?php echo $row->nomprocesoproyecto; ?>
		</td>
       		<td>
			<?php echo $row->numproceso; ?>
		</td>
       		<td >
			<?php echo $row->proceseval; ?>
		</td>
       		<td>
			<?php echo $row->fechactualizacion; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>