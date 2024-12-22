<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) { 
    include "../db_connector.php";

    function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate_input($_POST['username']);
    $password = validate_input($_POST['password']);

    if (empty($username)) {
        $em = "Username is required";
        header("Location: ../login.php?error=$em");
        exit();
    } else if (empty($password)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            $usernameDb = $user['username'];
            $passwordDb = $user['password'];
            $role = $user['role'];
            $id = $user['id'];

            if ($username === $usernameDb) {
                if (password_verify($password, $passwordDb)) {
                    $_SESSION['role'] = $role;
                    $_SESSION['id'] = $id;
                    $_SESSION['username'] = $usernameDb;

                    header("Location: ../index.php");
                    exit();
                } else {
                    $em = "Incorrect username or password";
                    header("Location: ../login.php?error=$em");
                    exit();
                }
            } else {
                $em = "Incorrect username or password";
                header("Location: ../login.php?error=$em");
                exit();
            }
        } else {
            // Handle the case where the username doesn't exist
            $em = "Incorrect username or password";
            header("Location: ../login.php?error=$em");
            exit();
        }
    }
} else {
    $em = "Unknown error occurred";
    header("Location: ../login.php?error=$em");
    exit();
}


