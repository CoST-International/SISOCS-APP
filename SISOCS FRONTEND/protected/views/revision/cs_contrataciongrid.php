<?php include_once "cruge_userinfo.php" ?>
<?php

// Create page object
if (!isset($cs_contratacion_grid)) $cs_contratacion_grid = new ccs_contratacion_grid();

// Page init
$cs_contratacion_grid->Page_Init();

// Page main
$cs_contratacion_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_contratacion_grid->Page_Render();
?>
<?php if ($cs_contratacion->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcs_contrataciongrid = new ew_Form("fcs_contrataciongrid", "grid");
fcs_contrataciongrid.FormKeyCountName = '<?php echo $cs_contratacion_grid->FormKeyCountName ?>';

// Validate form
fcs_contrataciongrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_idAdjudicacion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_contratacion->idAdjudicacion->FldCaption(), $cs_contratacion->idAdjudicacion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idAdjudicacion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_contratacion->idAdjudicacion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idEntidad");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_contratacion->idEntidad->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idoferente");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_contratacion->idoferente->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_precio");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_contratacion->precio->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_precio2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_contratacion->precio2->FldCaption(), $cs_contratacion->precio2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_precio2");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_contratacion->precio2->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcs_contrataciongrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "idAdjudicacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idEntidad", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idoferente", false)) return false;
	if (ew_ValueChanged(fobj, infix, "precio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "precio2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechainicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechafinal", false)) return false;
	if (ew_ValueChanged(fobj, infix, "duracioncontrato", false)) return false;
	if (ew_ValueChanged(fobj, infix, "documentocontra", false)) return false;
	if (ew_ValueChanged(fobj, infix, "regante", false)) return false;
	if (ew_ValueChanged(fobj, infix, "espeplanos", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "otro", false)) return false;
	if (ew_ValueChanged(fobj, infix, "ncontrato", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecharecibido", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechacreacion", false)) return false;
	return true;
}

// Form_CustomValidate event
fcs_contrataciongrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_contrataciongrid.ValidateRequired = true;
<?php } else { ?>
fcs_contrataciongrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($cs_contratacion->CurrentAction == "gridadd") {
	if ($cs_contratacion->CurrentMode == "copy") {
		$bSelectLimit = $cs_contratacion_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cs_contratacion_grid->TotalRecs = $cs_contratacion->SelectRecordCount();
			$cs_contratacion_grid->Recordset = $cs_contratacion_grid->LoadRecordset($cs_contratacion_grid->StartRec-1, $cs_contratacion_grid->DisplayRecs);
		} else {
			if ($cs_contratacion_grid->Recordset = $cs_contratacion_grid->LoadRecordset())
				$cs_contratacion_grid->TotalRecs = $cs_contratacion_grid->Recordset->RecordCount();
		}
		$cs_contratacion_grid->StartRec = 1;
		$cs_contratacion_grid->DisplayRecs = $cs_contratacion_grid->TotalRecs;
	} else {
		$cs_contratacion->CurrentFilter = "0=1";
		$cs_contratacion_grid->StartRec = 1;
		$cs_contratacion_grid->DisplayRecs = $cs_contratacion->GridAddRowCount;
	}
	$cs_contratacion_grid->TotalRecs = $cs_contratacion_grid->DisplayRecs;
	$cs_contratacion_grid->StopRec = $cs_contratacion_grid->DisplayRecs;
} else {
	$bSelectLimit = $cs_contratacion_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_contratacion_grid->TotalRecs <= 0)
			$cs_contratacion_grid->TotalRecs = $cs_contratacion->SelectRecordCount();
	} else {
		if (!$cs_contratacion_grid->Recordset && ($cs_contratacion_grid->Recordset = $cs_contratacion_grid->LoadRecordset()))
			$cs_contratacion_grid->TotalRecs = $cs_contratacion_grid->Recordset->RecordCount();
	}
	$cs_contratacion_grid->StartRec = 1;
	$cs_contratacion_grid->DisplayRecs = $cs_contratacion_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cs_contratacion_grid->Recordset = $cs_contratacion_grid->LoadRecordset($cs_contratacion_grid->StartRec-1, $cs_contratacion_grid->DisplayRecs);

	// Set no record found message
	if ($cs_contratacion->CurrentAction == "" && $cs_contratacion_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_contratacion_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_contratacion_grid->SearchWhere == "0=101")
			$cs_contratacion_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_contratacion_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cs_contratacion_grid->RenderOtherOptions();
