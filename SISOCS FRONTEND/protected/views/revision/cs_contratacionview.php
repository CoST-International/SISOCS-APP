<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg12.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql12.php") ?>
<?php include_once "phpfn12.php" ?>
<?php include_once "cs_contratacioninfo.php" ?>
<?php include_once "cruge_userinfo.php" ?>
<?php include_once "cs_adjudicacioninfo.php" ?>
<?php include_once "cs_inicio_ejecuciongridcls.php" ?>
<?php include_once "userfn12.php" ?>
<?php

//
// Page class
//

$cs_contratacion_view = NULL; // Initialize page object first

class ccs_contratacion_view extends ccs_contratacion {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_contratacion';

	// Page object name
	var $PageObjName = 'cs_contratacion_view';

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

		// Table object (cs_contratacion)
		if (!isset($GLOBALS["cs_contratacion"]) || get_class($GLOBALS["cs_contratacion"]) == "ccs_contratacion") {
			$GLOBALS["cs_contratacion"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cs_contratacion"];
		}
		$KeyUrl = "";
		if (@$_GET["idContratacion"] <> "") {
			$this->RecKey["idContratacion"] = $_GET["idContratacion"];
			$KeyUrl .= "&amp;idContratacion=" . urlencode($this->RecKey["idContratacion"]);
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

		// Table object (cs_adjudicacion)
		if (!isset($GLOBALS['cs_adjudicacion'])) $GLOBALS['cs_adjudicacion'] = new ccs_adjudicacion();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["idContratacion"] <> "") {
				$this->idContratacion->setQueryStringValue($_GET["idContratacion"]);
				$this->RecKey["idContratacion"] = $this->idContratacion->QueryStringValue;
			} elseif (@$_POST["idContratacion"] <> "") {
				$this->idContratacion->setFormValue($_POST["idContratacion"]);
				$this->RecKey["idContratacion"] = $this->idContratacion->FormValue;
			} else {
				$sReturnUrl = "cs_contratacionlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_contratacionlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_contratacionlist.php"; // Not page request, return to list
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

		// "detail_cs_inicio_ejecucion"
		$item = &$option->Add("detail_cs_inicio_ejecucion");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("cs_inicio_ejecucion", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_inicio_ejecucionlist.php?" . EW_TABLE_SHOW_MASTER . "=cs_contratacion&fk_idContratacion=" . urlencode(strval($this->idContratacion->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["cs_inicio_ejecucion_grid"] && $GLOBALS["cs_inicio_ejecucion_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_inicio_ejecucion')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_inicio_ejecucion")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "cs_inicio_ejecucion";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_inicio_ejecucion');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "cs_inicio_ejecucion";
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

		// alcances
		$this->alcances->ViewValue = $this->alcances->CurrentValue;
		$this->alcances->ViewCustomAttributes = "";

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

		// titulocontrato
		$this->titulocontrato->ViewValue = $this->titulocontrato->CurrentValue;
		$this->titulocontrato->ViewCustomAttributes = "";

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

			// alcances
			$this->alcances->LinkCustomAttributes = "";
			$this->alcances->HrefValue = "";
			$this->alcances->TooltipValue = "";

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

			// titulocontrato
			$this->titulocontrato->LinkCustomAttributes = "";
			$this->titulocontrato->HrefValue = "";
			$this->titulocontrato->TooltipValue = "";

			// fecharecibido
			$this->fecharecibido->LinkCustomAttributes = "";
			$this->fecharecibido->HrefValue = "";
			$this->fecharecibido->TooltipValue = "";

			// fechacreacion
			$this->fechacreacion->LinkCustomAttributes = "";
			$this->fechacreacion->HrefValue = "";
			$this->fechacreacion->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
			if ($sMasterTblVar == "cs_adjudicacion") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_idAdjudicacion"] <> "") {
					$GLOBALS["cs_adjudicacion"]->idAdjudicacion->setQueryStringValue($_GET["fk_idAdjudicacion"]);
					$this->idAdjudicacion->setQueryStringValue($GLOBALS["cs_adjudicacion"]->idAdjudicacion->QueryStringValue);
					$this->idAdjudicacion->setSessionValue($this->idAdjudicacion->QueryStringValue);
					if (!is_numeric($GLOBALS["cs_adjudicacion"]->idAdjudicacion->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "cs_adjudicacion") {
				if ($this->idAdjudicacion->QueryStringValue == "") $this->idAdjudicacion->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
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
			if (in_array("cs_inicio_ejecucion", $DetailTblVar)) {
				if (!isset($GLOBALS["cs_inicio_ejecucion_grid"]))
					$GLOBALS["cs_inicio_ejecucion_grid"] = new ccs_inicio_ejecucion_grid;
				if ($GLOBALS["cs_inicio_ejecucion_grid"]->DetailView) {
					$GLOBALS["cs_inicio_ejecucion_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["cs_inicio_ejecucion_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cs_inicio_ejecucion_grid"]->setStartRecordNumber(1);
					$GLOBALS["cs_inicio_ejecucion_grid"]->idContratacion->FldIsDetailKey = TRUE;
					$GLOBALS["cs_inicio_ejecucion_grid"]->idContratacion->CurrentValue = $this->idContratacion->CurrentValue;
					$GLOBALS["cs_inicio_ejecucion_grid"]->idContratacion->setSessionValue($GLOBALS["cs_inicio_ejecucion_grid"]->idContratacion->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_contratacionlist.php", "", $this->TableVar, TRUE);
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
if (!isset($cs_contratacion_view)) $cs_contratacion_view = new ccs_contratacion_view();

// Page init
$cs_contratacion_view->Page_Init();

// Page main
$cs_contratacion_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_contratacion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_contratacionview = new ew_Form("fcs_contratacionview", "view");

// Form_CustomValidate event
fcs_contratacionview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_contratacionview.ValidateRequired = true;
<?php } else { ?>
fcs_contratacionview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_contratacion_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_contratacion_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_contratacion_view->ShowPageHeader(); ?>
<?php
$cs_contratacion_view->ShowMessage();
?>
<form name="fcs_contratacionview" id="fcs_contratacionview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_contratacion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_contratacion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_contratacion">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_contratacion->idContratacion->Visible) { // idContratacion ?>
	<tr id="r_idContratacion">
		<td><span id="elh_cs_contratacion_idContratacion"><?php echo $cs_contratacion->idContratacion->FldCaption() ?></span></td>
		<td data-name="idContratacion"<?php echo $cs_contratacion->idContratacion->CellAttributes() ?>>
<span id="el_cs_contratacion_idContratacion">
<span<?php echo $cs_contratacion->idContratacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idContratacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->idAdjudicacion->Visible) { // idAdjudicacion ?>
	<tr id="r_idAdjudicacion">
		<td><span id="elh_cs_contratacion_idAdjudicacion"><?php echo $cs_contratacion->idAdjudicacion->FldCaption() ?></span></td>
		<td data-name="idAdjudicacion"<?php echo $cs_contratacion->idAdjudicacion->CellAttributes() ?>>
<span id="el_cs_contratacion_idAdjudicacion">
<span<?php echo $cs_contratacion->idAdjudicacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->idAdjudicacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->idEntidad->Visible) { // idEntidad ?>
	<tr id="r_idEntidad">
		<td><span id="elh_cs_contratacion_idEntidad"><?php echo $cs_contratacion->idEntidad->FldCaption() ?></span></td>
		<td data-name="idEntidad"<?php echo $cs_contratacion->idEntidad->CellAttributes() ?>>
<span id="el_cs_contratacion_idEntidad">
<span<?php echo $cs_contratacion->idEntidad->ViewAttributes() ?>>
<?php echo $cs_contratacion->idEntidad->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->idoferente->Visible) { // idoferente ?>
	<tr id="r_idoferente">
		<td><span id="elh_cs_contratacion_idoferente"><?php echo $cs_contratacion->idoferente->FldCaption() ?></span></td>
		<td data-name="idoferente"<?php echo $cs_contratacion->idoferente->CellAttributes() ?>>
<span id="el_cs_contratacion_idoferente">
<span<?php echo $cs_contratacion->idoferente->ViewAttributes() ?>>
<?php echo $cs_contratacion->idoferente->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->precio->Visible) { // precio ?>
	<tr id="r_precio">
		<td><span id="elh_cs_contratacion_precio"><?php echo $cs_contratacion->precio->FldCaption() ?></span></td>
		<td data-name="precio"<?php echo $cs_contratacion->precio->CellAttributes() ?>>
<span id="el_cs_contratacion_precio">
<span<?php echo $cs_contratacion->precio->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->precio2->Visible) { // precio2 ?>
	<tr id="r_precio2">
		<td><span id="elh_cs_contratacion_precio2"><?php echo $cs_contratacion->precio2->FldCaption() ?></span></td>
		<td data-name="precio2"<?php echo $cs_contratacion->precio2->CellAttributes() ?>>
<span id="el_cs_contratacion_precio2">
<span<?php echo $cs_contratacion->precio2->ViewAttributes() ?>>
<?php echo $cs_contratacion->precio2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->alcances->Visible) { // alcances ?>
	<tr id="r_alcances">
		<td><span id="elh_cs_contratacion_alcances"><?php echo $cs_contratacion->alcances->FldCaption() ?></span></td>
		<td data-name="alcances"<?php echo $cs_contratacion->alcances->CellAttributes() ?>>
<span id="el_cs_contratacion_alcances">
<span<?php echo $cs_contratacion->alcances->ViewAttributes() ?>>
<?php echo $cs_contratacion->alcances->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->fechainicio->Visible) { // fechainicio ?>
	<tr id="r_fechainicio">
		<td><span id="elh_cs_contratacion_fechainicio"><?php echo $cs_contratacion->fechainicio->FldCaption() ?></span></td>
		<td data-name="fechainicio"<?php echo $cs_contratacion->fechainicio->CellAttributes() ?>>
<span id="el_cs_contratacion_fechainicio">
<span<?php echo $cs_contratacion->fechainicio->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechainicio->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->fechafinal->Visible) { // fechafinal ?>
	<tr id="r_fechafinal">
		<td><span id="elh_cs_contratacion_fechafinal"><?php echo $cs_contratacion->fechafinal->FldCaption() ?></span></td>
		<td data-name="fechafinal"<?php echo $cs_contratacion->fechafinal->CellAttributes() ?>>
<span id="el_cs_contratacion_fechafinal">
<span<?php echo $cs_contratacion->fechafinal->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechafinal->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->duracioncontrato->Visible) { // duracioncontrato ?>
	<tr id="r_duracioncontrato">
		<td><span id="elh_cs_contratacion_duracioncontrato"><?php echo $cs_contratacion->duracioncontrato->FldCaption() ?></span></td>
		<td data-name="duracioncontrato"<?php echo $cs_contratacion->duracioncontrato->CellAttributes() ?>>
<span id="el_cs_contratacion_duracioncontrato">
<span<?php echo $cs_contratacion->duracioncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->duracioncontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->documentocontra->Visible) { // documentocontra ?>
	<tr id="r_documentocontra">
		<td><span id="elh_cs_contratacion_documentocontra"><?php echo $cs_contratacion->documentocontra->FldCaption() ?></span></td>
		<td data-name="documentocontra"<?php echo $cs_contratacion->documentocontra->CellAttributes() ?>>
<span id="el_cs_contratacion_documentocontra">
<span<?php echo $cs_contratacion->documentocontra->ViewAttributes() ?>>
<?php echo $cs_contratacion->documentocontra->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->regante->Visible) { // regante ?>
	<tr id="r_regante">
		<td><span id="elh_cs_contratacion_regante"><?php echo $cs_contratacion->regante->FldCaption() ?></span></td>
		<td data-name="regante"<?php echo $cs_contratacion->regante->CellAttributes() ?>>
<span id="el_cs_contratacion_regante">
<span<?php echo $cs_contratacion->regante->ViewAttributes() ?>>
<?php echo $cs_contratacion->regante->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->espeplanos->Visible) { // espeplanos ?>
	<tr id="r_espeplanos">
		<td><span id="elh_cs_contratacion_espeplanos"><?php echo $cs_contratacion->espeplanos->FldCaption() ?></span></td>
		<td data-name="espeplanos"<?php echo $cs_contratacion->espeplanos->CellAttributes() ?>>
<span id="el_cs_contratacion_espeplanos">
<span<?php echo $cs_contratacion->espeplanos->ViewAttributes() ?>>
<?php echo $cs_contratacion->espeplanos->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td><span id="elh_cs_contratacion_estado"><?php echo $cs_contratacion->estado->FldCaption() ?></span></td>
		<td data-name="estado"<?php echo $cs_contratacion->estado->CellAttributes() ?>>
<span id="el_cs_contratacion_estado">
<span<?php echo $cs_contratacion->estado->ViewAttributes() ?>>
<?php echo $cs_contratacion->estado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->otro->Visible) { // otro ?>
	<tr id="r_otro">
		<td><span id="elh_cs_contratacion_otro"><?php echo $cs_contratacion->otro->FldCaption() ?></span></td>
		<td data-name="otro"<?php echo $cs_contratacion->otro->CellAttributes() ?>>
<span id="el_cs_contratacion_otro">
<span<?php echo $cs_contratacion->otro->ViewAttributes() ?>>
<?php echo $cs_contratacion->otro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->ncontrato->Visible) { // ncontrato ?>
	<tr id="r_ncontrato">
		<td><span id="elh_cs_contratacion_ncontrato"><?php echo $cs_contratacion->ncontrato->FldCaption() ?></span></td>
		<td data-name="ncontrato"<?php echo $cs_contratacion->ncontrato->CellAttributes() ?>>
<span id="el_cs_contratacion_ncontrato">
<span<?php echo $cs_contratacion->ncontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->ncontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->titulocontrato->Visible) { // titulocontrato ?>
	<tr id="r_titulocontrato">
		<td><span id="elh_cs_contratacion_titulocontrato"><?php echo $cs_contratacion->titulocontrato->FldCaption() ?></span></td>
		<td data-name="titulocontrato"<?php echo $cs_contratacion->titulocontrato->CellAttributes() ?>>
<span id="el_cs_contratacion_titulocontrato">
<span<?php echo $cs_contratacion->titulocontrato->ViewAttributes() ?>>
<?php echo $cs_contratacion->titulocontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->fecharecibido->Visible) { // fecharecibido ?>
	<tr id="r_fecharecibido">
		<td><span id="elh_cs_contratacion_fecharecibido"><?php echo $cs_contratacion->fecharecibido->FldCaption() ?></span></td>
		<td data-name="fecharecibido"<?php echo $cs_contratacion->fecharecibido->CellAttributes() ?>>
<span id="el_cs_contratacion_fecharecibido">
<span<?php echo $cs_contratacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_contratacion->fecharecibido->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_contratacion->fechacreacion->Visible) { // fechacreacion ?>
	<tr id="r_fechacreacion">
		<td><span id="elh_cs_contratacion_fechacreacion"><?php echo $cs_contratacion->fechacreacion->FldCaption() ?></span></td>
		<td data-name="fechacreacion"<?php echo $cs_contratacion->fechacreacion->CellAttributes() ?>>
<span id="el_cs_contratacion_fechacreacion">
<span<?php echo $cs_contratacion->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_contratacion->fechacreacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cs_inicio_ejecucion", explode(",", $cs_contratacion->getCurrentDetailTable())) && $cs_inicio_ejecucion->DetailView) {
?>
<?php if ($cs_contratacion->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("cs_inicio_ejecucion", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cs_inicio_ejecuciongrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
fcs_contratacionview.Init();
</script>
<?php
$cs_contratacion_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_contratacion_view->Page_Terminate();
?>
