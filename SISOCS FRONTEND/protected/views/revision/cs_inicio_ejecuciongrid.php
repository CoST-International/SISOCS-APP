<?php include_once "cruge_userinfo.php" ?>
<?php

// Create page object
if (!isset($cs_inicio_ejecucion_grid)) $cs_inicio_ejecucion_grid = new ccs_inicio_ejecucion_grid();

// Page init
$cs_inicio_ejecucion_grid->Page_Init();

// Page main
$cs_inicio_ejecucion_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_inicio_ejecucion_grid->Page_Render();
?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcs_inicio_ejecuciongrid = new ew_Form("fcs_inicio_ejecuciongrid", "grid");
fcs_inicio_ejecuciongrid.FormKeyCountName = '<?php echo $cs_inicio_ejecucion_grid->FormKeyCountName ?>';

// Validate form
fcs_inicio_ejecuciongrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_idContratacion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->idContratacion->FldCaption(), $cs_inicio_ejecucion->idContratacion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idContratacion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->idContratacion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_cod_contacto_01");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->cod_contacto_01->FldCaption(), $cs_inicio_ejecucion->cod_contacto_01->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cod_contacto_01");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->cod_contacto_01->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_cod_contacto_02");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->cod_contacto_02->FldCaption(), $cs_inicio_ejecucion->cod_contacto_02->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cod_contacto_02");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->cod_contacto_02->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_cod_contacto_03");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->cod_contacto_03->FldCaption(), $cs_inicio_ejecucion->cod_contacto_03->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_cod_contacto_03");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->cod_contacto_03->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tipo_garant_01");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->tipo_garant_01->FldCaption(), $cs_inicio_ejecucion->tipo_garant_01->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tipo_garant_01");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->tipo_garant_01->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tipo_garant_02");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->tipo_garant_02->FldCaption(), $cs_inicio_ejecucion->tipo_garant_02->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tipo_garant_02");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->tipo_garant_02->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tipo_garant_03");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->tipo_garant_03->FldCaption(), $cs_inicio_ejecucion->tipo_garant_03->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tipo_garant_03");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->tipo_garant_03->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monto_garant_01");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->monto_garant_01->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monto_garant_02");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->monto_garant_02->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monto_garant_03");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->monto_garant_03->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_estado_garant_01");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->estado_garant_01->FldCaption(), $cs_inicio_ejecucion->estado_garant_01->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_estado_garant_01");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->estado_garant_01->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_estado_garant_02");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->estado_garant_02->FldCaption(), $cs_inicio_ejecucion->estado_garant_02->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_estado_garant_02");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->estado_garant_02->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_estado_garant_03");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->estado_garant_03->FldCaption(), $cs_inicio_ejecucion->estado_garant_03->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_estado_garant_03");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->estado_garant_03->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_venc_01");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->fecha_venc_01->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_venc_02");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->fecha_venc_02->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_venc_03");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->fecha_venc_03->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_geo_latitud");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->geo_latitud->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_geo_longitud");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->geo_longitud->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_geo_lati_final");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->geo_lati_final->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_geo_long_final");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->geo_long_final->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_inicio");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->fecha_inicio->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_registro");
			if (elm && !ew_CheckDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_inicio_ejecucion->fecha_registro->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_user_registro");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_inicio_ejecucion->user_registro->FldCaption(), $cs_inicio_ejecucion->user_registro->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcs_inicio_ejecuciongrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "idContratacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cod_contacto_01", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cod_contacto_02", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cod_contacto_03", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tipo_garant_01", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tipo_garant_02", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tipo_garant_03", false)) return false;
	if (ew_ValueChanged(fobj, infix, "monto_garant_01", false)) return false;
	if (ew_ValueChanged(fobj, infix, "monto_garant_02", false)) return false;
	if (ew_ValueChanged(fobj, infix, "monto_garant_03", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado_garant_01", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado_garant_02", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado_garant_03", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_venc_01", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_venc_02", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_venc_03", false)) return false;
	if (ew_ValueChanged(fobj, infix, "geo_latitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "geo_longitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "geo_lati_final", false)) return false;
	if (ew_ValueChanged(fobj, infix, "geo_long_final", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_inicio", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado_sol", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_registro", false)) return false;
	if (ew_ValueChanged(fobj, infix, "user_registro", false)) return false;
	return true;
}

// Form_CustomValidate event
fcs_inicio_ejecuciongrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_inicio_ejecuciongrid.ValidateRequired = true;
<?php } else { ?>
fcs_inicio_ejecuciongrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($cs_inicio_ejecucion->CurrentAction == "gridadd") {
	if ($cs_inicio_ejecucion->CurrentMode == "copy") {
		$bSelectLimit = $cs_inicio_ejecucion_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cs_inicio_ejecucion_grid->TotalRecs = $cs_inicio_ejecucion->SelectRecordCount();
			$cs_inicio_ejecucion_grid->Recordset = $cs_inicio_ejecucion_grid->LoadRecordset($cs_inicio_ejecucion_grid->StartRec-1, $cs_inicio_ejecucion_grid->DisplayRecs);
		} else {
			if ($cs_inicio_ejecucion_grid->Recordset = $cs_inicio_ejecucion_grid->LoadRecordset())
				$cs_inicio_ejecucion_grid->TotalRecs = $cs_inicio_ejecucion_grid->Recordset->RecordCount();
		}
		$cs_inicio_ejecucion_grid->StartRec = 1;
		$cs_inicio_ejecucion_grid->DisplayRecs = $cs_inicio_ejecucion_grid->TotalRecs;
	} else {
		$cs_inicio_ejecucion->CurrentFilter = "0=1";
		$cs_inicio_ejecucion_grid->StartRec = 1;
		$cs_inicio_ejecucion_grid->DisplayRecs = $cs_inicio_ejecucion->GridAddRowCount;
	}
	$cs_inicio_ejecucion_grid->TotalRecs = $cs_inicio_ejecucion_grid->DisplayRecs;
	$cs_inicio_ejecucion_grid->StopRec = $cs_inicio_ejecucion_grid->DisplayRecs;
} else {
	$bSelectLimit = $cs_inicio_ejecucion_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_inicio_ejecucion_grid->TotalRecs <= 0)
			$cs_inicio_ejecucion_grid->TotalRecs = $cs_inicio_ejecucion->SelectRecordCount();
	} else {
		if (!$cs_inicio_ejecucion_grid->Recordset && ($cs_inicio_ejecucion_grid->Recordset = $cs_inicio_ejecucion_grid->LoadRecordset()))
			$cs_inicio_ejecucion_grid->TotalRecs = $cs_inicio_ejecucion_grid->Recordset->RecordCount();
	}
	$cs_inicio_ejecucion_grid->StartRec = 1;
	$cs_inicio_ejecucion_grid->DisplayRecs = $cs_inicio_ejecucion_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cs_inicio_ejecucion_grid->Recordset = $cs_inicio_ejecucion_grid->LoadRecordset($cs_inicio_ejecucion_grid->StartRec-1, $cs_inicio_ejecucion_grid->DisplayRecs);

	// Set no record found message
	if ($cs_inicio_ejecucion->CurrentAction == "" && $cs_inicio_ejecucion_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_inicio_ejecucion_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_inicio_ejecucion_grid->SearchWhere == "0=101")
			$cs_inicio_ejecucion_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_inicio_ejecucion_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cs_inicio_ejecucion_grid->RenderOtherOptions();
