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

$cs_programa_view = NULL; // Initialize page object first

class ccs_programa_view extends ccs_programa {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_programa';

	// Page object name
	var $PageObjName = 'cs_programa_view';

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
		$KeyUrl = "";
		if (@$_GET["idPrograma"] <> "") {
			$this->RecKey["idPrograma"] = $_GET["idPrograma"];
			$KeyUrl .= "&amp;idPrograma=" . urlencode($this->RecKey["idPrograma"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (cruge_user)
		if (!isset($GLOBALS['cruge_user'])) $GLOBALS['cruge_user'] = new ccruge_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
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
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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

		// Create Token
		$this->CreateToken();
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
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["idPrograma"] <> "") {
				$this->idPrograma->setQueryStringValue($_GET["idPrograma"]);
				$this->RecKey["idPrograma"] = $this->idPrograma->QueryStringValue;
			} elseif (@$_POST["idPrograma"] <> "") {
				$this->idPrograma->setFormValue($_POST["idPrograma"]);
				$this->RecKey["idPrograma"] = $this->idPrograma->FormValue;
			} else {
				$sReturnUrl = "cs_programalist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_programalist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_programalist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();

		// Set up detail parameters
		$this->SetUpDetailParms();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];
		$option = &$options["detail"];
		$DetailTableLink = "";
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_cs_proyecto"
		$item = &$option->Add("detail_cs_proyecto");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("cs_proyecto", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_proyectolist.php?" . EW_TABLE_SHOW_MASTER . "=cs_programa&fk_idPrograma=" . urlencode(strval($this->idPrograma->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["cs_proyecto_grid"] && $GLOBALS["cs_proyecto_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_proyecto')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_proyecto")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "cs_proyecto";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_proyecto');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "cs_proyecto";
		}
		if ($this->ShowMultipleDetails) $item->Visible = FALSE;

		// Multiple details
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
			$oListOpt = &$option->Add("details");
			$oListOpt->Body = $body;
		}

		// Set up detail default
		$option = &$options["detail"];
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$option->UseImageAndText = TRUE;
		$ar = explode(",", $DetailTableLink);
		$cnt = count($ar);
		$option->UseDropDownButton = ($cnt > 1);
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

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

		// ubicacion
		$this->ubicacion->ViewValue = $this->ubicacion->CurrentValue;
		$this->ubicacion->ViewCustomAttributes = "";

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

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

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

			// ubicacion
			$this->ubicacion->LinkCustomAttributes = "";
			$this->ubicacion->HrefValue = "";
			$this->ubicacion->TooltipValue = "";

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

