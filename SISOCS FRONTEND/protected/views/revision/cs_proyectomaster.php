<?php

// idProyecto
// idPrograma
// codigo
// idUbicacion
// idRegion
// idDepto
// idTramo
// idRuta
// idTipoRed
// idProposito
// presupuesto
// especiplano
// presuprogra
// estudiofact
// estudioimpact
// licambi
// estuimpactierra
// planreasea
// plananual
// acuerdofinan
// otro
// fechacreacion
// estado
// idFuncionario
// fechaaprob
// idfuente
// codsefin
// notaprioridad
// constanciabanco
// fecharecibido
// clase
// entes
// idRol

?>
<?php if ($cs_proyecto->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $cs_proyecto->TableCaption() ?></h4> -->
<table id="tbl_cs_proyectomaster" class="table table-bordered table-striped ewViewTable">
	<tbody>
<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
		<tr id="r_idProyecto">
			<td><?php echo $cs_proyecto->idProyecto->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idProyecto->CellAttributes() ?>>
<span id="el_cs_proyecto_idProyecto">
<span<?php echo $cs_proyecto->idProyecto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProyecto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
		<tr id="r_idPrograma">
			<td><?php echo $cs_proyecto->idPrograma->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idPrograma->CellAttributes() ?>>
<span id="el_cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<?php echo $cs_proyecto->idPrograma->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
		<tr id="r_codigo">
			<td><?php echo $cs_proyecto->codigo->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->codigo->CellAttributes() ?>>
<span id="el_cs_proyecto_codigo">
<span<?php echo $cs_proyecto->codigo->ViewAttributes() ?>>
<?php echo $cs_proyecto->codigo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
		<tr id="r_idUbicacion">
			<td><?php echo $cs_proyecto->idUbicacion->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idUbicacion->CellAttributes() ?>>
<span id="el_cs_proyecto_idUbicacion">
<span<?php echo $cs_proyecto->idUbicacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idUbicacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
		<tr id="r_idRegion">
			<td><?php echo $cs_proyecto->idRegion->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idRegion->CellAttributes() ?>>
<span id="el_cs_proyecto_idRegion">
<span<?php echo $cs_proyecto->idRegion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRegion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
		<tr id="r_idDepto">
			<td><?php echo $cs_proyecto->idDepto->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idDepto->CellAttributes() ?>>
<span id="el_cs_proyecto_idDepto">
<span<?php echo $cs_proyecto->idDepto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idDepto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
		<tr id="r_idTramo">
			<td><?php echo $cs_proyecto->idTramo->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idTramo->CellAttributes() ?>>
<span id="el_cs_proyecto_idTramo">
<span<?php echo $cs_proyecto->idTramo->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTramo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
		<tr id="r_idRuta">
			<td><?php echo $cs_proyecto->idRuta->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idRuta->CellAttributes() ?>>
<span id="el_cs_proyecto_idRuta">
<span<?php echo $cs_proyecto->idRuta->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRuta->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
		<tr id="r_idTipoRed">
			<td><?php echo $cs_proyecto->idTipoRed->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idTipoRed->CellAttributes() ?>>
<span id="el_cs_proyecto_idTipoRed">
<span<?php echo $cs_proyecto->idTipoRed->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTipoRed->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
		<tr id="r_idProposito">
			<td><?php echo $cs_proyecto->idProposito->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idProposito->CellAttributes() ?>>
<span id="el_cs_proyecto_idProposito">
<span<?php echo $cs_proyecto->idProposito->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProposito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
		<tr id="r_presupuesto">
			<td><?php echo $cs_proyecto->presupuesto->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->presupuesto->CellAttributes() ?>>
<span id="el_cs_proyecto_presupuesto">
<span<?php echo $cs_proyecto->presupuesto->ViewAttributes() ?>>
<?php echo $cs_proyecto->presupuesto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
		<tr id="r_especiplano">
			<td><?php echo $cs_proyecto->especiplano->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->especiplano->CellAttributes() ?>>
<span id="el_cs_proyecto_especiplano">
<span<?php echo $cs_proyecto->especiplano->ViewAttributes() ?>>
<?php echo $cs_proyecto->especiplano->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
		<tr id="r_presuprogra">
			<td><?php echo $cs_proyecto->presuprogra->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->presuprogra->CellAttributes() ?>>
<span id="el_cs_proyecto_presuprogra">
<span<?php echo $cs_proyecto->presuprogra->ViewAttributes() ?>>
<?php echo $cs_proyecto->presuprogra->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
		<tr id="r_estudiofact">
			<td><?php echo $cs_proyecto->estudiofact->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->estudiofact->CellAttributes() ?>>
<span id="el_cs_proyecto_estudiofact">
<span<?php echo $cs_proyecto->estudiofact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudiofact->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
		<tr id="r_estudioimpact">
			<td><?php echo $cs_proyecto->estudioimpact->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->estudioimpact->CellAttributes() ?>>
<span id="el_cs_proyecto_estudioimpact">
<span<?php echo $cs_proyecto->estudioimpact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudioimpact->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
		<tr id="r_licambi">
			<td><?php echo $cs_proyecto->licambi->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->licambi->CellAttributes() ?>>
<span id="el_cs_proyecto_licambi">
<span<?php echo $cs_proyecto->licambi->ViewAttributes() ?>>
<?php echo $cs_proyecto->licambi->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
		<tr id="r_estuimpactierra">
			<td><?php echo $cs_proyecto->estuimpactierra->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->estuimpactierra->CellAttributes() ?>>
<span id="el_cs_proyecto_estuimpactierra">
<span<?php echo $cs_proyecto->estuimpactierra->ViewAttributes() ?>>
<?php echo $cs_proyecto->estuimpactierra->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
		<tr id="r_planreasea">
			<td><?php echo $cs_proyecto->planreasea->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->planreasea->CellAttributes() ?>>
<span id="el_cs_proyecto_planreasea">
<span<?php echo $cs_proyecto->planreasea->ViewAttributes() ?>>
<?php echo $cs_proyecto->planreasea->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
		<tr id="r_plananual">
			<td><?php echo $cs_proyecto->plananual->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->plananual->CellAttributes() ?>>
<span id="el_cs_proyecto_plananual">
<span<?php echo $cs_proyecto->plananual->ViewAttributes() ?>>
<?php echo $cs_proyecto->plananual->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
		<tr id="r_acuerdofinan">
			<td><?php echo $cs_proyecto->acuerdofinan->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->acuerdofinan->CellAttributes() ?>>
<span id="el_cs_proyecto_acuerdofinan">
<span<?php echo $cs_proyecto->acuerdofinan->ViewAttributes() ?>>
<?php echo $cs_proyecto->acuerdofinan->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->otro->Visible) { // otro ?>
		<tr id="r_otro">
			<td><?php echo $cs_proyecto->otro->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->otro->CellAttributes() ?>>
<span id="el_cs_proyecto_otro">
<span<?php echo $cs_proyecto->otro->ViewAttributes() ?>>
<?php echo $cs_proyecto->otro->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
		<tr id="r_fechacreacion">
			<td><?php echo $cs_proyecto->fechacreacion->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->fechacreacion->CellAttributes() ?>>
<span id="el_cs_proyecto_fechacreacion">
<span<?php echo $cs_proyecto->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechacreacion->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td><?php echo $cs_proyecto->estado->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->estado->CellAttributes() ?>>
<span id="el_cs_proyecto_estado">
<span<?php echo $cs_proyecto->estado->ViewAttributes() ?>>
<?php echo $cs_proyecto->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
		<tr id="r_idFuncionario">
			<td><?php echo $cs_proyecto->idFuncionario->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idFuncionario->CellAttributes() ?>>
<span id="el_cs_proyecto_idFuncionario">
<span<?php echo $cs_proyecto->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_proyecto->idFuncionario->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
		<tr id="r_fechaaprob">
			<td><?php echo $cs_proyecto->fechaaprob->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->fechaaprob->CellAttributes() ?>>
<span id="el_cs_proyecto_fechaaprob">
<span<?php echo $cs_proyecto->fechaaprob->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechaaprob->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
		<tr id="r_idfuente">
			<td><?php echo $cs_proyecto->idfuente->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idfuente->CellAttributes() ?>>
<span id="el_cs_proyecto_idfuente">
<span<?php echo $cs_proyecto->idfuente->ViewAttributes() ?>>
<?php echo $cs_proyecto->idfuente->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
		<tr id="r_codsefin">
			<td><?php echo $cs_proyecto->codsefin->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->codsefin->CellAttributes() ?>>
<span id="el_cs_proyecto_codsefin">
<span<?php echo $cs_proyecto->codsefin->ViewAttributes() ?>>
<?php echo $cs_proyecto->codsefin->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
		<tr id="r_notaprioridad">
			<td><?php echo $cs_proyecto->notaprioridad->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->notaprioridad->CellAttributes() ?>>
<span id="el_cs_proyecto_notaprioridad">
<span<?php echo $cs_proyecto->notaprioridad->ViewAttributes() ?>>
<?php echo $cs_proyecto->notaprioridad->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
		<tr id="r_constanciabanco">
			<td><?php echo $cs_proyecto->constanciabanco->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->constanciabanco->CellAttributes() ?>>
<span id="el_cs_proyecto_constanciabanco">
<span<?php echo $cs_proyecto->constanciabanco->ViewAttributes() ?>>
<?php echo $cs_proyecto->constanciabanco->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
		<tr id="r_fecharecibido">
			<td><?php echo $cs_proyecto->fecharecibido->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->fecharecibido->CellAttributes() ?>>
<span id="el_cs_proyecto_fecharecibido">
<span<?php echo $cs_proyecto->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_proyecto->fecharecibido->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->clase->Visible) { // clase ?>
		<tr id="r_clase">
			<td><?php echo $cs_proyecto->clase->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->clase->CellAttributes() ?>>
<span id="el_cs_proyecto_clase">
<span<?php echo $cs_proyecto->clase->ViewAttributes() ?>>
<?php echo $cs_proyecto->clase->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->entes->Visible) { // entes ?>
		<tr id="r_entes">
			<td><?php echo $cs_proyecto->entes->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->entes->CellAttributes() ?>>
<span id="el_cs_proyecto_entes">
<span<?php echo $cs_proyecto->entes->ViewAttributes() ?>>
<?php echo $cs_proyecto->entes->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
		<tr id="r_idRol">
			<td><?php echo $cs_proyecto->idRol->FldCaption() ?></td>
			<td<?php echo $cs_proyecto->idRol->CellAttributes() ?>>
<span id="el_cs_proyecto_idRol">
<span<?php echo $cs_proyecto->idRol->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRol->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