?>
<?php $cs_inicio_ejecucion_grid->ShowPageHeader(); ?>
<?php
$cs_inicio_ejecucion_grid->ShowMessage();
?>
<?php if ($cs_inicio_ejecucion_grid->TotalRecs > 0 || $cs_inicio_ejecucion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<div id="fcs_inicio_ejecuciongrid" class="ewForm form-inline">
<div id="gmp_cs_inicio_ejecucion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_cs_inicio_ejecuciongrid" class="table ewTable">
<?php echo $cs_inicio_ejecucion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_inicio_ejecucion_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_inicio_ejecucion_grid->RenderListOptions();

// Render list options (header, left)
$cs_inicio_ejecucion_grid->ListOptions->Render("header", "left");
?>
<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->codigo) == "") { ?>
		<th data-name="codigo"><div id="elh_cs_inicio_ejecucion_codigo" class="cs_inicio_ejecucion_codigo"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->codigo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo"><div><div id="elh_cs_inicio_ejecucion_codigo" class="cs_inicio_ejecucion_codigo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->codigo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->codigo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->codigo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->idContratacion) == "") { ?>
		<th data-name="idContratacion"><div id="elh_cs_inicio_ejecucion_idContratacion" class="cs_inicio_ejecucion_idContratacion"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->idContratacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idContratacion"><div><div id="elh_cs_inicio_ejecucion_idContratacion" class="cs_inicio_ejecucion_idContratacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->idContratacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->idContratacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->idContratacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->imagen) == "") { ?>
		<th data-name="imagen"><div id="elh_cs_inicio_ejecucion_imagen" class="cs_inicio_ejecucion_imagen"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen"><div><div id="elh_cs_inicio_ejecucion_imagen" class="cs_inicio_ejecucion_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->imagen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_01) == "") { ?>
		<th data-name="cod_contacto_01"><div id="elh_cs_inicio_ejecucion_cod_contacto_01" class="cs_inicio_ejecucion_cod_contacto_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cod_contacto_01"><div><div id="elh_cs_inicio_ejecucion_cod_contacto_01" class="cs_inicio_ejecucion_cod_contacto_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->cod_contacto_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->cod_contacto_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_02) == "") { ?>
		<th data-name="cod_contacto_02"><div id="elh_cs_inicio_ejecucion_cod_contacto_02" class="cs_inicio_ejecucion_cod_contacto_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cod_contacto_02"><div><div id="elh_cs_inicio_ejecucion_cod_contacto_02" class="cs_inicio_ejecucion_cod_contacto_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->cod_contacto_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->cod_contacto_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_03) == "") { ?>
		<th data-name="cod_contacto_03"><div id="elh_cs_inicio_ejecucion_cod_contacto_03" class="cs_inicio_ejecucion_cod_contacto_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cod_contacto_03"><div><div id="elh_cs_inicio_ejecucion_cod_contacto_03" class="cs_inicio_ejecucion_cod_contacto_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->cod_contacto_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->cod_contacto_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_01) == "") { ?>
		<th data-name="tipo_garant_01"><div id="elh_cs_inicio_ejecucion_tipo_garant_01" class="cs_inicio_ejecucion_tipo_garant_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_garant_01"><div><div id="elh_cs_inicio_ejecucion_tipo_garant_01" class="cs_inicio_ejecucion_tipo_garant_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->tipo_garant_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->tipo_garant_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_02) == "") { ?>
		<th data-name="tipo_garant_02"><div id="elh_cs_inicio_ejecucion_tipo_garant_02" class="cs_inicio_ejecucion_tipo_garant_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_garant_02"><div><div id="elh_cs_inicio_ejecucion_tipo_garant_02" class="cs_inicio_ejecucion_tipo_garant_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->tipo_garant_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->tipo_garant_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_03) == "") { ?>
		<th data-name="tipo_garant_03"><div id="elh_cs_inicio_ejecucion_tipo_garant_03" class="cs_inicio_ejecucion_tipo_garant_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_garant_03"><div><div id="elh_cs_inicio_ejecucion_tipo_garant_03" class="cs_inicio_ejecucion_tipo_garant_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->tipo_garant_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->tipo_garant_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_01) == "") { ?>
		<th data-name="monto_garant_01"><div id="elh_cs_inicio_ejecucion_monto_garant_01" class="cs_inicio_ejecucion_monto_garant_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_garant_01"><div><div id="elh_cs_inicio_ejecucion_monto_garant_01" class="cs_inicio_ejecucion_monto_garant_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->monto_garant_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->monto_garant_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_02) == "") { ?>
		<th data-name="monto_garant_02"><div id="elh_cs_inicio_ejecucion_monto_garant_02" class="cs_inicio_ejecucion_monto_garant_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_garant_02"><div><div id="elh_cs_inicio_ejecucion_monto_garant_02" class="cs_inicio_ejecucion_monto_garant_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->monto_garant_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->monto_garant_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_03) == "") { ?>
		<th data-name="monto_garant_03"><div id="elh_cs_inicio_ejecucion_monto_garant_03" class="cs_inicio_ejecucion_monto_garant_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_garant_03"><div><div id="elh_cs_inicio_ejecucion_monto_garant_03" class="cs_inicio_ejecucion_monto_garant_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->monto_garant_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->monto_garant_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_01) == "") { ?>
		<th data-name="estado_garant_01"><div id="elh_cs_inicio_ejecucion_estado_garant_01" class="cs_inicio_ejecucion_estado_garant_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_garant_01"><div><div id="elh_cs_inicio_ejecucion_estado_garant_01" class="cs_inicio_ejecucion_estado_garant_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_garant_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_garant_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_02) == "") { ?>
		<th data-name="estado_garant_02"><div id="elh_cs_inicio_ejecucion_estado_garant_02" class="cs_inicio_ejecucion_estado_garant_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_garant_02"><div><div id="elh_cs_inicio_ejecucion_estado_garant_02" class="cs_inicio_ejecucion_estado_garant_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_garant_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_garant_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_03) == "") { ?>
		<th data-name="estado_garant_03"><div id="elh_cs_inicio_ejecucion_estado_garant_03" class="cs_inicio_ejecucion_estado_garant_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_garant_03"><div><div id="elh_cs_inicio_ejecucion_estado_garant_03" class="cs_inicio_ejecucion_estado_garant_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_garant_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_garant_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_01) == "") { ?>
		<th data-name="fecha_venc_01"><div id="elh_cs_inicio_ejecucion_fecha_venc_01" class="cs_inicio_ejecucion_fecha_venc_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_venc_01"><div><div id="elh_cs_inicio_ejecucion_fecha_venc_01" class="cs_inicio_ejecucion_fecha_venc_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_venc_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_venc_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_02) == "") { ?>
		<th data-name="fecha_venc_02"><div id="elh_cs_inicio_ejecucion_fecha_venc_02" class="cs_inicio_ejecucion_fecha_venc_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_venc_02"><div><div id="elh_cs_inicio_ejecucion_fecha_venc_02" class="cs_inicio_ejecucion_fecha_venc_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_venc_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_venc_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_03) == "") { ?>
		<th data-name="fecha_venc_03"><div id="elh_cs_inicio_ejecucion_fecha_venc_03" class="cs_inicio_ejecucion_fecha_venc_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_venc_03"><div><div id="elh_cs_inicio_ejecucion_fecha_venc_03" class="cs_inicio_ejecucion_fecha_venc_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_venc_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_venc_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_latitud) == "") { ?>
		<th data-name="geo_latitud"><div id="elh_cs_inicio_ejecucion_geo_latitud" class="cs_inicio_ejecucion_geo_latitud"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_latitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_latitud"><div><div id="elh_cs_inicio_ejecucion_geo_latitud" class="cs_inicio_ejecucion_geo_latitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_latitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_latitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_latitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_longitud) == "") { ?>
		<th data-name="geo_longitud"><div id="elh_cs_inicio_ejecucion_geo_longitud" class="cs_inicio_ejecucion_geo_longitud"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_longitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_longitud"><div><div id="elh_cs_inicio_ejecucion_geo_longitud" class="cs_inicio_ejecucion_geo_longitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_longitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_longitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_longitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_lati_final) == "") { ?>
		<th data-name="geo_lati_final"><div id="elh_cs_inicio_ejecucion_geo_lati_final" class="cs_inicio_ejecucion_geo_lati_final"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_lati_final->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_lati_final"><div><div id="elh_cs_inicio_ejecucion_geo_lati_final" class="cs_inicio_ejecucion_geo_lati_final">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_lati_final->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_lati_final->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_lati_final->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_long_final) == "") { ?>
		<th data-name="geo_long_final"><div id="elh_cs_inicio_ejecucion_geo_long_final" class="cs_inicio_ejecucion_geo_long_final"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_long_final->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_long_final"><div><div id="elh_cs_inicio_ejecucion_geo_long_final" class="cs_inicio_ejecucion_geo_long_final">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_long_final->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_long_final->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_long_final->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_inicio) == "") { ?>
		<th data-name="fecha_inicio"><div id="elh_cs_inicio_ejecucion_fecha_inicio" class="cs_inicio_ejecucion_fecha_inicio"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_inicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inicio"><div><div id="elh_cs_inicio_ejecucion_fecha_inicio" class="cs_inicio_ejecucion_fecha_inicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_inicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_inicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_inicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_sol) == "") { ?>
		<th data-name="estado_sol"><div id="elh_cs_inicio_ejecucion_estado_sol" class="cs_inicio_ejecucion_estado_sol"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_sol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_sol"><div><div id="elh_cs_inicio_ejecucion_estado_sol" class="cs_inicio_ejecucion_estado_sol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_sol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_sol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_sol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_registro) == "") { ?>
		<th data-name="fecha_registro"><div id="elh_cs_inicio_ejecucion_fecha_registro" class="cs_inicio_ejecucion_fecha_registro"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_registro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_registro"><div><div id="elh_cs_inicio_ejecucion_fecha_registro" class="cs_inicio_ejecucion_fecha_registro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_registro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_registro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_registro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->user_registro) == "") { ?>
		<th data-name="user_registro"><div id="elh_cs_inicio_ejecucion_user_registro" class="cs_inicio_ejecucion_user_registro"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->user_registro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_registro"><div><div id="elh_cs_inicio_ejecucion_user_registro" class="cs_inicio_ejecucion_user_registro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->user_registro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->user_registro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->user_registro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_inicio_ejecucion_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cs_inicio_ejecucion_grid->StartRec = 1;
$cs_inicio_ejecucion_grid->StopRec = $cs_inicio_ejecucion_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cs_inicio_ejecucion_grid->FormKeyCountName) && ($cs_inicio_ejecucion->CurrentAction == "gridadd" || $cs_inicio_ejecucion->CurrentAction == "gridedit" || $cs_inicio_ejecucion->CurrentAction == "F")) {
		$cs_inicio_ejecucion_grid->KeyCount = $objForm->GetValue($cs_inicio_ejecucion_grid->FormKeyCountName);
		$cs_inicio_ejecucion_grid->StopRec = $cs_inicio_ejecucion_grid->StartRec + $cs_inicio_ejecucion_grid->KeyCount - 1;
	}
}
$cs_inicio_ejecucion_grid->RecCnt = $cs_inicio_ejecucion_grid->StartRec - 1;
if ($cs_inicio_ejecucion_grid->Recordset && !$cs_inicio_ejecucion_grid->Recordset->EOF) {
	$cs_inicio_ejecucion_grid->Recordset->MoveFirst();
	$bSelectLimit = $cs_inicio_ejecucion_grid->UseSelectLimit;
	if (!$bSelectLimit && $cs_inicio_ejecucion_grid->StartRec > 1)
		$cs_inicio_ejecucion_grid->Recordset->Move($cs_inicio_ejecucion_grid->StartRec - 1);
} elseif (!$cs_inicio_ejecucion->AllowAddDeleteRow && $cs_inicio_ejecucion_grid->StopRec == 0) {
	$cs_inicio_ejecucion_grid->StopRec = $cs_inicio_ejecucion->GridAddRowCount;
}

