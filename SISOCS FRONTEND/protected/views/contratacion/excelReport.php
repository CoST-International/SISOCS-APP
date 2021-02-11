<?php if ($model !== null):?>
<table border="1">
	<tr>
	
	</tr>SOPTRAVI, Sistema SISOCS	</tr>
 	<tr>Reporte de Contrataciones</tr>
	<tr>
		<th width="90px">
		      Codigo del Contratación		</th>
 		<th width="90px">
		      Contrato	</th>
 		<th width="80px">
		      Precio		</th>
 		<th >
		      Firma Contratada		</th>
 		<th width="80px">
		      Fecha Inicio		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->idContratacion; ?>
		</td>
       		<td>
			<?php echo $row->titulocontrato; ?>
		</td>
       		<td>
			<?php echo $row->precioLPS; ?>
		</td>
       		<td >
			<?php echo $row->documentocontra; ?>
		</td>
       		<td>
			<?php echo $row->fecha_creacion; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>