<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

	include "db_connector.php";
	include "app/Model/Task.php";
	include "app/Model/User.php";

	if ($_SESSION['role'] == "admin") {
		$due_today_task = count_tasks_due_today($conn);
		$ovedue_task = count_tasks_Overdue($conn);
		$no_deadline_task = count_tasks_no_deadline($conn);
		$num_task = count_tasks($conn);
		$num_users = count_users($conn);
		$pending = count_pending_tasks($conn);
		$in_progress = count_in_progress_tasks($conn);
		$completed = count_completed_tasks($conn);
	}else {
        $num_mytask = count_mytasks($conn, $_SESSION['id']);
        $ovedue_mytask = count_mytasks_Overdue($conn, $_SESSION['id']);
        $no_deadline_mytask = count_mytasks_no_deadline($conn, $_SESSION['id']);
        $pending = count_pending_mytasks($conn, $_SESSION['id']);
		$in_progress = count_in_progress_mytasks($conn, $_SESSION['id']);
		$completed = count_completed_mytasks($conn, $_SESSION['id']);
	}

	
?>
<!DOCTYPE html>
<html>
<head>
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
			<?php if ($_SESSION['role'] == "admin") { ?>
				<div class="dashboard">
					<div class="dashboard-item">
						<i class="fa fa-users"></i>
						<span>Employee (<?=$num_users?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-tasks"></i>
						<span>All Tasks (<?=$num_task?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-rectangle-xmark"></i>
						<span>Overdue (<?=$ovedue_task?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-clock"></i>
						<span>No Deadline (<?=$no_deadline_task?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-triangle-exclamation"></i>
						<span>Due Today (<?=$due_today_task?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa fa-bell"></i>
						<span>Notifications (<?=$num_task?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-regular fa-square"></i>
						<span>Pending (<?=$pending?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-spinner"></i>
						<span>In Progress (<?=$in_progress?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-regular fa-square-check"></i>
						<span>Completed (<?=$completed?>)</span>
					</div>
				</div>
			<?php }else{ ?>
				<div class="dashboard">
					<div class="dashboard-item">
						<i class="fa fa-tasks"></i>
						<span>My Tasks (<?=$num_mytask?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-rectangle-xmark"></i>
						<span>Overdue (<?=$ovedue_mytask?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-clock"></i>
						<span>No Deadline (<?=$no_deadline_mytask?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-regular fa-square"></i>
						<span>Pending (<?=$pending?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-solid fa-spinner"></i>
						<span>In Progress (<?=$in_progress?>)</span>
					</div>
					<div class="dashboard-item">
						<i class="fa-regular fa-square-check"></i>
						<span>Completed (<?=$completed?>)</span>
					</div>
				</div>
			<?php } ?>	
		</section>
	</div>
<script type="text/javascript">
	var active = document.querySelector("#navList li:nth-child(1)");
	active.classList.add("active");
</script>
</body>
</html>
<?php } ?>