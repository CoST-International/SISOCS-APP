<?php

// Global variable for table object
$cs_programa = NULL;

//
// Table class for cs_programa
//
class ccs_programa extends cTable {
	var $idPrograma;
	var $programa;
	var $BIP;
	var $nombreprograma;
	var $ubicacion;
	var $entes;
	var $idFuncionario;
	var $idRol;
	var $idSector;
	var $idSubSector;
	var $descripcion;
	var $costoesti;
	var $fechaapro;
	var $cartaconvenio;
	var $otro1;
	var $planope;
	var $presupuesto;
	var $perfildelprogra;
	var $otro2;
	var $fechacreacion;
	var $estado;
	var $idProposito;
	var $fecharecibido;
	var $moneda;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_programa';
		$this->TableName = 'cs_programa';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_programa`";
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
		$this->idPrograma = new cField('cs_programa', 'cs_programa', 'x_idPrograma', 'idPrograma', '`idPrograma`', '`idPrograma`', 3, -1, FALSE, '`idPrograma`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idPrograma->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idPrograma'] = &$this->idPrograma;

		// programa
		$this->programa = new cField('cs_programa', 'cs_programa', 'x_programa', 'programa', '`programa`', '`programa`', 200, -1, FALSE, '`programa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['programa'] = &$this->programa;

