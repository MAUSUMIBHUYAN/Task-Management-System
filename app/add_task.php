<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['assigned_to']) && $_SESSION['role'] == 'admin' && isset($_POST['due_date'])) { 
    include "../db_connector.php";

    function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
    $title = validate_input($_POST['title']);
    $description = validate_input($_POST['description']);
    $assigned_to = validate_input($_POST['assigned_to']);
    $due_date = validate_input($_POST['due_date']);

    if (empty($title)) {
        $em = "Title is required";
        header("Location: ../create.php?error=$em");
        exit();
    }else if (empty($description)) {
        $em = "Description is required";
        header("Location: ../create.php?error=$em");
        exit();
    }else if ($assigned_to == 0) {
        $em = "Select User";
        header("Location: ../create.php?error=$em");
        exit();
    }else {
        include "Model/Task.php";
        include "Model/Notification.php";
        $data = array($title, $description, $assigned_to, $due_date);
        insert_task($conn, $data);

        $notification_data = array("'$title' has been assigned to you. Please review and start working it", $assigned_to, 'New Task Assigned');
        insert_notification($conn, $notification_data);
        $em = "Task created successfully";
        header("Location: ../create.php?success=$em");
        exit();
    }

}else {
    $em = "Unknown error occurred";
    header("Location: ../create.php?error=$em");
    exit();
}

}else {
    $em = "First login";
    header("Location: ../create.php?error=$em");
    exit();
}

