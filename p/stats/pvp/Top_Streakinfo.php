<?php

// Global variable for table object
$Top_Streak = NULL;

//
// Table class for Top Streak
//
class cTop_Streak extends cTable {
	var $id;
	var $division;
	var $Points;
	var $skins;
	var $name;
	var $kills;
	var $deaths;
	var $streak;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'Top_Streak';
		$this->TableName = 'Top Streak';
		$this->TableType = 'CUSTOMVIEW';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('Top_Streak', 'Top Streak', 'x_id', 'id', 'pvpstats.id', 'pvpstats.id', 3, -1, FALSE, 'pvpstats.id', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// division
		$this->division = new cField('Top_Streak', 'Top Streak', 'x_division', 'division', 'pvpstats.kills - pvpstats.kills', 'pvpstats.kills - pvpstats.kills', 20, -1, FALSE, 'pvpstats.kills - pvpstats.kills', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->division->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['division'] = &$this->division;

		// Points
		$this->Points = new cField('Top_Streak', 'Top Streak', 'x_Points', 'Points', 'pvpstats.kills - pvpstats.deaths', 'pvpstats.kills - pvpstats.deaths', 20, -1, FALSE, 'pvpstats.kills - pvpstats.deaths', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->Points->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Points'] = &$this->Points;

		// skins
		$this->skins = new cField('Top_Streak', 'Top Streak', 'x_skins', 'skins', 'pvpstats.name', 'pvpstats.name', 200, -1, FALSE, 'pvpstats.name', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['skins'] = &$this->skins;

		// name
		$this->name = new cField('Top_Streak', 'Top Streak', 'x_name', 'name', 'pvpstats.name', 'pvpstats.name', 200, -1, FALSE, 'pvpstats.name', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->fields['name'] = &$this->name;

		// kills
		$this->kills = new cField('Top_Streak', 'Top Streak', 'x_kills', 'kills', 'pvpstats.kills', 'pvpstats.kills', 3, -1, FALSE, 'pvpstats.kills', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->kills->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['kills'] = &$this->kills;

		// deaths
		$this->deaths = new cField('Top_Streak', 'Top Streak', 'x_deaths', 'deaths', 'pvpstats.deaths', 'pvpstats.deaths', 3, -1, FALSE, 'pvpstats.deaths', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->deaths->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['deaths'] = &$this->deaths;

		// streak
		$this->streak = new cField('Top_Streak', 'Top Streak', 'x_streak', 'streak', 'pvpstats.streak', 'pvpstats.streak', 3, -1, FALSE, 'pvpstats.streak', FALSE, FALSE, FALSE, 'FORMATTED TEXT');
		$this->streak->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['streak'] = &$this->streak;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "pvpstats";
	}

	function SqlSelect() { // Select
		return "SELECT pvpstats.name, pvpstats.kills, pvpstats.deaths, pvpstats.name AS skins, pvpstats.kills - pvpstats.kills AS division, pvpstats.kills - pvpstats.deaths AS Points, pvpstats.streak, pvpstats.id FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "pvpstats.kills, pvpstats.deaths, pvpstats.kills - pvpstats.kills, pvpstats.kills - pvpstats.deaths, pvpstats.streak, pvpstats.id";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "pvpstats.streak DESC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (@$this->PageID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->SqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Update Table
	var $UpdateTable = "pvpstats";

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		global $conn;
		return $conn->Execute($this->InsertSQL($rs));
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "") {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]))
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL) {
		global $conn;
		return $conn->Execute($this->UpdateSQL($rs, $where));
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "") {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType));
		}
		$filter = $this->CurrentFilter;
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "") {
		global $conn;
		return $conn->Execute($this->DeleteSQL($rs, $where));
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "pvpstats.id = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "Top_Streaklist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "Top_Streaklist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			return $this->KeyUrl("Top_Streakview.php", $this->UrlParm($parm));
		else
			return $this->KeyUrl("Top_Streakview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
	}

	// Add URL
	function GetAddUrl() {
		return "Top_Streakadd.php";
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		return $this->KeyUrl("Top_Streakedit.php", $this->UrlParm($parm));
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		return $this->KeyUrl("Top_Streakadd.php", $this->UrlParm($parm));
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("Top_Streakdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		return "";
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET)) {
			$arKeys[] = @$_GET["id"]; // id

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		foreach ($arKeys as $key) {
			if (!is_numeric($key))
				continue;
			$ar[] = $key;
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->division->setDbValue($rs->fields('division'));
		$this->Points->setDbValue($rs->fields('Points'));
		$this->skins->setDbValue($rs->fields('skins'));
		$this->name->setDbValue($rs->fields('name'));
		$this->kills->setDbValue($rs->fields('kills'));
		$this->deaths->setDbValue($rs->fields('deaths'));
		$this->streak->setDbValue($rs->fields('streak'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

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
		$this->kills->ViewCustomAttributes = "";

		// deaths
		$this->deaths->ViewValue = $this->deaths->CurrentValue;
		$this->deaths->ViewCustomAttributes = "";

		// streak
		$this->streak->ViewValue = $this->streak->CurrentValue;
		$this->streak->CssStyle = "font-weight: bold;";
		$this->streak->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;

		// Write header
		$Doc->ExportTableHeader();
		if ($Doc->Horizontal) { // Horizontal format, write header
			$Doc->BeginExportRow();
			if ($ExportPageType == "view") {
			} else {
			}
			$Doc->EndExportRow();
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
				if ($ExportPageType == "view") {
				} else {
				}
				$Doc->EndExportRow();
			}
			$Recordset->MoveNext();
		}
		$Doc->ExportTableFooter();
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);
	//$YourSQL = "SELECT MAX(points) FROM (SELECT COUNT(*) AS points FROM pvpstats WHERE points > 0 GROUP BY player) as counts";
	//$GLOBALS["conn"]->Execute($YourSQL);  
	//$this->Ranks->ViewValue = $YourSQL; 

	$iron = "Iron";   
	  if ($this->Points->CurrentValue >= "0") {   
			$this->division->ViewValue = "";
	}
	 if ($this->division->CurrentValue >= "0") {   
			$this->division->ViewValue = "";
	}
	 $i = $this->name->CurrentValue;  
	 $ipoints = $this->Points->CurrentValue; 
	 $this->skins->ViewValue = '<img src="http://minotar.net/helm/' .$i. '/50.png">'; 
	  if ($this->Points->CurrentValue >= "25") {
			$this->division->ViewValue = "Wood";
			$this->division->ViewValue = '<img src="division/wood.png" title="Wood Division">';
			$this->name->ViewAttrs["style"] = "color: #FFFFFF; background-color: #61210B";    
	}
	 if ($this->Points->CurrentValue >= "50") { 
			$this->division->ViewValue = "Stone";
			$this->division->ViewValue = '<img src="division/stone.png" title="Stone Division">';
			$this->name->ViewAttrs["style"] = "color: #FFFFFF; background-color: #6E6E6E";    
	}
	 if ($this->Points->CurrentValue >= "150") {
			$this->division->ViewValue = "Iron";
			$this->division->ViewValue = '<img src="division/iron.png" title="Iron Division">';
			$this->name->ViewAttrs["style"] = "color: #000000; background-color: #BDBDBD"; 
	}                                                                                  
	 if ($this->Points->CurrentValue >= "200") {
			$this->division->ViewValue = "Gold";
			$this->division->ViewValue = '<img src="division/gold.png" title="Gold Division">';
			$this->name->ViewAttrs["style"] = "color: #000000; background-color: #FACC2E"; 
	}                                                           
	 if ($this->Points->CurrentValue >= "350") {
			$this->division->ViewValue = "Diamond";
					$this->division->ViewValue = '<img src="division/diamond.png" title="Diamond Division">';
			$this->name->ViewAttrs["style"] = "color: #000000; background-color: #00FFFF";
	}
	 if ($this->Points->CurrentValue >= "500") {
			$this->division->ViewValue = "Master";
			$this->division->ViewValue = '<img src="division/master.png" title="Master Division">';
			$this->name->ViewAttrs["style"] = "color: #FFFFFF; background-color: #013ADF";
	}
	 if ($this->Points->CurrentValue >= "750") {
			$this->division->ViewValue = "Epic";
			$this->division->ViewValue = '<img src="division/epic.png" title="Epic Division">';
			$this->name->ViewAttrs["style"] = "color: #FFFFFF; background-color: #4B088A";
	}
	 if ($this->Points->CurrentValue >= "1000") {
			$this->division->ViewValue = "Legend";
			$this->division->ViewValue = '<img src="division/legend.png" title="Legend Division">';
			$this->name->ViewAttrs["style"] = "color: #FFFFFF; background-color: #B45F04";
	}             
	}                                                                                      

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
