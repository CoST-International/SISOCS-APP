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

$cs_inicio_ejecucion_list = NULL; // Initialize page object first

class ccs_inicio_ejecucion_list extends ccs_inicio_ejecucion {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_inicio_ejecucion';

	// Page object name
	var $PageObjName = 'cs_inicio_ejecucion_list';

	// Grid form hidden field names
	var $FormName = 'fcs_inicio_ejecucionlist';
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

		// Table object (cs_inicio_ejecucion)
		if (!isset($GLOBALS["cs_inicio_ejecucion"]) || get_class($GLOBALS["cs_inicio_ejecucion"]) == "ccs_inicio_ejecucion") {
			$GLOBALS["cs_inicio_ejecucion"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_inicio_ejecucion"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cs_inicio_ejecucionadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cs_inicio_ejecuciondelete.php";
		$this->MultiUpdateUrl = "cs_inicio_ejecucionupdate.php";

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Table object (cs_contratacion)
		if (!isset($GLOBALS['cs_contratacion'])) $GLOBALS['cs_contratacion'] = new ccs_contratacion();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fcs_inicio_ejecucionlistsrch";

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Process auto fill for detail table 'cs_avances'
			if (@$_POST["grid"] == "fcs_avancesgrid") {
				if (!isset($GLOBALS["cs_avances_grid"])) $GLOBALS["cs_avances_grid"] = new ccs_avances_grid;
				$GLOBALS["cs_avances_grid"]->Page_Init();
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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_contratacion") {
			global $cs_contratacion;
			$rsmaster = $cs_contratacion->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cs_contratacionlist.php"); // Return to master page
			} else {
				$cs_contratacion->LoadListRowValues($rsmaster);
				$cs_contratacion->RowType = EW_ROWTYPE_MASTER; // Master row
				$cs_contratacion->RenderListRow();
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
			$this->codigo->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->codigo->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->codigo->AdvancedSearch->ToJSON(), ","); // Field codigo
		$sFilterList = ew_Concat($sFilterList, $this->idContratacion->AdvancedSearch->ToJSON(), ","); // Field idContratacion
		$sFilterList = ew_Concat($sFilterList, $this->imagen->AdvancedSearch->ToJSON(), ","); // Field imagen
		$sFilterList = ew_Concat($sFilterList, $this->cod_contacto_01->AdvancedSearch->ToJSON(), ","); // Field cod_contacto_01
		$sFilterList = ew_Concat($sFilterList, $this->cod_contacto_02->AdvancedSearch->ToJSON(), ","); // Field cod_contacto_02
		$sFilterList = ew_Concat($sFilterList, $this->cod_contacto_03->AdvancedSearch->ToJSON(), ","); // Field cod_contacto_03
		$sFilterList = ew_Concat($sFilterList, $this->tipo_garant_01->AdvancedSearch->ToJSON(), ","); // Field tipo_garant_01
		$sFilterList = ew_Concat($sFilterList, $this->tipo_garant_02->AdvancedSearch->ToJSON(), ","); // Field tipo_garant_02
		$sFilterList = ew_Concat($sFilterList, $this->tipo_garant_03->AdvancedSearch->ToJSON(), ","); // Field tipo_garant_03
		$sFilterList = ew_Concat($sFilterList, $this->monto_garant_01->AdvancedSearch->ToJSON(), ","); // Field monto_garant_01
		$sFilterList = ew_Concat($sFilterList, $this->monto_garant_02->AdvancedSearch->ToJSON(), ","); // Field monto_garant_02
		$sFilterList = ew_Concat($sFilterList, $this->monto_garant_03->AdvancedSearch->ToJSON(), ","); // Field monto_garant_03
		$sFilterList = ew_Concat($sFilterList, $this->estado_garant_01->AdvancedSearch->ToJSON(), ","); // Field estado_garant_01
		$sFilterList = ew_Concat($sFilterList, $this->estado_garant_02->AdvancedSearch->ToJSON(), ","); // Field estado_garant_02
		$sFilterList = ew_Concat($sFilterList, $this->estado_garant_03->AdvancedSearch->ToJSON(), ","); // Field estado_garant_03
		$sFilterList = ew_Concat($sFilterList, $this->fecha_venc_01->AdvancedSearch->ToJSON(), ","); // Field fecha_venc_01
		$sFilterList = ew_Concat($sFilterList, $this->fecha_venc_02->AdvancedSearch->ToJSON(), ","); // Field fecha_venc_02
		$sFilterList = ew_Concat($sFilterList, $this->fecha_venc_03->AdvancedSearch->ToJSON(), ","); // Field fecha_venc_03
		$sFilterList = ew_Concat($sFilterList, $this->geo_latitud->AdvancedSearch->ToJSON(), ","); // Field geo_latitud
		$sFilterList = ew_Concat($sFilterList, $this->geo_longitud->AdvancedSearch->ToJSON(), ","); // Field geo_longitud
		$sFilterList = ew_Concat($sFilterList, $this->geo_lati_final->AdvancedSearch->ToJSON(), ","); // Field geo_lati_final
		$sFilterList = ew_Concat($sFilterList, $this->geo_long_final->AdvancedSearch->ToJSON(), ","); // Field geo_long_final
		$sFilterList = ew_Concat($sFilterList, $this->fecha_inicio->AdvancedSearch->ToJSON(), ","); // Field fecha_inicio
		$sFilterList = ew_Concat($sFilterList, $this->estado_sol->AdvancedSearch->ToJSON(), ","); // Field estado_sol
		$sFilterList = ew_Concat($sFilterList, $this->fecha_registro->AdvancedSearch->ToJSON(), ","); // Field fecha_registro
		$sFilterList = ew_Concat($sFilterList, $this->user_registro->AdvancedSearch->ToJSON(), ","); // Field user_registro
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

		// Field codigo
		$this->codigo->AdvancedSearch->SearchValue = @$filter["x_codigo"];
		$this->codigo->AdvancedSearch->SearchOperator = @$filter["z_codigo"];
		$this->codigo->AdvancedSearch->SearchCondition = @$filter["v_codigo"];
		$this->codigo->AdvancedSearch->SearchValue2 = @$filter["y_codigo"];
		$this->codigo->AdvancedSearch->SearchOperator2 = @$filter["w_codigo"];
		$this->codigo->AdvancedSearch->Save();

		// Field idContratacion
		$this->idContratacion->AdvancedSearch->SearchValue = @$filter["x_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchOperator = @$filter["z_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchCondition = @$filter["v_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchValue2 = @$filter["y_idContratacion"];
		$this->idContratacion->AdvancedSearch->SearchOperator2 = @$filter["w_idContratacion"];
		$this->idContratacion->AdvancedSearch->Save();

		// Field imagen
		$this->imagen->AdvancedSearch->SearchValue = @$filter["x_imagen"];
		$this->imagen->AdvancedSearch->SearchOperator = @$filter["z_imagen"];
		$this->imagen->AdvancedSearch->SearchCondition = @$filter["v_imagen"];
		$this->imagen->AdvancedSearch->SearchValue2 = @$filter["y_imagen"];
		$this->imagen->AdvancedSearch->SearchOperator2 = @$filter["w_imagen"];
		$this->imagen->AdvancedSearch->Save();

		// Field cod_contacto_01
		$this->cod_contacto_01->AdvancedSearch->SearchValue = @$filter["x_cod_contacto_01"];
		$this->cod_contacto_01->AdvancedSearch->SearchOperator = @$filter["z_cod_contacto_01"];
		$this->cod_contacto_01->AdvancedSearch->SearchCondition = @$filter["v_cod_contacto_01"];
		$this->cod_contacto_01->AdvancedSearch->SearchValue2 = @$filter["y_cod_contacto_01"];
		$this->cod_contacto_01->AdvancedSearch->SearchOperator2 = @$filter["w_cod_contacto_01"];
		$this->cod_contacto_01->AdvancedSearch->Save();

		// Field cod_contacto_02
		$this->cod_contacto_02->AdvancedSearch->SearchValue = @$filter["x_cod_contacto_02"];
		$this->cod_contacto_02->AdvancedSearch->SearchOperator = @$filter["z_cod_contacto_02"];
		$this->cod_contacto_02->AdvancedSearch->SearchCondition = @$filter["v_cod_contacto_02"];
		$this->cod_contacto_02->AdvancedSearch->SearchValue2 = @$filter["y_cod_contacto_02"];
		$this->cod_contacto_02->AdvancedSearch->SearchOperator2 = @$filter["w_cod_contacto_02"];
		$this->cod_contacto_02->AdvancedSearch->Save();

		// Field cod_contacto_03
		$this->cod_contacto_03->AdvancedSearch->SearchValue = @$filter["x_cod_contacto_03"];
		$this->cod_contacto_03->AdvancedSearch->SearchOperator = @$filter["z_cod_contacto_03"];
		$this->cod_contacto_03->AdvancedSearch->SearchCondition = @$filter["v_cod_contacto_03"];
		$this->cod_contacto_03->AdvancedSearch->SearchValue2 = @$filter["y_cod_contacto_03"];
		$this->cod_contacto_03->AdvancedSearch->SearchOperator2 = @$filter["w_cod_contacto_03"];
		$this->cod_contacto_03->AdvancedSearch->Save();

		// Field tipo_garant_01
		$this->tipo_garant_01->AdvancedSearch->SearchValue = @$filter["x_tipo_garant_01"];
		$this->tipo_garant_01->AdvancedSearch->SearchOperator = @$filter["z_tipo_garant_01"];
		$this->tipo_garant_01->AdvancedSearch->SearchCondition = @$filter["v_tipo_garant_01"];
		$this->tipo_garant_01->AdvancedSearch->SearchValue2 = @$filter["y_tipo_garant_01"];
		$this->tipo_garant_01->AdvancedSearch->SearchOperator2 = @$filter["w_tipo_garant_01"];
		$this->tipo_garant_01->AdvancedSearch->Save();

		// Field tipo_garant_02
		$this->tipo_garant_02->AdvancedSearch->SearchValue = @$filter["x_tipo_garant_02"];
		$this->tipo_garant_02->AdvancedSearch->SearchOperator = @$filter["z_tipo_garant_02"];
		$this->tipo_garant_02->AdvancedSearch->SearchCondition = @$filter["v_tipo_garant_02"];
		$this->tipo_garant_02->AdvancedSearch->SearchValue2 = @$filter["y_tipo_garant_02"];
		$this->tipo_garant_02->AdvancedSearch->SearchOperator2 = @$filter["w_tipo_garant_02"];
		$this->tipo_garant_02->AdvancedSearch->Save();

		// Field tipo_garant_03
		$this->tipo_garant_03->AdvancedSearch->SearchValue = @$filter["x_tipo_garant_03"];
		$this->tipo_garant_03->AdvancedSearch->SearchOperator = @$filter["z_tipo_garant_03"];
		$this->tipo_garant_03->AdvancedSearch->SearchCondition = @$filter["v_tipo_garant_03"];
		$this->tipo_garant_03->AdvancedSearch->SearchValue2 = @$filter["y_tipo_garant_03"];
		$this->tipo_garant_03->AdvancedSearch->SearchOperator2 = @$filter["w_tipo_garant_03"];
		$this->tipo_garant_03->AdvancedSearch->Save();

		// Field monto_garant_01
		$this->monto_garant_01->AdvancedSearch->SearchValue = @$filter["x_monto_garant_01"];
		$this->monto_garant_01->AdvancedSearch->SearchOperator = @$filter["z_monto_garant_01"];
		$this->monto_garant_01->AdvancedSearch->SearchCondition = @$filter["v_monto_garant_01"];
		$this->monto_garant_01->AdvancedSearch->SearchValue2 = @$filter["y_monto_garant_01"];
		$this->monto_garant_01->AdvancedSearch->SearchOperator2 = @$filter["w_monto_garant_01"];
		$this->monto_garant_01->AdvancedSearch->Save();

		// Field monto_garant_02
		$this->monto_garant_02->AdvancedSearch->SearchValue = @$filter["x_monto_garant_02"];
		$this->monto_garant_02->AdvancedSearch->SearchOperator = @$filter["z_monto_garant_02"];
		$this->monto_garant_02->AdvancedSearch->SearchCondition = @$filter["v_monto_garant_02"];
		$this->monto_garant_02->AdvancedSearch->SearchValue2 = @$filter["y_monto_garant_02"];
		$this->monto_garant_02->AdvancedSearch->SearchOperator2 = @$filter["w_monto_garant_02"];
		$this->monto_garant_02->AdvancedSearch->Save();

		// Field monto_garant_03
		$this->monto_garant_03->AdvancedSearch->SearchValue = @$filter["x_monto_garant_03"];
		$this->monto_garant_03->AdvancedSearch->SearchOperator = @$filter["z_monto_garant_03"];
		$this->monto_garant_03->AdvancedSearch->SearchCondition = @$filter["v_monto_garant_03"];
		$this->monto_garant_03->AdvancedSearch->SearchValue2 = @$filter["y_monto_garant_03"];
		$this->monto_garant_03->AdvancedSearch->SearchOperator2 = @$filter["w_monto_garant_03"];
		$this->monto_garant_03->AdvancedSearch->Save();

		// Field estado_garant_01
		$this->estado_garant_01->AdvancedSearch->SearchValue = @$filter["x_estado_garant_01"];
		$this->estado_garant_01->AdvancedSearch->SearchOperator = @$filter["z_estado_garant_01"];
		$this->estado_garant_01->AdvancedSearch->SearchCondition = @$filter["v_estado_garant_01"];
		$this->estado_garant_01->AdvancedSearch->SearchValue2 = @$filter["y_estado_garant_01"];
		$this->estado_garant_01->AdvancedSearch->SearchOperator2 = @$filter["w_estado_garant_01"];
		$this->estado_garant_01->AdvancedSearch->Save();

		// Field estado_garant_02
		$this->estado_garant_02->AdvancedSearch->SearchValue = @$filter["x_estado_garant_02"];
		$this->estado_garant_02->AdvancedSearch->SearchOperator = @$filter["z_estado_garant_02"];
		$this->estado_garant_02->AdvancedSearch->SearchCondition = @$filter["v_estado_garant_02"];
		$this->estado_garant_02->AdvancedSearch->SearchValue2 = @$filter["y_estado_garant_02"];
		$this->estado_garant_02->AdvancedSearch->SearchOperator2 = @$filter["w_estado_garant_02"];
		$this->estado_garant_02->AdvancedSearch->Save();

		// Field estado_garant_03
		$this->estado_garant_03->AdvancedSearch->SearchValue = @$filter["x_estado_garant_03"];
		$this->estado_garant_03->AdvancedSearch->SearchOperator = @$filter["z_estado_garant_03"];
		$this->estado_garant_03->AdvancedSearch->SearchCondition = @$filter["v_estado_garant_03"];
		$this->estado_garant_03->AdvancedSearch->SearchValue2 = @$filter["y_estado_garant_03"];
		$this->estado_garant_03->AdvancedSearch->SearchOperator2 = @$filter["w_estado_garant_03"];
		$this->estado_garant_03->AdvancedSearch->Save();

		// Field fecha_venc_01
		$this->fecha_venc_01->AdvancedSearch->SearchValue = @$filter["x_fecha_venc_01"];
		$this->fecha_venc_01->AdvancedSearch->SearchOperator = @$filter["z_fecha_venc_01"];
		$this->fecha_venc_01->AdvancedSearch->SearchCondition = @$filter["v_fecha_venc_01"];
		$this->fecha_venc_01->AdvancedSearch->SearchValue2 = @$filter["y_fecha_venc_01"];
		$this->fecha_venc_01->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_venc_01"];
		$this->fecha_venc_01->AdvancedSearch->Save();

		// Field fecha_venc_02
		$this->fecha_venc_02->AdvancedSearch->SearchValue = @$filter["x_fecha_venc_02"];
		$this->fecha_venc_02->AdvancedSearch->SearchOperator = @$filter["z_fecha_venc_02"];
		$this->fecha_venc_02->AdvancedSearch->SearchCondition = @$filter["v_fecha_venc_02"];
		$this->fecha_venc_02->AdvancedSearch->SearchValue2 = @$filter["y_fecha_venc_02"];
		$this->fecha_venc_02->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_venc_02"];
		$this->fecha_venc_02->AdvancedSearch->Save();

		// Field fecha_venc_03
		$this->fecha_venc_03->AdvancedSearch->SearchValue = @$filter["x_fecha_venc_03"];
		$this->fecha_venc_03->AdvancedSearch->SearchOperator = @$filter["z_fecha_venc_03"];
		$this->fecha_venc_03->AdvancedSearch->SearchCondition = @$filter["v_fecha_venc_03"];
		$this->fecha_venc_03->AdvancedSearch->SearchValue2 = @$filter["y_fecha_venc_03"];
		$this->fecha_venc_03->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_venc_03"];
		$this->fecha_venc_03->AdvancedSearch->Save();

		// Field geo_latitud
		$this->geo_latitud->AdvancedSearch->SearchValue = @$filter["x_geo_latitud"];
		$this->geo_latitud->AdvancedSearch->SearchOperator = @$filter["z_geo_latitud"];
		$this->geo_latitud->AdvancedSearch->SearchCondition = @$filter["v_geo_latitud"];
		$this->geo_latitud->AdvancedSearch->SearchValue2 = @$filter["y_geo_latitud"];
		$this->geo_latitud->AdvancedSearch->SearchOperator2 = @$filter["w_geo_latitud"];
		$this->geo_latitud->AdvancedSearch->Save();

		// Field geo_longitud
		$this->geo_longitud->AdvancedSearch->SearchValue = @$filter["x_geo_longitud"];
		$this->geo_longitud->AdvancedSearch->SearchOperator = @$filter["z_geo_longitud"];
		$this->geo_longitud->AdvancedSearch->SearchCondition = @$filter["v_geo_longitud"];
		$this->geo_longitud->AdvancedSearch->SearchValue2 = @$filter["y_geo_longitud"];
		$this->geo_longitud->AdvancedSearch->SearchOperator2 = @$filter["w_geo_longitud"];
		$this->geo_longitud->AdvancedSearch->Save();

		// Field geo_lati_final
		$this->geo_lati_final->AdvancedSearch->SearchValue = @$filter["x_geo_lati_final"];
		$this->geo_lati_final->AdvancedSearch->SearchOperator = @$filter["z_geo_lati_final"];
		$this->geo_lati_final->AdvancedSearch->SearchCondition = @$filter["v_geo_lati_final"];
		$this->geo_lati_final->AdvancedSearch->SearchValue2 = @$filter["y_geo_lati_final"];
		$this->geo_lati_final->AdvancedSearch->SearchOperator2 = @$filter["w_geo_lati_final"];
		$this->geo_lati_final->AdvancedSearch->Save();

		// Field geo_long_final
		$this->geo_long_final->AdvancedSearch->SearchValue = @$filter["x_geo_long_final"];
		$this->geo_long_final->AdvancedSearch->SearchOperator = @$filter["z_geo_long_final"];
		$this->geo_long_final->AdvancedSearch->SearchCondition = @$filter["v_geo_long_final"];
		$this->geo_long_final->AdvancedSearch->SearchValue2 = @$filter["y_geo_long_final"];
		$this->geo_long_final->AdvancedSearch->SearchOperator2 = @$filter["w_geo_long_final"];
		$this->geo_long_final->AdvancedSearch->Save();

		// Field fecha_inicio
		$this->fecha_inicio->AdvancedSearch->SearchValue = @$filter["x_fecha_inicio"];
		$this->fecha_inicio->AdvancedSearch->SearchOperator = @$filter["z_fecha_inicio"];
		$this->fecha_inicio->AdvancedSearch->SearchCondition = @$filter["v_fecha_inicio"];
		$this->fecha_inicio->AdvancedSearch->SearchValue2 = @$filter["y_fecha_inicio"];
		$this->fecha_inicio->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_inicio"];
		$this->fecha_inicio->AdvancedSearch->Save();

		// Field estado_sol
		$this->estado_sol->AdvancedSearch->SearchValue = @$filter["x_estado_sol"];
		$this->estado_sol->AdvancedSearch->SearchOperator = @$filter["z_estado_sol"];
		$this->estado_sol->AdvancedSearch->SearchCondition = @$filter["v_estado_sol"];
		$this->estado_sol->AdvancedSearch->SearchValue2 = @$filter["y_estado_sol"];
		$this->estado_sol->AdvancedSearch->SearchOperator2 = @$filter["w_estado_sol"];
		$this->estado_sol->AdvancedSearch->Save();

		// Field fecha_registro
		$this->fecha_registro->AdvancedSearch->SearchValue = @$filter["x_fecha_registro"];
		$this->fecha_registro->AdvancedSearch->SearchOperator = @$filter["z_fecha_registro"];
		$this->fecha_registro->AdvancedSearch->SearchCondition = @$filter["v_fecha_registro"];
		$this->fecha_registro->AdvancedSearch->SearchValue2 = @$filter["y_fecha_registro"];
		$this->fecha_registro->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_registro"];
		$this->fecha_registro->AdvancedSearch->Save();

		// Field user_registro
		$this->user_registro->AdvancedSearch->SearchValue = @$filter["x_user_registro"];
		$this->user_registro->AdvancedSearch->SearchOperator = @$filter["z_user_registro"];
		$this->user_registro->AdvancedSearch->SearchCondition = @$filter["v_user_registro"];
		$this->user_registro->AdvancedSearch->SearchValue2 = @$filter["y_user_registro"];
		$this->user_registro->AdvancedSearch->SearchOperator2 = @$filter["w_user_registro"];
		$this->user_registro->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter["psearch"]);
		$this->BasicSearch->setType(@$filter["psearchtype"]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->imagen, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estado_sol, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->user_registro, $arKeywords, $type);
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
			$this->UpdateSort($this->codigo); // codigo
			$this->UpdateSort($this->idContratacion); // idContratacion
			$this->UpdateSort($this->imagen); // imagen
			$this->UpdateSort($this->cod_contacto_01); // cod_contacto_01
			$this->UpdateSort($this->cod_contacto_02); // cod_contacto_02
			$this->UpdateSort($this->cod_contacto_03); // cod_contacto_03
			$this->UpdateSort($this->tipo_garant_01); // tipo_garant_01
			$this->UpdateSort($this->tipo_garant_02); // tipo_garant_02
			$this->UpdateSort($this->tipo_garant_03); // tipo_garant_03
			$this->UpdateSort($this->monto_garant_01); // monto_garant_01
			$this->UpdateSort($this->monto_garant_02); // monto_garant_02
			$this->UpdateSort($this->monto_garant_03); // monto_garant_03
			$this->UpdateSort($this->estado_garant_01); // estado_garant_01
			$this->UpdateSort($this->estado_garant_02); // estado_garant_02
			$this->UpdateSort($this->estado_garant_03); // estado_garant_03
			$this->UpdateSort($this->fecha_venc_01); // fecha_venc_01
			$this->UpdateSort($this->fecha_venc_02); // fecha_venc_02
			$this->UpdateSort($this->fecha_venc_03); // fecha_venc_03
			$this->UpdateSort($this->geo_latitud); // geo_latitud
			$this->UpdateSort($this->geo_longitud); // geo_longitud
			$this->UpdateSort($this->geo_lati_final); // geo_lati_final
			$this->UpdateSort($this->geo_long_final); // geo_long_final
			$this->UpdateSort($this->fecha_inicio); // fecha_inicio
			$this->UpdateSort($this->estado_sol); // estado_sol
			$this->UpdateSort($this->fecha_registro); // fecha_registro
			$this->UpdateSort($this->user_registro); // user_registro
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
				$this->idContratacion->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->codigo->setSort("");
				$this->idContratacion->setSort("");
				$this->imagen->setSort("");
				$this->cod_contacto_01->setSort("");
				$this->cod_contacto_02->setSort("");
				$this->cod_contacto_03->setSort("");
				$this->tipo_garant_01->setSort("");
				$this->tipo_garant_02->setSort("");
				$this->tipo_garant_03->setSort("");
				$this->monto_garant_01->setSort("");
				$this->monto_garant_02->setSort("");
				$this->monto_garant_03->setSort("");
				$this->estado_garant_01->setSort("");
				$this->estado_garant_02->setSort("");
				$this->estado_garant_03->setSort("");
				$this->fecha_venc_01->setSort("");
				$this->fecha_venc_02->setSort("");
				$this->fecha_venc_03->setSort("");
				$this->geo_latitud->setSort("");
				$this->geo_longitud->setSort("");
				$this->geo_lati_final->setSort("");
				$this->geo_long_final->setSort("");
				$this->fecha_inicio->setSort("");
				$this->estado_sol->setSort("");
				$this->fecha_registro->setSort("");
				$this->user_registro->setSort("");
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

		// "detail_cs_avances"
		$item = &$this->ListOptions->Add("detail_cs_avances");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_avances') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cs_avances_grid"])) $GLOBALS["cs_avances_grid"] = new ccs_avances_grid;

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
		$pages->Add("cs_avances");
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

		// "detail_cs_avances"
		$oListOpt = &$this->ListOptions->Items["detail_cs_avances"];
		if ($Security->AllowList(CurrentProjectID() . 'cs_avances')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("cs_avances", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_avanceslist.php?" . EW_TABLE_SHOW_MASTER . "=cs_inicio_ejecucion&fk_idContratacion=" . urlencode(strval($this->idContratacion->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cs_avances_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_avances')) {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_avances")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "cs_avances";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->codigo->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fcs_inicio_ejecucionlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fcs_inicio_ejecucionlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fcs_inicio_ejecucionlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fcs_inicio_ejecucionlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("codigo")) <> "")
			$this->codigo->CurrentValue = $this->getKey("codigo"); // codigo
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
		$item->Body = "<button id=\"emf_cs_inicio_ejecucion\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_cs_inicio_ejecucion',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fcs_inicio_ejecucionlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_contratacion") {
			global $cs_contratacion;
			if (!isset($cs_contratacion)) $cs_contratacion = new ccs_contratacion;
			$rsmaster = $cs_contratacion->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$cs_contratacion;
					$cs_contratacion->ExportDocument($Doc, $rsmaster, 1, 1);
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
if (!isset($cs_inicio_ejecucion_list)) $cs_inicio_ejecucion_list = new ccs_inicio_ejecucion_list();

// Page init
$cs_inicio_ejecucion_list->Page_Init();

// Page main
$cs_inicio_ejecucion_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_inicio_ejecucion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fcs_inicio_ejecucionlist = new ew_Form("fcs_inicio_ejecucionlist", "list");
fcs_inicio_ejecucionlist.FormKeyCountName = '<?php echo $cs_inicio_ejecucion_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcs_inicio_ejecucionlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_inicio_ejecucionlist.ValidateRequired = true;
<?php } else { ?>
fcs_inicio_ejecucionlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

var CurrentSearchForm = fcs_inicio_ejecucionlistsrch = new ew_Form("fcs_inicio_ejecucionlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<div class="ewToolbar">
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion_list->TotalRecs > 0 && $cs_inicio_ejecucion_list->ExportOptions->Visible()) { ?>
<?php $cs_inicio_ejecucion_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion_list->SearchOptions->Visible()) { ?>
<?php $cs_inicio_ejecucion_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion_list->FilterOptions->Visible()) { ?>
<?php $cs_inicio_ejecucion_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($cs_inicio_ejecucion->Export == "") || (EW_EXPORT_MASTER_RECORD && $cs_inicio_ejecucion->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "cs_contratacionlist.php";
if ($cs_inicio_ejecucion_list->DbMasterFilter <> "" && $cs_inicio_ejecucion->getCurrentMasterTable() == "cs_contratacion") {
	if ($cs_inicio_ejecucion_list->MasterRecordExists) {
		if ($cs_inicio_ejecucion->getCurrentMasterTable() == $cs_inicio_ejecucion->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include_once "cs_contratacionmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $cs_inicio_ejecucion_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_inicio_ejecucion_list->TotalRecs <= 0)
			$cs_inicio_ejecucion_list->TotalRecs = $cs_inicio_ejecucion->SelectRecordCount();
	} else {
		if (!$cs_inicio_ejecucion_list->Recordset && ($cs_inicio_ejecucion_list->Recordset = $cs_inicio_ejecucion_list->LoadRecordset()))
			$cs_inicio_ejecucion_list->TotalRecs = $cs_inicio_ejecucion_list->Recordset->RecordCount();
	}
	$cs_inicio_ejecucion_list->StartRec = 1;
	if ($cs_inicio_ejecucion_list->DisplayRecs <= 0 || ($cs_inicio_ejecucion->Export <> "" && $cs_inicio_ejecucion->ExportAll)) // Display all records
		$cs_inicio_ejecucion_list->DisplayRecs = $cs_inicio_ejecucion_list->TotalRecs;
	if (!($cs_inicio_ejecucion->Export <> "" && $cs_inicio_ejecucion->ExportAll))
		$cs_inicio_ejecucion_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cs_inicio_ejecucion_list->Recordset = $cs_inicio_ejecucion_list->LoadRecordset($cs_inicio_ejecucion_list->StartRec-1, $cs_inicio_ejecucion_list->DisplayRecs);

	// Set no record found message
	if ($cs_inicio_ejecucion->CurrentAction == "" && $cs_inicio_ejecucion_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_inicio_ejecucion_list->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_inicio_ejecucion_list->SearchWhere == "0=101")
			$cs_inicio_ejecucion_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_inicio_ejecucion_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$cs_inicio_ejecucion_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($cs_inicio_ejecucion->Export == "" && $cs_inicio_ejecucion->CurrentAction == "") { ?>
<form name="fcs_inicio_ejecucionlistsrch" id="fcs_inicio_ejecucionlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($cs_inicio_ejecucion_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fcs_inicio_ejecucionlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cs_inicio_ejecucion">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($cs_inicio_ejecucion_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $cs_inicio_ejecucion_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($cs_inicio_ejecucion_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($cs_inicio_ejecucion_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($cs_inicio_ejecucion_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($cs_inicio_ejecucion_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $cs_inicio_ejecucion_list->ShowPageHeader(); ?>
<?php
$cs_inicio_ejecucion_list->ShowMessage();
?>
<?php if ($cs_inicio_ejecucion_list->TotalRecs > 0 || $cs_inicio_ejecucion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<form name="fcs_inicio_ejecucionlist" id="fcs_inicio_ejecucionlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_inicio_ejecucion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_inicio_ejecucion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_inicio_ejecucion">
<div id="gmp_cs_inicio_ejecucion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($cs_inicio_ejecucion_list->TotalRecs > 0) { ?>
<table id="tbl_cs_inicio_ejecucionlist" class="table ewTable">
<?php echo $cs_inicio_ejecucion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_inicio_ejecucion_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_inicio_ejecucion_list->RenderListOptions();

// Render list options (header, left)
$cs_inicio_ejecucion_list->ListOptions->Render("header", "left");
?>
<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->codigo) == "") { ?>
		<th data-name="codigo"><div id="elh_cs_inicio_ejecucion_codigo" class="cs_inicio_ejecucion_codigo"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->codigo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->codigo) ?>',1);"><div id="elh_cs_inicio_ejecucion_codigo" class="cs_inicio_ejecucion_codigo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->codigo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->codigo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->codigo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->idContratacion) == "") { ?>
		<th data-name="idContratacion"><div id="elh_cs_inicio_ejecucion_idContratacion" class="cs_inicio_ejecucion_idContratacion"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->idContratacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idContratacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->idContratacion) ?>',1);"><div id="elh_cs_inicio_ejecucion_idContratacion" class="cs_inicio_ejecucion_idContratacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->idContratacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->idContratacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->idContratacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->imagen) == "") { ?>
		<th data-name="imagen"><div id="elh_cs_inicio_ejecucion_imagen" class="cs_inicio_ejecucion_imagen"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->imagen) ?>',1);"><div id="elh_cs_inicio_ejecucion_imagen" class="cs_inicio_ejecucion_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->imagen->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_01) == "") { ?>
		<th data-name="cod_contacto_01"><div id="elh_cs_inicio_ejecucion_cod_contacto_01" class="cs_inicio_ejecucion_cod_contacto_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cod_contacto_01"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_01) ?>',1);"><div id="elh_cs_inicio_ejecucion_cod_contacto_01" class="cs_inicio_ejecucion_cod_contacto_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->cod_contacto_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->cod_contacto_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_02) == "") { ?>
		<th data-name="cod_contacto_02"><div id="elh_cs_inicio_ejecucion_cod_contacto_02" class="cs_inicio_ejecucion_cod_contacto_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cod_contacto_02"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_02) ?>',1);"><div id="elh_cs_inicio_ejecucion_cod_contacto_02" class="cs_inicio_ejecucion_cod_contacto_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->cod_contacto_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->cod_contacto_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_03) == "") { ?>
		<th data-name="cod_contacto_03"><div id="elh_cs_inicio_ejecucion_cod_contacto_03" class="cs_inicio_ejecucion_cod_contacto_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cod_contacto_03"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->cod_contacto_03) ?>',1);"><div id="elh_cs_inicio_ejecucion_cod_contacto_03" class="cs_inicio_ejecucion_cod_contacto_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->cod_contacto_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->cod_contacto_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->cod_contacto_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_01) == "") { ?>
		<th data-name="tipo_garant_01"><div id="elh_cs_inicio_ejecucion_tipo_garant_01" class="cs_inicio_ejecucion_tipo_garant_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_garant_01"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_01) ?>',1);"><div id="elh_cs_inicio_ejecucion_tipo_garant_01" class="cs_inicio_ejecucion_tipo_garant_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->tipo_garant_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->tipo_garant_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_02) == "") { ?>
		<th data-name="tipo_garant_02"><div id="elh_cs_inicio_ejecucion_tipo_garant_02" class="cs_inicio_ejecucion_tipo_garant_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_garant_02"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_02) ?>',1);"><div id="elh_cs_inicio_ejecucion_tipo_garant_02" class="cs_inicio_ejecucion_tipo_garant_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->tipo_garant_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->tipo_garant_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_03) == "") { ?>
		<th data-name="tipo_garant_03"><div id="elh_cs_inicio_ejecucion_tipo_garant_03" class="cs_inicio_ejecucion_tipo_garant_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipo_garant_03"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->tipo_garant_03) ?>',1);"><div id="elh_cs_inicio_ejecucion_tipo_garant_03" class="cs_inicio_ejecucion_tipo_garant_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->tipo_garant_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->tipo_garant_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->tipo_garant_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_01) == "") { ?>
		<th data-name="monto_garant_01"><div id="elh_cs_inicio_ejecucion_monto_garant_01" class="cs_inicio_ejecucion_monto_garant_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_garant_01"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_01) ?>',1);"><div id="elh_cs_inicio_ejecucion_monto_garant_01" class="cs_inicio_ejecucion_monto_garant_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->monto_garant_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->monto_garant_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_02) == "") { ?>
		<th data-name="monto_garant_02"><div id="elh_cs_inicio_ejecucion_monto_garant_02" class="cs_inicio_ejecucion_monto_garant_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_garant_02"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_02) ?>',1);"><div id="elh_cs_inicio_ejecucion_monto_garant_02" class="cs_inicio_ejecucion_monto_garant_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->monto_garant_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->monto_garant_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_03) == "") { ?>
		<th data-name="monto_garant_03"><div id="elh_cs_inicio_ejecucion_monto_garant_03" class="cs_inicio_ejecucion_monto_garant_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_garant_03"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->monto_garant_03) ?>',1);"><div id="elh_cs_inicio_ejecucion_monto_garant_03" class="cs_inicio_ejecucion_monto_garant_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->monto_garant_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->monto_garant_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->monto_garant_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_01) == "") { ?>
		<th data-name="estado_garant_01"><div id="elh_cs_inicio_ejecucion_estado_garant_01" class="cs_inicio_ejecucion_estado_garant_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_garant_01"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_01) ?>',1);"><div id="elh_cs_inicio_ejecucion_estado_garant_01" class="cs_inicio_ejecucion_estado_garant_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_garant_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_garant_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_02) == "") { ?>
		<th data-name="estado_garant_02"><div id="elh_cs_inicio_ejecucion_estado_garant_02" class="cs_inicio_ejecucion_estado_garant_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_garant_02"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_02) ?>',1);"><div id="elh_cs_inicio_ejecucion_estado_garant_02" class="cs_inicio_ejecucion_estado_garant_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_garant_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_garant_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_03) == "") { ?>
		<th data-name="estado_garant_03"><div id="elh_cs_inicio_ejecucion_estado_garant_03" class="cs_inicio_ejecucion_estado_garant_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_garant_03"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_garant_03) ?>',1);"><div id="elh_cs_inicio_ejecucion_estado_garant_03" class="cs_inicio_ejecucion_estado_garant_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_garant_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_garant_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_garant_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_01) == "") { ?>
		<th data-name="fecha_venc_01"><div id="elh_cs_inicio_ejecucion_fecha_venc_01" class="cs_inicio_ejecucion_fecha_venc_01"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_venc_01"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_01) ?>',1);"><div id="elh_cs_inicio_ejecucion_fecha_venc_01" class="cs_inicio_ejecucion_fecha_venc_01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_01->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_venc_01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_venc_01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_02) == "") { ?>
		<th data-name="fecha_venc_02"><div id="elh_cs_inicio_ejecucion_fecha_venc_02" class="cs_inicio_ejecucion_fecha_venc_02"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_venc_02"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_02) ?>',1);"><div id="elh_cs_inicio_ejecucion_fecha_venc_02" class="cs_inicio_ejecucion_fecha_venc_02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_02->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_venc_02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_venc_02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_03) == "") { ?>
		<th data-name="fecha_venc_03"><div id="elh_cs_inicio_ejecucion_fecha_venc_03" class="cs_inicio_ejecucion_fecha_venc_03"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_03->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_venc_03"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_venc_03) ?>',1);"><div id="elh_cs_inicio_ejecucion_fecha_venc_03" class="cs_inicio_ejecucion_fecha_venc_03">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_venc_03->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_venc_03->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_venc_03->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_latitud) == "") { ?>
		<th data-name="geo_latitud"><div id="elh_cs_inicio_ejecucion_geo_latitud" class="cs_inicio_ejecucion_geo_latitud"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_latitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_latitud"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_latitud) ?>',1);"><div id="elh_cs_inicio_ejecucion_geo_latitud" class="cs_inicio_ejecucion_geo_latitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_latitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_latitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_latitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_longitud) == "") { ?>
		<th data-name="geo_longitud"><div id="elh_cs_inicio_ejecucion_geo_longitud" class="cs_inicio_ejecucion_geo_longitud"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_longitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_longitud"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_longitud) ?>',1);"><div id="elh_cs_inicio_ejecucion_geo_longitud" class="cs_inicio_ejecucion_geo_longitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_longitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_longitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_longitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_lati_final) == "") { ?>
		<th data-name="geo_lati_final"><div id="elh_cs_inicio_ejecucion_geo_lati_final" class="cs_inicio_ejecucion_geo_lati_final"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_lati_final->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_lati_final"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_lati_final) ?>',1);"><div id="elh_cs_inicio_ejecucion_geo_lati_final" class="cs_inicio_ejecucion_geo_lati_final">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_lati_final->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_lati_final->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_lati_final->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_long_final) == "") { ?>
		<th data-name="geo_long_final"><div id="elh_cs_inicio_ejecucion_geo_long_final" class="cs_inicio_ejecucion_geo_long_final"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_long_final->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="geo_long_final"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->geo_long_final) ?>',1);"><div id="elh_cs_inicio_ejecucion_geo_long_final" class="cs_inicio_ejecucion_geo_long_final">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->geo_long_final->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->geo_long_final->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->geo_long_final->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_inicio) == "") { ?>
		<th data-name="fecha_inicio"><div id="elh_cs_inicio_ejecucion_fecha_inicio" class="cs_inicio_ejecucion_fecha_inicio"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_inicio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inicio"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_inicio) ?>',1);"><div id="elh_cs_inicio_ejecucion_fecha_inicio" class="cs_inicio_ejecucion_fecha_inicio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_inicio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_inicio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_inicio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_sol) == "") { ?>
		<th data-name="estado_sol"><div id="elh_cs_inicio_ejecucion_estado_sol" class="cs_inicio_ejecucion_estado_sol"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_sol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_sol"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->estado_sol) ?>',1);"><div id="elh_cs_inicio_ejecucion_estado_sol" class="cs_inicio_ejecucion_estado_sol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->estado_sol->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->estado_sol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->estado_sol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_registro) == "") { ?>
		<th data-name="fecha_registro"><div id="elh_cs_inicio_ejecucion_fecha_registro" class="cs_inicio_ejecucion_fecha_registro"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_registro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_registro"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->fecha_registro) ?>',1);"><div id="elh_cs_inicio_ejecucion_fecha_registro" class="cs_inicio_ejecucion_fecha_registro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->fecha_registro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->fecha_registro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->fecha_registro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
	<?php if ($cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->user_registro) == "") { ?>
		<th data-name="user_registro"><div id="elh_cs_inicio_ejecucion_user_registro" class="cs_inicio_ejecucion_user_registro"><div class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->user_registro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="user_registro"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_inicio_ejecucion->SortUrl($cs_inicio_ejecucion->user_registro) ?>',1);"><div id="elh_cs_inicio_ejecucion_user_registro" class="cs_inicio_ejecucion_user_registro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_inicio_ejecucion->user_registro->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_inicio_ejecucion->user_registro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_inicio_ejecucion->user_registro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_inicio_ejecucion_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cs_inicio_ejecucion->ExportAll && $cs_inicio_ejecucion->Export <> "") {
	$cs_inicio_ejecucion_list->StopRec = $cs_inicio_ejecucion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cs_inicio_ejecucion_list->TotalRecs > $cs_inicio_ejecucion_list->StartRec + $cs_inicio_ejecucion_list->DisplayRecs - 1)
		$cs_inicio_ejecucion_list->StopRec = $cs_inicio_ejecucion_list->StartRec + $cs_inicio_ejecucion_list->DisplayRecs - 1;
	else
		$cs_inicio_ejecucion_list->StopRec = $cs_inicio_ejecucion_list->TotalRecs;
}
$cs_inicio_ejecucion_list->RecCnt = $cs_inicio_ejecucion_list->StartRec - 1;
if ($cs_inicio_ejecucion_list->Recordset && !$cs_inicio_ejecucion_list->Recordset->EOF) {
	$cs_inicio_ejecucion_list->Recordset->MoveFirst();
	$bSelectLimit = $cs_inicio_ejecucion_list->UseSelectLimit;
	if (!$bSelectLimit && $cs_inicio_ejecucion_list->StartRec > 1)
		$cs_inicio_ejecucion_list->Recordset->Move($cs_inicio_ejecucion_list->StartRec - 1);
} elseif (!$cs_inicio_ejecucion->AllowAddDeleteRow && $cs_inicio_ejecucion_list->StopRec == 0) {
	$cs_inicio_ejecucion_list->StopRec = $cs_inicio_ejecucion->GridAddRowCount;
}

