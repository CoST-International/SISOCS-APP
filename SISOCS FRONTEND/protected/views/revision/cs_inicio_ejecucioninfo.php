<?php

// Global variable for table object
$cs_inicio_ejecucion = NULL;

//
// Table class for cs_inicio_ejecucion
//
class ccs_inicio_ejecucion extends cTable {
	var $codigo;
	var $idContratacion;
	var $imagen;
	var $cod_contacto_01;
	var $cod_contacto_02;
	var $cod_contacto_03;
	var $tipo_garant_01;
	var $tipo_garant_02;
	var $tipo_garant_03;
	var $monto_garant_01;
	var $monto_garant_02;
	var $monto_garant_03;
	var $estado_garant_01;
	var $estado_garant_02;
	var $estado_garant_03;
	var $fecha_venc_01;
	var $fecha_venc_02;
	var $fecha_venc_03;
	var $geo_latitud;
	var $geo_longitud;
	var $geo_lati_final;
	var $geo_long_final;
	var $fecha_inicio;
	var $estado_sol;
	var $fecha_registro;
	var $user_registro;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_inicio_ejecucion';
		$this->TableName = 'cs_inicio_ejecucion';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_inicio_ejecucion`";
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
		$this->codigo = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_codigo', 'codigo', '`codigo`', '`codigo`', 3, -1, FALSE, '`codigo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->codigo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['codigo'] = &$this->codigo;

		// idContratacion
		$this->idContratacion = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_idContratacion', 'idContratacion', '`idContratacion`', '`idContratacion`', 3, -1, FALSE, '`idContratacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idContratacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratacion'] = &$this->idContratacion;

		// imagen
		$this->imagen = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_imagen', 'imagen', '`imagen`', '`imagen`', 200, -1, FALSE, '`imagen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['imagen'] = &$this->imagen;

		// cod_contacto_01
		$this->cod_contacto_01 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_cod_contacto_01', 'cod_contacto_01', '`cod_contacto_01`', '`cod_contacto_01`', 3, -1, FALSE, '`cod_contacto_01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cod_contacto_01->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cod_contacto_01'] = &$this->cod_contacto_01;

		// cod_contacto_02
		$this->cod_contacto_02 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_cod_contacto_02', 'cod_contacto_02', '`cod_contacto_02`', '`cod_contacto_02`', 3, -1, FALSE, '`cod_contacto_02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cod_contacto_02->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cod_contacto_02'] = &$this->cod_contacto_02;

		// cod_contacto_03
		$this->cod_contacto_03 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_cod_contacto_03', 'cod_contacto_03', '`cod_contacto_03`', '`cod_contacto_03`', 3, -1, FALSE, '`cod_contacto_03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cod_contacto_03->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['cod_contacto_03'] = &$this->cod_contacto_03;

		// tipo_garant_01
		$this->tipo_garant_01 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_tipo_garant_01', 'tipo_garant_01', '`tipo_garant_01`', '`tipo_garant_01`', 3, -1, FALSE, '`tipo_garant_01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipo_garant_01->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tipo_garant_01'] = &$this->tipo_garant_01;

		// tipo_garant_02
		$this->tipo_garant_02 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_tipo_garant_02', 'tipo_garant_02', '`tipo_garant_02`', '`tipo_garant_02`', 3, -1, FALSE, '`tipo_garant_02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipo_garant_02->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tipo_garant_02'] = &$this->tipo_garant_02;

		// tipo_garant_03
		$this->tipo_garant_03 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_tipo_garant_03', 'tipo_garant_03', '`tipo_garant_03`', '`tipo_garant_03`', 3, -1, FALSE, '`tipo_garant_03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tipo_garant_03->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tipo_garant_03'] = &$this->tipo_garant_03;

		// monto_garant_01
		$this->monto_garant_01 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_monto_garant_01', 'monto_garant_01', '`monto_garant_01`', '`monto_garant_01`', 131, -1, FALSE, '`monto_garant_01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto_garant_01->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monto_garant_01'] = &$this->monto_garant_01;

		// monto_garant_02
		$this->monto_garant_02 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_monto_garant_02', 'monto_garant_02', '`monto_garant_02`', '`monto_garant_02`', 131, -1, FALSE, '`monto_garant_02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto_garant_02->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monto_garant_02'] = &$this->monto_garant_02;

		// monto_garant_03
		$this->monto_garant_03 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_monto_garant_03', 'monto_garant_03', '`monto_garant_03`', '`monto_garant_03`', 131, -1, FALSE, '`monto_garant_03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto_garant_03->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monto_garant_03'] = &$this->monto_garant_03;

		// estado_garant_01
		$this->estado_garant_01 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_estado_garant_01', 'estado_garant_01', '`estado_garant_01`', '`estado_garant_01`', 3, -1, FALSE, '`estado_garant_01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estado_garant_01->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estado_garant_01'] = &$this->estado_garant_01;

		// estado_garant_02
		$this->estado_garant_02 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_estado_garant_02', 'estado_garant_02', '`estado_garant_02`', '`estado_garant_02`', 3, -1, FALSE, '`estado_garant_02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estado_garant_02->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estado_garant_02'] = &$this->estado_garant_02;

		// estado_garant_03
		$this->estado_garant_03 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_estado_garant_03', 'estado_garant_03', '`estado_garant_03`', '`estado_garant_03`', 3, -1, FALSE, '`estado_garant_03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estado_garant_03->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estado_garant_03'] = &$this->estado_garant_03;

