<?php

// Global variable for table object
$cruge_user = NULL;

//
// Table class for cruge_user
//
class ccruge_user extends cTable {
	var $iduser;
	var $regdate;
	var $actdate;
	var $logondate;
	var $username;
	var $_email;
	var $password;
	var $authkey;
	var $state;
	var $totalsessioncounter;
	var $currentsessioncounter;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'cruge_user';
		$this->TableName = 'cruge_user';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cruge_user`";
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

		// iduser
		$this->iduser = new cField('cruge_user', 'cruge_user', 'x_iduser', 'iduser', '`iduser`', '`iduser`', 3, -1, FALSE, '`iduser`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->iduser->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['iduser'] = &$this->iduser;

		// regdate
		$this->regdate = new cField('cruge_user', 'cruge_user', 'x_regdate', 'regdate', '`regdate`', '`regdate`', 20, -1, FALSE, '`regdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->regdate->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['regdate'] = &$this->regdate;

		// actdate
		$this->actdate = new cField('cruge_user', 'cruge_user', 'x_actdate', 'actdate', '`actdate`', '`actdate`', 20, -1, FALSE, '`actdate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->actdate->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['actdate'] = &$this->actdate;

		// logondate
		$this->logondate = new cField('cruge_user', 'cruge_user', 'x_logondate', 'logondate', '`logondate`', '`logondate`', 20, -1, FALSE, '`logondate`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->logondate->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['logondate'] = &$this->logondate;

		// username
		$this->username = new cField('cruge_user', 'cruge_user', 'x_username', 'username', '`username`', '`username`', 200, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['username'] = &$this->username;

		// email
		$this->_email = new cField('cruge_user', 'cruge_user', 'x__email', 'email', '`email`', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['email'] = &$this->_email;

		// password
		$this->password = new cField('cruge_user', 'cruge_user', 'x_password', 'password', '`password`', '`password`', 200, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['password'] = &$this->password;

		// authkey
		$this->authkey = new cField('cruge_user', 'cruge_user', 'x_authkey', 'authkey', '`authkey`', '`authkey`', 200, -1, FALSE, '`authkey`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fields['authkey'] = &$this->authkey;

		// state
		$this->state = new cField('cruge_user', 'cruge_user', 'x_state', 'state', '`state`', '`state`', 3, -1, FALSE, '`state`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->state->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['state'] = &$this->state;

		// totalsessioncounter
		$this->totalsessioncounter = new cField('cruge_user', 'cruge_user', 'x_totalsessioncounter', 'totalsessioncounter', '`totalsessioncounter`', '`totalsessioncounter`', 3, -1, FALSE, '`totalsessioncounter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->totalsessioncounter->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['totalsessioncounter'] = &$this->totalsessioncounter;

		// currentsessioncounter
		$this->currentsessioncounter = new cField('cruge_user', 'cruge_user', 'x_currentsessioncounter', 'currentsessioncounter', '`currentsessioncounter`', '`currentsessioncounter`', 3, -1, FALSE, '`currentsessioncounter`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->currentsessioncounter->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['currentsessioncounter'] = &$this->currentsessioncounter;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`cruge_user`";
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
			if (EW_ENCRYPTED_PASSWORD && $name == 'password')
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? ew_EncryptPassword($value) : ew_EncryptPassword(strtolower($value));
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
			if (EW_ENCRYPTED_PASSWORD && $name == 'password') {
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? ew_EncryptPassword($value) : ew_EncryptPassword(strtolower($value));
			}
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
			if (array_key_exists('iduser', $rs))
				ew_AddFilter($where, ew_QuotedName('iduser', $this->DBID) . '=' . ew_QuotedValue($rs['iduser'], $this->iduser->FldDataType, $this->DBID));
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
		return "`iduser` = @iduser@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->iduser->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@iduser@", ew_AdjustSql($this->iduser->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "cruge_userlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "cruge_userlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("cruge_userview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("cruge_userview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			return "cruge_useradd.php?" . $this->UrlParm($parm);
		else
			return "cruge_useradd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("cruge_useredit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("cruge_useradd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("cruge_userdelete.php", $this->UrlParm());
	}

	function KeyToJson() {
		$json = "";
		$json .= "iduser:" . ew_VarToJson($this->iduser->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->iduser->CurrentValue)) {
			$sUrl .= "iduser=" . urlencode($this->iduser->CurrentValue);
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
			$arKeys[] = $isPost ? ew_StripSlashes(@$_POST["iduser"]) : ew_StripSlashes(@$_GET["iduser"]); // iduser

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
			$this->iduser->CurrentValue = $key;
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
		$this->iduser->setDbValue($rs->fields('iduser'));
		$this->regdate->setDbValue($rs->fields('regdate'));
		$this->actdate->setDbValue($rs->fields('actdate'));
		$this->logondate->setDbValue($rs->fields('logondate'));
		$this->username->setDbValue($rs->fields('username'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->password->setDbValue($rs->fields('password'));
		$this->authkey->setDbValue($rs->fields('authkey'));
		$this->state->setDbValue($rs->fields('state'));
		$this->totalsessioncounter->setDbValue($rs->fields('totalsessioncounter'));
		$this->currentsessioncounter->setDbValue($rs->fields('currentsessioncounter'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// iduser
		// regdate
		// actdate
		// logondate
		// username
		// email
		// password
		// authkey
		// state
		// totalsessioncounter
		// currentsessioncounter
		// iduser

		$this->iduser->ViewValue = $this->iduser->CurrentValue;
		$this->iduser->ViewCustomAttributes = "";

		// regdate
		$this->regdate->ViewValue = $this->regdate->CurrentValue;
		$this->regdate->ViewCustomAttributes = "";

		// actdate
		$this->actdate->ViewValue = $this->actdate->CurrentValue;
		$this->actdate->ViewCustomAttributes = "";

		// logondate
		$this->logondate->ViewValue = $this->logondate->CurrentValue;
		$this->logondate->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// authkey
		$this->authkey->ViewValue = $this->authkey->CurrentValue;
		$this->authkey->ViewCustomAttributes = "";

		// state
		$this->state->ViewValue = $this->state->CurrentValue;
		$this->state->ViewCustomAttributes = "";

		// totalsessioncounter
		$this->totalsessioncounter->ViewValue = $this->totalsessioncounter->CurrentValue;
		$this->totalsessioncounter->ViewCustomAttributes = "";

		// currentsessioncounter
		$this->currentsessioncounter->ViewValue = $this->currentsessioncounter->CurrentValue;
		$this->currentsessioncounter->ViewCustomAttributes = "";

		// iduser
		$this->iduser->LinkCustomAttributes = "";
		$this->iduser->HrefValue = "";
		$this->iduser->TooltipValue = "";

		// regdate
		$this->regdate->LinkCustomAttributes = "";
		$this->regdate->HrefValue = "";
		$this->regdate->TooltipValue = "";

		// actdate
		$this->actdate->LinkCustomAttributes = "";
		$this->actdate->HrefValue = "";
		$this->actdate->TooltipValue = "";

		// logondate
		$this->logondate->LinkCustomAttributes = "";
		$this->logondate->HrefValue = "";
		$this->logondate->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// authkey
		$this->authkey->LinkCustomAttributes = "";
		$this->authkey->HrefValue = "";
		$this->authkey->TooltipValue = "";

		// state
		$this->state->LinkCustomAttributes = "";
		$this->state->HrefValue = "";
		$this->state->TooltipValue = "";

		// totalsessioncounter
		$this->totalsessioncounter->LinkCustomAttributes = "";
		$this->totalsessioncounter->HrefValue = "";
		$this->totalsessioncounter->TooltipValue = "";

		// currentsessioncounter
		$this->currentsessioncounter->LinkCustomAttributes = "";
		$this->currentsessioncounter->HrefValue = "";
		$this->currentsessioncounter->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// iduser
		$this->iduser->EditAttrs["class"] = "form-control";
		$this->iduser->EditCustomAttributes = "";
		$this->iduser->EditValue = $this->iduser->CurrentValue;
		$this->iduser->ViewCustomAttributes = "";

		// regdate
		$this->regdate->EditAttrs["class"] = "form-control";
		$this->regdate->EditCustomAttributes = "";
		$this->regdate->EditValue = $this->regdate->CurrentValue;
		$this->regdate->PlaceHolder = ew_RemoveHtml($this->regdate->FldCaption());

		// actdate
		$this->actdate->EditAttrs["class"] = "form-control";
		$this->actdate->EditCustomAttributes = "";
		$this->actdate->EditValue = $this->actdate->CurrentValue;
		$this->actdate->PlaceHolder = ew_RemoveHtml($this->actdate->FldCaption());

		// logondate
		$this->logondate->EditAttrs["class"] = "form-control";
		$this->logondate->EditCustomAttributes = "";
		$this->logondate->EditValue = $this->logondate->CurrentValue;
		$this->logondate->PlaceHolder = ew_RemoveHtml($this->logondate->FldCaption());

		// username
		$this->username->EditAttrs["class"] = "form-control";
		$this->username->EditCustomAttributes = "";
		$this->username->EditValue = $this->username->CurrentValue;
		$this->username->PlaceHolder = ew_RemoveHtml($this->username->FldCaption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldCaption());

		// password
		$this->password->EditAttrs["class"] = "form-control ewPasswordStrength";
		$this->password->EditCustomAttributes = "";
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = ew_RemoveHtml($this->password->FldCaption());

		// authkey
		$this->authkey->EditAttrs["class"] = "form-control";
		$this->authkey->EditCustomAttributes = "";
		$this->authkey->EditValue = $this->authkey->CurrentValue;
		$this->authkey->PlaceHolder = ew_RemoveHtml($this->authkey->FldCaption());

		// state
		$this->state->EditAttrs["class"] = "form-control";
		$this->state->EditCustomAttributes = "";
		$this->state->EditValue = $this->state->CurrentValue;
		$this->state->PlaceHolder = ew_RemoveHtml($this->state->FldCaption());

		// totalsessioncounter
		$this->totalsessioncounter->EditAttrs["class"] = "form-control";
		$this->totalsessioncounter->EditCustomAttributes = "";
		$this->totalsessioncounter->EditValue = $this->totalsessioncounter->CurrentValue;
		$this->totalsessioncounter->PlaceHolder = ew_RemoveHtml($this->totalsessioncounter->FldCaption());

		// currentsessioncounter
		$this->currentsessioncounter->EditAttrs["class"] = "form-control";
		$this->currentsessioncounter->EditCustomAttributes = "";
		$this->currentsessioncounter->EditValue = $this->currentsessioncounter->CurrentValue;
		$this->currentsessioncounter->PlaceHolder = ew_RemoveHtml($this->currentsessioncounter->FldCaption());

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
					if ($this->iduser->Exportable) $Doc->ExportCaption($this->iduser);
					if ($this->regdate->Exportable) $Doc->ExportCaption($this->regdate);
					if ($this->actdate->Exportable) $Doc->ExportCaption($this->actdate);
					if ($this->logondate->Exportable) $Doc->ExportCaption($this->logondate);
					if ($this->username->Exportable) $Doc->ExportCaption($this->username);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->password->Exportable) $Doc->ExportCaption($this->password);
					if ($this->authkey->Exportable) $Doc->ExportCaption($this->authkey);
					if ($this->state->Exportable) $Doc->ExportCaption($this->state);
					if ($this->totalsessioncounter->Exportable) $Doc->ExportCaption($this->totalsessioncounter);
					if ($this->currentsessioncounter->Exportable) $Doc->ExportCaption($this->currentsessioncounter);
				} else {
					if ($this->iduser->Exportable) $Doc->ExportCaption($this->iduser);
					if ($this->regdate->Exportable) $Doc->ExportCaption($this->regdate);
					if ($this->actdate->Exportable) $Doc->ExportCaption($this->actdate);
					if ($this->logondate->Exportable) $Doc->ExportCaption($this->logondate);
					if ($this->username->Exportable) $Doc->ExportCaption($this->username);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->password->Exportable) $Doc->ExportCaption($this->password);
					if ($this->authkey->Exportable) $Doc->ExportCaption($this->authkey);
					if ($this->state->Exportable) $Doc->ExportCaption($this->state);
					if ($this->totalsessioncounter->Exportable) $Doc->ExportCaption($this->totalsessioncounter);
					if ($this->currentsessioncounter->Exportable) $Doc->ExportCaption($this->currentsessioncounter);
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
						if ($this->iduser->Exportable) $Doc->ExportField($this->iduser);
						if ($this->regdate->Exportable) $Doc->ExportField($this->regdate);
						if ($this->actdate->Exportable) $Doc->ExportField($this->actdate);
						if ($this->logondate->Exportable) $Doc->ExportField($this->logondate);
						if ($this->username->Exportable) $Doc->ExportField($this->username);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->password->Exportable) $Doc->ExportField($this->password);
						if ($this->authkey->Exportable) $Doc->ExportField($this->authkey);
						if ($this->state->Exportable) $Doc->ExportField($this->state);
						if ($this->totalsessioncounter->Exportable) $Doc->ExportField($this->totalsessioncounter);
						if ($this->currentsessioncounter->Exportable) $Doc->ExportField($this->currentsessioncounter);
					} else {
						if ($this->iduser->Exportable) $Doc->ExportField($this->iduser);
						if ($this->regdate->Exportable) $Doc->ExportField($this->regdate);
						if ($this->actdate->Exportable) $Doc->ExportField($this->actdate);
						if ($this->logondate->Exportable) $Doc->ExportField($this->logondate);
						if ($this->username->Exportable) $Doc->ExportField($this->username);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->password->Exportable) $Doc->ExportField($this->password);
						if ($this->authkey->Exportable) $Doc->ExportField($this->authkey);
						if ($this->state->Exportable) $Doc->ExportField($this->state);
						if ($this->totalsessioncounter->Exportable) $Doc->ExportField($this->totalsessioncounter);
						if ($this->currentsessioncounter->Exportable) $Doc->ExportField($this->currentsessioncounter);
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
