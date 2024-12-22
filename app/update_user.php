<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['full_name']) && $_SESSION['role'] == 'admin') { 
    include "../db_connector.php";

    function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);
    $full_name = validate_input($_POST['full_name']);
    $id = validate_input($_POST['id']);

    if (empty($username)) {
        $em = "Username is required";
        $id = "Username is required";
        header("Location: ../edit_user.php?error=$em&id=$id");
        exit();
    }else if (empty($password)) {
        $em = "password is required";
        header("Location: ../edit_user.php?error=$em&id=$id");
        exit();
    }else if (empty($full_name)) {
        $em = "Fullname is required";
        header("Location: ../edit_user.php?error=$em&id=$id");
        exit();
    }else {
        include "Model/User.php";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $data = array($full_name, $username, $password, "employee", $id, "employee");
        update_user($conn,$data);
        
        $em = "User created successfully";
        header("Location: ../edit_user.php?success=$em&id=$id");
        exit();
    }

}else {
    $em = "Unknown error occurred";
    header("Location: ../edit_user.php?error=$em");
    exit();
}

}else {
    $em = "First login";
    header("Location: ../edit_user.php?error=$em");
    exit();
}


