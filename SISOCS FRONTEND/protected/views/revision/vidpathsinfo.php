<?php

// Global variable for table object
$vidpaths = NULL;

//
// Table class for vidpaths
//
class cvidpaths extends cTable {
	var $idPrograma;
	var $idProyecto;
	var $idCalificacion;
	var $idAdjudicacion;
	var $idContratacion;
	var $idContratos;
	var $idEjecucion;
	var $idAvances;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'vidpaths';
		$this->TableName = 'vidpaths';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`vidpaths`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// idPrograma
		$this->idPrograma = new cField('vidpaths', 'vidpaths', 'x_idPrograma', 'idPrograma', '`idPrograma`', '`idPrograma`', 3, -1, FALSE, '`idPrograma`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idPrograma->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idPrograma'] = &$this->idPrograma;

		// idProyecto
		$this->idProyecto = new cField('vidpaths', 'vidpaths', 'x_idProyecto', 'idProyecto', '`idProyecto`', '`idProyecto`', 3, -1, FALSE, '`idProyecto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idProyecto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idProyecto'] = &$this->idProyecto;

		// idCalificacion
		$this->idCalificacion = new cField('vidpaths', 'vidpaths', 'x_idCalificacion', 'idCalificacion', '`idCalificacion`', '`idCalificacion`', 3, -1, FALSE, '`idCalificacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idCalificacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idCalificacion'] = &$this->idCalificacion;

		// idAdjudicacion
		$this->idAdjudicacion = new cField('vidpaths', 'vidpaths', 'x_idAdjudicacion', 'idAdjudicacion', '`idAdjudicacion`', '`idAdjudicacion`', 3, -1, FALSE, '`idAdjudicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idAdjudicacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idAdjudicacion'] = &$this->idAdjudicacion;

		// idContratacion
		$this->idContratacion = new cField('vidpaths', 'vidpaths', 'x_idContratacion', 'idContratacion', '`idContratacion`', '`idContratacion`', 3, -1, FALSE, '`idContratacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idContratacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratacion'] = &$this->idContratacion;

		// idContratos
		$this->idContratos = new cField('vidpaths', 'vidpaths', 'x_idContratos', 'idContratos', '`idContratos`', '`idContratos`', 3, -1, FALSE, '`idContratos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idContratos->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratos'] = &$this->idContratos;

		// idEjecucion
		$this->idEjecucion = new cField('vidpaths', 'vidpaths', 'x_idEjecucion', 'idEjecucion', '`idEjecucion`', '`idEjecucion`', 3, -1, FALSE, '`idEjecucion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idEjecucion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idEjecucion'] = &$this->idEjecucion;

