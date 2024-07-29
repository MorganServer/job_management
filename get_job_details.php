<?php
require_once "connection.php";

$job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;

$sql = "SELECT * FROM jobs WHERE job_id = $job_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die(json_encode(['error' => "SQL Error: " . mysqli_error($conn)]));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'No job found with the given ID']);
}
?>