			// descripcion
			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";
			$this->descripcion->TooltipValue = "";

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

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("cs_proyecto", $DetailTblVar)) {
				if (!isset($GLOBALS["cs_proyecto_grid"]))
					$GLOBALS["cs_proyecto_grid"] = new ccs_proyecto_grid;
				if ($GLOBALS["cs_proyecto_grid"]->DetailView) {
					$GLOBALS["cs_proyecto_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["cs_proyecto_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cs_proyecto_grid"]->setStartRecordNumber(1);
					$GLOBALS["cs_proyecto_grid"]->idPrograma->FldIsDetailKey = TRUE;
					$GLOBALS["cs_proyecto_grid"]->idPrograma->CurrentValue = $this->idPrograma->CurrentValue;
					$GLOBALS["cs_proyecto_grid"]->idPrograma->setSessionValue($GLOBALS["cs_proyecto_grid"]->idPrograma->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_programalist.php", "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
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
if (!isset($cs_programa_view)) $cs_programa_view = new ccs_programa_view();

// Page init
$cs_programa_view->Page_Init();

// Page main
$cs_programa_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_programa_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_programaview = new ew_Form("fcs_programaview", "view");

// Form_CustomValidate event
fcs_programaview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_programaview.ValidateRequired = true;
<?php } else { ?>
fcs_programaview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fcs_programaview.Lists["x_entes"] = {"LinkField":"x_idente","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_programa_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_programa_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_programa_view->ShowPageHeader(); ?>
<?php
$cs_programa_view->ShowMessage();
?>
<form name="fcs_programaview" id="fcs_programaview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_programa_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_programa_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_programa">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_programa->idPrograma->Visible) { // idPrograma ?>
	<tr id="r_idPrograma">
		<td><span id="elh_cs_programa_idPrograma"><?php echo $cs_programa->idPrograma->FldCaption() ?></span></td>
		<td data-name="idPrograma"<?php echo $cs_programa->idPrograma->CellAttributes() ?>>
<span id="el_cs_programa_idPrograma">
<span<?php echo $cs_programa->idPrograma->ViewAttributes() ?>>
<?php echo $cs_programa->idPrograma->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->programa->Visible) { // programa ?>
	<tr id="r_programa">
		<td><span id="elh_cs_programa_programa"><?php echo $cs_programa->programa->FldCaption() ?></span></td>
		<td data-name="programa"<?php echo $cs_programa->programa->CellAttributes() ?>>
<span id="el_cs_programa_programa">
<span<?php echo $cs_programa->programa->ViewAttributes() ?>>
<?php echo $cs_programa->programa->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->BIP->Visible) { // BIP ?>
	<tr id="r_BIP">
		<td><span id="elh_cs_programa_BIP"><?php echo $cs_programa->BIP->FldCaption() ?></span></td>
		<td data-name="BIP"<?php echo $cs_programa->BIP->CellAttributes() ?>>
<span id="el_cs_programa_BIP">
<span<?php echo $cs_programa->BIP->ViewAttributes() ?>>
<?php echo $cs_programa->BIP->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->nombreprograma->Visible) { // nombreprograma ?>
	<tr id="r_nombreprograma">
		<td><span id="elh_cs_programa_nombreprograma"><?php echo $cs_programa->nombreprograma->FldCaption() ?></span></td>
		<td data-name="nombreprograma"<?php echo $cs_programa->nombreprograma->CellAttributes() ?>>
<span id="el_cs_programa_nombreprograma">
<span<?php echo $cs_programa->nombreprograma->ViewAttributes() ?>>
<?php echo $cs_programa->nombreprograma->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->ubicacion->Visible) { // ubicacion ?>
	<tr id="r_ubicacion">
		<td><span id="elh_cs_programa_ubicacion"><?php echo $cs_programa->ubicacion->FldCaption() ?></span></td>
		<td data-name="ubicacion"<?php echo $cs_programa->ubicacion->CellAttributes() ?>>
<span id="el_cs_programa_ubicacion">
<span<?php echo $cs_programa->ubicacion->ViewAttributes() ?>>
<?php echo $cs_programa->ubicacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->entes->Visible) { // entes ?>
	<tr id="r_entes">
		<td><span id="elh_cs_programa_entes"><?php echo $cs_programa->entes->FldCaption() ?></span></td>
		<td data-name="entes"<?php echo $cs_programa->entes->CellAttributes() ?>>
<span id="el_cs_programa_entes">
<span<?php echo $cs_programa->entes->ViewAttributes() ?>>
<?php echo $cs_programa->entes->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->idFuncionario->Visible) { // idFuncionario ?>
	<tr id="r_idFuncionario">
		<td><span id="elh_cs_programa_idFuncionario"><?php echo $cs_programa->idFuncionario->FldCaption() ?></span></td>
		<td data-name="idFuncionario"<?php echo $cs_programa->idFuncionario->CellAttributes() ?>>
<span id="el_cs_programa_idFuncionario">
<span<?php echo $cs_programa->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_programa->idFuncionario->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->idRol->Visible) { // idRol ?>
	<tr id="r_idRol">
		<td><span id="elh_cs_programa_idRol"><?php echo $cs_programa->idRol->FldCaption() ?></span></td>
		<td data-name="idRol"<?php echo $cs_programa->idRol->CellAttributes() ?>>
<span id="el_cs_programa_idRol">
<span<?php echo $cs_programa->idRol->ViewAttributes() ?>>
<?php echo $cs_programa->idRol->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->idSector->Visible) { // idSector ?>
	<tr id="r_idSector">
		<td><span id="elh_cs_programa_idSector"><?php echo $cs_programa->idSector->FldCaption() ?></span></td>
		<td data-name="idSector"<?php echo $cs_programa->idSector->CellAttributes() ?>>
<span id="el_cs_programa_idSector">
<span<?php echo $cs_programa->idSector->ViewAttributes() ?>>
<?php echo $cs_programa->idSector->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->idSubSector->Visible) { // idSubSector ?>
	<tr id="r_idSubSector">
		<td><span id="elh_cs_programa_idSubSector"><?php echo $cs_programa->idSubSector->FldCaption() ?></span></td>
		<td data-name="idSubSector"<?php echo $cs_programa->idSubSector->CellAttributes() ?>>
<span id="el_cs_programa_idSubSector">
<span<?php echo $cs_programa->idSubSector->ViewAttributes() ?>>
<?php echo $cs_programa->idSubSector->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td><span id="elh_cs_programa_descripcion"><?php echo $cs_programa->descripcion->FldCaption() ?></span></td>
		<td data-name="descripcion"<?php echo $cs_programa->descripcion->CellAttributes() ?>>
<span id="el_cs_programa_descripcion">
<span<?php echo $cs_programa->descripcion->ViewAttributes() ?>>
<?php echo $cs_programa->descripcion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->costoesti->Visible) { // costoesti ?>
	<tr id="r_costoesti">
		<td><span id="elh_cs_programa_costoesti"><?php echo $cs_programa->costoesti->FldCaption() ?></span></td>
		<td data-name="costoesti"<?php echo $cs_programa->costoesti->CellAttributes() ?>>
<span id="el_cs_programa_costoesti">
<span<?php echo $cs_programa->costoesti->ViewAttributes() ?>>
<?php echo $cs_programa->costoesti->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->fechaapro->Visible) { // fechaapro ?>
	<tr id="r_fechaapro">
		<td><span id="elh_cs_programa_fechaapro"><?php echo $cs_programa->fechaapro->FldCaption() ?></span></td>
		<td data-name="fechaapro"<?php echo $cs_programa->fechaapro->CellAttributes() ?>>
<span id="el_cs_programa_fechaapro">
<span<?php echo $cs_programa->fechaapro->ViewAttributes() ?>>
<?php echo $cs_programa->fechaapro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->cartaconvenio->Visible) { // cartaconvenio ?>
	<tr id="r_cartaconvenio">
		<td><span id="elh_cs_programa_cartaconvenio"><?php echo $cs_programa->cartaconvenio->FldCaption() ?></span></td>
		<td data-name="cartaconvenio"<?php echo $cs_programa->cartaconvenio->CellAttributes() ?>>
<span id="el_cs_programa_cartaconvenio">
<span<?php echo $cs_programa->cartaconvenio->ViewAttributes() ?>>
<?php echo $cs_programa->cartaconvenio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->otro1->Visible) { // otro1 ?>
	<tr id="r_otro1">
		<td><span id="elh_cs_programa_otro1"><?php echo $cs_programa->otro1->FldCaption() ?></span></td>
		<td data-name="otro1"<?php echo $cs_programa->otro1->CellAttributes() ?>>
<span id="el_cs_programa_otro1">
<span<?php echo $cs_programa->otro1->ViewAttributes() ?>>
<?php echo $cs_programa->otro1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->planope->Visible) { // planope ?>
	<tr id="r_planope">
		<td><span id="elh_cs_programa_planope"><?php echo $cs_programa->planope->FldCaption() ?></span></td>
		<td data-name="planope"<?php echo $cs_programa->planope->CellAttributes() ?>>
<span id="el_cs_programa_planope">
<span<?php echo $cs_programa->planope->ViewAttributes() ?>>
<?php echo $cs_programa->planope->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->presupuesto->Visible) { // presupuesto ?>
	<tr id="r_presupuesto">
		<td><span id="elh_cs_programa_presupuesto"><?php echo $cs_programa->presupuesto->FldCaption() ?></span></td>
		<td data-name="presupuesto"<?php echo $cs_programa->presupuesto->CellAttributes() ?>>
<span id="el_cs_programa_presupuesto">
<span<?php echo $cs_programa->presupuesto->ViewAttributes() ?>>
<?php echo $cs_programa->presupuesto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->perfildelprogra->Visible) { // perfildelprogra ?>
	<tr id="r_perfildelprogra">
		<td><span id="elh_cs_programa_perfildelprogra"><?php echo $cs_programa->perfildelprogra->FldCaption() ?></span></td>
		<td data-name="perfildelprogra"<?php echo $cs_programa->perfildelprogra->CellAttributes() ?>>
<span id="el_cs_programa_perfildelprogra">
<span<?php echo $cs_programa->perfildelprogra->ViewAttributes() ?>>
<?php echo $cs_programa->perfildelprogra->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->otro2->Visible) { // otro2 ?>
	<tr id="r_otro2">
		<td><span id="elh_cs_programa_otro2"><?php echo $cs_programa->otro2->FldCaption() ?></span></td>
		<td data-name="otro2"<?php echo $cs_programa->otro2->CellAttributes() ?>>
<span id="el_cs_programa_otro2">
<span<?php echo $cs_programa->otro2->ViewAttributes() ?>>
<?php echo $cs_programa->otro2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->fechacreacion->Visible) { // fechacreacion ?>
	<tr id="r_fechacreacion">
		<td><span id="elh_cs_programa_fechacreacion"><?php echo $cs_programa->fechacreacion->FldCaption() ?></span></td>
		<td data-name="fechacreacion"<?php echo $cs_programa->fechacreacion->CellAttributes() ?>>
<span id="el_cs_programa_fechacreacion">
<span<?php echo $cs_programa->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_programa->fechacreacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td><span id="elh_cs_programa_estado"><?php echo $cs_programa->estado->FldCaption() ?></span></td>
		<td data-name="estado"<?php echo $cs_programa->estado->CellAttributes() ?>>
<span id="el_cs_programa_estado">
<span<?php echo $cs_programa->estado->ViewAttributes() ?>>
<?php echo $cs_programa->estado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->idProposito->Visible) { // idProposito ?>
	<tr id="r_idProposito">
		<td><span id="elh_cs_programa_idProposito"><?php echo $cs_programa->idProposito->FldCaption() ?></span></td>
		<td data-name="idProposito"<?php echo $cs_programa->idProposito->CellAttributes() ?>>
<span id="el_cs_programa_idProposito">
<span<?php echo $cs_programa->idProposito->ViewAttributes() ?>>
<?php echo $cs_programa->idProposito->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->fecharecibido->Visible) { // fecharecibido ?>
	<tr id="r_fecharecibido">
		<td><span id="elh_cs_programa_fecharecibido"><?php echo $cs_programa->fecharecibido->FldCaption() ?></span></td>
		<td data-name="fecharecibido"<?php echo $cs_programa->fecharecibido->CellAttributes() ?>>
<span id="el_cs_programa_fecharecibido">
<span<?php echo $cs_programa->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_programa->fecharecibido->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_programa->moneda->Visible) { // moneda ?>
	<tr id="r_moneda">
		<td><span id="elh_cs_programa_moneda"><?php echo $cs_programa->moneda->FldCaption() ?></span></td>
		<td data-name="moneda"<?php echo $cs_programa->moneda->CellAttributes() ?>>
<span id="el_cs_programa_moneda">
<span<?php echo $cs_programa->moneda->ViewAttributes() ?>>
<?php echo $cs_programa->moneda->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cs_proyecto", explode(",", $cs_programa->getCurrentDetailTable())) && $cs_proyecto->DetailView) {
?>
<?php if ($cs_programa->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("cs_proyecto", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cs_proyectogrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
fcs_programaview.Init();
</script>
<?php
$cs_programa_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_programa_view->Page_Terminate();
?>
