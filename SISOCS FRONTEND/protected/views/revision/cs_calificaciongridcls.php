<?php include_once "cs_calificacioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php

//
// Page class
//

$cs_calificacion_grid = NULL; // Initialize page object first

class ccs_calificacion_grid extends ccs_calificacion {

	// Page ID
	var $PageID = 'grid';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_calificacion';

	// Page object name
	var $PageObjName = 'cs_calificacion_grid';

	// Grid form hidden field names
	var $FormName = 'fcs_calificaciongrid';
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

		// Table object (cs_calificacion)
		if (!isset($GLOBALS["cs_calificacion"]) || get_class($GLOBALS["cs_calificacion"]) == "ccs_calificacion") {
			$GLOBALS["cs_calificacion"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["cs_calificacion"];

		}

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

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
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

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
			$this->idCalificacion->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->idCalificacion->FormValue))
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
					$sKey .= $this->idCalificacion->CurrentValue;

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
		if ($objForm->HasValue("x_idProyecto") && $objForm->HasValue("o_idProyecto") && $this->idProyecto->CurrentValue <> $this->idProyecto->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_numproceso") && $objForm->HasValue("o_numproceso") && $this->numproceso->CurrentValue <> $this->numproceso->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechactualizacion") && $objForm->HasValue("o_fechactualizacion") && $this->fechactualizacion->CurrentValue <> $this->fechactualizacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idFuncionario") && $objForm->HasValue("o_idFuncionario") && $this->idFuncionario->CurrentValue <> $this->idFuncionario->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estatusproceso") && $objForm->HasValue("o_estatusproceso") && $this->estatusproceso->CurrentValue <> $this->estatusproceso->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_proceseval") && $objForm->HasValue("o_proceseval") && $this->proceseval->CurrentValue <> $this->proceseval->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_invitainter") && $objForm->HasValue("o_invitainter") && $this->invitainter->CurrentValue <> $this->invitainter->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_basespreca") && $objForm->HasValue("o_basespreca") && $this->basespreca->CurrentValue <> $this->basespreca->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_resolucion") && $objForm->HasValue("o_resolucion") && $this->resolucion->CurrentValue <> $this->resolucion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_nombreante") && $objForm->HasValue("o_nombreante") && $this->nombreante->CurrentValue <> $this->nombreante->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_convocainvi") && $objForm->HasValue("o_convocainvi") && $this->convocainvi->CurrentValue <> $this->convocainvi->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tdr") && $objForm->HasValue("o_tdr") && $this->tdr->CurrentValue <> $this->tdr->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_aclaraciones") && $objForm->HasValue("o_aclaraciones") && $this->aclaraciones->CurrentValue <> $this->aclaraciones->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_actarecpcion") && $objForm->HasValue("o_actarecpcion") && $this->actarecpcion->CurrentValue <> $this->actarecpcion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fechaingreso") && $objForm->HasValue("o_fechaingreso") && $this->fechaingreso->CurrentValue <> $this->fechaingreso->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tipocontrato") && $objForm->HasValue("o_tipocontrato") && $this->tipocontrato->CurrentValue <> $this->tipocontrato->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado") && $objForm->HasValue("o_estado") && $this->estado->CurrentValue <> $this->estado->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_otro1") && $objForm->HasValue("o_otro1") && $this->otro1->CurrentValue <> $this->otro1->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_otro2") && $objForm->HasValue("o_otro2") && $this->otro2->CurrentValue <> $this->otro2->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_identidadadquisicion") && $objForm->HasValue("o_identidadadquisicion") && $this->identidadadquisicion->CurrentValue <> $this->identidadadquisicion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_idmetodo") && $objForm->HasValue("o_idmetodo") && $this->idmetodo->CurrentValue <> $this->idmetodo->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecharecibido") && $objForm->HasValue("o_fecharecibido") && $this->fecharecibido->CurrentValue <> $this->fecharecibido->OldValue)
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
				$this->idProyecto->setSessionValue("");
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
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $KeyName . "\" id=\"" . $KeyName . "\" value=\"" . $this->idCalificacion->CurrentValue . "\">";
		}
		$this->RenderListOptionsExt();
	}

	// Set record key
	function SetRecordKey(&$key, $rs) {
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs->fields('idCalificacion');
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
		$this->idCalificacion->CurrentValue = NULL;
		$this->idCalificacion->OldValue = $this->idCalificacion->CurrentValue;
		$this->idProyecto->CurrentValue = NULL;
		$this->idProyecto->OldValue = $this->idProyecto->CurrentValue;
		$this->numproceso->CurrentValue = NULL;
		$this->numproceso->OldValue = $this->numproceso->CurrentValue;
		$this->fechactualizacion->CurrentValue = NULL;
		$this->fechactualizacion->OldValue = $this->fechactualizacion->CurrentValue;
		$this->idFuncionario->CurrentValue = NULL;
		$this->idFuncionario->OldValue = $this->idFuncionario->CurrentValue;
		$this->estatusproceso->CurrentValue = NULL;
		$this->estatusproceso->OldValue = $this->estatusproceso->CurrentValue;
		$this->proceseval->CurrentValue = NULL;
		$this->proceseval->OldValue = $this->proceseval->CurrentValue;
		$this->invitainter->CurrentValue = NULL;
		$this->invitainter->OldValue = $this->invitainter->CurrentValue;
		$this->basespreca->CurrentValue = NULL;
		$this->basespreca->OldValue = $this->basespreca->CurrentValue;
		$this->resolucion->CurrentValue = NULL;
		$this->resolucion->OldValue = $this->resolucion->CurrentValue;
		$this->nombreante->CurrentValue = NULL;
		$this->nombreante->OldValue = $this->nombreante->CurrentValue;
		$this->convocainvi->CurrentValue = NULL;
		$this->convocainvi->OldValue = $this->convocainvi->CurrentValue;
		$this->tdr->CurrentValue = NULL;
		$this->tdr->OldValue = $this->tdr->CurrentValue;
		$this->aclaraciones->CurrentValue = NULL;
		$this->aclaraciones->OldValue = $this->aclaraciones->CurrentValue;
		$this->actarecpcion->CurrentValue = NULL;
		$this->actarecpcion->OldValue = $this->actarecpcion->CurrentValue;
		$this->fechaingreso->CurrentValue = NULL;
		$this->fechaingreso->OldValue = $this->fechaingreso->CurrentValue;
		$this->tipocontrato->CurrentValue = NULL;
		$this->tipocontrato->OldValue = $this->tipocontrato->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->otro1->CurrentValue = NULL;
		$this->otro1->OldValue = $this->otro1->CurrentValue;
		$this->otro2->CurrentValue = NULL;
		$this->otro2->OldValue = $this->otro2->CurrentValue;
		$this->identidadadquisicion->CurrentValue = NULL;
		$this->identidadadquisicion->OldValue = $this->identidadadquisicion->CurrentValue;
		$this->idmetodo->CurrentValue = 0;
		$this->idmetodo->OldValue = $this->idmetodo->CurrentValue;
		$this->fecharecibido->CurrentValue = NULL;
		$this->fecharecibido->OldValue = $this->fecharecibido->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$objForm->FormName = $this->FormName;
		if (!$this->idCalificacion->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idCalificacion->setFormValue($objForm->GetValue("x_idCalificacion"));
		if (!$this->idProyecto->FldIsDetailKey) {
			$this->idProyecto->setFormValue($objForm->GetValue("x_idProyecto"));
		}
		$this->idProyecto->setOldValue($objForm->GetValue("o_idProyecto"));
		if (!$this->numproceso->FldIsDetailKey) {
			$this->numproceso->setFormValue($objForm->GetValue("x_numproceso"));
		}
		$this->numproceso->setOldValue($objForm->GetValue("o_numproceso"));
		if (!$this->fechactualizacion->FldIsDetailKey) {
			$this->fechactualizacion->setFormValue($objForm->GetValue("x_fechactualizacion"));
		}
		$this->fechactualizacion->setOldValue($objForm->GetValue("o_fechactualizacion"));
		if (!$this->idFuncionario->FldIsDetailKey) {
			$this->idFuncionario->setFormValue($objForm->GetValue("x_idFuncionario"));
		}
		$this->idFuncionario->setOldValue($objForm->GetValue("o_idFuncionario"));
		if (!$this->estatusproceso->FldIsDetailKey) {
			$this->estatusproceso->setFormValue($objForm->GetValue("x_estatusproceso"));
		}
		$this->estatusproceso->setOldValue($objForm->GetValue("o_estatusproceso"));
		if (!$this->proceseval->FldIsDetailKey) {
			$this->proceseval->setFormValue($objForm->GetValue("x_proceseval"));
		}
		$this->proceseval->setOldValue($objForm->GetValue("o_proceseval"));
		if (!$this->invitainter->FldIsDetailKey) {
			$this->invitainter->setFormValue($objForm->GetValue("x_invitainter"));
		}
		$this->invitainter->setOldValue($objForm->GetValue("o_invitainter"));
		if (!$this->basespreca->FldIsDetailKey) {
			$this->basespreca->setFormValue($objForm->GetValue("x_basespreca"));
		}
		$this->basespreca->setOldValue($objForm->GetValue("o_basespreca"));
		if (!$this->resolucion->FldIsDetailKey) {
			$this->resolucion->setFormValue($objForm->GetValue("x_resolucion"));
		}
		$this->resolucion->setOldValue($objForm->GetValue("o_resolucion"));
		if (!$this->nombreante->FldIsDetailKey) {
			$this->nombreante->setFormValue($objForm->GetValue("x_nombreante"));
		}
		$this->nombreante->setOldValue($objForm->GetValue("o_nombreante"));
		if (!$this->convocainvi->FldIsDetailKey) {
			$this->convocainvi->setFormValue($objForm->GetValue("x_convocainvi"));
		}
		$this->convocainvi->setOldValue($objForm->GetValue("o_convocainvi"));
		if (!$this->tdr->FldIsDetailKey) {
			$this->tdr->setFormValue($objForm->GetValue("x_tdr"));
		}
		$this->tdr->setOldValue($objForm->GetValue("o_tdr"));
		if (!$this->aclaraciones->FldIsDetailKey) {
			$this->aclaraciones->setFormValue($objForm->GetValue("x_aclaraciones"));
		}
		$this->aclaraciones->setOldValue($objForm->GetValue("o_aclaraciones"));
		if (!$this->actarecpcion->FldIsDetailKey) {
			$this->actarecpcion->setFormValue($objForm->GetValue("x_actarecpcion"));
		}
		$this->actarecpcion->setOldValue($objForm->GetValue("o_actarecpcion"));
		if (!$this->fechaingreso->FldIsDetailKey) {
			$this->fechaingreso->setFormValue($objForm->GetValue("x_fechaingreso"));
		}
		$this->fechaingreso->setOldValue($objForm->GetValue("o_fechaingreso"));
		if (!$this->tipocontrato->FldIsDetailKey) {
			$this->tipocontrato->setFormValue($objForm->GetValue("x_tipocontrato"));
		}
		$this->tipocontrato->setOldValue($objForm->GetValue("o_tipocontrato"));
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$this->estado->setOldValue($objForm->GetValue("o_estado"));
		if (!$this->otro1->FldIsDetailKey) {
			$this->otro1->setFormValue($objForm->GetValue("x_otro1"));
		}
		$this->otro1->setOldValue($objForm->GetValue("o_otro1"));
		if (!$this->otro2->FldIsDetailKey) {
			$this->otro2->setFormValue($objForm->GetValue("x_otro2"));
		}
		$this->otro2->setOldValue($objForm->GetValue("o_otro2"));
		if (!$this->identidadadquisicion->FldIsDetailKey) {
			$this->identidadadquisicion->setFormValue($objForm->GetValue("x_identidadadquisicion"));
		}
		$this->identidadadquisicion->setOldValue($objForm->GetValue("o_identidadadquisicion"));
		if (!$this->idmetodo->FldIsDetailKey) {
			$this->idmetodo->setFormValue($objForm->GetValue("x_idmetodo"));
		}
		$this->idmetodo->setOldValue($objForm->GetValue("o_idmetodo"));
		if (!$this->fecharecibido->FldIsDetailKey) {
			$this->fecharecibido->setFormValue($objForm->GetValue("x_fecharecibido"));
		}
		$this->fecharecibido->setOldValue($objForm->GetValue("o_fecharecibido"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->idCalificacion->CurrentValue = $this->idCalificacion->FormValue;
		$this->idProyecto->CurrentValue = $this->idProyecto->FormValue;
		$this->numproceso->CurrentValue = $this->numproceso->FormValue;
		$this->fechactualizacion->CurrentValue = $this->fechactualizacion->FormValue;
		$this->idFuncionario->CurrentValue = $this->idFuncionario->FormValue;
		$this->estatusproceso->CurrentValue = $this->estatusproceso->FormValue;
		$this->proceseval->CurrentValue = $this->proceseval->FormValue;
		$this->invitainter->CurrentValue = $this->invitainter->FormValue;
		$this->basespreca->CurrentValue = $this->basespreca->FormValue;
		$this->resolucion->CurrentValue = $this->resolucion->FormValue;
		$this->nombreante->CurrentValue = $this->nombreante->FormValue;
		$this->convocainvi->CurrentValue = $this->convocainvi->FormValue;
		$this->tdr->CurrentValue = $this->tdr->FormValue;
		$this->aclaraciones->CurrentValue = $this->aclaraciones->FormValue;
		$this->actarecpcion->CurrentValue = $this->actarecpcion->FormValue;
		$this->fechaingreso->CurrentValue = $this->fechaingreso->FormValue;
		$this->tipocontrato->CurrentValue = $this->tipocontrato->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->otro1->CurrentValue = $this->otro1->FormValue;
		$this->otro2->CurrentValue = $this->otro2->FormValue;
		$this->identidadadquisicion->CurrentValue = $this->identidadadquisicion->FormValue;
		$this->idmetodo->CurrentValue = $this->idmetodo->FormValue;
		$this->fecharecibido->CurrentValue = $this->fecharecibido->FormValue;
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
		$arKeys[] = $this->RowOldKey;
		$cnt = count($arKeys);
		if ($cnt >= 1) {
			if (strval($arKeys[0]) <> "")
				$this->idCalificacion->CurrentValue = strval($arKeys[0]); // idCalificacion
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// idCalificacion
			// idProyecto

			$this->idProyecto->EditAttrs["class"] = "form-control";
			$this->idProyecto->EditCustomAttributes = "";
			if ($this->idProyecto->getSessionValue() <> "") {
				$this->idProyecto->CurrentValue = $this->idProyecto->getSessionValue();
				$this->idProyecto->OldValue = $this->idProyecto->CurrentValue;
			$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
			$this->idProyecto->ViewCustomAttributes = "";
			} else {
			$this->idProyecto->EditValue = ew_HtmlEncode($this->idProyecto->CurrentValue);
			$this->idProyecto->PlaceHolder = ew_RemoveHtml($this->idProyecto->FldCaption());
			}

			// numproceso
			$this->numproceso->EditAttrs["class"] = "form-control";
			$this->numproceso->EditCustomAttributes = "";
			$this->numproceso->EditValue = ew_HtmlEncode($this->numproceso->CurrentValue);
			$this->numproceso->PlaceHolder = ew_RemoveHtml($this->numproceso->FldCaption());

			// fechactualizacion
			$this->fechactualizacion->EditAttrs["class"] = "form-control";
			$this->fechactualizacion->EditCustomAttributes = "";
			$this->fechactualizacion->EditValue = ew_HtmlEncode($this->fechactualizacion->CurrentValue);
			$this->fechactualizacion->PlaceHolder = ew_RemoveHtml($this->fechactualizacion->FldCaption());

			// idFuncionario
			$this->idFuncionario->EditAttrs["class"] = "form-control";
			$this->idFuncionario->EditCustomAttributes = "";
			$this->idFuncionario->EditValue = ew_HtmlEncode($this->idFuncionario->CurrentValue);
			$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

			// estatusproceso
			$this->estatusproceso->EditAttrs["class"] = "form-control";
			$this->estatusproceso->EditCustomAttributes = "";
			$this->estatusproceso->EditValue = ew_HtmlEncode($this->estatusproceso->CurrentValue);
			$this->estatusproceso->PlaceHolder = ew_RemoveHtml($this->estatusproceso->FldCaption());

			// proceseval
			$this->proceseval->EditAttrs["class"] = "form-control";
			$this->proceseval->EditCustomAttributes = "";
			$this->proceseval->EditValue = ew_HtmlEncode($this->proceseval->CurrentValue);
			$this->proceseval->PlaceHolder = ew_RemoveHtml($this->proceseval->FldCaption());

			// invitainter
			$this->invitainter->EditAttrs["class"] = "form-control";
			$this->invitainter->EditCustomAttributes = "";
			$this->invitainter->EditValue = ew_HtmlEncode($this->invitainter->CurrentValue);
			$this->invitainter->PlaceHolder = ew_RemoveHtml($this->invitainter->FldCaption());

			// basespreca
			$this->basespreca->EditAttrs["class"] = "form-control";
			$this->basespreca->EditCustomAttributes = "";
			$this->basespreca->EditValue = ew_HtmlEncode($this->basespreca->CurrentValue);
			$this->basespreca->PlaceHolder = ew_RemoveHtml($this->basespreca->FldCaption());

			// resolucion
			$this->resolucion->EditAttrs["class"] = "form-control";
			$this->resolucion->EditCustomAttributes = "";
			$this->resolucion->EditValue = ew_HtmlEncode($this->resolucion->CurrentValue);
			$this->resolucion->PlaceHolder = ew_RemoveHtml($this->resolucion->FldCaption());

			// nombreante
			$this->nombreante->EditAttrs["class"] = "form-control";
			$this->nombreante->EditCustomAttributes = "";
			$this->nombreante->EditValue = ew_HtmlEncode($this->nombreante->CurrentValue);
			$this->nombreante->PlaceHolder = ew_RemoveHtml($this->nombreante->FldCaption());

			// convocainvi
			$this->convocainvi->EditAttrs["class"] = "form-control";
			$this->convocainvi->EditCustomAttributes = "";
			$this->convocainvi->EditValue = ew_HtmlEncode($this->convocainvi->CurrentValue);
			$this->convocainvi->PlaceHolder = ew_RemoveHtml($this->convocainvi->FldCaption());

			// tdr
			$this->tdr->EditAttrs["class"] = "form-control";
			$this->tdr->EditCustomAttributes = "";
			$this->tdr->EditValue = ew_HtmlEncode($this->tdr->CurrentValue);
			$this->tdr->PlaceHolder = ew_RemoveHtml($this->tdr->FldCaption());

			// aclaraciones
			$this->aclaraciones->EditAttrs["class"] = "form-control";
			$this->aclaraciones->EditCustomAttributes = "";
			$this->aclaraciones->EditValue = ew_HtmlEncode($this->aclaraciones->CurrentValue);
			$this->aclaraciones->PlaceHolder = ew_RemoveHtml($this->aclaraciones->FldCaption());

			// actarecpcion
			$this->actarecpcion->EditAttrs["class"] = "form-control";
			$this->actarecpcion->EditCustomAttributes = "";
			$this->actarecpcion->EditValue = ew_HtmlEncode($this->actarecpcion->CurrentValue);
			$this->actarecpcion->PlaceHolder = ew_RemoveHtml($this->actarecpcion->FldCaption());

			// fechaingreso
			$this->fechaingreso->EditAttrs["class"] = "form-control";
			$this->fechaingreso->EditCustomAttributes = "";
			$this->fechaingreso->EditValue = ew_HtmlEncode($this->fechaingreso->CurrentValue);
			$this->fechaingreso->PlaceHolder = ew_RemoveHtml($this->fechaingreso->FldCaption());

			// tipocontrato
			$this->tipocontrato->EditAttrs["class"] = "form-control";
			$this->tipocontrato->EditCustomAttributes = "";
			$this->tipocontrato->EditValue = ew_HtmlEncode($this->tipocontrato->CurrentValue);
			$this->tipocontrato->PlaceHolder = ew_RemoveHtml($this->tipocontrato->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// otro1
			$this->otro1->EditAttrs["class"] = "form-control";
			$this->otro1->EditCustomAttributes = "";
			$this->otro1->EditValue = ew_HtmlEncode($this->otro1->CurrentValue);
			$this->otro1->PlaceHolder = ew_RemoveHtml($this->otro1->FldCaption());

			// otro2
			$this->otro2->EditAttrs["class"] = "form-control";
			$this->otro2->EditCustomAttributes = "";
			$this->otro2->EditValue = ew_HtmlEncode($this->otro2->CurrentValue);
			$this->otro2->PlaceHolder = ew_RemoveHtml($this->otro2->FldCaption());

			// identidadadquisicion
			$this->identidadadquisicion->EditAttrs["class"] = "form-control";
			$this->identidadadquisicion->EditCustomAttributes = "";
			$this->identidadadquisicion->EditValue = ew_HtmlEncode($this->identidadadquisicion->CurrentValue);
			$this->identidadadquisicion->PlaceHolder = ew_RemoveHtml($this->identidadadquisicion->FldCaption());

			// idmetodo
			$this->idmetodo->EditAttrs["class"] = "form-control";
			$this->idmetodo->EditCustomAttributes = "";
			$this->idmetodo->EditValue = ew_HtmlEncode($this->idmetodo->CurrentValue);
			$this->idmetodo->PlaceHolder = ew_RemoveHtml($this->idmetodo->FldCaption());

			// fecharecibido
			$this->fecharecibido->EditAttrs["class"] = "form-control";
			$this->fecharecibido->EditCustomAttributes = "";
			$this->fecharecibido->EditValue = ew_HtmlEncode($this->fecharecibido->CurrentValue);
			$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

			// Edit refer script
			// idCalificacion

			$this->idCalificacion->HrefValue = "";

			// idProyecto
			$this->idProyecto->HrefValue = "";

			// numproceso
			$this->numproceso->HrefValue = "";

			// fechactualizacion
			$this->fechactualizacion->HrefValue = "";

			// idFuncionario
			$this->idFuncionario->HrefValue = "";

			// estatusproceso
			$this->estatusproceso->HrefValue = "";

			// proceseval
			$this->proceseval->HrefValue = "";

			// invitainter
			$this->invitainter->HrefValue = "";

			// basespreca
			$this->basespreca->HrefValue = "";

			// resolucion
			$this->resolucion->HrefValue = "";

			// nombreante
			$this->nombreante->HrefValue = "";

			// convocainvi
			$this->convocainvi->HrefValue = "";

			// tdr
			$this->tdr->HrefValue = "";

			// aclaraciones
			$this->aclaraciones->HrefValue = "";

			// actarecpcion
			$this->actarecpcion->HrefValue = "";

			// fechaingreso
			$this->fechaingreso->HrefValue = "";

			// tipocontrato
			$this->tipocontrato->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// otro1
			$this->otro1->HrefValue = "";

			// otro2
			$this->otro2->HrefValue = "";

			// identidadadquisicion
			$this->identidadadquisicion->HrefValue = "";

			// idmetodo
			$this->idmetodo->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// idCalificacion
			$this->idCalificacion->EditAttrs["class"] = "form-control";
			$this->idCalificacion->EditCustomAttributes = "";
			$this->idCalificacion->EditValue = $this->idCalificacion->CurrentValue;
			$this->idCalificacion->ViewCustomAttributes = "";

			// idProyecto
			$this->idProyecto->EditAttrs["class"] = "form-control";
			$this->idProyecto->EditCustomAttributes = "";
			if ($this->idProyecto->getSessionValue() <> "") {
				$this->idProyecto->CurrentValue = $this->idProyecto->getSessionValue();
				$this->idProyecto->OldValue = $this->idProyecto->CurrentValue;
			$this->idProyecto->ViewValue = $this->idProyecto->CurrentValue;
			$this->idProyecto->ViewCustomAttributes = "";
			} else {
			$this->idProyecto->EditValue = ew_HtmlEncode($this->idProyecto->CurrentValue);
			$this->idProyecto->PlaceHolder = ew_RemoveHtml($this->idProyecto->FldCaption());
			}

			// numproceso
			$this->numproceso->EditAttrs["class"] = "form-control";
			$this->numproceso->EditCustomAttributes = "";
			$this->numproceso->EditValue = ew_HtmlEncode($this->numproceso->CurrentValue);
			$this->numproceso->PlaceHolder = ew_RemoveHtml($this->numproceso->FldCaption());

			// fechactualizacion
			$this->fechactualizacion->EditAttrs["class"] = "form-control";
			$this->fechactualizacion->EditCustomAttributes = "";
			$this->fechactualizacion->EditValue = ew_HtmlEncode($this->fechactualizacion->CurrentValue);
			$this->fechactualizacion->PlaceHolder = ew_RemoveHtml($this->fechactualizacion->FldCaption());

			// idFuncionario
			$this->idFuncionario->EditAttrs["class"] = "form-control";
			$this->idFuncionario->EditCustomAttributes = "";
			$this->idFuncionario->EditValue = ew_HtmlEncode($this->idFuncionario->CurrentValue);
			$this->idFuncionario->PlaceHolder = ew_RemoveHtml($this->idFuncionario->FldCaption());

			// estatusproceso
			$this->estatusproceso->EditAttrs["class"] = "form-control";
			$this->estatusproceso->EditCustomAttributes = "";
			$this->estatusproceso->EditValue = ew_HtmlEncode($this->estatusproceso->CurrentValue);
			$this->estatusproceso->PlaceHolder = ew_RemoveHtml($this->estatusproceso->FldCaption());

			// proceseval
			$this->proceseval->EditAttrs["class"] = "form-control";
			$this->proceseval->EditCustomAttributes = "";
			$this->proceseval->EditValue = ew_HtmlEncode($this->proceseval->CurrentValue);
			$this->proceseval->PlaceHolder = ew_RemoveHtml($this->proceseval->FldCaption());

			// invitainter
			$this->invitainter->EditAttrs["class"] = "form-control";
			$this->invitainter->EditCustomAttributes = "";
			$this->invitainter->EditValue = ew_HtmlEncode($this->invitainter->CurrentValue);
			$this->invitainter->PlaceHolder = ew_RemoveHtml($this->invitainter->FldCaption());

			// basespreca
			$this->basespreca->EditAttrs["class"] = "form-control";
			$this->basespreca->EditCustomAttributes = "";
			$this->basespreca->EditValue = ew_HtmlEncode($this->basespreca->CurrentValue);
			$this->basespreca->PlaceHolder = ew_RemoveHtml($this->basespreca->FldCaption());

			// resolucion
			$this->resolucion->EditAttrs["class"] = "form-control";
			$this->resolucion->EditCustomAttributes = "";
			$this->resolucion->EditValue = ew_HtmlEncode($this->resolucion->CurrentValue);
			$this->resolucion->PlaceHolder = ew_RemoveHtml($this->resolucion->FldCaption());

			// nombreante
			$this->nombreante->EditAttrs["class"] = "form-control";
			$this->nombreante->EditCustomAttributes = "";
			$this->nombreante->EditValue = ew_HtmlEncode($this->nombreante->CurrentValue);
			$this->nombreante->PlaceHolder = ew_RemoveHtml($this->nombreante->FldCaption());

			// convocainvi
			$this->convocainvi->EditAttrs["class"] = "form-control";
			$this->convocainvi->EditCustomAttributes = "";
			$this->convocainvi->EditValue = ew_HtmlEncode($this->convocainvi->CurrentValue);
			$this->convocainvi->PlaceHolder = ew_RemoveHtml($this->convocainvi->FldCaption());

			// tdr
			$this->tdr->EditAttrs["class"] = "form-control";
			$this->tdr->EditCustomAttributes = "";
			$this->tdr->EditValue = ew_HtmlEncode($this->tdr->CurrentValue);
			$this->tdr->PlaceHolder = ew_RemoveHtml($this->tdr->FldCaption());

			// aclaraciones
			$this->aclaraciones->EditAttrs["class"] = "form-control";
			$this->aclaraciones->EditCustomAttributes = "";
			$this->aclaraciones->EditValue = ew_HtmlEncode($this->aclaraciones->CurrentValue);
			$this->aclaraciones->PlaceHolder = ew_RemoveHtml($this->aclaraciones->FldCaption());

			// actarecpcion
			$this->actarecpcion->EditAttrs["class"] = "form-control";
			$this->actarecpcion->EditCustomAttributes = "";
			$this->actarecpcion->EditValue = ew_HtmlEncode($this->actarecpcion->CurrentValue);
			$this->actarecpcion->PlaceHolder = ew_RemoveHtml($this->actarecpcion->FldCaption());

			// fechaingreso
			$this->fechaingreso->EditAttrs["class"] = "form-control";
			$this->fechaingreso->EditCustomAttributes = "";
			$this->fechaingreso->EditValue = ew_HtmlEncode($this->fechaingreso->CurrentValue);
			$this->fechaingreso->PlaceHolder = ew_RemoveHtml($this->fechaingreso->FldCaption());

			// tipocontrato
			$this->tipocontrato->EditAttrs["class"] = "form-control";
			$this->tipocontrato->EditCustomAttributes = "";
			$this->tipocontrato->EditValue = ew_HtmlEncode($this->tipocontrato->CurrentValue);
			$this->tipocontrato->PlaceHolder = ew_RemoveHtml($this->tipocontrato->FldCaption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = ew_HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldCaption());

			// otro1
			$this->otro1->EditAttrs["class"] = "form-control";
			$this->otro1->EditCustomAttributes = "";
			$this->otro1->EditValue = ew_HtmlEncode($this->otro1->CurrentValue);
			$this->otro1->PlaceHolder = ew_RemoveHtml($this->otro1->FldCaption());

			// otro2
			$this->otro2->EditAttrs["class"] = "form-control";
			$this->otro2->EditCustomAttributes = "";
			$this->otro2->EditValue = ew_HtmlEncode($this->otro2->CurrentValue);
			$this->otro2->PlaceHolder = ew_RemoveHtml($this->otro2->FldCaption());

			// identidadadquisicion
			$this->identidadadquisicion->EditAttrs["class"] = "form-control";
			$this->identidadadquisicion->EditCustomAttributes = "";
			$this->identidadadquisicion->EditValue = ew_HtmlEncode($this->identidadadquisicion->CurrentValue);
			$this->identidadadquisicion->PlaceHolder = ew_RemoveHtml($this->identidadadquisicion->FldCaption());

			// idmetodo
			$this->idmetodo->EditAttrs["class"] = "form-control";
			$this->idmetodo->EditCustomAttributes = "";
			$this->idmetodo->EditValue = ew_HtmlEncode($this->idmetodo->CurrentValue);
			$this->idmetodo->PlaceHolder = ew_RemoveHtml($this->idmetodo->FldCaption());

			// fecharecibido
			$this->fecharecibido->EditAttrs["class"] = "form-control";
			$this->fecharecibido->EditCustomAttributes = "";
			$this->fecharecibido->EditValue = ew_HtmlEncode($this->fecharecibido->CurrentValue);
			$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldCaption());

			// Edit refer script
			// idCalificacion

			$this->idCalificacion->HrefValue = "";

			// idProyecto
			$this->idProyecto->HrefValue = "";

			// numproceso
			$this->numproceso->HrefValue = "";

			// fechactualizacion
			$this->fechactualizacion->HrefValue = "";

			// idFuncionario
			$this->idFuncionario->HrefValue = "";

			// estatusproceso
			$this->estatusproceso->HrefValue = "";

			// proceseval
			$this->proceseval->HrefValue = "";

			// invitainter
			$this->invitainter->HrefValue = "";

			// basespreca
			$this->basespreca->HrefValue = "";

			// resolucion
			$this->resolucion->HrefValue = "";

			// nombreante
			$this->nombreante->HrefValue = "";

			// convocainvi
			$this->convocainvi->HrefValue = "";

			// tdr
			$this->tdr->HrefValue = "";

			// aclaraciones
			$this->aclaraciones->HrefValue = "";

			// actarecpcion
			$this->actarecpcion->HrefValue = "";

			// fechaingreso
			$this->fechaingreso->HrefValue = "";

			// tipocontrato
			$this->tipocontrato->HrefValue = "";

			// estado
			$this->estado->HrefValue = "";

			// otro1
			$this->otro1->HrefValue = "";

			// otro2
			$this->otro2->HrefValue = "";

			// identidadadquisicion
			$this->identidadadquisicion->HrefValue = "";

			// idmetodo
			$this->idmetodo->HrefValue = "";

			// fecharecibido
			$this->fecharecibido->HrefValue = "";
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
		if (!$this->idProyecto->FldIsDetailKey && !is_null($this->idProyecto->FormValue) && $this->idProyecto->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idProyecto->FldCaption(), $this->idProyecto->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idProyecto->FormValue)) {
			ew_AddMessage($gsFormError, $this->idProyecto->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idFuncionario->FormValue)) {
			ew_AddMessage($gsFormError, $this->idFuncionario->FldErrMsg());
		}
		if (!ew_CheckInteger($this->identidadadquisicion->FormValue)) {
			ew_AddMessage($gsFormError, $this->identidadadquisicion->FldErrMsg());
		}
		if (!ew_CheckInteger($this->idmetodo->FormValue)) {
			ew_AddMessage($gsFormError, $this->idmetodo->FldErrMsg());
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

		// Check if records exist for detail table 'cs_adjudicacion'
		if (!isset($GLOBALS["cs_adjudicacion"])) $GLOBALS["cs_adjudicacion"] = new ccs_adjudicacion();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["cs_adjudicacion"]->LoadRs("`idCalificacion` = " . ew_QuotedValue($row['idCalificacion'], EW_DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$sRelatedRecordMsg = str_replace("%t", "cs_adjudicacion", $Language->Phrase("RelatedRecordExists"));
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
				$sThisKey .= $row['idCalificacion'];
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

			// idProyecto
			$this->idProyecto->SetDbValueDef($rsnew, $this->idProyecto->CurrentValue, 0, $this->idProyecto->ReadOnly);

			// numproceso
			$this->numproceso->SetDbValueDef($rsnew, $this->numproceso->CurrentValue, NULL, $this->numproceso->ReadOnly);

			// fechactualizacion
			$this->fechactualizacion->SetDbValueDef($rsnew, $this->fechactualizacion->CurrentValue, NULL, $this->fechactualizacion->ReadOnly);

			// idFuncionario
			$this->idFuncionario->SetDbValueDef($rsnew, $this->idFuncionario->CurrentValue, NULL, $this->idFuncionario->ReadOnly);

			// estatusproceso
			$this->estatusproceso->SetDbValueDef($rsnew, $this->estatusproceso->CurrentValue, NULL, $this->estatusproceso->ReadOnly);

			// proceseval
			$this->proceseval->SetDbValueDef($rsnew, $this->proceseval->CurrentValue, NULL, $this->proceseval->ReadOnly);

			// invitainter
			$this->invitainter->SetDbValueDef($rsnew, $this->invitainter->CurrentValue, NULL, $this->invitainter->ReadOnly);

			// basespreca
			$this->basespreca->SetDbValueDef($rsnew, $this->basespreca->CurrentValue, NULL, $this->basespreca->ReadOnly);

			// resolucion
			$this->resolucion->SetDbValueDef($rsnew, $this->resolucion->CurrentValue, NULL, $this->resolucion->ReadOnly);

			// nombreante
			$this->nombreante->SetDbValueDef($rsnew, $this->nombreante->CurrentValue, NULL, $this->nombreante->ReadOnly);

			// convocainvi
			$this->convocainvi->SetDbValueDef($rsnew, $this->convocainvi->CurrentValue, NULL, $this->convocainvi->ReadOnly);

			// tdr
			$this->tdr->SetDbValueDef($rsnew, $this->tdr->CurrentValue, NULL, $this->tdr->ReadOnly);

			// aclaraciones
			$this->aclaraciones->SetDbValueDef($rsnew, $this->aclaraciones->CurrentValue, NULL, $this->aclaraciones->ReadOnly);

			// actarecpcion
			$this->actarecpcion->SetDbValueDef($rsnew, $this->actarecpcion->CurrentValue, NULL, $this->actarecpcion->ReadOnly);

			// fechaingreso
			$this->fechaingreso->SetDbValueDef($rsnew, $this->fechaingreso->CurrentValue, NULL, $this->fechaingreso->ReadOnly);

			// tipocontrato
			$this->tipocontrato->SetDbValueDef($rsnew, $this->tipocontrato->CurrentValue, NULL, $this->tipocontrato->ReadOnly);

			// estado
			$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly);

			// otro1
			$this->otro1->SetDbValueDef($rsnew, $this->otro1->CurrentValue, NULL, $this->otro1->ReadOnly);

			// otro2
			$this->otro2->SetDbValueDef($rsnew, $this->otro2->CurrentValue, NULL, $this->otro2->ReadOnly);

			// identidadadquisicion
			$this->identidadadquisicion->SetDbValueDef($rsnew, $this->identidadadquisicion->CurrentValue, NULL, $this->identidadadquisicion->ReadOnly);

			// idmetodo
			$this->idmetodo->SetDbValueDef($rsnew, $this->idmetodo->CurrentValue, NULL, $this->idmetodo->ReadOnly);

			// fecharecibido
			$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, $this->fecharecibido->ReadOnly);

			// Check referential integrity for master table 'cs_proyecto'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_cs_proyecto();
			$KeyValue = isset($rsnew['idProyecto']) ? $rsnew['idProyecto'] : $rsold['idProyecto'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@idProyecto@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["cs_proyecto"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "cs_proyecto", $Language->Phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "cs_proyecto") {
				$this->idProyecto->CurrentValue = $this->idProyecto->getSessionValue();
			}

		// Check referential integrity for master table 'cs_proyecto'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cs_proyecto();
		if (strval($this->idProyecto->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@idProyecto@", ew_AdjustSql($this->idProyecto->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			$rsmaster = $GLOBALS["cs_proyecto"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cs_proyecto", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// idProyecto
		$this->idProyecto->SetDbValueDef($rsnew, $this->idProyecto->CurrentValue, 0, FALSE);

		// numproceso
		$this->numproceso->SetDbValueDef($rsnew, $this->numproceso->CurrentValue, NULL, FALSE);

		// fechactualizacion
		$this->fechactualizacion->SetDbValueDef($rsnew, $this->fechactualizacion->CurrentValue, NULL, FALSE);

		// idFuncionario
		$this->idFuncionario->SetDbValueDef($rsnew, $this->idFuncionario->CurrentValue, NULL, FALSE);

		// estatusproceso
		$this->estatusproceso->SetDbValueDef($rsnew, $this->estatusproceso->CurrentValue, NULL, FALSE);

		// proceseval
		$this->proceseval->SetDbValueDef($rsnew, $this->proceseval->CurrentValue, NULL, FALSE);

		// invitainter
		$this->invitainter->SetDbValueDef($rsnew, $this->invitainter->CurrentValue, NULL, FALSE);

		// basespreca
		$this->basespreca->SetDbValueDef($rsnew, $this->basespreca->CurrentValue, NULL, FALSE);

		// resolucion
		$this->resolucion->SetDbValueDef($rsnew, $this->resolucion->CurrentValue, NULL, FALSE);

		// nombreante
		$this->nombreante->SetDbValueDef($rsnew, $this->nombreante->CurrentValue, NULL, FALSE);

		// convocainvi
		$this->convocainvi->SetDbValueDef($rsnew, $this->convocainvi->CurrentValue, NULL, FALSE);

		// tdr
		$this->tdr->SetDbValueDef($rsnew, $this->tdr->CurrentValue, NULL, FALSE);

		// aclaraciones
		$this->aclaraciones->SetDbValueDef($rsnew, $this->aclaraciones->CurrentValue, NULL, FALSE);

		// actarecpcion
		$this->actarecpcion->SetDbValueDef($rsnew, $this->actarecpcion->CurrentValue, NULL, FALSE);

		// fechaingreso
		$this->fechaingreso->SetDbValueDef($rsnew, $this->fechaingreso->CurrentValue, NULL, FALSE);

		// tipocontrato
		$this->tipocontrato->SetDbValueDef($rsnew, $this->tipocontrato->CurrentValue, NULL, FALSE);

		// estado
		$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, FALSE);

		// otro1
		$this->otro1->SetDbValueDef($rsnew, $this->otro1->CurrentValue, NULL, FALSE);

		// otro2
		$this->otro2->SetDbValueDef($rsnew, $this->otro2->CurrentValue, NULL, FALSE);

		// identidadadquisicion
		$this->identidadadquisicion->SetDbValueDef($rsnew, $this->identidadadquisicion->CurrentValue, NULL, FALSE);

		// idmetodo
		$this->idmetodo->SetDbValueDef($rsnew, $this->idmetodo->CurrentValue, NULL, strval($this->idmetodo->CurrentValue) == "");

		// fecharecibido
		$this->fecharecibido->SetDbValueDef($rsnew, $this->fecharecibido->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {

				// Get insert id if necessary
				$this->idCalificacion->setDbValue($conn->Insert_ID());
				$rsnew['idCalificacion'] = $this->idCalificacion->DbValue;
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
		if ($sMasterTblVar == "cs_proyecto") {
			$this->idProyecto->Visible = FALSE;
			if ($GLOBALS["cs_proyecto"]->EventCancelled) $this->EventCancelled = TRUE;
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
