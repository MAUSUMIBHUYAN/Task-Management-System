<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
        include "db_connector.php";
        include "app/Model/Task.php";
        include "app/Model/User.php";
        if (!isset($_GET['id'])) {
                header("Location: tasks.php");
                exit();
        }
        $id = $_GET['id'];
        $task = get_tasks_by_id($conn,$id);

        if ($task == 0) {
                header("Location: tasks.php");
                exit();
        }
        $users = get_all_users($conn);

?>
<!DOCTYPE html>
<html>
<head>
        <title>Edit Task</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>sidebar</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
        <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <input type="checkbox" id="checkbox">
        <?php include "in/header.php"?>
        <div class = "body">
                <?php include "in/navigation.php" ?>
                <section class = "section-1">
                <h4 class = "title">Edit Task <a href = "mytask.php">Tasks</a></h4><br>
                <form class="form-1"
                      method="POST"
                      action="app/update_task_employee.php">
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
                <div class="input-holder">
                        <label></label>
                        <p><b>Title: </b><?=$task['title']?></p>
                </div>
                <div class="input-holder">
                        <label></label>
                        <p><b>Description: </b><?=$task['description']?></p>
                </div><br>
                <div class="input-holder">
                        <label>Status</label>
                        <select name = "status" class="input-1">
                                <option 
                                        <?php if ( $task['status'] == "pending") echo "selected"; ?>>pending</option>
                                <option
                                        <?php if ( $task['status'] == "in_progress") echo "selected"; ?>>in_progress</option>
                                <option
                                        <?php if ( $task['status'] == "completed") echo "selected"; ?>>completed</option>
                        </select><br>
                </div>        
                <input type="text" name="id" value="<?=$task['id']?>" hidden>

                <button class= "edit-btn">Update</button>
            </form>
                </section>
        </div>
<script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(2)");
        active.classList.add("active");
</script>

</body>
</html>
<?php } ?>