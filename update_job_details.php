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

    echo "  <div class='modal-header'>
                <h5 class='modal-title' id='updateApplicationModalLabel'>Update Application</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                <form id='updateApplicationForm' method='POST'>
                    <input type='hidden' id='update-job-id' name='job_id' value='$job_id'>
                    <div class='mb-3'>
                        <label for='update-job_title' class='form-label'>Job Title</label>
                        <input type='text' class='form-control' id='update-job_title' name='job_title' value='$job_title'>
                    </div>
                    <div class='mb-3'>
                        <label for='update-job_link' class='form-label'>Job Link</label>
                        <input type='text' class='form-control' id='update-job_link' name='job_link' value='$job_link'>
                    </div>
                    <div class='mb-3'>
                        <label for='update-company' class='form-label'>Company</label>
                        <input type='text' class='form-control' id='update-company' name='company' value='$company'>
                    </div>
                    <div class='mb-3'>
                        <label for='update-location' class='form-label'>Location</label>
                        <input type='text' class='form-control' id='update-location' name='location' value='$location'>
                    </div>
                    <div class='mb-3'>
                        <label for='update-pay' class='form-label'>Pay</label>
                        <input type='text' class='form-control' id='update-pay' name='pay' value='$pay'>
                    </div>
                    <div class='mb-3'>
                        <label for='update-bonus_pay' class='form-label'>Bonus Pay</label>
                        <input type='text' class='form-control' id='update-bonus_pay' name='bonus_pay' value='$bonus_pay'>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='update-status'>Status</label>
                        <select class='form-control' id='update-status' name='status'>
                            <option value=''>Please select one...</option>
                            <option value='Applied' " . ($status == 'Applied' ? 'selected' : '') . ">Applied</option>
                            <option value='Interviewed' " . ($status == 'Interviewed' ? 'selected' : '') . ">Interviewed</option>
                            <option value='Offered' " . ($status == 'Offered' ? 'selected' : '') . ">Offered</option>
                            <option value='Rejected' " . ($status == 'Rejected' ? 'selected' : '') . ">Rejected</option>
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='update-job_type'>Job Type</label>
                        <select class='form-control' id='update-job_type' name='job_type'>
                            <option value=''>Please select one...</option>
                            <option value='Full Time' " . ($job_type == 'Full Time' ? 'selected' : '') . ">Full Time</option>
                            <option value='Part Time' " . ($job_type == 'Part Time' ? 'selected' : '') . ">Part Time</option>
                            <option value='Contract' " . ($job_type == 'Contract' ? 'selected' : '') . ">Contract</option>
                            <option value='Internship' " . ($job_type == 'Internship' ? 'selected' : '') . ">Internship</option>
                            <option value='Temporary' " . ($job_type == 'Temporary' ? 'selected' : '') . ">Temporary</option>
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label class='form-label' for='update-notes'>Notes</label>
                        <textarea class='form-control' id='update-notes' name='notes' rows='5'>$notes</textarea>
                    </div>
                    <div class='row mb-3 ps-3'>
                        <div class='form-check'>
                            <input type='checkbox' class='form-check-input' id='update-watchlist' name='watchlist' value='1' " . ($watchlist ? 'checked' : '') . ">
                            <label class='form-check-label' for='update-watchlist'>Add to Watchlist</label>
                        </div>
                        <div class='form-check'>
                            <input type='checkbox' class='form-check-input' id='update-interview_set' name='interview_set' value='1' " . ($interview_set ? 'checked' : '') . ">
                            <label class='form-check-label' for='update-interview_set'>Interview Set</label>
                        </div>
                    </div>   
                    
                    <div class='mb-3'></div> 
                    </div>
                    <div class='modal-footer'>
                        <input type='submit' name='update-application' class='form-btn' value='Update Application'>
                    
                    </div>
                </form>
                

            <script>
                tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap |   removeformat',
                });
            </script>

    ";
}
?>
