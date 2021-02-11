<?php

// Global variable for table object
$cs_proyecto = NULL;

//
// Table class for cs_proyecto
//
class ccs_proyecto extends cTable {
	var $idProyecto;
	var $idPrograma;
	var $codigo;
	var $nombre_proyecto;
	var $idUbicacion;
	var $idRegion;
	var $idDepto;
	var $idTramo;
	var $idRuta;
	var $idTipoRed;
	var $idProposito;
	var $descrip;
	var $presupuesto;
	var $especiplano;
	var $presuprogra;
	var $estudiofact;
	var $estudioimpact;
	var $licambi;
	var $estuimpactierra;
	var $planreasea;
	var $plananual;
	var $acuerdofinan;
	var $otro;
	var $fechacreacion;
	var $estado;
	var $idFuncionario;
	var $fechaaprob;
	var $idfuente;
	var $codsefin;
	var $notaprioridad;
	var $constanciabanco;
	var $fecharecibido;
	var $clase;
	var $entes;
	var $idRol;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_proyecto';
		$this->TableName = 'cs_proyecto';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_proyecto`";
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

		// idProyecto
		$this->idProyecto = new cField('cs_proyecto', 'cs_proyecto', 'x_idProyecto', 'idProyecto', '`idProyecto`', '`idProyecto`', 3, -1, FALSE, '`idProyecto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idProyecto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idProyecto'] = &$this->idProyecto;

		// idPrograma
		$this->idPrograma = new cField('cs_proyecto', 'cs_proyecto', 'x_idPrograma', 'idPrograma', '`idPrograma`', '`idPrograma`', 3, -1, FALSE, '`idPrograma`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idPrograma->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idPrograma'] = &$this->idPrograma;

