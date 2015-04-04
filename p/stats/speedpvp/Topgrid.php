<?php

// Create page object
if (!isset($Top_grid)) $Top_grid = new cTop_grid();

// Page init
$Top_grid->Page_Init();

// Page main
$Top_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Top_grid->Page_Render();
?>
<?php if ($Top->Export == "") { ?>
<script type="text/javascript">

// Page object
var Top_grid = new ew_Page("Top_grid");
Top_grid.PageID = "grid"; // Page ID
var EW_PAGE_ID = Top_grid.PageID; // For backward compatibility

// Form object
var fTopgrid = new ew_Form("fTopgrid");
fTopgrid.FormKeyCountName = '<?php echo $Top_grid->FormKeyCountName ?>';

// Validate form
fTopgrid.Validate = function() {
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
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->division->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_division");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top->division->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Points");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->Points->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_Points");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top->Points->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_skins");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->skins->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_skins");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top->skins->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_name");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->name->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_kills");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->kills->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_kills");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top->kills->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_deaths");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->deaths->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_deaths");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top->deaths->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_streak");
			if (elm && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($Top->streak->FldCaption()) ?>");
			elm = this.GetElements("x" + infix + "_streak");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($Top->streak->FldErrMsg()) ?>");

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
fTopgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "division", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Points", false)) return false;
	if (ew_ValueChanged(fobj, infix, "skins", false)) return false;
	if (ew_ValueChanged(fobj, infix, "name", false)) return false;
	if (ew_ValueChanged(fobj, infix, "kills", false)) return false;
	if (ew_ValueChanged(fobj, infix, "deaths", false)) return false;
	if (ew_ValueChanged(fobj, infix, "streak", false)) return false;
	return true;
}

// Form_CustomValidate event
fTopgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fTopgrid.ValidateRequired = true;
<?php } else { ?>
fTopgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php if ($Top_grid->ExportOptions->Visible()) { ?>
<div class="ewListExportOptions"><?php $Top_grid->ExportOptions->Render("body") ?></div>
<?php } ?>
<?php
if ($Top->CurrentAction == "gridadd") {
	if ($Top->CurrentMode == "copy") {
		$bSelectLimit = EW_SELECT_LIMIT;
		if ($bSelectLimit) {
			$Top_grid->TotalRecs = $Top->SelectRecordCount();
			$Top_grid->Recordset = $Top_grid->LoadRecordset($Top_grid->StartRec-1, $Top_grid->DisplayRecs);
		} else {
			if ($Top_grid->Recordset = $Top_grid->LoadRecordset())
				$Top_grid->TotalRecs = $Top_grid->Recordset->RecordCount();
		}
		$Top_grid->StartRec = 1;
		$Top_grid->DisplayRecs = $Top_grid->TotalRecs;
	} else {
		$Top->CurrentFilter = "0=1";
		$Top_grid->StartRec = 1;
		$Top_grid->DisplayRecs = $Top->GridAddRowCount;
	}
	$Top_grid->TotalRecs = $Top_grid->DisplayRecs;
	$Top_grid->StopRec = $Top_grid->DisplayRecs;
} else {
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$Top_grid->TotalRecs = $Top->SelectRecordCount();
	} else {
		if ($Top_grid->Recordset = $Top_grid->LoadRecordset())
			$Top_grid->TotalRecs = $Top_grid->Recordset->RecordCount();
	}
	$Top_grid->StartRec = 1;
	$Top_grid->DisplayRecs = $Top_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$Top_grid->Recordset = $Top_grid->LoadRecordset($Top_grid->StartRec-1, $Top_grid->DisplayRecs);
}
$Top_grid->RenderOtherOptions();
?>
<?php $Top_grid->ShowPageHeader(); ?>
<?php
$Top_grid->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div id="fTopgrid" class="ewForm form-horizontal">
<?php if ($Top_grid->ShowOtherOptions) { ?>
<div class="ewGridUpperPanel ewListOtherOptions">
<?php
	foreach ($Top_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<?php } ?>
<div id="gmp_Top" class="ewGridMiddlePanel">
<table class="ewMultiColumnTable">
<?php
$Top_grid->StartRec = 1;
$Top_grid->StopRec = $Top_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($Top_grid->FormKeyCountName) && ($Top->CurrentAction == "gridadd" || $Top->CurrentAction == "gridedit" || $Top->CurrentAction == "F")) {
		$Top_grid->KeyCount = $objForm->GetValue($Top_grid->FormKeyCountName);
		$Top_grid->StopRec = $Top_grid->StartRec + $Top_grid->KeyCount - 1;
	}
}
$Top_grid->RecCnt = $Top_grid->StartRec - 1;
if ($Top_grid->Recordset && !$Top_grid->Recordset->EOF) {
	$Top_grid->Recordset->MoveFirst();
	if (!$bSelectLimit && $Top_grid->StartRec > 1)
		$Top_grid->Recordset->Move($Top_grid->StartRec - 1);
} elseif (!$Top->AllowAddDeleteRow && $Top_grid->StopRec == 0) {
	$Top_grid->StopRec = $Top->GridAddRowCount;
}
if ($Top->CurrentAction == "gridadd")
	$Top_grid->RowIndex = 0;
