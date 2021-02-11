<?php include_once "cruge_userinfo.php" ?>
<?php

// Create page object
if (!isset($cs_calificacion_grid)) $cs_calificacion_grid = new ccs_calificacion_grid();

// Page init
$cs_calificacion_grid->Page_Init();

// Page main
$cs_calificacion_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_calificacion_grid->Page_Render();
?>
<?php if ($cs_calificacion->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcs_calificaciongrid = new ew_Form("fcs_calificaciongrid", "grid");
fcs_calificaciongrid.FormKeyCountName = '<?php echo $cs_calificacion_grid->FormKeyCountName ?>';

// Validate form
fcs_calificaciongrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_idProyecto");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_calificacion->idProyecto->FldCaption(), $cs_calificacion->idProyecto->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idProyecto");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_calificacion->idProyecto->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idFuncionario");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_calificacion->idFuncionario->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_identidadadquisicion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_calificacion->identidadadquisicion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idmetodo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_calificacion->idmetodo->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcs_calificaciongrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "idProyecto", false)) return false;
	if (ew_ValueChanged(fobj, infix, "numproceso", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechactualizacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idFuncionario", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estatusproceso", false)) return false;
	if (ew_ValueChanged(fobj, infix, "proceseval", false)) return false;
	if (ew_ValueChanged(fobj, infix, "invitainter", false)) return false;
	if (ew_ValueChanged(fobj, infix, "basespreca", false)) return false;
	if (ew_ValueChanged(fobj, infix, "resolucion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nombreante", false)) return false;
	if (ew_ValueChanged(fobj, infix, "convocainvi", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tdr", false)) return false;
	if (ew_ValueChanged(fobj, infix, "aclaraciones", false)) return false;
	if (ew_ValueChanged(fobj, infix, "actarecpcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechaingreso", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tipocontrato", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "otro1", false)) return false;
	if (ew_ValueChanged(fobj, infix, "otro2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "identidadadquisicion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idmetodo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecharecibido", false)) return false;
	return true;
}

// Form_CustomValidate event
fcs_calificaciongrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_calificaciongrid.ValidateRequired = true;
<?php } else { ?>
fcs_calificaciongrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($cs_calificacion->CurrentAction == "gridadd") {
	if ($cs_calificacion->CurrentMode == "copy") {
		$bSelectLimit = $cs_calificacion_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cs_calificacion_grid->TotalRecs = $cs_calificacion->SelectRecordCount();
			$cs_calificacion_grid->Recordset = $cs_calificacion_grid->LoadRecordset($cs_calificacion_grid->StartRec-1, $cs_calificacion_grid->DisplayRecs);
		} else {
			if ($cs_calificacion_grid->Recordset = $cs_calificacion_grid->LoadRecordset())
				$cs_calificacion_grid->TotalRecs = $cs_calificacion_grid->Recordset->RecordCount();
		}
		$cs_calificacion_grid->StartRec = 1;
		$cs_calificacion_grid->DisplayRecs = $cs_calificacion_grid->TotalRecs;
	} else {
		$cs_calificacion->CurrentFilter = "0=1";
		$cs_calificacion_grid->StartRec = 1;
		$cs_calificacion_grid->DisplayRecs = $cs_calificacion->GridAddRowCount;
	}
	$cs_calificacion_grid->TotalRecs = $cs_calificacion_grid->DisplayRecs;
	$cs_calificacion_grid->StopRec = $cs_calificacion_grid->DisplayRecs;
} else {
	$bSelectLimit = $cs_calificacion_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_calificacion_grid->TotalRecs <= 0)
			$cs_calificacion_grid->TotalRecs = $cs_calificacion->SelectRecordCount();
	} else {
		if (!$cs_calificacion_grid->Recordset && ($cs_calificacion_grid->Recordset = $cs_calificacion_grid->LoadRecordset()))
			$cs_calificacion_grid->TotalRecs = $cs_calificacion_grid->Recordset->RecordCount();
	}
	$cs_calificacion_grid->StartRec = 1;
	$cs_calificacion_grid->DisplayRecs = $cs_calificacion_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cs_calificacion_grid->Recordset = $cs_calificacion_grid->LoadRecordset($cs_calificacion_grid->StartRec-1, $cs_calificacion_grid->DisplayRecs);

	// Set no record found message
	if ($cs_calificacion->CurrentAction == "" && $cs_calificacion_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_calificacion_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_calificacion_grid->SearchWhere == "0=101")
			$cs_calificacion_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_calificacion_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cs_calificacion_grid->RenderOtherOptions();
?>
<?php $cs_calificacion_grid->ShowPageHeader(); ?>
<?php
$cs_calificacion_grid->ShowMessage();
?>
<?php if ($cs_calificacion_grid->TotalRecs > 0 || $cs_calificacion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<div id="fcs_calificaciongrid" class="ewForm form-inline">
<div id="gmp_cs_calificacion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_cs_calificaciongrid" class="table ewTable">
<?php echo $cs_calificacion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_calificacion_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_calificacion_grid->RenderListOptions();

// Render list options (header, left)
$cs_calificacion_grid->ListOptions->Render("header", "left");
?>
<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idCalificacion) == "") { ?>
		<th data-name="idCalificacion"><div id="elh_cs_calificacion_idCalificacion" class="cs_calificacion_idCalificacion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idCalificacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idCalificacion"><div><div id="elh_cs_calificacion_idCalificacion" class="cs_calificacion_idCalificacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idCalificacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idCalificacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idCalificacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idProyecto) == "") { ?>
		<th data-name="idProyecto"><div id="elh_cs_calificacion_idProyecto" class="cs_calificacion_idProyecto"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idProyecto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProyecto"><div><div id="elh_cs_calificacion_idProyecto" class="cs_calificacion_idProyecto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idProyecto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idProyecto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idProyecto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->numproceso) == "") { ?>
		<th data-name="numproceso"><div id="elh_cs_calificacion_numproceso" class="cs_calificacion_numproceso"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->numproceso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numproceso"><div><div id="elh_cs_calificacion_numproceso" class="cs_calificacion_numproceso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->numproceso->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->numproceso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->numproceso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->fechactualizacion) == "") { ?>
		<th data-name="fechactualizacion"><div id="elh_cs_calificacion_fechactualizacion" class="cs_calificacion_fechactualizacion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechactualizacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechactualizacion"><div><div id="elh_cs_calificacion_fechactualizacion" class="cs_calificacion_fechactualizacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechactualizacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->fechactualizacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->fechactualizacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idFuncionario) == "") { ?>
		<th data-name="idFuncionario"><div id="elh_cs_calificacion_idFuncionario" class="cs_calificacion_idFuncionario"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idFuncionario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idFuncionario"><div><div id="elh_cs_calificacion_idFuncionario" class="cs_calificacion_idFuncionario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idFuncionario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idFuncionario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idFuncionario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->estatusproceso) == "") { ?>
		<th data-name="estatusproceso"><div id="elh_cs_calificacion_estatusproceso" class="cs_calificacion_estatusproceso"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->estatusproceso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estatusproceso"><div><div id="elh_cs_calificacion_estatusproceso" class="cs_calificacion_estatusproceso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->estatusproceso->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->estatusproceso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->estatusproceso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->proceseval) == "") { ?>
		<th data-name="proceseval"><div id="elh_cs_calificacion_proceseval" class="cs_calificacion_proceseval"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->proceseval->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="proceseval"><div><div id="elh_cs_calificacion_proceseval" class="cs_calificacion_proceseval">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->proceseval->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->proceseval->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->proceseval->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->invitainter) == "") { ?>
		<th data-name="invitainter"><div id="elh_cs_calificacion_invitainter" class="cs_calificacion_invitainter"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->invitainter->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invitainter"><div><div id="elh_cs_calificacion_invitainter" class="cs_calificacion_invitainter">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->invitainter->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->invitainter->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->invitainter->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->basespreca) == "") { ?>
		<th data-name="basespreca"><div id="elh_cs_calificacion_basespreca" class="cs_calificacion_basespreca"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->basespreca->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="basespreca"><div><div id="elh_cs_calificacion_basespreca" class="cs_calificacion_basespreca">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->basespreca->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->basespreca->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->basespreca->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->resolucion) == "") { ?>
		<th data-name="resolucion"><div id="elh_cs_calificacion_resolucion" class="cs_calificacion_resolucion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->resolucion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="resolucion"><div><div id="elh_cs_calificacion_resolucion" class="cs_calificacion_resolucion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->resolucion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->resolucion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->resolucion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->nombreante) == "") { ?>
		<th data-name="nombreante"><div id="elh_cs_calificacion_nombreante" class="cs_calificacion_nombreante"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->nombreante->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombreante"><div><div id="elh_cs_calificacion_nombreante" class="cs_calificacion_nombreante">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->nombreante->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->nombreante->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->nombreante->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->convocainvi) == "") { ?>
		<th data-name="convocainvi"><div id="elh_cs_calificacion_convocainvi" class="cs_calificacion_convocainvi"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->convocainvi->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="convocainvi"><div><div id="elh_cs_calificacion_convocainvi" class="cs_calificacion_convocainvi">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->convocainvi->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->convocainvi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->convocainvi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->tdr) == "") { ?>
		<th data-name="tdr"><div id="elh_cs_calificacion_tdr" class="cs_calificacion_tdr"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->tdr->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tdr"><div><div id="elh_cs_calificacion_tdr" class="cs_calificacion_tdr">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->tdr->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->tdr->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->tdr->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->aclaraciones) == "") { ?>
		<th data-name="aclaraciones"><div id="elh_cs_calificacion_aclaraciones" class="cs_calificacion_aclaraciones"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->aclaraciones->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aclaraciones"><div><div id="elh_cs_calificacion_aclaraciones" class="cs_calificacion_aclaraciones">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->aclaraciones->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->aclaraciones->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->aclaraciones->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->actarecpcion) == "") { ?>
		<th data-name="actarecpcion"><div id="elh_cs_calificacion_actarecpcion" class="cs_calificacion_actarecpcion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->actarecpcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="actarecpcion"><div><div id="elh_cs_calificacion_actarecpcion" class="cs_calificacion_actarecpcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->actarecpcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->actarecpcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->actarecpcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->fechaingreso) == "") { ?>
		<th data-name="fechaingreso"><div id="elh_cs_calificacion_fechaingreso" class="cs_calificacion_fechaingreso"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechaingreso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaingreso"><div><div id="elh_cs_calificacion_fechaingreso" class="cs_calificacion_fechaingreso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechaingreso->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->fechaingreso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->fechaingreso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->tipocontrato) == "") { ?>
		<th data-name="tipocontrato"><div id="elh_cs_calificacion_tipocontrato" class="cs_calificacion_tipocontrato"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->tipocontrato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipocontrato"><div><div id="elh_cs_calificacion_tipocontrato" class="cs_calificacion_tipocontrato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->tipocontrato->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->tipocontrato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->tipocontrato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->estado->Visible) { // estado ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_calificacion_estado" class="cs_calificacion_estado"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div><div id="elh_cs_calificacion_estado" class="cs_calificacion_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->otro1) == "") { ?>
		<th data-name="otro1"><div id="elh_cs_calificacion_otro1" class="cs_calificacion_otro1"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro1"><div><div id="elh_cs_calificacion_otro1" class="cs_calificacion_otro1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->otro1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->otro1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->otro2) == "") { ?>
		<th data-name="otro2"><div id="elh_cs_calificacion_otro2" class="cs_calificacion_otro2"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro2"><div><div id="elh_cs_calificacion_otro2" class="cs_calificacion_otro2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->otro2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->otro2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->identidadadquisicion) == "") { ?>
		<th data-name="identidadadquisicion"><div id="elh_cs_calificacion_identidadadquisicion" class="cs_calificacion_identidadadquisicion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->identidadadquisicion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="identidadadquisicion"><div><div id="elh_cs_calificacion_identidadadquisicion" class="cs_calificacion_identidadadquisicion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->identidadadquisicion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->identidadadquisicion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->identidadadquisicion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idmetodo) == "") { ?>
		<th data-name="idmetodo"><div id="elh_cs_calificacion_idmetodo" class="cs_calificacion_idmetodo"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idmetodo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idmetodo"><div><div id="elh_cs_calificacion_idmetodo" class="cs_calificacion_idmetodo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idmetodo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idmetodo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idmetodo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_calificacion_fecharecibido" class="cs_calificacion_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div><div id="elh_cs_calificacion_fecharecibido" class="cs_calificacion_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->fecharecibido->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_calificacion_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cs_calificacion_grid->StartRec = 1;
$cs_calificacion_grid->StopRec = $cs_calificacion_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cs_calificacion_grid->FormKeyCountName) && ($cs_calificacion->CurrentAction == "gridadd" || $cs_calificacion->CurrentAction == "gridedit" || $cs_calificacion->CurrentAction == "F")) {
		$cs_calificacion_grid->KeyCount = $objForm->GetValue($cs_calificacion_grid->FormKeyCountName);
		$cs_calificacion_grid->StopRec = $cs_calificacion_grid->StartRec + $cs_calificacion_grid->KeyCount - 1;
	}
}
$cs_calificacion_grid->RecCnt = $cs_calificacion_grid->StartRec - 1;
if ($cs_calificacion_grid->Recordset && !$cs_calificacion_grid->Recordset->EOF) {
	$cs_calificacion_grid->Recordset->MoveFirst();
	$bSelectLimit = $cs_calificacion_grid->UseSelectLimit;
	if (!$bSelectLimit && $cs_calificacion_grid->StartRec > 1)
		$cs_calificacion_grid->Recordset->Move($cs_calificacion_grid->StartRec - 1);
} elseif (!$cs_calificacion->AllowAddDeleteRow && $cs_calificacion_grid->StopRec == 0) {
	$cs_calificacion_grid->StopRec = $cs_calificacion->GridAddRowCount;
}

