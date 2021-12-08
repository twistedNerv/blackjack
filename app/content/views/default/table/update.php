<div class="col-sm-12 text-center"> 
    <h2>Table</h2>
</div>
<div class="col-sm-5 text-right"> 
    <div class="row">
        <div class="col-sm-12">
            <h4>Table</h4>
        </div>
        <div class="col-sm-12">
            <?php
            foreach ($data['items'] as $singleItem) { 
                $selectedTableClass = ($data['selectedTable']->id == $singleItem['id']) ? "font-weight-bold" : ""; ?>
                <div>
                    <span class='<?=$selectedTableClass?>'><?=$singleItem['table_name']?></span> | 
                    <a href='<?=URL?>table/update/<?=$singleItem['id']?>' title='Edit table'><i class='far fa-edit'></i></a> |
                    <a href='<?=URL?>table/remove/<?=$singleItem['id']?>' title='Delete table' onclick='return confirm("Really want to delete?");'><i class='fas fa-times'></i></a>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<div class="col-sm-3">
    <?php if ($data['selectedTable']->id) { ?>
        <a href="<?= URL ?>table/update">Add table</a>
        <h4>Edit table</h4>
    <?php } else { ?>
        <h4>Add table</h4>
    <?php } ?>
    <div class="table-settings">
        <form action="<?= URL ?>table/update<?php echo ($data['selectedTable']->id) ? "/" . $data['selectedTable']->id : "" ?>" method="post">
            <input type="hidden" name="action" value="handletable">
		<div class='form-group'>
			<label for='table-table_name'>Title</label>
			<input type='text' class='form-control' name='table-table_name' id='table-table_name' placeholder='Title of the table' value='<?php echo ($data['selectedTable']->table_name) ? $data['selectedTable']->table_name : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='table-decks_num'>Number of decks</label>
			<input type='number' class='form-control' name='table-decks_num' id='table-decks_num' placeholder='decs count' value='<?php echo ($data['selectedTable']->decks_num) ? $data['selectedTable']->decks_num : ''; ?>' required>
		</div>
		<div class='form-group  text-center'>
			<label for='table-dealer_stops_17'>Dealer stands at 17</label>
			<input type='hidden' name='table-dealer_stops_17'  value='0'>
			<input type='checkbox' class='form-control' name='table-dealer_stops_17' value='1' <?php echo ($data['selectedTable']->dealer_stops_17 == 1) ? 'checked' : '';?>>
		</div>
		<div class='form-group text-center'>
			<label for='table-double_bet'>Double down allowed</label>
			<input type='hidden' name='table-double_bet'  value='0'>
			<input type='checkbox' class='form-control' name='table-double_bet' value='1' <?php echo ($data['selectedTable']->double_bet == 1) ? 'checked' : '';?>>
		</div>
		<div class='form-group text-center'>
			<label for='table-split'>Split allowed</label>
			<input type='hidden' name='table-split' value='0'>
			<input type='checkbox' class='form-control' name='table-split' value='1' <?php echo ($data['selectedTable']->split == 1) ? 'checked' : '';?>>
		</div>
		<div class='form-group text-center'>
			<label for='table-surender'>Surrender allowed</label>
			<input type='hidden' name='table-surender'  value='0'>
			<input type='checkbox' class='form-control' name='table-surender' value='1' <?php echo ($data['selectedTable']->surender == 1) ? 'checked' : '';?>>
		</div>
		<div class='form-group text-center'>
			<label for='table-insurance'>Insurance allowed</label>
			<input type='hidden' name='table-insurance'  value='0'>
			<input type='checkbox' class='form-control' name='table-insurance' value='1' <?php echo ($data['selectedTable']->insurance == 1) ? 'checked' : '';?>>
		</div>
		<div class='form-group'>
			<label for='table-ratio'>ratio</label>
			<select class='form-control' name='table-ratio' id='table-ratio'>
				<option value='2:1' <?php echo ($data['selectedTable']->ratio == '2:1') ? 'selected' : '' ?>>2:1</option>
				<option value='3:2' <?php echo ($data['selectedTable']->ratio == '3:2') ? 'selected' : '' ?>>3:2</option>
				<option value='6:5' <?php echo ($data['selectedTable']->ratio == '6:5') ? 'selected' : '' ?>>6:5</option>
				<option value='1:1' <?php echo ($data['selectedTable']->ratio == '1:1') ? 'selected' : '' ?>>1:1</option>
			</select>
		</div>
		<div class='form-group'>
			<label for='table-min_bet'>min_bet</label>
			<input type='number' class='form-control' name='table-min_bet' id='table-min_bet' placeholder='min_bet' value='<?php echo ($data['selectedTable']->min_bet) ? $data['selectedTable']->min_bet : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='table-max_bet'>max_bet</label>
			<input type='number' class='form-control' name='table-max_bet' id='table-max_bet' placeholder='max_bet' value='<?php echo ($data['selectedTable']->max_bet) ? $data['selectedTable']->max_bet : ''; ?>' required>
		</div>
		<div class='form-group'>
			<label for='table-color'>color</label>
			<input type='color' class='form-control' name='table-color' id='table-color' placeholder='color' value='<?php echo ($data['selectedTable']->color) ? $data['selectedTable']->color : ''; ?>'>
		</div>
		<div class='form-group'>
			<label for='table-active_table'>active</label>
			<input type='hidden' name='table-active_table'  value='0'>
			<input type='checkbox' class='form-control' name='table-active_table' value='1' <?php echo ($data['selectedTable']->active_table == 1) ? 'checked' : '';?>>
		</div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class='btn btn-danger' href="<?= URL ?>table/update">Cancel</a>
        </form>
    </div>
    
</div>