// Initialize aggregate
$cs_inicio_ejecucion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_inicio_ejecucion->ResetAttrs();
$cs_inicio_ejecucion_grid->RenderRow();
if ($cs_inicio_ejecucion->CurrentAction == "gridadd")
	$cs_inicio_ejecucion_grid->RowIndex = 0;
if ($cs_inicio_ejecucion->CurrentAction == "gridedit")
	$cs_inicio_ejecucion_grid->RowIndex = 0;
while ($cs_inicio_ejecucion_grid->RecCnt < $cs_inicio_ejecucion_grid->StopRec) {
	$cs_inicio_ejecucion_grid->RecCnt++;
	if (intval($cs_inicio_ejecucion_grid->RecCnt) >= intval($cs_inicio_ejecucion_grid->StartRec)) {
		$cs_inicio_ejecucion_grid->RowCnt++;
		if ($cs_inicio_ejecucion->CurrentAction == "gridadd" || $cs_inicio_ejecucion->CurrentAction == "gridedit" || $cs_inicio_ejecucion->CurrentAction == "F") {
			$cs_inicio_ejecucion_grid->RowIndex++;
			$objForm->Index = $cs_inicio_ejecucion_grid->RowIndex;
			if ($objForm->HasValue($cs_inicio_ejecucion_grid->FormActionName))
				$cs_inicio_ejecucion_grid->RowAction = strval($objForm->GetValue($cs_inicio_ejecucion_grid->FormActionName));
			elseif ($cs_inicio_ejecucion->CurrentAction == "gridadd")
				$cs_inicio_ejecucion_grid->RowAction = "insert";
			else
				$cs_inicio_ejecucion_grid->RowAction = "";
		}

		// Set up key count
		$cs_inicio_ejecucion_grid->KeyCount = $cs_inicio_ejecucion_grid->RowIndex;

		// Init row class and style
		$cs_inicio_ejecucion->ResetAttrs();
		$cs_inicio_ejecucion->CssClass = "";
		if ($cs_inicio_ejecucion->CurrentAction == "gridadd") {
			if ($cs_inicio_ejecucion->CurrentMode == "copy") {
				$cs_inicio_ejecucion_grid->LoadRowValues($cs_inicio_ejecucion_grid->Recordset); // Load row values
				$cs_inicio_ejecucion_grid->SetRecordKey($cs_inicio_ejecucion_grid->RowOldKey, $cs_inicio_ejecucion_grid->Recordset); // Set old record key
			} else {
				$cs_inicio_ejecucion_grid->LoadDefaultValues(); // Load default values
				$cs_inicio_ejecucion_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cs_inicio_ejecucion_grid->LoadRowValues($cs_inicio_ejecucion_grid->Recordset); // Load row values
		}
		$cs_inicio_ejecucion->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cs_inicio_ejecucion->CurrentAction == "gridadd") // Grid add
			$cs_inicio_ejecucion->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cs_inicio_ejecucion->CurrentAction == "gridadd" && $cs_inicio_ejecucion->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cs_inicio_ejecucion_grid->RestoreCurrentRowFormValues($cs_inicio_ejecucion_grid->RowIndex); // Restore form values
		if ($cs_inicio_ejecucion->CurrentAction == "gridedit") { // Grid edit
			if ($cs_inicio_ejecucion->EventCancelled) {
				$cs_inicio_ejecucion_grid->RestoreCurrentRowFormValues($cs_inicio_ejecucion_grid->RowIndex); // Restore form values
			}
			if ($cs_inicio_ejecucion_grid->RowAction == "insert")
				$cs_inicio_ejecucion->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cs_inicio_ejecucion->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cs_inicio_ejecucion->CurrentAction == "gridedit" && ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT || $cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) && $cs_inicio_ejecucion->EventCancelled) // Update failed
			$cs_inicio_ejecucion_grid->RestoreCurrentRowFormValues($cs_inicio_ejecucion_grid->RowIndex); // Restore form values
		if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cs_inicio_ejecucion_grid->EditRowCnt++;
		if ($cs_inicio_ejecucion->CurrentAction == "F") // Confirm row
			$cs_inicio_ejecucion_grid->RestoreCurrentRowFormValues($cs_inicio_ejecucion_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cs_inicio_ejecucion->RowAttrs = array_merge($cs_inicio_ejecucion->RowAttrs, array('data-rowindex'=>$cs_inicio_ejecucion_grid->RowCnt, 'id'=>'r' . $cs_inicio_ejecucion_grid->RowCnt . '_cs_inicio_ejecucion', 'data-rowtype'=>$cs_inicio_ejecucion->RowType));

		// Render row
		$cs_inicio_ejecucion_grid->RenderRow();

		// Render list options
		$cs_inicio_ejecucion_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cs_inicio_ejecucion_grid->RowAction <> "delete" && $cs_inicio_ejecucion_grid->RowAction <> "insertdelete" && !($cs_inicio_ejecucion_grid->RowAction == "insert" && $cs_inicio_ejecucion->CurrentAction == "F" && $cs_inicio_ejecucion_grid->EmptyRow())) {
?>
	<tr<?php echo $cs_inicio_ejecucion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_inicio_ejecucion_grid->ListOptions->Render("body", "left", $cs_inicio_ejecucion_grid->RowCnt);
?>
	<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cs_inicio_ejecucion->codigo->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_codigo" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->codigo->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_codigo" class="form-group cs_inicio_ejecucion_codigo">
<span<?php echo $cs_inicio_ejecucion->codigo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->codigo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_codigo" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->codigo->CurrentValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_codigo" class="cs_inicio_ejecucion_codigo">
<span<?php echo $cs_inicio_ejecucion->codigo->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->codigo->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_codigo" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->codigo->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_codigo" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->codigo->OldValue) ?>">
<?php } ?>
<a id="<?php echo $cs_inicio_ejecucion_grid->PageObjName . "_row_" . $cs_inicio_ejecucion_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion"<?php echo $cs_inicio_ejecucion->idContratacion->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cs_inicio_ejecucion->idContratacion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->idContratacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->idContratacion->EditValue ?>"<?php echo $cs_inicio_ejecucion->idContratacion->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cs_inicio_ejecucion->idContratacion->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->idContratacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->idContratacion->EditValue ?>"<?php echo $cs_inicio_ejecucion->idContratacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_idContratacion" class="cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->idContratacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $cs_inicio_ejecucion->imagen->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_imagen" class="form-group cs_inicio_ejecucion_imagen">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->imagen->EditValue ?>"<?php echo $cs_inicio_ejecucion->imagen->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_imagen" class="form-group cs_inicio_ejecucion_imagen">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->imagen->EditValue ?>"<?php echo $cs_inicio_ejecucion->imagen->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_imagen" class="cs_inicio_ejecucion_imagen">
<span<?php echo $cs_inicio_ejecucion->imagen->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->imagen->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
		<td data-name="cod_contacto_01"<?php echo $cs_inicio_ejecucion->cod_contacto_01->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_01" class="form-group cs_inicio_ejecucion_cod_contacto_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_01->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_01" class="form-group cs_inicio_ejecucion_cod_contacto_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_01->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_01" class="cs_inicio_ejecucion_cod_contacto_01">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_01->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
		<td data-name="cod_contacto_02"<?php echo $cs_inicio_ejecucion->cod_contacto_02->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_02" class="form-group cs_inicio_ejecucion_cod_contacto_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_02->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_02" class="form-group cs_inicio_ejecucion_cod_contacto_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_02->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_02" class="cs_inicio_ejecucion_cod_contacto_02">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_02->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
		<td data-name="cod_contacto_03"<?php echo $cs_inicio_ejecucion->cod_contacto_03->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_03" class="form-group cs_inicio_ejecucion_cod_contacto_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_03->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_03" class="form-group cs_inicio_ejecucion_cod_contacto_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_03->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_03" class="cs_inicio_ejecucion_cod_contacto_03">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_03->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
		<td data-name="tipo_garant_01"<?php echo $cs_inicio_ejecucion->tipo_garant_01->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_01" class="form-group cs_inicio_ejecucion_tipo_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_01->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_01" class="form-group cs_inicio_ejecucion_tipo_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_01->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_01" class="cs_inicio_ejecucion_tipo_garant_01">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_01->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
		<td data-name="tipo_garant_02"<?php echo $cs_inicio_ejecucion->tipo_garant_02->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_02" class="form-group cs_inicio_ejecucion_tipo_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_02->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_02" class="form-group cs_inicio_ejecucion_tipo_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_02->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_02" class="cs_inicio_ejecucion_tipo_garant_02">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_02->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
		<td data-name="tipo_garant_03"<?php echo $cs_inicio_ejecucion->tipo_garant_03->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_03" class="form-group cs_inicio_ejecucion_tipo_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_03->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_03" class="form-group cs_inicio_ejecucion_tipo_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_03->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_03" class="cs_inicio_ejecucion_tipo_garant_03">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_03->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
		<td data-name="monto_garant_01"<?php echo $cs_inicio_ejecucion->monto_garant_01->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_01" class="form-group cs_inicio_ejecucion_monto_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_01->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_01" class="form-group cs_inicio_ejecucion_monto_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_01->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_01" class="cs_inicio_ejecucion_monto_garant_01">
