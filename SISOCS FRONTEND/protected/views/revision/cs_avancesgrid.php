<?php include_once "cruge_userinfo.php" ?>
<?php

// Create page object
if (!isset($cs_avances_grid)) $cs_avances_grid = new ccs_avances_grid();

// Page init
$cs_avances_grid->Page_Init();

// Page main
$cs_avances_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_avances_grid->Page_Render();
?>
<?php if ($cs_avances->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcs_avancesgrid = new ew_Form("fcs_avancesgrid", "grid");
fcs_avancesgrid.FormKeyCountName = '<?php echo $cs_avances_grid->FormKeyCountName ?>';

// Validate form
fcs_avancesgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_codigo_inicio_ejecucion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->codigo_inicio_ejecucion->FldCaption(), $cs_avances->codigo_inicio_ejecucion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_codigo_inicio_ejecucion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->codigo_inicio_ejecucion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_porcent_programado");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->porcent_programado->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_porcent_real");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->porcent_real->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_finan_programado");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->finan_programado->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_finan_real");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->finan_real->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_registro");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->fecha_registro->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_user_registro");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->user_registro->FldCaption(), $cs_avances->user_registro->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idEjecucion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->idEjecucion->FldCaption(), $cs_avances->idEjecucion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idEjecucion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->idEjecucion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avance");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->fecha_avance->FldCaption(), $cs_avances->fecha_avance->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avance");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->fecha_avance->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idContratacion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->idContratacion->FldCaption(), $cs_avances->idContratacion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idContratacion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_avances->idContratacion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_estado_sol");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->estado_sol->FldCaption(), $cs_avances->estado_sol->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_garantias");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_garantias->FldCaption(), $cs_avances->adj_garantias->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_avances");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_avances->FldCaption(), $cs_avances->adj_avances->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_supervicion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_supervicion->FldCaption(), $cs_avances->adj_supervicion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_evaluacion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_evaluacion->FldCaption(), $cs_avances->adj_evaluacion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_tecnica");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_tecnica->FldCaption(), $cs_avances->adj_tecnica->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_financiero");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_financiero->FldCaption(), $cs_avances->adj_financiero->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_recepcion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_recepcion->FldCaption(), $cs_avances->adj_recepcion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_adj_disconformidad");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_avances->adj_disconformidad->FldCaption(), $cs_avances->adj_disconformidad->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcs_avancesgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "codigo_inicio_ejecucion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "porcent_programado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "porcent_real", false)) return false;
	if (ew_ValueChanged(fobj, infix, "finan_programado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "finan_real", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_registro", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "user_registro", false)) return false;
	if (ew_ValueChanged(fobj, infix, "desc_problemas", false)) return false;
	if (ew_ValueChanged(fobj, infix, "desc_temas", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idEjecucion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_avance", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idContratacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado_sol", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_garantias", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_avances", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_supervicion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_evaluacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_tecnica", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_financiero", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_recepcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "adj_disconformidad", false)) return false;
	return true;
}

// Form_CustomValidate event
fcs_avancesgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_avancesgrid.ValidateRequired = true;
<?php } else { ?>
fcs_avancesgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($cs_avances->CurrentAction == "gridadd") {
	if ($cs_avances->CurrentMode == "copy") {
		$bSelectLimit = $cs_avances_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cs_avances_grid->TotalRecs = $cs_avances->SelectRecordCount();
			$cs_avances_grid->Recordset = $cs_avances_grid->LoadRecordset($cs_avances_grid->StartRec-1, $cs_avances_grid->DisplayRecs);
		} else {
			if ($cs_avances_grid->Recordset = $cs_avances_grid->LoadRecordset())
				$cs_avances_grid->TotalRecs = $cs_avances_grid->Recordset->RecordCount();
		}
		$cs_avances_grid->StartRec = 1;
		$cs_avances_grid->DisplayRecs = $cs_avances_grid->TotalRecs;
	} else {
		$cs_avances->CurrentFilter = "0=1";
		$cs_avances_grid->StartRec = 1;
		$cs_avances_grid->DisplayRecs = $cs_avances->GridAddRowCount;
	}
	$cs_avances_grid->TotalRecs = $cs_avances_grid->DisplayRecs;
	$cs_avances_grid->StopRec = $cs_avances_grid->DisplayRecs;
} else {
	$bSelectLimit = $cs_avances_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_avances_grid->TotalRecs <= 0)
			$cs_avances_grid->TotalRecs = $cs_avances->SelectRecordCount();
	} else {
		if (!$cs_avances_grid->Recordset && ($cs_avances_grid->Recordset = $cs_avances_grid->LoadRecordset()))
			$cs_avances_grid->TotalRecs = $cs_avances_grid->Recordset->RecordCount();
	}
	$cs_avances_grid->StartRec = 1;
	$cs_avances_grid->DisplayRecs = $cs_avances_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cs_avances_grid->Recordset = $cs_avances_grid->LoadRecordset($cs_avances_grid->StartRec-1, $cs_avances_grid->DisplayRecs);

	// Set no record found message
	if ($cs_avances->CurrentAction == "" && $cs_avances_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_avances_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_avances_grid->SearchWhere == "0=101")
			$cs_avances_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_avances_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cs_avances_grid->RenderOtherOptions();
