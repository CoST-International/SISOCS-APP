<?php include_once "cs_inicio_ejecucioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php

//
// Page class
//

$cs_inicio_ejecucion_grid = NULL; // Initialize page object first

class ccs_inicio_ejecucion_grid extends ccs_inicio_ejecucion {

	// Page ID
	var $PageID = 'grid';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_inicio_ejecucion';

	// Page object name
	var $PageObjName = 'cs_inicio_ejecucion_grid';

	// Grid form hidden field names
	var $FormName = 'fcs_inicio_ejecuciongrid';
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

		// Table object (cs_inicio_ejecucion)
		if (!isset($GLOBALS["cs_inicio_ejecucion"]) || get_class($GLOBALS["cs_inicio_ejecucion"]) == "ccs_inicio_ejecucion") {
			$GLOBALS["cs_inicio_ejecucion"] = &$this;

//			$GLOBALS["MasterTable"] = &$GLOBALS["Table"];
//			if (!isset($GLOBALS["Table"])) $GLOBALS["Table"] = &$GLOBALS["cs_inicio_ejecucion"];

		}

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'grid', TRUE);

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
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

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
		$this->monto_garant_01->FormValue = ""; // Clear form value
		$this->monto_garant_02->FormValue = ""; // Clear form value
		$this->monto_garant_03->FormValue = ""; // Clear form value
		$this->geo_latitud->FormValue = ""; // Clear form value
		$this->geo_longitud->FormValue = ""; // Clear form value
		$this->geo_lati_final->FormValue = ""; // Clear form value
		$this->geo_long_final->FormValue = ""; // Clear form value
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
		if ($objForm->HasValue("x_idContratacion") && $objForm->HasValue("o_idContratacion") && $this->idContratacion->CurrentValue <> $this->idContratacion->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_imagen") && $objForm->HasValue("o_imagen") && $this->imagen->CurrentValue <> $this->imagen->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cod_contacto_01") && $objForm->HasValue("o_cod_contacto_01") && $this->cod_contacto_01->CurrentValue <> $this->cod_contacto_01->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cod_contacto_02") && $objForm->HasValue("o_cod_contacto_02") && $this->cod_contacto_02->CurrentValue <> $this->cod_contacto_02->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_cod_contacto_03") && $objForm->HasValue("o_cod_contacto_03") && $this->cod_contacto_03->CurrentValue <> $this->cod_contacto_03->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tipo_garant_01") && $objForm->HasValue("o_tipo_garant_01") && $this->tipo_garant_01->CurrentValue <> $this->tipo_garant_01->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tipo_garant_02") && $objForm->HasValue("o_tipo_garant_02") && $this->tipo_garant_02->CurrentValue <> $this->tipo_garant_02->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_tipo_garant_03") && $objForm->HasValue("o_tipo_garant_03") && $this->tipo_garant_03->CurrentValue <> $this->tipo_garant_03->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_monto_garant_01") && $objForm->HasValue("o_monto_garant_01") && $this->monto_garant_01->CurrentValue <> $this->monto_garant_01->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_monto_garant_02") && $objForm->HasValue("o_monto_garant_02") && $this->monto_garant_02->CurrentValue <> $this->monto_garant_02->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_monto_garant_03") && $objForm->HasValue("o_monto_garant_03") && $this->monto_garant_03->CurrentValue <> $this->monto_garant_03->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado_garant_01") && $objForm->HasValue("o_estado_garant_01") && $this->estado_garant_01->CurrentValue <> $this->estado_garant_01->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado_garant_02") && $objForm->HasValue("o_estado_garant_02") && $this->estado_garant_02->CurrentValue <> $this->estado_garant_02->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado_garant_03") && $objForm->HasValue("o_estado_garant_03") && $this->estado_garant_03->CurrentValue <> $this->estado_garant_03->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_venc_01") && $objForm->HasValue("o_fecha_venc_01") && $this->fecha_venc_01->CurrentValue <> $this->fecha_venc_01->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_venc_02") && $objForm->HasValue("o_fecha_venc_02") && $this->fecha_venc_02->CurrentValue <> $this->fecha_venc_02->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_venc_03") && $objForm->HasValue("o_fecha_venc_03") && $this->fecha_venc_03->CurrentValue <> $this->fecha_venc_03->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_geo_latitud") && $objForm->HasValue("o_geo_latitud") && $this->geo_latitud->CurrentValue <> $this->geo_latitud->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_geo_longitud") && $objForm->HasValue("o_geo_longitud") && $this->geo_longitud->CurrentValue <> $this->geo_longitud->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_geo_lati_final") && $objForm->HasValue("o_geo_lati_final") && $this->geo_lati_final->CurrentValue <> $this->geo_lati_final->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_geo_long_final") && $objForm->HasValue("o_geo_long_final") && $this->geo_long_final->CurrentValue <> $this->geo_long_final->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_inicio") && $objForm->HasValue("o_fecha_inicio") && $this->fecha_inicio->CurrentValue <> $this->fecha_inicio->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_estado_sol") && $objForm->HasValue("o_estado_sol") && $this->estado_sol->CurrentValue <> $this->estado_sol->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_fecha_registro") && $objForm->HasValue("o_fecha_registro") && $this->fecha_registro->CurrentValue <> $this->fecha_registro->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_user_registro") && $objForm->HasValue("o_user_registro") && $this->user_registro->CurrentValue <> $this->user_registro->OldValue)
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
				$this->idContratacion->setSessionValue("");
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
		$this->idContratacion->CurrentValue = NULL;
		$this->idContratacion->OldValue = $this->idContratacion->CurrentValue;
		$this->imagen->CurrentValue = NULL;
		$this->imagen->OldValue = $this->imagen->CurrentValue;
		$this->cod_contacto_01->CurrentValue = NULL;
		$this->cod_contacto_01->OldValue = $this->cod_contacto_01->CurrentValue;
		$this->cod_contacto_02->CurrentValue = NULL;
		$this->cod_contacto_02->OldValue = $this->cod_contacto_02->CurrentValue;
		$this->cod_contacto_03->CurrentValue = NULL;
		$this->cod_contacto_03->OldValue = $this->cod_contacto_03->CurrentValue;
		$this->tipo_garant_01->CurrentValue = NULL;
		$this->tipo_garant_01->OldValue = $this->tipo_garant_01->CurrentValue;
		$this->tipo_garant_02->CurrentValue = NULL;
		$this->tipo_garant_02->OldValue = $this->tipo_garant_02->CurrentValue;
		$this->tipo_garant_03->CurrentValue = NULL;
		$this->tipo_garant_03->OldValue = $this->tipo_garant_03->CurrentValue;
		$this->monto_garant_01->CurrentValue = NULL;
		$this->monto_garant_01->OldValue = $this->monto_garant_01->CurrentValue;
		$this->monto_garant_02->CurrentValue = NULL;
		$this->monto_garant_02->OldValue = $this->monto_garant_02->CurrentValue;
		$this->monto_garant_03->CurrentValue = NULL;
		$this->monto_garant_03->OldValue = $this->monto_garant_03->CurrentValue;
		$this->estado_garant_01->CurrentValue = NULL;
		$this->estado_garant_01->OldValue = $this->estado_garant_01->CurrentValue;
		$this->estado_garant_02->CurrentValue = NULL;
		$this->estado_garant_02->OldValue = $this->estado_garant_02->CurrentValue;
		$this->estado_garant_03->CurrentValue = NULL;
		$this->estado_garant_03->OldValue = $this->estado_garant_03->CurrentValue;
		$this->fecha_venc_01->CurrentValue = NULL;
		$this->fecha_venc_01->OldValue = $this->fecha_venc_01->CurrentValue;
		$this->fecha_venc_02->CurrentValue = NULL;
		$this->fecha_venc_02->OldValue = $this->fecha_venc_02->CurrentValue;
		$this->fecha_venc_03->CurrentValue = NULL;
		$this->fecha_venc_03->OldValue = $this->fecha_venc_03->CurrentValue;
		$this->geo_latitud->CurrentValue = NULL;
		$this->geo_latitud->OldValue = $this->geo_latitud->CurrentValue;
		$this->geo_longitud->CurrentValue = NULL;
		$this->geo_longitud->OldValue = $this->geo_longitud->CurrentValue;
		$this->geo_lati_final->CurrentValue = NULL;
		$this->geo_lati_final->OldValue = $this->geo_lati_final->CurrentValue;
		$this->geo_long_final->CurrentValue = NULL;
		$this->geo_long_final->OldValue = $this->geo_long_final->CurrentValue;
		$this->fecha_inicio->CurrentValue = NULL;
		$this->fecha_inicio->OldValue = $this->fecha_inicio->CurrentValue;
		$this->estado_sol->CurrentValue = NULL;
		$this->estado_sol->OldValue = $this->estado_sol->CurrentValue;
		$this->fecha_registro->CurrentValue = NULL;
		$this->fecha_registro->OldValue = $this->fecha_registro->CurrentValue;
		$this->user_registro->CurrentValue = "system";
		$this->user_registro->OldValue = $this->user_registro->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$objForm->FormName = $this->FormName;
		if (!$this->codigo->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->codigo->setFormValue($objForm->GetValue("x_codigo"));
		if (!$this->idContratacion->FldIsDetailKey) {
			$this->idContratacion->setFormValue($objForm->GetValue("x_idContratacion"));
		}
		$this->idContratacion->setOldValue($objForm->GetValue("o_idContratacion"));
		if (!$this->imagen->FldIsDetailKey) {
			$this->imagen->setFormValue($objForm->GetValue("x_imagen"));
		}
		$this->imagen->setOldValue($objForm->GetValue("o_imagen"));
		if (!$this->cod_contacto_01->FldIsDetailKey) {
			$this->cod_contacto_01->setFormValue($objForm->GetValue("x_cod_contacto_01"));
		}
		$this->cod_contacto_01->setOldValue($objForm->GetValue("o_cod_contacto_01"));
		if (!$this->cod_contacto_02->FldIsDetailKey) {
			$this->cod_contacto_02->setFormValue($objForm->GetValue("x_cod_contacto_02"));
		}
		$this->cod_contacto_02->setOldValue($objForm->GetValue("o_cod_contacto_02"));
		if (!$this->cod_contacto_03->FldIsDetailKey) {
			$this->cod_contacto_03->setFormValue($objForm->GetValue("x_cod_contacto_03"));
		}
		$this->cod_contacto_03->setOldValue($objForm->GetValue("o_cod_contacto_03"));
		if (!$this->tipo_garant_01->FldIsDetailKey) {
			$this->tipo_garant_01->setFormValue($objForm->GetValue("x_tipo_garant_01"));
		}
		$this->tipo_garant_01->setOldValue($objForm->GetValue("o_tipo_garant_01"));
		if (!$this->tipo_garant_02->FldIsDetailKey) {
			$this->tipo_garant_02->setFormValue($objForm->GetValue("x_tipo_garant_02"));
		}
		$this->tipo_garant_02->setOldValue($objForm->GetValue("o_tipo_garant_02"));
		if (!$this->tipo_garant_03->FldIsDetailKey) {
			$this->tipo_garant_03->setFormValue($objForm->GetValue("x_tipo_garant_03"));
		}
		$this->tipo_garant_03->setOldValue($objForm->GetValue("o_tipo_garant_03"));
		if (!$this->monto_garant_01->FldIsDetailKey) {
			$this->monto_garant_01->setFormValue($objForm->GetValue("x_monto_garant_01"));
		}
		$this->monto_garant_01->setOldValue($objForm->GetValue("o_monto_garant_01"));
		if (!$this->monto_garant_02->FldIsDetailKey) {
			$this->monto_garant_02->setFormValue($objForm->GetValue("x_monto_garant_02"));
		}
		$this->monto_garant_02->setOldValue($objForm->GetValue("o_monto_garant_02"));
		if (!$this->monto_garant_03->FldIsDetailKey) {
			$this->monto_garant_03->setFormValue($objForm->GetValue("x_monto_garant_03"));
		}
		$this->monto_garant_03->setOldValue($objForm->GetValue("o_monto_garant_03"));
		if (!$this->estado_garant_01->FldIsDetailKey) {
			$this->estado_garant_01->setFormValue($objForm->GetValue("x_estado_garant_01"));
		}
		$this->estado_garant_01->setOldValue($objForm->GetValue("o_estado_garant_01"));
		if (!$this->estado_garant_02->FldIsDetailKey) {
			$this->estado_garant_02->setFormValue($objForm->GetValue("x_estado_garant_02"));
		}
		$this->estado_garant_02->setOldValue($objForm->GetValue("o_estado_garant_02"));
		if (!$this->estado_garant_03->FldIsDetailKey) {
			$this->estado_garant_03->setFormValue($objForm->GetValue("x_estado_garant_03"));
		}
		$this->estado_garant_03->setOldValue($objForm->GetValue("o_estado_garant_03"));
		if (!$this->fecha_venc_01->FldIsDetailKey) {
			$this->fecha_venc_01->setFormValue($objForm->GetValue("x_fecha_venc_01"));
			$this->fecha_venc_01->CurrentValue = ew_UnFormatDateTime($this->fecha_venc_01->CurrentValue, 5);
		}
		$this->fecha_venc_01->setOldValue($objForm->GetValue("o_fecha_venc_01"));
		if (!$this->fecha_venc_02->FldIsDetailKey) {
			$this->fecha_venc_02->setFormValue($objForm->GetValue("x_fecha_venc_02"));
			$this->fecha_venc_02->CurrentValue = ew_UnFormatDateTime($this->fecha_venc_02->CurrentValue, 5);
		}
		$this->fecha_venc_02->setOldValue($objForm->GetValue("o_fecha_venc_02"));
		if (!$this->fecha_venc_03->FldIsDetailKey) {
			$this->fecha_venc_03->setFormValue($objForm->GetValue("x_fecha_venc_03"));
			$this->fecha_venc_03->CurrentValue = ew_UnFormatDateTime($this->fecha_venc_03->CurrentValue, 5);
		}
		$this->fecha_venc_03->setOldValue($objForm->GetValue("o_fecha_venc_03"));
		if (!$this->geo_latitud->FldIsDetailKey) {
			$this->geo_latitud->setFormValue($objForm->GetValue("x_geo_latitud"));
		}
		$this->geo_latitud->setOldValue($objForm->GetValue("o_geo_latitud"));
		if (!$this->geo_longitud->FldIsDetailKey) {
			$this->geo_longitud->setFormValue($objForm->GetValue("x_geo_longitud"));
		}
		$this->geo_longitud->setOldValue($objForm->GetValue("o_geo_longitud"));
		if (!$this->geo_lati_final->FldIsDetailKey) {
			$this->geo_lati_final->setFormValue($objForm->GetValue("x_geo_lati_final"));
		}
		$this->geo_lati_final->setOldValue($objForm->GetValue("o_geo_lati_final"));
		if (!$this->geo_long_final->FldIsDetailKey) {
			$this->geo_long_final->setFormValue($objForm->GetValue("x_geo_long_final"));
		}
		$this->geo_long_final->setOldValue($objForm->GetValue("o_geo_long_final"));
		if (!$this->fecha_inicio->FldIsDetailKey) {
			$this->fecha_inicio->setFormValue($objForm->GetValue("x_fecha_inicio"));
			$this->fecha_inicio->CurrentValue = ew_UnFormatDateTime($this->fecha_inicio->CurrentValue, 5);
		}
		$this->fecha_inicio->setOldValue($objForm->GetValue("o_fecha_inicio"));
		if (!$this->estado_sol->FldIsDetailKey) {
			$this->estado_sol->setFormValue($objForm->GetValue("x_estado_sol"));
		}
		$this->estado_sol->setOldValue($objForm->GetValue("o_estado_sol"));
		if (!$this->fecha_registro->FldIsDetailKey) {
			$this->fecha_registro->setFormValue($objForm->GetValue("x_fecha_registro"));
			$this->fecha_registro->CurrentValue = ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5);
		}
		$this->fecha_registro->setOldValue($objForm->GetValue("o_fecha_registro"));
		if (!$this->user_registro->FldIsDetailKey) {
			$this->user_registro->setFormValue($objForm->GetValue("x_user_registro"));
		}
		$this->user_registro->setOldValue($objForm->GetValue("o_user_registro"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->codigo->CurrentValue = $this->codigo->FormValue;
		$this->idContratacion->CurrentValue = $this->idContratacion->FormValue;
		$this->imagen->CurrentValue = $this->imagen->FormValue;
		$this->cod_contacto_01->CurrentValue = $this->cod_contacto_01->FormValue;
		$this->cod_contacto_02->CurrentValue = $this->cod_contacto_02->FormValue;
		$this->cod_contacto_03->CurrentValue = $this->cod_contacto_03->FormValue;
		$this->tipo_garant_01->CurrentValue = $this->tipo_garant_01->FormValue;
		$this->tipo_garant_02->CurrentValue = $this->tipo_garant_02->FormValue;
		$this->tipo_garant_03->CurrentValue = $this->tipo_garant_03->FormValue;
		$this->monto_garant_01->CurrentValue = $this->monto_garant_01->FormValue;
		$this->monto_garant_02->CurrentValue = $this->monto_garant_02->FormValue;
		$this->monto_garant_03->CurrentValue = $this->monto_garant_03->FormValue;
		$this->estado_garant_01->CurrentValue = $this->estado_garant_01->FormValue;
		$this->estado_garant_02->CurrentValue = $this->estado_garant_02->FormValue;
		$this->estado_garant_03->CurrentValue = $this->estado_garant_03->FormValue;
		$this->fecha_venc_01->CurrentValue = $this->fecha_venc_01->FormValue;
		$this->fecha_venc_01->CurrentValue = ew_UnFormatDateTime($this->fecha_venc_01->CurrentValue, 5);
		$this->fecha_venc_02->CurrentValue = $this->fecha_venc_02->FormValue;
		$this->fecha_venc_02->CurrentValue = ew_UnFormatDateTime($this->fecha_venc_02->CurrentValue, 5);
		$this->fecha_venc_03->CurrentValue = $this->fecha_venc_03->FormValue;
		$this->fecha_venc_03->CurrentValue = ew_UnFormatDateTime($this->fecha_venc_03->CurrentValue, 5);
		$this->geo_latitud->CurrentValue = $this->geo_latitud->FormValue;
		$this->geo_longitud->CurrentValue = $this->geo_longitud->FormValue;
		$this->geo_lati_final->CurrentValue = $this->geo_lati_final->FormValue;
		$this->geo_long_final->CurrentValue = $this->geo_long_final->FormValue;
		$this->fecha_inicio->CurrentValue = $this->fecha_inicio->FormValue;
		$this->fecha_inicio->CurrentValue = ew_UnFormatDateTime($this->fecha_inicio->CurrentValue, 5);
		$this->estado_sol->CurrentValue = $this->estado_sol->FormValue;
		$this->fecha_registro->CurrentValue = $this->fecha_registro->FormValue;
		$this->fecha_registro->CurrentValue = ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5);
		$this->user_registro->CurrentValue = $this->user_registro->FormValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// codigo
			// idContratacion

			$this->idContratacion->EditAttrs["class"] = "form-control";
			$this->idContratacion->EditCustomAttributes = "";
			if ($this->idContratacion->getSessionValue() <> "") {
				$this->idContratacion->CurrentValue = $this->idContratacion->getSessionValue();
				$this->idContratacion->OldValue = $this->idContratacion->CurrentValue;
			$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
			$this->idContratacion->ViewCustomAttributes = "";
			} else {
			$this->idContratacion->EditValue = ew_HtmlEncode($this->idContratacion->CurrentValue);
			$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());
			}

			// imagen
			$this->imagen->EditAttrs["class"] = "form-control";
			$this->imagen->EditCustomAttributes = "";
			$this->imagen->EditValue = ew_HtmlEncode($this->imagen->CurrentValue);
			$this->imagen->PlaceHolder = ew_RemoveHtml($this->imagen->FldCaption());

			// cod_contacto_01
			$this->cod_contacto_01->EditAttrs["class"] = "form-control";
			$this->cod_contacto_01->EditCustomAttributes = "";
			$this->cod_contacto_01->EditValue = ew_HtmlEncode($this->cod_contacto_01->CurrentValue);
			$this->cod_contacto_01->PlaceHolder = ew_RemoveHtml($this->cod_contacto_01->FldCaption());

			// cod_contacto_02
			$this->cod_contacto_02->EditAttrs["class"] = "form-control";
			$this->cod_contacto_02->EditCustomAttributes = "";
			$this->cod_contacto_02->EditValue = ew_HtmlEncode($this->cod_contacto_02->CurrentValue);
			$this->cod_contacto_02->PlaceHolder = ew_RemoveHtml($this->cod_contacto_02->FldCaption());

			// cod_contacto_03
			$this->cod_contacto_03->EditAttrs["class"] = "form-control";
			$this->cod_contacto_03->EditCustomAttributes = "";
			$this->cod_contacto_03->EditValue = ew_HtmlEncode($this->cod_contacto_03->CurrentValue);
			$this->cod_contacto_03->PlaceHolder = ew_RemoveHtml($this->cod_contacto_03->FldCaption());

			// tipo_garant_01
			$this->tipo_garant_01->EditAttrs["class"] = "form-control";
			$this->tipo_garant_01->EditCustomAttributes = "";
			$this->tipo_garant_01->EditValue = ew_HtmlEncode($this->tipo_garant_01->CurrentValue);
			$this->tipo_garant_01->PlaceHolder = ew_RemoveHtml($this->tipo_garant_01->FldCaption());

			// tipo_garant_02
			$this->tipo_garant_02->EditAttrs["class"] = "form-control";
			$this->tipo_garant_02->EditCustomAttributes = "";
			$this->tipo_garant_02->EditValue = ew_HtmlEncode($this->tipo_garant_02->CurrentValue);
			$this->tipo_garant_02->PlaceHolder = ew_RemoveHtml($this->tipo_garant_02->FldCaption());

			// tipo_garant_03
			$this->tipo_garant_03->EditAttrs["class"] = "form-control";
			$this->tipo_garant_03->EditCustomAttributes = "";
			$this->tipo_garant_03->EditValue = ew_HtmlEncode($this->tipo_garant_03->CurrentValue);
			$this->tipo_garant_03->PlaceHolder = ew_RemoveHtml($this->tipo_garant_03->FldCaption());

			// monto_garant_01
			$this->monto_garant_01->EditAttrs["class"] = "form-control";
			$this->monto_garant_01->EditCustomAttributes = "";
			$this->monto_garant_01->EditValue = ew_HtmlEncode($this->monto_garant_01->CurrentValue);
			$this->monto_garant_01->PlaceHolder = ew_RemoveHtml($this->monto_garant_01->FldCaption());
			if (strval($this->monto_garant_01->EditValue) <> "" && is_numeric($this->monto_garant_01->EditValue)) {
			$this->monto_garant_01->EditValue = ew_FormatNumber($this->monto_garant_01->EditValue, -2, -1, -2, 0);
			$this->monto_garant_01->OldValue = $this->monto_garant_01->EditValue;
			}

			// monto_garant_02
			$this->monto_garant_02->EditAttrs["class"] = "form-control";
			$this->monto_garant_02->EditCustomAttributes = "";
			$this->monto_garant_02->EditValue = ew_HtmlEncode($this->monto_garant_02->CurrentValue);
			$this->monto_garant_02->PlaceHolder = ew_RemoveHtml($this->monto_garant_02->FldCaption());
			if (strval($this->monto_garant_02->EditValue) <> "" && is_numeric($this->monto_garant_02->EditValue)) {
			$this->monto_garant_02->EditValue = ew_FormatNumber($this->monto_garant_02->EditValue, -2, -1, -2, 0);
			$this->monto_garant_02->OldValue = $this->monto_garant_02->EditValue;
			}

			// monto_garant_03
			$this->monto_garant_03->EditAttrs["class"] = "form-control";
			$this->monto_garant_03->EditCustomAttributes = "";
			$this->monto_garant_03->EditValue = ew_HtmlEncode($this->monto_garant_03->CurrentValue);
			$this->monto_garant_03->PlaceHolder = ew_RemoveHtml($this->monto_garant_03->FldCaption());
			if (strval($this->monto_garant_03->EditValue) <> "" && is_numeric($this->monto_garant_03->EditValue)) {
			$this->monto_garant_03->EditValue = ew_FormatNumber($this->monto_garant_03->EditValue, -2, -1, -2, 0);
			$this->monto_garant_03->OldValue = $this->monto_garant_03->EditValue;
			}

			// estado_garant_01
			$this->estado_garant_01->EditAttrs["class"] = "form-control";
			$this->estado_garant_01->EditCustomAttributes = "";
			$this->estado_garant_01->EditValue = ew_HtmlEncode($this->estado_garant_01->CurrentValue);
			$this->estado_garant_01->PlaceHolder = ew_RemoveHtml($this->estado_garant_01->FldCaption());

			// estado_garant_02
			$this->estado_garant_02->EditAttrs["class"] = "form-control";
			$this->estado_garant_02->EditCustomAttributes = "";
			$this->estado_garant_02->EditValue = ew_HtmlEncode($this->estado_garant_02->CurrentValue);
			$this->estado_garant_02->PlaceHolder = ew_RemoveHtml($this->estado_garant_02->FldCaption());

			// estado_garant_03
			$this->estado_garant_03->EditAttrs["class"] = "form-control";
			$this->estado_garant_03->EditCustomAttributes = "";
			$this->estado_garant_03->EditValue = ew_HtmlEncode($this->estado_garant_03->CurrentValue);
			$this->estado_garant_03->PlaceHolder = ew_RemoveHtml($this->estado_garant_03->FldCaption());

			// fecha_venc_01
			$this->fecha_venc_01->EditAttrs["class"] = "form-control";
			$this->fecha_venc_01->EditCustomAttributes = "";
			$this->fecha_venc_01->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_venc_01->CurrentValue, 5));
			$this->fecha_venc_01->PlaceHolder = ew_RemoveHtml($this->fecha_venc_01->FldCaption());

			// fecha_venc_02
			$this->fecha_venc_02->EditAttrs["class"] = "form-control";
			$this->fecha_venc_02->EditCustomAttributes = "";
			$this->fecha_venc_02->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_venc_02->CurrentValue, 5));
			$this->fecha_venc_02->PlaceHolder = ew_RemoveHtml($this->fecha_venc_02->FldCaption());

			// fecha_venc_03
			$this->fecha_venc_03->EditAttrs["class"] = "form-control";
			$this->fecha_venc_03->EditCustomAttributes = "";
			$this->fecha_venc_03->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_venc_03->CurrentValue, 5));
			$this->fecha_venc_03->PlaceHolder = ew_RemoveHtml($this->fecha_venc_03->FldCaption());

			// geo_latitud
			$this->geo_latitud->EditAttrs["class"] = "form-control";
			$this->geo_latitud->EditCustomAttributes = "";
			$this->geo_latitud->EditValue = ew_HtmlEncode($this->geo_latitud->CurrentValue);
			$this->geo_latitud->PlaceHolder = ew_RemoveHtml($this->geo_latitud->FldCaption());
			if (strval($this->geo_latitud->EditValue) <> "" && is_numeric($this->geo_latitud->EditValue)) {
			$this->geo_latitud->EditValue = ew_FormatNumber($this->geo_latitud->EditValue, -2, -1, -2, 0);
			$this->geo_latitud->OldValue = $this->geo_latitud->EditValue;
			}

			// geo_longitud
			$this->geo_longitud->EditAttrs["class"] = "form-control";
			$this->geo_longitud->EditCustomAttributes = "";
			$this->geo_longitud->EditValue = ew_HtmlEncode($this->geo_longitud->CurrentValue);
			$this->geo_longitud->PlaceHolder = ew_RemoveHtml($this->geo_longitud->FldCaption());
			if (strval($this->geo_longitud->EditValue) <> "" && is_numeric($this->geo_longitud->EditValue)) {
			$this->geo_longitud->EditValue = ew_FormatNumber($this->geo_longitud->EditValue, -2, -1, -2, 0);
			$this->geo_longitud->OldValue = $this->geo_longitud->EditValue;
			}

			// geo_lati_final
			$this->geo_lati_final->EditAttrs["class"] = "form-control";
			$this->geo_lati_final->EditCustomAttributes = "";
			$this->geo_lati_final->EditValue = ew_HtmlEncode($this->geo_lati_final->CurrentValue);
			$this->geo_lati_final->PlaceHolder = ew_RemoveHtml($this->geo_lati_final->FldCaption());
			if (strval($this->geo_lati_final->EditValue) <> "" && is_numeric($this->geo_lati_final->EditValue)) {
			$this->geo_lati_final->EditValue = ew_FormatNumber($this->geo_lati_final->EditValue, -2, -1, -2, 0);
			$this->geo_lati_final->OldValue = $this->geo_lati_final->EditValue;
			}

			// geo_long_final
			$this->geo_long_final->EditAttrs["class"] = "form-control";
			$this->geo_long_final->EditCustomAttributes = "";
			$this->geo_long_final->EditValue = ew_HtmlEncode($this->geo_long_final->CurrentValue);
			$this->geo_long_final->PlaceHolder = ew_RemoveHtml($this->geo_long_final->FldCaption());
			if (strval($this->geo_long_final->EditValue) <> "" && is_numeric($this->geo_long_final->EditValue)) {
			$this->geo_long_final->EditValue = ew_FormatNumber($this->geo_long_final->EditValue, -2, -1, -2, 0);
			$this->geo_long_final->OldValue = $this->geo_long_final->EditValue;
			}

			// fecha_inicio
			$this->fecha_inicio->EditAttrs["class"] = "form-control";
			$this->fecha_inicio->EditCustomAttributes = "";
			$this->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_inicio->CurrentValue, 5));
			$this->fecha_inicio->PlaceHolder = ew_RemoveHtml($this->fecha_inicio->FldCaption());

			// estado_sol
			$this->estado_sol->EditAttrs["class"] = "form-control";
			$this->estado_sol->EditCustomAttributes = "";
			$this->estado_sol->EditValue = ew_HtmlEncode($this->estado_sol->CurrentValue);
			$this->estado_sol->PlaceHolder = ew_RemoveHtml($this->estado_sol->FldCaption());

			// fecha_registro
			$this->fecha_registro->EditAttrs["class"] = "form-control";
			$this->fecha_registro->EditCustomAttributes = "";
			$this->fecha_registro->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_registro->CurrentValue, 5));
			$this->fecha_registro->PlaceHolder = ew_RemoveHtml($this->fecha_registro->FldCaption());

			// user_registro
			$this->user_registro->EditAttrs["class"] = "form-control";
			$this->user_registro->EditCustomAttributes = "";
			$this->user_registro->EditValue = ew_HtmlEncode($this->user_registro->CurrentValue);
			$this->user_registro->PlaceHolder = ew_RemoveHtml($this->user_registro->FldCaption());

			// Edit refer script
			// codigo

			$this->codigo->HrefValue = "";

			// idContratacion
			$this->idContratacion->HrefValue = "";

			// imagen
			$this->imagen->HrefValue = "";

			// cod_contacto_01
			$this->cod_contacto_01->HrefValue = "";

			// cod_contacto_02
			$this->cod_contacto_02->HrefValue = "";

			// cod_contacto_03
			$this->cod_contacto_03->HrefValue = "";

			// tipo_garant_01
			$this->tipo_garant_01->HrefValue = "";

			// tipo_garant_02
			$this->tipo_garant_02->HrefValue = "";

			// tipo_garant_03
			$this->tipo_garant_03->HrefValue = "";

			// monto_garant_01
			$this->monto_garant_01->HrefValue = "";

			// monto_garant_02
			$this->monto_garant_02->HrefValue = "";

			// monto_garant_03
			$this->monto_garant_03->HrefValue = "";

			// estado_garant_01
			$this->estado_garant_01->HrefValue = "";

			// estado_garant_02
			$this->estado_garant_02->HrefValue = "";

			// estado_garant_03
			$this->estado_garant_03->HrefValue = "";

			// fecha_venc_01
			$this->fecha_venc_01->HrefValue = "";

			// fecha_venc_02
			$this->fecha_venc_02->HrefValue = "";

			// fecha_venc_03
			$this->fecha_venc_03->HrefValue = "";

			// geo_latitud
			$this->geo_latitud->HrefValue = "";

			// geo_longitud
			$this->geo_longitud->HrefValue = "";

			// geo_lati_final
			$this->geo_lati_final->HrefValue = "";

			// geo_long_final
			$this->geo_long_final->HrefValue = "";

			// fecha_inicio
			$this->fecha_inicio->HrefValue = "";

			// estado_sol
			$this->estado_sol->HrefValue = "";

			// fecha_registro
			$this->fecha_registro->HrefValue = "";

			// user_registro
			$this->user_registro->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			$this->codigo->EditValue = $this->codigo->CurrentValue;
			$this->codigo->ViewCustomAttributes = "";

			// idContratacion
			$this->idContratacion->EditAttrs["class"] = "form-control";
			$this->idContratacion->EditCustomAttributes = "";
			if ($this->idContratacion->getSessionValue() <> "") {
				$this->idContratacion->CurrentValue = $this->idContratacion->getSessionValue();
				$this->idContratacion->OldValue = $this->idContratacion->CurrentValue;
			$this->idContratacion->ViewValue = $this->idContratacion->CurrentValue;
			$this->idContratacion->ViewCustomAttributes = "";
			} else {
			$this->idContratacion->EditValue = ew_HtmlEncode($this->idContratacion->CurrentValue);
			$this->idContratacion->PlaceHolder = ew_RemoveHtml($this->idContratacion->FldCaption());
			}

			// imagen
			$this->imagen->EditAttrs["class"] = "form-control";
			$this->imagen->EditCustomAttributes = "";
			$this->imagen->EditValue = ew_HtmlEncode($this->imagen->CurrentValue);
			$this->imagen->PlaceHolder = ew_RemoveHtml($this->imagen->FldCaption());

			// cod_contacto_01
			$this->cod_contacto_01->EditAttrs["class"] = "form-control";
			$this->cod_contacto_01->EditCustomAttributes = "";
			$this->cod_contacto_01->EditValue = ew_HtmlEncode($this->cod_contacto_01->CurrentValue);
			$this->cod_contacto_01->PlaceHolder = ew_RemoveHtml($this->cod_contacto_01->FldCaption());

			// cod_contacto_02
			$this->cod_contacto_02->EditAttrs["class"] = "form-control";
			$this->cod_contacto_02->EditCustomAttributes = "";
			$this->cod_contacto_02->EditValue = ew_HtmlEncode($this->cod_contacto_02->CurrentValue);
			$this->cod_contacto_02->PlaceHolder = ew_RemoveHtml($this->cod_contacto_02->FldCaption());

			// cod_contacto_03
			$this->cod_contacto_03->EditAttrs["class"] = "form-control";
			$this->cod_contacto_03->EditCustomAttributes = "";
			$this->cod_contacto_03->EditValue = ew_HtmlEncode($this->cod_contacto_03->CurrentValue);
			$this->cod_contacto_03->PlaceHolder = ew_RemoveHtml($this->cod_contacto_03->FldCaption());

			// tipo_garant_01
			$this->tipo_garant_01->EditAttrs["class"] = "form-control";
			$this->tipo_garant_01->EditCustomAttributes = "";
			$this->tipo_garant_01->EditValue = ew_HtmlEncode($this->tipo_garant_01->CurrentValue);
			$this->tipo_garant_01->PlaceHolder = ew_RemoveHtml($this->tipo_garant_01->FldCaption());

			// tipo_garant_02
			$this->tipo_garant_02->EditAttrs["class"] = "form-control";
			$this->tipo_garant_02->EditCustomAttributes = "";
			$this->tipo_garant_02->EditValue = ew_HtmlEncode($this->tipo_garant_02->CurrentValue);
			$this->tipo_garant_02->PlaceHolder = ew_RemoveHtml($this->tipo_garant_02->FldCaption());

			// tipo_garant_03
			$this->tipo_garant_03->EditAttrs["class"] = "form-control";
			$this->tipo_garant_03->EditCustomAttributes = "";
			$this->tipo_garant_03->EditValue = ew_HtmlEncode($this->tipo_garant_03->CurrentValue);
			$this->tipo_garant_03->PlaceHolder = ew_RemoveHtml($this->tipo_garant_03->FldCaption());

			// monto_garant_01
			$this->monto_garant_01->EditAttrs["class"] = "form-control";
			$this->monto_garant_01->EditCustomAttributes = "";
			$this->monto_garant_01->EditValue = ew_HtmlEncode($this->monto_garant_01->CurrentValue);
			$this->monto_garant_01->PlaceHolder = ew_RemoveHtml($this->monto_garant_01->FldCaption());
			if (strval($this->monto_garant_01->EditValue) <> "" && is_numeric($this->monto_garant_01->EditValue)) {
			$this->monto_garant_01->EditValue = ew_FormatNumber($this->monto_garant_01->EditValue, -2, -1, -2, 0);
			$this->monto_garant_01->OldValue = $this->monto_garant_01->EditValue;
			}

			// monto_garant_02
			$this->monto_garant_02->EditAttrs["class"] = "form-control";
			$this->monto_garant_02->EditCustomAttributes = "";
			$this->monto_garant_02->EditValue = ew_HtmlEncode($this->monto_garant_02->CurrentValue);
			$this->monto_garant_02->PlaceHolder = ew_RemoveHtml($this->monto_garant_02->FldCaption());
			if (strval($this->monto_garant_02->EditValue) <> "" && is_numeric($this->monto_garant_02->EditValue)) {
			$this->monto_garant_02->EditValue = ew_FormatNumber($this->monto_garant_02->EditValue, -2, -1, -2, 0);
			$this->monto_garant_02->OldValue = $this->monto_garant_02->EditValue;
			}

			// monto_garant_03
			$this->monto_garant_03->EditAttrs["class"] = "form-control";
			$this->monto_garant_03->EditCustomAttributes = "";
			$this->monto_garant_03->EditValue = ew_HtmlEncode($this->monto_garant_03->CurrentValue);
			$this->monto_garant_03->PlaceHolder = ew_RemoveHtml($this->monto_garant_03->FldCaption());
			if (strval($this->monto_garant_03->EditValue) <> "" && is_numeric($this->monto_garant_03->EditValue)) {
			$this->monto_garant_03->EditValue = ew_FormatNumber($this->monto_garant_03->EditValue, -2, -1, -2, 0);
			$this->monto_garant_03->OldValue = $this->monto_garant_03->EditValue;
			}

			// estado_garant_01
			$this->estado_garant_01->EditAttrs["class"] = "form-control";
			$this->estado_garant_01->EditCustomAttributes = "";
			$this->estado_garant_01->EditValue = ew_HtmlEncode($this->estado_garant_01->CurrentValue);
			$this->estado_garant_01->PlaceHolder = ew_RemoveHtml($this->estado_garant_01->FldCaption());

			// estado_garant_02
			$this->estado_garant_02->EditAttrs["class"] = "form-control";
			$this->estado_garant_02->EditCustomAttributes = "";
			$this->estado_garant_02->EditValue = ew_HtmlEncode($this->estado_garant_02->CurrentValue);
			$this->estado_garant_02->PlaceHolder = ew_RemoveHtml($this->estado_garant_02->FldCaption());

			// estado_garant_03
			$this->estado_garant_03->EditAttrs["class"] = "form-control";
			$this->estado_garant_03->EditCustomAttributes = "";
			$this->estado_garant_03->EditValue = ew_HtmlEncode($this->estado_garant_03->CurrentValue);
			$this->estado_garant_03->PlaceHolder = ew_RemoveHtml($this->estado_garant_03->FldCaption());

			// fecha_venc_01
			$this->fecha_venc_01->EditAttrs["class"] = "form-control";
			$this->fecha_venc_01->EditCustomAttributes = "";
			$this->fecha_venc_01->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_venc_01->CurrentValue, 5));
			$this->fecha_venc_01->PlaceHolder = ew_RemoveHtml($this->fecha_venc_01->FldCaption());

			// fecha_venc_02
			$this->fecha_venc_02->EditAttrs["class"] = "form-control";
			$this->fecha_venc_02->EditCustomAttributes = "";
			$this->fecha_venc_02->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_venc_02->CurrentValue, 5));
			$this->fecha_venc_02->PlaceHolder = ew_RemoveHtml($this->fecha_venc_02->FldCaption());

			// fecha_venc_03
			$this->fecha_venc_03->EditAttrs["class"] = "form-control";
			$this->fecha_venc_03->EditCustomAttributes = "";
			$this->fecha_venc_03->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_venc_03->CurrentValue, 5));
			$this->fecha_venc_03->PlaceHolder = ew_RemoveHtml($this->fecha_venc_03->FldCaption());

			// geo_latitud
			$this->geo_latitud->EditAttrs["class"] = "form-control";
			$this->geo_latitud->EditCustomAttributes = "";
			$this->geo_latitud->EditValue = ew_HtmlEncode($this->geo_latitud->CurrentValue);
			$this->geo_latitud->PlaceHolder = ew_RemoveHtml($this->geo_latitud->FldCaption());
			if (strval($this->geo_latitud->EditValue) <> "" && is_numeric($this->geo_latitud->EditValue)) {
			$this->geo_latitud->EditValue = ew_FormatNumber($this->geo_latitud->EditValue, -2, -1, -2, 0);
			$this->geo_latitud->OldValue = $this->geo_latitud->EditValue;
			}

			// geo_longitud
			$this->geo_longitud->EditAttrs["class"] = "form-control";
			$this->geo_longitud->EditCustomAttributes = "";
			$this->geo_longitud->EditValue = ew_HtmlEncode($this->geo_longitud->CurrentValue);
			$this->geo_longitud->PlaceHolder = ew_RemoveHtml($this->geo_longitud->FldCaption());
			if (strval($this->geo_longitud->EditValue) <> "" && is_numeric($this->geo_longitud->EditValue)) {
			$this->geo_longitud->EditValue = ew_FormatNumber($this->geo_longitud->EditValue, -2, -1, -2, 0);
			$this->geo_longitud->OldValue = $this->geo_longitud->EditValue;
			}

			// geo_lati_final
			$this->geo_lati_final->EditAttrs["class"] = "form-control";
			$this->geo_lati_final->EditCustomAttributes = "";
			$this->geo_lati_final->EditValue = ew_HtmlEncode($this->geo_lati_final->CurrentValue);
			$this->geo_lati_final->PlaceHolder = ew_RemoveHtml($this->geo_lati_final->FldCaption());
			if (strval($this->geo_lati_final->EditValue) <> "" && is_numeric($this->geo_lati_final->EditValue)) {
			$this->geo_lati_final->EditValue = ew_FormatNumber($this->geo_lati_final->EditValue, -2, -1, -2, 0);
			$this->geo_lati_final->OldValue = $this->geo_lati_final->EditValue;
			}

			// geo_long_final
			$this->geo_long_final->EditAttrs["class"] = "form-control";
			$this->geo_long_final->EditCustomAttributes = "";
			$this->geo_long_final->EditValue = ew_HtmlEncode($this->geo_long_final->CurrentValue);
			$this->geo_long_final->PlaceHolder = ew_RemoveHtml($this->geo_long_final->FldCaption());
			if (strval($this->geo_long_final->EditValue) <> "" && is_numeric($this->geo_long_final->EditValue)) {
			$this->geo_long_final->EditValue = ew_FormatNumber($this->geo_long_final->EditValue, -2, -1, -2, 0);
			$this->geo_long_final->OldValue = $this->geo_long_final->EditValue;
			}

			// fecha_inicio
			$this->fecha_inicio->EditAttrs["class"] = "form-control";
			$this->fecha_inicio->EditCustomAttributes = "";
			$this->fecha_inicio->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_inicio->CurrentValue, 5));
			$this->fecha_inicio->PlaceHolder = ew_RemoveHtml($this->fecha_inicio->FldCaption());

			// estado_sol
			$this->estado_sol->EditAttrs["class"] = "form-control";
			$this->estado_sol->EditCustomAttributes = "";
			$this->estado_sol->EditValue = ew_HtmlEncode($this->estado_sol->CurrentValue);
			$this->estado_sol->PlaceHolder = ew_RemoveHtml($this->estado_sol->FldCaption());

			// fecha_registro
			$this->fecha_registro->EditAttrs["class"] = "form-control";
			$this->fecha_registro->EditCustomAttributes = "";
			$this->fecha_registro->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_registro->CurrentValue, 5));
			$this->fecha_registro->PlaceHolder = ew_RemoveHtml($this->fecha_registro->FldCaption());

			// user_registro
			$this->user_registro->EditAttrs["class"] = "form-control";
			$this->user_registro->EditCustomAttributes = "";
			$this->user_registro->EditValue = ew_HtmlEncode($this->user_registro->CurrentValue);
			$this->user_registro->PlaceHolder = ew_RemoveHtml($this->user_registro->FldCaption());

			// Edit refer script
			// codigo

			$this->codigo->HrefValue = "";

			// idContratacion
			$this->idContratacion->HrefValue = "";

			// imagen
			$this->imagen->HrefValue = "";

			// cod_contacto_01
			$this->cod_contacto_01->HrefValue = "";

			// cod_contacto_02
			$this->cod_contacto_02->HrefValue = "";

			// cod_contacto_03
			$this->cod_contacto_03->HrefValue = "";

			// tipo_garant_01
			$this->tipo_garant_01->HrefValue = "";

			// tipo_garant_02
			$this->tipo_garant_02->HrefValue = "";

			// tipo_garant_03
			$this->tipo_garant_03->HrefValue = "";

			// monto_garant_01
			$this->monto_garant_01->HrefValue = "";

			// monto_garant_02
			$this->monto_garant_02->HrefValue = "";

			// monto_garant_03
			$this->monto_garant_03->HrefValue = "";

			// estado_garant_01
			$this->estado_garant_01->HrefValue = "";

			// estado_garant_02
			$this->estado_garant_02->HrefValue = "";

			// estado_garant_03
			$this->estado_garant_03->HrefValue = "";

			// fecha_venc_01
			$this->fecha_venc_01->HrefValue = "";

			// fecha_venc_02
			$this->fecha_venc_02->HrefValue = "";

			// fecha_venc_03
			$this->fecha_venc_03->HrefValue = "";

			// geo_latitud
			$this->geo_latitud->HrefValue = "";

			// geo_longitud
			$this->geo_longitud->HrefValue = "";

			// geo_lati_final
			$this->geo_lati_final->HrefValue = "";

			// geo_long_final
			$this->geo_long_final->HrefValue = "";

			// fecha_inicio
			$this->fecha_inicio->HrefValue = "";

			// estado_sol
			$this->estado_sol->HrefValue = "";

			// fecha_registro
			$this->fecha_registro->HrefValue = "";

			// user_registro
			$this->user_registro->HrefValue = "";
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
		if (!$this->idContratacion->FldIsDetailKey && !is_null($this->idContratacion->FormValue) && $this->idContratacion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->idContratacion->FldCaption(), $this->idContratacion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->idContratacion->FormValue)) {
			ew_AddMessage($gsFormError, $this->idContratacion->FldErrMsg());
		}
		if (!$this->cod_contacto_01->FldIsDetailKey && !is_null($this->cod_contacto_01->FormValue) && $this->cod_contacto_01->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cod_contacto_01->FldCaption(), $this->cod_contacto_01->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->cod_contacto_01->FormValue)) {
			ew_AddMessage($gsFormError, $this->cod_contacto_01->FldErrMsg());
		}
		if (!$this->cod_contacto_02->FldIsDetailKey && !is_null($this->cod_contacto_02->FormValue) && $this->cod_contacto_02->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cod_contacto_02->FldCaption(), $this->cod_contacto_02->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->cod_contacto_02->FormValue)) {
			ew_AddMessage($gsFormError, $this->cod_contacto_02->FldErrMsg());
		}
		if (!$this->cod_contacto_03->FldIsDetailKey && !is_null($this->cod_contacto_03->FormValue) && $this->cod_contacto_03->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->cod_contacto_03->FldCaption(), $this->cod_contacto_03->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->cod_contacto_03->FormValue)) {
			ew_AddMessage($gsFormError, $this->cod_contacto_03->FldErrMsg());
		}
		if (!$this->tipo_garant_01->FldIsDetailKey && !is_null($this->tipo_garant_01->FormValue) && $this->tipo_garant_01->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tipo_garant_01->FldCaption(), $this->tipo_garant_01->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->tipo_garant_01->FormValue)) {
			ew_AddMessage($gsFormError, $this->tipo_garant_01->FldErrMsg());
		}
		if (!$this->tipo_garant_02->FldIsDetailKey && !is_null($this->tipo_garant_02->FormValue) && $this->tipo_garant_02->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tipo_garant_02->FldCaption(), $this->tipo_garant_02->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->tipo_garant_02->FormValue)) {
			ew_AddMessage($gsFormError, $this->tipo_garant_02->FldErrMsg());
		}
		if (!$this->tipo_garant_03->FldIsDetailKey && !is_null($this->tipo_garant_03->FormValue) && $this->tipo_garant_03->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tipo_garant_03->FldCaption(), $this->tipo_garant_03->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->tipo_garant_03->FormValue)) {
			ew_AddMessage($gsFormError, $this->tipo_garant_03->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monto_garant_01->FormValue)) {
			ew_AddMessage($gsFormError, $this->monto_garant_01->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monto_garant_02->FormValue)) {
			ew_AddMessage($gsFormError, $this->monto_garant_02->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monto_garant_03->FormValue)) {
			ew_AddMessage($gsFormError, $this->monto_garant_03->FldErrMsg());
		}
		if (!$this->estado_garant_01->FldIsDetailKey && !is_null($this->estado_garant_01->FormValue) && $this->estado_garant_01->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->estado_garant_01->FldCaption(), $this->estado_garant_01->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->estado_garant_01->FormValue)) {
			ew_AddMessage($gsFormError, $this->estado_garant_01->FldErrMsg());
		}
		if (!$this->estado_garant_02->FldIsDetailKey && !is_null($this->estado_garant_02->FormValue) && $this->estado_garant_02->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->estado_garant_02->FldCaption(), $this->estado_garant_02->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->estado_garant_02->FormValue)) {
			ew_AddMessage($gsFormError, $this->estado_garant_02->FldErrMsg());
		}
		if (!$this->estado_garant_03->FldIsDetailKey && !is_null($this->estado_garant_03->FormValue) && $this->estado_garant_03->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->estado_garant_03->FldCaption(), $this->estado_garant_03->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->estado_garant_03->FormValue)) {
			ew_AddMessage($gsFormError, $this->estado_garant_03->FldErrMsg());
		}
		if (!ew_CheckDate($this->fecha_venc_01->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_venc_01->FldErrMsg());
		}
		if (!ew_CheckDate($this->fecha_venc_02->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_venc_02->FldErrMsg());
		}
		if (!ew_CheckDate($this->fecha_venc_03->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_venc_03->FldErrMsg());
		}
		if (!ew_CheckNumber($this->geo_latitud->FormValue)) {
			ew_AddMessage($gsFormError, $this->geo_latitud->FldErrMsg());
		}
		if (!ew_CheckNumber($this->geo_longitud->FormValue)) {
			ew_AddMessage($gsFormError, $this->geo_longitud->FldErrMsg());
		}
		if (!ew_CheckNumber($this->geo_lati_final->FormValue)) {
			ew_AddMessage($gsFormError, $this->geo_lati_final->FldErrMsg());
		}
		if (!ew_CheckNumber($this->geo_long_final->FormValue)) {
			ew_AddMessage($gsFormError, $this->geo_long_final->FldErrMsg());
		}
		if (!ew_CheckDate($this->fecha_inicio->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_inicio->FldErrMsg());
		}
		if (!ew_CheckDate($this->fecha_registro->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_registro->FldErrMsg());
		}
		if (!$this->user_registro->FldIsDetailKey && !is_null($this->user_registro->FormValue) && $this->user_registro->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->user_registro->FldCaption(), $this->user_registro->ReqErrMsg));
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

		// Check if records exist for detail table 'cs_avances'
		if (!isset($GLOBALS["cs_avances"])) $GLOBALS["cs_avances"] = new ccs_avances();
		foreach ($rows as $row) {
			$rsdetail = $GLOBALS["cs_avances"]->LoadRs("`codigo_inicio_ejecucion` = " . ew_QuotedValue($row['idContratacion'], EW_DATATYPE_NUMBER, 'DB'));
			if ($rsdetail && !$rsdetail->EOF) {
				$sRelatedRecordMsg = str_replace("%t", "cs_avances", $Language->Phrase("RelatedRecordExists"));
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

			// idContratacion
			$this->idContratacion->SetDbValueDef($rsnew, $this->idContratacion->CurrentValue, 0, $this->idContratacion->ReadOnly);

			// imagen
			$this->imagen->SetDbValueDef($rsnew, $this->imagen->CurrentValue, NULL, $this->imagen->ReadOnly);

			// cod_contacto_01
			$this->cod_contacto_01->SetDbValueDef($rsnew, $this->cod_contacto_01->CurrentValue, 0, $this->cod_contacto_01->ReadOnly);

			// cod_contacto_02
			$this->cod_contacto_02->SetDbValueDef($rsnew, $this->cod_contacto_02->CurrentValue, 0, $this->cod_contacto_02->ReadOnly);

			// cod_contacto_03
			$this->cod_contacto_03->SetDbValueDef($rsnew, $this->cod_contacto_03->CurrentValue, 0, $this->cod_contacto_03->ReadOnly);

			// tipo_garant_01
			$this->tipo_garant_01->SetDbValueDef($rsnew, $this->tipo_garant_01->CurrentValue, 0, $this->tipo_garant_01->ReadOnly);

			// tipo_garant_02
			$this->tipo_garant_02->SetDbValueDef($rsnew, $this->tipo_garant_02->CurrentValue, 0, $this->tipo_garant_02->ReadOnly);

			// tipo_garant_03
			$this->tipo_garant_03->SetDbValueDef($rsnew, $this->tipo_garant_03->CurrentValue, 0, $this->tipo_garant_03->ReadOnly);

			// monto_garant_01
			$this->monto_garant_01->SetDbValueDef($rsnew, $this->monto_garant_01->CurrentValue, NULL, $this->monto_garant_01->ReadOnly);

			// monto_garant_02
			$this->monto_garant_02->SetDbValueDef($rsnew, $this->monto_garant_02->CurrentValue, NULL, $this->monto_garant_02->ReadOnly);

			// monto_garant_03
			$this->monto_garant_03->SetDbValueDef($rsnew, $this->monto_garant_03->CurrentValue, NULL, $this->monto_garant_03->ReadOnly);

			// estado_garant_01
			$this->estado_garant_01->SetDbValueDef($rsnew, $this->estado_garant_01->CurrentValue, 0, $this->estado_garant_01->ReadOnly);

			// estado_garant_02
			$this->estado_garant_02->SetDbValueDef($rsnew, $this->estado_garant_02->CurrentValue, 0, $this->estado_garant_02->ReadOnly);

			// estado_garant_03
			$this->estado_garant_03->SetDbValueDef($rsnew, $this->estado_garant_03->CurrentValue, 0, $this->estado_garant_03->ReadOnly);

			// fecha_venc_01
			$this->fecha_venc_01->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_venc_01->CurrentValue, 5), NULL, $this->fecha_venc_01->ReadOnly);

			// fecha_venc_02
			$this->fecha_venc_02->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_venc_02->CurrentValue, 5), NULL, $this->fecha_venc_02->ReadOnly);

			// fecha_venc_03
			$this->fecha_venc_03->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_venc_03->CurrentValue, 5), NULL, $this->fecha_venc_03->ReadOnly);

			// geo_latitud
			$this->geo_latitud->SetDbValueDef($rsnew, $this->geo_latitud->CurrentValue, NULL, $this->geo_latitud->ReadOnly);

			// geo_longitud
			$this->geo_longitud->SetDbValueDef($rsnew, $this->geo_longitud->CurrentValue, NULL, $this->geo_longitud->ReadOnly);

			// geo_lati_final
			$this->geo_lati_final->SetDbValueDef($rsnew, $this->geo_lati_final->CurrentValue, NULL, $this->geo_lati_final->ReadOnly);

			// geo_long_final
			$this->geo_long_final->SetDbValueDef($rsnew, $this->geo_long_final->CurrentValue, NULL, $this->geo_long_final->ReadOnly);

			// fecha_inicio
			$this->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_inicio->CurrentValue, 5), NULL, $this->fecha_inicio->ReadOnly);

			// estado_sol
			$this->estado_sol->SetDbValueDef($rsnew, $this->estado_sol->CurrentValue, NULL, $this->estado_sol->ReadOnly);

			// fecha_registro
			$this->fecha_registro->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5), NULL, $this->fecha_registro->ReadOnly);

			// user_registro
			$this->user_registro->SetDbValueDef($rsnew, $this->user_registro->CurrentValue, "", $this->user_registro->ReadOnly);

			// Check referential integrity for master table 'cs_contratacion'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_cs_contratacion();
			$KeyValue = isset($rsnew['idContratacion']) ? $rsnew['idContratacion'] : $rsold['idContratacion'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@idContratacion@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				$rsmaster = $GLOBALS["cs_contratacion"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "cs_contratacion", $Language->Phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "cs_contratacion") {
				$this->idContratacion->CurrentValue = $this->idContratacion->getSessionValue();
			}

		// Check referential integrity for master table 'cs_contratacion'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cs_contratacion();
		if (strval($this->idContratacion->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@idContratacion@", ew_AdjustSql($this->idContratacion->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			$rsmaster = $GLOBALS["cs_contratacion"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cs_contratacion", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// idContratacion
		$this->idContratacion->SetDbValueDef($rsnew, $this->idContratacion->CurrentValue, 0, FALSE);

		// imagen
		$this->imagen->SetDbValueDef($rsnew, $this->imagen->CurrentValue, NULL, FALSE);

		// cod_contacto_01
		$this->cod_contacto_01->SetDbValueDef($rsnew, $this->cod_contacto_01->CurrentValue, 0, FALSE);

		// cod_contacto_02
		$this->cod_contacto_02->SetDbValueDef($rsnew, $this->cod_contacto_02->CurrentValue, 0, FALSE);

		// cod_contacto_03
		$this->cod_contacto_03->SetDbValueDef($rsnew, $this->cod_contacto_03->CurrentValue, 0, FALSE);

		// tipo_garant_01
		$this->tipo_garant_01->SetDbValueDef($rsnew, $this->tipo_garant_01->CurrentValue, 0, FALSE);

		// tipo_garant_02
		$this->tipo_garant_02->SetDbValueDef($rsnew, $this->tipo_garant_02->CurrentValue, 0, FALSE);

		// tipo_garant_03
		$this->tipo_garant_03->SetDbValueDef($rsnew, $this->tipo_garant_03->CurrentValue, 0, FALSE);

		// monto_garant_01
		$this->monto_garant_01->SetDbValueDef($rsnew, $this->monto_garant_01->CurrentValue, NULL, FALSE);

		// monto_garant_02
		$this->monto_garant_02->SetDbValueDef($rsnew, $this->monto_garant_02->CurrentValue, NULL, FALSE);

		// monto_garant_03
		$this->monto_garant_03->SetDbValueDef($rsnew, $this->monto_garant_03->CurrentValue, NULL, FALSE);

		// estado_garant_01
		$this->estado_garant_01->SetDbValueDef($rsnew, $this->estado_garant_01->CurrentValue, 0, FALSE);

		// estado_garant_02
		$this->estado_garant_02->SetDbValueDef($rsnew, $this->estado_garant_02->CurrentValue, 0, FALSE);

		// estado_garant_03
		$this->estado_garant_03->SetDbValueDef($rsnew, $this->estado_garant_03->CurrentValue, 0, FALSE);

		// fecha_venc_01
		$this->fecha_venc_01->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_venc_01->CurrentValue, 5), NULL, FALSE);

		// fecha_venc_02
		$this->fecha_venc_02->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_venc_02->CurrentValue, 5), NULL, FALSE);

		// fecha_venc_03
		$this->fecha_venc_03->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_venc_03->CurrentValue, 5), NULL, FALSE);

		// geo_latitud
		$this->geo_latitud->SetDbValueDef($rsnew, $this->geo_latitud->CurrentValue, NULL, FALSE);

		// geo_longitud
		$this->geo_longitud->SetDbValueDef($rsnew, $this->geo_longitud->CurrentValue, NULL, FALSE);

		// geo_lati_final
		$this->geo_lati_final->SetDbValueDef($rsnew, $this->geo_lati_final->CurrentValue, NULL, FALSE);

		// geo_long_final
		$this->geo_long_final->SetDbValueDef($rsnew, $this->geo_long_final->CurrentValue, NULL, FALSE);

		// fecha_inicio
		$this->fecha_inicio->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_inicio->CurrentValue, 5), NULL, FALSE);

		// estado_sol
		$this->estado_sol->SetDbValueDef($rsnew, $this->estado_sol->CurrentValue, NULL, FALSE);

		// fecha_registro
		$this->fecha_registro->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_registro->CurrentValue, 5), NULL, FALSE);

		// user_registro
		$this->user_registro->SetDbValueDef($rsnew, $this->user_registro->CurrentValue, "", strval($this->user_registro->CurrentValue) == "");

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
		if ($sMasterTblVar == "cs_contratacion") {
			$this->idContratacion->Visible = FALSE;
			if ($GLOBALS["cs_contratacion"]->EventCancelled) $this->EventCancelled = TRUE;
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
