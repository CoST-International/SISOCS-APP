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

$cs_calificacion_view = NULL; // Initialize page object first

class ccs_calificacion_view extends ccs_calificacion {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_calificacion';

	// Page object name
	var $PageObjName = 'cs_calificacion_view';

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
		$KeyUrl = "";
		if (@$_GET["idCalificacion"] <> "") {
			$this->RecKey["idCalificacion"] = $_GET["idCalificacion"];
			$KeyUrl .= "&amp;idCalificacion=" . urlencode($this->RecKey["idCalificacion"]);
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

		// Table object (cs_proyecto)
		if (!isset($GLOBALS['cs_proyecto'])) $GLOBALS['cs_proyecto'] = new ccs_proyecto();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
			if (@$_GET["idCalificacion"] <> "") {
				$this->idCalificacion->setQueryStringValue($_GET["idCalificacion"]);
				$this->RecKey["idCalificacion"] = $this->idCalificacion->QueryStringValue;
			} elseif (@$_POST["idCalificacion"] <> "") {
				$this->idCalificacion->setFormValue($_POST["idCalificacion"]);
				$this->RecKey["idCalificacion"] = $this->idCalificacion->FormValue;
			} else {
				$sReturnUrl = "cs_calificacionlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_calificacionlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_calificacionlist.php"; // Not page request, return to list
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

		// "detail_cs_adjudicacion"
		$item = &$option->Add("detail_cs_adjudicacion");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("cs_adjudicacion", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_adjudicacionlist.php?" . EW_TABLE_SHOW_MASTER . "=cs_calificacion&fk_idCalificacion=" . urlencode(strval($this->idCalificacion->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["cs_adjudicacion_grid"] && $GLOBALS["cs_adjudicacion_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_adjudicacion')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_adjudicacion")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "cs_adjudicacion";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_adjudicacion');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "cs_adjudicacion";
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

		// nomprocesoproyecto
		$this->nomprocesoproyecto->ViewValue = $this->nomprocesoproyecto->CurrentValue;
		$this->nomprocesoproyecto->ViewCustomAttributes = "";

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

			// nomprocesoproyecto
			$this->nomprocesoproyecto->LinkCustomAttributes = "";
			$this->nomprocesoproyecto->HrefValue = "";
			$this->nomprocesoproyecto->TooltipValue = "";

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
			$this->setSessionWhere($this->GetDetailFilter());

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
			if (in_array("cs_adjudicacion", $DetailTblVar)) {
				if (!isset($GLOBALS["cs_adjudicacion_grid"]))
					$GLOBALS["cs_adjudicacion_grid"] = new ccs_adjudicacion_grid;
				if ($GLOBALS["cs_adjudicacion_grid"]->DetailView) {
					$GLOBALS["cs_adjudicacion_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["cs_adjudicacion_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cs_adjudicacion_grid"]->setStartRecordNumber(1);
					$GLOBALS["cs_adjudicacion_grid"]->idCalificacion->FldIsDetailKey = TRUE;
					$GLOBALS["cs_adjudicacion_grid"]->idCalificacion->CurrentValue = $this->idCalificacion->CurrentValue;
					$GLOBALS["cs_adjudicacion_grid"]->idCalificacion->setSessionValue($GLOBALS["cs_adjudicacion_grid"]->idCalificacion->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_calificacionlist.php", "", $this->TableVar, TRUE);
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
if (!isset($cs_calificacion_view)) $cs_calificacion_view = new ccs_calificacion_view();

// Page init
$cs_calificacion_view->Page_Init();

// Page main
$cs_calificacion_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_calificacion_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_calificacionview = new ew_Form("fcs_calificacionview", "view");

// Form_CustomValidate event
fcs_calificacionview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_calificacionview.ValidateRequired = true;
<?php } else { ?>
fcs_calificacionview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_calificacion_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_calificacion_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_calificacion_view->ShowPageHeader(); ?>
<?php
$cs_calificacion_view->ShowMessage();
?>
<form name="fcs_calificacionview" id="fcs_calificacionview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_calificacion_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_calificacion_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_calificacion">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_calificacion->idCalificacion->Visible) { // idCalificacion ?>
	<tr id="r_idCalificacion">
		<td><span id="elh_cs_calificacion_idCalificacion"><?php echo $cs_calificacion->idCalificacion->FldCaption() ?></span></td>
		<td data-name="idCalificacion"<?php echo $cs_calificacion->idCalificacion->CellAttributes() ?>>
<span id="el_cs_calificacion_idCalificacion">
<span<?php echo $cs_calificacion->idCalificacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->idCalificacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->idProyecto->Visible) { // idProyecto ?>
	<tr id="r_idProyecto">
		<td><span id="elh_cs_calificacion_idProyecto"><?php echo $cs_calificacion->idProyecto->FldCaption() ?></span></td>
		<td data-name="idProyecto"<?php echo $cs_calificacion->idProyecto->CellAttributes() ?>>
<span id="el_cs_calificacion_idProyecto">
<span<?php echo $cs_calificacion->idProyecto->ViewAttributes() ?>>
<?php echo $cs_calificacion->idProyecto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->numproceso->Visible) { // numproceso ?>
	<tr id="r_numproceso">
		<td><span id="elh_cs_calificacion_numproceso"><?php echo $cs_calificacion->numproceso->FldCaption() ?></span></td>
		<td data-name="numproceso"<?php echo $cs_calificacion->numproceso->CellAttributes() ?>>
<span id="el_cs_calificacion_numproceso">
<span<?php echo $cs_calificacion->numproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->numproceso->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->nomprocesoproyecto->Visible) { // nomprocesoproyecto ?>
	<tr id="r_nomprocesoproyecto">
		<td><span id="elh_cs_calificacion_nomprocesoproyecto"><?php echo $cs_calificacion->nomprocesoproyecto->FldCaption() ?></span></td>
		<td data-name="nomprocesoproyecto"<?php echo $cs_calificacion->nomprocesoproyecto->CellAttributes() ?>>
<span id="el_cs_calificacion_nomprocesoproyecto">
<span<?php echo $cs_calificacion->nomprocesoproyecto->ViewAttributes() ?>>
<?php echo $cs_calificacion->nomprocesoproyecto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->fechactualizacion->Visible) { // fechactualizacion ?>
	<tr id="r_fechactualizacion">
		<td><span id="elh_cs_calificacion_fechactualizacion"><?php echo $cs_calificacion->fechactualizacion->FldCaption() ?></span></td>
		<td data-name="fechactualizacion"<?php echo $cs_calificacion->fechactualizacion->CellAttributes() ?>>
<span id="el_cs_calificacion_fechactualizacion">
<span<?php echo $cs_calificacion->fechactualizacion->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechactualizacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->idFuncionario->Visible) { // idFuncionario ?>
	<tr id="r_idFuncionario">
		<td><span id="elh_cs_calificacion_idFuncionario"><?php echo $cs_calificacion->idFuncionario->FldCaption() ?></span></td>
		<td data-name="idFuncionario"<?php echo $cs_calificacion->idFuncionario->CellAttributes() ?>>
<span id="el_cs_calificacion_idFuncionario">
<span<?php echo $cs_calificacion->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_calificacion->idFuncionario->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->estatusproceso->Visible) { // estatusproceso ?>
	<tr id="r_estatusproceso">
		<td><span id="elh_cs_calificacion_estatusproceso"><?php echo $cs_calificacion->estatusproceso->FldCaption() ?></span></td>
		<td data-name="estatusproceso"<?php echo $cs_calificacion->estatusproceso->CellAttributes() ?>>
<span id="el_cs_calificacion_estatusproceso">
<span<?php echo $cs_calificacion->estatusproceso->ViewAttributes() ?>>
<?php echo $cs_calificacion->estatusproceso->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->proceseval->Visible) { // proceseval ?>
	<tr id="r_proceseval">
		<td><span id="elh_cs_calificacion_proceseval"><?php echo $cs_calificacion->proceseval->FldCaption() ?></span></td>
		<td data-name="proceseval"<?php echo $cs_calificacion->proceseval->CellAttributes() ?>>
<span id="el_cs_calificacion_proceseval">
<span<?php echo $cs_calificacion->proceseval->ViewAttributes() ?>>
<?php echo $cs_calificacion->proceseval->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->invitainter->Visible) { // invitainter ?>
	<tr id="r_invitainter">
		<td><span id="elh_cs_calificacion_invitainter"><?php echo $cs_calificacion->invitainter->FldCaption() ?></span></td>
		<td data-name="invitainter"<?php echo $cs_calificacion->invitainter->CellAttributes() ?>>
<span id="el_cs_calificacion_invitainter">
<span<?php echo $cs_calificacion->invitainter->ViewAttributes() ?>>
<?php echo $cs_calificacion->invitainter->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->basespreca->Visible) { // basespreca ?>
	<tr id="r_basespreca">
		<td><span id="elh_cs_calificacion_basespreca"><?php echo $cs_calificacion->basespreca->FldCaption() ?></span></td>
		<td data-name="basespreca"<?php echo $cs_calificacion->basespreca->CellAttributes() ?>>
<span id="el_cs_calificacion_basespreca">
<span<?php echo $cs_calificacion->basespreca->ViewAttributes() ?>>
<?php echo $cs_calificacion->basespreca->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->resolucion->Visible) { // resolucion ?>
	<tr id="r_resolucion">
		<td><span id="elh_cs_calificacion_resolucion"><?php echo $cs_calificacion->resolucion->FldCaption() ?></span></td>
		<td data-name="resolucion"<?php echo $cs_calificacion->resolucion->CellAttributes() ?>>
<span id="el_cs_calificacion_resolucion">
<span<?php echo $cs_calificacion->resolucion->ViewAttributes() ?>>
<?php echo $cs_calificacion->resolucion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->nombreante->Visible) { // nombreante ?>
	<tr id="r_nombreante">
		<td><span id="elh_cs_calificacion_nombreante"><?php echo $cs_calificacion->nombreante->FldCaption() ?></span></td>
		<td data-name="nombreante"<?php echo $cs_calificacion->nombreante->CellAttributes() ?>>
<span id="el_cs_calificacion_nombreante">
<span<?php echo $cs_calificacion->nombreante->ViewAttributes() ?>>
<?php echo $cs_calificacion->nombreante->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->convocainvi->Visible) { // convocainvi ?>
	<tr id="r_convocainvi">
		<td><span id="elh_cs_calificacion_convocainvi"><?php echo $cs_calificacion->convocainvi->FldCaption() ?></span></td>
		<td data-name="convocainvi"<?php echo $cs_calificacion->convocainvi->CellAttributes() ?>>
<span id="el_cs_calificacion_convocainvi">
<span<?php echo $cs_calificacion->convocainvi->ViewAttributes() ?>>
<?php echo $cs_calificacion->convocainvi->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->tdr->Visible) { // tdr ?>
	<tr id="r_tdr">
		<td><span id="elh_cs_calificacion_tdr"><?php echo $cs_calificacion->tdr->FldCaption() ?></span></td>
		<td data-name="tdr"<?php echo $cs_calificacion->tdr->CellAttributes() ?>>
<span id="el_cs_calificacion_tdr">
<span<?php echo $cs_calificacion->tdr->ViewAttributes() ?>>
<?php echo $cs_calificacion->tdr->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->aclaraciones->Visible) { // aclaraciones ?>
	<tr id="r_aclaraciones">
		<td><span id="elh_cs_calificacion_aclaraciones"><?php echo $cs_calificacion->aclaraciones->FldCaption() ?></span></td>
		<td data-name="aclaraciones"<?php echo $cs_calificacion->aclaraciones->CellAttributes() ?>>
<span id="el_cs_calificacion_aclaraciones">
<span<?php echo $cs_calificacion->aclaraciones->ViewAttributes() ?>>
<?php echo $cs_calificacion->aclaraciones->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->actarecpcion->Visible) { // actarecpcion ?>
	<tr id="r_actarecpcion">
		<td><span id="elh_cs_calificacion_actarecpcion"><?php echo $cs_calificacion->actarecpcion->FldCaption() ?></span></td>
		<td data-name="actarecpcion"<?php echo $cs_calificacion->actarecpcion->CellAttributes() ?>>
<span id="el_cs_calificacion_actarecpcion">
<span<?php echo $cs_calificacion->actarecpcion->ViewAttributes() ?>>
<?php echo $cs_calificacion->actarecpcion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->fechaingreso->Visible) { // fechaingreso ?>
	<tr id="r_fechaingreso">
		<td><span id="elh_cs_calificacion_fechaingreso"><?php echo $cs_calificacion->fechaingreso->FldCaption() ?></span></td>
		<td data-name="fechaingreso"<?php echo $cs_calificacion->fechaingreso->CellAttributes() ?>>
<span id="el_cs_calificacion_fechaingreso">
<span<?php echo $cs_calificacion->fechaingreso->ViewAttributes() ?>>
<?php echo $cs_calificacion->fechaingreso->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->tipocontrato->Visible) { // tipocontrato ?>
	<tr id="r_tipocontrato">
		<td><span id="elh_cs_calificacion_tipocontrato"><?php echo $cs_calificacion->tipocontrato->FldCaption() ?></span></td>
		<td data-name="tipocontrato"<?php echo $cs_calificacion->tipocontrato->CellAttributes() ?>>
<span id="el_cs_calificacion_tipocontrato">
<span<?php echo $cs_calificacion->tipocontrato->ViewAttributes() ?>>
<?php echo $cs_calificacion->tipocontrato->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td><span id="elh_cs_calificacion_estado"><?php echo $cs_calificacion->estado->FldCaption() ?></span></td>
		<td data-name="estado"<?php echo $cs_calificacion->estado->CellAttributes() ?>>
<span id="el_cs_calificacion_estado">
<span<?php echo $cs_calificacion->estado->ViewAttributes() ?>>
<?php echo $cs_calificacion->estado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->otro1->Visible) { // otro1 ?>
	<tr id="r_otro1">
		<td><span id="elh_cs_calificacion_otro1"><?php echo $cs_calificacion->otro1->FldCaption() ?></span></td>
		<td data-name="otro1"<?php echo $cs_calificacion->otro1->CellAttributes() ?>>
<span id="el_cs_calificacion_otro1">
<span<?php echo $cs_calificacion->otro1->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->otro2->Visible) { // otro2 ?>
	<tr id="r_otro2">
		<td><span id="elh_cs_calificacion_otro2"><?php echo $cs_calificacion->otro2->FldCaption() ?></span></td>
		<td data-name="otro2"<?php echo $cs_calificacion->otro2->CellAttributes() ?>>
<span id="el_cs_calificacion_otro2">
<span<?php echo $cs_calificacion->otro2->ViewAttributes() ?>>
<?php echo $cs_calificacion->otro2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->identidadadquisicion->Visible) { // identidadadquisicion ?>
	<tr id="r_identidadadquisicion">
		<td><span id="elh_cs_calificacion_identidadadquisicion"><?php echo $cs_calificacion->identidadadquisicion->FldCaption() ?></span></td>
		<td data-name="identidadadquisicion"<?php echo $cs_calificacion->identidadadquisicion->CellAttributes() ?>>
<span id="el_cs_calificacion_identidadadquisicion">
<span<?php echo $cs_calificacion->identidadadquisicion->ViewAttributes() ?>>
<?php echo $cs_calificacion->identidadadquisicion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->idmetodo->Visible) { // idmetodo ?>
	<tr id="r_idmetodo">
		<td><span id="elh_cs_calificacion_idmetodo"><?php echo $cs_calificacion->idmetodo->FldCaption() ?></span></td>
		<td data-name="idmetodo"<?php echo $cs_calificacion->idmetodo->CellAttributes() ?>>
<span id="el_cs_calificacion_idmetodo">
<span<?php echo $cs_calificacion->idmetodo->ViewAttributes() ?>>
<?php echo $cs_calificacion->idmetodo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_calificacion->fecharecibido->Visible) { // fecharecibido ?>
	<tr id="r_fecharecibido">
		<td><span id="elh_cs_calificacion_fecharecibido"><?php echo $cs_calificacion->fecharecibido->FldCaption() ?></span></td>
		<td data-name="fecharecibido"<?php echo $cs_calificacion->fecharecibido->CellAttributes() ?>>
<span id="el_cs_calificacion_fecharecibido">
<span<?php echo $cs_calificacion->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_calificacion->fecharecibido->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cs_adjudicacion", explode(",", $cs_calificacion->getCurrentDetailTable())) && $cs_adjudicacion->DetailView) {
?>
<?php if ($cs_calificacion->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("cs_adjudicacion", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cs_adjudicaciongrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
fcs_calificacionview.Init();
</script>
<?php
$cs_calificacion_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_calificacion_view->Page_Terminate();
?>
