<?php

// Global variable for table object
$cs_adjudicacion = NULL;

//
// Table class for cs_adjudicacion
//
class ccs_adjudicacion extends cTable {
	var $idAdjudicacion;
	var $idCalificacion;
	var $numproceso;
	var $nomprocesoproyecto;
	var $nconsulnac;
	var $nconsulinter;
	var $costoesti;
	var $estadoproceso;
	var $actaaper;
	var $informeacta;
	var $resoladju;
	var $estado;
	var $otro;
	var $numfirmasnac;
	var $numfimasinter;
	var $numconsulcorta;
	var $fecharecibido;
	var $fechacreacion;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_adjudicacion';
		$this->TableName = 'cs_adjudicacion';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_adjudicacion`";
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

		// idAdjudicacion
		$this->idAdjudicacion = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_idAdjudicacion', 'idAdjudicacion', '`idAdjudicacion`', '`idAdjudicacion`', 3, -1, FALSE, '`idAdjudicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idAdjudicacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idAdjudicacion'] = &$this->idAdjudicacion;

		// idCalificacion
		$this->idCalificacion = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_idCalificacion', 'idCalificacion', '`idCalificacion`', '`idCalificacion`', 3, -1, FALSE, '`idCalificacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idCalificacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idCalificacion'] = &$this->idCalificacion;

		// numproceso
		$this->numproceso = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_numproceso', 'numproceso', '`numproceso`', '`numproceso`', 200, -1, FALSE, '`numproceso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['numproceso'] = &$this->numproceso;

		// nomprocesoproyecto
		$this->nomprocesoproyecto = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_nomprocesoproyecto', 'nomprocesoproyecto', '`nomprocesoproyecto`', '`nomprocesoproyecto`', 201, -1, FALSE, '`nomprocesoproyecto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['nomprocesoproyecto'] = &$this->nomprocesoproyecto;

		// nconsulnac
		$this->nconsulnac = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_nconsulnac', 'nconsulnac', '`nconsulnac`', '`nconsulnac`', 200, -1, FALSE, '`nconsulnac`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['nconsulnac'] = &$this->nconsulnac;

		// nconsulinter
		$this->nconsulinter = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_nconsulinter', 'nconsulinter', '`nconsulinter`', '`nconsulinter`', 200, -1, FALSE, '`nconsulinter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['nconsulinter'] = &$this->nconsulinter;

		// costoesti
		$this->costoesti = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_costoesti', 'costoesti', '`costoesti`', '`costoesti`', 5, -1, FALSE, '`costoesti`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->costoesti->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['costoesti'] = &$this->costoesti;

		// estadoproceso
		$this->estadoproceso = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_estadoproceso', 'estadoproceso', '`estadoproceso`', '`estadoproceso`', 200, -1, FALSE, '`estadoproceso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estadoproceso'] = &$this->estadoproceso;

		// actaaper
		$this->actaaper = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_actaaper', 'actaaper', '`actaaper`', '`actaaper`', 200, -1, FALSE, '`actaaper`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['actaaper'] = &$this->actaaper;

		// informeacta
		$this->informeacta = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_informeacta', 'informeacta', '`informeacta`', '`informeacta`', 200, -1, FALSE, '`informeacta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['informeacta'] = &$this->informeacta;

		// resoladju
		$this->resoladju = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_resoladju', 'resoladju', '`resoladju`', '`resoladju`', 200, -1, FALSE, '`resoladju`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['resoladju'] = &$this->resoladju;

		// estado
		$this->estado = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// otro
		$this->otro = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_otro', 'otro', '`otro`', '`otro`', 200, -1, FALSE, '`otro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro'] = &$this->otro;

		// numfirmasnac
		$this->numfirmasnac = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_numfirmasnac', 'numfirmasnac', '`numfirmasnac`', '`numfirmasnac`', 200, -1, FALSE, '`numfirmasnac`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['numfirmasnac'] = &$this->numfirmasnac;

		// numfimasinter
		$this->numfimasinter = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_numfimasinter', 'numfimasinter', '`numfimasinter`', '`numfimasinter`', 200, -1, FALSE, '`numfimasinter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['numfimasinter'] = &$this->numfimasinter;

