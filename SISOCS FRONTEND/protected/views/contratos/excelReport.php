<?php if ($model !== null):?>
<table border="1">
	<tr>
	
	</tr>SOPTRAVI, Sistema SISOCS	</tr>
 	<tr>Reporte de Gestión de contratos</tr>
	<tr>
		<th width="90px">
		      Codigo de Contrato		</th>
 		<th width="90px">
		      Alcance Contrato		</th>
 		<th width="80px">
		      Justificación Modificación		</th>
 		<th >
		      Tipo Modificación		</th>
 		<th width="80px">
		      Fecha Modificación		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->idContratos; ?>
		</td>
       		<td>
			<?php echo $row->alcanceactucontrato; ?>
		</td>
       		<td>
			<?php echo $row->justimodcontrato; ?>
		</td>
       		<td >
			<?php echo $row->tipomodifica; ?>
		</td>
       		<td>
			<?php echo $row->fecha; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>