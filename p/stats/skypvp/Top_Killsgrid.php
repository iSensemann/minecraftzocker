<?php

// Create page object
if (!isset($Top_Kills_grid)) $Top_Kills_grid = new cTop_Kills_grid();

// Page init
$Top_Kills_grid->Page_Init();

// Page main
$Top_Kills_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Top_Kills_grid->Page_Render();
?>
<?php if ($Top_Kills->Export == "") { ?>
<script type="text/javascript">

// Page object
var Top_Kills_grid = new ew_Page("Top_Kills_grid");
Top_Kills_grid.PageID = "grid"; // Page ID
var EW_PAGE_ID = Top_Kills_grid.PageID; // For backward compatibility

// Form object
var fTop_Killsgrid = new ew_Form("fTop_Killsgrid");
fTop_Killsgrid.FormKeyCountName = '<?php echo $Top_Kills_grid->FormKeyCountName ?>';

// Validate form
fTop_Killsgrid.Validate = function() {
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
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->division->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_division");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Kills->division->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Points");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->Points->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_Points");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Kills->Points->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_skins");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->skins->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_player");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->player->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_kills");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->kills->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_kills");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Kills->kills->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_deaths");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->deaths->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_deaths");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Kills->deaths->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_streak");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top_Kills->streak->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_streak");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top_Kills->streak->FldErrMsg()) ?>");

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
fTop_Killsgrid.EmptyRow = function(infix) {
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
fTop_Killsgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fTop_Killsgrid.ValidateRequired = true;
<?php } else { ?>
fTop_Killsgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php if ($Top_Kills->getCurrentMasterTable() == "" && $Top_Kills_grid->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $Top_Kills_grid->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
if ($Top_Kills->CurrentAction == "gridadd") {
	if ($Top_Kills->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$Top_Kills_grid->TotalRecs = $Top_Kills->SelectRecordCount();
			$Top_Kills_grid->Recordset = $Top_Kills_grid->LoadRecordset($Top_Kills_grid->StartRec-1, $Top_Kills_grid->DisplayRecs);
		} else {
			if ($Top_Kills_grid->Recordset = $Top_Kills_grid->LoadRecordset())
				$Top_Kills_grid->TotalRecs = $Top_Kills_grid->Recordset->RecordCount();
		}
		$Top_Kills_grid->StartRec = 1;
		$Top_Kills_grid->DisplayRecs = $Top_Kills_grid->TotalRecs;
	} else {
		$Top_Kills->CurrentFilter = "0=1";
		$Top_Kills_grid->StartRec = 1;
		$Top_Kills_grid->DisplayRecs = $Top_Kills->GridAddRowCount;
	}
	$Top_Kills_grid->TotalRecs = $Top_Kills_grid->DisplayRecs;
	$Top_Kills_grid->StopRec = $Top_Kills_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Top_Kills_grid->TotalRecs = $Top_Kills->SelectRecordCount();
	} else {
		if ($Top_Kills_grid->Recordset = $Top_Kills_grid->LoadRecordset())
			$Top_Kills_grid->TotalRecs = $Top_Kills_grid->Recordset->RecordCount();
	}
	$Top_Kills_grid->StartRec = 1;
	$Top_Kills_grid->DisplayRecs = $Top_Kills_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$Top_Kills_grid->Recordset = $Top_Kills_grid->LoadRecordset($Top_Kills_grid->StartRec-1, $Top_Kills_grid->DisplayRecs);
}
$Top_Kills_grid->RenderOtherOptions();
?>
<?php $Top_Kills_grid->ShowPageHeader(); ?>
<?php
$Top_Kills_grid->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="fTop_Killsgrid" class="ewForm form-horizontal">
<div id="gmp_Top_Kills" class="ewGridMiddlePanel">
<table id="tbl_Top_Killsgrid" class="ewTable ewTableSeparate">
<?php echo $Top_Kills->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$Top_Kills_grid->RenderListOptions();

