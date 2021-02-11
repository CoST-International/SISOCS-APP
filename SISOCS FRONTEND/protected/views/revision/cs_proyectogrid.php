<?php include_once "cruge_userinfo.php" ?>
<?php

// Create page object
if (!isset($cs_proyecto_grid)) $cs_proyecto_grid = new ccs_proyecto_grid();

// Page init
$cs_proyecto_grid->Page_Init();

// Page main
$cs_proyecto_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_proyecto_grid->Page_Render();
?>
<?php if ($cs_proyecto->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcs_proyectogrid = new ew_Form("fcs_proyectogrid", "grid");
fcs_proyectogrid.FormKeyCountName = '<?php echo $cs_proyecto_grid->FormKeyCountName ?>';

// Validate form
fcs_proyectogrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_idPrograma");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_proyecto->idPrograma->FldCaption(), $cs_proyecto->idPrograma->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idPrograma");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idPrograma->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_codigo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $cs_proyecto->codigo->FldCaption(), $cs_proyecto->codigo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_idUbicacion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idUbicacion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idRegion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idRegion->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idDepto");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idDepto->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idTramo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idTramo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idRuta");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idRuta->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idTipoRed");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idTipoRed->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idProposito");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idProposito->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_presupuesto");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->presupuesto->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idFuncionario");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idFuncionario->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idfuente");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idfuente->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_idRol");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($cs_proyecto->idRol->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcs_proyectogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "idPrograma", false)) return false;
	if (ew_ValueChanged(fobj, infix, "codigo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idUbicacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idRegion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idDepto", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idTramo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idRuta", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idTipoRed", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idProposito", false)) return false;
	if (ew_ValueChanged(fobj, infix, "presupuesto", false)) return false;
	if (ew_ValueChanged(fobj, infix, "especiplano", false)) return false;
	if (ew_ValueChanged(fobj, infix, "presuprogra", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estudiofact", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estudioimpact", false)) return false;
	if (ew_ValueChanged(fobj, infix, "licambi", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estuimpactierra", false)) return false;
	if (ew_ValueChanged(fobj, infix, "planreasea", false)) return false;
	if (ew_ValueChanged(fobj, infix, "plananual", false)) return false;
	if (ew_ValueChanged(fobj, infix, "acuerdofinan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "otro", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechacreacion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idFuncionario", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fechaaprob", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idfuente", false)) return false;
	if (ew_ValueChanged(fobj, infix, "codsefin", false)) return false;
	if (ew_ValueChanged(fobj, infix, "notaprioridad", false)) return false;
	if (ew_ValueChanged(fobj, infix, "constanciabanco", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecharecibido", false)) return false;
	if (ew_ValueChanged(fobj, infix, "clase", false)) return false;
	if (ew_ValueChanged(fobj, infix, "entes", false)) return false;
	if (ew_ValueChanged(fobj, infix, "idRol", false)) return false;
	return true;
}

// Form_CustomValidate event
fcs_proyectogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_proyectogrid.ValidateRequired = true;
<?php } else { ?>
fcs_proyectogrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($cs_proyecto->CurrentAction == "gridadd") {
	if ($cs_proyecto->CurrentMode == "copy") {
		$bSelectLimit = $cs_proyecto_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$cs_proyecto_grid->TotalRecs = $cs_proyecto->SelectRecordCount();
			$cs_proyecto_grid->Recordset = $cs_proyecto_grid->LoadRecordset($cs_proyecto_grid->StartRec-1, $cs_proyecto_grid->DisplayRecs);
		} else {
			if ($cs_proyecto_grid->Recordset = $cs_proyecto_grid->LoadRecordset())
				$cs_proyecto_grid->TotalRecs = $cs_proyecto_grid->Recordset->RecordCount();
		}
		$cs_proyecto_grid->StartRec = 1;
		$cs_proyecto_grid->DisplayRecs = $cs_proyecto_grid->TotalRecs;
	} else {
		$cs_proyecto->CurrentFilter = "0=1";
		$cs_proyecto_grid->StartRec = 1;
		$cs_proyecto_grid->DisplayRecs = $cs_proyecto->GridAddRowCount;
	}
	$cs_proyecto_grid->TotalRecs = $cs_proyecto_grid->DisplayRecs;
	$cs_proyecto_grid->StopRec = $cs_proyecto_grid->DisplayRecs;
} else {
	$bSelectLimit = $cs_proyecto_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_proyecto_grid->TotalRecs <= 0)
			$cs_proyecto_grid->TotalRecs = $cs_proyecto->SelectRecordCount();
	} else {
		if (!$cs_proyecto_grid->Recordset && ($cs_proyecto_grid->Recordset = $cs_proyecto_grid->LoadRecordset()))
			$cs_proyecto_grid->TotalRecs = $cs_proyecto_grid->Recordset->RecordCount();
	}
	$cs_proyecto_grid->StartRec = 1;
	$cs_proyecto_grid->DisplayRecs = $cs_proyecto_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$cs_proyecto_grid->Recordset = $cs_proyecto_grid->LoadRecordset($cs_proyecto_grid->StartRec-1, $cs_proyecto_grid->DisplayRecs);

	// Set no record found message
	if ($cs_proyecto->CurrentAction == "" && $cs_proyecto_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_proyecto_grid->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_proyecto_grid->SearchWhere == "0=101")
			$cs_proyecto_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_proyecto_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$cs_proyecto_grid->RenderOtherOptions();
?>
<?php $cs_proyecto_grid->ShowPageHeader(); ?>
<?php
$cs_proyecto_grid->ShowMessage();
?>
<?php if ($cs_proyecto_grid->TotalRecs > 0 || $cs_proyecto->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<div id="fcs_proyectogrid" class="ewForm form-inline">
<div id="gmp_cs_proyecto" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_cs_proyectogrid" class="table ewTable">
<?php echo $cs_proyecto->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_proyecto_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_proyecto_grid->RenderListOptions();

// Render list options (header, left)
$cs_proyecto_grid->ListOptions->Render("header", "left");
?>
<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idProyecto) == "") { ?>
		<th data-name="idProyecto"><div id="elh_cs_proyecto_idProyecto" class="cs_proyecto_idProyecto"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProyecto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProyecto"><div><div id="elh_cs_proyecto_idProyecto" class="cs_proyecto_idProyecto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProyecto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idProyecto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idProyecto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idPrograma) == "") { ?>
		<th data-name="idPrograma"><div id="elh_cs_proyecto_idPrograma" class="cs_proyecto_idPrograma"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idPrograma->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idPrograma"><div><div id="elh_cs_proyecto_idPrograma" class="cs_proyecto_idPrograma">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idPrograma->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idPrograma->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idPrograma->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->codigo) == "") { ?>
		<th data-name="codigo"><div id="elh_cs_proyecto_codigo" class="cs_proyecto_codigo"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->codigo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo"><div><div id="elh_cs_proyecto_codigo" class="cs_proyecto_codigo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->codigo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->codigo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->codigo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idUbicacion) == "") { ?>
		<th data-name="idUbicacion"><div id="elh_cs_proyecto_idUbicacion" class="cs_proyecto_idUbicacion"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idUbicacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idUbicacion"><div><div id="elh_cs_proyecto_idUbicacion" class="cs_proyecto_idUbicacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idUbicacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idUbicacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idUbicacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idRegion) == "") { ?>
		<th data-name="idRegion"><div id="elh_cs_proyecto_idRegion" class="cs_proyecto_idRegion"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRegion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRegion"><div><div id="elh_cs_proyecto_idRegion" class="cs_proyecto_idRegion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRegion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idRegion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idRegion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idDepto) == "") { ?>
		<th data-name="idDepto"><div id="elh_cs_proyecto_idDepto" class="cs_proyecto_idDepto"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idDepto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idDepto"><div><div id="elh_cs_proyecto_idDepto" class="cs_proyecto_idDepto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idDepto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idDepto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idDepto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idTramo) == "") { ?>
		<th data-name="idTramo"><div id="elh_cs_proyecto_idTramo" class="cs_proyecto_idTramo"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTramo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idTramo"><div><div id="elh_cs_proyecto_idTramo" class="cs_proyecto_idTramo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTramo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idTramo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idTramo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idRuta) == "") { ?>
		<th data-name="idRuta"><div id="elh_cs_proyecto_idRuta" class="cs_proyecto_idRuta"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRuta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRuta"><div><div id="elh_cs_proyecto_idRuta" class="cs_proyecto_idRuta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRuta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idRuta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idRuta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idTipoRed) == "") { ?>
		<th data-name="idTipoRed"><div id="elh_cs_proyecto_idTipoRed" class="cs_proyecto_idTipoRed"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTipoRed->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idTipoRed"><div><div id="elh_cs_proyecto_idTipoRed" class="cs_proyecto_idTipoRed">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTipoRed->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idTipoRed->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idTipoRed->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idProposito) == "") { ?>
		<th data-name="idProposito"><div id="elh_cs_proyecto_idProposito" class="cs_proyecto_idProposito"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProposito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProposito"><div><div id="elh_cs_proyecto_idProposito" class="cs_proyecto_idProposito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProposito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idProposito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idProposito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->presupuesto) == "") { ?>
		<th data-name="presupuesto"><div id="elh_cs_proyecto_presupuesto" class="cs_proyecto_presupuesto"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->presupuesto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presupuesto"><div><div id="elh_cs_proyecto_presupuesto" class="cs_proyecto_presupuesto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->presupuesto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->presupuesto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->presupuesto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->especiplano) == "") { ?>
		<th data-name="especiplano"><div id="elh_cs_proyecto_especiplano" class="cs_proyecto_especiplano"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->especiplano->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="especiplano"><div><div id="elh_cs_proyecto_especiplano" class="cs_proyecto_especiplano">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->especiplano->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->especiplano->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->especiplano->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->presuprogra) == "") { ?>
		<th data-name="presuprogra"><div id="elh_cs_proyecto_presuprogra" class="cs_proyecto_presuprogra"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->presuprogra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presuprogra"><div><div id="elh_cs_proyecto_presuprogra" class="cs_proyecto_presuprogra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->presuprogra->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->presuprogra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->presuprogra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estudiofact) == "") { ?>
		<th data-name="estudiofact"><div id="elh_cs_proyecto_estudiofact" class="cs_proyecto_estudiofact"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudiofact->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estudiofact"><div><div id="elh_cs_proyecto_estudiofact" class="cs_proyecto_estudiofact">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudiofact->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estudiofact->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estudiofact->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estudioimpact) == "") { ?>
		<th data-name="estudioimpact"><div id="elh_cs_proyecto_estudioimpact" class="cs_proyecto_estudioimpact"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudioimpact->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estudioimpact"><div><div id="elh_cs_proyecto_estudioimpact" class="cs_proyecto_estudioimpact">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudioimpact->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estudioimpact->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estudioimpact->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->licambi) == "") { ?>
		<th data-name="licambi"><div id="elh_cs_proyecto_licambi" class="cs_proyecto_licambi"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->licambi->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="licambi"><div><div id="elh_cs_proyecto_licambi" class="cs_proyecto_licambi">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->licambi->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->licambi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->licambi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estuimpactierra) == "") { ?>
		<th data-name="estuimpactierra"><div id="elh_cs_proyecto_estuimpactierra" class="cs_proyecto_estuimpactierra"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estuimpactierra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estuimpactierra"><div><div id="elh_cs_proyecto_estuimpactierra" class="cs_proyecto_estuimpactierra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estuimpactierra->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estuimpactierra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estuimpactierra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->planreasea) == "") { ?>
		<th data-name="planreasea"><div id="elh_cs_proyecto_planreasea" class="cs_proyecto_planreasea"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->planreasea->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planreasea"><div><div id="elh_cs_proyecto_planreasea" class="cs_proyecto_planreasea">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->planreasea->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->planreasea->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->planreasea->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->plananual) == "") { ?>
		<th data-name="plananual"><div id="elh_cs_proyecto_plananual" class="cs_proyecto_plananual"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->plananual->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plananual"><div><div id="elh_cs_proyecto_plananual" class="cs_proyecto_plananual">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->plananual->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->plananual->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->plananual->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->acuerdofinan) == "") { ?>
		<th data-name="acuerdofinan"><div id="elh_cs_proyecto_acuerdofinan" class="cs_proyecto_acuerdofinan"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->acuerdofinan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acuerdofinan"><div><div id="elh_cs_proyecto_acuerdofinan" class="cs_proyecto_acuerdofinan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->acuerdofinan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->acuerdofinan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->acuerdofinan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->otro->Visible) { // otro ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->otro) == "") { ?>
		<th data-name="otro"><div id="elh_cs_proyecto_otro" class="cs_proyecto_otro"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->otro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro"><div><div id="elh_cs_proyecto_otro" class="cs_proyecto_otro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->otro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->otro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->otro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->fechacreacion) == "") { ?>
		<th data-name="fechacreacion"><div id="elh_cs_proyecto_fechacreacion" class="cs_proyecto_fechacreacion"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechacreacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechacreacion"><div><div id="elh_cs_proyecto_fechacreacion" class="cs_proyecto_fechacreacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechacreacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->fechacreacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->fechacreacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estado->Visible) { // estado ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_proyecto_estado" class="cs_proyecto_estado"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div><div id="elh_cs_proyecto_estado" class="cs_proyecto_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idFuncionario) == "") { ?>
		<th data-name="idFuncionario"><div id="elh_cs_proyecto_idFuncionario" class="cs_proyecto_idFuncionario"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idFuncionario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idFuncionario"><div><div id="elh_cs_proyecto_idFuncionario" class="cs_proyecto_idFuncionario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idFuncionario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idFuncionario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idFuncionario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->fechaaprob) == "") { ?>
		<th data-name="fechaaprob"><div id="elh_cs_proyecto_fechaaprob" class="cs_proyecto_fechaaprob"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechaaprob->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaaprob"><div><div id="elh_cs_proyecto_fechaaprob" class="cs_proyecto_fechaaprob">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechaaprob->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->fechaaprob->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->fechaaprob->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idfuente) == "") { ?>
		<th data-name="idfuente"><div id="elh_cs_proyecto_idfuente" class="cs_proyecto_idfuente"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idfuente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfuente"><div><div id="elh_cs_proyecto_idfuente" class="cs_proyecto_idfuente">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idfuente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idfuente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idfuente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->codsefin) == "") { ?>
		<th data-name="codsefin"><div id="elh_cs_proyecto_codsefin" class="cs_proyecto_codsefin"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->codsefin->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codsefin"><div><div id="elh_cs_proyecto_codsefin" class="cs_proyecto_codsefin">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->codsefin->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->codsefin->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->codsefin->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->notaprioridad) == "") { ?>
		<th data-name="notaprioridad"><div id="elh_cs_proyecto_notaprioridad" class="cs_proyecto_notaprioridad"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->notaprioridad->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="notaprioridad"><div><div id="elh_cs_proyecto_notaprioridad" class="cs_proyecto_notaprioridad">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->notaprioridad->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->notaprioridad->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->notaprioridad->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->constanciabanco) == "") { ?>
		<th data-name="constanciabanco"><div id="elh_cs_proyecto_constanciabanco" class="cs_proyecto_constanciabanco"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->constanciabanco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="constanciabanco"><div><div id="elh_cs_proyecto_constanciabanco" class="cs_proyecto_constanciabanco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->constanciabanco->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->constanciabanco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->constanciabanco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_proyecto_fecharecibido" class="cs_proyecto_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div><div id="elh_cs_proyecto_fecharecibido" class="cs_proyecto_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->fecharecibido->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->clase->Visible) { // clase ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->clase) == "") { ?>
		<th data-name="clase"><div id="elh_cs_proyecto_clase" class="cs_proyecto_clase"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->clase->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="clase"><div><div id="elh_cs_proyecto_clase" class="cs_proyecto_clase">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->clase->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->clase->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->clase->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->entes->Visible) { // entes ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->entes) == "") { ?>
		<th data-name="entes"><div id="elh_cs_proyecto_entes" class="cs_proyecto_entes"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->entes->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="entes"><div><div id="elh_cs_proyecto_entes" class="cs_proyecto_entes">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->entes->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->entes->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->entes->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idRol) == "") { ?>
		<th data-name="idRol"><div id="elh_cs_proyecto_idRol" class="cs_proyecto_idRol"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRol"><div><div id="elh_cs_proyecto_idRol" class="cs_proyecto_idRol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idRol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idRol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_proyecto_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$cs_proyecto_grid->StartRec = 1;
$cs_proyecto_grid->StopRec = $cs_proyecto_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($cs_proyecto_grid->FormKeyCountName) && ($cs_proyecto->CurrentAction == "gridadd" || $cs_proyecto->CurrentAction == "gridedit" || $cs_proyecto->CurrentAction == "F")) {
		$cs_proyecto_grid->KeyCount = $objForm->GetValue($cs_proyecto_grid->FormKeyCountName);
		$cs_proyecto_grid->StopRec = $cs_proyecto_grid->StartRec + $cs_proyecto_grid->KeyCount - 1;
	}
}
$cs_proyecto_grid->RecCnt = $cs_proyecto_grid->StartRec - 1;
if ($cs_proyecto_grid->Recordset && !$cs_proyecto_grid->Recordset->EOF) {
	$cs_proyecto_grid->Recordset->MoveFirst();
	$bSelectLimit = $cs_proyecto_grid->UseSelectLimit;
	if (!$bSelectLimit && $cs_proyecto_grid->StartRec > 1)
		$cs_proyecto_grid->Recordset->Move($cs_proyecto_grid->StartRec - 1);
} elseif (!$cs_proyecto->AllowAddDeleteRow && $cs_proyecto_grid->StopRec == 0) {
	$cs_proyecto_grid->StopRec = $cs_proyecto->GridAddRowCount;
}

