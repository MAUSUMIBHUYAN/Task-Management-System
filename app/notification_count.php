<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {
    include "../db_connector.php";
    include "Model/Notification.php";

    $count_notification = count_notification($conn, $_SESSION['id']);
    if ($count_notification) {
        echo "&nbsp;". $count_notification. "&nbsp;";
    }

}else{
    echo "";
}
?>