		// fecha_venc_01
		$this->fecha_venc_01 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_fecha_venc_01', 'fecha_venc_01', '`fecha_venc_01`', 'DATE_FORMAT(`fecha_venc_01`, \'%Y/%m/%d\')', 135, 5, FALSE, '`fecha_venc_01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_venc_01->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_venc_01'] = &$this->fecha_venc_01;

		// fecha_venc_02
		$this->fecha_venc_02 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_fecha_venc_02', 'fecha_venc_02', '`fecha_venc_02`', 'DATE_FORMAT(`fecha_venc_02`, \'%Y/%m/%d\')', 135, 5, FALSE, '`fecha_venc_02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_venc_02->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_venc_02'] = &$this->fecha_venc_02;

		// fecha_venc_03
		$this->fecha_venc_03 = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_fecha_venc_03', 'fecha_venc_03', '`fecha_venc_03`', 'DATE_FORMAT(`fecha_venc_03`, \'%Y/%m/%d\')', 135, 5, FALSE, '`fecha_venc_03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_venc_03->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_venc_03'] = &$this->fecha_venc_03;

		// geo_latitud
		$this->geo_latitud = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_geo_latitud', 'geo_latitud', '`geo_latitud`', '`geo_latitud`', 131, -1, FALSE, '`geo_latitud`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->geo_latitud->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['geo_latitud'] = &$this->geo_latitud;

		// geo_longitud
		$this->geo_longitud = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_geo_longitud', 'geo_longitud', '`geo_longitud`', '`geo_longitud`', 131, -1, FALSE, '`geo_longitud`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->geo_longitud->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['geo_longitud'] = &$this->geo_longitud;

		// geo_lati_final
		$this->geo_lati_final = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_geo_lati_final', 'geo_lati_final', '`geo_lati_final`', '`geo_lati_final`', 131, -1, FALSE, '`geo_lati_final`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->geo_lati_final->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['geo_lati_final'] = &$this->geo_lati_final;

		// geo_long_final
		$this->geo_long_final = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_geo_long_final', 'geo_long_final', '`geo_long_final`', '`geo_long_final`', 131, -1, FALSE, '`geo_long_final`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->geo_long_final->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['geo_long_final'] = &$this->geo_long_final;

		// fecha_inicio
		$this->fecha_inicio = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_fecha_inicio', 'fecha_inicio', '`fecha_inicio`', 'DATE_FORMAT(`fecha_inicio`, \'%Y/%m/%d\')', 135, 5, FALSE, '`fecha_inicio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_inicio->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_inicio'] = &$this->fecha_inicio;

		// estado_sol
		$this->estado_sol = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_estado_sol', 'estado_sol', '`estado_sol`', '`estado_sol`', 200, -1, FALSE, '`estado_sol`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado_sol'] = &$this->estado_sol;

