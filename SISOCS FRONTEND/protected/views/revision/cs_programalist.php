<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_programainfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_proyectogridcls.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_programa_list = NULL; // Initialize page object first

class ccs_programa_list extends ccs_programa {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_programa';

	// Page object name
	var $PageObjName = 'cs_programa_list';

	// Grid form hidden field names
	var $FormName = 'fcs_programalist';
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

		// Table object (cs_programa)
		if (!isset($GLOBALS["cs_programa"]) || get_class($GLOBALS["cs_programa"]) == "ccs_programa") {
			$GLOBALS["cs_programa"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_programa"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cs_programaadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cs_programadelete.php";
		$this->MultiUpdateUrl = "cs_programaupdate.php";

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_programa', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fcs_programalistsrch";

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
		$this->idPrograma->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

			// Process auto fill for detail table 'cs_proyecto'
			if (@$_POST["grid"] == "fcs_proyectogrid") {
				if (!isset($GLOBALS["cs_proyecto_grid"])) $GLOBALS["cs_proyecto_grid"] = new ccs_proyecto_grid;
				$GLOBALS["cs_proyecto_grid"]->Page_Init();
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
		global $EW_EXPORT, $cs_programa;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_programa);
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
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Restore filter list
			$this->RestoreFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
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

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
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
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

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
			$this->idPrograma->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idPrograma->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->entes->AdvancedSearch->ToJSON(), ","); // Field entes

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

		// Field entes
		$this->entes->AdvancedSearch->SearchValue = @$filter["x_entes"];
		$this->entes->AdvancedSearch->SearchOperator = @$filter["z_entes"];
		$this->entes->AdvancedSearch->SearchCondition = @$filter["v_entes"];
		$this->entes->AdvancedSearch->SearchValue2 = @$filter["y_entes"];
		$this->entes->AdvancedSearch->SearchOperator2 = @$filter["w_entes"];
		$this->entes->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->entes, $Default, FALSE); // entes

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->entes->AdvancedSearch->Save(); // entes
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Check if search parm exists
	function CheckSearchParms() {
		if ($this->entes->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->entes->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->entes->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->idPrograma); // idPrograma
			$this->UpdateSort($this->programa); // programa
			$this->UpdateSort($this->BIP); // BIP
			$this->UpdateSort($this->nombreprograma); // nombreprograma
			$this->UpdateSort($this->entes); // entes
			$this->UpdateSort($this->idFuncionario); // idFuncionario
			$this->UpdateSort($this->idRol); // idRol
			$this->UpdateSort($this->idSector); // idSector
			$this->UpdateSort($this->idSubSector); // idSubSector
			$this->UpdateSort($this->costoesti); // costoesti
			$this->UpdateSort($this->fechaapro); // fechaapro
			$this->UpdateSort($this->cartaconvenio); // cartaconvenio
			$this->UpdateSort($this->otro1); // otro1
			$this->UpdateSort($this->planope); // planope
			$this->UpdateSort($this->presupuesto); // presupuesto
			$this->UpdateSort($this->perfildelprogra); // perfildelprogra
			$this->UpdateSort($this->otro2); // otro2
			$this->UpdateSort($this->fechacreacion); // fechacreacion
			$this->UpdateSort($this->estado); // estado
			$this->UpdateSort($this->idProposito); // idProposito
			$this->UpdateSort($this->fecharecibido); // fecharecibido
			$this->UpdateSort($this->moneda); // moneda
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

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->idPrograma->setSort("");
				$this->programa->setSort("");
				$this->BIP->setSort("");
				$this->nombreprograma->setSort("");
				$this->entes->setSort("");
				$this->idFuncionario->setSort("");
				$this->idRol->setSort("");
				$this->idSector->setSort("");
				$this->idSubSector->setSort("");
				$this->costoesti->setSort("");
				$this->fechaapro->setSort("");
				$this->cartaconvenio->setSort("");
				$this->otro1->setSort("");
				$this->planope->setSort("");
				$this->presupuesto->setSort("");
				$this->perfildelprogra->setSort("");
				$this->otro2->setSort("");
				$this->fechacreacion->setSort("");
				$this->estado->setSort("");
				$this->idProposito->setSort("");
				$this->fecharecibido->setSort("");
				$this->moneda->setSort("");
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

		// "detail_cs_proyecto"
		$item = &$this->ListOptions->Add("detail_cs_proyecto");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_proyecto') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cs_proyecto_grid"])) $GLOBALS["cs_proyecto_grid"] = new ccs_proyecto_grid;

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
		$pages->Add("cs_proyecto");
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

		// "detail_cs_proyecto"
		$oListOpt = &$this->ListOptions->Items["detail_cs_proyecto"];
		if ($Security->AllowList(CurrentProjectID() . 'cs_proyecto')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("cs_proyecto", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_proyectolist.php?" . EW_TABLE_SHOW_MASTER . "=cs_programa&fk_idPrograma=" . urlencode(strval($this->idPrograma->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cs_proyecto_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_proyecto')) {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_proyecto")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "cs_proyecto";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->idPrograma->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fcs_programalistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fcs_programalistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fcs_programalist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->Add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"cs_programasrch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

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

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// entes

		$this->entes->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_entes"]);
		if ($this->entes->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->entes->AdvancedSearch->SearchOperator = @$_GET["z_entes"];
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
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
		$this->idPrograma->setDbValue($rs->fields('idPrograma'));
		$this->programa->setDbValue($rs->fields('programa'));
		$this->BIP->setDbValue($rs->fields('BIP'));
		$this->nombreprograma->setDbValue($rs->fields('nombreprograma'));
		$this->ubicacion->setDbValue($rs->fields('ubicacion'));
		$this->entes->setDbValue($rs->fields('entes'));
		if (array_key_exists('EV__entes', $rs->fields)) {
			$this->entes->VirtualValue = $rs->fields('EV__entes'); // Set up virtual field value
		} else {
			$this->entes->VirtualValue = ""; // Clear value
		}
		$this->idFuncionario->setDbValue($rs->fields('idFuncionario'));
		$this->idRol->setDbValue($rs->fields('idRol'));
		$this->idSector->setDbValue($rs->fields('idSector'));
		$this->idSubSector->setDbValue($rs->fields('idSubSector'));
		$this->descripcion->setDbValue($rs->fields('descripcion'));
		$this->costoesti->setDbValue($rs->fields('costoesti'));
		$this->fechaapro->setDbValue($rs->fields('fechaapro'));
		$this->cartaconvenio->setDbValue($rs->fields('cartaconvenio'));
		$this->otro1->setDbValue($rs->fields('otro1'));
		$this->planope->setDbValue($rs->fields('planope'));
		$this->presupuesto->setDbValue($rs->fields('presupuesto'));
		$this->perfildelprogra->setDbValue($rs->fields('perfildelprogra'));
		$this->otro2->setDbValue($rs->fields('otro2'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->idProposito->setDbValue($rs->fields('idProposito'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->moneda->setDbValue($rs->fields('moneda'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idPrograma->DbValue = $row['idPrograma'];
		$this->programa->DbValue = $row['programa'];
		$this->BIP->DbValue = $row['BIP'];
		$this->nombreprograma->DbValue = $row['nombreprograma'];
		$this->ubicacion->DbValue = $row['ubicacion'];
		$this->entes->DbValue = $row['entes'];
		$this->idFuncionario->DbValue = $row['idFuncionario'];
		$this->idRol->DbValue = $row['idRol'];
		$this->idSector->DbValue = $row['idSector'];
		$this->idSubSector->DbValue = $row['idSubSector'];
		$this->descripcion->DbValue = $row['descripcion'];
		$this->costoesti->DbValue = $row['costoesti'];
		$this->fechaapro->DbValue = $row['fechaapro'];
		$this->cartaconvenio->DbValue = $row['cartaconvenio'];
		$this->otro1->DbValue = $row['otro1'];
		$this->planope->DbValue = $row['planope'];
		$this->presupuesto->DbValue = $row['presupuesto'];
		$this->perfildelprogra->DbValue = $row['perfildelprogra'];
		$this->otro2->DbValue = $row['otro2'];
		$this->fechacreacion->DbValue = $row['fechacreacion'];
		$this->estado->DbValue = $row['estado'];
		$this->idProposito->DbValue = $row['idProposito'];
		$this->fecharecibido->DbValue = $row['fecharecibido'];
		$this->moneda->DbValue = $row['moneda'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("idPrograma")) <> "")
			$this->idPrograma->CurrentValue = $this->getKey("idPrograma"); // idPrograma
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
		if ($this->costoesti->FormValue == $this->costoesti->CurrentValue && is_numeric(ew_StrToFloat($this->costoesti->CurrentValue)))
			$this->costoesti->CurrentValue = ew_StrToFloat($this->costoesti->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// idPrograma
		// programa
		// BIP
		// nombreprograma
		// ubicacion
		// entes
		// idFuncionario
		// idRol
		// idSector
		// idSubSector
		// descripcion
		// costoesti
		// fechaapro
		// cartaconvenio
		// otro1
		// planope
		// presupuesto
		// perfildelprogra
		// otro2
		// fechacreacion
		// estado
		// idProposito
		// fecharecibido
		// moneda

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// idPrograma
		$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->ViewCustomAttributes = "";

		// programa
		$this->programa->ViewValue = $this->programa->CurrentValue;
		$this->programa->ViewCustomAttributes = "";

		// BIP
		$this->BIP->ViewValue = $this->BIP->CurrentValue;
		$this->BIP->ViewCustomAttributes = "";

		// nombreprograma
		$this->nombreprograma->ViewValue = $this->nombreprograma->CurrentValue;
		$this->nombreprograma->ViewCustomAttributes = "";

		// entes
		if ($this->entes->VirtualValue <> "") {
			$this->entes->ViewValue = $this->entes->VirtualValue;
		} else {
		if (strval($this->entes->CurrentValue) <> "") {
			$sFilterWrk = "`idente`" . ew_SearchString("=", $this->entes->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `idente`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cs_entes`";
		$sWhereWrk = "";
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->entes, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->entes->ViewValue = $this->entes->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->entes->ViewValue = $this->entes->CurrentValue;
			}
		} else {
			$this->entes->ViewValue = NULL;
		}
		}
		$this->entes->ViewCustomAttributes = "";

		// idFuncionario
		$this->idFuncionario->ViewValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->ViewCustomAttributes = "";

		// idRol
		$this->idRol->ViewValue = $this->idRol->CurrentValue;
		$this->idRol->ViewCustomAttributes = "";

		// idSector
		$this->idSector->ViewValue = $this->idSector->CurrentValue;
		$this->idSector->ViewCustomAttributes = "";

		// idSubSector
		$this->idSubSector->ViewValue = $this->idSubSector->CurrentValue;
		$this->idSubSector->ViewCustomAttributes = "";

		// costoesti
		$this->costoesti->ViewValue = $this->costoesti->CurrentValue;
		$this->costoesti->ViewCustomAttributes = "";

		// fechaapro
		$this->fechaapro->ViewValue = $this->fechaapro->CurrentValue;
		$this->fechaapro->ViewCustomAttributes = "";

		// cartaconvenio
		$this->cartaconvenio->ViewValue = $this->cartaconvenio->CurrentValue;
		$this->cartaconvenio->ViewCustomAttributes = "";

		// otro1
		$this->otro1->ViewValue = $this->otro1->CurrentValue;
		$this->otro1->ViewCustomAttributes = "";

		// planope
		$this->planope->ViewValue = $this->planope->CurrentValue;
		$this->planope->ViewCustomAttributes = "";

		// presupuesto
		$this->presupuesto->ViewValue = $this->presupuesto->CurrentValue;
		$this->presupuesto->ViewCustomAttributes = "";

		// perfildelprogra
		$this->perfildelprogra->ViewValue = $this->perfildelprogra->CurrentValue;
		$this->perfildelprogra->ViewCustomAttributes = "";

		// otro2
		$this->otro2->ViewValue = $this->otro2->CurrentValue;
		$this->otro2->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// idProposito
		$this->idProposito->ViewValue = $this->idProposito->CurrentValue;
		$this->idProposito->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// moneda
		$this->moneda->ViewValue = $this->moneda->CurrentValue;
		$this->moneda->ViewCustomAttributes = "";

			// idPrograma
			$this->idPrograma->LinkCustomAttributes = "";
			$this->idPrograma->HrefValue = "";
			$this->idPrograma->TooltipValue = "";

			// programa
			$this->programa->LinkCustomAttributes = "";
			$this->programa->HrefValue = "";
			$this->programa->TooltipValue = "";

			// BIP
			$this->BIP->LinkCustomAttributes = "";
			$this->BIP->HrefValue = "";
			$this->BIP->TooltipValue = "";

			// nombreprograma
			$this->nombreprograma->LinkCustomAttributes = "";
			$this->nombreprograma->HrefValue = "";
			$this->nombreprograma->TooltipValue = "";

			// entes
			$this->entes->LinkCustomAttributes = "";
			$this->entes->HrefValue = "";
			$this->entes->TooltipValue = "";

			// idFuncionario
			$this->idFuncionario->LinkCustomAttributes = "";
			$this->idFuncionario->HrefValue = "";
			$this->idFuncionario->TooltipValue = "";

			// idRol
			$this->idRol->LinkCustomAttributes = "";
			$this->idRol->HrefValue = "";
			$this->idRol->TooltipValue = "";

			// idSector
			$this->idSector->LinkCustomAttributes = "";
			$this->idSector->HrefValue = "";
			$this->idSector->TooltipValue = "";

			// idSubSector
			$this->idSubSector->LinkCustomAttributes = "";
			$this->idSubSector->HrefValue = "";
			$this->idSubSector->TooltipValue = "";

			// costoesti
			$this->costoesti->LinkCustomAttributes = "";
			$this->costoesti->HrefValue = "";
			$this->costoesti->TooltipValue = "";

			// fechaapro
			$this->fechaapro->LinkCustomAttributes = "";
			$this->fechaapro->HrefValue = "";
			$this->fechaapro->TooltipValue = "";

			// cartaconvenio
			$this->cartaconvenio->LinkCustomAttributes = "";
			$this->cartaconvenio->HrefValue = "";
			$this->cartaconvenio->TooltipValue = "";

			// otro1
			$this->otro1->LinkCustomAttributes = "";
			$this->otro1->HrefValue = "";
			$this->otro1->TooltipValue = "";

			// planope
			$this->planope->LinkCustomAttributes = "";
			$this->planope->HrefValue = "";
			$this->planope->TooltipValue = "";

			// presupuesto
			$this->presupuesto->LinkCustomAttributes = "";
			$this->presupuesto->HrefValue = "";
			$this->presupuesto->TooltipValue = "";

			// perfildelprogra
			$this->perfildelprogra->LinkCustomAttributes = "";
			$this->perfildelprogra->HrefValue = "";
			$this->perfildelprogra->TooltipValue = "";

			// otro2
			$this->otro2->LinkCustomAttributes = "";
			$this->otro2->HrefValue = "";
			$this->otro2->TooltipValue = "";

			// fechacreacion
			$this->fechacreacion->LinkCustomAttributes = "";
			$this->fechacreacion->HrefValue = "";
			$this->fechacreacion->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// idProposito
			$this->idProposito->LinkCustomAttributes = "";
			$this->idProposito->HrefValue = "";
			$this->idProposito->TooltipValue = "";

			// fecharecibido
			$this->fecharecibido->LinkCustomAttributes = "";
			$this->fecharecibido->HrefValue = "";
			$this->fecharecibido->TooltipValue = "";

			// moneda
			$this->moneda->LinkCustomAttributes = "";
			$this->moneda->HrefValue = "";
			$this->moneda->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->entes->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_cs_programa\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_cs_programa',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fcs_programalist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
if (!isset($cs_programa_list)) $cs_programa_list = new ccs_programa_list();

// Page init
$cs_programa_list->Page_Init();

// Page main
$cs_programa_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_programa_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($cs_programa->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fcs_programalist = new ew_Form("fcs_programalist", "list");
fcs_programalist.FormKeyCountName = '<?php echo $cs_programa_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcs_programalist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_programalist.ValidateRequired = true;
<?php } else { ?>
fcs_programalist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fcs_programalist.Lists["x_entes"] = {"LinkField":"x_idente","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};

// Form object for search
var CurrentSearchForm = fcs_programalistsrch = new ew_Form("fcs_programalistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($cs_programa->Export == "") { ?>
<div class="ewToolbar">
<?php if ($cs_programa->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($cs_programa_list->TotalRecs > 0 && $cs_programa_list->ExportOptions->Visible()) { ?>
<?php $cs_programa_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_programa_list->SearchOptions->Visible()) { ?>
<?php $cs_programa_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_programa_list->FilterOptions->Visible()) { ?>
<?php $cs_programa_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_programa->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $cs_programa_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_programa_list->TotalRecs <= 0)
			$cs_programa_list->TotalRecs = $cs_programa->SelectRecordCount();
	} else {
		if (!$cs_programa_list->Recordset && ($cs_programa_list->Recordset = $cs_programa_list->LoadRecordset()))
			$cs_programa_list->TotalRecs = $cs_programa_list->Recordset->RecordCount();
	}
	$cs_programa_list->StartRec = 1;
	if ($cs_programa_list->DisplayRecs <= 0 || ($cs_programa->Export <> "" && $cs_programa->ExportAll)) // Display all records
		$cs_programa_list->DisplayRecs = $cs_programa_list->TotalRecs;
	if (!($cs_programa->Export <> "" && $cs_programa->ExportAll))
		$cs_programa_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cs_programa_list->Recordset = $cs_programa_list->LoadRecordset($cs_programa_list->StartRec-1, $cs_programa_list->DisplayRecs);

	// Set no record found message
	if ($cs_programa->CurrentAction == "" && $cs_programa_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_programa_list->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_programa_list->SearchWhere == "0=101")
			$cs_programa_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_programa_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$cs_programa_list->RenderOtherOptions();
?>
<?php $cs_programa_list->ShowPageHeader(); ?>
<?php
$cs_programa_list->ShowMessage();
?>
<?php if ($cs_programa_list->TotalRecs > 0 || $cs_programa->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<form name="fcs_programalist" id="fcs_programalist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_programa_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_programa_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_programa">
<div id="gmp_cs_programa" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($cs_programa_list->TotalRecs > 0) { ?>
<table id="tbl_cs_programalist" class="table ewTable">
<?php echo $cs_programa->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_programa_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_programa_list->RenderListOptions();

// Render list options (header, left)
$cs_programa_list->ListOptions->Render("header", "left");
?>
<?php if ($cs_programa->idPrograma->Visible) { // idPrograma ?>
	<?php if ($cs_programa->SortUrl($cs_programa->idPrograma) == "") { ?>
		<th data-name="idPrograma"><div id="elh_cs_programa_idPrograma" class="cs_programa_idPrograma"><div class="ewTableHeaderCaption"><?php echo $cs_programa->idPrograma->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idPrograma"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->idPrograma) ?>',1);"><div id="elh_cs_programa_idPrograma" class="cs_programa_idPrograma">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->idPrograma->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->idPrograma->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->idPrograma->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->programa->Visible) { // programa ?>
	<?php if ($cs_programa->SortUrl($cs_programa->programa) == "") { ?>
		<th data-name="programa"><div id="elh_cs_programa_programa" class="cs_programa_programa"><div class="ewTableHeaderCaption"><?php echo $cs_programa->programa->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="programa"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->programa) ?>',1);"><div id="elh_cs_programa_programa" class="cs_programa_programa">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->programa->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->programa->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->programa->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->BIP->Visible) { // BIP ?>
	<?php if ($cs_programa->SortUrl($cs_programa->BIP) == "") { ?>
		<th data-name="BIP"><div id="elh_cs_programa_BIP" class="cs_programa_BIP"><div class="ewTableHeaderCaption"><?php echo $cs_programa->BIP->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BIP"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->BIP) ?>',1);"><div id="elh_cs_programa_BIP" class="cs_programa_BIP">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->BIP->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->BIP->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->BIP->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->nombreprograma->Visible) { // nombreprograma ?>
	<?php if ($cs_programa->SortUrl($cs_programa->nombreprograma) == "") { ?>
		<th data-name="nombreprograma"><div id="elh_cs_programa_nombreprograma" class="cs_programa_nombreprograma"><div class="ewTableHeaderCaption"><?php echo $cs_programa->nombreprograma->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombreprograma"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->nombreprograma) ?>',1);"><div id="elh_cs_programa_nombreprograma" class="cs_programa_nombreprograma">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->nombreprograma->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->nombreprograma->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->nombreprograma->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->entes->Visible) { // entes ?>
	<?php if ($cs_programa->SortUrl($cs_programa->entes) == "") { ?>
		<th data-name="entes"><div id="elh_cs_programa_entes" class="cs_programa_entes"><div class="ewTableHeaderCaption"><?php echo $cs_programa->entes->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="entes"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->entes) ?>',1);"><div id="elh_cs_programa_entes" class="cs_programa_entes">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->entes->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->entes->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->entes->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->idFuncionario->Visible) { // idFuncionario ?>
	<?php if ($cs_programa->SortUrl($cs_programa->idFuncionario) == "") { ?>
		<th data-name="idFuncionario"><div id="elh_cs_programa_idFuncionario" class="cs_programa_idFuncionario"><div class="ewTableHeaderCaption"><?php echo $cs_programa->idFuncionario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idFuncionario"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->idFuncionario) ?>',1);"><div id="elh_cs_programa_idFuncionario" class="cs_programa_idFuncionario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->idFuncionario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->idFuncionario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->idFuncionario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->idRol->Visible) { // idRol ?>
	<?php if ($cs_programa->SortUrl($cs_programa->idRol) == "") { ?>
		<th data-name="idRol"><div id="elh_cs_programa_idRol" class="cs_programa_idRol"><div class="ewTableHeaderCaption"><?php echo $cs_programa->idRol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRol"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->idRol) ?>',1);"><div id="elh_cs_programa_idRol" class="cs_programa_idRol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->idRol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->idRol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->idRol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->idSector->Visible) { // idSector ?>
	<?php if ($cs_programa->SortUrl($cs_programa->idSector) == "") { ?>
		<th data-name="idSector"><div id="elh_cs_programa_idSector" class="cs_programa_idSector"><div class="ewTableHeaderCaption"><?php echo $cs_programa->idSector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idSector"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->idSector) ?>',1);"><div id="elh_cs_programa_idSector" class="cs_programa_idSector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->idSector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->idSector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->idSector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->idSubSector->Visible) { // idSubSector ?>
	<?php if ($cs_programa->SortUrl($cs_programa->idSubSector) == "") { ?>
		<th data-name="idSubSector"><div id="elh_cs_programa_idSubSector" class="cs_programa_idSubSector"><div class="ewTableHeaderCaption"><?php echo $cs_programa->idSubSector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idSubSector"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->idSubSector) ?>',1);"><div id="elh_cs_programa_idSubSector" class="cs_programa_idSubSector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->idSubSector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->idSubSector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->idSubSector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->costoesti->Visible) { // costoesti ?>
	<?php if ($cs_programa->SortUrl($cs_programa->costoesti) == "") { ?>
		<th data-name="costoesti"><div id="elh_cs_programa_costoesti" class="cs_programa_costoesti"><div class="ewTableHeaderCaption"><?php echo $cs_programa->costoesti->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="costoesti"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->costoesti) ?>',1);"><div id="elh_cs_programa_costoesti" class="cs_programa_costoesti">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->costoesti->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->costoesti->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->costoesti->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->fechaapro->Visible) { // fechaapro ?>
	<?php if ($cs_programa->SortUrl($cs_programa->fechaapro) == "") { ?>
		<th data-name="fechaapro"><div id="elh_cs_programa_fechaapro" class="cs_programa_fechaapro"><div class="ewTableHeaderCaption"><?php echo $cs_programa->fechaapro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaapro"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->fechaapro) ?>',1);"><div id="elh_cs_programa_fechaapro" class="cs_programa_fechaapro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->fechaapro->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->fechaapro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->fechaapro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->cartaconvenio->Visible) { // cartaconvenio ?>
	<?php if ($cs_programa->SortUrl($cs_programa->cartaconvenio) == "") { ?>
		<th data-name="cartaconvenio"><div id="elh_cs_programa_cartaconvenio" class="cs_programa_cartaconvenio"><div class="ewTableHeaderCaption"><?php echo $cs_programa->cartaconvenio->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cartaconvenio"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->cartaconvenio) ?>',1);"><div id="elh_cs_programa_cartaconvenio" class="cs_programa_cartaconvenio">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->cartaconvenio->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->cartaconvenio->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->cartaconvenio->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->otro1->Visible) { // otro1 ?>
	<?php if ($cs_programa->SortUrl($cs_programa->otro1) == "") { ?>
		<th data-name="otro1"><div id="elh_cs_programa_otro1" class="cs_programa_otro1"><div class="ewTableHeaderCaption"><?php echo $cs_programa->otro1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->otro1) ?>',1);"><div id="elh_cs_programa_otro1" class="cs_programa_otro1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->otro1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->otro1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->otro1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->planope->Visible) { // planope ?>
	<?php if ($cs_programa->SortUrl($cs_programa->planope) == "") { ?>
		<th data-name="planope"><div id="elh_cs_programa_planope" class="cs_programa_planope"><div class="ewTableHeaderCaption"><?php echo $cs_programa->planope->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planope"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->planope) ?>',1);"><div id="elh_cs_programa_planope" class="cs_programa_planope">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->planope->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->planope->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->planope->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->presupuesto->Visible) { // presupuesto ?>
	<?php if ($cs_programa->SortUrl($cs_programa->presupuesto) == "") { ?>
		<th data-name="presupuesto"><div id="elh_cs_programa_presupuesto" class="cs_programa_presupuesto"><div class="ewTableHeaderCaption"><?php echo $cs_programa->presupuesto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presupuesto"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->presupuesto) ?>',1);"><div id="elh_cs_programa_presupuesto" class="cs_programa_presupuesto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->presupuesto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->presupuesto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->presupuesto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->perfildelprogra->Visible) { // perfildelprogra ?>
	<?php if ($cs_programa->SortUrl($cs_programa->perfildelprogra) == "") { ?>
		<th data-name="perfildelprogra"><div id="elh_cs_programa_perfildelprogra" class="cs_programa_perfildelprogra"><div class="ewTableHeaderCaption"><?php echo $cs_programa->perfildelprogra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perfildelprogra"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->perfildelprogra) ?>',1);"><div id="elh_cs_programa_perfildelprogra" class="cs_programa_perfildelprogra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->perfildelprogra->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->perfildelprogra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->perfildelprogra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->otro2->Visible) { // otro2 ?>
	<?php if ($cs_programa->SortUrl($cs_programa->otro2) == "") { ?>
		<th data-name="otro2"><div id="elh_cs_programa_otro2" class="cs_programa_otro2"><div class="ewTableHeaderCaption"><?php echo $cs_programa->otro2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->otro2) ?>',1);"><div id="elh_cs_programa_otro2" class="cs_programa_otro2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->otro2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->otro2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->otro2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->fechacreacion->Visible) { // fechacreacion ?>
	<?php if ($cs_programa->SortUrl($cs_programa->fechacreacion) == "") { ?>
		<th data-name="fechacreacion"><div id="elh_cs_programa_fechacreacion" class="cs_programa_fechacreacion"><div class="ewTableHeaderCaption"><?php echo $cs_programa->fechacreacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechacreacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->fechacreacion) ?>',1);"><div id="elh_cs_programa_fechacreacion" class="cs_programa_fechacreacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->fechacreacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->fechacreacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->fechacreacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->estado->Visible) { // estado ?>
	<?php if ($cs_programa->SortUrl($cs_programa->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_programa_estado" class="cs_programa_estado"><div class="ewTableHeaderCaption"><?php echo $cs_programa->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->estado) ?>',1);"><div id="elh_cs_programa_estado" class="cs_programa_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->idProposito->Visible) { // idProposito ?>
	<?php if ($cs_programa->SortUrl($cs_programa->idProposito) == "") { ?>
		<th data-name="idProposito"><div id="elh_cs_programa_idProposito" class="cs_programa_idProposito"><div class="ewTableHeaderCaption"><?php echo $cs_programa->idProposito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProposito"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->idProposito) ?>',1);"><div id="elh_cs_programa_idProposito" class="cs_programa_idProposito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->idProposito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->idProposito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->idProposito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_programa->SortUrl($cs_programa->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_programa_fecharecibido" class="cs_programa_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_programa->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->fecharecibido) ?>',1);"><div id="elh_cs_programa_fecharecibido" class="cs_programa_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->fecharecibido->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_programa->moneda->Visible) { // moneda ?>
	<?php if ($cs_programa->SortUrl($cs_programa->moneda) == "") { ?>
		<th data-name="moneda"><div id="elh_cs_programa_moneda" class="cs_programa_moneda"><div class="ewTableHeaderCaption"><?php echo $cs_programa->moneda->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="moneda"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_programa->SortUrl($cs_programa->moneda) ?>',1);"><div id="elh_cs_programa_moneda" class="cs_programa_moneda">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_programa->moneda->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_programa->moneda->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_programa->moneda->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_programa_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cs_programa->ExportAll && $cs_programa->Export <> "") {
	$cs_programa_list->StopRec = $cs_programa_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cs_programa_list->TotalRecs > $cs_programa_list->StartRec + $cs_programa_list->DisplayRecs - 1)
		$cs_programa_list->StopRec = $cs_programa_list->StartRec + $cs_programa_list->DisplayRecs - 1;
	else
		$cs_programa_list->StopRec = $cs_programa_list->TotalRecs;
}
$cs_programa_list->RecCnt = $cs_programa_list->StartRec - 1;
if ($cs_programa_list->Recordset && !$cs_programa_list->Recordset->EOF) {
	$cs_programa_list->Recordset->MoveFirst();
	$bSelectLimit = $cs_programa_list->UseSelectLimit;
	if (!$bSelectLimit && $cs_programa_list->StartRec > 1)
		$cs_programa_list->Recordset->Move($cs_programa_list->StartRec - 1);
} elseif (!$cs_programa->AllowAddDeleteRow && $cs_programa_list->StopRec == 0) {
	$cs_programa_list->StopRec = $cs_programa->GridAddRowCount;
}

// Initialize aggregate
$cs_programa->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_programa->ResetAttrs();
$cs_programa_list->RenderRow();
while ($cs_programa_list->RecCnt < $cs_programa_list->StopRec) {
	$cs_programa_list->RecCnt++;
	if (intval($cs_programa_list->RecCnt) >= intval($cs_programa_list->StartRec)) {
		$cs_programa_list->RowCnt++;

		// Set up key count
		$cs_programa_list->KeyCount = $cs_programa_list->RowIndex;

		// Init row class and style
		$cs_programa->ResetAttrs();
		$cs_programa->CssClass = "";
		if ($cs_programa->CurrentAction == "gridadd") {
		} else {
			$cs_programa_list->LoadRowValues($cs_programa_list->Recordset); // Load row values
		}
		$cs_programa->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cs_programa->RowAttrs = array_merge($cs_programa->RowAttrs, array('data-rowindex'=>$cs_programa_list->RowCnt, 'id'=>'r' . $cs_programa_list->RowCnt . '_cs_programa', 'data-rowtype'=>$cs_programa->RowType));

		// Render row
		$cs_programa_list->RenderRow();

		// Render list options
		$cs_programa_list->RenderListOptions();
?>
	<tr<?php echo $cs_programa->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_programa_list->ListOptions->Render("body", "left", $cs_programa_list->RowCnt);
?>
	<?php if ($cs_programa->idPrograma->Visible) { // idPrograma ?>
		<td data-name="idPrograma"<?php echo $cs_programa->idPrograma->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_idPrograma" class="cs_programa_idPrograma">
<span<?php echo $cs_programa->idPrograma->ViewAttributes() ?>>
<?php echo $cs_programa->idPrograma->ListViewValue() ?></span>
</span>
<a id="<?php echo $cs_programa_list->PageObjName . "_row_" . $cs_programa_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_programa->programa->Visible) { // programa ?>
		<td data-name="programa"<?php echo $cs_programa->programa->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_programa" class="cs_programa_programa">
<span<?php echo $cs_programa->programa->ViewAttributes() ?>>
<?php echo $cs_programa->programa->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->BIP->Visible) { // BIP ?>
		<td data-name="BIP"<?php echo $cs_programa->BIP->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_BIP" class="cs_programa_BIP">
<span<?php echo $cs_programa->BIP->ViewAttributes() ?>>
<?php echo $cs_programa->BIP->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->nombreprograma->Visible) { // nombreprograma ?>
		<td data-name="nombreprograma"<?php echo $cs_programa->nombreprograma->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_nombreprograma" class="cs_programa_nombreprograma">
<span<?php echo $cs_programa->nombreprograma->ViewAttributes() ?>>
<?php echo $cs_programa->nombreprograma->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->entes->Visible) { // entes ?>
		<td data-name="entes"<?php echo $cs_programa->entes->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_entes" class="cs_programa_entes">
<span<?php echo $cs_programa->entes->ViewAttributes() ?>>
<?php echo $cs_programa->entes->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario"<?php echo $cs_programa->idFuncionario->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_idFuncionario" class="cs_programa_idFuncionario">
<span<?php echo $cs_programa->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_programa->idFuncionario->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->idRol->Visible) { // idRol ?>
		<td data-name="idRol"<?php echo $cs_programa->idRol->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_idRol" class="cs_programa_idRol">
<span<?php echo $cs_programa->idRol->ViewAttributes() ?>>
<?php echo $cs_programa->idRol->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->idSector->Visible) { // idSector ?>
		<td data-name="idSector"<?php echo $cs_programa->idSector->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_idSector" class="cs_programa_idSector">
<span<?php echo $cs_programa->idSector->ViewAttributes() ?>>
<?php echo $cs_programa->idSector->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->idSubSector->Visible) { // idSubSector ?>
		<td data-name="idSubSector"<?php echo $cs_programa->idSubSector->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_idSubSector" class="cs_programa_idSubSector">
<span<?php echo $cs_programa->idSubSector->ViewAttributes() ?>>
<?php echo $cs_programa->idSubSector->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->costoesti->Visible) { // costoesti ?>
		<td data-name="costoesti"<?php echo $cs_programa->costoesti->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_costoesti" class="cs_programa_costoesti">
<span<?php echo $cs_programa->costoesti->ViewAttributes() ?>>
<?php echo $cs_programa->costoesti->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->fechaapro->Visible) { // fechaapro ?>
		<td data-name="fechaapro"<?php echo $cs_programa->fechaapro->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_fechaapro" class="cs_programa_fechaapro">
<span<?php echo $cs_programa->fechaapro->ViewAttributes() ?>>
<?php echo $cs_programa->fechaapro->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->cartaconvenio->Visible) { // cartaconvenio ?>
		<td data-name="cartaconvenio"<?php echo $cs_programa->cartaconvenio->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_cartaconvenio" class="cs_programa_cartaconvenio">
<span<?php echo $cs_programa->cartaconvenio->ViewAttributes() ?>>
<?php echo $cs_programa->cartaconvenio->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->otro1->Visible) { // otro1 ?>
		<td data-name="otro1"<?php echo $cs_programa->otro1->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_otro1" class="cs_programa_otro1">
<span<?php echo $cs_programa->otro1->ViewAttributes() ?>>
<?php echo $cs_programa->otro1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->planope->Visible) { // planope ?>
		<td data-name="planope"<?php echo $cs_programa->planope->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_planope" class="cs_programa_planope">
<span<?php echo $cs_programa->planope->ViewAttributes() ?>>
<?php echo $cs_programa->planope->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->presupuesto->Visible) { // presupuesto ?>
		<td data-name="presupuesto"<?php echo $cs_programa->presupuesto->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_presupuesto" class="cs_programa_presupuesto">
<span<?php echo $cs_programa->presupuesto->ViewAttributes() ?>>
<?php echo $cs_programa->presupuesto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->perfildelprogra->Visible) { // perfildelprogra ?>
		<td data-name="perfildelprogra"<?php echo $cs_programa->perfildelprogra->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_perfildelprogra" class="cs_programa_perfildelprogra">
<span<?php echo $cs_programa->perfildelprogra->ViewAttributes() ?>>
<?php echo $cs_programa->perfildelprogra->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->otro2->Visible) { // otro2 ?>
		<td data-name="otro2"<?php echo $cs_programa->otro2->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_otro2" class="cs_programa_otro2">
<span<?php echo $cs_programa->otro2->ViewAttributes() ?>>
<?php echo $cs_programa->otro2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion"<?php echo $cs_programa->fechacreacion->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_fechacreacion" class="cs_programa_fechacreacion">
<span<?php echo $cs_programa->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_programa->fechacreacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_programa->estado->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_estado" class="cs_programa_estado">
<span<?php echo $cs_programa->estado->ViewAttributes() ?>>
<?php echo $cs_programa->estado->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->idProposito->Visible) { // idProposito ?>
		<td data-name="idProposito"<?php echo $cs_programa->idProposito->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_idProposito" class="cs_programa_idProposito">
<span<?php echo $cs_programa->idProposito->ViewAttributes() ?>>
<?php echo $cs_programa->idProposito->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_programa->fecharecibido->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_fecharecibido" class="cs_programa_fecharecibido">
<span<?php echo $cs_programa->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_programa->fecharecibido->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_programa->moneda->Visible) { // moneda ?>
		<td data-name="moneda"<?php echo $cs_programa->moneda->CellAttributes() ?>>
<span id="el<?php echo $cs_programa_list->RowCnt ?>_cs_programa_moneda" class="cs_programa_moneda">
<span<?php echo $cs_programa->moneda->ViewAttributes() ?>>
<?php echo $cs_programa->moneda->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_programa_list->ListOptions->Render("body", "right", $cs_programa_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($cs_programa->CurrentAction <> "gridadd")
		$cs_programa_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($cs_programa->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cs_programa_list->Recordset)
	$cs_programa_list->Recordset->Close();
?>
<?php if ($cs_programa->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($cs_programa->CurrentAction <> "gridadd" && $cs_programa->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cs_programa_list->Pager)) $cs_programa_list->Pager = new cPrevNextPager($cs_programa_list->StartRec, $cs_programa_list->DisplayRecs, $cs_programa_list->TotalRecs) ?>
<?php if ($cs_programa_list->Pager->RecordCount > 0) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cs_programa_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cs_programa_list->PageUrl() ?>start=<?php echo $cs_programa_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cs_programa_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cs_programa_list->PageUrl() ?>start=<?php echo $cs_programa_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cs_programa_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cs_programa_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cs_programa_list->PageUrl() ?>start=<?php echo $cs_programa_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cs_programa_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cs_programa_list->PageUrl() ?>start=<?php echo $cs_programa_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cs_programa_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cs_programa_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cs_programa_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cs_programa_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_programa_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($cs_programa_list->TotalRecs == 0 && $cs_programa->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_programa_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_programa->Export == "") { ?>
<script type="text/javascript">
fcs_programalistsrch.Init();
fcs_programalistsrch.FilterList = <?php echo $cs_programa_list->GetFilterList() ?>;
fcs_programalist.Init();
</script>
<?php } ?>
<?php
$cs_programa_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cs_programa->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cs_programa_list->Page_Terminate();
?>