// Render list options (header, left)
$Top_Kills_grid->ListOptions->Render("header", "left");
?>
<?php if ($Top_Kills->division->Visible) { // division ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->division) == "") { ?>
		<td><div id="elh_Top_Kills_division" class="Top_Kills_division"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->division->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_division" class="Top_Kills_division">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->division->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->division->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->division->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Kills->Points->Visible) { // Points ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->Points) == "") { ?>
		<td><div id="elh_Top_Kills_Points" class="Top_Kills_Points"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->Points->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_Points" class="Top_Kills_Points">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->Points->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->Points->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->Points->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Kills->skins->Visible) { // skins ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->skins) == "") { ?>
		<td><div id="elh_Top_Kills_skins" class="Top_Kills_skins"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->skins->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_skins" class="Top_Kills_skins">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->skins->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->skins->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->skins->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Kills->player->Visible) { // player ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->player) == "") { ?>
		<td><div id="elh_Top_Kills_player" class="Top_Kills_player"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->player->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_player" class="Top_Kills_player">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->player->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->player->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->player->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Kills->kills->Visible) { // kills ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->kills) == "") { ?>
		<td><div id="elh_Top_Kills_kills" class="Top_Kills_kills"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->kills->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_kills" class="Top_Kills_kills">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->kills->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->kills->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->kills->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Kills->deaths->Visible) { // deaths ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->deaths) == "") { ?>
		<td><div id="elh_Top_Kills_deaths" class="Top_Kills_deaths"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->deaths->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_deaths" class="Top_Kills_deaths">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->deaths->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->deaths->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->deaths->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php if ($Top_Kills->streak->Visible) { // streak ?>
	<?php if ($Top_Kills->SortUrl($Top_Kills->streak) == "") { ?>
		<td><div id="elh_Top_Kills_streak" class="Top_Kills_streak"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top_Kills->streak->FldCaption() ?></div></div></td>
	<?php } else { ?>
		<td><div><div id="elh_Top_Kills_streak" class="Top_Kills_streak">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $Top_Kills->streak->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top_Kills->streak->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top_Kills->streak->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></td>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$Top_Kills_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$Top_Kills_grid->StartRec = 1;
$Top_Kills_grid->StopRec = $Top_Kills_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($Top_Kills_grid->FormKeyCountName) && ($Top_Kills->CurrentAction == "gridadd" || $Top_Kills->CurrentAction == "gridedit" || $Top_Kills->CurrentAction == "F")) {
		$Top_Kills_grid->KeyCount = $objForm->GetValue($Top_Kills_grid->FormKeyCountName);
		$Top_Kills_grid->StopRec = $Top_Kills_grid->StartRec + $Top_Kills_grid->KeyCount - 1;
	}
}
$Top_Kills_grid->RecCnt = $Top_Kills_grid->StartRec - 1;
if ($Top_Kills_grid->Recordset && !$Top_Kills_grid->Recordset->EOF) {
	$Top_Kills_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $Top_Kills_grid->StartRec > 1)
		$Top_Kills_grid->Recordset->Move($Top_Kills_grid->StartRec - 1);
} elseif (!$Top_Kills->AllowAddDeleteRow && $Top_Kills_grid->StopRec == 0) {
	$Top_Kills_grid->StopRec = $Top_Kills->GridAddRowCount;
}

// Initialize aggregate
$Top_Kills->RowType = EW_ROWTYPE_AGGREGATEINIT;
$Top_Kills->ResetAttrs();
$Top_Kills_grid->RenderRow();
if ($Top_Kills->CurrentAction == "gridadd")
	$Top_Kills_grid->RowIndex = 0;
if ($Top_Kills->CurrentAction == "gridedit")
	$Top_Kills_grid->RowIndex = 0;
