<?php include_once "cs_proyectoinfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php

//
// Page class
//

$cs_proyecto_grid = NULL; // Initialize page object first

class ccs_proyecto_grid extends ccs_proyecto {

	// Page ID
	var $PageID = 'grid';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_proyecto';

	// Page object name
	var $PageObjName = 'cs_proyecto_grid';

	// Grid form hidden field names
	var $FormName = 'fcs_proyectogrid';
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

		// Table object (cs_proyecto)
		if (!isset($GLOBALS["cs_proyecto"]) || get_class($GLOBALS["cs_proyecto"]) == "ccs_proyecto") {
			$GLOBALS["cs_proyecto"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["cs_proyecto"];

		}

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

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
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

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
		$this->presupuesto->FormValue = ""; // Clear form value
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
			$this->idProyecto->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idProyecto->FormValue))
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
					$sKey .= $this->idProyecto->CurrentValue;

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
		if ($objForm->HasValue("x_idPrograma") && $objForm->HasValue("o_idPrograma") && $this->idPrograma->CurrentValue <> $this->idPrograma->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_codigo") && $objForm->HasValue("o_codigo") && $this->codigo->CurrentValue <> $this->codigo->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idUbicacion") && $objForm->HasValue("o_idUbicacion") && $this->idUbicacion->CurrentValue <> $this->idUbicacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idRegion") && $objForm->HasValue("o_idRegion") && $this->idRegion->CurrentValue <> $this->idRegion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idDepto") && $objForm->HasValue("o_idDepto") && $this->idDepto->CurrentValue <> $this->idDepto->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idTramo") && $objForm->HasValue("o_idTramo") && $this->idTramo->CurrentValue <> $this->idTramo->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idRuta") && $objForm->HasValue("o_idRuta") && $this->idRuta->CurrentValue <> $this->idRuta->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idTipoRed") && $objForm->HasValue("o_idTipoRed") && $this->idTipoRed->CurrentValue <> $this->idTipoRed->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idProposito") && $objForm->HasValue("o_idProposito") && $this->idProposito->CurrentValue <> $this->idProposito->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_presupuesto") && $objForm->HasValue("o_presupuesto") && $this->presupuesto->CurrentValue <> $this->presupuesto->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_especiplano") && $objForm->HasValue("o_especiplano") && $this->especiplano->CurrentValue <> $this->especiplano->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_presuprogra") && $objForm->HasValue("o_presuprogra") && $this->presuprogra->CurrentValue <> $this->presuprogra->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estudiofact") && $objForm->HasValue("o_estudiofact") && $this->estudiofact->CurrentValue <> $this->estudiofact->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estudioimpact") && $objForm->HasValue("o_estudioimpact") && $this->estudioimpact->CurrentValue <> $this->estudioimpact->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_licambi") && $objForm->HasValue("o_licambi") && $this->licambi->CurrentValue <> $this->licambi->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estuimpactierra") && $objForm->HasValue("o_estuimpactierra") && $this->estuimpactierra->CurrentValue <> $this->estuimpactierra->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_planreasea") && $objForm->HasValue("o_planreasea") && $this->planreasea->CurrentValue <> $this->planreasea->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_plananual") && $objForm->HasValue("o_plananual") && $this->plananual->CurrentValue <> $this->plananual->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_acuerdofinan") && $objForm->HasValue("o_acuerdofinan") && $this->acuerdofinan->CurrentValue <> $this->acuerdofinan->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_otro") && $objForm->HasValue("o_otro") && $this->otro->CurrentValue <> $this->otro->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechacreacion") && $objForm->HasValue("o_fechacreacion") && $this->fechacreacion->CurrentValue <> $this->fechacreacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado") && $objForm->HasValue("o_estado") && $this->estado->CurrentValue <> $this->estado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idFuncionario") && $objForm->HasValue("o_idFuncionario") && $this->idFuncionario->CurrentValue <> $this->idFuncionario->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechaaprob") && $objForm->HasValue("o_fechaaprob") && $this->fechaaprob->CurrentValue <> $this->fechaaprob->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idfuente") && $objForm->HasValue("o_idfuente") && $this->idfuente->CurrentValue <> $this->idfuente->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_codsefin") && $objForm->HasValue("o_codsefin") && $this->codsefin->CurrentValue <> $this->codsefin->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_notaprioridad") && $objForm->HasValue("o_notaprioridad") && $this->notaprioridad->CurrentValue <> $this->notaprioridad->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_constanciabanco") && $objForm->HasValue("o_constanciabanco") && $this->constanciabanco->CurrentValue <> $this->constanciabanco->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecharecibido") && $objForm->HasValue("o_fecharecibido") && $this->fecharecibido->CurrentValue <> $this->fecharecibido->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_clase") && $objForm->HasValue("o_clase") && $this->clase->CurrentValue <> $this->clase->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_entes") && $objForm->HasValue("o_entes") && $this->entes->CurrentValue <> $this->entes->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idRol") && $objForm->HasValue("o_idRol") && $this->idRol->CurrentValue <> $this->idRol->OldValue)
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
				$this->idPrograma->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->idProyecto->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('idProyecto');
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
		$this->idProyecto->CurrentValue = NULL;
		$this->idProyecto->OldValue = $this->idProyecto->CurrentValue;
		$this->idPrograma->CurrentValue = NULL;
		$this->idPrograma->OldValue = $this->idPrograma->CurrentValue;
		$this->codigo->CurrentValue = NULL;
		$this->codigo->OldValue = $this->codigo->CurrentValue;
		$this->idUbicacion->CurrentValue = NULL;
		$this->idUbicacion->OldValue = $this->idUbicacion->CurrentValue;
		$this->idRegion->CurrentValue = NULL;
		$this->idRegion->OldValue = $this->idRegion->CurrentValue;
		$this->idDepto->CurrentValue = NULL;
		$this->idDepto->OldValue = $this->idDepto->CurrentValue;
		$this->idTramo->CurrentValue = NULL;
		$this->idTramo->OldValue = $this->idTramo->CurrentValue;
		$this->idRuta->CurrentValue = NULL;
		$this->idRuta->OldValue = $this->idRuta->CurrentValue;
		$this->idTipoRed->CurrentValue = NULL;
		$this->idTipoRed->OldValue = $this->idTipoRed->CurrentValue;
		$this->idProposito->CurrentValue = NULL;
		$this->idProposito->OldValue = $this->idProposito->CurrentValue;
		$this->presupuesto->CurrentValue = NULL;
		$this->presupuesto->OldValue = $this->presupuesto->CurrentValue;
		$this->especiplano->CurrentValue = NULL;
		$this->especiplano->OldValue = $this->especiplano->CurrentValue;
		$this->presuprogra->CurrentValue = NULL;
		$this->presuprogra->OldValue = $this->presuprogra->CurrentValue;
		$this->estudiofact->CurrentValue = NULL;
		$this->estudiofact->OldValue = $this->estudiofact->CurrentValue;
		$this->estudioimpact->CurrentValue = NULL;
		$this->estudioimpact->OldValue = $this->estudioimpact->CurrentValue;
		$this->licambi->CurrentValue = NULL;
		$this->licambi->OldValue = $this->licambi->CurrentValue;
		$this->estuimpactierra->CurrentValue = NULL;
		$this->estuimpactierra->OldValue = $this->estuimpactierra->CurrentValue;
		$this->planreasea->CurrentValue = NULL;
		$this->planreasea->OldValue = $this->planreasea->CurrentValue;
		$this->plananual->CurrentValue = NULL;
		$this->plananual->OldValue = $this->plananual->CurrentValue;
		$this->acuerdofinan->CurrentValue = NULL;
		$this->acuerdofinan->OldValue = $this->acuerdofinan->CurrentValue;
		$this->otro->CurrentValue = NULL;
		$this->otro->OldValue = $this->otro->CurrentValue;
		$this->fechacreacion->CurrentValue = NULL;
		$this->fechacreacion->OldValue = $this->fechacreacion->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->idFuncionario->CurrentValue = NULL;
		$this->idFuncionario->OldValue = $this->idFuncionario->CurrentValue;
		$this->fechaaprob->CurrentValue = NULL;
		$this->fechaaprob->OldValue = $this->fechaaprob->CurrentValue;
		$this->idfuente->CurrentValue = NULL;
		$this->idfuente->OldValue = $this->idfuente->CurrentValue;
		$this->codsefin->CurrentValue = NULL;
		$this->codsefin->OldValue = $this->codsefin->CurrentValue;
		$this->notaprioridad->CurrentValue = NULL;
		$this->notaprioridad->OldValue = $this->notaprioridad->CurrentValue;
		$this->constanciabanco->CurrentValue = NULL;
		$this->constanciabanco->OldValue = $this->constanciabanco->CurrentValue;
		$this->fecharecibido->CurrentValue = NULL;
		$this->fecharecibido->OldValue = $this->fecharecibido->CurrentValue;
		$this->clase->CurrentValue = NULL;
		$this->clase->OldValue = $this->clase->CurrentValue;
		$this->entes->CurrentValue = NULL;
		$this->entes->OldValue = $this->entes->CurrentValue;
		$this->idRol->CurrentValue = NULL;
		$this->idRol->OldValue = $this->idRol->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$objForm->FormName = $this->FormName;
		if (!$this->idProyecto->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idProyecto->setFormValue($objForm->GetValue("x_idProyecto"));
		if (!$this->idPrograma->FldIsDetailKey) {
			$this->idPrograma->setFormValue($objForm->GetValue("x_idPrograma"));
		}
		$this->idPrograma->setOldValue($objForm->GetValue("o_idPrograma"));
		if (!$this->codigo->FldIsDetailKey) {
			$this->codigo->setFormValue($objForm->GetValue("x_codigo"));
		}
		$this->codigo->setOldValue($objForm->GetValue("o_codigo"));
		if (!$this->idUbicacion->FldIsDetailKey) {
			$this->idUbicacion->setFormValue($objForm->GetValue("x_idUbicacion"));
		}
		$this->idUbicacion->setOldValue($objForm->GetValue("o_idUbicacion"));
		if (!$this->idRegion->FldIsDetailKey) {
			$this->idRegion->setFormValue($objForm->GetValue("x_idRegion"));
		}
		$this->idRegion->setOldValue($objForm->GetValue("o_idRegion"));
		if (!$this->idDepto->FldIsDetailKey) {
			$this->idDepto->setFormValue($objForm->GetValue("x_idDepto"));
		}
		$this->idDepto->setOldValue($objForm->GetValue("o_idDepto"));
		if (!$this->idTramo->FldIsDetailKey) {
			$this->idTramo->setFormValue($objForm->GetValue("x_idTramo"));
		}
		$this->idTramo->setOldValue($objForm->GetValue("o_idTramo"));
		if (!$this->idRuta->FldIsDetailKey) {
			$this->idRuta->setFormValue($objForm->GetValue("x_idRuta"));
		}
		$this->idRuta->setOldValue($objForm->GetValue("o_idRuta"));
		if (!$this->idTipoRed->FldIsDetailKey) {
			$this->idTipoRed->setFormValue($objForm->GetValue("x_idTipoRed"));
		}
		$this->idTipoRed->setOldValue($objForm->GetValue("o_idTipoRed"));
		if (!$this->idProposito->FldIsDetailKey) {
			$this->idProposito->setFormValue($objForm->GetValue("x_idProposito"));
		}
		$this->idProposito->setOldValue($objForm->GetValue("o_idProposito"));
		if (!$this->presupuesto->FldIsDetailKey) {
			$this->presupuesto->setFormValue($objForm->GetValue("x_presupuesto"));
		}
		$this->presupuesto->setOldValue($objForm->GetValue("o_presupuesto"));
		if (!$this->especiplano->FldIsDetailKey) {
			$this->especiplano->setFormValue($objForm->GetValue("x_especiplano"));
		}
		$this->especiplano->setOldValue($objForm->GetValue("o_especiplano"));
		if (!$this->presuprogra->FldIsDetailKey) {
			$this->presuprogra->setFormValue($objForm->GetValue("x_presuprogra"));
		}
		$this->presuprogra->setOldValue($objForm->GetValue("o_presuprogra"));
		if (!$this->estudiofact->FldIsDetailKey) {
			$this->estudiofact->setFormValue($objForm->GetValue("x_estudiofact"));
		}
		$this->estudiofact->setOldValue($objForm->GetValue("o_estudiofact"));
		if (!$this->estudioimpact->FldIsDetailKey) {
			$this->estudioimpact->setFormValue($objForm->GetValue("x_estudioimpact"));
		}
		$this->estudioimpact->setOldValue($objForm->GetValue("o_estudioimpact"));
		if (!$this->licambi->FldIsDetailKey) {
			$this->licambi->setFormValue($objForm->GetValue("x_licambi"));
		}
		$this->licambi->setOldValue($objForm->GetValue("o_licambi"));
		if (!$this->estuimpactierra->FldIsDetailKey) {
			$this->estuimpactierra->setFormValue($objForm->GetValue("x_estuimpactierra"));
		}
		$this->estuimpactierra->setOldValue($objForm->GetValue("o_estuimpactierra"));
		if (!$this->planreasea->FldIsDetailKey) {
			$this->planreasea->setFormValue($objForm->GetValue("x_planreasea"));
		}
		$this->planreasea->setOldValue($objForm->GetValue("o_planreasea"));
		if (!$this->plananual->FldIsDetailKey) {
			$this->plananual->setFormValue($objForm->GetValue("x_plananual"));
		}
		$this->plananual->setOldValue($objForm->GetValue("o_plananual"));
		if (!$this->acuerdofinan->FldIsDetailKey) {
			$this->acuerdofinan->setFormValue($objForm->GetValue("x_acuerdofinan"));
		}
		$this->acuerdofinan->setOldValue($objForm->GetValue("o_acuerdofinan"));
		if (!$this->otro->FldIsDetailKey) {
			$this->otro->setFormValue($objForm->GetValue("x_otro"));
		}
		$this->otro->setOldValue($objForm->GetValue("o_otro"));
		if (!$this->fechacreacion->FldIsDetailKey) {
			$this->fechacreacion->setFormValue($objForm->GetValue("x_fechacreacion"));
		}
		$this->fechacreacion->setOldValue($objForm->GetValue("o_fechacreacion"));
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$this->estado->setOldValue($objForm->GetValue("o_estado"));
		if (!$this->idFuncionario->FldIsDetailKey) {
			$this->idFuncionario->setFormValue($objForm->GetValue("x_idFuncionario"));
		}
		$this->idFuncionario->setOldValue($objForm->GetValue("o_idFuncionario"));
		if (!$this->fechaaprob->FldIsDetailKey) {
			$this->fechaaprob->setFormValue($objForm->GetValue("x_fechaaprob"));
		}
		$this->fechaaprob->setOldValue($objForm->GetValue("o_fechaaprob"));
		if (!$this->idfuente->FldIsDetailKey) {
			$this->idfuente->setFormValue($objForm->GetValue("x_idfuente"));
		}
		$this->idfuente->setOldValue($objForm->GetValue("o_idfuente"));
		if (!$this->codsefin->FldIsDetailKey) {
			$this->codsefin->setFormValue($objForm->GetValue("x_codsefin"));
		}
		$this->codsefin->setOldValue($objForm->GetValue("o_codsefin"));
		if (!$this->notaprioridad->FldIsDetailKey) {
			$this->notaprioridad->setFormValue($objForm->GetValue("x_notaprioridad"));
		}
		$this->notaprioridad->setOldValue($objForm->GetValue("o_notaprioridad"));
		if (!$this->constanciabanco->FldIsDetailKey) {
			$this->constanciabanco->setFormValue($objForm->GetValue("x_constanciabanco"));
		}
		$this->constanciabanco->setOldValue($objForm->GetValue("o_constanciabanco"));
		if (!$this->fecharecibido->FldIsDetailKey) {
			$this->fecharecibido->setFormValue($objForm->GetValue("x_fecharecibido"));
		}
		$this->fecharecibido->setOldValue($objForm->GetValue("o_fecharecibido"));
		if (!$this->clase->FldIsDetailKey) {
			$this->clase->setFormValue($objForm->GetValue("x_clase"));
		}
		$this->clase->setOldValue($objForm->GetValue("o_clase"));
		if (!$this->entes->FldIsDetailKey) {
			$this->entes->setFormValue($objForm->GetValue("x_entes"));
		}
		$this->entes->setOldValue($objForm->GetValue("o_entes"));
		if (!$this->idRol->FldIsDetailKey) {
			$this->idRol->setFormValue($objForm->GetValue("x_idRol"));
		}
		$this->idRol->setOldValue($objForm->GetValue("o_idRol"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idProyecto->CurrentValue = $this->idProyecto->FormValue;
		$this->idPrograma->CurrentValue = $this->idPrograma->FormValue;
		$this->codigo->CurrentValue = $this->codigo->FormValue;
		$this->idUbicacion->CurrentValue = $this->idUbicacion->FormValue;
		$this->idRegion->CurrentValue = $this->idRegion->FormValue;
		$this->idDepto->CurrentValue = $this->idDepto->FormValue;
		$this->idTramo->CurrentValue = $this->idTramo->FormValue;
		$this->idRuta->CurrentValue = $this->idRuta->FormValue;
		$this->idTipoRed->CurrentValue = $this->idTipoRed->FormValue;
		$this->idProposito->CurrentValue = $this->idProposito->FormValue;
		$this->presupuesto->CurrentValue = $this->presupuesto->FormValue;
		$this->especiplano->CurrentValue = $this->especiplano->FormValue;
		$this->presuprogra->CurrentValue = $this->presuprogra->FormValue;
		$this->estudiofact->CurrentValue = $this->estudiofact->FormValue;
		$this->estudioimpact->CurrentValue = $this->estudioimpact->FormValue;
		$this->licambi->CurrentValue = $this->licambi->FormValue;
		$this->estuimpactierra->CurrentValue = $this->estuimpactierra->FormValue;
		$this->planreasea->CurrentValue = $this->planreasea->FormValue;
		$this->plananual->CurrentValue = $this->plananual->FormValue;
		$this->acuerdofinan->CurrentValue = $this->acuerdofinan->FormValue;
		$this->otro->CurrentValue = $this->otro->FormValue;
		$this->fechacreacion->CurrentValue = $this->fechacreacion->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->idFuncionario->CurrentValue = $this->idFuncionario->FormValue;
		$this->fechaaprob->CurrentValue = $this->fechaaprob->FormValue;
		$this->idfuente->CurrentValue = $this->idfuente->FormValue;
		$this->codsefin->CurrentValue = $this->codsefin->FormValue;
		$this->notaprioridad->CurrentValue = $this->notaprioridad->FormValue;
		$this->constanciabanco->CurrentValue = $this->constanciabanco->FormValue;
		$this->fecharecibido->CurrentValue = $this->fecharecibido->FormValue;
		$this->clase->CurrentValue = $this->clase->FormValue;
		$this->entes->CurrentValue = $this->entes->FormValue;
		$this->idRol->CurrentValue = $this->idRol->FormValue;
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
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->idProyecto->CurrentValue = strval($arKeys[0]); // idProyecto
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// idProyecto
			// idPrograma

			$this->idPrograma->EditAttrs["class"] = "form-control";
			$this->idPrograma->EditCustomAttributes = "";
			if ($this->idPrograma->getSessionValue() <> "") {
				$this->idPrograma->CurrentValue = $this->idPrograma->getSessionValue();
				$this->idPrograma->OldValue = $this->idPrograma->CurrentValue;
			$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
			$this->idPrograma->ViewCustomAttributes = "";
			} else {
			$this->idPrograma->EditValue = ew_HtmlEncode($this->idPrograma->CurrentValue);
			$this->idPrograma->PlaceHolder = ew_RemoveHtml($this->idPrograma->FldCaption());
			}

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			$this->codigo->EditValue = ew_HtmlEncode($this->codigo->CurrentValue);
			$this->codigo->PlaceHolder = ew_RemoveHtml($this->codigo->FldCaption());

			// idUbicacion
			$this->idUbicacion->EditAttrs["class"] = "form-control";
			$this->idUbicacion->EditCustomAttributes = "";
			$this->idUbicacion->EditValue = ew_HtmlEncode($this->idUbicacion->CurrentValue);
			$this->idUbicacion->PlaceHolder = ew_RemoveHtml($this->idUbicacion->FldCaption());

			// idRegion
			$this->idRegion->EditAttrs["class"] = "form-control";
			$this->idRegion->EditCustomAttributes = "";
			$this->idRegion->EditValue = ew_HtmlEncode($this->idRegion->CurrentValue);
			$this->idRegion->PlaceHolder = ew_RemoveHtml($this->idRegion->FldCaption());

			// idDepto
			$this->idDepto->EditAttrs["class"] = "form-control";
			$this->idDepto->EditCustomAttributes = "";
			$this->idDepto->EditValue = ew_HtmlEncode($this->idDepto->CurrentValue);
			$this->idDepto->PlaceHolder = ew_RemoveHtml($this->idDepto->FldCaption());

			// idTramo
			$this->idTramo->EditAttrs["class"] = "form-control";
			$this->idTramo->EditCustomAttributes = "";
			$this->idTramo->EditValue = ew_HtmlEncode($this->idTramo->CurrentValue);
			$this->idTramo->PlaceHolder = ew_RemoveHtml($this->idTramo->FldCaption());

			// idRuta
			$this->idRuta->EditAttrs["class"] = "form-control";
			$this->idRuta->EditCustomAttributes = "";
			$this->idRuta->EditValue = ew_HtmlEncode($this->idRuta->CurrentValue);
			$this->idRuta->PlaceHolder = ew_RemoveHtml($this->idRuta->FldCaption());

			// idTipoRed
			$this->idTipoRed->EditAttrs["class"] = "form-control";
			$this->idTipoRed->EditCustomAttributes = "";
			$this->idTipoRed->EditValue = ew_HtmlEncode($this->idTipoRed->CurrentValue);
			$this->idTipoRed->PlaceHolder = ew_RemoveHtml($this->idTipoRed->FldCaption());

			// idProposito
			$this->idProposito->EditAttrs["class"] = "form-control";
			$this->idProposito->EditCustomAttributes = "";
			$this->idProposito->EditValue = ew_HtmlEncode($this->idProposito->CurrentValue);
			$this->idProposito->PlaceHolder = ew_RemoveHtml($this->idProposito->FldCaption());

			// presupuesto
			$this->presupuesto->EditAttrs["class"] = "form-control";
			$this->presupuesto->EditCustomAttributes = "";
			$this->presupuesto->EditValue = ew_HtmlEncode($this->presupuesto->CurrentValue);
			$this->presupuesto->PlaceHolder = ew_RemoveHtml($this->presupuesto->FldCaption());
			if (strval($this->presupuesto->EditValue) <> "" && is_numeric($this->presupuesto->EditValue)) {
			$this->presupuesto->EditValue = ew_FormatNumber($this->presupuesto->EditValue, -2, -1, -2, 0);
			$this->presupuesto->OldValue = $this->presupuesto->EditValue;
			}

			// especiplano
			$this->especiplano->EditAttrs["class"] = "form-control";
			$this->especiplano->EditCustomAttributes = "";
			$this->especiplano->EditValue = ew_HtmlEncode($this->especiplano->CurrentValue);
			$this->especiplano->PlaceHolder = ew_RemoveHtml($this->especiplano->FldCaption());

			// presuprogra
			$this->presuprogra->EditAttrs["class"] = "form-control";
			$this->presuprogra->EditCustomAttributes = "";
			$this->presuprogra->EditValue = ew_HtmlEncode($this->presuprogra->CurrentValue);
			$this->presuprogra->PlaceHolder = ew_RemoveHtml($this->presuprogra->FldCaption());

			// estudiofact
			$this->estudiofact->EditAttrs["class"] = "form-control";
			$this->estudiofact->EditCustomAttributes = "";
			$this->estudiofact->EditValue = ew_HtmlEncode($this->estudiofact->CurrentValue);
			$this->estudiofact->PlaceHolder = ew_RemoveHtml($this->estudiofact->FldCaption());

			// estudioimpact
			$this->estudioimpact->EditAttrs["class"] = "form-control";
			$this->estudioimpact->EditCustomAttributes = "";
			$this->estudioimpact->EditValue = ew_HtmlEncode($this->estudioimpact->CurrentValue);
			$this->estudioimpact->PlaceHolder = ew_RemoveHtml($this->estudioimpact->FldCaption());

			// licambi
			$this->licambi->EditAttrs["class"] = "form-control";
			$this->licambi->EditCustomAttributes = "";
			$this->licambi->EditValue = ew_HtmlEncode($this->licambi->CurrentValue);
			$this->licambi->PlaceHolder = ew_RemoveHtml($this->licambi->FldCaption());

			// estuimpactierra
			$this->estuimpactierra->EditAttrs["class"] = "form-control";
			$this->estuimpactierra->EditCustomAttributes = "";
			$this->estuimpactierra->EditValue = ew_HtmlEncode($this->estuimpactierra->CurrentValue);
			$this->estuimpactierra->PlaceHolder = ew_RemoveHtml($this->estuimpactierra->FldCaption());

			// planreasea
			$this->planreasea->EditAttrs["class"] = "form-control";
			$this->planreasea->EditCustomAttributes = "";
			$this->planreasea->EditValue = ew_HtmlEncode($this->planreasea->CurrentValue);
			$this->planreasea->PlaceHolder = ew_RemoveHtml($this->planreasea->FldCaption());

			// plananual
			$this->plananual->EditAttrs["class"] = "form-control";
			$this->plananual->EditCustomAttributes = "";
			$this->plananual->EditValue = ew_HtmlEncode($this->plananual->CurrentValue);
			$this->plananual->PlaceHolder = ew_RemoveHtml($this->plananual->FldCaption());

			// acuerdofinan
			$this->acuerdofinan->EditAttrs["class"] = "form-control";
			$this->acuerdofinan->EditCustomAttributes = "";
			$this->acuerdofinan->EditValue = ew_HtmlEncode($this->acuerdofinan->CurrentValue);
			$this->acuerdofinan->PlaceHolder = ew_RemoveHtml($this->acuerdofinan->FldCaption());

			// otro
			$this->otro->EditAttrs["class"] = "form-control";
			$this->otro->EditCustomAttributes = "";
			$this->otro->EditValue = ew_HtmlEncode($this->otro->CurrentValue);
			$this->otro->PlaceHolder = ew_RemoveHtml($this->otro->FldCaption());

			// fechacreacion
			$this->fechacreacion->EditAttrs["class"] = "form-control";
			$this->fechacreacion->EditCustomAttributes = "";
			$this->fechacreacion->EditValue = ew_HtmlEncode($this->fechacreacion->CurrentValue);
			$this->fechacreacion->PlaceHolder = ew_RemoveHtml($this->fechacreacion->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// idFuncionario
			$this->idFuncionario->EditAttrs["class"] = "form-control";
			$this->idFuncionario->EditCustomAttributes = "";
			$this->idFuncionario->EditValue = ew_HtmlEncode($this->idFuncionario->CurrentValue);
			$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

			// fechaaprob
			$this->fechaaprob->EditAttrs["class"] = "form-control";
			$this->fechaaprob->EditCustomAttributes = "";
			$this->fechaaprob->EditValue = ew_HtmlEncode($this->fechaaprob->CurrentValue);
			$this->fechaaprob->PlaceHolder = ew_RemoveHtml($this->fechaaprob->FldCaption());

			// idfuente
			$this->idfuente->EditAttrs["class"] = "form-control";
			$this->idfuente->EditCustomAttributes = "";
			$this->idfuente->EditValue = ew_HtmlEncode($this->idfuente->CurrentValue);
			$this->idfuente->PlaceHolder = ew_RemoveHtml($this->idfuente->FldCaption());

			// codsefin
			$this->codsefin->EditAttrs["class"] = "form-control";
			$this->codsefin->EditCustomAttributes = "";
			$this->codsefin->EditValue = ew_HtmlEncode($this->codsefin->CurrentValue);
			$this->codsefin->PlaceHolder = ew_RemoveHtml($this->codsefin->FldCaption());

			// notaprioridad
			$this->notaprioridad->EditAttrs["class"] = "form-control";
			$this->notaprioridad->EditCustomAttributes = "";
			$this->notaprioridad->EditValue = ew_HtmlEncode($this->notaprioridad->CurrentValue);
			$this->notaprioridad->PlaceHolder = ew_RemoveHtml($this->notaprioridad->FldCaption());

			// constanciabanco
			$this->constanciabanco->EditAttrs["class"] = "form-control";
			$this->constanciabanco->EditCustomAttributes = "";
			$this->constanciabanco->EditValue = ew_HtmlEncode($this->constanciabanco->CurrentValue);
			$this->constanciabanco->PlaceHolder = ew_RemoveHtml($this->constanciabanco->FldCaption());

			// fecharecibido
			$this->fecharecibido->EditAttrs["class"] = "form-control";
			$this->fecharecibido->EditCustomAttributes = "";
			$this->fecharecibido->EditValue = ew_HtmlEncode($this->fecharecibido->CurrentValue);
			$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

			// clase
			$this->clase->EditAttrs["class"] = "form-control";
			$this->clase->EditCustomAttributes = "";
			$this->clase->EditValue = ew_HtmlEncode($this->clase->CurrentValue);
			$this->clase->PlaceHolder = ew_RemoveHtml($this->clase->FldCaption());

			// entes
			$this->entes->EditAttrs["class"] = "form-control";
			$this->entes->EditCustomAttributes = "";
			$this->entes->EditValue = ew_HtmlEncode($this->entes->CurrentValue);
			$this->entes->PlaceHolder = ew_RemoveHtml($this->entes->FldCaption());

			// idRol
			$this->idRol->EditAttrs["class"] = "form-control";
			$this->idRol->EditCustomAttributes = "";
			$this->idRol->EditValue = ew_HtmlEncode($this->idRol->CurrentValue);
			$this->idRol->PlaceHolder = ew_RemoveHtml($this->idRol->FldCaption());

			// Edit refer script
			// idProyecto

			$this->idProyecto->HrefValue = "";

			// idPrograma
			$this->idPrograma->HrefValue = "";

			// codigo
			$this->codigo->HrefValue = "";

			// idUbicacion
			$this->idUbicacion->HrefValue = "";

			// idRegion
			$this->idRegion->HrefValue = "";

			// idDepto
			$this->idDepto->HrefValue = "";

			// idTramo
			$this->idTramo->HrefValue = "";

			// idRuta
			$this->idRuta->HrefValue = "";

			// idTipoRed
			$this->idTipoRed->HrefValue = "";

			// idProposito
			$this->idProposito->HrefValue = "";

			// presupuesto
			$this->presupuesto->HrefValue = "";

			// especiplano
			$this->especiplano->HrefValue = "";

			// presuprogra
			$this->presuprogra->HrefValue = "";

			// estudiofact
			$this->estudiofact->HrefValue = "";

			// estudioimpact
			$this->estudioimpact->HrefValue = "";

			// licambi
			$this->licambi->HrefValue = "";

			// estuimpactierra
			$this->estuimpactierra->HrefValue = "";

			// planreasea
			$this->planreasea->HrefValue = "";

			// plananual
			$this->plananual->HrefValue = "";

			// acuerdofinan
			$this->acuerdofinan->HrefValue = "";

			// otro
			$this->otro->HrefValue = "";

			// fechacreacion
			$this->fechacreacion->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// idFuncionario
			$this->idFuncionario->HrefValue = "";

			// fechaaprob
			$this->fechaaprob->HrefValue = "";

			// idfuente
			$this->idfuente->HrefValue = "";

			// codsefin
			$this->codsefin->HrefValue = "";

			// notaprioridad
			$this->notaprioridad->HrefValue = "";

			// constanciabanco
			$this->constanciabanco->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";

			// clase
			$this->clase->HrefValue = "";

			// entes
			$this->entes->HrefValue = "";

			// idRol
			$this->idRol->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idProyecto
			$this->idProyecto->EditAttrs["class"] = "form-control";
			$this->idProyecto->EditCustomAttributes = "";
			$this->idProyecto->EditValue = $this->idProyecto->CurrentValue;
			$this->idProyecto->ViewCustomAttributes = "";

			// idPrograma
			$this->idPrograma->EditAttrs["class"] = "form-control";
			$this->idPrograma->EditCustomAttributes = "";
			if ($this->idPrograma->getSessionValue() <> "") {
				$this->idPrograma->CurrentValue = $this->idPrograma->getSessionValue();
				$this->idPrograma->OldValue = $this->idPrograma->CurrentValue;
			$this->idPrograma->ViewValue = $this->idPrograma->CurrentValue;
			$this->idPrograma->ViewCustomAttributes = "";
			} else {
			$this->idPrograma->EditValue = ew_HtmlEncode($this->idPrograma->CurrentValue);
			$this->idPrograma->PlaceHolder = ew_RemoveHtml($this->idPrograma->FldCaption());
			}

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			$this->codigo->EditValue = ew_HtmlEncode($this->codigo->CurrentValue);
			$this->codigo->PlaceHolder = ew_RemoveHtml($this->codigo->FldCaption());

			// idUbicacion
			$this->idUbicacion->EditAttrs["class"] = "form-control";
			$this->idUbicacion->EditCustomAttributes = "";
			$this->idUbicacion->EditValue = ew_HtmlEncode($this->idUbicacion->CurrentValue);
			$this->idUbicacion->PlaceHolder = ew_RemoveHtml($this->idUbicacion->FldCaption());

			// idRegion
			$this->idRegion->EditAttrs["class"] = "form-control";
			$this->idRegion->EditCustomAttributes = "";
			$this->idRegion->EditValue = ew_HtmlEncode($this->idRegion->CurrentValue);
			$this->idRegion->PlaceHolder = ew_RemoveHtml($this->idRegion->FldCaption());

			// idDepto
			$this->idDepto->EditAttrs["class"] = "form-control";
			$this->idDepto->EditCustomAttributes = "";
			$this->idDepto->EditValue = ew_HtmlEncode($this->idDepto->CurrentValue);
			$this->idDepto->PlaceHolder = ew_RemoveHtml($this->idDepto->FldCaption());

			// idTramo
			$this->idTramo->EditAttrs["class"] = "form-control";
			$this->idTramo->EditCustomAttributes = "";
			$this->idTramo->EditValue = ew_HtmlEncode($this->idTramo->CurrentValue);
			$this->idTramo->PlaceHolder = ew_RemoveHtml($this->idTramo->FldCaption());

			// idRuta
			$this->idRuta->EditAttrs["class"] = "form-control";
			$this->idRuta->EditCustomAttributes = "";
			$this->idRuta->EditValue = ew_HtmlEncode($this->idRuta->CurrentValue);
			$this->idRuta->PlaceHolder = ew_RemoveHtml($this->idRuta->FldCaption());

			// idTipoRed
			$this->idTipoRed->EditAttrs["class"] = "form-control";
			$this->idTipoRed->EditCustomAttributes = "";
			$this->idTipoRed->EditValue = ew_HtmlEncode($this->idTipoRed->CurrentValue);
			$this->idTipoRed->PlaceHolder = ew_RemoveHtml($this->idTipoRed->FldCaption());

			// idProposito
			$this->idProposito->EditAttrs["class"] = "form-control";
			$this->idProposito->EditCustomAttributes = "";
			$this->idProposito->EditValue = ew_HtmlEncode($this->idProposito->CurrentValue);
			$this->idProposito->PlaceHolder = ew_RemoveHtml($this->idProposito->FldCaption());

			// presupuesto
			$this->presupuesto->EditAttrs["class"] = "form-control";
			$this->presupuesto->EditCustomAttributes = "";
			$this->presupuesto->EditValue = ew_HtmlEncode($this->presupuesto->CurrentValue);
			$this->presupuesto->PlaceHolder = ew_RemoveHtml($this->presupuesto->FldCaption());
			if (strval($this->presupuesto->EditValue) <> "" && is_numeric($this->presupuesto->EditValue)) {
			$this->presupuesto->EditValue = ew_FormatNumber($this->presupuesto->EditValue, -2, -1, -2, 0);
			$this->presupuesto->OldValue = $this->presupuesto->EditValue;
			}

			// especiplano
			$this->especiplano->EditAttrs["class"] = "form-control";
			$this->especiplano->EditCustomAttributes = "";
			$this->especiplano->EditValue = ew_HtmlEncode($this->especiplano->CurrentValue);
			$this->especiplano->PlaceHolder = ew_RemoveHtml($this->especiplano->FldCaption());

			// presuprogra
			$this->presuprogra->EditAttrs["class"] = "form-control";
			$this->presuprogra->EditCustomAttributes = "";
			$this->presuprogra->EditValue = ew_HtmlEncode($this->presuprogra->CurrentValue);
			$this->presuprogra->PlaceHolder = ew_RemoveHtml($this->presuprogra->FldCaption());

			// estudiofact
			$this->estudiofact->EditAttrs["class"] = "form-control";
			$this->estudiofact->EditCustomAttributes = "";
			$this->estudiofact->EditValue = ew_HtmlEncode($this->estudiofact->CurrentValue);
			$this->estudiofact->PlaceHolder = ew_RemoveHtml($this->estudiofact->FldCaption());

			// estudioimpact
			$this->estudioimpact->EditAttrs["class"] = "form-control";
			$this->estudioimpact->EditCustomAttributes = "";
			$this->estudioimpact->EditValue = ew_HtmlEncode($this->estudioimpact->CurrentValue);
			$this->estudioimpact->PlaceHolder = ew_RemoveHtml($this->estudioimpact->FldCaption());

			// licambi
			$this->licambi->EditAttrs["class"] = "form-control";
			$this->licambi->EditCustomAttributes = "";
			$this->licambi->EditValue = ew_HtmlEncode($this->licambi->CurrentValue);
			$this->licambi->PlaceHolder = ew_RemoveHtml($this->licambi->FldCaption());

			// estuimpactierra
			$this->estuimpactierra->EditAttrs["class"] = "form-control";
			$this->estuimpactierra->EditCustomAttributes = "";
			$this->estuimpactierra->EditValue = ew_HtmlEncode($this->estuimpactierra->CurrentValue);
			$this->estuimpactierra->PlaceHolder = ew_RemoveHtml($this->estuimpactierra->FldCaption());

			// planreasea
			$this->planreasea->EditAttrs["class"] = "form-control";
			$this->planreasea->EditCustomAttributes = "";
			$this->planreasea->EditValue = ew_HtmlEncode($this->planreasea->CurrentValue);
			$this->planreasea->PlaceHolder = ew_RemoveHtml($this->planreasea->FldCaption());

			// plananual
			$this->plananual->EditAttrs["class"] = "form-control";
			$this->plananual->EditCustomAttributes = "";
			$this->plananual->EditValue = ew_HtmlEncode($this->plananual->CurrentValue);
			$this->plananual->PlaceHolder = ew_RemoveHtml($this->plananual->FldCaption());

			// acuerdofinan
			$this->acuerdofinan->EditAttrs["class"] = "form-control";
			$this->acuerdofinan->EditCustomAttributes = "";
			$this->acuerdofinan->EditValue = ew_HtmlEncode($this->acuerdofinan->CurrentValue);
			$this->acuerdofinan->PlaceHolder = ew_RemoveHtml($this->acuerdofinan->FldCaption());

			// otro
			$this->otro->EditAttrs["class"] = "form-control";
			$this->otro->EditCustomAttributes = "";
			$this->otro->EditValue = ew_HtmlEncode($this->otro->CurrentValue);
			$this->otro->PlaceHolder = ew_RemoveHtml($this->otro->FldCaption());

			// fechacreacion
			$this->fechacreacion->EditAttrs["class"] = "form-control";
			$this->fechacreacion->EditCustomAttributes = "";
			$this->fechacreacion->EditValue = ew_HtmlEncode($this->fechacreacion->CurrentValue);
			$this->fechacreacion->PlaceHolder = ew_RemoveHtml($this->fechacreacion->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// idFuncionario
			$this->idFuncionario->EditAttrs["class"] = "form-control";
			$this->idFuncionario->EditCustomAttributes = "";
			$this->idFuncionario->EditValue = ew_HtmlEncode($this->idFuncionario->CurrentValue);
			$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

			// fechaaprob
			$this->fechaaprob->EditAttrs["class"] = "form-control";
			$this->fechaaprob->EditCustomAttributes = "";
			$this->fechaaprob->EditValue = ew_HtmlEncode($this->fechaaprob->CurrentValue);
			$this->fechaaprob->PlaceHolder = ew_RemoveHtml($this->fechaaprob->FldCaption());

			// idfuente
			$this->idfuente->EditAttrs["class"] = "form-control";
			$this->idfuente->EditCustomAttributes = "";
			$this->idfuente->EditValue = ew_HtmlEncode($this->idfuente->CurrentValue);
			$this->idfuente->PlaceHolder = ew_RemoveHtml($this->idfuente->FldCaption());

			// codsefin
			$this->codsefin->EditAttrs["class"] = "form-control";
			$this->codsefin->EditCustomAttributes = "";
			$this->codsefin->EditValue = ew_HtmlEncode($this->codsefin->CurrentValue);
			$this->codsefin->PlaceHolder = ew_RemoveHtml($this->codsefin->FldCaption());

			// notaprioridad
			$this->notaprioridad->EditAttrs["class"] = "form-control";
			$this->notaprioridad->EditCustomAttributes = "";
			$this->notaprioridad->EditValue = ew_HtmlEncode($this->notaprioridad->CurrentValue);
			$this->notaprioridad->PlaceHolder = ew_RemoveHtml($this->notaprioridad->FldCaption());

			// constanciabanco
			$this->constanciabanco->EditAttrs["class"] = "form-control";
			$this->constanciabanco->EditCustomAttributes = "";
			$this->constanciabanco->EditValue = ew_HtmlEncode($this->constanciabanco->CurrentValue);
			$this->constanciabanco->PlaceHolder = ew_RemoveHtml($this->constanciabanco->FldCaption());

			// fecharecibido
			$this->fecharecibido->EditAttrs["class"] = "form-control";
			$this->fecharecibido->EditCustomAttributes = "";
			$this->fecharecibido->EditValue = ew_HtmlEncode($this->fecharecibido->CurrentValue);
			$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

			// clase
			$this->clase->EditAttrs["class"] = "form-control";
			$this->clase->EditCustomAttributes = "";
			$this->clase->EditValue = ew_HtmlEncode($this->clase->CurrentValue);
			$this->clase->PlaceHolder = ew_RemoveHtml($this->clase->FldCaption());

			// entes
			$this->entes->EditAttrs["class"] = "form-control";
			$this->entes->EditCustomAttributes = "";
			$this->entes->EditValue = ew_HtmlEncode($this->entes->CurrentValue);
			$this->entes->PlaceHolder = ew_RemoveHtml($this->entes->FldCaption());

			// idRol
			$this->idRol->EditAttrs["class"] = "form-control";
			$this->idRol->EditCustomAttributes = "";
			$this->idRol->EditValue = ew_HtmlEncode($this->idRol->CurrentValue);
			$this->idRol->PlaceHolder = ew_RemoveHtml($this->idRol->FldCaption());

			// Edit refer script
			// idProyecto

			$this->idProyecto->HrefValue = "";

			// idPrograma
			$this->idPrograma->HrefValue = "";

			// codigo
			$this->codigo->HrefValue = "";

			// idUbicacion
			$this->idUbicacion->HrefValue = "";

			// idRegion
			$this->idRegion->HrefValue = "";

			// idDepto
			$this->idDepto->HrefValue = "";

			// idTramo
			$this->idTramo->HrefValue = "";

			// idRuta
			$this->idRuta->HrefValue = "";

			// idTipoRed
			$this->idTipoRed->HrefValue = "";

			// idProposito
			$this->idProposito->HrefValue = "";

			// presupuesto
			$this->presupuesto->HrefValue = "";

			// especiplano
			$this->especiplano->HrefValue = "";

			// presuprogra
			$this->presuprogra->HrefValue = "";

			// estudiofact
			$this->estudiofact->HrefValue = "";

			// estudioimpact
			$this->estudioimpact->HrefValue = "";

			// licambi
			$this->licambi->HrefValue = "";

			// estuimpactierra
			$this->estuimpactierra->HrefValue = "";

			// planreasea
			$this->planreasea->HrefValue = "";

			// plananual
			$this->plananual->HrefValue = "";

			// acuerdofinan
			$this->acuerdofinan->HrefValue = "";

			// otro
			$this->otro->HrefValue = "";

			// fechacreacion
			$this->fechacreacion->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// idFuncionario
			$this->idFuncionario->HrefValue = "";

			// fechaaprob
			$this->fechaaprob->HrefValue = "";

			// idfuente
			$this->idfuente->HrefValue = "";

			// codsefin
			$this->codsefin->HrefValue = "";

			// notaprioridad
			$this->notaprioridad->HrefValue = "";

			// constanciabanco
			$this->constanciabanco->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";

			// clase
			$this->clase->HrefValue = "";

			// entes
			$this->entes->HrefValue = "";

			// idRol
			$this->idRol->HrefValue = "";
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
		if (!$this->idPrograma->FldIsDetailKey && !is_null($this->idPrograma->FormValue) && $this->idPrograma->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idPrograma->FldCaption(), $this->idPrograma->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idPrograma->FormValue)) {
			ew_AddMessage($gsFormError, $this->idPrograma->FldErrMsg());
		}
		if (!$this->codigo->FldIsDetailKey && !is_null($this->codigo->FormValue) && $this->codigo->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->codigo->FldCaption(), $this->codigo->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idUbicacion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idUbicacion->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idRegion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idRegion->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idDepto->FormValue)) {
			ew_AddMessage($gsFormError, $this->idDepto->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idTramo->FormValue)) {
			ew_AddMessage($gsFormError, $this->idTramo->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idRuta->FormValue)) {
			ew_AddMessage($gsFormError, $this->idRuta->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idTipoRed->FormValue)) {
			ew_AddMessage($gsFormError, $this->idTipoRed->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idProposito->FormValue)) {
			ew_AddMessage($gsFormError, $this->idProposito->FldErrMsg());
		}
		if (!ew_CheckNumber($this->presupuesto->FormValue)) {
			ew_AddMessage($gsFormError, $this->presupuesto->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idFuncionario->FormValue)) {
			ew_AddMessage($gsFormError, $this->idFuncionario->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idfuente->FormValue)) {
			ew_AddMessage($gsFormError, $this->idfuente->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idRol->FormValue)) {
			ew_AddMessage($gsFormError, $this->idRol->FldErrMsg());
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

		// Check if records exist for detail table 'cs_calificacion'
		if (!isset($GLOBALS["cs_calificacion"])) $GLOBALS["cs_calificacion"] = new ccs_calificacion();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["cs_calificacion"]->LoadRs("`idProyecto` = " . ew_QuotedValue($row['idProyecto'], EW_DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$sRelatedRecordMsg = str_replace("%t", "cs_calificacion", $Language->Phrase("RelatedRecordExists"));
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
				$sThisKey .= $row['idProyecto'];
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

			// idPrograma
			$this->idPrograma->SetDbValueDef($rsnew, $this->idPrograma->CurrentValue, 0, $this->idPrograma->ReadOnly);

			// codigo
			$this->codigo->SetDbValueDef($rsnew, $this->codigo->CurrentValue, "", $this->codigo->ReadOnly);

			// idUbicacion
			$this->idUbicacion->SetDbValueDef($rsnew, $this->idUbicacion->CurrentValue, NULL, $this->idUbicacion->ReadOnly);

			// idRegion
			$this->idRegion->SetDbValueDef($rsnew, $this->idRegion->CurrentValue, NULL, $this->idRegion->ReadOnly);

			// idDepto
			$this->idDepto->SetDbValueDef($rsnew, $this->idDepto->CurrentValue, NULL, $this->idDepto->ReadOnly);

			// idTramo
			$this->idTramo->SetDbValueDef($rsnew, $this->idTramo->CurrentValue, NULL, $this->idTramo->ReadOnly);

			// idRuta
			$this->idRuta->SetDbValueDef($rsnew, $this->idRuta->CurrentValue, NULL, $this->idRuta->ReadOnly);

			// idTipoRed
			$this->idTipoRed->SetDbValueDef($rsnew, $this->idTipoRed->CurrentValue, NULL, $this->idTipoRed->ReadOnly);

			// idProposito
			$this->idProposito->SetDbValueDef($rsnew, $this->idProposito->CurrentValue, NULL, $this->idProposito->ReadOnly);

			// presupuesto
			$this->presupuesto->SetDbValueDef($rsnew, $this->presupuesto->CurrentValue, NULL, $this->presupuesto->ReadOnly);

			// especiplano
			$this->especiplano->SetDbValueDef($rsnew, $this->especiplano->CurrentValue, NULL, $this->especiplano->ReadOnly);

			// presuprogra
			$this->presuprogra->SetDbValueDef($rsnew, $this->presuprogra->CurrentValue, NULL, $this->presuprogra->ReadOnly);

			// estudiofact
			$this->estudiofact->SetDbValueDef($rsnew, $this->estudiofact->CurrentValue, NULL, $this->estudiofact->ReadOnly);

			// estudioimpact
			$this->estudioimpact->SetDbValueDef($rsnew, $this->estudioimpact->CurrentValue, NULL, $this->estudioimpact->ReadOnly);

			// licambi
			$this->licambi->SetDbValueDef($rsnew, $this->licambi->CurrentValue, NULL, $this->licambi->ReadOnly);

			// estuimpactierra
			$this->estuimpactierra->SetDbValueDef($rsnew, $this->estuimpactierra->CurrentValue, NULL, $this->estuimpactierra->ReadOnly);

			// planreasea
			$this->planreasea->SetDbValueDef($rsnew, $this->planreasea->CurrentValue, NULL, $this->planreasea->ReadOnly);

			// plananual
			$this->plananual->SetDbValueDef($rsnew, $this->plananual->CurrentValue, NULL, $this->plananual->ReadOnly);

			// acuerdofinan
			$this->acuerdofinan->SetDbValueDef($rsnew, $this->acuerdofinan->CurrentValue, NULL, $this->acuerdofinan->ReadOnly);

			// otro
			$this->otro->SetDbValueDef($rsnew, $this->otro->CurrentValue, NULL, $this->otro->ReadOnly);

			// fechacreacion
			$this->fechacreacion->SetDbValueDef($rsnew, $this->fechacreacion->CurrentValue, NULL, $this->fechacreacion->ReadOnly);

			// estado
			$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly);

			// idFuncionario
			$this->idFuncionario->SetDbValueDef($rsnew, $this->idFuncionario->CurrentValue, NULL, $this->idFuncionario->ReadOnly);

			// fechaaprob
			$this->fechaaprob->SetDbValueDef($rsnew, $this->fechaaprob->CurrentValue, NULL, $this->fechaaprob->ReadOnly);

			// idfuente
			$this->idfuente->SetDbValueDef($rsnew, $this->idfuente->CurrentValue, NULL, $this->idfuente->ReadOnly);

			// codsefin
			$this->codsefin->SetDbValueDef($rsnew, $this->codsefin->CurrentValue, NULL, $this->codsefin->ReadOnly);

			// notaprioridad
			$this->notaprioridad->SetDbValueDef($rsnew, $this->notaprioridad->CurrentValue, NULL, $this->notaprioridad->ReadOnly);

			// constanciabanco
			$this->constanciabanco->SetDbValueDef($rsnew, $this->constanciabanco->CurrentValue, NULL, $this->constanciabanco->ReadOnly);

			// fecharecibido
			$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, $this->fecharecibido->ReadOnly);

			// clase
			$this->clase->SetDbValueDef($rsnew, $this->clase->CurrentValue, NULL, $this->clase->ReadOnly);

			// entes
			$this->entes->SetDbValueDef($rsnew, $this->entes->CurrentValue, NULL, $this->entes->ReadOnly);

			// idRol
			$this->idRol->SetDbValueDef($rsnew, $this->idRol->CurrentValue, NULL, $this->idRol->ReadOnly);

			// Check referential integrity for master table 'cs_programa'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_cs_programa();
			$KeyValue = isset($rsnew['idPrograma']) ? $rsnew['idPrograma'] : $rsold['idPrograma'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@idPrograma@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["cs_programa"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "cs_programa", $Language->Phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "cs_programa") {
				$this->idPrograma->CurrentValue = $this->idPrograma->getSessionValue();
			}

		// Check referential integrity for master table 'cs_programa'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cs_programa();
		if (strval($this->idPrograma->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@idPrograma@", ew_AdjustSql($this->idPrograma->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			$rsmaster = $GLOBALS["cs_programa"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cs_programa", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// idPrograma
		$this->idPrograma->SetDbValueDef($rsnew, $this->idPrograma->CurrentValue, 0, FALSE);

		// codigo
		$this->codigo->SetDbValueDef($rsnew, $this->codigo->CurrentValue, "", FALSE);

		// idUbicacion
		$this->idUbicacion->SetDbValueDef($rsnew, $this->idUbicacion->CurrentValue, NULL, FALSE);

		// idRegion
		$this->idRegion->SetDbValueDef($rsnew, $this->idRegion->CurrentValue, NULL, FALSE);

		// idDepto
		$this->idDepto->SetDbValueDef($rsnew, $this->idDepto->CurrentValue, NULL, FALSE);

		// idTramo
		$this->idTramo->SetDbValueDef($rsnew, $this->idTramo->CurrentValue, NULL, FALSE);

		// idRuta
		$this->idRuta->SetDbValueDef($rsnew, $this->idRuta->CurrentValue, NULL, FALSE);

		// idTipoRed
		$this->idTipoRed->SetDbValueDef($rsnew, $this->idTipoRed->CurrentValue, NULL, FALSE);

		// idProposito
		$this->idProposito->SetDbValueDef($rsnew, $this->idProposito->CurrentValue, NULL, FALSE);

		// presupuesto
		$this->presupuesto->SetDbValueDef($rsnew, $this->presupuesto->CurrentValue, NULL, FALSE);

		// especiplano
		$this->especiplano->SetDbValueDef($rsnew, $this->especiplano->CurrentValue, NULL, FALSE);

		// presuprogra
		$this->presuprogra->SetDbValueDef($rsnew, $this->presuprogra->CurrentValue, NULL, FALSE);

		// estudiofact
		$this->estudiofact->SetDbValueDef($rsnew, $this->estudiofact->CurrentValue, NULL, FALSE);

		// estudioimpact
		$this->estudioimpact->SetDbValueDef($rsnew, $this->estudioimpact->CurrentValue, NULL, FALSE);

		// licambi
		$this->licambi->SetDbValueDef($rsnew, $this->licambi->CurrentValue, NULL, FALSE);

		// estuimpactierra
		$this->estuimpactierra->SetDbValueDef($rsnew, $this->estuimpactierra->CurrentValue, NULL, FALSE);

		// planreasea
		$this->planreasea->SetDbValueDef($rsnew, $this->planreasea->CurrentValue, NULL, FALSE);

		// plananual
		$this->plananual->SetDbValueDef($rsnew, $this->plananual->CurrentValue, NULL, FALSE);

		// acuerdofinan
		$this->acuerdofinan->SetDbValueDef($rsnew, $this->acuerdofinan->CurrentValue, NULL, FALSE);

		// otro
		$this->otro->SetDbValueDef($rsnew, $this->otro->CurrentValue, NULL, FALSE);

		// fechacreacion
		$this->fechacreacion->SetDbValueDef($rsnew, $this->fechacreacion->CurrentValue, NULL, FALSE);

		// estado
		$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, FALSE);

		// idFuncionario
		$this->idFuncionario->SetDbValueDef($rsnew, $this->idFuncionario->CurrentValue, NULL, FALSE);

		// fechaaprob
		$this->fechaaprob->SetDbValueDef($rsnew, $this->fechaaprob->CurrentValue, NULL, FALSE);

		// idfuente
		$this->idfuente->SetDbValueDef($rsnew, $this->idfuente->CurrentValue, NULL, FALSE);

		// codsefin
		$this->codsefin->SetDbValueDef($rsnew, $this->codsefin->CurrentValue, NULL, FALSE);

		// notaprioridad
		$this->notaprioridad->SetDbValueDef($rsnew, $this->notaprioridad->CurrentValue, NULL, FALSE);

		// constanciabanco
		$this->constanciabanco->SetDbValueDef($rsnew, $this->constanciabanco->CurrentValue, NULL, FALSE);

		// fecharecibido
		$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, FALSE);

		// clase
		$this->clase->SetDbValueDef($rsnew, $this->clase->CurrentValue, NULL, FALSE);

		// entes
		$this->entes->SetDbValueDef($rsnew, $this->entes->CurrentValue, NULL, FALSE);

		// idRol
		$this->idRol->SetDbValueDef($rsnew, $this->idRol->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {

				// Get insert id if necessary
				$this->idProyecto->setDbValue($conn->Insert_ID());
				$rsnew['idProyecto'] = $this->idProyecto->DbValue;
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
		if ($sMasterTblVar == "cs_programa") {
			$this->idPrograma->Visible = FALSE;
			if ($GLOBALS["cs_programa"]->EventCancelled) $this->EventCancelled = TRUE;
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