<span<?php echo $cs_inicio_ejecucion->monto_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_01->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
		<td data-name="monto_garant_02"<?php echo $cs_inicio_ejecucion->monto_garant_02->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_02" class="form-group cs_inicio_ejecucion_monto_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_02->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_02" class="form-group cs_inicio_ejecucion_monto_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_02->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_02" class="cs_inicio_ejecucion_monto_garant_02">
<span<?php echo $cs_inicio_ejecucion->monto_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_02->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
		<td data-name="monto_garant_03"<?php echo $cs_inicio_ejecucion->monto_garant_03->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_03" class="form-group cs_inicio_ejecucion_monto_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_03->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_03" class="form-group cs_inicio_ejecucion_monto_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_03->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_monto_garant_03" class="cs_inicio_ejecucion_monto_garant_03">
<span<?php echo $cs_inicio_ejecucion->monto_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_03->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
		<td data-name="estado_garant_01"<?php echo $cs_inicio_ejecucion->estado_garant_01->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_01" class="form-group cs_inicio_ejecucion_estado_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_01->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_01" class="form-group cs_inicio_ejecucion_estado_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_01->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_01" class="cs_inicio_ejecucion_estado_garant_01">
<span<?php echo $cs_inicio_ejecucion->estado_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_01->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
		<td data-name="estado_garant_02"<?php echo $cs_inicio_ejecucion->estado_garant_02->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_02" class="form-group cs_inicio_ejecucion_estado_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_02->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_02" class="form-group cs_inicio_ejecucion_estado_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_02->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_02" class="cs_inicio_ejecucion_estado_garant_02">
