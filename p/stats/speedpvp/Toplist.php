<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "Topinfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$Top_list = NULL; // Initialize page object first

class cTop_list extends cTop {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{AA815AAB-3B1C-42A2-995A-8F483332E9FF}";

	// Table name
	var $TableName = 'Top';

	// Page object name
	var $PageObjName = 'Top_list';

	// Grid form hidden field names
	var $FormName = 'fToplist';
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
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sMessage . "</div>";
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
			$html .= "<div class=\"alert alert-error ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<table class=\"ewStdTable\"><tr><td><div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div></td></tr></table>";
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

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language, $UserAgent;

		// User agent
		$UserAgent = ew_UserAgent();
		$GLOBALS["Page"] = &$this;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (Top)
		if (!isset($GLOBALS["Top"])) {
			$GLOBALS["Top"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Top"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "Topadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "Topdelete.php";
		$this->MultiUpdateUrl = "Topupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Top', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "span";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "span";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "span";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up curent action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
		$this->division->Visible = !$this->IsAddOrEdit();
		$this->Points->Visible = !$this->IsAddOrEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Setup other options
		$this->SetupOtherOptions();

		// Set "checkbox" visible
		if (count($this->CustomActions) > 0)
			$this->ListOptions->Items["checkbox"]->Visible = TRUE;
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		$this->Page_Redirecting($url);

		 // Close connection
		$conn->Close();

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
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 21;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
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
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Multi Column
		$this->RecPerRow = 3;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process custom action first
			$this->ProcessCustomAction();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			$this->SetupBreadcrumb();

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

			// Hide export options
			if ($this->Export <> "" || $this->CurrentAction <> "")
				$this->ExportOptions->HideAllOptions();

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 21; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue("k_key"));
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
			$sThisKey = strval($objForm->GetValue("k_key"));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
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
			if ($this->SqlOrderBy() <> "") {
				$sOrderBy = $this->SqlOrderBy();
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

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<label class=\"checkbox\"><input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\"></label>";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		$this->ListOptions->ButtonClass = "btn-small"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<label class=\"checkbox\"><input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\"></label>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-small"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];
			foreach ($this->CustomActions as $action => $name) {

				// Add custom action
				$item = &$option->Add("custom_" . $action);
				$item->Body = "<a class=\"ewAction ewCustomAction\" href=\"\" onclick=\"ew_SubmitSelected(document.fToplist, '" . ew_CurrentUrl() . "', null, '" . $action . "');return false;\">" . $name . "</a>";
			}

			// Hide grid edit, multi-delete and multi-update
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$item = &$option->GetItem("multidelete");
				if ($item) $item->Visible = FALSE;
				$item = &$option->GetItem("multiupdate");
				if ($item) $item->Visible = FALSE;
			}
	}

	// Process custom action
	function ProcessCustomAction() {
		global $conn, $Language, $Security;
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$rsuser = ($rs) ? $rs->GetRows() : array();
			if ($rs)
				$rs->Close();

			// Call row custom action event
			if (count($rsuser) > 0) {
				$conn->BeginTrans();
				foreach ($rsuser as $row) {
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $UserAction, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $UserAction, $Language->Phrase("CustomActionCancelled")));
					}
				}
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

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn;

		// Call Recordset Selecting event
		$this->Recordset_Selecting($this->CurrentFilter);

		// Load List page SQL
		$sSql = $this->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn;
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->division->setDbValue($rs->fields('division'));
		$this->Points->setDbValue($rs->fields('Points'));
		$this->skins->setDbValue($rs->fields('skins'));
		$this->name->setDbValue($rs->fields('name'));
		$this->kills->setDbValue($rs->fields('kills'));
		$this->deaths->setDbValue($rs->fields('deaths'));

	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->division->DbValue = $row['division'];
		$this->Points->DbValue = $row['Points'];
		$this->skins->DbValue = $row['skins'];
		$this->name->DbValue = $row['name'];
		$this->kills->DbValue = $row['kills'];
		$this->deaths->DbValue = $row['deaths'];

	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language;
		global $gsLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// division
		$this->division->CellCssStyle = "white-space: nowrap;";

		// Points
		$this->Points->CellCssStyle = "white-space: nowrap;";

		// skins
		$this->skins->CellCssStyle = "white-space: nowrap;";

		// name
		$this->name->CellCssStyle = "white-space: nowrap;";

		// kills
		$this->kills->CellCssStyle = "white-space: nowrap;";

		// deaths
		$this->deaths->CellCssStyle = "white-space: nowrap;";

		// streak
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// division
			$this->division->ViewValue = $this->division->CurrentValue;
			$this->division->ViewCustomAttributes = "";

			// Points
			$this->Points->ViewValue = $this->Points->CurrentValue;
			$this->Points->CssStyle = "font-weight: bold;";
			$this->Points->ViewCustomAttributes = "";

			// skins
			$this->skins->ViewValue = $this->skins->CurrentValue;
			$this->skins->ViewCustomAttributes = "";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->ViewCustomAttributes = "";

			// kills
			$this->kills->ViewValue = $this->kills->CurrentValue;
			$this->kills->CellCssStyle .= "text-align: center;";
			$this->kills->ViewCustomAttributes = "";

			// deaths
			$this->deaths->ViewValue = $this->deaths->CurrentValue;
			$this->deaths->CellCssStyle .= "text-align: center;";
			$this->deaths->ViewCustomAttributes = "";

			// streak


			// division
			$this->division->LinkCustomAttributes = "";
			$this->division->HrefValue = "";
			$this->division->TooltipValue = "";

			// Points
			$this->Points->LinkCustomAttributes = "";
			$this->Points->HrefValue = "";
			$this->Points->TooltipValue = "";

			// skins
			$this->skins->LinkCustomAttributes = "";
			$this->skins->HrefValue = "";
			$this->skins->TooltipValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";

			// kills
			$this->kills->LinkCustomAttributes = "";
			$this->kills->HrefValue = "";
			$this->kills->TooltipValue = "";

			// deaths
			$this->deaths->LinkCustomAttributes = "";
			$this->deaths->HrefValue = "";
			$this->deaths->TooltipValue = "";

			// streak

		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$PageCaption = $this->TableCaption();
		$url = ew_CurrentUrl();
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", "" . $PageCaption . "</span>", $url, $this->TableVar);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($Top_list)) $Top_list = new cTop_list();