?>
<?php $cs_avances_grid->ShowPageHeader(); ?>
<?php
$cs_avances_grid->ShowMessage();
?>
<?php if ($cs_avances_grid->TotalRecs > 0 || $cs_avances->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<div id="fcs_avancesgrid" class="ewForm form-inline">
<div id="gmp_cs_avances" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_cs_avancesgrid" class="table ewTable">
<?php echo $cs_avances->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_avances_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_avances_grid->RenderListOptions();

// Render list options (header, left)
$cs_avances_grid->ListOptions->Render("header", "left");
?>
<?php if ($cs_avances->codigo->Visible) { // codigo ?>
	<?php if ($cs_avances->SortUrl($cs_avances->codigo) == "") { ?>
		<th data-name="codigo"><div id="elh_cs_avances_codigo" class="cs_avances_codigo"><div class="ewTableHeaderCaption"><?php echo $cs_avances->codigo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo"><div><div id="elh_cs_avances_codigo" class="cs_avances_codigo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->codigo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->codigo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->codigo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->codigo_inicio_ejecucion->Visible) { // codigo_inicio_ejecucion ?>
	<?php if ($cs_avances->SortUrl($cs_avances->codigo_inicio_ejecucion) == "") { ?>
		<th data-name="codigo_inicio_ejecucion"><div id="elh_cs_avances_codigo_inicio_ejecucion" class="cs_avances_codigo_inicio_ejecucion"><div class="ewTableHeaderCaption"><?php echo $cs_avances->codigo_inicio_ejecucion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo_inicio_ejecucion"><div><div id="elh_cs_avances_codigo_inicio_ejecucion" class="cs_avances_codigo_inicio_ejecucion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->codigo_inicio_ejecucion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->codigo_inicio_ejecucion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->codigo_inicio_ejecucion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->porcent_programado->Visible) { // porcent_programado ?>
	<?php if ($cs_avances->SortUrl($cs_avances->porcent_programado) == "") { ?>
		<th data-name="porcent_programado"><div id="elh_cs_avances_porcent_programado" class="cs_avances_porcent_programado"><div class="ewTableHeaderCaption"><?php echo $cs_avances->porcent_programado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="porcent_programado"><div><div id="elh_cs_avances_porcent_programado" class="cs_avances_porcent_programado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->porcent_programado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->porcent_programado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->porcent_programado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->porcent_real->Visible) { // porcent_real ?>
	<?php if ($cs_avances->SortUrl($cs_avances->porcent_real) == "") { ?>
		<th data-name="porcent_real"><div id="elh_cs_avances_porcent_real" class="cs_avances_porcent_real"><div class="ewTableHeaderCaption"><?php echo $cs_avances->porcent_real->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="porcent_real"><div><div id="elh_cs_avances_porcent_real" class="cs_avances_porcent_real">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->porcent_real->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->porcent_real->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->porcent_real->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->finan_programado->Visible) { // finan_programado ?>
	<?php if ($cs_avances->SortUrl($cs_avances->finan_programado) == "") { ?>
		<th data-name="finan_programado"><div id="elh_cs_avances_finan_programado" class="cs_avances_finan_programado"><div class="ewTableHeaderCaption"><?php echo $cs_avances->finan_programado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="finan_programado"><div><div id="elh_cs_avances_finan_programado" class="cs_avances_finan_programado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->finan_programado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->finan_programado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->finan_programado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->finan_real->Visible) { // finan_real ?>
	<?php if ($cs_avances->SortUrl($cs_avances->finan_real) == "") { ?>
		<th data-name="finan_real"><div id="elh_cs_avances_finan_real" class="cs_avances_finan_real"><div class="ewTableHeaderCaption"><?php echo $cs_avances->finan_real->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="finan_real"><div><div id="elh_cs_avances_finan_real" class="cs_avances_finan_real">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->finan_real->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->finan_real->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->finan_real->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->fecha_registro->Visible) { // fecha_registro ?>
	<?php if ($cs_avances->SortUrl($cs_avances->fecha_registro) == "") { ?>
		<th data-name="fecha_registro"><div id="elh_cs_avances_fecha_registro" class="cs_avances_fecha_registro"><div class="ewTableHeaderCaption"><?php echo $cs_avances->fecha_registro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_registro"><div><div id="elh_cs_avances_fecha_registro" class="cs_avances_fecha_registro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->fecha_registro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->fecha_registro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->fecha_registro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->estado->Visible) { // estado ?>
	<?php if ($cs_avances->SortUrl($cs_avances->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_avances_estado" class="cs_avances_estado"><div class="ewTableHeaderCaption"><?php echo $cs_avances->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div><div id="elh_cs_avances_estado" class="cs_avances_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->user_registro->Visible) { // user_registro ?>
	<?php if ($cs_avances->SortUrl($cs_avances->user_registro) == "") { ?>
		<th data-name="user_registro"><div id="elh_cs_avances_user_registro" class="cs_avances_user_registro"><div class="ewTableHeaderCaption"><?php echo $cs_avances->user_registro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_registro"><div><div id="elh_cs_avances_user_registro" class="cs_avances_user_registro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->user_registro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->user_registro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->user_registro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->desc_problemas->Visible) { // desc_problemas ?>
	<?php if ($cs_avances->SortUrl($cs_avances->desc_problemas) == "") { ?>
		<th data-name="desc_problemas"><div id="elh_cs_avances_desc_problemas" class="cs_avances_desc_problemas"><div class="ewTableHeaderCaption"><?php echo $cs_avances->desc_problemas->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc_problemas"><div><div id="elh_cs_avances_desc_problemas" class="cs_avances_desc_problemas">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->desc_problemas->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->desc_problemas->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->desc_problemas->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->desc_temas->Visible) { // desc_temas ?>
	<?php if ($cs_avances->SortUrl($cs_avances->desc_temas) == "") { ?>
		<th data-name="desc_temas"><div id="elh_cs_avances_desc_temas" class="cs_avances_desc_temas"><div class="ewTableHeaderCaption"><?php echo $cs_avances->desc_temas->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="desc_temas"><div><div id="elh_cs_avances_desc_temas" class="cs_avances_desc_temas">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->desc_temas->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->desc_temas->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->desc_temas->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->idEjecucion->Visible) { // idEjecucion ?>
	<?php if ($cs_avances->SortUrl($cs_avances->idEjecucion) == "") { ?>
		<th data-name="idEjecucion"><div id="elh_cs_avances_idEjecucion" class="cs_avances_idEjecucion"><div class="ewTableHeaderCaption"><?php echo $cs_avances->idEjecucion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idEjecucion"><div><div id="elh_cs_avances_idEjecucion" class="cs_avances_idEjecucion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->idEjecucion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->idEjecucion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->idEjecucion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->fecha_avance->Visible) { // fecha_avance ?>
	<?php if ($cs_avances->SortUrl($cs_avances->fecha_avance) == "") { ?>
		<th data-name="fecha_avance"><div id="elh_cs_avances_fecha_avance" class="cs_avances_fecha_avance"><div class="ewTableHeaderCaption"><?php echo $cs_avances->fecha_avance->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avance"><div><div id="elh_cs_avances_fecha_avance" class="cs_avances_fecha_avance">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->fecha_avance->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->fecha_avance->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->fecha_avance->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->idContratacion->Visible) { // idContratacion ?>
	<?php if ($cs_avances->SortUrl($cs_avances->idContratacion) == "") { ?>
		<th data-name="idContratacion"><div id="elh_cs_avances_idContratacion" class="cs_avances_idContratacion"><div class="ewTableHeaderCaption"><?php echo $cs_avances->idContratacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idContratacion"><div><div id="elh_cs_avances_idContratacion" class="cs_avances_idContratacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->idContratacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->idContratacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->idContratacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->estado_sol->Visible) { // estado_sol ?>
	<?php if ($cs_avances->SortUrl($cs_avances->estado_sol) == "") { ?>
		<th data-name="estado_sol"><div id="elh_cs_avances_estado_sol" class="cs_avances_estado_sol"><div class="ewTableHeaderCaption"><?php echo $cs_avances->estado_sol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_sol"><div><div id="elh_cs_avances_estado_sol" class="cs_avances_estado_sol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->estado_sol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->estado_sol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->estado_sol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_garantias->Visible) { // adj_garantias ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_garantias) == "") { ?>
		<th data-name="adj_garantias"><div id="elh_cs_avances_adj_garantias" class="cs_avances_adj_garantias"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_garantias->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_garantias"><div><div id="elh_cs_avances_adj_garantias" class="cs_avances_adj_garantias">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_garantias->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_garantias->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_garantias->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_avances->Visible) { // adj_avances ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_avances) == "") { ?>
		<th data-name="adj_avances"><div id="elh_cs_avances_adj_avances" class="cs_avances_adj_avances"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_avances->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_avances"><div><div id="elh_cs_avances_adj_avances" class="cs_avances_adj_avances">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_avances->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_avances->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_avances->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_supervicion->Visible) { // adj_supervicion ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_supervicion) == "") { ?>
		<th data-name="adj_supervicion"><div id="elh_cs_avances_adj_supervicion" class="cs_avances_adj_supervicion"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_supervicion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_supervicion"><div><div id="elh_cs_avances_adj_supervicion" class="cs_avances_adj_supervicion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_supervicion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_supervicion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_supervicion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_evaluacion->Visible) { // adj_evaluacion ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_evaluacion) == "") { ?>
		<th data-name="adj_evaluacion"><div id="elh_cs_avances_adj_evaluacion" class="cs_avances_adj_evaluacion"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_evaluacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_evaluacion"><div><div id="elh_cs_avances_adj_evaluacion" class="cs_avances_adj_evaluacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_evaluacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_evaluacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_evaluacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_tecnica->Visible) { // adj_tecnica ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_tecnica) == "") { ?>
		<th data-name="adj_tecnica"><div id="elh_cs_avances_adj_tecnica" class="cs_avances_adj_tecnica"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_tecnica->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_tecnica"><div><div id="elh_cs_avances_adj_tecnica" class="cs_avances_adj_tecnica">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_tecnica->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_tecnica->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_tecnica->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_financiero->Visible) { // adj_financiero ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_financiero) == "") { ?>
		<th data-name="adj_financiero"><div id="elh_cs_avances_adj_financiero" class="cs_avances_adj_financiero"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_financiero->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_financiero"><div><div id="elh_cs_avances_adj_financiero" class="cs_avances_adj_financiero">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_financiero->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_financiero->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_financiero->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_recepcion->Visible) { // adj_recepcion ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_recepcion) == "") { ?>
		<th data-name="adj_recepcion"><div id="elh_cs_avances_adj_recepcion" class="cs_avances_adj_recepcion"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_recepcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_recepcion"><div><div id="elh_cs_avances_adj_recepcion" class="cs_avances_adj_recepcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_recepcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_recepcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_recepcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_avances->adj_disconformidad->Visible) { // adj_disconformidad ?>
	<?php if ($cs_avances->SortUrl($cs_avances->adj_disconformidad) == "") { ?>
		<th data-name="adj_disconformidad"><div id="elh_cs_avances_adj_disconformidad" class="cs_avances_adj_disconformidad"><div class="ewTableHeaderCaption"><?php echo $cs_avances->adj_disconformidad->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="adj_disconformidad"><div><div id="elh_cs_avances_adj_disconformidad" class="cs_avances_adj_disconformidad">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_avances->adj_disconformidad->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_avances->adj_disconformidad->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_avances->adj_disconformidad->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_avances_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cs_avances_grid->StartRec = 1;
$cs_avances_grid->StopRec = $cs_avances_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cs_avances_grid->FormKeyCountName) && ($cs_avances->CurrentAction == "gridadd" || $cs_avances->CurrentAction == "gridedit" || $cs_avances->CurrentAction == "F")) {
		$cs_avances_grid->KeyCount = $objForm->GetValue($cs_avances_grid->FormKeyCountName);
		$cs_avances_grid->StopRec = $cs_avances_grid->StartRec + $cs_avances_grid->KeyCount - 1;
	}
}
$cs_avances_grid->RecCnt = $cs_avances_grid->StartRec - 1;
if ($cs_avances_grid->Recordset && !$cs_avances_grid->Recordset->EOF) {
	$cs_avances_grid->Recordset->MoveFirst();
	$bSelectLimit = $cs_avances_grid->UseSelectLimit;
	if (!$bSelectLimit && $cs_avances_grid->StartRec > 1)
		$cs_avances_grid->Recordset->Move($cs_avances_grid->StartRec - 1);
} elseif (!$cs_avances->AllowAddDeleteRow && $cs_avances_grid->StopRec == 0) {
	$cs_avances_grid->StopRec = $cs_avances->GridAddRowCount;
}

// Initialize aggregate
$cs_avances->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_avances->ResetAttrs();
$cs_avances_grid->RenderRow();
if ($cs_avances->CurrentAction == "gridadd")
	$cs_avances_grid->RowIndex = 0;
if ($cs_avances->CurrentAction == "gridedit")
	$cs_avances_grid->RowIndex = 0;
while ($cs_avances_grid->RecCnt < $cs_avances_grid->StopRec) {
	$cs_avances_grid->RecCnt++;
	if (intval($cs_avances_grid->RecCnt) >= intval($cs_avances_grid->StartRec)) {
		$cs_avances_grid->RowCnt++;
		if ($cs_avances->CurrentAction == "gridadd" || $cs_avances->CurrentAction == "gridedit" || $cs_avances->CurrentAction == "F") {
			$cs_avances_grid->RowIndex++;
			$objForm->Index = $cs_avances_grid->RowIndex;
			if ($objForm->HasValue($cs_avances_grid->FormActionName))
				$cs_avances_grid->RowAction = strval($objForm->GetValue($cs_avances_grid->FormActionName));
			elseif ($cs_avances->CurrentAction == "gridadd")
				$cs_avances_grid->RowAction = "insert";
			else
				$cs_avances_grid->RowAction = "";
		}

		// Set up key count
		$cs_avances_grid->KeyCount = $cs_avances_grid->RowIndex;

		// Init row class and style
		$cs_avances->ResetAttrs();
		$cs_avances->CssClass = "";
		if ($cs_avances->CurrentAction == "gridadd") {
			if ($cs_avances->CurrentMode == "copy") {
				$cs_avances_grid->LoadRowValues($cs_avances_grid->Recordset); // Load row values
				$cs_avances_grid->SetRecordKey($cs_avances_grid->RowOldKey, $cs_avances_grid->Recordset); // Set old record key
			} else {
				$cs_avances_grid->LoadDefaultValues(); // Load default values
				$cs_avances_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cs_avances_grid->LoadRowValues($cs_avances_grid->Recordset); // Load row values
		}
		$cs_avances->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cs_avances->CurrentAction == "gridadd") // Grid add
			$cs_avances->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cs_avances->CurrentAction == "gridadd" && $cs_avances->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cs_avances_grid->RestoreCurrentRowFormValues($cs_avances_grid->RowIndex); // Restore form values
		if ($cs_avances->CurrentAction == "gridedit") { // Grid edit
			if ($cs_avances->EventCancelled) {
				$cs_avances_grid->RestoreCurrentRowFormValues($cs_avances_grid->RowIndex); // Restore form values
			}
			if ($cs_avances_grid->RowAction == "insert")
				$cs_avances->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cs_avances->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cs_avances->CurrentAction == "gridedit" && ($cs_avances->RowType == EW_ROWTYPE_EDIT || $cs_avances->RowType == EW_ROWTYPE_ADD) && $cs_avances->EventCancelled) // Update failed
			$cs_avances_grid->RestoreCurrentRowFormValues($cs_avances_grid->RowIndex); // Restore form values
		if ($cs_avances->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cs_avances_grid->EditRowCnt++;
		if ($cs_avances->CurrentAction == "F") // Confirm row
			$cs_avances_grid->RestoreCurrentRowFormValues($cs_avances_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cs_avances->RowAttrs = array_merge($cs_avances->RowAttrs, array('data-rowindex'=>$cs_avances_grid->RowCnt, 'id'=>'r' . $cs_avances_grid->RowCnt . '_cs_avances', 'data-rowtype'=>$cs_avances->RowType));

		// Render row
		$cs_avances_grid->RenderRow();

		// Render list options
		$cs_avances_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cs_avances_grid->RowAction <> "delete" && $cs_avances_grid->RowAction <> "insertdelete" && !($cs_avances_grid->RowAction == "insert" && $cs_avances->CurrentAction == "F" && $cs_avances_grid->EmptyRow())) {
?>
	<tr<?php echo $cs_avances->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_avances_grid->ListOptions->Render("body", "left", $cs_avances_grid->RowCnt);
?>
	<?php if ($cs_avances->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cs_avances->codigo->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cs_avances" data-field="x_codigo" name="o<?php echo $cs_avances_grid->RowIndex ?>_codigo" id="o<?php echo $cs_avances_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_avances->codigo->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo" class="form-group cs_avances_codigo">
<span<?php echo $cs_avances->codigo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->codigo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_codigo" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_avances->codigo->CurrentValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo" class="cs_avances_codigo">
<span<?php echo $cs_avances->codigo->ViewAttributes() ?>>
<?php echo $cs_avances->codigo->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_codigo" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_avances->codigo->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_codigo" name="o<?php echo $cs_avances_grid->RowIndex ?>_codigo" id="o<?php echo $cs_avances_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_avances->codigo->OldValue) ?>">
<?php } ?>
<a id="<?php echo $cs_avances_grid->PageObjName . "_row_" . $cs_avances_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_avances->codigo_inicio_ejecucion->Visible) { // codigo_inicio_ejecucion ?>
		<td data-name="codigo_inicio_ejecucion"<?php echo $cs_avances->codigo_inicio_ejecucion->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cs_avances->codigo_inicio_ejecucion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<span<?php echo $cs_avances->codigo_inicio_ejecucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->codigo_inicio_ejecucion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<input type="text" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->codigo_inicio_ejecucion->EditValue ?>"<?php echo $cs_avances->codigo_inicio_ejecucion->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="o<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="o<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cs_avances->codigo_inicio_ejecucion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<span<?php echo $cs_avances->codigo_inicio_ejecucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->codigo_inicio_ejecucion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<input type="text" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->codigo_inicio_ejecucion->EditValue ?>"<?php echo $cs_avances->codigo_inicio_ejecucion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_codigo_inicio_ejecucion" class="cs_avances_codigo_inicio_ejecucion">
<span<?php echo $cs_avances->codigo_inicio_ejecucion->ViewAttributes() ?>>
<?php echo $cs_avances->codigo_inicio_ejecucion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="o<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="o<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->porcent_programado->Visible) { // porcent_programado ?>
		<td data-name="porcent_programado"<?php echo $cs_avances->porcent_programado->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_porcent_programado" class="form-group cs_avances_porcent_programado">
<input type="text" data-table="cs_avances" data-field="x_porcent_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->porcent_programado->EditValue ?>"<?php echo $cs_avances->porcent_programado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_programado" name="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" value="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_porcent_programado" class="form-group cs_avances_porcent_programado">
<input type="text" data-table="cs_avances" data-field="x_porcent_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->porcent_programado->EditValue ?>"<?php echo $cs_avances->porcent_programado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_porcent_programado" class="cs_avances_porcent_programado">
<span<?php echo $cs_avances->porcent_programado->ViewAttributes() ?>>
<?php echo $cs_avances->porcent_programado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" value="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_porcent_programado" name="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" value="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->porcent_real->Visible) { // porcent_real ?>
		<td data-name="porcent_real"<?php echo $cs_avances->porcent_real->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_porcent_real" class="form-group cs_avances_porcent_real">
<input type="text" data-table="cs_avances" data-field="x_porcent_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->porcent_real->getPlaceHolder()) ?>" value="<?php echo $cs_avances->porcent_real->EditValue ?>"<?php echo $cs_avances->porcent_real->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_real" name="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" value="<?php echo ew_HtmlEncode($cs_avances->porcent_real->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_porcent_real" class="form-group cs_avances_porcent_real">
<input type="text" data-table="cs_avances" data-field="x_porcent_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->porcent_real->getPlaceHolder()) ?>" value="<?php echo $cs_avances->porcent_real->EditValue ?>"<?php echo $cs_avances->porcent_real->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_porcent_real" class="cs_avances_porcent_real">
<span<?php echo $cs_avances->porcent_real->ViewAttributes() ?>>
<?php echo $cs_avances->porcent_real->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" value="<?php echo ew_HtmlEncode($cs_avances->porcent_real->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_porcent_real" name="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" value="<?php echo ew_HtmlEncode($cs_avances->porcent_real->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->finan_programado->Visible) { // finan_programado ?>
		<td data-name="finan_programado"<?php echo $cs_avances->finan_programado->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_finan_programado" class="form-group cs_avances_finan_programado">
<input type="text" data-table="cs_avances" data-field="x_finan_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->finan_programado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->finan_programado->EditValue ?>"<?php echo $cs_avances->finan_programado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_finan_programado" name="o<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="o<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" value="<?php echo ew_HtmlEncode($cs_avances->finan_programado->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_finan_programado" class="form-group cs_avances_finan_programado">
<input type="text" data-table="cs_avances" data-field="x_finan_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->finan_programado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->finan_programado->EditValue ?>"<?php echo $cs_avances->finan_programado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_finan_programado" class="cs_avances_finan_programado">
<span<?php echo $cs_avances->finan_programado->ViewAttributes() ?>>
<?php echo $cs_avances->finan_programado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_finan_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" value="<?php echo ew_HtmlEncode($cs_avances->finan_programado->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_finan_programado" name="o<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="o<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" value="<?php echo ew_HtmlEncode($cs_avances->finan_programado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->finan_real->Visible) { // finan_real ?>
		<td data-name="finan_real"<?php echo $cs_avances->finan_real->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_finan_real" class="form-group cs_avances_finan_real">
<input type="text" data-table="cs_avances" data-field="x_finan_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->finan_real->getPlaceHolder()) ?>" value="<?php echo $cs_avances->finan_real->EditValue ?>"<?php echo $cs_avances->finan_real->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_finan_real" name="o<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="o<?php echo $cs_avances_grid->RowIndex ?>_finan_real" value="<?php echo ew_HtmlEncode($cs_avances->finan_real->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_finan_real" class="form-group cs_avances_finan_real">
<input type="text" data-table="cs_avances" data-field="x_finan_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->finan_real->getPlaceHolder()) ?>" value="<?php echo $cs_avances->finan_real->EditValue ?>"<?php echo $cs_avances->finan_real->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_finan_real" class="cs_avances_finan_real">
<span<?php echo $cs_avances->finan_real->ViewAttributes() ?>>
<?php echo $cs_avances->finan_real->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_finan_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" value="<?php echo ew_HtmlEncode($cs_avances->finan_real->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_finan_real" name="o<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="o<?php echo $cs_avances_grid->RowIndex ?>_finan_real" value="<?php echo ew_HtmlEncode($cs_avances->finan_real->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->fecha_registro->Visible) { // fecha_registro ?>
		<td data-name="fecha_registro"<?php echo $cs_avances->fecha_registro->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_fecha_registro" class="form-group cs_avances_fecha_registro">
<input type="text" data-table="cs_avances" data-field="x_fecha_registro" data-format="5" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" placeholder="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->getPlaceHolder()) ?>" value="<?php echo $cs_avances->fecha_registro->EditValue ?>"<?php echo $cs_avances->fecha_registro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_registro" name="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_fecha_registro" class="form-group cs_avances_fecha_registro">
<input type="text" data-table="cs_avances" data-field="x_fecha_registro" data-format="5" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" placeholder="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->getPlaceHolder()) ?>" value="<?php echo $cs_avances->fecha_registro->EditValue ?>"<?php echo $cs_avances->fecha_registro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_fecha_registro" class="cs_avances_fecha_registro">
<span<?php echo $cs_avances->fecha_registro->ViewAttributes() ?>>
<?php echo $cs_avances->fecha_registro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_fecha_registro" name="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_avances->estado->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_estado" class="form-group cs_avances_estado">
<input type="text" data-table="cs_avances" data-field="x_estado" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_avances->estado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->estado->EditValue ?>"<?php echo $cs_avances->estado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_estado" name="o<?php echo $cs_avances_grid->RowIndex ?>_estado" id="o<?php echo $cs_avances_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_avances->estado->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_estado" class="form-group cs_avances_estado">
<input type="text" data-table="cs_avances" data-field="x_estado" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_avances->estado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->estado->EditValue ?>"<?php echo $cs_avances->estado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_estado" class="cs_avances_estado">
<span<?php echo $cs_avances->estado->ViewAttributes() ?>>
<?php echo $cs_avances->estado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_estado" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_avances->estado->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_estado" name="o<?php echo $cs_avances_grid->RowIndex ?>_estado" id="o<?php echo $cs_avances_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_avances->estado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->user_registro->Visible) { // user_registro ?>
		<td data-name="user_registro"<?php echo $cs_avances->user_registro->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_user_registro" class="form-group cs_avances_user_registro">
<input type="text" data-table="cs_avances" data-field="x_user_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($cs_avances->user_registro->getPlaceHolder()) ?>" value="<?php echo $cs_avances->user_registro->EditValue ?>"<?php echo $cs_avances->user_registro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_user_registro" name="o<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="o<?php echo $cs_avances_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_avances->user_registro->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_user_registro" class="form-group cs_avances_user_registro">
<input type="text" data-table="cs_avances" data-field="x_user_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($cs_avances->user_registro->getPlaceHolder()) ?>" value="<?php echo $cs_avances->user_registro->EditValue ?>"<?php echo $cs_avances->user_registro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_user_registro" class="cs_avances_user_registro">
<span<?php echo $cs_avances->user_registro->ViewAttributes() ?>>
<?php echo $cs_avances->user_registro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_user_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_avances->user_registro->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_user_registro" name="o<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="o<?php echo $cs_avances_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_avances->user_registro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->desc_problemas->Visible) { // desc_problemas ?>
		<td data-name="desc_problemas"<?php echo $cs_avances->desc_problemas->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_desc_problemas" class="form-group cs_avances_desc_problemas">
<input type="text" data-table="cs_avances" data-field="x_desc_problemas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->getPlaceHolder()) ?>" value="<?php echo $cs_avances->desc_problemas->EditValue ?>"<?php echo $cs_avances->desc_problemas->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_desc_problemas" name="o<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="o<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" value="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_desc_problemas" class="form-group cs_avances_desc_problemas">
<input type="text" data-table="cs_avances" data-field="x_desc_problemas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->getPlaceHolder()) ?>" value="<?php echo $cs_avances->desc_problemas->EditValue ?>"<?php echo $cs_avances->desc_problemas->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_desc_problemas" class="cs_avances_desc_problemas">
<span<?php echo $cs_avances->desc_problemas->ViewAttributes() ?>>
<?php echo $cs_avances->desc_problemas->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_desc_problemas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" value="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_desc_problemas" name="o<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="o<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" value="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->desc_temas->Visible) { // desc_temas ?>
		<td data-name="desc_temas"<?php echo $cs_avances->desc_temas->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_desc_temas" class="form-group cs_avances_desc_temas">
<input type="text" data-table="cs_avances" data-field="x_desc_temas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_avances->desc_temas->getPlaceHolder()) ?>" value="<?php echo $cs_avances->desc_temas->EditValue ?>"<?php echo $cs_avances->desc_temas->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_desc_temas" name="o<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="o<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" value="<?php echo ew_HtmlEncode($cs_avances->desc_temas->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_desc_temas" class="form-group cs_avances_desc_temas">
<input type="text" data-table="cs_avances" data-field="x_desc_temas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_avances->desc_temas->getPlaceHolder()) ?>" value="<?php echo $cs_avances->desc_temas->EditValue ?>"<?php echo $cs_avances->desc_temas->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_desc_temas" class="cs_avances_desc_temas">
<span<?php echo $cs_avances->desc_temas->ViewAttributes() ?>>
<?php echo $cs_avances->desc_temas->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_desc_temas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" value="<?php echo ew_HtmlEncode($cs_avances->desc_temas->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_desc_temas" name="o<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="o<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" value="<?php echo ew_HtmlEncode($cs_avances->desc_temas->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->idEjecucion->Visible) { // idEjecucion ?>
		<td data-name="idEjecucion"<?php echo $cs_avances->idEjecucion->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_idEjecucion" class="form-group cs_avances_idEjecucion">
<input type="text" data-table="cs_avances" data-field="x_idEjecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->idEjecucion->EditValue ?>"<?php echo $cs_avances->idEjecucion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_idEjecucion" name="o<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="o<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" value="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_idEjecucion" class="form-group cs_avances_idEjecucion">
<input type="text" data-table="cs_avances" data-field="x_idEjecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->idEjecucion->EditValue ?>"<?php echo $cs_avances->idEjecucion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_idEjecucion" class="cs_avances_idEjecucion">
<span<?php echo $cs_avances->idEjecucion->ViewAttributes() ?>>
<?php echo $cs_avances->idEjecucion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_idEjecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" value="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_idEjecucion" name="o<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="o<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" value="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->fecha_avance->Visible) { // fecha_avance ?>
		<td data-name="fecha_avance"<?php echo $cs_avances->fecha_avance->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_fecha_avance" class="form-group cs_avances_fecha_avance">
<input type="text" data-table="cs_avances" data-field="x_fecha_avance" data-format="5" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" placeholder="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->getPlaceHolder()) ?>" value="<?php echo $cs_avances->fecha_avance->EditValue ?>"<?php echo $cs_avances->fecha_avance->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_avance" name="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" value="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_fecha_avance" class="form-group cs_avances_fecha_avance">
<input type="text" data-table="cs_avances" data-field="x_fecha_avance" data-format="5" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" placeholder="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->getPlaceHolder()) ?>" value="<?php echo $cs_avances->fecha_avance->EditValue ?>"<?php echo $cs_avances->fecha_avance->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_fecha_avance" class="cs_avances_fecha_avance">
<span<?php echo $cs_avances->fecha_avance->ViewAttributes() ?>>
<?php echo $cs_avances->fecha_avance->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_avance" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" value="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_fecha_avance" name="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" value="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion"<?php echo $cs_avances->idContratacion->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_idContratacion" class="form-group cs_avances_idContratacion">
<input type="text" data-table="cs_avances" data-field="x_idContratacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->idContratacion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->idContratacion->EditValue ?>"<?php echo $cs_avances->idContratacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_idContratacion" name="o<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_avances->idContratacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_idContratacion" class="form-group cs_avances_idContratacion">
<input type="text" data-table="cs_avances" data-field="x_idContratacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->idContratacion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->idContratacion->EditValue ?>"<?php echo $cs_avances->idContratacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_idContratacion" class="cs_avances_idContratacion">
<span<?php echo $cs_avances->idContratacion->ViewAttributes() ?>>
<?php echo $cs_avances->idContratacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_idContratacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_avances->idContratacion->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_idContratacion" name="o<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_avances->idContratacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->estado_sol->Visible) { // estado_sol ?>
		<td data-name="estado_sol"<?php echo $cs_avances->estado_sol->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_estado_sol" class="form-group cs_avances_estado_sol">
<input type="text" data-table="cs_avances" data-field="x_estado_sol" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_avances->estado_sol->getPlaceHolder()) ?>" value="<?php echo $cs_avances->estado_sol->EditValue ?>"<?php echo $cs_avances->estado_sol->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_estado_sol" name="o<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="o<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_avances->estado_sol->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_estado_sol" class="form-group cs_avances_estado_sol">
<input type="text" data-table="cs_avances" data-field="x_estado_sol" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_avances->estado_sol->getPlaceHolder()) ?>" value="<?php echo $cs_avances->estado_sol->EditValue ?>"<?php echo $cs_avances->estado_sol->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_estado_sol" class="cs_avances_estado_sol">
<span<?php echo $cs_avances->estado_sol->ViewAttributes() ?>>
<?php echo $cs_avances->estado_sol->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_estado_sol" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_avances->estado_sol->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_estado_sol" name="o<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="o<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_avances->estado_sol->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_garantias->Visible) { // adj_garantias ?>
		<td data-name="adj_garantias"<?php echo $cs_avances->adj_garantias->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_garantias" class="form-group cs_avances_adj_garantias">
<input type="text" data-table="cs_avances" data-field="x_adj_garantias" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_garantias->EditValue ?>"<?php echo $cs_avances->adj_garantias->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_garantias" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" value="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_garantias" class="form-group cs_avances_adj_garantias">
<input type="text" data-table="cs_avances" data-field="x_adj_garantias" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_garantias->EditValue ?>"<?php echo $cs_avances->adj_garantias->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_garantias" class="cs_avances_adj_garantias">
<span<?php echo $cs_avances->adj_garantias->ViewAttributes() ?>>
<?php echo $cs_avances->adj_garantias->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_garantias" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" value="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_garantias" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" value="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_avances->Visible) { // adj_avances ?>
		<td data-name="adj_avances"<?php echo $cs_avances->adj_avances->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_avances" class="form-group cs_avances_adj_avances">
<input type="text" data-table="cs_avances" data-field="x_adj_avances" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_avances->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_avances->EditValue ?>"<?php echo $cs_avances->adj_avances->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_avances" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" value="<?php echo ew_HtmlEncode($cs_avances->adj_avances->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_avances" class="form-group cs_avances_adj_avances">
<input type="text" data-table="cs_avances" data-field="x_adj_avances" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_avances->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_avances->EditValue ?>"<?php echo $cs_avances->adj_avances->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_avances" class="cs_avances_adj_avances">
<span<?php echo $cs_avances->adj_avances->ViewAttributes() ?>>
<?php echo $cs_avances->adj_avances->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_avances" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" value="<?php echo ew_HtmlEncode($cs_avances->adj_avances->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_avances" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" value="<?php echo ew_HtmlEncode($cs_avances->adj_avances->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_supervicion->Visible) { // adj_supervicion ?>
		<td data-name="adj_supervicion"<?php echo $cs_avances->adj_supervicion->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_supervicion" class="form-group cs_avances_adj_supervicion">
<input type="text" data-table="cs_avances" data-field="x_adj_supervicion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_supervicion->EditValue ?>"<?php echo $cs_avances->adj_supervicion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_supervicion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" value="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_supervicion" class="form-group cs_avances_adj_supervicion">
<input type="text" data-table="cs_avances" data-field="x_adj_supervicion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_supervicion->EditValue ?>"<?php echo $cs_avances->adj_supervicion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_supervicion" class="cs_avances_adj_supervicion">
<span<?php echo $cs_avances->adj_supervicion->ViewAttributes() ?>>
<?php echo $cs_avances->adj_supervicion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_supervicion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" value="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_supervicion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" value="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_evaluacion->Visible) { // adj_evaluacion ?>
		<td data-name="adj_evaluacion"<?php echo $cs_avances->adj_evaluacion->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_evaluacion" class="form-group cs_avances_adj_evaluacion">
<input type="text" data-table="cs_avances" data-field="x_adj_evaluacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_evaluacion->EditValue ?>"<?php echo $cs_avances->adj_evaluacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_evaluacion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" value="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_evaluacion" class="form-group cs_avances_adj_evaluacion">
<input type="text" data-table="cs_avances" data-field="x_adj_evaluacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_evaluacion->EditValue ?>"<?php echo $cs_avances->adj_evaluacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_evaluacion" class="cs_avances_adj_evaluacion">
<span<?php echo $cs_avances->adj_evaluacion->ViewAttributes() ?>>
<?php echo $cs_avances->adj_evaluacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_evaluacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" value="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_evaluacion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" value="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_tecnica->Visible) { // adj_tecnica ?>
		<td data-name="adj_tecnica"<?php echo $cs_avances->adj_tecnica->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_tecnica" class="form-group cs_avances_adj_tecnica">
<input type="text" data-table="cs_avances" data-field="x_adj_tecnica" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_tecnica->EditValue ?>"<?php echo $cs_avances->adj_tecnica->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_tecnica" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" value="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_tecnica" class="form-group cs_avances_adj_tecnica">
<input type="text" data-table="cs_avances" data-field="x_adj_tecnica" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_tecnica->EditValue ?>"<?php echo $cs_avances->adj_tecnica->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_tecnica" class="cs_avances_adj_tecnica">
<span<?php echo $cs_avances->adj_tecnica->ViewAttributes() ?>>
<?php echo $cs_avances->adj_tecnica->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_tecnica" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" value="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_tecnica" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" value="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_financiero->Visible) { // adj_financiero ?>
		<td data-name="adj_financiero"<?php echo $cs_avances->adj_financiero->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_financiero" class="form-group cs_avances_adj_financiero">
<input type="text" data-table="cs_avances" data-field="x_adj_financiero" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_financiero->EditValue ?>"<?php echo $cs_avances->adj_financiero->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_financiero" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" value="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_financiero" class="form-group cs_avances_adj_financiero">
<input type="text" data-table="cs_avances" data-field="x_adj_financiero" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_financiero->EditValue ?>"<?php echo $cs_avances->adj_financiero->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_financiero" class="cs_avances_adj_financiero">
<span<?php echo $cs_avances->adj_financiero->ViewAttributes() ?>>
<?php echo $cs_avances->adj_financiero->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_financiero" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" value="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_financiero" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" value="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_recepcion->Visible) { // adj_recepcion ?>
		<td data-name="adj_recepcion"<?php echo $cs_avances->adj_recepcion->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_recepcion" class="form-group cs_avances_adj_recepcion">
<input type="text" data-table="cs_avances" data-field="x_adj_recepcion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_recepcion->EditValue ?>"<?php echo $cs_avances->adj_recepcion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_recepcion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" value="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_recepcion" class="form-group cs_avances_adj_recepcion">
<input type="text" data-table="cs_avances" data-field="x_adj_recepcion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_recepcion->EditValue ?>"<?php echo $cs_avances->adj_recepcion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_recepcion" class="cs_avances_adj_recepcion">
<span<?php echo $cs_avances->adj_recepcion->ViewAttributes() ?>>
<?php echo $cs_avances->adj_recepcion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_recepcion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" value="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_recepcion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" value="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_disconformidad->Visible) { // adj_disconformidad ?>
		<td data-name="adj_disconformidad"<?php echo $cs_avances->adj_disconformidad->CellAttributes() ?>>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_disconformidad" class="form-group cs_avances_adj_disconformidad">
<input type="text" data-table="cs_avances" data-field="x_adj_disconformidad" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_disconformidad->EditValue ?>"<?php echo $cs_avances->adj_disconformidad->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_disconformidad" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" value="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->OldValue) ?>">
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_disconformidad" class="form-group cs_avances_adj_disconformidad">
<input type="text" data-table="cs_avances" data-field="x_adj_disconformidad" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_disconformidad->EditValue ?>"<?php echo $cs_avances->adj_disconformidad->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_avances->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_avances_grid->RowCnt ?>_cs_avances_adj_disconformidad" class="cs_avances_adj_disconformidad">
<span<?php echo $cs_avances->adj_disconformidad->ViewAttributes() ?>>
<?php echo $cs_avances->adj_disconformidad->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_disconformidad" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" value="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->FormValue) ?>">
<input type="hidden" data-table="cs_avances" data-field="x_adj_disconformidad" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" value="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_avances_grid->ListOptions->Render("body", "right", $cs_avances_grid->RowCnt);
?>
	</tr>
<?php if ($cs_avances->RowType == EW_ROWTYPE_ADD || $cs_avances->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcs_avancesgrid.UpdateOpts(<?php echo $cs_avances_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cs_avances->CurrentAction <> "gridadd" || $cs_avances->CurrentMode == "copy")
		if (!$cs_avances_grid->Recordset->EOF) $cs_avances_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cs_avances->CurrentMode == "add" || $cs_avances->CurrentMode == "copy" || $cs_avances->CurrentMode == "edit") {
		$cs_avances_grid->RowIndex = '$rowindex$';
		$cs_avances_grid->LoadDefaultValues();

		// Set row properties
		$cs_avances->ResetAttrs();
		$cs_avances->RowAttrs = array_merge($cs_avances->RowAttrs, array('data-rowindex'=>$cs_avances_grid->RowIndex, 'id'=>'r0_cs_avances', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cs_avances->RowAttrs["class"], "ewTemplate");
		$cs_avances->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cs_avances_grid->RenderRow();

		// Render list options
		$cs_avances_grid->RenderListOptions();
		$cs_avances_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cs_avances->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_avances_grid->ListOptions->Render("body", "left", $cs_avances_grid->RowIndex);
?>
	<?php if ($cs_avances->codigo->Visible) { // codigo ?>
		<td data-name="codigo">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_codigo" class="form-group cs_avances_codigo">
<span<?php echo $cs_avances->codigo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->codigo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_codigo" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_avances->codigo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_codigo" name="o<?php echo $cs_avances_grid->RowIndex ?>_codigo" id="o<?php echo $cs_avances_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_avances->codigo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->codigo_inicio_ejecucion->Visible) { // codigo_inicio_ejecucion ?>
		<td data-name="codigo_inicio_ejecucion">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<?php if ($cs_avances->codigo_inicio_ejecucion->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<span<?php echo $cs_avances->codigo_inicio_ejecucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->codigo_inicio_ejecucion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<input type="text" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->codigo_inicio_ejecucion->EditValue ?>"<?php echo $cs_avances->codigo_inicio_ejecucion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_codigo_inicio_ejecucion" class="form-group cs_avances_codigo_inicio_ejecucion">
<span<?php echo $cs_avances->codigo_inicio_ejecucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->codigo_inicio_ejecucion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_codigo_inicio_ejecucion" name="o<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" id="o<?php echo $cs_avances_grid->RowIndex ?>_codigo_inicio_ejecucion" value="<?php echo ew_HtmlEncode($cs_avances->codigo_inicio_ejecucion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->porcent_programado->Visible) { // porcent_programado ?>
		<td data-name="porcent_programado">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_porcent_programado" class="form-group cs_avances_porcent_programado">
<input type="text" data-table="cs_avances" data-field="x_porcent_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->porcent_programado->EditValue ?>"<?php echo $cs_avances->porcent_programado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_porcent_programado" class="form-group cs_avances_porcent_programado">
<span<?php echo $cs_avances->porcent_programado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->porcent_programado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" value="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_programado" name="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" id="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_programado" value="<?php echo ew_HtmlEncode($cs_avances->porcent_programado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->porcent_real->Visible) { // porcent_real ?>
		<td data-name="porcent_real">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_porcent_real" class="form-group cs_avances_porcent_real">
<input type="text" data-table="cs_avances" data-field="x_porcent_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->porcent_real->getPlaceHolder()) ?>" value="<?php echo $cs_avances->porcent_real->EditValue ?>"<?php echo $cs_avances->porcent_real->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_porcent_real" class="form-group cs_avances_porcent_real">
<span<?php echo $cs_avances->porcent_real->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->porcent_real->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" value="<?php echo ew_HtmlEncode($cs_avances->porcent_real->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_porcent_real" name="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" id="o<?php echo $cs_avances_grid->RowIndex ?>_porcent_real" value="<?php echo ew_HtmlEncode($cs_avances->porcent_real->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->finan_programado->Visible) { // finan_programado ?>
		<td data-name="finan_programado">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_finan_programado" class="form-group cs_avances_finan_programado">
<input type="text" data-table="cs_avances" data-field="x_finan_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->finan_programado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->finan_programado->EditValue ?>"<?php echo $cs_avances->finan_programado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_finan_programado" class="form-group cs_avances_finan_programado">
<span<?php echo $cs_avances->finan_programado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->finan_programado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_finan_programado" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" value="<?php echo ew_HtmlEncode($cs_avances->finan_programado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_finan_programado" name="o<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" id="o<?php echo $cs_avances_grid->RowIndex ?>_finan_programado" value="<?php echo ew_HtmlEncode($cs_avances->finan_programado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->finan_real->Visible) { // finan_real ?>
		<td data-name="finan_real">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_finan_real" class="form-group cs_avances_finan_real">
<input type="text" data-table="cs_avances" data-field="x_finan_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->finan_real->getPlaceHolder()) ?>" value="<?php echo $cs_avances->finan_real->EditValue ?>"<?php echo $cs_avances->finan_real->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_finan_real" class="form-group cs_avances_finan_real">
<span<?php echo $cs_avances->finan_real->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->finan_real->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_finan_real" name="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="x<?php echo $cs_avances_grid->RowIndex ?>_finan_real" value="<?php echo ew_HtmlEncode($cs_avances->finan_real->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_finan_real" name="o<?php echo $cs_avances_grid->RowIndex ?>_finan_real" id="o<?php echo $cs_avances_grid->RowIndex ?>_finan_real" value="<?php echo ew_HtmlEncode($cs_avances->finan_real->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->fecha_registro->Visible) { // fecha_registro ?>
		<td data-name="fecha_registro">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_fecha_registro" class="form-group cs_avances_fecha_registro">
<input type="text" data-table="cs_avances" data-field="x_fecha_registro" data-format="5" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" placeholder="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->getPlaceHolder()) ?>" value="<?php echo $cs_avances->fecha_registro->EditValue ?>"<?php echo $cs_avances->fecha_registro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_fecha_registro" class="form-group cs_avances_fecha_registro">
<span<?php echo $cs_avances->fecha_registro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->fecha_registro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_registro" name="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" id="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_avances->fecha_registro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_estado" class="form-group cs_avances_estado">
<input type="text" data-table="cs_avances" data-field="x_estado" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_avances->estado->getPlaceHolder()) ?>" value="<?php echo $cs_avances->estado->EditValue ?>"<?php echo $cs_avances->estado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_estado" class="form-group cs_avances_estado">
<span<?php echo $cs_avances->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_estado" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_avances->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_estado" name="o<?php echo $cs_avances_grid->RowIndex ?>_estado" id="o<?php echo $cs_avances_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_avances->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->user_registro->Visible) { // user_registro ?>
		<td data-name="user_registro">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_user_registro" class="form-group cs_avances_user_registro">
<input type="text" data-table="cs_avances" data-field="x_user_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($cs_avances->user_registro->getPlaceHolder()) ?>" value="<?php echo $cs_avances->user_registro->EditValue ?>"<?php echo $cs_avances->user_registro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_user_registro" class="form-group cs_avances_user_registro">
<span<?php echo $cs_avances->user_registro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->user_registro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_user_registro" name="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_avances_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_avances->user_registro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_user_registro" name="o<?php echo $cs_avances_grid->RowIndex ?>_user_registro" id="o<?php echo $cs_avances_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_avances->user_registro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->desc_problemas->Visible) { // desc_problemas ?>
		<td data-name="desc_problemas">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_desc_problemas" class="form-group cs_avances_desc_problemas">
<input type="text" data-table="cs_avances" data-field="x_desc_problemas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->getPlaceHolder()) ?>" value="<?php echo $cs_avances->desc_problemas->EditValue ?>"<?php echo $cs_avances->desc_problemas->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_desc_problemas" class="form-group cs_avances_desc_problemas">
<span<?php echo $cs_avances->desc_problemas->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->desc_problemas->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_desc_problemas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" value="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_desc_problemas" name="o<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" id="o<?php echo $cs_avances_grid->RowIndex ?>_desc_problemas" value="<?php echo ew_HtmlEncode($cs_avances->desc_problemas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->desc_temas->Visible) { // desc_temas ?>
		<td data-name="desc_temas">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_desc_temas" class="form-group cs_avances_desc_temas">
<input type="text" data-table="cs_avances" data-field="x_desc_temas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" size="30" maxlength="254" placeholder="<?php echo ew_HtmlEncode($cs_avances->desc_temas->getPlaceHolder()) ?>" value="<?php echo $cs_avances->desc_temas->EditValue ?>"<?php echo $cs_avances->desc_temas->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_desc_temas" class="form-group cs_avances_desc_temas">
<span<?php echo $cs_avances->desc_temas->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->desc_temas->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_desc_temas" name="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="x<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" value="<?php echo ew_HtmlEncode($cs_avances->desc_temas->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_desc_temas" name="o<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" id="o<?php echo $cs_avances_grid->RowIndex ?>_desc_temas" value="<?php echo ew_HtmlEncode($cs_avances->desc_temas->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->idEjecucion->Visible) { // idEjecucion ?>
		<td data-name="idEjecucion">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_idEjecucion" class="form-group cs_avances_idEjecucion">
<input type="text" data-table="cs_avances" data-field="x_idEjecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->idEjecucion->EditValue ?>"<?php echo $cs_avances->idEjecucion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_idEjecucion" class="form-group cs_avances_idEjecucion">
<span<?php echo $cs_avances->idEjecucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->idEjecucion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_idEjecucion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" value="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_idEjecucion" name="o<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" id="o<?php echo $cs_avances_grid->RowIndex ?>_idEjecucion" value="<?php echo ew_HtmlEncode($cs_avances->idEjecucion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->fecha_avance->Visible) { // fecha_avance ?>
		<td data-name="fecha_avance">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_fecha_avance" class="form-group cs_avances_fecha_avance">
<input type="text" data-table="cs_avances" data-field="x_fecha_avance" data-format="5" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" placeholder="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->getPlaceHolder()) ?>" value="<?php echo $cs_avances->fecha_avance->EditValue ?>"<?php echo $cs_avances->fecha_avance->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_fecha_avance" class="form-group cs_avances_fecha_avance">
<span<?php echo $cs_avances->fecha_avance->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->fecha_avance->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_avance" name="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="x<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" value="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_fecha_avance" name="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" id="o<?php echo $cs_avances_grid->RowIndex ?>_fecha_avance" value="<?php echo ew_HtmlEncode($cs_avances->fecha_avance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_idContratacion" class="form-group cs_avances_idContratacion">
<input type="text" data-table="cs_avances" data-field="x_idContratacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_avances->idContratacion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->idContratacion->EditValue ?>"<?php echo $cs_avances->idContratacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_idContratacion" class="form-group cs_avances_idContratacion">
<span<?php echo $cs_avances->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->idContratacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_idContratacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_avances->idContratacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_idContratacion" name="o<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_avances_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_avances->idContratacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->estado_sol->Visible) { // estado_sol ?>
		<td data-name="estado_sol">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_estado_sol" class="form-group cs_avances_estado_sol">
<input type="text" data-table="cs_avances" data-field="x_estado_sol" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_avances->estado_sol->getPlaceHolder()) ?>" value="<?php echo $cs_avances->estado_sol->EditValue ?>"<?php echo $cs_avances->estado_sol->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_estado_sol" class="form-group cs_avances_estado_sol">
<span<?php echo $cs_avances->estado_sol->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->estado_sol->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_estado_sol" name="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_avances->estado_sol->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_estado_sol" name="o<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" id="o<?php echo $cs_avances_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_avances->estado_sol->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_garantias->Visible) { // adj_garantias ?>
		<td data-name="adj_garantias">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_garantias" class="form-group cs_avances_adj_garantias">
<input type="text" data-table="cs_avances" data-field="x_adj_garantias" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_garantias->EditValue ?>"<?php echo $cs_avances->adj_garantias->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_garantias" class="form-group cs_avances_adj_garantias">
<span<?php echo $cs_avances->adj_garantias->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_garantias->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_garantias" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" value="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_garantias" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_garantias" value="<?php echo ew_HtmlEncode($cs_avances->adj_garantias->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_avances->Visible) { // adj_avances ?>
		<td data-name="adj_avances">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_avances" class="form-group cs_avances_adj_avances">
<input type="text" data-table="cs_avances" data-field="x_adj_avances" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_avances->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_avances->EditValue ?>"<?php echo $cs_avances->adj_avances->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_avances" class="form-group cs_avances_adj_avances">
<span<?php echo $cs_avances->adj_avances->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_avances->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_avances" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" value="<?php echo ew_HtmlEncode($cs_avances->adj_avances->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_avances" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_avances" value="<?php echo ew_HtmlEncode($cs_avances->adj_avances->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_supervicion->Visible) { // adj_supervicion ?>
		<td data-name="adj_supervicion">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_supervicion" class="form-group cs_avances_adj_supervicion">
<input type="text" data-table="cs_avances" data-field="x_adj_supervicion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_supervicion->EditValue ?>"<?php echo $cs_avances->adj_supervicion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_supervicion" class="form-group cs_avances_adj_supervicion">
<span<?php echo $cs_avances->adj_supervicion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_supervicion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_supervicion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" value="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_supervicion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_supervicion" value="<?php echo ew_HtmlEncode($cs_avances->adj_supervicion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_evaluacion->Visible) { // adj_evaluacion ?>
		<td data-name="adj_evaluacion">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_evaluacion" class="form-group cs_avances_adj_evaluacion">
<input type="text" data-table="cs_avances" data-field="x_adj_evaluacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_evaluacion->EditValue ?>"<?php echo $cs_avances->adj_evaluacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_evaluacion" class="form-group cs_avances_adj_evaluacion">
<span<?php echo $cs_avances->adj_evaluacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_evaluacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_evaluacion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" value="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_evaluacion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_evaluacion" value="<?php echo ew_HtmlEncode($cs_avances->adj_evaluacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_tecnica->Visible) { // adj_tecnica ?>
		<td data-name="adj_tecnica">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_tecnica" class="form-group cs_avances_adj_tecnica">
<input type="text" data-table="cs_avances" data-field="x_adj_tecnica" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_tecnica->EditValue ?>"<?php echo $cs_avances->adj_tecnica->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_tecnica" class="form-group cs_avances_adj_tecnica">
<span<?php echo $cs_avances->adj_tecnica->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_tecnica->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_tecnica" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" value="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_tecnica" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_tecnica" value="<?php echo ew_HtmlEncode($cs_avances->adj_tecnica->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_financiero->Visible) { // adj_financiero ?>
		<td data-name="adj_financiero">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_financiero" class="form-group cs_avances_adj_financiero">
<input type="text" data-table="cs_avances" data-field="x_adj_financiero" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_financiero->EditValue ?>"<?php echo $cs_avances->adj_financiero->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_financiero" class="form-group cs_avances_adj_financiero">
<span<?php echo $cs_avances->adj_financiero->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_financiero->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_financiero" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" value="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_financiero" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_financiero" value="<?php echo ew_HtmlEncode($cs_avances->adj_financiero->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_recepcion->Visible) { // adj_recepcion ?>
		<td data-name="adj_recepcion">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_recepcion" class="form-group cs_avances_adj_recepcion">
<input type="text" data-table="cs_avances" data-field="x_adj_recepcion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_recepcion->EditValue ?>"<?php echo $cs_avances->adj_recepcion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_recepcion" class="form-group cs_avances_adj_recepcion">
<span<?php echo $cs_avances->adj_recepcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_recepcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_recepcion" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" value="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_recepcion" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_recepcion" value="<?php echo ew_HtmlEncode($cs_avances->adj_recepcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_avances->adj_disconformidad->Visible) { // adj_disconformidad ?>
		<td data-name="adj_disconformidad">
<?php if ($cs_avances->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_avances_adj_disconformidad" class="form-group cs_avances_adj_disconformidad">
<input type="text" data-table="cs_avances" data-field="x_adj_disconformidad" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->getPlaceHolder()) ?>" value="<?php echo $cs_avances->adj_disconformidad->EditValue ?>"<?php echo $cs_avances->adj_disconformidad->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_avances_adj_disconformidad" class="form-group cs_avances_adj_disconformidad">
<span<?php echo $cs_avances->adj_disconformidad->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_avances->adj_disconformidad->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_avances" data-field="x_adj_disconformidad" name="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="x<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" value="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_avances" data-field="x_adj_disconformidad" name="o<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" id="o<?php echo $cs_avances_grid->RowIndex ?>_adj_disconformidad" value="<?php echo ew_HtmlEncode($cs_avances->adj_disconformidad->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_avances_grid->ListOptions->Render("body", "right", $cs_avances_grid->RowCnt);
?>
<script type="text/javascript">
fcs_avancesgrid.UpdateOpts(<?php echo $cs_avances_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cs_avances->CurrentMode == "add" || $cs_avances->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cs_avances_grid->FormKeyCountName ?>" id="<?php echo $cs_avances_grid->FormKeyCountName ?>" value="<?php echo $cs_avances_grid->KeyCount ?>">
<?php echo $cs_avances_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_avances->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cs_avances_grid->FormKeyCountName ?>" id="<?php echo $cs_avances_grid->FormKeyCountName ?>" value="<?php echo $cs_avances_grid->KeyCount ?>">
<?php echo $cs_avances_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_avances->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcs_avancesgrid">
</div>
<?php

// Close recordset
if ($cs_avances_grid->Recordset)
	$cs_avances_grid->Recordset->Close();
?>
<?php if ($cs_avances_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($cs_avances_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cs_avances_grid->TotalRecs == 0 && $cs_avances->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_avances_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_avances->Export == "") { ?>
<script type="text/javascript">
fcs_avancesgrid.Init();
</script>
<?php } ?>
<?php
$cs_avances_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$cs_avances_grid->Page_Terminate();
?>
