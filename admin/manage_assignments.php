<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM assignments where id=".$_GET['id'])->fetch_array();
	foreach($qry as $k =>$v){
		$$k = $v;
	}
}

?>
<div class="container-fluid">
	<form action="" id="manage-assignments">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id']:'' ?>" class="form-control">
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Position Name</label>
				<input type="text" name="position" class="form-control" value="<?php echo isset($position) ? $position:'' ?>">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Availability</label>
				<input type="number" name="availability" min='1' class="form-control text-right" value="<?php echo isset($availability) ? $availability:'' ?>">
			</div>
		</div>
		<?php if(isset($id)): ?>
		<div class="row form-group">
			<div class="col-md-8">
				<label class="control-label">Completed</label>
				<select name="status" class="browser-default custom-select" id="">
				<input type="number" name="completed" min='1' class="form-control text-right" value="<?php echo isset($completed) ? $completed:'' ?>">
				</select>
			</div>
		</div>
		<?php endif; ?>
		<div class="row form-group">
			<div class="col-md-12">
				<label class="control-label">Description</label>
				<textarea name="description" class="text-jqte"><?php echo isset($description) ? $description : '' ?></textarea>
			</div>
		</div>
	</form>
</div>

<script>
	$('.text-jqte').jqte();
	$('#manage-assignments').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_assignments',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Data successfully saved.",'success')
					setTimeout(function(){
						location.reload()
					},1000)
				}
			}
		})
	})
</script>