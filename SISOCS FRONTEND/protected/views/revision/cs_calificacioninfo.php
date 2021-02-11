<?php

// Global variable for table object
$cs_calificacion = NULL;

//
// Table class for cs_calificacion
//
class ccs_calificacion extends cTable {
	var $idCalificacion;
	var $idProyecto;
	var $numproceso;
	var $nomprocesoproyecto;
	var $fechactualizacion;
	var $idFuncionario;
	var $estatusproceso;
	var $proceseval;
	var $invitainter;
	var $basespreca;
	var $resolucion;
	var $nombreante;
	var $convocainvi;
	var $tdr;
	var $aclaraciones;
	var $actarecpcion;
	var $fechaingreso;
	var $tipocontrato;
	var $estado;
	var $otro1;
	var $otro2;
	var $identidadadquisicion;
	var $idmetodo;
	var $fecharecibido;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_calificacion';
		$this->TableName = 'cs_calificacion';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_calificacion`";
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

		// idCalificacion
		$this->idCalificacion = new cField('cs_calificacion', 'cs_calificacion', 'x_idCalificacion', 'idCalificacion', '`idCalificacion`', '`idCalificacion`', 3, -1, FALSE, '`idCalificacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idCalificacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idCalificacion'] = &$this->idCalificacion;

		// idProyecto
		$this->idProyecto = new cField('cs_calificacion', 'cs_calificacion', 'x_idProyecto', 'idProyecto', '`idProyecto`', '`idProyecto`', 3, -1, FALSE, '`idProyecto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idProyecto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idProyecto'] = &$this->idProyecto;