?>
<?php $cs_contratacion_grid->ShowPageHeader(); ?>
<?php
$cs_contratacion_grid->ShowMessage();
?>
<?php if ($cs_contratacion_grid->TotalRecs > 0 || $cs_contratacion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<div id="fcs_contrataciongrid" class="ewForm form-inline">
<div id="gmp_cs_contratacion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_cs_contrataciongrid" class="table ewTable">
<?php echo $cs_contratacion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_contratacion_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_contratacion_grid->RenderListOptions();

// Render list options (header, left)
$cs_contratacion_grid->ListOptions->Render("header", "left");
?>
<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idContratacion) == "") { ?>
		<th data-name="idContratacion"><div id="elh_cs_contratacion_idContratacion" class="cs_contratacion_idContratacion"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idContratacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idContratacion"><div><div id="elh_cs_contratacion_idContratacion" class="cs_contratacion_idContratacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idContratacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idContratacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idContratacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idAdjudicacion) == "") { ?>
		<th data-name="idAdjudicacion"><div id="elh_cs_contratacion_idAdjudicacion" class="cs_contratacion_idAdjudicacion"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idAdjudicacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idAdjudicacion"><div><div id="elh_cs_contratacion_idAdjudicacion" class="cs_contratacion_idAdjudicacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idAdjudicacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idAdjudicacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idAdjudicacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idEntidad) == "") { ?>
		<th data-name="idEntidad"><div id="elh_cs_contratacion_idEntidad" class="cs_contratacion_idEntidad"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idEntidad->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idEntidad"><div><div id="elh_cs_contratacion_idEntidad" class="cs_contratacion_idEntidad">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idEntidad->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idEntidad->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idEntidad->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idoferente) == "") { ?>
		<th data-name="idoferente"><div id="elh_cs_contratacion_idoferente" class="cs_contratacion_idoferente"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idoferente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idoferente"><div><div id="elh_cs_contratacion_idoferente" class="cs_contratacion_idoferente">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idoferente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idoferente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idoferente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->precio->Visible) { // precio ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->precio) == "") { ?>
		<th data-name="precio"><div id="elh_cs_contratacion_precio" class="cs_contratacion_precio"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio"><div><div id="elh_cs_contratacion_precio" class="cs_contratacion_precio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->precio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->precio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->precio2) == "") { ?>
		<th data-name="precio2"><div id="elh_cs_contratacion_precio2" class="cs_contratacion_precio2"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio2"><div><div id="elh_cs_contratacion_precio2" class="cs_contratacion_precio2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->precio2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->precio2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fechainicio) == "") { ?>
		<th data-name="fechainicio"><div id="elh_cs_contratacion_fechainicio" class="cs_contratacion_fechainicio"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechainicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechainicio"><div><div id="elh_cs_contratacion_fechainicio" class="cs_contratacion_fechainicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechainicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fechainicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fechainicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fechafinal) == "") { ?>
		<th data-name="fechafinal"><div id="elh_cs_contratacion_fechafinal" class="cs_contratacion_fechafinal"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechafinal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechafinal"><div><div id="elh_cs_contratacion_fechafinal" class="cs_contratacion_fechafinal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechafinal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fechafinal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fechafinal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->duracioncontrato) == "") { ?>
		<th data-name="duracioncontrato"><div id="elh_cs_contratacion_duracioncontrato" class="cs_contratacion_duracioncontrato"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->duracioncontrato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="duracioncontrato"><div><div id="elh_cs_contratacion_duracioncontrato" class="cs_contratacion_duracioncontrato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->duracioncontrato->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->duracioncontrato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->duracioncontrato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->documentocontra) == "") { ?>
		<th data-name="documentocontra"><div id="elh_cs_contratacion_documentocontra" class="cs_contratacion_documentocontra"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->documentocontra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="documentocontra"><div><div id="elh_cs_contratacion_documentocontra" class="cs_contratacion_documentocontra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->documentocontra->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->documentocontra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->documentocontra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->regante->Visible) { // regante ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->regante) == "") { ?>
		<th data-name="regante"><div id="elh_cs_contratacion_regante" class="cs_contratacion_regante"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->regante->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="regante"><div><div id="elh_cs_contratacion_regante" class="cs_contratacion_regante">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->regante->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->regante->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->regante->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->espeplanos) == "") { ?>
		<th data-name="espeplanos"><div id="elh_cs_contratacion_espeplanos" class="cs_contratacion_espeplanos"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->espeplanos->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="espeplanos"><div><div id="elh_cs_contratacion_espeplanos" class="cs_contratacion_espeplanos">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->espeplanos->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->espeplanos->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->espeplanos->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->estado->Visible) { // estado ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_contratacion_estado" class="cs_contratacion_estado"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div><div id="elh_cs_contratacion_estado" class="cs_contratacion_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->otro->Visible) { // otro ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->otro) == "") { ?>
		<th data-name="otro"><div id="elh_cs_contratacion_otro" class="cs_contratacion_otro"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->otro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro"><div><div id="elh_cs_contratacion_otro" class="cs_contratacion_otro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->otro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->otro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->otro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->ncontrato) == "") { ?>
		<th data-name="ncontrato"><div id="elh_cs_contratacion_ncontrato" class="cs_contratacion_ncontrato"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->ncontrato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ncontrato"><div><div id="elh_cs_contratacion_ncontrato" class="cs_contratacion_ncontrato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->ncontrato->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->ncontrato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->ncontrato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_contratacion_fecharecibido" class="cs_contratacion_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div><div id="elh_cs_contratacion_fecharecibido" class="cs_contratacion_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fecharecibido->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fechacreacion) == "") { ?>
		<th data-name="fechacreacion"><div id="elh_cs_contratacion_fechacreacion" class="cs_contratacion_fechacreacion"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechacreacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechacreacion"><div><div id="elh_cs_contratacion_fechacreacion" class="cs_contratacion_fechacreacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechacreacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fechacreacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fechacreacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_contratacion_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cs_contratacion_grid->StartRec = 1;
$cs_contratacion_grid->StopRec = $cs_contratacion_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cs_contratacion_grid->FormKeyCountName) && ($cs_contratacion->CurrentAction == "gridadd" || $cs_contratacion->CurrentAction == "gridedit" || $cs_contratacion->CurrentAction == "F")) {
		$cs_contratacion_grid->KeyCount = $objForm->GetValue($cs_contratacion_grid->FormKeyCountName);
		$cs_contratacion_grid->StopRec = $cs_contratacion_grid->StartRec + $cs_contratacion_grid->KeyCount - 1;
	}
}
$cs_contratacion_grid->RecCnt = $cs_contratacion_grid->StartRec - 1;
if ($cs_contratacion_grid->Recordset && !$cs_contratacion_grid->Recordset->EOF) {
	$cs_contratacion_grid->Recordset->MoveFirst();
	$bSelectLimit = $cs_contratacion_grid->UseSelectLimit;
	if (!$bSelectLimit && $cs_contratacion_grid->StartRec > 1)
		$cs_contratacion_grid->Recordset->Move($cs_contratacion_grid->StartRec - 1);
} elseif (!$cs_contratacion->AllowAddDeleteRow && $cs_contratacion_grid->StopRec == 0) {
	$cs_contratacion_grid->StopRec = $cs_contratacion->GridAddRowCount;
}

