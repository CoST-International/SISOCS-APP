<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_contratacioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_adjudicacioninfo.php" ?>
<?php include_once "cs_inicio_ejecuciongridcls.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_contratacion_list = NULL; // Initialize page object first

class ccs_contratacion_list extends ccs_contratacion {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_contratacion';

	// Page object name
	var $PageObjName = 'cs_contratacion_list';

	// Grid form hidden field names
	var $FormName = 'fcs_contratacionlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

		// Table object (cs_contratacion)
		if (!isset($GLOBALS["cs_contratacion"]) || get_class($GLOBALS["cs_contratacion"]) == "ccs_contratacion") {
			$GLOBALS["cs_contratacion"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_contratacion"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cs_contratacionadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cs_contrataciondelete.php";
		$this->MultiUpdateUrl = "cs_contratacionupdate.php";

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Table object (cs_adjudicacion)
		if (!isset($GLOBALS['cs_adjudicacion'])) $GLOBALS['cs_adjudicacion'] = new ccs_adjudicacion();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_contratacion', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (cruge_user)
		if (!isset($UserTable)) {
			$UserTable = new ccruge_user();
			$UserTableConn = Conn($UserTable->DBID);
		}

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fcs_contratacionlistsrch";

		// List actions
		$this->ListActions = new cListActions();
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

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->idContratacion->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Process auto fill for detail table 'cs_inicio_ejecucion'
			if (@$_POST["grid"] == "fcs_inicio_ejecuciongrid") {
				if (!isset($GLOBALS["cs_inicio_ejecucion_grid"])) $GLOBALS["cs_inicio_ejecucion_grid"] = new ccs_inicio_ejecucion_grid;
				$GLOBALS["cs_inicio_ejecucion_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
		global $EW_EXPORT, $cs_contratacion;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_contratacion);
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore filter list
			$this->RestoreFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_adjudicacion") {
			global $cs_adjudicacion;
			$rsmaster = $cs_adjudicacion->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cs_adjudicacionlist.php"); // Return to master page
			} else {
				$cs_adjudicacion->LoadListRowValues($rsmaster);
				$cs_adjudicacion->RowType = EW_ROWTYPE_MASTER; // Master row
				$cs_adjudicacion->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->SelectRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->idContratacion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idContratacion->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->idContratacion->AdvancedSearch->ToJSON(), ","); // Field idContratacion
		$sFilterList = ew_Concat($sFilterList, $this->idAdjudicacion->AdvancedSearch->ToJSON(), ","); // Field idAdjudicacion
		$sFilterList = ew_Concat($sFilterList, $this->idEntidad->AdvancedSearch->ToJSON(), ","); // Field idEntidad
		$sFilterList = ew_Concat($sFilterList, $this->idoferente->AdvancedSearch->ToJSON(), ","); // Field idoferente
		$sFilterList = ew_Concat($sFilterList, $this->precio->AdvancedSearch->ToJSON(), ","); // Field precio
		$sFilterList = ew_Concat($sFilterList, $this->precio2->AdvancedSearch->ToJSON(), ","); // Field precio2
		$sFilterList = ew_Concat($sFilterList, $this->alcances->AdvancedSearch->ToJSON(), ","); // Field alcances
		$sFilterList = ew_Concat($sFilterList, $this->fechainicio->AdvancedSearch->ToJSON(), ","); // Field fechainicio
		$sFilterList = ew_Concat($sFilterList, $this->fechafinal->AdvancedSearch->ToJSON(), ","); // Field fechafinal
		$sFilterList = ew_Concat($sFilterList, $this->duracioncontrato->AdvancedSearch->ToJSON(), ","); // Field duracioncontrato
		$sFilterList = ew_Concat($sFilterList, $this->documentocontra->AdvancedSearch->ToJSON(), ","); // Field documentocontra
		$sFilterList = ew_Concat($sFilterList, $this->regante->AdvancedSearch->ToJSON(), ","); // Field regante
		$sFilterList = ew_Concat($sFilterList, $this->espeplanos->AdvancedSearch->ToJSON(), ","); // Field espeplanos
		$sFilterList = ew_Concat($sFilterList, $this->estado->AdvancedSearch->ToJSON(), ","); // Field estado
		$sFilterList = ew_Concat($sFilterList, $this->otro->AdvancedSearch->ToJSON(), ","); // Field otro
		$sFilterList = ew_Concat($sFilterList, $this->ncontrato->AdvancedSearch->ToJSON(), ","); // Field ncontrato
		$sFilterList = ew_Concat($sFilterList, $this->titulocontrato->AdvancedSearch->ToJSON(), ","); // Field titulocontrato
		$sFilterList = ew_Concat($sFilterList, $this->fecharecibido->AdvancedSearch->ToJSON(), ","); // Field fecharecibido
		$sFilterList = ew_Concat($sFilterList, $this->fechacreacion->AdvancedSearch->ToJSON(), ","); // Field fechacreacion
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"psearch\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"psearchtype\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}

		// Return filter list in json
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ew_StripSlashes(@$_POST["filter"]), TRUE);
		$this->Command = "search";