// Initialize aggregate
$cs_calificacion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_calificacion->ResetAttrs();
$cs_calificacion_grid->RenderRow();
if ($cs_calificacion->CurrentAction == "gridadd")
	$cs_calificacion_grid->RowIndex = 0;
if ($cs_calificacion->CurrentAction == "gridedit")
	$cs_calificacion_grid->RowIndex = 0;
while ($cs_calificacion_grid->RecCnt < $cs_calificacion_grid->StopRec) {
	$cs_calificacion_grid->RecCnt++;
	if (intval($cs_calificacion_grid->RecCnt) >= intval($cs_calificacion_grid->StartRec)) {
		$cs_calificacion_grid->RowCnt++;
		if ($cs_calificacion->CurrentAction == "gridadd" || $cs_calificacion->CurrentAction == "gridedit" || $cs_calificacion->CurrentAction == "F") {
			$cs_calificacion_grid->RowIndex++;
			$objForm->Index = $cs_calificacion_grid->RowIndex;
			if ($objForm->HasValue($cs_calificacion_grid->FormActionName))
				$cs_calificacion_grid->RowAction = strval($objForm->GetValue($cs_calificacion_grid->FormActionName));
			elseif ($cs_calificacion->CurrentAction == "gridadd")
				$cs_calificacion_grid->RowAction = "insert";
			else
				$cs_calificacion_grid->RowAction = "";
		}

		// Set up key count
		$cs_calificacion_grid->KeyCount = $cs_calificacion_grid->RowIndex;

		// Init row class and style
		$cs_calificacion->ResetAttrs();
		$cs_calificacion->CssClass = "";
		if ($cs_calificacion->CurrentAction == "gridadd") {
			if ($cs_calificacion->CurrentMode == "copy") {
				$cs_calificacion_grid->LoadRowValues($cs_calificacion_grid->Recordset); // Load row values
				$cs_calificacion_grid->SetRecordKey($cs_calificacion_grid->RowOldKey, $cs_calificacion_grid->Recordset); // Set old record key
			} else {
				$cs_calificacion_grid->LoadDefaultValues(); // Load default values
				$cs_calificacion_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cs_calificacion_grid->LoadRowValues($cs_calificacion_grid->Recordset); // Load row values
		}
		$cs_calificacion->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cs_calificacion->CurrentAction == "gridadd") // Grid add
			$cs_calificacion->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cs_calificacion->CurrentAction == "gridadd" && $cs_calificacion->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cs_calificacion_grid->RestoreCurrentRowFormValues($cs_calificacion_grid->RowIndex); // Restore form values
		if ($cs_calificacion->CurrentAction == "gridedit") { // Grid edit
			if ($cs_calificacion->EventCancelled) {
				$cs_calificacion_grid->RestoreCurrentRowFormValues($cs_calificacion_grid->RowIndex); // Restore form values
			}
			if ($cs_calificacion_grid->RowAction == "insert")
				$cs_calificacion->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cs_calificacion->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cs_calificacion->CurrentAction == "gridedit" && ($cs_calificacion->RowType == EW_ROWTYPE_EDIT || $cs_calificacion->RowType == EW_ROWTYPE_ADD) && $cs_calificacion->EventCancelled) // Update failed
			$cs_calificacion_grid->RestoreCurrentRowFormValues($cs_calificacion_grid->RowIndex); // Restore form values
		if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cs_calificacion_grid->EditRowCnt++;
		if ($cs_calificacion->CurrentAction == "F") // Confirm row
			$cs_calificacion_grid->RestoreCurrentRowFormValues($cs_calificacion_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cs_calificacion->RowAttrs = array_merge($cs_calificacion->RowAttrs, array('data-rowindex'=>$cs_calificacion_grid->RowCnt, 'id'=>'r' . $cs_calificacion_grid->RowCnt . '_cs_calificacion', 'data-rowtype'=>$cs_calificacion->RowType));

		// Render row
		$cs_calificacion_grid->RenderRow();

		// Render list options
		$cs_calificacion_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cs_calificacion_grid->RowAction <> "delete" && $cs_calificacion_grid->RowAction <> "insertdelete" && !($cs_calificacion_grid->RowAction == "insert" && $cs_calificacion->CurrentAction == "F" && $cs_calificacion_grid->EmptyRow())) {
?>
	<tr<?php echo $cs_calificacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_calificacion_grid->ListOptions->Render("body", "left", $cs_calificacion_grid->RowCnt);
?>
	<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
		<td data-name="idCalificacion"<?php echo $cs_calificacion->idCalificacion->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_idCalificacion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_calificacion->idCalificacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idCalificacion" class="form-group cs_calificacion_idCalificacion">
<span<?php echo $cs_calificacion->idCalificacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idCalificacion->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idCalificacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_calificacion->idCalificacion->CurrentValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idCalificacion" class="cs_calificacion_idCalificacion">
<span<?php echo $cs_calificacion->idCalificacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->idCalificacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idCalificacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_calificacion->idCalificacion->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_idCalificacion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_calificacion->idCalificacion->OldValue) ?>">
<?php } ?>
<a id="<?php echo $cs_calificacion_grid->PageObjName . "_row_" . $cs_calificacion_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
		<td data-name="idProyecto"<?php echo $cs_calificacion->idProyecto->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cs_calificacion->idProyecto->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idProyecto->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<input type="text" data-table="cs_calificacion" data-field="x_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idProyecto->EditValue ?>"<?php echo $cs_calificacion->idProyecto->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_idProyecto" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cs_calificacion->idProyecto->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idProyecto->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<input type="text" data-table="cs_calificacion" data-field="x_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idProyecto->EditValue ?>"<?php echo $cs_calificacion->idProyecto->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idProyecto" class="cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<?php echo $cs_calificacion->idProyecto->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_idProyecto" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
		<td data-name="numproceso"<?php echo $cs_calificacion->numproceso->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_numproceso" class="form-group cs_calificacion_numproceso">
<input type="text" data-table="cs_calificacion" data-field="x_numproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->numproceso->EditValue ?>"<?php echo $cs_calificacion->numproceso->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_numproceso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_numproceso" class="form-group cs_calificacion_numproceso">
<input type="text" data-table="cs_calificacion" data-field="x_numproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->numproceso->EditValue ?>"<?php echo $cs_calificacion->numproceso->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_numproceso" class="cs_calificacion_numproceso">
<span<?php echo $cs_calificacion->numproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->numproceso->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_numproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_numproceso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
		<td data-name="fechactualizacion"<?php echo $cs_calificacion->fechactualizacion->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fechactualizacion" class="form-group cs_calificacion_fechactualizacion">
<input type="text" data-table="cs_calificacion" data-field="x_fechactualizacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fechactualizacion->EditValue ?>"<?php echo $cs_calificacion->fechactualizacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechactualizacion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" value="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fechactualizacion" class="form-group cs_calificacion_fechactualizacion">
<input type="text" data-table="cs_calificacion" data-field="x_fechactualizacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fechactualizacion->EditValue ?>"<?php echo $cs_calificacion->fechactualizacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fechactualizacion" class="cs_calificacion_fechactualizacion">
<span<?php echo $cs_calificacion->fechactualizacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechactualizacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechactualizacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" value="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_fechactualizacion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" value="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario"<?php echo $cs_calificacion->idFuncionario->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idFuncionario" class="form-group cs_calificacion_idFuncionario">
<input type="text" data-table="cs_calificacion" data-field="x_idFuncionario" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idFuncionario->EditValue ?>"<?php echo $cs_calificacion->idFuncionario->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idFuncionario" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idFuncionario" class="form-group cs_calificacion_idFuncionario">
<input type="text" data-table="cs_calificacion" data-field="x_idFuncionario" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idFuncionario->EditValue ?>"<?php echo $cs_calificacion->idFuncionario->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idFuncionario" class="cs_calificacion_idFuncionario">
<span<?php echo $cs_calificacion->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_calificacion->idFuncionario->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idFuncionario" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_idFuncionario" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
		<td data-name="estatusproceso"<?php echo $cs_calificacion->estatusproceso->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_estatusproceso" class="form-group cs_calificacion_estatusproceso">
<input type="text" data-table="cs_calificacion" data-field="x_estatusproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->estatusproceso->EditValue ?>"<?php echo $cs_calificacion->estatusproceso->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_estatusproceso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_estatusproceso" class="form-group cs_calificacion_estatusproceso">
<input type="text" data-table="cs_calificacion" data-field="x_estatusproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->estatusproceso->EditValue ?>"<?php echo $cs_calificacion->estatusproceso->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_estatusproceso" class="cs_calificacion_estatusproceso">
<span<?php echo $cs_calificacion->estatusproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->estatusproceso->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_estatusproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_estatusproceso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
		<td data-name="proceseval"<?php echo $cs_calificacion->proceseval->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_proceseval" class="form-group cs_calificacion_proceseval">
<input type="text" data-table="cs_calificacion" data-field="x_proceseval" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->proceseval->EditValue ?>"<?php echo $cs_calificacion->proceseval->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_proceseval" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" value="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_proceseval" class="form-group cs_calificacion_proceseval">
<input type="text" data-table="cs_calificacion" data-field="x_proceseval" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->proceseval->EditValue ?>"<?php echo $cs_calificacion->proceseval->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_proceseval" class="cs_calificacion_proceseval">
<span<?php echo $cs_calificacion->proceseval->ViewAttributes() ?>>
<?php echo $cs_calificacion->proceseval->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_proceseval" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" value="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_proceseval" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" value="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
		<td data-name="invitainter"<?php echo $cs_calificacion->invitainter->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_invitainter" class="form-group cs_calificacion_invitainter">
<input type="text" data-table="cs_calificacion" data-field="x_invitainter" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->invitainter->EditValue ?>"<?php echo $cs_calificacion->invitainter->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_invitainter" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" value="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_invitainter" class="form-group cs_calificacion_invitainter">
<input type="text" data-table="cs_calificacion" data-field="x_invitainter" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->invitainter->EditValue ?>"<?php echo $cs_calificacion->invitainter->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_invitainter" class="cs_calificacion_invitainter">
<span<?php echo $cs_calificacion->invitainter->ViewAttributes() ?>>
<?php echo $cs_calificacion->invitainter->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_invitainter" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" value="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_invitainter" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" value="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
		<td data-name="basespreca"<?php echo $cs_calificacion->basespreca->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_basespreca" class="form-group cs_calificacion_basespreca">
<input type="text" data-table="cs_calificacion" data-field="x_basespreca" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->basespreca->EditValue ?>"<?php echo $cs_calificacion->basespreca->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_basespreca" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" value="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_basespreca" class="form-group cs_calificacion_basespreca">
<input type="text" data-table="cs_calificacion" data-field="x_basespreca" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->basespreca->EditValue ?>"<?php echo $cs_calificacion->basespreca->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_basespreca" class="cs_calificacion_basespreca">
<span<?php echo $cs_calificacion->basespreca->ViewAttributes() ?>>
<?php echo $cs_calificacion->basespreca->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_basespreca" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" value="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_basespreca" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" value="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
		<td data-name="resolucion"<?php echo $cs_calificacion->resolucion->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_resolucion" class="form-group cs_calificacion_resolucion">
<input type="text" data-table="cs_calificacion" data-field="x_resolucion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->resolucion->EditValue ?>"<?php echo $cs_calificacion->resolucion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_resolucion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" value="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_resolucion" class="form-group cs_calificacion_resolucion">
<input type="text" data-table="cs_calificacion" data-field="x_resolucion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->resolucion->EditValue ?>"<?php echo $cs_calificacion->resolucion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_resolucion" class="cs_calificacion_resolucion">
<span<?php echo $cs_calificacion->resolucion->ViewAttributes() ?>>
<?php echo $cs_calificacion->resolucion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_resolucion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" value="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_resolucion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" value="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
		<td data-name="nombreante"<?php echo $cs_calificacion->nombreante->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_nombreante" class="form-group cs_calificacion_nombreante">
<input type="text" data-table="cs_calificacion" data-field="x_nombreante" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->nombreante->EditValue ?>"<?php echo $cs_calificacion->nombreante->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_nombreante" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" value="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_nombreante" class="form-group cs_calificacion_nombreante">
<input type="text" data-table="cs_calificacion" data-field="x_nombreante" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->nombreante->EditValue ?>"<?php echo $cs_calificacion->nombreante->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_nombreante" class="cs_calificacion_nombreante">
<span<?php echo $cs_calificacion->nombreante->ViewAttributes() ?>>
<?php echo $cs_calificacion->nombreante->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_nombreante" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" value="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_nombreante" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" value="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
		<td data-name="convocainvi"<?php echo $cs_calificacion->convocainvi->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_convocainvi" class="form-group cs_calificacion_convocainvi">
<input type="text" data-table="cs_calificacion" data-field="x_convocainvi" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->convocainvi->EditValue ?>"<?php echo $cs_calificacion->convocainvi->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_convocainvi" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" value="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_convocainvi" class="form-group cs_calificacion_convocainvi">
<input type="text" data-table="cs_calificacion" data-field="x_convocainvi" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->convocainvi->EditValue ?>"<?php echo $cs_calificacion->convocainvi->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_convocainvi" class="cs_calificacion_convocainvi">
<span<?php echo $cs_calificacion->convocainvi->ViewAttributes() ?>>
<?php echo $cs_calificacion->convocainvi->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_convocainvi" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" value="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_convocainvi" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" value="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
		<td data-name="tdr"<?php echo $cs_calificacion->tdr->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_tdr" class="form-group cs_calificacion_tdr">
<input type="text" data-table="cs_calificacion" data-field="x_tdr" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->tdr->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->tdr->EditValue ?>"<?php echo $cs_calificacion->tdr->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_tdr" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" value="<?php echo ew_HtmlEncode($cs_calificacion->tdr->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_tdr" class="form-group cs_calificacion_tdr">
<input type="text" data-table="cs_calificacion" data-field="x_tdr" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->tdr->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->tdr->EditValue ?>"<?php echo $cs_calificacion->tdr->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_tdr" class="cs_calificacion_tdr">
<span<?php echo $cs_calificacion->tdr->ViewAttributes() ?>>
<?php echo $cs_calificacion->tdr->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_tdr" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" value="<?php echo ew_HtmlEncode($cs_calificacion->tdr->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_tdr" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" value="<?php echo ew_HtmlEncode($cs_calificacion->tdr->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
		<td data-name="aclaraciones"<?php echo $cs_calificacion->aclaraciones->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_aclaraciones" class="form-group cs_calificacion_aclaraciones">
<input type="text" data-table="cs_calificacion" data-field="x_aclaraciones" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->aclaraciones->EditValue ?>"<?php echo $cs_calificacion->aclaraciones->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_aclaraciones" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" value="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_aclaraciones" class="form-group cs_calificacion_aclaraciones">
<input type="text" data-table="cs_calificacion" data-field="x_aclaraciones" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->aclaraciones->EditValue ?>"<?php echo $cs_calificacion->aclaraciones->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_aclaraciones" class="cs_calificacion_aclaraciones">
<span<?php echo $cs_calificacion->aclaraciones->ViewAttributes() ?>>
<?php echo $cs_calificacion->aclaraciones->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_aclaraciones" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" value="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_aclaraciones" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" value="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
		<td data-name="actarecpcion"<?php echo $cs_calificacion->actarecpcion->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_actarecpcion" class="form-group cs_calificacion_actarecpcion">
<input type="text" data-table="cs_calificacion" data-field="x_actarecpcion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->actarecpcion->EditValue ?>"<?php echo $cs_calificacion->actarecpcion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_actarecpcion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" value="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_actarecpcion" class="form-group cs_calificacion_actarecpcion">
<input type="text" data-table="cs_calificacion" data-field="x_actarecpcion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->actarecpcion->EditValue ?>"<?php echo $cs_calificacion->actarecpcion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_actarecpcion" class="cs_calificacion_actarecpcion">
<span<?php echo $cs_calificacion->actarecpcion->ViewAttributes() ?>>
<?php echo $cs_calificacion->actarecpcion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_actarecpcion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" value="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_actarecpcion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" value="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
		<td data-name="fechaingreso"<?php echo $cs_calificacion->fechaingreso->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fechaingreso" class="form-group cs_calificacion_fechaingreso">
<input type="text" data-table="cs_calificacion" data-field="x_fechaingreso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fechaingreso->EditValue ?>"<?php echo $cs_calificacion->fechaingreso->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechaingreso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" value="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fechaingreso" class="form-group cs_calificacion_fechaingreso">
<input type="text" data-table="cs_calificacion" data-field="x_fechaingreso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fechaingreso->EditValue ?>"<?php echo $cs_calificacion->fechaingreso->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fechaingreso" class="cs_calificacion_fechaingreso">
<span<?php echo $cs_calificacion->fechaingreso->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechaingreso->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechaingreso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" value="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_fechaingreso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" value="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
		<td data-name="tipocontrato"<?php echo $cs_calificacion->tipocontrato->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_tipocontrato" class="form-group cs_calificacion_tipocontrato">
<input type="text" data-table="cs_calificacion" data-field="x_tipocontrato" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->tipocontrato->EditValue ?>"<?php echo $cs_calificacion->tipocontrato->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_tipocontrato" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" value="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_tipocontrato" class="form-group cs_calificacion_tipocontrato">
<input type="text" data-table="cs_calificacion" data-field="x_tipocontrato" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->tipocontrato->EditValue ?>"<?php echo $cs_calificacion->tipocontrato->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_tipocontrato" class="cs_calificacion_tipocontrato">
<span<?php echo $cs_calificacion->tipocontrato->ViewAttributes() ?>>
<?php echo $cs_calificacion->tipocontrato->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_tipocontrato" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" value="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_tipocontrato" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" value="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_calificacion->estado->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_estado" class="form-group cs_calificacion_estado">
<input type="text" data-table="cs_calificacion" data-field="x_estado" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->estado->EditValue ?>"<?php echo $cs_calificacion->estado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_estado" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_calificacion->estado->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_estado" class="form-group cs_calificacion_estado">
<input type="text" data-table="cs_calificacion" data-field="x_estado" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->estado->EditValue ?>"<?php echo $cs_calificacion->estado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_estado" class="cs_calificacion_estado">
<span<?php echo $cs_calificacion->estado->ViewAttributes() ?>>
<?php echo $cs_calificacion->estado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_estado" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_calificacion->estado->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_estado" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_calificacion->estado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
		<td data-name="otro1"<?php echo $cs_calificacion->otro1->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_otro1" class="form-group cs_calificacion_otro1">
<input type="text" data-table="cs_calificacion" data-field="x_otro1" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->otro1->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->otro1->EditValue ?>"<?php echo $cs_calificacion->otro1->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro1" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" value="<?php echo ew_HtmlEncode($cs_calificacion->otro1->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_otro1" class="form-group cs_calificacion_otro1">
<input type="text" data-table="cs_calificacion" data-field="x_otro1" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->otro1->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->otro1->EditValue ?>"<?php echo $cs_calificacion->otro1->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_otro1" class="cs_calificacion_otro1">
<span<?php echo $cs_calificacion->otro1->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro1->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro1" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" value="<?php echo ew_HtmlEncode($cs_calificacion->otro1->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_otro1" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" value="<?php echo ew_HtmlEncode($cs_calificacion->otro1->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
		<td data-name="otro2"<?php echo $cs_calificacion->otro2->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_otro2" class="form-group cs_calificacion_otro2">
<input type="text" data-table="cs_calificacion" data-field="x_otro2" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->otro2->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->otro2->EditValue ?>"<?php echo $cs_calificacion->otro2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro2" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" value="<?php echo ew_HtmlEncode($cs_calificacion->otro2->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_otro2" class="form-group cs_calificacion_otro2">
<input type="text" data-table="cs_calificacion" data-field="x_otro2" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->otro2->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->otro2->EditValue ?>"<?php echo $cs_calificacion->otro2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_otro2" class="cs_calificacion_otro2">
<span<?php echo $cs_calificacion->otro2->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro2->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro2" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" value="<?php echo ew_HtmlEncode($cs_calificacion->otro2->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_otro2" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" value="<?php echo ew_HtmlEncode($cs_calificacion->otro2->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
		<td data-name="identidadadquisicion"<?php echo $cs_calificacion->identidadadquisicion->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_identidadadquisicion" class="form-group cs_calificacion_identidadadquisicion">
<input type="text" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->identidadadquisicion->EditValue ?>"<?php echo $cs_calificacion->identidadadquisicion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" value="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_identidadadquisicion" class="form-group cs_calificacion_identidadadquisicion">
<input type="text" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->identidadadquisicion->EditValue ?>"<?php echo $cs_calificacion->identidadadquisicion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_identidadadquisicion" class="cs_calificacion_identidadadquisicion">
<span<?php echo $cs_calificacion->identidadadquisicion->ViewAttributes() ?>>
<?php echo $cs_calificacion->identidadadquisicion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" value="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" value="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
		<td data-name="idmetodo"<?php echo $cs_calificacion->idmetodo->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idmetodo" class="form-group cs_calificacion_idmetodo">
<input type="text" data-table="cs_calificacion" data-field="x_idmetodo" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idmetodo->EditValue ?>"<?php echo $cs_calificacion->idmetodo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idmetodo" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" value="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idmetodo" class="form-group cs_calificacion_idmetodo">
<input type="text" data-table="cs_calificacion" data-field="x_idmetodo" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idmetodo->EditValue ?>"<?php echo $cs_calificacion->idmetodo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_idmetodo" class="cs_calificacion_idmetodo">
<span<?php echo $cs_calificacion->idmetodo->ViewAttributes() ?>>
<?php echo $cs_calificacion->idmetodo->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idmetodo" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" value="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_idmetodo" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" value="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_calificacion->fecharecibido->CellAttributes() ?>>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fecharecibido" class="form-group cs_calificacion_fecharecibido">
<input type="text" data-table="cs_calificacion" data-field="x_fecharecibido" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fecharecibido->EditValue ?>"<?php echo $cs_calificacion->fecharecibido->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fecharecibido" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->OldValue) ?>">
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fecharecibido" class="form-group cs_calificacion_fecharecibido">
<input type="text" data-table="cs_calificacion" data-field="x_fecharecibido" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fecharecibido->EditValue ?>"<?php echo $cs_calificacion->fecharecibido->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_calificacion_grid->RowCnt ?>_cs_calificacion_fecharecibido" class="cs_calificacion_fecharecibido">
<span<?php echo $cs_calificacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_calificacion->fecharecibido->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fecharecibido" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->FormValue) ?>">
<input type="hidden" data-table="cs_calificacion" data-field="x_fecharecibido" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_calificacion_grid->ListOptions->Render("body", "right", $cs_calificacion_grid->RowCnt);
?>
	</tr>
<?php if ($cs_calificacion->RowType == EW_ROWTYPE_ADD || $cs_calificacion->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcs_calificaciongrid.UpdateOpts(<?php echo $cs_calificacion_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cs_calificacion->CurrentAction <> "gridadd" || $cs_calificacion->CurrentMode == "copy")
		if (!$cs_calificacion_grid->Recordset->EOF) $cs_calificacion_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cs_calificacion->CurrentMode == "add" || $cs_calificacion->CurrentMode == "copy" || $cs_calificacion->CurrentMode == "edit") {
		$cs_calificacion_grid->RowIndex = '$rowindex$';
		$cs_calificacion_grid->LoadDefaultValues();

		// Set row properties
		$cs_calificacion->ResetAttrs();
		$cs_calificacion->RowAttrs = array_merge($cs_calificacion->RowAttrs, array('data-rowindex'=>$cs_calificacion_grid->RowIndex, 'id'=>'r0_cs_calificacion', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cs_calificacion->RowAttrs["class"], "ewTemplate");
		$cs_calificacion->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cs_calificacion_grid->RenderRow();

		// Render list options
		$cs_calificacion_grid->RenderListOptions();
		$cs_calificacion_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cs_calificacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_calificacion_grid->ListOptions->Render("body", "left", $cs_calificacion_grid->RowIndex);
?>
	<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
		<td data-name="idCalificacion">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_idCalificacion" class="form-group cs_calificacion_idCalificacion">
<span<?php echo $cs_calificacion->idCalificacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idCalificacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idCalificacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_calificacion->idCalificacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_idCalificacion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_calificacion->idCalificacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
		<td data-name="idProyecto">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<?php if ($cs_calificacion->idProyecto->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idProyecto->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<input type="text" data-table="cs_calificacion" data-field="x_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idProyecto->EditValue ?>"<?php echo $cs_calificacion->idProyecto->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_idProyecto" class="form-group cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idProyecto->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idProyecto" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_idProyecto" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_calificacion->idProyecto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
		<td data-name="numproceso">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_numproceso" class="form-group cs_calificacion_numproceso">
<input type="text" data-table="cs_calificacion" data-field="x_numproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->numproceso->EditValue ?>"<?php echo $cs_calificacion->numproceso->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_numproceso" class="form-group cs_calificacion_numproceso">
<span<?php echo $cs_calificacion->numproceso->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->numproceso->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_numproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_numproceso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->numproceso->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
		<td data-name="fechactualizacion">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_fechactualizacion" class="form-group cs_calificacion_fechactualizacion">
<input type="text" data-table="cs_calificacion" data-field="x_fechactualizacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fechactualizacion->EditValue ?>"<?php echo $cs_calificacion->fechactualizacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_fechactualizacion" class="form-group cs_calificacion_fechactualizacion">
<span<?php echo $cs_calificacion->fechactualizacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->fechactualizacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechactualizacion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" value="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechactualizacion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechactualizacion" value="<?php echo ew_HtmlEncode($cs_calificacion->fechactualizacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_idFuncionario" class="form-group cs_calificacion_idFuncionario">
<input type="text" data-table="cs_calificacion" data-field="x_idFuncionario" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idFuncionario->EditValue ?>"<?php echo $cs_calificacion->idFuncionario->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_idFuncionario" class="form-group cs_calificacion_idFuncionario">
<span<?php echo $cs_calificacion->idFuncionario->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idFuncionario->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idFuncionario" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_idFuncionario" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_calificacion->idFuncionario->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
		<td data-name="estatusproceso">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_estatusproceso" class="form-group cs_calificacion_estatusproceso">
<input type="text" data-table="cs_calificacion" data-field="x_estatusproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->estatusproceso->EditValue ?>"<?php echo $cs_calificacion->estatusproceso->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_estatusproceso" class="form-group cs_calificacion_estatusproceso">
<span<?php echo $cs_calificacion->estatusproceso->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->estatusproceso->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_estatusproceso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_estatusproceso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_estatusproceso" value="<?php echo ew_HtmlEncode($cs_calificacion->estatusproceso->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
		<td data-name="proceseval">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_proceseval" class="form-group cs_calificacion_proceseval">
<input type="text" data-table="cs_calificacion" data-field="x_proceseval" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->proceseval->EditValue ?>"<?php echo $cs_calificacion->proceseval->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_proceseval" class="form-group cs_calificacion_proceseval">
<span<?php echo $cs_calificacion->proceseval->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->proceseval->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_proceseval" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" value="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_proceseval" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_proceseval" value="<?php echo ew_HtmlEncode($cs_calificacion->proceseval->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
		<td data-name="invitainter">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_invitainter" class="form-group cs_calificacion_invitainter">
<input type="text" data-table="cs_calificacion" data-field="x_invitainter" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->invitainter->EditValue ?>"<?php echo $cs_calificacion->invitainter->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_invitainter" class="form-group cs_calificacion_invitainter">
<span<?php echo $cs_calificacion->invitainter->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->invitainter->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_invitainter" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" value="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_invitainter" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_invitainter" value="<?php echo ew_HtmlEncode($cs_calificacion->invitainter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
		<td data-name="basespreca">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_basespreca" class="form-group cs_calificacion_basespreca">
<input type="text" data-table="cs_calificacion" data-field="x_basespreca" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->basespreca->EditValue ?>"<?php echo $cs_calificacion->basespreca->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_basespreca" class="form-group cs_calificacion_basespreca">
<span<?php echo $cs_calificacion->basespreca->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->basespreca->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_basespreca" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" value="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_basespreca" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_basespreca" value="<?php echo ew_HtmlEncode($cs_calificacion->basespreca->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
		<td data-name="resolucion">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_resolucion" class="form-group cs_calificacion_resolucion">
<input type="text" data-table="cs_calificacion" data-field="x_resolucion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->resolucion->EditValue ?>"<?php echo $cs_calificacion->resolucion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_resolucion" class="form-group cs_calificacion_resolucion">
<span<?php echo $cs_calificacion->resolucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->resolucion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_resolucion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" value="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_resolucion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_resolucion" value="<?php echo ew_HtmlEncode($cs_calificacion->resolucion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
		<td data-name="nombreante">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_nombreante" class="form-group cs_calificacion_nombreante">
<input type="text" data-table="cs_calificacion" data-field="x_nombreante" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->nombreante->EditValue ?>"<?php echo $cs_calificacion->nombreante->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_nombreante" class="form-group cs_calificacion_nombreante">
<span<?php echo $cs_calificacion->nombreante->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->nombreante->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_nombreante" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" value="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_nombreante" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_nombreante" value="<?php echo ew_HtmlEncode($cs_calificacion->nombreante->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
		<td data-name="convocainvi">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_convocainvi" class="form-group cs_calificacion_convocainvi">
<input type="text" data-table="cs_calificacion" data-field="x_convocainvi" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->convocainvi->EditValue ?>"<?php echo $cs_calificacion->convocainvi->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_convocainvi" class="form-group cs_calificacion_convocainvi">
<span<?php echo $cs_calificacion->convocainvi->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->convocainvi->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_convocainvi" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" value="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_convocainvi" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_convocainvi" value="<?php echo ew_HtmlEncode($cs_calificacion->convocainvi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
		<td data-name="tdr">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_tdr" class="form-group cs_calificacion_tdr">
<input type="text" data-table="cs_calificacion" data-field="x_tdr" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->tdr->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->tdr->EditValue ?>"<?php echo $cs_calificacion->tdr->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_tdr" class="form-group cs_calificacion_tdr">
<span<?php echo $cs_calificacion->tdr->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->tdr->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_tdr" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" value="<?php echo ew_HtmlEncode($cs_calificacion->tdr->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_tdr" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_tdr" value="<?php echo ew_HtmlEncode($cs_calificacion->tdr->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
		<td data-name="aclaraciones">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_aclaraciones" class="form-group cs_calificacion_aclaraciones">
<input type="text" data-table="cs_calificacion" data-field="x_aclaraciones" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->aclaraciones->EditValue ?>"<?php echo $cs_calificacion->aclaraciones->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_aclaraciones" class="form-group cs_calificacion_aclaraciones">
<span<?php echo $cs_calificacion->aclaraciones->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->aclaraciones->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_aclaraciones" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" value="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_aclaraciones" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_aclaraciones" value="<?php echo ew_HtmlEncode($cs_calificacion->aclaraciones->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
		<td data-name="actarecpcion">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_actarecpcion" class="form-group cs_calificacion_actarecpcion">
<input type="text" data-table="cs_calificacion" data-field="x_actarecpcion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->actarecpcion->EditValue ?>"<?php echo $cs_calificacion->actarecpcion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_actarecpcion" class="form-group cs_calificacion_actarecpcion">
<span<?php echo $cs_calificacion->actarecpcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->actarecpcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_actarecpcion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" value="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_actarecpcion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_actarecpcion" value="<?php echo ew_HtmlEncode($cs_calificacion->actarecpcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
		<td data-name="fechaingreso">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_fechaingreso" class="form-group cs_calificacion_fechaingreso">
<input type="text" data-table="cs_calificacion" data-field="x_fechaingreso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" size="30" maxlength="12" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fechaingreso->EditValue ?>"<?php echo $cs_calificacion->fechaingreso->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_fechaingreso" class="form-group cs_calificacion_fechaingreso">
<span<?php echo $cs_calificacion->fechaingreso->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->fechaingreso->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechaingreso" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" value="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_fechaingreso" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fechaingreso" value="<?php echo ew_HtmlEncode($cs_calificacion->fechaingreso->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
		<td data-name="tipocontrato">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_tipocontrato" class="form-group cs_calificacion_tipocontrato">
<input type="text" data-table="cs_calificacion" data-field="x_tipocontrato" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->tipocontrato->EditValue ?>"<?php echo $cs_calificacion->tipocontrato->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_tipocontrato" class="form-group cs_calificacion_tipocontrato">
<span<?php echo $cs_calificacion->tipocontrato->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->tipocontrato->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_tipocontrato" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" value="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_tipocontrato" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_tipocontrato" value="<?php echo ew_HtmlEncode($cs_calificacion->tipocontrato->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_estado" class="form-group cs_calificacion_estado">
<input type="text" data-table="cs_calificacion" data-field="x_estado" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->estado->EditValue ?>"<?php echo $cs_calificacion->estado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_estado" class="form-group cs_calificacion_estado">
<span<?php echo $cs_calificacion->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_estado" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_calificacion->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_estado" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_calificacion->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
		<td data-name="otro1">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_otro1" class="form-group cs_calificacion_otro1">
<input type="text" data-table="cs_calificacion" data-field="x_otro1" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->otro1->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->otro1->EditValue ?>"<?php echo $cs_calificacion->otro1->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_otro1" class="form-group cs_calificacion_otro1">
<span<?php echo $cs_calificacion->otro1->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->otro1->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro1" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" value="<?php echo ew_HtmlEncode($cs_calificacion->otro1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro1" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro1" value="<?php echo ew_HtmlEncode($cs_calificacion->otro1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
		<td data-name="otro2">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_otro2" class="form-group cs_calificacion_otro2">
<input type="text" data-table="cs_calificacion" data-field="x_otro2" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->otro2->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->otro2->EditValue ?>"<?php echo $cs_calificacion->otro2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_otro2" class="form-group cs_calificacion_otro2">
<span<?php echo $cs_calificacion->otro2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->otro2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro2" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" value="<?php echo ew_HtmlEncode($cs_calificacion->otro2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_otro2" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_otro2" value="<?php echo ew_HtmlEncode($cs_calificacion->otro2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
		<td data-name="identidadadquisicion">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_identidadadquisicion" class="form-group cs_calificacion_identidadadquisicion">
<input type="text" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->identidadadquisicion->EditValue ?>"<?php echo $cs_calificacion->identidadadquisicion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_identidadadquisicion" class="form-group cs_calificacion_identidadadquisicion">
<span<?php echo $cs_calificacion->identidadadquisicion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->identidadadquisicion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" value="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_identidadadquisicion" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_identidadadquisicion" value="<?php echo ew_HtmlEncode($cs_calificacion->identidadadquisicion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
		<td data-name="idmetodo">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_idmetodo" class="form-group cs_calificacion_idmetodo">
<input type="text" data-table="cs_calificacion" data-field="x_idmetodo" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" size="30" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->idmetodo->EditValue ?>"<?php echo $cs_calificacion->idmetodo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_idmetodo" class="form-group cs_calificacion_idmetodo">
<span<?php echo $cs_calificacion->idmetodo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->idmetodo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_idmetodo" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" value="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_idmetodo" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_idmetodo" value="<?php echo ew_HtmlEncode($cs_calificacion->idmetodo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido">
<?php if ($cs_calificacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_calificacion_fecharecibido" class="form-group cs_calificacion_fecharecibido">
<input type="text" data-table="cs_calificacion" data-field="x_fecharecibido" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_calificacion->fecharecibido->EditValue ?>"<?php echo $cs_calificacion->fecharecibido->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_calificacion_fecharecibido" class="form-group cs_calificacion_fecharecibido">
<span<?php echo $cs_calificacion->fecharecibido->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_calificacion->fecharecibido->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_calificacion" data-field="x_fecharecibido" name="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_calificacion" data-field="x_fecharecibido" name="o<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_calificacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_calificacion->fecharecibido->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_calificacion_grid->ListOptions->Render("body", "right", $cs_calificacion_grid->RowCnt);
?>
<script type="text/javascript">
fcs_calificaciongrid.UpdateOpts(<?php echo $cs_calificacion_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cs_calificacion->CurrentMode == "add" || $cs_calificacion->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cs_calificacion_grid->FormKeyCountName ?>" id="<?php echo $cs_calificacion_grid->FormKeyCountName ?>" value="<?php echo $cs_calificacion_grid->KeyCount ?>">
<?php echo $cs_calificacion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_calificacion->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cs_calificacion_grid->FormKeyCountName ?>" id="<?php echo $cs_calificacion_grid->FormKeyCountName ?>" value="<?php echo $cs_calificacion_grid->KeyCount ?>">
<?php echo $cs_calificacion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_calificacion->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcs_calificaciongrid">
</div>
<?php

// Close recordset
if ($cs_calificacion_grid->Recordset)
	$cs_calificacion_grid->Recordset->Close();
?>
<?php if ($cs_calificacion_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($cs_calificacion_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cs_calificacion_grid->TotalRecs == 0 && $cs_calificacion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_calificacion_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_calificacion->Export == "") { ?>
<script type="text/javascript">
fcs_calificaciongrid.Init();
</script>
<?php } ?>
<?php
$cs_calificacion_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$cs_calificacion_grid->Page_Terminate();
?>
