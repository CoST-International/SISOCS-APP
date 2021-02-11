<?php

// Global variable for table object
$cs_contratacion = NULL;

//
// Table class for cs_contratacion
//
class ccs_contratacion extends cTable {
	var $idContratacion;
	var $idAdjudicacion;
	var $idEntidad;
	var $idoferente;
	var $precio;
	var $precio2;
	var $alcances;
	var $fechainicio;
	var $fechafinal;
	var $duracioncontrato;
	var $documentocontra;
	var $regante;
	var $espeplanos;
	var $estado;
	var $otro;
	var $ncontrato;
	var $titulocontrato;
	var $fecharecibido;
	var $fechacreacion;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_contratacion';
		$this->TableName = 'cs_contratacion';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_contratacion`";
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

		// idContratacion
		$this->idContratacion = new cField('cs_contratacion', 'cs_contratacion', 'x_idContratacion', 'idContratacion', '`idContratacion`', '`idContratacion`', 3, -1, FALSE, '`idContratacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idContratacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratacion'] = &$this->idContratacion;

		// idAdjudicacion
		$this->idAdjudicacion = new cField('cs_contratacion', 'cs_contratacion', 'x_idAdjudicacion', 'idAdjudicacion', '`idAdjudicacion`', '`idAdjudicacion`', 3, -1, FALSE, '`idAdjudicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idAdjudicacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idAdjudicacion'] = &$this->idAdjudicacion;

		// idEntidad
		$this->idEntidad = new cField('cs_contratacion', 'cs_contratacion', 'x_idEntidad', 'idEntidad', '`idEntidad`', '`idEntidad`', 3, -1, FALSE, '`idEntidad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idEntidad->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idEntidad'] = &$this->idEntidad;

		// idoferente
		$this->idoferente = new cField('cs_contratacion', 'cs_contratacion', 'x_idoferente', 'idoferente', '`idoferente`', '`idoferente`', 3, -1, FALSE, '`idoferente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idoferente->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idoferente'] = &$this->idoferente;

