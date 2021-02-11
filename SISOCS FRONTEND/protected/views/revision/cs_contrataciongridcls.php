<?php include_once "cs_contratacioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php

//
// Page class
//

$cs_contratacion_grid = NULL; // Initialize page object first

class ccs_contratacion_grid extends ccs_contratacion {

	// Page ID
	var $PageID = 'grid';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_contratacion';

	// Page object name
	var $PageObjName = 'cs_contratacion_grid';

	// Grid form hidden field names
	var $FormName = 'fcs_contrataciongrid';
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

		// Table object (cs_contratacion)
		if (!isset($GLOBALS["cs_contratacion"]) || get_class($GLOBALS["cs_contratacion"]) == "ccs_contratacion") {
			$GLOBALS["cs_contratacion"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["cs_contratacion"];

		}

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

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
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

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
		$this->precio->FormValue = ""; // Clear form value
		$this->precio2->FormValue = ""; // Clear form value
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
			$this->idContratacion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idContratacion->FormValue))
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
					$sKey .= $this->idContratacion->CurrentValue;

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
		if ($objForm->HasValue("x_idAdjudicacion") && $objForm->HasValue("o_idAdjudicacion") && $this->idAdjudicacion->CurrentValue <> $this->idAdjudicacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idEntidad") && $objForm->HasValue("o_idEntidad") && $this->idEntidad->CurrentValue <> $this->idEntidad->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idoferente") && $objForm->HasValue("o_idoferente") && $this->idoferente->CurrentValue <> $this->idoferente->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_precio") && $objForm->HasValue("o_precio") && $this->precio->CurrentValue <> $this->precio->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_precio2") && $objForm->HasValue("o_precio2") && $this->precio2->CurrentValue <> $this->precio2->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechainicio") && $objForm->HasValue("o_fechainicio") && $this->fechainicio->CurrentValue <> $this->fechainicio->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechafinal") && $objForm->HasValue("o_fechafinal") && $this->fechafinal->CurrentValue <> $this->fechafinal->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_duracioncontrato") && $objForm->HasValue("o_duracioncontrato") && $this->duracioncontrato->CurrentValue <> $this->duracioncontrato->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_documentocontra") && $objForm->HasValue("o_documentocontra") && $this->documentocontra->CurrentValue <> $this->documentocontra->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_regante") && $objForm->HasValue("o_regante") && $this->regante->CurrentValue <> $this->regante->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_espeplanos") && $objForm->HasValue("o_espeplanos") && $this->espeplanos->CurrentValue <> $this->espeplanos->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado") && $objForm->HasValue("o_estado") && $this->estado->CurrentValue <> $this->estado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_otro") && $objForm->HasValue("o_otro") && $this->otro->CurrentValue <> $this->otro->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_ncontrato") && $objForm->HasValue("o_ncontrato") && $this->ncontrato->CurrentValue <> $this->ncontrato->OldValue)
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
				$this->idAdjudicacion->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->idContratacion->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('idContratacion');
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
		$this->idContratacion->CurrentValue = NULL;
		$this->idContratacion->OldValue = $this->idContratacion->CurrentValue;
		$this->idAdjudicacion->CurrentValue = NULL;
		$this->idAdjudicacion->OldValue = $this->idAdjudicacion->CurrentValue;
		$this->idEntidad->CurrentValue = NULL;
		$this->idEntidad->OldValue = $this->idEntidad->CurrentValue;
		$this->idoferente->CurrentValue = NULL;
		$this->idoferente->OldValue = $this->idoferente->CurrentValue;
		$this->precio->CurrentValue = NULL;
		$this->precio->OldValue = $this->precio->CurrentValue;
		$this->precio2->CurrentValue = NULL;
		$this->precio2->OldValue = $this->precio2->CurrentValue;
		$this->fechainicio->CurrentValue = NULL;
		$this->fechainicio->OldValue = $this->fechainicio->CurrentValue;
		$this->fechafinal->CurrentValue = NULL;
		$this->fechafinal->OldValue = $this->fechafinal->CurrentValue;
		$this->duracioncontrato->CurrentValue = NULL;
		$this->duracioncontrato->OldValue = $this->duracioncontrato->CurrentValue;
		$this->documentocontra->CurrentValue = NULL;
		$this->documentocontra->OldValue = $this->documentocontra->CurrentValue;
		$this->regante->CurrentValue = NULL;
		$this->regante->OldValue = $this->regante->CurrentValue;
		$this->espeplanos->CurrentValue = NULL;
		$this->espeplanos->OldValue = $this->espeplanos->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->otro->CurrentValue = NULL;
		$this->otro->OldValue = $this->otro->CurrentValue;
		$this->ncontrato->CurrentValue = NULL;
		$this->ncontrato->OldValue = $this->ncontrato->CurrentValue;
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
		if (!$this->idContratacion->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idContratacion->setFormValue($objForm->GetValue("x_idContratacion"));
		if (!$this->idAdjudicacion->FldIsDetailKey) {
			$this->idAdjudicacion->setFormValue($objForm->GetValue("x_idAdjudicacion"));
		}
		$this->idAdjudicacion->setOldValue($objForm->GetValue("o_idAdjudicacion"));
		if (!$this->idEntidad->FldIsDetailKey) {
			$this->idEntidad->setFormValue($objForm->GetValue("x_idEntidad"));
		}
		$this->idEntidad->setOldValue($objForm->GetValue("o_idEntidad"));
		if (!$this->idoferente->FldIsDetailKey) {
			$this->idoferente->setFormValue($objForm->GetValue("x_idoferente"));
		}
		$this->idoferente->setOldValue($objForm->GetValue("o_idoferente"));
		if (!$this->precio->FldIsDetailKey) {
			$this->precio->setFormValue($objForm->GetValue("x_precio"));
		}
		$this->precio->setOldValue($objForm->GetValue("o_precio"));
		if (!$this->precio2->FldIsDetailKey) {
			$this->precio2->setFormValue($objForm->GetValue("x_precio2"));
		}
		$this->precio2->setOldValue($objForm->GetValue("o_precio2"));
		if (!$this->fechainicio->FldIsDetailKey) {
			$this->fechainicio->setFormValue($objForm->GetValue("x_fechainicio"));
		}
		$this->fechainicio->setOldValue($objForm->GetValue("o_fechainicio"));
		if (!$this->fechafinal->FldIsDetailKey) {
			$this->fechafinal->setFormValue($objForm->GetValue("x_fechafinal"));
		}
		$this->fechafinal->setOldValue($objForm->GetValue("o_fechafinal"));
		if (!$this->duracioncontrato->FldIsDetailKey) {
			$this->duracioncontrato->setFormValue($objForm->GetValue("x_duracioncontrato"));
		}
		$this->duracioncontrato->setOldValue($objForm->GetValue("o_duracioncontrato"));
		if (!$this->documentocontra->FldIsDetailKey) {
			$this->documentocontra->setFormValue($objForm->GetValue("x_documentocontra"));
		}
		$this->documentocontra->setOldValue($objForm->GetValue("o_documentocontra"));
		if (!$this->regante->FldIsDetailKey) {
			$this->regante->setFormValue($objForm->GetValue("x_regante"));
		}
		$this->regante->setOldValue($objForm->GetValue("o_regante"));
		if (!$this->espeplanos->FldIsDetailKey) {
			$this->espeplanos->setFormValue($objForm->GetValue("x_espeplanos"));
		}
		$this->espeplanos->setOldValue($objForm->GetValue("o_espeplanos"));
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$this->estado->setOldValue($objForm->GetValue("o_estado"));
		if (!$this->otro->FldIsDetailKey) {
			$this->otro->setFormValue($objForm->GetValue("x_otro"));
		}
		$this->otro->setOldValue($objForm->GetValue("o_otro"));
		if (!$this->ncontrato->FldIsDetailKey) {
			$this->ncontrato->setFormValue($objForm->GetValue("x_ncontrato"));
		}
		$this->ncontrato->setOldValue($objForm->GetValue("o_ncontrato"));
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
			$this->idContratacion->CurrentValue = $this->idContratacion->FormValue;
		$this->idAdjudicacion->CurrentValue = $this->idAdjudicacion->FormValue;
		$this->idEntidad->CurrentValue = $this->idEntidad->FormValue;
		$this->idoferente->CurrentValue = $this->idoferente->FormValue;
		$this->precio->CurrentValue = $this->precio->FormValue;
		$this->precio2->CurrentValue = $this->precio2->FormValue;
		$this->fechainicio->CurrentValue = $this->fechainicio->FormValue;
		$this->fechafinal->CurrentValue = $this->fechafinal->FormValue;
		$this->duracioncontrato->CurrentValue = $this->duracioncontrato->FormValue;
		$this->documentocontra->CurrentValue = $this->documentocontra->FormValue;
		$this->regante->CurrentValue = $this->regante->FormValue;
		$this->espeplanos->CurrentValue = $this->espeplanos->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->otro->CurrentValue = $this->otro->FormValue;
		$this->ncontrato->CurrentValue = $this->ncontrato->FormValue;
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
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->idContratacion->CurrentValue = strval($arKeys[0]); // idContratacion
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// idContratacion
			// idAdjudicacion

			$this->idAdjudicacion->EditAttrs["class"] = "form-control";
			$this->idAdjudicacion->EditCustomAttributes = "";
			if ($this->idAdjudicacion->getSessionValue() <> "") {
				$this->idAdjudicacion->CurrentValue = $this->idAdjudicacion->getSessionValue();
				$this->idAdjudicacion->OldValue = $this->idAdjudicacion->CurrentValue;
			$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
			$this->idAdjudicacion->ViewCustomAttributes = "";
			} else {
			$this->idAdjudicacion->EditValue = ew_HtmlEncode($this->idAdjudicacion->CurrentValue);
			$this->idAdjudicacion->PlaceHolder = ew_RemoveHtml($this->idAdjudicacion->FldCaption());
			}

			// idEntidad
			$this->idEntidad->EditAttrs["class"] = "form-control";
			$this->idEntidad->EditCustomAttributes = "";
			$this->idEntidad->EditValue = ew_HtmlEncode($this->idEntidad->CurrentValue);
			$this->idEntidad->PlaceHolder = ew_RemoveHtml($this->idEntidad->FldCaption());

			// idoferente
			$this->idoferente->EditAttrs["class"] = "form-control";
			$this->idoferente->EditCustomAttributes = "";
			$this->idoferente->EditValue = ew_HtmlEncode($this->idoferente->CurrentValue);
			$this->idoferente->PlaceHolder = ew_RemoveHtml($this->idoferente->FldCaption());

			// precio
			$this->precio->EditAttrs["class"] = "form-control";
			$this->precio->EditCustomAttributes = "";
			$this->precio->EditValue = ew_HtmlEncode($this->precio->CurrentValue);
			$this->precio->PlaceHolder = ew_RemoveHtml($this->precio->FldCaption());
			if (strval($this->precio->EditValue) <> "" && is_numeric($this->precio->EditValue)) {
			$this->precio->EditValue = ew_FormatNumber($this->precio->EditValue, -2, -1, -2, 0);
			$this->precio->OldValue = $this->precio->EditValue;
			}

			// precio2
			$this->precio2->EditAttrs["class"] = "form-control";
			$this->precio2->EditCustomAttributes = "";
			$this->precio2->EditValue = ew_HtmlEncode($this->precio2->CurrentValue);
			$this->precio2->PlaceHolder = ew_RemoveHtml($this->precio2->FldCaption());
			if (strval($this->precio2->EditValue) <> "" && is_numeric($this->precio2->EditValue)) {
			$this->precio2->EditValue = ew_FormatNumber($this->precio2->EditValue, -2, -1, -2, 0);
			$this->precio2->OldValue = $this->precio2->EditValue;
			}

			// fechainicio
			$this->fechainicio->EditAttrs["class"] = "form-control";
			$this->fechainicio->EditCustomAttributes = "";
			$this->fechainicio->EditValue = ew_HtmlEncode($this->fechainicio->CurrentValue);
			$this->fechainicio->PlaceHolder = ew_RemoveHtml($this->fechainicio->FldCaption());

			// fechafinal
			$this->fechafinal->EditAttrs["class"] = "form-control";
			$this->fechafinal->EditCustomAttributes = "";
			$this->fechafinal->EditValue = ew_HtmlEncode($this->fechafinal->CurrentValue);
			$this->fechafinal->PlaceHolder = ew_RemoveHtml($this->fechafinal->FldCaption());

			// duracioncontrato
			$this->duracioncontrato->EditAttrs["class"] = "form-control";
			$this->duracioncontrato->EditCustomAttributes = "";
			$this->duracioncontrato->EditValue = ew_HtmlEncode($this->duracioncontrato->CurrentValue);
			$this->duracioncontrato->PlaceHolder = ew_RemoveHtml($this->duracioncontrato->FldCaption());

			// documentocontra
			$this->documentocontra->EditAttrs["class"] = "form-control";
			$this->documentocontra->EditCustomAttributes = "";
			$this->documentocontra->EditValue = ew_HtmlEncode($this->documentocontra->CurrentValue);
			$this->documentocontra->PlaceHolder = ew_RemoveHtml($this->documentocontra->FldCaption());

			// regante
			$this->regante->EditAttrs["class"] = "form-control";
			$this->regante->EditCustomAttributes = "";
			$this->regante->EditValue = ew_HtmlEncode($this->regante->CurrentValue);
			$this->regante->PlaceHolder = ew_RemoveHtml($this->regante->FldCaption());

			// espeplanos
			$this->espeplanos->EditAttrs["class"] = "form-control";
			$this->espeplanos->EditCustomAttributes = "";
			$this->espeplanos->EditValue = ew_HtmlEncode($this->espeplanos->CurrentValue);
			$this->espeplanos->PlaceHolder = ew_RemoveHtml($this->espeplanos->FldCaption());

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

			// ncontrato
			$this->ncontrato->EditAttrs["class"] = "form-control";
			$this->ncontrato->EditCustomAttributes = "";
			$this->ncontrato->EditValue = ew_HtmlEncode($this->ncontrato->CurrentValue);
			$this->ncontrato->PlaceHolder = ew_RemoveHtml($this->ncontrato->FldCaption());

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
			// idContratacion

			$this->idContratacion->HrefValue = "";

			// idAdjudicacion
			$this->idAdjudicacion->HrefValue = "";

			// idEntidad
			$this->idEntidad->HrefValue = "";

			// idoferente
			$this->idoferente->HrefValue = "";

			// precio
			$this->precio->HrefValue = "";

			// precio2
			$this->precio2->HrefValue = "";

			// fechainicio
			$this->fechainicio->HrefValue = "";

			// fechafinal
			$this->fechafinal->HrefValue = "";

			// duracioncontrato
			$this->duracioncontrato->HrefValue = "";

			// documentocontra
			$this->documentocontra->HrefValue = "";

			// regante
			$this->regante->HrefValue = "";

			// espeplanos
			$this->espeplanos->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// otro
			$this->otro->HrefValue = "";

			// ncontrato
			$this->ncontrato->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";

			// fechacreacion
			$this->fechacreacion->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idContratacion
			$this->idContratacion->EditAttrs["class"] = "form-control";
			$this->idContratacion->EditCustomAttributes = "";
			$this->idContratacion->EditValue = $this->idContratacion->CurrentValue;
			$this->idContratacion->ViewCustomAttributes = "";

			// idAdjudicacion
			$this->idAdjudicacion->EditAttrs["class"] = "form-control";
			$this->idAdjudicacion->EditCustomAttributes = "";
			if ($this->idAdjudicacion->getSessionValue() <> "") {
				$this->idAdjudicacion->CurrentValue = $this->idAdjudicacion->getSessionValue();
				$this->idAdjudicacion->OldValue = $this->idAdjudicacion->CurrentValue;
			$this->idAdjudicacion->ViewValue = $this->idAdjudicacion->CurrentValue;
			$this->idAdjudicacion->ViewCustomAttributes = "";
			} else {
			$this->idAdjudicacion->EditValue = ew_HtmlEncode($this->idAdjudicacion->CurrentValue);
			$this->idAdjudicacion->PlaceHolder = ew_RemoveHtml($this->idAdjudicacion->FldCaption());
			}

			// idEntidad
			$this->idEntidad->EditAttrs["class"] = "form-control";
			$this->idEntidad->EditCustomAttributes = "";
			$this->idEntidad->EditValue = ew_HtmlEncode($this->idEntidad->CurrentValue);
			$this->idEntidad->PlaceHolder = ew_RemoveHtml($this->idEntidad->FldCaption());

			// idoferente
			$this->idoferente->EditAttrs["class"] = "form-control";
			$this->idoferente->EditCustomAttributes = "";
			$this->idoferente->EditValue = ew_HtmlEncode($this->idoferente->CurrentValue);
			$this->idoferente->PlaceHolder = ew_RemoveHtml($this->idoferente->FldCaption());

			// precio
			$this->precio->EditAttrs["class"] = "form-control";
			$this->precio->EditCustomAttributes = "";
			$this->precio->EditValue = ew_HtmlEncode($this->precio->CurrentValue);
			$this->precio->PlaceHolder = ew_RemoveHtml($this->precio->FldCaption());
			if (strval($this->precio->EditValue) <> "" && is_numeric($this->precio->EditValue)) {
			$this->precio->EditValue = ew_FormatNumber($this->precio->EditValue, -2, -1, -2, 0);
			$this->precio->OldValue = $this->precio->EditValue;
			}

			// precio2
			$this->precio2->EditAttrs["class"] = "form-control";
			$this->precio2->EditCustomAttributes = "";
			$this->precio2->EditValue = ew_HtmlEncode($this->precio2->CurrentValue);
			$this->precio2->PlaceHolder = ew_RemoveHtml($this->precio2->FldCaption());
			if (strval($this->precio2->EditValue) <> "" && is_numeric($this->precio2->EditValue)) {
			$this->precio2->EditValue = ew_FormatNumber($this->precio2->EditValue, -2, -1, -2, 0);
			$this->precio2->OldValue = $this->precio2->EditValue;
			}

			// fechainicio
			$this->fechainicio->EditAttrs["class"] = "form-control";
			$this->fechainicio->EditCustomAttributes = "";
			$this->fechainicio->EditValue = ew_HtmlEncode($this->fechainicio->CurrentValue);
			$this->fechainicio->PlaceHolder = ew_RemoveHtml($this->fechainicio->FldCaption());

			// fechafinal
			$this->fechafinal->EditAttrs["class"] = "form-control";
			$this->fechafinal->EditCustomAttributes = "";
			$this->fechafinal->EditValue = ew_HtmlEncode($this->fechafinal->CurrentValue);
			$this->fechafinal->PlaceHolder = ew_RemoveHtml($this->fechafinal->FldCaption());

			// duracioncontrato
			$this->duracioncontrato->EditAttrs["class"] = "form-control";
			$this->duracioncontrato->EditCustomAttributes = "";
			$this->duracioncontrato->EditValue = ew_HtmlEncode($this->duracioncontrato->CurrentValue);
			$this->duracioncontrato->PlaceHolder = ew_RemoveHtml($this->duracioncontrato->FldCaption());

			// documentocontra
			$this->documentocontra->EditAttrs["class"] = "form-control";
			$this->documentocontra->EditCustomAttributes = "";
			$this->documentocontra->EditValue = ew_HtmlEncode($this->documentocontra->CurrentValue);
			$this->documentocontra->PlaceHolder = ew_RemoveHtml($this->documentocontra->FldCaption());

			// regante
			$this->regante->EditAttrs["class"] = "form-control";
			$this->regante->EditCustomAttributes = "";
			$this->regante->EditValue = ew_HtmlEncode($this->regante->CurrentValue);
			$this->regante->PlaceHolder = ew_RemoveHtml($this->regante->FldCaption());

			// espeplanos
			$this->espeplanos->EditAttrs["class"] = "form-control";
			$this->espeplanos->EditCustomAttributes = "";
			$this->espeplanos->EditValue = ew_HtmlEncode($this->espeplanos->CurrentValue);
			$this->espeplanos->PlaceHolder = ew_RemoveHtml($this->espeplanos->FldCaption());

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

			// ncontrato
			$this->ncontrato->EditAttrs["class"] = "form-control";
			$this->ncontrato->EditCustomAttributes = "";
			$this->ncontrato->EditValue = ew_HtmlEncode($this->ncontrato->CurrentValue);
			$this->ncontrato->PlaceHolder = ew_RemoveHtml($this->ncontrato->FldCaption());

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
			// idContratacion

			$this->idContratacion->HrefValue = "";

			// idAdjudicacion
			$this->idAdjudicacion->HrefValue = "";

			// idEntidad
			$this->idEntidad->HrefValue = "";

			// idoferente
			$this->idoferente->HrefValue = "";

			// precio
			$this->precio->HrefValue = "";

			// precio2
			$this->precio2->HrefValue = "";

			// fechainicio
			$this->fechainicio->HrefValue = "";

			// fechafinal
			$this->fechafinal->HrefValue = "";

			// duracioncontrato
			$this->duracioncontrato->HrefValue = "";

			// documentocontra
			$this->documentocontra->HrefValue = "";

			// regante
			$this->regante->HrefValue = "";

			// espeplanos
			$this->espeplanos->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// otro
			$this->otro->HrefValue = "";

			// ncontrato
			$this->ncontrato->HrefValue = "";

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
		if (!$this->idAdjudicacion->FldIsDetailKey && !is_null($this->idAdjudicacion->FormValue) && $this->idAdjudicacion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idAdjudicacion->FldCaption(), $this->idAdjudicacion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idAdjudicacion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idAdjudicacion->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idEntidad->FormValue)) {
			ew_AddMessage($gsFormError, $this->idEntidad->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idoferente->FormValue)) {
			ew_AddMessage($gsFormError, $this->idoferente->FldErrMsg());
		}
		if (!ew_CheckNumber($this->precio->FormValue)) {
			ew_AddMessage($gsFormError, $this->precio->FldErrMsg());
		}
		if (!$this->precio2->FldIsDetailKey && !is_null($this->precio2->FormValue) && $this->precio2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->precio2->FldCaption(), $this->precio2->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->precio2->FormValue)) {
			ew_AddMessage($gsFormError, $this->precio2->FldErrMsg());
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

		// Check if records exist for detail table 'cs_inicio_ejecucion'
		if (!isset($GLOBALS["cs_inicio_ejecucion"])) $GLOBALS["cs_inicio_ejecucion"] = new ccs_inicio_ejecucion();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["cs_inicio_ejecucion"]->LoadRs("`idContratacion` = " . ew_QuotedValue($row['idContratacion'], EW_DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$sRelatedRecordMsg = str_replace("%t", "cs_inicio_ejecucion", $Language->Phrase("RelatedRecordExists"));
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
				$sThisKey .= $row['idContratacion'];
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

			// idAdjudicacion
			$this->idAdjudicacion->SetDbValueDef($rsnew, $this->idAdjudicacion->CurrentValue, 0, $this->idAdjudicacion->ReadOnly);

			// idEntidad
			$this->idEntidad->SetDbValueDef($rsnew, $this->idEntidad->CurrentValue, NULL, $this->idEntidad->ReadOnly);

			// idoferente
			$this->idoferente->SetDbValueDef($rsnew, $this->idoferente->CurrentValue, NULL, $this->idoferente->ReadOnly);

			// precio
			$this->precio->SetDbValueDef($rsnew, $this->precio->CurrentValue, NULL, $this->precio->ReadOnly);

			// precio2
			$this->precio2->SetDbValueDef($rsnew, $this->precio2->CurrentValue, 0, $this->precio2->ReadOnly);

			// fechainicio
			$this->fechainicio->SetDbValueDef($rsnew, $this->fechainicio->CurrentValue, NULL, $this->fechainicio->ReadOnly);

			// fechafinal
			$this->fechafinal->SetDbValueDef($rsnew, $this->fechafinal->CurrentValue, NULL, $this->fechafinal->ReadOnly);

			// duracioncontrato
			$this->duracioncontrato->SetDbValueDef($rsnew, $this->duracioncontrato->CurrentValue, NULL, $this->duracioncontrato->ReadOnly);

			// documentocontra
			$this->documentocontra->SetDbValueDef($rsnew, $this->documentocontra->CurrentValue, NULL, $this->documentocontra->ReadOnly);

			// regante
			$this->regante->SetDbValueDef($rsnew, $this->regante->CurrentValue, NULL, $this->regante->ReadOnly);

			// espeplanos
			$this->espeplanos->SetDbValueDef($rsnew, $this->espeplanos->CurrentValue, NULL, $this->espeplanos->ReadOnly);

			// estado
			$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly);

			// otro
			$this->otro->SetDbValueDef($rsnew, $this->otro->CurrentValue, NULL, $this->otro->ReadOnly);

			// ncontrato
			$this->ncontrato->SetDbValueDef($rsnew, $this->ncontrato->CurrentValue, NULL, $this->ncontrato->ReadOnly);

			// fecharecibido
			$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, $this->fecharecibido->ReadOnly);

			// fechacreacion
			$this->fechacreacion->SetDbValueDef($rsnew, $this->fechacreacion->CurrentValue, NULL, $this->fechacreacion->ReadOnly);

			// Check referential integrity for master table 'cs_adjudicacion'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_cs_adjudicacion();
			$KeyValue = isset($rsnew['idAdjudicacion']) ? $rsnew['idAdjudicacion'] : $rsold['idAdjudicacion'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@idAdjudicacion@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["cs_adjudicacion"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "cs_adjudicacion", $Language->Phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "cs_adjudicacion") {
				$this->idAdjudicacion->CurrentValue = $this->idAdjudicacion->getSessionValue();
			}

		// Check referential integrity for master table 'cs_adjudicacion'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cs_adjudicacion();
		if (strval($this->idAdjudicacion->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@idAdjudicacion@", ew_AdjustSql($this->idAdjudicacion->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			$rsmaster = $GLOBALS["cs_adjudicacion"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cs_adjudicacion", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// idAdjudicacion
		$this->idAdjudicacion->SetDbValueDef($rsnew, $this->idAdjudicacion->CurrentValue, 0, FALSE);

		// idEntidad
		$this->idEntidad->SetDbValueDef($rsnew, $this->idEntidad->CurrentValue, NULL, FALSE);

		// idoferente
		$this->idoferente->SetDbValueDef($rsnew, $this->idoferente->CurrentValue, NULL, FALSE);

		// precio
		$this->precio->SetDbValueDef($rsnew, $this->precio->CurrentValue, NULL, FALSE);

		// precio2
		$this->precio2->SetDbValueDef($rsnew, $this->precio2->CurrentValue, 0, FALSE);

		// fechainicio
		$this->fechainicio->SetDbValueDef($rsnew, $this->fechainicio->CurrentValue, NULL, FALSE);

		// fechafinal
		$this->fechafinal->SetDbValueDef($rsnew, $this->fechafinal->CurrentValue, NULL, FALSE);

		// duracioncontrato
		$this->duracioncontrato->SetDbValueDef($rsnew, $this->duracioncontrato->CurrentValue, NULL, FALSE);

		// documentocontra
		$this->documentocontra->SetDbValueDef($rsnew, $this->documentocontra->CurrentValue, NULL, FALSE);

		// regante
		$this->regante->SetDbValueDef($rsnew, $this->regante->CurrentValue, NULL, FALSE);

		// espeplanos
		$this->espeplanos->SetDbValueDef($rsnew, $this->espeplanos->CurrentValue, NULL, FALSE);

		// estado
		$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, FALSE);

		// otro
		$this->otro->SetDbValueDef($rsnew, $this->otro->CurrentValue, NULL, FALSE);

		// ncontrato
		$this->ncontrato->SetDbValueDef($rsnew, $this->ncontrato->CurrentValue, NULL, FALSE);

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
				$this->idContratacion->setDbValue($conn->Insert_ID());
				$rsnew['idContratacion'] = $this->idContratacion->DbValue;
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
		if ($sMasterTblVar == "cs_adjudicacion") {
			$this->idAdjudicacion->Visible = FALSE;
			if ($GLOBALS["cs_adjudicacion"]->EventCancelled) $this->EventCancelled = TRUE;
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
