<?php include_once "cs_adjudicacioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php

//
// Page class
//

$cs_adjudicacion_grid = NULL; // Initialize page object first

class ccs_adjudicacion_grid extends ccs_adjudicacion {

	// Page ID
	var $PageID = 'grid';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_adjudicacion';

	// Page object name
	var $PageObjName = 'cs_adjudicacion_grid';

	// Grid form hidden field names
	var $FormName = 'fcs_adjudicaciongrid';
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
		$this->FormActionName .= '_' . $this->FormName;
		$this->FormKeyName .= '_' . $this->FormName;
		$this->FormOldKeyName .= '_' . $this->FormName;
		$this->FormBlankRowName .= '_' . $this->FormName;
		$this->FormKeyCountName .= '_' . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (cs_adjudicacion)
		if (!isset($GLOBALS["cs_adjudicacion"]) || get_class($GLOBALS["cs_adjudicacion"]) == "ccs_adjudicacion") {
			$GLOBALS["cs_adjudicacion"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["cs_adjudicacion"];

		}

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'cs_adjudicacion', TRUE);

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

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->idAdjudicacion->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();

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

			// Process auto fill for detail table 'cs_contratacion'
			if (@$_POST["grid"] == "fcs_contrataciongrid") {
				if (!isset($GLOBALS["cs_contratacion_grid"])) $GLOBALS["cs_contratacion_grid"] = new ccs_contratacion_grid;
				$GLOBALS["cs_contratacion_grid"]->Page_Init();
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
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Export
		global $EW_EXPORT, $cs_adjudicacion;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cs_adjudicacion);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url == "")
			return;
		$this->Page_Redirecting($url);

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
	var $ShowOtherOptions = FALSE;
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

			// Handle reset command
			$this->ResetCmd();

			// Set up master detail parameters
			$this->SetUpMasterParms();

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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_calificacion") {
			global $cs_calificacion;
			$rsmaster = $cs_calificacion->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cs_calificacionlist.php"); // Return to master page
			} else {
				$cs_calificacion->LoadListRowValues($rsmaster);
				$cs_calificacion->RowType = EW_ROWTYPE_MASTER; // Master row
				$cs_calificacion->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

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
	}

	//  Exit inline mode
	function ClearInlineMode() {
		$this->costoesti->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
	}

	// Switch to Grid Edit mode
	function GridEditMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridedit"; // Enable grid edit
	}

	// Perform update to grid
	function GridUpdate() {
		global $Language, $objForm, $gsFormError;
		$bGridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->BuildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			$rsold = $rs->GetRows();
			$rs->Close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		$sKey = "";

		// Update row index and get row key
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$objForm->Index = $rowindex;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			$rowaction = strval($objForm->GetValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction <> "insertdelete") { // Skip insert then deleted rows
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$bGridUpdate = $this->SetupKeyValues($rowkey); // Set up key values
				} else {
					$bGridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($bGridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->KeyFilter();
						$bGridUpdate = $this->DeleteRows(); // Delete this row
					} else if (!$this->ValidateForm()) {
						$bGridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($gsFormError);
					} else {
						if ($rowaction == "insert") {
							$bGridUpdate = $this->AddRow(); // Insert this row
						} else {
							if ($rowkey <> "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$bGridUpdate = $this->EditRow(); // Update this row
							}
						} // End update
					}
				}
				if ($bGridUpdate) {
					if ($sKey <> "") $sKey .= ", ";
					$sKey .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($bGridUpdate) {

			// Get new recordset
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
		}
		return $bGridUpdate;
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
			$this->idAdjudicacion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idAdjudicacion->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($objForm->GetValue($this->FormOldKeyName));
				$this->LoadOldRecord(); // Load old recordset
			}
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->idAdjudicacion->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->ClearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($bGridInsert) {

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_idCalificacion") && $objForm->HasValue("o_idCalificacion") && $this->idCalificacion->CurrentValue <> $this->idCalificacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_numproceso") && $objForm->HasValue("o_numproceso") && $this->numproceso->CurrentValue <> $this->numproceso->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_nconsulnac") && $objForm->HasValue("o_nconsulnac") && $this->nconsulnac->CurrentValue <> $this->nconsulnac->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_nconsulinter") && $objForm->HasValue("o_nconsulinter") && $this->nconsulinter->CurrentValue <> $this->nconsulinter->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_costoesti") && $objForm->HasValue("o_costoesti") && $this->costoesti->CurrentValue <> $this->costoesti->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estadoproceso") && $objForm->HasValue("o_estadoproceso") && $this->estadoproceso->CurrentValue <> $this->estadoproceso->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_actaaper") && $objForm->HasValue("o_actaaper") && $this->actaaper->CurrentValue <> $this->actaaper->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_informeacta") && $objForm->HasValue("o_informeacta") && $this->informeacta->CurrentValue <> $this->informeacta->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_resoladju") && $objForm->HasValue("o_resoladju") && $this->resoladju->CurrentValue <> $this->resoladju->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado") && $objForm->HasValue("o_estado") && $this->estado->CurrentValue <> $this->estado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_otro") && $objForm->HasValue("o_otro") && $this->otro->CurrentValue <> $this->otro->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_numfirmasnac") && $objForm->HasValue("o_numfirmasnac") && $this->numfirmasnac->CurrentValue <> $this->numfirmasnac->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_numfimasinter") && $objForm->HasValue("o_numfimasinter") && $this->numfimasinter->CurrentValue <> $this->numfimasinter->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_numconsulcorta") && $objForm->HasValue("o_numconsulcorta") && $this->numconsulcorta->CurrentValue <> $this->numconsulcorta->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecharecibido") && $objForm->HasValue("o_fecharecibido") && $this->fecharecibido->CurrentValue <> $this->fecharecibido->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechacreacion") && $objForm->HasValue("o_fechacreacion") && $this->fechacreacion->CurrentValue <> $this->fechacreacion->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->idCalificacion->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssStyle = "white-space: nowrap;";
			$item->OnLeft = FALSE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($objForm->HasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($objForm->GetValue($this->FormOldKeyName));
			if ($this->RowOldKey <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $OldKeyName . "\" id=\"" . $OldKeyName . "\" value=\"" . ew_HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex)) {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->idAdjudicacion->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('idAdjudicacion');
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$option = &$this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;
		$option->ButtonClass = "btn-sm"; // Class for button group
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && $this->CurrentAction != "F") { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = &$options["addedit"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;
				$item = &$option->Add("addblankrow");
				$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
				$item->Visible = FALSE;
				$this->ShowOtherOptions = $item->Visible;
			}
		}
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->idAdjudicacion->CurrentValue = NULL;
		$this->idAdjudicacion->OldValue = $this->idAdjudicacion->CurrentValue;
		$this->idCalificacion->CurrentValue = NULL;
		$this->idCalificacion->OldValue = $this->idCalificacion->CurrentValue;
		$this->numproceso->CurrentValue = NULL;
		$this->numproceso->OldValue = $this->numproceso->CurrentValue;
		$this->nconsulnac->CurrentValue = NULL;
		$this->nconsulnac->OldValue = $this->nconsulnac->CurrentValue;
		$this->nconsulinter->CurrentValue = NULL;
		$this->nconsulinter->OldValue = $this->nconsulinter->CurrentValue;
		$this->costoesti->CurrentValue = NULL;
		$this->costoesti->OldValue = $this->costoesti->CurrentValue;
		$this->estadoproceso->CurrentValue = NULL;
		$this->estadoproceso->OldValue = $this->estadoproceso->CurrentValue;
		$this->actaaper->CurrentValue = NULL;
		$this->actaaper->OldValue = $this->actaaper->CurrentValue;
		$this->informeacta->CurrentValue = NULL;
		$this->informeacta->OldValue = $this->informeacta->CurrentValue;
		$this->resoladju->CurrentValue = NULL;
		$this->resoladju->OldValue = $this->resoladju->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->otro->CurrentValue = NULL;
		$this->otro->OldValue = $this->otro->CurrentValue;
		$this->numfirmasnac->CurrentValue = NULL;
		$this->numfirmasnac->OldValue = $this->numfirmasnac->CurrentValue;
		$this->numfimasinter->CurrentValue = NULL;
		$this->numfimasinter->OldValue = $this->numfimasinter->CurrentValue;
		$this->numconsulcorta->CurrentValue = NULL;
		$this->numconsulcorta->OldValue = $this->numconsulcorta->CurrentValue;
		$this->fecharecibido->CurrentValue = NULL;
		$this->fecharecibido->OldValue = $this->fecharecibido->CurrentValue;
		$this->fechacreacion->CurrentValue = NULL;
		$this->fechacreacion->OldValue = $this->fechacreacion->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$objForm->FormName = $this->FormName;
		if (!$this->idAdjudicacion->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idAdjudicacion->setFormValue($objForm->GetValue("x_idAdjudicacion"));
		if (!$this->idCalificacion->FldIsDetailKey) {
			$this->idCalificacion->setFormValue($objForm->GetValue("x_idCalificacion"));
		}
		$this->idCalificacion->setOldValue($objForm->GetValue("o_idCalificacion"));
		if (!$this->numproceso->FldIsDetailKey) {
			$this->numproceso->setFormValue($objForm->GetValue("x_numproceso"));
		}
		$this->numproceso->setOldValue($objForm->GetValue("o_numproceso"));
		if (!$this->nconsulnac->FldIsDetailKey) {
			$this->nconsulnac->setFormValue($objForm->GetValue("x_nconsulnac"));
		}
		$this->nconsulnac->setOldValue($objForm->GetValue("o_nconsulnac"));
		if (!$this->nconsulinter->FldIsDetailKey) {
			$this->nconsulinter->setFormValue($objForm->GetValue("x_nconsulinter"));
		}
		$this->nconsulinter->setOldValue($objForm->GetValue("o_nconsulinter"));
		if (!$this->costoesti->FldIsDetailKey) {
			$this->costoesti->setFormValue($objForm->GetValue("x_costoesti"));
		}
		$this->costoesti->setOldValue($objForm->GetValue("o_costoesti"));
		if (!$this->estadoproceso->FldIsDetailKey) {
			$this->estadoproceso->setFormValue($objForm->GetValue("x_estadoproceso"));
		}
		$this->estadoproceso->setOldValue($objForm->GetValue("o_estadoproceso"));
		if (!$this->actaaper->FldIsDetailKey) {
			$this->actaaper->setFormValue($objForm->GetValue("x_actaaper"));
		}
		$this->actaaper->setOldValue($objForm->GetValue("o_actaaper"));
		if (!$this->informeacta->FldIsDetailKey) {
			$this->informeacta->setFormValue($objForm->GetValue("x_informeacta"));
		}
		$this->informeacta->setOldValue($objForm->GetValue("o_informeacta"));
		if (!$this->resoladju->FldIsDetailKey) {
			$this->resoladju->setFormValue($objForm->GetValue("x_resoladju"));
		}
		$this->resoladju->setOldValue($objForm->GetValue("o_resoladju"));
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$this->estado->setOldValue($objForm->GetValue("o_estado"));
		if (!$this->otro->FldIsDetailKey) {
			$this->otro->setFormValue($objForm->GetValue("x_otro"));
		}
		$this->otro->setOldValue($objForm->GetValue("o_otro"));
		if (!$this->numfirmasnac->FldIsDetailKey) {
			$this->numfirmasnac->setFormValue($objForm->GetValue("x_numfirmasnac"));
		}
		$this->numfirmasnac->setOldValue($objForm->GetValue("o_numfirmasnac"));
		if (!$this->numfimasinter->FldIsDetailKey) {
			$this->numfimasinter->setFormValue($objForm->GetValue("x_numfimasinter"));
		}
		$this->numfimasinter->setOldValue($objForm->GetValue("o_numfimasinter"));
		if (!$this->numconsulcorta->FldIsDetailKey) {
			$this->numconsulcorta->setFormValue($objForm->GetValue("x_numconsulcorta"));
		}
		$this->numconsulcorta->setOldValue($objForm->GetValue("o_numconsulcorta"));
		if (!$this->fecharecibido->FldIsDetailKey) {
			$this->fecharecibido->setFormValue($objForm->GetValue("x_fecharecibido"));
		}
		$this->fecharecibido->setOldValue($objForm->GetValue("o_fecharecibido"));
		if (!$this->fechacreacion->FldIsDetailKey) {
			$this->fechacreacion->setFormValue($objForm->GetValue("x_fechacreacion"));
		}
		$this->fechacreacion->setOldValue($objForm->GetValue("o_fechacreacion"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idAdjudicacion->CurrentValue = $this->idAdjudicacion->FormValue;
		$this->idCalificacion->CurrentValue = $this->idCalificacion->FormValue;
		$this->numproceso->CurrentValue = $this->numproceso->FormValue;
		$this->nconsulnac->CurrentValue = $this->nconsulnac->FormValue;
		$this->nconsulinter->CurrentValue = $this->nconsulinter->FormValue;
		$this->costoesti->CurrentValue = $this->costoesti->FormValue;
		$this->estadoproceso->CurrentValue = $this->estadoproceso->FormValue;
		$this->actaaper->CurrentValue = $this->actaaper->FormValue;
		$this->informeacta->CurrentValue = $this->informeacta->FormValue;
		$this->resoladju->CurrentValue = $this->resoladju->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->otro->CurrentValue = $this->otro->FormValue;
		$this->numfirmasnac->CurrentValue = $this->numfirmasnac->FormValue;
		$this->numfimasinter->CurrentValue = $this->numfimasinter->FormValue;
		$this->numconsulcorta->CurrentValue = $this->numconsulcorta->FormValue;
		$this->fecharecibido->CurrentValue = $this->fecharecibido->FormValue;
		$this->fechacreacion->CurrentValue = $this->fechacreacion->FormValue;
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
		$this->idAdjudicacion->setDbValue($rs->fields('idAdjudicacion'));
		$this->idCalificacion->setDbValue($rs->fields('idCalificacion'));
		$this->numproceso->setDbValue($rs->fields('numproceso'));
		$this->nomprocesoproyecto->setDbValue($rs->fields('nomprocesoproyecto'));
		$this->nconsulnac->setDbValue($rs->fields('nconsulnac'));
		$this->nconsulinter->setDbValue($rs->fields('nconsulinter'));
		$this->costoesti->setDbValue($rs->fields('costoesti'));
		$this->estadoproceso->setDbValue($rs->fields('estadoproceso'));
		$this->actaaper->setDbValue($rs->fields('actaaper'));
		$this->informeacta->setDbValue($rs->fields('informeacta'));
		$this->resoladju->setDbValue($rs->fields('resoladju'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->otro->setDbValue($rs->fields('otro'));
		$this->numfirmasnac->setDbValue($rs->fields('numfirmasnac'));
		$this->numfimasinter->setDbValue($rs->fields('numfimasinter'));
		$this->numconsulcorta->setDbValue($rs->fields('numconsulcorta'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->fechacreacion->setDbValue($rs->fields('fechacreacion'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idAdjudicacion->DbValue = $row['idAdjudicacion'];
		$this->idCalificacion->DbValue = $row['idCalificacion'];
		$this->numproceso->DbValue = $row['numproceso'];
		$this->nomprocesoproyecto->DbValue = $row['nomprocesoproyecto'];
		$this->nconsulnac->DbValue = $row['nconsulnac'];
		$this->nconsulinter->DbValue = $row['nconsulinter'];
		$this->costoesti->DbValue = $row['costoesti'];
		$this->estadoproceso->DbValue = $row['estadoproceso'];
		$this->actaaper->DbValue = $row['actaaper'];
		$this->informeacta->DbValue = $row['informeacta'];
		$this->resoladju->DbValue = $row['resoladju'];
		$this->estado->DbValue = $row['estado'];
		$this->otro->DbValue = $row['otro'];
		$this->numfirmasnac->DbValue = $row['numfirmasnac'];
		$this->numfimasinter->DbValue = $row['numfimasinter'];
		$this->numconsulcorta->DbValue = $row['numconsulcorta'];
		$this->fecharecibido->DbValue = $row['fecharecibido'];
		$this->fechacreacion->DbValue = $row['fechacreacion'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->idAdjudicacion->CurrentValue = strval($arKeys[0]); // idAdjudicacion
			else
				$bValidKey = FALSE;
		} else {
			$bValidKey = FALSE;
		}

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
		// Convert decimal values if posted back

		if ($this->costoesti->FormValue == $this->costoesti->CurrentValue && is_numeric(ew_StrToFloat($this->costoesti->CurrentValue)))
			$this->costoesti->CurrentValue = ew_StrToFloat($this->costoesti->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// idAdjudicacion
		// idCalificacion
		// numproceso
		// nomprocesoproyecto
		// nconsulnac
		// nconsulinter
		// costoesti
		// estadoproceso
		// actaaper
		// informeacta
		// resoladju
		// estado
		// otro
		// numfirmasnac
		// numfimasinter
		// numconsulcorta
		// fecharecibido
		// fechacreacion

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// idAdjudicacion
		$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
		$this->idAdjudicacion->ViewCustomAttributes = "";

		// idCalificacion
		$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
		$this->idCalificacion->ViewCustomAttributes = "";

		// numproceso
		$this->numproceso->ViewValue = $this->numproceso->CurrentValue;
		$this->numproceso->ViewCustomAttributes = "";

		// nconsulnac
		$this->nconsulnac->ViewValue = $this->nconsulnac->CurrentValue;
		$this->nconsulnac->ViewCustomAttributes = "";

		// nconsulinter
		$this->nconsulinter->ViewValue = $this->nconsulinter->CurrentValue;
		$this->nconsulinter->ViewCustomAttributes = "";

		// costoesti
		$this->costoesti->ViewValue = $this->costoesti->CurrentValue;
		$this->costoesti->ViewCustomAttributes = "";

		// estadoproceso
		$this->estadoproceso->ViewValue = $this->estadoproceso->CurrentValue;
		$this->estadoproceso->ViewCustomAttributes = "";

		// actaaper
		$this->actaaper->ViewValue = $this->actaaper->CurrentValue;
		$this->actaaper->ViewCustomAttributes = "";

		// informeacta
		$this->informeacta->ViewValue = $this->informeacta->CurrentValue;
		$this->informeacta->ViewCustomAttributes = "";

		// resoladju
		$this->resoladju->ViewValue = $this->resoladju->CurrentValue;
		$this->resoladju->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// otro
		$this->otro->ViewValue = $this->otro->CurrentValue;
		$this->otro->ViewCustomAttributes = "";

		// numfirmasnac
		$this->numfirmasnac->ViewValue = $this->numfirmasnac->CurrentValue;
		$this->numfirmasnac->ViewCustomAttributes = "";

		// numfimasinter
		$this->numfimasinter->ViewValue = $this->numfimasinter->CurrentValue;
		$this->numfimasinter->ViewCustomAttributes = "";

		// numconsulcorta
		$this->numconsulcorta->ViewValue = $this->numconsulcorta->CurrentValue;
		$this->numconsulcorta->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewCustomAttributes = "";

		// fechacreacion
		$this->fechacreacion->ViewValue = $this->fechacreacion->CurrentValue;
		$this->fechacreacion->ViewCustomAttributes = "";

			// idAdjudicacion
			$this->idAdjudicacion->LinkCustomAttributes = "";
			$this->idAdjudicacion->HrefValue = "";
			$this->idAdjudicacion->TooltipValue = "";

			// idCalificacion
			$this->idCalificacion->LinkCustomAttributes = "";
			$this->idCalificacion->HrefValue = "";
			$this->idCalificacion->TooltipValue = "";

			// numproceso
			$this->numproceso->LinkCustomAttributes = "";
			$this->numproceso->HrefValue = "";
			$this->numproceso->TooltipValue = "";

			// nconsulnac
			$this->nconsulnac->LinkCustomAttributes = "";
			$this->nconsulnac->HrefValue = "";
			$this->nconsulnac->TooltipValue = "";

			// nconsulinter
			$this->nconsulinter->LinkCustomAttributes = "";
			$this->nconsulinter->HrefValue = "";
			$this->nconsulinter->TooltipValue = "";

			// costoesti
			$this->costoesti->LinkCustomAttributes = "";
			$this->costoesti->HrefValue = "";
			$this->costoesti->TooltipValue = "";

			// estadoproceso
			$this->estadoproceso->LinkCustomAttributes = "";
			$this->estadoproceso->HrefValue = "";
			$this->estadoproceso->TooltipValue = "";

			// actaaper
			$this->actaaper->LinkCustomAttributes = "";
			$this->actaaper->HrefValue = "";
			$this->actaaper->TooltipValue = "";

			// informeacta
			$this->informeacta->LinkCustomAttributes = "";
			$this->informeacta->HrefValue = "";
			$this->informeacta->TooltipValue = "";

			// resoladju
			$this->resoladju->LinkCustomAttributes = "";
			$this->resoladju->HrefValue = "";
			$this->resoladju->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// otro
			$this->otro->LinkCustomAttributes = "";
			$this->otro->HrefValue = "";
			$this->otro->TooltipValue = "";

			// numfirmasnac
			$this->numfirmasnac->LinkCustomAttributes = "";
			$this->numfirmasnac->HrefValue = "";
			$this->numfirmasnac->TooltipValue = "";

			// numfimasinter
			$this->numfimasinter->LinkCustomAttributes = "";
			$this->numfimasinter->HrefValue = "";
			$this->numfimasinter->TooltipValue = "";

			// numconsulcorta
			$this->numconsulcorta->LinkCustomAttributes = "";
			$this->numconsulcorta->HrefValue = "";
			$this->numconsulcorta->TooltipValue = "";

			// fecharecibido
			$this->fecharecibido->LinkCustomAttributes = "";
			$this->fecharecibido->HrefValue = "";
			$this->fecharecibido->TooltipValue = "";

			// fechacreacion
			$this->fechacreacion->LinkCustomAttributes = "";
			$this->fechacreacion->HrefValue = "";
			$this->fechacreacion->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// idAdjudicacion
			// idCalificacion

			$this->idCalificacion->EditAttrs["class"] = "form-control";
			$this->idCalificacion->EditCustomAttributes = "";
			if ($this->idCalificacion->getSessionValue() <> "") {
				$this->idCalificacion->CurrentValue = $this->idCalificacion->getSessionValue();
				$this->idCalificacion->OldValue = $this->idCalificacion->CurrentValue;
			$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
			$this->idCalificacion->ViewCustomAttributes = "";
			} else {
			$this->idCalificacion->EditValue = ew_HtmlEncode($this->idCalificacion->CurrentValue);
			$this->idCalificacion->PlaceHolder = ew_RemoveHtml($this->idCalificacion->FldCaption());
			}

			// numproceso
			$this->numproceso->EditAttrs["class"] = "form-control";
			$this->numproceso->EditCustomAttributes = "";
			$this->numproceso->EditValue = ew_HtmlEncode($this->numproceso->CurrentValue);
			$this->numproceso->PlaceHolder = ew_RemoveHtml($this->numproceso->FldCaption());

			// nconsulnac
			$this->nconsulnac->EditAttrs["class"] = "form-control";
			$this->nconsulnac->EditCustomAttributes = "";
			$this->nconsulnac->EditValue = ew_HtmlEncode($this->nconsulnac->CurrentValue);
			$this->nconsulnac->PlaceHolder = ew_RemoveHtml($this->nconsulnac->FldCaption());

			// nconsulinter
			$this->nconsulinter->EditAttrs["class"] = "form-control";
			$this->nconsulinter->EditCustomAttributes = "";
			$this->nconsulinter->EditValue = ew_HtmlEncode($this->nconsulinter->CurrentValue);
			$this->nconsulinter->PlaceHolder = ew_RemoveHtml($this->nconsulinter->FldCaption());

			// costoesti
			$this->costoesti->EditAttrs["class"] = "form-control";
			$this->costoesti->EditCustomAttributes = "";
			$this->costoesti->EditValue = ew_HtmlEncode($this->costoesti->CurrentValue);
			$this->costoesti->PlaceHolder = ew_RemoveHtml($this->costoesti->FldCaption());
			if (strval($this->costoesti->EditValue) <> "" && is_numeric($this->costoesti->EditValue)) {
			$this->costoesti->EditValue = ew_FormatNumber($this->costoesti->EditValue, -2, -1, -2, 0);
			$this->costoesti->OldValue = $this->costoesti->EditValue;
			}

			// estadoproceso
			$this->estadoproceso->EditAttrs["class"] = "form-control";
			$this->estadoproceso->EditCustomAttributes = "";
			$this->estadoproceso->EditValue = ew_HtmlEncode($this->estadoproceso->CurrentValue);
			$this->estadoproceso->PlaceHolder = ew_RemoveHtml($this->estadoproceso->FldCaption());

			// actaaper
			$this->actaaper->EditAttrs["class"] = "form-control";
			$this->actaaper->EditCustomAttributes = "";
			$this->actaaper->EditValue = ew_HtmlEncode($this->actaaper->CurrentValue);
			$this->actaaper->PlaceHolder = ew_RemoveHtml($this->actaaper->FldCaption());

			// informeacta
			$this->informeacta->EditAttrs["class"] = "form-control";
			$this->informeacta->EditCustomAttributes = "";
			$this->informeacta->EditValue = ew_HtmlEncode($this->informeacta->CurrentValue);
			$this->informeacta->PlaceHolder = ew_RemoveHtml($this->informeacta->FldCaption());

			// resoladju
			$this->resoladju->EditAttrs["class"] = "form-control";
			$this->resoladju->EditCustomAttributes = "";
			$this->resoladju->EditValue = ew_HtmlEncode($this->resoladju->CurrentValue);
			$this->resoladju->PlaceHolder = ew_RemoveHtml($this->resoladju->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// otro
			$this->otro->EditAttrs["class"] = "form-control";
			$this->otro->EditCustomAttributes = "";
			$this->otro->EditValue = ew_HtmlEncode($this->otro->CurrentValue);
			$this->otro->PlaceHolder = ew_RemoveHtml($this->otro->FldCaption());

			// numfirmasnac
			$this->numfirmasnac->EditAttrs["class"] = "form-control";
			$this->numfirmasnac->EditCustomAttributes = "";
			$this->numfirmasnac->EditValue = ew_HtmlEncode($this->numfirmasnac->CurrentValue);
			$this->numfirmasnac->PlaceHolder = ew_RemoveHtml($this->numfirmasnac->FldCaption());

			// numfimasinter
			$this->numfimasinter->EditAttrs["class"] = "form-control";
			$this->numfimasinter->EditCustomAttributes = "";
			$this->numfimasinter->EditValue = ew_HtmlEncode($this->numfimasinter->CurrentValue);
			$this->numfimasinter->PlaceHolder = ew_RemoveHtml($this->numfimasinter->FldCaption());

			// numconsulcorta
			$this->numconsulcorta->EditAttrs["class"] = "form-control";
			$this->numconsulcorta->EditCustomAttributes = "";
			$this->numconsulcorta->EditValue = ew_HtmlEncode($this->numconsulcorta->CurrentValue);
			$this->numconsulcorta->PlaceHolder = ew_RemoveHtml($this->numconsulcorta->FldCaption());

			// fecharecibido
			$this->fecharecibido->EditAttrs["class"] = "form-control";
			$this->fecharecibido->EditCustomAttributes = "";
			$this->fecharecibido->EditValue = ew_HtmlEncode($this->fecharecibido->CurrentValue);
			$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

			// fechacreacion
			$this->fechacreacion->EditAttrs["class"] = "form-control";
			$this->fechacreacion->EditCustomAttributes = "";
			$this->fechacreacion->EditValue = ew_HtmlEncode($this->fechacreacion->CurrentValue);
			$this->fechacreacion->PlaceHolder = ew_RemoveHtml($this->fechacreacion->FldCaption());

			// Edit refer script
			// idAdjudicacion

			$this->idAdjudicacion->HrefValue = "";

			// idCalificacion
			$this->idCalificacion->HrefValue = "";

			// numproceso
			$this->numproceso->HrefValue = "";

			// nconsulnac
			$this->nconsulnac->HrefValue = "";

			// nconsulinter
			$this->nconsulinter->HrefValue = "";

			// costoesti
			$this->costoesti->HrefValue = "";

			// estadoproceso
			$this->estadoproceso->HrefValue = "";

			// actaaper
			$this->actaaper->HrefValue = "";

			// informeacta
			$this->informeacta->HrefValue = "";

			// resoladju
			$this->resoladju->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// otro
			$this->otro->HrefValue = "";

			// numfirmasnac
			$this->numfirmasnac->HrefValue = "";

			// numfimasinter
			$this->numfimasinter->HrefValue = "";

			// numconsulcorta
			$this->numconsulcorta->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";

			// fechacreacion
			$this->fechacreacion->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idAdjudicacion
			$this->idAdjudicacion->EditAttrs["class"] = "form-control";
			$this->idAdjudicacion->EditCustomAttributes = "";
			$this->idAdjudicacion->EditValue = $this->idAdjudicacion->CurrentValue;
			$this->idAdjudicacion->ViewCustomAttributes = "";

			// idCalificacion
			$this->idCalificacion->EditAttrs["class"] = "form-control";
			$this->idCalificacion->EditCustomAttributes = "";
			if ($this->idCalificacion->getSessionValue() <> "") {
				$this->idCalificacion->CurrentValue = $this->idCalificacion->getSessionValue();
				$this->idCalificacion->OldValue = $this->idCalificacion->CurrentValue;
			$this->idCalificacion->ViewValue = $this->idCalificacion->CurrentValue;
			$this->idCalificacion->ViewCustomAttributes = "";
			} else {
			$this->idCalificacion->EditValue = ew_HtmlEncode($this->idCalificacion->CurrentValue);
			$this->idCalificacion->PlaceHolder = ew_RemoveHtml($this->idCalificacion->FldCaption());
			}

			// numproceso
			$this->numproceso->EditAttrs["class"] = "form-control";
			$this->numproceso->EditCustomAttributes = "";
			$this->numproceso->EditValue = ew_HtmlEncode($this->numproceso->CurrentValue);
			$this->numproceso->PlaceHolder = ew_RemoveHtml($this->numproceso->FldCaption());

			// nconsulnac
			$this->nconsulnac->EditAttrs["class"] = "form-control";
			$this->nconsulnac->EditCustomAttributes = "";
			$this->nconsulnac->EditValue = ew_HtmlEncode($this->nconsulnac->CurrentValue);
			$this->nconsulnac->PlaceHolder = ew_RemoveHtml($this->nconsulnac->FldCaption());

			// nconsulinter
			$this->nconsulinter->EditAttrs["class"] = "form-control";
			$this->nconsulinter->EditCustomAttributes = "";
			$this->nconsulinter->EditValue = ew_HtmlEncode($this->nconsulinter->CurrentValue);
			$this->nconsulinter->PlaceHolder = ew_RemoveHtml($this->nconsulinter->FldCaption());

			// costoesti
			$this->costoesti->EditAttrs["class"] = "form-control";
			$this->costoesti->EditCustomAttributes = "";
			$this->costoesti->EditValue = ew_HtmlEncode($this->costoesti->CurrentValue);
			$this->costoesti->PlaceHolder = ew_RemoveHtml($this->costoesti->FldCaption());
			if (strval($this->costoesti->EditValue) <> "" && is_numeric($this->costoesti->EditValue)) {
			$this->costoesti->EditValue = ew_FormatNumber($this->costoesti->EditValue, -2, -1, -2, 0);
			$this->costoesti->OldValue = $this->costoesti->EditValue;
			}

			// estadoproceso
			$this->estadoproceso->EditAttrs["class"] = "form-control";
			$this->estadoproceso->EditCustomAttributes = "";
			$this->estadoproceso->EditValue = ew_HtmlEncode($this->estadoproceso->CurrentValue);
			$this->estadoproceso->PlaceHolder = ew_RemoveHtml($this->estadoproceso->FldCaption());

			// actaaper
			$this->actaaper->EditAttrs["class"] = "form-control";
			$this->actaaper->EditCustomAttributes = "";
			$this->actaaper->EditValue = ew_HtmlEncode($this->actaaper->CurrentValue);
			$this->actaaper->PlaceHolder = ew_RemoveHtml($this->actaaper->FldCaption());

			// informeacta
			$this->informeacta->EditAttrs["class"] = "form-control";
			$this->informeacta->EditCustomAttributes = "";
			$this->informeacta->EditValue = ew_HtmlEncode($this->informeacta->CurrentValue);
			$this->informeacta->PlaceHolder = ew_RemoveHtml($this->informeacta->FldCaption());

			// resoladju
			$this->resoladju->EditAttrs["class"] = "form-control";
			$this->resoladju->EditCustomAttributes = "";
			$this->resoladju->EditValue = ew_HtmlEncode($this->resoladju->CurrentValue);
			$this->resoladju->PlaceHolder = ew_RemoveHtml($this->resoladju->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// otro
			$this->otro->EditAttrs["class"] = "form-control";
			$this->otro->EditCustomAttributes = "";
			$this->otro->EditValue = ew_HtmlEncode($this->otro->CurrentValue);
			$this->otro->PlaceHolder = ew_RemoveHtml($this->otro->FldCaption());

			// numfirmasnac
			$this->numfirmasnac->EditAttrs["class"] = "form-control";
			$this->numfirmasnac->EditCustomAttributes = "";
			$this->numfirmasnac->EditValue = ew_HtmlEncode($this->numfirmasnac->CurrentValue);
			$this->numfirmasnac->PlaceHolder = ew_RemoveHtml($this->numfirmasnac->FldCaption());

			// numfimasinter
			$this->numfimasinter->EditAttrs["class"] = "form-control";
			$this->numfimasinter->EditCustomAttributes = "";
			$this->numfimasinter->EditValue = ew_HtmlEncode($this->numfimasinter->CurrentValue);
			$this->numfimasinter->PlaceHolder = ew_RemoveHtml($this->numfimasinter->FldCaption());

			// numconsulcorta
			$this->numconsulcorta->EditAttrs["class"] = "form-control";
			$this->numconsulcorta->EditCustomAttributes = "";
			$this->numconsulcorta->EditValue = ew_HtmlEncode($this->numconsulcorta->CurrentValue);
			$this->numconsulcorta->PlaceHolder = ew_RemoveHtml($this->numconsulcorta->FldCaption());

			// fecharecibido
			$this->fecharecibido->EditAttrs["class"] = "form-control";
			$this->fecharecibido->EditCustomAttributes = "";
			$this->fecharecibido->EditValue = ew_HtmlEncode($this->fecharecibido->CurrentValue);
			$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

			// fechacreacion
			$this->fechacreacion->EditAttrs["class"] = "form-control";
			$this->fechacreacion->EditCustomAttributes = "";
			$this->fechacreacion->EditValue = ew_HtmlEncode($this->fechacreacion->CurrentValue);
			$this->fechacreacion->PlaceHolder = ew_RemoveHtml($this->fechacreacion->FldCaption());

			// Edit refer script
			// idAdjudicacion

			$this->idAdjudicacion->HrefValue = "";

			// idCalificacion
			$this->idCalificacion->HrefValue = "";

			// numproceso
			$this->numproceso->HrefValue = "";

			// nconsulnac
			$this->nconsulnac->HrefValue = "";

			// nconsulinter
			$this->nconsulinter->HrefValue = "";

			// costoesti
			$this->costoesti->HrefValue = "";

			// estadoproceso
			$this->estadoproceso->HrefValue = "";

			// actaaper
			$this->actaaper->HrefValue = "";

			// informeacta
			$this->informeacta->HrefValue = "";

			// resoladju
			$this->resoladju->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// otro
			$this->otro->HrefValue = "";

			// numfirmasnac
			$this->numfirmasnac->HrefValue = "";

			// numfimasinter
			$this->numfimasinter->HrefValue = "";

			// numconsulcorta
			$this->numconsulcorta->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";

			// fechacreacion
			$this->fechacreacion->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->idCalificacion->FldIsDetailKey && !is_null($this->idCalificacion->FormValue) && $this->idCalificacion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idCalificacion->FldCaption(), $this->idCalificacion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idCalificacion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idCalificacion->FldErrMsg());
		}
		if (!ew_CheckNumber($this->costoesti->FormValue)) {
			ew_AddMessage($gsFormError, $this->costoesti->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();

		// Check if records exist for detail table 'cs_contratacion'
		if (!isset($GLOBALS["cs_contratacion"])) $GLOBALS["cs_contratacion"] = new ccs_contratacion();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["cs_contratacion"]->LoadRs("`idAdjudicacion` = " . ew_QuotedValue($row['idAdjudicacion'], EW_DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$sRelatedRecordMsg = str_replace("%t", "cs_contratacion", $Language->Phrase("RelatedRecordExists"));
				$this->setFailureMessage($sRelatedRecordMsg);
				return FALSE;
			}
		}

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['idAdjudicacion'];
				$this->LoadDbValues($row);
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// idCalificacion
			$this->idCalificacion->SetDbValueDef($rsnew, $this->idCalificacion->CurrentValue, 0, $this->idCalificacion->ReadOnly);

			// numproceso
			$this->numproceso->SetDbValueDef($rsnew, $this->numproceso->CurrentValue, NULL, $this->numproceso->ReadOnly);

			// nconsulnac
			$this->nconsulnac->SetDbValueDef($rsnew, $this->nconsulnac->CurrentValue, NULL, $this->nconsulnac->ReadOnly);

			// nconsulinter
			$this->nconsulinter->SetDbValueDef($rsnew, $this->nconsulinter->CurrentValue, NULL, $this->nconsulinter->ReadOnly);

			// costoesti
			$this->costoesti->SetDbValueDef($rsnew, $this->costoesti->CurrentValue, NULL, $this->costoesti->ReadOnly);

			// estadoproceso
			$this->estadoproceso->SetDbValueDef($rsnew, $this->estadoproceso->CurrentValue, NULL, $this->estadoproceso->ReadOnly);

			// actaaper
			$this->actaaper->SetDbValueDef($rsnew, $this->actaaper->CurrentValue, NULL, $this->actaaper->ReadOnly);

			// informeacta
			$this->informeacta->SetDbValueDef($rsnew, $this->informeacta->CurrentValue, NULL, $this->informeacta->ReadOnly);

			// resoladju
			$this->resoladju->SetDbValueDef($rsnew, $this->resoladju->CurrentValue, NULL, $this->resoladju->ReadOnly);

			// estado
			$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly);

			// otro
			$this->otro->SetDbValueDef($rsnew, $this->otro->CurrentValue, NULL, $this->otro->ReadOnly);

			// numfirmasnac
			$this->numfirmasnac->SetDbValueDef($rsnew, $this->numfirmasnac->CurrentValue, NULL, $this->numfirmasnac->ReadOnly);

			// numfimasinter
			$this->numfimasinter->SetDbValueDef($rsnew, $this->numfimasinter->CurrentValue, NULL, $this->numfimasinter->ReadOnly);

			// numconsulcorta
			$this->numconsulcorta->SetDbValueDef($rsnew, $this->numconsulcorta->CurrentValue, NULL, $this->numconsulcorta->ReadOnly);

			// fecharecibido
			$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, $this->fecharecibido->ReadOnly);

			// fechacreacion
			$this->fechacreacion->SetDbValueDef($rsnew, $this->fechacreacion->CurrentValue, NULL, $this->fechacreacion->ReadOnly);

			// Check referential integrity for master table 'cs_calificacion'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_cs_calificacion();
			$KeyValue = isset($rsnew['idCalificacion']) ? $rsnew['idCalificacion'] : $rsold['idCalificacion'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@idCalificacion@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["cs_calificacion"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "cs_calificacion", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
			}

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "cs_calificacion") {
				$this->idCalificacion->CurrentValue = $this->idCalificacion->getSessionValue();
			}

		// Check referential integrity for master table 'cs_calificacion'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cs_calificacion();
		if (strval($this->idCalificacion->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@idCalificacion@", ew_AdjustSql($this->idCalificacion->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			$rsmaster = $GLOBALS["cs_calificacion"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cs_calificacion", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// idCalificacion
		$this->idCalificacion->SetDbValueDef($rsnew, $this->idCalificacion->CurrentValue, 0, FALSE);

		// numproceso
		$this->numproceso->SetDbValueDef($rsnew, $this->numproceso->CurrentValue, NULL, FALSE);

		// nconsulnac
		$this->nconsulnac->SetDbValueDef($rsnew, $this->nconsulnac->CurrentValue, NULL, FALSE);

		// nconsulinter
		$this->nconsulinter->SetDbValueDef($rsnew, $this->nconsulinter->CurrentValue, NULL, FALSE);

		// costoesti
		$this->costoesti->SetDbValueDef($rsnew, $this->costoesti->CurrentValue, NULL, FALSE);

		// estadoproceso
		$this->estadoproceso->SetDbValueDef($rsnew, $this->estadoproceso->CurrentValue, NULL, FALSE);

		// actaaper
		$this->actaaper->SetDbValueDef($rsnew, $this->actaaper->CurrentValue, NULL, FALSE);

		// informeacta
		$this->informeacta->SetDbValueDef($rsnew, $this->informeacta->CurrentValue, NULL, FALSE);

		// resoladju
		$this->resoladju->SetDbValueDef($rsnew, $this->resoladju->CurrentValue, NULL, FALSE);

		// estado
		$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, FALSE);

		// otro
		$this->otro->SetDbValueDef($rsnew, $this->otro->CurrentValue, NULL, FALSE);

		// numfirmasnac
		$this->numfirmasnac->SetDbValueDef($rsnew, $this->numfirmasnac->CurrentValue, NULL, FALSE);

		// numfimasinter
		$this->numfimasinter->SetDbValueDef($rsnew, $this->numfimasinter->CurrentValue, NULL, FALSE);

		// numconsulcorta
		$this->numconsulcorta->SetDbValueDef($rsnew, $this->numconsulcorta->CurrentValue, NULL, FALSE);

		// fecharecibido
		$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, FALSE);

		// fechacreacion
		$this->fechacreacion->SetDbValueDef($rsnew, $this->fechacreacion->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {

				// Get insert id if necessary
				$this->idAdjudicacion->setDbValue($conn->Insert_ID());
				$rsnew['idAdjudicacion'] = $this->idAdjudicacion->DbValue;
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {

		// Hide foreign keys
		$sMasterTblVar = $this->getCurrentMasterTable();
		if ($sMasterTblVar == "cs_calificacion") {
			$this->idCalificacion->Visible = FALSE;
			if ($GLOBALS["cs_calificacion"]->EventCancelled) $this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
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
}
?>
