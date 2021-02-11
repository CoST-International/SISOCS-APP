<?php

// idAdjudicacion
// idCalificacion
// numproceso
// nconsulnac
// nconsulinter
// costoesti
// estadoproceso
// actaaper
// informeacta
// resoladju
// estado
// otro
// numfirmasnac
// numfimasinter
// numconsulcorta
// fecharecibido
// fechacreacion

?>
<?php if ($cs_adjudicacion->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $cs_adjudicacion->TableCaption() ?></h4> -->
<table id="tbl_cs_adjudicacionmaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($cs_adjudicacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<tr id="r_idAdjudicacion">
			<td><?php echo $cs_adjudicacion->idAdjudicacion->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->idAdjudicacion->CellAttributes() ?>>
<span id="el_cs_adjudicacion_idAdjudicacion">
<span<?php echo $cs_adjudicacion->idAdjudicacion->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->idAdjudicacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->idCalificacion->Visible) { // idCalificacion ?>
		<tr id="r_idCalificacion">
			<td><?php echo $cs_adjudicacion->idCalificacion->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->idCalificacion->CellAttributes() ?>>
<span id="el_cs_adjudicacion_idCalificacion">
<span<?php echo $cs_adjudicacion->idCalificacion->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->idCalificacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->numproceso->Visible) { // numproceso ?>
		<tr id="r_numproceso">
			<td><?php echo $cs_adjudicacion->numproceso->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->numproceso->CellAttributes() ?>>
<span id="el_cs_adjudicacion_numproceso">
<span<?php echo $cs_adjudicacion->numproceso->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numproceso->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->nconsulnac->Visible) { // nconsulnac ?>
		<tr id="r_nconsulnac">
			<td><?php echo $cs_adjudicacion->nconsulnac->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->nconsulnac->CellAttributes() ?>>
<span id="el_cs_adjudicacion_nconsulnac">
<span<?php echo $cs_adjudicacion->nconsulnac->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->nconsulnac->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->nconsulinter->Visible) { // nconsulinter ?>
		<tr id="r_nconsulinter">
			<td><?php echo $cs_adjudicacion->nconsulinter->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->nconsulinter->CellAttributes() ?>>
<span id="el_cs_adjudicacion_nconsulinter">
<span<?php echo $cs_adjudicacion->nconsulinter->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->nconsulinter->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->costoesti->Visible) { // costoesti ?>
		<tr id="r_costoesti">
			<td><?php echo $cs_adjudicacion->costoesti->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->costoesti->CellAttributes() ?>>
<span id="el_cs_adjudicacion_costoesti">
<span<?php echo $cs_adjudicacion->costoesti->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->costoesti->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->estadoproceso->Visible) { // estadoproceso ?>
		<tr id="r_estadoproceso">
			<td><?php echo $cs_adjudicacion->estadoproceso->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->estadoproceso->CellAttributes() ?>>
<span id="el_cs_adjudicacion_estadoproceso">
<span<?php echo $cs_adjudicacion->estadoproceso->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->estadoproceso->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->actaaper->Visible) { // actaaper ?>
		<tr id="r_actaaper">
			<td><?php echo $cs_adjudicacion->actaaper->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->actaaper->CellAttributes() ?>>
<span id="el_cs_adjudicacion_actaaper">
<span<?php echo $cs_adjudicacion->actaaper->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->actaaper->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->informeacta->Visible) { // informeacta ?>
		<tr id="r_informeacta">
			<td><?php echo $cs_adjudicacion->informeacta->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->informeacta->CellAttributes() ?>>
<span id="el_cs_adjudicacion_informeacta">
<span<?php echo $cs_adjudicacion->informeacta->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->informeacta->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->resoladju->Visible) { // resoladju ?>
		<tr id="r_resoladju">
			<td><?php echo $cs_adjudicacion->resoladju->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->resoladju->CellAttributes() ?>>
<span id="el_cs_adjudicacion_resoladju">
<span<?php echo $cs_adjudicacion->resoladju->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->resoladju->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td><?php echo $cs_adjudicacion->estado->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->estado->CellAttributes() ?>>
<span id="el_cs_adjudicacion_estado">
<span<?php echo $cs_adjudicacion->estado->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->otro->Visible) { // otro ?>
		<tr id="r_otro">
			<td><?php echo $cs_adjudicacion->otro->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->otro->CellAttributes() ?>>
<span id="el_cs_adjudicacion_otro">
<span<?php echo $cs_adjudicacion->otro->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->otro->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->numfirmasnac->Visible) { // numfirmasnac ?>
		<tr id="r_numfirmasnac">
			<td><?php echo $cs_adjudicacion->numfirmasnac->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->numfirmasnac->CellAttributes() ?>>
<span id="el_cs_adjudicacion_numfirmasnac">
<span<?php echo $cs_adjudicacion->numfirmasnac->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numfirmasnac->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->numfimasinter->Visible) { // numfimasinter ?>
		<tr id="r_numfimasinter">
			<td><?php echo $cs_adjudicacion->numfimasinter->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->numfimasinter->CellAttributes() ?>>
<span id="el_cs_adjudicacion_numfimasinter">
<span<?php echo $cs_adjudicacion->numfimasinter->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numfimasinter->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->numconsulcorta->Visible) { // numconsulcorta ?>
		<tr id="r_numconsulcorta">
			<td><?php echo $cs_adjudicacion->numconsulcorta->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->numconsulcorta->CellAttributes() ?>>
<span id="el_cs_adjudicacion_numconsulcorta">
<span<?php echo $cs_adjudicacion->numconsulcorta->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numconsulcorta->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->fecharecibido->Visible) { // fecharecibido ?>
		<tr id="r_fecharecibido">
			<td><?php echo $cs_adjudicacion->fecharecibido->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->fecharecibido->CellAttributes() ?>>
<span id="el_cs_adjudicacion_fecharecibido">
<span<?php echo $cs_adjudicacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->fecharecibido->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_adjudicacion->fechacreacion->Visible) { // fechacreacion ?>
		<tr id="r_fechacreacion">
			<td><?php echo $cs_adjudicacion->fechacreacion->FldCaption() ?></td>
			<td<?php echo $cs_adjudicacion->fechacreacion->CellAttributes() ?>>
<span id="el_cs_adjudicacion_fechacreacion">
<span<?php echo $cs_adjudicacion->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->fechacreacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