<span<?php echo $cs_inicio_ejecucion->estado_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_02->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
		<td data-name="estado_garant_03"<?php echo $cs_inicio_ejecucion->estado_garant_03->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_03" class="form-group cs_inicio_ejecucion_estado_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_03->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_03" class="form-group cs_inicio_ejecucion_estado_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_03->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_garant_03" class="cs_inicio_ejecucion_estado_garant_03">
<span<?php echo $cs_inicio_ejecucion->estado_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_03->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
		<td data-name="fecha_venc_01"<?php echo $cs_inicio_ejecucion->fecha_venc_01->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_01" class="form-group cs_inicio_ejecucion_fecha_venc_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_01->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_01" class="form-group cs_inicio_ejecucion_fecha_venc_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_01->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_01" class="cs_inicio_ejecucion_fecha_venc_01">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_01->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
		<td data-name="fecha_venc_02"<?php echo $cs_inicio_ejecucion->fecha_venc_02->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_02" class="form-group cs_inicio_ejecucion_fecha_venc_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_02->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_02" class="form-group cs_inicio_ejecucion_fecha_venc_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_02->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_02" class="cs_inicio_ejecucion_fecha_venc_02">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_02->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
		<td data-name="fecha_venc_03"<?php echo $cs_inicio_ejecucion->fecha_venc_03->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_03" class="form-group cs_inicio_ejecucion_fecha_venc_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_03->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_03" class="form-group cs_inicio_ejecucion_fecha_venc_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_03->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_03" class="cs_inicio_ejecucion_fecha_venc_03">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_03->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
		<td data-name="geo_latitud"<?php echo $cs_inicio_ejecucion->geo_latitud->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_latitud" class="form-group cs_inicio_ejecucion_geo_latitud">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_latitud->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_latitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_latitud" class="form-group cs_inicio_ejecucion_geo_latitud">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_latitud->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_latitud->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_latitud" class="cs_inicio_ejecucion_geo_latitud">