while ($Top_Kills_grid->RecCnt < $Top_Kills_grid->StopRec) {
	$Top_Kills_grid->RecCnt++;
	if (intval($Top_Kills_grid->RecCnt) >= intval($Top_Kills_grid->StartRec)) {
		$Top_Kills_grid->RowCnt++;
		if ($Top_Kills->CurrentAction == "gridadd" || $Top_Kills->CurrentAction == "gridedit" || $Top_Kills->CurrentAction == "F") {
			$Top_Kills_grid->RowIndex++;
			$objForm->Index = $Top_Kills_grid->RowIndex;
			if ($objForm->HasValue($Top_Kills_grid->FormActionName))
				$Top_Kills_grid->RowAction = strval($objForm->GetValue($Top_Kills_grid->FormActionName));
			elseif ($Top_Kills->CurrentAction == "gridadd")
				$Top_Kills_grid->RowAction = "insert";
			else
				$Top_Kills_grid->RowAction = "";
		}

		// Set up key count
		$Top_Kills_grid->KeyCount = $Top_Kills_grid->RowIndex;

		// Init row class and style
		$Top_Kills->ResetAttrs();
		$Top_Kills->CssClass = "";
		if ($Top_Kills->CurrentAction == "gridadd") {
			if ($Top_Kills->CurrentMode == "copy") {
				$Top_Kills_grid->LoadRowValues($Top_Kills_grid->Recordset); // Load row values
				$Top_Kills_grid->SetRecordKey($Top_Kills_grid->RowOldKey, $Top_Kills_grid->Recordset); // Set old record key
			} else {
				$Top_Kills_grid->LoadDefaultValues(); // Load default values
				$Top_Kills_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Top_Kills_grid->LoadRowValues($Top_Kills_grid->Recordset); // Load row values
		}
		$Top_Kills->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($Top_Kills->CurrentAction == "gridadd") // Grid add
			$Top_Kills->RowType = EW_ROWTYPE_ADD; // Render add
		if ($Top_Kills->CurrentAction == "gridadd" && $Top_Kills->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$Top_Kills_grid->RestoreCurrentRowFormValues($Top_Kills_grid->RowIndex); // Restore form values
		if ($Top_Kills->CurrentAction == "gridedit") { // Grid edit
			if ($Top_Kills->EventCancelled) {
				$Top_Kills_grid->RestoreCurrentRowFormValues($Top_Kills_grid->RowIndex); // Restore form values
			}
			if ($Top_Kills_grid->RowAction == "insert")
				$Top_Kills->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$Top_Kills->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($Top_Kills->CurrentAction == "gridedit" && ($Top_Kills->RowType == EW_ROWTYPE_EDIT || $Top_Kills->RowType == EW_ROWTYPE_ADD) && $Top_Kills->EventCancelled) // Update failed
			$Top_Kills_grid->RestoreCurrentRowFormValues($Top_Kills_grid->RowIndex); // Restore form values
		if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) // Edit row
			$Top_Kills_grid->EditRowCnt++;
		if ($Top_Kills->CurrentAction == "F") // Confirm row
			$Top_Kills_grid->RestoreCurrentRowFormValues($Top_Kills_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Top_Kills->RowAttrs = array_merge($Top_Kills->RowAttrs, array('data-rowindex'=>$Top_Kills_grid->RowCnt, 'id'=>'r' . $Top_Kills_grid->RowCnt . '_Top_Kills', 'data-rowtype'=>$Top_Kills->RowType));

		// Render row
		$Top_Kills_grid->RenderRow();

		// Render list options
		$Top_Kills_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Top_Kills_grid->RowAction <> "delete" && $Top_Kills_grid->RowAction <> "insertdelete" && !($Top_Kills_grid->RowAction == "insert" && $Top_Kills->CurrentAction == "F" && $Top_Kills_grid->EmptyRow())) {
?>
	<tr<?php echo $Top_Kills->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Top_Kills_grid->ListOptions->Render("body", "left", $Top_Kills_grid->RowCnt);
?>
	<?php if ($Top_Kills->division->Visible) { // division ?>
		<td<?php echo $Top_Kills->division->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_division" class="control-group Top_Kills_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_Kills_grid->RowIndex ?>_division" id="x<?php echo $Top_Kills_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top_Kills->division->PlaceHolder ?>" value="<?php echo $Top_Kills->division->EditValue ?>"<?php echo $Top_Kills->division->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_division" name="o<?php echo $Top_Kills_grid->RowIndex ?>_division" id="o<?php echo $Top_Kills_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Kills->division->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_division" class="control-group Top_Kills_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_Kills_grid->RowIndex ?>_division" id="x<?php echo $Top_Kills_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top_Kills->division->PlaceHolder ?>" value="<?php echo $Top_Kills->division->EditValue ?>"<?php echo $Top_Kills->division->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->division->ViewAttributes() ?>>
<?php echo $Top_Kills->division->ListViewValue() ?></span>
<input type="hidden" data-field="x_division" name="x<?php echo $Top_Kills_grid->RowIndex ?>_division" id="x<?php echo $Top_Kills_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Kills->division->FormValue) ?>">
<input type="hidden" data-field="x_division" name="o<?php echo $Top_Kills_grid->RowIndex ?>_division" id="o<?php echo $Top_Kills_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Kills->division->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-field="x_id" name="x<?php echo $Top_Kills_grid->RowIndex ?>_id" id="x<?php echo $Top_Kills_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($Top_Kills->id->CurrentValue) ?>">
<input type="hidden" data-field="x_id" name="o<?php echo $Top_Kills_grid->RowIndex ?>_id" id="o<?php echo $Top_Kills_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($Top_Kills->id->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT || $Top_Kills->CurrentMode == "edit") { ?>
<input type="hidden" data-field="x_id" name="x<?php echo $Top_Kills_grid->RowIndex ?>_id" id="x<?php echo $Top_Kills_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($Top_Kills->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($Top_Kills->Points->Visible) { // Points ?>
		<td<?php echo $Top_Kills->Points->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_Points" class="control-group Top_Kills_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top_Kills->Points->PlaceHolder ?>" value="<?php echo $Top_Kills->Points->EditValue ?>"<?php echo $Top_Kills->Points->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="o<?php echo $Top_Kills_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Kills->Points->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_Points" class="control-group Top_Kills_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top_Kills->Points->PlaceHolder ?>" value="<?php echo $Top_Kills->Points->EditValue ?>"<?php echo $Top_Kills->Points->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->Points->ViewAttributes() ?>>
<?php echo $Top_Kills->Points->ListViewValue() ?></span>
<input type="hidden" data-field="x_Points" name="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Kills->Points->FormValue) ?>">
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="o<?php echo $Top_Kills_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Kills->Points->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Kills->skins->Visible) { // skins ?>
		<td<?php echo $Top_Kills->skins->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_skins" class="control-group Top_Kills_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top_Kills->skins->PlaceHolder ?>" value="<?php echo $Top_Kills->skins->EditValue ?>"<?php echo $Top_Kills->skins->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="o<?php echo $Top_Kills_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Kills->skins->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_skins" class="control-group Top_Kills_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top_Kills->skins->PlaceHolder ?>" value="<?php echo $Top_Kills->skins->EditValue ?>"<?php echo $Top_Kills->skins->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->skins->ViewAttributes() ?>>
<?php echo $Top_Kills->skins->ListViewValue() ?></span>
<input type="hidden" data-field="x_skins" name="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Kills->skins->FormValue) ?>">
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="o<?php echo $Top_Kills_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Kills->skins->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Kills->player->Visible) { // player ?>
		<td<?php echo $Top_Kills->player->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_player" class="control-group Top_Kills_player">
<input type="text" data-field="x_player" name="x<?php echo $Top_Kills_grid->RowIndex ?>_player" id="x<?php echo $Top_Kills_grid->RowIndex ?>_player" size="30" maxlength="42" placeholder="<?php echo $Top_Kills->player->PlaceHolder ?>" value="<?php echo $Top_Kills->player->EditValue ?>"<?php echo $Top_Kills->player->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_player" name="o<?php echo $Top_Kills_grid->RowIndex ?>_player" id="o<?php echo $Top_Kills_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Kills->player->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_player" class="control-group Top_Kills_player">
<input type="text" data-field="x_player" name="x<?php echo $Top_Kills_grid->RowIndex ?>_player" id="x<?php echo $Top_Kills_grid->RowIndex ?>_player" size="30" maxlength="42" placeholder="<?php echo $Top_Kills->player->PlaceHolder ?>" value="<?php echo $Top_Kills->player->EditValue ?>"<?php echo $Top_Kills->player->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->player->ViewAttributes() ?>>
<?php echo $Top_Kills->player->ListViewValue() ?></span>
<input type="hidden" data-field="x_player" name="x<?php echo $Top_Kills_grid->RowIndex ?>_player" id="x<?php echo $Top_Kills_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Kills->player->FormValue) ?>">
<input type="hidden" data-field="x_player" name="o<?php echo $Top_Kills_grid->RowIndex ?>_player" id="o<?php echo $Top_Kills_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Kills->player->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Kills->kills->Visible) { // kills ?>
		<td<?php echo $Top_Kills->kills->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_kills" class="control-group Top_Kills_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top_Kills->kills->PlaceHolder ?>" value="<?php echo $Top_Kills->kills->EditValue ?>"<?php echo $Top_Kills->kills->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="o<?php echo $Top_Kills_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Kills->kills->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_kills" class="control-group Top_Kills_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top_Kills->kills->PlaceHolder ?>" value="<?php echo $Top_Kills->kills->EditValue ?>"<?php echo $Top_Kills->kills->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->kills->ViewAttributes() ?>>
<?php echo $Top_Kills->kills->ListViewValue() ?></span>
<input type="hidden" data-field="x_kills" name="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Kills->kills->FormValue) ?>">
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="o<?php echo $Top_Kills_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Kills->kills->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Kills->deaths->Visible) { // deaths ?>
		<td<?php echo $Top_Kills->deaths->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_deaths" class="control-group Top_Kills_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top_Kills->deaths->PlaceHolder ?>" value="<?php echo $Top_Kills->deaths->EditValue ?>"<?php echo $Top_Kills->deaths->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="o<?php echo $Top_Kills_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Kills->deaths->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_deaths" class="control-group Top_Kills_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top_Kills->deaths->PlaceHolder ?>" value="<?php echo $Top_Kills->deaths->EditValue ?>"<?php echo $Top_Kills->deaths->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->deaths->ViewAttributes() ?>>
<?php echo $Top_Kills->deaths->ListViewValue() ?></span>
<input type="hidden" data-field="x_deaths" name="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Kills->deaths->FormValue) ?>">
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="o<?php echo $Top_Kills_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Kills->deaths->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($Top_Kills->streak->Visible) { // streak ?>
		<td<?php echo $Top_Kills->streak->CellAttributes() ?>>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_streak" class="control-group Top_Kills_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top_Kills->streak->PlaceHolder ?>" value="<?php echo $Top_Kills->streak->EditValue ?>"<?php echo $Top_Kills->streak->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="o<?php echo $Top_Kills_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Kills->streak->OldValue) ?>">
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_Kills_grid->RowCnt ?>_Top_Kills_streak" class="control-group Top_Kills_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top_Kills->streak->PlaceHolder ?>" value="<?php echo $Top_Kills->streak->EditValue ?>"<?php echo $Top_Kills->streak->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top_Kills->streak->ViewAttributes() ?>>
<?php echo $Top_Kills->streak->ListViewValue() ?></span>
<input type="hidden" data-field="x_streak" name="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Kills->streak->FormValue) ?>">
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="o<?php echo $Top_Kills_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Kills->streak->OldValue) ?>">
<?php } ?>
<a id="<?php echo $Top_Kills_grid->PageObjName . "_row_" . $Top_Kills_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$Top_Kills_grid->ListOptions->Render("body", "right", $Top_Kills_grid->RowCnt);
?>
	</tr>
<?php if ($Top_Kills->RowType == EW_ROWTYPE_ADD || $Top_Kills->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fTop_Killsgrid.UpdateOpts(<?php echo $Top_Kills_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($Top_Kills->CurrentAction <> "gridadd" || $Top_Kills->CurrentMode == "copy")
		if (!$Top_Kills_grid->Recordset->EOF) $Top_Kills_grid->Recordset->MoveNext();
}
?>
<?php
	if ($Top_Kills->CurrentMode == "add" || $Top_Kills->CurrentMode == "copy" || $Top_Kills->CurrentMode == "edit") {
		$Top_Kills_grid->RowIndex = '$rowindex$';
		$Top_Kills_grid->LoadDefaultValues();

		// Set row properties
		$Top_Kills->ResetAttrs();
		$Top_Kills->RowAttrs = array_merge($Top_Kills->RowAttrs, array('data-rowindex'=>$Top_Kills_grid->RowIndex, 'id'=>'r0_Top_Kills', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($Top_Kills->RowAttrs["class"], "ewTemplate");
		$Top_Kills->RowType = EW_ROWTYPE_ADD;

		// Render row
		$Top_Kills_grid->RenderRow();

		// Render list options
		$Top_Kills_grid->RenderListOptions();
		$Top_Kills_grid->StartRowCnt = 0;
?>
	<tr<?php echo $Top_Kills->RowAttributes() ?>>
<?php

// Render list options (body, left)
$Top_Kills_grid->ListOptions->Render("body", "left", $Top_Kills_grid->RowIndex);
?>
	<?php if ($Top_Kills->division->Visible) { // division ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_division" class="control-group Top_Kills_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_Kills_grid->RowIndex ?>_division" id="x<?php echo $Top_Kills_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top_Kills->division->PlaceHolder ?>" value="<?php echo $Top_Kills->division->EditValue ?>"<?php echo $Top_Kills->division->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_division" class="control-group Top_Kills_division">
<span<?php echo $Top_Kills->division->ViewAttributes() ?>>
<?php echo $Top_Kills->division->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_division" name="x<?php echo $Top_Kills_grid->RowIndex ?>_division" id="x<?php echo $Top_Kills_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Kills->division->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_division" name="o<?php echo $Top_Kills_grid->RowIndex ?>_division" id="o<?php echo $Top_Kills_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top_Kills->division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Kills->Points->Visible) { // Points ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_Points" class="control-group Top_Kills_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top_Kills->Points->PlaceHolder ?>" value="<?php echo $Top_Kills->Points->EditValue ?>"<?php echo $Top_Kills->Points->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_Points" class="control-group Top_Kills_Points">
<span<?php echo $Top_Kills->Points->ViewAttributes() ?>>
<?php echo $Top_Kills->Points->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_Points" name="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="x<?php echo $Top_Kills_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Kills->Points->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_Kills_grid->RowIndex ?>_Points" id="o<?php echo $Top_Kills_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top_Kills->Points->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Kills->skins->Visible) { // skins ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_skins" class="control-group Top_Kills_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top_Kills->skins->PlaceHolder ?>" value="<?php echo $Top_Kills->skins->EditValue ?>"<?php echo $Top_Kills->skins->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_skins" class="control-group Top_Kills_skins">
<span<?php echo $Top_Kills->skins->ViewAttributes() ?>>
<?php echo $Top_Kills->skins->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_skins" name="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="x<?php echo $Top_Kills_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Kills->skins->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_Kills_grid->RowIndex ?>_skins" id="o<?php echo $Top_Kills_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top_Kills->skins->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Kills->player->Visible) { // player ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_player" class="control-group Top_Kills_player">
<input type="text" data-field="x_player" name="x<?php echo $Top_Kills_grid->RowIndex ?>_player" id="x<?php echo $Top_Kills_grid->RowIndex ?>_player" size="30" maxlength="42" placeholder="<?php echo $Top_Kills->player->PlaceHolder ?>" value="<?php echo $Top_Kills->player->EditValue ?>"<?php echo $Top_Kills->player->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_player" class="control-group Top_Kills_player">
<span<?php echo $Top_Kills->player->ViewAttributes() ?>>
<?php echo $Top_Kills->player->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_player" name="x<?php echo $Top_Kills_grid->RowIndex ?>_player" id="x<?php echo $Top_Kills_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Kills->player->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_player" name="o<?php echo $Top_Kills_grid->RowIndex ?>_player" id="o<?php echo $Top_Kills_grid->RowIndex ?>_player" value="<?php echo ew_HtmlEncode($Top_Kills->player->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Kills->kills->Visible) { // kills ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_kills" class="control-group Top_Kills_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top_Kills->kills->PlaceHolder ?>" value="<?php echo $Top_Kills->kills->EditValue ?>"<?php echo $Top_Kills->kills->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_kills" class="control-group Top_Kills_kills">
<span<?php echo $Top_Kills->kills->ViewAttributes() ?>>
<?php echo $Top_Kills->kills->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_kills" name="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="x<?php echo $Top_Kills_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Kills->kills->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_Kills_grid->RowIndex ?>_kills" id="o<?php echo $Top_Kills_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top_Kills->kills->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Kills->deaths->Visible) { // deaths ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_deaths" class="control-group Top_Kills_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top_Kills->deaths->PlaceHolder ?>" value="<?php echo $Top_Kills->deaths->EditValue ?>"<?php echo $Top_Kills->deaths->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_deaths" class="control-group Top_Kills_deaths">
<span<?php echo $Top_Kills->deaths->ViewAttributes() ?>>
<?php echo $Top_Kills->deaths->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_deaths" name="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="x<?php echo $Top_Kills_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Kills->deaths->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_Kills_grid->RowIndex ?>_deaths" id="o<?php echo $Top_Kills_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top_Kills->deaths->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($Top_Kills->streak->Visible) { // streak ?>
		<td>
<?php if ($Top_Kills->CurrentAction <> "F") { ?>
<span id="el$rowindex$_Top_Kills_streak" class="control-group Top_Kills_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top_Kills->streak->PlaceHolder ?>" value="<?php echo $Top_Kills->streak->EditValue ?>"<?php echo $Top_Kills->streak->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_Top_Kills_streak" class="control-group Top_Kills_streak">
<span<?php echo $Top_Kills->streak->ViewAttributes() ?>>
<?php echo $Top_Kills->streak->ViewValue ?></span>
</span>
<input type="hidden" data-field="x_streak" name="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="x<?php echo $Top_Kills_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Kills->streak->FormValue) ?>">
<?php } ?>
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_Kills_grid->RowIndex ?>_streak" id="o<?php echo $Top_Kills_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top_Kills->streak->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$Top_Kills_grid->ListOptions->Render("body", "right", $Top_Kills_grid->RowCnt);
?>
<script type="text/javascript">
fTop_Killsgrid.UpdateOpts(<?php echo $Top_Kills_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($Top_Kills->CurrentMode == "add" || $Top_Kills->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $Top_Kills_grid->FormKeyCountName ?>" id="<?php echo $Top_Kills_grid->FormKeyCountName ?>" value="<?php echo $Top_Kills_grid->KeyCount ?>">
<?php echo $Top_Kills_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Top_Kills->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $Top_Kills_grid->FormKeyCountName ?>" id="<?php echo $Top_Kills_grid->FormKeyCountName ?>" value="<?php echo $Top_Kills_grid->KeyCount ?>">
<?php echo $Top_Kills_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Top_Kills->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fTop_Killsgrid">
</div>
<?php

// Close recordset
if ($Top_Kills_grid->Recordset)
	$Top_Kills_grid->Recordset->Close();
?>
<?php if ($Top_Kills_grid->ShowOtherOptions) { ?>
<div class="ewGridLowerPanel ewListOtherOptions">
<?php
	foreach ($Top_Kills_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<?php } ?>
</div>
</td></tr></table>
<?php if ($Top_Kills->Export == "") { ?>
<script type="text/javascript">
fTop_Killsgrid.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$Top_Kills_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$Top_Kills_grid->Page_Terminate();
?>