// Initialize aggregate
$cs_contratacion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_contratacion->ResetAttrs();
$cs_contratacion_grid->RenderRow();
if ($cs_contratacion->CurrentAction == "gridadd")
	$cs_contratacion_grid->RowIndex = 0;
if ($cs_contratacion->CurrentAction == "gridedit")
	$cs_contratacion_grid->RowIndex = 0;
while ($cs_contratacion_grid->RecCnt < $cs_contratacion_grid->StopRec) {
	$cs_contratacion_grid->RecCnt++;
	if (intval($cs_contratacion_grid->RecCnt) >= intval($cs_contratacion_grid->StartRec)) {
		$cs_contratacion_grid->RowCnt++;
		if ($cs_contratacion->CurrentAction == "gridadd" || $cs_contratacion->CurrentAction == "gridedit" || $cs_contratacion->CurrentAction == "F") {
			$cs_contratacion_grid->RowIndex++;
			$objForm->Index = $cs_contratacion_grid->RowIndex;
			if ($objForm->HasValue($cs_contratacion_grid->FormActionName))
				$cs_contratacion_grid->RowAction = strval($objForm->GetValue($cs_contratacion_grid->FormActionName));
			elseif ($cs_contratacion->CurrentAction == "gridadd")
				$cs_contratacion_grid->RowAction = "insert";
			else
				$cs_contratacion_grid->RowAction = "";
		}

		// Set up key count
		$cs_contratacion_grid->KeyCount = $cs_contratacion_grid->RowIndex;

		// Init row class and style
		$cs_contratacion->ResetAttrs();
		$cs_contratacion->CssClass = "";
		if ($cs_contratacion->CurrentAction == "gridadd") {
			if ($cs_contratacion->CurrentMode == "copy") {
				$cs_contratacion_grid->LoadRowValues($cs_contratacion_grid->Recordset); // Load row values
				$cs_contratacion_grid->SetRecordKey($cs_contratacion_grid->RowOldKey, $cs_contratacion_grid->Recordset); // Set old record key
			} else {
				$cs_contratacion_grid->LoadDefaultValues(); // Load default values
				$cs_contratacion_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cs_contratacion_grid->LoadRowValues($cs_contratacion_grid->Recordset); // Load row values
		}
		$cs_contratacion->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cs_contratacion->CurrentAction == "gridadd") // Grid add
			$cs_contratacion->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cs_contratacion->CurrentAction == "gridadd" && $cs_contratacion->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cs_contratacion_grid->RestoreCurrentRowFormValues($cs_contratacion_grid->RowIndex); // Restore form values
		if ($cs_contratacion->CurrentAction == "gridedit") { // Grid edit
			if ($cs_contratacion->EventCancelled) {
				$cs_contratacion_grid->RestoreCurrentRowFormValues($cs_contratacion_grid->RowIndex); // Restore form values
			}
			if ($cs_contratacion_grid->RowAction == "insert")
				$cs_contratacion->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cs_contratacion->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cs_contratacion->CurrentAction == "gridedit" && ($cs_contratacion->RowType == EW_ROWTYPE_EDIT || $cs_contratacion->RowType == EW_ROWTYPE_ADD) && $cs_contratacion->EventCancelled) // Update failed
			$cs_contratacion_grid->RestoreCurrentRowFormValues($cs_contratacion_grid->RowIndex); // Restore form values
		if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cs_contratacion_grid->EditRowCnt++;
		if ($cs_contratacion->CurrentAction == "F") // Confirm row
			$cs_contratacion_grid->RestoreCurrentRowFormValues($cs_contratacion_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cs_contratacion->RowAttrs = array_merge($cs_contratacion->RowAttrs, array('data-rowindex'=>$cs_contratacion_grid->RowCnt, 'id'=>'r' . $cs_contratacion_grid->RowCnt . '_cs_contratacion', 'data-rowtype'=>$cs_contratacion->RowType));

		// Render row
		$cs_contratacion_grid->RenderRow();

		// Render list options
		$cs_contratacion_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cs_contratacion_grid->RowAction <> "delete" && $cs_contratacion_grid->RowAction <> "insertdelete" && !($cs_contratacion_grid->RowAction == "insert" && $cs_contratacion->CurrentAction == "F" && $cs_contratacion_grid->EmptyRow())) {
?>
	<tr<?php echo $cs_contratacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_contratacion_grid->ListOptions->Render("body", "left", $cs_contratacion_grid->RowCnt);
?>
	<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion"<?php echo $cs_contratacion->idContratacion->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_idContratacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idContratacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idContratacion" class="form-group cs_contratacion_idContratacion">
<span<?php echo $cs_contratacion->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idContratacion->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idContratacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idContratacion->CurrentValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idContratacion" class="cs_contratacion_idContratacion">
<span<?php echo $cs_contratacion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idContratacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idContratacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idContratacion->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_idContratacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idContratacion->OldValue) ?>">
<?php } ?>
<a id="<?php echo $cs_contratacion_grid->PageObjName . "_row_" . $cs_contratacion_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<td data-name="idAdjudicacion"<?php echo $cs_contratacion->idAdjudicacion->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cs_contratacion->idAdjudicacion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idAdjudicacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<input type="text" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idAdjudicacion->EditValue ?>"<?php echo $cs_contratacion->idAdjudicacion->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cs_contratacion->idAdjudicacion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idAdjudicacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<input type="text" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idAdjudicacion->EditValue ?>"<?php echo $cs_contratacion->idAdjudicacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idAdjudicacion" class="cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idAdjudicacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
		<td data-name="idEntidad"<?php echo $cs_contratacion->idEntidad->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idEntidad" class="form-group cs_contratacion_idEntidad">
<input type="text" data-table="cs_contratacion" data-field="x_idEntidad" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idEntidad->EditValue ?>"<?php echo $cs_contratacion->idEntidad->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idEntidad" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" value="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idEntidad" class="form-group cs_contratacion_idEntidad">
<input type="text" data-table="cs_contratacion" data-field="x_idEntidad" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idEntidad->EditValue ?>"<?php echo $cs_contratacion->idEntidad->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idEntidad" class="cs_contratacion_idEntidad">
<span<?php echo $cs_contratacion->idEntidad->ViewAttributes() ?>>
<?php echo $cs_contratacion->idEntidad->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idEntidad" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" value="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_idEntidad" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" value="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
		<td data-name="idoferente"<?php echo $cs_contratacion->idoferente->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idoferente" class="form-group cs_contratacion_idoferente">
<input type="text" data-table="cs_contratacion" data-field="x_idoferente" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idoferente->EditValue ?>"<?php echo $cs_contratacion->idoferente->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idoferente" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" value="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idoferente" class="form-group cs_contratacion_idoferente">
<input type="text" data-table="cs_contratacion" data-field="x_idoferente" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idoferente->EditValue ?>"<?php echo $cs_contratacion->idoferente->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_idoferente" class="cs_contratacion_idoferente">
<span<?php echo $cs_contratacion->idoferente->ViewAttributes() ?>>
<?php echo $cs_contratacion->idoferente->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idoferente" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" value="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_idoferente" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" value="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->precio->Visible) { // precio ?>
		<td data-name="precio"<?php echo $cs_contratacion->precio->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_precio" class="form-group cs_contratacion_precio">
<input type="text" data-table="cs_contratacion" data-field="x_precio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->precio->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->precio->EditValue ?>"<?php echo $cs_contratacion->precio->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio" value="<?php echo ew_HtmlEncode($cs_contratacion->precio->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_precio" class="form-group cs_contratacion_precio">
<input type="text" data-table="cs_contratacion" data-field="x_precio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->precio->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->precio->EditValue ?>"<?php echo $cs_contratacion->precio->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_precio" class="cs_contratacion_precio">
<span<?php echo $cs_contratacion->precio->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" value="<?php echo ew_HtmlEncode($cs_contratacion->precio->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_precio" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio" value="<?php echo ew_HtmlEncode($cs_contratacion->precio->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
		<td data-name="precio2"<?php echo $cs_contratacion->precio2->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_precio2" class="form-group cs_contratacion_precio2">
<input type="text" data-table="cs_contratacion" data-field="x_precio2" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->precio2->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->precio2->EditValue ?>"<?php echo $cs_contratacion->precio2->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio2" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" value="<?php echo ew_HtmlEncode($cs_contratacion->precio2->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_precio2" class="form-group cs_contratacion_precio2">
<input type="text" data-table="cs_contratacion" data-field="x_precio2" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->precio2->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->precio2->EditValue ?>"<?php echo $cs_contratacion->precio2->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_precio2" class="cs_contratacion_precio2">
<span<?php echo $cs_contratacion->precio2->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio2->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio2" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" value="<?php echo ew_HtmlEncode($cs_contratacion->precio2->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_precio2" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" value="<?php echo ew_HtmlEncode($cs_contratacion->precio2->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
		<td data-name="fechainicio"<?php echo $cs_contratacion->fechainicio->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechainicio" class="form-group cs_contratacion_fechainicio">
<input type="text" data-table="cs_contratacion" data-field="x_fechainicio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechainicio->EditValue ?>"<?php echo $cs_contratacion->fechainicio->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechainicio" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" value="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechainicio" class="form-group cs_contratacion_fechainicio">
<input type="text" data-table="cs_contratacion" data-field="x_fechainicio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechainicio->EditValue ?>"<?php echo $cs_contratacion->fechainicio->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechainicio" class="cs_contratacion_fechainicio">
<span<?php echo $cs_contratacion->fechainicio->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechainicio->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechainicio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" value="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_fechainicio" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" value="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
		<td data-name="fechafinal"<?php echo $cs_contratacion->fechafinal->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechafinal" class="form-group cs_contratacion_fechafinal">
<input type="text" data-table="cs_contratacion" data-field="x_fechafinal" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechafinal->EditValue ?>"<?php echo $cs_contratacion->fechafinal->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechafinal" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" value="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechafinal" class="form-group cs_contratacion_fechafinal">
<input type="text" data-table="cs_contratacion" data-field="x_fechafinal" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechafinal->EditValue ?>"<?php echo $cs_contratacion->fechafinal->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechafinal" class="cs_contratacion_fechafinal">
<span<?php echo $cs_contratacion->fechafinal->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechafinal->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechafinal" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" value="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_fechafinal" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" value="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
		<td data-name="duracioncontrato"<?php echo $cs_contratacion->duracioncontrato->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_duracioncontrato" class="form-group cs_contratacion_duracioncontrato">
<input type="text" data-table="cs_contratacion" data-field="x_duracioncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" size="30" maxlength="65" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->duracioncontrato->EditValue ?>"<?php echo $cs_contratacion->duracioncontrato->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_duracioncontrato" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_duracioncontrato" class="form-group cs_contratacion_duracioncontrato">
<input type="text" data-table="cs_contratacion" data-field="x_duracioncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" size="30" maxlength="65" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->duracioncontrato->EditValue ?>"<?php echo $cs_contratacion->duracioncontrato->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_duracioncontrato" class="cs_contratacion_duracioncontrato">
<span<?php echo $cs_contratacion->duracioncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->duracioncontrato->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_duracioncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_duracioncontrato" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
		<td data-name="documentocontra"<?php echo $cs_contratacion->documentocontra->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_documentocontra" class="form-group cs_contratacion_documentocontra">
<input type="text" data-table="cs_contratacion" data-field="x_documentocontra" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->documentocontra->EditValue ?>"<?php echo $cs_contratacion->documentocontra->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_documentocontra" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" value="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_documentocontra" class="form-group cs_contratacion_documentocontra">
<input type="text" data-table="cs_contratacion" data-field="x_documentocontra" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->documentocontra->EditValue ?>"<?php echo $cs_contratacion->documentocontra->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_documentocontra" class="cs_contratacion_documentocontra">
<span<?php echo $cs_contratacion->documentocontra->ViewAttributes() ?>>
<?php echo $cs_contratacion->documentocontra->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_documentocontra" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" value="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_documentocontra" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" value="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->regante->Visible) { // regante ?>
		<td data-name="regante"<?php echo $cs_contratacion->regante->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_regante" class="form-group cs_contratacion_regante">
<input type="text" data-table="cs_contratacion" data-field="x_regante" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->regante->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->regante->EditValue ?>"<?php echo $cs_contratacion->regante->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_regante" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_regante" value="<?php echo ew_HtmlEncode($cs_contratacion->regante->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_regante" class="form-group cs_contratacion_regante">
<input type="text" data-table="cs_contratacion" data-field="x_regante" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->regante->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->regante->EditValue ?>"<?php echo $cs_contratacion->regante->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_regante" class="cs_contratacion_regante">
<span<?php echo $cs_contratacion->regante->ViewAttributes() ?>>
<?php echo $cs_contratacion->regante->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_regante" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" value="<?php echo ew_HtmlEncode($cs_contratacion->regante->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_regante" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_regante" value="<?php echo ew_HtmlEncode($cs_contratacion->regante->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
		<td data-name="espeplanos"<?php echo $cs_contratacion->espeplanos->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_espeplanos" class="form-group cs_contratacion_espeplanos">
<input type="text" data-table="cs_contratacion" data-field="x_espeplanos" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->espeplanos->EditValue ?>"<?php echo $cs_contratacion->espeplanos->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_espeplanos" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" value="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_espeplanos" class="form-group cs_contratacion_espeplanos">
<input type="text" data-table="cs_contratacion" data-field="x_espeplanos" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->espeplanos->EditValue ?>"<?php echo $cs_contratacion->espeplanos->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_espeplanos" class="cs_contratacion_espeplanos">
<span<?php echo $cs_contratacion->espeplanos->ViewAttributes() ?>>
<?php echo $cs_contratacion->espeplanos->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_espeplanos" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" value="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_espeplanos" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" value="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_contratacion->estado->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_estado" class="form-group cs_contratacion_estado">
<input type="text" data-table="cs_contratacion" data-field="x_estado" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->estado->EditValue ?>"<?php echo $cs_contratacion->estado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_estado" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_contratacion->estado->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_estado" class="form-group cs_contratacion_estado">
<input type="text" data-table="cs_contratacion" data-field="x_estado" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->estado->EditValue ?>"<?php echo $cs_contratacion->estado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_estado" class="cs_contratacion_estado">
<span<?php echo $cs_contratacion->estado->ViewAttributes() ?>>
<?php echo $cs_contratacion->estado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_estado" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_contratacion->estado->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_estado" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_contratacion->estado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->otro->Visible) { // otro ?>
		<td data-name="otro"<?php echo $cs_contratacion->otro->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_otro" class="form-group cs_contratacion_otro">
<input type="text" data-table="cs_contratacion" data-field="x_otro" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->otro->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->otro->EditValue ?>"<?php echo $cs_contratacion->otro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_otro" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_contratacion->otro->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_otro" class="form-group cs_contratacion_otro">
<input type="text" data-table="cs_contratacion" data-field="x_otro" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->otro->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->otro->EditValue ?>"<?php echo $cs_contratacion->otro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_otro" class="cs_contratacion_otro">
<span<?php echo $cs_contratacion->otro->ViewAttributes() ?>>
<?php echo $cs_contratacion->otro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_otro" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_contratacion->otro->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_otro" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_contratacion->otro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
		<td data-name="ncontrato"<?php echo $cs_contratacion->ncontrato->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_ncontrato" class="form-group cs_contratacion_ncontrato">
<input type="text" data-table="cs_contratacion" data-field="x_ncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->ncontrato->EditValue ?>"<?php echo $cs_contratacion->ncontrato->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_ncontrato" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_ncontrato" class="form-group cs_contratacion_ncontrato">
<input type="text" data-table="cs_contratacion" data-field="x_ncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->ncontrato->EditValue ?>"<?php echo $cs_contratacion->ncontrato->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_ncontrato" class="cs_contratacion_ncontrato">
<span<?php echo $cs_contratacion->ncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->ncontrato->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_ncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_ncontrato" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_contratacion->fecharecibido->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fecharecibido" class="form-group cs_contratacion_fecharecibido">
<input type="text" data-table="cs_contratacion" data-field="x_fecharecibido" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fecharecibido->EditValue ?>"<?php echo $cs_contratacion->fecharecibido->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fecharecibido" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fecharecibido" class="form-group cs_contratacion_fecharecibido">
<input type="text" data-table="cs_contratacion" data-field="x_fecharecibido" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fecharecibido->EditValue ?>"<?php echo $cs_contratacion->fecharecibido->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fecharecibido" class="cs_contratacion_fecharecibido">
<span<?php echo $cs_contratacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_contratacion->fecharecibido->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fecharecibido" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_fecharecibido" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion"<?php echo $cs_contratacion->fechacreacion->CellAttributes() ?>>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechacreacion" class="form-group cs_contratacion_fechacreacion">
<input type="text" data-table="cs_contratacion" data-field="x_fechacreacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechacreacion->EditValue ?>"<?php echo $cs_contratacion->fechacreacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechacreacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechacreacion" class="form-group cs_contratacion_fechacreacion">
<input type="text" data-table="cs_contratacion" data-field="x_fechacreacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechacreacion->EditValue ?>"<?php echo $cs_contratacion->fechacreacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_contratacion_grid->RowCnt ?>_cs_contratacion_fechacreacion" class="cs_contratacion_fechacreacion">
<span<?php echo $cs_contratacion->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechacreacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechacreacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->FormValue) ?>">
<input type="hidden" data-table="cs_contratacion" data-field="x_fechacreacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_contratacion_grid->ListOptions->Render("body", "right", $cs_contratacion_grid->RowCnt);
?>
	</tr>
<?php if ($cs_contratacion->RowType == EW_ROWTYPE_ADD || $cs_contratacion->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcs_contrataciongrid.UpdateOpts(<?php echo $cs_contratacion_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cs_contratacion->CurrentAction <> "gridadd" || $cs_contratacion->CurrentMode == "copy")
		if (!$cs_contratacion_grid->Recordset->EOF) $cs_contratacion_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cs_contratacion->CurrentMode == "add" || $cs_contratacion->CurrentMode == "copy" || $cs_contratacion->CurrentMode == "edit") {
		$cs_contratacion_grid->RowIndex = '$rowindex$';
		$cs_contratacion_grid->LoadDefaultValues();

		// Set row properties
		$cs_contratacion->ResetAttrs();
		$cs_contratacion->RowAttrs = array_merge($cs_contratacion->RowAttrs, array('data-rowindex'=>$cs_contratacion_grid->RowIndex, 'id'=>'r0_cs_contratacion', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cs_contratacion->RowAttrs["class"], "ewTemplate");
		$cs_contratacion->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cs_contratacion_grid->RenderRow();

		// Render list options
		$cs_contratacion_grid->RenderListOptions();
		$cs_contratacion_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cs_contratacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_contratacion_grid->ListOptions->Render("body", "left", $cs_contratacion_grid->RowIndex);
?>
	<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_idContratacion" class="form-group cs_contratacion_idContratacion">
<span<?php echo $cs_contratacion->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idContratacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idContratacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idContratacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_idContratacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idContratacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<td data-name="idAdjudicacion">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<?php if ($cs_contratacion->idAdjudicacion->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idAdjudicacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<input type="text" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idAdjudicacion->EditValue ?>"<?php echo $cs_contratacion->idAdjudicacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_idAdjudicacion" class="form-group cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idAdjudicacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_idAdjudicacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_contratacion->idAdjudicacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
		<td data-name="idEntidad">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_idEntidad" class="form-group cs_contratacion_idEntidad">
<input type="text" data-table="cs_contratacion" data-field="x_idEntidad" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idEntidad->EditValue ?>"<?php echo $cs_contratacion->idEntidad->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_idEntidad" class="form-group cs_contratacion_idEntidad">
<span<?php echo $cs_contratacion->idEntidad->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idEntidad->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idEntidad" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" value="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_idEntidad" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idEntidad" value="<?php echo ew_HtmlEncode($cs_contratacion->idEntidad->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
		<td data-name="idoferente">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_idoferente" class="form-group cs_contratacion_idoferente">
<input type="text" data-table="cs_contratacion" data-field="x_idoferente" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->idoferente->EditValue ?>"<?php echo $cs_contratacion->idoferente->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_idoferente" class="form-group cs_contratacion_idoferente">
<span<?php echo $cs_contratacion->idoferente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->idoferente->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_idoferente" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" value="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_idoferente" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_idoferente" value="<?php echo ew_HtmlEncode($cs_contratacion->idoferente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->precio->Visible) { // precio ?>
		<td data-name="precio">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_precio" class="form-group cs_contratacion_precio">
<input type="text" data-table="cs_contratacion" data-field="x_precio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->precio->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->precio->EditValue ?>"<?php echo $cs_contratacion->precio->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_precio" class="form-group cs_contratacion_precio">
<span<?php echo $cs_contratacion->precio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->precio->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio" value="<?php echo ew_HtmlEncode($cs_contratacion->precio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio" value="<?php echo ew_HtmlEncode($cs_contratacion->precio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
		<td data-name="precio2">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_precio2" class="form-group cs_contratacion_precio2">
<input type="text" data-table="cs_contratacion" data-field="x_precio2" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" size="30" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->precio2->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->precio2->EditValue ?>"<?php echo $cs_contratacion->precio2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_precio2" class="form-group cs_contratacion_precio2">
<span<?php echo $cs_contratacion->precio2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->precio2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio2" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" value="<?php echo ew_HtmlEncode($cs_contratacion->precio2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_precio2" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_precio2" value="<?php echo ew_HtmlEncode($cs_contratacion->precio2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
		<td data-name="fechainicio">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_fechainicio" class="form-group cs_contratacion_fechainicio">
<input type="text" data-table="cs_contratacion" data-field="x_fechainicio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechainicio->EditValue ?>"<?php echo $cs_contratacion->fechainicio->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_fechainicio" class="form-group cs_contratacion_fechainicio">
<span<?php echo $cs_contratacion->fechainicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->fechainicio->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechainicio" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" value="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechainicio" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechainicio" value="<?php echo ew_HtmlEncode($cs_contratacion->fechainicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
		<td data-name="fechafinal">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_fechafinal" class="form-group cs_contratacion_fechafinal">
<input type="text" data-table="cs_contratacion" data-field="x_fechafinal" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechafinal->EditValue ?>"<?php echo $cs_contratacion->fechafinal->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_fechafinal" class="form-group cs_contratacion_fechafinal">
<span<?php echo $cs_contratacion->fechafinal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->fechafinal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechafinal" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" value="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechafinal" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechafinal" value="<?php echo ew_HtmlEncode($cs_contratacion->fechafinal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
		<td data-name="duracioncontrato">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_duracioncontrato" class="form-group cs_contratacion_duracioncontrato">
<input type="text" data-table="cs_contratacion" data-field="x_duracioncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" size="30" maxlength="65" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->duracioncontrato->EditValue ?>"<?php echo $cs_contratacion->duracioncontrato->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_duracioncontrato" class="form-group cs_contratacion_duracioncontrato">
<span<?php echo $cs_contratacion->duracioncontrato->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->duracioncontrato->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_duracioncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_duracioncontrato" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_duracioncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->duracioncontrato->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
		<td data-name="documentocontra">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_documentocontra" class="form-group cs_contratacion_documentocontra">
<input type="text" data-table="cs_contratacion" data-field="x_documentocontra" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->documentocontra->EditValue ?>"<?php echo $cs_contratacion->documentocontra->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_documentocontra" class="form-group cs_contratacion_documentocontra">
<span<?php echo $cs_contratacion->documentocontra->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->documentocontra->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_documentocontra" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" value="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_documentocontra" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_documentocontra" value="<?php echo ew_HtmlEncode($cs_contratacion->documentocontra->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->regante->Visible) { // regante ?>
		<td data-name="regante">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_regante" class="form-group cs_contratacion_regante">
<input type="text" data-table="cs_contratacion" data-field="x_regante" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->regante->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->regante->EditValue ?>"<?php echo $cs_contratacion->regante->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_regante" class="form-group cs_contratacion_regante">
<span<?php echo $cs_contratacion->regante->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->regante->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_regante" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_regante" value="<?php echo ew_HtmlEncode($cs_contratacion->regante->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_regante" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_regante" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_regante" value="<?php echo ew_HtmlEncode($cs_contratacion->regante->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
		<td data-name="espeplanos">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_espeplanos" class="form-group cs_contratacion_espeplanos">
<input type="text" data-table="cs_contratacion" data-field="x_espeplanos" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->espeplanos->EditValue ?>"<?php echo $cs_contratacion->espeplanos->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_espeplanos" class="form-group cs_contratacion_espeplanos">
<span<?php echo $cs_contratacion->espeplanos->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->espeplanos->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_espeplanos" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" value="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_espeplanos" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_espeplanos" value="<?php echo ew_HtmlEncode($cs_contratacion->espeplanos->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_estado" class="form-group cs_contratacion_estado">
<input type="text" data-table="cs_contratacion" data-field="x_estado" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->estado->EditValue ?>"<?php echo $cs_contratacion->estado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_estado" class="form-group cs_contratacion_estado">
<span<?php echo $cs_contratacion->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_estado" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_contratacion->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_estado" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_contratacion->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->otro->Visible) { // otro ?>
		<td data-name="otro">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_otro" class="form-group cs_contratacion_otro">
<input type="text" data-table="cs_contratacion" data-field="x_otro" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->otro->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->otro->EditValue ?>"<?php echo $cs_contratacion->otro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_otro" class="form-group cs_contratacion_otro">
<span<?php echo $cs_contratacion->otro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->otro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_otro" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_contratacion->otro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_otro" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_otro" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_contratacion->otro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
		<td data-name="ncontrato">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_ncontrato" class="form-group cs_contratacion_ncontrato">
<input type="text" data-table="cs_contratacion" data-field="x_ncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->ncontrato->EditValue ?>"<?php echo $cs_contratacion->ncontrato->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_ncontrato" class="form-group cs_contratacion_ncontrato">
<span<?php echo $cs_contratacion->ncontrato->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->ncontrato->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_ncontrato" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_ncontrato" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_ncontrato" value="<?php echo ew_HtmlEncode($cs_contratacion->ncontrato->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_fecharecibido" class="form-group cs_contratacion_fecharecibido">
<input type="text" data-table="cs_contratacion" data-field="x_fecharecibido" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fecharecibido->EditValue ?>"<?php echo $cs_contratacion->fecharecibido->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_fecharecibido" class="form-group cs_contratacion_fecharecibido">
<span<?php echo $cs_contratacion->fecharecibido->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->fecharecibido->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fecharecibido" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_fecharecibido" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_contratacion->fecharecibido->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion">
<?php if ($cs_contratacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_contratacion_fechacreacion" class="form-group cs_contratacion_fechacreacion">
<input type="text" data-table="cs_contratacion" data-field="x_fechacreacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_contratacion->fechacreacion->EditValue ?>"<?php echo $cs_contratacion->fechacreacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_contratacion_fechacreacion" class="form-group cs_contratacion_fechacreacion">
<span<?php echo $cs_contratacion->fechacreacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_contratacion->fechacreacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechacreacion" name="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_contratacion" data-field="x_fechacreacion" name="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_contratacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_contratacion->fechacreacion->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_contratacion_grid->ListOptions->Render("body", "right", $cs_contratacion_grid->RowCnt);
?>
<script type="text/javascript">
fcs_contrataciongrid.UpdateOpts(<?php echo $cs_contratacion_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cs_contratacion->CurrentMode == "add" || $cs_contratacion->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cs_contratacion_grid->FormKeyCountName ?>" id="<?php echo $cs_contratacion_grid->FormKeyCountName ?>" value="<?php echo $cs_contratacion_grid->KeyCount ?>">
<?php echo $cs_contratacion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_contratacion->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cs_contratacion_grid->FormKeyCountName ?>" id="<?php echo $cs_contratacion_grid->FormKeyCountName ?>" value="<?php echo $cs_contratacion_grid->KeyCount ?>">
<?php echo $cs_contratacion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_contratacion->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcs_contrataciongrid">
</div>
<?php

// Close recordset
if ($cs_contratacion_grid->Recordset)
	$cs_contratacion_grid->Recordset->Close();
?>
<?php if ($cs_contratacion_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($cs_contratacion_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cs_contratacion_grid->TotalRecs == 0 && $cs_contratacion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_contratacion_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_contratacion->Export == "") { ?>
<script type="text/javascript">
fcs_contrataciongrid.Init();
</script>
<?php } ?>
<?php
$cs_contratacion_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$cs_contratacion_grid->Page_Terminate();
?>