		// numconsulcorta
		$this->numconsulcorta = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_numconsulcorta', 'numconsulcorta', '`numconsulcorta`', '`numconsulcorta`', 200, -1, FALSE, '`numconsulcorta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['numconsulcorta'] = &$this->numconsulcorta;

		// fecharecibido
		$this->fecharecibido = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', '`fecharecibido`', 200, -1, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecharecibido'] = &$this->fecharecibido;

		// fechacreacion
		$this->fechacreacion = new cField('cs_adjudicacion', 'cs_adjudicacion', 'x_fechacreacion', 'fechacreacion', '`fechacreacion`', '`fechacreacion`', 200, -1, FALSE, '`fechacreacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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
		if ($this->getCurrentMasterTable() == "cs_calificacion") {
			if ($this->idCalificacion->getSessionValue() <> "")
				$sMasterFilter .= "`idCalificacion`=" . ew_QuotedValue($this->idCalificacion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cs_calificacion") {
			if ($this->idCalificacion->getSessionValue() <> "")
				$sDetailFilter .= "`idCalificacion`=" . ew_QuotedValue($this->idCalificacion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cs_calificacion() {
		return "`idCalificacion`=@idCalificacion@";
	}

	// Detail filter
	function SqlDetailFilter_cs_calificacion() {
		return "`idCalificacion`=@idCalificacion@";
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
		if ($this->getCurrentDetailTable() == "cs_contratacion") {
			$sDetailUrl = $GLOBALS["cs_contratacion"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_idAdjudicacion=" . urlencode($this->idAdjudicacion->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "cs_adjudicacionlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_adjudicacion`";
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
			if (array_key_exists('idAdjudicacion', $rs))
				ew_AddFilter($where, ew_QuotedName('idAdjudicacion', $this->DBID) . '=' . ew_QuotedValue($rs['idAdjudicacion'], $this->idAdjudicacion->FldDataType, $this->DBID));
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
		return "`idAdjudicacion` = @idAdjudicacion@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idAdjudicacion->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idAdjudicacion@", ew_AdjustSql($this->idAdjudicacion->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_adjudicacionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_adjudicacionlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_adjudicacionview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_adjudicacionview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_adjudicacionadd.php?" . $this->UrlParm($parm);
		else
			return "cs_adjudicacionadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_adjudicacionedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_adjudicacionedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_adjudicacionadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_adjudicacionadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_adjudicaciondelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "idAdjudicacion:" . ew_VarToJson($this->idAdjudicacion->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idAdjudicacion->CurrentValue)) {
			$sUrl .= "idAdjudicacion=" . urlencode($this->idAdjudicacion->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["idAdjudicacion"]) : ew_StripSlashes(@$_GET["idAdjudicacion"]); // idAdjudicacion

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
			$this->idAdjudicacion->CurrentValue = $key;
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
		$this->idAdjudicacion->setDbValue($rs->fields('idAdjudicacion'));
		$this->idCalificacion->setDbValue($rs->fields('idCalificacion'));
		$this->numproceso->setDbValue($rs->fields('numproceso'));
		$this->nomprocesoproyecto->setDbValue($rs->fields('nomprocesoproyecto'));
		$this->nconsulnac->setDbValue($rs->fields('nconsulnac'));
		$this->nconsulinter->setDbValue($rs->fields('nconsulinter'));
		$this->costoesti->setDbValue($rs->fields('costoesti'));
		$this->estadoproceso->setDbValue($rs->fields('estadoproceso'));
		$this->actaaper->setDbValue($rs->fields('actaaper'));
		$this->informeacta->setDbValue($rs->fields('informeacta'));
		$this->resoladju->setDbValue($rs->fields('resoladju'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro->setDbValue($rs->fields('otro'));
		$this->numfirmasnac->setDbValue($rs->fields('numfirmasnac'));
		$this->numfimasinter->setDbValue($rs->fields('numfimasinter'));
		$this->numconsulcorta->setDbValue($rs->fields('numconsulcorta'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idAdjudicacion
		// idCalificacion
		// numproceso
		// nomprocesoproyecto
		// nconsulnac
		// nconsulinter
		// costoesti
		// estadoproceso
		// actaaper
		// informeacta
		// resoladju
		// estado
		// otro
		// numfirmasnac
		// numfimasinter
		// numconsulcorta
		// fecharecibido
		// fechacreacion
		// idAdjudicacion

		$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";

		// idCalificacion
		$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";

		// numproceso
		$this->numproceso->ViewValue = $this->numproceso->CurrentValue;
		$this->numproceso->ViewCustomAttributes = "";

		// nomprocesoproyecto
		$this->nomprocesoproyecto->ViewValue = $this->nomprocesoproyecto->CurrentValue;
		$this->nomprocesoproyecto->ViewCustomAttributes = "";

		// nconsulnac
		$this->nconsulnac->ViewValue = $this->nconsulnac->CurrentValue;
		$this->nconsulnac->ViewCustomAttributes = "";

		// nconsulinter
		$this->nconsulinter->ViewValue = $this->nconsulinter->CurrentValue;
		$this->nconsulinter->ViewCustomAttributes = "";

		// costoesti
		$this->costoesti->ViewValue = $this->costoesti->CurrentValue;
		$this->costoesti->ViewCustomAttributes = "";

		// estadoproceso
		$this->estadoproceso->ViewValue = $this->estadoproceso->CurrentValue;
		$this->estadoproceso->ViewCustomAttributes = "";

		// actaaper
		$this->actaaper->ViewValue = $this->actaaper->CurrentValue;
		$this->actaaper->ViewCustomAttributes = "";

		// informeacta
		$this->informeacta->ViewValue = $this->informeacta->CurrentValue;
		$this->informeacta->ViewCustomAttributes = "";

		// resoladju
		$this->resoladju->ViewValue = $this->resoladju->CurrentValue;
		$this->resoladju->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro
		$this->otro->ViewValue = $this->otro->CurrentValue;
		$this->otro->ViewCustomAttributes = "";

		// numfirmasnac
		$this->numfirmasnac->ViewValue = $this->numfirmasnac->CurrentValue;
		$this->numfirmasnac->ViewCustomAttributes = "";

		// numfimasinter
		$this->numfimasinter->ViewValue = $this->numfimasinter->CurrentValue;
		$this->numfimasinter->ViewCustomAttributes = "";

		// numconsulcorta
		$this->numconsulcorta->ViewValue = $this->numconsulcorta->CurrentValue;
		$this->numconsulcorta->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

		// idAdjudicacion
		$this->idAdjudicacion->LinkCustomAttributes = "";
		$this->idAdjudicacion->HrefValue = "";
		$this->idAdjudicacion->TooltipValue = "";

		// idCalificacion
		$this->idCalificacion->LinkCustomAttributes = "";
		$this->idCalificacion->HrefValue = "";
		$this->idCalificacion->TooltipValue = "";

		// numproceso
		$this->numproceso->LinkCustomAttributes = "";
		$this->numproceso->HrefValue = "";
		$this->numproceso->TooltipValue = "";

		// nomprocesoproyecto
		$this->nomprocesoproyecto->LinkCustomAttributes = "";
		$this->nomprocesoproyecto->HrefValue = "";
		$this->nomprocesoproyecto->TooltipValue = "";

		// nconsulnac
		$this->nconsulnac->LinkCustomAttributes = "";
		$this->nconsulnac->HrefValue = "";
		$this->nconsulnac->TooltipValue = "";

		// nconsulinter
		$this->nconsulinter->LinkCustomAttributes = "";
		$this->nconsulinter->HrefValue = "";
		$this->nconsulinter->TooltipValue = "";

		// costoesti
		$this->costoesti->LinkCustomAttributes = "";
		$this->costoesti->HrefValue = "";
		$this->costoesti->TooltipValue = "";

		// estadoproceso
		$this->estadoproceso->LinkCustomAttributes = "";
		$this->estadoproceso->HrefValue = "";
		$this->estadoproceso->TooltipValue = "";

		// actaaper
		$this->actaaper->LinkCustomAttributes = "";
		$this->actaaper->HrefValue = "";
		$this->actaaper->TooltipValue = "";

		// informeacta
		$this->informeacta->LinkCustomAttributes = "";
		$this->informeacta->HrefValue = "";
		$this->informeacta->TooltipValue = "";

		// resoladju
		$this->resoladju->LinkCustomAttributes = "";
		$this->resoladju->HrefValue = "";
		$this->resoladju->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// otro
		$this->otro->LinkCustomAttributes = "";
		$this->otro->HrefValue = "";
		$this->otro->TooltipValue = "";

		// numfirmasnac
		$this->numfirmasnac->LinkCustomAttributes = "";
		$this->numfirmasnac->HrefValue = "";
		$this->numfirmasnac->TooltipValue = "";

		// numfimasinter
		$this->numfimasinter->LinkCustomAttributes = "";
		$this->numfimasinter->HrefValue = "";
		$this->numfimasinter->TooltipValue = "";

		// numconsulcorta
		$this->numconsulcorta->LinkCustomAttributes = "";
		$this->numconsulcorta->HrefValue = "";
		$this->numconsulcorta->TooltipValue = "";

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

		// idAdjudicacion
		$this->idAdjudicacion->EditAttrs["class"] = "form-control";
		$this->idAdjudicacion->EditCustomAttributes = "";
		$this->idAdjudicacion->EditValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";

		// idCalificacion
		$this->idCalificacion->EditAttrs["class"] = "form-control";
		$this->idCalificacion->EditCustomAttributes = "";
		if ($this->idCalificacion->getSessionValue() <> "") {
			$this->idCalificacion->CurrentValue = $this->idCalificacion->getSessionValue();
		$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";
		} else {
		$this->idCalificacion->EditValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->PlaceHolder = ew_RemoveHtml($this->idCalificacion->FldCaption());
		}

		// numproceso
		$this->numproceso->EditAttrs["class"] = "form-control";
		$this->numproceso->EditCustomAttributes = "";
		$this->numproceso->EditValue = $this->numproceso->CurrentValue;
		$this->numproceso->PlaceHolder = ew_RemoveHtml($this->numproceso->FldCaption());

		// nomprocesoproyecto
		$this->nomprocesoproyecto->EditAttrs["class"] = "form-control";
		$this->nomprocesoproyecto->EditCustomAttributes = "";
		$this->nomprocesoproyecto->EditValue = $this->nomprocesoproyecto->CurrentValue;
		$this->nomprocesoproyecto->PlaceHolder = ew_RemoveHtml($this->nomprocesoproyecto->FldCaption());

		// nconsulnac
		$this->nconsulnac->EditAttrs["class"] = "form-control";
		$this->nconsulnac->EditCustomAttributes = "";
		$this->nconsulnac->EditValue = $this->nconsulnac->CurrentValue;
		$this->nconsulnac->PlaceHolder = ew_RemoveHtml($this->nconsulnac->FldCaption());

		// nconsulinter
		$this->nconsulinter->EditAttrs["class"] = "form-control";
		$this->nconsulinter->EditCustomAttributes = "";
		$this->nconsulinter->EditValue = $this->nconsulinter->CurrentValue;
		$this->nconsulinter->PlaceHolder = ew_RemoveHtml($this->nconsulinter->FldCaption());

		// costoesti
		$this->costoesti->EditAttrs["class"] = "form-control";
		$this->costoesti->EditCustomAttributes = "";
		$this->costoesti->EditValue = $this->costoesti->CurrentValue;
		$this->costoesti->PlaceHolder = ew_RemoveHtml($this->costoesti->FldCaption());
		if (strval($this->costoesti->EditValue) <> "" && is_numeric($this->costoesti->EditValue)) $this->costoesti->EditValue = ew_FormatNumber($this->costoesti->EditValue, -2, -1, -2, 0);

		// estadoproceso
		$this->estadoproceso->EditAttrs["class"] = "form-control";
		$this->estadoproceso->EditCustomAttributes = "";
		$this->estadoproceso->EditValue = $this->estadoproceso->CurrentValue;
		$this->estadoproceso->PlaceHolder = ew_RemoveHtml($this->estadoproceso->FldCaption());

		// actaaper
		$this->actaaper->EditAttrs["class"] = "form-control";
		$this->actaaper->EditCustomAttributes = "";
		$this->actaaper->EditValue = $this->actaaper->CurrentValue;
		$this->actaaper->PlaceHolder = ew_RemoveHtml($this->actaaper->FldCaption());

		// informeacta
		$this->informeacta->EditAttrs["class"] = "form-control";
		$this->informeacta->EditCustomAttributes = "";
		$this->informeacta->EditValue = $this->informeacta->CurrentValue;
		$this->informeacta->PlaceHolder = ew_RemoveHtml($this->informeacta->FldCaption());

		// resoladju
		$this->resoladju->EditAttrs["class"] = "form-control";
		$this->resoladju->EditCustomAttributes = "";
		$this->resoladju->EditValue = $this->resoladju->CurrentValue;
		$this->resoladju->PlaceHolder = ew_RemoveHtml($this->resoladju->FldCaption());

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

		// numfirmasnac
		$this->numfirmasnac->EditAttrs["class"] = "form-control";
		$this->numfirmasnac->EditCustomAttributes = "";
		$this->numfirmasnac->EditValue = $this->numfirmasnac->CurrentValue;
		$this->numfirmasnac->PlaceHolder = ew_RemoveHtml($this->numfirmasnac->FldCaption());

		// numfimasinter
		$this->numfimasinter->EditAttrs["class"] = "form-control";
		$this->numfimasinter->EditCustomAttributes = "";
		$this->numfimasinter->EditValue = $this->numfimasinter->CurrentValue;
		$this->numfimasinter->PlaceHolder = ew_RemoveHtml($this->numfimasinter->FldCaption());

		// numconsulcorta
		$this->numconsulcorta->EditAttrs["class"] = "form-control";
		$this->numconsulcorta->EditCustomAttributes = "";
		$this->numconsulcorta->EditValue = $this->numconsulcorta->CurrentValue;
		$this->numconsulcorta->PlaceHolder = ew_RemoveHtml($this->numconsulcorta->FldCaption());

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
					if ($this->idAdjudicacion->Exportable) $Doc->ExportCaption($this->idAdjudicacion);
					if ($this->idCalificacion->Exportable) $Doc->ExportCaption($this->idCalificacion);
					if ($this->numproceso->Exportable) $Doc->ExportCaption($this->numproceso);
					if ($this->nomprocesoproyecto->Exportable) $Doc->ExportCaption($this->nomprocesoproyecto);
					if ($this->nconsulnac->Exportable) $Doc->ExportCaption($this->nconsulnac);
					if ($this->nconsulinter->Exportable) $Doc->ExportCaption($this->nconsulinter);
					if ($this->costoesti->Exportable) $Doc->ExportCaption($this->costoesti);
					if ($this->estadoproceso->Exportable) $Doc->ExportCaption($this->estadoproceso);
					if ($this->actaaper->Exportable) $Doc->ExportCaption($this->actaaper);
					if ($this->informeacta->Exportable) $Doc->ExportCaption($this->informeacta);
					if ($this->resoladju->Exportable) $Doc->ExportCaption($this->resoladju);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->numfirmasnac->Exportable) $Doc->ExportCaption($this->numfirmasnac);
					if ($this->numfimasinter->Exportable) $Doc->ExportCaption($this->numfimasinter);
					if ($this->numconsulcorta->Exportable) $Doc->ExportCaption($this->numconsulcorta);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
				} else {
					if ($this->idAdjudicacion->Exportable) $Doc->ExportCaption($this->idAdjudicacion);
					if ($this->idCalificacion->Exportable) $Doc->ExportCaption($this->idCalificacion);
					if ($this->numproceso->Exportable) $Doc->ExportCaption($this->numproceso);
					if ($this->nconsulnac->Exportable) $Doc->ExportCaption($this->nconsulnac);
					if ($this->nconsulinter->Exportable) $Doc->ExportCaption($this->nconsulinter);
					if ($this->costoesti->Exportable) $Doc->ExportCaption($this->costoesti);
					if ($this->estadoproceso->Exportable) $Doc->ExportCaption($this->estadoproceso);
					if ($this->actaaper->Exportable) $Doc->ExportCaption($this->actaaper);
					if ($this->informeacta->Exportable) $Doc->ExportCaption($this->informeacta);
					if ($this->resoladju->Exportable) $Doc->ExportCaption($this->resoladju);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->numfirmasnac->Exportable) $Doc->ExportCaption($this->numfirmasnac);
					if ($this->numfimasinter->Exportable) $Doc->ExportCaption($this->numfimasinter);
					if ($this->numconsulcorta->Exportable) $Doc->ExportCaption($this->numconsulcorta);
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
						if ($this->idAdjudicacion->Exportable) $Doc->ExportField($this->idAdjudicacion);
						if ($this->idCalificacion->Exportable) $Doc->ExportField($this->idCalificacion);
						if ($this->numproceso->Exportable) $Doc->ExportField($this->numproceso);
						if ($this->nomprocesoproyecto->Exportable) $Doc->ExportField($this->nomprocesoproyecto);
						if ($this->nconsulnac->Exportable) $Doc->ExportField($this->nconsulnac);
						if ($this->nconsulinter->Exportable) $Doc->ExportField($this->nconsulinter);
						if ($this->costoesti->Exportable) $Doc->ExportField($this->costoesti);
						if ($this->estadoproceso->Exportable) $Doc->ExportField($this->estadoproceso);
						if ($this->actaaper->Exportable) $Doc->ExportField($this->actaaper);
						if ($this->informeacta->Exportable) $Doc->ExportField($this->informeacta);
						if ($this->resoladju->Exportable) $Doc->ExportField($this->resoladju);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->numfirmasnac->Exportable) $Doc->ExportField($this->numfirmasnac);
						if ($this->numfimasinter->Exportable) $Doc->ExportField($this->numfimasinter);
						if ($this->numconsulcorta->Exportable) $Doc->ExportField($this->numconsulcorta);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
					} else {
						if ($this->idAdjudicacion->Exportable) $Doc->ExportField($this->idAdjudicacion);
						if ($this->idCalificacion->Exportable) $Doc->ExportField($this->idCalificacion);
						if ($this->numproceso->Exportable) $Doc->ExportField($this->numproceso);
						if ($this->nconsulnac->Exportable) $Doc->ExportField($this->nconsulnac);
						if ($this->nconsulinter->Exportable) $Doc->ExportField($this->nconsulinter);
						if ($this->costoesti->Exportable) $Doc->ExportField($this->costoesti);
						if ($this->estadoproceso->Exportable) $Doc->ExportField($this->estadoproceso);
						if ($this->actaaper->Exportable) $Doc->ExportField($this->actaaper);
						if ($this->informeacta->Exportable) $Doc->ExportField($this->informeacta);
						if ($this->resoladju->Exportable) $Doc->ExportField($this->resoladju);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->numfirmasnac->Exportable) $Doc->ExportField($this->numfirmasnac);
						if ($this->numfimasinter->Exportable) $Doc->ExportField($this->numfimasinter);
						if ($this->numconsulcorta->Exportable) $Doc->ExportField($this->numconsulcorta);
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
