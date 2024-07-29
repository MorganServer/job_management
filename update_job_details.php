<?php
require_once "connection.php";

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
    $status         = $row['status'];
    $pay            = $row['pay'];
    $bonus_pay      = $row['bonus_pay'];
    $job_type       = $row['job_type'];
    $watchlist      = $row['watchlist'];
    $interview_set  = $row['interview_set'];
    $notes          = $row['notes'];
    $job_link       = $row['job_link'];

    echo "
    <div class='modal-body'>
        <form id='edit-application-form' method='POST' action='update_job.php' class='mt-4'>
            <input type='hidden' id='edit-job-id' name='job_id' value='$job_id'>

            <div class='row mb-3'>
                <div class='col'>
                    <label for='edit-job_title' class='form-label'>Job Title</label>
                    <input type='text' class='form-control' id='edit-job_title' name='job_title' value='$job_title'>
                </div>
                <div class='col'>
                    <label for='edit-job_link' class='form-label'>Job Link</label>
                    <input type='text' class='form-control' id='edit-job_link' name='job_link' value='$job_link'>
                </div>
            </div>

            <div class='row mb-3'>
                <div class='col'>
                    <label for='edit-company' class='form-label'>Company</label>
                    <input type='text' class='form-control' id='edit-company' name='company' value='$company'>
                </div>
                <div class='col'>
                    <label for='edit-location' class='form-label'>Location</label>
                    <input type='text' class='form-control' id='edit-location' name='location' value='$location'>
                </div>
            </div>

            <div class='row mb-3'>
                <div class='col'>
                    <label for='edit-pay' class='form-label'>Pay</label>
                    <input type='text' class='form-control' id='edit-pay' name='pay' value='$pay'>
                </div>
                <div class='col'>
                    <label for='edit-bonus_pay' class='form-label'>Bonus Pay <span class='text-muted' style='font-size: 10px;'>Optional</span></label>
                    <input type='text' class='form-control' id='edit-bonus_pay' name='bonus_pay' value='$bonus_pay'>
                </div>
                <div class='col'>
                    <label class='form-label' for='edit-status'>Status</label>
                    <select class='form-control' id='edit-status' name='status'>
                        <option value=''>Please select one...</option>
                        <option value='Applied'" . ($status == 'Applied' ? " selected" : "") . ">Applied</option>
                        <option value='Interviewed'" . ($status == 'Interviewed' ? " selected" : "") . ">Interviewed</option>
                        <option value='Offered'" . ($status == 'Offered' ? " selected" : "") . ">Offered</option>
                        <option value='Rejected'" . ($status == 'Rejected' ? " selected" : "") . ">Rejected</option>
                    </select>
                </div>
                <div class='col'>
                    <label class='form-label' for='edit-job_type'>Job Type</label>
                    <select class='form-control' id='edit-job_type' name='job_type'>
                        <option value=''>Please select one...</option>
                        <option value='Full Time'" . ($job_type == 'Full Time' ? " selected" : "") . ">Full Time</option>
                        <option value='Part Time'" . ($job_type == 'Part Time' ? " selected" : "") . ">Part Time</option>
                        <option value='Contract'" . ($job_type == 'Contract' ? " selected" : "") . ">Contract</option>
                        <option value='Internship'" . ($job_type == 'Internship' ? " selected" : "") . ">Internship</option>
                        <option value='Temporary'" . ($job_type == 'Temporary' ? " selected" : "") . ">Temporary</option>
                    </select>
                </div>
            </div>

            <div class='row mb-3'>
                <div class='col'>
                    <label class='form-label' for='edit-notes'>Notes</label>
                    <textarea class='form-control' id='edit-notes' name='notes' rows='5'>$notes</textarea>
                </div>
            </div>

            <div class='row mb-3 ps-3'>
                <div class='form-check'>
                    <input type='checkbox' class='form-check-input' id='edit-watchlist' name='watchlist' value='1'" . ($watchlist == 1 ? " checked" : "") . ">
                    <label class='form-check-label' for='edit-watchlist'>Add to Watchlist</label>
                </div>
                <div class='form-check'>
                    <input type='checkbox' class='form-check-input' id='edit-interview_set' name='interview_set' value='1'" . ($interview_set == 1 ? " checked" : "") . ">
                    <label class='form-check-label' for='edit-interview_set'>Interview Set</label>
                </div>
            </div>

            <input type='submit' name='update-application' class='form-btn' value='Update Application'>
            <div class='pb-4'></div>
        </form>
    </div>";
}
?>
