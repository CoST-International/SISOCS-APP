<?php

// idContratacion
// idAdjudicacion
// idEntidad
// idoferente
// precio
// precio2
// fechainicio
// fechafinal
// duracioncontrato
// documentocontra
// regante
// espeplanos
// estado
// otro
// ncontrato
// fecharecibido
// fechacreacion

?>
<?php if ($cs_contratacion->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $cs_contratacion->TableCaption() ?></h4> -->
<table id="tbl_cs_contratacionmaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
		<tr id="r_idContratacion">
			<td><?php echo $cs_contratacion->idContratacion->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->idContratacion->CellAttributes() ?>>
<span id="el_cs_contratacion_idContratacion">
<span<?php echo $cs_contratacion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idContratacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<tr id="r_idAdjudicacion">
			<td><?php echo $cs_contratacion->idAdjudicacion->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->idAdjudicacion->CellAttributes() ?>>
<span id="el_cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idAdjudicacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
		<tr id="r_idEntidad">
			<td><?php echo $cs_contratacion->idEntidad->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->idEntidad->CellAttributes() ?>>
<span id="el_cs_contratacion_idEntidad">
<span<?php echo $cs_contratacion->idEntidad->ViewAttributes() ?>>
<?php echo $cs_contratacion->idEntidad->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
		<tr id="r_idoferente">
			<td><?php echo $cs_contratacion->idoferente->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->idoferente->CellAttributes() ?>>
<span id="el_cs_contratacion_idoferente">
<span<?php echo $cs_contratacion->idoferente->ViewAttributes() ?>>
<?php echo $cs_contratacion->idoferente->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->precio->Visible) { // precio ?>
		<tr id="r_precio">
			<td><?php echo $cs_contratacion->precio->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->precio->CellAttributes() ?>>
<span id="el_cs_contratacion_precio">
<span<?php echo $cs_contratacion->precio->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
		<tr id="r_precio2">
			<td><?php echo $cs_contratacion->precio2->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->precio2->CellAttributes() ?>>
<span id="el_cs_contratacion_precio2">
<span<?php echo $cs_contratacion->precio2->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio2->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
		<tr id="r_fechainicio">
			<td><?php echo $cs_contratacion->fechainicio->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->fechainicio->CellAttributes() ?>>
<span id="el_cs_contratacion_fechainicio">
<span<?php echo $cs_contratacion->fechainicio->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechainicio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
		<tr id="r_fechafinal">
			<td><?php echo $cs_contratacion->fechafinal->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->fechafinal->CellAttributes() ?>>
<span id="el_cs_contratacion_fechafinal">
<span<?php echo $cs_contratacion->fechafinal->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechafinal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
		<tr id="r_duracioncontrato">
			<td><?php echo $cs_contratacion->duracioncontrato->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->duracioncontrato->CellAttributes() ?>>
<span id="el_cs_contratacion_duracioncontrato">
<span<?php echo $cs_contratacion->duracioncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->duracioncontrato->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
		<tr id="r_documentocontra">
			<td><?php echo $cs_contratacion->documentocontra->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->documentocontra->CellAttributes() ?>>
<span id="el_cs_contratacion_documentocontra">
<span<?php echo $cs_contratacion->documentocontra->ViewAttributes() ?>>
<?php echo $cs_contratacion->documentocontra->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->regante->Visible) { // regante ?>
		<tr id="r_regante">
			<td><?php echo $cs_contratacion->regante->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->regante->CellAttributes() ?>>
<span id="el_cs_contratacion_regante">
<span<?php echo $cs_contratacion->regante->ViewAttributes() ?>>
<?php echo $cs_contratacion->regante->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
		<tr id="r_espeplanos">
			<td><?php echo $cs_contratacion->espeplanos->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->espeplanos->CellAttributes() ?>>
<span id="el_cs_contratacion_espeplanos">
<span<?php echo $cs_contratacion->espeplanos->ViewAttributes() ?>>
<?php echo $cs_contratacion->espeplanos->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td><?php echo $cs_contratacion->estado->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->estado->CellAttributes() ?>>
<span id="el_cs_contratacion_estado">
<span<?php echo $cs_contratacion->estado->ViewAttributes() ?>>
<?php echo $cs_contratacion->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->otro->Visible) { // otro ?>
		<tr id="r_otro">
			<td><?php echo $cs_contratacion->otro->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->otro->CellAttributes() ?>>
<span id="el_cs_contratacion_otro">
<span<?php echo $cs_contratacion->otro->ViewAttributes() ?>>
<?php echo $cs_contratacion->otro->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
		<tr id="r_ncontrato">
			<td><?php echo $cs_contratacion->ncontrato->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->ncontrato->CellAttributes() ?>>
<span id="el_cs_contratacion_ncontrato">
<span<?php echo $cs_contratacion->ncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->ncontrato->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
		<tr id="r_fecharecibido">
			<td><?php echo $cs_contratacion->fecharecibido->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->fecharecibido->CellAttributes() ?>>
<span id="el_cs_contratacion_fecharecibido">
<span<?php echo $cs_contratacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_contratacion->fecharecibido->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
		<tr id="r_fechacreacion">
			<td><?php echo $cs_contratacion->fechacreacion->FldCaption() ?></td>
			<td<?php echo $cs_contratacion->fechacreacion->CellAttributes() ?>>
<span id="el_cs_contratacion_fechacreacion">
<span<?php echo $cs_contratacion->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechacreacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
