<nav class="side-bar">
    <div class="user-p">
        <img src="img/user.png">
        <h4><?= $_SESSION['username'] ?></h4>
    </div>

    <?php
    // Get the current file name to highlight the active menu
    $current_page = basename($_SERVER['PHP_SELF']);

    if ($_SESSION['role'] == "employee") {
    ?>
        <!--Employee Navigation Bar-->
        <ul>
            <li class="<?= $current_page == 'index.php' ? 'active' : '' ?>">
                <a href="index.php">
                    <i class="fa-solid fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= $current_page == 'mytask.php' ? 'active' : '' ?>">
                <a href="mytask.php">
                    <i class="fa-solid fa-tasks"></i>
                    <span>My Task</span>
                </a>
            </li>
            <li class="<?= $current_page == 'profile.php' ? 'active' : '' ?>">
                <a href="profile.php">
                    <i class="fa-solid fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <li class="<?= $current_page == 'notification.php' ? 'active' : '' ?>">
                <a href="notification.php">
                    <i class="fa-solid fa-bell"></i>
                    <span>Notification</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa-solid fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    <?php
    } else {
    ?>
        <!--Admin Navigation Bar-->
        <ul id="navList">
            <li class="<?= $current_page == 'index.php' ? 'active' : '' ?>">
                <a href="index.php">
                    <i class="fa-solid fa-tachometer"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= $current_page == 'user.php' ? 'active' : '' ?>">
                <a href="user.php">
                    <i class="fa-solid fa-users"></i>
                    <span>Manage Users</span>
                </a>
            </li>
            <li class="<?= $current_page == 'create.php' ? 'active' : '' ?>">
                <a href="create.php">
                    <i class="fa-solid fa-plus"></i>
                    <span>Create Task</span>
                </a>
            </li>
            <li class="<?= $current_page == 'tasks.php' ? 'active' : '' ?>">
                <a href="tasks.php">
                    <i class="fa-solid fa-tasks"></i>
                    <span>All Tasks</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fa-solid fa-sign-out"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    <?php
    }
    ?>
</nav>
