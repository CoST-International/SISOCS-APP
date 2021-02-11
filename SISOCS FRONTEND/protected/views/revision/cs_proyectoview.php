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

$cs_proyecto_view = NULL; // Initialize page object first

class ccs_proyecto_view extends ccs_proyecto {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{95DDD5E1-EED3-4F75-9459-65662A38CD3B}";

	// Table name
	var $TableName = 'cs_proyecto';

	// Page object name
	var $PageObjName = 'cs_proyecto_view';

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
		$KeyUrl = "";
		if (@$_GET["idProyecto"] <> "") {
			$this->RecKey["idProyecto"] = $_GET["idProyecto"];
			$KeyUrl .= "&amp;idProyecto=" . urlencode($this->RecKey["idProyecto"]);
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

		// Table object (cs_programa)
		if (!isset($GLOBALS['cs_programa'])) $GLOBALS['cs_programa'] = new ccs_programa();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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
			if (@$_GET["idProyecto"] <> "") {
				$this->idProyecto->setQueryStringValue($_GET["idProyecto"]);
				$this->RecKey["idProyecto"] = $this->idProyecto->QueryStringValue;
			} elseif (@$_POST["idProyecto"] <> "") {
				$this->idProyecto->setFormValue($_POST["idProyecto"]);
				$this->RecKey["idProyecto"] = $this->idProyecto->FormValue;
			} else {
				$sReturnUrl = "cs_proyectolist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "cs_proyectolist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "cs_proyectolist.php"; // Not page request, return to list
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

		// "detail_cs_calificacion"
		$item = &$option->Add("detail_cs_calificacion");
		$body = $Language->Phrase("ViewPageDetailLink") . $Language->TablePhrase("cs_calificacion", "TblCaption");
		$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("cs_calificacionlist.php?" . EW_TABLE_SHOW_MASTER . "=cs_proyecto&fk_idProyecto=" . urlencode(strval($this->idProyecto->CurrentValue)) . "") . "\">" . $body . "</a>";
		$links = "";
		if ($GLOBALS["cs_calificacion_grid"] && $GLOBALS["cs_calificacion_grid"]->DetailView && $Security->CanView() && $Security->AllowView(CurrentProjectID() . 'cs_calificacion')) {
			$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=cs_calificacion")) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			if ($DetailViewTblVar <> "") $DetailViewTblVar .= ",";
			$DetailViewTblVar .= "cs_calificacion";
		}
		if ($links <> "") {
			$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
			$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
		}
		$body = "<div class=\"btn-group\">" . $body . "</div>";
		$item->Body = $body;
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'cs_calificacion');
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "cs_calificacion";
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

		// nombre_proyecto
		$this->nombre_proyecto->ViewValue = $this->nombre_proyecto->CurrentValue;
		$this->nombre_proyecto->ViewCustomAttributes = "";

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

		// descrip
		$this->descrip->ViewValue = $this->descrip->CurrentValue;
		$this->descrip->ViewCustomAttributes = "";

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

			// nombre_proyecto
			$this->nombre_proyecto->LinkCustomAttributes = "";
			$this->nombre_proyecto->HrefValue = "";
			$this->nombre_proyecto->TooltipValue = "";

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

			// descrip
			$this->descrip->LinkCustomAttributes = "";
			$this->descrip->HrefValue = "";
			$this->descrip->TooltipValue = "";

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
			$this->setSessionWhere($this->GetDetailFilter());

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
			if (in_array("cs_calificacion", $DetailTblVar)) {
				if (!isset($GLOBALS["cs_calificacion_grid"]))
					$GLOBALS["cs_calificacion_grid"] = new ccs_calificacion_grid;
				if ($GLOBALS["cs_calificacion_grid"]->DetailView) {
					$GLOBALS["cs_calificacion_grid"]->CurrentMode = "view";

					// Save current master table to detail table
					$GLOBALS["cs_calificacion_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["cs_calificacion_grid"]->setStartRecordNumber(1);
					$GLOBALS["cs_calificacion_grid"]->idProyecto->FldIsDetailKey = TRUE;
					$GLOBALS["cs_calificacion_grid"]->idProyecto->CurrentValue = $this->idProyecto->CurrentValue;
					$GLOBALS["cs_calificacion_grid"]->idProyecto->setSessionValue($GLOBALS["cs_calificacion_grid"]->idProyecto->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, "cs_proyectolist.php", "", $this->TableVar, TRUE);
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
if (!isset($cs_proyecto_view)) $cs_proyecto_view = new ccs_proyecto_view();

// Page init
$cs_proyecto_view->Page_Init();

// Page main
$cs_proyecto_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cs_proyecto_view->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fcs_proyectoview = new ew_Form("fcs_proyectoview", "view");

// Form_CustomValidate event
fcs_proyectoview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fcs_proyectoview.ValidateRequired = true;
<?php } else { ?>
fcs_proyectoview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php $cs_proyecto_view->ExportOptions->Render("body") ?>
<?php
	foreach ($cs_proyecto_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $cs_proyecto_view->ShowPageHeader(); ?>
<?php
$cs_proyecto_view->ShowMessage();
?>
<form name="fcs_proyectoview" id="fcs_proyectoview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($cs_proyecto_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $cs_proyecto_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cs_proyecto">
<table class="table table-bordered table-striped ewViewTable">
<?php if ($cs_proyecto->idProyecto->Visible) { // idProyecto ?>
	<tr id="r_idProyecto">
		<td><span id="elh_cs_proyecto_idProyecto"><?php echo $cs_proyecto->idProyecto->FldCaption() ?></span></td>
		<td data-name="idProyecto"<?php echo $cs_proyecto->idProyecto->CellAttributes() ?>>
<span id="el_cs_proyecto_idProyecto">
<span<?php echo $cs_proyecto->idProyecto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProyecto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idPrograma->Visible) { // idPrograma ?>
	<tr id="r_idPrograma">
		<td><span id="elh_cs_proyecto_idPrograma"><?php echo $cs_proyecto->idPrograma->FldCaption() ?></span></td>
		<td data-name="idPrograma"<?php echo $cs_proyecto->idPrograma->CellAttributes() ?>>
<span id="el_cs_proyecto_idPrograma">
<span<?php echo $cs_proyecto->idPrograma->ViewAttributes() ?>>
<?php echo $cs_proyecto->idPrograma->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->codigo->Visible) { // codigo ?>
	<tr id="r_codigo">
		<td><span id="elh_cs_proyecto_codigo"><?php echo $cs_proyecto->codigo->FldCaption() ?></span></td>
		<td data-name="codigo"<?php echo $cs_proyecto->codigo->CellAttributes() ?>>
<span id="el_cs_proyecto_codigo">
<span<?php echo $cs_proyecto->codigo->ViewAttributes() ?>>
<?php echo $cs_proyecto->codigo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->nombre_proyecto->Visible) { // nombre_proyecto ?>
	<tr id="r_nombre_proyecto">
		<td><span id="elh_cs_proyecto_nombre_proyecto"><?php echo $cs_proyecto->nombre_proyecto->FldCaption() ?></span></td>
		<td data-name="nombre_proyecto"<?php echo $cs_proyecto->nombre_proyecto->CellAttributes() ?>>
<span id="el_cs_proyecto_nombre_proyecto">
<span<?php echo $cs_proyecto->nombre_proyecto->ViewAttributes() ?>>
<?php echo $cs_proyecto->nombre_proyecto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idUbicacion->Visible) { // idUbicacion ?>
	<tr id="r_idUbicacion">
		<td><span id="elh_cs_proyecto_idUbicacion"><?php echo $cs_proyecto->idUbicacion->FldCaption() ?></span></td>
		<td data-name="idUbicacion"<?php echo $cs_proyecto->idUbicacion->CellAttributes() ?>>
<span id="el_cs_proyecto_idUbicacion">
<span<?php echo $cs_proyecto->idUbicacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idUbicacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idRegion->Visible) { // idRegion ?>
	<tr id="r_idRegion">
		<td><span id="elh_cs_proyecto_idRegion"><?php echo $cs_proyecto->idRegion->FldCaption() ?></span></td>
		<td data-name="idRegion"<?php echo $cs_proyecto->idRegion->CellAttributes() ?>>
<span id="el_cs_proyecto_idRegion">
<span<?php echo $cs_proyecto->idRegion->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRegion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idDepto->Visible) { // idDepto ?>
	<tr id="r_idDepto">
		<td><span id="elh_cs_proyecto_idDepto"><?php echo $cs_proyecto->idDepto->FldCaption() ?></span></td>
		<td data-name="idDepto"<?php echo $cs_proyecto->idDepto->CellAttributes() ?>>
<span id="el_cs_proyecto_idDepto">
<span<?php echo $cs_proyecto->idDepto->ViewAttributes() ?>>
<?php echo $cs_proyecto->idDepto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idTramo->Visible) { // idTramo ?>
	<tr id="r_idTramo">
		<td><span id="elh_cs_proyecto_idTramo"><?php echo $cs_proyecto->idTramo->FldCaption() ?></span></td>
		<td data-name="idTramo"<?php echo $cs_proyecto->idTramo->CellAttributes() ?>>
<span id="el_cs_proyecto_idTramo">
<span<?php echo $cs_proyecto->idTramo->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTramo->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idRuta->Visible) { // idRuta ?>
	<tr id="r_idRuta">
		<td><span id="elh_cs_proyecto_idRuta"><?php echo $cs_proyecto->idRuta->FldCaption() ?></span></td>
		<td data-name="idRuta"<?php echo $cs_proyecto->idRuta->CellAttributes() ?>>
<span id="el_cs_proyecto_idRuta">
<span<?php echo $cs_proyecto->idRuta->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRuta->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idTipoRed->Visible) { // idTipoRed ?>
	<tr id="r_idTipoRed">
		<td><span id="elh_cs_proyecto_idTipoRed"><?php echo $cs_proyecto->idTipoRed->FldCaption() ?></span></td>
		<td data-name="idTipoRed"<?php echo $cs_proyecto->idTipoRed->CellAttributes() ?>>
<span id="el_cs_proyecto_idTipoRed">
<span<?php echo $cs_proyecto->idTipoRed->ViewAttributes() ?>>
<?php echo $cs_proyecto->idTipoRed->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idProposito->Visible) { // idProposito ?>
	<tr id="r_idProposito">
		<td><span id="elh_cs_proyecto_idProposito"><?php echo $cs_proyecto->idProposito->FldCaption() ?></span></td>
		<td data-name="idProposito"<?php echo $cs_proyecto->idProposito->CellAttributes() ?>>
<span id="el_cs_proyecto_idProposito">
<span<?php echo $cs_proyecto->idProposito->ViewAttributes() ?>>
<?php echo $cs_proyecto->idProposito->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->descrip->Visible) { // descrip ?>
	<tr id="r_descrip">
		<td><span id="elh_cs_proyecto_descrip"><?php echo $cs_proyecto->descrip->FldCaption() ?></span></td>
		<td data-name="descrip"<?php echo $cs_proyecto->descrip->CellAttributes() ?>>
<span id="el_cs_proyecto_descrip">
<span<?php echo $cs_proyecto->descrip->ViewAttributes() ?>>
<?php echo $cs_proyecto->descrip->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->presupuesto->Visible) { // presupuesto ?>
	<tr id="r_presupuesto">
		<td><span id="elh_cs_proyecto_presupuesto"><?php echo $cs_proyecto->presupuesto->FldCaption() ?></span></td>
		<td data-name="presupuesto"<?php echo $cs_proyecto->presupuesto->CellAttributes() ?>>
<span id="el_cs_proyecto_presupuesto">
<span<?php echo $cs_proyecto->presupuesto->ViewAttributes() ?>>
<?php echo $cs_proyecto->presupuesto->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->especiplano->Visible) { // especiplano ?>
	<tr id="r_especiplano">
		<td><span id="elh_cs_proyecto_especiplano"><?php echo $cs_proyecto->especiplano->FldCaption() ?></span></td>
		<td data-name="especiplano"<?php echo $cs_proyecto->especiplano->CellAttributes() ?>>
<span id="el_cs_proyecto_especiplano">
<span<?php echo $cs_proyecto->especiplano->ViewAttributes() ?>>
<?php echo $cs_proyecto->especiplano->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->presuprogra->Visible) { // presuprogra ?>
	<tr id="r_presuprogra">
		<td><span id="elh_cs_proyecto_presuprogra"><?php echo $cs_proyecto->presuprogra->FldCaption() ?></span></td>
		<td data-name="presuprogra"<?php echo $cs_proyecto->presuprogra->CellAttributes() ?>>
<span id="el_cs_proyecto_presuprogra">
<span<?php echo $cs_proyecto->presuprogra->ViewAttributes() ?>>
<?php echo $cs_proyecto->presuprogra->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->estudiofact->Visible) { // estudiofact ?>
	<tr id="r_estudiofact">
		<td><span id="elh_cs_proyecto_estudiofact"><?php echo $cs_proyecto->estudiofact->FldCaption() ?></span></td>
		<td data-name="estudiofact"<?php echo $cs_proyecto->estudiofact->CellAttributes() ?>>
<span id="el_cs_proyecto_estudiofact">
<span<?php echo $cs_proyecto->estudiofact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudiofact->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->estudioimpact->Visible) { // estudioimpact ?>
	<tr id="r_estudioimpact">
		<td><span id="elh_cs_proyecto_estudioimpact"><?php echo $cs_proyecto->estudioimpact->FldCaption() ?></span></td>
		<td data-name="estudioimpact"<?php echo $cs_proyecto->estudioimpact->CellAttributes() ?>>
<span id="el_cs_proyecto_estudioimpact">
<span<?php echo $cs_proyecto->estudioimpact->ViewAttributes() ?>>
<?php echo $cs_proyecto->estudioimpact->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->licambi->Visible) { // licambi ?>
	<tr id="r_licambi">
		<td><span id="elh_cs_proyecto_licambi"><?php echo $cs_proyecto->licambi->FldCaption() ?></span></td>
		<td data-name="licambi"<?php echo $cs_proyecto->licambi->CellAttributes() ?>>
<span id="el_cs_proyecto_licambi">
<span<?php echo $cs_proyecto->licambi->ViewAttributes() ?>>
<?php echo $cs_proyecto->licambi->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->estuimpactierra->Visible) { // estuimpactierra ?>
	<tr id="r_estuimpactierra">
		<td><span id="elh_cs_proyecto_estuimpactierra"><?php echo $cs_proyecto->estuimpactierra->FldCaption() ?></span></td>
		<td data-name="estuimpactierra"<?php echo $cs_proyecto->estuimpactierra->CellAttributes() ?>>
<span id="el_cs_proyecto_estuimpactierra">
<span<?php echo $cs_proyecto->estuimpactierra->ViewAttributes() ?>>
<?php echo $cs_proyecto->estuimpactierra->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->planreasea->Visible) { // planreasea ?>
	<tr id="r_planreasea">
		<td><span id="elh_cs_proyecto_planreasea"><?php echo $cs_proyecto->planreasea->FldCaption() ?></span></td>
		<td data-name="planreasea"<?php echo $cs_proyecto->planreasea->CellAttributes() ?>>
<span id="el_cs_proyecto_planreasea">
<span<?php echo $cs_proyecto->planreasea->ViewAttributes() ?>>
<?php echo $cs_proyecto->planreasea->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->plananual->Visible) { // plananual ?>
	<tr id="r_plananual">
		<td><span id="elh_cs_proyecto_plananual"><?php echo $cs_proyecto->plananual->FldCaption() ?></span></td>
		<td data-name="plananual"<?php echo $cs_proyecto->plananual->CellAttributes() ?>>
<span id="el_cs_proyecto_plananual">
<span<?php echo $cs_proyecto->plananual->ViewAttributes() ?>>
<?php echo $cs_proyecto->plananual->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->acuerdofinan->Visible) { // acuerdofinan ?>
	<tr id="r_acuerdofinan">
		<td><span id="elh_cs_proyecto_acuerdofinan"><?php echo $cs_proyecto->acuerdofinan->FldCaption() ?></span></td>
		<td data-name="acuerdofinan"<?php echo $cs_proyecto->acuerdofinan->CellAttributes() ?>>
<span id="el_cs_proyecto_acuerdofinan">
<span<?php echo $cs_proyecto->acuerdofinan->ViewAttributes() ?>>
<?php echo $cs_proyecto->acuerdofinan->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->otro->Visible) { // otro ?>
	<tr id="r_otro">
		<td><span id="elh_cs_proyecto_otro"><?php echo $cs_proyecto->otro->FldCaption() ?></span></td>
		<td data-name="otro"<?php echo $cs_proyecto->otro->CellAttributes() ?>>
<span id="el_cs_proyecto_otro">
<span<?php echo $cs_proyecto->otro->ViewAttributes() ?>>
<?php echo $cs_proyecto->otro->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->fechacreacion->Visible) { // fechacreacion ?>
	<tr id="r_fechacreacion">
		<td><span id="elh_cs_proyecto_fechacreacion"><?php echo $cs_proyecto->fechacreacion->FldCaption() ?></span></td>
		<td data-name="fechacreacion"<?php echo $cs_proyecto->fechacreacion->CellAttributes() ?>>
<span id="el_cs_proyecto_fechacreacion">
<span<?php echo $cs_proyecto->fechacreacion->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechacreacion->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td><span id="elh_cs_proyecto_estado"><?php echo $cs_proyecto->estado->FldCaption() ?></span></td>
		<td data-name="estado"<?php echo $cs_proyecto->estado->CellAttributes() ?>>
<span id="el_cs_proyecto_estado">
<span<?php echo $cs_proyecto->estado->ViewAttributes() ?>>
<?php echo $cs_proyecto->estado->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idFuncionario->Visible) { // idFuncionario ?>
	<tr id="r_idFuncionario">
		<td><span id="elh_cs_proyecto_idFuncionario"><?php echo $cs_proyecto->idFuncionario->FldCaption() ?></span></td>
		<td data-name="idFuncionario"<?php echo $cs_proyecto->idFuncionario->CellAttributes() ?>>
<span id="el_cs_proyecto_idFuncionario">
<span<?php echo $cs_proyecto->idFuncionario->ViewAttributes() ?>>
<?php echo $cs_proyecto->idFuncionario->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->fechaaprob->Visible) { // fechaaprob ?>
	<tr id="r_fechaaprob">
		<td><span id="elh_cs_proyecto_fechaaprob"><?php echo $cs_proyecto->fechaaprob->FldCaption() ?></span></td>
		<td data-name="fechaaprob"<?php echo $cs_proyecto->fechaaprob->CellAttributes() ?>>
<span id="el_cs_proyecto_fechaaprob">
<span<?php echo $cs_proyecto->fechaaprob->ViewAttributes() ?>>
<?php echo $cs_proyecto->fechaaprob->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idfuente->Visible) { // idfuente ?>
	<tr id="r_idfuente">
		<td><span id="elh_cs_proyecto_idfuente"><?php echo $cs_proyecto->idfuente->FldCaption() ?></span></td>
		<td data-name="idfuente"<?php echo $cs_proyecto->idfuente->CellAttributes() ?>>
<span id="el_cs_proyecto_idfuente">
<span<?php echo $cs_proyecto->idfuente->ViewAttributes() ?>>
<?php echo $cs_proyecto->idfuente->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->codsefin->Visible) { // codsefin ?>
	<tr id="r_codsefin">
		<td><span id="elh_cs_proyecto_codsefin"><?php echo $cs_proyecto->codsefin->FldCaption() ?></span></td>
		<td data-name="codsefin"<?php echo $cs_proyecto->codsefin->CellAttributes() ?>>
<span id="el_cs_proyecto_codsefin">
<span<?php echo $cs_proyecto->codsefin->ViewAttributes() ?>>
<?php echo $cs_proyecto->codsefin->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->notaprioridad->Visible) { // notaprioridad ?>
	<tr id="r_notaprioridad">
		<td><span id="elh_cs_proyecto_notaprioridad"><?php echo $cs_proyecto->notaprioridad->FldCaption() ?></span></td>
		<td data-name="notaprioridad"<?php echo $cs_proyecto->notaprioridad->CellAttributes() ?>>
<span id="el_cs_proyecto_notaprioridad">
<span<?php echo $cs_proyecto->notaprioridad->ViewAttributes() ?>>
<?php echo $cs_proyecto->notaprioridad->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->constanciabanco->Visible) { // constanciabanco ?>
	<tr id="r_constanciabanco">
		<td><span id="elh_cs_proyecto_constanciabanco"><?php echo $cs_proyecto->constanciabanco->FldCaption() ?></span></td>
		<td data-name="constanciabanco"<?php echo $cs_proyecto->constanciabanco->CellAttributes() ?>>
<span id="el_cs_proyecto_constanciabanco">
<span<?php echo $cs_proyecto->constanciabanco->ViewAttributes() ?>>
<?php echo $cs_proyecto->constanciabanco->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->fecharecibido->Visible) { // fecharecibido ?>
	<tr id="r_fecharecibido">
		<td><span id="elh_cs_proyecto_fecharecibido"><?php echo $cs_proyecto->fecharecibido->FldCaption() ?></span></td>
		<td data-name="fecharecibido"<?php echo $cs_proyecto->fecharecibido->CellAttributes() ?>>
<span id="el_cs_proyecto_fecharecibido">
<span<?php echo $cs_proyecto->fecharecibido->ViewAttributes() ?>>
<?php echo $cs_proyecto->fecharecibido->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->clase->Visible) { // clase ?>
	<tr id="r_clase">
		<td><span id="elh_cs_proyecto_clase"><?php echo $cs_proyecto->clase->FldCaption() ?></span></td>
		<td data-name="clase"<?php echo $cs_proyecto->clase->CellAttributes() ?>>
<span id="el_cs_proyecto_clase">
<span<?php echo $cs_proyecto->clase->ViewAttributes() ?>>
<?php echo $cs_proyecto->clase->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->entes->Visible) { // entes ?>
	<tr id="r_entes">
		<td><span id="elh_cs_proyecto_entes"><?php echo $cs_proyecto->entes->FldCaption() ?></span></td>
		<td data-name="entes"<?php echo $cs_proyecto->entes->CellAttributes() ?>>
<span id="el_cs_proyecto_entes">
<span<?php echo $cs_proyecto->entes->ViewAttributes() ?>>
<?php echo $cs_proyecto->entes->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cs_proyecto->idRol->Visible) { // idRol ?>
	<tr id="r_idRol">
		<td><span id="elh_cs_proyecto_idRol"><?php echo $cs_proyecto->idRol->FldCaption() ?></span></td>
		<td data-name="idRol"<?php echo $cs_proyecto->idRol->CellAttributes() ?>>
<span id="el_cs_proyecto_idRol">
<span<?php echo $cs_proyecto->idRol->ViewAttributes() ?>>
<?php echo $cs_proyecto->idRol->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("cs_calificacion", explode(",", $cs_proyecto->getCurrentDetailTable())) && $cs_calificacion->DetailView) {
?>
<?php if ($cs_proyecto->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("cs_calificacion", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "cs_calificaciongrid.php" ?>
<?php } ?>
</form>
<script type="text/javascript">
fcs_proyectoview.Init();
</script>
<?php
$cs_proyecto_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cs_proyecto_view->Page_Terminate();
?>
