<?php include_once "cruge_userinfo.php" ?>
<?php

// Create page object
if (!isset($cs_adjudicacion_grid)) $cs_adjudicacion_grid = new ccs_adjudicacion_grid();

// Page init
$cs_adjudicacion_grid->Page_Init();

// Page main
$cs_adjudicacion_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_adjudicacion_grid->Page_Render();
?>
<?php if ($cs_adjudicacion->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcs_adjudicaciongrid = new ew_Form("fcs_adjudicaciongrid", "grid");
fcs_adjudicaciongrid.FormKeyCountName = '<?php echo $cs_adjudicacion_grid->FormKeyCountName ?>';

// Validate form
fcs_adjudicaciongrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_idCalificacion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_adjudicacion->idCalificacion->FldCaption(), $cs_adjudicacion->idCalificacion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idCalificacion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_adjudicacion->idCalificacion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_costoesti");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_adjudicacion->costoesti->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcs_adjudicaciongrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "idCalificacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "numproceso", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nconsulnac", false)) return false;
	if (ew_ValueChanged(fobj, infix, "nconsulinter", false)) return false;
	if (ew_ValueChanged(fobj, infix, "costoesti", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadoproceso", false)) return false;
	if (ew_ValueChanged(fobj, infix, "actaaper", false)) return false;
	if (ew_ValueChanged(fobj, infix, "informeacta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "resoladju", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "otro", false)) return false;
	if (ew_ValueChanged(fobj, infix, "numfirmasnac", false)) return false;
	if (ew_ValueChanged(fobj, infix, "numfimasinter", false)) return false;
	if (ew_ValueChanged(fobj, infix, "numconsulcorta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecharecibido", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechacreacion", false)) return false;
	return true;
}

// Form_CustomValidate event
fcs_adjudicaciongrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_adjudicaciongrid.ValidateRequired = true;
<?php } else { ?>
fcs_adjudicaciongrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($cs_adjudicacion->CurrentAction == "gridadd") {
	if ($cs_adjudicacion->CurrentMode == "copy") {
		$bSelectLimit = $cs_adjudicacion_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cs_adjudicacion_grid->TotalRecs = $cs_adjudicacion->SelectRecordCount();
			$cs_adjudicacion_grid->Recordset = $cs_adjudicacion_grid->LoadRecordset($cs_adjudicacion_grid->StartRec-1, $cs_adjudicacion_grid->DisplayRecs);
		} else {
			if ($cs_adjudicacion_grid->Recordset = $cs_adjudicacion_grid->LoadRecordset())
				$cs_adjudicacion_grid->TotalRecs = $cs_adjudicacion_grid->Recordset->RecordCount();
		}
		$cs_adjudicacion_grid->StartRec = 1;
		$cs_adjudicacion_grid->DisplayRecs = $cs_adjudicacion_grid->TotalRecs;
	} else {
		$cs_adjudicacion->CurrentFilter = "0=1";
		$cs_adjudicacion_grid->StartRec = 1;
		$cs_adjudicacion_grid->DisplayRecs = $cs_adjudicacion->GridAddRowCount;
	}
	$cs_adjudicacion_grid->TotalRecs = $cs_adjudicacion_grid->DisplayRecs;
	$cs_adjudicacion_grid->StopRec = $cs_adjudicacion_grid->DisplayRecs;
} else {
	$bSelectLimit = $cs_adjudicacion_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_adjudicacion_grid->TotalRecs <= 0)
			$cs_adjudicacion_grid->TotalRecs = $cs_adjudicacion->SelectRecordCount();
	} else {
		if (!$cs_adjudicacion_grid->Recordset && ($cs_adjudicacion_grid->Recordset = $cs_adjudicacion_grid->LoadRecordset()))
			$cs_adjudicacion_grid->TotalRecs = $cs_adjudicacion_grid->Recordset->RecordCount();
	}
	$cs_adjudicacion_grid->StartRec = 1;
	$cs_adjudicacion_grid->DisplayRecs = $cs_adjudicacion_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cs_adjudicacion_grid->Recordset = $cs_adjudicacion_grid->LoadRecordset($cs_adjudicacion_grid->StartRec-1, $cs_adjudicacion_grid->DisplayRecs);

	// Set no record found message
	if ($cs_adjudicacion->CurrentAction == "" && $cs_adjudicacion_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_adjudicacion_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_adjudicacion_grid->SearchWhere == "0=101")
			$cs_adjudicacion_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_adjudicacion_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cs_adjudicacion_grid->RenderOtherOptions();
?>
<?php $cs_adjudicacion_grid->ShowPageHeader(); ?>
<?php
$cs_adjudicacion_grid->ShowMessage();
?>
<?php if ($cs_adjudicacion_grid->TotalRecs > 0 || $cs_adjudicacion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<div id="fcs_adjudicaciongrid" class="ewForm form-inline">
<div id="gmp_cs_adjudicacion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_cs_adjudicaciongrid" class="table ewTable">
<?php echo $cs_adjudicacion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_adjudicacion_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_adjudicacion_grid->RenderListOptions();

// Render list options (header, left)
$cs_adjudicacion_grid->ListOptions->Render("header", "left");
?>
<?php if ($cs_adjudicacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->idAdjudicacion) == "") { ?>
		<th data-name="idAdjudicacion"><div id="elh_cs_adjudicacion_idAdjudicacion" class="cs_adjudicacion_idAdjudicacion"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->idAdjudicacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idAdjudicacion"><div><div id="elh_cs_adjudicacion_idAdjudicacion" class="cs_adjudicacion_idAdjudicacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->idAdjudicacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->idAdjudicacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->idAdjudicacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->idCalificacion->Visible) { // idCalificacion ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->idCalificacion) == "") { ?>
		<th data-name="idCalificacion"><div id="elh_cs_adjudicacion_idCalificacion" class="cs_adjudicacion_idCalificacion"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->idCalificacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idCalificacion"><div><div id="elh_cs_adjudicacion_idCalificacion" class="cs_adjudicacion_idCalificacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->idCalificacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->idCalificacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->idCalificacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->numproceso->Visible) { // numproceso ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->numproceso) == "") { ?>
		<th data-name="numproceso"><div id="elh_cs_adjudicacion_numproceso" class="cs_adjudicacion_numproceso"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numproceso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numproceso"><div><div id="elh_cs_adjudicacion_numproceso" class="cs_adjudicacion_numproceso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numproceso->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->numproceso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->numproceso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->nconsulnac->Visible) { // nconsulnac ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->nconsulnac) == "") { ?>
		<th data-name="nconsulnac"><div id="elh_cs_adjudicacion_nconsulnac" class="cs_adjudicacion_nconsulnac"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->nconsulnac->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nconsulnac"><div><div id="elh_cs_adjudicacion_nconsulnac" class="cs_adjudicacion_nconsulnac">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->nconsulnac->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->nconsulnac->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->nconsulnac->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->nconsulinter->Visible) { // nconsulinter ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->nconsulinter) == "") { ?>
		<th data-name="nconsulinter"><div id="elh_cs_adjudicacion_nconsulinter" class="cs_adjudicacion_nconsulinter"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->nconsulinter->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nconsulinter"><div><div id="elh_cs_adjudicacion_nconsulinter" class="cs_adjudicacion_nconsulinter">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->nconsulinter->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->nconsulinter->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->nconsulinter->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->costoesti->Visible) { // costoesti ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->costoesti) == "") { ?>
		<th data-name="costoesti"><div id="elh_cs_adjudicacion_costoesti" class="cs_adjudicacion_costoesti"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->costoesti->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="costoesti"><div><div id="elh_cs_adjudicacion_costoesti" class="cs_adjudicacion_costoesti">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->costoesti->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->costoesti->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->costoesti->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->estadoproceso->Visible) { // estadoproceso ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->estadoproceso) == "") { ?>
		<th data-name="estadoproceso"><div id="elh_cs_adjudicacion_estadoproceso" class="cs_adjudicacion_estadoproceso"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->estadoproceso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadoproceso"><div><div id="elh_cs_adjudicacion_estadoproceso" class="cs_adjudicacion_estadoproceso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->estadoproceso->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->estadoproceso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->estadoproceso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->actaaper->Visible) { // actaaper ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->actaaper) == "") { ?>
		<th data-name="actaaper"><div id="elh_cs_adjudicacion_actaaper" class="cs_adjudicacion_actaaper"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->actaaper->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="actaaper"><div><div id="elh_cs_adjudicacion_actaaper" class="cs_adjudicacion_actaaper">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->actaaper->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->actaaper->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->actaaper->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->informeacta->Visible) { // informeacta ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->informeacta) == "") { ?>
		<th data-name="informeacta"><div id="elh_cs_adjudicacion_informeacta" class="cs_adjudicacion_informeacta"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->informeacta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="informeacta"><div><div id="elh_cs_adjudicacion_informeacta" class="cs_adjudicacion_informeacta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->informeacta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->informeacta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->informeacta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->resoladju->Visible) { // resoladju ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->resoladju) == "") { ?>
		<th data-name="resoladju"><div id="elh_cs_adjudicacion_resoladju" class="cs_adjudicacion_resoladju"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->resoladju->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="resoladju"><div><div id="elh_cs_adjudicacion_resoladju" class="cs_adjudicacion_resoladju">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->resoladju->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->resoladju->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->resoladju->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->estado->Visible) { // estado ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_adjudicacion_estado" class="cs_adjudicacion_estado"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div><div id="elh_cs_adjudicacion_estado" class="cs_adjudicacion_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->otro->Visible) { // otro ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->otro) == "") { ?>
		<th data-name="otro"><div id="elh_cs_adjudicacion_otro" class="cs_adjudicacion_otro"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->otro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro"><div><div id="elh_cs_adjudicacion_otro" class="cs_adjudicacion_otro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->otro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->otro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->otro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->numfirmasnac->Visible) { // numfirmasnac ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->numfirmasnac) == "") { ?>
		<th data-name="numfirmasnac"><div id="elh_cs_adjudicacion_numfirmasnac" class="cs_adjudicacion_numfirmasnac"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numfirmasnac->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numfirmasnac"><div><div id="elh_cs_adjudicacion_numfirmasnac" class="cs_adjudicacion_numfirmasnac">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numfirmasnac->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->numfirmasnac->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->numfirmasnac->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->numfimasinter->Visible) { // numfimasinter ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->numfimasinter) == "") { ?>
		<th data-name="numfimasinter"><div id="elh_cs_adjudicacion_numfimasinter" class="cs_adjudicacion_numfimasinter"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numfimasinter->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numfimasinter"><div><div id="elh_cs_adjudicacion_numfimasinter" class="cs_adjudicacion_numfimasinter">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numfimasinter->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->numfimasinter->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->numfimasinter->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->numconsulcorta->Visible) { // numconsulcorta ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->numconsulcorta) == "") { ?>
		<th data-name="numconsulcorta"><div id="elh_cs_adjudicacion_numconsulcorta" class="cs_adjudicacion_numconsulcorta"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numconsulcorta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numconsulcorta"><div><div id="elh_cs_adjudicacion_numconsulcorta" class="cs_adjudicacion_numconsulcorta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->numconsulcorta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->numconsulcorta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->numconsulcorta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_adjudicacion_fecharecibido" class="cs_adjudicacion_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div><div id="elh_cs_adjudicacion_fecharecibido" class="cs_adjudicacion_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->fecharecibido->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_adjudicacion->fechacreacion->Visible) { // fechacreacion ?>
	<?php if ($cs_adjudicacion->SortUrl($cs_adjudicacion->fechacreacion) == "") { ?>
		<th data-name="fechacreacion"><div id="elh_cs_adjudicacion_fechacreacion" class="cs_adjudicacion_fechacreacion"><div class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->fechacreacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechacreacion"><div><div id="elh_cs_adjudicacion_fechacreacion" class="cs_adjudicacion_fechacreacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_adjudicacion->fechacreacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_adjudicacion->fechacreacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_adjudicacion->fechacreacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_adjudicacion_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cs_adjudicacion_grid->StartRec = 1;
$cs_adjudicacion_grid->StopRec = $cs_adjudicacion_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cs_adjudicacion_grid->FormKeyCountName) && ($cs_adjudicacion->CurrentAction == "gridadd" || $cs_adjudicacion->CurrentAction == "gridedit" || $cs_adjudicacion->CurrentAction == "F")) {
		$cs_adjudicacion_grid->KeyCount = $objForm->GetValue($cs_adjudicacion_grid->FormKeyCountName);
		$cs_adjudicacion_grid->StopRec = $cs_adjudicacion_grid->StartRec + $cs_adjudicacion_grid->KeyCount - 1;
	}
}
$cs_adjudicacion_grid->RecCnt = $cs_adjudicacion_grid->StartRec - 1;
if ($cs_adjudicacion_grid->Recordset && !$cs_adjudicacion_grid->Recordset->EOF) {
	$cs_adjudicacion_grid->Recordset->MoveFirst();
	$bSelectLimit = $cs_adjudicacion_grid->UseSelectLimit;
	if (!$bSelectLimit && $cs_adjudicacion_grid->StartRec > 1)
		$cs_adjudicacion_grid->Recordset->Move($cs_adjudicacion_grid->StartRec - 1);
} elseif (!$cs_adjudicacion->AllowAddDeleteRow && $cs_adjudicacion_grid->StopRec == 0) {
	$cs_adjudicacion_grid->StopRec = $cs_adjudicacion->GridAddRowCount;
}

// Initialize aggregate
$cs_adjudicacion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_adjudicacion->ResetAttrs();
$cs_adjudicacion_grid->RenderRow();
if ($cs_adjudicacion->CurrentAction == "gridadd")
	$cs_adjudicacion_grid->RowIndex = 0;
if ($cs_adjudicacion->CurrentAction == "gridedit")
	$cs_adjudicacion_grid->RowIndex = 0;
while ($cs_adjudicacion_grid->RecCnt < $cs_adjudicacion_grid->StopRec) {
	$cs_adjudicacion_grid->RecCnt++;
	if (intval($cs_adjudicacion_grid->RecCnt) >= intval($cs_adjudicacion_grid->StartRec)) {
		$cs_adjudicacion_grid->RowCnt++;
		if ($cs_adjudicacion->CurrentAction == "gridadd" || $cs_adjudicacion->CurrentAction == "gridedit" || $cs_adjudicacion->CurrentAction == "F") {
			$cs_adjudicacion_grid->RowIndex++;
			$objForm->Index = $cs_adjudicacion_grid->RowIndex;
			if ($objForm->HasValue($cs_adjudicacion_grid->FormActionName))
				$cs_adjudicacion_grid->RowAction = strval($objForm->GetValue($cs_adjudicacion_grid->FormActionName));
			elseif ($cs_adjudicacion->CurrentAction == "gridadd")
				$cs_adjudicacion_grid->RowAction = "insert";
			else
				$cs_adjudicacion_grid->RowAction = "";
		}

		// Set up key count
		$cs_adjudicacion_grid->KeyCount = $cs_adjudicacion_grid->RowIndex;

		// Init row class and style
		$cs_adjudicacion->ResetAttrs();
		$cs_adjudicacion->CssClass = "";
		if ($cs_adjudicacion->CurrentAction == "gridadd") {
			if ($cs_adjudicacion->CurrentMode == "copy") {
				$cs_adjudicacion_grid->LoadRowValues($cs_adjudicacion_grid->Recordset); // Load row values
				$cs_adjudicacion_grid->SetRecordKey($cs_adjudicacion_grid->RowOldKey, $cs_adjudicacion_grid->Recordset); // Set old record key
			} else {
				$cs_adjudicacion_grid->LoadDefaultValues(); // Load default values
				$cs_adjudicacion_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cs_adjudicacion_grid->LoadRowValues($cs_adjudicacion_grid->Recordset); // Load row values
		}
		$cs_adjudicacion->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cs_adjudicacion->CurrentAction == "gridadd") // Grid add
			$cs_adjudicacion->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cs_adjudicacion->CurrentAction == "gridadd" && $cs_adjudicacion->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cs_adjudicacion_grid->RestoreCurrentRowFormValues($cs_adjudicacion_grid->RowIndex); // Restore form values
		if ($cs_adjudicacion->CurrentAction == "gridedit") { // Grid edit
			if ($cs_adjudicacion->EventCancelled) {
				$cs_adjudicacion_grid->RestoreCurrentRowFormValues($cs_adjudicacion_grid->RowIndex); // Restore form values
			}
			if ($cs_adjudicacion_grid->RowAction == "insert")
				$cs_adjudicacion->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cs_adjudicacion->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cs_adjudicacion->CurrentAction == "gridedit" && ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT || $cs_adjudicacion->RowType == EW_ROWTYPE_ADD) && $cs_adjudicacion->EventCancelled) // Update failed
			$cs_adjudicacion_grid->RestoreCurrentRowFormValues($cs_adjudicacion_grid->RowIndex); // Restore form values
		if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cs_adjudicacion_grid->EditRowCnt++;
		if ($cs_adjudicacion->CurrentAction == "F") // Confirm row
			$cs_adjudicacion_grid->RestoreCurrentRowFormValues($cs_adjudicacion_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cs_adjudicacion->RowAttrs = array_merge($cs_adjudicacion->RowAttrs, array('data-rowindex'=>$cs_adjudicacion_grid->RowCnt, 'id'=>'r' . $cs_adjudicacion_grid->RowCnt . '_cs_adjudicacion', 'data-rowtype'=>$cs_adjudicacion->RowType));

		// Render row
		$cs_adjudicacion_grid->RenderRow();

		// Render list options
		$cs_adjudicacion_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cs_adjudicacion_grid->RowAction <> "delete" && $cs_adjudicacion_grid->RowAction <> "insertdelete" && !($cs_adjudicacion_grid->RowAction == "insert" && $cs_adjudicacion->CurrentAction == "F" && $cs_adjudicacion_grid->EmptyRow())) {
?>
	<tr<?php echo $cs_adjudicacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_adjudicacion_grid->ListOptions->Render("body", "left", $cs_adjudicacion_grid->RowCnt);
?>
	<?php if ($cs_adjudicacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<td data-name="idAdjudicacion"<?php echo $cs_adjudicacion->idAdjudicacion->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idAdjudicacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idAdjudicacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idAdjudicacion" class="form-group cs_adjudicacion_idAdjudicacion">
<span<?php echo $cs_adjudicacion->idAdjudicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->idAdjudicacion->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idAdjudicacion->CurrentValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idAdjudicacion" class="cs_adjudicacion_idAdjudicacion">
<span<?php echo $cs_adjudicacion->idAdjudicacion->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->idAdjudicacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idAdjudicacion->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idAdjudicacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idAdjudicacion->OldValue) ?>">
<?php } ?>
<a id="<?php echo $cs_adjudicacion_grid->PageObjName . "_row_" . $cs_adjudicacion_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_adjudicacion->idCalificacion->Visible) { // idCalificacion ?>
		<td data-name="idCalificacion"<?php echo $cs_adjudicacion->idCalificacion->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cs_adjudicacion->idCalificacion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<span<?php echo $cs_adjudicacion->idCalificacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->idCalificacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<input type="text" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->idCalificacion->EditValue ?>"<?php echo $cs_adjudicacion->idCalificacion->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cs_adjudicacion->idCalificacion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<span<?php echo $cs_adjudicacion->idCalificacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->idCalificacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<input type="text" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->idCalificacion->EditValue ?>"<?php echo $cs_adjudicacion->idCalificacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_idCalificacion" class="cs_adjudicacion_idCalificacion">
<span<?php echo $cs_adjudicacion->idCalificacion->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->idCalificacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numproceso->Visible) { // numproceso ?>
		<td data-name="numproceso"<?php echo $cs_adjudicacion->numproceso->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numproceso" class="form-group cs_adjudicacion_numproceso">
<input type="text" data-table="cs_adjudicacion" data-field="x_numproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" size="30" maxlength="60" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numproceso->EditValue ?>"<?php echo $cs_adjudicacion->numproceso->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numproceso" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numproceso" class="form-group cs_adjudicacion_numproceso">
<input type="text" data-table="cs_adjudicacion" data-field="x_numproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" size="30" maxlength="60" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numproceso->EditValue ?>"<?php echo $cs_adjudicacion->numproceso->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numproceso" class="cs_adjudicacion_numproceso">
<span<?php echo $cs_adjudicacion->numproceso->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numproceso->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numproceso" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->nconsulnac->Visible) { // nconsulnac ?>
		<td data-name="nconsulnac"<?php echo $cs_adjudicacion->nconsulnac->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_nconsulnac" class="form-group cs_adjudicacion_nconsulnac">
<input type="text" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->nconsulnac->EditValue ?>"<?php echo $cs_adjudicacion->nconsulnac->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_nconsulnac" class="form-group cs_adjudicacion_nconsulnac">
<input type="text" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->nconsulnac->EditValue ?>"<?php echo $cs_adjudicacion->nconsulnac->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_nconsulnac" class="cs_adjudicacion_nconsulnac">
<span<?php echo $cs_adjudicacion->nconsulnac->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->nconsulnac->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->nconsulinter->Visible) { // nconsulinter ?>
		<td data-name="nconsulinter"<?php echo $cs_adjudicacion->nconsulinter->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_nconsulinter" class="form-group cs_adjudicacion_nconsulinter">
<input type="text" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->nconsulinter->EditValue ?>"<?php echo $cs_adjudicacion->nconsulinter->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_nconsulinter" class="form-group cs_adjudicacion_nconsulinter">
<input type="text" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->nconsulinter->EditValue ?>"<?php echo $cs_adjudicacion->nconsulinter->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_nconsulinter" class="cs_adjudicacion_nconsulinter">
<span<?php echo $cs_adjudicacion->nconsulinter->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->nconsulinter->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->costoesti->Visible) { // costoesti ?>
		<td data-name="costoesti"<?php echo $cs_adjudicacion->costoesti->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_costoesti" class="form-group cs_adjudicacion_costoesti">
<input type="text" data-table="cs_adjudicacion" data-field="x_costoesti" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" size="30" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->costoesti->EditValue ?>"<?php echo $cs_adjudicacion->costoesti->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_costoesti" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" value="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_costoesti" class="form-group cs_adjudicacion_costoesti">
<input type="text" data-table="cs_adjudicacion" data-field="x_costoesti" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" size="30" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->costoesti->EditValue ?>"<?php echo $cs_adjudicacion->costoesti->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_costoesti" class="cs_adjudicacion_costoesti">
<span<?php echo $cs_adjudicacion->costoesti->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->costoesti->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_costoesti" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" value="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_costoesti" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" value="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->estadoproceso->Visible) { // estadoproceso ?>
		<td data-name="estadoproceso"<?php echo $cs_adjudicacion->estadoproceso->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_estadoproceso" class="form-group cs_adjudicacion_estadoproceso">
<input type="text" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->estadoproceso->EditValue ?>"<?php echo $cs_adjudicacion->estadoproceso->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_estadoproceso" class="form-group cs_adjudicacion_estadoproceso">
<input type="text" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->estadoproceso->EditValue ?>"<?php echo $cs_adjudicacion->estadoproceso->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_estadoproceso" class="cs_adjudicacion_estadoproceso">
<span<?php echo $cs_adjudicacion->estadoproceso->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->estadoproceso->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->actaaper->Visible) { // actaaper ?>
		<td data-name="actaaper"<?php echo $cs_adjudicacion->actaaper->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_actaaper" class="form-group cs_adjudicacion_actaaper">
<input type="text" data-table="cs_adjudicacion" data-field="x_actaaper" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->actaaper->EditValue ?>"<?php echo $cs_adjudicacion->actaaper->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_actaaper" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" value="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_actaaper" class="form-group cs_adjudicacion_actaaper">
<input type="text" data-table="cs_adjudicacion" data-field="x_actaaper" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->actaaper->EditValue ?>"<?php echo $cs_adjudicacion->actaaper->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_actaaper" class="cs_adjudicacion_actaaper">
<span<?php echo $cs_adjudicacion->actaaper->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->actaaper->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_actaaper" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" value="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_actaaper" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" value="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->informeacta->Visible) { // informeacta ?>
		<td data-name="informeacta"<?php echo $cs_adjudicacion->informeacta->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_informeacta" class="form-group cs_adjudicacion_informeacta">
<input type="text" data-table="cs_adjudicacion" data-field="x_informeacta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->informeacta->EditValue ?>"<?php echo $cs_adjudicacion->informeacta->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_informeacta" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_informeacta" class="form-group cs_adjudicacion_informeacta">
<input type="text" data-table="cs_adjudicacion" data-field="x_informeacta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->informeacta->EditValue ?>"<?php echo $cs_adjudicacion->informeacta->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_informeacta" class="cs_adjudicacion_informeacta">
<span<?php echo $cs_adjudicacion->informeacta->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->informeacta->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_informeacta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_informeacta" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->resoladju->Visible) { // resoladju ?>
		<td data-name="resoladju"<?php echo $cs_adjudicacion->resoladju->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_resoladju" class="form-group cs_adjudicacion_resoladju">
<input type="text" data-table="cs_adjudicacion" data-field="x_resoladju" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->resoladju->EditValue ?>"<?php echo $cs_adjudicacion->resoladju->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_resoladju" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" value="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_resoladju" class="form-group cs_adjudicacion_resoladju">
<input type="text" data-table="cs_adjudicacion" data-field="x_resoladju" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->resoladju->EditValue ?>"<?php echo $cs_adjudicacion->resoladju->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_resoladju" class="cs_adjudicacion_resoladju">
<span<?php echo $cs_adjudicacion->resoladju->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->resoladju->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_resoladju" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" value="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_resoladju" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" value="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_adjudicacion->estado->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_estado" class="form-group cs_adjudicacion_estado">
<input type="text" data-table="cs_adjudicacion" data-field="x_estado" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->estado->EditValue ?>"<?php echo $cs_adjudicacion->estado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estado" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_estado" class="form-group cs_adjudicacion_estado">
<input type="text" data-table="cs_adjudicacion" data-field="x_estado" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->estado->EditValue ?>"<?php echo $cs_adjudicacion->estado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_estado" class="cs_adjudicacion_estado">
<span<?php echo $cs_adjudicacion->estado->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->estado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estado" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estado" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->otro->Visible) { // otro ?>
		<td data-name="otro"<?php echo $cs_adjudicacion->otro->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_otro" class="form-group cs_adjudicacion_otro">
<input type="text" data-table="cs_adjudicacion" data-field="x_otro" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->otro->EditValue ?>"<?php echo $cs_adjudicacion->otro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_otro" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_otro" class="form-group cs_adjudicacion_otro">
<input type="text" data-table="cs_adjudicacion" data-field="x_otro" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->otro->EditValue ?>"<?php echo $cs_adjudicacion->otro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_otro" class="cs_adjudicacion_otro">
<span<?php echo $cs_adjudicacion->otro->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->otro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_otro" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_otro" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numfirmasnac->Visible) { // numfirmasnac ?>
		<td data-name="numfirmasnac"<?php echo $cs_adjudicacion->numfirmasnac->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numfirmasnac" class="form-group cs_adjudicacion_numfirmasnac">
<input type="text" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numfirmasnac->EditValue ?>"<?php echo $cs_adjudicacion->numfirmasnac->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numfirmasnac" class="form-group cs_adjudicacion_numfirmasnac">
<input type="text" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numfirmasnac->EditValue ?>"<?php echo $cs_adjudicacion->numfirmasnac->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numfirmasnac" class="cs_adjudicacion_numfirmasnac">
<span<?php echo $cs_adjudicacion->numfirmasnac->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numfirmasnac->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numfimasinter->Visible) { // numfimasinter ?>
		<td data-name="numfimasinter"<?php echo $cs_adjudicacion->numfimasinter->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numfimasinter" class="form-group cs_adjudicacion_numfimasinter">
<input type="text" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numfimasinter->EditValue ?>"<?php echo $cs_adjudicacion->numfimasinter->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numfimasinter" class="form-group cs_adjudicacion_numfimasinter">
<input type="text" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numfimasinter->EditValue ?>"<?php echo $cs_adjudicacion->numfimasinter->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numfimasinter" class="cs_adjudicacion_numfimasinter">
<span<?php echo $cs_adjudicacion->numfimasinter->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numfimasinter->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numconsulcorta->Visible) { // numconsulcorta ?>
		<td data-name="numconsulcorta"<?php echo $cs_adjudicacion->numconsulcorta->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numconsulcorta" class="form-group cs_adjudicacion_numconsulcorta">
<input type="text" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numconsulcorta->EditValue ?>"<?php echo $cs_adjudicacion->numconsulcorta->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numconsulcorta" class="form-group cs_adjudicacion_numconsulcorta">
<input type="text" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numconsulcorta->EditValue ?>"<?php echo $cs_adjudicacion->numconsulcorta->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_numconsulcorta" class="cs_adjudicacion_numconsulcorta">
<span<?php echo $cs_adjudicacion->numconsulcorta->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->numconsulcorta->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_adjudicacion->fecharecibido->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_fecharecibido" class="form-group cs_adjudicacion_fecharecibido">
<input type="text" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->fecharecibido->EditValue ?>"<?php echo $cs_adjudicacion->fecharecibido->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_fecharecibido" class="form-group cs_adjudicacion_fecharecibido">
<input type="text" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->fecharecibido->EditValue ?>"<?php echo $cs_adjudicacion->fecharecibido->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_fecharecibido" class="cs_adjudicacion_fecharecibido">
<span<?php echo $cs_adjudicacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->fecharecibido->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion"<?php echo $cs_adjudicacion->fechacreacion->CellAttributes() ?>>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_fechacreacion" class="form-group cs_adjudicacion_fechacreacion">
<input type="text" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->fechacreacion->EditValue ?>"<?php echo $cs_adjudicacion->fechacreacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_fechacreacion" class="form-group cs_adjudicacion_fechacreacion">
<input type="text" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->fechacreacion->EditValue ?>"<?php echo $cs_adjudicacion->fechacreacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_adjudicacion_grid->RowCnt ?>_cs_adjudicacion_fechacreacion" class="cs_adjudicacion_fechacreacion">
<span<?php echo $cs_adjudicacion->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_adjudicacion->fechacreacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->FormValue) ?>">
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_adjudicacion_grid->ListOptions->Render("body", "right", $cs_adjudicacion_grid->RowCnt);
?>
	</tr>
<?php if ($cs_adjudicacion->RowType == EW_ROWTYPE_ADD || $cs_adjudicacion->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcs_adjudicaciongrid.UpdateOpts(<?php echo $cs_adjudicacion_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cs_adjudicacion->CurrentAction <> "gridadd" || $cs_adjudicacion->CurrentMode == "copy")
		if (!$cs_adjudicacion_grid->Recordset->EOF) $cs_adjudicacion_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cs_adjudicacion->CurrentMode == "add" || $cs_adjudicacion->CurrentMode == "copy" || $cs_adjudicacion->CurrentMode == "edit") {
		$cs_adjudicacion_grid->RowIndex = '$rowindex$';
		$cs_adjudicacion_grid->LoadDefaultValues();

		// Set row properties
		$cs_adjudicacion->ResetAttrs();
		$cs_adjudicacion->RowAttrs = array_merge($cs_adjudicacion->RowAttrs, array('data-rowindex'=>$cs_adjudicacion_grid->RowIndex, 'id'=>'r0_cs_adjudicacion', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cs_adjudicacion->RowAttrs["class"], "ewTemplate");
		$cs_adjudicacion->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cs_adjudicacion_grid->RenderRow();

		// Render list options
		$cs_adjudicacion_grid->RenderListOptions();
		$cs_adjudicacion_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cs_adjudicacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_adjudicacion_grid->ListOptions->Render("body", "left", $cs_adjudicacion_grid->RowIndex);
?>
	<?php if ($cs_adjudicacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<td data-name="idAdjudicacion">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_idAdjudicacion" class="form-group cs_adjudicacion_idAdjudicacion">
<span<?php echo $cs_adjudicacion->idAdjudicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->idAdjudicacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idAdjudicacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idAdjudicacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idAdjudicacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idAdjudicacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idAdjudicacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->idCalificacion->Visible) { // idCalificacion ?>
		<td data-name="idCalificacion">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<?php if ($cs_adjudicacion->idCalificacion->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<span<?php echo $cs_adjudicacion->idCalificacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->idCalificacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<input type="text" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->idCalificacion->EditValue ?>"<?php echo $cs_adjudicacion->idCalificacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_idCalificacion" class="form-group cs_adjudicacion_idCalificacion">
<span<?php echo $cs_adjudicacion->idCalificacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->idCalificacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_idCalificacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_idCalificacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->idCalificacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numproceso->Visible) { // numproceso ?>
		<td data-name="numproceso">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_numproceso" class="form-group cs_adjudicacion_numproceso">
<input type="text" data-table="cs_adjudicacion" data-field="x_numproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" size="30" maxlength="60" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numproceso->EditValue ?>"<?php echo $cs_adjudicacion->numproceso->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_numproceso" class="form-group cs_adjudicacion_numproceso">
<span<?php echo $cs_adjudicacion->numproceso->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->numproceso->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numproceso" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numproceso->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->nconsulnac->Visible) { // nconsulnac ?>
		<td data-name="nconsulnac">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_nconsulnac" class="form-group cs_adjudicacion_nconsulnac">
<input type="text" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->nconsulnac->EditValue ?>"<?php echo $cs_adjudicacion->nconsulnac->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_nconsulnac" class="form-group cs_adjudicacion_nconsulnac">
<span<?php echo $cs_adjudicacion->nconsulnac->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->nconsulnac->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulnac" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulnac->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->nconsulinter->Visible) { // nconsulinter ?>
		<td data-name="nconsulinter">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_nconsulinter" class="form-group cs_adjudicacion_nconsulinter">
<input type="text" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->nconsulinter->EditValue ?>"<?php echo $cs_adjudicacion->nconsulinter->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_nconsulinter" class="form-group cs_adjudicacion_nconsulinter">
<span<?php echo $cs_adjudicacion->nconsulinter->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->nconsulinter->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_nconsulinter" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_nconsulinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->nconsulinter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->costoesti->Visible) { // costoesti ?>
		<td data-name="costoesti">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_costoesti" class="form-group cs_adjudicacion_costoesti">
<input type="text" data-table="cs_adjudicacion" data-field="x_costoesti" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" size="30" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->costoesti->EditValue ?>"<?php echo $cs_adjudicacion->costoesti->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_costoesti" class="form-group cs_adjudicacion_costoesti">
<span<?php echo $cs_adjudicacion->costoesti->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->costoesti->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_costoesti" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" value="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_costoesti" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_costoesti" value="<?php echo ew_HtmlEncode($cs_adjudicacion->costoesti->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->estadoproceso->Visible) { // estadoproceso ?>
		<td data-name="estadoproceso">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_estadoproceso" class="form-group cs_adjudicacion_estadoproceso">
<input type="text" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->estadoproceso->EditValue ?>"<?php echo $cs_adjudicacion->estadoproceso->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_estadoproceso" class="form-group cs_adjudicacion_estadoproceso">
<span<?php echo $cs_adjudicacion->estadoproceso->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->estadoproceso->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estadoproceso" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estadoproceso" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estadoproceso->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->actaaper->Visible) { // actaaper ?>
		<td data-name="actaaper">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_actaaper" class="form-group cs_adjudicacion_actaaper">
<input type="text" data-table="cs_adjudicacion" data-field="x_actaaper" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" size="30" maxlength="250" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->actaaper->EditValue ?>"<?php echo $cs_adjudicacion->actaaper->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_actaaper" class="form-group cs_adjudicacion_actaaper">
<span<?php echo $cs_adjudicacion->actaaper->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->actaaper->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_actaaper" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" value="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_actaaper" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_actaaper" value="<?php echo ew_HtmlEncode($cs_adjudicacion->actaaper->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->informeacta->Visible) { // informeacta ?>
		<td data-name="informeacta">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_informeacta" class="form-group cs_adjudicacion_informeacta">
<input type="text" data-table="cs_adjudicacion" data-field="x_informeacta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->informeacta->EditValue ?>"<?php echo $cs_adjudicacion->informeacta->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_informeacta" class="form-group cs_adjudicacion_informeacta">
<span<?php echo $cs_adjudicacion->informeacta->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->informeacta->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_informeacta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_informeacta" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_informeacta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->informeacta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->resoladju->Visible) { // resoladju ?>
		<td data-name="resoladju">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_resoladju" class="form-group cs_adjudicacion_resoladju">
<input type="text" data-table="cs_adjudicacion" data-field="x_resoladju" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->resoladju->EditValue ?>"<?php echo $cs_adjudicacion->resoladju->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_resoladju" class="form-group cs_adjudicacion_resoladju">
<span<?php echo $cs_adjudicacion->resoladju->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->resoladju->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_resoladju" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" value="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_resoladju" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_resoladju" value="<?php echo ew_HtmlEncode($cs_adjudicacion->resoladju->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_estado" class="form-group cs_adjudicacion_estado">
<input type="text" data-table="cs_adjudicacion" data-field="x_estado" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->estado->EditValue ?>"<?php echo $cs_adjudicacion->estado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_estado" class="form-group cs_adjudicacion_estado">
<span<?php echo $cs_adjudicacion->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estado" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_estado" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_adjudicacion->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->otro->Visible) { // otro ?>
		<td data-name="otro">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_otro" class="form-group cs_adjudicacion_otro">
<input type="text" data-table="cs_adjudicacion" data-field="x_otro" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->otro->EditValue ?>"<?php echo $cs_adjudicacion->otro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_otro" class="form-group cs_adjudicacion_otro">
<span<?php echo $cs_adjudicacion->otro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->otro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_otro" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_otro" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_adjudicacion->otro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numfirmasnac->Visible) { // numfirmasnac ?>
		<td data-name="numfirmasnac">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_numfirmasnac" class="form-group cs_adjudicacion_numfirmasnac">
<input type="text" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numfirmasnac->EditValue ?>"<?php echo $cs_adjudicacion->numfirmasnac->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_numfirmasnac" class="form-group cs_adjudicacion_numfirmasnac">
<span<?php echo $cs_adjudicacion->numfirmasnac->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->numfirmasnac->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfirmasnac" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfirmasnac" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfirmasnac->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numfimasinter->Visible) { // numfimasinter ?>
		<td data-name="numfimasinter">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_numfimasinter" class="form-group cs_adjudicacion_numfimasinter">
<input type="text" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numfimasinter->EditValue ?>"<?php echo $cs_adjudicacion->numfimasinter->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_numfimasinter" class="form-group cs_adjudicacion_numfimasinter">
<span<?php echo $cs_adjudicacion->numfimasinter->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->numfimasinter->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numfimasinter" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numfimasinter" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numfimasinter->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->numconsulcorta->Visible) { // numconsulcorta ?>
		<td data-name="numconsulcorta">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_numconsulcorta" class="form-group cs_adjudicacion_numconsulcorta">
<input type="text" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->numconsulcorta->EditValue ?>"<?php echo $cs_adjudicacion->numconsulcorta->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_numconsulcorta" class="form-group cs_adjudicacion_numconsulcorta">
<span<?php echo $cs_adjudicacion->numconsulcorta->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->numconsulcorta->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_numconsulcorta" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_numconsulcorta" value="<?php echo ew_HtmlEncode($cs_adjudicacion->numconsulcorta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_fecharecibido" class="form-group cs_adjudicacion_fecharecibido">
<input type="text" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->fecharecibido->EditValue ?>"<?php echo $cs_adjudicacion->fecharecibido->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_fecharecibido" class="form-group cs_adjudicacion_fecharecibido">
<span<?php echo $cs_adjudicacion->fecharecibido->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->fecharecibido->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fecharecibido" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fecharecibido->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_adjudicacion->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion">
<?php if ($cs_adjudicacion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_adjudicacion_fechacreacion" class="form-group cs_adjudicacion_fechacreacion">
<input type="text" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_adjudicacion->fechacreacion->EditValue ?>"<?php echo $cs_adjudicacion->fechacreacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_adjudicacion_fechacreacion" class="form-group cs_adjudicacion_fechacreacion">
<span<?php echo $cs_adjudicacion->fechacreacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_adjudicacion->fechacreacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_adjudicacion" data-field="x_fechacreacion" name="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_adjudicacion_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_adjudicacion->fechacreacion->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_adjudicacion_grid->ListOptions->Render("body", "right", $cs_adjudicacion_grid->RowCnt);
?>
<script type="text/javascript">
fcs_adjudicaciongrid.UpdateOpts(<?php echo $cs_adjudicacion_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cs_adjudicacion->CurrentMode == "add" || $cs_adjudicacion->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cs_adjudicacion_grid->FormKeyCountName ?>" id="<?php echo $cs_adjudicacion_grid->FormKeyCountName ?>" value="<?php echo $cs_adjudicacion_grid->KeyCount ?>">
<?php echo $cs_adjudicacion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_adjudicacion->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cs_adjudicacion_grid->FormKeyCountName ?>" id="<?php echo $cs_adjudicacion_grid->FormKeyCountName ?>" value="<?php echo $cs_adjudicacion_grid->KeyCount ?>">
<?php echo $cs_adjudicacion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_adjudicacion->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcs_adjudicaciongrid">
</div>
<?php

// Close recordset
if ($cs_adjudicacion_grid->Recordset)
	$cs_adjudicacion_grid->Recordset->Close();
?>
<?php if ($cs_adjudicacion_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($cs_adjudicacion_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cs_adjudicacion_grid->TotalRecs == 0 && $cs_adjudicacion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_adjudicacion_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_adjudicacion->Export == "") { ?>
<script type="text/javascript">
fcs_adjudicaciongrid.Init();
</script>
<?php } ?>
<?php
$cs_adjudicacion_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$cs_adjudicacion_grid->Page_Terminate();
?>
