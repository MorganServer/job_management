<?php
require_once "connection.php";

$job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;

if ($job_id > 0) {
    $sql = "SELECT * FROM jobs WHERE job_id = $job_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $job = mysqli_fetch_assoc($result);
        echo json_encode($job);
    } else {
        echo json_encode(['error' => 'No job found']);
    }
} else {
    echo json_encode(['error' => 'Invalid job ID']);
}
?>
