<?php if ($model !== null):?>
<table border="1">
	<tr>
	
	</tr>SOPTRAVI, Sistema SISOCS	</tr>
 	<tr>Reporte de Planificación de Proyectos</tr>  
	<tr>
		<th width="90px">
		      Codigo del Proyecto		</th>
 		<th width="90px">
		      Nombre Proyecyo		</th>  
 		<th width="80px">
		      Descripción		</th>
 		<th >
		      Presupuesto	</th>
 		<th width="80px">
		      Fecha Creación		</th>     
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->codigo; ?>
		</td>
       		<td>  
			<?php echo $row->nombre_proyecto; ?>
		</td>
       		<td>
			<?php echo $row->descrip; ?>
		</td>
       		<td >
			<?php echo $row->presupuesto; ?>
		</td>
       		<td>
			<?php echo $row->fecha_creacion; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>