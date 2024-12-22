<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
        include "db_connector.php";
        include "app/Model/User.php";
        if (!isset($_GET['id'])) {
                header("Location: user.php");
                exit();
        }
        $id = $_GET['id'];
        $user = get_users_by_id($conn,$id);

        if ($user == 0) {
                header("Location: user.php");
                exit();
        }

?>
<!DOCTYPE html>
<html>
<head>
        <title>Edit User</title>
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
                <h4 class = "title">Edit Users <a href = "user.php">Users</a></h4>
                <form class="form-1"
                      method="POST"
                      action="app/update_user.php">
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
                        <label>Full Name</label>
                        <input type="text" name = "full_name" class="input-1" placeholder="Full Name" value = "<?=$user['full_name']?>"><br>
                </div>
                <div class="input-holder">
                        <label>Username</label>
                        <input type="text" name = "username" value = "<?=$user['username']?>" class="input-1" placeholder="Username"><br>
                </div>
                <div class="input-holder">
                        <label>Password</label>
                        <input type="text" value = "************" name = "password" class="input-1" placeholder="Password"><br>
                </div>
                <input type="text" name="id" value="<?=$user['id']?>" hidden>

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