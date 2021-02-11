 <?php if ($model !== null):?>
<table border="1"> 

	<tr>SOPTRAVI, Sistema SISOCS</tr>
 	<tr>Reporte de Gestión de Ofertas y Adjudicación</tr>
	<tr>
		<th width="90px">
		      Codigo de Calificación</th>
 		<th width="90px">
		      Número de Proceso		</th>
 		<th width="80px">
		      Nombre de Proceso</th>
 		<th >
		      Costo Estimado		</th>
 		<th width="80px">
		      Fecha Aprobación		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->idCalificacion; ?>
		</td>
       		<td>
			<?php echo $row->numproceso; ?>
		</td>
       		<td>
			<?php //echo $row->nomprocesoproyecto; ?>
		</td>
       		<td >
			<?php echo $row->costoesti; ?>
		</td>
       		<td>
			<?php echo $row->fecha_creacion; ?>
		</td>
       	</tr>   
     <?php endforeach; ?>
</table>             
<?php endif; ?>         