<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_contratosinfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_contratos_view = NULL; // Initialize page object first

class ccs_contratos_view extends ccs_contratos {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_contratos';

	// Page object name
	var $PageObjName = 'cs_contratos_view';

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

		// Table object (cs_contratos)
		if (!isset($GLOBALS["cs_contratos"]) || get_class($GLOBALS["cs_contratos"]) == "ccs_contratos") {
			$GLOBALS["cs_contratos"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_contratos"];
		}
		$KeyUrl = "";
		if (@$_GET["idContratos"] <> "") {
			$this->RecKey["idContratos"] = $_GET["idContratos"];
			$KeyUrl .= "&amp;idContratos=" . urlencode($this->RecKey["idContratos"]);
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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_contratos', TRUE);

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
		$this->idContratos->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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
		global $EW_EXPORT, $cs_contratos;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_contratos);
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

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["idContratos"] <> "") {
				$this->idContratos->setQueryStringValue($_GET["idContratos"]);
				$this->RecKey["idContratos"] = $this->idContratos->QueryStringValue;
			} elseif (@$_POST["idContratos"] <> "") {
				$this->idContratos->setFormValue($_POST["idContratos"]);
				$this->RecKey["idContratos"] = $this->idContratos->FormValue;
			} else {
				$sReturnUrl = "cs_contratoslist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_contratoslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_contratoslist.php"; // Not page request, return to list
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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idContratos->DbValue = $row['idContratos'];
		$this->idContratacion->DbValue = $row['idContratacion'];
		$this->estatuscontrato->DbValue = $row['estatuscontrato'];
		$this->nmodifica->DbValue = $row['nmodifica'];
		$this->fecha->DbValue = $row['fecha'];
		$this->tipomodifica->DbValue = $row['tipomodifica'];
		$this->justimodcontrato->DbValue = $row['justimodcontrato'];
		$this->precioactual->DbValue = $row['precioactual'];
		$this->fechatercontra->DbValue = $row['fechatercontra'];
		$this->alcanceactucontrato->DbValue = $row['alcanceactucontrato'];
		$this->detallesreadju->DbValue = $row['detallesreadju'];
		$this->prograini->DbValue = $row['prograini'];
		$this->adendas->DbValue = $row['adendas'];
		$this->prograactu->DbValue = $row['prograactu'];
		$this->estado->DbValue = $row['estado'];
		$this->otro->DbValue = $row['otro'];
		$this->fecharecibido->DbValue = $row['fecharecibido'];
		$this->fechacreacion->DbValue = $row['fechacreacion'];
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
		if ($this->precioactual->FormValue == $this->precioactual->CurrentValue && is_numeric(ew_StrToFloat($this->precioactual->CurrentValue)))
			$this->precioactual->CurrentValue = ew_StrToFloat($this->precioactual->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_contratoslist.php", "", $this->TableVar, TRUE);
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
if (!isset($cs_contratos_view)) $cs_contratos_view = new ccs_contratos_view();

// Page init
$cs_contratos_view->Page_Init();

// Page main
$cs_contratos_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_contratos_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_contratosview = new ew_Form("fcs_contratosview", "view");

// Form_CustomValidate event
fcs_contratosview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_contratosview.ValidateRequired = true;
<?php } else { ?>
fcs_contratosview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_contratos_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_contratos_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_contratos_view->ShowPageHeader(); ?>
<?php
$cs_contratos_view->ShowMessage();
?>
<form name="fcs_contratosview" id="fcs_contratosview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_contratos_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_contratos_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_contratos">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_contratos->idContratos->Visible) { // idContratos ?>
	<tr id="r_idContratos">
		<td><span id="elh_cs_contratos_idContratos"><?php echo $cs_contratos->idContratos->FldCaption() ?></span></td>
		<td data-name="idContratos"<?php echo $cs_contratos->idContratos->CellAttributes() ?>>
<span id="el_cs_contratos_idContratos">
<span<?php echo $cs_contratos->idContratos->ViewAttributes() ?>>
<?php echo $cs_contratos->idContratos->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->idContratacion->Visible) { // idContratacion ?>
	<tr id="r_idContratacion">
		<td><span id="elh_cs_contratos_idContratacion"><?php echo $cs_contratos->idContratacion->FldCaption() ?></span></td>
		<td data-name="idContratacion"<?php echo $cs_contratos->idContratacion->CellAttributes() ?>>
<span id="el_cs_contratos_idContratacion">
<span<?php echo $cs_contratos->idContratacion->ViewAttributes() ?>>
<?php echo $cs_contratos->idContratacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->estatuscontrato->Visible) { // estatuscontrato ?>
	<tr id="r_estatuscontrato">
		<td><span id="elh_cs_contratos_estatuscontrato"><?php echo $cs_contratos->estatuscontrato->FldCaption() ?></span></td>
		<td data-name="estatuscontrato"<?php echo $cs_contratos->estatuscontrato->CellAttributes() ?>>
<span id="el_cs_contratos_estatuscontrato">
<span<?php echo $cs_contratos->estatuscontrato->ViewAttributes() ?>>
<?php echo $cs_contratos->estatuscontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->nmodifica->Visible) { // nmodifica ?>
	<tr id="r_nmodifica">
		<td><span id="elh_cs_contratos_nmodifica"><?php echo $cs_contratos->nmodifica->FldCaption() ?></span></td>
		<td data-name="nmodifica"<?php echo $cs_contratos->nmodifica->CellAttributes() ?>>
<span id="el_cs_contratos_nmodifica">
<span<?php echo $cs_contratos->nmodifica->ViewAttributes() ?>>
<?php echo $cs_contratos->nmodifica->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td><span id="elh_cs_contratos_fecha"><?php echo $cs_contratos->fecha->FldCaption() ?></span></td>
		<td data-name="fecha"<?php echo $cs_contratos->fecha->CellAttributes() ?>>
<span id="el_cs_contratos_fecha">
<span<?php echo $cs_contratos->fecha->ViewAttributes() ?>>
<?php echo $cs_contratos->fecha->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->tipomodifica->Visible) { // tipomodifica ?>
	<tr id="r_tipomodifica">
		<td><span id="elh_cs_contratos_tipomodifica"><?php echo $cs_contratos->tipomodifica->FldCaption() ?></span></td>
		<td data-name="tipomodifica"<?php echo $cs_contratos->tipomodifica->CellAttributes() ?>>
<span id="el_cs_contratos_tipomodifica">
<span<?php echo $cs_contratos->tipomodifica->ViewAttributes() ?>>
<?php echo $cs_contratos->tipomodifica->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->justimodcontrato->Visible) { // justimodcontrato ?>
	<tr id="r_justimodcontrato">
		<td><span id="elh_cs_contratos_justimodcontrato"><?php echo $cs_contratos->justimodcontrato->FldCaption() ?></span></td>
		<td data-name="justimodcontrato"<?php echo $cs_contratos->justimodcontrato->CellAttributes() ?>>
<span id="el_cs_contratos_justimodcontrato">
<span<?php echo $cs_contratos->justimodcontrato->ViewAttributes() ?>>
<?php echo $cs_contratos->justimodcontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->precioactual->Visible) { // precioactual ?>
	<tr id="r_precioactual">
		<td><span id="elh_cs_contratos_precioactual"><?php echo $cs_contratos->precioactual->FldCaption() ?></span></td>
		<td data-name="precioactual"<?php echo $cs_contratos->precioactual->CellAttributes() ?>>
<span id="el_cs_contratos_precioactual">
<span<?php echo $cs_contratos->precioactual->ViewAttributes() ?>>
<?php echo $cs_contratos->precioactual->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->fechatercontra->Visible) { // fechatercontra ?>
	<tr id="r_fechatercontra">
		<td><span id="elh_cs_contratos_fechatercontra"><?php echo $cs_contratos->fechatercontra->FldCaption() ?></span></td>
		<td data-name="fechatercontra"<?php echo $cs_contratos->fechatercontra->CellAttributes() ?>>
<span id="el_cs_contratos_fechatercontra">
<span<?php echo $cs_contratos->fechatercontra->ViewAttributes() ?>>
<?php echo $cs_contratos->fechatercontra->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->alcanceactucontrato->Visible) { // alcanceactucontrato ?>
	<tr id="r_alcanceactucontrato">
		<td><span id="elh_cs_contratos_alcanceactucontrato"><?php echo $cs_contratos->alcanceactucontrato->FldCaption() ?></span></td>
		<td data-name="alcanceactucontrato"<?php echo $cs_contratos->alcanceactucontrato->CellAttributes() ?>>
<span id="el_cs_contratos_alcanceactucontrato">
<span<?php echo $cs_contratos->alcanceactucontrato->ViewAttributes() ?>>
<?php echo $cs_contratos->alcanceactucontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->detallesreadju->Visible) { // detallesreadju ?>
	<tr id="r_detallesreadju">
		<td><span id="elh_cs_contratos_detallesreadju"><?php echo $cs_contratos->detallesreadju->FldCaption() ?></span></td>
		<td data-name="detallesreadju"<?php echo $cs_contratos->detallesreadju->CellAttributes() ?>>
<span id="el_cs_contratos_detallesreadju">
<span<?php echo $cs_contratos->detallesreadju->ViewAttributes() ?>>
<?php echo $cs_contratos->detallesreadju->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->prograini->Visible) { // prograini ?>
	<tr id="r_prograini">
		<td><span id="elh_cs_contratos_prograini"><?php echo $cs_contratos->prograini->FldCaption() ?></span></td>
		<td data-name="prograini"<?php echo $cs_contratos->prograini->CellAttributes() ?>>
<span id="el_cs_contratos_prograini">
<span<?php echo $cs_contratos->prograini->ViewAttributes() ?>>
<?php echo $cs_contratos->prograini->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->adendas->Visible) { // adendas ?>
	<tr id="r_adendas">
		<td><span id="elh_cs_contratos_adendas"><?php echo $cs_contratos->adendas->FldCaption() ?></span></td>
		<td data-name="adendas"<?php echo $cs_contratos->adendas->CellAttributes() ?>>
<span id="el_cs_contratos_adendas">
<span<?php echo $cs_contratos->adendas->ViewAttributes() ?>>
<?php echo $cs_contratos->adendas->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->prograactu->Visible) { // prograactu ?>
	<tr id="r_prograactu">
		<td><span id="elh_cs_contratos_prograactu"><?php echo $cs_contratos->prograactu->FldCaption() ?></span></td>
		<td data-name="prograactu"<?php echo $cs_contratos->prograactu->CellAttributes() ?>>
<span id="el_cs_contratos_prograactu">
<span<?php echo $cs_contratos->prograactu->ViewAttributes() ?>>
<?php echo $cs_contratos->prograactu->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td><span id="elh_cs_contratos_estado"><?php echo $cs_contratos->estado->FldCaption() ?></span></td>
		<td data-name="estado"<?php echo $cs_contratos->estado->CellAttributes() ?>>
<span id="el_cs_contratos_estado">
<span<?php echo $cs_contratos->estado->ViewAttributes() ?>>
<?php echo $cs_contratos->estado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->otro->Visible) { // otro ?>
	<tr id="r_otro">
		<td><span id="elh_cs_contratos_otro"><?php echo $cs_contratos->otro->FldCaption() ?></span></td>
		<td data-name="otro"<?php echo $cs_contratos->otro->CellAttributes() ?>>
<span id="el_cs_contratos_otro">
<span<?php echo $cs_contratos->otro->ViewAttributes() ?>>
<?php echo $cs_contratos->otro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->fecharecibido->Visible) { // fecharecibido ?>
	<tr id="r_fecharecibido">
		<td><span id="elh_cs_contratos_fecharecibido"><?php echo $cs_contratos->fecharecibido->FldCaption() ?></span></td>
		<td data-name="fecharecibido"<?php echo $cs_contratos->fecharecibido->CellAttributes() ?>>
<span id="el_cs_contratos_fecharecibido">
<span<?php echo $cs_contratos->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_contratos->fecharecibido->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratos->fechacreacion->Visible) { // fechacreacion ?>
	<tr id="r_fechacreacion">
		<td><span id="elh_cs_contratos_fechacreacion"><?php echo $cs_contratos->fechacreacion->FldCaption() ?></span></td>
		<td data-name="fechacreacion"<?php echo $cs_contratos->fechacreacion->CellAttributes() ?>>
<span id="el_cs_contratos_fechacreacion">
<span<?php echo $cs_contratos->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_contratos->fechacreacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<script type="text/javascript">
fcs_contratosview.Init();
</script>
<?php
$cs_contratos_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_contratos_view->Page_Terminate();
?>
