<?php

function get_all_mynotification($conn, $id){
	$sql = "SELECT * FROM notifications WHERE recipient = ? LIMIT 5";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	if($stmt->rowCount() > 0){
		$notifications = $stmt->fetchAll();
	}else $notifications = 0;

	return $notifications;
}

function count_notification($conn, $id){
	$sql = "SELECT id FROM notifications WHERE recipient = ? AND is_read = 0";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

	return $stmt->rowCount();
}

function insert_notification($conn,$data){
	$sql = "INSERT INTO notifications (message, recipient, type) VALUES(?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute($data);
}

function notification_make_read($conn,$recipient_id,$notification_id){
	$sql = "UPDATE notifications SET is_read=1 WHERE id = ? AND recipient = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$notification_id,$recipient_id]);
}
function get_notification_by_id($conn, $id) {
    $sql = "SELECT * FROM notifications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        $notification = $stmt->fetch();
    } else {
        $notification = 0;
    }

    return $notification;
}
function delete_notification($conn, $data) {
    $sql = "DELETE FROM notifications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
}