<span<?php echo $cs_inicio_ejecucion->geo_latitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_latitud->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
		<td data-name="geo_longitud"<?php echo $cs_inicio_ejecucion->geo_longitud->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_longitud" class="form-group cs_inicio_ejecucion_geo_longitud">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_longitud->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_longitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_longitud" class="form-group cs_inicio_ejecucion_geo_longitud">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_longitud->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_longitud->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_longitud" class="cs_inicio_ejecucion_geo_longitud">
<span<?php echo $cs_inicio_ejecucion->geo_longitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_longitud->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
		<td data-name="geo_lati_final"<?php echo $cs_inicio_ejecucion->geo_lati_final->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_lati_final" class="form-group cs_inicio_ejecucion_geo_lati_final">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_lati_final->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_lati_final->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_lati_final" class="form-group cs_inicio_ejecucion_geo_lati_final">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_lati_final->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_lati_final->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_lati_final" class="cs_inicio_ejecucion_geo_lati_final">
<span<?php echo $cs_inicio_ejecucion->geo_lati_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_lati_final->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
		<td data-name="geo_long_final"<?php echo $cs_inicio_ejecucion->geo_long_final->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_long_final" class="form-group cs_inicio_ejecucion_geo_long_final">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_long_final->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_long_final->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_long_final" class="form-group cs_inicio_ejecucion_geo_long_final">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_long_final->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_long_final->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_geo_long_final" class="cs_inicio_ejecucion_geo_long_final">
<span<?php echo $cs_inicio_ejecucion->geo_long_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_long_final->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
		<td data-name="fecha_inicio"<?php echo $cs_inicio_ejecucion->fecha_inicio->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_inicio" class="form-group cs_inicio_ejecucion_fecha_inicio">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_inicio->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_inicio->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_inicio" class="form-group cs_inicio_ejecucion_fecha_inicio">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_inicio->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_inicio->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_inicio" class="cs_inicio_ejecucion_fecha_inicio">
<span<?php echo $cs_inicio_ejecucion->fecha_inicio->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_inicio->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
		<td data-name="estado_sol"<?php echo $cs_inicio_ejecucion->estado_sol->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_sol" class="form-group cs_inicio_ejecucion_estado_sol">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_sol->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_sol->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_sol" class="form-group cs_inicio_ejecucion_estado_sol">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_sol->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_sol->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_estado_sol" class="cs_inicio_ejecucion_estado_sol">
<span<?php echo $cs_inicio_ejecucion->estado_sol->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_sol->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
		<td data-name="fecha_registro"<?php echo $cs_inicio_ejecucion->fecha_registro->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_registro" class="form-group cs_inicio_ejecucion_fecha_registro">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_registro->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_registro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_registro" class="form-group cs_inicio_ejecucion_fecha_registro">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_registro->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_registro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_fecha_registro" class="cs_inicio_ejecucion_fecha_registro">
<span<?php echo $cs_inicio_ejecucion->fecha_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_registro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
		<td data-name="user_registro"<?php echo $cs_inicio_ejecucion->user_registro->CellAttributes() ?>>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_user_registro" class="form-group cs_inicio_ejecucion_user_registro">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->user_registro->EditValue ?>"<?php echo $cs_inicio_ejecucion->user_registro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->OldValue) ?>">
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_user_registro" class="form-group cs_inicio_ejecucion_user_registro">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->user_registro->EditValue ?>"<?php echo $cs_inicio_ejecucion->user_registro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_inicio_ejecucion_grid->RowCnt ?>_cs_inicio_ejecucion_user_registro" class="cs_inicio_ejecucion_user_registro">
<span<?php echo $cs_inicio_ejecucion->user_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->user_registro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->FormValue) ?>">
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_inicio_ejecucion_grid->ListOptions->Render("body", "right", $cs_inicio_ejecucion_grid->RowCnt);
?>
	</tr>