if ($Top->CurrentAction == "gridedit")
	$Top_grid->RowIndex = 0;
while ($Top_grid->RecCnt < $Top_grid->StopRec) {
	$Top_grid->RecCnt++;
	if (intval($Top_grid->RecCnt) >= intval($Top_grid->StartRec)) {
		$Top_grid->RowCnt++;
		$Top_grid->ColCnt++;
		if ($Top_grid->ColCnt > $Top_grid->RecPerRow)
			$Top_grid->ColCnt = 1;
		if ($Top->CurrentAction == "gridadd" || $Top->CurrentAction == "gridedit" || $Top->CurrentAction == "F") {
			$Top_grid->RowIndex++;
			$objForm->Index = $Top_grid->RowIndex;
			if ($objForm->HasValue($Top_grid->FormActionName))
				$Top_grid->RowAction = strval($objForm->GetValue($Top_grid->FormActionName));
			elseif ($Top->CurrentAction == "gridadd")
				$Top_grid->RowAction = "insert";
			else
				$Top_grid->RowAction = "";
		}

		// Set up key count
		$Top_grid->KeyCount = $Top_grid->RowIndex;

		// Init row class and style
		$Top->ResetAttrs();
		$Top->CssClass = "";
		if ($Top->CurrentAction == "gridadd") {
			if ($Top->CurrentMode == "copy") {
				$Top_grid->LoadRowValues($Top_grid->Recordset); // Load row values
				$Top_grid->SetRecordKey($Top_grid->RowOldKey, $Top_grid->Recordset); // Set old record key
			} else {
				$Top_grid->LoadDefaultValues(); // Load default values
				$Top_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$Top_grid->LoadRowValues($Top_grid->Recordset); // Load row values
		}
		$Top->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($Top->CurrentAction == "gridadd") // Grid add
			$Top->RowType = EW_ROWTYPE_ADD; // Render add
		if ($Top->CurrentAction == "gridadd" && $Top->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$Top_grid->RestoreCurrentRowFormValues($Top_grid->RowIndex); // Restore form values
		if ($Top->CurrentAction == "gridedit") { // Grid edit
			if ($Top->EventCancelled) {
				$Top_grid->RestoreCurrentRowFormValues($Top_grid->RowIndex); // Restore form values
			}
			if ($Top_grid->RowAction == "insert")
				$Top->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$Top->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($Top->CurrentAction == "gridedit" && ($Top->RowType == EW_ROWTYPE_EDIT || $Top->RowType == EW_ROWTYPE_ADD) && $Top->EventCancelled) // Update failed
			$Top_grid->RestoreCurrentRowFormValues($Top_grid->RowIndex); // Restore form values
		if ($Top->RowType == EW_ROWTYPE_EDIT) // Edit row
			$Top_grid->EditRowCnt++;
		if ($Top->CurrentAction == "F") // Confirm row
			$Top_grid->RestoreCurrentRowFormValues($Top_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$Top->RowAttrs = array_merge($Top->RowAttrs, array('data-rowindex'=>$Top_grid->RowCnt, 'id'=>'r' . $Top_grid->RowCnt . '_Top', 'data-rowtype'=>$Top->RowType));

		// Render row
		$Top_grid->RenderRow();

		// Render list options
		$Top_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($Top_grid->RowAction <> "delete" && $Top_grid->RowAction <> "insertdelete" && !($Top_grid->RowAction == "insert" && $Top->CurrentAction == "F" && $Top_grid->EmptyRow())) {
?>
<?php if ($Top_grid->ColCnt == 1) { ?>
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
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_division" class="control-group Top_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_grid->RowIndex ?>_division" id="x<?php echo $Top_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top->division->PlaceHolder ?>" value="<?php echo $Top->division->EditValue ?>"<?php echo $Top->division->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_division" name="o<?php echo $Top_grid->RowIndex ?>_division" id="o<?php echo $Top_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top->division->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_division" class="control-group Top_division">
<input type="text" data-field="x_division" name="x<?php echo $Top_grid->RowIndex ?>_division" id="x<?php echo $Top_grid->RowIndex ?>_division" size="30" placeholder="<?php echo $Top->division->PlaceHolder ?>" value="<?php echo $Top->division->EditValue ?>"<?php echo $Top->division->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->division->ViewAttributes() ?>>
<?php echo $Top->division->ListViewValue() ?></span>
<input type="hidden" data-field="x_division" name="x<?php echo $Top_grid->RowIndex ?>_division" id="x<?php echo $Top_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top->division->FormValue) ?>">
<input type="hidden" data-field="x_division" name="o<?php echo $Top_grid->RowIndex ?>_division" id="o<?php echo $Top_grid->RowIndex ?>_division" value="<?php echo ew_HtmlEncode($Top->division->OldValue) ?>">
<?php } ?>
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
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_Points" class="control-group Top_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_grid->RowIndex ?>_Points" id="x<?php echo $Top_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top->Points->PlaceHolder ?>" value="<?php echo $Top->Points->EditValue ?>"<?php echo $Top->Points->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_grid->RowIndex ?>_Points" id="o<?php echo $Top_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top->Points->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_Points" class="control-group Top_Points">
<input type="text" data-field="x_Points" name="x<?php echo $Top_grid->RowIndex ?>_Points" id="x<?php echo $Top_grid->RowIndex ?>_Points" size="30" placeholder="<?php echo $Top->Points->PlaceHolder ?>" value="<?php echo $Top->Points->EditValue ?>"<?php echo $Top->Points->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->Points->ViewAttributes() ?>>
<?php echo $Top->Points->ListViewValue() ?></span>
<input type="hidden" data-field="x_Points" name="x<?php echo $Top_grid->RowIndex ?>_Points" id="x<?php echo $Top_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top->Points->FormValue) ?>">
<input type="hidden" data-field="x_Points" name="o<?php echo $Top_grid->RowIndex ?>_Points" id="o<?php echo $Top_grid->RowIndex ?>_Points" value="<?php echo ew_HtmlEncode($Top->Points->OldValue) ?>">
<?php } ?>
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
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_skins" class="control-group Top_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_grid->RowIndex ?>_skins" id="x<?php echo $Top_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top->skins->PlaceHolder ?>" value="<?php echo $Top->skins->EditValue ?>"<?php echo $Top->skins->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_grid->RowIndex ?>_skins" id="o<?php echo $Top_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top->skins->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_skins" class="control-group Top_skins">
<input type="text" data-field="x_skins" name="x<?php echo $Top_grid->RowIndex ?>_skins" id="x<?php echo $Top_grid->RowIndex ?>_skins" size="30" maxlength="42" placeholder="<?php echo $Top->skins->PlaceHolder ?>" value="<?php echo $Top->skins->EditValue ?>"<?php echo $Top->skins->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->skins->ViewAttributes() ?>>
<?php echo $Top->skins->ListViewValue() ?></span>
<input type="hidden" data-field="x_skins" name="x<?php echo $Top_grid->RowIndex ?>_skins" id="x<?php echo $Top_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top->skins->FormValue) ?>">
<input type="hidden" data-field="x_skins" name="o<?php echo $Top_grid->RowIndex ?>_skins" id="o<?php echo $Top_grid->RowIndex ?>_skins" value="<?php echo ew_HtmlEncode($Top->skins->OldValue) ?>">
<?php } ?>
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
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_name" class="control-group Top_name">
<input type="text" data-field="x_name" name="x<?php echo $Top_grid->RowIndex ?>_name" id="x<?php echo $Top_grid->RowIndex ?>_name" size="30" maxlength="42" placeholder="<?php echo $Top->name->PlaceHolder ?>" value="<?php echo $Top->name->EditValue ?>"<?php echo $Top->name->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_name" name="o<?php echo $Top_grid->RowIndex ?>_name" id="o<?php echo $Top_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($Top->name->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_name" class="control-group Top_name">
<input type="text" data-field="x_name" name="x<?php echo $Top_grid->RowIndex ?>_name" id="x<?php echo $Top_grid->RowIndex ?>_name" size="30" maxlength="42" placeholder="<?php echo $Top->name->PlaceHolder ?>" value="<?php echo $Top->name->EditValue ?>"<?php echo $Top->name->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->name->ViewAttributes() ?>>
<?php echo $Top->name->ListViewValue() ?></span>
<input type="hidden" data-field="x_name" name="x<?php echo $Top_grid->RowIndex ?>_name" id="x<?php echo $Top_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($Top->name->FormValue) ?>">
<input type="hidden" data-field="x_name" name="o<?php echo $Top_grid->RowIndex ?>_name" id="o<?php echo $Top_grid->RowIndex ?>_name" value="<?php echo ew_HtmlEncode($Top->name->OldValue) ?>">
<?php } ?>
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
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_kills" class="control-group Top_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_grid->RowIndex ?>_kills" id="x<?php echo $Top_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top->kills->PlaceHolder ?>" value="<?php echo $Top->kills->EditValue ?>"<?php echo $Top->kills->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_grid->RowIndex ?>_kills" id="o<?php echo $Top_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top->kills->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_kills" class="control-group Top_kills">
<input type="text" data-field="x_kills" name="x<?php echo $Top_grid->RowIndex ?>_kills" id="x<?php echo $Top_grid->RowIndex ?>_kills" size="30" placeholder="<?php echo $Top->kills->PlaceHolder ?>" value="<?php echo $Top->kills->EditValue ?>"<?php echo $Top->kills->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->kills->ViewAttributes() ?>>
<?php echo $Top->kills->ListViewValue() ?></span>
<input type="hidden" data-field="x_kills" name="x<?php echo $Top_grid->RowIndex ?>_kills" id="x<?php echo $Top_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top->kills->FormValue) ?>">
<input type="hidden" data-field="x_kills" name="o<?php echo $Top_grid->RowIndex ?>_kills" id="o<?php echo $Top_grid->RowIndex ?>_kills" value="<?php echo ew_HtmlEncode($Top->kills->OldValue) ?>">
<?php } ?>
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
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_deaths" class="control-group Top_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_grid->RowIndex ?>_deaths" id="x<?php echo $Top_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top->deaths->PlaceHolder ?>" value="<?php echo $Top->deaths->EditValue ?>"<?php echo $Top->deaths->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_grid->RowIndex ?>_deaths" id="o<?php echo $Top_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top->deaths->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_deaths" class="control-group Top_deaths">
<input type="text" data-field="x_deaths" name="x<?php echo $Top_grid->RowIndex ?>_deaths" id="x<?php echo $Top_grid->RowIndex ?>_deaths" size="30" placeholder="<?php echo $Top->deaths->PlaceHolder ?>" value="<?php echo $Top->deaths->EditValue ?>"<?php echo $Top->deaths->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->deaths->ViewAttributes() ?>>
<?php echo $Top->deaths->ListViewValue() ?></span>
<input type="hidden" data-field="x_deaths" name="x<?php echo $Top_grid->RowIndex ?>_deaths" id="x<?php echo $Top_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top->deaths->FormValue) ?>">
<input type="hidden" data-field="x_deaths" name="o<?php echo $Top_grid->RowIndex ?>_deaths" id="o<?php echo $Top_grid->RowIndex ?>_deaths" value="<?php echo ew_HtmlEncode($Top->deaths->OldValue) ?>">
<?php } ?>
</td>
		</tr>
	<?php } ?>
	<?php if ($Top->streak->Visible) { // streak ?>
		<tr>
			<td class="ewTableHeader"><span class="Top_streak">
<?php if ($Top->Export <> "" || $Top->SortUrl($Top->streak) == "") { ?>
				<div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $Top->streak->FldCaption() ?></div>
<?php } else { ?>
				<div>
            	<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $Top->streak->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($Top->streak->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($Top->streak->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
				</div>
<?php } ?>
			</span></td>
			<td<?php echo $Top->streak->CellAttributes() ?>>
<?php if ($Top->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_streak" class="control-group Top_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_grid->RowIndex ?>_streak" id="x<?php echo $Top_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top->streak->PlaceHolder ?>" value="<?php echo $Top->streak->EditValue ?>"<?php echo $Top->streak->EditAttributes() ?>>
</span>
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_grid->RowIndex ?>_streak" id="o<?php echo $Top_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top->streak->OldValue) ?>">
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $Top_grid->RowCnt ?>_Top_streak" class="control-group Top_streak">
<input type="text" data-field="x_streak" name="x<?php echo $Top_grid->RowIndex ?>_streak" id="x<?php echo $Top_grid->RowIndex ?>_streak" size="30" placeholder="<?php echo $Top->streak->PlaceHolder ?>" value="<?php echo $Top->streak->EditValue ?>"<?php echo $Top->streak->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span<?php echo $Top->streak->ViewAttributes() ?>>
<?php echo $Top->streak->ListViewValue() ?></span>
<input type="hidden" data-field="x_streak" name="x<?php echo $Top_grid->RowIndex ?>_streak" id="x<?php echo $Top_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top->streak->FormValue) ?>">
<input type="hidden" data-field="x_streak" name="o<?php echo $Top_grid->RowIndex ?>_streak" id="o<?php echo $Top_grid->RowIndex ?>_streak" value="<?php echo ew_HtmlEncode($Top->streak->OldValue) ?>">
<?php } ?>
</td>
		</tr>
	<?php } ?>
	</table>
<div class="ewMultiColumnListOption">
<?php

// Render list options (body, bottom)
$Top_grid->ListOptions->Render("body", "", $Top_grid->RowCnt);
?>
</div>
	</td>
<?php if ($Top_grid->ColCnt == $Top_grid->RecPerRow) { ?>
</tr>
<?php } ?>
<?php if ($Top->RowType == EW_ROWTYPE_ADD || $Top->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fTopgrid.UpdateOpts(<?php echo $Top_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($Top->CurrentAction <> "gridadd" || $Top->CurrentMode == "copy")
		if (!$Top_grid->Recordset->EOF) $Top_grid->Recordset->MoveNext();
}
?>
<?php if ($Top_grid->ColCnt < $Top_grid->RecPerRow) { ?>
<?php for ($i = 1; $i <= $Top_grid->RecPerRow - $Top_grid->ColCnt; $i++) { ?>
	<td>&nbsp;</td>
<?php } ?>
</tr>
<?php } ?>
</table>
<?php if ($Top->CurrentMode == "add" || $Top->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $Top_grid->FormKeyCountName ?>" id="<?php echo $Top_grid->FormKeyCountName ?>" value="<?php echo $Top_grid->KeyCount ?>">
<?php echo $Top_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Top->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $Top_grid->FormKeyCountName ?>" id="<?php echo $Top_grid->FormKeyCountName ?>" value="<?php echo $Top_grid->KeyCount ?>">
<?php echo $Top_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Top->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fTopgrid">
</div>
<?php

// Close recordset
if ($Top_grid->Recordset)
	$Top_grid->Recordset->Close();
?>
<?php if ($Top_grid->ShowOtherOptions) { ?>
<div class="ewGridLowerPanel ewListOtherOptions">
<?php
	foreach ($Top_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<?php } ?>
</div>
</td></tr></table>
<?php if ($Top->Export == "") { ?>
<script type="text/javascript">
fTopgrid.Init();
<?php if (EW_MOBILE_REFLOW && ew_IsMobile()) { ?>
ew_Reflow();
<?php } ?>
</script>
<?php } ?>
<?php
$Top_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$Top_grid->Page_Terminate();
?>