// Initialize aggregate
$cs_inicio_ejecucion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_inicio_ejecucion->ResetAttrs();
$cs_inicio_ejecucion_list->RenderRow();
while ($cs_inicio_ejecucion_list->RecCnt < $cs_inicio_ejecucion_list->StopRec) {
	$cs_inicio_ejecucion_list->RecCnt++;
	if (intval($cs_inicio_ejecucion_list->RecCnt) >= intval($cs_inicio_ejecucion_list->StartRec)) {
		$cs_inicio_ejecucion_list->RowCnt++;

		// Set up key count
		$cs_inicio_ejecucion_list->KeyCount = $cs_inicio_ejecucion_list->RowIndex;

		// Init row class and style
		$cs_inicio_ejecucion->ResetAttrs();
		$cs_inicio_ejecucion->CssClass = "";
		if ($cs_inicio_ejecucion->CurrentAction == "gridadd") {
		} else {
			$cs_inicio_ejecucion_list->LoadRowValues($cs_inicio_ejecucion_list->Recordset); // Load row values
		}
		$cs_inicio_ejecucion->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cs_inicio_ejecucion->RowAttrs = array_merge($cs_inicio_ejecucion->RowAttrs, array('data-rowindex'=>$cs_inicio_ejecucion_list->RowCnt, 'id'=>'r' . $cs_inicio_ejecucion_list->RowCnt . '_cs_inicio_ejecucion', 'data-rowtype'=>$cs_inicio_ejecucion->RowType));

		// Render row
		$cs_inicio_ejecucion_list->RenderRow();

		// Render list options
		$cs_inicio_ejecucion_list->RenderListOptions();
?>
	<tr<?php echo $cs_inicio_ejecucion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_inicio_ejecucion_list->ListOptions->Render("body", "left", $cs_inicio_ejecucion_list->RowCnt);
?>
	<?php if ($cs_inicio_ejecucion->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cs_inicio_ejecucion->codigo->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_codigo" class="cs_inicio_ejecucion_codigo">
<span<?php echo $cs_inicio_ejecucion->codigo->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->codigo->ListViewValue() ?></span>
</span>
<a id="<?php echo $cs_inicio_ejecucion_list->PageObjName . "_row_" . $cs_inicio_ejecucion_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->idContratacion->Visible) { // idContratacion ?>
		<td data-name="idContratacion"<?php echo $cs_inicio_ejecucion->idContratacion->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_idContratacion" class="cs_inicio_ejecucion_idContratacion">
<span<?php echo $cs_inicio_ejecucion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->idContratacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $cs_inicio_ejecucion->imagen->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_imagen" class="cs_inicio_ejecucion_imagen">
<span<?php echo $cs_inicio_ejecucion->imagen->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->imagen->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_01->Visible) { // cod_contacto_01 ?>
		<td data-name="cod_contacto_01"<?php echo $cs_inicio_ejecucion->cod_contacto_01->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_01" class="cs_inicio_ejecucion_cod_contacto_01">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_01->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_02->Visible) { // cod_contacto_02 ?>
		<td data-name="cod_contacto_02"<?php echo $cs_inicio_ejecucion->cod_contacto_02->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_02" class="cs_inicio_ejecucion_cod_contacto_02">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_02->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->cod_contacto_03->Visible) { // cod_contacto_03 ?>
		<td data-name="cod_contacto_03"<?php echo $cs_inicio_ejecucion->cod_contacto_03->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_cod_contacto_03" class="cs_inicio_ejecucion_cod_contacto_03">
<span<?php echo $cs_inicio_ejecucion->cod_contacto_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->cod_contacto_03->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_01->Visible) { // tipo_garant_01 ?>
		<td data-name="tipo_garant_01"<?php echo $cs_inicio_ejecucion->tipo_garant_01->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_01" class="cs_inicio_ejecucion_tipo_garant_01">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_01->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_02->Visible) { // tipo_garant_02 ?>
		<td data-name="tipo_garant_02"<?php echo $cs_inicio_ejecucion->tipo_garant_02->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_02" class="cs_inicio_ejecucion_tipo_garant_02">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_02->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->tipo_garant_03->Visible) { // tipo_garant_03 ?>
		<td data-name="tipo_garant_03"<?php echo $cs_inicio_ejecucion->tipo_garant_03->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_tipo_garant_03" class="cs_inicio_ejecucion_tipo_garant_03">
<span<?php echo $cs_inicio_ejecucion->tipo_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->tipo_garant_03->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_01->Visible) { // monto_garant_01 ?>
		<td data-name="monto_garant_01"<?php echo $cs_inicio_ejecucion->monto_garant_01->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_monto_garant_01" class="cs_inicio_ejecucion_monto_garant_01">
<span<?php echo $cs_inicio_ejecucion->monto_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_01->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_02->Visible) { // monto_garant_02 ?>
		<td data-name="monto_garant_02"<?php echo $cs_inicio_ejecucion->monto_garant_02->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_monto_garant_02" class="cs_inicio_ejecucion_monto_garant_02">
<span<?php echo $cs_inicio_ejecucion->monto_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_02->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->monto_garant_03->Visible) { // monto_garant_03 ?>
		<td data-name="monto_garant_03"<?php echo $cs_inicio_ejecucion->monto_garant_03->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_monto_garant_03" class="cs_inicio_ejecucion_monto_garant_03">
<span<?php echo $cs_inicio_ejecucion->monto_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->monto_garant_03->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_01->Visible) { // estado_garant_01 ?>
		<td data-name="estado_garant_01"<?php echo $cs_inicio_ejecucion->estado_garant_01->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_estado_garant_01" class="cs_inicio_ejecucion_estado_garant_01">
<span<?php echo $cs_inicio_ejecucion->estado_garant_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_01->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_02->Visible) { // estado_garant_02 ?>
		<td data-name="estado_garant_02"<?php echo $cs_inicio_ejecucion->estado_garant_02->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_estado_garant_02" class="cs_inicio_ejecucion_estado_garant_02">
<span<?php echo $cs_inicio_ejecucion->estado_garant_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_02->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_garant_03->Visible) { // estado_garant_03 ?>
		<td data-name="estado_garant_03"<?php echo $cs_inicio_ejecucion->estado_garant_03->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_estado_garant_03" class="cs_inicio_ejecucion_estado_garant_03">
<span<?php echo $cs_inicio_ejecucion->estado_garant_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_garant_03->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_01->Visible) { // fecha_venc_01 ?>
		<td data-name="fecha_venc_01"<?php echo $cs_inicio_ejecucion->fecha_venc_01->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_01" class="cs_inicio_ejecucion_fecha_venc_01">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_01->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_01->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_02->Visible) { // fecha_venc_02 ?>
		<td data-name="fecha_venc_02"<?php echo $cs_inicio_ejecucion->fecha_venc_02->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_02" class="cs_inicio_ejecucion_fecha_venc_02">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_02->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_02->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_venc_03->Visible) { // fecha_venc_03 ?>
		<td data-name="fecha_venc_03"<?php echo $cs_inicio_ejecucion->fecha_venc_03->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_fecha_venc_03" class="cs_inicio_ejecucion_fecha_venc_03">
<span<?php echo $cs_inicio_ejecucion->fecha_venc_03->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_venc_03->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_latitud->Visible) { // geo_latitud ?>
		<td data-name="geo_latitud"<?php echo $cs_inicio_ejecucion->geo_latitud->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_geo_latitud" class="cs_inicio_ejecucion_geo_latitud">
<span<?php echo $cs_inicio_ejecucion->geo_latitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_latitud->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_longitud->Visible) { // geo_longitud ?>
		<td data-name="geo_longitud"<?php echo $cs_inicio_ejecucion->geo_longitud->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_geo_longitud" class="cs_inicio_ejecucion_geo_longitud">
<span<?php echo $cs_inicio_ejecucion->geo_longitud->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_longitud->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_lati_final->Visible) { // geo_lati_final ?>
		<td data-name="geo_lati_final"<?php echo $cs_inicio_ejecucion->geo_lati_final->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_geo_lati_final" class="cs_inicio_ejecucion_geo_lati_final">
<span<?php echo $cs_inicio_ejecucion->geo_lati_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_lati_final->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->geo_long_final->Visible) { // geo_long_final ?>
		<td data-name="geo_long_final"<?php echo $cs_inicio_ejecucion->geo_long_final->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_geo_long_final" class="cs_inicio_ejecucion_geo_long_final">
<span<?php echo $cs_inicio_ejecucion->geo_long_final->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->geo_long_final->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_inicio->Visible) { // fecha_inicio ?>
		<td data-name="fecha_inicio"<?php echo $cs_inicio_ejecucion->fecha_inicio->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_fecha_inicio" class="cs_inicio_ejecucion_fecha_inicio">
<span<?php echo $cs_inicio_ejecucion->fecha_inicio->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_inicio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->estado_sol->Visible) { // estado_sol ?>
		<td data-name="estado_sol"<?php echo $cs_inicio_ejecucion->estado_sol->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_estado_sol" class="cs_inicio_ejecucion_estado_sol">
<span<?php echo $cs_inicio_ejecucion->estado_sol->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->estado_sol->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->fecha_registro->Visible) { // fecha_registro ?>
		<td data-name="fecha_registro"<?php echo $cs_inicio_ejecucion->fecha_registro->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_fecha_registro" class="cs_inicio_ejecucion_fecha_registro">
<span<?php echo $cs_inicio_ejecucion->fecha_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->fecha_registro->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_inicio_ejecucion->user_registro->Visible) { // user_registro ?>
		<td data-name="user_registro"<?php echo $cs_inicio_ejecucion->user_registro->CellAttributes() ?>>
<span id="el<?php echo $cs_inicio_ejecucion_list->RowCnt ?>_cs_inicio_ejecucion_user_registro" class="cs_inicio_ejecucion_user_registro">
<span<?php echo $cs_inicio_ejecucion->user_registro->ViewAttributes() ?>>
<?php echo $cs_inicio_ejecucion->user_registro->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_inicio_ejecucion_list->ListOptions->Render("body", "right", $cs_inicio_ejecucion_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($cs_inicio_ejecucion->CurrentAction <> "gridadd")
		$cs_inicio_ejecucion_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($cs_inicio_ejecucion->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cs_inicio_ejecucion_list->Recordset)
	$cs_inicio_ejecucion_list->Recordset->Close();
?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($cs_inicio_ejecucion->CurrentAction <> "gridadd" && $cs_inicio_ejecucion->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cs_inicio_ejecucion_list->Pager)) $cs_inicio_ejecucion_list->Pager = new cPrevNextPager($cs_inicio_ejecucion_list->StartRec, $cs_inicio_ejecucion_list->DisplayRecs, $cs_inicio_ejecucion_list->TotalRecs) ?>
<?php if ($cs_inicio_ejecucion_list->Pager->RecordCount > 0) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cs_inicio_ejecucion_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cs_inicio_ejecucion_list->PageUrl() ?>start=<?php echo $cs_inicio_ejecucion_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cs_inicio_ejecucion_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cs_inicio_ejecucion_list->PageUrl() ?>start=<?php echo $cs_inicio_ejecucion_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cs_inicio_ejecucion_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cs_inicio_ejecucion_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cs_inicio_ejecucion_list->PageUrl() ?>start=<?php echo $cs_inicio_ejecucion_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cs_inicio_ejecucion_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cs_inicio_ejecucion_list->PageUrl() ?>start=<?php echo $cs_inicio_ejecucion_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cs_inicio_ejecucion_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cs_inicio_ejecucion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cs_inicio_ejecucion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cs_inicio_ejecucion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_inicio_ejecucion_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($cs_inicio_ejecucion_list->TotalRecs == 0 && $cs_inicio_ejecucion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_inicio_ejecucion_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<script type="text/javascript">
fcs_inicio_ejecucionlistsrch.Init();
fcs_inicio_ejecucionlistsrch.FilterList = <?php echo $cs_inicio_ejecucion_list->GetFilterList() ?>;
fcs_inicio_ejecucionlist.Init();
</script>
<?php } ?>
<?php
$cs_inicio_ejecucion_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cs_inicio_ejecucion->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cs_inicio_ejecucion_list->Page_Terminate();
?>
