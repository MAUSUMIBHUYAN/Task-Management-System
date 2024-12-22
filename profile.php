<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
        include "db_connector.php";
        include "app/Model/User.php";
        $user = get_users_by_id($conn,$_SESSION['id']);

?>
<!DOCTYPE html>
<html>
<head>
        <title>Profile</title>
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
                <h4 class = "title">Profile <a href = "edit_profile.php">Edit Profile</a></h4>
                <table class="main-table" style="max-width: 300px;">
                      <tr>
                              <td>Full Name</td>
                              <td><?=$user['full_name']?></td>
                      </tr>
                      <tr>
                              <td>Username</td>
                              <td><?=$user['username']?></td>
                      </tr>  
                      <tr>
                              <td>Joined At</td>
                              <td><?=$user['created_at']?></td>
                      </tr>  
                </table>
                </section>
        </div>
<script type="text/javascript">
        var active = document.querySelector("#navList li:nth-child(3)");
        active.classList.add("active");
</script>

</body>
</html>
<?php } ?>