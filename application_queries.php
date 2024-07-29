<?php
require_once "connection.php";

// Job - Add Job
    if (isset($_POST['add-application'])) {
        $idno  = rand(1000000, 9999999);
        $watchlist = isset($_POST['watchlist']) ? 1 : 0;
        $interview_set = isset($_POST['interview_set']) ? 1 : 0;
        if(isset($_POST['job_title'])) { $job_title = mysqli_real_escape_string($conn, $_POST['job_title']); } else { $job_title = ""; }
        if(isset($_POST['company'])) { $company = mysqli_real_escape_string($conn, $_POST['company']); } else { $company = ""; }
        if(isset($_POST['location'])) { $location = mysqli_real_escape_string($conn, $_POST['location']); } else { $location = ""; }
        if(isset($_POST['pay'])) { $pay = mysqli_real_escape_string($conn, $_POST['pay']); } else { $pay = ""; }
        if(isset($_POST['bonus_pay'])) { $bonus_pay = mysqli_real_escape_string($conn, $_POST['bonus_pay']); } else { $bonus_pay = ""; }
        if(isset($_POST['status'])) { $status = mysqli_real_escape_string($conn, $_POST['status']); } else { $status = ""; }
        if(isset($_POST['job_link'])) { $job_link = mysqli_real_escape_string($conn, $_POST['job_link']); } else { $job_link = ""; }
        if(isset($_POST['job_type'])) { $job_type = mysqli_real_escape_string($conn, $_POST['job_type']); } else { $job_type = ""; }
        if(isset($_POST['notes'])) { $notes = mysqli_real_escape_string($conn, $_POST['notes']); } else { $notes = ""; }
    
        $select = "SELECT * FROM jobs WHERE idno = '$idno'";
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) > 0) {
            $error[] = 'Job already exists!';
        } else {
            $insert = "INSERT INTO jobs (idno, job_title, company, location, pay, bonus_pay, status, watchlist, job_link, job_type, interview_set, notes) 
            VALUES ('$idno',NULLIF('$job_title',''),NULLIF('$company',''),NULLIF('$location',''),NULLIF('$pay',''),NULLIF('$bonus_pay',''),NULLIF('$status',''), '$watchlist',NULLIF('$job_link',''),NULLIF('$job_type',''),'$interview_set',NULLIF('$notes',''))";
            mysqli_query($conn, $insert);
            header('location: /');
        }
    }
// End Job - Add Job

// Job - Update Job
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $job_id        = intval($_POST['job_id']);
        $job_title     = mysqli_real_escape_string($conn, $_POST['job_title']);
        $job_link      = mysqli_real_escape_string($conn, $_POST['job_link']);
        $company       = mysqli_real_escape_string($conn, $_POST['company']);
        $location      = mysqli_real_escape_string($conn, $_POST['location']);
        $pay           = mysqli_real_escape_string($conn, $_POST['pay']);
        $bonus_pay     = mysqli_real_escape_string($conn, $_POST['bonus_pay']);
        $status        = mysqli_real_escape_string($conn, $_POST['status']);
        $job_type      = mysqli_real_escape_string($conn, $_POST['job_type']);
        $notes         = mysqli_real_escape_string($conn, $_POST['notes']);
        $watchlist     = isset($_POST['watchlist']) ? 1 : 0;
        $interview_set = isset($_POST['interview_set']) ? 1 : 0;
    
        $sql = "UPDATE jobs SET job_title='$job_title', job_link='$job_link', company='$company', location='$location', pay='$pay', bonus_pay='$bonus_pay', status='$status', job_type='$job_type', notes='$notes', watchlist=$watchlist, interview_set=$interview_set WHERE job_id=$job_id";
    
        if (mysqli_query($conn, $sql)) {
            header("Location: /?update=success"); // Redirect back to the list with a success message
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
// End Job - Update Job

// Jobs - Delete Job
    if(isset($_GET['appdelid'])) {
        $id = $_GET['appdelid'];

        $sql = "DELETE FROM jobs WHERE job_id=$id";
        $result = mysqli_query($conn, $sql);
    }
// End Jobs - Delete Job

?>