		// codigo
		$this->codigo = new cField('cs_proyecto', 'cs_proyecto', 'x_codigo', 'codigo', '`codigo`', '`codigo`', 200, -1, FALSE, '`codigo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['codigo'] = &$this->codigo;

		// nombre_proyecto
		$this->nombre_proyecto = new cField('cs_proyecto', 'cs_proyecto', 'x_nombre_proyecto', 'nombre_proyecto', '`nombre_proyecto`', '`nombre_proyecto`', 201, -1, FALSE, '`nombre_proyecto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['nombre_proyecto'] = &$this->nombre_proyecto;

		// idUbicacion
		$this->idUbicacion = new cField('cs_proyecto', 'cs_proyecto', 'x_idUbicacion', 'idUbicacion', '`idUbicacion`', '`idUbicacion`', 3, -1, FALSE, '`idUbicacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idUbicacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idUbicacion'] = &$this->idUbicacion;

		// idRegion
		$this->idRegion = new cField('cs_proyecto', 'cs_proyecto', 'x_idRegion', 'idRegion', '`idRegion`', '`idRegion`', 3, -1, FALSE, '`idRegion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idRegion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idRegion'] = &$this->idRegion;

		// idDepto
		$this->idDepto = new cField('cs_proyecto', 'cs_proyecto', 'x_idDepto', 'idDepto', '`idDepto`', '`idDepto`', 3, -1, FALSE, '`idDepto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idDepto->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idDepto'] = &$this->idDepto;

		// idTramo
		$this->idTramo = new cField('cs_proyecto', 'cs_proyecto', 'x_idTramo', 'idTramo', '`idTramo`', '`idTramo`', 3, -1, FALSE, '`idTramo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idTramo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idTramo'] = &$this->idTramo;

		// idRuta
		$this->idRuta = new cField('cs_proyecto', 'cs_proyecto', 'x_idRuta', 'idRuta', '`idRuta`', '`idRuta`', 3, -1, FALSE, '`idRuta`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idRuta->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idRuta'] = &$this->idRuta;

		// idTipoRed
		$this->idTipoRed = new cField('cs_proyecto', 'cs_proyecto', 'x_idTipoRed', 'idTipoRed', '`idTipoRed`', '`idTipoRed`', 3, -1, FALSE, '`idTipoRed`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idTipoRed->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idTipoRed'] = &$this->idTipoRed;

		// idProposito
		$this->idProposito = new cField('cs_proyecto', 'cs_proyecto', 'x_idProposito', 'idProposito', '`idProposito`', '`idProposito`', 3, -1, FALSE, '`idProposito`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idProposito->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idProposito'] = &$this->idProposito;

		// descrip
		$this->descrip = new cField('cs_proyecto', 'cs_proyecto', 'x_descrip', 'descrip', '`descrip`', '`descrip`', 201, -1, FALSE, '`descrip`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['descrip'] = &$this->descrip;

		// presupuesto
		$this->presupuesto = new cField('cs_proyecto', 'cs_proyecto', 'x_presupuesto', 'presupuesto', '`presupuesto`', '`presupuesto`', 5, -1, FALSE, '`presupuesto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->presupuesto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['presupuesto'] = &$this->presupuesto;

		// especiplano
		$this->especiplano = new cField('cs_proyecto', 'cs_proyecto', 'x_especiplano', 'especiplano', '`especiplano`', '`especiplano`', 200, -1, FALSE, '`especiplano`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['especiplano'] = &$this->especiplano;

		// presuprogra
		$this->presuprogra = new cField('cs_proyecto', 'cs_proyecto', 'x_presuprogra', 'presuprogra', '`presuprogra`', '`presuprogra`', 200, -1, FALSE, '`presuprogra`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['presuprogra'] = &$this->presuprogra;

		// estudiofact
		$this->estudiofact = new cField('cs_proyecto', 'cs_proyecto', 'x_estudiofact', 'estudiofact', '`estudiofact`', '`estudiofact`', 200, -1, FALSE, '`estudiofact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estudiofact'] = &$this->estudiofact;

		// estudioimpact
		$this->estudioimpact = new cField('cs_proyecto', 'cs_proyecto', 'x_estudioimpact', 'estudioimpact', '`estudioimpact`', '`estudioimpact`', 200, -1, FALSE, '`estudioimpact`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estudioimpact'] = &$this->estudioimpact;

		// licambi
		$this->licambi = new cField('cs_proyecto', 'cs_proyecto', 'x_licambi', 'licambi', '`licambi`', '`licambi`', 200, -1, FALSE, '`licambi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['licambi'] = &$this->licambi;

		// estuimpactierra
		$this->estuimpactierra = new cField('cs_proyecto', 'cs_proyecto', 'x_estuimpactierra', 'estuimpactierra', '`estuimpactierra`', '`estuimpactierra`', 200, -1, FALSE, '`estuimpactierra`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estuimpactierra'] = &$this->estuimpactierra;

		// planreasea
		$this->planreasea = new cField('cs_proyecto', 'cs_proyecto', 'x_planreasea', 'planreasea', '`planreasea`', '`planreasea`', 200, -1, FALSE, '`planreasea`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['planreasea'] = &$this->planreasea;

		// plananual
		$this->plananual = new cField('cs_proyecto', 'cs_proyecto', 'x_plananual', 'plananual', '`plananual`', '`plananual`', 200, -1, FALSE, '`plananual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['plananual'] = &$this->plananual;

		// acuerdofinan
		$this->acuerdofinan = new cField('cs_proyecto', 'cs_proyecto', 'x_acuerdofinan', 'acuerdofinan', '`acuerdofinan`', '`acuerdofinan`', 200, -1, FALSE, '`acuerdofinan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['acuerdofinan'] = &$this->acuerdofinan;

		// otro
		$this->otro = new cField('cs_proyecto', 'cs_proyecto', 'x_otro', 'otro', '`otro`', '`otro`', 200, -1, FALSE, '`otro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro'] = &$this->otro;

		// fechacreacion
		$this->fechacreacion = new cField('cs_proyecto', 'cs_proyecto', 'x_fechacreacion', 'fechacreacion', '`fechacreacion`', '`fechacreacion`', 200, -1, FALSE, '`fechacreacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechacreacion'] = &$this->fechacreacion;

		// estado
		$this->estado = new cField('cs_proyecto', 'cs_proyecto', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// idFuncionario
		$this->idFuncionario = new cField('cs_proyecto', 'cs_proyecto', 'x_idFuncionario', 'idFuncionario', '`idFuncionario`', '`idFuncionario`', 3, -1, FALSE, '`idFuncionario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idFuncionario->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idFuncionario'] = &$this->idFuncionario;

		// fechaaprob
		$this->fechaaprob = new cField('cs_proyecto', 'cs_proyecto', 'x_fechaaprob', 'fechaaprob', '`fechaaprob`', '`fechaaprob`', 200, -1, FALSE, '`fechaaprob`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechaaprob'] = &$this->fechaaprob;

		// idfuente
		$this->idfuente = new cField('cs_proyecto', 'cs_proyecto', 'x_idfuente', 'idfuente', '`idfuente`', '`idfuente`', 3, -1, FALSE, '`idfuente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idfuente->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idfuente'] = &$this->idfuente;

		// codsefin
		$this->codsefin = new cField('cs_proyecto', 'cs_proyecto', 'x_codsefin', 'codsefin', '`codsefin`', '`codsefin`', 200, -1, FALSE, '`codsefin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['codsefin'] = &$this->codsefin;

		// notaprioridad
		$this->notaprioridad = new cField('cs_proyecto', 'cs_proyecto', 'x_notaprioridad', 'notaprioridad', '`notaprioridad`', '`notaprioridad`', 200, -1, FALSE, '`notaprioridad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['notaprioridad'] = &$this->notaprioridad;

		// constanciabanco
		$this->constanciabanco = new cField('cs_proyecto', 'cs_proyecto', 'x_constanciabanco', 'constanciabanco', '`constanciabanco`', '`constanciabanco`', 200, -1, FALSE, '`constanciabanco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['constanciabanco'] = &$this->constanciabanco;

		// fecharecibido
		$this->fecharecibido = new cField('cs_proyecto', 'cs_proyecto', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', '`fecharecibido`', 200, -1, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecharecibido'] = &$this->fecharecibido;

		// clase
		$this->clase = new cField('cs_proyecto', 'cs_proyecto', 'x_clase', 'clase', '`clase`', '`clase`', 200, -1, FALSE, '`clase`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['clase'] = &$this->clase;

		// entes
		$this->entes = new cField('cs_proyecto', 'cs_proyecto', 'x_entes', 'entes', '`entes`', '`entes`', 200, -1, FALSE, '`entes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['entes'] = &$this->entes;

		// idRol
		$this->idRol = new cField('cs_proyecto', 'cs_proyecto', 'x_idRol', 'idRol', '`idRol`', '`idRol`', 3, -1, FALSE, '`idRol`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idRol->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idRol'] = &$this->idRol;
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
		if ($this->getCurrentMasterTable() == "cs_programa") {
			if ($this->idPrograma->getSessionValue() <> "")
				$sMasterFilter .= "`idPrograma`=" . ew_QuotedValue($this->idPrograma->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "cs_programa") {
			if ($this->idPrograma->getSessionValue() <> "")
				$sDetailFilter .= "`idPrograma`=" . ew_QuotedValue($this->idPrograma->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_cs_programa() {
		return "`idPrograma`=@idPrograma@";
	}

	// Detail filter
	function SqlDetailFilter_cs_programa() {
		return "`idPrograma`=@idPrograma@";
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
		if ($this->getCurrentDetailTable() == "cs_calificacion") {
			$sDetailUrl = $GLOBALS["cs_calificacion"]->GetListUrl() . "?showmaster=" . $this->TableVar;
			$sDetailUrl .= "&fk_idProyecto=" . urlencode($this->idProyecto->CurrentValue);
		}
		if ($sDetailUrl == "") {
			$sDetailUrl = "cs_proyectolist.php";
		}
		return $sDetailUrl;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_proyecto`";
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
			if (array_key_exists('idProyecto', $rs))
				ew_AddFilter($where, ew_QuotedName('idProyecto', $this->DBID) . '=' . ew_QuotedValue($rs['idProyecto'], $this->idProyecto->FldDataType, $this->DBID));
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
		return "`idProyecto` = @idProyecto@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idProyecto->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idProyecto@", ew_AdjustSql($this->idProyecto->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_proyectolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_proyectolist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_proyectoview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_proyectoview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_proyectoadd.php?" . $this->UrlParm($parm);
		else
			return "cs_proyectoadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_proyectoedit.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_proyectoedit.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_proyectoadd.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_proyectoadd.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_proyectodelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "idProyecto:" . ew_VarToJson($this->idProyecto->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idProyecto->CurrentValue)) {
			$sUrl .= "idProyecto=" . urlencode($this->idProyecto->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["idProyecto"]) : ew_StripSlashes(@$_GET["idProyecto"]); // idProyecto

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
			$this->idProyecto->CurrentValue = $key;
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
		$this->idProyecto->setDbValue($rs->fields('idProyecto'));
		$this->idPrograma->setDbValue($rs->fields('idPrograma'));
		$this->codigo->setDbValue($rs->fields('codigo'));
		$this->nombre_proyecto->setDbValue($rs->fields('nombre_proyecto'));
		$this->idUbicacion->setDbValue($rs->fields('idUbicacion'));
		$this->idRegion->setDbValue($rs->fields('idRegion'));
		$this->idDepto->setDbValue($rs->fields('idDepto'));
		$this->idTramo->setDbValue($rs->fields('idTramo'));
		$this->idRuta->setDbValue($rs->fields('idRuta'));
		$this->idTipoRed->setDbValue($rs->fields('idTipoRed'));
		$this->idProposito->setDbValue($rs->fields('idProposito'));
		$this->descrip->setDbValue($rs->fields('descrip'));
		$this->presupuesto->setDbValue($rs->fields('presupuesto'));
		$this->especiplano->setDbValue($rs->fields('especiplano'));
		$this->presuprogra->setDbValue($rs->fields('presuprogra'));
		$this->estudiofact->setDbValue($rs->fields('estudiofact'));
		$this->estudioimpact->setDbValue($rs->fields('estudioimpact'));
		$this->licambi->setDbValue($rs->fields('licambi'));
		$this->estuimpactierra->setDbValue($rs->fields('estuimpactierra'));
		$this->planreasea->setDbValue($rs->fields('planreasea'));
		$this->plananual->setDbValue($rs->fields('plananual'));
		$this->acuerdofinan->setDbValue($rs->fields('acuerdofinan'));
		$this->otro->setDbValue($rs->fields('otro'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->idFuncionario->setDbValue($rs->fields('idFuncionario'));
		$this->fechaaprob->setDbValue($rs->fields('fechaaprob'));
		$this->idfuente->setDbValue($rs->fields('idfuente'));
		$this->codsefin->setDbValue($rs->fields('codsefin'));
		$this->notaprioridad->setDbValue($rs->fields('notaprioridad'));
		$this->constanciabanco->setDbValue($rs->fields('constanciabanco'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->clase->setDbValue($rs->fields('clase'));
		$this->entes->setDbValue($rs->fields('entes'));
		$this->idRol->setDbValue($rs->fields('idRol'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idProyecto
		// idPrograma
		// codigo
		// nombre_proyecto
		// idUbicacion
		// idRegion
		// idDepto
		// idTramo
		// idRuta
		// idTipoRed
		// idProposito
		// descrip
		// presupuesto
		// especiplano
		// presuprogra
		// estudiofact
		// estudioimpact
		// licambi
		// estuimpactierra
		// planreasea
		// plananual
		// acuerdofinan
		// otro
		// fechacreacion
		// estado
		// idFuncionario
		// fechaaprob
		// idfuente
		// codsefin
		// notaprioridad
		// constanciabanco
		// fecharecibido
		// clase
		// entes
		// idRol
		// idProyecto

		$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";

		// idPrograma
		$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->ViewCustomAttributes = "";

		// codigo
		$this->codigo->ViewValue = $this->codigo->CurrentValue;
		$this->codigo->ViewCustomAttributes = "";

		// nombre_proyecto
		$this->nombre_proyecto->ViewValue = $this->nombre_proyecto->CurrentValue;
		$this->nombre_proyecto->ViewCustomAttributes = "";

		// idUbicacion
		$this->idUbicacion->ViewValue = $this->idUbicacion->CurrentValue;
		$this->idUbicacion->ViewCustomAttributes = "";

		// idRegion
		$this->idRegion->ViewValue = $this->idRegion->CurrentValue;
		$this->idRegion->ViewCustomAttributes = "";

		// idDepto
		$this->idDepto->ViewValue = $this->idDepto->CurrentValue;
		$this->idDepto->ViewCustomAttributes = "";

		// idTramo
		$this->idTramo->ViewValue = $this->idTramo->CurrentValue;
		$this->idTramo->ViewCustomAttributes = "";

		// idRuta
		$this->idRuta->ViewValue = $this->idRuta->CurrentValue;
		$this->idRuta->ViewCustomAttributes = "";

		// idTipoRed
		$this->idTipoRed->ViewValue = $this->idTipoRed->CurrentValue;
		$this->idTipoRed->ViewCustomAttributes = "";

		// idProposito
		$this->idProposito->ViewValue = $this->idProposito->CurrentValue;
		$this->idProposito->ViewCustomAttributes = "";

		// descrip
		$this->descrip->ViewValue = $this->descrip->CurrentValue;
		$this->descrip->ViewCustomAttributes = "";

		// presupuesto
		$this->presupuesto->ViewValue = $this->presupuesto->CurrentValue;
		$this->presupuesto->ViewCustomAttributes = "";

		// especiplano
		$this->especiplano->ViewValue = $this->especiplano->CurrentValue;
		$this->especiplano->ViewCustomAttributes = "";

		// presuprogra
		$this->presuprogra->ViewValue = $this->presuprogra->CurrentValue;
		$this->presuprogra->ViewCustomAttributes = "";

		// estudiofact
		$this->estudiofact->ViewValue = $this->estudiofact->CurrentValue;
		$this->estudiofact->ViewCustomAttributes = "";

		// estudioimpact
		$this->estudioimpact->ViewValue = $this->estudioimpact->CurrentValue;
		$this->estudioimpact->ViewCustomAttributes = "";

		// licambi
		$this->licambi->ViewValue = $this->licambi->CurrentValue;
		$this->licambi->ViewCustomAttributes = "";

		// estuimpactierra
		$this->estuimpactierra->ViewValue = $this->estuimpactierra->CurrentValue;
		$this->estuimpactierra->ViewCustomAttributes = "";

		// planreasea
		$this->planreasea->ViewValue = $this->planreasea->CurrentValue;
		$this->planreasea->ViewCustomAttributes = "";

		// plananual
		$this->plananual->ViewValue = $this->plananual->CurrentValue;
		$this->plananual->ViewCustomAttributes = "";

		// acuerdofinan
		$this->acuerdofinan->ViewValue = $this->acuerdofinan->CurrentValue;
		$this->acuerdofinan->ViewCustomAttributes = "";

		// otro
		$this->otro->ViewValue = $this->otro->CurrentValue;
		$this->otro->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// idFuncionario
		$this->idFuncionario->ViewValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->ViewCustomAttributes = "";

		// fechaaprob
		$this->fechaaprob->ViewValue = $this->fechaaprob->CurrentValue;
		$this->fechaaprob->ViewCustomAttributes = "";

		// idfuente
		$this->idfuente->ViewValue = $this->idfuente->CurrentValue;
		$this->idfuente->ViewCustomAttributes = "";

		// codsefin
		$this->codsefin->ViewValue = $this->codsefin->CurrentValue;
		$this->codsefin->ViewCustomAttributes = "";

		// notaprioridad
		$this->notaprioridad->ViewValue = $this->notaprioridad->CurrentValue;
		$this->notaprioridad->ViewCustomAttributes = "";

		// constanciabanco
		$this->constanciabanco->ViewValue = $this->constanciabanco->CurrentValue;
		$this->constanciabanco->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// clase
		$this->clase->ViewValue = $this->clase->CurrentValue;
		$this->clase->ViewCustomAttributes = "";

		// entes
		$this->entes->ViewValue = $this->entes->CurrentValue;
		$this->entes->ViewCustomAttributes = "";

		// idRol
		$this->idRol->ViewValue = $this->idRol->CurrentValue;
		$this->idRol->ViewCustomAttributes = "";

		// idProyecto
		$this->idProyecto->LinkCustomAttributes = "";
		$this->idProyecto->HrefValue = "";
		$this->idProyecto->TooltipValue = "";

		// idPrograma
		$this->idPrograma->LinkCustomAttributes = "";
		$this->idPrograma->HrefValue = "";
		$this->idPrograma->TooltipValue = "";

		// codigo
		$this->codigo->LinkCustomAttributes = "";
		$this->codigo->HrefValue = "";
		$this->codigo->TooltipValue = "";

		// nombre_proyecto
		$this->nombre_proyecto->LinkCustomAttributes = "";
		$this->nombre_proyecto->HrefValue = "";
		$this->nombre_proyecto->TooltipValue = "";

		// idUbicacion
		$this->idUbicacion->LinkCustomAttributes = "";
		$this->idUbicacion->HrefValue = "";
		$this->idUbicacion->TooltipValue = "";

		// idRegion
		$this->idRegion->LinkCustomAttributes = "";
		$this->idRegion->HrefValue = "";
		$this->idRegion->TooltipValue = "";

		// idDepto
		$this->idDepto->LinkCustomAttributes = "";
		$this->idDepto->HrefValue = "";
		$this->idDepto->TooltipValue = "";

		// idTramo
		$this->idTramo->LinkCustomAttributes = "";
		$this->idTramo->HrefValue = "";
		$this->idTramo->TooltipValue = "";

		// idRuta
		$this->idRuta->LinkCustomAttributes = "";
		$this->idRuta->HrefValue = "";
		$this->idRuta->TooltipValue = "";

		// idTipoRed
		$this->idTipoRed->LinkCustomAttributes = "";
		$this->idTipoRed->HrefValue = "";
		$this->idTipoRed->TooltipValue = "";

		// idProposito
		$this->idProposito->LinkCustomAttributes = "";
		$this->idProposito->HrefValue = "";
		$this->idProposito->TooltipValue = "";

		// descrip
		$this->descrip->LinkCustomAttributes = "";
		$this->descrip->HrefValue = "";
		$this->descrip->TooltipValue = "";

		// presupuesto
		$this->presupuesto->LinkCustomAttributes = "";
		$this->presupuesto->HrefValue = "";
		$this->presupuesto->TooltipValue = "";

		// especiplano
		$this->especiplano->LinkCustomAttributes = "";
		$this->especiplano->HrefValue = "";
		$this->especiplano->TooltipValue = "";

		// presuprogra
		$this->presuprogra->LinkCustomAttributes = "";
		$this->presuprogra->HrefValue = "";
		$this->presuprogra->TooltipValue = "";

		// estudiofact
		$this->estudiofact->LinkCustomAttributes = "";
		$this->estudiofact->HrefValue = "";
		$this->estudiofact->TooltipValue = "";

		// estudioimpact
		$this->estudioimpact->LinkCustomAttributes = "";
		$this->estudioimpact->HrefValue = "";
		$this->estudioimpact->TooltipValue = "";

		// licambi
		$this->licambi->LinkCustomAttributes = "";
		$this->licambi->HrefValue = "";
		$this->licambi->TooltipValue = "";

		// estuimpactierra
		$this->estuimpactierra->LinkCustomAttributes = "";
		$this->estuimpactierra->HrefValue = "";
		$this->estuimpactierra->TooltipValue = "";

		// planreasea
		$this->planreasea->LinkCustomAttributes = "";
		$this->planreasea->HrefValue = "";
		$this->planreasea->TooltipValue = "";

		// plananual
		$this->plananual->LinkCustomAttributes = "";
		$this->plananual->HrefValue = "";
		$this->plananual->TooltipValue = "";

		// acuerdofinan
		$this->acuerdofinan->LinkCustomAttributes = "";
		$this->acuerdofinan->HrefValue = "";
		$this->acuerdofinan->TooltipValue = "";

		// otro
		$this->otro->LinkCustomAttributes = "";
		$this->otro->HrefValue = "";
		$this->otro->TooltipValue = "";

		// fechacreacion
		$this->fechacreacion->LinkCustomAttributes = "";
		$this->fechacreacion->HrefValue = "";
		$this->fechacreacion->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// idFuncionario
		$this->idFuncionario->LinkCustomAttributes = "";
		$this->idFuncionario->HrefValue = "";
		$this->idFuncionario->TooltipValue = "";

		// fechaaprob
		$this->fechaaprob->LinkCustomAttributes = "";
		$this->fechaaprob->HrefValue = "";
		$this->fechaaprob->TooltipValue = "";

		// idfuente
		$this->idfuente->LinkCustomAttributes = "";
		$this->idfuente->HrefValue = "";
		$this->idfuente->TooltipValue = "";

		// codsefin
		$this->codsefin->LinkCustomAttributes = "";
		$this->codsefin->HrefValue = "";
		$this->codsefin->TooltipValue = "";

		// notaprioridad
		$this->notaprioridad->LinkCustomAttributes = "";
		$this->notaprioridad->HrefValue = "";
		$this->notaprioridad->TooltipValue = "";

		// constanciabanco
		$this->constanciabanco->LinkCustomAttributes = "";
		$this->constanciabanco->HrefValue = "";
		$this->constanciabanco->TooltipValue = "";

		// fecharecibido
		$this->fecharecibido->LinkCustomAttributes = "";
		$this->fecharecibido->HrefValue = "";
		$this->fecharecibido->TooltipValue = "";

		// clase
		$this->clase->LinkCustomAttributes = "";
		$this->clase->HrefValue = "";
		$this->clase->TooltipValue = "";

		// entes
		$this->entes->LinkCustomAttributes = "";
		$this->entes->HrefValue = "";
		$this->entes->TooltipValue = "";

		// idRol
		$this->idRol->LinkCustomAttributes = "";
		$this->idRol->HrefValue = "";
		$this->idRol->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// idProyecto
		$this->idProyecto->EditAttrs["class"] = "form-control";
		$this->idProyecto->EditCustomAttributes = "";
		$this->idProyecto->EditValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";

		// idPrograma
		$this->idPrograma->EditAttrs["class"] = "form-control";
		$this->idPrograma->EditCustomAttributes = "";
		if ($this->idPrograma->getSessionValue() <> "") {
			$this->idPrograma->CurrentValue = $this->idPrograma->getSessionValue();
		$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->ViewCustomAttributes = "";
		} else {
		$this->idPrograma->EditValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->PlaceHolder = ew_RemoveHtml($this->idPrograma->FldCaption());
		}

		// codigo
		$this->codigo->EditAttrs["class"] = "form-control";
		$this->codigo->EditCustomAttributes = "";
		$this->codigo->EditValue = $this->codigo->CurrentValue;
		$this->codigo->PlaceHolder = ew_RemoveHtml($this->codigo->FldCaption());

		// nombre_proyecto
		$this->nombre_proyecto->EditAttrs["class"] = "form-control";
		$this->nombre_proyecto->EditCustomAttributes = "";
		$this->nombre_proyecto->EditValue = $this->nombre_proyecto->CurrentValue;
		$this->nombre_proyecto->PlaceHolder = ew_RemoveHtml($this->nombre_proyecto->FldCaption());

		// idUbicacion
		$this->idUbicacion->EditAttrs["class"] = "form-control";
		$this->idUbicacion->EditCustomAttributes = "";
		$this->idUbicacion->EditValue = $this->idUbicacion->CurrentValue;
		$this->idUbicacion->PlaceHolder = ew_RemoveHtml($this->idUbicacion->FldCaption());

		// idRegion
		$this->idRegion->EditAttrs["class"] = "form-control";
		$this->idRegion->EditCustomAttributes = "";
		$this->idRegion->EditValue = $this->idRegion->CurrentValue;
		$this->idRegion->PlaceHolder = ew_RemoveHtml($this->idRegion->FldCaption());

		// idDepto
		$this->idDepto->EditAttrs["class"] = "form-control";
		$this->idDepto->EditCustomAttributes = "";
		$this->idDepto->EditValue = $this->idDepto->CurrentValue;
		$this->idDepto->PlaceHolder = ew_RemoveHtml($this->idDepto->FldCaption());

		// idTramo
		$this->idTramo->EditAttrs["class"] = "form-control";
		$this->idTramo->EditCustomAttributes = "";
		$this->idTramo->EditValue = $this->idTramo->CurrentValue;
		$this->idTramo->PlaceHolder = ew_RemoveHtml($this->idTramo->FldCaption());

		// idRuta
		$this->idRuta->EditAttrs["class"] = "form-control";
		$this->idRuta->EditCustomAttributes = "";
		$this->idRuta->EditValue = $this->idRuta->CurrentValue;
		$this->idRuta->PlaceHolder = ew_RemoveHtml($this->idRuta->FldCaption());

		// idTipoRed
		$this->idTipoRed->EditAttrs["class"] = "form-control";
		$this->idTipoRed->EditCustomAttributes = "";
		$this->idTipoRed->EditValue = $this->idTipoRed->CurrentValue;
		$this->idTipoRed->PlaceHolder = ew_RemoveHtml($this->idTipoRed->FldCaption());

		// idProposito
		$this->idProposito->EditAttrs["class"] = "form-control";
		$this->idProposito->EditCustomAttributes = "";
		$this->idProposito->EditValue = $this->idProposito->CurrentValue;
		$this->idProposito->PlaceHolder = ew_RemoveHtml($this->idProposito->FldCaption());

		// descrip
		$this->descrip->EditAttrs["class"] = "form-control";
		$this->descrip->EditCustomAttributes = "";
		$this->descrip->EditValue = $this->descrip->CurrentValue;
		$this->descrip->PlaceHolder = ew_RemoveHtml($this->descrip->FldCaption());

		// presupuesto
		$this->presupuesto->EditAttrs["class"] = "form-control";
		$this->presupuesto->EditCustomAttributes = "";
		$this->presupuesto->EditValue = $this->presupuesto->CurrentValue;
		$this->presupuesto->PlaceHolder = ew_RemoveHtml($this->presupuesto->FldCaption());
		if (strval($this->presupuesto->EditValue) <> "" && is_numeric($this->presupuesto->EditValue)) $this->presupuesto->EditValue = ew_FormatNumber($this->presupuesto->EditValue, -2, -1, -2, 0);

		// especiplano
		$this->especiplano->EditAttrs["class"] = "form-control";
		$this->especiplano->EditCustomAttributes = "";
		$this->especiplano->EditValue = $this->especiplano->CurrentValue;
		$this->especiplano->PlaceHolder = ew_RemoveHtml($this->especiplano->FldCaption());

		// presuprogra
		$this->presuprogra->EditAttrs["class"] = "form-control";
		$this->presuprogra->EditCustomAttributes = "";
		$this->presuprogra->EditValue = $this->presuprogra->CurrentValue;
		$this->presuprogra->PlaceHolder = ew_RemoveHtml($this->presuprogra->FldCaption());

		// estudiofact
		$this->estudiofact->EditAttrs["class"] = "form-control";
		$this->estudiofact->EditCustomAttributes = "";
		$this->estudiofact->EditValue = $this->estudiofact->CurrentValue;
		$this->estudiofact->PlaceHolder = ew_RemoveHtml($this->estudiofact->FldCaption());

		// estudioimpact
		$this->estudioimpact->EditAttrs["class"] = "form-control";
		$this->estudioimpact->EditCustomAttributes = "";
		$this->estudioimpact->EditValue = $this->estudioimpact->CurrentValue;
		$this->estudioimpact->PlaceHolder = ew_RemoveHtml($this->estudioimpact->FldCaption());

		// licambi
		$this->licambi->EditAttrs["class"] = "form-control";
		$this->licambi->EditCustomAttributes = "";
		$this->licambi->EditValue = $this->licambi->CurrentValue;
		$this->licambi->PlaceHolder = ew_RemoveHtml($this->licambi->FldCaption());

		// estuimpactierra
		$this->estuimpactierra->EditAttrs["class"] = "form-control";
		$this->estuimpactierra->EditCustomAttributes = "";
		$this->estuimpactierra->EditValue = $this->estuimpactierra->CurrentValue;
		$this->estuimpactierra->PlaceHolder = ew_RemoveHtml($this->estuimpactierra->FldCaption());

		// planreasea
		$this->planreasea->EditAttrs["class"] = "form-control";
		$this->planreasea->EditCustomAttributes = "";
		$this->planreasea->EditValue = $this->planreasea->CurrentValue;
		$this->planreasea->PlaceHolder = ew_RemoveHtml($this->planreasea->FldCaption());

		// plananual
		$this->plananual->EditAttrs["class"] = "form-control";
		$this->plananual->EditCustomAttributes = "";
		$this->plananual->EditValue = $this->plananual->CurrentValue;
		$this->plananual->PlaceHolder = ew_RemoveHtml($this->plananual->FldCaption());

		// acuerdofinan
		$this->acuerdofinan->EditAttrs["class"] = "form-control";
		$this->acuerdofinan->EditCustomAttributes = "";
		$this->acuerdofinan->EditValue = $this->acuerdofinan->CurrentValue;
		$this->acuerdofinan->PlaceHolder = ew_RemoveHtml($this->acuerdofinan->FldCaption());

		// otro
		$this->otro->EditAttrs["class"] = "form-control";
		$this->otro->EditCustomAttributes = "";
		$this->otro->EditValue = $this->otro->CurrentValue;
		$this->otro->PlaceHolder = ew_RemoveHtml($this->otro->FldCaption());

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

		// idFuncionario
		$this->idFuncionario->EditAttrs["class"] = "form-control";
		$this->idFuncionario->EditCustomAttributes = "";
		$this->idFuncionario->EditValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

		// fechaaprob
		$this->fechaaprob->EditAttrs["class"] = "form-control";
		$this->fechaaprob->EditCustomAttributes = "";
		$this->fechaaprob->EditValue = $this->fechaaprob->CurrentValue;
		$this->fechaaprob->PlaceHolder = ew_RemoveHtml($this->fechaaprob->FldCaption());

		// idfuente
		$this->idfuente->EditAttrs["class"] = "form-control";
		$this->idfuente->EditCustomAttributes = "";
		$this->idfuente->EditValue = $this->idfuente->CurrentValue;
		$this->idfuente->PlaceHolder = ew_RemoveHtml($this->idfuente->FldCaption());

		// codsefin
		$this->codsefin->EditAttrs["class"] = "form-control";
		$this->codsefin->EditCustomAttributes = "";
		$this->codsefin->EditValue = $this->codsefin->CurrentValue;
		$this->codsefin->PlaceHolder = ew_RemoveHtml($this->codsefin->FldCaption());

		// notaprioridad
		$this->notaprioridad->EditAttrs["class"] = "form-control";
		$this->notaprioridad->EditCustomAttributes = "";
		$this->notaprioridad->EditValue = $this->notaprioridad->CurrentValue;
		$this->notaprioridad->PlaceHolder = ew_RemoveHtml($this->notaprioridad->FldCaption());

		// constanciabanco
		$this->constanciabanco->EditAttrs["class"] = "form-control";
		$this->constanciabanco->EditCustomAttributes = "";
		$this->constanciabanco->EditValue = $this->constanciabanco->CurrentValue;
		$this->constanciabanco->PlaceHolder = ew_RemoveHtml($this->constanciabanco->FldCaption());

		// fecharecibido
		$this->fecharecibido->EditAttrs["class"] = "form-control";
		$this->fecharecibido->EditCustomAttributes = "";
		$this->fecharecibido->EditValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

		// clase
		$this->clase->EditAttrs["class"] = "form-control";
		$this->clase->EditCustomAttributes = "";
		$this->clase->EditValue = $this->clase->CurrentValue;
		$this->clase->PlaceHolder = ew_RemoveHtml($this->clase->FldCaption());

		// entes
		$this->entes->EditAttrs["class"] = "form-control";
		$this->entes->EditCustomAttributes = "";
		$this->entes->EditValue = $this->entes->CurrentValue;
		$this->entes->PlaceHolder = ew_RemoveHtml($this->entes->FldCaption());

		// idRol
		$this->idRol->EditAttrs["class"] = "form-control";
		$this->idRol->EditCustomAttributes = "";
		$this->idRol->EditValue = $this->idRol->CurrentValue;
		$this->idRol->PlaceHolder = ew_RemoveHtml($this->idRol->FldCaption());

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
					if ($this->idProyecto->Exportable) $Doc->ExportCaption($this->idProyecto);
					if ($this->idPrograma->Exportable) $Doc->ExportCaption($this->idPrograma);
					if ($this->codigo->Exportable) $Doc->ExportCaption($this->codigo);
					if ($this->nombre_proyecto->Exportable) $Doc->ExportCaption($this->nombre_proyecto);
					if ($this->idUbicacion->Exportable) $Doc->ExportCaption($this->idUbicacion);
					if ($this->idRegion->Exportable) $Doc->ExportCaption($this->idRegion);
					if ($this->idDepto->Exportable) $Doc->ExportCaption($this->idDepto);
					if ($this->idTramo->Exportable) $Doc->ExportCaption($this->idTramo);
					if ($this->idRuta->Exportable) $Doc->ExportCaption($this->idRuta);
					if ($this->idTipoRed->Exportable) $Doc->ExportCaption($this->idTipoRed);
					if ($this->idProposito->Exportable) $Doc->ExportCaption($this->idProposito);
					if ($this->descrip->Exportable) $Doc->ExportCaption($this->descrip);
					if ($this->presupuesto->Exportable) $Doc->ExportCaption($this->presupuesto);
					if ($this->especiplano->Exportable) $Doc->ExportCaption($this->especiplano);
					if ($this->presuprogra->Exportable) $Doc->ExportCaption($this->presuprogra);
					if ($this->estudiofact->Exportable) $Doc->ExportCaption($this->estudiofact);
					if ($this->estudioimpact->Exportable) $Doc->ExportCaption($this->estudioimpact);
					if ($this->licambi->Exportable) $Doc->ExportCaption($this->licambi);
					if ($this->estuimpactierra->Exportable) $Doc->ExportCaption($this->estuimpactierra);
					if ($this->planreasea->Exportable) $Doc->ExportCaption($this->planreasea);
					if ($this->plananual->Exportable) $Doc->ExportCaption($this->plananual);
					if ($this->acuerdofinan->Exportable) $Doc->ExportCaption($this->acuerdofinan);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->idFuncionario->Exportable) $Doc->ExportCaption($this->idFuncionario);
					if ($this->fechaaprob->Exportable) $Doc->ExportCaption($this->fechaaprob);
					if ($this->idfuente->Exportable) $Doc->ExportCaption($this->idfuente);
					if ($this->codsefin->Exportable) $Doc->ExportCaption($this->codsefin);
					if ($this->notaprioridad->Exportable) $Doc->ExportCaption($this->notaprioridad);
					if ($this->constanciabanco->Exportable) $Doc->ExportCaption($this->constanciabanco);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->clase->Exportable) $Doc->ExportCaption($this->clase);
					if ($this->entes->Exportable) $Doc->ExportCaption($this->entes);
					if ($this->idRol->Exportable) $Doc->ExportCaption($this->idRol);
				} else {
					if ($this->idProyecto->Exportable) $Doc->ExportCaption($this->idProyecto);
					if ($this->idPrograma->Exportable) $Doc->ExportCaption($this->idPrograma);
					if ($this->codigo->Exportable) $Doc->ExportCaption($this->codigo);
					if ($this->idUbicacion->Exportable) $Doc->ExportCaption($this->idUbicacion);
					if ($this->idRegion->Exportable) $Doc->ExportCaption($this->idRegion);
					if ($this->idDepto->Exportable) $Doc->ExportCaption($this->idDepto);
					if ($this->idTramo->Exportable) $Doc->ExportCaption($this->idTramo);
					if ($this->idRuta->Exportable) $Doc->ExportCaption($this->idRuta);
					if ($this->idTipoRed->Exportable) $Doc->ExportCaption($this->idTipoRed);
					if ($this->idProposito->Exportable) $Doc->ExportCaption($this->idProposito);
					if ($this->presupuesto->Exportable) $Doc->ExportCaption($this->presupuesto);
					if ($this->especiplano->Exportable) $Doc->ExportCaption($this->especiplano);
					if ($this->presuprogra->Exportable) $Doc->ExportCaption($this->presuprogra);
					if ($this->estudiofact->Exportable) $Doc->ExportCaption($this->estudiofact);
					if ($this->estudioimpact->Exportable) $Doc->ExportCaption($this->estudioimpact);
					if ($this->licambi->Exportable) $Doc->ExportCaption($this->licambi);
					if ($this->estuimpactierra->Exportable) $Doc->ExportCaption($this->estuimpactierra);
					if ($this->planreasea->Exportable) $Doc->ExportCaption($this->planreasea);
					if ($this->plananual->Exportable) $Doc->ExportCaption($this->plananual);
					if ($this->acuerdofinan->Exportable) $Doc->ExportCaption($this->acuerdofinan);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->idFuncionario->Exportable) $Doc->ExportCaption($this->idFuncionario);
					if ($this->fechaaprob->Exportable) $Doc->ExportCaption($this->fechaaprob);
					if ($this->idfuente->Exportable) $Doc->ExportCaption($this->idfuente);
					if ($this->codsefin->Exportable) $Doc->ExportCaption($this->codsefin);
					if ($this->notaprioridad->Exportable) $Doc->ExportCaption($this->notaprioridad);
					if ($this->constanciabanco->Exportable) $Doc->ExportCaption($this->constanciabanco);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->clase->Exportable) $Doc->ExportCaption($this->clase);
					if ($this->entes->Exportable) $Doc->ExportCaption($this->entes);
					if ($this->idRol->Exportable) $Doc->ExportCaption($this->idRol);
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
						if ($this->idProyecto->Exportable) $Doc->ExportField($this->idProyecto);
						if ($this->idPrograma->Exportable) $Doc->ExportField($this->idPrograma);
						if ($this->codigo->Exportable) $Doc->ExportField($this->codigo);
						if ($this->nombre_proyecto->Exportable) $Doc->ExportField($this->nombre_proyecto);
						if ($this->idUbicacion->Exportable) $Doc->ExportField($this->idUbicacion);
						if ($this->idRegion->Exportable) $Doc->ExportField($this->idRegion);
						if ($this->idDepto->Exportable) $Doc->ExportField($this->idDepto);
						if ($this->idTramo->Exportable) $Doc->ExportField($this->idTramo);
						if ($this->idRuta->Exportable) $Doc->ExportField($this->idRuta);
						if ($this->idTipoRed->Exportable) $Doc->ExportField($this->idTipoRed);
						if ($this->idProposito->Exportable) $Doc->ExportField($this->idProposito);
						if ($this->descrip->Exportable) $Doc->ExportField($this->descrip);
						if ($this->presupuesto->Exportable) $Doc->ExportField($this->presupuesto);
						if ($this->especiplano->Exportable) $Doc->ExportField($this->especiplano);
						if ($this->presuprogra->Exportable) $Doc->ExportField($this->presuprogra);
						if ($this->estudiofact->Exportable) $Doc->ExportField($this->estudiofact);
						if ($this->estudioimpact->Exportable) $Doc->ExportField($this->estudioimpact);
						if ($this->licambi->Exportable) $Doc->ExportField($this->licambi);
						if ($this->estuimpactierra->Exportable) $Doc->ExportField($this->estuimpactierra);
						if ($this->planreasea->Exportable) $Doc->ExportField($this->planreasea);
						if ($this->plananual->Exportable) $Doc->ExportField($this->plananual);
						if ($this->acuerdofinan->Exportable) $Doc->ExportField($this->acuerdofinan);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->idFuncionario->Exportable) $Doc->ExportField($this->idFuncionario);
						if ($this->fechaaprob->Exportable) $Doc->ExportField($this->fechaaprob);
						if ($this->idfuente->Exportable) $Doc->ExportField($this->idfuente);
						if ($this->codsefin->Exportable) $Doc->ExportField($this->codsefin);
						if ($this->notaprioridad->Exportable) $Doc->ExportField($this->notaprioridad);
						if ($this->constanciabanco->Exportable) $Doc->ExportField($this->constanciabanco);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->clase->Exportable) $Doc->ExportField($this->clase);
						if ($this->entes->Exportable) $Doc->ExportField($this->entes);
						if ($this->idRol->Exportable) $Doc->ExportField($this->idRol);
					} else {
						if ($this->idProyecto->Exportable) $Doc->ExportField($this->idProyecto);
						if ($this->idPrograma->Exportable) $Doc->ExportField($this->idPrograma);
						if ($this->codigo->Exportable) $Doc->ExportField($this->codigo);
						if ($this->idUbicacion->Exportable) $Doc->ExportField($this->idUbicacion);
						if ($this->idRegion->Exportable) $Doc->ExportField($this->idRegion);
						if ($this->idDepto->Exportable) $Doc->ExportField($this->idDepto);
						if ($this->idTramo->Exportable) $Doc->ExportField($this->idTramo);
						if ($this->idRuta->Exportable) $Doc->ExportField($this->idRuta);
						if ($this->idTipoRed->Exportable) $Doc->ExportField($this->idTipoRed);
						if ($this->idProposito->Exportable) $Doc->ExportField($this->idProposito);
						if ($this->presupuesto->Exportable) $Doc->ExportField($this->presupuesto);
						if ($this->especiplano->Exportable) $Doc->ExportField($this->especiplano);
						if ($this->presuprogra->Exportable) $Doc->ExportField($this->presuprogra);
						if ($this->estudiofact->Exportable) $Doc->ExportField($this->estudiofact);
						if ($this->estudioimpact->Exportable) $Doc->ExportField($this->estudioimpact);
						if ($this->licambi->Exportable) $Doc->ExportField($this->licambi);
						if ($this->estuimpactierra->Exportable) $Doc->ExportField($this->estuimpactierra);
						if ($this->planreasea->Exportable) $Doc->ExportField($this->planreasea);
						if ($this->plananual->Exportable) $Doc->ExportField($this->plananual);
						if ($this->acuerdofinan->Exportable) $Doc->ExportField($this->acuerdofinan);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->idFuncionario->Exportable) $Doc->ExportField($this->idFuncionario);
						if ($this->fechaaprob->Exportable) $Doc->ExportField($this->fechaaprob);
						if ($this->idfuente->Exportable) $Doc->ExportField($this->idfuente);
						if ($this->codsefin->Exportable) $Doc->ExportField($this->codsefin);
						if ($this->notaprioridad->Exportable) $Doc->ExportField($this->notaprioridad);
						if ($this->constanciabanco->Exportable) $Doc->ExportField($this->constanciabanco);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->clase->Exportable) $Doc->ExportField($this->clase);
						if ($this->entes->Exportable) $Doc->ExportField($this->entes);
						if ($this->idRol->Exportable) $Doc->ExportField($this->idRol);
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
