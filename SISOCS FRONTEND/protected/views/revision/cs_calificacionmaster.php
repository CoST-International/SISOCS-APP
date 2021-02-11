<?php

// idCalificacion
// idProyecto
// numproceso
// fechactualizacion
// idFuncionario
// estatusproceso
// proceseval
// invitainter
// basespreca
// resolucion
// nombreante
// convocainvi
// tdr
// aclaraciones
// actarecpcion
// fechaingreso
// tipocontrato
// estado
// otro1
// otro2
// identidadadquisicion
// idmetodo
// fecharecibido

?>
<?php if ($cs_calificacion->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $cs_calificacion->TableCaption() ?></h4> -->
<table id="tbl_cs_calificacionmaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
		<tr id="r_idCalificacion">
			<td><?php echo $cs_calificacion->idCalificacion->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->idCalificacion->CellAttributes() ?>>
<span id="el_cs_calificacion_idCalificacion">
<span<?php echo $cs_calificacion->idCalificacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->idCalificacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
		<tr id="r_idProyecto">
			<td><?php echo $cs_calificacion->idProyecto->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->idProyecto->CellAttributes() ?>>
<span id="el_cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<?php echo $cs_calificacion->idProyecto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
		<tr id="r_numproceso">
			<td><?php echo $cs_calificacion->numproceso->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->numproceso->CellAttributes() ?>>
<span id="el_cs_calificacion_numproceso">
<span<?php echo $cs_calificacion->numproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->numproceso->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
		<tr id="r_fechactualizacion">
			<td><?php echo $cs_calificacion->fechactualizacion->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->fechactualizacion->CellAttributes() ?>>
<span id="el_cs_calificacion_fechactualizacion">
<span<?php echo $cs_calificacion->fechactualizacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechactualizacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
		<tr id="r_idFuncionario">
			<td><?php echo $cs_calificacion->idFuncionario->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->idFuncionario->CellAttributes() ?>>
<span id="el_cs_calificacion_idFuncionario">
<span<?php echo $cs_calificacion->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_calificacion->idFuncionario->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
		<tr id="r_estatusproceso">
			<td><?php echo $cs_calificacion->estatusproceso->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->estatusproceso->CellAttributes() ?>>
<span id="el_cs_calificacion_estatusproceso">
<span<?php echo $cs_calificacion->estatusproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->estatusproceso->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
		<tr id="r_proceseval">
			<td><?php echo $cs_calificacion->proceseval->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->proceseval->CellAttributes() ?>>
<span id="el_cs_calificacion_proceseval">
<span<?php echo $cs_calificacion->proceseval->ViewAttributes() ?>>
<?php echo $cs_calificacion->proceseval->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
		<tr id="r_invitainter">
			<td><?php echo $cs_calificacion->invitainter->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->invitainter->CellAttributes() ?>>
<span id="el_cs_calificacion_invitainter">
<span<?php echo $cs_calificacion->invitainter->ViewAttributes() ?>>
<?php echo $cs_calificacion->invitainter->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
		<tr id="r_basespreca">
			<td><?php echo $cs_calificacion->basespreca->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->basespreca->CellAttributes() ?>>
<span id="el_cs_calificacion_basespreca">
<span<?php echo $cs_calificacion->basespreca->ViewAttributes() ?>>
<?php echo $cs_calificacion->basespreca->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
		<tr id="r_resolucion">
			<td><?php echo $cs_calificacion->resolucion->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->resolucion->CellAttributes() ?>>
<span id="el_cs_calificacion_resolucion">
<span<?php echo $cs_calificacion->resolucion->ViewAttributes() ?>>
<?php echo $cs_calificacion->resolucion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
		<tr id="r_nombreante">
			<td><?php echo $cs_calificacion->nombreante->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->nombreante->CellAttributes() ?>>
<span id="el_cs_calificacion_nombreante">
<span<?php echo $cs_calificacion->nombreante->ViewAttributes() ?>>
<?php echo $cs_calificacion->nombreante->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
		<tr id="r_convocainvi">
			<td><?php echo $cs_calificacion->convocainvi->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->convocainvi->CellAttributes() ?>>
<span id="el_cs_calificacion_convocainvi">
<span<?php echo $cs_calificacion->convocainvi->ViewAttributes() ?>>
<?php echo $cs_calificacion->convocainvi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
		<tr id="r_tdr">
			<td><?php echo $cs_calificacion->tdr->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->tdr->CellAttributes() ?>>
<span id="el_cs_calificacion_tdr">
<span<?php echo $cs_calificacion->tdr->ViewAttributes() ?>>
<?php echo $cs_calificacion->tdr->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
		<tr id="r_aclaraciones">
			<td><?php echo $cs_calificacion->aclaraciones->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->aclaraciones->CellAttributes() ?>>
<span id="el_cs_calificacion_aclaraciones">
<span<?php echo $cs_calificacion->aclaraciones->ViewAttributes() ?>>
<?php echo $cs_calificacion->aclaraciones->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
		<tr id="r_actarecpcion">
			<td><?php echo $cs_calificacion->actarecpcion->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->actarecpcion->CellAttributes() ?>>
<span id="el_cs_calificacion_actarecpcion">
<span<?php echo $cs_calificacion->actarecpcion->ViewAttributes() ?>>
<?php echo $cs_calificacion->actarecpcion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
		<tr id="r_fechaingreso">
			<td><?php echo $cs_calificacion->fechaingreso->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->fechaingreso->CellAttributes() ?>>
<span id="el_cs_calificacion_fechaingreso">
<span<?php echo $cs_calificacion->fechaingreso->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechaingreso->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
		<tr id="r_tipocontrato">
			<td><?php echo $cs_calificacion->tipocontrato->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->tipocontrato->CellAttributes() ?>>
<span id="el_cs_calificacion_tipocontrato">
<span<?php echo $cs_calificacion->tipocontrato->ViewAttributes() ?>>
<?php echo $cs_calificacion->tipocontrato->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td><?php echo $cs_calificacion->estado->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->estado->CellAttributes() ?>>
<span id="el_cs_calificacion_estado">
<span<?php echo $cs_calificacion->estado->ViewAttributes() ?>>
<?php echo $cs_calificacion->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
		<tr id="r_otro1">
			<td><?php echo $cs_calificacion->otro1->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->otro1->CellAttributes() ?>>
<span id="el_cs_calificacion_otro1">
<span<?php echo $cs_calificacion->otro1->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro1->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
		<tr id="r_otro2">
			<td><?php echo $cs_calificacion->otro2->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->otro2->CellAttributes() ?>>
<span id="el_cs_calificacion_otro2">
<span<?php echo $cs_calificacion->otro2->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro2->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
		<tr id="r_identidadadquisicion">
			<td><?php echo $cs_calificacion->identidadadquisicion->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->identidadadquisicion->CellAttributes() ?>>
<span id="el_cs_calificacion_identidadadquisicion">
<span<?php echo $cs_calificacion->identidadadquisicion->ViewAttributes() ?>>
<?php echo $cs_calificacion->identidadadquisicion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
		<tr id="r_idmetodo">
			<td><?php echo $cs_calificacion->idmetodo->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->idmetodo->CellAttributes() ?>>
<span id="el_cs_calificacion_idmetodo">
<span<?php echo $cs_calificacion->idmetodo->ViewAttributes() ?>>
<?php echo $cs_calificacion->idmetodo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
		<tr id="r_fecharecibido">
			<td><?php echo $cs_calificacion->fecharecibido->FldCaption() ?></td>
			<td<?php echo $cs_calificacion->fecharecibido->CellAttributes() ?>>
<span id="el_cs_calificacion_fecharecibido">
<span<?php echo $cs_calificacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_calificacion->fecharecibido->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