// Initialize aggregate
$cs_proyecto->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_proyecto->ResetAttrs();
$cs_proyecto_grid->RenderRow();
if ($cs_proyecto->CurrentAction == "gridadd")
	$cs_proyecto_grid->RowIndex = 0;
if ($cs_proyecto->CurrentAction == "gridedit")
	$cs_proyecto_grid->RowIndex = 0;
while ($cs_proyecto_grid->RecCnt < $cs_proyecto_grid->StopRec) {
	$cs_proyecto_grid->RecCnt++;
	if (intval($cs_proyecto_grid->RecCnt) >= intval($cs_proyecto_grid->StartRec)) {
		$cs_proyecto_grid->RowCnt++;
		if ($cs_proyecto->CurrentAction == "gridadd" || $cs_proyecto->CurrentAction == "gridedit" || $cs_proyecto->CurrentAction == "F") {
			$cs_proyecto_grid->RowIndex++;
			$objForm->Index = $cs_proyecto_grid->RowIndex;
			if ($objForm->HasValue($cs_proyecto_grid->FormActionName))
				$cs_proyecto_grid->RowAction = strval($objForm->GetValue($cs_proyecto_grid->FormActionName));
			elseif ($cs_proyecto->CurrentAction == "gridadd")
				$cs_proyecto_grid->RowAction = "insert";
			else
				$cs_proyecto_grid->RowAction = "";
		}

		// Set up key count
		$cs_proyecto_grid->KeyCount = $cs_proyecto_grid->RowIndex;

		// Init row class and style
		$cs_proyecto->ResetAttrs();
		$cs_proyecto->CssClass = "";
		if ($cs_proyecto->CurrentAction == "gridadd") {
			if ($cs_proyecto->CurrentMode == "copy") {
				$cs_proyecto_grid->LoadRowValues($cs_proyecto_grid->Recordset); // Load row values
				$cs_proyecto_grid->SetRecordKey($cs_proyecto_grid->RowOldKey, $cs_proyecto_grid->Recordset); // Set old record key
			} else {
				$cs_proyecto_grid->LoadDefaultValues(); // Load default values
				$cs_proyecto_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$cs_proyecto_grid->LoadRowValues($cs_proyecto_grid->Recordset); // Load row values
		}
		$cs_proyecto->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($cs_proyecto->CurrentAction == "gridadd") // Grid add
			$cs_proyecto->RowType = EW_ROWTYPE_ADD; // Render add
		if ($cs_proyecto->CurrentAction == "gridadd" && $cs_proyecto->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$cs_proyecto_grid->RestoreCurrentRowFormValues($cs_proyecto_grid->RowIndex); // Restore form values
		if ($cs_proyecto->CurrentAction == "gridedit") { // Grid edit
			if ($cs_proyecto->EventCancelled) {
				$cs_proyecto_grid->RestoreCurrentRowFormValues($cs_proyecto_grid->RowIndex); // Restore form values
			}
			if ($cs_proyecto_grid->RowAction == "insert")
				$cs_proyecto->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$cs_proyecto->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($cs_proyecto->CurrentAction == "gridedit" && ($cs_proyecto->RowType == EW_ROWTYPE_EDIT || $cs_proyecto->RowType == EW_ROWTYPE_ADD) && $cs_proyecto->EventCancelled) // Update failed
			$cs_proyecto_grid->RestoreCurrentRowFormValues($cs_proyecto_grid->RowIndex); // Restore form values
		if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) // Edit row
			$cs_proyecto_grid->EditRowCnt++;
		if ($cs_proyecto->CurrentAction == "F") // Confirm row
			$cs_proyecto_grid->RestoreCurrentRowFormValues($cs_proyecto_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$cs_proyecto->RowAttrs = array_merge($cs_proyecto->RowAttrs, array('data-rowindex'=>$cs_proyecto_grid->RowCnt, 'id'=>'r' . $cs_proyecto_grid->RowCnt . '_cs_proyecto', 'data-rowtype'=>$cs_proyecto->RowType));

		// Render row
		$cs_proyecto_grid->RenderRow();

		// Render list options
		$cs_proyecto_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($cs_proyecto_grid->RowAction <> "delete" && $cs_proyecto_grid->RowAction <> "insertdelete" && !($cs_proyecto_grid->RowAction == "insert" && $cs_proyecto->CurrentAction == "F" && $cs_proyecto_grid->EmptyRow())) {
?>
	<tr<?php echo $cs_proyecto->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_proyecto_grid->ListOptions->Render("body", "left", $cs_proyecto_grid->RowCnt);
?>
	<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
		<td data-name="idProyecto"<?php echo $cs_proyecto->idProyecto->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProyecto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_proyecto->idProyecto->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idProyecto" class="form-group cs_proyecto_idProyecto">
<span<?php echo $cs_proyecto->idProyecto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idProyecto->EditValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProyecto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_proyecto->idProyecto->CurrentValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idProyecto" class="cs_proyecto_idProyecto">
<span<?php echo $cs_proyecto->idProyecto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProyecto->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProyecto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_proyecto->idProyecto->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idProyecto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_proyecto->idProyecto->OldValue) ?>">
<?php } ?>
<a id="<?php echo $cs_proyecto_grid->PageObjName . "_row_" . $cs_proyecto_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
		<td data-name="idPrograma"<?php echo $cs_proyecto->idPrograma->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($cs_proyecto->idPrograma->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idPrograma->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<input type="text" data-table="cs_proyecto" data-field="x_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idPrograma->EditValue ?>"<?php echo $cs_proyecto->idPrograma->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idPrograma" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($cs_proyecto->idPrograma->getSessionValue() <> "") { ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idPrograma->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<input type="text" data-table="cs_proyecto" data-field="x_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idPrograma->EditValue ?>"<?php echo $cs_proyecto->idPrograma->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idPrograma" class="cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<?php echo $cs_proyecto->idPrograma->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idPrograma" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cs_proyecto->codigo->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_codigo" class="form-group cs_proyecto_codigo">
<input type="text" data-table="cs_proyecto" data-field="x_codigo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->codigo->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->codigo->EditValue ?>"<?php echo $cs_proyecto->codigo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_codigo" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_proyecto->codigo->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_codigo" class="form-group cs_proyecto_codigo">
<input type="text" data-table="cs_proyecto" data-field="x_codigo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->codigo->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->codigo->EditValue ?>"<?php echo $cs_proyecto->codigo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_codigo" class="cs_proyecto_codigo">
<span<?php echo $cs_proyecto->codigo->ViewAttributes() ?>>
<?php echo $cs_proyecto->codigo->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_codigo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_proyecto->codigo->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_codigo" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_proyecto->codigo->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
		<td data-name="idUbicacion"<?php echo $cs_proyecto->idUbicacion->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idUbicacion" class="form-group cs_proyecto_idUbicacion">
<input type="text" data-table="cs_proyecto" data-field="x_idUbicacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idUbicacion->EditValue ?>"<?php echo $cs_proyecto->idUbicacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idUbicacion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" value="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idUbicacion" class="form-group cs_proyecto_idUbicacion">
<input type="text" data-table="cs_proyecto" data-field="x_idUbicacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idUbicacion->EditValue ?>"<?php echo $cs_proyecto->idUbicacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idUbicacion" class="cs_proyecto_idUbicacion">
<span<?php echo $cs_proyecto->idUbicacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idUbicacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idUbicacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" value="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idUbicacion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" value="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
		<td data-name="idRegion"<?php echo $cs_proyecto->idRegion->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRegion" class="form-group cs_proyecto_idRegion">
<input type="text" data-table="cs_proyecto" data-field="x_idRegion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRegion->EditValue ?>"<?php echo $cs_proyecto->idRegion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRegion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" value="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRegion" class="form-group cs_proyecto_idRegion">
<input type="text" data-table="cs_proyecto" data-field="x_idRegion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRegion->EditValue ?>"<?php echo $cs_proyecto->idRegion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRegion" class="cs_proyecto_idRegion">
<span<?php echo $cs_proyecto->idRegion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRegion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRegion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" value="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idRegion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" value="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
		<td data-name="idDepto"<?php echo $cs_proyecto->idDepto->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idDepto" class="form-group cs_proyecto_idDepto">
<input type="text" data-table="cs_proyecto" data-field="x_idDepto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idDepto->EditValue ?>"<?php echo $cs_proyecto->idDepto->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idDepto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" value="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idDepto" class="form-group cs_proyecto_idDepto">
<input type="text" data-table="cs_proyecto" data-field="x_idDepto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idDepto->EditValue ?>"<?php echo $cs_proyecto->idDepto->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idDepto" class="cs_proyecto_idDepto">
<span<?php echo $cs_proyecto->idDepto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idDepto->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idDepto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" value="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idDepto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" value="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
		<td data-name="idTramo"<?php echo $cs_proyecto->idTramo->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idTramo" class="form-group cs_proyecto_idTramo">
<input type="text" data-table="cs_proyecto" data-field="x_idTramo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idTramo->EditValue ?>"<?php echo $cs_proyecto->idTramo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTramo" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" value="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idTramo" class="form-group cs_proyecto_idTramo">
<input type="text" data-table="cs_proyecto" data-field="x_idTramo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idTramo->EditValue ?>"<?php echo $cs_proyecto->idTramo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idTramo" class="cs_proyecto_idTramo">
<span<?php echo $cs_proyecto->idTramo->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTramo->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTramo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" value="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idTramo" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" value="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
		<td data-name="idRuta"<?php echo $cs_proyecto->idRuta->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRuta" class="form-group cs_proyecto_idRuta">
<input type="text" data-table="cs_proyecto" data-field="x_idRuta" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRuta->EditValue ?>"<?php echo $cs_proyecto->idRuta->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRuta" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" value="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRuta" class="form-group cs_proyecto_idRuta">
<input type="text" data-table="cs_proyecto" data-field="x_idRuta" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRuta->EditValue ?>"<?php echo $cs_proyecto->idRuta->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRuta" class="cs_proyecto_idRuta">
<span<?php echo $cs_proyecto->idRuta->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRuta->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRuta" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" value="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idRuta" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" value="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
		<td data-name="idTipoRed"<?php echo $cs_proyecto->idTipoRed->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idTipoRed" class="form-group cs_proyecto_idTipoRed">
<input type="text" data-table="cs_proyecto" data-field="x_idTipoRed" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idTipoRed->EditValue ?>"<?php echo $cs_proyecto->idTipoRed->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTipoRed" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" value="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idTipoRed" class="form-group cs_proyecto_idTipoRed">
<input type="text" data-table="cs_proyecto" data-field="x_idTipoRed" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idTipoRed->EditValue ?>"<?php echo $cs_proyecto->idTipoRed->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idTipoRed" class="cs_proyecto_idTipoRed">
<span<?php echo $cs_proyecto->idTipoRed->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTipoRed->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTipoRed" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" value="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idTipoRed" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" value="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
		<td data-name="idProposito"<?php echo $cs_proyecto->idProposito->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idProposito" class="form-group cs_proyecto_idProposito">
<input type="text" data-table="cs_proyecto" data-field="x_idProposito" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idProposito->EditValue ?>"<?php echo $cs_proyecto->idProposito->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProposito" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" value="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idProposito" class="form-group cs_proyecto_idProposito">
<input type="text" data-table="cs_proyecto" data-field="x_idProposito" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idProposito->EditValue ?>"<?php echo $cs_proyecto->idProposito->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idProposito" class="cs_proyecto_idProposito">
<span<?php echo $cs_proyecto->idProposito->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProposito->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProposito" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" value="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idProposito" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" value="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
		<td data-name="presupuesto"<?php echo $cs_proyecto->presupuesto->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_presupuesto" class="form-group cs_proyecto_presupuesto">
<input type="text" data-table="cs_proyecto" data-field="x_presupuesto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->presupuesto->EditValue ?>"<?php echo $cs_proyecto->presupuesto->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_presupuesto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" value="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_presupuesto" class="form-group cs_proyecto_presupuesto">
<input type="text" data-table="cs_proyecto" data-field="x_presupuesto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->presupuesto->EditValue ?>"<?php echo $cs_proyecto->presupuesto->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_presupuesto" class="cs_proyecto_presupuesto">
<span<?php echo $cs_proyecto->presupuesto->ViewAttributes() ?>>
<?php echo $cs_proyecto->presupuesto->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_presupuesto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" value="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_presupuesto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" value="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
		<td data-name="especiplano"<?php echo $cs_proyecto->especiplano->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_especiplano" class="form-group cs_proyecto_especiplano">
<input type="text" data-table="cs_proyecto" data-field="x_especiplano" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->especiplano->EditValue ?>"<?php echo $cs_proyecto->especiplano->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_especiplano" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" value="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_especiplano" class="form-group cs_proyecto_especiplano">
<input type="text" data-table="cs_proyecto" data-field="x_especiplano" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->especiplano->EditValue ?>"<?php echo $cs_proyecto->especiplano->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_especiplano" class="cs_proyecto_especiplano">
<span<?php echo $cs_proyecto->especiplano->ViewAttributes() ?>>
<?php echo $cs_proyecto->especiplano->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_especiplano" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" value="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_especiplano" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" value="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
		<td data-name="presuprogra"<?php echo $cs_proyecto->presuprogra->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_presuprogra" class="form-group cs_proyecto_presuprogra">
<input type="text" data-table="cs_proyecto" data-field="x_presuprogra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->presuprogra->EditValue ?>"<?php echo $cs_proyecto->presuprogra->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_presuprogra" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" value="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_presuprogra" class="form-group cs_proyecto_presuprogra">
<input type="text" data-table="cs_proyecto" data-field="x_presuprogra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->presuprogra->EditValue ?>"<?php echo $cs_proyecto->presuprogra->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_presuprogra" class="cs_proyecto_presuprogra">
<span<?php echo $cs_proyecto->presuprogra->ViewAttributes() ?>>
<?php echo $cs_proyecto->presuprogra->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_presuprogra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" value="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_presuprogra" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" value="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
		<td data-name="estudiofact"<?php echo $cs_proyecto->estudiofact->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estudiofact" class="form-group cs_proyecto_estudiofact">
<input type="text" data-table="cs_proyecto" data-field="x_estudiofact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estudiofact->EditValue ?>"<?php echo $cs_proyecto->estudiofact->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudiofact" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estudiofact" class="form-group cs_proyecto_estudiofact">
<input type="text" data-table="cs_proyecto" data-field="x_estudiofact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estudiofact->EditValue ?>"<?php echo $cs_proyecto->estudiofact->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estudiofact" class="cs_proyecto_estudiofact">
<span<?php echo $cs_proyecto->estudiofact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudiofact->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudiofact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_estudiofact" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
		<td data-name="estudioimpact"<?php echo $cs_proyecto->estudioimpact->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estudioimpact" class="form-group cs_proyecto_estudioimpact">
<input type="text" data-table="cs_proyecto" data-field="x_estudioimpact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estudioimpact->EditValue ?>"<?php echo $cs_proyecto->estudioimpact->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudioimpact" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estudioimpact" class="form-group cs_proyecto_estudioimpact">
<input type="text" data-table="cs_proyecto" data-field="x_estudioimpact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estudioimpact->EditValue ?>"<?php echo $cs_proyecto->estudioimpact->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estudioimpact" class="cs_proyecto_estudioimpact">
<span<?php echo $cs_proyecto->estudioimpact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudioimpact->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudioimpact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_estudioimpact" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
		<td data-name="licambi"<?php echo $cs_proyecto->licambi->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_licambi" class="form-group cs_proyecto_licambi">
<input type="text" data-table="cs_proyecto" data-field="x_licambi" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->licambi->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->licambi->EditValue ?>"<?php echo $cs_proyecto->licambi->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_licambi" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" value="<?php echo ew_HtmlEncode($cs_proyecto->licambi->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_licambi" class="form-group cs_proyecto_licambi">
<input type="text" data-table="cs_proyecto" data-field="x_licambi" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->licambi->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->licambi->EditValue ?>"<?php echo $cs_proyecto->licambi->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_licambi" class="cs_proyecto_licambi">
<span<?php echo $cs_proyecto->licambi->ViewAttributes() ?>>
<?php echo $cs_proyecto->licambi->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_licambi" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" value="<?php echo ew_HtmlEncode($cs_proyecto->licambi->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_licambi" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" value="<?php echo ew_HtmlEncode($cs_proyecto->licambi->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
		<td data-name="estuimpactierra"<?php echo $cs_proyecto->estuimpactierra->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estuimpactierra" class="form-group cs_proyecto_estuimpactierra">
<input type="text" data-table="cs_proyecto" data-field="x_estuimpactierra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estuimpactierra->EditValue ?>"<?php echo $cs_proyecto->estuimpactierra->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estuimpactierra" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" value="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estuimpactierra" class="form-group cs_proyecto_estuimpactierra">
<input type="text" data-table="cs_proyecto" data-field="x_estuimpactierra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estuimpactierra->EditValue ?>"<?php echo $cs_proyecto->estuimpactierra->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estuimpactierra" class="cs_proyecto_estuimpactierra">
<span<?php echo $cs_proyecto->estuimpactierra->ViewAttributes() ?>>
<?php echo $cs_proyecto->estuimpactierra->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estuimpactierra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" value="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_estuimpactierra" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" value="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
		<td data-name="planreasea"<?php echo $cs_proyecto->planreasea->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_planreasea" class="form-group cs_proyecto_planreasea">
<input type="text" data-table="cs_proyecto" data-field="x_planreasea" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->planreasea->EditValue ?>"<?php echo $cs_proyecto->planreasea->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_planreasea" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" value="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_planreasea" class="form-group cs_proyecto_planreasea">
<input type="text" data-table="cs_proyecto" data-field="x_planreasea" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->planreasea->EditValue ?>"<?php echo $cs_proyecto->planreasea->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_planreasea" class="cs_proyecto_planreasea">
<span<?php echo $cs_proyecto->planreasea->ViewAttributes() ?>>
<?php echo $cs_proyecto->planreasea->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_planreasea" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" value="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_planreasea" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" value="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
		<td data-name="plananual"<?php echo $cs_proyecto->plananual->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_plananual" class="form-group cs_proyecto_plananual">
<input type="text" data-table="cs_proyecto" data-field="x_plananual" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->plananual->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->plananual->EditValue ?>"<?php echo $cs_proyecto->plananual->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_plananual" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" value="<?php echo ew_HtmlEncode($cs_proyecto->plananual->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_plananual" class="form-group cs_proyecto_plananual">
<input type="text" data-table="cs_proyecto" data-field="x_plananual" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->plananual->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->plananual->EditValue ?>"<?php echo $cs_proyecto->plananual->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_plananual" class="cs_proyecto_plananual">
<span<?php echo $cs_proyecto->plananual->ViewAttributes() ?>>
<?php echo $cs_proyecto->plananual->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_plananual" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" value="<?php echo ew_HtmlEncode($cs_proyecto->plananual->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_plananual" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" value="<?php echo ew_HtmlEncode($cs_proyecto->plananual->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
		<td data-name="acuerdofinan"<?php echo $cs_proyecto->acuerdofinan->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_acuerdofinan" class="form-group cs_proyecto_acuerdofinan">
<input type="text" data-table="cs_proyecto" data-field="x_acuerdofinan" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->acuerdofinan->EditValue ?>"<?php echo $cs_proyecto->acuerdofinan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_acuerdofinan" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" value="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_acuerdofinan" class="form-group cs_proyecto_acuerdofinan">
<input type="text" data-table="cs_proyecto" data-field="x_acuerdofinan" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->acuerdofinan->EditValue ?>"<?php echo $cs_proyecto->acuerdofinan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_acuerdofinan" class="cs_proyecto_acuerdofinan">
<span<?php echo $cs_proyecto->acuerdofinan->ViewAttributes() ?>>
<?php echo $cs_proyecto->acuerdofinan->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_acuerdofinan" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" value="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_acuerdofinan" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" value="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->otro->Visible) { // otro ?>
		<td data-name="otro"<?php echo $cs_proyecto->otro->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_otro" class="form-group cs_proyecto_otro">
<input type="text" data-table="cs_proyecto" data-field="x_otro" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->otro->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->otro->EditValue ?>"<?php echo $cs_proyecto->otro->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_otro" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_proyecto->otro->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_otro" class="form-group cs_proyecto_otro">
<input type="text" data-table="cs_proyecto" data-field="x_otro" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->otro->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->otro->EditValue ?>"<?php echo $cs_proyecto->otro->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_otro" class="cs_proyecto_otro">
<span<?php echo $cs_proyecto->otro->ViewAttributes() ?>>
<?php echo $cs_proyecto->otro->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_otro" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_proyecto->otro->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_otro" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_proyecto->otro->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion"<?php echo $cs_proyecto->fechacreacion->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fechacreacion" class="form-group cs_proyecto_fechacreacion">
<input type="text" data-table="cs_proyecto" data-field="x_fechacreacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fechacreacion->EditValue ?>"<?php echo $cs_proyecto->fechacreacion->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechacreacion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fechacreacion" class="form-group cs_proyecto_fechacreacion">
<input type="text" data-table="cs_proyecto" data-field="x_fechacreacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fechacreacion->EditValue ?>"<?php echo $cs_proyecto->fechacreacion->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fechacreacion" class="cs_proyecto_fechacreacion">
<span<?php echo $cs_proyecto->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechacreacion->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechacreacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_fechacreacion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_proyecto->estado->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estado" class="form-group cs_proyecto_estado">
<input type="text" data-table="cs_proyecto" data-field="x_estado" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estado->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estado->EditValue ?>"<?php echo $cs_proyecto->estado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estado" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_proyecto->estado->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estado" class="form-group cs_proyecto_estado">
<input type="text" data-table="cs_proyecto" data-field="x_estado" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estado->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estado->EditValue ?>"<?php echo $cs_proyecto->estado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_estado" class="cs_proyecto_estado">
<span<?php echo $cs_proyecto->estado->ViewAttributes() ?>>
<?php echo $cs_proyecto->estado->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estado" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_proyecto->estado->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_estado" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_proyecto->estado->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario"<?php echo $cs_proyecto->idFuncionario->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idFuncionario" class="form-group cs_proyecto_idFuncionario">
<input type="text" data-table="cs_proyecto" data-field="x_idFuncionario" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idFuncionario->EditValue ?>"<?php echo $cs_proyecto->idFuncionario->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idFuncionario" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idFuncionario" class="form-group cs_proyecto_idFuncionario">
<input type="text" data-table="cs_proyecto" data-field="x_idFuncionario" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idFuncionario->EditValue ?>"<?php echo $cs_proyecto->idFuncionario->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idFuncionario" class="cs_proyecto_idFuncionario">
<span<?php echo $cs_proyecto->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_proyecto->idFuncionario->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idFuncionario" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idFuncionario" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
		<td data-name="fechaaprob"<?php echo $cs_proyecto->fechaaprob->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fechaaprob" class="form-group cs_proyecto_fechaaprob">
<input type="text" data-table="cs_proyecto" data-field="x_fechaaprob" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fechaaprob->EditValue ?>"<?php echo $cs_proyecto->fechaaprob->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechaaprob" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" value="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fechaaprob" class="form-group cs_proyecto_fechaaprob">
<input type="text" data-table="cs_proyecto" data-field="x_fechaaprob" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fechaaprob->EditValue ?>"<?php echo $cs_proyecto->fechaaprob->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fechaaprob" class="cs_proyecto_fechaaprob">
<span<?php echo $cs_proyecto->fechaaprob->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechaaprob->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechaaprob" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" value="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_fechaaprob" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" value="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
		<td data-name="idfuente"<?php echo $cs_proyecto->idfuente->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idfuente" class="form-group cs_proyecto_idfuente">
<input type="text" data-table="cs_proyecto" data-field="x_idfuente" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idfuente->EditValue ?>"<?php echo $cs_proyecto->idfuente->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idfuente" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" value="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idfuente" class="form-group cs_proyecto_idfuente">
<input type="text" data-table="cs_proyecto" data-field="x_idfuente" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idfuente->EditValue ?>"<?php echo $cs_proyecto->idfuente->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idfuente" class="cs_proyecto_idfuente">
<span<?php echo $cs_proyecto->idfuente->ViewAttributes() ?>>
<?php echo $cs_proyecto->idfuente->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idfuente" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" value="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idfuente" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" value="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
		<td data-name="codsefin"<?php echo $cs_proyecto->codsefin->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_codsefin" class="form-group cs_proyecto_codsefin">
<input type="text" data-table="cs_proyecto" data-field="x_codsefin" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->codsefin->EditValue ?>"<?php echo $cs_proyecto->codsefin->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_codsefin" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" value="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_codsefin" class="form-group cs_proyecto_codsefin">
<input type="text" data-table="cs_proyecto" data-field="x_codsefin" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->codsefin->EditValue ?>"<?php echo $cs_proyecto->codsefin->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_codsefin" class="cs_proyecto_codsefin">
<span<?php echo $cs_proyecto->codsefin->ViewAttributes() ?>>
<?php echo $cs_proyecto->codsefin->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_codsefin" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" value="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_codsefin" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" value="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
		<td data-name="notaprioridad"<?php echo $cs_proyecto->notaprioridad->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_notaprioridad" class="form-group cs_proyecto_notaprioridad">
<input type="text" data-table="cs_proyecto" data-field="x_notaprioridad" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->notaprioridad->EditValue ?>"<?php echo $cs_proyecto->notaprioridad->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_notaprioridad" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" value="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_notaprioridad" class="form-group cs_proyecto_notaprioridad">
<input type="text" data-table="cs_proyecto" data-field="x_notaprioridad" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->notaprioridad->EditValue ?>"<?php echo $cs_proyecto->notaprioridad->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_notaprioridad" class="cs_proyecto_notaprioridad">
<span<?php echo $cs_proyecto->notaprioridad->ViewAttributes() ?>>
<?php echo $cs_proyecto->notaprioridad->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_notaprioridad" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" value="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_notaprioridad" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" value="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
		<td data-name="constanciabanco"<?php echo $cs_proyecto->constanciabanco->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_constanciabanco" class="form-group cs_proyecto_constanciabanco">
<input type="text" data-table="cs_proyecto" data-field="x_constanciabanco" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->constanciabanco->EditValue ?>"<?php echo $cs_proyecto->constanciabanco->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_constanciabanco" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" value="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_constanciabanco" class="form-group cs_proyecto_constanciabanco">
<input type="text" data-table="cs_proyecto" data-field="x_constanciabanco" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->constanciabanco->EditValue ?>"<?php echo $cs_proyecto->constanciabanco->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_constanciabanco" class="cs_proyecto_constanciabanco">
<span<?php echo $cs_proyecto->constanciabanco->ViewAttributes() ?>>
<?php echo $cs_proyecto->constanciabanco->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_constanciabanco" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" value="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_constanciabanco" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" value="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_proyecto->fecharecibido->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fecharecibido" class="form-group cs_proyecto_fecharecibido">
<input type="text" data-table="cs_proyecto" data-field="x_fecharecibido" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fecharecibido->EditValue ?>"<?php echo $cs_proyecto->fecharecibido->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fecharecibido" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fecharecibido" class="form-group cs_proyecto_fecharecibido">
<input type="text" data-table="cs_proyecto" data-field="x_fecharecibido" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fecharecibido->EditValue ?>"<?php echo $cs_proyecto->fecharecibido->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_fecharecibido" class="cs_proyecto_fecharecibido">
<span<?php echo $cs_proyecto->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_proyecto->fecharecibido->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fecharecibido" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_fecharecibido" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->clase->Visible) { // clase ?>
		<td data-name="clase"<?php echo $cs_proyecto->clase->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_clase" class="form-group cs_proyecto_clase">
<input type="text" data-table="cs_proyecto" data-field="x_clase" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" size="30" maxlength="45" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->clase->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->clase->EditValue ?>"<?php echo $cs_proyecto->clase->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_clase" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_clase" value="<?php echo ew_HtmlEncode($cs_proyecto->clase->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_clase" class="form-group cs_proyecto_clase">
<input type="text" data-table="cs_proyecto" data-field="x_clase" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" size="30" maxlength="45" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->clase->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->clase->EditValue ?>"<?php echo $cs_proyecto->clase->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_clase" class="cs_proyecto_clase">
<span<?php echo $cs_proyecto->clase->ViewAttributes() ?>>
<?php echo $cs_proyecto->clase->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_clase" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" value="<?php echo ew_HtmlEncode($cs_proyecto->clase->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_clase" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_clase" value="<?php echo ew_HtmlEncode($cs_proyecto->clase->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->entes->Visible) { // entes ?>
		<td data-name="entes"<?php echo $cs_proyecto->entes->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_entes" class="form-group cs_proyecto_entes">
<input type="text" data-table="cs_proyecto" data-field="x_entes" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->entes->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->entes->EditValue ?>"<?php echo $cs_proyecto->entes->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_entes" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_entes" value="<?php echo ew_HtmlEncode($cs_proyecto->entes->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_entes" class="form-group cs_proyecto_entes">
<input type="text" data-table="cs_proyecto" data-field="x_entes" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->entes->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->entes->EditValue ?>"<?php echo $cs_proyecto->entes->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_entes" class="cs_proyecto_entes">
<span<?php echo $cs_proyecto->entes->ViewAttributes() ?>>
<?php echo $cs_proyecto->entes->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_entes" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" value="<?php echo ew_HtmlEncode($cs_proyecto->entes->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_entes" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_entes" value="<?php echo ew_HtmlEncode($cs_proyecto->entes->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
		<td data-name="idRol"<?php echo $cs_proyecto->idRol->CellAttributes() ?>>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRol" class="form-group cs_proyecto_idRol">
<input type="text" data-table="cs_proyecto" data-field="x_idRol" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRol->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRol->EditValue ?>"<?php echo $cs_proyecto->idRol->EditAttributes() ?>>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRol" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" value="<?php echo ew_HtmlEncode($cs_proyecto->idRol->OldValue) ?>">
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRol" class="form-group cs_proyecto_idRol">
<input type="text" data-table="cs_proyecto" data-field="x_idRol" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRol->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRol->EditValue ?>"<?php echo $cs_proyecto->idRol->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $cs_proyecto_grid->RowCnt ?>_cs_proyecto_idRol" class="cs_proyecto_idRol">
<span<?php echo $cs_proyecto->idRol->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRol->ListViewValue() ?></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRol" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" value="<?php echo ew_HtmlEncode($cs_proyecto->idRol->FormValue) ?>">
<input type="hidden" data-table="cs_proyecto" data-field="x_idRol" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" value="<?php echo ew_HtmlEncode($cs_proyecto->idRol->OldValue) ?>">
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_proyecto_grid->ListOptions->Render("body", "right", $cs_proyecto_grid->RowCnt);
?>
	</tr>
<?php if ($cs_proyecto->RowType == EW_ROWTYPE_ADD || $cs_proyecto->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcs_proyectogrid.UpdateOpts(<?php echo $cs_proyecto_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($cs_proyecto->CurrentAction <> "gridadd" || $cs_proyecto->CurrentMode == "copy")
		if (!$cs_proyecto_grid->Recordset->EOF) $cs_proyecto_grid->Recordset->MoveNext();
}
?>
<?php
	if ($cs_proyecto->CurrentMode == "add" || $cs_proyecto->CurrentMode == "copy" || $cs_proyecto->CurrentMode == "edit") {
		$cs_proyecto_grid->RowIndex = '$rowindex$';
		$cs_proyecto_grid->LoadDefaultValues();

		// Set row properties
		$cs_proyecto->ResetAttrs();
		$cs_proyecto->RowAttrs = array_merge($cs_proyecto->RowAttrs, array('data-rowindex'=>$cs_proyecto_grid->RowIndex, 'id'=>'r0_cs_proyecto', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($cs_proyecto->RowAttrs["class"], "ewTemplate");
		$cs_proyecto->RowType = EW_ROWTYPE_ADD;

		// Render row
		$cs_proyecto_grid->RenderRow();

		// Render list options
		$cs_proyecto_grid->RenderListOptions();
		$cs_proyecto_grid->StartRowCnt = 0;
?>
	<tr<?php echo $cs_proyecto->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_proyecto_grid->ListOptions->Render("body", "left", $cs_proyecto_grid->RowIndex);
?>
	<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
		<td data-name="idProyecto">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idProyecto" class="form-group cs_proyecto_idProyecto">
<span<?php echo $cs_proyecto->idProyecto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idProyecto->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProyecto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_proyecto->idProyecto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProyecto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProyecto" value="<?php echo ew_HtmlEncode($cs_proyecto->idProyecto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
		<td data-name="idPrograma">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<?php if ($cs_proyecto->idPrograma->getSessionValue() <> "") { ?>
<span id="el$rowindex$_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idPrograma->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<input type="text" data-table="cs_proyecto" data-field="x_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idPrograma->EditValue ?>"<?php echo $cs_proyecto->idPrograma->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idPrograma" class="form-group cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idPrograma->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idPrograma" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idPrograma" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idPrograma" value="<?php echo ew_HtmlEncode($cs_proyecto->idPrograma->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
		<td data-name="codigo">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_codigo" class="form-group cs_proyecto_codigo">
<input type="text" data-table="cs_proyecto" data-field="x_codigo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->codigo->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->codigo->EditValue ?>"<?php echo $cs_proyecto->codigo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_codigo" class="form-group cs_proyecto_codigo">
<span<?php echo $cs_proyecto->codigo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->codigo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_codigo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_proyecto->codigo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_codigo" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_codigo" value="<?php echo ew_HtmlEncode($cs_proyecto->codigo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
		<td data-name="idUbicacion">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idUbicacion" class="form-group cs_proyecto_idUbicacion">
<input type="text" data-table="cs_proyecto" data-field="x_idUbicacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idUbicacion->EditValue ?>"<?php echo $cs_proyecto->idUbicacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idUbicacion" class="form-group cs_proyecto_idUbicacion">
<span<?php echo $cs_proyecto->idUbicacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idUbicacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idUbicacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" value="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idUbicacion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idUbicacion" value="<?php echo ew_HtmlEncode($cs_proyecto->idUbicacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
		<td data-name="idRegion">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idRegion" class="form-group cs_proyecto_idRegion">
<input type="text" data-table="cs_proyecto" data-field="x_idRegion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRegion->EditValue ?>"<?php echo $cs_proyecto->idRegion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idRegion" class="form-group cs_proyecto_idRegion">
<span<?php echo $cs_proyecto->idRegion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idRegion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRegion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" value="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRegion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRegion" value="<?php echo ew_HtmlEncode($cs_proyecto->idRegion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
		<td data-name="idDepto">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idDepto" class="form-group cs_proyecto_idDepto">
<input type="text" data-table="cs_proyecto" data-field="x_idDepto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idDepto->EditValue ?>"<?php echo $cs_proyecto->idDepto->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idDepto" class="form-group cs_proyecto_idDepto">
<span<?php echo $cs_proyecto->idDepto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idDepto->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idDepto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" value="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idDepto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idDepto" value="<?php echo ew_HtmlEncode($cs_proyecto->idDepto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
		<td data-name="idTramo">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idTramo" class="form-group cs_proyecto_idTramo">
<input type="text" data-table="cs_proyecto" data-field="x_idTramo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idTramo->EditValue ?>"<?php echo $cs_proyecto->idTramo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idTramo" class="form-group cs_proyecto_idTramo">
<span<?php echo $cs_proyecto->idTramo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idTramo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTramo" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" value="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTramo" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTramo" value="<?php echo ew_HtmlEncode($cs_proyecto->idTramo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
		<td data-name="idRuta">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idRuta" class="form-group cs_proyecto_idRuta">
<input type="text" data-table="cs_proyecto" data-field="x_idRuta" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRuta->EditValue ?>"<?php echo $cs_proyecto->idRuta->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idRuta" class="form-group cs_proyecto_idRuta">
<span<?php echo $cs_proyecto->idRuta->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idRuta->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRuta" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" value="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRuta" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRuta" value="<?php echo ew_HtmlEncode($cs_proyecto->idRuta->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
		<td data-name="idTipoRed">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idTipoRed" class="form-group cs_proyecto_idTipoRed">
<input type="text" data-table="cs_proyecto" data-field="x_idTipoRed" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idTipoRed->EditValue ?>"<?php echo $cs_proyecto->idTipoRed->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idTipoRed" class="form-group cs_proyecto_idTipoRed">
<span<?php echo $cs_proyecto->idTipoRed->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idTipoRed->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTipoRed" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" value="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idTipoRed" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idTipoRed" value="<?php echo ew_HtmlEncode($cs_proyecto->idTipoRed->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
		<td data-name="idProposito">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idProposito" class="form-group cs_proyecto_idProposito">
<input type="text" data-table="cs_proyecto" data-field="x_idProposito" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idProposito->EditValue ?>"<?php echo $cs_proyecto->idProposito->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idProposito" class="form-group cs_proyecto_idProposito">
<span<?php echo $cs_proyecto->idProposito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idProposito->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProposito" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" value="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idProposito" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idProposito" value="<?php echo ew_HtmlEncode($cs_proyecto->idProposito->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
		<td data-name="presupuesto">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_presupuesto" class="form-group cs_proyecto_presupuesto">
<input type="text" data-table="cs_proyecto" data-field="x_presupuesto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->presupuesto->EditValue ?>"<?php echo $cs_proyecto->presupuesto->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_presupuesto" class="form-group cs_proyecto_presupuesto">
<span<?php echo $cs_proyecto->presupuesto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->presupuesto->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_presupuesto" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" value="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_presupuesto" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_presupuesto" value="<?php echo ew_HtmlEncode($cs_proyecto->presupuesto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
		<td data-name="especiplano">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_especiplano" class="form-group cs_proyecto_especiplano">
<input type="text" data-table="cs_proyecto" data-field="x_especiplano" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->especiplano->EditValue ?>"<?php echo $cs_proyecto->especiplano->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_especiplano" class="form-group cs_proyecto_especiplano">
<span<?php echo $cs_proyecto->especiplano->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->especiplano->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_especiplano" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" value="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_especiplano" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_especiplano" value="<?php echo ew_HtmlEncode($cs_proyecto->especiplano->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
		<td data-name="presuprogra">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_presuprogra" class="form-group cs_proyecto_presuprogra">
<input type="text" data-table="cs_proyecto" data-field="x_presuprogra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->presuprogra->EditValue ?>"<?php echo $cs_proyecto->presuprogra->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_presuprogra" class="form-group cs_proyecto_presuprogra">
<span<?php echo $cs_proyecto->presuprogra->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->presuprogra->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_presuprogra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" value="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_presuprogra" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_presuprogra" value="<?php echo ew_HtmlEncode($cs_proyecto->presuprogra->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
		<td data-name="estudiofact">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_estudiofact" class="form-group cs_proyecto_estudiofact">
<input type="text" data-table="cs_proyecto" data-field="x_estudiofact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estudiofact->EditValue ?>"<?php echo $cs_proyecto->estudiofact->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_estudiofact" class="form-group cs_proyecto_estudiofact">
<span<?php echo $cs_proyecto->estudiofact->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->estudiofact->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudiofact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudiofact" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudiofact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudiofact->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
		<td data-name="estudioimpact">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_estudioimpact" class="form-group cs_proyecto_estudioimpact">
<input type="text" data-table="cs_proyecto" data-field="x_estudioimpact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estudioimpact->EditValue ?>"<?php echo $cs_proyecto->estudioimpact->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_estudioimpact" class="form-group cs_proyecto_estudioimpact">
<span<?php echo $cs_proyecto->estudioimpact->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->estudioimpact->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudioimpact" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_estudioimpact" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estudioimpact" value="<?php echo ew_HtmlEncode($cs_proyecto->estudioimpact->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
		<td data-name="licambi">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_licambi" class="form-group cs_proyecto_licambi">
<input type="text" data-table="cs_proyecto" data-field="x_licambi" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->licambi->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->licambi->EditValue ?>"<?php echo $cs_proyecto->licambi->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_licambi" class="form-group cs_proyecto_licambi">
<span<?php echo $cs_proyecto->licambi->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->licambi->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_licambi" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" value="<?php echo ew_HtmlEncode($cs_proyecto->licambi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_licambi" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_licambi" value="<?php echo ew_HtmlEncode($cs_proyecto->licambi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
		<td data-name="estuimpactierra">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_estuimpactierra" class="form-group cs_proyecto_estuimpactierra">
<input type="text" data-table="cs_proyecto" data-field="x_estuimpactierra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estuimpactierra->EditValue ?>"<?php echo $cs_proyecto->estuimpactierra->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_estuimpactierra" class="form-group cs_proyecto_estuimpactierra">
<span<?php echo $cs_proyecto->estuimpactierra->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->estuimpactierra->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estuimpactierra" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" value="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_estuimpactierra" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estuimpactierra" value="<?php echo ew_HtmlEncode($cs_proyecto->estuimpactierra->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
		<td data-name="planreasea">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_planreasea" class="form-group cs_proyecto_planreasea">
<input type="text" data-table="cs_proyecto" data-field="x_planreasea" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->planreasea->EditValue ?>"<?php echo $cs_proyecto->planreasea->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_planreasea" class="form-group cs_proyecto_planreasea">
<span<?php echo $cs_proyecto->planreasea->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->planreasea->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_planreasea" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" value="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_planreasea" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_planreasea" value="<?php echo ew_HtmlEncode($cs_proyecto->planreasea->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
		<td data-name="plananual">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_plananual" class="form-group cs_proyecto_plananual">
<input type="text" data-table="cs_proyecto" data-field="x_plananual" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->plananual->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->plananual->EditValue ?>"<?php echo $cs_proyecto->plananual->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_plananual" class="form-group cs_proyecto_plananual">
<span<?php echo $cs_proyecto->plananual->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->plananual->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_plananual" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" value="<?php echo ew_HtmlEncode($cs_proyecto->plananual->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_plananual" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_plananual" value="<?php echo ew_HtmlEncode($cs_proyecto->plananual->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
		<td data-name="acuerdofinan">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_acuerdofinan" class="form-group cs_proyecto_acuerdofinan">
<input type="text" data-table="cs_proyecto" data-field="x_acuerdofinan" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->acuerdofinan->EditValue ?>"<?php echo $cs_proyecto->acuerdofinan->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_acuerdofinan" class="form-group cs_proyecto_acuerdofinan">
<span<?php echo $cs_proyecto->acuerdofinan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->acuerdofinan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_acuerdofinan" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" value="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_acuerdofinan" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_acuerdofinan" value="<?php echo ew_HtmlEncode($cs_proyecto->acuerdofinan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->otro->Visible) { // otro ?>
		<td data-name="otro">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_otro" class="form-group cs_proyecto_otro">
<input type="text" data-table="cs_proyecto" data-field="x_otro" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->otro->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->otro->EditValue ?>"<?php echo $cs_proyecto->otro->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_otro" class="form-group cs_proyecto_otro">
<span<?php echo $cs_proyecto->otro->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->otro->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_otro" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_proyecto->otro->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_otro" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_otro" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_otro" value="<?php echo ew_HtmlEncode($cs_proyecto->otro->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_fechacreacion" class="form-group cs_proyecto_fechacreacion">
<input type="text" data-table="cs_proyecto" data-field="x_fechacreacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fechacreacion->EditValue ?>"<?php echo $cs_proyecto->fechacreacion->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_fechacreacion" class="form-group cs_proyecto_fechacreacion">
<span<?php echo $cs_proyecto->fechacreacion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->fechacreacion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechacreacion" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechacreacion" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechacreacion" value="<?php echo ew_HtmlEncode($cs_proyecto->fechacreacion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_estado" class="form-group cs_proyecto_estado">
<input type="text" data-table="cs_proyecto" data-field="x_estado" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->estado->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->estado->EditValue ?>"<?php echo $cs_proyecto->estado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_estado" class="form-group cs_proyecto_estado">
<span<?php echo $cs_proyecto->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_estado" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_proyecto->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_estado" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_estado" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($cs_proyecto->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idFuncionario" class="form-group cs_proyecto_idFuncionario">
<input type="text" data-table="cs_proyecto" data-field="x_idFuncionario" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idFuncionario->EditValue ?>"<?php echo $cs_proyecto->idFuncionario->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idFuncionario" class="form-group cs_proyecto_idFuncionario">
<span<?php echo $cs_proyecto->idFuncionario->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idFuncionario->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idFuncionario" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idFuncionario" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idFuncionario" value="<?php echo ew_HtmlEncode($cs_proyecto->idFuncionario->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
		<td data-name="fechaaprob">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_fechaaprob" class="form-group cs_proyecto_fechaaprob">
<input type="text" data-table="cs_proyecto" data-field="x_fechaaprob" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fechaaprob->EditValue ?>"<?php echo $cs_proyecto->fechaaprob->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_fechaaprob" class="form-group cs_proyecto_fechaaprob">
<span<?php echo $cs_proyecto->fechaaprob->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->fechaaprob->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechaaprob" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" value="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_fechaaprob" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fechaaprob" value="<?php echo ew_HtmlEncode($cs_proyecto->fechaaprob->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
		<td data-name="idfuente">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idfuente" class="form-group cs_proyecto_idfuente">
<input type="text" data-table="cs_proyecto" data-field="x_idfuente" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idfuente->EditValue ?>"<?php echo $cs_proyecto->idfuente->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idfuente" class="form-group cs_proyecto_idfuente">
<span<?php echo $cs_proyecto->idfuente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idfuente->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idfuente" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" value="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idfuente" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idfuente" value="<?php echo ew_HtmlEncode($cs_proyecto->idfuente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
		<td data-name="codsefin">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_codsefin" class="form-group cs_proyecto_codsefin">
<input type="text" data-table="cs_proyecto" data-field="x_codsefin" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->codsefin->EditValue ?>"<?php echo $cs_proyecto->codsefin->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_codsefin" class="form-group cs_proyecto_codsefin">
<span<?php echo $cs_proyecto->codsefin->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->codsefin->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_codsefin" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" value="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_codsefin" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_codsefin" value="<?php echo ew_HtmlEncode($cs_proyecto->codsefin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
		<td data-name="notaprioridad">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_notaprioridad" class="form-group cs_proyecto_notaprioridad">
<input type="text" data-table="cs_proyecto" data-field="x_notaprioridad" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->notaprioridad->EditValue ?>"<?php echo $cs_proyecto->notaprioridad->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_notaprioridad" class="form-group cs_proyecto_notaprioridad">
<span<?php echo $cs_proyecto->notaprioridad->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->notaprioridad->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_notaprioridad" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" value="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_notaprioridad" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_notaprioridad" value="<?php echo ew_HtmlEncode($cs_proyecto->notaprioridad->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
		<td data-name="constanciabanco">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_constanciabanco" class="form-group cs_proyecto_constanciabanco">
<input type="text" data-table="cs_proyecto" data-field="x_constanciabanco" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" size="30" maxlength="150" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->constanciabanco->EditValue ?>"<?php echo $cs_proyecto->constanciabanco->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_constanciabanco" class="form-group cs_proyecto_constanciabanco">
<span<?php echo $cs_proyecto->constanciabanco->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->constanciabanco->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_constanciabanco" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" value="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_constanciabanco" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_constanciabanco" value="<?php echo ew_HtmlEncode($cs_proyecto->constanciabanco->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_fecharecibido" class="form-group cs_proyecto_fecharecibido">
<input type="text" data-table="cs_proyecto" data-field="x_fecharecibido" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" size="30" maxlength="10" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->fecharecibido->EditValue ?>"<?php echo $cs_proyecto->fecharecibido->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_fecharecibido" class="form-group cs_proyecto_fecharecibido">
<span<?php echo $cs_proyecto->fecharecibido->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->fecharecibido->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_fecharecibido" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_fecharecibido" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_fecharecibido" value="<?php echo ew_HtmlEncode($cs_proyecto->fecharecibido->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->clase->Visible) { // clase ?>
		<td data-name="clase">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_clase" class="form-group cs_proyecto_clase">
<input type="text" data-table="cs_proyecto" data-field="x_clase" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" size="30" maxlength="45" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->clase->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->clase->EditValue ?>"<?php echo $cs_proyecto->clase->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_clase" class="form-group cs_proyecto_clase">
<span<?php echo $cs_proyecto->clase->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->clase->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_clase" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_clase" value="<?php echo ew_HtmlEncode($cs_proyecto->clase->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_clase" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_clase" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_clase" value="<?php echo ew_HtmlEncode($cs_proyecto->clase->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->entes->Visible) { // entes ?>
		<td data-name="entes">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_entes" class="form-group cs_proyecto_entes">
<input type="text" data-table="cs_proyecto" data-field="x_entes" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" size="30" maxlength="15" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->entes->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->entes->EditValue ?>"<?php echo $cs_proyecto->entes->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_entes" class="form-group cs_proyecto_entes">
<span<?php echo $cs_proyecto->entes->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->entes->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_entes" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_entes" value="<?php echo ew_HtmlEncode($cs_proyecto->entes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_entes" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_entes" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_entes" value="<?php echo ew_HtmlEncode($cs_proyecto->entes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
		<td data-name="idRol">
<?php if ($cs_proyecto->CurrentAction <> "F") { ?>
<span id="el$rowindex$_cs_proyecto_idRol" class="form-group cs_proyecto_idRol">
<input type="text" data-table="cs_proyecto" data-field="x_idRol" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" size="30" placeholder="<?php echo ew_HtmlEncode($cs_proyecto->idRol->getPlaceHolder()) ?>" value="<?php echo $cs_proyecto->idRol->EditValue ?>"<?php echo $cs_proyecto->idRol->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_cs_proyecto_idRol" class="form-group cs_proyecto_idRol">
<span<?php echo $cs_proyecto->idRol->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $cs_proyecto->idRol->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRol" name="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="x<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" value="<?php echo ew_HtmlEncode($cs_proyecto->idRol->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="cs_proyecto" data-field="x_idRol" name="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" id="o<?php echo $cs_proyecto_grid->RowIndex ?>_idRol" value="<?php echo ew_HtmlEncode($cs_proyecto->idRol->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_proyecto_grid->ListOptions->Render("body", "right", $cs_proyecto_grid->RowCnt);
?>
<script type="text/javascript">
fcs_proyectogrid.UpdateOpts(<?php echo $cs_proyecto_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($cs_proyecto->CurrentMode == "add" || $cs_proyecto->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $cs_proyecto_grid->FormKeyCountName ?>" id="<?php echo $cs_proyecto_grid->FormKeyCountName ?>" value="<?php echo $cs_proyecto_grid->KeyCount ?>">
<?php echo $cs_proyecto_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_proyecto->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $cs_proyecto_grid->FormKeyCountName ?>" id="<?php echo $cs_proyecto_grid->FormKeyCountName ?>" value="<?php echo $cs_proyecto_grid->KeyCount ?>">
<?php echo $cs_proyecto_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($cs_proyecto->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcs_proyectogrid">
</div>
<?php

// Close recordset
if ($cs_proyecto_grid->Recordset)
	$cs_proyecto_grid->Recordset->Close();
?>
<?php if ($cs_proyecto_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($cs_proyecto_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($cs_proyecto_grid->TotalRecs == 0 && $cs_proyecto->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_proyecto_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_proyecto->Export == "") { ?>
<script type="text/javascript">
fcs_proyectogrid.Init();
</script>
<?php } ?>
<?php
$cs_proyecto_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$cs_proyecto_grid->Page_Terminate();
?>
