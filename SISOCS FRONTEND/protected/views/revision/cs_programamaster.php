<?php

// idPrograma
// programa
// BIP
// nombreprograma
// entes
// idFuncionario
// idRol
// idSector
// idSubSector
// costoesti
// fechaapro
// cartaconvenio
// otro1
// planope
// presupuesto
// perfildelprogra
// otro2
// fechacreacion
// estado
// idProposito
// fecharecibido
// moneda

?>
<?php if ($cs_programa->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $cs_programa->TableCaption() ?></h4> -->
<table id="tbl_cs_programamaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($cs_programa->idPrograma->Visible) { // idPrograma ?>
		<tr id="r_idPrograma">
			<td><?php echo $cs_programa->idPrograma->FldCaption() ?></td>
			<td<?php echo $cs_programa->idPrograma->CellAttributes() ?>>
<span id="el_cs_programa_idPrograma">
<span<?php echo $cs_programa->idPrograma->ViewAttributes() ?>>
<?php echo $cs_programa->idPrograma->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->programa->Visible) { // programa ?>
		<tr id="r_programa">
			<td><?php echo $cs_programa->programa->FldCaption() ?></td>
			<td<?php echo $cs_programa->programa->CellAttributes() ?>>
<span id="el_cs_programa_programa">
<span<?php echo $cs_programa->programa->ViewAttributes() ?>>
<?php echo $cs_programa->programa->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->BIP->Visible) { // BIP ?>
		<tr id="r_BIP">
			<td><?php echo $cs_programa->BIP->FldCaption() ?></td>
			<td<?php echo $cs_programa->BIP->CellAttributes() ?>>
<span id="el_cs_programa_BIP">
<span<?php echo $cs_programa->BIP->ViewAttributes() ?>>
<?php echo $cs_programa->BIP->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->nombreprograma->Visible) { // nombreprograma ?>
		<tr id="r_nombreprograma">
			<td><?php echo $cs_programa->nombreprograma->FldCaption() ?></td>
			<td<?php echo $cs_programa->nombreprograma->CellAttributes() ?>>
<span id="el_cs_programa_nombreprograma">
<span<?php echo $cs_programa->nombreprograma->ViewAttributes() ?>>
<?php echo $cs_programa->nombreprograma->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->entes->Visible) { // entes ?>
		<tr id="r_entes">
			<td><?php echo $cs_programa->entes->FldCaption() ?></td>
			<td<?php echo $cs_programa->entes->CellAttributes() ?>>
<span id="el_cs_programa_entes">
<span<?php echo $cs_programa->entes->ViewAttributes() ?>>
<?php echo $cs_programa->entes->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->idFuncionario->Visible) { // idFuncionario ?>
		<tr id="r_idFuncionario">
			<td><?php echo $cs_programa->idFuncionario->FldCaption() ?></td>
			<td<?php echo $cs_programa->idFuncionario->CellAttributes() ?>>
<span id="el_cs_programa_idFuncionario">
<span<?php echo $cs_programa->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_programa->idFuncionario->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->idRol->Visible) { // idRol ?>
		<tr id="r_idRol">
			<td><?php echo $cs_programa->idRol->FldCaption() ?></td>
			<td<?php echo $cs_programa->idRol->CellAttributes() ?>>
<span id="el_cs_programa_idRol">
<span<?php echo $cs_programa->idRol->ViewAttributes() ?>>
<?php echo $cs_programa->idRol->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->idSector->Visible) { // idSector ?>
		<tr id="r_idSector">
			<td><?php echo $cs_programa->idSector->FldCaption() ?></td>
			<td<?php echo $cs_programa->idSector->CellAttributes() ?>>
<span id="el_cs_programa_idSector">
<span<?php echo $cs_programa->idSector->ViewAttributes() ?>>
<?php echo $cs_programa->idSector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->idSubSector->Visible) { // idSubSector ?>
		<tr id="r_idSubSector">
			<td><?php echo $cs_programa->idSubSector->FldCaption() ?></td>
			<td<?php echo $cs_programa->idSubSector->CellAttributes() ?>>
<span id="el_cs_programa_idSubSector">
<span<?php echo $cs_programa->idSubSector->ViewAttributes() ?>>
<?php echo $cs_programa->idSubSector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->costoesti->Visible) { // costoesti ?>
		<tr id="r_costoesti">
			<td><?php echo $cs_programa->costoesti->FldCaption() ?></td>
			<td<?php echo $cs_programa->costoesti->CellAttributes() ?>>
<span id="el_cs_programa_costoesti">
<span<?php echo $cs_programa->costoesti->ViewAttributes() ?>>
<?php echo $cs_programa->costoesti->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->fechaapro->Visible) { // fechaapro ?>
		<tr id="r_fechaapro">
			<td><?php echo $cs_programa->fechaapro->FldCaption() ?></td>
			<td<?php echo $cs_programa->fechaapro->CellAttributes() ?>>
<span id="el_cs_programa_fechaapro">
<span<?php echo $cs_programa->fechaapro->ViewAttributes() ?>>
<?php echo $cs_programa->fechaapro->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->cartaconvenio->Visible) { // cartaconvenio ?>
		<tr id="r_cartaconvenio">
			<td><?php echo $cs_programa->cartaconvenio->FldCaption() ?></td>
			<td<?php echo $cs_programa->cartaconvenio->CellAttributes() ?>>
<span id="el_cs_programa_cartaconvenio">
<span<?php echo $cs_programa->cartaconvenio->ViewAttributes() ?>>
<?php echo $cs_programa->cartaconvenio->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->otro1->Visible) { // otro1 ?>
		<tr id="r_otro1">
			<td><?php echo $cs_programa->otro1->FldCaption() ?></td>
			<td<?php echo $cs_programa->otro1->CellAttributes() ?>>
<span id="el_cs_programa_otro1">
<span<?php echo $cs_programa->otro1->ViewAttributes() ?>>
<?php echo $cs_programa->otro1->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->planope->Visible) { // planope ?>
		<tr id="r_planope">
			<td><?php echo $cs_programa->planope->FldCaption() ?></td>
			<td<?php echo $cs_programa->planope->CellAttributes() ?>>
<span id="el_cs_programa_planope">
<span<?php echo $cs_programa->planope->ViewAttributes() ?>>
<?php echo $cs_programa->planope->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->presupuesto->Visible) { // presupuesto ?>
		<tr id="r_presupuesto">
			<td><?php echo $cs_programa->presupuesto->FldCaption() ?></td>
			<td<?php echo $cs_programa->presupuesto->CellAttributes() ?>>
<span id="el_cs_programa_presupuesto">
<span<?php echo $cs_programa->presupuesto->ViewAttributes() ?>>
<?php echo $cs_programa->presupuesto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->perfildelprogra->Visible) { // perfildelprogra ?>
		<tr id="r_perfildelprogra">
			<td><?php echo $cs_programa->perfildelprogra->FldCaption() ?></td>
			<td<?php echo $cs_programa->perfildelprogra->CellAttributes() ?>>
<span id="el_cs_programa_perfildelprogra">
<span<?php echo $cs_programa->perfildelprogra->ViewAttributes() ?>>
<?php echo $cs_programa->perfildelprogra->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->otro2->Visible) { // otro2 ?>
		<tr id="r_otro2">
			<td><?php echo $cs_programa->otro2->FldCaption() ?></td>
			<td<?php echo $cs_programa->otro2->CellAttributes() ?>>
<span id="el_cs_programa_otro2">
<span<?php echo $cs_programa->otro2->ViewAttributes() ?>>
<?php echo $cs_programa->otro2->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->fechacreacion->Visible) { // fechacreacion ?>
		<tr id="r_fechacreacion">
			<td><?php echo $cs_programa->fechacreacion->FldCaption() ?></td>
			<td<?php echo $cs_programa->fechacreacion->CellAttributes() ?>>
<span id="el_cs_programa_fechacreacion">
<span<?php echo $cs_programa->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_programa->fechacreacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td><?php echo $cs_programa->estado->FldCaption() ?></td>
			<td<?php echo $cs_programa->estado->CellAttributes() ?>>
<span id="el_cs_programa_estado">
<span<?php echo $cs_programa->estado->ViewAttributes() ?>>
<?php echo $cs_programa->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->idProposito->Visible) { // idProposito ?>
		<tr id="r_idProposito">
			<td><?php echo $cs_programa->idProposito->FldCaption() ?></td>
			<td<?php echo $cs_programa->idProposito->CellAttributes() ?>>
<span id="el_cs_programa_idProposito">
<span<?php echo $cs_programa->idProposito->ViewAttributes() ?>>
<?php echo $cs_programa->idProposito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->fecharecibido->Visible) { // fecharecibido ?>
		<tr id="r_fecharecibido">
			<td><?php echo $cs_programa->fecharecibido->FldCaption() ?></td>
			<td<?php echo $cs_programa->fecharecibido->CellAttributes() ?>>
<span id="el_cs_programa_fecharecibido">
<span<?php echo $cs_programa->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_programa->fecharecibido->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_programa->moneda->Visible) { // moneda ?>
		<tr id="r_moneda">
			<td><?php echo $cs_programa->moneda->FldCaption() ?></td>
			<td<?php echo $cs_programa->moneda->CellAttributes() ?>>
<span id="el_cs_programa_moneda">
<span<?php echo $cs_programa->moneda->ViewAttributes() ?>>
<?php echo $cs_programa->moneda->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
