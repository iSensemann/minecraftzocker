<?php

// Create page object
if (!isset($Top_Streak_grid)) $Top_Streak_grid = new cTop_Streak_grid();

// Page init
$Top_Streak_grid->Page_Init();

// Page main
$Top_Streak_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Top_Streak_grid->Page_Render();
?>
<?php if ($Top_Streak->Export == "") { ?>
<script type="text/javascript">

// Page object
var Top_Streak_grid = new ew_Page("Top_Streak_grid");
Top_Streak_grid.PageID = "grid"; // Page ID
var EW_PAGE_ID = Top_Streak_grid.PageID; // For backward compatibility

// Form object
var fTop_Streakgrid = new ew_Form("fTop_Streakgrid");
fTop_Streakgrid.FormKeyCountName = '<?php echo $Top_Streak_grid->FormKeyCountName ?>';

// Validate form
fTop_Streakgrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	this.PostAutoSuggest();
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_division");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->division->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_division");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Streak->division->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Points");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->Points->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_Points");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Streak->Points->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_skins");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->skins->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_player");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->player->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_kills");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->kills->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_kills");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Streak->kills->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_deaths");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->deaths->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_deaths");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Streak->deaths->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_streak");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Streak->streak->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_streak");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Streak->streak->FldErrMsg()) ?>");

			// Set up row object
			ew_ElementsToRow(fobj);

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fTop_Streakgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "division", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Points", false)) return false;
	if (ew_ValueChanged(fobj, infix, "skins", false)) return false;
	if (ew_ValueChanged(fobj, infix, "player", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kills", false)) return false;
	if (ew_ValueChanged(fobj, infix, "deaths", false)) return false;
	if (ew_ValueChanged(fobj, infix, "streak", false)) return false;
	return true;
}

// Form_CustomValidate event
fTop_Streakgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fTop_Streakgrid.ValidateRequired = true;
<?php } else { ?>
fTop_Streakgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php if ($Top_Streak->getCurrentMasterTable() == "" && $Top_Streak_grid->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $Top_Streak_grid->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
if ($Top_Streak->CurrentAction == "gridadd") {
	if ($Top_Streak->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$Top_Streak_grid->TotalRecs = $Top_Streak->SelectRecordCount();
			$Top_Streak_grid->Recordset = $Top_Streak_grid->LoadRecordset($Top_Streak_grid->StartRec-1, $Top_Streak_grid->DisplayRecs);
		} else {
			if ($Top_Streak_grid->Recordset = $Top_Streak_grid->LoadRecordset())
				$Top_Streak_grid->TotalRecs = $Top_Streak_grid->Recordset->RecordCount();
		}
		$Top_Streak_grid->StartRec = 1;
		$Top_Streak_grid->DisplayRecs = $Top_Streak_grid->TotalRecs;
	} else {
		$Top_Streak->CurrentFilter = "0=1";
		$Top_Streak_grid->StartRec = 1;
		$Top_Streak_grid->DisplayRecs = $Top_Streak->GridAddRowCount;
	}
	$Top_Streak_grid->TotalRecs = $Top_Streak_grid->DisplayRecs;
	$Top_Streak_grid->StopRec = $Top_Streak_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Top_Streak_grid->TotalRecs = $Top_Streak->SelectRecordCount();
	} else {
		if ($Top_Streak_grid->Recordset = $Top_Streak_grid->LoadRecordset())
			$Top_Streak_grid->TotalRecs = $Top_Streak_grid->Recordset->RecordCount();
	}
	$Top_Streak_grid->StartRec = 1;
	$Top_Streak_grid->DisplayRecs = $Top_Streak_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$Top_Streak_grid->Recordset = $Top_Streak_grid->LoadRecordset($Top_Streak_grid->StartRec-1, $Top_Streak_grid->DisplayRecs);
}
$Top_Streak_grid->RenderOtherOptions();
?>
<?php $Top_Streak_grid->ShowPageHeader(); ?>
<?php
$Top_Streak_grid->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="fTop_Streakgrid" class="ewForm form-horizontal">
<div id="gmp_Top_Streak" class="ewGridMiddlePanel">
<table id="tbl_Top_Streakgrid" class="ewTable ewTableSeparate">
<?php echo $Top_Streak->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$Top_Streak_grid->RenderListOptions();

