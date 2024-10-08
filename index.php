<?php
require_once "application_queries.php";

$sql="select count('1') from jobs";
$result=mysqli_query($conn,$sql);
$rowtotal=mysqli_fetch_array($result); 

$a_sql="select count('1') from jobs where status ='Applied'";
$a_result=mysqli_query($conn,$a_sql);
$applied_total=mysqli_fetch_array($a_result);

$i_sql="select count('1') from jobs where status ='Interviewed'";
$i_result=mysqli_query($conn,$i_sql);
$interviewed_total=mysqli_fetch_array($i_result);

$r_sql="select count('1') from jobs where status ='Rejected'";
$r_result=mysqli_query($conn,$r_sql);
$rejected_total=mysqli_fetch_array($r_result);

$o_sql="select count('1') from jobs where status ='Offered'";
$o_result=mysqli_query($conn,$o_sql);
$offered_total=mysqli_fetch_array($o_result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.tiny.cloud/1/7kainuaawjddfzf3pj7t2fm3qdjgq5smjfjtsw3l4kqfd1h4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Applications</title>

</head>
<body>
    <div class="content">
        <div class="search-bar position-relative">
            <form class="d-flex" id="search-form">
                <i class="bi bi-search search-icon"></i>
                <input class="form-control ps-5 shadow-none" id="search-input" type="search" placeholder="Search by job title, company, location, or status" aria-label="Search" autocorrect="off" autocomplete="off" spellcheck="false">
            </form>
        </div>
        <hr class="mt-2">
        <div class="mt-5"></div>
        <div class="top-content d-flex justify-content-between align-items-center">
            <div class="col ms-5">
                <div class="row">
                    <h2 class="">Applications (<?php echo "$rowtotal[0]"; ?>)</h2>
                </div>
                <div class="row d-inline">
                    <span class="text-secondary" style="font-size: 12px;"><strong>Applied:</strong> <?php echo "$applied_total[0]"; ?></span>
                    <span class="text-secondary" style="font-size: 12px;"><strong>Interviewed:</strong> <?php echo "$interviewed_total[0]"; ?></span>
                    <span class="text-secondary" style="font-size: 12px;"><strong>Rejected:</strong> <?php echo "$rejected_total[0]"; ?></span>
                    <span class="text-secondary" style="font-size: 12px;"><strong>Offered:</strong> <?php echo "$offered_total[0]"; ?></span>
                </div>
            </div>
            <a href="#" class="badge text-bg-success text-decoration-none me-5" data-bs-toggle="modal" data-bs-target="#addApplicationModal">Add Application</a>
        </div>

        <!-- Add Application Modal -->
            <div class="modal fade" id="addApplicationModal" tabindex="-1" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addApplicationModalLabel">Add Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job_title" name="job_title">
                        </div>
                        <div class="mb-3">
                            <label for="job_link" class="form-label">Job Link</label>
                            <input type="text" class="form-control" id="job_link" name="job_link">
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="pay" class="form-label">Pay</label>
                            <input type="text" class="form-control" id="pay" name="pay">
                        </div>
                        <div class="mb-3">
                            <label for="bonus_pay" class="form-label">Bonus Pay  <span class="text-muted" style="font-size: 10px;">Optional</span></label>
                            <input type="text" class="form-control" id="bonus_pay" name="bonus_pay">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Please select one...</option>
                                <option value="Applied">Applied</option>
                                <option value="Interviewed">Interviewed</option>
                                <option value="Offered">Offered</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="job_type">Job Type</label>
                            <select class="form-control" name="job_type">
                                <option value="">Please select one...</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                                <option value="Temporary">Temporary</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="notes">Notes</label>
                            <textarea class="form-control" name="notes" rows="5"></textarea>
                        </div>
                        <div class="row mb-3 ps-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="watchlist" name="watchlist" value="1">
                                <label class="form-check-label" for="watchlist">Add to Watchlist</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="interview_set" name="interview_set" value="1">
                                <label class="form-check-label" for="interview_set">Interview Set</label>
                            </div>
                        </div>
                        <div class="mb-3"></div> 
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="add-application" class="form-btn" value="Add Application">
                    </div>
                        
                    </form>
                </div>
              </div>
            </div>
        <!-- end Add Application Modal -->


        <!-- Success and Failure Toasts -->
        <?php
            session_start(); // Start the session at the top of the script

            if (isset($_SESSION['message'])) {
                $messageType = $_SESSION['message']['type'];
                $messageText = $_SESSION['message']['text'];
            
                echo '<div class="toast-container position-fixed bottom-0 end-0 p-3">';
                echo '<div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">';
                echo '<div class="toast-header">';
                echo '<strong class="me-auto">';
                echo $messageType === 'success' ? '<i class="bi bi-circle-fill text-success" style="font-size: 10px; vertical-align: .125rem !important; margin-top: -100px !important;"></i>&nbsp;&nbsp;' : '<i class="bi      bi-circle-fill text-danger" style="font-size: 10px; vertical-align: .125rem !important; margin-top: -100px !important;"></i>&nbsp;&nbsp;';
                echo ucfirst($messageType);
                echo '</strong>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="toast-body">';
                echo '<strong>' . ucfirst($messageType) . '!</strong> ' . $messageText;
                echo '</div>';
                echo '</div>';
                echo '</div>';
            
                // Clear the message from the session after displaying it
                unset($_SESSION['message']);
            }
        ?>

        <table class="table mx-auto mt-5" style="width: 95%;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Job Title</th>
                    <th scope="col">Company</th>
                    <th scope="col">Location</th>
                    <th scope="col">Applied</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="jobs-table-body">
               
            </tbody>
        </table>
    </div>
            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Function to fetch jobs based on the query
            function fetchJobs(query = '') {
                $.ajax({
                    url: 'search_bar_function.php',
                    method: 'POST',
                    data: { query: query },
                    success: function(data) {
                        $('#jobs-table-body').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }
        
            // Function to fetch job details for Offcanvas
            function fetchJobDetails(jobId) {
                $.ajax({
                    url: 'get_job_details.php', // Update with the actual URL
                    type: 'POST',
                    data: { job_id: jobId },
                    success: function(data) {
                        var canvasContentId = 'app-canvas-content-' + jobId;
                        $('#' + canvasContentId).html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching job details:', status, error);
                    }
                });
            }
        
            // Function to fetch and update job details in the Modal
            function fetchUpdateJobDetails(jobId) {
                $.ajax({
                    url: 'update_job_details.php',
                    type: 'POST',
                    data: { job_id: jobId },
                    success: function(data) {
                        var targetJobId = 'app-modal-' + jobId;
                        var existingModal = document.getElementById(targetJobId);
                    
                        if (!existingModal) {
                            // Create and append Modal dynamically if not exists
                            var modalHtml = `
                                <div class='modal fade' id='${targetJobId}' tabindex='-1' aria-labelledby='updateApplicationModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-xl modal-dialog-scrollable'>
                                        <div class='modal-content'>
                                            ${data}
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('body').append(modalHtml);
                        } else {
                            // Update existing modal content
                            $('#' + targetJobId + ' .modal-content').html(data);
                        }
                    
                        // Initialize and show the Modal
                        var modalElement = document.getElementById(targetJobId);
                        var modal = new bootstrap.Modal(modalElement);
                        modal.show();
                    },
                    error: function(error) {
                        console.error('Error fetching job details:', error);
                    }
                });
            }
        
            // Initial fetch to load all jobs
            fetchJobs();
        
            // Fetch jobs as user types in the search input
            $('#search-input').on('input', function() {
                let query = $(this).val();
                if (query.length >= 3) {
                    fetchJobs(query);
                } else {
                    fetchJobs(); 
                }
            });
        
            // Handling click events to open the Offcanvas
            $(document).on('click', '.view', function() {
                var jobId = $(this).data('job-id');
                fetchJobDetails(jobId);
            
                var targetId = 'app-canvas-' + jobId;
                var existingCanvas = document.getElementById(targetId);
            
                if (!existingCanvas) {
                    // Create and append Offcanvas dynamically if not exists
                    var offcanvasHtml = `
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="${targetId}" aria-labelledby="offcanvasRightLabel">
                            <div class="offcanvas-body" id="app-canvas-content-${jobId}">
                                <!-- Content will be dynamically loaded here -->
                            </div>
                        </div>
                    `;
                    $('body').append(offcanvasHtml);
                }
            
                // Initialize and show the Offcanvas
                var canvasElement = document.getElementById(targetId);
                var canvas = new bootstrap.Offcanvas(canvasElement);
                canvas.show();
            });
        
            // Handling click events to open the Modal
            $(document).on('click', '.edit', function() {
                var jobId = $(this).data('job-id');
                fetchUpdateJobDetails(jobId);
            });
        });

    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var toastElement = document.getElementById('liveToast');
        if (toastElement) {
          var toast = new bootstrap.Toast(toastElement);
          toast.show();
        }
      });
    </script>

    <!-- tinyMCE -->
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap |   removeformat',
      });
    </script>

</body>
</html>
