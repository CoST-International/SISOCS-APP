<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_calificacioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_proyectoinfo.php" ?>
<?php include_once "cs_adjudicaciongridcls.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_calificacion_list = NULL; // Initialize page object first

class ccs_calificacion_list extends ccs_calificacion {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_calificacion';

	// Page object name
	var $PageObjName = 'cs_calificacion_list';

	// Grid form hidden field names
	var $FormName = 'fcs_calificacionlist';
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

		// Table object (cs_calificacion)
		if (!isset($GLOBALS["cs_calificacion"]) || get_class($GLOBALS["cs_calificacion"]) == "ccs_calificacion") {
			$GLOBALS["cs_calificacion"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_calificacion"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cs_calificacionadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cs_calificaciondelete.php";
		$this->MultiUpdateUrl = "cs_calificacionupdate.php";

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Table object (cs_proyecto)
		if (!isset($GLOBALS['cs_proyecto'])) $GLOBALS['cs_proyecto'] = new ccs_proyecto();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_calificacion', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fcs_calificacionlistsrch";

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
		$this->idCalificacion->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

			// Process auto fill for detail table 'cs_adjudicacion'
			if (@$_POST["grid"] == "fcs_adjudicaciongrid") {
				if (!isset($GLOBALS["cs_adjudicacion_grid"])) $GLOBALS["cs_adjudicacion_grid"] = new ccs_adjudicacion_grid;
				$GLOBALS["cs_adjudicacion_grid"]->Page_Init();
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
		global $EW_EXPORT, $cs_calificacion;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_calificacion);
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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_proyecto") {
			global $cs_proyecto;
			$rsmaster = $cs_proyecto->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cs_proyectolist.php"); // Return to master page
			} else {
				$cs_proyecto->LoadListRowValues($rsmaster);
				$cs_proyecto->RowType = EW_ROWTYPE_MASTER; // Master row
				$cs_proyecto->RenderListRow();
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
			$this->idCalificacion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idCalificacion->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->idCalificacion->AdvancedSearch->ToJSON(), ","); // Field idCalificacion
		$sFilterList = ew_Concat($sFilterList, $this->idProyecto->AdvancedSearch->ToJSON(), ","); // Field idProyecto
		$sFilterList = ew_Concat($sFilterList, $this->numproceso->AdvancedSearch->ToJSON(), ","); // Field numproceso
		$sFilterList = ew_Concat($sFilterList, $this->nomprocesoproyecto->AdvancedSearch->ToJSON(), ","); // Field nomprocesoproyecto
		$sFilterList = ew_Concat($sFilterList, $this->fechactualizacion->AdvancedSearch->ToJSON(), ","); // Field fechactualizacion
		$sFilterList = ew_Concat($sFilterList, $this->idFuncionario->AdvancedSearch->ToJSON(), ","); // Field idFuncionario
		$sFilterList = ew_Concat($sFilterList, $this->estatusproceso->AdvancedSearch->ToJSON(), ","); // Field estatusproceso
		$sFilterList = ew_Concat($sFilterList, $this->proceseval->AdvancedSearch->ToJSON(), ","); // Field proceseval
		$sFilterList = ew_Concat($sFilterList, $this->invitainter->AdvancedSearch->ToJSON(), ","); // Field invitainter
		$sFilterList = ew_Concat($sFilterList, $this->basespreca->AdvancedSearch->ToJSON(), ","); // Field basespreca
		$sFilterList = ew_Concat($sFilterList, $this->resolucion->AdvancedSearch->ToJSON(), ","); // Field resolucion
		$sFilterList = ew_Concat($sFilterList, $this->nombreante->AdvancedSearch->ToJSON(), ","); // Field nombreante
		$sFilterList = ew_Concat($sFilterList, $this->convocainvi->AdvancedSearch->ToJSON(), ","); // Field convocainvi
		$sFilterList = ew_Concat($sFilterList, $this->tdr->AdvancedSearch->ToJSON(), ","); // Field tdr
		$sFilterList = ew_Concat($sFilterList, $this->aclaraciones->AdvancedSearch->ToJSON(), ","); // Field aclaraciones
		$sFilterList = ew_Concat($sFilterList, $this->actarecpcion->AdvancedSearch->ToJSON(), ","); // Field actarecpcion
		$sFilterList = ew_Concat($sFilterList, $this->fechaingreso->AdvancedSearch->ToJSON(), ","); // Field fechaingreso
		$sFilterList = ew_Concat($sFilterList, $this->tipocontrato->AdvancedSearch->ToJSON(), ","); // Field tipocontrato
		$sFilterList = ew_Concat($sFilterList, $this->estado->AdvancedSearch->ToJSON(), ","); // Field estado
		$sFilterList = ew_Concat($sFilterList, $this->otro1->AdvancedSearch->ToJSON(), ","); // Field otro1
		$sFilterList = ew_Concat($sFilterList, $this->otro2->AdvancedSearch->ToJSON(), ","); // Field otro2
		$sFilterList = ew_Concat($sFilterList, $this->identidadadquisicion->AdvancedSearch->ToJSON(), ","); // Field identidadadquisicion
		$sFilterList = ew_Concat($sFilterList, $this->idmetodo->AdvancedSearch->ToJSON(), ","); // Field idmetodo
		$sFilterList = ew_Concat($sFilterList, $this->fecharecibido->AdvancedSearch->ToJSON(), ","); // Field fecharecibido
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

		// Field idCalificacion
		$this->idCalificacion->AdvancedSearch->SearchValue = @$filter["x_idCalificacion"];
		$this->idCalificacion->AdvancedSearch->SearchOperator = @$filter["z_idCalificacion"];
		$this->idCalificacion->AdvancedSearch->SearchCondition = @$filter["v_idCalificacion"];
		$this->idCalificacion->AdvancedSearch->SearchValue2 = @$filter["y_idCalificacion"];
		$this->idCalificacion->AdvancedSearch->SearchOperator2 = @$filter["w_idCalificacion"];
		$this->idCalificacion->AdvancedSearch->Save();

		// Field idProyecto
		$this->idProyecto->AdvancedSearch->SearchValue = @$filter["x_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchOperator = @$filter["z_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchCondition = @$filter["v_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchValue2 = @$filter["y_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchOperator2 = @$filter["w_idProyecto"];
		$this->idProyecto->AdvancedSearch->Save();

		// Field numproceso
		$this->numproceso->AdvancedSearch->SearchValue = @$filter["x_numproceso"];
		$this->numproceso->AdvancedSearch->SearchOperator = @$filter["z_numproceso"];
		$this->numproceso->AdvancedSearch->SearchCondition = @$filter["v_numproceso"];
		$this->numproceso->AdvancedSearch->SearchValue2 = @$filter["y_numproceso"];
		$this->numproceso->AdvancedSearch->SearchOperator2 = @$filter["w_numproceso"];
		$this->numproceso->AdvancedSearch->Save();

		// Field nomprocesoproyecto
		$this->nomprocesoproyecto->AdvancedSearch->SearchValue = @$filter["x_nomprocesoproyecto"];
		$this->nomprocesoproyecto->AdvancedSearch->SearchOperator = @$filter["z_nomprocesoproyecto"];
		$this->nomprocesoproyecto->AdvancedSearch->SearchCondition = @$filter["v_nomprocesoproyecto"];
		$this->nomprocesoproyecto->AdvancedSearch->SearchValue2 = @$filter["y_nomprocesoproyecto"];
		$this->nomprocesoproyecto->AdvancedSearch->SearchOperator2 = @$filter["w_nomprocesoproyecto"];
		$this->nomprocesoproyecto->AdvancedSearch->Save();

		// Field fechactualizacion
		$this->fechactualizacion->AdvancedSearch->SearchValue = @$filter["x_fechactualizacion"];
		$this->fechactualizacion->AdvancedSearch->SearchOperator = @$filter["z_fechactualizacion"];
		$this->fechactualizacion->AdvancedSearch->SearchCondition = @$filter["v_fechactualizacion"];
		$this->fechactualizacion->AdvancedSearch->SearchValue2 = @$filter["y_fechactualizacion"];
		$this->fechactualizacion->AdvancedSearch->SearchOperator2 = @$filter["w_fechactualizacion"];
		$this->fechactualizacion->AdvancedSearch->Save();

		// Field idFuncionario
		$this->idFuncionario->AdvancedSearch->SearchValue = @$filter["x_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchOperator = @$filter["z_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchCondition = @$filter["v_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchValue2 = @$filter["y_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchOperator2 = @$filter["w_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->Save();

		// Field estatusproceso
		$this->estatusproceso->AdvancedSearch->SearchValue = @$filter["x_estatusproceso"];
		$this->estatusproceso->AdvancedSearch->SearchOperator = @$filter["z_estatusproceso"];
		$this->estatusproceso->AdvancedSearch->SearchCondition = @$filter["v_estatusproceso"];
		$this->estatusproceso->AdvancedSearch->SearchValue2 = @$filter["y_estatusproceso"];
		$this->estatusproceso->AdvancedSearch->SearchOperator2 = @$filter["w_estatusproceso"];
		$this->estatusproceso->AdvancedSearch->Save();

		// Field proceseval
		$this->proceseval->AdvancedSearch->SearchValue = @$filter["x_proceseval"];
		$this->proceseval->AdvancedSearch->SearchOperator = @$filter["z_proceseval"];
		$this->proceseval->AdvancedSearch->SearchCondition = @$filter["v_proceseval"];
		$this->proceseval->AdvancedSearch->SearchValue2 = @$filter["y_proceseval"];
		$this->proceseval->AdvancedSearch->SearchOperator2 = @$filter["w_proceseval"];
		$this->proceseval->AdvancedSearch->Save();

		// Field invitainter
		$this->invitainter->AdvancedSearch->SearchValue = @$filter["x_invitainter"];
		$this->invitainter->AdvancedSearch->SearchOperator = @$filter["z_invitainter"];
		$this->invitainter->AdvancedSearch->SearchCondition = @$filter["v_invitainter"];
		$this->invitainter->AdvancedSearch->SearchValue2 = @$filter["y_invitainter"];
		$this->invitainter->AdvancedSearch->SearchOperator2 = @$filter["w_invitainter"];
		$this->invitainter->AdvancedSearch->Save();

		// Field basespreca
		$this->basespreca->AdvancedSearch->SearchValue = @$filter["x_basespreca"];
		$this->basespreca->AdvancedSearch->SearchOperator = @$filter["z_basespreca"];
		$this->basespreca->AdvancedSearch->SearchCondition = @$filter["v_basespreca"];
		$this->basespreca->AdvancedSearch->SearchValue2 = @$filter["y_basespreca"];
		$this->basespreca->AdvancedSearch->SearchOperator2 = @$filter["w_basespreca"];
		$this->basespreca->AdvancedSearch->Save();

		// Field resolucion
		$this->resolucion->AdvancedSearch->SearchValue = @$filter["x_resolucion"];
		$this->resolucion->AdvancedSearch->SearchOperator = @$filter["z_resolucion"];
		$this->resolucion->AdvancedSearch->SearchCondition = @$filter["v_resolucion"];
		$this->resolucion->AdvancedSearch->SearchValue2 = @$filter["y_resolucion"];
		$this->resolucion->AdvancedSearch->SearchOperator2 = @$filter["w_resolucion"];
		$this->resolucion->AdvancedSearch->Save();

		// Field nombreante
		$this->nombreante->AdvancedSearch->SearchValue = @$filter["x_nombreante"];
		$this->nombreante->AdvancedSearch->SearchOperator = @$filter["z_nombreante"];
		$this->nombreante->AdvancedSearch->SearchCondition = @$filter["v_nombreante"];
		$this->nombreante->AdvancedSearch->SearchValue2 = @$filter["y_nombreante"];
		$this->nombreante->AdvancedSearch->SearchOperator2 = @$filter["w_nombreante"];
		$this->nombreante->AdvancedSearch->Save();

		// Field convocainvi
		$this->convocainvi->AdvancedSearch->SearchValue = @$filter["x_convocainvi"];
		$this->convocainvi->AdvancedSearch->SearchOperator = @$filter["z_convocainvi"];
		$this->convocainvi->AdvancedSearch->SearchCondition = @$filter["v_convocainvi"];
		$this->convocainvi->AdvancedSearch->SearchValue2 = @$filter["y_convocainvi"];
		$this->convocainvi->AdvancedSearch->SearchOperator2 = @$filter["w_convocainvi"];
		$this->convocainvi->AdvancedSearch->Save();

		// Field tdr
		$this->tdr->AdvancedSearch->SearchValue = @$filter["x_tdr"];
		$this->tdr->AdvancedSearch->SearchOperator = @$filter["z_tdr"];
		$this->tdr->AdvancedSearch->SearchCondition = @$filter["v_tdr"];
		$this->tdr->AdvancedSearch->SearchValue2 = @$filter["y_tdr"];
		$this->tdr->AdvancedSearch->SearchOperator2 = @$filter["w_tdr"];
		$this->tdr->AdvancedSearch->Save();

		// Field aclaraciones
		$this->aclaraciones->AdvancedSearch->SearchValue = @$filter["x_aclaraciones"];
		$this->aclaraciones->AdvancedSearch->SearchOperator = @$filter["z_aclaraciones"];
		$this->aclaraciones->AdvancedSearch->SearchCondition = @$filter["v_aclaraciones"];
		$this->aclaraciones->AdvancedSearch->SearchValue2 = @$filter["y_aclaraciones"];
		$this->aclaraciones->AdvancedSearch->SearchOperator2 = @$filter["w_aclaraciones"];
		$this->aclaraciones->AdvancedSearch->Save();

		// Field actarecpcion
		$this->actarecpcion->AdvancedSearch->SearchValue = @$filter["x_actarecpcion"];
		$this->actarecpcion->AdvancedSearch->SearchOperator = @$filter["z_actarecpcion"];
		$this->actarecpcion->AdvancedSearch->SearchCondition = @$filter["v_actarecpcion"];
		$this->actarecpcion->AdvancedSearch->SearchValue2 = @$filter["y_actarecpcion"];
		$this->actarecpcion->AdvancedSearch->SearchOperator2 = @$filter["w_actarecpcion"];
		$this->actarecpcion->AdvancedSearch->Save();

		// Field fechaingreso
		$this->fechaingreso->AdvancedSearch->SearchValue = @$filter["x_fechaingreso"];
		$this->fechaingreso->AdvancedSearch->SearchOperator = @$filter["z_fechaingreso"];
		$this->fechaingreso->AdvancedSearch->SearchCondition = @$filter["v_fechaingreso"];
		$this->fechaingreso->AdvancedSearch->SearchValue2 = @$filter["y_fechaingreso"];
		$this->fechaingreso->AdvancedSearch->SearchOperator2 = @$filter["w_fechaingreso"];
		$this->fechaingreso->AdvancedSearch->Save();

		// Field tipocontrato
		$this->tipocontrato->AdvancedSearch->SearchValue = @$filter["x_tipocontrato"];
		$this->tipocontrato->AdvancedSearch->SearchOperator = @$filter["z_tipocontrato"];
		$this->tipocontrato->AdvancedSearch->SearchCondition = @$filter["v_tipocontrato"];
		$this->tipocontrato->AdvancedSearch->SearchValue2 = @$filter["y_tipocontrato"];
		$this->tipocontrato->AdvancedSearch->SearchOperator2 = @$filter["w_tipocontrato"];
		$this->tipocontrato->AdvancedSearch->Save();

		// Field estado
		$this->estado->AdvancedSearch->SearchValue = @$filter["x_estado"];
		$this->estado->AdvancedSearch->SearchOperator = @$filter["z_estado"];
		$this->estado->AdvancedSearch->SearchCondition = @$filter["v_estado"];
		$this->estado->AdvancedSearch->SearchValue2 = @$filter["y_estado"];
		$this->estado->AdvancedSearch->SearchOperator2 = @$filter["w_estado"];
		$this->estado->AdvancedSearch->Save();

		// Field otro1
		$this->otro1->AdvancedSearch->SearchValue = @$filter["x_otro1"];
		$this->otro1->AdvancedSearch->SearchOperator = @$filter["z_otro1"];
		$this->otro1->AdvancedSearch->SearchCondition = @$filter["v_otro1"];
		$this->otro1->AdvancedSearch->SearchValue2 = @$filter["y_otro1"];
		$this->otro1->AdvancedSearch->SearchOperator2 = @$filter["w_otro1"];
		$this->otro1->AdvancedSearch->Save();

		// Field otro2
		$this->otro2->AdvancedSearch->SearchValue = @$filter["x_otro2"];
		$this->otro2->AdvancedSearch->SearchOperator = @$filter["z_otro2"];
		$this->otro2->AdvancedSearch->SearchCondition = @$filter["v_otro2"];
		$this->otro2->AdvancedSearch->SearchValue2 = @$filter["y_otro2"];
		$this->otro2->AdvancedSearch->SearchOperator2 = @$filter["w_otro2"];
		$this->otro2->AdvancedSearch->Save();

		// Field identidadadquisicion
		$this->identidadadquisicion->AdvancedSearch->SearchValue = @$filter["x_identidadadquisicion"];
		$this->identidadadquisicion->AdvancedSearch->SearchOperator = @$filter["z_identidadadquisicion"];
		$this->identidadadquisicion->AdvancedSearch->SearchCondition = @$filter["v_identidadadquisicion"];
		$this->identidadadquisicion->AdvancedSearch->SearchValue2 = @$filter["y_identidadadquisicion"];
		$this->identidadadquisicion->AdvancedSearch->SearchOperator2 = @$filter["w_identidadadquisicion"];
		$this->identidadadquisicion->AdvancedSearch->Save();

		// Field idmetodo
		$this->idmetodo->AdvancedSearch->SearchValue = @$filter["x_idmetodo"];
		$this->idmetodo->AdvancedSearch->SearchOperator = @$filter["z_idmetodo"];
		$this->idmetodo->AdvancedSearch->SearchCondition = @$filter["v_idmetodo"];
		$this->idmetodo->AdvancedSearch->SearchValue2 = @$filter["y_idmetodo"];
		$this->idmetodo->AdvancedSearch->SearchOperator2 = @$filter["w_idmetodo"];
		$this->idmetodo->AdvancedSearch->Save();

		// Field fecharecibido
		$this->fecharecibido->AdvancedSearch->SearchValue = @$filter["x_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchOperator = @$filter["z_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchCondition = @$filter["v_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchValue2 = @$filter["y_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchOperator2 = @$filter["w_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter["psearch"]);
		$this->BasicSearch->setType(@$filter["psearchtype"]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->numproceso, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->nomprocesoproyecto, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechactualizacion, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estatusproceso, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->proceseval, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->invitainter, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->basespreca, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->resolucion, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->nombreante, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->convocainvi, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->tdr, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->aclaraciones, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->actarecpcion, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechaingreso, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->tipocontrato, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estado, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->otro1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->otro2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fecharecibido, $arKeywords, $type);
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
			$this->UpdateSort($this->idCalificacion); // idCalificacion
			$this->UpdateSort($this->idProyecto); // idProyecto
			$this->UpdateSort($this->numproceso); // numproceso
			$this->UpdateSort($this->fechactualizacion); // fechactualizacion
			$this->UpdateSort($this->idFuncionario); // idFuncionario
			$this->UpdateSort($this->estatusproceso); // estatusproceso
			$this->UpdateSort($this->proceseval); // proceseval
			$this->UpdateSort($this->invitainter); // invitainter
			$this->UpdateSort($this->basespreca); // basespreca
			$this->UpdateSort($this->resolucion); // resolucion
			$this->UpdateSort($this->nombreante); // nombreante
			$this->UpdateSort($this->convocainvi); // convocainvi
			$this->UpdateSort($this->tdr); // tdr
			$this->UpdateSort($this->aclaraciones); // aclaraciones
			$this->UpdateSort($this->actarecpcion); // actarecpcion
			$this->UpdateSort($this->fechaingreso); // fechaingreso
			$this->UpdateSort($this->tipocontrato); // tipocontrato
			$this->UpdateSort($this->estado); // estado
			$this->UpdateSort($this->otro1); // otro1
			$this->UpdateSort($this->otro2); // otro2
			$this->UpdateSort($this->identidadadquisicion); // identidadadquisicion
			$this->UpdateSort($this->idmetodo); // idmetodo
			$this->UpdateSort($this->fecharecibido); // fecharecibido
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
				$this->idProyecto->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->idCalificacion->setSort("");
				$this->idProyecto->setSort("");
				$this->numproceso->setSort("");
				$this->fechactualizacion->setSort("");
				$this->idFuncionario->setSort("");
				$this->estatusproceso->setSort("");
				$this->proceseval->setSort("");
				$this->invitainter->setSort("");
				$this->basespreca->setSort("");
				$this->resolucion->setSort("");
				$this->nombreante->setSort("");
				$this->convocainvi->setSort("");
				$this->tdr->setSort("");
				$this->aclaraciones->setSort("");
				$this->actarecpcion->setSort("");
				$this->fechaingreso->setSort("");
				$this->tipocontrato->setSort("");
				$this->estado->setSort("");
				$this->otro1->setSort("");
				$this->otro2->setSort("");
				$this->identidadadquisicion->setSort("");
				$this->idmetodo->setSort("");
				$this->fecharecibido->setSort("");
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

		// "detail_cs_adjudicacion"
		$item = &$this->ListOptions->Add("detail_cs_adjudicacion");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_adjudicacion') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cs_adjudicacion_grid"])) $GLOBALS["cs_adjudicacion_grid"] = new ccs_adjudicacion_grid;

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
		$pages->Add("cs_adjudicacion");
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

		// "detail_cs_adjudicacion"
		$oListOpt = &$this->ListOptions->Items["detail_cs_adjudicacion"];
		if ($Security->AllowList(CurrentProjectID() . 'cs_adjudicacion')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("cs_adjudicacion", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_adjudicacionlist.php?" . EW_TABLE_SHOW_MASTER . "=cs_calificacion&fk_idCalificacion=" . urlencode(strval($this->idCalificacion->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cs_adjudicacion_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_adjudicacion')) {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_adjudicacion")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "cs_adjudicacion";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->idCalificacion->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fcs_calificacionlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fcs_calificacionlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fcs_calificacionlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fcs_calificacionlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
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
		$this->idCalificacion->setDbValue($rs->fields('idCalificacion'));
		$this->idProyecto->setDbValue($rs->fields('idProyecto'));
		$this->numproceso->setDbValue($rs->fields('numproceso'));
		$this->nomprocesoproyecto->setDbValue($rs->fields('nomprocesoproyecto'));
		$this->fechactualizacion->setDbValue($rs->fields('fechactualizacion'));
		$this->idFuncionario->setDbValue($rs->fields('idFuncionario'));
		$this->estatusproceso->setDbValue($rs->fields('estatusproceso'));
		$this->proceseval->setDbValue($rs->fields('proceseval'));
		$this->invitainter->setDbValue($rs->fields('invitainter'));
		$this->basespreca->setDbValue($rs->fields('basespreca'));
		$this->resolucion->setDbValue($rs->fields('resolucion'));
		$this->nombreante->setDbValue($rs->fields('nombreante'));
		$this->convocainvi->setDbValue($rs->fields('convocainvi'));
		$this->tdr->setDbValue($rs->fields('tdr'));
		$this->aclaraciones->setDbValue($rs->fields('aclaraciones'));
		$this->actarecpcion->setDbValue($rs->fields('actarecpcion'));
		$this->fechaingreso->setDbValue($rs->fields('fechaingreso'));
		$this->tipocontrato->setDbValue($rs->fields('tipocontrato'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro1->setDbValue($rs->fields('otro1'));
		$this->otro2->setDbValue($rs->fields('otro2'));
		$this->identidadadquisicion->setDbValue($rs->fields('identidadadquisicion'));
		$this->idmetodo->setDbValue($rs->fields('idmetodo'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idCalificacion->DbValue = $row['idCalificacion'];
		$this->idProyecto->DbValue = $row['idProyecto'];
		$this->numproceso->DbValue = $row['numproceso'];
		$this->nomprocesoproyecto->DbValue = $row['nomprocesoproyecto'];
		$this->fechactualizacion->DbValue = $row['fechactualizacion'];
		$this->idFuncionario->DbValue = $row['idFuncionario'];
		$this->estatusproceso->DbValue = $row['estatusproceso'];
		$this->proceseval->DbValue = $row['proceseval'];
		$this->invitainter->DbValue = $row['invitainter'];
		$this->basespreca->DbValue = $row['basespreca'];
		$this->resolucion->DbValue = $row['resolucion'];
		$this->nombreante->DbValue = $row['nombreante'];
		$this->convocainvi->DbValue = $row['convocainvi'];
		$this->tdr->DbValue = $row['tdr'];
		$this->aclaraciones->DbValue = $row['aclaraciones'];
		$this->actarecpcion->DbValue = $row['actarecpcion'];
		$this->fechaingreso->DbValue = $row['fechaingreso'];
		$this->tipocontrato->DbValue = $row['tipocontrato'];
		$this->estado->DbValue = $row['estado'];
		$this->otro1->DbValue = $row['otro1'];
		$this->otro2->DbValue = $row['otro2'];
		$this->identidadadquisicion->DbValue = $row['identidadadquisicion'];
		$this->idmetodo->DbValue = $row['idmetodo'];
		$this->fecharecibido->DbValue = $row['fecharecibido'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("idCalificacion")) <> "")
			$this->idCalificacion->CurrentValue = $this->getKey("idCalificacion"); // idCalificacion
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

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// idCalificacion
		// idProyecto
		// numproceso
		// nomprocesoproyecto
		// fechactualizacion
		// idFuncionario
		// estatusproceso
		// proceseval
		// invitainter
		// basespreca
		// resolucion
		// nombreante
		// convocainvi
		// tdr
		// aclaraciones
		// actarecpcion
		// fechaingreso
		// tipocontrato
		// estado
		// otro1
		// otro2
		// identidadadquisicion
		// idmetodo
		// fecharecibido

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// idCalificacion
		$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";

		// idProyecto
		$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";

		// numproceso
		$this->numproceso->ViewValue = $this->numproceso->CurrentValue;
		$this->numproceso->ViewCustomAttributes = "";

		// fechactualizacion
		$this->fechactualizacion->ViewValue = $this->fechactualizacion->CurrentValue;
		$this->fechactualizacion->ViewCustomAttributes = "";

		// idFuncionario
		$this->idFuncionario->ViewValue = $this->idFuncionario->CurrentValue;
		$this->idFuncionario->ViewCustomAttributes = "";

		// estatusproceso
		$this->estatusproceso->ViewValue = $this->estatusproceso->CurrentValue;
		$this->estatusproceso->ViewCustomAttributes = "";

		// proceseval
		$this->proceseval->ViewValue = $this->proceseval->CurrentValue;
		$this->proceseval->ViewCustomAttributes = "";

		// invitainter
		$this->invitainter->ViewValue = $this->invitainter->CurrentValue;
		$this->invitainter->ViewCustomAttributes = "";

		// basespreca
		$this->basespreca->ViewValue = $this->basespreca->CurrentValue;
		$this->basespreca->ViewCustomAttributes = "";

		// resolucion
		$this->resolucion->ViewValue = $this->resolucion->CurrentValue;
		$this->resolucion->ViewCustomAttributes = "";

		// nombreante
		$this->nombreante->ViewValue = $this->nombreante->CurrentValue;
		$this->nombreante->ViewCustomAttributes = "";

		// convocainvi
		$this->convocainvi->ViewValue = $this->convocainvi->CurrentValue;
		$this->convocainvi->ViewCustomAttributes = "";

		// tdr
		$this->tdr->ViewValue = $this->tdr->CurrentValue;
		$this->tdr->ViewCustomAttributes = "";

		// aclaraciones
		$this->aclaraciones->ViewValue = $this->aclaraciones->CurrentValue;
		$this->aclaraciones->ViewCustomAttributes = "";

		// actarecpcion
		$this->actarecpcion->ViewValue = $this->actarecpcion->CurrentValue;
		$this->actarecpcion->ViewCustomAttributes = "";

		// fechaingreso
		$this->fechaingreso->ViewValue = $this->fechaingreso->CurrentValue;
		$this->fechaingreso->ViewCustomAttributes = "";

		// tipocontrato
		$this->tipocontrato->ViewValue = $this->tipocontrato->CurrentValue;
		$this->tipocontrato->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro1
		$this->otro1->ViewValue = $this->otro1->CurrentValue;
		$this->otro1->ViewCustomAttributes = "";

		// otro2
		$this->otro2->ViewValue = $this->otro2->CurrentValue;
		$this->otro2->ViewCustomAttributes = "";

		// identidadadquisicion
		$this->identidadadquisicion->ViewValue = $this->identidadadquisicion->CurrentValue;
		$this->identidadadquisicion->ViewCustomAttributes = "";

		// idmetodo
		$this->idmetodo->ViewValue = $this->idmetodo->CurrentValue;
		$this->idmetodo->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

			// idCalificacion
			$this->idCalificacion->LinkCustomAttributes = "";
			$this->idCalificacion->HrefValue = "";
			$this->idCalificacion->TooltipValue = "";

			// idProyecto
			$this->idProyecto->LinkCustomAttributes = "";
			$this->idProyecto->HrefValue = "";
			$this->idProyecto->TooltipValue = "";

			// numproceso
			$this->numproceso->LinkCustomAttributes = "";
			$this->numproceso->HrefValue = "";
			$this->numproceso->TooltipValue = "";

			// fechactualizacion
			$this->fechactualizacion->LinkCustomAttributes = "";
			$this->fechactualizacion->HrefValue = "";
			$this->fechactualizacion->TooltipValue = "";

			// idFuncionario
			$this->idFuncionario->LinkCustomAttributes = "";
			$this->idFuncionario->HrefValue = "";
			$this->idFuncionario->TooltipValue = "";

			// estatusproceso
			$this->estatusproceso->LinkCustomAttributes = "";
			$this->estatusproceso->HrefValue = "";
			$this->estatusproceso->TooltipValue = "";

			// proceseval
			$this->proceseval->LinkCustomAttributes = "";
			$this->proceseval->HrefValue = "";
			$this->proceseval->TooltipValue = "";

			// invitainter
			$this->invitainter->LinkCustomAttributes = "";
			$this->invitainter->HrefValue = "";
			$this->invitainter->TooltipValue = "";

			// basespreca
			$this->basespreca->LinkCustomAttributes = "";
			$this->basespreca->HrefValue = "";
			$this->basespreca->TooltipValue = "";

			// resolucion
			$this->resolucion->LinkCustomAttributes = "";
			$this->resolucion->HrefValue = "";
			$this->resolucion->TooltipValue = "";

			// nombreante
			$this->nombreante->LinkCustomAttributes = "";
			$this->nombreante->HrefValue = "";
			$this->nombreante->TooltipValue = "";

			// convocainvi
			$this->convocainvi->LinkCustomAttributes = "";
			$this->convocainvi->HrefValue = "";
			$this->convocainvi->TooltipValue = "";

			// tdr
			$this->tdr->LinkCustomAttributes = "";
			$this->tdr->HrefValue = "";
			$this->tdr->TooltipValue = "";

			// aclaraciones
			$this->aclaraciones->LinkCustomAttributes = "";
			$this->aclaraciones->HrefValue = "";
			$this->aclaraciones->TooltipValue = "";

			// actarecpcion
			$this->actarecpcion->LinkCustomAttributes = "";
			$this->actarecpcion->HrefValue = "";
			$this->actarecpcion->TooltipValue = "";

			// fechaingreso
			$this->fechaingreso->LinkCustomAttributes = "";
			$this->fechaingreso->HrefValue = "";
			$this->fechaingreso->TooltipValue = "";

			// tipocontrato
			$this->tipocontrato->LinkCustomAttributes = "";
			$this->tipocontrato->HrefValue = "";
			$this->tipocontrato->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// otro1
			$this->otro1->LinkCustomAttributes = "";
			$this->otro1->HrefValue = "";
			$this->otro1->TooltipValue = "";

			// otro2
			$this->otro2->LinkCustomAttributes = "";
			$this->otro2->HrefValue = "";
			$this->otro2->TooltipValue = "";

			// identidadadquisicion
			$this->identidadadquisicion->LinkCustomAttributes = "";
			$this->identidadadquisicion->HrefValue = "";
			$this->identidadadquisicion->TooltipValue = "";

			// idmetodo
			$this->idmetodo->LinkCustomAttributes = "";
			$this->idmetodo->HrefValue = "";
			$this->idmetodo->TooltipValue = "";

			// fecharecibido
			$this->fecharecibido->LinkCustomAttributes = "";
			$this->fecharecibido->HrefValue = "";
			$this->fecharecibido->TooltipValue = "";
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
		$item->Body = "<button id=\"emf_cs_calificacion\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_cs_calificacion',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fcs_calificacionlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_proyecto") {
			global $cs_proyecto;
			if (!isset($cs_proyecto)) $cs_proyecto = new ccs_proyecto;
			$rsmaster = $cs_proyecto->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$cs_proyecto;
					$cs_proyecto->ExportDocument($Doc, $rsmaster, 1, 1);
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
			if ($sMasterTblVar == "cs_proyecto") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_idProyecto"] <> "") {
					$GLOBALS["cs_proyecto"]->idProyecto->setQueryStringValue($_GET["fk_idProyecto"]);
					$this->idProyecto->setQueryStringValue($GLOBALS["cs_proyecto"]->idProyecto->QueryStringValue);
					$this->idProyecto->setSessionValue($this->idProyecto->QueryStringValue);
					if (!is_numeric($GLOBALS["cs_proyecto"]->idProyecto->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cs_proyecto") {
				if ($this->idProyecto->QueryStringValue == "") $this->idProyecto->setSessionValue("");
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
if (!isset($cs_calificacion_list)) $cs_calificacion_list = new ccs_calificacion_list();

// Page init
$cs_calificacion_list->Page_Init();

// Page main
$cs_calificacion_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_calificacion_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($cs_calificacion->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fcs_calificacionlist = new ew_Form("fcs_calificacionlist", "list");
fcs_calificacionlist.FormKeyCountName = '<?php echo $cs_calificacion_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcs_calificacionlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_calificacionlist.ValidateRequired = true;
<?php } else { ?>
fcs_calificacionlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

var CurrentSearchForm = fcs_calificacionlistsrch = new ew_Form("fcs_calificacionlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($cs_calificacion->Export == "") { ?>
<div class="ewToolbar">
<?php if ($cs_calificacion->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($cs_calificacion_list->TotalRecs > 0 && $cs_calificacion_list->ExportOptions->Visible()) { ?>
<?php $cs_calificacion_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_calificacion_list->SearchOptions->Visible()) { ?>
<?php $cs_calificacion_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_calificacion_list->FilterOptions->Visible()) { ?>
<?php $cs_calificacion_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_calificacion->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($cs_calificacion->Export == "") || (EW_EXPORT_MASTER_RECORD && $cs_calificacion->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "cs_proyectolist.php";
if ($cs_calificacion_list->DbMasterFilter <> "" && $cs_calificacion->getCurrentMasterTable() == "cs_proyecto") {
	if ($cs_calificacion_list->MasterRecordExists) {
		if ($cs_calificacion->getCurrentMasterTable() == $cs_calificacion->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include_once "cs_proyectomaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $cs_calificacion_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_calificacion_list->TotalRecs <= 0)
			$cs_calificacion_list->TotalRecs = $cs_calificacion->SelectRecordCount();
	} else {
		if (!$cs_calificacion_list->Recordset && ($cs_calificacion_list->Recordset = $cs_calificacion_list->LoadRecordset()))
			$cs_calificacion_list->TotalRecs = $cs_calificacion_list->Recordset->RecordCount();
	}
	$cs_calificacion_list->StartRec = 1;
	if ($cs_calificacion_list->DisplayRecs <= 0 || ($cs_calificacion->Export <> "" && $cs_calificacion->ExportAll)) // Display all records
		$cs_calificacion_list->DisplayRecs = $cs_calificacion_list->TotalRecs;
	if (!($cs_calificacion->Export <> "" && $cs_calificacion->ExportAll))
		$cs_calificacion_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cs_calificacion_list->Recordset = $cs_calificacion_list->LoadRecordset($cs_calificacion_list->StartRec-1, $cs_calificacion_list->DisplayRecs);

	// Set no record found message
	if ($cs_calificacion->CurrentAction == "" && $cs_calificacion_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_calificacion_list->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_calificacion_list->SearchWhere == "0=101")
			$cs_calificacion_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_calificacion_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$cs_calificacion_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($cs_calificacion->Export == "" && $cs_calificacion->CurrentAction == "") { ?>
<form name="fcs_calificacionlistsrch" id="fcs_calificacionlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($cs_calificacion_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fcs_calificacionlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cs_calificacion">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($cs_calificacion_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($cs_calificacion_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $cs_calificacion_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($cs_calificacion_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($cs_calificacion_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($cs_calificacion_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($cs_calificacion_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $cs_calificacion_list->ShowPageHeader(); ?>
<?php
$cs_calificacion_list->ShowMessage();
?>
<?php if ($cs_calificacion_list->TotalRecs > 0 || $cs_calificacion->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<form name="fcs_calificacionlist" id="fcs_calificacionlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_calificacion_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_calificacion_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_calificacion">
<div id="gmp_cs_calificacion" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($cs_calificacion_list->TotalRecs > 0) { ?>
<table id="tbl_cs_calificacionlist" class="table ewTable">
<?php echo $cs_calificacion->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_calificacion_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_calificacion_list->RenderListOptions();

// Render list options (header, left)
$cs_calificacion_list->ListOptions->Render("header", "left");
?>
<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idCalificacion) == "") { ?>
		<th data-name="idCalificacion"><div id="elh_cs_calificacion_idCalificacion" class="cs_calificacion_idCalificacion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idCalificacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idCalificacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->idCalificacion) ?>',1);"><div id="elh_cs_calificacion_idCalificacion" class="cs_calificacion_idCalificacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idCalificacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idCalificacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idCalificacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idProyecto) == "") { ?>
		<th data-name="idProyecto"><div id="elh_cs_calificacion_idProyecto" class="cs_calificacion_idProyecto"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idProyecto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProyecto"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->idProyecto) ?>',1);"><div id="elh_cs_calificacion_idProyecto" class="cs_calificacion_idProyecto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idProyecto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idProyecto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idProyecto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->numproceso) == "") { ?>
		<th data-name="numproceso"><div id="elh_cs_calificacion_numproceso" class="cs_calificacion_numproceso"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->numproceso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numproceso"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->numproceso) ?>',1);"><div id="elh_cs_calificacion_numproceso" class="cs_calificacion_numproceso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->numproceso->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->numproceso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->numproceso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->fechactualizacion) == "") { ?>
		<th data-name="fechactualizacion"><div id="elh_cs_calificacion_fechactualizacion" class="cs_calificacion_fechactualizacion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechactualizacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechactualizacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->fechactualizacion) ?>',1);"><div id="elh_cs_calificacion_fechactualizacion" class="cs_calificacion_fechactualizacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechactualizacion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->fechactualizacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->fechactualizacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idFuncionario) == "") { ?>
		<th data-name="idFuncionario"><div id="elh_cs_calificacion_idFuncionario" class="cs_calificacion_idFuncionario"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idFuncionario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idFuncionario"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->idFuncionario) ?>',1);"><div id="elh_cs_calificacion_idFuncionario" class="cs_calificacion_idFuncionario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idFuncionario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idFuncionario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idFuncionario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->estatusproceso) == "") { ?>
		<th data-name="estatusproceso"><div id="elh_cs_calificacion_estatusproceso" class="cs_calificacion_estatusproceso"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->estatusproceso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estatusproceso"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->estatusproceso) ?>',1);"><div id="elh_cs_calificacion_estatusproceso" class="cs_calificacion_estatusproceso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->estatusproceso->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->estatusproceso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->estatusproceso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->proceseval) == "") { ?>
		<th data-name="proceseval"><div id="elh_cs_calificacion_proceseval" class="cs_calificacion_proceseval"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->proceseval->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="proceseval"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->proceseval) ?>',1);"><div id="elh_cs_calificacion_proceseval" class="cs_calificacion_proceseval">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->proceseval->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->proceseval->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->proceseval->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->invitainter) == "") { ?>
		<th data-name="invitainter"><div id="elh_cs_calificacion_invitainter" class="cs_calificacion_invitainter"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->invitainter->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="invitainter"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->invitainter) ?>',1);"><div id="elh_cs_calificacion_invitainter" class="cs_calificacion_invitainter">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->invitainter->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->invitainter->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->invitainter->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->basespreca) == "") { ?>
		<th data-name="basespreca"><div id="elh_cs_calificacion_basespreca" class="cs_calificacion_basespreca"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->basespreca->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="basespreca"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->basespreca) ?>',1);"><div id="elh_cs_calificacion_basespreca" class="cs_calificacion_basespreca">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->basespreca->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->basespreca->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->basespreca->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->resolucion) == "") { ?>
		<th data-name="resolucion"><div id="elh_cs_calificacion_resolucion" class="cs_calificacion_resolucion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->resolucion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="resolucion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->resolucion) ?>',1);"><div id="elh_cs_calificacion_resolucion" class="cs_calificacion_resolucion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->resolucion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->resolucion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->resolucion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->nombreante) == "") { ?>
		<th data-name="nombreante"><div id="elh_cs_calificacion_nombreante" class="cs_calificacion_nombreante"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->nombreante->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombreante"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->nombreante) ?>',1);"><div id="elh_cs_calificacion_nombreante" class="cs_calificacion_nombreante">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->nombreante->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->nombreante->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->nombreante->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->convocainvi) == "") { ?>
		<th data-name="convocainvi"><div id="elh_cs_calificacion_convocainvi" class="cs_calificacion_convocainvi"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->convocainvi->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="convocainvi"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->convocainvi) ?>',1);"><div id="elh_cs_calificacion_convocainvi" class="cs_calificacion_convocainvi">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->convocainvi->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->convocainvi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->convocainvi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->tdr) == "") { ?>
		<th data-name="tdr"><div id="elh_cs_calificacion_tdr" class="cs_calificacion_tdr"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->tdr->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tdr"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->tdr) ?>',1);"><div id="elh_cs_calificacion_tdr" class="cs_calificacion_tdr">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->tdr->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->tdr->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->tdr->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->aclaraciones) == "") { ?>
		<th data-name="aclaraciones"><div id="elh_cs_calificacion_aclaraciones" class="cs_calificacion_aclaraciones"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->aclaraciones->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aclaraciones"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->aclaraciones) ?>',1);"><div id="elh_cs_calificacion_aclaraciones" class="cs_calificacion_aclaraciones">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->aclaraciones->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->aclaraciones->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->aclaraciones->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->actarecpcion) == "") { ?>
		<th data-name="actarecpcion"><div id="elh_cs_calificacion_actarecpcion" class="cs_calificacion_actarecpcion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->actarecpcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="actarecpcion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->actarecpcion) ?>',1);"><div id="elh_cs_calificacion_actarecpcion" class="cs_calificacion_actarecpcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->actarecpcion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->actarecpcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->actarecpcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->fechaingreso) == "") { ?>
		<th data-name="fechaingreso"><div id="elh_cs_calificacion_fechaingreso" class="cs_calificacion_fechaingreso"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechaingreso->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaingreso"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->fechaingreso) ?>',1);"><div id="elh_cs_calificacion_fechaingreso" class="cs_calificacion_fechaingreso">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->fechaingreso->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->fechaingreso->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->fechaingreso->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->tipocontrato) == "") { ?>
		<th data-name="tipocontrato"><div id="elh_cs_calificacion_tipocontrato" class="cs_calificacion_tipocontrato"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->tipocontrato->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipocontrato"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->tipocontrato) ?>',1);"><div id="elh_cs_calificacion_tipocontrato" class="cs_calificacion_tipocontrato">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->tipocontrato->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->tipocontrato->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->tipocontrato->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->estado->Visible) { // estado ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_calificacion_estado" class="cs_calificacion_estado"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->estado) ?>',1);"><div id="elh_cs_calificacion_estado" class="cs_calificacion_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->estado->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->otro1) == "") { ?>
		<th data-name="otro1"><div id="elh_cs_calificacion_otro1" class="cs_calificacion_otro1"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->otro1) ?>',1);"><div id="elh_cs_calificacion_otro1" class="cs_calificacion_otro1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->otro1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->otro1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->otro2) == "") { ?>
		<th data-name="otro2"><div id="elh_cs_calificacion_otro2" class="cs_calificacion_otro2"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->otro2) ?>',1);"><div id="elh_cs_calificacion_otro2" class="cs_calificacion_otro2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->otro2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->otro2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->otro2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->identidadadquisicion) == "") { ?>
		<th data-name="identidadadquisicion"><div id="elh_cs_calificacion_identidadadquisicion" class="cs_calificacion_identidadadquisicion"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->identidadadquisicion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="identidadadquisicion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->identidadadquisicion) ?>',1);"><div id="elh_cs_calificacion_identidadadquisicion" class="cs_calificacion_identidadadquisicion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->identidadadquisicion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->identidadadquisicion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->identidadadquisicion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->idmetodo) == "") { ?>
		<th data-name="idmetodo"><div id="elh_cs_calificacion_idmetodo" class="cs_calificacion_idmetodo"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->idmetodo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idmetodo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->idmetodo) ?>',1);"><div id="elh_cs_calificacion_idmetodo" class="cs_calificacion_idmetodo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->idmetodo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->idmetodo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->idmetodo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_calificacion->SortUrl($cs_calificacion->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_calificacion_fecharecibido" class="cs_calificacion_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_calificacion->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_calificacion->SortUrl($cs_calificacion->fecharecibido) ?>',1);"><div id="elh_cs_calificacion_fecharecibido" class="cs_calificacion_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_calificacion->fecharecibido->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_calificacion->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_calificacion->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_calificacion_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cs_calificacion->ExportAll && $cs_calificacion->Export <> "") {
	$cs_calificacion_list->StopRec = $cs_calificacion_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cs_calificacion_list->TotalRecs > $cs_calificacion_list->StartRec + $cs_calificacion_list->DisplayRecs - 1)
		$cs_calificacion_list->StopRec = $cs_calificacion_list->StartRec + $cs_calificacion_list->DisplayRecs - 1;
	else
		$cs_calificacion_list->StopRec = $cs_calificacion_list->TotalRecs;
}
$cs_calificacion_list->RecCnt = $cs_calificacion_list->StartRec - 1;
if ($cs_calificacion_list->Recordset && !$cs_calificacion_list->Recordset->EOF) {
	$cs_calificacion_list->Recordset->MoveFirst();
	$bSelectLimit = $cs_calificacion_list->UseSelectLimit;
	if (!$bSelectLimit && $cs_calificacion_list->StartRec > 1)
		$cs_calificacion_list->Recordset->Move($cs_calificacion_list->StartRec - 1);
} elseif (!$cs_calificacion->AllowAddDeleteRow && $cs_calificacion_list->StopRec == 0) {
	$cs_calificacion_list->StopRec = $cs_calificacion->GridAddRowCount;
}

// Initialize aggregate
$cs_calificacion->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_calificacion->ResetAttrs();
$cs_calificacion_list->RenderRow();
while ($cs_calificacion_list->RecCnt < $cs_calificacion_list->StopRec) {
	$cs_calificacion_list->RecCnt++;
	if (intval($cs_calificacion_list->RecCnt) >= intval($cs_calificacion_list->StartRec)) {
		$cs_calificacion_list->RowCnt++;

		// Set up key count
		$cs_calificacion_list->KeyCount = $cs_calificacion_list->RowIndex;

		// Init row class and style
		$cs_calificacion->ResetAttrs();
		$cs_calificacion->CssClass = "";
		if ($cs_calificacion->CurrentAction == "gridadd") {
		} else {
			$cs_calificacion_list->LoadRowValues($cs_calificacion_list->Recordset); // Load row values
		}
		$cs_calificacion->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cs_calificacion->RowAttrs = array_merge($cs_calificacion->RowAttrs, array('data-rowindex'=>$cs_calificacion_list->RowCnt, 'id'=>'r' . $cs_calificacion_list->RowCnt . '_cs_calificacion', 'data-rowtype'=>$cs_calificacion->RowType));

		// Render row
		$cs_calificacion_list->RenderRow();

		// Render list options
		$cs_calificacion_list->RenderListOptions();
?>
	<tr<?php echo $cs_calificacion->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_calificacion_list->ListOptions->Render("body", "left", $cs_calificacion_list->RowCnt);
?>
	<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
		<td data-name="idCalificacion"<?php echo $cs_calificacion->idCalificacion->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_idCalificacion" class="cs_calificacion_idCalificacion">
<span<?php echo $cs_calificacion->idCalificacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->idCalificacion->ListViewValue() ?></span>
</span>
<a id="<?php echo $cs_calificacion_list->PageObjName . "_row_" . $cs_calificacion_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
		<td data-name="idProyecto"<?php echo $cs_calificacion->idProyecto->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_idProyecto" class="cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<?php echo $cs_calificacion->idProyecto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
		<td data-name="numproceso"<?php echo $cs_calificacion->numproceso->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_numproceso" class="cs_calificacion_numproceso">
<span<?php echo $cs_calificacion->numproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->numproceso->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
		<td data-name="fechactualizacion"<?php echo $cs_calificacion->fechactualizacion->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_fechactualizacion" class="cs_calificacion_fechactualizacion">
<span<?php echo $cs_calificacion->fechactualizacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechactualizacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario"<?php echo $cs_calificacion->idFuncionario->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_idFuncionario" class="cs_calificacion_idFuncionario">
<span<?php echo $cs_calificacion->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_calificacion->idFuncionario->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
		<td data-name="estatusproceso"<?php echo $cs_calificacion->estatusproceso->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_estatusproceso" class="cs_calificacion_estatusproceso">
<span<?php echo $cs_calificacion->estatusproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->estatusproceso->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
		<td data-name="proceseval"<?php echo $cs_calificacion->proceseval->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_proceseval" class="cs_calificacion_proceseval">
<span<?php echo $cs_calificacion->proceseval->ViewAttributes() ?>>
<?php echo $cs_calificacion->proceseval->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
		<td data-name="invitainter"<?php echo $cs_calificacion->invitainter->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_invitainter" class="cs_calificacion_invitainter">
<span<?php echo $cs_calificacion->invitainter->ViewAttributes() ?>>
<?php echo $cs_calificacion->invitainter->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
		<td data-name="basespreca"<?php echo $cs_calificacion->basespreca->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_basespreca" class="cs_calificacion_basespreca">
<span<?php echo $cs_calificacion->basespreca->ViewAttributes() ?>>
<?php echo $cs_calificacion->basespreca->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
		<td data-name="resolucion"<?php echo $cs_calificacion->resolucion->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_resolucion" class="cs_calificacion_resolucion">
<span<?php echo $cs_calificacion->resolucion->ViewAttributes() ?>>
<?php echo $cs_calificacion->resolucion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
		<td data-name="nombreante"<?php echo $cs_calificacion->nombreante->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_nombreante" class="cs_calificacion_nombreante">
<span<?php echo $cs_calificacion->nombreante->ViewAttributes() ?>>
<?php echo $cs_calificacion->nombreante->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
		<td data-name="convocainvi"<?php echo $cs_calificacion->convocainvi->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_convocainvi" class="cs_calificacion_convocainvi">
<span<?php echo $cs_calificacion->convocainvi->ViewAttributes() ?>>
<?php echo $cs_calificacion->convocainvi->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
		<td data-name="tdr"<?php echo $cs_calificacion->tdr->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_tdr" class="cs_calificacion_tdr">
<span<?php echo $cs_calificacion->tdr->ViewAttributes() ?>>
<?php echo $cs_calificacion->tdr->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
		<td data-name="aclaraciones"<?php echo $cs_calificacion->aclaraciones->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_aclaraciones" class="cs_calificacion_aclaraciones">
<span<?php echo $cs_calificacion->aclaraciones->ViewAttributes() ?>>
<?php echo $cs_calificacion->aclaraciones->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
		<td data-name="actarecpcion"<?php echo $cs_calificacion->actarecpcion->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_actarecpcion" class="cs_calificacion_actarecpcion">
<span<?php echo $cs_calificacion->actarecpcion->ViewAttributes() ?>>
<?php echo $cs_calificacion->actarecpcion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
		<td data-name="fechaingreso"<?php echo $cs_calificacion->fechaingreso->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_fechaingreso" class="cs_calificacion_fechaingreso">
<span<?php echo $cs_calificacion->fechaingreso->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechaingreso->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
		<td data-name="tipocontrato"<?php echo $cs_calificacion->tipocontrato->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_tipocontrato" class="cs_calificacion_tipocontrato">
<span<?php echo $cs_calificacion->tipocontrato->ViewAttributes() ?>>
<?php echo $cs_calificacion->tipocontrato->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_calificacion->estado->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_estado" class="cs_calificacion_estado">
<span<?php echo $cs_calificacion->estado->ViewAttributes() ?>>
<?php echo $cs_calificacion->estado->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
		<td data-name="otro1"<?php echo $cs_calificacion->otro1->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_otro1" class="cs_calificacion_otro1">
<span<?php echo $cs_calificacion->otro1->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
		<td data-name="otro2"<?php echo $cs_calificacion->otro2->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_otro2" class="cs_calificacion_otro2">
<span<?php echo $cs_calificacion->otro2->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
		<td data-name="identidadadquisicion"<?php echo $cs_calificacion->identidadadquisicion->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_identidadadquisicion" class="cs_calificacion_identidadadquisicion">
<span<?php echo $cs_calificacion->identidadadquisicion->ViewAttributes() ?>>
<?php echo $cs_calificacion->identidadadquisicion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
		<td data-name="idmetodo"<?php echo $cs_calificacion->idmetodo->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_idmetodo" class="cs_calificacion_idmetodo">
<span<?php echo $cs_calificacion->idmetodo->ViewAttributes() ?>>
<?php echo $cs_calificacion->idmetodo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_calificacion->fecharecibido->CellAttributes() ?>>
<span id="el<?php echo $cs_calificacion_list->RowCnt ?>_cs_calificacion_fecharecibido" class="cs_calificacion_fecharecibido">
<span<?php echo $cs_calificacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_calificacion->fecharecibido->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_calificacion_list->ListOptions->Render("body", "right", $cs_calificacion_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($cs_calificacion->CurrentAction <> "gridadd")
		$cs_calificacion_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($cs_calificacion->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cs_calificacion_list->Recordset)
	$cs_calificacion_list->Recordset->Close();
?>
<?php if ($cs_calificacion->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($cs_calificacion->CurrentAction <> "gridadd" && $cs_calificacion->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cs_calificacion_list->Pager)) $cs_calificacion_list->Pager = new cPrevNextPager($cs_calificacion_list->StartRec, $cs_calificacion_list->DisplayRecs, $cs_calificacion_list->TotalRecs) ?>
<?php if ($cs_calificacion_list->Pager->RecordCount > 0) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cs_calificacion_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cs_calificacion_list->PageUrl() ?>start=<?php echo $cs_calificacion_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cs_calificacion_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cs_calificacion_list->PageUrl() ?>start=<?php echo $cs_calificacion_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cs_calificacion_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cs_calificacion_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cs_calificacion_list->PageUrl() ?>start=<?php echo $cs_calificacion_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cs_calificacion_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cs_calificacion_list->PageUrl() ?>start=<?php echo $cs_calificacion_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cs_calificacion_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cs_calificacion_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cs_calificacion_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cs_calificacion_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_calificacion_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($cs_calificacion_list->TotalRecs == 0 && $cs_calificacion->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_calificacion_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_calificacion->Export == "") { ?>
<script type="text/javascript">
fcs_calificacionlistsrch.Init();
fcs_calificacionlistsrch.FilterList = <?php echo $cs_calificacion_list->GetFilterList() ?>;
fcs_calificacionlist.Init();
</script>
<?php } ?>
<?php
$cs_calificacion_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cs_calificacion->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cs_calificacion_list->Page_Terminate();
?>