// Render list options (header, left)
$Top_Streak_grid->ListOptions->Render("header", "left");
?>
<?php if ($Top_Streak->division->Visible) { // division ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->division) == "") { ?>
		<td><div id="elh_Top_Streak_division" class="Top_Streak_division"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->division->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_division" class="Top_Streak_division">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->division->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->division->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->division->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Streak->Points->Visible) { // Points ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->Points) == "") { ?>
		<td><div id="elh_Top_Streak_Points" class="Top_Streak_Points"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->Points->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_Points" class="Top_Streak_Points">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->Points->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->Points->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->Points->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Streak->skins->Visible) { // skins ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->skins) == "") { ?>
		<td><div id="elh_Top_Streak_skins" class="Top_Streak_skins"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->skins->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_skins" class="Top_Streak_skins">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->skins->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->skins->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->skins->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Streak->player->Visible) { // player ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->player) == "") { ?>
		<td><div id="elh_Top_Streak_player" class="Top_Streak_player"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->player->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_player" class="Top_Streak_player">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->player->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->player->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->player->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Streak->kills->Visible) { // kills ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->kills) == "") { ?>
		<td><div id="elh_Top_Streak_kills" class="Top_Streak_kills"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->kills->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_kills" class="Top_Streak_kills">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->kills->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->kills->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->kills->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Streak->deaths->Visible) { // deaths ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->deaths) == "") { ?>
		<td><div id="elh_Top_Streak_deaths" class="Top_Streak_deaths"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->deaths->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_deaths" class="Top_Streak_deaths">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->deaths->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->deaths->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->deaths->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Streak->streak->Visible) { // streak ?>
	<?php if ($Top_Streak->SortUrl($Top_Streak->streak) == "") { ?>
		<td><div id="elh_Top_Streak_streak" class="Top_Streak_streak"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Streak->streak->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Streak_streak" class="Top_Streak_streak">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Streak->streak->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Streak->streak->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Streak->streak->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$Top_Streak_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Top_Streak_grid->StartRec = 1;
$Top_Streak_grid->StopRec = $Top_Streak_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($Top_Streak_grid->FormKeyCountName) && ($Top_Streak->CurrentAction == "gridadd" || $Top_Streak->CurrentAction == "gridedit" || $Top_Streak->CurrentAction == "F")) {
		$Top_Streak_grid->KeyCount = $objForm->GetValue($Top_Streak_grid->FormKeyCountName);
		$Top_Streak_grid->StopRec = $Top_Streak_grid->StartRec + $Top_Streak_grid->KeyCount - 1;
	}
}
$Top_Streak_grid->RecCnt = $Top_Streak_grid->StartRec - 1;
if ($Top_Streak_grid->Recordset && !$Top_Streak_grid->Recordset->EOF) {
	$Top_Streak_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $Top_Streak_grid->StartRec > 1)
		$Top_Streak_grid->Recordset->Move($Top_Streak_grid->StartRec - 1);
} elseif (!$Top_Streak->AllowAddDeleteRow && $Top_Streak_grid->StopRec == 0) {
	$Top_Streak_grid->StopRec = $Top_Streak->GridAddRowCount;
}

// Initialize aggregate
$Top_Streak->RowType = EW_ROWTYPE_AGGREGATEINIT;
$Top_Streak->ResetAttrs();
$Top_Streak_grid->RenderRow();
if ($Top_Streak->CurrentAction == "gridadd")
	$Top_Streak_grid->RowIndex = 0;
if ($Top_Streak->CurrentAction == "gridedit")
	$Top_Streak_grid->RowIndex = 0;
