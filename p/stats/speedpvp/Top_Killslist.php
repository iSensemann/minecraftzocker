<?php
if (session_id() == "") session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg10.php" ?>
<?php include_once "ewmysql10.php" ?>
<?php include_once "phpfn10.php" ?>
<?php include_once "Top_Killsinfo.php" ?>
<?php include_once "userfn10.php" ?>
<?php

//
// Page class
//

$Top_Kills_list = NULL; // Initialize page object first

class cTop_Kills_list extends cTop_Kills {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{AA815AAB-3B1C-42A2-995A-8F483332E9FF}";

	// Table name
	var $TableName = 'Top Kills';

	// Page object name
	var $PageObjName = 'Top_Kills_list';

	// Grid form hidden field names
	var $FormName = 'fTop_Killslist';
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

		// Table object (Top_Kills)
		if (!isset($GLOBALS["Top_Kills"])) {
			$GLOBALS["Top_Kills"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["Top_Kills"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "Top_Killsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "Top_Killsdelete.php";
		$this->MultiUpdateUrl = "Top_Killsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'Top Kills', TRUE);

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
				$this->kills->setSort("DESC");
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
				$item->Body = "<a class=\"ewAction ewCustomAction\" href=\"\" onclick=\"ew_SubmitSelected(document.fTop_Killslist, '" . ew_CurrentUrl() . "', null, '" . $action . "');return false;\">" . $name . "</a>";
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
		$this->streak->setDbValue($rs->fields('streak'));
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
		$this->streak->DbValue = $row['streak'];
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
		$this->streak->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

			// division
			$this->division->ViewValue = $this->division->CurrentValue;
			$this->division->ViewCustomAttributes = "";

			// Points
			$this->Points->ViewValue = $this->Points->CurrentValue;
			$this->Points->ViewCustomAttributes = "";

			// skins
			$this->skins->ViewValue = $this->skins->CurrentValue;
			$this->skins->ViewCustomAttributes = "";

			// name
			$this->name->ViewValue = $this->name->CurrentValue;
			$this->name->ViewCustomAttributes = "";

			// kills
			$this->kills->ViewValue = $this->kills->CurrentValue;
			$this->kills->CssStyle = "font-weight: bold;";
			$this->kills->ViewCustomAttributes = "";

			// deaths
			$this->deaths->ViewValue = $this->deaths->CurrentValue;
			$this->deaths->ViewCustomAttributes = "";

			// streak
			$this->streak->ViewValue = $this->streak->CurrentValue;
			$this->streak->ViewCustomAttributes = "";

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
			$this->streak->LinkCustomAttributes = "";
			$this->streak->HrefValue = "";
			$this->streak->TooltipValue = "";
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
		$Breadcrumb->Add("list", "<span id=\"ewPageCaption\">" . $PageCaption . "</span>", $url, $this->TableVar);
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
if (!isset($Top_Kills_list)) $Top_Kills_list = new cTop_Kills_list();

// Page init
$Top_Kills_list->Page_Init();

// Page main
$Top_Kills_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Top_Kills_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Page object
var Top_Kills_list = new ew_Page("Top_Kills_list");
Top_Kills_list.PageID = "list"; // Page ID
var EW_PAGE_ID = Top_Kills_list.PageID; // For backward compatibility

// Form object
var fTop_Killslist = new ew_Form("fTop_Killslist");
fTop_Killslist.FormKeyCountName = '<?php echo $Top_Kills_list->FormKeyCountName ?>';

// Form_CustomValidate event
fTop_Killslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fTop_Killslist.ValidateRequired = true;
<?php } else { ?>
fTop_Killslist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $Breadcrumb->Render(); ?>
<?php if ($Top_Kills_list->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $Top_Kills_list->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Top_Kills_list->TotalRecs = $Top_Kills->SelectRecordCount();
	} else {
		if ($Top_Kills_list->Recordset = $Top_Kills_list->LoadRecordset())
			$Top_Kills_list->TotalRecs = $Top_Kills_list->Recordset->RecordCount();
	}
	$Top_Kills_list->StartRec = 1;
	if ($Top_Kills_list->DisplayRecs <= 0 || ($Top_Kills->Export <> "" && $Top_Kills->ExportAll)) // Display all records
		$Top_Kills_list->DisplayRecs = $Top_Kills_list->TotalRecs;
	if (!($Top_Kills->Export <> "" && $Top_Kills->ExportAll))
		$Top_Kills_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$Top_Kills_list->Recordset = $Top_Kills_list->LoadRecordset($Top_Kills_list->StartRec-1, $Top_Kills_list->DisplayRecs);
$Top_Kills_list->RenderOtherOptions();
?>
<?php $Top_Kills_list->ShowPageHeader(); ?>
<?php
$Top_Kills_list->ShowMessage();
?>
<center><table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridUpperPanel">
<?php if ($Top_Kills->CurrentAction <> "gridadd" && $Top_Kills->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($Top_Kills_list->Pager)) $Top_Kills_list->Pager = new cNumericPager($Top_Kills_list->StartRec, $Top_Kills_list->DisplayRecs, $Top_Kills_list->TotalRecs, $Top_Kills_list->RecRange) ?>
<?php if ($Top_Kills_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($Top_Kills_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Top_Kills_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Top_Kills_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $Top_Kills_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Top_Kills_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Top_Kills_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($Top_Kills_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Top_Kills_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Top_Kills_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Top_Kills_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Top_Kills_list->SearchWhere == "0=101") { ?>
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
	foreach ($Top_Kills_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
</div>
<form name="fTop_Killslist" id="fTop_Killslist" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" value="Top_Kills">
<div id="gmp_Top_Kills" class="ewGridMiddlePanel">
<?php if ($Top_Kills_list->TotalRecs > 0) { ?>
<table class="ewMultiColumnTable">
<?php
if ($Top_Kills->ExportAll && $Top_Kills->Export <> "") {
	$Top_Kills_list->StopRec = $Top_Kills_list->TotalRecs;
} else {

	// Set the last record to display
	if ($Top_Kills_list->TotalRecs > $Top_Kills_list->StartRec + $Top_Kills_list->DisplayRecs - 1)
		$Top_Kills_list->StopRec = $Top_Kills_list->StartRec + $Top_Kills_list->DisplayRecs - 1;
	else
		$Top_Kills_list->StopRec = $Top_Kills_list->TotalRecs;
}
$Top_Kills_list->RecCnt = $Top_Kills_list->StartRec - 1;
if ($Top_Kills_list->Recordset && !$Top_Kills_list->Recordset->EOF) {
	$Top_Kills_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $Top_Kills_list->StartRec > 1)
		$Top_Kills_list->Recordset->Move($Top_Kills_list->StartRec - 1);
} elseif (!$Top_Kills->AllowAddDeleteRow && $Top_Kills_list->StopRec == 0) {
	$Top_Kills_list->StopRec = $Top_Kills->GridAddRowCount;
}
while ($Top_Kills_list->RecCnt < $Top_Kills_list->StopRec) {
	$Top_Kills_list->RecCnt++;
	if (intval($Top_Kills_list->RecCnt) >= intval($Top_Kills_list->StartRec)) {
		$Top_Kills_list->RowCnt++;
		$Top_Kills_list->ColCnt++;
		if ($Top_Kills_list->ColCnt > $Top_Kills_list->RecPerRow)
			$Top_Kills_list->ColCnt = 1;

		// Set up key count
		$Top_Kills_list->KeyCount = $Top_Kills_list->RowIndex;

		// Init row class and style
		$Top_Kills->ResetAttrs();
		$Top_Kills->CssClass = "";
		if ($Top_Kills->CurrentAction == "gridadd") {
		} else {
			$Top_Kills_list->LoadRowValues($Top_Kills_list->Recordset); // Load row values
		}
		$Top_Kills->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$Top_Kills->RowAttrs = array_merge($Top_Kills->RowAttrs, array('data-rowindex'=>$Top_Kills_list->RowCnt, 'id'=>'r' . $Top_Kills_list->RowCnt . '_Top_Kills', 'data-rowtype'=>$Top_Kills->RowType));

		// Render row
		$Top_Kills_list->RenderRow();

		// Render list options
		$Top_Kills_list->RenderListOptions();
?>
<?php if ($Top_Kills_list->ColCnt == 1) { ?>
<tr>
<?php } ?>
	<td valign="top"<?php echo $Top_Kills->RowAttributes() ?>>
	<table class="table table-bordered table-striped">
	<?php if ($Top_Kills->division->Visible) { // division ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_division">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->division) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->division->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->division->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->division->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->division->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->division->CellAttributes() ?>>
<span<?php echo $Top_Kills->division->ViewAttributes() ?>>
<?php echo $Top_Kills->division->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top_Kills->Points->Visible) { // Points ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_Points">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->Points) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->Points->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->Points->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->Points->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->Points->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->Points->CellAttributes() ?>>
<span<?php echo $Top_Kills->Points->ViewAttributes() ?>>
<?php echo $Top_Kills->Points->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top_Kills->skins->Visible) { // skins ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_skins">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->skins) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->skins->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->skins->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->skins->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->skins->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->skins->CellAttributes() ?>>
<span<?php echo $Top_Kills->skins->ViewAttributes() ?>>
<?php echo $Top_Kills->skins->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top_Kills->name->Visible) { // name ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_name">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->name) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->name->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->name->CellAttributes() ?>>
<span<?php echo $Top_Kills->name->ViewAttributes() ?>>
<?php echo $Top_Kills->name->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top_Kills->kills->Visible) { // kills ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_kills">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->kills) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->kills->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->kills->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->kills->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->kills->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->kills->CellAttributes() ?>>
<span<?php echo $Top_Kills->kills->ViewAttributes() ?>>
<?php echo $Top_Kills->kills->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top_Kills->deaths->Visible) { // deaths ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_deaths">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->deaths) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->deaths->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->deaths->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->deaths->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->deaths->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->deaths->CellAttributes() ?>>
<span<?php echo $Top_Kills->deaths->ViewAttributes() ?>>
<?php echo $Top_Kills->deaths->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top_Kills->streak->Visible) { // streak ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_Kills_streak">
<?php if ($Top_Kills->Export <> "" || $Top_Kills->SortUrl($Top_Kills->streak) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->streak->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->streak->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->streak->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->streak->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top_Kills->streak->CellAttributes() ?>>
<span<?php echo $Top_Kills->streak->ViewAttributes() ?>>
<?php echo $Top_Kills->streak->ListViewValue() ?></span>
</td>
		</tr>
	<?php } ?>
	</table>
<div class="ewMultiColumnListOption">
<?php

// Render list options (body, bottom)
$Top_Kills_list->ListOptions->Render("body", "", $Top_Kills_list->RowCnt);
?>
</div>
	</td>
<?php if ($Top_Kills_list->ColCnt == $Top_Kills_list->RecPerRow) { ?>
</tr>
<?php } ?>
<?php
	}
	if ($Top_Kills->CurrentAction <> "gridadd")
		$Top_Kills_list->Recordset->MoveNext();
}
?>
<?php if ($Top_Kills_list->ColCnt < $Top_Kills_list->RecPerRow) { ?>
<?php for ($i = 1; $i <= $Top_Kills_list->RecPerRow - $Top_Kills_list->ColCnt; $i++) { ?>
	<td>&nbsp;</td>
<?php } ?>
</tr>
<?php } ?>
</table>
<?php } ?>
<?php if ($Top_Kills->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($Top_Kills_list->Recordset)
	$Top_Kills_list->Recordset->Close();
?>
<?php if ($Top_Kills_list->TotalRecs > 0) { ?>
<div class="ewGridLowerPanel">
<?php if ($Top_Kills->CurrentAction <> "gridadd" && $Top_Kills->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-horizontal" action="<?php echo ew_CurrentPage() ?>">
<table class="ewPager">
<tr><td>
<?php if (!isset($Top_Kills_list->Pager)) $Top_Kills_list->Pager = new cNumericPager($Top_Kills_list->StartRec, $Top_Kills_list->DisplayRecs, $Top_Kills_list->TotalRecs, $Top_Kills_list->RecRange) ?>
<?php if ($Top_Kills_list->Pager->RecordCount > 0) { ?>
<table cellspacing="0" class="ewStdTable"><tbody><tr><td>
<div class="pagination"><ul>
	<?php if ($Top_Kills_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($Top_Kills_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($Top_Kills_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $Top_Kills_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($Top_Kills_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($Top_Kills_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $Top_Kills_list->PageUrl() ?>start=<?php echo $Top_Kills_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</td>
<td>
	<?php if ($Top_Kills_list->Pager->ButtonCount > 0) { ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php } ?>
	<?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $Top_Kills_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $Top_Kills_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $Top_Kills_list->Pager->RecordCount ?>
</td>
</tr></tbody></table>
<?php } else { ?>
	<?php if ($Top_Kills_list->SearchWhere == "0=101") { ?>
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
	foreach ($Top_Kills_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
</div>
<?php } ?>
</td></tr></table></center>
<script type="text/javascript">
fTop_Killslist.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php
$Top_Kills_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$Top_Kills_list->Page_Terminate();
?>