		// fecha_registro
		$this->fecha_registro = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_fecha_registro', 'fecha_registro', '`fecha_registro`', 'DATE_FORMAT(`fecha_registro`, \'%Y/%m/%d\')', 135, 5, FALSE, '`fecha_registro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_registro->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['fecha_registro'] = &$this->fecha_registro;

		// user_registro
		$this->user_registro = new cField('cs_inicio_ejecucion', 'cs_inicio_ejecucion', 'x_user_registro', 'user_registro', '`user_registro`', '`user_registro`', 200, -1, FALSE, '`user_registro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['user_registro'] = &$this->user_registro;
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
		if ($this->getCurrentMasterTable() == "cs_contratacion") {
			if ($this->idContratacion->getSessionValue() <> "")
				$sMasterFilter .= "`idContratacion`=" . ew_QuotedValue($this->idContratacion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cs_contratacion") {
			if ($this->idContratacion->getSessionValue() <> "")
				$sDetailFilter .= "`idContratacion`=" . ew_QuotedValue($this->idContratacion->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cs_contratacion() {
		return "`idContratacion`=@idContratacion@";
	}

	// Detail filter
	function SqlDetailFilter_cs_contratacion() {
		return "`idContratacion`=@idContratacion@";
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
		if ($this->getCurrentDetailTable() == "cs_avances") {
			$sDetailUrl = $GLOBALS["cs_avances"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_idContratacion=" . urlencode($this->idContratacion->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "cs_inicio_ejecucionlist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_inicio_ejecucion`";
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
			return "cs_inicio_ejecucionlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_inicio_ejecucionlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_inicio_ejecucionview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_inicio_ejecucionview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_inicio_ejecucionadd.php?" . $this->UrlParm($parm);
		else
			return "cs_inicio_ejecucionadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_inicio_ejecucionedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_inicio_ejecucionedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_inicio_ejecucionadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_inicio_ejecucionadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_inicio_ejecuciondelete.php", $this->UrlParm());
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
		$this->idContratacion->setDbValue($rs->fields('idContratacion'));
		$this->imagen->setDbValue($rs->fields('imagen'));
		$this->cod_contacto_01->setDbValue($rs->fields('cod_contacto_01'));
		$this->cod_contacto_02->setDbValue($rs->fields('cod_contacto_02'));
		$this->cod_contacto_03->setDbValue($rs->fields('cod_contacto_03'));
		$this->tipo_garant_01->setDbValue($rs->fields('tipo_garant_01'));
		$this->tipo_garant_02->setDbValue($rs->fields('tipo_garant_02'));
		$this->tipo_garant_03->setDbValue($rs->fields('tipo_garant_03'));
		$this->monto_garant_01->setDbValue($rs->fields('monto_garant_01'));
		$this->monto_garant_02->setDbValue($rs->fields('monto_garant_02'));
		$this->monto_garant_03->setDbValue($rs->fields('monto_garant_03'));
		$this->estado_garant_01->setDbValue($rs->fields('estado_garant_01'));
		$this->estado_garant_02->setDbValue($rs->fields('estado_garant_02'));
		$this->estado_garant_03->setDbValue($rs->fields('estado_garant_03'));
		$this->fecha_venc_01->setDbValue($rs->fields('fecha_venc_01'));
		$this->fecha_venc_02->setDbValue($rs->fields('fecha_venc_02'));
		$this->fecha_venc_03->setDbValue($rs->fields('fecha_venc_03'));
		$this->geo_latitud->setDbValue($rs->fields('geo_latitud'));
		$this->geo_longitud->setDbValue($rs->fields('geo_longitud'));
		$this->geo_lati_final->setDbValue($rs->fields('geo_lati_final'));
		$this->geo_long_final->setDbValue($rs->fields('geo_long_final'));
		$this->fecha_inicio->setDbValue($rs->fields('fecha_inicio'));
		$this->estado_sol->setDbValue($rs->fields('estado_sol'));
		$this->fecha_registro->setDbValue($rs->fields('fecha_registro'));
		$this->user_registro->setDbValue($rs->fields('user_registro'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// codigo
		// idContratacion
		// imagen
		// cod_contacto_01
		// cod_contacto_02
		// cod_contacto_03
		// tipo_garant_01
		// tipo_garant_02
		// tipo_garant_03
		// monto_garant_01
		// monto_garant_02
		// monto_garant_03
		// estado_garant_01
		// estado_garant_02
		// estado_garant_03
		// fecha_venc_01
		// fecha_venc_02
		// fecha_venc_03
		// geo_latitud
		// geo_longitud
		// geo_lati_final
		// geo_long_final
		// fecha_inicio
		// estado_sol
		// fecha_registro
		// user_registro
		// codigo

		$this->codigo->ViewValue = $this->codigo->CurrentValue;
		$this->codigo->ViewCustomAttributes = "";

		// idContratacion
		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// imagen
		$this->imagen->ViewValue = $this->imagen->CurrentValue;
		$this->imagen->ViewCustomAttributes = "";

		// cod_contacto_01
		$this->cod_contacto_01->ViewValue = $this->cod_contacto_01->CurrentValue;
		$this->cod_contacto_01->ViewCustomAttributes = "";

		// cod_contacto_02
		$this->cod_contacto_02->ViewValue = $this->cod_contacto_02->CurrentValue;
		$this->cod_contacto_02->ViewCustomAttributes = "";

		// cod_contacto_03
		$this->cod_contacto_03->ViewValue = $this->cod_contacto_03->CurrentValue;
		$this->cod_contacto_03->ViewCustomAttributes = "";

		// tipo_garant_01
		$this->tipo_garant_01->ViewValue = $this->tipo_garant_01->CurrentValue;
		$this->tipo_garant_01->ViewCustomAttributes = "";

		// tipo_garant_02
		$this->tipo_garant_02->ViewValue = $this->tipo_garant_02->CurrentValue;
		$this->tipo_garant_02->ViewCustomAttributes = "";

		// tipo_garant_03
		$this->tipo_garant_03->ViewValue = $this->tipo_garant_03->CurrentValue;
		$this->tipo_garant_03->ViewCustomAttributes = "";

		// monto_garant_01
		$this->monto_garant_01->ViewValue = $this->monto_garant_01->CurrentValue;
		$this->monto_garant_01->ViewCustomAttributes = "";

		// monto_garant_02
		$this->monto_garant_02->ViewValue = $this->monto_garant_02->CurrentValue;
		$this->monto_garant_02->ViewCustomAttributes = "";

		// monto_garant_03
		$this->monto_garant_03->ViewValue = $this->monto_garant_03->CurrentValue;
		$this->monto_garant_03->ViewCustomAttributes = "";

		// estado_garant_01
		$this->estado_garant_01->ViewValue = $this->estado_garant_01->CurrentValue;
		$this->estado_garant_01->ViewCustomAttributes = "";

		// estado_garant_02
		$this->estado_garant_02->ViewValue = $this->estado_garant_02->CurrentValue;
		$this->estado_garant_02->ViewCustomAttributes = "";

		// estado_garant_03
		$this->estado_garant_03->ViewValue = $this->estado_garant_03->CurrentValue;
		$this->estado_garant_03->ViewCustomAttributes = "";

		// fecha_venc_01
		$this->fecha_venc_01->ViewValue = $this->fecha_venc_01->CurrentValue;
		$this->fecha_venc_01->ViewValue = ew_FormatDateTime($this->fecha_venc_01->ViewValue, 5);
		$this->fecha_venc_01->ViewCustomAttributes = "";

		// fecha_venc_02
		$this->fecha_venc_02->ViewValue = $this->fecha_venc_02->CurrentValue;
		$this->fecha_venc_02->ViewValue = ew_FormatDateTime($this->fecha_venc_02->ViewValue, 5);
		$this->fecha_venc_02->ViewCustomAttributes = "";

		// fecha_venc_03
		$this->fecha_venc_03->ViewValue = $this->fecha_venc_03->CurrentValue;
		$this->fecha_venc_03->ViewValue = ew_FormatDateTime($this->fecha_venc_03->ViewValue, 5);
		$this->fecha_venc_03->ViewCustomAttributes = "";

		// geo_latitud
		$this->geo_latitud->ViewValue = $this->geo_latitud->CurrentValue;
		$this->geo_latitud->ViewCustomAttributes = "";

		// geo_longitud
		$this->geo_longitud->ViewValue = $this->geo_longitud->CurrentValue;
		$this->geo_longitud->ViewCustomAttributes = "";

		// geo_lati_final
		$this->geo_lati_final->ViewValue = $this->geo_lati_final->CurrentValue;
		$this->geo_lati_final->ViewCustomAttributes = "";

		// geo_long_final
		$this->geo_long_final->ViewValue = $this->geo_long_final->CurrentValue;
		$this->geo_long_final->ViewCustomAttributes = "";

		// fecha_inicio
		$this->fecha_inicio->ViewValue = $this->fecha_inicio->CurrentValue;
		$this->fecha_inicio->ViewValue = ew_FormatDateTime($this->fecha_inicio->ViewValue, 5);
		$this->fecha_inicio->ViewCustomAttributes = "";

		// estado_sol
		$this->estado_sol->ViewValue = $this->estado_sol->CurrentValue;
		$this->estado_sol->ViewCustomAttributes = "";

		// fecha_registro
		$this->fecha_registro->ViewValue = $this->fecha_registro->CurrentValue;
		$this->fecha_registro->ViewValue = ew_FormatDateTime($this->fecha_registro->ViewValue, 5);
		$this->fecha_registro->ViewCustomAttributes = "";

		// user_registro
		$this->user_registro->ViewValue = $this->user_registro->CurrentValue;
		$this->user_registro->ViewCustomAttributes = "";

		// codigo
		$this->codigo->LinkCustomAttributes = "";
		$this->codigo->HrefValue = "";
		$this->codigo->TooltipValue = "";

		// idContratacion
		$this->idContratacion->LinkCustomAttributes = "";
		$this->idContratacion->HrefValue = "";
		$this->idContratacion->TooltipValue = "";

		// imagen
		$this->imagen->LinkCustomAttributes = "";
		$this->imagen->HrefValue = "";
		$this->imagen->TooltipValue = "";

		// cod_contacto_01
		$this->cod_contacto_01->LinkCustomAttributes = "";
		$this->cod_contacto_01->HrefValue = "";
		$this->cod_contacto_01->TooltipValue = "";

		// cod_contacto_02
		$this->cod_contacto_02->LinkCustomAttributes = "";
		$this->cod_contacto_02->HrefValue = "";
		$this->cod_contacto_02->TooltipValue = "";

		// cod_contacto_03
		$this->cod_contacto_03->LinkCustomAttributes = "";
		$this->cod_contacto_03->HrefValue = "";
		$this->cod_contacto_03->TooltipValue = "";

		// tipo_garant_01
		$this->tipo_garant_01->LinkCustomAttributes = "";
		$this->tipo_garant_01->HrefValue = "";
		$this->tipo_garant_01->TooltipValue = "";

		// tipo_garant_02
		$this->tipo_garant_02->LinkCustomAttributes = "";
		$this->tipo_garant_02->HrefValue = "";
		$this->tipo_garant_02->TooltipValue = "";

		// tipo_garant_03
		$this->tipo_garant_03->LinkCustomAttributes = "";
		$this->tipo_garant_03->HrefValue = "";
		$this->tipo_garant_03->TooltipValue = "";

		// monto_garant_01
		$this->monto_garant_01->LinkCustomAttributes = "";
		$this->monto_garant_01->HrefValue = "";
		$this->monto_garant_01->TooltipValue = "";

		// monto_garant_02
		$this->monto_garant_02->LinkCustomAttributes = "";
		$this->monto_garant_02->HrefValue = "";
		$this->monto_garant_02->TooltipValue = "";

		// monto_garant_03
		$this->monto_garant_03->LinkCustomAttributes = "";
		$this->monto_garant_03->HrefValue = "";
		$this->monto_garant_03->TooltipValue = "";

		// estado_garant_01
		$this->estado_garant_01->LinkCustomAttributes = "";
		$this->estado_garant_01->HrefValue = "";
		$this->estado_garant_01->TooltipValue = "";

		// estado_garant_02
		$this->estado_garant_02->LinkCustomAttributes = "";
		$this->estado_garant_02->HrefValue = "";
		$this->estado_garant_02->TooltipValue = "";

		// estado_garant_03
		$this->estado_garant_03->LinkCustomAttributes = "";
		$this->estado_garant_03->HrefValue = "";
		$this->estado_garant_03->TooltipValue = "";

		// fecha_venc_01
		$this->fecha_venc_01->LinkCustomAttributes = "";
		$this->fecha_venc_01->HrefValue = "";
		$this->fecha_venc_01->TooltipValue = "";

		// fecha_venc_02
		$this->fecha_venc_02->LinkCustomAttributes = "";
		$this->fecha_venc_02->HrefValue = "";
		$this->fecha_venc_02->TooltipValue = "";

		// fecha_venc_03
		$this->fecha_venc_03->LinkCustomAttributes = "";
		$this->fecha_venc_03->HrefValue = "";
		$this->fecha_venc_03->TooltipValue = "";

		// geo_latitud
		$this->geo_latitud->LinkCustomAttributes = "";
		$this->geo_latitud->HrefValue = "";
		$this->geo_latitud->TooltipValue = "";

		// geo_longitud
		$this->geo_longitud->LinkCustomAttributes = "";
		$this->geo_longitud->HrefValue = "";
		$this->geo_longitud->TooltipValue = "";

		// geo_lati_final
		$this->geo_lati_final->LinkCustomAttributes = "";
		$this->geo_lati_final->HrefValue = "";
		$this->geo_lati_final->TooltipValue = "";

		// geo_long_final
		$this->geo_long_final->LinkCustomAttributes = "";
		$this->geo_long_final->HrefValue = "";
		$this->geo_long_final->TooltipValue = "";

		// fecha_inicio
		$this->fecha_inicio->LinkCustomAttributes = "";
		$this->fecha_inicio->HrefValue = "";
		$this->fecha_inicio->TooltipValue = "";

		// estado_sol
		$this->estado_sol->LinkCustomAttributes = "";
		$this->estado_sol->HrefValue = "";
		$this->estado_sol->TooltipValue = "";

		// fecha_registro
		$this->fecha_registro->LinkCustomAttributes = "";
		$this->fecha_registro->HrefValue = "";
		$this->fecha_registro->TooltipValue = "";

		// user_registro
		$this->user_registro->LinkCustomAttributes = "";
		$this->user_registro->HrefValue = "";
		$this->user_registro->TooltipValue = "";

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

		// idContratacion
		$this->idContratacion->EditAttrs["class"] = "form-control";
		$this->idContratacion->EditCustomAttributes = "";
		if ($this->idContratacion->getSessionValue() <> "") {
			$this->idContratacion->CurrentValue = $this->idContratacion->getSessionValue();
		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";
		} else {
		$this->idContratacion->EditValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());
		}

		// imagen
		$this->imagen->EditAttrs["class"] = "form-control";
		$this->imagen->EditCustomAttributes = "";
		$this->imagen->EditValue = $this->imagen->CurrentValue;
		$this->imagen->PlaceHolder = ew_RemoveHtml($this->imagen->FldCaption());

		// cod_contacto_01
		$this->cod_contacto_01->EditAttrs["class"] = "form-control";
		$this->cod_contacto_01->EditCustomAttributes = "";
		$this->cod_contacto_01->EditValue = $this->cod_contacto_01->CurrentValue;
		$this->cod_contacto_01->PlaceHolder = ew_RemoveHtml($this->cod_contacto_01->FldCaption());

		// cod_contacto_02
		$this->cod_contacto_02->EditAttrs["class"] = "form-control";
		$this->cod_contacto_02->EditCustomAttributes = "";
		$this->cod_contacto_02->EditValue = $this->cod_contacto_02->CurrentValue;
		$this->cod_contacto_02->PlaceHolder = ew_RemoveHtml($this->cod_contacto_02->FldCaption());

		// cod_contacto_03
		$this->cod_contacto_03->EditAttrs["class"] = "form-control";
		$this->cod_contacto_03->EditCustomAttributes = "";
		$this->cod_contacto_03->EditValue = $this->cod_contacto_03->CurrentValue;
		$this->cod_contacto_03->PlaceHolder = ew_RemoveHtml($this->cod_contacto_03->FldCaption());

		// tipo_garant_01
		$this->tipo_garant_01->EditAttrs["class"] = "form-control";
		$this->tipo_garant_01->EditCustomAttributes = "";
		$this->tipo_garant_01->EditValue = $this->tipo_garant_01->CurrentValue;
		$this->tipo_garant_01->PlaceHolder = ew_RemoveHtml($this->tipo_garant_01->FldCaption());

		// tipo_garant_02
		$this->tipo_garant_02->EditAttrs["class"] = "form-control";
		$this->tipo_garant_02->EditCustomAttributes = "";
		$this->tipo_garant_02->EditValue = $this->tipo_garant_02->CurrentValue;
		$this->tipo_garant_02->PlaceHolder = ew_RemoveHtml($this->tipo_garant_02->FldCaption());

		// tipo_garant_03
		$this->tipo_garant_03->EditAttrs["class"] = "form-control";
		$this->tipo_garant_03->EditCustomAttributes = "";
		$this->tipo_garant_03->EditValue = $this->tipo_garant_03->CurrentValue;
		$this->tipo_garant_03->PlaceHolder = ew_RemoveHtml($this->tipo_garant_03->FldCaption());

		// monto_garant_01
		$this->monto_garant_01->EditAttrs["class"] = "form-control";
		$this->monto_garant_01->EditCustomAttributes = "";
		$this->monto_garant_01->EditValue = $this->monto_garant_01->CurrentValue;
		$this->monto_garant_01->PlaceHolder = ew_RemoveHtml($this->monto_garant_01->FldCaption());
		if (strval($this->monto_garant_01->EditValue) <> "" && is_numeric($this->monto_garant_01->EditValue)) $this->monto_garant_01->EditValue = ew_FormatNumber($this->monto_garant_01->EditValue, -2, -1, -2, 0);

		// monto_garant_02
		$this->monto_garant_02->EditAttrs["class"] = "form-control";
		$this->monto_garant_02->EditCustomAttributes = "";
		$this->monto_garant_02->EditValue = $this->monto_garant_02->CurrentValue;
		$this->monto_garant_02->PlaceHolder = ew_RemoveHtml($this->monto_garant_02->FldCaption());
		if (strval($this->monto_garant_02->EditValue) <> "" && is_numeric($this->monto_garant_02->EditValue)) $this->monto_garant_02->EditValue = ew_FormatNumber($this->monto_garant_02->EditValue, -2, -1, -2, 0);

		// monto_garant_03
		$this->monto_garant_03->EditAttrs["class"] = "form-control";
		$this->monto_garant_03->EditCustomAttributes = "";
		$this->monto_garant_03->EditValue = $this->monto_garant_03->CurrentValue;
		$this->monto_garant_03->PlaceHolder = ew_RemoveHtml($this->monto_garant_03->FldCaption());
		if (strval($this->monto_garant_03->EditValue) <> "" && is_numeric($this->monto_garant_03->EditValue)) $this->monto_garant_03->EditValue = ew_FormatNumber($this->monto_garant_03->EditValue, -2, -1, -2, 0);

		// estado_garant_01
		$this->estado_garant_01->EditAttrs["class"] = "form-control";
		$this->estado_garant_01->EditCustomAttributes = "";
		$this->estado_garant_01->EditValue = $this->estado_garant_01->CurrentValue;
		$this->estado_garant_01->PlaceHolder = ew_RemoveHtml($this->estado_garant_01->FldCaption());

		// estado_garant_02
		$this->estado_garant_02->EditAttrs["class"] = "form-control";
		$this->estado_garant_02->EditCustomAttributes = "";
		$this->estado_garant_02->EditValue = $this->estado_garant_02->CurrentValue;
		$this->estado_garant_02->PlaceHolder = ew_RemoveHtml($this->estado_garant_02->FldCaption());

		// estado_garant_03
		$this->estado_garant_03->EditAttrs["class"] = "form-control";
		$this->estado_garant_03->EditCustomAttributes = "";
		$this->estado_garant_03->EditValue = $this->estado_garant_03->CurrentValue;
		$this->estado_garant_03->PlaceHolder = ew_RemoveHtml($this->estado_garant_03->FldCaption());

		// fecha_venc_01
		$this->fecha_venc_01->EditAttrs["class"] = "form-control";
		$this->fecha_venc_01->EditCustomAttributes = "";
		$this->fecha_venc_01->EditValue = ew_FormatDateTime($this->fecha_venc_01->CurrentValue, 5);
		$this->fecha_venc_01->PlaceHolder = ew_RemoveHtml($this->fecha_venc_01->FldCaption());

		// fecha_venc_02
		$this->fecha_venc_02->EditAttrs["class"] = "form-control";
		$this->fecha_venc_02->EditCustomAttributes = "";
		$this->fecha_venc_02->EditValue = ew_FormatDateTime($this->fecha_venc_02->CurrentValue, 5);
		$this->fecha_venc_02->PlaceHolder = ew_RemoveHtml($this->fecha_venc_02->FldCaption());

		// fecha_venc_03
		$this->fecha_venc_03->EditAttrs["class"] = "form-control";
		$this->fecha_venc_03->EditCustomAttributes = "";
		$this->fecha_venc_03->EditValue = ew_FormatDateTime($this->fecha_venc_03->CurrentValue, 5);
		$this->fecha_venc_03->PlaceHolder = ew_RemoveHtml($this->fecha_venc_03->FldCaption());

		// geo_latitud
		$this->geo_latitud->EditAttrs["class"] = "form-control";
		$this->geo_latitud->EditCustomAttributes = "";
		$this->geo_latitud->EditValue = $this->geo_latitud->CurrentValue;
		$this->geo_latitud->PlaceHolder = ew_RemoveHtml($this->geo_latitud->FldCaption());
		if (strval($this->geo_latitud->EditValue) <> "" && is_numeric($this->geo_latitud->EditValue)) $this->geo_latitud->EditValue = ew_FormatNumber($this->geo_latitud->EditValue, -2, -1, -2, 0);

		// geo_longitud
		$this->geo_longitud->EditAttrs["class"] = "form-control";
		$this->geo_longitud->EditCustomAttributes = "";
		$this->geo_longitud->EditValue = $this->geo_longitud->CurrentValue;
		$this->geo_longitud->PlaceHolder = ew_RemoveHtml($this->geo_longitud->FldCaption());
		if (strval($this->geo_longitud->EditValue) <> "" && is_numeric($this->geo_longitud->EditValue)) $this->geo_longitud->EditValue = ew_FormatNumber($this->geo_longitud->EditValue, -2, -1, -2, 0);

		// geo_lati_final
		$this->geo_lati_final->EditAttrs["class"] = "form-control";
		$this->geo_lati_final->EditCustomAttributes = "";
		$this->geo_lati_final->EditValue = $this->geo_lati_final->CurrentValue;
		$this->geo_lati_final->PlaceHolder = ew_RemoveHtml($this->geo_lati_final->FldCaption());
		if (strval($this->geo_lati_final->EditValue) <> "" && is_numeric($this->geo_lati_final->EditValue)) $this->geo_lati_final->EditValue = ew_FormatNumber($this->geo_lati_final->EditValue, -2, -1, -2, 0);

		// geo_long_final
		$this->geo_long_final->EditAttrs["class"] = "form-control";
		$this->geo_long_final->EditCustomAttributes = "";
		$this->geo_long_final->EditValue = $this->geo_long_final->CurrentValue;
		$this->geo_long_final->PlaceHolder = ew_RemoveHtml($this->geo_long_final->FldCaption());
		if (strval($this->geo_long_final->EditValue) <> "" && is_numeric($this->geo_long_final->EditValue)) $this->geo_long_final->EditValue = ew_FormatNumber($this->geo_long_final->EditValue, -2, -1, -2, 0);

		// fecha_inicio
		$this->fecha_inicio->EditAttrs["class"] = "form-control";
		$this->fecha_inicio->EditCustomAttributes = "";
		$this->fecha_inicio->EditValue = ew_FormatDateTime($this->fecha_inicio->CurrentValue, 5);
		$this->fecha_inicio->PlaceHolder = ew_RemoveHtml($this->fecha_inicio->FldCaption());

		// estado_sol
		$this->estado_sol->EditAttrs["class"] = "form-control";
		$this->estado_sol->EditCustomAttributes = "";
		$this->estado_sol->EditValue = $this->estado_sol->CurrentValue;
		$this->estado_sol->PlaceHolder = ew_RemoveHtml($this->estado_sol->FldCaption());

		// fecha_registro
		$this->fecha_registro->EditAttrs["class"] = "form-control";
		$this->fecha_registro->EditCustomAttributes = "";
		$this->fecha_registro->EditValue = ew_FormatDateTime($this->fecha_registro->CurrentValue, 5);
		$this->fecha_registro->PlaceHolder = ew_RemoveHtml($this->fecha_registro->FldCaption());

		// user_registro
		$this->user_registro->EditAttrs["class"] = "form-control";
		$this->user_registro->EditCustomAttributes = "";
		$this->user_registro->EditValue = $this->user_registro->CurrentValue;
		$this->user_registro->PlaceHolder = ew_RemoveHtml($this->user_registro->FldCaption());

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
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->imagen->Exportable) $Doc->ExportCaption($this->imagen);
					if ($this->cod_contacto_01->Exportable) $Doc->ExportCaption($this->cod_contacto_01);
					if ($this->cod_contacto_02->Exportable) $Doc->ExportCaption($this->cod_contacto_02);
					if ($this->cod_contacto_03->Exportable) $Doc->ExportCaption($this->cod_contacto_03);
					if ($this->tipo_garant_01->Exportable) $Doc->ExportCaption($this->tipo_garant_01);
					if ($this->tipo_garant_02->Exportable) $Doc->ExportCaption($this->tipo_garant_02);
					if ($this->tipo_garant_03->Exportable) $Doc->ExportCaption($this->tipo_garant_03);
					if ($this->monto_garant_01->Exportable) $Doc->ExportCaption($this->monto_garant_01);
					if ($this->monto_garant_02->Exportable) $Doc->ExportCaption($this->monto_garant_02);
					if ($this->monto_garant_03->Exportable) $Doc->ExportCaption($this->monto_garant_03);
					if ($this->estado_garant_01->Exportable) $Doc->ExportCaption($this->estado_garant_01);
					if ($this->estado_garant_02->Exportable) $Doc->ExportCaption($this->estado_garant_02);
					if ($this->estado_garant_03->Exportable) $Doc->ExportCaption($this->estado_garant_03);
					if ($this->fecha_venc_01->Exportable) $Doc->ExportCaption($this->fecha_venc_01);
					if ($this->fecha_venc_02->Exportable) $Doc->ExportCaption($this->fecha_venc_02);
					if ($this->fecha_venc_03->Exportable) $Doc->ExportCaption($this->fecha_venc_03);
					if ($this->geo_latitud->Exportable) $Doc->ExportCaption($this->geo_latitud);
					if ($this->geo_longitud->Exportable) $Doc->ExportCaption($this->geo_longitud);
					if ($this->geo_lati_final->Exportable) $Doc->ExportCaption($this->geo_lati_final);
					if ($this->geo_long_final->Exportable) $Doc->ExportCaption($this->geo_long_final);
					if ($this->fecha_inicio->Exportable) $Doc->ExportCaption($this->fecha_inicio);
					if ($this->estado_sol->Exportable) $Doc->ExportCaption($this->estado_sol);
					if ($this->fecha_registro->Exportable) $Doc->ExportCaption($this->fecha_registro);
					if ($this->user_registro->Exportable) $Doc->ExportCaption($this->user_registro);
				} else {
					if ($this->codigo->Exportable) $Doc->ExportCaption($this->codigo);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->imagen->Exportable) $Doc->ExportCaption($this->imagen);
					if ($this->cod_contacto_01->Exportable) $Doc->ExportCaption($this->cod_contacto_01);
					if ($this->cod_contacto_02->Exportable) $Doc->ExportCaption($this->cod_contacto_02);
					if ($this->cod_contacto_03->Exportable) $Doc->ExportCaption($this->cod_contacto_03);
					if ($this->tipo_garant_01->Exportable) $Doc->ExportCaption($this->tipo_garant_01);
					if ($this->tipo_garant_02->Exportable) $Doc->ExportCaption($this->tipo_garant_02);
					if ($this->tipo_garant_03->Exportable) $Doc->ExportCaption($this->tipo_garant_03);
					if ($this->monto_garant_01->Exportable) $Doc->ExportCaption($this->monto_garant_01);
					if ($this->monto_garant_02->Exportable) $Doc->ExportCaption($this->monto_garant_02);
					if ($this->monto_garant_03->Exportable) $Doc->ExportCaption($this->monto_garant_03);
					if ($this->estado_garant_01->Exportable) $Doc->ExportCaption($this->estado_garant_01);
					if ($this->estado_garant_02->Exportable) $Doc->ExportCaption($this->estado_garant_02);
					if ($this->estado_garant_03->Exportable) $Doc->ExportCaption($this->estado_garant_03);
					if ($this->fecha_venc_01->Exportable) $Doc->ExportCaption($this->fecha_venc_01);
					if ($this->fecha_venc_02->Exportable) $Doc->ExportCaption($this->fecha_venc_02);
					if ($this->fecha_venc_03->Exportable) $Doc->ExportCaption($this->fecha_venc_03);
					if ($this->geo_latitud->Exportable) $Doc->ExportCaption($this->geo_latitud);
					if ($this->geo_longitud->Exportable) $Doc->ExportCaption($this->geo_longitud);
					if ($this->geo_lati_final->Exportable) $Doc->ExportCaption($this->geo_lati_final);
					if ($this->geo_long_final->Exportable) $Doc->ExportCaption($this->geo_long_final);
					if ($this->fecha_inicio->Exportable) $Doc->ExportCaption($this->fecha_inicio);
					if ($this->estado_sol->Exportable) $Doc->ExportCaption($this->estado_sol);
					if ($this->fecha_registro->Exportable) $Doc->ExportCaption($this->fecha_registro);
					if ($this->user_registro->Exportable) $Doc->ExportCaption($this->user_registro);
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
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->imagen->Exportable) $Doc->ExportField($this->imagen);
						if ($this->cod_contacto_01->Exportable) $Doc->ExportField($this->cod_contacto_01);
						if ($this->cod_contacto_02->Exportable) $Doc->ExportField($this->cod_contacto_02);
						if ($this->cod_contacto_03->Exportable) $Doc->ExportField($this->cod_contacto_03);
						if ($this->tipo_garant_01->Exportable) $Doc->ExportField($this->tipo_garant_01);
						if ($this->tipo_garant_02->Exportable) $Doc->ExportField($this->tipo_garant_02);
						if ($this->tipo_garant_03->Exportable) $Doc->ExportField($this->tipo_garant_03);
						if ($this->monto_garant_01->Exportable) $Doc->ExportField($this->monto_garant_01);
						if ($this->monto_garant_02->Exportable) $Doc->ExportField($this->monto_garant_02);
						if ($this->monto_garant_03->Exportable) $Doc->ExportField($this->monto_garant_03);
						if ($this->estado_garant_01->Exportable) $Doc->ExportField($this->estado_garant_01);
						if ($this->estado_garant_02->Exportable) $Doc->ExportField($this->estado_garant_02);
						if ($this->estado_garant_03->Exportable) $Doc->ExportField($this->estado_garant_03);
						if ($this->fecha_venc_01->Exportable) $Doc->ExportField($this->fecha_venc_01);
						if ($this->fecha_venc_02->Exportable) $Doc->ExportField($this->fecha_venc_02);
						if ($this->fecha_venc_03->Exportable) $Doc->ExportField($this->fecha_venc_03);
						if ($this->geo_latitud->Exportable) $Doc->ExportField($this->geo_latitud);
						if ($this->geo_longitud->Exportable) $Doc->ExportField($this->geo_longitud);
						if ($this->geo_lati_final->Exportable) $Doc->ExportField($this->geo_lati_final);
						if ($this->geo_long_final->Exportable) $Doc->ExportField($this->geo_long_final);
						if ($this->fecha_inicio->Exportable) $Doc->ExportField($this->fecha_inicio);
						if ($this->estado_sol->Exportable) $Doc->ExportField($this->estado_sol);
						if ($this->fecha_registro->Exportable) $Doc->ExportField($this->fecha_registro);
						if ($this->user_registro->Exportable) $Doc->ExportField($this->user_registro);
					} else {
						if ($this->codigo->Exportable) $Doc->ExportField($this->codigo);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->imagen->Exportable) $Doc->ExportField($this->imagen);
						if ($this->cod_contacto_01->Exportable) $Doc->ExportField($this->cod_contacto_01);
						if ($this->cod_contacto_02->Exportable) $Doc->ExportField($this->cod_contacto_02);
						if ($this->cod_contacto_03->Exportable) $Doc->ExportField($this->cod_contacto_03);
						if ($this->tipo_garant_01->Exportable) $Doc->ExportField($this->tipo_garant_01);
						if ($this->tipo_garant_02->Exportable) $Doc->ExportField($this->tipo_garant_02);
						if ($this->tipo_garant_03->Exportable) $Doc->ExportField($this->tipo_garant_03);
						if ($this->monto_garant_01->Exportable) $Doc->ExportField($this->monto_garant_01);
						if ($this->monto_garant_02->Exportable) $Doc->ExportField($this->monto_garant_02);
						if ($this->monto_garant_03->Exportable) $Doc->ExportField($this->monto_garant_03);
						if ($this->estado_garant_01->Exportable) $Doc->ExportField($this->estado_garant_01);
						if ($this->estado_garant_02->Exportable) $Doc->ExportField($this->estado_garant_02);
						if ($this->estado_garant_03->Exportable) $Doc->ExportField($this->estado_garant_03);
						if ($this->fecha_venc_01->Exportable) $Doc->ExportField($this->fecha_venc_01);
						if ($this->fecha_venc_02->Exportable) $Doc->ExportField($this->fecha_venc_02);
						if ($this->fecha_venc_03->Exportable) $Doc->ExportField($this->fecha_venc_03);
						if ($this->geo_latitud->Exportable) $Doc->ExportField($this->geo_latitud);
						if ($this->geo_longitud->Exportable) $Doc->ExportField($this->geo_longitud);
						if ($this->geo_lati_final->Exportable) $Doc->ExportField($this->geo_lati_final);
						if ($this->geo_long_final->Exportable) $Doc->ExportField($this->geo_long_final);
						if ($this->fecha_inicio->Exportable) $Doc->ExportField($this->fecha_inicio);
						if ($this->estado_sol->Exportable) $Doc->ExportField($this->estado_sol);
						if ($this->fecha_registro->Exportable) $Doc->ExportField($this->fecha_registro);
						if ($this->user_registro->Exportable) $Doc->ExportField($this->user_registro);
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