while ($Top_Streak_grid->RecCnt < $Top_Streak_grid->StopRec) {
	$Top_Streak_grid->RecCnt++;
	if (intval($Top_Streak_grid->RecCnt) >= intval($Top_Streak_grid->StartRec)) {
		$Top_Streak_grid->RowCnt++;
		if ($Top_Streak->CurrentAction == "gridadd" || $Top_Streak->CurrentAction == "gridedit" || $Top_Streak->CurrentAction == "F") {
			$Top_Streak_grid->RowIndex++;
			$objForm->Index = $Top_Streak_grid->RowIndex;
			if ($objForm->HasValue($Top_Streak_grid->FormActionName))
				$Top_Streak_grid->RowAction = strval($objForm->GetValue($Top_Streak_grid->FormActionName));
			elseif ($Top_Streak->CurrentAction == "gridadd")
				$Top_Streak_grid->RowAction = "insert";
			else
				$Top_Streak_grid->RowAction = "";
		}

		// Set up key count
		$Top_Streak_grid->KeyCount = $Top_Streak_grid->RowIndex;

		// Init row class and style
		$Top_Streak->ResetAttrs();
		$Top_Streak->CssClass = "";
		if ($Top_Streak->CurrentAction == "gridadd") {
			if ($Top_Streak->CurrentMode == "copy") {
				$Top_Streak_grid->LoadRowValues($Top_Streak_grid->Recordset); // Load row values
				$Top_Streak_grid->SetRecordKey($Top_Streak_grid->RowOldKey, $Top_Streak_grid->Recordset); // Set old record key
			} else {
				$Top_Streak_grid->LoadDefaultValues(); // Load default values
				$Top_Streak_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Top_Streak_grid->LoadRowValues($Top_Streak_grid->Recordset); // Load row values
		}
		$Top_Streak->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($Top_Streak->CurrentAction == "gridadd") // Grid add
			$Top_Streak->RowType = EW_ROWTYPE_ADD; // Render add
		if ($Top_Streak->CurrentAction == "gridadd" && $Top_Streak->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$Top_Streak_grid->RestoreCurrentRowFormValues($Top_Streak_grid->RowIndex); // Restore form values
		if ($Top_Streak->CurrentAction == "gridedit") { // Grid edit
			if ($Top_Streak->EventCancelled) {
				$Top_Streak_grid->RestoreCurrentRowFormValues($Top_Streak_grid->RowIndex); // Restore form values
			}
			if ($Top_Streak_grid->RowAction == "insert")
				$Top_Streak->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$Top_Streak->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($Top_Streak->CurrentAction == "gridedit" && ($Top_Streak->RowType == EW_ROWTYPE_EDIT || $Top_Streak->RowType == EW_ROWTYPE_ADD) && $Top_Streak->EventCancelled) // Update failed
			$Top_Streak_grid->RestoreCurrentRowFormValues($Top_Streak_grid->RowIndex); // Restore form values
		if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) // Edit row
			$Top_Streak_grid->EditRowCnt++;
		if ($Top_Streak->CurrentAction == "F") // Confirm row
			$Top_Streak_grid->RestoreCurrentRowFormValues($Top_Streak_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Top_Streak->RowAttrs = array_merge($Top_Streak->RowAttrs, array('data-rowindex'=>$Top_Streak_grid->RowCnt, 'id'=>'r' . $Top_Streak_grid->RowCnt . '_Top_Streak', 'data-rowtype'=>$Top_Streak->RowType));

		// Render row
		$Top_Streak_grid->RenderRow();

		// Render list options
		$Top_Streak_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Top_Streak_grid->RowAction <> "delete" && $Top_Streak_grid->RowAction <> "insertdelete" && !($Top_Streak_grid->RowAction == "insert" && $Top_Streak->CurrentAction == "F" && $Top_Streak_grid->EmptyRow())) {
?>
	<tr<?php echo $Top_Streak->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Top_Streak_grid->ListOptions->Render("body", "left", $Top_Streak_grid->RowCnt);
?>
	<?php if ($Top_Streak->division->Visible) { // division ?>
		<td<?php echo $Top_Streak->division->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_division" class="control-group Top_Streak_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_Streak_grid->RowIndex ?>_division" id="x<?php echo $Top_Streak_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top_Streak->division->PlaceHolder ?>" value="<?php echo $Top_Streak->division->EditValue ?>"<?php echo $Top_Streak->division->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_division" name="o<?php echo $Top_Streak_grid->RowIndex ?>_division" id="o<?php echo $Top_Streak_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Streak->division->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_division" class="control-group Top_Streak_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_Streak_grid->RowIndex ?>_division" id="x<?php echo $Top_Streak_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top_Streak->division->PlaceHolder ?>" value="<?php echo $Top_Streak->division->EditValue ?>"<?php echo $Top_Streak->division->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->division->ViewAttributes() ?>>
<?php echo $Top_Streak->division->ListViewValue() ?></span>
<input type="hidden" data-field="x_division" name="x<?php echo $Top_Streak_grid->RowIndex ?>_division" id="x<?php echo $Top_Streak_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Streak->division->FormValue) ?>">
<input type="hidden" data-field="x_division" name="o<?php echo $Top_Streak_grid->RowIndex ?>_division" id="o<?php echo $Top_Streak_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Streak->division->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-field="x_id" name="x<?php echo $Top_Streak_grid->RowIndex ?>_id" id="x<?php echo $Top_Streak_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($Top_Streak->id->CurrentValue) ?>">
<input type="hidden" data-field="x_id" name="o<?php echo $Top_Streak_grid->RowIndex ?>_id" id="o<?php echo $Top_Streak_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($Top_Streak->id->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT || $Top_Streak->CurrentMode == "edit") { ?>
<input type="hidden" data-field="x_id" name="x<?php echo $Top_Streak_grid->RowIndex ?>_id" id="x<?php echo $Top_Streak_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($Top_Streak->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($Top_Streak->Points->Visible) { // Points ?>
		<td<?php echo $Top_Streak->Points->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_Points" class="control-group Top_Streak_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top_Streak->Points->PlaceHolder ?>" value="<?php echo $Top_Streak->Points->EditValue ?>"<?php echo $Top_Streak->Points->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="o<?php echo $Top_Streak_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Streak->Points->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_Points" class="control-group Top_Streak_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top_Streak->Points->PlaceHolder ?>" value="<?php echo $Top_Streak->Points->EditValue ?>"<?php echo $Top_Streak->Points->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->Points->ViewAttributes() ?>>
<?php echo $Top_Streak->Points->ListViewValue() ?></span>
<input type="hidden" data-field="x_Points" name="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Streak->Points->FormValue) ?>">
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="o<?php echo $Top_Streak_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Streak->Points->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Streak->skins->Visible) { // skins ?>
		<td<?php echo $Top_Streak->skins->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_skins" class="control-group Top_Streak_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top_Streak->skins->PlaceHolder ?>" value="<?php echo $Top_Streak->skins->EditValue ?>"<?php echo $Top_Streak->skins->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="o<?php echo $Top_Streak_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Streak->skins->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_skins" class="control-group Top_Streak_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top_Streak->skins->PlaceHolder ?>" value="<?php echo $Top_Streak->skins->EditValue ?>"<?php echo $Top_Streak->skins->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->skins->ViewAttributes() ?>>
<?php echo $Top_Streak->skins->ListViewValue() ?></span>
<input type="hidden" data-field="x_skins" name="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Streak->skins->FormValue) ?>">
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="o<?php echo $Top_Streak_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Streak->skins->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Streak->player->Visible) { // player ?>
		<td<?php echo $Top_Streak->player->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_player" class="control-group Top_Streak_player">
<input type="text" data-field="x_player" name="x<?php echo $Top_Streak_grid->RowIndex ?>_player" id="x<?php echo $Top_Streak_grid->RowIndex ?>_player" size="30" maxlength="42" placeholder="<?php echo $Top_Streak->player->PlaceHolder ?>" value="<?php echo $Top_Streak->player->EditValue ?>"<?php echo $Top_Streak->player->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_player" name="o<?php echo $Top_Streak_grid->RowIndex ?>_player" id="o<?php echo $Top_Streak_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Streak->player->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_player" class="control-group Top_Streak_player">
<input type="text" data-field="x_player" name="x<?php echo $Top_Streak_grid->RowIndex ?>_player" id="x<?php echo $Top_Streak_grid->RowIndex ?>_player" size="30" maxlength="42" placeholder="<?php echo $Top_Streak->player->PlaceHolder ?>" value="<?php echo $Top_Streak->player->EditValue ?>"<?php echo $Top_Streak->player->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->player->ViewAttributes() ?>>
<?php echo $Top_Streak->player->ListViewValue() ?></span>
<input type="hidden" data-field="x_player" name="x<?php echo $Top_Streak_grid->RowIndex ?>_player" id="x<?php echo $Top_Streak_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Streak->player->FormValue) ?>">
<input type="hidden" data-field="x_player" name="o<?php echo $Top_Streak_grid->RowIndex ?>_player" id="o<?php echo $Top_Streak_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Streak->player->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Streak->kills->Visible) { // kills ?>
		<td<?php echo $Top_Streak->kills->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_kills" class="control-group Top_Streak_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top_Streak->kills->PlaceHolder ?>" value="<?php echo $Top_Streak->kills->EditValue ?>"<?php echo $Top_Streak->kills->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="o<?php echo $Top_Streak_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Streak->kills->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_kills" class="control-group Top_Streak_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top_Streak->kills->PlaceHolder ?>" value="<?php echo $Top_Streak->kills->EditValue ?>"<?php echo $Top_Streak->kills->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->kills->ViewAttributes() ?>>
<?php echo $Top_Streak->kills->ListViewValue() ?></span>
<input type="hidden" data-field="x_kills" name="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Streak->kills->FormValue) ?>">
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="o<?php echo $Top_Streak_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Streak->kills->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Streak->deaths->Visible) { // deaths ?>
		<td<?php echo $Top_Streak->deaths->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_deaths" class="control-group Top_Streak_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top_Streak->deaths->PlaceHolder ?>" value="<?php echo $Top_Streak->deaths->EditValue ?>"<?php echo $Top_Streak->deaths->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="o<?php echo $Top_Streak_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Streak->deaths->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_deaths" class="control-group Top_Streak_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top_Streak->deaths->PlaceHolder ?>" value="<?php echo $Top_Streak->deaths->EditValue ?>"<?php echo $Top_Streak->deaths->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->deaths->ViewAttributes() ?>>
<?php echo $Top_Streak->deaths->ListViewValue() ?></span>
<input type="hidden" data-field="x_deaths" name="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Streak->deaths->FormValue) ?>">
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="o<?php echo $Top_Streak_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Streak->deaths->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Streak->streak->Visible) { // streak ?>
		<td<?php echo $Top_Streak->streak->CellAttributes() ?>>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_streak" class="control-group Top_Streak_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top_Streak->streak->PlaceHolder ?>" value="<?php echo $Top_Streak->streak->EditValue ?>"<?php echo $Top_Streak->streak->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="o<?php echo $Top_Streak_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Streak->streak->OldValue) ?>">
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Streak_grid->RowCnt ?>_Top_Streak_streak" class="control-group Top_Streak_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top_Streak->streak->PlaceHolder ?>" value="<?php echo $Top_Streak->streak->EditValue ?>"<?php echo $Top_Streak->streak->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Streak->streak->ViewAttributes() ?>>
<?php echo $Top_Streak->streak->ListViewValue() ?></span>
<input type="hidden" data-field="x_streak" name="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Streak->streak->FormValue) ?>">
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="o<?php echo $Top_Streak_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Streak->streak->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Streak_grid->PageObjName . "_row_" . $Top_Streak_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$Top_Streak_grid->ListOptions->Render("body", "right", $Top_Streak_grid->RowCnt);
?>
	</tr>
<?php if ($Top_Streak->RowType == EW_ROWTYPE_ADD || $Top_Streak->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fTop_Streakgrid.UpdateOpts(<?php echo $Top_Streak_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($Top_Streak->CurrentAction <> "gridadd" || $Top_Streak->CurrentMode == "copy")
		if (!$Top_Streak_grid->Recordset->EOF) $Top_Streak_grid->Recordset->MoveNext();
}
?>
<?php
	if ($Top_Streak->CurrentMode == "add" || $Top_Streak->CurrentMode == "copy" || $Top_Streak->CurrentMode == "edit") {
		$Top_Streak_grid->RowIndex = '$rowindex$';
		$Top_Streak_grid->LoadDefaultValues();

		// Set row properties
		$Top_Streak->ResetAttrs();
		$Top_Streak->RowAttrs = array_merge($Top_Streak->RowAttrs, array('data-rowindex'=>$Top_Streak_grid->RowIndex, 'id'=>'r0_Top_Streak', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($Top_Streak->RowAttrs["class"], "ewTemplate");
		$Top_Streak->RowType = EW_ROWTYPE_ADD;

		// Render row
		$Top_Streak_grid->RenderRow();

		// Render list options
		$Top_Streak_grid->RenderListOptions();
		$Top_Streak_grid->StartRowCnt = 0;
?>
	<tr<?php echo $Top_Streak->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Top_Streak_grid->ListOptions->Render("body", "left", $Top_Streak_grid->RowIndex);
?>
	<?php if ($Top_Streak->division->Visible) { // division ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_division" class="control-group Top_Streak_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_Streak_grid->RowIndex ?>_division" id="x<?php echo $Top_Streak_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top_Streak->division->PlaceHolder ?>" value="<?php echo $Top_Streak->division->EditValue ?>"<?php echo $Top_Streak->division->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_division" class="control-group Top_Streak_division">
<span<?php echo $Top_Streak->division->ViewAttributes() ?>>
<?php echo $Top_Streak->division->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_division" name="x<?php echo $Top_Streak_grid->RowIndex ?>_division" id="x<?php echo $Top_Streak_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Streak->division->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_division" name="o<?php echo $Top_Streak_grid->RowIndex ?>_division" id="o<?php echo $Top_Streak_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Streak->division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Streak->Points->Visible) { // Points ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_Points" class="control-group Top_Streak_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top_Streak->Points->PlaceHolder ?>" value="<?php echo $Top_Streak->Points->EditValue ?>"<?php echo $Top_Streak->Points->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_Points" class="control-group Top_Streak_Points">
<span<?php echo $Top_Streak->Points->ViewAttributes() ?>>
<?php echo $Top_Streak->Points->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_Points" name="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="x<?php echo $Top_Streak_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Streak->Points->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_Streak_grid->RowIndex ?>_Points" id="o<?php echo $Top_Streak_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Streak->Points->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Streak->skins->Visible) { // skins ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_skins" class="control-group Top_Streak_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top_Streak->skins->PlaceHolder ?>" value="<?php echo $Top_Streak->skins->EditValue ?>"<?php echo $Top_Streak->skins->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_skins" class="control-group Top_Streak_skins">
<span<?php echo $Top_Streak->skins->ViewAttributes() ?>>
<?php echo $Top_Streak->skins->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_skins" name="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="x<?php echo $Top_Streak_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Streak->skins->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_Streak_grid->RowIndex ?>_skins" id="o<?php echo $Top_Streak_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Streak->skins->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Streak->player->Visible) { // player ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_player" class="control-group Top_Streak_player">
<input type="text" data-field="x_player" name="x<?php echo $Top_Streak_grid->RowIndex ?>_player" id="x<?php echo $Top_Streak_grid->RowIndex ?>_player" size="30" maxlength="42" placeholder="<?php echo $Top_Streak->player->PlaceHolder ?>" value="<?php echo $Top_Streak->player->EditValue ?>"<?php echo $Top_Streak->player->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_player" class="control-group Top_Streak_player">
<span<?php echo $Top_Streak->player->ViewAttributes() ?>>
<?php echo $Top_Streak->player->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_player" name="x<?php echo $Top_Streak_grid->RowIndex ?>_player" id="x<?php echo $Top_Streak_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Streak->player->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_player" name="o<?php echo $Top_Streak_grid->RowIndex ?>_player" id="o<?php echo $Top_Streak_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Streak->player->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Streak->kills->Visible) { // kills ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_kills" class="control-group Top_Streak_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top_Streak->kills->PlaceHolder ?>" value="<?php echo $Top_Streak->kills->EditValue ?>"<?php echo $Top_Streak->kills->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_kills" class="control-group Top_Streak_kills">
<span<?php echo $Top_Streak->kills->ViewAttributes() ?>>
<?php echo $Top_Streak->kills->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_kills" name="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="x<?php echo $Top_Streak_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Streak->kills->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_Streak_grid->RowIndex ?>_kills" id="o<?php echo $Top_Streak_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Streak->kills->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Streak->deaths->Visible) { // deaths ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_deaths" class="control-group Top_Streak_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top_Streak->deaths->PlaceHolder ?>" value="<?php echo $Top_Streak->deaths->EditValue ?>"<?php echo $Top_Streak->deaths->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_deaths" class="control-group Top_Streak_deaths">
<span<?php echo $Top_Streak->deaths->ViewAttributes() ?>>
<?php echo $Top_Streak->deaths->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_deaths" name="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Streak_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Streak->deaths->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_Streak_grid->RowIndex ?>_deaths" id="o<?php echo $Top_Streak_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Streak->deaths->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Streak->streak->Visible) { // streak ?>
		<td>
<?php if ($Top_Streak->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Streak_streak" class="control-group Top_Streak_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top_Streak->streak->PlaceHolder ?>" value="<?php echo $Top_Streak->streak->EditValue ?>"<?php echo $Top_Streak->streak->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Streak_streak" class="control-group Top_Streak_streak">
<span<?php echo $Top_Streak->streak->ViewAttributes() ?>>
<?php echo $Top_Streak->streak->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_streak" name="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="x<?php echo $Top_Streak_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Streak->streak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_Streak_grid->RowIndex ?>_streak" id="o<?php echo $Top_Streak_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Streak->streak->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Top_Streak_grid->ListOptions->Render("body", "right", $Top_Streak_grid->RowCnt);
?>
<script type="text/javascript">
fTop_Streakgrid.UpdateOpts(<?php echo $Top_Streak_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($Top_Streak->CurrentMode == "add" || $Top_Streak->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $Top_Streak_grid->FormKeyCountName ?>" id="<?php echo $Top_Streak_grid->FormKeyCountName ?>" value="<?php echo $Top_Streak_grid->KeyCount ?>">
<?php echo $Top_Streak_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Top_Streak->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $Top_Streak_grid->FormKeyCountName ?>" id="<?php echo $Top_Streak_grid->FormKeyCountName ?>" value="<?php echo $Top_Streak_grid->KeyCount ?>">
<?php echo $Top_Streak_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Top_Streak->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fTop_Streakgrid">
</div>
<?php

// Close recordset
if ($Top_Streak_grid->Recordset)
	$Top_Streak_grid->Recordset->Close();
?>
<?php if ($Top_Streak_grid->ShowOtherOptions) { ?>
<div class="ewGridLowerPanel ewListOtherOptions">
<?php
	foreach ($Top_Streak_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<?php } ?>
</div>
</td></tr></table>
<?php if ($Top_Streak->Export == "") { ?>
<script type="text/javascript">
fTop_Streakgrid.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$Top_Streak_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$Top_Streak_grid->Page_Terminate();
?>