		// Field idContratacion
		$this->idContratacion->AdvancedSearch->SearchValue = @$filter["x_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchOperator = @$filter["z_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchCondition = @$filter["v_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchValue2 = @$filter["y_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchOperator2 = @$filter["w_idContratacion"];
		$this->idContratacion->AdvancedSearch->Save();

		// Field idAdjudicacion
		$this->idAdjudicacion->AdvancedSearch->SearchValue = @$filter["x_idAdjudicacion"];
		$this->idAdjudicacion->AdvancedSearch->SearchOperator = @$filter["z_idAdjudicacion"];
		$this->idAdjudicacion->AdvancedSearch->SearchCondition = @$filter["v_idAdjudicacion"];
		$this->idAdjudicacion->AdvancedSearch->SearchValue2 = @$filter["y_idAdjudicacion"];
		$this->idAdjudicacion->AdvancedSearch->SearchOperator2 = @$filter["w_idAdjudicacion"];
		$this->idAdjudicacion->AdvancedSearch->Save();

		// Field idEntidad
		$this->idEntidad->AdvancedSearch->SearchValue = @$filter["x_idEntidad"];
		$this->idEntidad->AdvancedSearch->SearchOperator = @$filter["z_idEntidad"];
		$this->idEntidad->AdvancedSearch->SearchCondition = @$filter["v_idEntidad"];
		$this->idEntidad->AdvancedSearch->SearchValue2 = @$filter["y_idEntidad"];
		$this->idEntidad->AdvancedSearch->SearchOperator2 = @$filter["w_idEntidad"];
		$this->idEntidad->AdvancedSearch->Save();

		// Field idoferente
		$this->idoferente->AdvancedSearch->SearchValue = @$filter["x_idoferente"];
		$this->idoferente->AdvancedSearch->SearchOperator = @$filter["z_idoferente"];
		$this->idoferente->AdvancedSearch->SearchCondition = @$filter["v_idoferente"];
		$this->idoferente->AdvancedSearch->SearchValue2 = @$filter["y_idoferente"];
		$this->idoferente->AdvancedSearch->SearchOperator2 = @$filter["w_idoferente"];
		$this->idoferente->AdvancedSearch->Save();

		// Field precio
		$this->precio->AdvancedSearch->SearchValue = @$filter["x_precio"];
		$this->precio->AdvancedSearch->SearchOperator = @$filter["z_precio"];
		$this->precio->AdvancedSearch->SearchCondition = @$filter["v_precio"];
		$this->precio->AdvancedSearch->SearchValue2 = @$filter["y_precio"];
		$this->precio->AdvancedSearch->SearchOperator2 = @$filter["w_precio"];
		$this->precio->AdvancedSearch->Save();

		// Field precio2
		$this->precio2->AdvancedSearch->SearchValue = @$filter["x_precio2"];
		$this->precio2->AdvancedSearch->SearchOperator = @$filter["z_precio2"];
		$this->precio2->AdvancedSearch->SearchCondition = @$filter["v_precio2"];
		$this->precio2->AdvancedSearch->SearchValue2 = @$filter["y_precio2"];
		$this->precio2->AdvancedSearch->SearchOperator2 = @$filter["w_precio2"];
		$this->precio2->AdvancedSearch->Save();

		// Field alcances
		$this->alcances->AdvancedSearch->SearchValue = @$filter["x_alcances"];
		$this->alcances->AdvancedSearch->SearchOperator = @$filter["z_alcances"];
		$this->alcances->AdvancedSearch->SearchCondition = @$filter["v_alcances"];
		$this->alcances->AdvancedSearch->SearchValue2 = @$filter["y_alcances"];
		$this->alcances->AdvancedSearch->SearchOperator2 = @$filter["w_alcances"];
		$this->alcances->AdvancedSearch->Save();

		// Field fechainicio
		$this->fechainicio->AdvancedSearch->SearchValue = @$filter["x_fechainicio"];
		$this->fechainicio->AdvancedSearch->SearchOperator = @$filter["z_fechainicio"];
		$this->fechainicio->AdvancedSearch->SearchCondition = @$filter["v_fechainicio"];
		$this->fechainicio->AdvancedSearch->SearchValue2 = @$filter["y_fechainicio"];
		$this->fechainicio->AdvancedSearch->SearchOperator2 = @$filter["w_fechainicio"];
		$this->fechainicio->AdvancedSearch->Save();

		// Field fechafinal
		$this->fechafinal->AdvancedSearch->SearchValue = @$filter["x_fechafinal"];
		$this->fechafinal->AdvancedSearch->SearchOperator = @$filter["z_fechafinal"];
		$this->fechafinal->AdvancedSearch->SearchCondition = @$filter["v_fechafinal"];
		$this->fechafinal->AdvancedSearch->SearchValue2 = @$filter["y_fechafinal"];
		$this->fechafinal->AdvancedSearch->SearchOperator2 = @$filter["w_fechafinal"];
		$this->fechafinal->AdvancedSearch->Save();

		// Field duracioncontrato
		$this->duracioncontrato->AdvancedSearch->SearchValue = @$filter["x_duracioncontrato"];
		$this->duracioncontrato->AdvancedSearch->SearchOperator = @$filter["z_duracioncontrato"];
		$this->duracioncontrato->AdvancedSearch->SearchCondition = @$filter["v_duracioncontrato"];
		$this->duracioncontrato->AdvancedSearch->SearchValue2 = @$filter["y_duracioncontrato"];
		$this->duracioncontrato->AdvancedSearch->SearchOperator2 = @$filter["w_duracioncontrato"];
		$this->duracioncontrato->AdvancedSearch->Save();

		// Field documentocontra
		$this->documentocontra->AdvancedSearch->SearchValue = @$filter["x_documentocontra"];
		$this->documentocontra->AdvancedSearch->SearchOperator = @$filter["z_documentocontra"];
		$this->documentocontra->AdvancedSearch->SearchCondition = @$filter["v_documentocontra"];
		$this->documentocontra->AdvancedSearch->SearchValue2 = @$filter["y_documentocontra"];
		$this->documentocontra->AdvancedSearch->SearchOperator2 = @$filter["w_documentocontra"];
		$this->documentocontra->AdvancedSearch->Save();

		// Field regante
		$this->regante->AdvancedSearch->SearchValue = @$filter["x_regante"];
		$this->regante->AdvancedSearch->SearchOperator = @$filter["z_regante"];
		$this->regante->AdvancedSearch->SearchCondition = @$filter["v_regante"];
		$this->regante->AdvancedSearch->SearchValue2 = @$filter["y_regante"];
		$this->regante->AdvancedSearch->SearchOperator2 = @$filter["w_regante"];
		$this->regante->AdvancedSearch->Save();

		// Field espeplanos
		$this->espeplanos->AdvancedSearch->SearchValue = @$filter["x_espeplanos"];
		$this->espeplanos->AdvancedSearch->SearchOperator = @$filter["z_espeplanos"];
		$this->espeplanos->AdvancedSearch->SearchCondition = @$filter["v_espeplanos"];
		$this->espeplanos->AdvancedSearch->SearchValue2 = @$filter["y_espeplanos"];
		$this->espeplanos->AdvancedSearch->SearchOperator2 = @$filter["w_espeplanos"];
		$this->espeplanos->AdvancedSearch->Save();

		// Field estado
		$this->estado->AdvancedSearch->SearchValue = @$filter["x_estado"];
		$this->estado->AdvancedSearch->SearchOperator = @$filter["z_estado"];
		$this->estado->AdvancedSearch->SearchCondition = @$filter["v_estado"];
		$this->estado->AdvancedSearch->SearchValue2 = @$filter["y_estado"];
		$this->estado->AdvancedSearch->SearchOperator2 = @$filter["w_estado"];
		$this->estado->AdvancedSearch->Save();

		// Field otro
		$this->otro->AdvancedSearch->SearchValue = @$filter["x_otro"];
		$this->otro->AdvancedSearch->SearchOperator = @$filter["z_otro"];
		$this->otro->AdvancedSearch->SearchCondition = @$filter["v_otro"];
		$this->otro->AdvancedSearch->SearchValue2 = @$filter["y_otro"];
		$this->otro->AdvancedSearch->SearchOperator2 = @$filter["w_otro"];
		$this->otro->AdvancedSearch->Save();

		// Field ncontrato
		$this->ncontrato->AdvancedSearch->SearchValue = @$filter["x_ncontrato"];
		$this->ncontrato->AdvancedSearch->SearchOperator = @$filter["z_ncontrato"];
		$this->ncontrato->AdvancedSearch->SearchCondition = @$filter["v_ncontrato"];
		$this->ncontrato->AdvancedSearch->SearchValue2 = @$filter["y_ncontrato"];
		$this->ncontrato->AdvancedSearch->SearchOperator2 = @$filter["w_ncontrato"];
		$this->ncontrato->AdvancedSearch->Save();

		// Field titulocontrato
		$this->titulocontrato->AdvancedSearch->SearchValue = @$filter["x_titulocontrato"];
		$this->titulocontrato->AdvancedSearch->SearchOperator = @$filter["z_titulocontrato"];
		$this->titulocontrato->AdvancedSearch->SearchCondition = @$filter["v_titulocontrato"];
		$this->titulocontrato->AdvancedSearch->SearchValue2 = @$filter["y_titulocontrato"];
		$this->titulocontrato->AdvancedSearch->SearchOperator2 = @$filter["w_titulocontrato"];
		$this->titulocontrato->AdvancedSearch->Save();

		// Field fecharecibido
		$this->fecharecibido->AdvancedSearch->SearchValue = @$filter["x_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchOperator = @$filter["z_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchCondition = @$filter["v_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchValue2 = @$filter["y_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchOperator2 = @$filter["w_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->Save();

		// Field fechacreacion
		$this->fechacreacion->AdvancedSearch->SearchValue = @$filter["x_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchOperator = @$filter["z_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchCondition = @$filter["v_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchValue2 = @$filter["y_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchOperator2 = @$filter["w_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter["psearch"]);
		$this->BasicSearch->setType(@$filter["psearchtype"]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->alcances, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechainicio, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechafinal, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->duracioncontrato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->documentocontra, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->regante, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->espeplanos, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estado, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->otro, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->ncontrato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->titulocontrato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fecharecibido, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechacreacion, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $arKeywords, $type) {
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$sCond = $sDefCond;
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if (EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace(EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual && $Fld->FldVirtualSearch) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .=  "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "=") {
				$ar = array();

				// Match quoted keywords (i.e.: "...")
				if (preg_match_all('/"([^"]*)"/i', $sSearch, $matches, PREG_SET_ORDER)) {
					foreach ($matches as $match) {
						$p = strpos($sSearch, $match[0]);
						$str = substr($sSearch, 0, $p);
						$sSearch = substr($sSearch, $p + strlen($match[0]));
						if (strlen(trim($str)) > 0)
							$ar = array_merge($ar, explode(" ", trim($str)));
						$ar[] = $match[1]; // Save quoted keyword
					}
				}

				// Match individual keywords
				if (strlen(trim($sSearch)) > 0)
					$ar = array_merge($ar, explode(" ", trim($sSearch)));
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			} else {
				$sSearchStr = $this->BasicSearchSQL(array($sSearch), $sSearchType);
			}
			if (!$Default) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->idContratacion); // idContratacion
			$this->UpdateSort($this->idAdjudicacion); // idAdjudicacion
			$this->UpdateSort($this->idEntidad); // idEntidad
			$this->UpdateSort($this->idoferente); // idoferente
			$this->UpdateSort($this->precio); // precio
			$this->UpdateSort($this->precio2); // precio2
			$this->UpdateSort($this->fechainicio); // fechainicio
			$this->UpdateSort($this->fechafinal); // fechafinal
			$this->UpdateSort($this->duracioncontrato); // duracioncontrato
			$this->UpdateSort($this->documentocontra); // documentocontra
			$this->UpdateSort($this->regante); // regante
			$this->UpdateSort($this->espeplanos); // espeplanos
			$this->UpdateSort($this->estado); // estado
			$this->UpdateSort($this->otro); // otro
			$this->UpdateSort($this->ncontrato); // ncontrato
			$this->UpdateSort($this->fecharecibido); // fecharecibido
			$this->UpdateSort($this->fechacreacion); // fechacreacion
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->idAdjudicacion->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->idContratacion->setSort("");
				$this->idAdjudicacion->setSort("");
				$this->idEntidad->setSort("");
				$this->idoferente->setSort("");
				$this->precio->setSort("");
				$this->precio2->setSort("");
				$this->fechainicio->setSort("");
				$this->fechafinal->setSort("");
				$this->duracioncontrato->setSort("");
				$this->documentocontra->setSort("");
				$this->regante->setSort("");
				$this->espeplanos->setSort("");
				$this->estado->setSort("");
				$this->otro->setSort("");
				$this->ncontrato->setSort("");
				$this->fecharecibido->setSort("");
				$this->fechacreacion->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "detail_cs_inicio_ejecucion"
		$item = &$this->ListOptions->Add("detail_cs_inicio_ejecucion");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_inicio_ejecucion') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cs_inicio_ejecucion_grid"])) $GLOBALS["cs_inicio_ejecucion_grid"] = new ccs_inicio_ejecucion_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssStyle = "white-space: nowrap;";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = FALSE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("cs_inicio_ejecucion");
		$this->DetailPages = $pages;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssStyle = "white-space: nowrap;";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		if ($Security->CanView())
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewLink")) . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		else
			$oListOpt->Body = "";

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt) {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_cs_inicio_ejecucion"
		$oListOpt = &$this->ListOptions->Items["detail_cs_inicio_ejecucion"];
		if ($Security->AllowList(CurrentProjectID() . 'cs_inicio_ejecucion')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("cs_inicio_ejecucion", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_inicio_ejecucionlist.php?" . EW_TABLE_SHOW_MASTER . "=cs_contratacion&fk_idContratacion=" . urlencode(strval($this->idContratacion->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cs_inicio_ejecucion_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_inicio_ejecucion')) {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_inicio_ejecucion")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "cs_inicio_ejecucion";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
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
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->idContratacion->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fcs_contratacionlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fcs_contratacionlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fcs_contratacionlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fcs_contratacionlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->idContratacion->setDbValue($rs->fields('idContratacion'));
		$this->idAdjudicacion->setDbValue($rs->fields('idAdjudicacion'));
		$this->idEntidad->setDbValue($rs->fields('idEntidad'));
		$this->idoferente->setDbValue($rs->fields('idoferente'));
		$this->precio->setDbValue($rs->fields('precio'));
		$this->precio2->setDbValue($rs->fields('precio2'));
		$this->alcances->setDbValue($rs->fields('alcances'));
		$this->fechainicio->setDbValue($rs->fields('fechainicio'));
		$this->fechafinal->setDbValue($rs->fields('fechafinal'));
		$this->duracioncontrato->setDbValue($rs->fields('duracioncontrato'));
		$this->documentocontra->setDbValue($rs->fields('documentocontra'));
		$this->regante->setDbValue($rs->fields('regante'));
		$this->espeplanos->setDbValue($rs->fields('espeplanos'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro->setDbValue($rs->fields('otro'));
		$this->ncontrato->setDbValue($rs->fields('ncontrato'));
		$this->titulocontrato->setDbValue($rs->fields('titulocontrato'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idContratacion->DbValue = $row['idContratacion'];
		$this->idAdjudicacion->DbValue = $row['idAdjudicacion'];
		$this->idEntidad->DbValue = $row['idEntidad'];
		$this->idoferente->DbValue = $row['idoferente'];
		$this->precio->DbValue = $row['precio'];
		$this->precio2->DbValue = $row['precio2'];
		$this->alcances->DbValue = $row['alcances'];
		$this->fechainicio->DbValue = $row['fechainicio'];
		$this->fechafinal->DbValue = $row['fechafinal'];
		$this->duracioncontrato->DbValue = $row['duracioncontrato'];
		$this->documentocontra->DbValue = $row['documentocontra'];
		$this->regante->DbValue = $row['regante'];
		$this->espeplanos->DbValue = $row['espeplanos'];
		$this->estado->DbValue = $row['estado'];
		$this->otro->DbValue = $row['otro'];
		$this->ncontrato->DbValue = $row['ncontrato'];
		$this->titulocontrato->DbValue = $row['titulocontrato'];
		$this->fecharecibido->DbValue = $row['fecharecibido'];
		$this->fechacreacion->DbValue = $row['fechacreacion'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("idContratacion")) <> "")
			$this->idContratacion->CurrentValue = $this->getKey("idContratacion"); // idContratacion
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Convert decimal values if posted back
		if ($this->precio->FormValue == $this->precio->CurrentValue && is_numeric(ew_StrToFloat($this->precio->CurrentValue)))
			$this->precio->CurrentValue = ew_StrToFloat($this->precio->CurrentValue);

		// Convert decimal values if posted back
		if ($this->precio2->FormValue == $this->precio2->CurrentValue && is_numeric(ew_StrToFloat($this->precio2->CurrentValue)))
			$this->precio2->CurrentValue = ew_StrToFloat($this->precio2->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// idContratacion
		// idAdjudicacion
		// idEntidad
		// idoferente
		// precio
		// precio2
		// alcances
		// fechainicio
		// fechafinal
		// duracioncontrato
		// documentocontra
		// regante
		// espeplanos
		// estado
		// otro
		// ncontrato
		// titulocontrato
		// fecharecibido
		// fechacreacion

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// idContratacion
		$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
		$this->idContratacion->ViewCustomAttributes = "";

		// idAdjudicacion
		$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";

		// idEntidad
		$this->idEntidad->ViewValue = $this->idEntidad->CurrentValue;
		$this->idEntidad->ViewCustomAttributes = "";

		// idoferente
		$this->idoferente->ViewValue = $this->idoferente->CurrentValue;
		$this->idoferente->ViewCustomAttributes = "";

		// precio
		$this->precio->ViewValue = $this->precio->CurrentValue;
		$this->precio->ViewCustomAttributes = "";

		// precio2
		$this->precio2->ViewValue = $this->precio2->CurrentValue;
		$this->precio2->ViewCustomAttributes = "";

		// fechainicio
		$this->fechainicio->ViewValue = $this->fechainicio->CurrentValue;
		$this->fechainicio->ViewCustomAttributes = "";

		// fechafinal
		$this->fechafinal->ViewValue = $this->fechafinal->CurrentValue;
		$this->fechafinal->ViewCustomAttributes = "";

		// duracioncontrato
		$this->duracioncontrato->ViewValue = $this->duracioncontrato->CurrentValue;
		$this->duracioncontrato->ViewCustomAttributes = "";

		// documentocontra
		$this->documentocontra->ViewValue = $this->documentocontra->CurrentValue;
		$this->documentocontra->ViewCustomAttributes = "";

		// regante
		$this->regante->ViewValue = $this->regante->CurrentValue;
		$this->regante->ViewCustomAttributes = "";

		// espeplanos
		$this->espeplanos->ViewValue = $this->espeplanos->CurrentValue;
		$this->espeplanos->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro
		$this->otro->ViewValue = $this->otro->CurrentValue;
		$this->otro->ViewCustomAttributes = "";

		// ncontrato
		$this->ncontrato->ViewValue = $this->ncontrato->CurrentValue;
		$this->ncontrato->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

			// idContratacion
			$this->idContratacion->LinkCustomAttributes = "";
			$this->idContratacion->HrefValue = "";
			$this->idContratacion->TooltipValue = "";

			// idAdjudicacion
			$this->idAdjudicacion->LinkCustomAttributes = "";
			$this->idAdjudicacion->HrefValue = "";
			$this->idAdjudicacion->TooltipValue = "";

			// idEntidad
			$this->idEntidad->LinkCustomAttributes = "";
			$this->idEntidad->HrefValue = "";
			$this->idEntidad->TooltipValue = "";

			// idoferente
			$this->idoferente->LinkCustomAttributes = "";
			$this->idoferente->HrefValue = "";
			$this->idoferente->TooltipValue = "";

			// precio
			$this->precio->LinkCustomAttributes = "";
			$this->precio->HrefValue = "";
			$this->precio->TooltipValue = "";

			// precio2
			$this->precio2->LinkCustomAttributes = "";
			$this->precio2->HrefValue = "";
			$this->precio2->TooltipValue = "";

			// fechainicio
			$this->fechainicio->LinkCustomAttributes = "";
			$this->fechainicio->HrefValue = "";
			$this->fechainicio->TooltipValue = "";

			// fechafinal
			$this->fechafinal->LinkCustomAttributes = "";
			$this->fechafinal->HrefValue = "";
			$this->fechafinal->TooltipValue = "";

			// duracioncontrato
			$this->duracioncontrato->LinkCustomAttributes = "";
			$this->duracioncontrato->HrefValue = "";
			$this->duracioncontrato->TooltipValue = "";

			// documentocontra
			$this->documentocontra->LinkCustomAttributes = "";
			$this->documentocontra->HrefValue = "";
			$this->documentocontra->TooltipValue = "";

			// regante
			$this->regante->LinkCustomAttributes = "";
			$this->regante->HrefValue = "";
			$this->regante->TooltipValue = "";

			// espeplanos
			$this->espeplanos->LinkCustomAttributes = "";
			$this->espeplanos->HrefValue = "";
			$this->espeplanos->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// otro
			$this->otro->LinkCustomAttributes = "";
			$this->otro->HrefValue = "";
			$this->otro->TooltipValue = "";

			// ncontrato
			$this->ncontrato->LinkCustomAttributes = "";
			$this->ncontrato->HrefValue = "";
			$this->ncontrato->TooltipValue = "";

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

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = FALSE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = FALSE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_cs_contratacion\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_cs_contratacion',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fcs_contratacionlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = FALSE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = FALSE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->SelectRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_adjudicacion") {
			global $cs_adjudicacion;
			if (!isset($cs_adjudicacion)) $cs_adjudicacion = new ccs_adjudicacion;
			$rsmaster = $cs_adjudicacion->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$cs_adjudicacion;
					$cs_adjudicacion->ExportDocument($Doc, $rsmaster, 1, 1);
					$Doc->ExportEmptyRow();
					$Doc->Table = &$this;
				}
				$Doc->SetStyle($ExportStyle); // Restore
				$rsmaster->Close();
			}
		}
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED)
			echo ew_DebugMsg();

		// Output data
		$Doc->Export();
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
			if ($sMasterTblVar == "cs_adjudicacion") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_idAdjudicacion"] <> "") {
					$GLOBALS["cs_adjudicacion"]->idAdjudicacion->setQueryStringValue($_GET["fk_idAdjudicacion"]);
					$this->idAdjudicacion->setQueryStringValue($GLOBALS["cs_adjudicacion"]->idAdjudicacion->QueryStringValue);
					$this->idAdjudicacion->setSessionValue($this->idAdjudicacion->QueryStringValue);
					if (!is_numeric($GLOBALS["cs_adjudicacion"]->idAdjudicacion->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "cs_adjudicacion") {
				if ($this->idAdjudicacion->QueryStringValue == "") $this->idAdjudicacion->setSessionValue("");
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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
if (!isset($cs_contratacion_list)) $cs_contratacion_list = new ccs_contratacion_list();

// Page init
$cs_contratacion_list->Page_Init();

// Page main
$cs_contratacion_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_contratacion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($cs_contratacion->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fcs_contratacionlist = new ew_Form("fcs_contratacionlist", "list");
fcs_contratacionlist.FormKeyCountName = '<?php echo $cs_contratacion_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcs_contratacionlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_contratacionlist.ValidateRequired = true;
<?php } else { ?>
fcs_contratacionlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

var CurrentSearchForm = fcs_contratacionlistsrch = new ew_Form("fcs_contratacionlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($cs_contratacion->Export == "") { ?>
<div class="ewToolbar">
<?php if ($cs_contratacion->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($cs_contratacion_list->TotalRecs > 0 && $cs_contratacion_list->ExportOptions->Visible()) { ?>
<?php $cs_contratacion_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_contratacion_list->SearchOptions->Visible()) { ?>
<?php $cs_contratacion_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_contratacion_list->FilterOptions->Visible()) { ?>
<?php $cs_contratacion_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_contratacion->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($cs_contratacion->Export == "") || (EW_EXPORT_MASTER_RECORD && $cs_contratacion->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "cs_adjudicacionlist.php";
if ($cs_contratacion_list->DbMasterFilter <> "" && $cs_contratacion->getCurrentMasterTable() == "cs_adjudicacion") {
	if ($cs_contratacion_list->MasterRecordExists) {
		if ($cs_contratacion->getCurrentMasterTable() == $cs_contratacion->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include_once "cs_adjudicacionmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $cs_contratacion_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_contratacion_list->TotalRecs <= 0)
			$cs_contratacion_list->TotalRecs = $cs_contratacion->SelectRecordCount();
	} else {
		if (!$cs_contratacion_list->Recordset && ($cs_contratacion_list->Recordset = $cs_contratacion_list->LoadRecordset()))
			$cs_contratacion_list->TotalRecs = $cs_contratacion_list->Recordset->RecordCount();
	}
	$cs_contratacion_list->StartRec = 1;
	if ($cs_contratacion_list->DisplayRecs <= 0 || ($cs_contratacion->Export <> "" && $cs_contratacion->ExportAll)) // Display all records
		$cs_contratacion_list->DisplayRecs = $cs_contratacion_list->TotalRecs;
	if (!($cs_contratacion->Export <> "" && $cs_contratacion->ExportAll))
		$cs_contratacion_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cs_contratacion_list->Recordset = $cs_contratacion_list->LoadRecordset($cs_contratacion_list->StartRec-1, $cs_contratacion_list->DisplayRecs);

	// Set no record found message
	if ($cs_contratacion->CurrentAction == "" && $cs_contratacion_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_contratacion_list->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_contratacion_list->SearchWhere == "0=101")
			$cs_contratacion_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_contratacion_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$cs_contratacion_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($cs_contratacion->Export == "" && $cs_contratacion->CurrentAction == "") { ?>
<form name="fcs_contratacionlistsrch" id="fcs_contratacionlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($cs_contratacion_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fcs_contratacionlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cs_contratacion">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($cs_contratacion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($cs_contratacion_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $cs_contratacion_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($cs_contratacion_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($cs_contratacion_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($cs_contratacion_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($cs_contratacion_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $cs_contratacion_list->ShowPageHeader(); ?>
<?php
$cs_contratacion_list->ShowMessage();
?>
<?php if ($cs_contratacion_list->TotalRecs > 0 || $cs_contratacion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<form name="fcs_contratacionlist" id="fcs_contratacionlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_contratacion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_contratacion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_contratacion">
<div id="gmp_cs_contratacion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($cs_contratacion_list->TotalRecs > 0) { ?>
<table id="tbl_cs_contratacionlist" class="table ewTable">
<?php echo $cs_contratacion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_contratacion_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_contratacion_list->RenderListOptions();

// Render list options (header, left)
$cs_contratacion_list->ListOptions->Render("header", "left");
?>
<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idContratacion) == "") { ?>
		<th data-name="idContratacion"><div id="elh_cs_contratacion_idContratacion" class="cs_contratacion_idContratacion"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idContratacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idContratacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->idContratacion) ?>',1);"><div id="elh_cs_contratacion_idContratacion" class="cs_contratacion_idContratacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idContratacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idContratacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idContratacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idAdjudicacion) == "") { ?>
		<th data-name="idAdjudicacion"><div id="elh_cs_contratacion_idAdjudicacion" class="cs_contratacion_idAdjudicacion"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idAdjudicacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idAdjudicacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->idAdjudicacion) ?>',1);"><div id="elh_cs_contratacion_idAdjudicacion" class="cs_contratacion_idAdjudicacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idAdjudicacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idAdjudicacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idAdjudicacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idEntidad) == "") { ?>
		<th data-name="idEntidad"><div id="elh_cs_contratacion_idEntidad" class="cs_contratacion_idEntidad"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idEntidad->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idEntidad"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->idEntidad) ?>',1);"><div id="elh_cs_contratacion_idEntidad" class="cs_contratacion_idEntidad">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idEntidad->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idEntidad->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idEntidad->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->idoferente) == "") { ?>
		<th data-name="idoferente"><div id="elh_cs_contratacion_idoferente" class="cs_contratacion_idoferente"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->idoferente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idoferente"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->idoferente) ?>',1);"><div id="elh_cs_contratacion_idoferente" class="cs_contratacion_idoferente">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->idoferente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->idoferente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->idoferente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->precio->Visible) { // precio ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->precio) == "") { ?>
		<th data-name="precio"><div id="elh_cs_contratacion_precio" class="cs_contratacion_precio"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->precio) ?>',1);"><div id="elh_cs_contratacion_precio" class="cs_contratacion_precio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->precio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->precio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->precio2) == "") { ?>
		<th data-name="precio2"><div id="elh_cs_contratacion_precio2" class="cs_contratacion_precio2"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->precio2) ?>',1);"><div id="elh_cs_contratacion_precio2" class="cs_contratacion_precio2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->precio2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->precio2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->precio2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fechainicio) == "") { ?>
		<th data-name="fechainicio"><div id="elh_cs_contratacion_fechainicio" class="cs_contratacion_fechainicio"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechainicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechainicio"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->fechainicio) ?>',1);"><div id="elh_cs_contratacion_fechainicio" class="cs_contratacion_fechainicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechainicio->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fechainicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fechainicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fechafinal) == "") { ?>
		<th data-name="fechafinal"><div id="elh_cs_contratacion_fechafinal" class="cs_contratacion_fechafinal"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechafinal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechafinal"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->fechafinal) ?>',1);"><div id="elh_cs_contratacion_fechafinal" class="cs_contratacion_fechafinal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechafinal->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fechafinal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fechafinal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->duracioncontrato) == "") { ?>
		<th data-name="duracioncontrato"><div id="elh_cs_contratacion_duracioncontrato" class="cs_contratacion_duracioncontrato"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->duracioncontrato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="duracioncontrato"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->duracioncontrato) ?>',1);"><div id="elh_cs_contratacion_duracioncontrato" class="cs_contratacion_duracioncontrato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->duracioncontrato->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->duracioncontrato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->duracioncontrato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->documentocontra) == "") { ?>
		<th data-name="documentocontra"><div id="elh_cs_contratacion_documentocontra" class="cs_contratacion_documentocontra"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->documentocontra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="documentocontra"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->documentocontra) ?>',1);"><div id="elh_cs_contratacion_documentocontra" class="cs_contratacion_documentocontra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->documentocontra->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->documentocontra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->documentocontra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->regante->Visible) { // regante ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->regante) == "") { ?>
		<th data-name="regante"><div id="elh_cs_contratacion_regante" class="cs_contratacion_regante"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->regante->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="regante"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->regante) ?>',1);"><div id="elh_cs_contratacion_regante" class="cs_contratacion_regante">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->regante->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->regante->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->regante->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->espeplanos) == "") { ?>
		<th data-name="espeplanos"><div id="elh_cs_contratacion_espeplanos" class="cs_contratacion_espeplanos"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->espeplanos->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="espeplanos"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->espeplanos) ?>',1);"><div id="elh_cs_contratacion_espeplanos" class="cs_contratacion_espeplanos">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->espeplanos->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->espeplanos->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->espeplanos->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->estado->Visible) { // estado ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_contratacion_estado" class="cs_contratacion_estado"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->estado) ?>',1);"><div id="elh_cs_contratacion_estado" class="cs_contratacion_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->estado->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->otro->Visible) { // otro ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->otro) == "") { ?>
		<th data-name="otro"><div id="elh_cs_contratacion_otro" class="cs_contratacion_otro"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->otro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->otro) ?>',1);"><div id="elh_cs_contratacion_otro" class="cs_contratacion_otro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->otro->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->otro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->otro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->ncontrato) == "") { ?>
		<th data-name="ncontrato"><div id="elh_cs_contratacion_ncontrato" class="cs_contratacion_ncontrato"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->ncontrato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ncontrato"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->ncontrato) ?>',1);"><div id="elh_cs_contratacion_ncontrato" class="cs_contratacion_ncontrato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->ncontrato->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->ncontrato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->ncontrato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_contratacion_fecharecibido" class="cs_contratacion_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->fecharecibido) ?>',1);"><div id="elh_cs_contratacion_fecharecibido" class="cs_contratacion_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fecharecibido->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
	<?php if ($cs_contratacion->SortUrl($cs_contratacion->fechacreacion) == "") { ?>
		<th data-name="fechacreacion"><div id="elh_cs_contratacion_fechacreacion" class="cs_contratacion_fechacreacion"><div class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechacreacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechacreacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_contratacion->SortUrl($cs_contratacion->fechacreacion) ?>',1);"><div id="elh_cs_contratacion_fechacreacion" class="cs_contratacion_fechacreacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_contratacion->fechacreacion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_contratacion->fechacreacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_contratacion->fechacreacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_contratacion_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cs_contratacion->ExportAll && $cs_contratacion->Export <> "") {
	$cs_contratacion_list->StopRec = $cs_contratacion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cs_contratacion_list->TotalRecs > $cs_contratacion_list->StartRec + $cs_contratacion_list->DisplayRecs - 1)
		$cs_contratacion_list->StopRec = $cs_contratacion_list->StartRec + $cs_contratacion_list->DisplayRecs - 1;
	else
		$cs_contratacion_list->StopRec = $cs_contratacion_list->TotalRecs;
}
$cs_contratacion_list->RecCnt = $cs_contratacion_list->StartRec - 1;
if ($cs_contratacion_list->Recordset && !$cs_contratacion_list->Recordset->EOF) {
	$cs_contratacion_list->Recordset->MoveFirst();
	$bSelectLimit = $cs_contratacion_list->UseSelectLimit;
	if (!$bSelectLimit && $cs_contratacion_list->StartRec > 1)
		$cs_contratacion_list->Recordset->Move($cs_contratacion_list->StartRec - 1);
} elseif (!$cs_contratacion->AllowAddDeleteRow && $cs_contratacion_list->StopRec == 0) {
	$cs_contratacion_list->StopRec = $cs_contratacion->GridAddRowCount;
}

// Initialize aggregate
$cs_contratacion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_contratacion->ResetAttrs();
$cs_contratacion_list->RenderRow();
while ($cs_contratacion_list->RecCnt < $cs_contratacion_list->StopRec) {
	$cs_contratacion_list->RecCnt++;
	if (intval($cs_contratacion_list->RecCnt) >= intval($cs_contratacion_list->StartRec)) {
		$cs_contratacion_list->RowCnt++;

		// Set up key count
		$cs_contratacion_list->KeyCount = $cs_contratacion_list->RowIndex;

		// Init row class and style
		$cs_contratacion->ResetAttrs();
		$cs_contratacion->CssClass = "";
		if ($cs_contratacion->CurrentAction == "gridadd") {
		} else {
			$cs_contratacion_list->LoadRowValues($cs_contratacion_list->Recordset); // Load row values
		}
		$cs_contratacion->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cs_contratacion->RowAttrs = array_merge($cs_contratacion->RowAttrs, array('data-rowindex'=>$cs_contratacion_list->RowCnt, 'id'=>'r' . $cs_contratacion_list->RowCnt . '_cs_contratacion', 'data-rowtype'=>$cs_contratacion->RowType));

		// Render row
		$cs_contratacion_list->RenderRow();

		// Render list options
		$cs_contratacion_list->RenderListOptions();
?>
	<tr<?php echo $cs_contratacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_contratacion_list->ListOptions->Render("body", "left", $cs_contratacion_list->RowCnt);
?>
	<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion"<?php echo $cs_contratacion->idContratacion->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_idContratacion" class="cs_contratacion_idContratacion">
<span<?php echo $cs_contratacion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idContratacion->ListViewValue() ?></span>
</span>
<a id="<?php echo $cs_contratacion_list->PageObjName . "_row_" . $cs_contratacion_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
		<td data-name="idAdjudicacion"<?php echo $cs_contratacion->idAdjudicacion->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_idAdjudicacion" class="cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idAdjudicacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
		<td data-name="idEntidad"<?php echo $cs_contratacion->idEntidad->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_idEntidad" class="cs_contratacion_idEntidad">
<span<?php echo $cs_contratacion->idEntidad->ViewAttributes() ?>>
<?php echo $cs_contratacion->idEntidad->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
		<td data-name="idoferente"<?php echo $cs_contratacion->idoferente->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_idoferente" class="cs_contratacion_idoferente">
<span<?php echo $cs_contratacion->idoferente->ViewAttributes() ?>>
<?php echo $cs_contratacion->idoferente->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->precio->Visible) { // precio ?>
		<td data-name="precio"<?php echo $cs_contratacion->precio->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_precio" class="cs_contratacion_precio">
<span<?php echo $cs_contratacion->precio->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
		<td data-name="precio2"<?php echo $cs_contratacion->precio2->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_precio2" class="cs_contratacion_precio2">
<span<?php echo $cs_contratacion->precio2->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
		<td data-name="fechainicio"<?php echo $cs_contratacion->fechainicio->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_fechainicio" class="cs_contratacion_fechainicio">
<span<?php echo $cs_contratacion->fechainicio->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechainicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
		<td data-name="fechafinal"<?php echo $cs_contratacion->fechafinal->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_fechafinal" class="cs_contratacion_fechafinal">
<span<?php echo $cs_contratacion->fechafinal->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechafinal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
		<td data-name="duracioncontrato"<?php echo $cs_contratacion->duracioncontrato->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_duracioncontrato" class="cs_contratacion_duracioncontrato">
<span<?php echo $cs_contratacion->duracioncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->duracioncontrato->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
		<td data-name="documentocontra"<?php echo $cs_contratacion->documentocontra->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_documentocontra" class="cs_contratacion_documentocontra">
<span<?php echo $cs_contratacion->documentocontra->ViewAttributes() ?>>
<?php echo $cs_contratacion->documentocontra->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->regante->Visible) { // regante ?>
		<td data-name="regante"<?php echo $cs_contratacion->regante->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_regante" class="cs_contratacion_regante">
<span<?php echo $cs_contratacion->regante->ViewAttributes() ?>>
<?php echo $cs_contratacion->regante->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
		<td data-name="espeplanos"<?php echo $cs_contratacion->espeplanos->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_espeplanos" class="cs_contratacion_espeplanos">
<span<?php echo $cs_contratacion->espeplanos->ViewAttributes() ?>>
<?php echo $cs_contratacion->espeplanos->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_contratacion->estado->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_estado" class="cs_contratacion_estado">
<span<?php echo $cs_contratacion->estado->ViewAttributes() ?>>
<?php echo $cs_contratacion->estado->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->otro->Visible) { // otro ?>
		<td data-name="otro"<?php echo $cs_contratacion->otro->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_otro" class="cs_contratacion_otro">
<span<?php echo $cs_contratacion->otro->ViewAttributes() ?>>
<?php echo $cs_contratacion->otro->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
		<td data-name="ncontrato"<?php echo $cs_contratacion->ncontrato->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_ncontrato" class="cs_contratacion_ncontrato">
<span<?php echo $cs_contratacion->ncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->ncontrato->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_contratacion->fecharecibido->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_fecharecibido" class="cs_contratacion_fecharecibido">
<span<?php echo $cs_contratacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_contratacion->fecharecibido->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion"<?php echo $cs_contratacion->fechacreacion->CellAttributes() ?>>
<span id="el<?php echo $cs_contratacion_list->RowCnt ?>_cs_contratacion_fechacreacion" class="cs_contratacion_fechacreacion">
<span<?php echo $cs_contratacion->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechacreacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_contratacion_list->ListOptions->Render("body", "right", $cs_contratacion_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($cs_contratacion->CurrentAction <> "gridadd")
		$cs_contratacion_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($cs_contratacion->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cs_contratacion_list->Recordset)
	$cs_contratacion_list->Recordset->Close();
?>
<?php if ($cs_contratacion->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($cs_contratacion->CurrentAction <> "gridadd" && $cs_contratacion->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cs_contratacion_list->Pager)) $cs_contratacion_list->Pager = new cPrevNextPager($cs_contratacion_list->StartRec, $cs_contratacion_list->DisplayRecs, $cs_contratacion_list->TotalRecs) ?>
<?php if ($cs_contratacion_list->Pager->RecordCount > 0) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cs_contratacion_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cs_contratacion_list->PageUrl() ?>start=<?php echo $cs_contratacion_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cs_contratacion_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cs_contratacion_list->PageUrl() ?>start=<?php echo $cs_contratacion_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cs_contratacion_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cs_contratacion_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cs_contratacion_list->PageUrl() ?>start=<?php echo $cs_contratacion_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cs_contratacion_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cs_contratacion_list->PageUrl() ?>start=<?php echo $cs_contratacion_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cs_contratacion_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cs_contratacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cs_contratacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cs_contratacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_contratacion_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($cs_contratacion_list->TotalRecs == 0 && $cs_contratacion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_contratacion_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_contratacion->Export == "") { ?>
<script type="text/javascript">
fcs_contratacionlistsrch.Init();
fcs_contratacionlistsrch.FilterList = <?php echo $cs_contratacion_list->GetFilterList() ?>;
fcs_contratacionlist.Init();
</script>
<?php } ?>
<?php
$cs_contratacion_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cs_contratacion->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cs_contratacion_list->Page_Terminate();
?>