		// precio
		$this->precio = new cField('cs_contratacion', 'cs_contratacion', 'x_precio', 'precio', '`precio`', '`precio`', 5, -1, FALSE, '`precio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->precio->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['precio'] = &$this->precio;

		// precio2
		$this->precio2 = new cField('cs_contratacion', 'cs_contratacion', 'x_precio2', 'precio2', '`precio2`', '`precio2`', 5, -1, FALSE, '`precio2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->precio2->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['precio2'] = &$this->precio2;

		// alcances
		$this->alcances = new cField('cs_contratacion', 'cs_contratacion', 'x_alcances', 'alcances', '`alcances`', '`alcances`', 201, -1, FALSE, '`alcances`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['alcances'] = &$this->alcances;

		// fechainicio
		$this->fechainicio = new cField('cs_contratacion', 'cs_contratacion', 'x_fechainicio', 'fechainicio', '`fechainicio`', '`fechainicio`', 200, -1, FALSE, '`fechainicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechainicio'] = &$this->fechainicio;

		// fechafinal
		$this->fechafinal = new cField('cs_contratacion', 'cs_contratacion', 'x_fechafinal', 'fechafinal', '`fechafinal`', '`fechafinal`', 200, -1, FALSE, '`fechafinal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechafinal'] = &$this->fechafinal;

		// duracioncontrato
		$this->duracioncontrato = new cField('cs_contratacion', 'cs_contratacion', 'x_duracioncontrato', 'duracioncontrato', '`duracioncontrato`', '`duracioncontrato`', 200, -1, FALSE, '`duracioncontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['duracioncontrato'] = &$this->duracioncontrato;

		// documentocontra
		$this->documentocontra = new cField('cs_contratacion', 'cs_contratacion', 'x_documentocontra', 'documentocontra', '`documentocontra`', '`documentocontra`', 200, -1, FALSE, '`documentocontra`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['documentocontra'] = &$this->documentocontra;

		// regante
		$this->regante = new cField('cs_contratacion', 'cs_contratacion', 'x_regante', 'regante', '`regante`', '`regante`', 200, -1, FALSE, '`regante`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['regante'] = &$this->regante;

		// espeplanos
		$this->espeplanos = new cField('cs_contratacion', 'cs_contratacion', 'x_espeplanos', 'espeplanos', '`espeplanos`', '`espeplanos`', 200, -1, FALSE, '`espeplanos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['espeplanos'] = &$this->espeplanos;

		// estado
		$this->estado = new cField('cs_contratacion', 'cs_contratacion', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// otro
		$this->otro = new cField('cs_contratacion', 'cs_contratacion', 'x_otro', 'otro', '`otro`', '`otro`', 200, -1, FALSE, '`otro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro'] = &$this->otro;

		// ncontrato
		$this->ncontrato = new cField('cs_contratacion', 'cs_contratacion', 'x_ncontrato', 'ncontrato', '`ncontrato`', '`ncontrato`', 200, -1, FALSE, '`ncontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['ncontrato'] = &$this->ncontrato;

		// titulocontrato
		$this->titulocontrato = new cField('cs_contratacion', 'cs_contratacion', 'x_titulocontrato', 'titulocontrato', '`titulocontrato`', '`titulocontrato`', 201, -1, FALSE, '`titulocontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['titulocontrato'] = &$this->titulocontrato;

		// fecharecibido
		$this->fecharecibido = new cField('cs_contratacion', 'cs_contratacion', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', '`fecharecibido`', 200, -1, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecharecibido'] = &$this->fecharecibido;

		// fechacreacion
		$this->fechacreacion = new cField('cs_contratacion', 'cs_contratacion', 'x_fechacreacion', 'fechacreacion', '`fechacreacion`', '`fechacreacion`', 200, -1, FALSE, '`fechacreacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechacreacion'] = &$this->fechacreacion;
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

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "cs_adjudicacion") {
			if ($this->idAdjudicacion->getSessionValue() <> "")
				$sMasterFilter .= "`idAdjudicacion`=" . ew_QuotedValue($this->idAdjudicacion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cs_adjudicacion") {
			if ($this->idAdjudicacion->getSessionValue() <> "")
				$sDetailFilter .= "`idAdjudicacion`=" . ew_QuotedValue($this->idAdjudicacion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cs_adjudicacion() {
		return "`idAdjudicacion`=@idAdjudicacion@";
	}

	// Detail filter
	function SqlDetailFilter_cs_adjudicacion() {
		return "`idAdjudicacion`=@idAdjudicacion@";
	}

	// Current detail table name
	function getCurrentDetailTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE];
	}

	function setCurrentDetailTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_DETAIL_TABLE] = $v;
	}

	// Get detail url
	function GetDetailUrl() {

		// Detail url
		$sDetailUrl = "";
		if ($this->getCurrentDetailTable() == "cs_inicio_ejecucion") {
			$sDetailUrl = $GLOBALS["cs_inicio_ejecucion"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_idContratacion=" . urlencode($this->idContratacion->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "cs_contratacionlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_contratacion`";
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
			if (array_key_exists('idContratacion', $rs))
				ew_AddFilter($where, ew_QuotedName('idContratacion', $this->DBID) . '=' . ew_QuotedValue($rs['idContratacion'], $this->idContratacion->FldDataType, $this->DBID));
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
		return "`idContratacion` = @idContratacion@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idContratacion->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idContratacion@", ew_AdjustSql($this->idContratacion->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_contratacionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_contratacionlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_contratacionview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_contratacionview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_contratacionadd.php?" . $this->UrlParm($parm);
		else
			return "cs_contratacionadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_contratacionedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_contratacionedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_contratacionadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_contratacionadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_contrataciondelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "idContratacion:" . ew_VarToJson($this->idContratacion->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idContratacion->CurrentValue)) {
			$sUrl .= "idContratacion=" . urlencode($this->idContratacion->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["idContratacion"]) : ew_StripSlashes(@$_GET["idContratacion"]); // idContratacion

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
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
			$this->idContratacion->CurrentValue = $key;
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
		$this->idContratacion->setDbValue($rs->fields('idContratacion'));
		$this->idAdjudicacion->setDbValue($rs->fields('idAdjudicacion'));
		$this->idEntidad->setDbValue($rs->fields('idEntidad'));
		$this->idoferente->setDbValue($rs->fields('idoferente'));
		$this->precio->setDbValue($rs->fields('precio'));
		$this->precio2->setDbValue($rs->fields('precio2'));
		$this->alcances->setDbValue($rs->fields('alcances'));
		$this->fechainicio->setDbValue($rs->fields('fechainicio'));
		$this->fechafinal->setDbValue($rs->fields('fechafinal'));
		$this->duracioncontrato->setDbValue($rs->fields('duracioncontrato'));
		$this->documentocontra->setDbValue($rs->fields('documentocontra'));
		$this->regante->setDbValue($rs->fields('regante'));
		$this->espeplanos->setDbValue($rs->fields('espeplanos'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro->setDbValue($rs->fields('otro'));
		$this->ncontrato->setDbValue($rs->fields('ncontrato'));
		$this->titulocontrato->setDbValue($rs->fields('titulocontrato'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idContratacion
		// idAdjudicacion
		// idEntidad
		// idoferente
		// precio
		// precio2
		// alcances
		// fechainicio
		// fechafinal
		// duracioncontrato
		// documentocontra
		// regante
		// espeplanos
		// estado
		// otro
		// ncontrato
		// titulocontrato
		// fecharecibido
		// fechacreacion
		// idContratacion

		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// idAdjudicacion
		$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";

		// idEntidad
		$this->idEntidad->ViewValue = $this->idEntidad->CurrentValue;
		$this->idEntidad->ViewCustomAttributes = "";

		// idoferente
		$this->idoferente->ViewValue = $this->idoferente->CurrentValue;
		$this->idoferente->ViewCustomAttributes = "";

		// precio
		$this->precio->ViewValue = $this->precio->CurrentValue;
		$this->precio->ViewCustomAttributes = "";

		// precio2
		$this->precio2->ViewValue = $this->precio2->CurrentValue;
		$this->precio2->ViewCustomAttributes = "";

		// alcances
		$this->alcances->ViewValue = $this->alcances->CurrentValue;
		$this->alcances->ViewCustomAttributes = "";

		// fechainicio
		$this->fechainicio->ViewValue = $this->fechainicio->CurrentValue;
		$this->fechainicio->ViewCustomAttributes = "";

		// fechafinal
		$this->fechafinal->ViewValue = $this->fechafinal->CurrentValue;
		$this->fechafinal->ViewCustomAttributes = "";

		// duracioncontrato
		$this->duracioncontrato->ViewValue = $this->duracioncontrato->CurrentValue;
		$this->duracioncontrato->ViewCustomAttributes = "";

		// documentocontra
		$this->documentocontra->ViewValue = $this->documentocontra->CurrentValue;
		$this->documentocontra->ViewCustomAttributes = "";

		// regante
		$this->regante->ViewValue = $this->regante->CurrentValue;
		$this->regante->ViewCustomAttributes = "";

		// espeplanos
		$this->espeplanos->ViewValue = $this->espeplanos->CurrentValue;
		$this->espeplanos->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro
		$this->otro->ViewValue = $this->otro->CurrentValue;
		$this->otro->ViewCustomAttributes = "";

		// ncontrato
		$this->ncontrato->ViewValue = $this->ncontrato->CurrentValue;
		$this->ncontrato->ViewCustomAttributes = "";

		// titulocontrato
		$this->titulocontrato->ViewValue = $this->titulocontrato->CurrentValue;
		$this->titulocontrato->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

		// idContratacion
		$this->idContratacion->LinkCustomAttributes = "";
		$this->idContratacion->HrefValue = "";
		$this->idContratacion->TooltipValue = "";

		// idAdjudicacion
		$this->idAdjudicacion->LinkCustomAttributes = "";
		$this->idAdjudicacion->HrefValue = "";
		$this->idAdjudicacion->TooltipValue = "";

		// idEntidad
		$this->idEntidad->LinkCustomAttributes = "";
		$this->idEntidad->HrefValue = "";
		$this->idEntidad->TooltipValue = "";

		// idoferente
		$this->idoferente->LinkCustomAttributes = "";
		$this->idoferente->HrefValue = "";
		$this->idoferente->TooltipValue = "";

		// precio
		$this->precio->LinkCustomAttributes = "";
		$this->precio->HrefValue = "";
		$this->precio->TooltipValue = "";

		// precio2
		$this->precio2->LinkCustomAttributes = "";
		$this->precio2->HrefValue = "";
		$this->precio2->TooltipValue = "";

		// alcances
		$this->alcances->LinkCustomAttributes = "";
		$this->alcances->HrefValue = "";
		$this->alcances->TooltipValue = "";

		// fechainicio
		$this->fechainicio->LinkCustomAttributes = "";
		$this->fechainicio->HrefValue = "";
		$this->fechainicio->TooltipValue = "";

		// fechafinal
		$this->fechafinal->LinkCustomAttributes = "";
		$this->fechafinal->HrefValue = "";
		$this->fechafinal->TooltipValue = "";

		// duracioncontrato
		$this->duracioncontrato->LinkCustomAttributes = "";
		$this->duracioncontrato->HrefValue = "";
		$this->duracioncontrato->TooltipValue = "";

		// documentocontra
		$this->documentocontra->LinkCustomAttributes = "";
		$this->documentocontra->HrefValue = "";
		$this->documentocontra->TooltipValue = "";

		// regante
		$this->regante->LinkCustomAttributes = "";
		$this->regante->HrefValue = "";
		$this->regante->TooltipValue = "";

		// espeplanos
		$this->espeplanos->LinkCustomAttributes = "";
		$this->espeplanos->HrefValue = "";
		$this->espeplanos->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// otro
		$this->otro->LinkCustomAttributes = "";
		$this->otro->HrefValue = "";
		$this->otro->TooltipValue = "";

		// ncontrato
		$this->ncontrato->LinkCustomAttributes = "";
		$this->ncontrato->HrefValue = "";
		$this->ncontrato->TooltipValue = "";

		// titulocontrato
		$this->titulocontrato->LinkCustomAttributes = "";
		$this->titulocontrato->HrefValue = "";
		$this->titulocontrato->TooltipValue = "";

		// fecharecibido
		$this->fecharecibido->LinkCustomAttributes = "";
		$this->fecharecibido->HrefValue = "";
		$this->fecharecibido->TooltipValue = "";

		// fechacreacion
		$this->fechacreacion->LinkCustomAttributes = "";
		$this->fechacreacion->HrefValue = "";
		$this->fechacreacion->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// idContratacion
		$this->idContratacion->EditAttrs["class"] = "form-control";
		$this->idContratacion->EditCustomAttributes = "";
		$this->idContratacion->EditValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// idAdjudicacion
		$this->idAdjudicacion->EditAttrs["class"] = "form-control";
		$this->idAdjudicacion->EditCustomAttributes = "";
		if ($this->idAdjudicacion->getSessionValue() <> "") {
			$this->idAdjudicacion->CurrentValue = $this->idAdjudicacion->getSessionValue();
		$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";
		} else {
		$this->idAdjudicacion->EditValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->PlaceHolder = ew_RemoveHtml($this->idAdjudicacion->FldCaption());
		}

		// idEntidad
		$this->idEntidad->EditAttrs["class"] = "form-control";
		$this->idEntidad->EditCustomAttributes = "";
		$this->idEntidad->EditValue = $this->idEntidad->CurrentValue;
		$this->idEntidad->PlaceHolder = ew_RemoveHtml($this->idEntidad->FldCaption());

		// idoferente
		$this->idoferente->EditAttrs["class"] = "form-control";
		$this->idoferente->EditCustomAttributes = "";
		$this->idoferente->EditValue = $this->idoferente->CurrentValue;
		$this->idoferente->PlaceHolder = ew_RemoveHtml($this->idoferente->FldCaption());

		// precio
		$this->precio->EditAttrs["class"] = "form-control";
		$this->precio->EditCustomAttributes = "";
		$this->precio->EditValue = $this->precio->CurrentValue;
		$this->precio->PlaceHolder = ew_RemoveHtml($this->precio->FldCaption());
		if (strval($this->precio->EditValue) <> "" && is_numeric($this->precio->EditValue)) $this->precio->EditValue = ew_FormatNumber($this->precio->EditValue, -2, -1, -2, 0);

		// precio2
		$this->precio2->EditAttrs["class"] = "form-control";
		$this->precio2->EditCustomAttributes = "";
		$this->precio2->EditValue = $this->precio2->CurrentValue;
		$this->precio2->PlaceHolder = ew_RemoveHtml($this->precio2->FldCaption());
		if (strval($this->precio2->EditValue) <> "" && is_numeric($this->precio2->EditValue)) $this->precio2->EditValue = ew_FormatNumber($this->precio2->EditValue, -2, -1, -2, 0);

		// alcances
		$this->alcances->EditAttrs["class"] = "form-control";
		$this->alcances->EditCustomAttributes = "";
		$this->alcances->EditValue = $this->alcances->CurrentValue;
		$this->alcances->PlaceHolder = ew_RemoveHtml($this->alcances->FldCaption());

		// fechainicio
		$this->fechainicio->EditAttrs["class"] = "form-control";
		$this->fechainicio->EditCustomAttributes = "";
		$this->fechainicio->EditValue = $this->fechainicio->CurrentValue;
		$this->fechainicio->PlaceHolder = ew_RemoveHtml($this->fechainicio->FldCaption());

		// fechafinal
		$this->fechafinal->EditAttrs["class"] = "form-control";
		$this->fechafinal->EditCustomAttributes = "";
		$this->fechafinal->EditValue = $this->fechafinal->CurrentValue;
		$this->fechafinal->PlaceHolder = ew_RemoveHtml($this->fechafinal->FldCaption());

		// duracioncontrato
		$this->duracioncontrato->EditAttrs["class"] = "form-control";
		$this->duracioncontrato->EditCustomAttributes = "";
		$this->duracioncontrato->EditValue = $this->duracioncontrato->CurrentValue;
		$this->duracioncontrato->PlaceHolder = ew_RemoveHtml($this->duracioncontrato->FldCaption());

		// documentocontra
		$this->documentocontra->EditAttrs["class"] = "form-control";
		$this->documentocontra->EditCustomAttributes = "";
		$this->documentocontra->EditValue = $this->documentocontra->CurrentValue;
		$this->documentocontra->PlaceHolder = ew_RemoveHtml($this->documentocontra->FldCaption());

		// regante
		$this->regante->EditAttrs["class"] = "form-control";
		$this->regante->EditCustomAttributes = "";
		$this->regante->EditValue = $this->regante->CurrentValue;
		$this->regante->PlaceHolder = ew_RemoveHtml($this->regante->FldCaption());

		// espeplanos
		$this->espeplanos->EditAttrs["class"] = "form-control";
		$this->espeplanos->EditCustomAttributes = "";
		$this->espeplanos->EditValue = $this->espeplanos->CurrentValue;
		$this->espeplanos->PlaceHolder = ew_RemoveHtml($this->espeplanos->FldCaption());

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		$this->estado->EditValue = $this->estado->CurrentValue;
		$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

		// otro
		$this->otro->EditAttrs["class"] = "form-control";
		$this->otro->EditCustomAttributes = "";
		$this->otro->EditValue = $this->otro->CurrentValue;
		$this->otro->PlaceHolder = ew_RemoveHtml($this->otro->FldCaption());

		// ncontrato
		$this->ncontrato->EditAttrs["class"] = "form-control";
		$this->ncontrato->EditCustomAttributes = "";
		$this->ncontrato->EditValue = $this->ncontrato->CurrentValue;
		$this->ncontrato->PlaceHolder = ew_RemoveHtml($this->ncontrato->FldCaption());

		// titulocontrato
		$this->titulocontrato->EditAttrs["class"] = "form-control";
		$this->titulocontrato->EditCustomAttributes = "";
		$this->titulocontrato->EditValue = $this->titulocontrato->CurrentValue;
		$this->titulocontrato->PlaceHolder = ew_RemoveHtml($this->titulocontrato->FldCaption());

		// fecharecibido
		$this->fecharecibido->EditAttrs["class"] = "form-control";
		$this->fecharecibido->EditCustomAttributes = "";
		$this->fecharecibido->EditValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

		// fechacreacion
		$this->fechacreacion->EditAttrs["class"] = "form-control";
		$this->fechacreacion->EditCustomAttributes = "";
		$this->fechacreacion->EditValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->PlaceHolder = ew_RemoveHtml($this->fechacreacion->FldCaption());

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
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->idAdjudicacion->Exportable) $Doc->ExportCaption($this->idAdjudicacion);
					if ($this->idEntidad->Exportable) $Doc->ExportCaption($this->idEntidad);
					if ($this->idoferente->Exportable) $Doc->ExportCaption($this->idoferente);
					if ($this->precio->Exportable) $Doc->ExportCaption($this->precio);
					if ($this->precio2->Exportable) $Doc->ExportCaption($this->precio2);
					if ($this->alcances->Exportable) $Doc->ExportCaption($this->alcances);
					if ($this->fechainicio->Exportable) $Doc->ExportCaption($this->fechainicio);
					if ($this->fechafinal->Exportable) $Doc->ExportCaption($this->fechafinal);
					if ($this->duracioncontrato->Exportable) $Doc->ExportCaption($this->duracioncontrato);
					if ($this->documentocontra->Exportable) $Doc->ExportCaption($this->documentocontra);
					if ($this->regante->Exportable) $Doc->ExportCaption($this->regante);
					if ($this->espeplanos->Exportable) $Doc->ExportCaption($this->espeplanos);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->ncontrato->Exportable) $Doc->ExportCaption($this->ncontrato);
					if ($this->titulocontrato->Exportable) $Doc->ExportCaption($this->titulocontrato);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
				} else {
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->idAdjudicacion->Exportable) $Doc->ExportCaption($this->idAdjudicacion);
					if ($this->idEntidad->Exportable) $Doc->ExportCaption($this->idEntidad);
					if ($this->idoferente->Exportable) $Doc->ExportCaption($this->idoferente);
					if ($this->precio->Exportable) $Doc->ExportCaption($this->precio);
					if ($this->precio2->Exportable) $Doc->ExportCaption($this->precio2);
					if ($this->fechainicio->Exportable) $Doc->ExportCaption($this->fechainicio);
					if ($this->fechafinal->Exportable) $Doc->ExportCaption($this->fechafinal);
					if ($this->duracioncontrato->Exportable) $Doc->ExportCaption($this->duracioncontrato);
					if ($this->documentocontra->Exportable) $Doc->ExportCaption($this->documentocontra);
					if ($this->regante->Exportable) $Doc->ExportCaption($this->regante);
					if ($this->espeplanos->Exportable) $Doc->ExportCaption($this->espeplanos);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->ncontrato->Exportable) $Doc->ExportCaption($this->ncontrato);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
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
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->idAdjudicacion->Exportable) $Doc->ExportField($this->idAdjudicacion);
						if ($this->idEntidad->Exportable) $Doc->ExportField($this->idEntidad);
						if ($this->idoferente->Exportable) $Doc->ExportField($this->idoferente);
						if ($this->precio->Exportable) $Doc->ExportField($this->precio);
						if ($this->precio2->Exportable) $Doc->ExportField($this->precio2);
						if ($this->alcances->Exportable) $Doc->ExportField($this->alcances);
						if ($this->fechainicio->Exportable) $Doc->ExportField($this->fechainicio);
						if ($this->fechafinal->Exportable) $Doc->ExportField($this->fechafinal);
						if ($this->duracioncontrato->Exportable) $Doc->ExportField($this->duracioncontrato);
						if ($this->documentocontra->Exportable) $Doc->ExportField($this->documentocontra);
						if ($this->regante->Exportable) $Doc->ExportField($this->regante);
						if ($this->espeplanos->Exportable) $Doc->ExportField($this->espeplanos);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->ncontrato->Exportable) $Doc->ExportField($this->ncontrato);
						if ($this->titulocontrato->Exportable) $Doc->ExportField($this->titulocontrato);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
					} else {
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->idAdjudicacion->Exportable) $Doc->ExportField($this->idAdjudicacion);
						if ($this->idEntidad->Exportable) $Doc->ExportField($this->idEntidad);
						if ($this->idoferente->Exportable) $Doc->ExportField($this->idoferente);
						if ($this->precio->Exportable) $Doc->ExportField($this->precio);
						if ($this->precio2->Exportable) $Doc->ExportField($this->precio2);
						if ($this->fechainicio->Exportable) $Doc->ExportField($this->fechainicio);
						if ($this->fechafinal->Exportable) $Doc->ExportField($this->fechafinal);
						if ($this->duracioncontrato->Exportable) $Doc->ExportField($this->duracioncontrato);
						if ($this->documentocontra->Exportable) $Doc->ExportField($this->documentocontra);
						if ($this->regante->Exportable) $Doc->ExportField($this->regante);
						if ($this->espeplanos->Exportable) $Doc->ExportField($this->espeplanos);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->ncontrato->Exportable) $Doc->ExportField($this->ncontrato);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
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