		// BIP
		$this->BIP = new cField('cs_programa', 'cs_programa', 'x_BIP', 'BIP', '`BIP`', '`BIP`', 200, -1, FALSE, '`BIP`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['BIP'] = &$this->BIP;

		// nombreprograma
		$this->nombreprograma = new cField('cs_programa', 'cs_programa', 'x_nombreprograma', 'nombreprograma', '`nombreprograma`', '`nombreprograma`', 200, -1, FALSE, '`nombreprograma`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['nombreprograma'] = &$this->nombreprograma;

		// ubicacion
		$this->ubicacion = new cField('cs_programa', 'cs_programa', 'x_ubicacion', 'ubicacion', '`ubicacion`', '`ubicacion`', 201, -1, FALSE, '`ubicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['ubicacion'] = &$this->ubicacion;

		// entes
		$this->entes = new cField('cs_programa', 'cs_programa', 'x_entes', 'entes', '`entes`', '`entes`', 200, -1, FALSE, '`EV__entes`', TRUE, TRUE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->fields['entes'] = &$this->entes;

		// idFuncionario
		$this->idFuncionario = new cField('cs_programa', 'cs_programa', 'x_idFuncionario', 'idFuncionario', '`idFuncionario`', '`idFuncionario`', 3, -1, FALSE, '`idFuncionario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idFuncionario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idFuncionario'] = &$this->idFuncionario;

		// idRol
		$this->idRol = new cField('cs_programa', 'cs_programa', 'x_idRol', 'idRol', '`idRol`', '`idRol`', 3, -1, FALSE, '`idRol`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idRol->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idRol'] = &$this->idRol;

		// idSector
		$this->idSector = new cField('cs_programa', 'cs_programa', 'x_idSector', 'idSector', '`idSector`', '`idSector`', 3, -1, FALSE, '`idSector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idSector->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idSector'] = &$this->idSector;

		// idSubSector
		$this->idSubSector = new cField('cs_programa', 'cs_programa', 'x_idSubSector', 'idSubSector', '`idSubSector`', '`idSubSector`', 3, -1, FALSE, '`idSubSector`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idSubSector->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idSubSector'] = &$this->idSubSector;

		// descripcion
		$this->descripcion = new cField('cs_programa', 'cs_programa', 'x_descripcion', 'descripcion', '`descripcion`', '`descripcion`', 201, -1, FALSE, '`descripcion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['descripcion'] = &$this->descripcion;

		// costoesti
		$this->costoesti = new cField('cs_programa', 'cs_programa', 'x_costoesti', 'costoesti', '`costoesti`', '`costoesti`', 5, -1, FALSE, '`costoesti`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->costoesti->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['costoesti'] = &$this->costoesti;

		// fechaapro
		$this->fechaapro = new cField('cs_programa', 'cs_programa', 'x_fechaapro', 'fechaapro', '`fechaapro`', '`fechaapro`', 200, -1, FALSE, '`fechaapro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechaapro'] = &$this->fechaapro;

		// cartaconvenio
		$this->cartaconvenio = new cField('cs_programa', 'cs_programa', 'x_cartaconvenio', 'cartaconvenio', '`cartaconvenio`', '`cartaconvenio`', 200, -1, FALSE, '`cartaconvenio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['cartaconvenio'] = &$this->cartaconvenio;

		// otro1
		$this->otro1 = new cField('cs_programa', 'cs_programa', 'x_otro1', 'otro1', '`otro1`', '`otro1`', 200, -1, FALSE, '`otro1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro1'] = &$this->otro1;

		// planope
		$this->planope = new cField('cs_programa', 'cs_programa', 'x_planope', 'planope', '`planope`', '`planope`', 200, -1, FALSE, '`planope`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['planope'] = &$this->planope;

		// presupuesto
		$this->presupuesto = new cField('cs_programa', 'cs_programa', 'x_presupuesto', 'presupuesto', '`presupuesto`', '`presupuesto`', 200, -1, FALSE, '`presupuesto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['presupuesto'] = &$this->presupuesto;

		// perfildelprogra
		$this->perfildelprogra = new cField('cs_programa', 'cs_programa', 'x_perfildelprogra', 'perfildelprogra', '`perfildelprogra`', '`perfildelprogra`', 200, -1, FALSE, '`perfildelprogra`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['perfildelprogra'] = &$this->perfildelprogra;

		// otro2
		$this->otro2 = new cField('cs_programa', 'cs_programa', 'x_otro2', 'otro2', '`otro2`', '`otro2`', 200, -1, FALSE, '`otro2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro2'] = &$this->otro2;

		// fechacreacion
		$this->fechacreacion = new cField('cs_programa', 'cs_programa', 'x_fechacreacion', 'fechacreacion', '`fechacreacion`', '`fechacreacion`', 200, -1, FALSE, '`fechacreacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechacreacion'] = &$this->fechacreacion;

		// estado
		$this->estado = new cField('cs_programa', 'cs_programa', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// idProposito
		$this->idProposito = new cField('cs_programa', 'cs_programa', 'x_idProposito', 'idProposito', '`idProposito`', '`idProposito`', 3, -1, FALSE, '`idProposito`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idProposito->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idProposito'] = &$this->idProposito;

		// fecharecibido
		$this->fecharecibido = new cField('cs_programa', 'cs_programa', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', '`fecharecibido`', 200, -1, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecharecibido'] = &$this->fecharecibido;

		// moneda
		$this->moneda = new cField('cs_programa', 'cs_programa', 'x_moneda', 'moneda', '`moneda`', '`moneda`', 200, -1, FALSE, '`moneda`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['moneda'] = &$this->moneda;
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
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
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
		if ($this->getCurrentDetailTable() == "cs_proyecto") {
			$sDetailUrl = $GLOBALS["cs_proyecto"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_idPrograma=" . urlencode($this->idPrograma->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "cs_programalist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_programa`";
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
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `descripcion` FROM `cs_entes` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`idente` = `cs_programa`.`entes` LIMIT 1) AS `EV__entes` FROM `cs_programa`" .
			") `EW_TMP_TABLE`";
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
    	return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
    	$this->_SqlSelectList = $v;
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
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->BasicSearch->getKeyword() <> "")
			return TRUE;
		if (strpos($sOrderBy, " " . $this->entes->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
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
			if (array_key_exists('idPrograma', $rs))
				ew_AddFilter($where, ew_QuotedName('idPrograma', $this->DBID) . '=' . ew_QuotedValue($rs['idPrograma'], $this->idPrograma->FldDataType, $this->DBID));
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
		return "`idPrograma` = @idPrograma@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idPrograma->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idPrograma@", ew_AdjustSql($this->idPrograma->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_programalist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_programalist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_programaview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_programaview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_programaadd.php?" . $this->UrlParm($parm);
		else
			return "cs_programaadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_programaedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_programaedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_programaadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_programaadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_programadelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "idPrograma:" . ew_VarToJson($this->idPrograma->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idPrograma->CurrentValue)) {
			$sUrl .= "idPrograma=" . urlencode($this->idPrograma->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["idPrograma"]) : ew_StripSlashes(@$_GET["idPrograma"]); // idPrograma

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
			$this->idPrograma->CurrentValue = $key;
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
		$this->programa->setDbValue($rs->fields('programa'));
		$this->BIP->setDbValue($rs->fields('BIP'));
		$this->nombreprograma->setDbValue($rs->fields('nombreprograma'));
		$this->ubicacion->setDbValue($rs->fields('ubicacion'));
		$this->entes->setDbValue($rs->fields('entes'));
		$this->idFuncionario->setDbValue($rs->fields('idFuncionario'));
		$this->idRol->setDbValue($rs->fields('idRol'));
		$this->idSector->setDbValue($rs->fields('idSector'));
		$this->idSubSector->setDbValue($rs->fields('idSubSector'));
		$this->descripcion->setDbValue($rs->fields('descripcion'));
		$this->costoesti->setDbValue($rs->fields('costoesti'));
		$this->fechaapro->setDbValue($rs->fields('fechaapro'));
		$this->cartaconvenio->setDbValue($rs->fields('cartaconvenio'));
		$this->otro1->setDbValue($rs->fields('otro1'));
		$this->planope->setDbValue($rs->fields('planope'));
		$this->presupuesto->setDbValue($rs->fields('presupuesto'));
		$this->perfildelprogra->setDbValue($rs->fields('perfildelprogra'));
		$this->otro2->setDbValue($rs->fields('otro2'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->idProposito->setDbValue($rs->fields('idProposito'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->moneda->setDbValue($rs->fields('moneda'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idPrograma
		// programa
		// BIP
		// nombreprograma
		// ubicacion
		// entes
		// idFuncionario
		// idRol
		// idSector
		// idSubSector
		// descripcion
		// costoesti
		// fechaapro
		// cartaconvenio
		// otro1
		// planope
		// presupuesto
		// perfildelprogra
		// otro2
		// fechacreacion
		// estado
		// idProposito
		// fecharecibido
		// moneda
		// idPrograma

		$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->ViewCustomAttributes = "";

		// programa
		$this->programa->ViewValue = $this->programa->CurrentValue;
		$this->programa->ViewCustomAttributes = "";

		// BIP
		$this->BIP->ViewValue = $this->BIP->CurrentValue;
		$this->BIP->ViewCustomAttributes = "";

		// nombreprograma
		$this->nombreprograma->ViewValue = $this->nombreprograma->CurrentValue;
		$this->nombreprograma->ViewCustomAttributes = "";

		// ubicacion
		$this->ubicacion->ViewValue = $this->ubicacion->CurrentValue;
		$this->ubicacion->ViewCustomAttributes = "";

		// entes
		if ($this->entes->VirtualValue <> "") {
			$this->entes->ViewValue = $this->entes->VirtualValue;
		} else {
		if (strval($this->entes->CurrentValue) <> "") {
			$sFilterWrk = "`idente`" . ew_SearchString("=", $this->entes->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `idente`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cs_entes`";
		$sWhereWrk = "";
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->entes, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->entes->ViewValue = $this->entes->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->entes->ViewValue = $this->entes->CurrentValue;
			}
		} else {
			$this->entes->ViewValue = NULL;
		}
		}
		$this->entes->ViewCustomAttributes = "";

		// idFuncionario
		$this->idFuncionario->ViewValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->ViewCustomAttributes = "";

		// idRol
		$this->idRol->ViewValue = $this->idRol->CurrentValue;
		$this->idRol->ViewCustomAttributes = "";

		// idSector
		$this->idSector->ViewValue = $this->idSector->CurrentValue;
		$this->idSector->ViewCustomAttributes = "";

		// idSubSector
		$this->idSubSector->ViewValue = $this->idSubSector->CurrentValue;
		$this->idSubSector->ViewCustomAttributes = "";

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

		// costoesti
		$this->costoesti->ViewValue = $this->costoesti->CurrentValue;
		$this->costoesti->ViewCustomAttributes = "";

		// fechaapro
		$this->fechaapro->ViewValue = $this->fechaapro->CurrentValue;
		$this->fechaapro->ViewCustomAttributes = "";

		// cartaconvenio
		$this->cartaconvenio->ViewValue = $this->cartaconvenio->CurrentValue;
		$this->cartaconvenio->ViewCustomAttributes = "";

		// otro1
		$this->otro1->ViewValue = $this->otro1->CurrentValue;
		$this->otro1->ViewCustomAttributes = "";

		// planope
		$this->planope->ViewValue = $this->planope->CurrentValue;
		$this->planope->ViewCustomAttributes = "";

		// presupuesto
		$this->presupuesto->ViewValue = $this->presupuesto->CurrentValue;
		$this->presupuesto->ViewCustomAttributes = "";

		// perfildelprogra
		$this->perfildelprogra->ViewValue = $this->perfildelprogra->CurrentValue;
		$this->perfildelprogra->ViewCustomAttributes = "";

		// otro2
		$this->otro2->ViewValue = $this->otro2->CurrentValue;
		$this->otro2->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// idProposito
		$this->idProposito->ViewValue = $this->idProposito->CurrentValue;
		$this->idProposito->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// moneda
		$this->moneda->ViewValue = $this->moneda->CurrentValue;
		$this->moneda->ViewCustomAttributes = "";

		// idPrograma
		$this->idPrograma->LinkCustomAttributes = "";
		$this->idPrograma->HrefValue = "";
		$this->idPrograma->TooltipValue = "";

		// programa
		$this->programa->LinkCustomAttributes = "";
		$this->programa->HrefValue = "";
		$this->programa->TooltipValue = "";

		// BIP
		$this->BIP->LinkCustomAttributes = "";
		$this->BIP->HrefValue = "";
		$this->BIP->TooltipValue = "";

		// nombreprograma
		$this->nombreprograma->LinkCustomAttributes = "";
		$this->nombreprograma->HrefValue = "";
		$this->nombreprograma->TooltipValue = "";

		// ubicacion
		$this->ubicacion->LinkCustomAttributes = "";
		$this->ubicacion->HrefValue = "";
		$this->ubicacion->TooltipValue = "";

		// entes
		$this->entes->LinkCustomAttributes = "";
		$this->entes->HrefValue = "";
		$this->entes->TooltipValue = "";

		// idFuncionario
		$this->idFuncionario->LinkCustomAttributes = "";
		$this->idFuncionario->HrefValue = "";
		$this->idFuncionario->TooltipValue = "";

		// idRol
		$this->idRol->LinkCustomAttributes = "";
		$this->idRol->HrefValue = "";
		$this->idRol->TooltipValue = "";

		// idSector
		$this->idSector->LinkCustomAttributes = "";
		$this->idSector->HrefValue = "";
		$this->idSector->TooltipValue = "";

		// idSubSector
		$this->idSubSector->LinkCustomAttributes = "";
		$this->idSubSector->HrefValue = "";
		$this->idSubSector->TooltipValue = "";

		// descripcion
		$this->descripcion->LinkCustomAttributes = "";
		$this->descripcion->HrefValue = "";
		$this->descripcion->TooltipValue = "";

		// costoesti
		$this->costoesti->LinkCustomAttributes = "";
		$this->costoesti->HrefValue = "";
		$this->costoesti->TooltipValue = "";

		// fechaapro
		$this->fechaapro->LinkCustomAttributes = "";
		$this->fechaapro->HrefValue = "";
		$this->fechaapro->TooltipValue = "";

		// cartaconvenio
		$this->cartaconvenio->LinkCustomAttributes = "";
		$this->cartaconvenio->HrefValue = "";
		$this->cartaconvenio->TooltipValue = "";

		// otro1
		$this->otro1->LinkCustomAttributes = "";
		$this->otro1->HrefValue = "";
		$this->otro1->TooltipValue = "";

		// planope
		$this->planope->LinkCustomAttributes = "";
		$this->planope->HrefValue = "";
		$this->planope->TooltipValue = "";

		// presupuesto
		$this->presupuesto->LinkCustomAttributes = "";
		$this->presupuesto->HrefValue = "";
		$this->presupuesto->TooltipValue = "";

		// perfildelprogra
		$this->perfildelprogra->LinkCustomAttributes = "";
		$this->perfildelprogra->HrefValue = "";
		$this->perfildelprogra->TooltipValue = "";

		// otro2
		$this->otro2->LinkCustomAttributes = "";
		$this->otro2->HrefValue = "";
		$this->otro2->TooltipValue = "";

		// fechacreacion
		$this->fechacreacion->LinkCustomAttributes = "";
		$this->fechacreacion->HrefValue = "";
		$this->fechacreacion->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// idProposito
		$this->idProposito->LinkCustomAttributes = "";
		$this->idProposito->HrefValue = "";
		$this->idProposito->TooltipValue = "";

		// fecharecibido
		$this->fecharecibido->LinkCustomAttributes = "";
		$this->fecharecibido->HrefValue = "";
		$this->fecharecibido->TooltipValue = "";

		// moneda
		$this->moneda->LinkCustomAttributes = "";
		$this->moneda->HrefValue = "";
		$this->moneda->TooltipValue = "";

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
		$this->idPrograma->ViewCustomAttributes = "";

		// programa
		$this->programa->EditAttrs["class"] = "form-control";
		$this->programa->EditCustomAttributes = "";
		$this->programa->EditValue = $this->programa->CurrentValue;
		$this->programa->PlaceHolder = ew_RemoveHtml($this->programa->FldCaption());

		// BIP
		$this->BIP->EditAttrs["class"] = "form-control";
		$this->BIP->EditCustomAttributes = "";
		$this->BIP->EditValue = $this->BIP->CurrentValue;
		$this->BIP->PlaceHolder = ew_RemoveHtml($this->BIP->FldCaption());

		// nombreprograma
		$this->nombreprograma->EditAttrs["class"] = "form-control";
		$this->nombreprograma->EditCustomAttributes = "";
		$this->nombreprograma->EditValue = $this->nombreprograma->CurrentValue;
		$this->nombreprograma->PlaceHolder = ew_RemoveHtml($this->nombreprograma->FldCaption());

		// ubicacion
		$this->ubicacion->EditAttrs["class"] = "form-control";
		$this->ubicacion->EditCustomAttributes = "";
		$this->ubicacion->EditValue = $this->ubicacion->CurrentValue;
		$this->ubicacion->PlaceHolder = ew_RemoveHtml($this->ubicacion->FldCaption());

		// entes
		$this->entes->EditCustomAttributes = "";

		// idFuncionario
		$this->idFuncionario->EditAttrs["class"] = "form-control";
		$this->idFuncionario->EditCustomAttributes = "";
		$this->idFuncionario->EditValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

		// idRol
		$this->idRol->EditAttrs["class"] = "form-control";
		$this->idRol->EditCustomAttributes = "";
		$this->idRol->EditValue = $this->idRol->CurrentValue;
		$this->idRol->PlaceHolder = ew_RemoveHtml($this->idRol->FldCaption());

		// idSector
		$this->idSector->EditAttrs["class"] = "form-control";
		$this->idSector->EditCustomAttributes = "";
		$this->idSector->EditValue = $this->idSector->CurrentValue;
		$this->idSector->PlaceHolder = ew_RemoveHtml($this->idSector->FldCaption());

		// idSubSector
		$this->idSubSector->EditAttrs["class"] = "form-control";
		$this->idSubSector->EditCustomAttributes = "";
		$this->idSubSector->EditValue = $this->idSubSector->CurrentValue;
		$this->idSubSector->PlaceHolder = ew_RemoveHtml($this->idSubSector->FldCaption());

		// descripcion
		$this->descripcion->EditAttrs["class"] = "form-control";
		$this->descripcion->EditCustomAttributes = "";
		$this->descripcion->EditValue = $this->descripcion->CurrentValue;
		$this->descripcion->PlaceHolder = ew_RemoveHtml($this->descripcion->FldCaption());

		// costoesti
		$this->costoesti->EditAttrs["class"] = "form-control";
		$this->costoesti->EditCustomAttributes = "";
		$this->costoesti->EditValue = $this->costoesti->CurrentValue;
		$this->costoesti->PlaceHolder = ew_RemoveHtml($this->costoesti->FldCaption());
		if (strval($this->costoesti->EditValue) <> "" && is_numeric($this->costoesti->EditValue)) $this->costoesti->EditValue = ew_FormatNumber($this->costoesti->EditValue, -2, -1, -2, 0);

		// fechaapro
		$this->fechaapro->EditAttrs["class"] = "form-control";
		$this->fechaapro->EditCustomAttributes = "";
		$this->fechaapro->EditValue = $this->fechaapro->CurrentValue;
		$this->fechaapro->PlaceHolder = ew_RemoveHtml($this->fechaapro->FldCaption());

		// cartaconvenio
		$this->cartaconvenio->EditAttrs["class"] = "form-control";
		$this->cartaconvenio->EditCustomAttributes = "";
		$this->cartaconvenio->EditValue = $this->cartaconvenio->CurrentValue;
		$this->cartaconvenio->PlaceHolder = ew_RemoveHtml($this->cartaconvenio->FldCaption());

		// otro1
		$this->otro1->EditAttrs["class"] = "form-control";
		$this->otro1->EditCustomAttributes = "";
		$this->otro1->EditValue = $this->otro1->CurrentValue;
		$this->otro1->PlaceHolder = ew_RemoveHtml($this->otro1->FldCaption());

		// planope
		$this->planope->EditAttrs["class"] = "form-control";
		$this->planope->EditCustomAttributes = "";
		$this->planope->EditValue = $this->planope->CurrentValue;
		$this->planope->PlaceHolder = ew_RemoveHtml($this->planope->FldCaption());

		// presupuesto
		$this->presupuesto->EditAttrs["class"] = "form-control";
		$this->presupuesto->EditCustomAttributes = "";
		$this->presupuesto->EditValue = $this->presupuesto->CurrentValue;
		$this->presupuesto->PlaceHolder = ew_RemoveHtml($this->presupuesto->FldCaption());

		// perfildelprogra
		$this->perfildelprogra->EditAttrs["class"] = "form-control";
		$this->perfildelprogra->EditCustomAttributes = "";
		$this->perfildelprogra->EditValue = $this->perfildelprogra->CurrentValue;
		$this->perfildelprogra->PlaceHolder = ew_RemoveHtml($this->perfildelprogra->FldCaption());

		// otro2
		$this->otro2->EditAttrs["class"] = "form-control";
		$this->otro2->EditCustomAttributes = "";
		$this->otro2->EditValue = $this->otro2->CurrentValue;
		$this->otro2->PlaceHolder = ew_RemoveHtml($this->otro2->FldCaption());

		// fechacreacion
		$this->fechacreacion->EditAttrs["class"] = "form-control";
		$this->fechacreacion->EditCustomAttributes = "";
		$this->fechacreacion->EditValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->PlaceHolder = ew_RemoveHtml($this->fechacreacion->FldCaption());

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		$this->estado->EditValue = $this->estado->CurrentValue;
		$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

		// idProposito
		$this->idProposito->EditAttrs["class"] = "form-control";
		$this->idProposito->EditCustomAttributes = "";
		$this->idProposito->EditValue = $this->idProposito->CurrentValue;
		$this->idProposito->PlaceHolder = ew_RemoveHtml($this->idProposito->FldCaption());

		// fecharecibido
		$this->fecharecibido->EditAttrs["class"] = "form-control";
		$this->fecharecibido->EditCustomAttributes = "";
		$this->fecharecibido->EditValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

		// moneda
		$this->moneda->EditAttrs["class"] = "form-control";
		$this->moneda->EditCustomAttributes = "";
		$this->moneda->EditValue = $this->moneda->CurrentValue;
		$this->moneda->PlaceHolder = ew_RemoveHtml($this->moneda->FldCaption());

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
					if ($this->programa->Exportable) $Doc->ExportCaption($this->programa);
					if ($this->BIP->Exportable) $Doc->ExportCaption($this->BIP);
					if ($this->nombreprograma->Exportable) $Doc->ExportCaption($this->nombreprograma);
					if ($this->ubicacion->Exportable) $Doc->ExportCaption($this->ubicacion);
					if ($this->entes->Exportable) $Doc->ExportCaption($this->entes);
					if ($this->idFuncionario->Exportable) $Doc->ExportCaption($this->idFuncionario);
					if ($this->idRol->Exportable) $Doc->ExportCaption($this->idRol);
					if ($this->idSector->Exportable) $Doc->ExportCaption($this->idSector);
					if ($this->idSubSector->Exportable) $Doc->ExportCaption($this->idSubSector);
					if ($this->descripcion->Exportable) $Doc->ExportCaption($this->descripcion);
					if ($this->costoesti->Exportable) $Doc->ExportCaption($this->costoesti);
					if ($this->fechaapro->Exportable) $Doc->ExportCaption($this->fechaapro);
					if ($this->cartaconvenio->Exportable) $Doc->ExportCaption($this->cartaconvenio);
					if ($this->otro1->Exportable) $Doc->ExportCaption($this->otro1);
					if ($this->planope->Exportable) $Doc->ExportCaption($this->planope);
					if ($this->presupuesto->Exportable) $Doc->ExportCaption($this->presupuesto);
					if ($this->perfildelprogra->Exportable) $Doc->ExportCaption($this->perfildelprogra);
					if ($this->otro2->Exportable) $Doc->ExportCaption($this->otro2);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->idProposito->Exportable) $Doc->ExportCaption($this->idProposito);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->moneda->Exportable) $Doc->ExportCaption($this->moneda);
				} else {
					if ($this->idPrograma->Exportable) $Doc->ExportCaption($this->idPrograma);
					if ($this->programa->Exportable) $Doc->ExportCaption($this->programa);
					if ($this->BIP->Exportable) $Doc->ExportCaption($this->BIP);
					if ($this->nombreprograma->Exportable) $Doc->ExportCaption($this->nombreprograma);
					if ($this->entes->Exportable) $Doc->ExportCaption($this->entes);
					if ($this->idFuncionario->Exportable) $Doc->ExportCaption($this->idFuncionario);
					if ($this->idRol->Exportable) $Doc->ExportCaption($this->idRol);
					if ($this->idSector->Exportable) $Doc->ExportCaption($this->idSector);
					if ($this->idSubSector->Exportable) $Doc->ExportCaption($this->idSubSector);
					if ($this->costoesti->Exportable) $Doc->ExportCaption($this->costoesti);
					if ($this->fechaapro->Exportable) $Doc->ExportCaption($this->fechaapro);
					if ($this->cartaconvenio->Exportable) $Doc->ExportCaption($this->cartaconvenio);
					if ($this->otro1->Exportable) $Doc->ExportCaption($this->otro1);
					if ($this->planope->Exportable) $Doc->ExportCaption($this->planope);
					if ($this->presupuesto->Exportable) $Doc->ExportCaption($this->presupuesto);
					if ($this->perfildelprogra->Exportable) $Doc->ExportCaption($this->perfildelprogra);
					if ($this->otro2->Exportable) $Doc->ExportCaption($this->otro2);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->idProposito->Exportable) $Doc->ExportCaption($this->idProposito);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->moneda->Exportable) $Doc->ExportCaption($this->moneda);
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
						if ($this->programa->Exportable) $Doc->ExportField($this->programa);
						if ($this->BIP->Exportable) $Doc->ExportField($this->BIP);
						if ($this->nombreprograma->Exportable) $Doc->ExportField($this->nombreprograma);
						if ($this->ubicacion->Exportable) $Doc->ExportField($this->ubicacion);
						if ($this->entes->Exportable) $Doc->ExportField($this->entes);
						if ($this->idFuncionario->Exportable) $Doc->ExportField($this->idFuncionario);
						if ($this->idRol->Exportable) $Doc->ExportField($this->idRol);
						if ($this->idSector->Exportable) $Doc->ExportField($this->idSector);
						if ($this->idSubSector->Exportable) $Doc->ExportField($this->idSubSector);
						if ($this->descripcion->Exportable) $Doc->ExportField($this->descripcion);
						if ($this->costoesti->Exportable) $Doc->ExportField($this->costoesti);
						if ($this->fechaapro->Exportable) $Doc->ExportField($this->fechaapro);
						if ($this->cartaconvenio->Exportable) $Doc->ExportField($this->cartaconvenio);
						if ($this->otro1->Exportable) $Doc->ExportField($this->otro1);
						if ($this->planope->Exportable) $Doc->ExportField($this->planope);
						if ($this->presupuesto->Exportable) $Doc->ExportField($this->presupuesto);
						if ($this->perfildelprogra->Exportable) $Doc->ExportField($this->perfildelprogra);
						if ($this->otro2->Exportable) $Doc->ExportField($this->otro2);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->idProposito->Exportable) $Doc->ExportField($this->idProposito);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->moneda->Exportable) $Doc->ExportField($this->moneda);
					} else {
						if ($this->idPrograma->Exportable) $Doc->ExportField($this->idPrograma);
						if ($this->programa->Exportable) $Doc->ExportField($this->programa);
						if ($this->BIP->Exportable) $Doc->ExportField($this->BIP);
						if ($this->nombreprograma->Exportable) $Doc->ExportField($this->nombreprograma);
						if ($this->entes->Exportable) $Doc->ExportField($this->entes);
						if ($this->idFuncionario->Exportable) $Doc->ExportField($this->idFuncionario);
						if ($this->idRol->Exportable) $Doc->ExportField($this->idRol);
						if ($this->idSector->Exportable) $Doc->ExportField($this->idSector);
						if ($this->idSubSector->Exportable) $Doc->ExportField($this->idSubSector);
						if ($this->costoesti->Exportable) $Doc->ExportField($this->costoesti);
						if ($this->fechaapro->Exportable) $Doc->ExportField($this->fechaapro);
						if ($this->cartaconvenio->Exportable) $Doc->ExportField($this->cartaconvenio);
						if ($this->otro1->Exportable) $Doc->ExportField($this->otro1);
						if ($this->planope->Exportable) $Doc->ExportField($this->planope);
						if ($this->presupuesto->Exportable) $Doc->ExportField($this->presupuesto);
						if ($this->perfildelprogra->Exportable) $Doc->ExportField($this->perfildelprogra);
						if ($this->otro2->Exportable) $Doc->ExportField($this->otro2);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->idProposito->Exportable) $Doc->ExportField($this->idProposito);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->moneda->Exportable) $Doc->ExportField($this->moneda);
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
