<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_inicio_ejecucioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_contratacioninfo.php" ?>
<?php include_once "cs_avancesgridcls.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_inicio_ejecucion_view = NULL; // Initialize page object first

class ccs_inicio_ejecucion_view extends ccs_inicio_ejecucion {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_inicio_ejecucion';

	// Page object name
	var $PageObjName = 'cs_inicio_ejecucion_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (cs_inicio_ejecucion)
		if (!isset($GLOBALS["cs_inicio_ejecucion"]) || get_class($GLOBALS["cs_inicio_ejecucion"]) == "ccs_inicio_ejecucion") {
			$GLOBALS["cs_inicio_ejecucion"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_inicio_ejecucion"];
		}
		$KeyUrl = "";
		if (@$_GET["codigo"] <> "") {
			$this->RecKey["codigo"] = $_GET["codigo"];
			$KeyUrl .= "&amp;codigo=" . urlencode($this->RecKey["codigo"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Table object (cs_contratacion)
		if (!isset($GLOBALS['cs_contratacion'])) $GLOBALS['cs_contratacion'] = new ccs_contratacion();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_inicio_ejecucion', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (cruge_user)
		if (!isset($UserTable)) {
			$UserTable = new ccruge_user();
			$UserTableConn = Conn($UserTable->DBID);
		}

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) $this->Page_Terminate(ew_GetUrl("login.php"));
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->codigo->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $cs_inicio_ejecucion;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_inicio_ejecucion);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["codigo"] <> "") {
				$this->codigo->setQueryStringValue($_GET["codigo"]);
				$this->RecKey["codigo"] = $this->codigo->QueryStringValue;
			} elseif (@$_POST["codigo"] <> "") {
				$this->codigo->setFormValue($_POST["codigo"]);
				$this->RecKey["codigo"] = $this->codigo->FormValue;
			} else {
				$sReturnUrl = "cs_inicio_ejecucionlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_inicio_ejecucionlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_inicio_ejecucionlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();

		// Set up detail parameters
		$this->SetUpDetailParms();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];
		$option = &$options["detail"];
		$DetailTableLink = "";
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_cs_avances"
		$item = &$option->Add("detail_cs_avances");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("cs_avances", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_avanceslist.php?" . EW_TABLE_SHOW_MASTER . "=cs_inicio_ejecucion&fk_idContratacion=" . urlencode(strval($this->idContratacion->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["cs_avances_grid"] && $GLOBALS["cs_avances_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_avances')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_avances")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "cs_avances";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_avances');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "cs_avances";
		}
		if ($this->ShowMultipleDetails) $item->Visible = FALSE;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$option->Add("details");
			$oListOpt->Body = $body;
		}

		// Set up detail default
		$option = &$options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$option->UseImageAndText = TRUE;
		$ar = explode(",", $DetailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->codigo->DbValue = $row['codigo'];
		$this->idContratacion->DbValue = $row['idContratacion'];
		$this->imagen->DbValue = $row['imagen'];
		$this->cod_contacto_01->DbValue = $row['cod_contacto_01'];
		$this->cod_contacto_02->DbValue = $row['cod_contacto_02'];
		$this->cod_contacto_03->DbValue = $row['cod_contacto_03'];
		$this->tipo_garant_01->DbValue = $row['tipo_garant_01'];
		$this->tipo_garant_02->DbValue = $row['tipo_garant_02'];
		$this->tipo_garant_03->DbValue = $row['tipo_garant_03'];
		$this->monto_garant_01->DbValue = $row['monto_garant_01'];
		$this->monto_garant_02->DbValue = $row['monto_garant_02'];
		$this->monto_garant_03->DbValue = $row['monto_garant_03'];
		$this->estado_garant_01->DbValue = $row['estado_garant_01'];
		$this->estado_garant_02->DbValue = $row['estado_garant_02'];
		$this->estado_garant_03->DbValue = $row['estado_garant_03'];
		$this->fecha_venc_01->DbValue = $row['fecha_venc_01'];
		$this->fecha_venc_02->DbValue = $row['fecha_venc_02'];
		$this->fecha_venc_03->DbValue = $row['fecha_venc_03'];
		$this->geo_latitud->DbValue = $row['geo_latitud'];
		$this->geo_longitud->DbValue = $row['geo_longitud'];
		$this->geo_lati_final->DbValue = $row['geo_lati_final'];
		$this->geo_long_final->DbValue = $row['geo_long_final'];
		$this->fecha_inicio->DbValue = $row['fecha_inicio'];
		$this->estado_sol->DbValue = $row['estado_sol'];
		$this->fecha_registro->DbValue = $row['fecha_registro'];
		$this->user_registro->DbValue = $row['user_registro'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

		// Convert decimal values if posted back
		if ($this->monto_garant_01->FormValue == $this->monto_garant_01->CurrentValue && is_numeric(ew_StrToFloat($this->monto_garant_01->CurrentValue)))
			$this->monto_garant_01->CurrentValue = ew_StrToFloat($this->monto_garant_01->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monto_garant_02->FormValue == $this->monto_garant_02->CurrentValue && is_numeric(ew_StrToFloat($this->monto_garant_02->CurrentValue)))
			$this->monto_garant_02->CurrentValue = ew_StrToFloat($this->monto_garant_02->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monto_garant_03->FormValue == $this->monto_garant_03->CurrentValue && is_numeric(ew_StrToFloat($this->monto_garant_03->CurrentValue)))
			$this->monto_garant_03->CurrentValue = ew_StrToFloat($this->monto_garant_03->CurrentValue);

		// Convert decimal values if posted back
		if ($this->geo_latitud->FormValue == $this->geo_latitud->CurrentValue && is_numeric(ew_StrToFloat($this->geo_latitud->CurrentValue)))
			$this->geo_latitud->CurrentValue = ew_StrToFloat($this->geo_latitud->CurrentValue);

		// Convert decimal values if posted back
		if ($this->geo_longitud->FormValue == $this->geo_longitud->CurrentValue && is_numeric(ew_StrToFloat($this->geo_longitud->CurrentValue)))
			$this->geo_longitud->CurrentValue = ew_StrToFloat($this->geo_longitud->CurrentValue);

		// Convert decimal values if posted back
		if ($this->geo_lati_final->FormValue == $this->geo_lati_final->CurrentValue && is_numeric(ew_StrToFloat($this->geo_lati_final->CurrentValue)))
			$this->geo_lati_final->CurrentValue = ew_StrToFloat($this->geo_lati_final->CurrentValue);

		// Convert decimal values if posted back
		if ($this->geo_long_final->FormValue == $this->geo_long_final->CurrentValue && is_numeric(ew_StrToFloat($this->geo_long_final->CurrentValue)))
			$this->geo_long_final->CurrentValue = ew_StrToFloat($this->geo_long_final->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "cs_contratacion") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_idContratacion"] <> "") {
					$GLOBALS["cs_contratacion"]->idContratacion->setQueryStringValue($_GET["fk_idContratacion"]);
					$this->idContratacion->setQueryStringValue($GLOBALS["cs_contratacion"]->idContratacion->QueryStringValue);
					$this->idContratacion->setSessionValue($this->idContratacion->QueryStringValue);
					if (!is_numeric($GLOBALS["cs_contratacion"]->idContratacion->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "cs_contratacion") {
				if ($this->idContratacion->QueryStringValue == "") $this->idContratacion->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("cs_avances", $DetailTblVar)) {
				if (!isset($GLOBALS["cs_avances_grid"]))
					$GLOBALS["cs_avances_grid"] = new ccs_avances_grid;
				if ($GLOBALS["cs_avances_grid"]->DetailView) {
					$GLOBALS["cs_avances_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["cs_avances_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cs_avances_grid"]->setStartRecordNumber(1);
					$GLOBALS["cs_avances_grid"]->codigo_inicio_ejecucion->FldIsDetailKey = TRUE;
					$GLOBALS["cs_avances_grid"]->codigo_inicio_ejecucion->CurrentValue = $this->idContratacion->CurrentValue;
					$GLOBALS["cs_avances_grid"]->codigo_inicio_ejecucion->setSessionValue($GLOBALS["cs_avances_grid"]->codigo_inicio_ejecucion->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_inicio_ejecucionlist.php", "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

	    //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($cs_inicio_ejecucion_view)) $cs_inicio_ejecucion_view = new ccs_inicio_ejecucion_view();

// Page init
$cs_inicio_ejecucion_view->Page_Init();

// Page main
$cs_inicio_ejecucion_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_inicio_ejecucion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_inicio_ejecucionview = new ew_Form("fcs_inicio_ejecucionview", "view");

// Form_CustomValidate event
fcs_inicio_ejecucionview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_inicio_ejecucionview.ValidateRequired = true;
<?php } else { ?>
fcs_inicio_ejecucionview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_inicio_ejecucion_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_inicio_ejecucion_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_inicio_ejecucion_view->ShowPageHeader(); ?>
<?php
$cs_inicio_ejecucion_view->ShowMessage();
?>
<form name="fcs_inicio_ejecucionview" id="fcs_inicio_ejecucionview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_inicio_ejecucion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_inicio_ejecucion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_inicio_ejecucion">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
	<tr id="r_codigo">
		<td><span id="elh_cs_inicio_ejecucion_codigo"><?php echo $cs_inicio_ejecucion->codigo->FldCaption() ?></span></td>
		<td data-name="codigo"<?php echo $cs_inicio_ejecucion->codigo->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_codigo">
<span<?php echo $cs_inicio_ejecucion->codigo->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->codigo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
	<tr id="r_idContratacion">
		<td><span id="elh_cs_inicio_ejecucion_idContratacion"><?php echo $cs_inicio_ejecucion->idContratacion->FldCaption() ?></span></td>
		<td data-name="idContratacion"<?php echo $cs_inicio_ejecucion->idContratacion->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->idContratacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
	<tr id="r_imagen">
		<td><span id="elh_cs_inicio_ejecucion_imagen"><?php echo $cs_inicio_ejecucion->imagen->FldCaption() ?></span></td>
		<td data-name="imagen"<?php echo $cs_inicio_ejecucion->imagen->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_imagen">
<span<?php echo $cs_inicio_ejecucion->imagen->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->imagen->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
	<tr id="r_cod_contacto_01">
		<td><span id="elh_cs_inicio_ejecucion_cod_contacto_01"><?php echo $cs_inicio_ejecucion->cod_contacto_01->FldCaption() ?></span></td>
		<td data-name="cod_contacto_01"<?php echo $cs_inicio_ejecucion->cod_contacto_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_cod_contacto_01">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
	<tr id="r_cod_contacto_02">
		<td><span id="elh_cs_inicio_ejecucion_cod_contacto_02"><?php echo $cs_inicio_ejecucion->cod_contacto_02->FldCaption() ?></span></td>
		<td data-name="cod_contacto_02"<?php echo $cs_inicio_ejecucion->cod_contacto_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_cod_contacto_02">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
	<tr id="r_cod_contacto_03">
		<td><span id="elh_cs_inicio_ejecucion_cod_contacto_03"><?php echo $cs_inicio_ejecucion->cod_contacto_03->FldCaption() ?></span></td>
		<td data-name="cod_contacto_03"<?php echo $cs_inicio_ejecucion->cod_contacto_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_cod_contacto_03">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
	<tr id="r_tipo_garant_01">
		<td><span id="elh_cs_inicio_ejecucion_tipo_garant_01"><?php echo $cs_inicio_ejecucion->tipo_garant_01->FldCaption() ?></span></td>
		<td data-name="tipo_garant_01"<?php echo $cs_inicio_ejecucion->tipo_garant_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_tipo_garant_01">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
	<tr id="r_tipo_garant_02">
		<td><span id="elh_cs_inicio_ejecucion_tipo_garant_02"><?php echo $cs_inicio_ejecucion->tipo_garant_02->FldCaption() ?></span></td>
		<td data-name="tipo_garant_02"<?php echo $cs_inicio_ejecucion->tipo_garant_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_tipo_garant_02">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
	<tr id="r_tipo_garant_03">
		<td><span id="elh_cs_inicio_ejecucion_tipo_garant_03"><?php echo $cs_inicio_ejecucion->tipo_garant_03->FldCaption() ?></span></td>
		<td data-name="tipo_garant_03"<?php echo $cs_inicio_ejecucion->tipo_garant_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_tipo_garant_03">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
	<tr id="r_monto_garant_01">
		<td><span id="elh_cs_inicio_ejecucion_monto_garant_01"><?php echo $cs_inicio_ejecucion->monto_garant_01->FldCaption() ?></span></td>
		<td data-name="monto_garant_01"<?php echo $cs_inicio_ejecucion->monto_garant_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_monto_garant_01">
<span<?php echo $cs_inicio_ejecucion->monto_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_01->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
	<tr id="r_monto_garant_02">
		<td><span id="elh_cs_inicio_ejecucion_monto_garant_02"><?php echo $cs_inicio_ejecucion->monto_garant_02->FldCaption() ?></span></td>
		<td data-name="monto_garant_02"<?php echo $cs_inicio_ejecucion->monto_garant_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_monto_garant_02">
<span<?php echo $cs_inicio_ejecucion->monto_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_02->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
	<tr id="r_monto_garant_03">
		<td><span id="elh_cs_inicio_ejecucion_monto_garant_03"><?php echo $cs_inicio_ejecucion->monto_garant_03->FldCaption() ?></span></td>
		<td data-name="monto_garant_03"<?php echo $cs_inicio_ejecucion->monto_garant_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_monto_garant_03">
<span<?php echo $cs_inicio_ejecucion->monto_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_03->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
	<tr id="r_estado_garant_01">
		<td><span id="elh_cs_inicio_ejecucion_estado_garant_01"><?php echo $cs_inicio_ejecucion->estado_garant_01->FldCaption() ?></span></td>
		<td data-name="estado_garant_01"<?php echo $cs_inicio_ejecucion->estado_garant_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_garant_01">
<span<?php echo $cs_inicio_ejecucion->estado_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_01->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
	<tr id="r_estado_garant_02">
		<td><span id="elh_cs_inicio_ejecucion_estado_garant_02"><?php echo $cs_inicio_ejecucion->estado_garant_02->FldCaption() ?></span></td>
		<td data-name="estado_garant_02"<?php echo $cs_inicio_ejecucion->estado_garant_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_garant_02">
<span<?php echo $cs_inicio_ejecucion->estado_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_02->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
	<tr id="r_estado_garant_03">
		<td><span id="elh_cs_inicio_ejecucion_estado_garant_03"><?php echo $cs_inicio_ejecucion->estado_garant_03->FldCaption() ?></span></td>
		<td data-name="estado_garant_03"<?php echo $cs_inicio_ejecucion->estado_garant_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_garant_03">
<span<?php echo $cs_inicio_ejecucion->estado_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_03->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
	<tr id="r_fecha_venc_01">
		<td><span id="elh_cs_inicio_ejecucion_fecha_venc_01"><?php echo $cs_inicio_ejecucion->fecha_venc_01->FldCaption() ?></span></td>
		<td data-name="fecha_venc_01"<?php echo $cs_inicio_ejecucion->fecha_venc_01->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_venc_01">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
	<tr id="r_fecha_venc_02">
		<td><span id="elh_cs_inicio_ejecucion_fecha_venc_02"><?php echo $cs_inicio_ejecucion->fecha_venc_02->FldCaption() ?></span></td>
		<td data-name="fecha_venc_02"<?php echo $cs_inicio_ejecucion->fecha_venc_02->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_venc_02">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
	<tr id="r_fecha_venc_03">
		<td><span id="elh_cs_inicio_ejecucion_fecha_venc_03"><?php echo $cs_inicio_ejecucion->fecha_venc_03->FldCaption() ?></span></td>
		<td data-name="fecha_venc_03"<?php echo $cs_inicio_ejecucion->fecha_venc_03->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_venc_03">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
	<tr id="r_geo_latitud">
		<td><span id="elh_cs_inicio_ejecucion_geo_latitud"><?php echo $cs_inicio_ejecucion->geo_latitud->FldCaption() ?></span></td>
		<td data-name="geo_latitud"<?php echo $cs_inicio_ejecucion->geo_latitud->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_latitud">
<span<?php echo $cs_inicio_ejecucion->geo_latitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_latitud->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
	<tr id="r_geo_longitud">
		<td><span id="elh_cs_inicio_ejecucion_geo_longitud"><?php echo $cs_inicio_ejecucion->geo_longitud->FldCaption() ?></span></td>
		<td data-name="geo_longitud"<?php echo $cs_inicio_ejecucion->geo_longitud->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_longitud">
<span<?php echo $cs_inicio_ejecucion->geo_longitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_longitud->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
	<tr id="r_geo_lati_final">
		<td><span id="elh_cs_inicio_ejecucion_geo_lati_final"><?php echo $cs_inicio_ejecucion->geo_lati_final->FldCaption() ?></span></td>
		<td data-name="geo_lati_final"<?php echo $cs_inicio_ejecucion->geo_lati_final->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_lati_final">
<span<?php echo $cs_inicio_ejecucion->geo_lati_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_lati_final->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
	<tr id="r_geo_long_final">
		<td><span id="elh_cs_inicio_ejecucion_geo_long_final"><?php echo $cs_inicio_ejecucion->geo_long_final->FldCaption() ?></span></td>
		<td data-name="geo_long_final"<?php echo $cs_inicio_ejecucion->geo_long_final->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_geo_long_final">
<span<?php echo $cs_inicio_ejecucion->geo_long_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_long_final->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
	<tr id="r_fecha_inicio">
		<td><span id="elh_cs_inicio_ejecucion_fecha_inicio"><?php echo $cs_inicio_ejecucion->fecha_inicio->FldCaption() ?></span></td>
		<td data-name="fecha_inicio"<?php echo $cs_inicio_ejecucion->fecha_inicio->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_inicio">
<span<?php echo $cs_inicio_ejecucion->fecha_inicio->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_inicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
	<tr id="r_estado_sol">
		<td><span id="elh_cs_inicio_ejecucion_estado_sol"><?php echo $cs_inicio_ejecucion->estado_sol->FldCaption() ?></span></td>
		<td data-name="estado_sol"<?php echo $cs_inicio_ejecucion->estado_sol->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_estado_sol">
<span<?php echo $cs_inicio_ejecucion->estado_sol->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_sol->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
	<tr id="r_fecha_registro">
		<td><span id="elh_cs_inicio_ejecucion_fecha_registro"><?php echo $cs_inicio_ejecucion->fecha_registro->FldCaption() ?></span></td>
		<td data-name="fecha_registro"<?php echo $cs_inicio_ejecucion->fecha_registro->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_fecha_registro">
<span<?php echo $cs_inicio_ejecucion->fecha_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_registro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
	<tr id="r_user_registro">
		<td><span id="elh_cs_inicio_ejecucion_user_registro"><?php echo $cs_inicio_ejecucion->user_registro->FldCaption() ?></span></td>
		<td data-name="user_registro"<?php echo $cs_inicio_ejecucion->user_registro->CellAttributes() ?>>
<span id="el_cs_inicio_ejecucion_user_registro">
<span<?php echo $cs_inicio_ejecucion->user_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->user_registro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cs_avances", explode(",", $cs_inicio_ejecucion->getCurrentDetailTable())) && $cs_avances->DetailView) {
?>
<?php if ($cs_inicio_ejecucion->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("cs_avances", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cs_avancesgrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
fcs_inicio_ejecucionview.Init();
</script>
<?php
$cs_inicio_ejecucion_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_inicio_ejecucion_view->Page_Terminate();
?>
