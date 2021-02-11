<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_proyectoinfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_programainfo.php" ?>
<?php include_once "cs_calificaciongridcls.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_proyecto_list = NULL; // Initialize page object first

class ccs_proyecto_list extends ccs_proyecto {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_proyecto';

	// Page object name
	var $PageObjName = 'cs_proyecto_list';

	// Grid form hidden field names
	var $FormName = 'fcs_proyectolist';
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

		// Table object (cs_proyecto)
		if (!isset($GLOBALS["cs_proyecto"]) || get_class($GLOBALS["cs_proyecto"]) == "ccs_proyecto") {
			$GLOBALS["cs_proyecto"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_proyecto"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "cs_proyectoadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "cs_proyectodelete.php";
		$this->MultiUpdateUrl = "cs_proyectoupdate.php";

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Table object (cs_programa)
		if (!isset($GLOBALS['cs_programa'])) $GLOBALS['cs_programa'] = new ccs_programa();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_proyecto', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fcs_proyectolistsrch";

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
		$this->idProyecto->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

			// Process auto fill for detail table 'cs_calificacion'
			if (@$_POST["grid"] == "fcs_calificaciongrid") {
				if (!isset($GLOBALS["cs_calificacion_grid"])) $GLOBALS["cs_calificacion_grid"] = new ccs_calificacion_grid;
				$GLOBALS["cs_calificacion_grid"]->Page_Init();
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
		global $EW_EXPORT, $cs_proyecto;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_proyecto);
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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_programa") {
			global $cs_programa;
			$rsmaster = $cs_programa->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cs_programalist.php"); // Return to master page
			} else {
				$cs_programa->LoadListRowValues($rsmaster);
				$cs_programa->RowType = EW_ROWTYPE_MASTER; // Master row
				$cs_programa->RenderListRow();
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
			$this->idProyecto->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idProyecto->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->idProyecto->AdvancedSearch->ToJSON(), ","); // Field idProyecto
		$sFilterList = ew_Concat($sFilterList, $this->idPrograma->AdvancedSearch->ToJSON(), ","); // Field idPrograma
		$sFilterList = ew_Concat($sFilterList, $this->codigo->AdvancedSearch->ToJSON(), ","); // Field codigo
		$sFilterList = ew_Concat($sFilterList, $this->nombre_proyecto->AdvancedSearch->ToJSON(), ","); // Field nombre_proyecto
		$sFilterList = ew_Concat($sFilterList, $this->idUbicacion->AdvancedSearch->ToJSON(), ","); // Field idUbicacion
		$sFilterList = ew_Concat($sFilterList, $this->idRegion->AdvancedSearch->ToJSON(), ","); // Field idRegion
		$sFilterList = ew_Concat($sFilterList, $this->idDepto->AdvancedSearch->ToJSON(), ","); // Field idDepto
		$sFilterList = ew_Concat($sFilterList, $this->idTramo->AdvancedSearch->ToJSON(), ","); // Field idTramo
		$sFilterList = ew_Concat($sFilterList, $this->idRuta->AdvancedSearch->ToJSON(), ","); // Field idRuta
		$sFilterList = ew_Concat($sFilterList, $this->idTipoRed->AdvancedSearch->ToJSON(), ","); // Field idTipoRed
		$sFilterList = ew_Concat($sFilterList, $this->idProposito->AdvancedSearch->ToJSON(), ","); // Field idProposito
		$sFilterList = ew_Concat($sFilterList, $this->descrip->AdvancedSearch->ToJSON(), ","); // Field descrip
		$sFilterList = ew_Concat($sFilterList, $this->presupuesto->AdvancedSearch->ToJSON(), ","); // Field presupuesto
		$sFilterList = ew_Concat($sFilterList, $this->especiplano->AdvancedSearch->ToJSON(), ","); // Field especiplano
		$sFilterList = ew_Concat($sFilterList, $this->presuprogra->AdvancedSearch->ToJSON(), ","); // Field presuprogra
		$sFilterList = ew_Concat($sFilterList, $this->estudiofact->AdvancedSearch->ToJSON(), ","); // Field estudiofact
		$sFilterList = ew_Concat($sFilterList, $this->estudioimpact->AdvancedSearch->ToJSON(), ","); // Field estudioimpact
		$sFilterList = ew_Concat($sFilterList, $this->licambi->AdvancedSearch->ToJSON(), ","); // Field licambi
		$sFilterList = ew_Concat($sFilterList, $this->estuimpactierra->AdvancedSearch->ToJSON(), ","); // Field estuimpactierra
		$sFilterList = ew_Concat($sFilterList, $this->planreasea->AdvancedSearch->ToJSON(), ","); // Field planreasea
		$sFilterList = ew_Concat($sFilterList, $this->plananual->AdvancedSearch->ToJSON(), ","); // Field plananual
		$sFilterList = ew_Concat($sFilterList, $this->acuerdofinan->AdvancedSearch->ToJSON(), ","); // Field acuerdofinan
		$sFilterList = ew_Concat($sFilterList, $this->otro->AdvancedSearch->ToJSON(), ","); // Field otro
		$sFilterList = ew_Concat($sFilterList, $this->fechacreacion->AdvancedSearch->ToJSON(), ","); // Field fechacreacion
		$sFilterList = ew_Concat($sFilterList, $this->estado->AdvancedSearch->ToJSON(), ","); // Field estado
		$sFilterList = ew_Concat($sFilterList, $this->idFuncionario->AdvancedSearch->ToJSON(), ","); // Field idFuncionario
		$sFilterList = ew_Concat($sFilterList, $this->fechaaprob->AdvancedSearch->ToJSON(), ","); // Field fechaaprob
		$sFilterList = ew_Concat($sFilterList, $this->idfuente->AdvancedSearch->ToJSON(), ","); // Field idfuente
		$sFilterList = ew_Concat($sFilterList, $this->codsefin->AdvancedSearch->ToJSON(), ","); // Field codsefin
		$sFilterList = ew_Concat($sFilterList, $this->notaprioridad->AdvancedSearch->ToJSON(), ","); // Field notaprioridad
		$sFilterList = ew_Concat($sFilterList, $this->constanciabanco->AdvancedSearch->ToJSON(), ","); // Field constanciabanco
		$sFilterList = ew_Concat($sFilterList, $this->fecharecibido->AdvancedSearch->ToJSON(), ","); // Field fecharecibido
		$sFilterList = ew_Concat($sFilterList, $this->clase->AdvancedSearch->ToJSON(), ","); // Field clase
		$sFilterList = ew_Concat($sFilterList, $this->entes->AdvancedSearch->ToJSON(), ","); // Field entes
		$sFilterList = ew_Concat($sFilterList, $this->idRol->AdvancedSearch->ToJSON(), ","); // Field idRol
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

		// Field idProyecto
		$this->idProyecto->AdvancedSearch->SearchValue = @$filter["x_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchOperator = @$filter["z_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchCondition = @$filter["v_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchValue2 = @$filter["y_idProyecto"];
		$this->idProyecto->AdvancedSearch->SearchOperator2 = @$filter["w_idProyecto"];
		$this->idProyecto->AdvancedSearch->Save();

		// Field idPrograma
		$this->idPrograma->AdvancedSearch->SearchValue = @$filter["x_idPrograma"];
		$this->idPrograma->AdvancedSearch->SearchOperator = @$filter["z_idPrograma"];
		$this->idPrograma->AdvancedSearch->SearchCondition = @$filter["v_idPrograma"];
		$this->idPrograma->AdvancedSearch->SearchValue2 = @$filter["y_idPrograma"];
		$this->idPrograma->AdvancedSearch->SearchOperator2 = @$filter["w_idPrograma"];
		$this->idPrograma->AdvancedSearch->Save();

		// Field codigo
		$this->codigo->AdvancedSearch->SearchValue = @$filter["x_codigo"];
		$this->codigo->AdvancedSearch->SearchOperator = @$filter["z_codigo"];
		$this->codigo->AdvancedSearch->SearchCondition = @$filter["v_codigo"];
		$this->codigo->AdvancedSearch->SearchValue2 = @$filter["y_codigo"];
		$this->codigo->AdvancedSearch->SearchOperator2 = @$filter["w_codigo"];
		$this->codigo->AdvancedSearch->Save();

		// Field nombre_proyecto
		$this->nombre_proyecto->AdvancedSearch->SearchValue = @$filter["x_nombre_proyecto"];
		$this->nombre_proyecto->AdvancedSearch->SearchOperator = @$filter["z_nombre_proyecto"];
		$this->nombre_proyecto->AdvancedSearch->SearchCondition = @$filter["v_nombre_proyecto"];
		$this->nombre_proyecto->AdvancedSearch->SearchValue2 = @$filter["y_nombre_proyecto"];
		$this->nombre_proyecto->AdvancedSearch->SearchOperator2 = @$filter["w_nombre_proyecto"];
		$this->nombre_proyecto->AdvancedSearch->Save();

		// Field idUbicacion
		$this->idUbicacion->AdvancedSearch->SearchValue = @$filter["x_idUbicacion"];
		$this->idUbicacion->AdvancedSearch->SearchOperator = @$filter["z_idUbicacion"];
		$this->idUbicacion->AdvancedSearch->SearchCondition = @$filter["v_idUbicacion"];
		$this->idUbicacion->AdvancedSearch->SearchValue2 = @$filter["y_idUbicacion"];
		$this->idUbicacion->AdvancedSearch->SearchOperator2 = @$filter["w_idUbicacion"];
		$this->idUbicacion->AdvancedSearch->Save();

		// Field idRegion
		$this->idRegion->AdvancedSearch->SearchValue = @$filter["x_idRegion"];
		$this->idRegion->AdvancedSearch->SearchOperator = @$filter["z_idRegion"];
		$this->idRegion->AdvancedSearch->SearchCondition = @$filter["v_idRegion"];
		$this->idRegion->AdvancedSearch->SearchValue2 = @$filter["y_idRegion"];
		$this->idRegion->AdvancedSearch->SearchOperator2 = @$filter["w_idRegion"];
		$this->idRegion->AdvancedSearch->Save();

		// Field idDepto
		$this->idDepto->AdvancedSearch->SearchValue = @$filter["x_idDepto"];
		$this->idDepto->AdvancedSearch->SearchOperator = @$filter["z_idDepto"];
		$this->idDepto->AdvancedSearch->SearchCondition = @$filter["v_idDepto"];
		$this->idDepto->AdvancedSearch->SearchValue2 = @$filter["y_idDepto"];
		$this->idDepto->AdvancedSearch->SearchOperator2 = @$filter["w_idDepto"];
		$this->idDepto->AdvancedSearch->Save();

		// Field idTramo
		$this->idTramo->AdvancedSearch->SearchValue = @$filter["x_idTramo"];
		$this->idTramo->AdvancedSearch->SearchOperator = @$filter["z_idTramo"];
		$this->idTramo->AdvancedSearch->SearchCondition = @$filter["v_idTramo"];
		$this->idTramo->AdvancedSearch->SearchValue2 = @$filter["y_idTramo"];
		$this->idTramo->AdvancedSearch->SearchOperator2 = @$filter["w_idTramo"];
		$this->idTramo->AdvancedSearch->Save();

		// Field idRuta
		$this->idRuta->AdvancedSearch->SearchValue = @$filter["x_idRuta"];
		$this->idRuta->AdvancedSearch->SearchOperator = @$filter["z_idRuta"];
		$this->idRuta->AdvancedSearch->SearchCondition = @$filter["v_idRuta"];
		$this->idRuta->AdvancedSearch->SearchValue2 = @$filter["y_idRuta"];
		$this->idRuta->AdvancedSearch->SearchOperator2 = @$filter["w_idRuta"];
		$this->idRuta->AdvancedSearch->Save();

		// Field idTipoRed
		$this->idTipoRed->AdvancedSearch->SearchValue = @$filter["x_idTipoRed"];
		$this->idTipoRed->AdvancedSearch->SearchOperator = @$filter["z_idTipoRed"];
		$this->idTipoRed->AdvancedSearch->SearchCondition = @$filter["v_idTipoRed"];
		$this->idTipoRed->AdvancedSearch->SearchValue2 = @$filter["y_idTipoRed"];
		$this->idTipoRed->AdvancedSearch->SearchOperator2 = @$filter["w_idTipoRed"];
		$this->idTipoRed->AdvancedSearch->Save();

		// Field idProposito
		$this->idProposito->AdvancedSearch->SearchValue = @$filter["x_idProposito"];
		$this->idProposito->AdvancedSearch->SearchOperator = @$filter["z_idProposito"];
		$this->idProposito->AdvancedSearch->SearchCondition = @$filter["v_idProposito"];
		$this->idProposito->AdvancedSearch->SearchValue2 = @$filter["y_idProposito"];
		$this->idProposito->AdvancedSearch->SearchOperator2 = @$filter["w_idProposito"];
		$this->idProposito->AdvancedSearch->Save();

		// Field descrip
		$this->descrip->AdvancedSearch->SearchValue = @$filter["x_descrip"];
		$this->descrip->AdvancedSearch->SearchOperator = @$filter["z_descrip"];
		$this->descrip->AdvancedSearch->SearchCondition = @$filter["v_descrip"];
		$this->descrip->AdvancedSearch->SearchValue2 = @$filter["y_descrip"];
		$this->descrip->AdvancedSearch->SearchOperator2 = @$filter["w_descrip"];
		$this->descrip->AdvancedSearch->Save();

		// Field presupuesto
		$this->presupuesto->AdvancedSearch->SearchValue = @$filter["x_presupuesto"];
		$this->presupuesto->AdvancedSearch->SearchOperator = @$filter["z_presupuesto"];
		$this->presupuesto->AdvancedSearch->SearchCondition = @$filter["v_presupuesto"];
		$this->presupuesto->AdvancedSearch->SearchValue2 = @$filter["y_presupuesto"];
		$this->presupuesto->AdvancedSearch->SearchOperator2 = @$filter["w_presupuesto"];
		$this->presupuesto->AdvancedSearch->Save();

		// Field especiplano
		$this->especiplano->AdvancedSearch->SearchValue = @$filter["x_especiplano"];
		$this->especiplano->AdvancedSearch->SearchOperator = @$filter["z_especiplano"];
		$this->especiplano->AdvancedSearch->SearchCondition = @$filter["v_especiplano"];
		$this->especiplano->AdvancedSearch->SearchValue2 = @$filter["y_especiplano"];
		$this->especiplano->AdvancedSearch->SearchOperator2 = @$filter["w_especiplano"];
		$this->especiplano->AdvancedSearch->Save();

		// Field presuprogra
		$this->presuprogra->AdvancedSearch->SearchValue = @$filter["x_presuprogra"];
		$this->presuprogra->AdvancedSearch->SearchOperator = @$filter["z_presuprogra"];
		$this->presuprogra->AdvancedSearch->SearchCondition = @$filter["v_presuprogra"];
		$this->presuprogra->AdvancedSearch->SearchValue2 = @$filter["y_presuprogra"];
		$this->presuprogra->AdvancedSearch->SearchOperator2 = @$filter["w_presuprogra"];
		$this->presuprogra->AdvancedSearch->Save();

		// Field estudiofact
		$this->estudiofact->AdvancedSearch->SearchValue = @$filter["x_estudiofact"];
		$this->estudiofact->AdvancedSearch->SearchOperator = @$filter["z_estudiofact"];
		$this->estudiofact->AdvancedSearch->SearchCondition = @$filter["v_estudiofact"];
		$this->estudiofact->AdvancedSearch->SearchValue2 = @$filter["y_estudiofact"];
		$this->estudiofact->AdvancedSearch->SearchOperator2 = @$filter["w_estudiofact"];
		$this->estudiofact->AdvancedSearch->Save();

		// Field estudioimpact
		$this->estudioimpact->AdvancedSearch->SearchValue = @$filter["x_estudioimpact"];
		$this->estudioimpact->AdvancedSearch->SearchOperator = @$filter["z_estudioimpact"];
		$this->estudioimpact->AdvancedSearch->SearchCondition = @$filter["v_estudioimpact"];
		$this->estudioimpact->AdvancedSearch->SearchValue2 = @$filter["y_estudioimpact"];
		$this->estudioimpact->AdvancedSearch->SearchOperator2 = @$filter["w_estudioimpact"];
		$this->estudioimpact->AdvancedSearch->Save();

		// Field licambi
		$this->licambi->AdvancedSearch->SearchValue = @$filter["x_licambi"];
		$this->licambi->AdvancedSearch->SearchOperator = @$filter["z_licambi"];
		$this->licambi->AdvancedSearch->SearchCondition = @$filter["v_licambi"];
		$this->licambi->AdvancedSearch->SearchValue2 = @$filter["y_licambi"];
		$this->licambi->AdvancedSearch->SearchOperator2 = @$filter["w_licambi"];
		$this->licambi->AdvancedSearch->Save();

		// Field estuimpactierra
		$this->estuimpactierra->AdvancedSearch->SearchValue = @$filter["x_estuimpactierra"];
		$this->estuimpactierra->AdvancedSearch->SearchOperator = @$filter["z_estuimpactierra"];
		$this->estuimpactierra->AdvancedSearch->SearchCondition = @$filter["v_estuimpactierra"];
		$this->estuimpactierra->AdvancedSearch->SearchValue2 = @$filter["y_estuimpactierra"];
		$this->estuimpactierra->AdvancedSearch->SearchOperator2 = @$filter["w_estuimpactierra"];
		$this->estuimpactierra->AdvancedSearch->Save();

		// Field planreasea
		$this->planreasea->AdvancedSearch->SearchValue = @$filter["x_planreasea"];
		$this->planreasea->AdvancedSearch->SearchOperator = @$filter["z_planreasea"];
		$this->planreasea->AdvancedSearch->SearchCondition = @$filter["v_planreasea"];
		$this->planreasea->AdvancedSearch->SearchValue2 = @$filter["y_planreasea"];
		$this->planreasea->AdvancedSearch->SearchOperator2 = @$filter["w_planreasea"];
		$this->planreasea->AdvancedSearch->Save();

		// Field plananual
		$this->plananual->AdvancedSearch->SearchValue = @$filter["x_plananual"];
		$this->plananual->AdvancedSearch->SearchOperator = @$filter["z_plananual"];
		$this->plananual->AdvancedSearch->SearchCondition = @$filter["v_plananual"];
		$this->plananual->AdvancedSearch->SearchValue2 = @$filter["y_plananual"];
		$this->plananual->AdvancedSearch->SearchOperator2 = @$filter["w_plananual"];
		$this->plananual->AdvancedSearch->Save();

		// Field acuerdofinan
		$this->acuerdofinan->AdvancedSearch->SearchValue = @$filter["x_acuerdofinan"];
		$this->acuerdofinan->AdvancedSearch->SearchOperator = @$filter["z_acuerdofinan"];
		$this->acuerdofinan->AdvancedSearch->SearchCondition = @$filter["v_acuerdofinan"];
		$this->acuerdofinan->AdvancedSearch->SearchValue2 = @$filter["y_acuerdofinan"];
		$this->acuerdofinan->AdvancedSearch->SearchOperator2 = @$filter["w_acuerdofinan"];
		$this->acuerdofinan->AdvancedSearch->Save();

		// Field otro
		$this->otro->AdvancedSearch->SearchValue = @$filter["x_otro"];
		$this->otro->AdvancedSearch->SearchOperator = @$filter["z_otro"];
		$this->otro->AdvancedSearch->SearchCondition = @$filter["v_otro"];
		$this->otro->AdvancedSearch->SearchValue2 = @$filter["y_otro"];
		$this->otro->AdvancedSearch->SearchOperator2 = @$filter["w_otro"];
		$this->otro->AdvancedSearch->Save();

		// Field fechacreacion
		$this->fechacreacion->AdvancedSearch->SearchValue = @$filter["x_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchOperator = @$filter["z_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchCondition = @$filter["v_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchValue2 = @$filter["y_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->SearchOperator2 = @$filter["w_fechacreacion"];
		$this->fechacreacion->AdvancedSearch->Save();

		// Field estado
		$this->estado->AdvancedSearch->SearchValue = @$filter["x_estado"];
		$this->estado->AdvancedSearch->SearchOperator = @$filter["z_estado"];
		$this->estado->AdvancedSearch->SearchCondition = @$filter["v_estado"];
		$this->estado->AdvancedSearch->SearchValue2 = @$filter["y_estado"];
		$this->estado->AdvancedSearch->SearchOperator2 = @$filter["w_estado"];
		$this->estado->AdvancedSearch->Save();

		// Field idFuncionario
		$this->idFuncionario->AdvancedSearch->SearchValue = @$filter["x_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchOperator = @$filter["z_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchCondition = @$filter["v_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchValue2 = @$filter["y_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->SearchOperator2 = @$filter["w_idFuncionario"];
		$this->idFuncionario->AdvancedSearch->Save();

		// Field fechaaprob
		$this->fechaaprob->AdvancedSearch->SearchValue = @$filter["x_fechaaprob"];
		$this->fechaaprob->AdvancedSearch->SearchOperator = @$filter["z_fechaaprob"];
		$this->fechaaprob->AdvancedSearch->SearchCondition = @$filter["v_fechaaprob"];
		$this->fechaaprob->AdvancedSearch->SearchValue2 = @$filter["y_fechaaprob"];
		$this->fechaaprob->AdvancedSearch->SearchOperator2 = @$filter["w_fechaaprob"];
		$this->fechaaprob->AdvancedSearch->Save();

		// Field idfuente
		$this->idfuente->AdvancedSearch->SearchValue = @$filter["x_idfuente"];
		$this->idfuente->AdvancedSearch->SearchOperator = @$filter["z_idfuente"];
		$this->idfuente->AdvancedSearch->SearchCondition = @$filter["v_idfuente"];
		$this->idfuente->AdvancedSearch->SearchValue2 = @$filter["y_idfuente"];
		$this->idfuente->AdvancedSearch->SearchOperator2 = @$filter["w_idfuente"];
		$this->idfuente->AdvancedSearch->Save();

		// Field codsefin
		$this->codsefin->AdvancedSearch->SearchValue = @$filter["x_codsefin"];
		$this->codsefin->AdvancedSearch->SearchOperator = @$filter["z_codsefin"];
		$this->codsefin->AdvancedSearch->SearchCondition = @$filter["v_codsefin"];
		$this->codsefin->AdvancedSearch->SearchValue2 = @$filter["y_codsefin"];
		$this->codsefin->AdvancedSearch->SearchOperator2 = @$filter["w_codsefin"];
		$this->codsefin->AdvancedSearch->Save();

		// Field notaprioridad
		$this->notaprioridad->AdvancedSearch->SearchValue = @$filter["x_notaprioridad"];
		$this->notaprioridad->AdvancedSearch->SearchOperator = @$filter["z_notaprioridad"];
		$this->notaprioridad->AdvancedSearch->SearchCondition = @$filter["v_notaprioridad"];
		$this->notaprioridad->AdvancedSearch->SearchValue2 = @$filter["y_notaprioridad"];
		$this->notaprioridad->AdvancedSearch->SearchOperator2 = @$filter["w_notaprioridad"];
		$this->notaprioridad->AdvancedSearch->Save();

		// Field constanciabanco
		$this->constanciabanco->AdvancedSearch->SearchValue = @$filter["x_constanciabanco"];
		$this->constanciabanco->AdvancedSearch->SearchOperator = @$filter["z_constanciabanco"];
		$this->constanciabanco->AdvancedSearch->SearchCondition = @$filter["v_constanciabanco"];
		$this->constanciabanco->AdvancedSearch->SearchValue2 = @$filter["y_constanciabanco"];
		$this->constanciabanco->AdvancedSearch->SearchOperator2 = @$filter["w_constanciabanco"];
		$this->constanciabanco->AdvancedSearch->Save();

		// Field fecharecibido
		$this->fecharecibido->AdvancedSearch->SearchValue = @$filter["x_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchOperator = @$filter["z_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchCondition = @$filter["v_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchValue2 = @$filter["y_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->SearchOperator2 = @$filter["w_fecharecibido"];
		$this->fecharecibido->AdvancedSearch->Save();

		// Field clase
		$this->clase->AdvancedSearch->SearchValue = @$filter["x_clase"];
		$this->clase->AdvancedSearch->SearchOperator = @$filter["z_clase"];
		$this->clase->AdvancedSearch->SearchCondition = @$filter["v_clase"];
		$this->clase->AdvancedSearch->SearchValue2 = @$filter["y_clase"];
		$this->clase->AdvancedSearch->SearchOperator2 = @$filter["w_clase"];
		$this->clase->AdvancedSearch->Save();

		// Field entes
		$this->entes->AdvancedSearch->SearchValue = @$filter["x_entes"];
		$this->entes->AdvancedSearch->SearchOperator = @$filter["z_entes"];
		$this->entes->AdvancedSearch->SearchCondition = @$filter["v_entes"];
		$this->entes->AdvancedSearch->SearchValue2 = @$filter["y_entes"];
		$this->entes->AdvancedSearch->SearchOperator2 = @$filter["w_entes"];
		$this->entes->AdvancedSearch->Save();

		// Field idRol
		$this->idRol->AdvancedSearch->SearchValue = @$filter["x_idRol"];
		$this->idRol->AdvancedSearch->SearchOperator = @$filter["z_idRol"];
		$this->idRol->AdvancedSearch->SearchCondition = @$filter["v_idRol"];
		$this->idRol->AdvancedSearch->SearchValue2 = @$filter["y_idRol"];
		$this->idRol->AdvancedSearch->SearchOperator2 = @$filter["w_idRol"];
		$this->idRol->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter["psearch"]);
		$this->BasicSearch->setType(@$filter["psearchtype"]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->codigo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->nombre_proyecto, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->descrip, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->especiplano, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->presuprogra, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estudiofact, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estudioimpact, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->licambi, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estuimpactierra, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->planreasea, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->plananual, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->acuerdofinan, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->otro, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechacreacion, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->estado, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fechaaprob, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->codsefin, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->notaprioridad, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->constanciabanco, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->fecharecibido, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->clase, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->entes, $arKeywords, $type);
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
			$this->UpdateSort($this->idProyecto); // idProyecto
			$this->UpdateSort($this->idPrograma); // idPrograma
			$this->UpdateSort($this->codigo); // codigo
			$this->UpdateSort($this->idUbicacion); // idUbicacion
			$this->UpdateSort($this->idRegion); // idRegion
			$this->UpdateSort($this->idDepto); // idDepto
			$this->UpdateSort($this->idTramo); // idTramo
			$this->UpdateSort($this->idRuta); // idRuta
			$this->UpdateSort($this->idTipoRed); // idTipoRed
			$this->UpdateSort($this->idProposito); // idProposito
			$this->UpdateSort($this->presupuesto); // presupuesto
			$this->UpdateSort($this->especiplano); // especiplano
			$this->UpdateSort($this->presuprogra); // presuprogra
			$this->UpdateSort($this->estudiofact); // estudiofact
			$this->UpdateSort($this->estudioimpact); // estudioimpact
			$this->UpdateSort($this->licambi); // licambi
			$this->UpdateSort($this->estuimpactierra); // estuimpactierra
			$this->UpdateSort($this->planreasea); // planreasea
			$this->UpdateSort($this->plananual); // plananual
			$this->UpdateSort($this->acuerdofinan); // acuerdofinan
			$this->UpdateSort($this->otro); // otro
			$this->UpdateSort($this->fechacreacion); // fechacreacion
			$this->UpdateSort($this->estado); // estado
			$this->UpdateSort($this->idFuncionario); // idFuncionario
			$this->UpdateSort($this->fechaaprob); // fechaaprob
			$this->UpdateSort($this->idfuente); // idfuente
			$this->UpdateSort($this->codsefin); // codsefin
			$this->UpdateSort($this->notaprioridad); // notaprioridad
			$this->UpdateSort($this->constanciabanco); // constanciabanco
			$this->UpdateSort($this->fecharecibido); // fecharecibido
			$this->UpdateSort($this->clase); // clase
			$this->UpdateSort($this->entes); // entes
			$this->UpdateSort($this->idRol); // idRol
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
				$this->idPrograma->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->idProyecto->setSort("");
				$this->idPrograma->setSort("");
				$this->codigo->setSort("");
				$this->idUbicacion->setSort("");
				$this->idRegion->setSort("");
				$this->idDepto->setSort("");
				$this->idTramo->setSort("");
				$this->idRuta->setSort("");
				$this->idTipoRed->setSort("");
				$this->idProposito->setSort("");
				$this->presupuesto->setSort("");
				$this->especiplano->setSort("");
				$this->presuprogra->setSort("");
				$this->estudiofact->setSort("");
				$this->estudioimpact->setSort("");
				$this->licambi->setSort("");
				$this->estuimpactierra->setSort("");
				$this->planreasea->setSort("");
				$this->plananual->setSort("");
				$this->acuerdofinan->setSort("");
				$this->otro->setSort("");
				$this->fechacreacion->setSort("");
				$this->estado->setSort("");
				$this->idFuncionario->setSort("");
				$this->fechaaprob->setSort("");
				$this->idfuente->setSort("");
				$this->codsefin->setSort("");
				$this->notaprioridad->setSort("");
				$this->constanciabanco->setSort("");
				$this->fecharecibido->setSort("");
				$this->clase->setSort("");
				$this->entes->setSort("");
				$this->idRol->setSort("");
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

		// "detail_cs_calificacion"
		$item = &$this->ListOptions->Add("detail_cs_calificacion");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_calificacion') && !$this->ShowMultipleDetails;
		$item->OnLeft = FALSE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["cs_calificacion_grid"])) $GLOBALS["cs_calificacion_grid"] = new ccs_calificacion_grid;

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
		$pages->Add("cs_calificacion");
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

		// "detail_cs_calificacion"
		$oListOpt = &$this->ListOptions->Items["detail_cs_calificacion"];
		if ($Security->AllowList(CurrentProjectID() . 'cs_calificacion')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("cs_calificacion", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_calificacionlist.php?" . EW_TABLE_SHOW_MASTER . "=cs_proyecto&fk_idProyecto=" . urlencode(strval($this->idProyecto->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["cs_calificacion_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_calificacion')) {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_calificacion")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
				if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
				$DetailViewTblVar .= "cs_calificacion";
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
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->idProyecto->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fcs_proyectolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fcs_proyectolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fcs_proyectolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fcs_proyectolistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idProyecto->DbValue = $row['idProyecto'];
		$this->idPrograma->DbValue = $row['idPrograma'];
		$this->codigo->DbValue = $row['codigo'];
		$this->nombre_proyecto->DbValue = $row['nombre_proyecto'];
		$this->idUbicacion->DbValue = $row['idUbicacion'];
		$this->idRegion->DbValue = $row['idRegion'];
		$this->idDepto->DbValue = $row['idDepto'];
		$this->idTramo->DbValue = $row['idTramo'];
		$this->idRuta->DbValue = $row['idRuta'];
		$this->idTipoRed->DbValue = $row['idTipoRed'];
		$this->idProposito->DbValue = $row['idProposito'];
		$this->descrip->DbValue = $row['descrip'];
		$this->presupuesto->DbValue = $row['presupuesto'];
		$this->especiplano->DbValue = $row['especiplano'];
		$this->presuprogra->DbValue = $row['presuprogra'];
		$this->estudiofact->DbValue = $row['estudiofact'];
		$this->estudioimpact->DbValue = $row['estudioimpact'];
		$this->licambi->DbValue = $row['licambi'];
		$this->estuimpactierra->DbValue = $row['estuimpactierra'];
		$this->planreasea->DbValue = $row['planreasea'];
		$this->plananual->DbValue = $row['plananual'];
		$this->acuerdofinan->DbValue = $row['acuerdofinan'];
		$this->otro->DbValue = $row['otro'];
		$this->fechacreacion->DbValue = $row['fechacreacion'];
		$this->estado->DbValue = $row['estado'];
		$this->idFuncionario->DbValue = $row['idFuncionario'];
		$this->fechaaprob->DbValue = $row['fechaaprob'];
		$this->idfuente->DbValue = $row['idfuente'];
		$this->codsefin->DbValue = $row['codsefin'];
		$this->notaprioridad->DbValue = $row['notaprioridad'];
		$this->constanciabanco->DbValue = $row['constanciabanco'];
		$this->fecharecibido->DbValue = $row['fecharecibido'];
		$this->clase->DbValue = $row['clase'];
		$this->entes->DbValue = $row['entes'];
		$this->idRol->DbValue = $row['idRol'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("idProyecto")) <> "")
			$this->idProyecto->CurrentValue = $this->getKey("idProyecto"); // idProyecto
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
		if ($this->presupuesto->FormValue == $this->presupuesto->CurrentValue && is_numeric(ew_StrToFloat($this->presupuesto->CurrentValue)))
			$this->presupuesto->CurrentValue = ew_StrToFloat($this->presupuesto->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// idProyecto
		$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
		$this->idProyecto->ViewCustomAttributes = "";

		// idPrograma
		$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
		$this->idPrograma->ViewCustomAttributes = "";

		// codigo
		$this->codigo->ViewValue = $this->codigo->CurrentValue;
		$this->codigo->ViewCustomAttributes = "";

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
		$item->Body = "<button id=\"emf_cs_proyecto\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_cs_proyecto',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fcs_proyectolist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_programa") {
			global $cs_programa;
			if (!isset($cs_programa)) $cs_programa = new ccs_programa;
			$rsmaster = $cs_programa->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$cs_programa;
					$cs_programa->ExportDocument($Doc, $rsmaster, 1, 1);
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
			if ($sMasterTblVar == "cs_programa") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_idPrograma"] <> "") {
					$GLOBALS["cs_programa"]->idPrograma->setQueryStringValue($_GET["fk_idPrograma"]);
					$this->idPrograma->setQueryStringValue($GLOBALS["cs_programa"]->idPrograma->QueryStringValue);
					$this->idPrograma->setSessionValue($this->idPrograma->QueryStringValue);
					if (!is_numeric($GLOBALS["cs_programa"]->idPrograma->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cs_programa") {
				if ($this->idPrograma->QueryStringValue == "") $this->idPrograma->setSessionValue("");
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
if (!isset($cs_proyecto_list)) $cs_proyecto_list = new ccs_proyecto_list();

// Page init
$cs_proyecto_list->Page_Init();

// Page main
$cs_proyecto_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_proyecto_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($cs_proyecto->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fcs_proyectolist = new ew_Form("fcs_proyectolist", "list");
fcs_proyectolist.FormKeyCountName = '<?php echo $cs_proyecto_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcs_proyectolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_proyectolist.ValidateRequired = true;
<?php } else { ?>
fcs_proyectolist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

var CurrentSearchForm = fcs_proyectolistsrch = new ew_Form("fcs_proyectolistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($cs_proyecto->Export == "") { ?>
<div class="ewToolbar">
<?php if ($cs_proyecto->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($cs_proyecto_list->TotalRecs > 0 && $cs_proyecto_list->ExportOptions->Visible()) { ?>
<?php $cs_proyecto_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_proyecto_list->SearchOptions->Visible()) { ?>
<?php $cs_proyecto_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_proyecto_list->FilterOptions->Visible()) { ?>
<?php $cs_proyecto_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($cs_proyecto->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($cs_proyecto->Export == "") || (EW_EXPORT_MASTER_RECORD && $cs_proyecto->Export == "print")) { ?>
<?php
$gsMasterReturnUrl = "cs_programalist.php";
if ($cs_proyecto_list->DbMasterFilter <> "" && $cs_proyecto->getCurrentMasterTable() == "cs_programa") {
	if ($cs_proyecto_list->MasterRecordExists) {
		if ($cs_proyecto->getCurrentMasterTable() == $cs_proyecto->TableVar) $gsMasterReturnUrl .= "?" . EW_TABLE_SHOW_MASTER . "=";
?>
<?php include_once "cs_programamaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $cs_proyecto_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($cs_proyecto_list->TotalRecs <= 0)
			$cs_proyecto_list->TotalRecs = $cs_proyecto->SelectRecordCount();
	} else {
		if (!$cs_proyecto_list->Recordset && ($cs_proyecto_list->Recordset = $cs_proyecto_list->LoadRecordset()))
			$cs_proyecto_list->TotalRecs = $cs_proyecto_list->Recordset->RecordCount();
	}
	$cs_proyecto_list->StartRec = 1;
	if ($cs_proyecto_list->DisplayRecs <= 0 || ($cs_proyecto->Export <> "" && $cs_proyecto->ExportAll)) // Display all records
		$cs_proyecto_list->DisplayRecs = $cs_proyecto_list->TotalRecs;
	if (!($cs_proyecto->Export <> "" && $cs_proyecto->ExportAll))
		$cs_proyecto_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$cs_proyecto_list->Recordset = $cs_proyecto_list->LoadRecordset($cs_proyecto_list->StartRec-1, $cs_proyecto_list->DisplayRecs);

	// Set no record found message
	if ($cs_proyecto->CurrentAction == "" && $cs_proyecto_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$cs_proyecto_list->setWarningMessage($Language->Phrase("NoPermission"));
		if ($cs_proyecto_list->SearchWhere == "0=101")
			$cs_proyecto_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$cs_proyecto_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$cs_proyecto_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($cs_proyecto->Export == "" && $cs_proyecto->CurrentAction == "") { ?>
<form name="fcs_proyectolistsrch" id="fcs_proyectolistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($cs_proyecto_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fcs_proyectolistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cs_proyecto">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($cs_proyecto_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($cs_proyecto_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $cs_proyecto_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($cs_proyecto_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($cs_proyecto_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($cs_proyecto_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($cs_proyecto_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $cs_proyecto_list->ShowPageHeader(); ?>
<?php
$cs_proyecto_list->ShowMessage();
?>
<?php if ($cs_proyecto_list->TotalRecs > 0 || $cs_proyecto->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid">
<form name="fcs_proyectolist" id="fcs_proyectolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_proyecto_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_proyecto_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_proyecto">
<div id="gmp_cs_proyecto" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($cs_proyecto_list->TotalRecs > 0) { ?>
<table id="tbl_cs_proyectolist" class="table ewTable">
<?php echo $cs_proyecto->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$cs_proyecto_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$cs_proyecto_list->RenderListOptions();

// Render list options (header, left)
$cs_proyecto_list->ListOptions->Render("header", "left");
?>
<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idProyecto) == "") { ?>
		<th data-name="idProyecto"><div id="elh_cs_proyecto_idProyecto" class="cs_proyecto_idProyecto"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProyecto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProyecto"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idProyecto) ?>',1);"><div id="elh_cs_proyecto_idProyecto" class="cs_proyecto_idProyecto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProyecto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idProyecto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idProyecto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idPrograma) == "") { ?>
		<th data-name="idPrograma"><div id="elh_cs_proyecto_idPrograma" class="cs_proyecto_idPrograma"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idPrograma->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idPrograma"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idPrograma) ?>',1);"><div id="elh_cs_proyecto_idPrograma" class="cs_proyecto_idPrograma">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idPrograma->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idPrograma->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idPrograma->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->codigo) == "") { ?>
		<th data-name="codigo"><div id="elh_cs_proyecto_codigo" class="cs_proyecto_codigo"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->codigo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->codigo) ?>',1);"><div id="elh_cs_proyecto_codigo" class="cs_proyecto_codigo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->codigo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->codigo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->codigo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idUbicacion) == "") { ?>
		<th data-name="idUbicacion"><div id="elh_cs_proyecto_idUbicacion" class="cs_proyecto_idUbicacion"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idUbicacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idUbicacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idUbicacion) ?>',1);"><div id="elh_cs_proyecto_idUbicacion" class="cs_proyecto_idUbicacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idUbicacion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idUbicacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idUbicacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idRegion) == "") { ?>
		<th data-name="idRegion"><div id="elh_cs_proyecto_idRegion" class="cs_proyecto_idRegion"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRegion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRegion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idRegion) ?>',1);"><div id="elh_cs_proyecto_idRegion" class="cs_proyecto_idRegion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRegion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idRegion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idRegion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idDepto) == "") { ?>
		<th data-name="idDepto"><div id="elh_cs_proyecto_idDepto" class="cs_proyecto_idDepto"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idDepto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idDepto"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idDepto) ?>',1);"><div id="elh_cs_proyecto_idDepto" class="cs_proyecto_idDepto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idDepto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idDepto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idDepto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idTramo) == "") { ?>
		<th data-name="idTramo"><div id="elh_cs_proyecto_idTramo" class="cs_proyecto_idTramo"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTramo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idTramo"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idTramo) ?>',1);"><div id="elh_cs_proyecto_idTramo" class="cs_proyecto_idTramo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTramo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idTramo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idTramo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idRuta) == "") { ?>
		<th data-name="idRuta"><div id="elh_cs_proyecto_idRuta" class="cs_proyecto_idRuta"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRuta->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRuta"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idRuta) ?>',1);"><div id="elh_cs_proyecto_idRuta" class="cs_proyecto_idRuta">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRuta->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idRuta->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idRuta->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idTipoRed) == "") { ?>
		<th data-name="idTipoRed"><div id="elh_cs_proyecto_idTipoRed" class="cs_proyecto_idTipoRed"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTipoRed->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idTipoRed"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idTipoRed) ?>',1);"><div id="elh_cs_proyecto_idTipoRed" class="cs_proyecto_idTipoRed">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idTipoRed->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idTipoRed->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idTipoRed->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idProposito) == "") { ?>
		<th data-name="idProposito"><div id="elh_cs_proyecto_idProposito" class="cs_proyecto_idProposito"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProposito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idProposito"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idProposito) ?>',1);"><div id="elh_cs_proyecto_idProposito" class="cs_proyecto_idProposito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idProposito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idProposito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idProposito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->presupuesto) == "") { ?>
		<th data-name="presupuesto"><div id="elh_cs_proyecto_presupuesto" class="cs_proyecto_presupuesto"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->presupuesto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presupuesto"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->presupuesto) ?>',1);"><div id="elh_cs_proyecto_presupuesto" class="cs_proyecto_presupuesto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->presupuesto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->presupuesto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->presupuesto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->especiplano) == "") { ?>
		<th data-name="especiplano"><div id="elh_cs_proyecto_especiplano" class="cs_proyecto_especiplano"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->especiplano->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="especiplano"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->especiplano) ?>',1);"><div id="elh_cs_proyecto_especiplano" class="cs_proyecto_especiplano">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->especiplano->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->especiplano->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->especiplano->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->presuprogra) == "") { ?>
		<th data-name="presuprogra"><div id="elh_cs_proyecto_presuprogra" class="cs_proyecto_presuprogra"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->presuprogra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="presuprogra"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->presuprogra) ?>',1);"><div id="elh_cs_proyecto_presuprogra" class="cs_proyecto_presuprogra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->presuprogra->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->presuprogra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->presuprogra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estudiofact) == "") { ?>
		<th data-name="estudiofact"><div id="elh_cs_proyecto_estudiofact" class="cs_proyecto_estudiofact"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudiofact->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estudiofact"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->estudiofact) ?>',1);"><div id="elh_cs_proyecto_estudiofact" class="cs_proyecto_estudiofact">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudiofact->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estudiofact->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estudiofact->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estudioimpact) == "") { ?>
		<th data-name="estudioimpact"><div id="elh_cs_proyecto_estudioimpact" class="cs_proyecto_estudioimpact"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudioimpact->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estudioimpact"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->estudioimpact) ?>',1);"><div id="elh_cs_proyecto_estudioimpact" class="cs_proyecto_estudioimpact">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estudioimpact->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estudioimpact->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estudioimpact->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->licambi) == "") { ?>
		<th data-name="licambi"><div id="elh_cs_proyecto_licambi" class="cs_proyecto_licambi"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->licambi->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="licambi"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->licambi) ?>',1);"><div id="elh_cs_proyecto_licambi" class="cs_proyecto_licambi">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->licambi->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->licambi->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->licambi->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estuimpactierra) == "") { ?>
		<th data-name="estuimpactierra"><div id="elh_cs_proyecto_estuimpactierra" class="cs_proyecto_estuimpactierra"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estuimpactierra->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estuimpactierra"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->estuimpactierra) ?>',1);"><div id="elh_cs_proyecto_estuimpactierra" class="cs_proyecto_estuimpactierra">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estuimpactierra->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estuimpactierra->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estuimpactierra->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->planreasea) == "") { ?>
		<th data-name="planreasea"><div id="elh_cs_proyecto_planreasea" class="cs_proyecto_planreasea"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->planreasea->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="planreasea"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->planreasea) ?>',1);"><div id="elh_cs_proyecto_planreasea" class="cs_proyecto_planreasea">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->planreasea->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->planreasea->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->planreasea->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->plananual) == "") { ?>
		<th data-name="plananual"><div id="elh_cs_proyecto_plananual" class="cs_proyecto_plananual"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->plananual->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="plananual"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->plananual) ?>',1);"><div id="elh_cs_proyecto_plananual" class="cs_proyecto_plananual">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->plananual->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->plananual->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->plananual->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->acuerdofinan) == "") { ?>
		<th data-name="acuerdofinan"><div id="elh_cs_proyecto_acuerdofinan" class="cs_proyecto_acuerdofinan"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->acuerdofinan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acuerdofinan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->acuerdofinan) ?>',1);"><div id="elh_cs_proyecto_acuerdofinan" class="cs_proyecto_acuerdofinan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->acuerdofinan->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->acuerdofinan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->acuerdofinan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->otro->Visible) { // otro ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->otro) == "") { ?>
		<th data-name="otro"><div id="elh_cs_proyecto_otro" class="cs_proyecto_otro"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->otro->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="otro"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->otro) ?>',1);"><div id="elh_cs_proyecto_otro" class="cs_proyecto_otro">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->otro->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->otro->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->otro->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->fechacreacion) == "") { ?>
		<th data-name="fechacreacion"><div id="elh_cs_proyecto_fechacreacion" class="cs_proyecto_fechacreacion"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechacreacion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechacreacion"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->fechacreacion) ?>',1);"><div id="elh_cs_proyecto_fechacreacion" class="cs_proyecto_fechacreacion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechacreacion->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->fechacreacion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->fechacreacion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->estado->Visible) { // estado ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->estado) == "") { ?>
		<th data-name="estado"><div id="elh_cs_proyecto_estado" class="cs_proyecto_estado"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->estado) ?>',1);"><div id="elh_cs_proyecto_estado" class="cs_proyecto_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->estado->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idFuncionario) == "") { ?>
		<th data-name="idFuncionario"><div id="elh_cs_proyecto_idFuncionario" class="cs_proyecto_idFuncionario"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idFuncionario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idFuncionario"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idFuncionario) ?>',1);"><div id="elh_cs_proyecto_idFuncionario" class="cs_proyecto_idFuncionario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idFuncionario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idFuncionario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idFuncionario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->fechaaprob) == "") { ?>
		<th data-name="fechaaprob"><div id="elh_cs_proyecto_fechaaprob" class="cs_proyecto_fechaaprob"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechaaprob->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fechaaprob"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->fechaaprob) ?>',1);"><div id="elh_cs_proyecto_fechaaprob" class="cs_proyecto_fechaaprob">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->fechaaprob->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->fechaaprob->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->fechaaprob->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idfuente) == "") { ?>
		<th data-name="idfuente"><div id="elh_cs_proyecto_idfuente" class="cs_proyecto_idfuente"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idfuente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idfuente"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idfuente) ?>',1);"><div id="elh_cs_proyecto_idfuente" class="cs_proyecto_idfuente">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idfuente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idfuente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idfuente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->codsefin) == "") { ?>
		<th data-name="codsefin"><div id="elh_cs_proyecto_codsefin" class="cs_proyecto_codsefin"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->codsefin->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codsefin"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->codsefin) ?>',1);"><div id="elh_cs_proyecto_codsefin" class="cs_proyecto_codsefin">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->codsefin->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->codsefin->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->codsefin->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->notaprioridad) == "") { ?>
		<th data-name="notaprioridad"><div id="elh_cs_proyecto_notaprioridad" class="cs_proyecto_notaprioridad"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->notaprioridad->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="notaprioridad"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->notaprioridad) ?>',1);"><div id="elh_cs_proyecto_notaprioridad" class="cs_proyecto_notaprioridad">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->notaprioridad->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->notaprioridad->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->notaprioridad->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->constanciabanco) == "") { ?>
		<th data-name="constanciabanco"><div id="elh_cs_proyecto_constanciabanco" class="cs_proyecto_constanciabanco"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->constanciabanco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="constanciabanco"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->constanciabanco) ?>',1);"><div id="elh_cs_proyecto_constanciabanco" class="cs_proyecto_constanciabanco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->constanciabanco->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->constanciabanco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->constanciabanco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->fecharecibido) == "") { ?>
		<th data-name="fecharecibido"><div id="elh_cs_proyecto_fecharecibido" class="cs_proyecto_fecharecibido"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->fecharecibido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecharecibido"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->fecharecibido) ?>',1);"><div id="elh_cs_proyecto_fecharecibido" class="cs_proyecto_fecharecibido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->fecharecibido->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->fecharecibido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->fecharecibido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->clase->Visible) { // clase ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->clase) == "") { ?>
		<th data-name="clase"><div id="elh_cs_proyecto_clase" class="cs_proyecto_clase"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->clase->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="clase"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->clase) ?>',1);"><div id="elh_cs_proyecto_clase" class="cs_proyecto_clase">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->clase->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->clase->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->clase->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->entes->Visible) { // entes ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->entes) == "") { ?>
		<th data-name="entes"><div id="elh_cs_proyecto_entes" class="cs_proyecto_entes"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->entes->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="entes"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->entes) ?>',1);"><div id="elh_cs_proyecto_entes" class="cs_proyecto_entes">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->entes->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->entes->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->entes->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
	<?php if ($cs_proyecto->SortUrl($cs_proyecto->idRol) == "") { ?>
		<th data-name="idRol"><div id="elh_cs_proyecto_idRol" class="cs_proyecto_idRol"><div class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idRol"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $cs_proyecto->SortUrl($cs_proyecto->idRol) ?>',1);"><div id="elh_cs_proyecto_idRol" class="cs_proyecto_idRol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $cs_proyecto->idRol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($cs_proyecto->idRol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($cs_proyecto->idRol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$cs_proyecto_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cs_proyecto->ExportAll && $cs_proyecto->Export <> "") {
	$cs_proyecto_list->StopRec = $cs_proyecto_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cs_proyecto_list->TotalRecs > $cs_proyecto_list->StartRec + $cs_proyecto_list->DisplayRecs - 1)
		$cs_proyecto_list->StopRec = $cs_proyecto_list->StartRec + $cs_proyecto_list->DisplayRecs - 1;
	else
		$cs_proyecto_list->StopRec = $cs_proyecto_list->TotalRecs;
}
$cs_proyecto_list->RecCnt = $cs_proyecto_list->StartRec - 1;
if ($cs_proyecto_list->Recordset && !$cs_proyecto_list->Recordset->EOF) {
	$cs_proyecto_list->Recordset->MoveFirst();
	$bSelectLimit = $cs_proyecto_list->UseSelectLimit;
	if (!$bSelectLimit && $cs_proyecto_list->StartRec > 1)
		$cs_proyecto_list->Recordset->Move($cs_proyecto_list->StartRec - 1);
} elseif (!$cs_proyecto->AllowAddDeleteRow && $cs_proyecto_list->StopRec == 0) {
	$cs_proyecto_list->StopRec = $cs_proyecto->GridAddRowCount;
}

// Initialize aggregate
$cs_proyecto->RowType = EW_ROWTYPE_AGGREGATEINIT;
$cs_proyecto->ResetAttrs();
$cs_proyecto_list->RenderRow();
while ($cs_proyecto_list->RecCnt < $cs_proyecto_list->StopRec) {
	$cs_proyecto_list->RecCnt++;
	if (intval($cs_proyecto_list->RecCnt) >= intval($cs_proyecto_list->StartRec)) {
		$cs_proyecto_list->RowCnt++;

		// Set up key count
		$cs_proyecto_list->KeyCount = $cs_proyecto_list->RowIndex;

		// Init row class and style
		$cs_proyecto->ResetAttrs();
		$cs_proyecto->CssClass = "";
		if ($cs_proyecto->CurrentAction == "gridadd") {
		} else {
			$cs_proyecto_list->LoadRowValues($cs_proyecto_list->Recordset); // Load row values
		}
		$cs_proyecto->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cs_proyecto->RowAttrs = array_merge($cs_proyecto->RowAttrs, array('data-rowindex'=>$cs_proyecto_list->RowCnt, 'id'=>'r' . $cs_proyecto_list->RowCnt . '_cs_proyecto', 'data-rowtype'=>$cs_proyecto->RowType));

		// Render row
		$cs_proyecto_list->RenderRow();

		// Render list options
		$cs_proyecto_list->RenderListOptions();
?>
	<tr<?php echo $cs_proyecto->RowAttributes() ?>>
<?php

// Render list options (body, left)
$cs_proyecto_list->ListOptions->Render("body", "left", $cs_proyecto_list->RowCnt);
?>
	<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
		<td data-name="idProyecto"<?php echo $cs_proyecto->idProyecto->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idProyecto" class="cs_proyecto_idProyecto">
<span<?php echo $cs_proyecto->idProyecto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProyecto->ListViewValue() ?></span>
</span>
<a id="<?php echo $cs_proyecto_list->PageObjName . "_row_" . $cs_proyecto_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
		<td data-name="idPrograma"<?php echo $cs_proyecto->idPrograma->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idPrograma" class="cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<?php echo $cs_proyecto->idPrograma->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
		<td data-name="codigo"<?php echo $cs_proyecto->codigo->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_codigo" class="cs_proyecto_codigo">
<span<?php echo $cs_proyecto->codigo->ViewAttributes() ?>>
<?php echo $cs_proyecto->codigo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
		<td data-name="idUbicacion"<?php echo $cs_proyecto->idUbicacion->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idUbicacion" class="cs_proyecto_idUbicacion">
<span<?php echo $cs_proyecto->idUbicacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idUbicacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
		<td data-name="idRegion"<?php echo $cs_proyecto->idRegion->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idRegion" class="cs_proyecto_idRegion">
<span<?php echo $cs_proyecto->idRegion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRegion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
		<td data-name="idDepto"<?php echo $cs_proyecto->idDepto->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idDepto" class="cs_proyecto_idDepto">
<span<?php echo $cs_proyecto->idDepto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idDepto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
		<td data-name="idTramo"<?php echo $cs_proyecto->idTramo->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idTramo" class="cs_proyecto_idTramo">
<span<?php echo $cs_proyecto->idTramo->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTramo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
		<td data-name="idRuta"<?php echo $cs_proyecto->idRuta->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idRuta" class="cs_proyecto_idRuta">
<span<?php echo $cs_proyecto->idRuta->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRuta->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
		<td data-name="idTipoRed"<?php echo $cs_proyecto->idTipoRed->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idTipoRed" class="cs_proyecto_idTipoRed">
<span<?php echo $cs_proyecto->idTipoRed->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTipoRed->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
		<td data-name="idProposito"<?php echo $cs_proyecto->idProposito->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idProposito" class="cs_proyecto_idProposito">
<span<?php echo $cs_proyecto->idProposito->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProposito->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
		<td data-name="presupuesto"<?php echo $cs_proyecto->presupuesto->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_presupuesto" class="cs_proyecto_presupuesto">
<span<?php echo $cs_proyecto->presupuesto->ViewAttributes() ?>>
<?php echo $cs_proyecto->presupuesto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
		<td data-name="especiplano"<?php echo $cs_proyecto->especiplano->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_especiplano" class="cs_proyecto_especiplano">
<span<?php echo $cs_proyecto->especiplano->ViewAttributes() ?>>
<?php echo $cs_proyecto->especiplano->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
		<td data-name="presuprogra"<?php echo $cs_proyecto->presuprogra->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_presuprogra" class="cs_proyecto_presuprogra">
<span<?php echo $cs_proyecto->presuprogra->ViewAttributes() ?>>
<?php echo $cs_proyecto->presuprogra->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
		<td data-name="estudiofact"<?php echo $cs_proyecto->estudiofact->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_estudiofact" class="cs_proyecto_estudiofact">
<span<?php echo $cs_proyecto->estudiofact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudiofact->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
		<td data-name="estudioimpact"<?php echo $cs_proyecto->estudioimpact->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_estudioimpact" class="cs_proyecto_estudioimpact">
<span<?php echo $cs_proyecto->estudioimpact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudioimpact->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
		<td data-name="licambi"<?php echo $cs_proyecto->licambi->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_licambi" class="cs_proyecto_licambi">
<span<?php echo $cs_proyecto->licambi->ViewAttributes() ?>>
<?php echo $cs_proyecto->licambi->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
		<td data-name="estuimpactierra"<?php echo $cs_proyecto->estuimpactierra->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_estuimpactierra" class="cs_proyecto_estuimpactierra">
<span<?php echo $cs_proyecto->estuimpactierra->ViewAttributes() ?>>
<?php echo $cs_proyecto->estuimpactierra->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
		<td data-name="planreasea"<?php echo $cs_proyecto->planreasea->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_planreasea" class="cs_proyecto_planreasea">
<span<?php echo $cs_proyecto->planreasea->ViewAttributes() ?>>
<?php echo $cs_proyecto->planreasea->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
		<td data-name="plananual"<?php echo $cs_proyecto->plananual->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_plananual" class="cs_proyecto_plananual">
<span<?php echo $cs_proyecto->plananual->ViewAttributes() ?>>
<?php echo $cs_proyecto->plananual->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
		<td data-name="acuerdofinan"<?php echo $cs_proyecto->acuerdofinan->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_acuerdofinan" class="cs_proyecto_acuerdofinan">
<span<?php echo $cs_proyecto->acuerdofinan->ViewAttributes() ?>>
<?php echo $cs_proyecto->acuerdofinan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->otro->Visible) { // otro ?>
		<td data-name="otro"<?php echo $cs_proyecto->otro->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_otro" class="cs_proyecto_otro">
<span<?php echo $cs_proyecto->otro->ViewAttributes() ?>>
<?php echo $cs_proyecto->otro->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
		<td data-name="fechacreacion"<?php echo $cs_proyecto->fechacreacion->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_fechacreacion" class="cs_proyecto_fechacreacion">
<span<?php echo $cs_proyecto->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechacreacion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $cs_proyecto->estado->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_estado" class="cs_proyecto_estado">
<span<?php echo $cs_proyecto->estado->ViewAttributes() ?>>
<?php echo $cs_proyecto->estado->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
		<td data-name="idFuncionario"<?php echo $cs_proyecto->idFuncionario->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idFuncionario" class="cs_proyecto_idFuncionario">
<span<?php echo $cs_proyecto->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_proyecto->idFuncionario->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
		<td data-name="fechaaprob"<?php echo $cs_proyecto->fechaaprob->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_fechaaprob" class="cs_proyecto_fechaaprob">
<span<?php echo $cs_proyecto->fechaaprob->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechaaprob->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
		<td data-name="idfuente"<?php echo $cs_proyecto->idfuente->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idfuente" class="cs_proyecto_idfuente">
<span<?php echo $cs_proyecto->idfuente->ViewAttributes() ?>>
<?php echo $cs_proyecto->idfuente->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
		<td data-name="codsefin"<?php echo $cs_proyecto->codsefin->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_codsefin" class="cs_proyecto_codsefin">
<span<?php echo $cs_proyecto->codsefin->ViewAttributes() ?>>
<?php echo $cs_proyecto->codsefin->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
		<td data-name="notaprioridad"<?php echo $cs_proyecto->notaprioridad->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_notaprioridad" class="cs_proyecto_notaprioridad">
<span<?php echo $cs_proyecto->notaprioridad->ViewAttributes() ?>>
<?php echo $cs_proyecto->notaprioridad->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
		<td data-name="constanciabanco"<?php echo $cs_proyecto->constanciabanco->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_constanciabanco" class="cs_proyecto_constanciabanco">
<span<?php echo $cs_proyecto->constanciabanco->ViewAttributes() ?>>
<?php echo $cs_proyecto->constanciabanco->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
		<td data-name="fecharecibido"<?php echo $cs_proyecto->fecharecibido->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_fecharecibido" class="cs_proyecto_fecharecibido">
<span<?php echo $cs_proyecto->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_proyecto->fecharecibido->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->clase->Visible) { // clase ?>
		<td data-name="clase"<?php echo $cs_proyecto->clase->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_clase" class="cs_proyecto_clase">
<span<?php echo $cs_proyecto->clase->ViewAttributes() ?>>
<?php echo $cs_proyecto->clase->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->entes->Visible) { // entes ?>
		<td data-name="entes"<?php echo $cs_proyecto->entes->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_entes" class="cs_proyecto_entes">
<span<?php echo $cs_proyecto->entes->ViewAttributes() ?>>
<?php echo $cs_proyecto->entes->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
		<td data-name="idRol"<?php echo $cs_proyecto->idRol->CellAttributes() ?>>
<span id="el<?php echo $cs_proyecto_list->RowCnt ?>_cs_proyecto_idRol" class="cs_proyecto_idRol">
<span<?php echo $cs_proyecto->idRol->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRol->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cs_proyecto_list->ListOptions->Render("body", "right", $cs_proyecto_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($cs_proyecto->CurrentAction <> "gridadd")
		$cs_proyecto_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($cs_proyecto->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($cs_proyecto_list->Recordset)
	$cs_proyecto_list->Recordset->Close();
?>
<?php if ($cs_proyecto->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($cs_proyecto->CurrentAction <> "gridadd" && $cs_proyecto->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($cs_proyecto_list->Pager)) $cs_proyecto_list->Pager = new cPrevNextPager($cs_proyecto_list->StartRec, $cs_proyecto_list->DisplayRecs, $cs_proyecto_list->TotalRecs) ?>
<?php if ($cs_proyecto_list->Pager->RecordCount > 0) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($cs_proyecto_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $cs_proyecto_list->PageUrl() ?>start=<?php echo $cs_proyecto_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($cs_proyecto_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $cs_proyecto_list->PageUrl() ?>start=<?php echo $cs_proyecto_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $cs_proyecto_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($cs_proyecto_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $cs_proyecto_list->PageUrl() ?>start=<?php echo $cs_proyecto_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($cs_proyecto_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $cs_proyecto_list->PageUrl() ?>start=<?php echo $cs_proyecto_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cs_proyecto_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cs_proyecto_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cs_proyecto_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cs_proyecto_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_proyecto_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($cs_proyecto_list->TotalRecs == 0 && $cs_proyecto->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($cs_proyecto_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($cs_proyecto->Export == "") { ?>
<script type="text/javascript">
fcs_proyectolistsrch.Init();
fcs_proyectolistsrch.FilterList = <?php echo $cs_proyecto_list->GetFilterList() ?>;
fcs_proyectolist.Init();
</script>
<?php } ?>
<?php
$cs_proyecto_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($cs_proyecto->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cs_proyecto_list->Page_Terminate();
?>
