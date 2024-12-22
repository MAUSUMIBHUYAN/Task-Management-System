<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "db_connector.php";
	include "app/Model/User.php";
	$users = get_all_users($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Task</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>sidebar</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<input type="checkbox" id="checkbox">
	<?php include "in/header.php" ?>
	<div class = "body">
		<?php include "in/navigation.php" ?>
		<section class = "section-1">
			<h4 class = "title">Create Task </h4>
			   <form class="form-1"
                  method="POST"
                  action="app/add_task.php">
                  <?php if (isset($_GET['error'])) {?>
					<div class="danger" role="alert">
					   <?php echo stripcslashes($_GET['error']); ?>
					</div>
					<?php } ?>	

					<?php if (isset($_GET['success'])) {?>
						<div class="success" role="alert">
						   <?php echo stripcslashes($_GET['success']); ?>
						</div>
					<?php } ?>
                  <p class="error'"></p>
            	<div class="input-holder">
            		<label>Title</label>
            		<input type="text" name="title" class="input-1" placeholder="Title">
            		<br>
            	<div class="input-holder">
            		<label>Description</label>
            		<textarea type="text" name="description" class="input-1" placeholder="Description"></textarea><br>
            	<div class="input-holder">
            		<label>Due Date</label>
            		<input type="date" name="due_date" class="input-1" placeholder="Due Date"><br>	
            	<div class="input-holder">
            		<label>Assigned to</label>
            		<select name = "assigned_to" class="input-1">
            			<option value="0">Select employee</option>
            			<?php if ($users != 0) {
            				foreach ($users as $user) {
            			?>
            			<option value="<?=$user['id']?>"><?=$user['full_name']?></option>
            		   <?php } } ?>
            		</select><br>		
            	<button class= "edit-btn">Create Task</button>
            </form>
		</section>
	</div>
<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(3)");
	active.classList.add("active");
</script>

</body>
</html>
<?php } ?>