// Page init
$Top_list->Page_Init();

// Page main
$Top_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Top_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var Top_list = new ew_Page("Top_list");
Top_list.PageID = "list"; // Page ID
var EW_PAGE_ID = Top_list.PageID; // For backward compatibility

// Form object
var fToplist = new ew_Form("fToplist");
fToplist.FormKeyCountName = '<?php echo $Top_list->FormKeyCountName ?>';

// Form_CustomValidate event
fToplist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fToplist.ValidateRequired = true;
<?php } else { ?>
fToplist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php ?>
<?php if ($Top_list->ExportOptions->Visible()) { ?>
<div id="liste">
<div class="ewListExportOptions"><?php $Top_list->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Top_list->TotalRecs = $Top->SelectRecordCount();
	} else {
		if ($Top_list->Recordset = $Top_list->LoadRecordset())
			$Top_list->TotalRecs = $Top_list->Recordset->RecordCount();
	}
	$Top_list->StartRec = 1;
	if ($Top_list->DisplayRecs <= 0 || ($Top->Export <> "" && $Top->ExportAll)) // Display all records
		$Top_list->DisplayRecs = $Top_list->TotalRecs;
	if (!($Top->Export <> "" && $Top->ExportAll))
		$Top_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$Top_list->Recordset = $Top_list->LoadRecordset($Top_list->StartRec-1, $Top_list->DisplayRecs);
$Top_list->RenderOtherOptions();
?>
<?php $Top_list->ShowPageHeader(); ?>
<?php
$Top_list->ShowMessage();
?>
<table cellspacing="0" class="ewGrid" align="center" width="40px"><tr><td class="ewGridContent">
<div class="ewGridUpperPanel">
<?php if ($Top->CurrentAction <> "gridadd" && $Top->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($Top_list->Pager)) $Top_list->Pager = new cNumericPager($Top_list->StartRec, $Top_list->DisplayRecs, $Top_list->TotalRecs, $Top_list->RecRange) ?>
<?php if ($Top_list->Pager->RecordCount > 0) { ?>

<?php } else { ?>
	<?php if ($Top_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
<?php } ?>
</td>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($Top_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
</div>
<form name="fToplist" id="fToplist" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="Top">
<div id="gmp_Top" class="ewGridMiddlePanel">
<?php if ($Top_list->TotalRecs > 0) { ?>
<table class="ewMultiColumnTable">
<?php
if ($Top->ExportAll && $Top->Export <> "") {
	$Top_list->StopRec = $Top_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Top_list->TotalRecs > $Top_list->StartRec + $Top_list->DisplayRecs - 1)
		$Top_list->StopRec = $Top_list->StartRec + $Top_list->DisplayRecs - 1;
	else
		$Top_list->StopRec = $Top_list->TotalRecs;
}
$Top_list->RecCnt = $Top_list->StartRec - 1;
if ($Top_list->Recordset && !$Top_list->Recordset->EOF) {
	$Top_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $Top_list->StartRec > 1)
		$Top_list->Recordset->Move($Top_list->StartRec - 1);
} elseif (!$Top->AllowAddDeleteRow && $Top_list->StopRec == 0) {
	$Top_list->StopRec = $Top->GridAddRowCount;
}
while ($Top_list->RecCnt < $Top_list->StopRec) {
	$Top_list->RecCnt++;
	if (intval($Top_list->RecCnt) >= intval($Top_list->StartRec)) {
		$Top_list->RowCnt++;
		$Top_list->ColCnt++;
		if ($Top_list->ColCnt > $Top_list->RecPerRow)
			$Top_list->ColCnt = 1;

		// Set up key count
		$Top_list->KeyCount = $Top_list->RowIndex;

		// Init row class and style
		$Top->ResetAttrs();
		$Top->CssClass = "";
		if ($Top->CurrentAction == "gridadd") {
		} else {
			$Top_list->LoadRowValues($Top_list->Recordset); // Load row values
		}
		$Top->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Top->RowAttrs = array_merge($Top->RowAttrs, array('data-rowindex'=>$Top_list->RowCnt, 'id'=>'r' . $Top_list->RowCnt . '_Top', 'data-rowtype'=>$Top->RowType));

		// Render row
		$Top_list->RenderRow();

		// Render list options
		$Top_list->RenderListOptions();
?>
<?php if ($Top_list->ColCnt == 1) { ?>
<tr>
<?php } ?>
	<td valign="top"<?php echo $Top->RowAttributes() ?>>
	<table class="table table-bordered table-striped">
	<?php if ($Top->division->Visible) { // division ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_division">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->division) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->division->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->division->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->division->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->division->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->division->CellAttributes() ?>>
<span<?php echo $Top->division->ViewAttributes() ?>>
<?php echo $Top->division->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top->Points->Visible) { // Points ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Points">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->Points) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->Points->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->Points->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->Points->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->Points->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->Points->CellAttributes() ?>>
<span<?php echo $Top->Points->ViewAttributes() ?>>
<?php echo $Top->Points->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top->skins->Visible) { // skins ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_skins">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->skins) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->skins->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->skins->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->skins->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->skins->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->skins->CellAttributes() ?>>
<span<?php echo $Top->skins->ViewAttributes() ?>>
<?php echo $Top->skins->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top->name->Visible) { // name ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_name">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->name) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->name->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->name->CellAttributes() ?>>
<span<?php echo $Top->name->ViewAttributes() ?>>
<?php echo $Top->name->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top->kills->Visible) { // kills ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_kills">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->kills) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->kills->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->kills->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->kills->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->kills->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->kills->CellAttributes() ?>>
<span<?php echo $Top->kills->ViewAttributes() ?>>
<?php echo $Top->kills->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top->deaths->Visible) { // deaths ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_deaths">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->deaths) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->deaths->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->deaths->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->deaths->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->deaths->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->deaths->CellAttributes() ?>>
<span<?php echo $Top->deaths->ViewAttributes() ?>>
<?php echo $Top->deaths->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>

	
	
	
	
	
	</table>
<div class="ewMultiColumnListOption">
<?php

// Render list options (body, bottom)
$Top_list->ListOptions->Render("body", "", $Top_list->RowCnt);
?>
</div>
	</td>
<?php if ($Top_list->ColCnt == $Top_list->RecPerRow) { ?>
</tr>
<?php } ?>
<?php
	}
	if ($Top->CurrentAction <> "gridadd")
		$Top_list->Recordset->MoveNext();
}
?>
<?php if ($Top_list->ColCnt < $Top_list->RecPerRow) { ?>
<?php for ($i = 1; $i <= $Top_list->RecPerRow - $Top_list->ColCnt; $i++) { ?>
	<td>&nbsp;</td>
<?php } ?>
</tr>
<?php } ?>
</table>
<?php } ?>
<?php if ($Top->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($Top_list->Recordset)
	$Top_list->Recordset->Close();
?>
<?php if ($Top_list->TotalRecs > 0) { ?>
<div class="ewGridLowerPanel">
<?php if ($Top->CurrentAction <> "gridadd" && $Top->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($Top_list->Pager)) $Top_list->Pager = new cNumericPager($Top_list->StartRec, $Top_list->DisplayRecs, $Top_list->TotalRecs, $Top_list->RecRange) ?>
<?php if ($Top_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($Top_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $Top_list->PageUrl() ?>start=<?php echo $Top_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Top_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $Top_list->PageUrl() ?>start=<?php echo $Top_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Top_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $Top_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Top_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $Top_list->PageUrl() ?>start=<?php echo $Top_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Top_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $Top_list->PageUrl() ?>start=<?php echo $Top_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($Top_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Top_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Top_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Top_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Top_list->SearchWhere == "0=101") { ?>
	<p><?php echo $Language->Phrase("EnterSearchCriteria") ?></p>
	<?php } else { ?>
	<p><?php echo $Language->Phrase("NoRecord") ?></p>
	<?php } ?>
<?php } ?>
</td>
</tr></table>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($Top_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
</div>
<?php } ?>
</td></tr></table>
</div>
<script type="text/javascript">
fToplist.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$Top_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Top_list->Page_Terminate();
?>
