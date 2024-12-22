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
	<title>Manage Users</title>
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
			<h4 class = "title">Manage Users <a href = "add_user.php">Add User</a></h4>
			<?php if (isset($_GET['success'])) {?>
                <div class="success" role="alert">
                   <?php echo stripcslashes($_GET['success']); ?>
                </div>
            <?php } ?>    
			<?php if ($users != 0) { ?>
			<table class="main-table">
				<tr>
					<th>#</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>role</th>
					<th>Action</th>
				</tr>
				<?php $i=0; foreach ($users as $user) { ?>
				<tr>
					<td><?=++$i?></td>
					<td><?=$user['full_name']?></td>
					<td><?=$user['username']?></td>
					<td><?=$user['role']?></td>
					<td>
						<a href="edit_user.php?id=<?=$user['id']?>" class = "edit-btn">Edit</a>
						<a href="delete_user.php?id=<?=$user['id']?>" class = "delete-btn">Delete</a>
					</td>
				</tr>
			    <?php } ?>
			</table>
		<?php }else { ?>
	    <?php } ?>		
		</section>
	</div>
<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(2)");
	active.classList.add("active");
</script>

</body>
</html>
<?php }else{
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>