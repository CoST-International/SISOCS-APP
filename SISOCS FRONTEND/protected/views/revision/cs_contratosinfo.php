<?php

// Global variable for table object
$cs_contratos = NULL;

//
// Table class for cs_contratos
//
class ccs_contratos extends cTable {
	var $idContratos;
	var $idContratacion;
	var $estatuscontrato;
	var $nmodifica;
	var $fecha;
	var $tipomodifica;
	var $justimodcontrato;
	var $precioactual;
	var $fechatercontra;
	var $alcanceactucontrato;
	var $detallesreadju;
	var $prograini;
	var $adendas;
	var $prograactu;
	var $estado;
	var $otro;
	var $fecharecibido;
	var $fechacreacion;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cs_contratos';
		$this->TableName = 'cs_contratos';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cs_contratos`";
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

		// idContratos
		$this->idContratos = new cField('cs_contratos', 'cs_contratos', 'x_idContratos', 'idContratos', '`idContratos`', '`idContratos`', 3, -1, FALSE, '`idContratos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idContratos->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratos'] = &$this->idContratos;

		// idContratacion
		$this->idContratacion = new cField('cs_contratos', 'cs_contratos', 'x_idContratacion', 'idContratacion', '`idContratacion`', '`idContratacion`', 3, -1, FALSE, '`idContratacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->idContratacion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['idContratacion'] = &$this->idContratacion;

		// estatuscontrato
		$this->estatuscontrato = new cField('cs_contratos', 'cs_contratos', 'x_estatuscontrato', 'estatuscontrato', '`estatuscontrato`', '`estatuscontrato`', 200, -1, FALSE, '`estatuscontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estatuscontrato'] = &$this->estatuscontrato;

		// nmodifica
		$this->nmodifica = new cField('cs_contratos', 'cs_contratos', 'x_nmodifica', 'nmodifica', '`nmodifica`', '`nmodifica`', 3, -1, FALSE, '`nmodifica`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nmodifica->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['nmodifica'] = &$this->nmodifica;

		// fecha
		$this->fecha = new cField('cs_contratos', 'cs_contratos', 'x_fecha', 'fecha', '`fecha`', '`fecha`', 200, -1, FALSE, '`fecha`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecha'] = &$this->fecha;

		// tipomodifica
		$this->tipomodifica = new cField('cs_contratos', 'cs_contratos', 'x_tipomodifica', 'tipomodifica', '`tipomodifica`', '`tipomodifica`', 200, -1, FALSE, '`tipomodifica`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['tipomodifica'] = &$this->tipomodifica;

		// justimodcontrato
		$this->justimodcontrato = new cField('cs_contratos', 'cs_contratos', 'x_justimodcontrato', 'justimodcontrato', '`justimodcontrato`', '`justimodcontrato`', 201, -1, FALSE, '`justimodcontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['justimodcontrato'] = &$this->justimodcontrato;

		// precioactual
		$this->precioactual = new cField('cs_contratos', 'cs_contratos', 'x_precioactual', 'precioactual', '`precioactual`', '`precioactual`', 5, -1, FALSE, '`precioactual`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->precioactual->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['precioactual'] = &$this->precioactual;

		// fechatercontra
		$this->fechatercontra = new cField('cs_contratos', 'cs_contratos', 'x_fechatercontra', 'fechatercontra', '`fechatercontra`', '`fechatercontra`', 200, -1, FALSE, '`fechatercontra`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fechatercontra'] = &$this->fechatercontra;

		// alcanceactucontrato
		$this->alcanceactucontrato = new cField('cs_contratos', 'cs_contratos', 'x_alcanceactucontrato', 'alcanceactucontrato', '`alcanceactucontrato`', '`alcanceactucontrato`', 201, -1, FALSE, '`alcanceactucontrato`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['alcanceactucontrato'] = &$this->alcanceactucontrato;

		// detallesreadju
		$this->detallesreadju = new cField('cs_contratos', 'cs_contratos', 'x_detallesreadju', 'detallesreadju', '`detallesreadju`', '`detallesreadju`', 201, -1, FALSE, '`detallesreadju`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->fields['detallesreadju'] = &$this->detallesreadju;

		// prograini
		$this->prograini = new cField('cs_contratos', 'cs_contratos', 'x_prograini', 'prograini', '`prograini`', '`prograini`', 200, -1, FALSE, '`prograini`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['prograini'] = &$this->prograini;

		// adendas
		$this->adendas = new cField('cs_contratos', 'cs_contratos', 'x_adendas', 'adendas', '`adendas`', '`adendas`', 200, -1, FALSE, '`adendas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['adendas'] = &$this->adendas;

		// prograactu
		$this->prograactu = new cField('cs_contratos', 'cs_contratos', 'x_prograactu', 'prograactu', '`prograactu`', '`prograactu`', 200, -1, FALSE, '`prograactu`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['prograactu'] = &$this->prograactu;

		// estado
		$this->estado = new cField('cs_contratos', 'cs_contratos', 'x_estado', 'estado', '`estado`', '`estado`', 200, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['estado'] = &$this->estado;

		// otro
		$this->otro = new cField('cs_contratos', 'cs_contratos', 'x_otro', 'otro', '`otro`', '`otro`', 200, -1, FALSE, '`otro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['otro'] = &$this->otro;

		// fecharecibido
		$this->fecharecibido = new cField('cs_contratos', 'cs_contratos', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', '`fecharecibido`', 200, -1, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['fecharecibido'] = &$this->fecharecibido;

		// fechacreacion
		$this->fechacreacion = new cField('cs_contratos', 'cs_contratos', 'x_fechacreacion', 'fechacreacion', '`fechacreacion`', '`fechacreacion`', 200, -1, FALSE, '`fechacreacion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
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

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cs_contratos`";
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
			if (array_key_exists('idContratos', $rs))
				ew_AddFilter($where, ew_QuotedName('idContratos', $this->DBID) . '=' . ew_QuotedValue($rs['idContratos'], $this->idContratos->FldDataType, $this->DBID));
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
		return "`idContratos` = @idContratos@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->idContratos->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@idContratos@", ew_AdjustSql($this->idContratos->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cs_contratoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cs_contratoslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cs_contratosview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cs_contratosview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cs_contratosadd.php?" . $this->UrlParm($parm);
		else
			return "cs_contratosadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("cs_contratosedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("cs_contratosadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cs_contratosdelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "idContratos:" . ew_VarToJson($this->idContratos->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->idContratos->CurrentValue)) {
			$sUrl .= "idContratos=" . urlencode($this->idContratos->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["idContratos"]) : ew_StripSlashes(@$_GET["idContratos"]); // idContratos

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
			$this->idContratos->CurrentValue = $key;
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
		$this->idContratos->setDbValue($rs->fields('idContratos'));
		$this->idContratacion->setDbValue($rs->fields('idContratacion'));
		$this->estatuscontrato->setDbValue($rs->fields('estatuscontrato'));
		$this->nmodifica->setDbValue($rs->fields('nmodifica'));
		$this->fecha->setDbValue($rs->fields('fecha'));
		$this->tipomodifica->setDbValue($rs->fields('tipomodifica'));
		$this->justimodcontrato->setDbValue($rs->fields('justimodcontrato'));
		$this->precioactual->setDbValue($rs->fields('precioactual'));
		$this->fechatercontra->setDbValue($rs->fields('fechatercontra'));
		$this->alcanceactucontrato->setDbValue($rs->fields('alcanceactucontrato'));
		$this->detallesreadju->setDbValue($rs->fields('detallesreadju'));
		$this->prograini->setDbValue($rs->fields('prograini'));
		$this->adendas->setDbValue($rs->fields('adendas'));
		$this->prograactu->setDbValue($rs->fields('prograactu'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro->setDbValue($rs->fields('otro'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// idContratos
		// idContratacion
		// estatuscontrato
		// nmodifica
		// fecha
		// tipomodifica
		// justimodcontrato
		// precioactual
		// fechatercontra
		// alcanceactucontrato
		// detallesreadju
		// prograini
		// adendas
		// prograactu
		// estado
		// otro
		// fecharecibido
		// fechacreacion
		// idContratos

		$this->idContratos->ViewValue = $this->idContratos->CurrentValue;
		$this->idContratos->ViewCustomAttributes = "";

		// idContratacion
		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// estatuscontrato
		$this->estatuscontrato->ViewValue = $this->estatuscontrato->CurrentValue;
		$this->estatuscontrato->ViewCustomAttributes = "";

		// nmodifica
		$this->nmodifica->ViewValue = $this->nmodifica->CurrentValue;
		$this->nmodifica->ViewCustomAttributes = "";

		// fecha
		$this->fecha->ViewValue = $this->fecha->CurrentValue;
		$this->fecha->ViewCustomAttributes = "";

		// tipomodifica
		$this->tipomodifica->ViewValue = $this->tipomodifica->CurrentValue;
		$this->tipomodifica->ViewCustomAttributes = "";

		// justimodcontrato
		$this->justimodcontrato->ViewValue = $this->justimodcontrato->CurrentValue;
		$this->justimodcontrato->ViewCustomAttributes = "";

		// precioactual
		$this->precioactual->ViewValue = $this->precioactual->CurrentValue;
		$this->precioactual->ViewCustomAttributes = "";

		// fechatercontra
		$this->fechatercontra->ViewValue = $this->fechatercontra->CurrentValue;
		$this->fechatercontra->ViewCustomAttributes = "";

		// alcanceactucontrato
		$this->alcanceactucontrato->ViewValue = $this->alcanceactucontrato->CurrentValue;
		$this->alcanceactucontrato->ViewCustomAttributes = "";

		// detallesreadju
		$this->detallesreadju->ViewValue = $this->detallesreadju->CurrentValue;
		$this->detallesreadju->ViewCustomAttributes = "";

		// prograini
		$this->prograini->ViewValue = $this->prograini->CurrentValue;
		$this->prograini->ViewCustomAttributes = "";

		// adendas
		$this->adendas->ViewValue = $this->adendas->CurrentValue;
		$this->adendas->ViewCustomAttributes = "";

		// prograactu
		$this->prograactu->ViewValue = $this->prograactu->CurrentValue;
		$this->prograactu->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro
		$this->otro->ViewValue = $this->otro->CurrentValue;
		$this->otro->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

		// idContratos
		$this->idContratos->LinkCustomAttributes = "";
		$this->idContratos->HrefValue = "";
		$this->idContratos->TooltipValue = "";

		// idContratacion
		$this->idContratacion->LinkCustomAttributes = "";
		$this->idContratacion->HrefValue = "";
		$this->idContratacion->TooltipValue = "";

		// estatuscontrato
		$this->estatuscontrato->LinkCustomAttributes = "";
		$this->estatuscontrato->HrefValue = "";
		$this->estatuscontrato->TooltipValue = "";

		// nmodifica
		$this->nmodifica->LinkCustomAttributes = "";
		$this->nmodifica->HrefValue = "";
		$this->nmodifica->TooltipValue = "";

		// fecha
		$this->fecha->LinkCustomAttributes = "";
		$this->fecha->HrefValue = "";
		$this->fecha->TooltipValue = "";

		// tipomodifica
		$this->tipomodifica->LinkCustomAttributes = "";
		$this->tipomodifica->HrefValue = "";
		$this->tipomodifica->TooltipValue = "";

		// justimodcontrato
		$this->justimodcontrato->LinkCustomAttributes = "";
		$this->justimodcontrato->HrefValue = "";
		$this->justimodcontrato->TooltipValue = "";

		// precioactual
		$this->precioactual->LinkCustomAttributes = "";
		$this->precioactual->HrefValue = "";
		$this->precioactual->TooltipValue = "";

		// fechatercontra
		$this->fechatercontra->LinkCustomAttributes = "";
		$this->fechatercontra->HrefValue = "";
		$this->fechatercontra->TooltipValue = "";

		// alcanceactucontrato
		$this->alcanceactucontrato->LinkCustomAttributes = "";
		$this->alcanceactucontrato->HrefValue = "";
		$this->alcanceactucontrato->TooltipValue = "";

		// detallesreadju
		$this->detallesreadju->LinkCustomAttributes = "";
		$this->detallesreadju->HrefValue = "";
		$this->detallesreadju->TooltipValue = "";

		// prograini
		$this->prograini->LinkCustomAttributes = "";
		$this->prograini->HrefValue = "";
		$this->prograini->TooltipValue = "";

		// adendas
		$this->adendas->LinkCustomAttributes = "";
		$this->adendas->HrefValue = "";
		$this->adendas->TooltipValue = "";

		// prograactu
		$this->prograactu->LinkCustomAttributes = "";
		$this->prograactu->HrefValue = "";
		$this->prograactu->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// otro
		$this->otro->LinkCustomAttributes = "";
		$this->otro->HrefValue = "";
		$this->otro->TooltipValue = "";

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

		// idContratos
		$this->idContratos->EditAttrs["class"] = "form-control";
		$this->idContratos->EditCustomAttributes = "";
		$this->idContratos->EditValue = $this->idContratos->CurrentValue;
		$this->idContratos->ViewCustomAttributes = "";

		// idContratacion
		$this->idContratacion->EditAttrs["class"] = "form-control";
		$this->idContratacion->EditCustomAttributes = "";
		$this->idContratacion->EditValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());

		// estatuscontrato
		$this->estatuscontrato->EditAttrs["class"] = "form-control";
		$this->estatuscontrato->EditCustomAttributes = "";
		$this->estatuscontrato->EditValue = $this->estatuscontrato->CurrentValue;
		$this->estatuscontrato->PlaceHolder = ew_RemoveHtml($this->estatuscontrato->FldCaption());

		// nmodifica
		$this->nmodifica->EditAttrs["class"] = "form-control";
		$this->nmodifica->EditCustomAttributes = "";
		$this->nmodifica->EditValue = $this->nmodifica->CurrentValue;
		$this->nmodifica->PlaceHolder = ew_RemoveHtml($this->nmodifica->FldCaption());

		// fecha
		$this->fecha->EditAttrs["class"] = "form-control";
		$this->fecha->EditCustomAttributes = "";
		$this->fecha->EditValue = $this->fecha->CurrentValue;
		$this->fecha->PlaceHolder = ew_RemoveHtml($this->fecha->FldCaption());

		// tipomodifica
		$this->tipomodifica->EditAttrs["class"] = "form-control";
		$this->tipomodifica->EditCustomAttributes = "";
		$this->tipomodifica->EditValue = $this->tipomodifica->CurrentValue;
		$this->tipomodifica->PlaceHolder = ew_RemoveHtml($this->tipomodifica->FldCaption());

		// justimodcontrato
		$this->justimodcontrato->EditAttrs["class"] = "form-control";
		$this->justimodcontrato->EditCustomAttributes = "";
		$this->justimodcontrato->EditValue = $this->justimodcontrato->CurrentValue;
		$this->justimodcontrato->PlaceHolder = ew_RemoveHtml($this->justimodcontrato->FldCaption());

		// precioactual
		$this->precioactual->EditAttrs["class"] = "form-control";
		$this->precioactual->EditCustomAttributes = "";
		$this->precioactual->EditValue = $this->precioactual->CurrentValue;
		$this->precioactual->PlaceHolder = ew_RemoveHtml($this->precioactual->FldCaption());
		if (strval($this->precioactual->EditValue) <> "" && is_numeric($this->precioactual->EditValue)) $this->precioactual->EditValue = ew_FormatNumber($this->precioactual->EditValue, -2, -1, -2, 0);

		// fechatercontra
		$this->fechatercontra->EditAttrs["class"] = "form-control";
		$this->fechatercontra->EditCustomAttributes = "";
		$this->fechatercontra->EditValue = $this->fechatercontra->CurrentValue;
		$this->fechatercontra->PlaceHolder = ew_RemoveHtml($this->fechatercontra->FldCaption());

		// alcanceactucontrato
		$this->alcanceactucontrato->EditAttrs["class"] = "form-control";
		$this->alcanceactucontrato->EditCustomAttributes = "";
		$this->alcanceactucontrato->EditValue = $this->alcanceactucontrato->CurrentValue;
		$this->alcanceactucontrato->PlaceHolder = ew_RemoveHtml($this->alcanceactucontrato->FldCaption());

		// detallesreadju
		$this->detallesreadju->EditAttrs["class"] = "form-control";
		$this->detallesreadju->EditCustomAttributes = "";
		$this->detallesreadju->EditValue = $this->detallesreadju->CurrentValue;
		$this->detallesreadju->PlaceHolder = ew_RemoveHtml($this->detallesreadju->FldCaption());

		// prograini
		$this->prograini->EditAttrs["class"] = "form-control";
		$this->prograini->EditCustomAttributes = "";
		$this->prograini->EditValue = $this->prograini->CurrentValue;
		$this->prograini->PlaceHolder = ew_RemoveHtml($this->prograini->FldCaption());

		// adendas
		$this->adendas->EditAttrs["class"] = "form-control";
		$this->adendas->EditCustomAttributes = "";
		$this->adendas->EditValue = $this->adendas->CurrentValue;
		$this->adendas->PlaceHolder = ew_RemoveHtml($this->adendas->FldCaption());

		// prograactu
		$this->prograactu->EditAttrs["class"] = "form-control";
		$this->prograactu->EditCustomAttributes = "";
		$this->prograactu->EditValue = $this->prograactu->CurrentValue;
		$this->prograactu->PlaceHolder = ew_RemoveHtml($this->prograactu->FldCaption());

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
					if ($this->idContratos->Exportable) $Doc->ExportCaption($this->idContratos);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->estatuscontrato->Exportable) $Doc->ExportCaption($this->estatuscontrato);
					if ($this->nmodifica->Exportable) $Doc->ExportCaption($this->nmodifica);
					if ($this->fecha->Exportable) $Doc->ExportCaption($this->fecha);
					if ($this->tipomodifica->Exportable) $Doc->ExportCaption($this->tipomodifica);
					if ($this->justimodcontrato->Exportable) $Doc->ExportCaption($this->justimodcontrato);
					if ($this->precioactual->Exportable) $Doc->ExportCaption($this->precioactual);
					if ($this->fechatercontra->Exportable) $Doc->ExportCaption($this->fechatercontra);
					if ($this->alcanceactucontrato->Exportable) $Doc->ExportCaption($this->alcanceactucontrato);
					if ($this->detallesreadju->Exportable) $Doc->ExportCaption($this->detallesreadju);
					if ($this->prograini->Exportable) $Doc->ExportCaption($this->prograini);
					if ($this->adendas->Exportable) $Doc->ExportCaption($this->adendas);
					if ($this->prograactu->Exportable) $Doc->ExportCaption($this->prograactu);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
					if ($this->fecharecibido->Exportable) $Doc->ExportCaption($this->fecharecibido);
					if ($this->fechacreacion->Exportable) $Doc->ExportCaption($this->fechacreacion);
				} else {
					if ($this->idContratos->Exportable) $Doc->ExportCaption($this->idContratos);
					if ($this->idContratacion->Exportable) $Doc->ExportCaption($this->idContratacion);
					if ($this->estatuscontrato->Exportable) $Doc->ExportCaption($this->estatuscontrato);
					if ($this->nmodifica->Exportable) $Doc->ExportCaption($this->nmodifica);
					if ($this->fecha->Exportable) $Doc->ExportCaption($this->fecha);
					if ($this->tipomodifica->Exportable) $Doc->ExportCaption($this->tipomodifica);
					if ($this->precioactual->Exportable) $Doc->ExportCaption($this->precioactual);
					if ($this->fechatercontra->Exportable) $Doc->ExportCaption($this->fechatercontra);
					if ($this->prograini->Exportable) $Doc->ExportCaption($this->prograini);
					if ($this->adendas->Exportable) $Doc->ExportCaption($this->adendas);
					if ($this->prograactu->Exportable) $Doc->ExportCaption($this->prograactu);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->otro->Exportable) $Doc->ExportCaption($this->otro);
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
						if ($this->idContratos->Exportable) $Doc->ExportField($this->idContratos);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->estatuscontrato->Exportable) $Doc->ExportField($this->estatuscontrato);
						if ($this->nmodifica->Exportable) $Doc->ExportField($this->nmodifica);
						if ($this->fecha->Exportable) $Doc->ExportField($this->fecha);
						if ($this->tipomodifica->Exportable) $Doc->ExportField($this->tipomodifica);
						if ($this->justimodcontrato->Exportable) $Doc->ExportField($this->justimodcontrato);
						if ($this->precioactual->Exportable) $Doc->ExportField($this->precioactual);
						if ($this->fechatercontra->Exportable) $Doc->ExportField($this->fechatercontra);
						if ($this->alcanceactucontrato->Exportable) $Doc->ExportField($this->alcanceactucontrato);
						if ($this->detallesreadju->Exportable) $Doc->ExportField($this->detallesreadju);
						if ($this->prograini->Exportable) $Doc->ExportField($this->prograini);
						if ($this->adendas->Exportable) $Doc->ExportField($this->adendas);
						if ($this->prograactu->Exportable) $Doc->ExportField($this->prograactu);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
						if ($this->fecharecibido->Exportable) $Doc->ExportField($this->fecharecibido);
						if ($this->fechacreacion->Exportable) $Doc->ExportField($this->fechacreacion);
					} else {
						if ($this->idContratos->Exportable) $Doc->ExportField($this->idContratos);
						if ($this->idContratacion->Exportable) $Doc->ExportField($this->idContratacion);
						if ($this->estatuscontrato->Exportable) $Doc->ExportField($this->estatuscontrato);
						if ($this->nmodifica->Exportable) $Doc->ExportField($this->nmodifica);
						if ($this->fecha->Exportable) $Doc->ExportField($this->fecha);
						if ($this->tipomodifica->Exportable) $Doc->ExportField($this->tipomodifica);
						if ($this->precioactual->Exportable) $Doc->ExportField($this->precioactual);
						if ($this->fechatercontra->Exportable) $Doc->ExportField($this->fechatercontra);
						if ($this->prograini->Exportable) $Doc->ExportField($this->prograini);
						if ($this->adendas->Exportable) $Doc->ExportField($this->adendas);
						if ($this->prograactu->Exportable) $Doc->ExportField($this->prograactu);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->otro->Exportable) $Doc->ExportField($this->otro);
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
