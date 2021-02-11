<?php

// Global variable for table object
$cs_avances = NULL;

//
// Table class for cs_avances
//
class ccs_avances extends cTable {
	var $codigo;
	var $codigo_inicio_ejecucion;
	var $porcent_programado;
	var $porcent_real;
	var $finan_programado;
	var $finan_real;
	var $fecha_registro;
	var $estado;
	var $user_registro;
	var $desc_problemas;
	var $desc_temas;
	var $idEjecucion;
	var $fecha_avance;
	var $idContratacion;
	var $estado_sol;
	var $adj_garantias;
	var $adj_avances;
	var $adj_supervicion;
	var $adj_evaluacion;
	var $adj_tecnica;
	var $adj_financiero;
	var $adj_recepcion;
	var $adj_disconformidad;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_avances';
		$this->TableName = 'cs_avances';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_avances`";
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

		// codigo
		$this->codigo = new cField('cs_avances', 'cs_avances', 'x_codigo', 'codigo', '`codigo`', '`codigo`', 3, -1, FALSE, '`codigo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->codigo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['codigo'] = &$this->codigo;

		// codigo_inicio_ejecucion
		$this->codigo_inicio_ejecucion = new cField('cs_avances', 'cs_avances', 'x_codigo_inicio_ejecucion', 'codigo_inicio_ejecucion', '`codigo_inicio_ejecucion`', '`codigo_inicio_ejecucion`', 3, -1, FALSE, '`codigo_inicio_ejecucion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->codigo_inicio_ejecucion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['codigo_inicio_ejecucion'] = &$this->codigo_inicio_ejecucion;

		// porcent_programado
		$this->porcent_programado = new cField('cs_avances', 'cs_avances', 'x_porcent_programado', 'porcent_programado', '`porcent_programado`', '`porcent_programado`', 131, -1, FALSE, '`porcent_programado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->porcent_programado->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['porcent_programado'] = &$this->porcent_programado;

		// porcent_real
		$this->porcent_real = new cField('cs_avances', 'cs_avances', 'x_porcent_real', 'porcent_real', '`porcent_real`', '`porcent_real`', 131, -1, FALSE, '`porcent_real`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->porcent_real->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['porcent_real'] = &$this->porcent_real;

		// finan_programado
		$this->finan_programado = new cField('cs_avances', 'cs_avances', 'x_finan_programado', 'finan_programado', '`finan_programado`', '`finan_programado`', 131, -1, FALSE, '`finan_programado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->finan_programado->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['finan_programado'] = &$this->finan_programado;

		// finan_real
		$this->finan_real = new cField('cs_avances', 'cs_avances', 'x_finan_real', 'finan_real', '`finan_real`', '`finan_real`', 131, -1, FALSE, '`finan_real`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->finan_real->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['finan_real'] = &$this->finan_real;

		// fecha_registro
		$this->fecha_registro = new cField('cs_avances', 'cs_avances', 'x_fecha_registro', 'fecha_registro', '`fecha_registro`', 'DATE_FORMAT(`fecha_registro`, \'%Y/%m/%d\')', 135, 5, FALSE, '`fecha_registro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_registro->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_registro'] = &$this->fecha_registro;

		// estado
		$this->estado = new cField('cs_avances', 'cs_avances', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// user_registro
		$this->user_registro = new cField('cs_avances', 'cs_avances', 'x_user_registro', 'user_registro', '`user_registro`', '`user_registro`', 200, -1, FALSE, '`user_registro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['user_registro'] = &$this->user_registro;

		// desc_problemas
		$this->desc_problemas = new cField('cs_avances', 'cs_avances', 'x_desc_problemas', 'desc_problemas', '`desc_problemas`', '`desc_problemas`', 200, -1, FALSE, '`desc_problemas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['desc_problemas'] = &$this->desc_problemas;

		// desc_temas
		$this->desc_temas = new cField('cs_avances', 'cs_avances', 'x_desc_temas', 'desc_temas', '`desc_temas`', '`desc_temas`', 200, -1, FALSE, '`desc_temas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['desc_temas'] = &$this->desc_temas;

		// idEjecucion
		$this->idEjecucion = new cField('cs_avances', 'cs_avances', 'x_idEjecucion', 'idEjecucion', '`idEjecucion`', '`idEjecucion`', 3, -1, FALSE, '`idEjecucion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idEjecucion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idEjecucion'] = &$this->idEjecucion;

		// fecha_avance
		$this->fecha_avance = new cField('cs_avances', 'cs_avances', 'x_fecha_avance', 'fecha_avance', '`fecha_avance`', 'DATE_FORMAT(`fecha_avance`, \'%Y/%m/%d\')', 133, 5, FALSE, '`fecha_avance`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_avance->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_avance'] = &$this->fecha_avance;

		// idContratacion
		$this->idContratacion = new cField('cs_avances', 'cs_avances', 'x_idContratacion', 'idContratacion', '`idContratacion`', '`idContratacion`', 3, -1, FALSE, '`idContratacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idContratacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratacion'] = &$this->idContratacion;

		// estado_sol
		$this->estado_sol = new cField('cs_avances', 'cs_avances', 'x_estado_sol', 'estado_sol', '`estado_sol`', '`estado_sol`', 200, -1, FALSE, '`estado_sol`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado_sol'] = &$this->estado_sol;

		// adj_garantias
		$this->adj_garantias = new cField('cs_avances', 'cs_avances', 'x_adj_garantias', 'adj_garantias', '`adj_garantias`', '`adj_garantias`', 200, -1, FALSE, '`adj_garantias`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_garantias'] = &$this->adj_garantias;

		// adj_avances
		$this->adj_avances = new cField('cs_avances', 'cs_avances', 'x_adj_avances', 'adj_avances', '`adj_avances`', '`adj_avances`', 200, -1, FALSE, '`adj_avances`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_avances'] = &$this->adj_avances;

		// adj_supervicion
		$this->adj_supervicion = new cField('cs_avances', 'cs_avances', 'x_adj_supervicion', 'adj_supervicion', '`adj_supervicion`', '`adj_supervicion`', 200, -1, FALSE, '`adj_supervicion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_supervicion'] = &$this->adj_supervicion;

		// adj_evaluacion
		$this->adj_evaluacion = new cField('cs_avances', 'cs_avances', 'x_adj_evaluacion', 'adj_evaluacion', '`adj_evaluacion`', '`adj_evaluacion`', 200, -1, FALSE, '`adj_evaluacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_evaluacion'] = &$this->adj_evaluacion;

		// adj_tecnica
		$this->adj_tecnica = new cField('cs_avances', 'cs_avances', 'x_adj_tecnica', 'adj_tecnica', '`adj_tecnica`', '`adj_tecnica`', 200, -1, FALSE, '`adj_tecnica`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_tecnica'] = &$this->adj_tecnica;

		// adj_financiero
		$this->adj_financiero = new cField('cs_avances', 'cs_avances', 'x_adj_financiero', 'adj_financiero', '`adj_financiero`', '`adj_financiero`', 200, -1, FALSE, '`adj_financiero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_financiero'] = &$this->adj_financiero;

		// adj_recepcion
		$this->adj_recepcion = new cField('cs_avances', 'cs_avances', 'x_adj_recepcion', 'adj_recepcion', '`adj_recepcion`', '`adj_recepcion`', 200, -1, FALSE, '`adj_recepcion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_recepcion'] = &$this->adj_recepcion;

		// adj_disconformidad
		$this->adj_disconformidad = new cField('cs_avances', 'cs_avances', 'x_adj_disconformidad', 'adj_disconformidad', '`adj_disconformidad`', '`adj_disconformidad`', 200, -1, FALSE, '`adj_disconformidad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adj_disconformidad'] = &$this->adj_disconformidad;
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
		if ($this->getCurrentMasterTable() == "cs_inicio_ejecucion") {
			if ($this->codigo_inicio_ejecucion->getSessionValue() <> "")
				$sMasterFilter .= "`idContratacion`=" . ew_QuotedValue($this->codigo_inicio_ejecucion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cs_inicio_ejecucion") {
			if ($this->codigo_inicio_ejecucion->getSessionValue() <> "")
				$sDetailFilter .= "`codigo_inicio_ejecucion`=" . ew_QuotedValue($this->codigo_inicio_ejecucion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cs_inicio_ejecucion() {
		return "`idContratacion`=@idContratacion@";
	}

	// Detail filter
	function SqlDetailFilter_cs_inicio_ejecucion() {
		return "`codigo_inicio_ejecucion`=@codigo_inicio_ejecucion@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_avances`";
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
			if (array_key_exists('codigo', $rs))
				ew_AddFilter($where, ew_QuotedName('codigo', $this->DBID) . '=' . ew_QuotedValue($rs['codigo'], $this->codigo->FldDataType, $this->DBID));
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
		return "`codigo` = @codigo@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->codigo->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@codigo@", ew_AdjustSql($this->codigo->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_avanceslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_avanceslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_avancesview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_avancesview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_avancesadd.php?" . $this->UrlParm($parm);
		else
			return "cs_avancesadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("cs_avancesedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("cs_avancesadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_avancesdelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "codigo:" . ew_VarToJson($this->codigo->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->codigo->CurrentValue)) {
			$sUrl .= "codigo=" . urlencode($this->codigo->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["codigo"]) : ew_StripSlashes(@$_GET["codigo"]); // codigo

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
			$this->codigo->CurrentValue = $key;
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
		$this->codigo->setDbValue($rs->fields('codigo'));
		$this->codigo_inicio_ejecucion->setDbValue($rs->fields('codigo_inicio_ejecucion'));
		$this->porcent_programado->setDbValue($rs->fields('porcent_programado'));
		$this->porcent_real->setDbValue($rs->fields('porcent_real'));
		$this->finan_programado->setDbValue($rs->fields('finan_programado'));
		$this->finan_real->setDbValue($rs->fields('finan_real'));
		$this->fecha_registro->setDbValue($rs->fields('fecha_registro'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->user_registro->setDbValue($rs->fields('user_registro'));
		$this->desc_problemas->setDbValue($rs->fields('desc_problemas'));
		$this->desc_temas->setDbValue($rs->fields('desc_temas'));
		$this->idEjecucion->setDbValue($rs->fields('idEjecucion'));
		$this->fecha_avance->setDbValue($rs->fields('fecha_avance'));
		$this->idContratacion->setDbValue($rs->fields('idContratacion'));
		$this->estado_sol->setDbValue($rs->fields('estado_sol'));
		$this->adj_garantias->setDbValue($rs->fields('adj_garantias'));
		$this->adj_avances->setDbValue($rs->fields('adj_avances'));
		$this->adj_supervicion->setDbValue($rs->fields('adj_supervicion'));
		$this->adj_evaluacion->setDbValue($rs->fields('adj_evaluacion'));
		$this->adj_tecnica->setDbValue($rs->fields('adj_tecnica'));
		$this->adj_financiero->setDbValue($rs->fields('adj_financiero'));
		$this->adj_recepcion->setDbValue($rs->fields('adj_recepcion'));
		$this->adj_disconformidad->setDbValue($rs->fields('adj_disconformidad'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// codigo
		// codigo_inicio_ejecucion
		// porcent_programado
		// porcent_real
		// finan_programado
		// finan_real
		// fecha_registro
		// estado
		// user_registro
		// desc_problemas
		// desc_temas
		// idEjecucion
		// fecha_avance
		// idContratacion
		// estado_sol
		// adj_garantias
		// adj_avances
		// adj_supervicion
		// adj_evaluacion
		// adj_tecnica
		// adj_financiero
		// adj_recepcion
		// adj_disconformidad
		// codigo

		$this->codigo->ViewValue = $this->codigo->CurrentValue;
		$this->codigo->ViewCustomAttributes = "";

		// codigo_inicio_ejecucion
		$this->codigo_inicio_ejecucion->ViewValue = $this->codigo_inicio_ejecucion->CurrentValue;
		$this->codigo_inicio_ejecucion->ViewCustomAttributes = "";

		// porcent_programado
		$this->porcent_programado->ViewValue = $this->porcent_programado->CurrentValue;
		$this->porcent_programado->ViewCustomAttributes = "";

		// porcent_real
		$this->porcent_real->ViewValue = $this->porcent_real->CurrentValue;
		$this->porcent_real->ViewCustomAttributes = "";

		// finan_programado
		$this->finan_programado->ViewValue = $this->finan_programado->CurrentValue;
		$this->finan_programado->ViewCustomAttributes = "";

		// finan_real
		$this->finan_real->ViewValue = $this->finan_real->CurrentValue;
		$this->finan_real->ViewCustomAttributes = "";

		// fecha_registro
		$this->fecha_registro->ViewValue = $this->fecha_registro->CurrentValue;
		$this->fecha_registro->ViewValue = ew_FormatDateTime($this->fecha_registro->ViewValue, 5);
		$this->fecha_registro->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// user_registro
		$this->user_registro->ViewValue = $this->user_registro->CurrentValue;
		$this->user_registro->ViewCustomAttributes = "";

		// desc_problemas
		$this->desc_problemas->ViewValue = $this->desc_problemas->CurrentValue;
		$this->desc_problemas->ViewCustomAttributes = "";

		// desc_temas
		$this->desc_temas->ViewValue = $this->desc_temas->CurrentValue;
		$this->desc_temas->ViewCustomAttributes = "";

		// idEjecucion
		$this->idEjecucion->ViewValue = $this->idEjecucion->CurrentValue;
		$this->idEjecucion->ViewCustomAttributes = "";

		// fecha_avance
		$this->fecha_avance->ViewValue = $this->fecha_avance->CurrentValue;
		$this->fecha_avance->ViewValue = ew_FormatDateTime($this->fecha_avance->ViewValue, 5);
		$this->fecha_avance->ViewCustomAttributes = "";

		// idContratacion
		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// estado_sol
		$this->estado_sol->ViewValue = $this->estado_sol->CurrentValue;
		$this->estado_sol->ViewCustomAttributes = "";

		// adj_garantias
		$this->adj_garantias->ViewValue = $this->adj_garantias->CurrentValue;
		$this->adj_garantias->ViewCustomAttributes = "";

		// adj_avances
		$this->adj_avances->ViewValue = $this->adj_avances->CurrentValue;
		$this->adj_avances->ViewCustomAttributes = "";

		// adj_supervicion
		$this->adj_supervicion->ViewValue = $this->adj_supervicion->CurrentValue;
		$this->adj_supervicion->ViewCustomAttributes = "";

		// adj_evaluacion
		$this->adj_evaluacion->ViewValue = $this->adj_evaluacion->CurrentValue;
		$this->adj_evaluacion->ViewCustomAttributes = "";

		// adj_tecnica
		$this->adj_tecnica->ViewValue = $this->adj_tecnica->CurrentValue;
		$this->adj_tecnica->ViewCustomAttributes = "";

		// adj_financiero
		$this->adj_financiero->ViewValue = $this->adj_financiero->CurrentValue;
		$this->adj_financiero->ViewCustomAttributes = "";

		// adj_recepcion
		$this->adj_recepcion->ViewValue = $this->adj_recepcion->CurrentValue;
		$this->adj_recepcion->ViewCustomAttributes = "";

		// adj_disconformidad
		$this->adj_disconformidad->ViewValue = $this->adj_disconformidad->CurrentValue;
		$this->adj_disconformidad->ViewCustomAttributes = "";

		// codigo
		$this->codigo->LinkCustomAttributes = "";
		$this->codigo->HrefValue = "";
		$this->codigo->TooltipValue = "";

		// codigo_inicio_ejecucion
		$this->codigo_inicio_ejecucion->LinkCustomAttributes = "";
		$this->codigo_inicio_ejecucion->HrefValue = "";
		$this->codigo_inicio_ejecucion->TooltipValue = "";

		// porcent_programado
		$this->porcent_programado->LinkCustomAttributes = "";
		$this->porcent_programado->HrefValue = "";
		$this->porcent_programado->TooltipValue = "";

		// porcent_real
		$this->porcent_real->LinkCustomAttributes = "";
		$this->porcent_real->HrefValue = "";
		$this->porcent_real->TooltipValue = "";

		// finan_programado
		$this->finan_programado->LinkCustomAttributes = "";
		$this->finan_programado->HrefValue = "";
		$this->finan_programado->TooltipValue = "";

		// finan_real
		$this->finan_real->LinkCustomAttributes = "";
		$this->finan_real->HrefValue = "";
		$this->finan_real->TooltipValue = "";

		// fecha_registro
		$this->fecha_registro->LinkCustomAttributes = "";
		$this->fecha_registro->HrefValue = "";
		$this->fecha_registro->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// user_registro
		$this->user_registro->LinkCustomAttributes = "";
		$this->user_registro->HrefValue = "";
		$this->user_registro->TooltipValue = "";

		// desc_problemas
		$this->desc_problemas->LinkCustomAttributes = "";
		$this->desc_problemas->HrefValue = "";
		$this->desc_problemas->TooltipValue = "";

		// desc_temas
		$this->desc_temas->LinkCustomAttributes = "";
		$this->desc_temas->HrefValue = "";
		$this->desc_temas->TooltipValue = "";

		// idEjecucion
		$this->idEjecucion->LinkCustomAttributes = "";
		$this->idEjecucion->HrefValue = "";
		$this->idEjecucion->TooltipValue = "";

		// fecha_avance
		$this->fecha_avance->LinkCustomAttributes = "";
		$this->fecha_avance->HrefValue = "";
		$this->fecha_avance->TooltipValue = "";

		// idContratacion
		$this->idContratacion->LinkCustomAttributes = "";
		$this->idContratacion->HrefValue = "";
		$this->idContratacion->TooltipValue = "";

		// estado_sol
		$this->estado_sol->LinkCustomAttributes = "";
		$this->estado_sol->HrefValue = "";
		$this->estado_sol->TooltipValue = "";

		// adj_garantias
		$this->adj_garantias->LinkCustomAttributes = "";
		$this->adj_garantias->HrefValue = "";
		$this->adj_garantias->TooltipValue = "";

		// adj_avances
		$this->adj_avances->LinkCustomAttributes = "";
		$this->adj_avances->HrefValue = "";
		$this->adj_avances->TooltipValue = "";

		// adj_supervicion
		$this->adj_supervicion->LinkCustomAttributes = "";
		$this->adj_supervicion->HrefValue = "";
		$this->adj_supervicion->TooltipValue = "";

		// adj_evaluacion
		$this->adj_evaluacion->LinkCustomAttributes = "";
		$this->adj_evaluacion->HrefValue = "";
		$this->adj_evaluacion->TooltipValue = "";

		// adj_tecnica
		$this->adj_tecnica->LinkCustomAttributes = "";
		$this->adj_tecnica->HrefValue = "";
		$this->adj_tecnica->TooltipValue = "";

		// adj_financiero
		$this->adj_financiero->LinkCustomAttributes = "";
		$this->adj_financiero->HrefValue = "";
		$this->adj_financiero->TooltipValue = "";

		// adj_recepcion
		$this->adj_recepcion->LinkCustomAttributes = "";
		$this->adj_recepcion->HrefValue = "";
		$this->adj_recepcion->TooltipValue = "";

		// adj_disconformidad
		$this->adj_disconformidad->LinkCustomAttributes = "";
		$this->adj_disconformidad->HrefValue = "";
		$this->adj_disconformidad->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// codigo
		$this->codigo->EditAttrs["class"] = "form-control";
		$this->codigo->EditCustomAttributes = "";
		$this->codigo->EditValue = $this->codigo->CurrentValue;
		$this->codigo->ViewCustomAttributes = "";

		// codigo_inicio_ejecucion
		$this->codigo_inicio_ejecucion->EditAttrs["class"] = "form-control";
		$this->codigo_inicio_ejecucion->EditCustomAttributes = "";
		if ($this->codigo_inicio_ejecucion->getSessionValue() <> "") {
			$this->codigo_inicio_ejecucion->CurrentValue = $this->codigo_inicio_ejecucion->getSessionValue();
		$this->codigo_inicio_ejecucion->ViewValue = $this->codigo_inicio_ejecucion->CurrentValue;
		$this->codigo_inicio_ejecucion->ViewCustomAttributes = "";
		} else {
		$this->codigo_inicio_ejecucion->EditValue = $this->codigo_inicio_ejecucion->CurrentValue;
		$this->codigo_inicio_ejecucion->PlaceHolder = ew_RemoveHtml($this->codigo_inicio_ejecucion->FldCaption());
		}

		// porcent_programado
		$this->porcent_programado->EditAttrs["class"] = "form-control";
		$this->porcent_programado->EditCustomAttributes = "";
		$this->porcent_programado->EditValue = $this->porcent_programado->CurrentValue;
		$this->porcent_programado->PlaceHolder = ew_RemoveHtml($this->porcent_programado->FldCaption());
		if (strval($this->porcent_programado->EditValue) <> "" && is_numeric($this->porcent_programado->EditValue)) $this->porcent_programado->EditValue = ew_FormatNumber($this->porcent_programado->EditValue, -2, -1, -2, 0);

		// porcent_real
		$this->porcent_real->EditAttrs["class"] = "form-control";
		$this->porcent_real->EditCustomAttributes = "";
		$this->porcent_real->EditValue = $this->porcent_real->CurrentValue;
		$this->porcent_real->PlaceHolder = ew_RemoveHtml($this->porcent_real->FldCaption());
		if (strval($this->porcent_real->EditValue) <> "" && is_numeric($this->porcent_real->EditValue)) $this->porcent_real->EditValue = ew_FormatNumber($this->porcent_real->EditValue, -2, -1, -2, 0);

		// finan_programado
		$this->finan_programado->EditAttrs["class"] = "form-control";
		$this->finan_programado->EditCustomAttributes = "";
		$this->finan_programado->EditValue = $this->finan_programado->CurrentValue;
		$this->finan_programado->PlaceHolder = ew_RemoveHtml($this->finan_programado->FldCaption());
		if (strval($this->finan_programado->EditValue) <> "" && is_numeric($this->finan_programado->EditValue)) $this->finan_programado->EditValue = ew_FormatNumber($this->finan_programado->EditValue, -2, -1, -2, 0);

		// finan_real
		$this->finan_real->EditAttrs["class"] = "form-control";
		$this->finan_real->EditCustomAttributes = "";
		$this->finan_real->EditValue = $this->finan_real->CurrentValue;
		$this->finan_real->PlaceHolder = ew_RemoveHtml($this->finan_real->FldCaption());
		if (strval($this->finan_real->EditValue) <> "" && is_numeric($this->finan_real->EditValue)) $this->finan_real->EditValue = ew_FormatNumber($this->finan_real->EditValue, -2, -1, -2, 0);

		// fecha_registro
		$this->fecha_registro->EditAttrs["class"] = "form-control";
		$this->fecha_registro->EditCustomAttributes = "";
		$this->fecha_registro->EditValue = ew_FormatDateTime($this->fecha_registro->CurrentValue, 5);
		$this->fecha_registro->PlaceHolder = ew_RemoveHtml($this->fecha_registro->FldCaption());

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		$this->estado->EditValue = $this->estado->CurrentValue;
		$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

		// user_registro
		$this->user_registro->EditAttrs["class"] = "form-control";
		$this->user_registro->EditCustomAttributes = "";
		$this->user_registro->EditValue = $this->user_registro->CurrentValue;
		$this->user_registro->PlaceHolder = ew_RemoveHtml($this->user_registro->FldCaption());

		// desc_problemas
		$this->desc_problemas->EditAttrs["class"] = "form-control";
		$this->desc_problemas->EditCustomAttributes = "";
		$this->desc_problemas->EditValue = $this->desc_problemas->CurrentValue;
		$this->desc_problemas->PlaceHolder = ew_RemoveHtml($this->desc_problemas->FldCaption());

		// desc_temas
		$this->desc_temas->EditAttrs["class"] = "form-control";
		$this->desc_temas->EditCustomAttributes = "";
		$this->desc_temas->EditValue = $this->desc_temas->CurrentValue;
		$this->desc_temas->PlaceHolder = ew_RemoveHtml($this->desc_temas->FldCaption());

		// idEjecucion
		$this->idEjecucion->EditAttrs["class"] = "form-control";
		$this->idEjecucion->EditCustomAttributes = "";
		$this->idEjecucion->EditValue = $this->idEjecucion->CurrentValue;
		$this->idEjecucion->PlaceHolder = ew_RemoveHtml($this->idEjecucion->FldCaption());

		// fecha_avance
		$this->fecha_avance->EditAttrs["class"] = "form-control";
		$this->fecha_avance->EditCustomAttributes = "";
		$this->fecha_avance->EditValue = ew_FormatDateTime($this->fecha_avance->CurrentValue, 5);
		$this->fecha_avance->PlaceHolder = ew_RemoveHtml($this->fecha_avance->FldCaption());

		// idContratacion
		$this->idContratacion->EditAttrs["class"] = "form-control";
		$this->idContratacion->EditCustomAttributes = "";
		$this->idContratacion->EditValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());

		// estado_sol
		$this->estado_sol->EditAttrs["class"] = "form-control";
		$this->estado_sol->EditCustomAttributes = "";
		$this->estado_sol->EditValue = $this->estado_sol->CurrentValue;
		$this->estado_sol->PlaceHolder = ew_RemoveHtml($this->estado_sol->FldCaption());

		// adj_garantias
		$this->adj_garantias->EditAttrs["class"] = "form-control";
		$this->adj_garantias->EditCustomAttributes = "";
		$this->adj_garantias->EditValue = $this->adj_garantias->CurrentValue;
		$this->adj_garantias->PlaceHolder = ew_RemoveHtml($this->adj_garantias->FldCaption());

		// adj_avances
		$this->adj_avances->EditAttrs["class"] = "form-control";
		$this->adj_avances->EditCustomAttributes = "";
		$this->adj_avances->EditValue = $this->adj_avances->CurrentValue;
		$this->adj_avances->PlaceHolder = ew_RemoveHtml($this->adj_avances->FldCaption());

		// adj_supervicion
		$this->adj_supervicion->EditAttrs["class"] = "form-control";
		$this->adj_supervicion->EditCustomAttributes = "";
		$this->adj_supervicion->EditValue = $this->adj_supervicion->CurrentValue;
		$this->adj_supervicion->PlaceHolder = ew_RemoveHtml($this->adj_supervicion->FldCaption());

		// adj_evaluacion
		$this->adj_evaluacion->EditAttrs["class"] = "form-control";
		$this->adj_evaluacion->EditCustomAttributes = "";
		$this->adj_evaluacion->EditValue = $this->adj_evaluacion->CurrentValue;
		$this->adj_evaluacion->PlaceHolder = ew_RemoveHtml($this->adj_evaluacion->FldCaption());

		// adj_tecnica
		$this->adj_tecnica->EditAttrs["class"] = "form-control";
		$this->adj_tecnica->EditCustomAttributes = "";
		$this->adj_tecnica->EditValue = $this->adj_tecnica->CurrentValue;
		$this->adj_tecnica->PlaceHolder = ew_RemoveHtml($this->adj_tecnica->FldCaption());

		// adj_financiero
		$this->adj_financiero->EditAttrs["class"] = "form-control";
		$this->adj_financiero->EditCustomAttributes = "";
		$this->adj_financiero->EditValue = $this->adj_financiero->CurrentValue;
		$this->adj_financiero->PlaceHolder = ew_RemoveHtml($this->adj_financiero->FldCaption());

		// adj_recepcion
		$this->adj_recepcion->EditAttrs["class"] = "form-control";
		$this->adj_recepcion->EditCustomAttributes = "";
		$this->adj_recepcion->EditValue = $this->adj_recepcion->CurrentValue;
		$this->adj_recepcion->PlaceHolder = ew_RemoveHtml($this->adj_recepcion->FldCaption());

		// adj_disconformidad
		$this->adj_disconformidad->EditAttrs["class"] = "form-control";
		$this->adj_disconformidad->EditCustomAttributes = "";
		$this->adj_disconformidad->EditValue = $this->adj_disconformidad->CurrentValue;
		$this->adj_disconformidad->PlaceHolder = ew_RemoveHtml($this->adj_disconformidad->FldCaption());

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
					if ($this->codigo->Exportable) $Doc->ExportCaption($this->codigo);
					if ($this->codigo_inicio_ejecucion->Exportable) $Doc->ExportCaption($this->codigo_inicio_ejecucion);
					if ($this->porcent_programado->Exportable) $Doc->ExportCaption($this->porcent_programado);
					if ($this->porcent_real->Exportable) $Doc->ExportCaption($this->porcent_real);
					if ($this->finan_programado->Exportable) $Doc->ExportCaption($this->finan_programado);
					if ($this->finan_real->Exportable) $Doc->ExportCaption($this->finan_real);
					if ($this->fecha_registro->Exportable) $Doc->ExportCaption($this->fecha_registro);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->user_registro->Exportable) $Doc->ExportCaption($this->user_registro);
					if ($this->desc_problemas->Exportable) $Doc->ExportCaption($this->desc_problemas);
					if ($this->desc_temas->Exportable) $Doc->ExportCaption($this->desc_temas);
					if ($this->idEjecucion->Exportable) $Doc->ExportCaption($this->idEjecucion);
					if ($this->fecha_avance->Exportable) $Doc->ExportCaption($this->fecha_avance);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->estado_sol->Exportable) $Doc->ExportCaption($this->estado_sol);
					if ($this->adj_garantias->Exportable) $Doc->ExportCaption($this->adj_garantias);
					if ($this->adj_avances->Exportable) $Doc->ExportCaption($this->adj_avances);
					if ($this->adj_supervicion->Exportable) $Doc->ExportCaption($this->adj_supervicion);
					if ($this->adj_evaluacion->Exportable) $Doc->ExportCaption($this->adj_evaluacion);
					if ($this->adj_tecnica->Exportable) $Doc->ExportCaption($this->adj_tecnica);
					if ($this->adj_financiero->Exportable) $Doc->ExportCaption($this->adj_financiero);
					if ($this->adj_recepcion->Exportable) $Doc->ExportCaption($this->adj_recepcion);
					if ($this->adj_disconformidad->Exportable) $Doc->ExportCaption($this->adj_disconformidad);
				} else {
					if ($this->codigo->Exportable) $Doc->ExportCaption($this->codigo);
					if ($this->codigo_inicio_ejecucion->Exportable) $Doc->ExportCaption($this->codigo_inicio_ejecucion);
					if ($this->porcent_programado->Exportable) $Doc->ExportCaption($this->porcent_programado);
					if ($this->porcent_real->Exportable) $Doc->ExportCaption($this->porcent_real);
					if ($this->finan_programado->Exportable) $Doc->ExportCaption($this->finan_programado);
					if ($this->finan_real->Exportable) $Doc->ExportCaption($this->finan_real);
					if ($this->fecha_registro->Exportable) $Doc->ExportCaption($this->fecha_registro);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->user_registro->Exportable) $Doc->ExportCaption($this->user_registro);
					if ($this->desc_problemas->Exportable) $Doc->ExportCaption($this->desc_problemas);
					if ($this->desc_temas->Exportable) $Doc->ExportCaption($this->desc_temas);
					if ($this->idEjecucion->Exportable) $Doc->ExportCaption($this->idEjecucion);
					if ($this->fecha_avance->Exportable) $Doc->ExportCaption($this->fecha_avance);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->estado_sol->Exportable) $Doc->ExportCaption($this->estado_sol);
					if ($this->adj_garantias->Exportable) $Doc->ExportCaption($this->adj_garantias);
					if ($this->adj_avances->Exportable) $Doc->ExportCaption($this->adj_avances);
					if ($this->adj_supervicion->Exportable) $Doc->ExportCaption($this->adj_supervicion);
					if ($this->adj_evaluacion->Exportable) $Doc->ExportCaption($this->adj_evaluacion);
					if ($this->adj_tecnica->Exportable) $Doc->ExportCaption($this->adj_tecnica);
					if ($this->adj_financiero->Exportable) $Doc->ExportCaption($this->adj_financiero);
					if ($this->adj_recepcion->Exportable) $Doc->ExportCaption($this->adj_recepcion);
					if ($this->adj_disconformidad->Exportable) $Doc->ExportCaption($this->adj_disconformidad);
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
						if ($this->codigo->Exportable) $Doc->ExportField($this->codigo);
						if ($this->codigo_inicio_ejecucion->Exportable) $Doc->ExportField($this->codigo_inicio_ejecucion);
						if ($this->porcent_programado->Exportable) $Doc->ExportField($this->porcent_programado);
						if ($this->porcent_real->Exportable) $Doc->ExportField($this->porcent_real);
						if ($this->finan_programado->Exportable) $Doc->ExportField($this->finan_programado);
						if ($this->finan_real->Exportable) $Doc->ExportField($this->finan_real);
						if ($this->fecha_registro->Exportable) $Doc->ExportField($this->fecha_registro);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->user_registro->Exportable) $Doc->ExportField($this->user_registro);
						if ($this->desc_problemas->Exportable) $Doc->ExportField($this->desc_problemas);
						if ($this->desc_temas->Exportable) $Doc->ExportField($this->desc_temas);
						if ($this->idEjecucion->Exportable) $Doc->ExportField($this->idEjecucion);
						if ($this->fecha_avance->Exportable) $Doc->ExportField($this->fecha_avance);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->estado_sol->Exportable) $Doc->ExportField($this->estado_sol);
						if ($this->adj_garantias->Exportable) $Doc->ExportField($this->adj_garantias);
						if ($this->adj_avances->Exportable) $Doc->ExportField($this->adj_avances);
						if ($this->adj_supervicion->Exportable) $Doc->ExportField($this->adj_supervicion);
						if ($this->adj_evaluacion->Exportable) $Doc->ExportField($this->adj_evaluacion);
						if ($this->adj_tecnica->Exportable) $Doc->ExportField($this->adj_tecnica);
						if ($this->adj_financiero->Exportable) $Doc->ExportField($this->adj_financiero);
						if ($this->adj_recepcion->Exportable) $Doc->ExportField($this->adj_recepcion);
						if ($this->adj_disconformidad->Exportable) $Doc->ExportField($this->adj_disconformidad);
					} else {
						if ($this->codigo->Exportable) $Doc->ExportField($this->codigo);
						if ($this->codigo_inicio_ejecucion->Exportable) $Doc->ExportField($this->codigo_inicio_ejecucion);
						if ($this->porcent_programado->Exportable) $Doc->ExportField($this->porcent_programado);
						if ($this->porcent_real->Exportable) $Doc->ExportField($this->porcent_real);
						if ($this->finan_programado->Exportable) $Doc->ExportField($this->finan_programado);
						if ($this->finan_real->Exportable) $Doc->ExportField($this->finan_real);
						if ($this->fecha_registro->Exportable) $Doc->ExportField($this->fecha_registro);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->user_registro->Exportable) $Doc->ExportField($this->user_registro);
						if ($this->desc_problemas->Exportable) $Doc->ExportField($this->desc_problemas);
						if ($this->desc_temas->Exportable) $Doc->ExportField($this->desc_temas);
						if ($this->idEjecucion->Exportable) $Doc->ExportField($this->idEjecucion);
						if ($this->fecha_avance->Exportable) $Doc->ExportField($this->fecha_avance);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->estado_sol->Exportable) $Doc->ExportField($this->estado_sol);
						if ($this->adj_garantias->Exportable) $Doc->ExportField($this->adj_garantias);
						if ($this->adj_avances->Exportable) $Doc->ExportField($this->adj_avances);
						if ($this->adj_supervicion->Exportable) $Doc->ExportField($this->adj_supervicion);
						if ($this->adj_evaluacion->Exportable) $Doc->ExportField($this->adj_evaluacion);
						if ($this->adj_tecnica->Exportable) $Doc->ExportField($this->adj_tecnica);
						if ($this->adj_financiero->Exportable) $Doc->ExportField($this->adj_financiero);
						if ($this->adj_recepcion->Exportable) $Doc->ExportField($this->adj_recepcion);
						if ($this->adj_disconformidad->Exportable) $Doc->ExportField($this->adj_disconformidad);
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
