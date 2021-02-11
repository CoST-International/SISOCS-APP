<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_avancesinfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_inicio_ejecucioninfo.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_avances_view = NULL; // Initialize page object first

class ccs_avances_view extends ccs_avances {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_avances';

	// Page object name
	var $PageObjName = 'cs_avances_view';

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

		// Table object (cs_avances)
		if (!isset($GLOBALS["cs_avances"]) || get_class($GLOBALS["cs_avances"]) == "ccs_avances") {
			$GLOBALS["cs_avances"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_avances"];
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

		// Table object (cs_inicio_ejecucion)
		if (!isset($GLOBALS['cs_inicio_ejecucion'])) $GLOBALS['cs_inicio_ejecucion'] = new ccs_inicio_ejecucion();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_avances', TRUE);

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
		global $EW_EXPORT, $cs_avances;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_avances);
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
				$sReturnUrl = "cs_avanceslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_avanceslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_avanceslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->codigo->DbValue = $row['codigo'];
		$this->codigo_inicio_ejecucion->DbValue = $row['codigo_inicio_ejecucion'];
		$this->porcent_programado->DbValue = $row['porcent_programado'];
		$this->porcent_real->DbValue = $row['porcent_real'];
		$this->finan_programado->DbValue = $row['finan_programado'];
		$this->finan_real->DbValue = $row['finan_real'];
		$this->fecha_registro->DbValue = $row['fecha_registro'];
		$this->estado->DbValue = $row['estado'];
		$this->user_registro->DbValue = $row['user_registro'];
		$this->desc_problemas->DbValue = $row['desc_problemas'];
		$this->desc_temas->DbValue = $row['desc_temas'];
		$this->idEjecucion->DbValue = $row['idEjecucion'];
		$this->fecha_avance->DbValue = $row['fecha_avance'];
		$this->idContratacion->DbValue = $row['idContratacion'];
		$this->estado_sol->DbValue = $row['estado_sol'];
		$this->adj_garantias->DbValue = $row['adj_garantias'];
		$this->adj_avances->DbValue = $row['adj_avances'];
		$this->adj_supervicion->DbValue = $row['adj_supervicion'];
		$this->adj_evaluacion->DbValue = $row['adj_evaluacion'];
		$this->adj_tecnica->DbValue = $row['adj_tecnica'];
		$this->adj_financiero->DbValue = $row['adj_financiero'];
		$this->adj_recepcion->DbValue = $row['adj_recepcion'];
		$this->adj_disconformidad->DbValue = $row['adj_disconformidad'];
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
		if ($this->porcent_programado->FormValue == $this->porcent_programado->CurrentValue && is_numeric(ew_StrToFloat($this->porcent_programado->CurrentValue)))
			$this->porcent_programado->CurrentValue = ew_StrToFloat($this->porcent_programado->CurrentValue);

		// Convert decimal values if posted back
		if ($this->porcent_real->FormValue == $this->porcent_real->CurrentValue && is_numeric(ew_StrToFloat($this->porcent_real->CurrentValue)))
			$this->porcent_real->CurrentValue = ew_StrToFloat($this->porcent_real->CurrentValue);

		// Convert decimal values if posted back
		if ($this->finan_programado->FormValue == $this->finan_programado->CurrentValue && is_numeric(ew_StrToFloat($this->finan_programado->CurrentValue)))
			$this->finan_programado->CurrentValue = ew_StrToFloat($this->finan_programado->CurrentValue);

		// Convert decimal values if posted back
		if ($this->finan_real->FormValue == $this->finan_real->CurrentValue && is_numeric(ew_StrToFloat($this->finan_real->CurrentValue)))
			$this->finan_real->CurrentValue = ew_StrToFloat($this->finan_real->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
			if ($sMasterTblVar == "cs_inicio_ejecucion") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_idContratacion"] <> "") {
					$GLOBALS["cs_inicio_ejecucion"]->idContratacion->setQueryStringValue($_GET["fk_idContratacion"]);
					$this->codigo_inicio_ejecucion->setQueryStringValue($GLOBALS["cs_inicio_ejecucion"]->idContratacion->QueryStringValue);
					$this->codigo_inicio_ejecucion->setSessionValue($this->codigo_inicio_ejecucion->QueryStringValue);
					if (!is_numeric($GLOBALS["cs_inicio_ejecucion"]->idContratacion->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cs_inicio_ejecucion") {
				if ($this->codigo_inicio_ejecucion->QueryStringValue == "") $this->codigo_inicio_ejecucion->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_avanceslist.php", "", $this->TableVar, TRUE);
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
if (!isset($cs_avances_view)) $cs_avances_view = new ccs_avances_view();

// Page init
$cs_avances_view->Page_Init();

// Page main
$cs_avances_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_avances_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_avancesview = new ew_Form("fcs_avancesview", "view");

// Form_CustomValidate event
fcs_avancesview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_avancesview.ValidateRequired = true;
<?php } else { ?>
fcs_avancesview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_avances_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_avances_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_avances_view->ShowPageHeader(); ?>
<?php
$cs_avances_view->ShowMessage();
?>
<form name="fcs_avancesview" id="fcs_avancesview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_avances_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_avances_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_avances">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_avances->codigo->Visible) { // codigo ?>
	<tr id="r_codigo">
		<td><span id="elh_cs_avances_codigo"><?php echo $cs_avances->codigo->FldCaption() ?></span></td>
		<td data-name="codigo"<?php echo $cs_avances->codigo->CellAttributes() ?>>
<span id="el_cs_avances_codigo">
<span<?php echo $cs_avances->codigo->ViewAttributes() ?>>
<?php echo $cs_avances->codigo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->codigo_inicio_ejecucion->Visible) { // codigo_inicio_ejecucion ?>
	<tr id="r_codigo_inicio_ejecucion">
		<td><span id="elh_cs_avances_codigo_inicio_ejecucion"><?php echo $cs_avances->codigo_inicio_ejecucion->FldCaption() ?></span></td>
		<td data-name="codigo_inicio_ejecucion"<?php echo $cs_avances->codigo_inicio_ejecucion->CellAttributes() ?>>
<span id="el_cs_avances_codigo_inicio_ejecucion">
<span<?php echo $cs_avances->codigo_inicio_ejecucion->ViewAttributes() ?>>
<?php echo $cs_avances->codigo_inicio_ejecucion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->porcent_programado->Visible) { // porcent_programado ?>
	<tr id="r_porcent_programado">
		<td><span id="elh_cs_avances_porcent_programado"><?php echo $cs_avances->porcent_programado->FldCaption() ?></span></td>
		<td data-name="porcent_programado"<?php echo $cs_avances->porcent_programado->CellAttributes() ?>>
<span id="el_cs_avances_porcent_programado">
<span<?php echo $cs_avances->porcent_programado->ViewAttributes() ?>>
<?php echo $cs_avances->porcent_programado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->porcent_real->Visible) { // porcent_real ?>
	<tr id="r_porcent_real">
		<td><span id="elh_cs_avances_porcent_real"><?php echo $cs_avances->porcent_real->FldCaption() ?></span></td>
		<td data-name="porcent_real"<?php echo $cs_avances->porcent_real->CellAttributes() ?>>
<span id="el_cs_avances_porcent_real">
<span<?php echo $cs_avances->porcent_real->ViewAttributes() ?>>
<?php echo $cs_avances->porcent_real->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->finan_programado->Visible) { // finan_programado ?>
	<tr id="r_finan_programado">
		<td><span id="elh_cs_avances_finan_programado"><?php echo $cs_avances->finan_programado->FldCaption() ?></span></td>
		<td data-name="finan_programado"<?php echo $cs_avances->finan_programado->CellAttributes() ?>>
<span id="el_cs_avances_finan_programado">
<span<?php echo $cs_avances->finan_programado->ViewAttributes() ?>>
<?php echo $cs_avances->finan_programado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->finan_real->Visible) { // finan_real ?>
	<tr id="r_finan_real">
		<td><span id="elh_cs_avances_finan_real"><?php echo $cs_avances->finan_real->FldCaption() ?></span></td>
		<td data-name="finan_real"<?php echo $cs_avances->finan_real->CellAttributes() ?>>
<span id="el_cs_avances_finan_real">
<span<?php echo $cs_avances->finan_real->ViewAttributes() ?>>
<?php echo $cs_avances->finan_real->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->fecha_registro->Visible) { // fecha_registro ?>
	<tr id="r_fecha_registro">
		<td><span id="elh_cs_avances_fecha_registro"><?php echo $cs_avances->fecha_registro->FldCaption() ?></span></td>
		<td data-name="fecha_registro"<?php echo $cs_avances->fecha_registro->CellAttributes() ?>>
<span id="el_cs_avances_fecha_registro">
<span<?php echo $cs_avances->fecha_registro->ViewAttributes() ?>>
<?php echo $cs_avances->fecha_registro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td><span id="elh_cs_avances_estado"><?php echo $cs_avances->estado->FldCaption() ?></span></td>
		<td data-name="estado"<?php echo $cs_avances->estado->CellAttributes() ?>>
<span id="el_cs_avances_estado">
<span<?php echo $cs_avances->estado->ViewAttributes() ?>>
<?php echo $cs_avances->estado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->user_registro->Visible) { // user_registro ?>
	<tr id="r_user_registro">
		<td><span id="elh_cs_avances_user_registro"><?php echo $cs_avances->user_registro->FldCaption() ?></span></td>
		<td data-name="user_registro"<?php echo $cs_avances->user_registro->CellAttributes() ?>>
<span id="el_cs_avances_user_registro">
<span<?php echo $cs_avances->user_registro->ViewAttributes() ?>>
<?php echo $cs_avances->user_registro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->desc_problemas->Visible) { // desc_problemas ?>
	<tr id="r_desc_problemas">
		<td><span id="elh_cs_avances_desc_problemas"><?php echo $cs_avances->desc_problemas->FldCaption() ?></span></td>
		<td data-name="desc_problemas"<?php echo $cs_avances->desc_problemas->CellAttributes() ?>>
<span id="el_cs_avances_desc_problemas">
<span<?php echo $cs_avances->desc_problemas->ViewAttributes() ?>>
<?php echo $cs_avances->desc_problemas->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->desc_temas->Visible) { // desc_temas ?>
	<tr id="r_desc_temas">
		<td><span id="elh_cs_avances_desc_temas"><?php echo $cs_avances->desc_temas->FldCaption() ?></span></td>
		<td data-name="desc_temas"<?php echo $cs_avances->desc_temas->CellAttributes() ?>>
<span id="el_cs_avances_desc_temas">
<span<?php echo $cs_avances->desc_temas->ViewAttributes() ?>>
<?php echo $cs_avances->desc_temas->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->idEjecucion->Visible) { // idEjecucion ?>
	<tr id="r_idEjecucion">
		<td><span id="elh_cs_avances_idEjecucion"><?php echo $cs_avances->idEjecucion->FldCaption() ?></span></td>
		<td data-name="idEjecucion"<?php echo $cs_avances->idEjecucion->CellAttributes() ?>>
<span id="el_cs_avances_idEjecucion">
<span<?php echo $cs_avances->idEjecucion->ViewAttributes() ?>>
<?php echo $cs_avances->idEjecucion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->fecha_avance->Visible) { // fecha_avance ?>
	<tr id="r_fecha_avance">
		<td><span id="elh_cs_avances_fecha_avance"><?php echo $cs_avances->fecha_avance->FldCaption() ?></span></td>
		<td data-name="fecha_avance"<?php echo $cs_avances->fecha_avance->CellAttributes() ?>>
<span id="el_cs_avances_fecha_avance">
<span<?php echo $cs_avances->fecha_avance->ViewAttributes() ?>>
<?php echo $cs_avances->fecha_avance->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->idContratacion->Visible) { // idContratacion ?>
	<tr id="r_idContratacion">
		<td><span id="elh_cs_avances_idContratacion"><?php echo $cs_avances->idContratacion->FldCaption() ?></span></td>
		<td data-name="idContratacion"<?php echo $cs_avances->idContratacion->CellAttributes() ?>>
<span id="el_cs_avances_idContratacion">
<span<?php echo $cs_avances->idContratacion->ViewAttributes() ?>>
<?php echo $cs_avances->idContratacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->estado_sol->Visible) { // estado_sol ?>
	<tr id="r_estado_sol">
		<td><span id="elh_cs_avances_estado_sol"><?php echo $cs_avances->estado_sol->FldCaption() ?></span></td>
		<td data-name="estado_sol"<?php echo $cs_avances->estado_sol->CellAttributes() ?>>
<span id="el_cs_avances_estado_sol">
<span<?php echo $cs_avances->estado_sol->ViewAttributes() ?>>
<?php echo $cs_avances->estado_sol->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_garantias->Visible) { // adj_garantias ?>
	<tr id="r_adj_garantias">
		<td><span id="elh_cs_avances_adj_garantias"><?php echo $cs_avances->adj_garantias->FldCaption() ?></span></td>
		<td data-name="adj_garantias"<?php echo $cs_avances->adj_garantias->CellAttributes() ?>>
<span id="el_cs_avances_adj_garantias">
<span<?php echo $cs_avances->adj_garantias->ViewAttributes() ?>>
<?php echo $cs_avances->adj_garantias->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_avances->Visible) { // adj_avances ?>
	<tr id="r_adj_avances">
		<td><span id="elh_cs_avances_adj_avances"><?php echo $cs_avances->adj_avances->FldCaption() ?></span></td>
		<td data-name="adj_avances"<?php echo $cs_avances->adj_avances->CellAttributes() ?>>
<span id="el_cs_avances_adj_avances">
<span<?php echo $cs_avances->adj_avances->ViewAttributes() ?>>
<?php echo $cs_avances->adj_avances->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_supervicion->Visible) { // adj_supervicion ?>
	<tr id="r_adj_supervicion">
		<td><span id="elh_cs_avances_adj_supervicion"><?php echo $cs_avances->adj_supervicion->FldCaption() ?></span></td>
		<td data-name="adj_supervicion"<?php echo $cs_avances->adj_supervicion->CellAttributes() ?>>
<span id="el_cs_avances_adj_supervicion">
<span<?php echo $cs_avances->adj_supervicion->ViewAttributes() ?>>
<?php echo $cs_avances->adj_supervicion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_evaluacion->Visible) { // adj_evaluacion ?>
	<tr id="r_adj_evaluacion">
		<td><span id="elh_cs_avances_adj_evaluacion"><?php echo $cs_avances->adj_evaluacion->FldCaption() ?></span></td>
		<td data-name="adj_evaluacion"<?php echo $cs_avances->adj_evaluacion->CellAttributes() ?>>
<span id="el_cs_avances_adj_evaluacion">
<span<?php echo $cs_avances->adj_evaluacion->ViewAttributes() ?>>
<?php echo $cs_avances->adj_evaluacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_tecnica->Visible) { // adj_tecnica ?>
	<tr id="r_adj_tecnica">
		<td><span id="elh_cs_avances_adj_tecnica"><?php echo $cs_avances->adj_tecnica->FldCaption() ?></span></td>
		<td data-name="adj_tecnica"<?php echo $cs_avances->adj_tecnica->CellAttributes() ?>>
<span id="el_cs_avances_adj_tecnica">
<span<?php echo $cs_avances->adj_tecnica->ViewAttributes() ?>>
<?php echo $cs_avances->adj_tecnica->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_financiero->Visible) { // adj_financiero ?>
	<tr id="r_adj_financiero">
		<td><span id="elh_cs_avances_adj_financiero"><?php echo $cs_avances->adj_financiero->FldCaption() ?></span></td>
		<td data-name="adj_financiero"<?php echo $cs_avances->adj_financiero->CellAttributes() ?>>
<span id="el_cs_avances_adj_financiero">
<span<?php echo $cs_avances->adj_financiero->ViewAttributes() ?>>
<?php echo $cs_avances->adj_financiero->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_recepcion->Visible) { // adj_recepcion ?>
	<tr id="r_adj_recepcion">
		<td><span id="elh_cs_avances_adj_recepcion"><?php echo $cs_avances->adj_recepcion->FldCaption() ?></span></td>
		<td data-name="adj_recepcion"<?php echo $cs_avances->adj_recepcion->CellAttributes() ?>>
<span id="el_cs_avances_adj_recepcion">
<span<?php echo $cs_avances->adj_recepcion->ViewAttributes() ?>>
<?php echo $cs_avances->adj_recepcion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_avances->adj_disconformidad->Visible) { // adj_disconformidad ?>
	<tr id="r_adj_disconformidad">
		<td><span id="elh_cs_avances_adj_disconformidad"><?php echo $cs_avances->adj_disconformidad->FldCaption() ?></span></td>
		<td data-name="adj_disconformidad"<?php echo $cs_avances->adj_disconformidad->CellAttributes() ?>>
<span id="el_cs_avances_adj_disconformidad">
<span<?php echo $cs_avances->adj_disconformidad->ViewAttributes() ?>>
<?php echo $cs_avances->adj_disconformidad->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<script type="text/javascript">
fcs_avancesview.Init();
</script>
<?php
$cs_avances_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_avances_view->Page_Terminate();
?>