		// numproceso
		$this->numproceso = new cField('cs_calificacion', 'cs_calificacion', 'x_numproceso', 'numproceso', '`numproceso`', '`numproceso`', 200, -1, FALSE, '`numproceso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['numproceso'] = &$this->numproceso;

		// nomprocesoproyecto
		$this->nomprocesoproyecto = new cField('cs_calificacion', 'cs_calificacion', 'x_nomprocesoproyecto', 'nomprocesoproyecto', '`nomprocesoproyecto`', '`nomprocesoproyecto`', 201, -1, FALSE, '`nomprocesoproyecto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['nomprocesoproyecto'] = &$this->nomprocesoproyecto;

		// fechactualizacion
		$this->fechactualizacion = new cField('cs_calificacion', 'cs_calificacion', 'x_fechactualizacion', 'fechactualizacion', '`fechactualizacion`', '`fechactualizacion`', 200, -1, FALSE, '`fechactualizacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechactualizacion'] = &$this->fechactualizacion;

		// idFuncionario
		$this->idFuncionario = new cField('cs_calificacion', 'cs_calificacion', 'x_idFuncionario', 'idFuncionario', '`idFuncionario`', '`idFuncionario`', 3, -1, FALSE, '`idFuncionario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idFuncionario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idFuncionario'] = &$this->idFuncionario;

		// estatusproceso
		$this->estatusproceso = new cField('cs_calificacion', 'cs_calificacion', 'x_estatusproceso', 'estatusproceso', '`estatusproceso`', '`estatusproceso`', 200, -1, FALSE, '`estatusproceso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estatusproceso'] = &$this->estatusproceso;

		// proceseval
		$this->proceseval = new cField('cs_calificacion', 'cs_calificacion', 'x_proceseval', 'proceseval', '`proceseval`', '`proceseval`', 200, -1, FALSE, '`proceseval`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['proceseval'] = &$this->proceseval;

		// invitainter
		$this->invitainter = new cField('cs_calificacion', 'cs_calificacion', 'x_invitainter', 'invitainter', '`invitainter`', '`invitainter`', 200, -1, FALSE, '`invitainter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['invitainter'] = &$this->invitainter;

		// basespreca
		$this->basespreca = new cField('cs_calificacion', 'cs_calificacion', 'x_basespreca', 'basespreca', '`basespreca`', '`basespreca`', 200, -1, FALSE, '`basespreca`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['basespreca'] = &$this->basespreca;

		// resolucion
		$this->resolucion = new cField('cs_calificacion', 'cs_calificacion', 'x_resolucion', 'resolucion', '`resolucion`', '`resolucion`', 200, -1, FALSE, '`resolucion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['resolucion'] = &$this->resolucion;

		// nombreante
		$this->nombreante = new cField('cs_calificacion', 'cs_calificacion', 'x_nombreante', 'nombreante', '`nombreante`', '`nombreante`', 200, -1, FALSE, '`nombreante`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['nombreante'] = &$this->nombreante;

		// convocainvi
		$this->convocainvi = new cField('cs_calificacion', 'cs_calificacion', 'x_convocainvi', 'convocainvi', '`convocainvi`', '`convocainvi`', 200, -1, FALSE, '`convocainvi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['convocainvi'] = &$this->convocainvi;

		// tdr
		$this->tdr = new cField('cs_calificacion', 'cs_calificacion', 'x_tdr', 'tdr', '`tdr`', '`tdr`', 200, -1, FALSE, '`tdr`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['tdr'] = &$this->tdr;

		// aclaraciones
		$this->aclaraciones = new cField('cs_calificacion', 'cs_calificacion', 'x_aclaraciones', 'aclaraciones', '`aclaraciones`', '`aclaraciones`', 200, -1, FALSE, '`aclaraciones`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['aclaraciones'] = &$this->aclaraciones;

		// actarecpcion
		$this->actarecpcion = new cField('cs_calificacion', 'cs_calificacion', 'x_actarecpcion', 'actarecpcion', '`actarecpcion`', '`actarecpcion`', 200, -1, FALSE, '`actarecpcion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['actarecpcion'] = &$this->actarecpcion;

		// fechaingreso
		$this->fechaingreso = new cField('cs_calificacion', 'cs_calificacion', 'x_fechaingreso', 'fechaingreso', '`fechaingreso`', '`fechaingreso`', 200, -1, FALSE, '`fechaingreso`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechaingreso'] = &$this->fechaingreso;

		// tipocontrato
		$this->tipocontrato = new cField('cs_calificacion', 'cs_calificacion', 'x_tipocontrato', 'tipocontrato', '`tipocontrato`', '`tipocontrato`', 200, -1, FALSE, '`tipocontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['tipocontrato'] = &$this->tipocontrato;

		// estado
		$this->estado = new cField('cs_calificacion', 'cs_calificacion', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// otro1
		$this->otro1 = new cField('cs_calificacion', 'cs_calificacion', 'x_otro1', 'otro1', '`otro1`', '`otro1`', 200, -1, FALSE, '`otro1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro1'] = &$this->otro1;

		// otro2
		$this->otro2 = new cField('cs_calificacion', 'cs_calificacion', 'x_otro2', 'otro2', '`otro2`', '`otro2`', 200, -1, FALSE, '`otro2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro2'] = &$this->otro2;

		// identidadadquisicion
		$this->identidadadquisicion = new cField('cs_calificacion', 'cs_calificacion', 'x_identidadadquisicion', 'identidadadquisicion', '`identidadadquisicion`', '`identidadadquisicion`', 3, -1, FALSE, '`identidadadquisicion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->identidadadquisicion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['identidadadquisicion'] = &$this->identidadadquisicion;

		// idmetodo
		$this->idmetodo = new cField('cs_calificacion', 'cs_calificacion', 'x_idmetodo', 'idmetodo', '`idmetodo`', '`idmetodo`', 3, -1, FALSE, '`idmetodo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idmetodo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idmetodo'] = &$this->idmetodo;

		// fecharecibido
		$this->fecharecibido = new cField('cs_calificacion', 'cs_calificacion', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', '`fecharecibido`', 200, -1, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecharecibido'] = &$this->fecharecibido;
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
		if ($this->getCurrentMasterTable() == "cs_proyecto") {
			if ($this->idProyecto->getSessionValue() <> "")
				$sMasterFilter .= "`idProyecto`=" . ew_QuotedValue($this->idProyecto->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cs_proyecto") {
			if ($this->idProyecto->getSessionValue() <> "")
				$sDetailFilter .= "`idProyecto`=" . ew_QuotedValue($this->idProyecto->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cs_proyecto() {
		return "`idProyecto`=@idProyecto@";
	}

	// Detail filter
	function SqlDetailFilter_cs_proyecto() {
		return "`idProyecto`=@idProyecto@";
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
		if ($this->getCurrentDetailTable() == "cs_adjudicacion") {
			$sDetailUrl = $GLOBALS["cs_adjudicacion"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_idCalificacion=" . urlencode($this->idCalificacion->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "cs_calificacionlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_calificacion`";
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
			if (array_key_exists('idCalificacion', $rs))
				ew_AddFilter($where, ew_QuotedName('idCalificacion', $this->DBID) . '=' . ew_QuotedValue($rs['idCalificacion'], $this->idCalificacion->FldDataType, $this->DBID));
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
		return "`idCalificacion` = @idCalificacion@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idCalificacion->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idCalificacion@", ew_AdjustSql($this->idCalificacion->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_calificacionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_calificacionlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_calificacionview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_calificacionview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_calificacionadd.php?" . $this->UrlParm($parm);
		else
			return "cs_calificacionadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_calificacionedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_calificacionedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_calificacionadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_calificacionadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_calificaciondelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "idCalificacion:" . ew_VarToJson($this->idCalificacion->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idCalificacion->CurrentValue)) {
			$sUrl .= "idCalificacion=" . urlencode($this->idCalificacion->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["idCalificacion"]) : ew_StripSlashes(@$_GET["idCalificacion"]); // idCalificacion

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
			$this->idCalificacion->CurrentValue = $key;
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
		$this->idCalificacion->setDbValue($rs->fields('idCalificacion'));
		$this->idProyecto->setDbValue($rs->fields('idProyecto'));
		$this->numproceso->setDbValue($rs->fields('numproceso'));
		$this->nomprocesoproyecto->setDbValue($rs->fields('nomprocesoproyecto'));
		$this->fechactualizacion->setDbValue($rs->fields('fechactualizacion'));
		$this->idFuncionario->setDbValue($rs->fields('idFuncionario'));
		$this->estatusproceso->setDbValue($rs->fields('estatusproceso'));
		$this->proceseval->setDbValue($rs->fields('proceseval'));
		$this->invitainter->setDbValue($rs->fields('invitainter'));
		$this->basespreca->setDbValue($rs->fields('basespreca'));
		$this->resolucion->setDbValue($rs->fields('resolucion'));
		$this->nombreante->setDbValue($rs->fields('nombreante'));
		$this->convocainvi->setDbValue($rs->fields('convocainvi'));
		$this->tdr->setDbValue($rs->fields('tdr'));
		$this->aclaraciones->setDbValue($rs->fields('aclaraciones'));
		$this->actarecpcion->setDbValue($rs->fields('actarecpcion'));
		$this->fechaingreso->setDbValue($rs->fields('fechaingreso'));
		$this->tipocontrato->setDbValue($rs->fields('tipocontrato'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro1->setDbValue($rs->fields('otro1'));
		$this->otro2->setDbValue($rs->fields('otro2'));
		$this->identidadadquisicion->setDbValue($rs->fields('identidadadquisicion'));
		$this->idmetodo->setDbValue($rs->fields('idmetodo'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idCalificacion
		// idProyecto
		// numproceso
		// nomprocesoproyecto
		// fechactualizacion
		// idFuncionario
		// estatusproceso
		// proceseval
		// invitainter
		// basespreca
		// resolucion
		// nombreante
		// convocainvi
		// tdr
		// aclaraciones
		// actarecpcion
		// fechaingreso
		// tipocontrato
		// estado
		// otro1
		// otro2
		// identidadadquisicion
		// idmetodo
		// fecharecibido
		// idCalificacion

		$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";

		// idProyecto
		$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";

		// numproceso
		$this->numproceso->ViewValue = $this->numproceso->CurrentValue;
		$this->numproceso->ViewCustomAttributes = "";

		// nomprocesoproyecto
		$this->nomprocesoproyecto->ViewValue = $this->nomprocesoproyecto->CurrentValue;
		$this->nomprocesoproyecto->ViewCustomAttributes = "";

		// fechactualizacion
		$this->fechactualizacion->ViewValue = $this->fechactualizacion->CurrentValue;
		$this->fechactualizacion->ViewCustomAttributes = "";

		// idFuncionario
		$this->idFuncionario->ViewValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->ViewCustomAttributes = "";

		// estatusproceso
		$this->estatusproceso->ViewValue = $this->estatusproceso->CurrentValue;
		$this->estatusproceso->ViewCustomAttributes = "";

		// proceseval
		$this->proceseval->ViewValue = $this->proceseval->CurrentValue;
		$this->proceseval->ViewCustomAttributes = "";

		// invitainter
		$this->invitainter->ViewValue = $this->invitainter->CurrentValue;
		$this->invitainter->ViewCustomAttributes = "";

		// basespreca
		$this->basespreca->ViewValue = $this->basespreca->CurrentValue;
		$this->basespreca->ViewCustomAttributes = "";

		// resolucion
		$this->resolucion->ViewValue = $this->resolucion->CurrentValue;
		$this->resolucion->ViewCustomAttributes = "";

		// nombreante
		$this->nombreante->ViewValue = $this->nombreante->CurrentValue;
		$this->nombreante->ViewCustomAttributes = "";

		// convocainvi
		$this->convocainvi->ViewValue = $this->convocainvi->CurrentValue;
		$this->convocainvi->ViewCustomAttributes = "";

		// tdr
		$this->tdr->ViewValue = $this->tdr->CurrentValue;
		$this->tdr->ViewCustomAttributes = "";

		// aclaraciones
		$this->aclaraciones->ViewValue = $this->aclaraciones->CurrentValue;
		$this->aclaraciones->ViewCustomAttributes = "";

		// actarecpcion
		$this->actarecpcion->ViewValue = $this->actarecpcion->CurrentValue;
		$this->actarecpcion->ViewCustomAttributes = "";

		// fechaingreso
		$this->fechaingreso->ViewValue = $this->fechaingreso->CurrentValue;
		$this->fechaingreso->ViewCustomAttributes = "";

		// tipocontrato
		$this->tipocontrato->ViewValue = $this->tipocontrato->CurrentValue;
		$this->tipocontrato->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro1
		$this->otro1->ViewValue = $this->otro1->CurrentValue;
		$this->otro1->ViewCustomAttributes = "";

		// otro2
		$this->otro2->ViewValue = $this->otro2->CurrentValue;
		$this->otro2->ViewCustomAttributes = "";

		// identidadadquisicion
		$this->identidadadquisicion->ViewValue = $this->identidadadquisicion->CurrentValue;
		$this->identidadadquisicion->ViewCustomAttributes = "";

		// idmetodo
		$this->idmetodo->ViewValue = $this->idmetodo->CurrentValue;
		$this->idmetodo->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// idCalificacion
		$this->idCalificacion->LinkCustomAttributes = "";
		$this->idCalificacion->HrefValue = "";
		$this->idCalificacion->TooltipValue = "";

		// idProyecto
		$this->idProyecto->LinkCustomAttributes = "";
		$this->idProyecto->HrefValue = "";
		$this->idProyecto->TooltipValue = "";

		// numproceso
		$this->numproceso->LinkCustomAttributes = "";
		$this->numproceso->HrefValue = "";
		$this->numproceso->TooltipValue = "";

		// nomprocesoproyecto
		$this->nomprocesoproyecto->LinkCustomAttributes = "";
		$this->nomprocesoproyecto->HrefValue = "";
		$this->nomprocesoproyecto->TooltipValue = "";

		// fechactualizacion
		$this->fechactualizacion->LinkCustomAttributes = "";
		$this->fechactualizacion->HrefValue = "";
		$this->fechactualizacion->TooltipValue = "";

		// idFuncionario
		$this->idFuncionario->LinkCustomAttributes = "";
		$this->idFuncionario->HrefValue = "";
		$this->idFuncionario->TooltipValue = "";

		// estatusproceso
		$this->estatusproceso->LinkCustomAttributes = "";
		$this->estatusproceso->HrefValue = "";
		$this->estatusproceso->TooltipValue = "";

		// proceseval
		$this->proceseval->LinkCustomAttributes = "";
		$this->proceseval->HrefValue = "";
		$this->proceseval->TooltipValue = "";

		// invitainter
		$this->invitainter->LinkCustomAttributes = "";
		$this->invitainter->HrefValue = "";
		$this->invitainter->TooltipValue = "";

		// basespreca
		$this->basespreca->LinkCustomAttributes = "";
		$this->basespreca->HrefValue = "";
		$this->basespreca->TooltipValue = "";

		// resolucion
		$this->resolucion->LinkCustomAttributes = "";
		$this->resolucion->HrefValue = "";
		$this->resolucion->TooltipValue = "";

		// nombreante
		$this->nombreante->LinkCustomAttributes = "";
		$this->nombreante->HrefValue = "";
		$this->nombreante->TooltipValue = "";

		// convocainvi
		$this->convocainvi->LinkCustomAttributes = "";
		$this->convocainvi->HrefValue = "";
		$this->convocainvi->TooltipValue = "";

		// tdr
		$this->tdr->LinkCustomAttributes = "";
		$this->tdr->HrefValue = "";
		$this->tdr->TooltipValue = "";

		// aclaraciones
		$this->aclaraciones->LinkCustomAttributes = "";
		$this->aclaraciones->HrefValue = "";
		$this->aclaraciones->TooltipValue = "";

		// actarecpcion
		$this->actarecpcion->LinkCustomAttributes = "";
		$this->actarecpcion->HrefValue = "";
		$this->actarecpcion->TooltipValue = "";

		// fechaingreso
		$this->fechaingreso->LinkCustomAttributes = "";
		$this->fechaingreso->HrefValue = "";
		$this->fechaingreso->TooltipValue = "";

		// tipocontrato
		$this->tipocontrato->LinkCustomAttributes = "";
		$this->tipocontrato->HrefValue = "";
		$this->tipocontrato->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// otro1
		$this->otro1->LinkCustomAttributes = "";
		$this->otro1->HrefValue = "";
		$this->otro1->TooltipValue = "";

		// otro2
		$this->otro2->LinkCustomAttributes = "";
		$this->otro2->HrefValue = "";
		$this->otro2->TooltipValue = "";

		// identidadadquisicion
		$this->identidadadquisicion->LinkCustomAttributes = "";
		$this->identidadadquisicion->HrefValue = "";
		$this->identidadadquisicion->TooltipValue = "";

		// idmetodo
		$this->idmetodo->LinkCustomAttributes = "";
		$this->idmetodo->HrefValue = "";
		$this->idmetodo->TooltipValue = "";

		// fecharecibido
		$this->fecharecibido->LinkCustomAttributes = "";
		$this->fecharecibido->HrefValue = "";
		$this->fecharecibido->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// idCalificacion
		$this->idCalificacion->EditAttrs["class"] = "form-control";
		$this->idCalificacion->EditCustomAttributes = "";
		$this->idCalificacion->EditValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";

		// idProyecto
		$this->idProyecto->EditAttrs["class"] = "form-control";
		$this->idProyecto->EditCustomAttributes = "";
		if ($this->idProyecto->getSessionValue() <> "") {
			$this->idProyecto->CurrentValue = $this->idProyecto->getSessionValue();
		$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";
		} else {
		$this->idProyecto->EditValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->PlaceHolder = ew_RemoveHtml($this->idProyecto->FldCaption());
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

		// fechactualizacion
		$this->fechactualizacion->EditAttrs["class"] = "form-control";
		$this->fechactualizacion->EditCustomAttributes = "";
		$this->fechactualizacion->EditValue = $this->fechactualizacion->CurrentValue;
		$this->fechactualizacion->PlaceHolder = ew_RemoveHtml($this->fechactualizacion->FldCaption());

		// idFuncionario
		$this->idFuncionario->EditAttrs["class"] = "form-control";
		$this->idFuncionario->EditCustomAttributes = "";
		$this->idFuncionario->EditValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

		// estatusproceso
		$this->estatusproceso->EditAttrs["class"] = "form-control";
		$this->estatusproceso->EditCustomAttributes = "";
		$this->estatusproceso->EditValue = $this->estatusproceso->CurrentValue;
		$this->estatusproceso->PlaceHolder = ew_RemoveHtml($this->estatusproceso->FldCaption());

		// proceseval
		$this->proceseval->EditAttrs["class"] = "form-control";
		$this->proceseval->EditCustomAttributes = "";
		$this->proceseval->EditValue = $this->proceseval->CurrentValue;
		$this->proceseval->PlaceHolder = ew_RemoveHtml($this->proceseval->FldCaption());

		// invitainter
		$this->invitainter->EditAttrs["class"] = "form-control";
		$this->invitainter->EditCustomAttributes = "";
		$this->invitainter->EditValue = $this->invitainter->CurrentValue;
		$this->invitainter->PlaceHolder = ew_RemoveHtml($this->invitainter->FldCaption());

		// basespreca
		$this->basespreca->EditAttrs["class"] = "form-control";
		$this->basespreca->EditCustomAttributes = "";
		$this->basespreca->EditValue = $this->basespreca->CurrentValue;
		$this->basespreca->PlaceHolder = ew_RemoveHtml($this->basespreca->FldCaption());

		// resolucion
		$this->resolucion->EditAttrs["class"] = "form-control";
		$this->resolucion->EditCustomAttributes = "";
		$this->resolucion->EditValue = $this->resolucion->CurrentValue;
		$this->resolucion->PlaceHolder = ew_RemoveHtml($this->resolucion->FldCaption());

		// nombreante
		$this->nombreante->EditAttrs["class"] = "form-control";
		$this->nombreante->EditCustomAttributes = "";
		$this->nombreante->EditValue = $this->nombreante->CurrentValue;
		$this->nombreante->PlaceHolder = ew_RemoveHtml($this->nombreante->FldCaption());

		// convocainvi
		$this->convocainvi->EditAttrs["class"] = "form-control";
		$this->convocainvi->EditCustomAttributes = "";
		$this->convocainvi->EditValue = $this->convocainvi->CurrentValue;
		$this->convocainvi->PlaceHolder = ew_RemoveHtml($this->convocainvi->FldCaption());

		// tdr
		$this->tdr->EditAttrs["class"] = "form-control";
		$this->tdr->EditCustomAttributes = "";
		$this->tdr->EditValue = $this->tdr->CurrentValue;
		$this->tdr->PlaceHolder = ew_RemoveHtml($this->tdr->FldCaption());

		// aclaraciones
		$this->aclaraciones->EditAttrs["class"] = "form-control";
		$this->aclaraciones->EditCustomAttributes = "";
		$this->aclaraciones->EditValue = $this->aclaraciones->CurrentValue;
		$this->aclaraciones->PlaceHolder = ew_RemoveHtml($this->aclaraciones->FldCaption());

		// actarecpcion
		$this->actarecpcion->EditAttrs["class"] = "form-control";
		$this->actarecpcion->EditCustomAttributes = "";
		$this->actarecpcion->EditValue = $this->actarecpcion->CurrentValue;
		$this->actarecpcion->PlaceHolder = ew_RemoveHtml($this->actarecpcion->FldCaption());

		// fechaingreso
		$this->fechaingreso->EditAttrs["class"] = "form-control";
		$this->fechaingreso->EditCustomAttributes = "";
		$this->fechaingreso->EditValue = $this->fechaingreso->CurrentValue;
		$this->fechaingreso->PlaceHolder = ew_RemoveHtml($this->fechaingreso->FldCaption());

		// tipocontrato
		$this->tipocontrato->EditAttrs["class"] = "form-control";
		$this->tipocontrato->EditCustomAttributes = "";
		$this->tipocontrato->EditValue = $this->tipocontrato->CurrentValue;
		$this->tipocontrato->PlaceHolder = ew_RemoveHtml($this->tipocontrato->FldCaption());

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		$this->estado->EditValue = $this->estado->CurrentValue;
		$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

		// otro1
		$this->otro1->EditAttrs["class"] = "form-control";
		$this->otro1->EditCustomAttributes = "";
		$this->otro1->EditValue = $this->otro1->CurrentValue;
		$this->otro1->PlaceHolder = ew_RemoveHtml($this->otro1->FldCaption());

		// otro2
		$this->otro2->EditAttrs["class"] = "form-control";
		$this->otro2->EditCustomAttributes = "";
		$this->otro2->EditValue = $this->otro2->CurrentValue;
		$this->otro2->PlaceHolder = ew_RemoveHtml($this->otro2->FldCaption());

		// identidadadquisicion
		$this->identidadadquisicion->EditAttrs["class"] = "form-control";
		$this->identidadadquisicion->EditCustomAttributes = "";
		$this->identidadadquisicion->EditValue = $this->identidadadquisicion->CurrentValue;
		$this->identidadadquisicion->PlaceHolder = ew_RemoveHtml($this->identidadadquisicion->FldCaption());

		// idmetodo
		$this->idmetodo->EditAttrs["class"] = "form-control";
		$this->idmetodo->EditCustomAttributes = "";
		$this->idmetodo->EditValue = $this->idmetodo->CurrentValue;
		$this->idmetodo->PlaceHolder = ew_RemoveHtml($this->idmetodo->FldCaption());

		// fecharecibido
		$this->fecharecibido->EditAttrs["class"] = "form-control";
		$this->fecharecibido->EditCustomAttributes = "";
		$this->fecharecibido->EditValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

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
					if ($this->idCalificacion->Exportable) $Doc->ExportCaption($this->idCalificacion);
					if ($this->idProyecto->Exportable) $Doc->ExportCaption($this->idProyecto);
					if ($this->numproceso->Exportable) $Doc->ExportCaption($this->numproceso);
					if ($this->nomprocesoproyecto->Exportable) $Doc->ExportCaption($this->nomprocesoproyecto);
					if ($this->fechactualizacion->Exportable) $Doc->ExportCaption($this->fechactualizacion);
					if ($this->idFuncionario->Exportable) $Doc->ExportCaption($this->idFuncionario);
					if ($this->estatusproceso->Exportable) $Doc->ExportCaption($this->estatusproceso);
					if ($this->proceseval->Exportable) $Doc->ExportCaption($this->proceseval);
					if ($this->invitainter->Exportable) $Doc->ExportCaption($this->invitainter);
					if ($this->basespreca->Exportable) $Doc->ExportCaption($this->basespreca);
					if ($this->resolucion->Exportable) $Doc->ExportCaption($this->resolucion);
					if ($this->nombreante->Exportable) $Doc->ExportCaption($this->nombreante);
					if ($this->convocainvi->Exportable) $Doc->ExportCaption($this->convocainvi);
					if ($this->tdr->Exportable) $Doc->ExportCaption($this->tdr);
					if ($this->aclaraciones->Exportable) $Doc->ExportCaption($this->aclaraciones);
					if ($this->actarecpcion->Exportable) $Doc->ExportCaption($this->actarecpcion);
					if ($this->fechaingreso->Exportable) $Doc->ExportCaption($this->fechaingreso);
					if ($this->tipocontrato->Exportable) $Doc->ExportCaption($this->tipocontrato);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro1->Exportable) $Doc->ExportCaption($this->otro1);
					if ($this->otro2->Exportable) $Doc->ExportCaption($this->otro2);
					if ($this->identidadadquisicion->Exportable) $Doc->ExportCaption($this->identidadadquisicion);
					if ($this->idmetodo->Exportable) $Doc->ExportCaption($this->idmetodo);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
				} else {
					if ($this->idCalificacion->Exportable) $Doc->ExportCaption($this->idCalificacion);
					if ($this->idProyecto->Exportable) $Doc->ExportCaption($this->idProyecto);
					if ($this->numproceso->Exportable) $Doc->ExportCaption($this->numproceso);
					if ($this->fechactualizacion->Exportable) $Doc->ExportCaption($this->fechactualizacion);
					if ($this->idFuncionario->Exportable) $Doc->ExportCaption($this->idFuncionario);
					if ($this->estatusproceso->Exportable) $Doc->ExportCaption($this->estatusproceso);
					if ($this->proceseval->Exportable) $Doc->ExportCaption($this->proceseval);
					if ($this->invitainter->Exportable) $Doc->ExportCaption($this->invitainter);
					if ($this->basespreca->Exportable) $Doc->ExportCaption($this->basespreca);
					if ($this->resolucion->Exportable) $Doc->ExportCaption($this->resolucion);
					if ($this->nombreante->Exportable) $Doc->ExportCaption($this->nombreante);
					if ($this->convocainvi->Exportable) $Doc->ExportCaption($this->convocainvi);
					if ($this->tdr->Exportable) $Doc->ExportCaption($this->tdr);
					if ($this->aclaraciones->Exportable) $Doc->ExportCaption($this->aclaraciones);
					if ($this->actarecpcion->Exportable) $Doc->ExportCaption($this->actarecpcion);
					if ($this->fechaingreso->Exportable) $Doc->ExportCaption($this->fechaingreso);
					if ($this->tipocontrato->Exportable) $Doc->ExportCaption($this->tipocontrato);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro1->Exportable) $Doc->ExportCaption($this->otro1);
					if ($this->otro2->Exportable) $Doc->ExportCaption($this->otro2);
					if ($this->identidadadquisicion->Exportable) $Doc->ExportCaption($this->identidadadquisicion);
					if ($this->idmetodo->Exportable) $Doc->ExportCaption($this->idmetodo);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
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
						if ($this->idCalificacion->Exportable) $Doc->ExportField($this->idCalificacion);
						if ($this->idProyecto->Exportable) $Doc->ExportField($this->idProyecto);
						if ($this->numproceso->Exportable) $Doc->ExportField($this->numproceso);
						if ($this->nomprocesoproyecto->Exportable) $Doc->ExportField($this->nomprocesoproyecto);
						if ($this->fechactualizacion->Exportable) $Doc->ExportField($this->fechactualizacion);
						if ($this->idFuncionario->Exportable) $Doc->ExportField($this->idFuncionario);
						if ($this->estatusproceso->Exportable) $Doc->ExportField($this->estatusproceso);
						if ($this->proceseval->Exportable) $Doc->ExportField($this->proceseval);
						if ($this->invitainter->Exportable) $Doc->ExportField($this->invitainter);
						if ($this->basespreca->Exportable) $Doc->ExportField($this->basespreca);
						if ($this->resolucion->Exportable) $Doc->ExportField($this->resolucion);
						if ($this->nombreante->Exportable) $Doc->ExportField($this->nombreante);
						if ($this->convocainvi->Exportable) $Doc->ExportField($this->convocainvi);
						if ($this->tdr->Exportable) $Doc->ExportField($this->tdr);
						if ($this->aclaraciones->Exportable) $Doc->ExportField($this->aclaraciones);
						if ($this->actarecpcion->Exportable) $Doc->ExportField($this->actarecpcion);
						if ($this->fechaingreso->Exportable) $Doc->ExportField($this->fechaingreso);
						if ($this->tipocontrato->Exportable) $Doc->ExportField($this->tipocontrato);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro1->Exportable) $Doc->ExportField($this->otro1);
						if ($this->otro2->Exportable) $Doc->ExportField($this->otro2);
						if ($this->identidadadquisicion->Exportable) $Doc->ExportField($this->identidadadquisicion);
						if ($this->idmetodo->Exportable) $Doc->ExportField($this->idmetodo);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
					} else {
						if ($this->idCalificacion->Exportable) $Doc->ExportField($this->idCalificacion);
						if ($this->idProyecto->Exportable) $Doc->ExportField($this->idProyecto);
						if ($this->numproceso->Exportable) $Doc->ExportField($this->numproceso);
						if ($this->fechactualizacion->Exportable) $Doc->ExportField($this->fechactualizacion);
						if ($this->idFuncionario->Exportable) $Doc->ExportField($this->idFuncionario);
						if ($this->estatusproceso->Exportable) $Doc->ExportField($this->estatusproceso);
						if ($this->proceseval->Exportable) $Doc->ExportField($this->proceseval);
						if ($this->invitainter->Exportable) $Doc->ExportField($this->invitainter);
						if ($this->basespreca->Exportable) $Doc->ExportField($this->basespreca);
						if ($this->resolucion->Exportable) $Doc->ExportField($this->resolucion);
						if ($this->nombreante->Exportable) $Doc->ExportField($this->nombreante);
						if ($this->convocainvi->Exportable) $Doc->ExportField($this->convocainvi);
						if ($this->tdr->Exportable) $Doc->ExportField($this->tdr);
						if ($this->aclaraciones->Exportable) $Doc->ExportField($this->aclaraciones);
						if ($this->actarecpcion->Exportable) $Doc->ExportField($this->actarecpcion);
						if ($this->fechaingreso->Exportable) $Doc->ExportField($this->fechaingreso);
						if ($this->tipocontrato->Exportable) $Doc->ExportField($this->tipocontrato);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro1->Exportable) $Doc->ExportField($this->otro1);
						if ($this->otro2->Exportable) $Doc->ExportField($this->otro2);
						if ($this->identidadadquisicion->Exportable) $Doc->ExportField($this->identidadadquisicion);
						if ($this->idmetodo->Exportable) $Doc->ExportField($this->idmetodo);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
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
