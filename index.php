<?php
require_once "application_queries.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Applications</title>

</head>
<body>

    <div class="content">
        <div class="search-bar position-relative">
            <form class="d-flex" id="search-form">
                <i class="bi bi-search search-icon"></i>
                <input class="form-control ps-5 shadow-none" id="search-input" type="search" placeholder="Search application, certification, experience, project, and accomplishments" aria-label="Search" autocorrect="off" autocomplete="off" spellcheck="false">
            </form>
        </div>
        <hr class="mt-2">
        <div class="mt-5"></div>
        <div class="top-content d-flex justify-content-between align-items-center">
            <h2 class="ms-5">Applications</h2>
            <a href="#" class="badge text-bg-success text-decoration-none me-5" data-bs-toggle="modal" data-bs-target="#addApplicationModal">Add Application</a>
        </div>

        <!-- Add Application Modal -->
            <div class="modal fade" id="addApplicationModal" tabindex="-1" aria-labelledby="addApplicationModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addApplicationModalLabel">Add Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="" class="mt-4">

                        <div class="row mb-3">
                            <div class="col">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title">
                            </div>
                            <div class="col">
                                <label for="job_link" class="form-label">Job Link</label>
                                <input type="text" class="form-control" id="job_link" name="job_link">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="company" class="form-label">Company</label>
                                <input type="text" class="form-control" id="company" name="company">
                            </div>
                            <div class="col">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="pay" class="form-label">Pay</label>
                                <input type="text" class="form-control" id="pay" name="pay">
                            </div>
                            <div class="col">
                                <label for="bonus_pay" class="form-label">Bonus Pay  <span class="text-muted" style="font-size: 10px;">Optional</span></label>
                                <input type="text" class="form-control" id="bonus_pay" name="bonus_pay">
                            </div>
                            <div class="col">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-control" name="status">
                                    <option value="">Please select one...</option>
                                    <option value="Applied">Applied</option>
                                    <option value="Interviewed">Interviewed</option>
                                    <option value="Offered">Offered</option>
                                    <option value="Rejected">Rejected</option>
                                </select>
                            </div>
                            <div class="col">
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
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label" for="notes">Notes</label>
                                <textarea class="form-control" name="notes" rows="5"></textarea>
                            </div>
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

                        <input type="submit" name="add-application" class="form-btn" value="Add Application">
                        <div class="pb-4"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <!-- end Add Application Modal -->
         

        <!-- Update Application Modal -->
<div class="modal fade" id="updateApplicationModal" tabindex="-1" aria-labelledby="updateApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateApplicationModalLabel">Update Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateApplicationForm" method="POST" action="update_job.php">
                    <input type="hidden" id="update-job-id" name="job_id">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="update-job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="update-job_title" name="job_title">
                        </div>
                        <div class="col">
                            <label for="update-job_link" class="form-label">Job Link</label>
                            <input type="text" class="form-control" id="update-job_link" name="job_link">
                        </div>
                    </div>
                    <!-- Add other fields as needed -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="update-company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="update-company" name="company">
                        </div>
                        <div class="col">
                            <label for="update-location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="update-location" name="location">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="update-pay" class="form-label">Pay</label>
                            <input type="text" class="form-control" id="update-pay" name="pay">
                        </div>
                        <div class="col">
                            <label for="update-bonus_pay" class="form-label">Bonus Pay</label>
                            <input type="text" class="form-control" id="update-bonus_pay" name="bonus_pay">
                        </div>
                        <div class="col">
                            <label class="form-label" for="update-status">Status</label>
                            <select class="form-control" id="update-status" name="status">
                                <option value="">Please select one...</option>
                                <option value="Applied">Applied</option>
                                <option value="Interviewed">Interviewed</option>
                                <option value="Offered">Offered</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label" for="update-job_type">Job Type</label>
                            <select class="form-control" id="update-job_type" name="job_type">
                                <option value="">Please select one...</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Internship">Internship</option>
                                <option value="Temporary">Temporary</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label" for="update-notes">Notes</label>
                            <textarea class="form-control" id="update-notes" name="notes" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3 ps-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="update-watchlist" name="watchlist" value="1">
                            <label class="form-check-label" for="update-watchlist">Add to Watchlist</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="update-interview_set" name="interview_set" value="1">
                            <label class="form-check-label" for="update-interview_set">Interview Set</label>
                        </div>
                    </div>
                    <input type="submit" name="update-application" class="form-btn" value="Update Application">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Update Application Modal -->


<?php if (isset($_GET['update_success'])): ?>
    <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Application updated successfully.
    </div>
<?php elseif (isset($_GET['update_error'])): ?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong> There was an issue updating the application.
    </div>
<?php endif; ?>



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

    <script src="applications.js"></script>

</body>
</html>
