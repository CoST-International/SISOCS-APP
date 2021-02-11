<?php include_once "cs_avancesinfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php

//
// Page class
//

$cs_avances_grid = NULL; // Initialize page object first

class ccs_avances_grid extends ccs_avances {

	// Page ID
	var $PageID = 'grid';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_avances';

	// Page object name
	var $PageObjName = 'cs_avances_grid';

	// Grid form hidden field names
	var $FormName = 'fcs_avancesgrid';
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

		// Table object (cs_avances)
		if (!isset($GLOBALS["cs_avances"]) || get_class($GLOBALS["cs_avances"]) == "ccs_avances") {
			$GLOBALS["cs_avances"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["cs_avances"];

		}

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "cs_inicio_ejecucion") {
			global $cs_inicio_ejecucion;
			$rsmaster = $cs_inicio_ejecucion->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("cs_inicio_ejecucionlist.php"); // Return to master page
			} else {
				$cs_inicio_ejecucion->LoadListRowValues($rsmaster);
				$cs_inicio_ejecucion->RowType = EW_ROWTYPE_MASTER; // Master row
				$cs_inicio_ejecucion->RenderListRow();
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
		$this->porcent_programado->FormValue = ""; // Clear form value
		$this->porcent_real->FormValue = ""; // Clear form value
		$this->finan_programado->FormValue = ""; // Clear form value
		$this->finan_real->FormValue = ""; // Clear form value
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
			$this->codigo->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->codigo->FormValue))
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
					$sKey .= $this->codigo->CurrentValue;

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
		if ($objForm->HasValue("x_codigo_inicio_ejecucion") && $objForm->HasValue("o_codigo_inicio_ejecucion") && $this->codigo_inicio_ejecucion->CurrentValue <> $this->codigo_inicio_ejecucion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_porcent_programado") && $objForm->HasValue("o_porcent_programado") && $this->porcent_programado->CurrentValue <> $this->porcent_programado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_porcent_real") && $objForm->HasValue("o_porcent_real") && $this->porcent_real->CurrentValue <> $this->porcent_real->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_finan_programado") && $objForm->HasValue("o_finan_programado") && $this->finan_programado->CurrentValue <> $this->finan_programado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_finan_real") && $objForm->HasValue("o_finan_real") && $this->finan_real->CurrentValue <> $this->finan_real->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_registro") && $objForm->HasValue("o_fecha_registro") && $this->fecha_registro->CurrentValue <> $this->fecha_registro->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado") && $objForm->HasValue("o_estado") && $this->estado->CurrentValue <> $this->estado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_user_registro") && $objForm->HasValue("o_user_registro") && $this->user_registro->CurrentValue <> $this->user_registro->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_desc_problemas") && $objForm->HasValue("o_desc_problemas") && $this->desc_problemas->CurrentValue <> $this->desc_problemas->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_desc_temas") && $objForm->HasValue("o_desc_temas") && $this->desc_temas->CurrentValue <> $this->desc_temas->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idEjecucion") && $objForm->HasValue("o_idEjecucion") && $this->idEjecucion->CurrentValue <> $this->idEjecucion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_avance") && $objForm->HasValue("o_fecha_avance") && $this->fecha_avance->CurrentValue <> $this->fecha_avance->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idContratacion") && $objForm->HasValue("o_idContratacion") && $this->idContratacion->CurrentValue <> $this->idContratacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado_sol") && $objForm->HasValue("o_estado_sol") && $this->estado_sol->CurrentValue <> $this->estado_sol->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_garantias") && $objForm->HasValue("o_adj_garantias") && $this->adj_garantias->CurrentValue <> $this->adj_garantias->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_avances") && $objForm->HasValue("o_adj_avances") && $this->adj_avances->CurrentValue <> $this->adj_avances->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_supervicion") && $objForm->HasValue("o_adj_supervicion") && $this->adj_supervicion->CurrentValue <> $this->adj_supervicion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_evaluacion") && $objForm->HasValue("o_adj_evaluacion") && $this->adj_evaluacion->CurrentValue <> $this->adj_evaluacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_tecnica") && $objForm->HasValue("o_adj_tecnica") && $this->adj_tecnica->CurrentValue <> $this->adj_tecnica->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_financiero") && $objForm->HasValue("o_adj_financiero") && $this->adj_financiero->CurrentValue <> $this->adj_financiero->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_recepcion") && $objForm->HasValue("o_adj_recepcion") && $this->adj_recepcion->CurrentValue <> $this->adj_recepcion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_adj_disconformidad") && $objForm->HasValue("o_adj_disconformidad") && $this->adj_disconformidad->CurrentValue <> $this->adj_disconformidad->OldValue)
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
				$this->codigo_inicio_ejecucion->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->codigo->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('codigo');
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
		$this->codigo->CurrentValue = NULL;
		$this->codigo->OldValue = $this->codigo->CurrentValue;
		$this->codigo_inicio_ejecucion->CurrentValue = NULL;
		$this->codigo_inicio_ejecucion->OldValue = $this->codigo_inicio_ejecucion->CurrentValue;
		$this->porcent_programado->CurrentValue = 0.00;
		$this->porcent_programado->OldValue = $this->porcent_programado->CurrentValue;
		$this->porcent_real->CurrentValue = 0.00;
		$this->porcent_real->OldValue = $this->porcent_real->CurrentValue;
		$this->finan_programado->CurrentValue = 0.00;
		$this->finan_programado->OldValue = $this->finan_programado->CurrentValue;
		$this->finan_real->CurrentValue = 0.00;
		$this->finan_real->OldValue = $this->finan_real->CurrentValue;
		$this->fecha_registro->CurrentValue = NULL;
		$this->fecha_registro->OldValue = $this->fecha_registro->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->user_registro->CurrentValue = "system";
		$this->user_registro->OldValue = $this->user_registro->CurrentValue;
		$this->desc_problemas->CurrentValue = NULL;
		$this->desc_problemas->OldValue = $this->desc_problemas->CurrentValue;
		$this->desc_temas->CurrentValue = NULL;
		$this->desc_temas->OldValue = $this->desc_temas->CurrentValue;
		$this->idEjecucion->CurrentValue = NULL;
		$this->idEjecucion->OldValue = $this->idEjecucion->CurrentValue;
		$this->fecha_avance->CurrentValue = NULL;
		$this->fecha_avance->OldValue = $this->fecha_avance->CurrentValue;
		$this->idContratacion->CurrentValue = NULL;
		$this->idContratacion->OldValue = $this->idContratacion->CurrentValue;
		$this->estado_sol->CurrentValue = NULL;
		$this->estado_sol->OldValue = $this->estado_sol->CurrentValue;
		$this->adj_garantias->CurrentValue = NULL;
		$this->adj_garantias->OldValue = $this->adj_garantias->CurrentValue;
		$this->adj_avances->CurrentValue = NULL;
		$this->adj_avances->OldValue = $this->adj_avances->CurrentValue;
		$this->adj_supervicion->CurrentValue = NULL;
		$this->adj_supervicion->OldValue = $this->adj_supervicion->CurrentValue;
		$this->adj_evaluacion->CurrentValue = NULL;
		$this->adj_evaluacion->OldValue = $this->adj_evaluacion->CurrentValue;
		$this->adj_tecnica->CurrentValue = NULL;
		$this->adj_tecnica->OldValue = $this->adj_tecnica->CurrentValue;
		$this->adj_financiero->CurrentValue = NULL;
		$this->adj_financiero->OldValue = $this->adj_financiero->CurrentValue;
		$this->adj_recepcion->CurrentValue = NULL;
		$this->adj_recepcion->OldValue = $this->adj_recepcion->CurrentValue;
		$this->adj_disconformidad->CurrentValue = NULL;
		$this->adj_disconformidad->OldValue = $this->adj_disconformidad->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$objForm->FormName = $this->FormName;
		if (!$this->codigo->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->codigo->setFormValue($objForm->GetValue("x_codigo"));
		if (!$this->codigo_inicio_ejecucion->FldIsDetailKey) {
			$this->codigo_inicio_ejecucion->setFormValue($objForm->GetValue("x_codigo_inicio_ejecucion"));
		}
		$this->codigo_inicio_ejecucion->setOldValue($objForm->GetValue("o_codigo_inicio_ejecucion"));
		if (!$this->porcent_programado->FldIsDetailKey) {
			$this->porcent_programado->setFormValue($objForm->GetValue("x_porcent_programado"));
		}
		$this->porcent_programado->setOldValue($objForm->GetValue("o_porcent_programado"));
		if (!$this->porcent_real->FldIsDetailKey) {
			$this->porcent_real->setFormValue($objForm->GetValue("x_porcent_real"));
		}
		$this->porcent_real->setOldValue($objForm->GetValue("o_porcent_real"));
		if (!$this->finan_programado->FldIsDetailKey) {
			$this->finan_programado->setFormValue($objForm->GetValue("x_finan_programado"));
		}
		$this->finan_programado->setOldValue($objForm->GetValue("o_finan_programado"));
		if (!$this->finan_real->FldIsDetailKey) {
			$this->finan_real->setFormValue($objForm->GetValue("x_finan_real"));
		}
		$this->finan_real->setOldValue($objForm->GetValue("o_finan_real"));
		if (!$this->fecha_registro->FldIsDetailKey) {
			$this->fecha_registro->setFormValue($objForm->GetValue("x_fecha_registro"));
			$this->fecha_registro->CurrentValue = ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5);
		}
		$this->fecha_registro->setOldValue($objForm->GetValue("o_fecha_registro"));
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$this->estado->setOldValue($objForm->GetValue("o_estado"));
		if (!$this->user_registro->FldIsDetailKey) {
			$this->user_registro->setFormValue($objForm->GetValue("x_user_registro"));
		}
		$this->user_registro->setOldValue($objForm->GetValue("o_user_registro"));
		if (!$this->desc_problemas->FldIsDetailKey) {
			$this->desc_problemas->setFormValue($objForm->GetValue("x_desc_problemas"));
		}
		$this->desc_problemas->setOldValue($objForm->GetValue("o_desc_problemas"));
		if (!$this->desc_temas->FldIsDetailKey) {
			$this->desc_temas->setFormValue($objForm->GetValue("x_desc_temas"));
		}
		$this->desc_temas->setOldValue($objForm->GetValue("o_desc_temas"));
		if (!$this->idEjecucion->FldIsDetailKey) {
			$this->idEjecucion->setFormValue($objForm->GetValue("x_idEjecucion"));
		}
		$this->idEjecucion->setOldValue($objForm->GetValue("o_idEjecucion"));
		if (!$this->fecha_avance->FldIsDetailKey) {
			$this->fecha_avance->setFormValue($objForm->GetValue("x_fecha_avance"));
			$this->fecha_avance->CurrentValue = ew_UnFormatDateTime($this->fecha_avance->CurrentValue, 5);
		}
		$this->fecha_avance->setOldValue($objForm->GetValue("o_fecha_avance"));
		if (!$this->idContratacion->FldIsDetailKey) {
			$this->idContratacion->setFormValue($objForm->GetValue("x_idContratacion"));
		}
		$this->idContratacion->setOldValue($objForm->GetValue("o_idContratacion"));
		if (!$this->estado_sol->FldIsDetailKey) {
			$this->estado_sol->setFormValue($objForm->GetValue("x_estado_sol"));
		}
		$this->estado_sol->setOldValue($objForm->GetValue("o_estado_sol"));
		if (!$this->adj_garantias->FldIsDetailKey) {
			$this->adj_garantias->setFormValue($objForm->GetValue("x_adj_garantias"));
		}
		$this->adj_garantias->setOldValue($objForm->GetValue("o_adj_garantias"));
		if (!$this->adj_avances->FldIsDetailKey) {
			$this->adj_avances->setFormValue($objForm->GetValue("x_adj_avances"));
		}
		$this->adj_avances->setOldValue($objForm->GetValue("o_adj_avances"));
		if (!$this->adj_supervicion->FldIsDetailKey) {
			$this->adj_supervicion->setFormValue($objForm->GetValue("x_adj_supervicion"));
		}
		$this->adj_supervicion->setOldValue($objForm->GetValue("o_adj_supervicion"));
		if (!$this->adj_evaluacion->FldIsDetailKey) {
			$this->adj_evaluacion->setFormValue($objForm->GetValue("x_adj_evaluacion"));
		}
		$this->adj_evaluacion->setOldValue($objForm->GetValue("o_adj_evaluacion"));
		if (!$this->adj_tecnica->FldIsDetailKey) {
			$this->adj_tecnica->setFormValue($objForm->GetValue("x_adj_tecnica"));
		}
		$this->adj_tecnica->setOldValue($objForm->GetValue("o_adj_tecnica"));
		if (!$this->adj_financiero->FldIsDetailKey) {
			$this->adj_financiero->setFormValue($objForm->GetValue("x_adj_financiero"));
		}
		$this->adj_financiero->setOldValue($objForm->GetValue("o_adj_financiero"));
		if (!$this->adj_recepcion->FldIsDetailKey) {
			$this->adj_recepcion->setFormValue($objForm->GetValue("x_adj_recepcion"));
		}
		$this->adj_recepcion->setOldValue($objForm->GetValue("o_adj_recepcion"));
		if (!$this->adj_disconformidad->FldIsDetailKey) {
			$this->adj_disconformidad->setFormValue($objForm->GetValue("x_adj_disconformidad"));
		}
		$this->adj_disconformidad->setOldValue($objForm->GetValue("o_adj_disconformidad"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->codigo->CurrentValue = $this->codigo->FormValue;
		$this->codigo_inicio_ejecucion->CurrentValue = $this->codigo_inicio_ejecucion->FormValue;
		$this->porcent_programado->CurrentValue = $this->porcent_programado->FormValue;
		$this->porcent_real->CurrentValue = $this->porcent_real->FormValue;
		$this->finan_programado->CurrentValue = $this->finan_programado->FormValue;
		$this->finan_real->CurrentValue = $this->finan_real->FormValue;
		$this->fecha_registro->CurrentValue = $this->fecha_registro->FormValue;
		$this->fecha_registro->CurrentValue = ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5);
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->user_registro->CurrentValue = $this->user_registro->FormValue;
		$this->desc_problemas->CurrentValue = $this->desc_problemas->FormValue;
		$this->desc_temas->CurrentValue = $this->desc_temas->FormValue;
		$this->idEjecucion->CurrentValue = $this->idEjecucion->FormValue;
		$this->fecha_avance->CurrentValue = $this->fecha_avance->FormValue;
		$this->fecha_avance->CurrentValue = ew_UnFormatDateTime($this->fecha_avance->CurrentValue, 5);
		$this->idContratacion->CurrentValue = $this->idContratacion->FormValue;
		$this->estado_sol->CurrentValue = $this->estado_sol->FormValue;
		$this->adj_garantias->CurrentValue = $this->adj_garantias->FormValue;
		$this->adj_avances->CurrentValue = $this->adj_avances->FormValue;
		$this->adj_supervicion->CurrentValue = $this->adj_supervicion->FormValue;
		$this->adj_evaluacion->CurrentValue = $this->adj_evaluacion->FormValue;
		$this->adj_tecnica->CurrentValue = $this->adj_tecnica->FormValue;
		$this->adj_financiero->CurrentValue = $this->adj_financiero->FormValue;
		$this->adj_recepcion->CurrentValue = $this->adj_recepcion->FormValue;
		$this->adj_disconformidad->CurrentValue = $this->adj_disconformidad->FormValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->codigo->CurrentValue = strval($arKeys[0]); // codigo
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// codigo
			// codigo_inicio_ejecucion

			$this->codigo_inicio_ejecucion->EditAttrs["class"] = "form-control";
			$this->codigo_inicio_ejecucion->EditCustomAttributes = "";
			if ($this->codigo_inicio_ejecucion->getSessionValue() <> "") {
				$this->codigo_inicio_ejecucion->CurrentValue = $this->codigo_inicio_ejecucion->getSessionValue();
				$this->codigo_inicio_ejecucion->OldValue = $this->codigo_inicio_ejecucion->CurrentValue;
			$this->codigo_inicio_ejecucion->ViewValue = $this->codigo_inicio_ejecucion->CurrentValue;
			$this->codigo_inicio_ejecucion->ViewCustomAttributes = "";
			} else {
			$this->codigo_inicio_ejecucion->EditValue = ew_HtmlEncode($this->codigo_inicio_ejecucion->CurrentValue);
			$this->codigo_inicio_ejecucion->PlaceHolder = ew_RemoveHtml($this->codigo_inicio_ejecucion->FldCaption());
			}

			// porcent_programado
			$this->porcent_programado->EditAttrs["class"] = "form-control";
			$this->porcent_programado->EditCustomAttributes = "";
			$this->porcent_programado->EditValue = ew_HtmlEncode($this->porcent_programado->CurrentValue);
			$this->porcent_programado->PlaceHolder = ew_RemoveHtml($this->porcent_programado->FldCaption());
			if (strval($this->porcent_programado->EditValue) <> "" && is_numeric($this->porcent_programado->EditValue)) {
			$this->porcent_programado->EditValue = ew_FormatNumber($this->porcent_programado->EditValue, -2, -1, -2, 0);
			$this->porcent_programado->OldValue = $this->porcent_programado->EditValue;
			}

			// porcent_real
			$this->porcent_real->EditAttrs["class"] = "form-control";
			$this->porcent_real->EditCustomAttributes = "";
			$this->porcent_real->EditValue = ew_HtmlEncode($this->porcent_real->CurrentValue);
			$this->porcent_real->PlaceHolder = ew_RemoveHtml($this->porcent_real->FldCaption());
			if (strval($this->porcent_real->EditValue) <> "" && is_numeric($this->porcent_real->EditValue)) {
			$this->porcent_real->EditValue = ew_FormatNumber($this->porcent_real->EditValue, -2, -1, -2, 0);
			$this->porcent_real->OldValue = $this->porcent_real->EditValue;
			}

			// finan_programado
			$this->finan_programado->EditAttrs["class"] = "form-control";
			$this->finan_programado->EditCustomAttributes = "";
			$this->finan_programado->EditValue = ew_HtmlEncode($this->finan_programado->CurrentValue);
			$this->finan_programado->PlaceHolder = ew_RemoveHtml($this->finan_programado->FldCaption());
			if (strval($this->finan_programado->EditValue) <> "" && is_numeric($this->finan_programado->EditValue)) {
			$this->finan_programado->EditValue = ew_FormatNumber($this->finan_programado->EditValue, -2, -1, -2, 0);
			$this->finan_programado->OldValue = $this->finan_programado->EditValue;
			}

			// finan_real
			$this->finan_real->EditAttrs["class"] = "form-control";
			$this->finan_real->EditCustomAttributes = "";
			$this->finan_real->EditValue = ew_HtmlEncode($this->finan_real->CurrentValue);
			$this->finan_real->PlaceHolder = ew_RemoveHtml($this->finan_real->FldCaption());
			if (strval($this->finan_real->EditValue) <> "" && is_numeric($this->finan_real->EditValue)) {
			$this->finan_real->EditValue = ew_FormatNumber($this->finan_real->EditValue, -2, -1, -2, 0);
			$this->finan_real->OldValue = $this->finan_real->EditValue;
			}

			// fecha_registro
			$this->fecha_registro->EditAttrs["class"] = "form-control";
			$this->fecha_registro->EditCustomAttributes = "";
			$this->fecha_registro->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_registro->CurrentValue, 5));
			$this->fecha_registro->PlaceHolder = ew_RemoveHtml($this->fecha_registro->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// user_registro
			$this->user_registro->EditAttrs["class"] = "form-control";
			$this->user_registro->EditCustomAttributes = "";
			$this->user_registro->EditValue = ew_HtmlEncode($this->user_registro->CurrentValue);
			$this->user_registro->PlaceHolder = ew_RemoveHtml($this->user_registro->FldCaption());

			// desc_problemas
			$this->desc_problemas->EditAttrs["class"] = "form-control";
			$this->desc_problemas->EditCustomAttributes = "";
			$this->desc_problemas->EditValue = ew_HtmlEncode($this->desc_problemas->CurrentValue);
			$this->desc_problemas->PlaceHolder = ew_RemoveHtml($this->desc_problemas->FldCaption());

			// desc_temas
			$this->desc_temas->EditAttrs["class"] = "form-control";
			$this->desc_temas->EditCustomAttributes = "";
			$this->desc_temas->EditValue = ew_HtmlEncode($this->desc_temas->CurrentValue);
			$this->desc_temas->PlaceHolder = ew_RemoveHtml($this->desc_temas->FldCaption());

			// idEjecucion
			$this->idEjecucion->EditAttrs["class"] = "form-control";
			$this->idEjecucion->EditCustomAttributes = "";
			$this->idEjecucion->EditValue = ew_HtmlEncode($this->idEjecucion->CurrentValue);
			$this->idEjecucion->PlaceHolder = ew_RemoveHtml($this->idEjecucion->FldCaption());

			// fecha_avance
			$this->fecha_avance->EditAttrs["class"] = "form-control";
			$this->fecha_avance->EditCustomAttributes = "";
			$this->fecha_avance->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_avance->CurrentValue, 5));
			$this->fecha_avance->PlaceHolder = ew_RemoveHtml($this->fecha_avance->FldCaption());

			// idContratacion
			$this->idContratacion->EditAttrs["class"] = "form-control";
			$this->idContratacion->EditCustomAttributes = "";
			$this->idContratacion->EditValue = ew_HtmlEncode($this->idContratacion->CurrentValue);
			$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());

			// estado_sol
			$this->estado_sol->EditAttrs["class"] = "form-control";
			$this->estado_sol->EditCustomAttributes = "";
			$this->estado_sol->EditValue = ew_HtmlEncode($this->estado_sol->CurrentValue);
			$this->estado_sol->PlaceHolder = ew_RemoveHtml($this->estado_sol->FldCaption());

			// adj_garantias
			$this->adj_garantias->EditAttrs["class"] = "form-control";
			$this->adj_garantias->EditCustomAttributes = "";
			$this->adj_garantias->EditValue = ew_HtmlEncode($this->adj_garantias->CurrentValue);
			$this->adj_garantias->PlaceHolder = ew_RemoveHtml($this->adj_garantias->FldCaption());

			// adj_avances
			$this->adj_avances->EditAttrs["class"] = "form-control";
			$this->adj_avances->EditCustomAttributes = "";
			$this->adj_avances->EditValue = ew_HtmlEncode($this->adj_avances->CurrentValue);
			$this->adj_avances->PlaceHolder = ew_RemoveHtml($this->adj_avances->FldCaption());

			// adj_supervicion
			$this->adj_supervicion->EditAttrs["class"] = "form-control";
			$this->adj_supervicion->EditCustomAttributes = "";
			$this->adj_supervicion->EditValue = ew_HtmlEncode($this->adj_supervicion->CurrentValue);
			$this->adj_supervicion->PlaceHolder = ew_RemoveHtml($this->adj_supervicion->FldCaption());

			// adj_evaluacion
			$this->adj_evaluacion->EditAttrs["class"] = "form-control";
			$this->adj_evaluacion->EditCustomAttributes = "";
			$this->adj_evaluacion->EditValue = ew_HtmlEncode($this->adj_evaluacion->CurrentValue);
			$this->adj_evaluacion->PlaceHolder = ew_RemoveHtml($this->adj_evaluacion->FldCaption());

			// adj_tecnica
			$this->adj_tecnica->EditAttrs["class"] = "form-control";
			$this->adj_tecnica->EditCustomAttributes = "";
			$this->adj_tecnica->EditValue = ew_HtmlEncode($this->adj_tecnica->CurrentValue);
			$this->adj_tecnica->PlaceHolder = ew_RemoveHtml($this->adj_tecnica->FldCaption());

			// adj_financiero
			$this->adj_financiero->EditAttrs["class"] = "form-control";
			$this->adj_financiero->EditCustomAttributes = "";
			$this->adj_financiero->EditValue = ew_HtmlEncode($this->adj_financiero->CurrentValue);
			$this->adj_financiero->PlaceHolder = ew_RemoveHtml($this->adj_financiero->FldCaption());

			// adj_recepcion
			$this->adj_recepcion->EditAttrs["class"] = "form-control";
			$this->adj_recepcion->EditCustomAttributes = "";
			$this->adj_recepcion->EditValue = ew_HtmlEncode($this->adj_recepcion->CurrentValue);
			$this->adj_recepcion->PlaceHolder = ew_RemoveHtml($this->adj_recepcion->FldCaption());

			// adj_disconformidad
			$this->adj_disconformidad->EditAttrs["class"] = "form-control";
			$this->adj_disconformidad->EditCustomAttributes = "";
			$this->adj_disconformidad->EditValue = ew_HtmlEncode($this->adj_disconformidad->CurrentValue);
			$this->adj_disconformidad->PlaceHolder = ew_RemoveHtml($this->adj_disconformidad->FldCaption());

			// Edit refer script
			// codigo

			$this->codigo->HrefValue = "";

			// codigo_inicio_ejecucion
			$this->codigo_inicio_ejecucion->HrefValue = "";

			// porcent_programado
			$this->porcent_programado->HrefValue = "";

			// porcent_real
			$this->porcent_real->HrefValue = "";

			// finan_programado
			$this->finan_programado->HrefValue = "";

			// finan_real
			$this->finan_real->HrefValue = "";

			// fecha_registro
			$this->fecha_registro->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// user_registro
			$this->user_registro->HrefValue = "";

			// desc_problemas
			$this->desc_problemas->HrefValue = "";

			// desc_temas
			$this->desc_temas->HrefValue = "";

			// idEjecucion
			$this->idEjecucion->HrefValue = "";

			// fecha_avance
			$this->fecha_avance->HrefValue = "";

			// idContratacion
			$this->idContratacion->HrefValue = "";

			// estado_sol
			$this->estado_sol->HrefValue = "";

			// adj_garantias
			$this->adj_garantias->HrefValue = "";

			// adj_avances
			$this->adj_avances->HrefValue = "";

			// adj_supervicion
			$this->adj_supervicion->HrefValue = "";

			// adj_evaluacion
			$this->adj_evaluacion->HrefValue = "";

			// adj_tecnica
			$this->adj_tecnica->HrefValue = "";

			// adj_financiero
			$this->adj_financiero->HrefValue = "";

			// adj_recepcion
			$this->adj_recepcion->HrefValue = "";

			// adj_disconformidad
			$this->adj_disconformidad->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			$this->codigo->EditValue = $this->codigo->CurrentValue;
			$this->codigo->ViewCustomAttributes = "";

			// codigo_inicio_ejecucion
			$this->codigo_inicio_ejecucion->EditAttrs["class"] = "form-control";
			$this->codigo_inicio_ejecucion->EditCustomAttributes = "";
			if ($this->codigo_inicio_ejecucion->getSessionValue() <> "") {
				$this->codigo_inicio_ejecucion->CurrentValue = $this->codigo_inicio_ejecucion->getSessionValue();
				$this->codigo_inicio_ejecucion->OldValue = $this->codigo_inicio_ejecucion->CurrentValue;
			$this->codigo_inicio_ejecucion->ViewValue = $this->codigo_inicio_ejecucion->CurrentValue;
			$this->codigo_inicio_ejecucion->ViewCustomAttributes = "";
			} else {
			$this->codigo_inicio_ejecucion->EditValue = ew_HtmlEncode($this->codigo_inicio_ejecucion->CurrentValue);
			$this->codigo_inicio_ejecucion->PlaceHolder = ew_RemoveHtml($this->codigo_inicio_ejecucion->FldCaption());
			}

			// porcent_programado
			$this->porcent_programado->EditAttrs["class"] = "form-control";
			$this->porcent_programado->EditCustomAttributes = "";
			$this->porcent_programado->EditValue = ew_HtmlEncode($this->porcent_programado->CurrentValue);
			$this->porcent_programado->PlaceHolder = ew_RemoveHtml($this->porcent_programado->FldCaption());
			if (strval($this->porcent_programado->EditValue) <> "" && is_numeric($this->porcent_programado->EditValue)) {
			$this->porcent_programado->EditValue = ew_FormatNumber($this->porcent_programado->EditValue, -2, -1, -2, 0);
			$this->porcent_programado->OldValue = $this->porcent_programado->EditValue;
			}

			// porcent_real
			$this->porcent_real->EditAttrs["class"] = "form-control";
			$this->porcent_real->EditCustomAttributes = "";
			$this->porcent_real->EditValue = ew_HtmlEncode($this->porcent_real->CurrentValue);
			$this->porcent_real->PlaceHolder = ew_RemoveHtml($this->porcent_real->FldCaption());
			if (strval($this->porcent_real->EditValue) <> "" && is_numeric($this->porcent_real->EditValue)) {
			$this->porcent_real->EditValue = ew_FormatNumber($this->porcent_real->EditValue, -2, -1, -2, 0);
			$this->porcent_real->OldValue = $this->porcent_real->EditValue;
			}

			// finan_programado
			$this->finan_programado->EditAttrs["class"] = "form-control";
			$this->finan_programado->EditCustomAttributes = "";
			$this->finan_programado->EditValue = ew_HtmlEncode($this->finan_programado->CurrentValue);
			$this->finan_programado->PlaceHolder = ew_RemoveHtml($this->finan_programado->FldCaption());
			if (strval($this->finan_programado->EditValue) <> "" && is_numeric($this->finan_programado->EditValue)) {
			$this->finan_programado->EditValue = ew_FormatNumber($this->finan_programado->EditValue, -2, -1, -2, 0);
			$this->finan_programado->OldValue = $this->finan_programado->EditValue;
			}

			// finan_real
			$this->finan_real->EditAttrs["class"] = "form-control";
			$this->finan_real->EditCustomAttributes = "";
			$this->finan_real->EditValue = ew_HtmlEncode($this->finan_real->CurrentValue);
			$this->finan_real->PlaceHolder = ew_RemoveHtml($this->finan_real->FldCaption());
			if (strval($this->finan_real->EditValue) <> "" && is_numeric($this->finan_real->EditValue)) {
			$this->finan_real->EditValue = ew_FormatNumber($this->finan_real->EditValue, -2, -1, -2, 0);
			$this->finan_real->OldValue = $this->finan_real->EditValue;
			}

			// fecha_registro
			$this->fecha_registro->EditAttrs["class"] = "form-control";
			$this->fecha_registro->EditCustomAttributes = "";
			$this->fecha_registro->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_registro->CurrentValue, 5));
			$this->fecha_registro->PlaceHolder = ew_RemoveHtml($this->fecha_registro->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// user_registro
			$this->user_registro->EditAttrs["class"] = "form-control";
			$this->user_registro->EditCustomAttributes = "";
			$this->user_registro->EditValue = ew_HtmlEncode($this->user_registro->CurrentValue);
			$this->user_registro->PlaceHolder = ew_RemoveHtml($this->user_registro->FldCaption());

			// desc_problemas
			$this->desc_problemas->EditAttrs["class"] = "form-control";
			$this->desc_problemas->EditCustomAttributes = "";
			$this->desc_problemas->EditValue = ew_HtmlEncode($this->desc_problemas->CurrentValue);
			$this->desc_problemas->PlaceHolder = ew_RemoveHtml($this->desc_problemas->FldCaption());

			// desc_temas
			$this->desc_temas->EditAttrs["class"] = "form-control";
			$this->desc_temas->EditCustomAttributes = "";
			$this->desc_temas->EditValue = ew_HtmlEncode($this->desc_temas->CurrentValue);
			$this->desc_temas->PlaceHolder = ew_RemoveHtml($this->desc_temas->FldCaption());

			// idEjecucion
			$this->idEjecucion->EditAttrs["class"] = "form-control";
			$this->idEjecucion->EditCustomAttributes = "";
			$this->idEjecucion->EditValue = ew_HtmlEncode($this->idEjecucion->CurrentValue);
			$this->idEjecucion->PlaceHolder = ew_RemoveHtml($this->idEjecucion->FldCaption());

			// fecha_avance
			$this->fecha_avance->EditAttrs["class"] = "form-control";
			$this->fecha_avance->EditCustomAttributes = "";
			$this->fecha_avance->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_avance->CurrentValue, 5));
			$this->fecha_avance->PlaceHolder = ew_RemoveHtml($this->fecha_avance->FldCaption());

			// idContratacion
			$this->idContratacion->EditAttrs["class"] = "form-control";
			$this->idContratacion->EditCustomAttributes = "";
			$this->idContratacion->EditValue = ew_HtmlEncode($this->idContratacion->CurrentValue);
			$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());

			// estado_sol
			$this->estado_sol->EditAttrs["class"] = "form-control";
			$this->estado_sol->EditCustomAttributes = "";
			$this->estado_sol->EditValue = ew_HtmlEncode($this->estado_sol->CurrentValue);
			$this->estado_sol->PlaceHolder = ew_RemoveHtml($this->estado_sol->FldCaption());

			// adj_garantias
			$this->adj_garantias->EditAttrs["class"] = "form-control";
			$this->adj_garantias->EditCustomAttributes = "";
			$this->adj_garantias->EditValue = ew_HtmlEncode($this->adj_garantias->CurrentValue);
			$this->adj_garantias->PlaceHolder = ew_RemoveHtml($this->adj_garantias->FldCaption());

			// adj_avances
			$this->adj_avances->EditAttrs["class"] = "form-control";
			$this->adj_avances->EditCustomAttributes = "";
			$this->adj_avances->EditValue = ew_HtmlEncode($this->adj_avances->CurrentValue);
			$this->adj_avances->PlaceHolder = ew_RemoveHtml($this->adj_avances->FldCaption());

			// adj_supervicion
			$this->adj_supervicion->EditAttrs["class"] = "form-control";
			$this->adj_supervicion->EditCustomAttributes = "";
			$this->adj_supervicion->EditValue = ew_HtmlEncode($this->adj_supervicion->CurrentValue);
			$this->adj_supervicion->PlaceHolder = ew_RemoveHtml($this->adj_supervicion->FldCaption());

			// adj_evaluacion
			$this->adj_evaluacion->EditAttrs["class"] = "form-control";
			$this->adj_evaluacion->EditCustomAttributes = "";
			$this->adj_evaluacion->EditValue = ew_HtmlEncode($this->adj_evaluacion->CurrentValue);
			$this->adj_evaluacion->PlaceHolder = ew_RemoveHtml($this->adj_evaluacion->FldCaption());

			// adj_tecnica
			$this->adj_tecnica->EditAttrs["class"] = "form-control";
			$this->adj_tecnica->EditCustomAttributes = "";
			$this->adj_tecnica->EditValue = ew_HtmlEncode($this->adj_tecnica->CurrentValue);
			$this->adj_tecnica->PlaceHolder = ew_RemoveHtml($this->adj_tecnica->FldCaption());

			// adj_financiero
			$this->adj_financiero->EditAttrs["class"] = "form-control";
			$this->adj_financiero->EditCustomAttributes = "";
			$this->adj_financiero->EditValue = ew_HtmlEncode($this->adj_financiero->CurrentValue);
			$this->adj_financiero->PlaceHolder = ew_RemoveHtml($this->adj_financiero->FldCaption());

			// adj_recepcion
			$this->adj_recepcion->EditAttrs["class"] = "form-control";
			$this->adj_recepcion->EditCustomAttributes = "";
			$this->adj_recepcion->EditValue = ew_HtmlEncode($this->adj_recepcion->CurrentValue);
			$this->adj_recepcion->PlaceHolder = ew_RemoveHtml($this->adj_recepcion->FldCaption());

			// adj_disconformidad
			$this->adj_disconformidad->EditAttrs["class"] = "form-control";
			$this->adj_disconformidad->EditCustomAttributes = "";
			$this->adj_disconformidad->EditValue = ew_HtmlEncode($this->adj_disconformidad->CurrentValue);
			$this->adj_disconformidad->PlaceHolder = ew_RemoveHtml($this->adj_disconformidad->FldCaption());

			// Edit refer script
			// codigo

			$this->codigo->HrefValue = "";

			// codigo_inicio_ejecucion
			$this->codigo_inicio_ejecucion->HrefValue = "";

			// porcent_programado
			$this->porcent_programado->HrefValue = "";

			// porcent_real
			$this->porcent_real->HrefValue = "";

			// finan_programado
			$this->finan_programado->HrefValue = "";

			// finan_real
			$this->finan_real->HrefValue = "";

			// fecha_registro
			$this->fecha_registro->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// user_registro
			$this->user_registro->HrefValue = "";

			// desc_problemas
			$this->desc_problemas->HrefValue = "";

			// desc_temas
			$this->desc_temas->HrefValue = "";

			// idEjecucion
			$this->idEjecucion->HrefValue = "";

			// fecha_avance
			$this->fecha_avance->HrefValue = "";

			// idContratacion
			$this->idContratacion->HrefValue = "";

			// estado_sol
			$this->estado_sol->HrefValue = "";

			// adj_garantias
			$this->adj_garantias->HrefValue = "";

			// adj_avances
			$this->adj_avances->HrefValue = "";

			// adj_supervicion
			$this->adj_supervicion->HrefValue = "";

			// adj_evaluacion
			$this->adj_evaluacion->HrefValue = "";

			// adj_tecnica
			$this->adj_tecnica->HrefValue = "";

			// adj_financiero
			$this->adj_financiero->HrefValue = "";

			// adj_recepcion
			$this->adj_recepcion->HrefValue = "";

			// adj_disconformidad
			$this->adj_disconformidad->HrefValue = "";
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
		if (!$this->codigo_inicio_ejecucion->FldIsDetailKey && !is_null($this->codigo_inicio_ejecucion->FormValue) && $this->codigo_inicio_ejecucion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->codigo_inicio_ejecucion->FldCaption(), $this->codigo_inicio_ejecucion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->codigo_inicio_ejecucion->FormValue)) {
			ew_AddMessage($gsFormError, $this->codigo_inicio_ejecucion->FldErrMsg());
		}
		if (!ew_CheckNumber($this->porcent_programado->FormValue)) {
			ew_AddMessage($gsFormError, $this->porcent_programado->FldErrMsg());
		}
		if (!ew_CheckNumber($this->porcent_real->FormValue)) {
			ew_AddMessage($gsFormError, $this->porcent_real->FldErrMsg());
		}
		if (!ew_CheckNumber($this->finan_programado->FormValue)) {
			ew_AddMessage($gsFormError, $this->finan_programado->FldErrMsg());
		}
		if (!ew_CheckNumber($this->finan_real->FormValue)) {
			ew_AddMessage($gsFormError, $this->finan_real->FldErrMsg());
		}
		if (!ew_CheckDate($this->fecha_registro->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_registro->FldErrMsg());
		}
		if (!$this->user_registro->FldIsDetailKey && !is_null($this->user_registro->FormValue) && $this->user_registro->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_registro->FldCaption(), $this->user_registro->ReqErrMsg));
		}
		if (!$this->idEjecucion->FldIsDetailKey && !is_null($this->idEjecucion->FormValue) && $this->idEjecucion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idEjecucion->FldCaption(), $this->idEjecucion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idEjecucion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idEjecucion->FldErrMsg());
		}
		if (!$this->fecha_avance->FldIsDetailKey && !is_null($this->fecha_avance->FormValue) && $this->fecha_avance->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->fecha_avance->FldCaption(), $this->fecha_avance->ReqErrMsg));
		}
		if (!ew_CheckDate($this->fecha_avance->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_avance->FldErrMsg());
		}
		if (!$this->idContratacion->FldIsDetailKey && !is_null($this->idContratacion->FormValue) && $this->idContratacion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idContratacion->FldCaption(), $this->idContratacion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idContratacion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idContratacion->FldErrMsg());
		}
		if (!$this->estado_sol->FldIsDetailKey && !is_null($this->estado_sol->FormValue) && $this->estado_sol->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->estado_sol->FldCaption(), $this->estado_sol->ReqErrMsg));
		}
		if (!$this->adj_garantias->FldIsDetailKey && !is_null($this->adj_garantias->FormValue) && $this->adj_garantias->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_garantias->FldCaption(), $this->adj_garantias->ReqErrMsg));
		}
		if (!$this->adj_avances->FldIsDetailKey && !is_null($this->adj_avances->FormValue) && $this->adj_avances->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_avances->FldCaption(), $this->adj_avances->ReqErrMsg));
		}
		if (!$this->adj_supervicion->FldIsDetailKey && !is_null($this->adj_supervicion->FormValue) && $this->adj_supervicion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_supervicion->FldCaption(), $this->adj_supervicion->ReqErrMsg));
		}
		if (!$this->adj_evaluacion->FldIsDetailKey && !is_null($this->adj_evaluacion->FormValue) && $this->adj_evaluacion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_evaluacion->FldCaption(), $this->adj_evaluacion->ReqErrMsg));
		}
		if (!$this->adj_tecnica->FldIsDetailKey && !is_null($this->adj_tecnica->FormValue) && $this->adj_tecnica->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_tecnica->FldCaption(), $this->adj_tecnica->ReqErrMsg));
		}
		if (!$this->adj_financiero->FldIsDetailKey && !is_null($this->adj_financiero->FormValue) && $this->adj_financiero->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_financiero->FldCaption(), $this->adj_financiero->ReqErrMsg));
		}
		if (!$this->adj_recepcion->FldIsDetailKey && !is_null($this->adj_recepcion->FormValue) && $this->adj_recepcion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_recepcion->FldCaption(), $this->adj_recepcion->ReqErrMsg));
		}
		if (!$this->adj_disconformidad->FldIsDetailKey && !is_null($this->adj_disconformidad->FormValue) && $this->adj_disconformidad->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->adj_disconformidad->FldCaption(), $this->adj_disconformidad->ReqErrMsg));
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
				$sThisKey .= $row['codigo'];
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

			// codigo_inicio_ejecucion
			$this->codigo_inicio_ejecucion->SetDbValueDef($rsnew, $this->codigo_inicio_ejecucion->CurrentValue, 0, $this->codigo_inicio_ejecucion->ReadOnly);

			// porcent_programado
			$this->porcent_programado->SetDbValueDef($rsnew, $this->porcent_programado->CurrentValue, NULL, $this->porcent_programado->ReadOnly);

			// porcent_real
			$this->porcent_real->SetDbValueDef($rsnew, $this->porcent_real->CurrentValue, NULL, $this->porcent_real->ReadOnly);

			// finan_programado
			$this->finan_programado->SetDbValueDef($rsnew, $this->finan_programado->CurrentValue, NULL, $this->finan_programado->ReadOnly);

			// finan_real
			$this->finan_real->SetDbValueDef($rsnew, $this->finan_real->CurrentValue, NULL, $this->finan_real->ReadOnly);

			// fecha_registro
			$this->fecha_registro->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5), NULL, $this->fecha_registro->ReadOnly);

			// estado
			$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly);

			// user_registro
			$this->user_registro->SetDbValueDef($rsnew, $this->user_registro->CurrentValue, "", $this->user_registro->ReadOnly);

			// desc_problemas
			$this->desc_problemas->SetDbValueDef($rsnew, $this->desc_problemas->CurrentValue, NULL, $this->desc_problemas->ReadOnly);

			// desc_temas
			$this->desc_temas->SetDbValueDef($rsnew, $this->desc_temas->CurrentValue, NULL, $this->desc_temas->ReadOnly);

			// idEjecucion
			$this->idEjecucion->SetDbValueDef($rsnew, $this->idEjecucion->CurrentValue, 0, $this->idEjecucion->ReadOnly);

			// fecha_avance
			$this->fecha_avance->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_avance->CurrentValue, 5), ew_CurrentDate(), $this->fecha_avance->ReadOnly);

			// idContratacion
			$this->idContratacion->SetDbValueDef($rsnew, $this->idContratacion->CurrentValue, 0, $this->idContratacion->ReadOnly);

			// estado_sol
			$this->estado_sol->SetDbValueDef($rsnew, $this->estado_sol->CurrentValue, "", $this->estado_sol->ReadOnly);

			// adj_garantias
			$this->adj_garantias->SetDbValueDef($rsnew, $this->adj_garantias->CurrentValue, "", $this->adj_garantias->ReadOnly);

			// adj_avances
			$this->adj_avances->SetDbValueDef($rsnew, $this->adj_avances->CurrentValue, "", $this->adj_avances->ReadOnly);

			// adj_supervicion
			$this->adj_supervicion->SetDbValueDef($rsnew, $this->adj_supervicion->CurrentValue, "", $this->adj_supervicion->ReadOnly);

			// adj_evaluacion
			$this->adj_evaluacion->SetDbValueDef($rsnew, $this->adj_evaluacion->CurrentValue, "", $this->adj_evaluacion->ReadOnly);

			// adj_tecnica
			$this->adj_tecnica->SetDbValueDef($rsnew, $this->adj_tecnica->CurrentValue, "", $this->adj_tecnica->ReadOnly);

			// adj_financiero
			$this->adj_financiero->SetDbValueDef($rsnew, $this->adj_financiero->CurrentValue, "", $this->adj_financiero->ReadOnly);

			// adj_recepcion
			$this->adj_recepcion->SetDbValueDef($rsnew, $this->adj_recepcion->CurrentValue, "", $this->adj_recepcion->ReadOnly);

			// adj_disconformidad
			$this->adj_disconformidad->SetDbValueDef($rsnew, $this->adj_disconformidad->CurrentValue, "", $this->adj_disconformidad->ReadOnly);

			// Check referential integrity for master table 'cs_inicio_ejecucion'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_cs_inicio_ejecucion();
			$KeyValue = isset($rsnew['codigo_inicio_ejecucion']) ? $rsnew['codigo_inicio_ejecucion'] : $rsold['codigo_inicio_ejecucion'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@idContratacion@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["cs_inicio_ejecucion"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "cs_inicio_ejecucion", $Language->Phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "cs_inicio_ejecucion") {
				$this->codigo_inicio_ejecucion->CurrentValue = $this->codigo_inicio_ejecucion->getSessionValue();
			}

		// Check referential integrity for master table 'cs_inicio_ejecucion'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cs_inicio_ejecucion();
		if (strval($this->codigo_inicio_ejecucion->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@idContratacion@", ew_AdjustSql($this->codigo_inicio_ejecucion->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			$rsmaster = $GLOBALS["cs_inicio_ejecucion"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cs_inicio_ejecucion", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// codigo_inicio_ejecucion
		$this->codigo_inicio_ejecucion->SetDbValueDef($rsnew, $this->codigo_inicio_ejecucion->CurrentValue, 0, FALSE);

		// porcent_programado
		$this->porcent_programado->SetDbValueDef($rsnew, $this->porcent_programado->CurrentValue, NULL, strval($this->porcent_programado->CurrentValue) == "");

		// porcent_real
		$this->porcent_real->SetDbValueDef($rsnew, $this->porcent_real->CurrentValue, NULL, strval($this->porcent_real->CurrentValue) == "");

		// finan_programado
		$this->finan_programado->SetDbValueDef($rsnew, $this->finan_programado->CurrentValue, NULL, strval($this->finan_programado->CurrentValue) == "");

		// finan_real
		$this->finan_real->SetDbValueDef($rsnew, $this->finan_real->CurrentValue, NULL, strval($this->finan_real->CurrentValue) == "");

		// fecha_registro
		$this->fecha_registro->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5), NULL, FALSE);

		// estado
		$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, FALSE);

		// user_registro
		$this->user_registro->SetDbValueDef($rsnew, $this->user_registro->CurrentValue, "", strval($this->user_registro->CurrentValue) == "");

		// desc_problemas
		$this->desc_problemas->SetDbValueDef($rsnew, $this->desc_problemas->CurrentValue, NULL, FALSE);

		// desc_temas
		$this->desc_temas->SetDbValueDef($rsnew, $this->desc_temas->CurrentValue, NULL, FALSE);

		// idEjecucion
		$this->idEjecucion->SetDbValueDef($rsnew, $this->idEjecucion->CurrentValue, 0, FALSE);

		// fecha_avance
		$this->fecha_avance->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_avance->CurrentValue, 5), ew_CurrentDate(), FALSE);

		// idContratacion
		$this->idContratacion->SetDbValueDef($rsnew, $this->idContratacion->CurrentValue, 0, FALSE);

		// estado_sol
		$this->estado_sol->SetDbValueDef($rsnew, $this->estado_sol->CurrentValue, "", FALSE);

		// adj_garantias
		$this->adj_garantias->SetDbValueDef($rsnew, $this->adj_garantias->CurrentValue, "", FALSE);

		// adj_avances
		$this->adj_avances->SetDbValueDef($rsnew, $this->adj_avances->CurrentValue, "", FALSE);

		// adj_supervicion
		$this->adj_supervicion->SetDbValueDef($rsnew, $this->adj_supervicion->CurrentValue, "", FALSE);

		// adj_evaluacion
		$this->adj_evaluacion->SetDbValueDef($rsnew, $this->adj_evaluacion->CurrentValue, "", FALSE);

		// adj_tecnica
		$this->adj_tecnica->SetDbValueDef($rsnew, $this->adj_tecnica->CurrentValue, "", FALSE);

		// adj_financiero
		$this->adj_financiero->SetDbValueDef($rsnew, $this->adj_financiero->CurrentValue, "", FALSE);

		// adj_recepcion
		$this->adj_recepcion->SetDbValueDef($rsnew, $this->adj_recepcion->CurrentValue, "", FALSE);

		// adj_disconformidad
		$this->adj_disconformidad->SetDbValueDef($rsnew, $this->adj_disconformidad->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {

				// Get insert id if necessary
				$this->codigo->setDbValue($conn->Insert_ID());
				$rsnew['codigo'] = $this->codigo->DbValue;
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
		if ($sMasterTblVar == "cs_inicio_ejecucion") {
			$this->codigo_inicio_ejecucion->Visible = FALSE;
			if ($GLOBALS["cs_inicio_ejecucion"]->EventCancelled) $this->EventCancelled = TRUE;
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
