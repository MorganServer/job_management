<?php
require_once "connection.php";

$query = isset($_POST['query']) ? $_POST['query'] : '';
$query = mysqli_real_escape_string($conn, $query);

$sql = "SELECT * FROM jobs WHERE job_title LIKE '%$query%' OR company LIKE '%$query%' OR location LIKE '%$query%' OR status LIKE '%$query%' ORDER BY updated_at DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id             = $row['job_id'];
        $idno           = $row['idno'];
        $job_title      = $row['job_title'];
        $company        = $row['company'];
        $location       = $row['location'];
        $created_at     = date('M j, Y', strtotime($row['created_at']));
        $status         = $row['status'];
        $pay            = $row['pay'];
        $bonus_pay      = $row['bonus_pay'];
        $job_type       = $row['job_type'];
        $watchlist      = $row['watchlist'];
        $interview_set  = $row['interview_set'];
        $notes          = $row['notes'];
        $job_link       = $row['job_link'];
        $updated_at_formatted = date('M j, Y', strtotime($row['updated_at']));

        // Generate table row with job_id in data attributes
        echo "<tr>
        <th scope='row'>$id</th>
        <td>$job_title</td>
        <td>$company</td>
        <td>$location</td>
        <td>$created_at</td>
        <td>$status</td>
        <td style='font-size: 20px;'>
            <a class='view' data-job-id='$id' style='text-decoration: none; cursor: pointer;'>
                <i class='bi bi-eye text-success'></i>
            </a>
            &nbsp; 
            <a class='edit' data-job-id='$id' style='text-decoration: none; cursor: pointer;'>
                <i class='bi bi-pencil-square' style='color:#005382;'></i>
            </a>
            &nbsp;
            <a href='/?appdelid=$id' class='delete' style='text-decoration: none;'>
                <i class='bi bi-trash' style='color:#941515;'></i>
            </a>
        </td>
      </tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>No jobs found.</td></tr>";
}
?>
