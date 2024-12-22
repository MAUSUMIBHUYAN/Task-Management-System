<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "employee") {
    include "db_connector.php";
    include "app/Model/Notification.php";

    // Check if ID is set in the URL
    if (!isset($_GET['id'])) {
        header("Location: notification.php");
        exit();
    }

    // Get the notification ID from the URL
    $id = $_GET['id'];
    $notification = get_notification_by_id($conn, $id);

    // Check if notification exists
    if ($notification == 0) {
        header("Location: notification.php");
        exit();
    }

    // Prepare data for deletion
    $data = array($id);
    delete_notification($conn, $data);

    // Success message
    $sm = "Deleted successfully";
    header("Location: notification.php?success=$sm");
    exit();

} else {
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>