		// idAvances
		$this->idAvances = new cField('vidpaths', 'vidpaths', 'x_idAvances', 'idAvances', '`idAvances`', '`idAvances`', 3, -1, FALSE, '`idAvances`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idAvances->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idAvances'] = &$this->idAvances;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`vidpaths`";
	}

	function SqlFrom() { // For backward compatibility
    	return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
    	$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
    	return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
    	$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
    	return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
    	$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
    	return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
    	$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
    	return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
    	$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
    	return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
    	$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		return $conn->Execute($this->InsertSQL($rs));
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		return $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		return $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "vidpathslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "vidpathslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("vidpathsview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("vidpathsview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "vidpathsadd.php?" . $this->UrlParm($parm);
		else
			return "vidpathsadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("vidpathsedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("vidpathsadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("vidpathsdelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->idPrograma->setDbValue($rs->fields('idPrograma'));
		$this->idProyecto->setDbValue($rs->fields('idProyecto'));
		$this->idCalificacion->setDbValue($rs->fields('idCalificacion'));
		$this->idAdjudicacion->setDbValue($rs->fields('idAdjudicacion'));
		$this->idContratacion->setDbValue($rs->fields('idContratacion'));
		$this->idContratos->setDbValue($rs->fields('idContratos'));
		$this->idEjecucion->setDbValue($rs->fields('idEjecucion'));
		$this->idAvances->setDbValue($rs->fields('idAvances'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idPrograma
		// idProyecto
		// idCalificacion
		// idAdjudicacion
		// idContratacion
		// idContratos
		// idEjecucion
		// idAvances
		// idPrograma

		$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->ViewCustomAttributes = "";

		// idProyecto
		$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";

		// idCalificacion
		$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";

		// idAdjudicacion
		$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";

		// idContratacion
		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// idContratos
		$this->idContratos->ViewValue = $this->idContratos->CurrentValue;
		$this->idContratos->ViewCustomAttributes = "";

		// idEjecucion
		$this->idEjecucion->ViewValue = $this->idEjecucion->CurrentValue;
		$this->idEjecucion->ViewCustomAttributes = "";

		// idAvances
		$this->idAvances->ViewValue = $this->idAvances->CurrentValue;
		$this->idAvances->ViewCustomAttributes = "";

		// idPrograma
		$this->idPrograma->LinkCustomAttributes = "";
		$this->idPrograma->HrefValue = "";
		$this->idPrograma->TooltipValue = "";

		// idProyecto
		$this->idProyecto->LinkCustomAttributes = "";
		$this->idProyecto->HrefValue = "";
		$this->idProyecto->TooltipValue = "";

		// idCalificacion
		$this->idCalificacion->LinkCustomAttributes = "";
		$this->idCalificacion->HrefValue = "";
		$this->idCalificacion->TooltipValue = "";

		// idAdjudicacion
		$this->idAdjudicacion->LinkCustomAttributes = "";
		$this->idAdjudicacion->HrefValue = "";
		$this->idAdjudicacion->TooltipValue = "";

		// idContratacion
		$this->idContratacion->LinkCustomAttributes = "";
		$this->idContratacion->HrefValue = "";
		$this->idContratacion->TooltipValue = "";

		// idContratos
		$this->idContratos->LinkCustomAttributes = "";
		$this->idContratos->HrefValue = "";
		$this->idContratos->TooltipValue = "";

		// idEjecucion
		$this->idEjecucion->LinkCustomAttributes = "";
		$this->idEjecucion->HrefValue = "";
		$this->idEjecucion->TooltipValue = "";

		// idAvances
		$this->idAvances->LinkCustomAttributes = "";
		$this->idAvances->HrefValue = "";
		$this->idAvances->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// idPrograma
		$this->idPrograma->EditAttrs["class"] = "form-control";
		$this->idPrograma->EditCustomAttributes = "";
		$this->idPrograma->EditValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->PlaceHolder = ew_RemoveHtml($this->idPrograma->FldCaption());

		// idProyecto
		$this->idProyecto->EditAttrs["class"] = "form-control";
		$this->idProyecto->EditCustomAttributes = "";
		$this->idProyecto->EditValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->PlaceHolder = ew_RemoveHtml($this->idProyecto->FldCaption());

		// idCalificacion
		$this->idCalificacion->EditAttrs["class"] = "form-control";
		$this->idCalificacion->EditCustomAttributes = "";
		$this->idCalificacion->EditValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->PlaceHolder = ew_RemoveHtml($this->idCalificacion->FldCaption());

		// idAdjudicacion
		$this->idAdjudicacion->EditAttrs["class"] = "form-control";
		$this->idAdjudicacion->EditCustomAttributes = "";
		$this->idAdjudicacion->EditValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->PlaceHolder = ew_RemoveHtml($this->idAdjudicacion->FldCaption());

		// idContratacion
		$this->idContratacion->EditAttrs["class"] = "form-control";
		$this->idContratacion->EditCustomAttributes = "";
		$this->idContratacion->EditValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());

		// idContratos
		$this->idContratos->EditAttrs["class"] = "form-control";
		$this->idContratos->EditCustomAttributes = "";
		$this->idContratos->EditValue = $this->idContratos->CurrentValue;
		$this->idContratos->PlaceHolder = ew_RemoveHtml($this->idContratos->FldCaption());

		// idEjecucion
		$this->idEjecucion->EditAttrs["class"] = "form-control";
		$this->idEjecucion->EditCustomAttributes = "";
		$this->idEjecucion->EditValue = $this->idEjecucion->CurrentValue;
		$this->idEjecucion->PlaceHolder = ew_RemoveHtml($this->idEjecucion->FldCaption());

		// idAvances
		$this->idAvances->EditAttrs["class"] = "form-control";
		$this->idAvances->EditCustomAttributes = "";
		$this->idAvances->EditValue = $this->idAvances->CurrentValue;
		$this->idAvances->PlaceHolder = ew_RemoveHtml($this->idAvances->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->idPrograma->Exportable) $Doc->ExportCaption($this->idPrograma);
					if ($this->idProyecto->Exportable) $Doc->ExportCaption($this->idProyecto);
					if ($this->idCalificacion->Exportable) $Doc->ExportCaption($this->idCalificacion);
					if ($this->idAdjudicacion->Exportable) $Doc->ExportCaption($this->idAdjudicacion);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->idContratos->Exportable) $Doc->ExportCaption($this->idContratos);
					if ($this->idEjecucion->Exportable) $Doc->ExportCaption($this->idEjecucion);
					if ($this->idAvances->Exportable) $Doc->ExportCaption($this->idAvances);
				} else {
					if ($this->idPrograma->Exportable) $Doc->ExportCaption($this->idPrograma);
					if ($this->idProyecto->Exportable) $Doc->ExportCaption($this->idProyecto);
					if ($this->idCalificacion->Exportable) $Doc->ExportCaption($this->idCalificacion);
					if ($this->idAdjudicacion->Exportable) $Doc->ExportCaption($this->idAdjudicacion);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->idContratos->Exportable) $Doc->ExportCaption($this->idContratos);
					if ($this->idEjecucion->Exportable) $Doc->ExportCaption($this->idEjecucion);
					if ($this->idAvances->Exportable) $Doc->ExportCaption($this->idAvances);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->idPrograma->Exportable) $Doc->ExportField($this->idPrograma);
						if ($this->idProyecto->Exportable) $Doc->ExportField($this->idProyecto);
						if ($this->idCalificacion->Exportable) $Doc->ExportField($this->idCalificacion);
						if ($this->idAdjudicacion->Exportable) $Doc->ExportField($this->idAdjudicacion);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->idContratos->Exportable) $Doc->ExportField($this->idContratos);
						if ($this->idEjecucion->Exportable) $Doc->ExportField($this->idEjecucion);
						if ($this->idAvances->Exportable) $Doc->ExportField($this->idAvances);
					} else {
						if ($this->idPrograma->Exportable) $Doc->ExportField($this->idPrograma);
						if ($this->idProyecto->Exportable) $Doc->ExportField($this->idProyecto);
						if ($this->idCalificacion->Exportable) $Doc->ExportField($this->idCalificacion);
						if ($this->idAdjudicacion->Exportable) $Doc->ExportField($this->idAdjudicacion);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->idContratos->Exportable) $Doc->ExportField($this->idContratos);
						if ($this->idEjecucion->Exportable) $Doc->ExportField($this->idEjecucion);
						if ($this->idAvances->Exportable) $Doc->ExportField($this->idAvances);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