<?php if ($cs_inicio_ejecucion->RowType == EW_ROWTYPE_ADD || $cs_inicio_ejecucion->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcs_inicio_ejecuciongrid.UpdateOpts(<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cs_inicio_ejecucion->CurrentAction <> "gridadd" || $cs_inicio_ejecucion->CurrentMode == "copy")
		if (!$cs_inicio_ejecucion_grid->Recordset->EOF) $cs_inicio_ejecucion_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cs_inicio_ejecucion->CurrentMode == "add" || $cs_inicio_ejecucion->CurrentMode == "copy" || $cs_inicio_ejecucion->CurrentMode == "edit") {
		$cs_inicio_ejecucion_grid->RowIndex = '$rowindex$';
		$cs_inicio_ejecucion_grid->LoadDefaultValues();

		// Set row properties
		$cs_inicio_ejecucion->ResetAttrs();
		$cs_inicio_ejecucion->RowAttrs = array_merge($cs_inicio_ejecucion->RowAttrs, array('data-rowindex'=>$cs_inicio_ejecucion_grid->RowIndex, 'id'=>'r0_cs_inicio_ejecucion', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cs_inicio_ejecucion->RowAttrs["class"], "ewTemplate");
		$cs_inicio_ejecucion->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cs_inicio_ejecucion_grid->RenderRow();

		// Render list options
		$cs_inicio_ejecucion_grid->RenderListOptions();
		$cs_inicio_ejecucion_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cs_inicio_ejecucion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_inicio_ejecucion_grid->ListOptions->Render("body", "left", $cs_inicio_ejecucion_grid->RowIndex);
?>
	<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
		<td data-name="codigo">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_codigo" class="form-group cs_inicio_ejecucion_codigo">
<span<?php echo $cs_inicio_ejecucion->codigo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->codigo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_codigo" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->codigo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_codigo" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->codigo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<?php if ($cs_inicio_ejecucion->idContratacion->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->idContratacion->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->idContratacion->EditValue ?>"<?php echo $cs_inicio_ejecucion->idContratacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_idContratacion" class="form-group cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->idContratacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_idContratacion" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_idContratacion" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->idContratacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
		<td data-name="imagen">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_imagen" class="form-group cs_inicio_ejecucion_imagen">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->imagen->EditValue ?>"<?php echo $cs_inicio_ejecucion->imagen->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_imagen" class="form-group cs_inicio_ejecucion_imagen">
<span<?php echo $cs_inicio_ejecucion->imagen->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->imagen->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_imagen" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
		<td data-name="cod_contacto_01">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_cod_contacto_01" class="form-group cs_inicio_ejecucion_cod_contacto_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_cod_contacto_01" class="form-group cs_inicio_ejecucion_cod_contacto_01">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_01->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
		<td data-name="cod_contacto_02">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_cod_contacto_02" class="form-group cs_inicio_ejecucion_cod_contacto_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_cod_contacto_02" class="form-group cs_inicio_ejecucion_cod_contacto_02">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_02->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
		<td data-name="cod_contacto_03">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_cod_contacto_03" class="form-group cs_inicio_ejecucion_cod_contacto_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->cod_contacto_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->cod_contacto_03->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_cod_contacto_03" class="form-group cs_inicio_ejecucion_cod_contacto_03">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_cod_contacto_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_cod_contacto_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->cod_contacto_03->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
		<td data-name="tipo_garant_01">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_tipo_garant_01" class="form-group cs_inicio_ejecucion_tipo_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_tipo_garant_01" class="form-group cs_inicio_ejecucion_tipo_garant_01">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_01->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
		<td data-name="tipo_garant_02">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_tipo_garant_02" class="form-group cs_inicio_ejecucion_tipo_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_tipo_garant_02" class="form-group cs_inicio_ejecucion_tipo_garant_02">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_02->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
		<td data-name="tipo_garant_03">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_tipo_garant_03" class="form-group cs_inicio_ejecucion_tipo_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->tipo_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->tipo_garant_03->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_tipo_garant_03" class="form-group cs_inicio_ejecucion_tipo_garant_03">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_tipo_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_tipo_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->tipo_garant_03->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
		<td data-name="monto_garant_01">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_monto_garant_01" class="form-group cs_inicio_ejecucion_monto_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_monto_garant_01" class="form-group cs_inicio_ejecucion_monto_garant_01">
<span<?php echo $cs_inicio_ejecucion->monto_garant_01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->monto_garant_01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_01->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
		<td data-name="monto_garant_02">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_monto_garant_02" class="form-group cs_inicio_ejecucion_monto_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_monto_garant_02" class="form-group cs_inicio_ejecucion_monto_garant_02">
<span<?php echo $cs_inicio_ejecucion->monto_garant_02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->monto_garant_02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_02->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
		<td data-name="monto_garant_03">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_monto_garant_03" class="form-group cs_inicio_ejecucion_monto_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->monto_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->monto_garant_03->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_monto_garant_03" class="form-group cs_inicio_ejecucion_monto_garant_03">
<span<?php echo $cs_inicio_ejecucion->monto_garant_03->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->monto_garant_03->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_monto_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_monto_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->monto_garant_03->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
		<td data-name="estado_garant_01">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_garant_01" class="form-group cs_inicio_ejecucion_estado_garant_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_garant_01" class="form-group cs_inicio_ejecucion_estado_garant_01">
<span<?php echo $cs_inicio_ejecucion->estado_garant_01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->estado_garant_01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_01->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
		<td data-name="estado_garant_02">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_garant_02" class="form-group cs_inicio_ejecucion_estado_garant_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_garant_02" class="form-group cs_inicio_ejecucion_estado_garant_02">
<span<?php echo $cs_inicio_ejecucion->estado_garant_02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->estado_garant_02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_02->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
		<td data-name="estado_garant_03">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_garant_03" class="form-group cs_inicio_ejecucion_estado_garant_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_garant_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_garant_03->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_garant_03" class="form-group cs_inicio_ejecucion_estado_garant_03">
<span<?php echo $cs_inicio_ejecucion->estado_garant_03->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->estado_garant_03->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_garant_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_garant_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_garant_03->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
		<td data-name="fecha_venc_01">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_venc_01" class="form-group cs_inicio_ejecucion_fecha_venc_01">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_01->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_venc_01" class="form-group cs_inicio_ejecucion_fecha_venc_01">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_01" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_01" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_01->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
		<td data-name="fecha_venc_02">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_venc_02" class="form-group cs_inicio_ejecucion_fecha_venc_02">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_02->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_venc_02" class="form-group cs_inicio_ejecucion_fecha_venc_02">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_02" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_02" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_02->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
		<td data-name="fecha_venc_03">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_venc_03" class="form-group cs_inicio_ejecucion_fecha_venc_03">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_venc_03->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_venc_03->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_venc_03" class="form-group cs_inicio_ejecucion_fecha_venc_03">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_venc_03" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_venc_03" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_venc_03->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
		<td data-name="geo_latitud">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_latitud" class="form-group cs_inicio_ejecucion_geo_latitud">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_latitud->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_latitud->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_latitud" class="form-group cs_inicio_ejecucion_geo_latitud">
<span<?php echo $cs_inicio_ejecucion->geo_latitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->geo_latitud->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_latitud" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_latitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_latitud->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
		<td data-name="geo_longitud">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_longitud" class="form-group cs_inicio_ejecucion_geo_longitud">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_longitud->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_longitud->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_longitud" class="form-group cs_inicio_ejecucion_geo_longitud">
<span<?php echo $cs_inicio_ejecucion->geo_longitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->geo_longitud->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_longitud" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_longitud" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_longitud->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
		<td data-name="geo_lati_final">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_lati_final" class="form-group cs_inicio_ejecucion_geo_lati_final">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_lati_final->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_lati_final->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_lati_final" class="form-group cs_inicio_ejecucion_geo_lati_final">
<span<?php echo $cs_inicio_ejecucion->geo_lati_final->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->geo_lati_final->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_lati_final" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_lati_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_lati_final->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
		<td data-name="geo_long_final">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_long_final" class="form-group cs_inicio_ejecucion_geo_long_final">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" size="30" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->geo_long_final->EditValue ?>"<?php echo $cs_inicio_ejecucion->geo_long_final->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_geo_long_final" class="form-group cs_inicio_ejecucion_geo_long_final">
<span<?php echo $cs_inicio_ejecucion->geo_long_final->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->geo_long_final->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_geo_long_final" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_geo_long_final" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->geo_long_final->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
		<td data-name="fecha_inicio">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_inicio" class="form-group cs_inicio_ejecucion_fecha_inicio">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_inicio->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_inicio->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_inicio" class="form-group cs_inicio_ejecucion_fecha_inicio">
<span<?php echo $cs_inicio_ejecucion->fecha_inicio->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->fecha_inicio->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_inicio" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_inicio" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_inicio->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
		<td data-name="estado_sol">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_sol" class="form-group cs_inicio_ejecucion_estado_sol">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->estado_sol->EditValue ?>"<?php echo $cs_inicio_ejecucion->estado_sol->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_estado_sol" class="form-group cs_inicio_ejecucion_estado_sol">
<span<?php echo $cs_inicio_ejecucion->estado_sol->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->estado_sol->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_estado_sol" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_estado_sol" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->estado_sol->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
		<td data-name="fecha_registro">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_registro" class="form-group cs_inicio_ejecucion_fecha_registro">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" data-format="5" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->fecha_registro->EditValue ?>"<?php echo $cs_inicio_ejecucion->fecha_registro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_fecha_registro" class="form-group cs_inicio_ejecucion_fecha_registro">
<span<?php echo $cs_inicio_ejecucion->fecha_registro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->fecha_registro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_fecha_registro" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_fecha_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->fecha_registro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
		<td data-name="user_registro">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_user_registro" class="form-group cs_inicio_ejecucion_user_registro">
<input type="text" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" size="30" maxlength="16" placeholder="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->getPlaceHolder()) ?>" value="<?php echo $cs_inicio_ejecucion->user_registro->EditValue ?>"<?php echo $cs_inicio_ejecucion->user_registro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_inicio_ejecucion_user_registro" class="form-group cs_inicio_ejecucion_user_registro">
<span<?php echo $cs_inicio_ejecucion->user_registro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_inicio_ejecucion->user_registro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="x<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_inicio_ejecucion" data-field="x_user_registro" name="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" id="o<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>_user_registro" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion->user_registro->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_inicio_ejecucion_grid->ListOptions->Render("body", "right", $cs_inicio_ejecucion_grid->RowCnt);
?>
<script type="text/javascript">
fcs_inicio_ejecuciongrid.UpdateOpts(<?php echo $cs_inicio_ejecucion_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cs_inicio_ejecucion->CurrentMode == "add" || $cs_inicio_ejecucion->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cs_inicio_ejecucion_grid->FormKeyCountName ?>" id="<?php echo $cs_inicio_ejecucion_grid->FormKeyCountName ?>" value="<?php echo $cs_inicio_ejecucion_grid->KeyCount ?>">
<?php echo $cs_inicio_ejecucion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cs_inicio_ejecucion_grid->FormKeyCountName ?>" id="<?php echo $cs_inicio_ejecucion_grid->FormKeyCountName ?>" value="<?php echo $cs_inicio_ejecucion_grid->KeyCount ?>">
<?php echo $cs_inicio_ejecucion_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcs_inicio_ejecuciongrid">
</div>
<?php

// Close recordset
if ($cs_inicio_ejecucion_grid->Recordset)
	$cs_inicio_ejecucion_grid->Recordset->Close();
?>
<?php if ($cs_inicio_ejecucion_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($cs_inicio_ejecucion_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cs_inicio_ejecucion_grid->TotalRecs == 0 && $cs_inicio_ejecucion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_inicio_ejecucion_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<script type="text/javascript">
fcs_inicio_ejecuciongrid.Init();
</script>
<?php } ?>
<?php
$cs_inicio_ejecucion_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$cs_inicio_ejecucion_grid->Page_Terminate();
?>
