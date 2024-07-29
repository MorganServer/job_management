<?php
require_once "../database/connection.php";

$job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;

$sql = "SELECT * FROM jobs WHERE job_id = $job_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
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

    echo "
    <button type='button' class='off-canvas-close-btn' data-bs-dismiss='offcanvas' aria-label='Close'><i class='bi bi-arrow-left-circle'></i></button>
    <hr>
    <div class='main-project-details'>
        <div class='ms-3 me-3'>
            <p><span class='float-end'><i style='font-size: 12px; margin-top: -5px;' class='bi bi-circle-fill " . ($status == 'Applied' ? "text-primary" : ($status == 'Interviewed' ? "text-info" : ($status == 'Offered' ? "text-success" : "text-danger"))) . "'></i> &nbsp; $status</span></p>
            <h3 class='mt-3'>$job_title</h3>
            <p class='text-secondary' style='font-size: 12px;'>
                <span class='pe-3'>Last updated: $updated_at_formatted</span>
                <span>Applied: $created_at</span>
            </p>
            <h4>Company Name</h4>
            <p>$company</p>
            <h4>Location</h4>
            <p>$location</p>
            <h4>Pay</h4>
            <p>$pay</p>
            <h4>Bonus Pay</h4>
            <p>$bonus_pay</p>
            <h4>Job Type</h4>
            <p>$job_type</p>
            <h4>Other Details</h4>
            <ul class='tags'>
                " . ($watchlist == 1 ? "<li>Watching</li>" : "") . "
                " . ($interview_set == 1 ? "<li>Interview Set</li>" : "") . "
            </ul>
            <p>" . ($interview_set == 0 && $watchlist == 0 ? "No other details." : "") . "</p>
            <h4>Notes</h4>
            <p>" . ($notes ? $notes : "No listed notes.") . "</p>
            <a href='$job_link' class='open__project' target='_blank' id='cardHover' rel='noopener noreferrer'>
               Open Job &nbsp; 
               <i class='bi bi-box-arrow-up-right'></i>
            </a>
        </div>
    </div>";
}
?>
