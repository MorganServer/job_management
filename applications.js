$(document).ready(function() {
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

    // Initial fetch to load all jobs
    fetchJobs();

    $('#search-input').on('input', function() {
        let query = $(this).val();
        if (query.length >= 3) {
            fetchJobs(query);
        } else {
            fetchJobs(); // Reload all jobs if query is less than 3 characters
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

    // Handling click events to open the Update Modal
    $(document).on('click', '.edit', function() {
        var jobId = $(this).data('job-id');
        fetchJobForUpdate(jobId);

        // Show the modal
        var updateModal = new bootstrap.Modal(document.getElementById('updateApplicationModal'));
        updateModal.show();
    });

    function fetchJobDetails(jobId) {
        $.ajax({
            url: 'get_job_details.php',
            method: 'POST',
            data: { job_id: jobId },
            success: function(data) {
                $(`#app-canvas-content-${jobId}`).html(data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    function fetchJobForUpdate(jobId) {
        $.ajax({
            url: 'get_job_details.php', // Reuse this script to get job details
            method: 'POST',
            data: { job_id: jobId },
            success: function(data) {
                var job = JSON.parse(data); // Assuming the data is JSON
                $('#update-job-id').val(job.id);
                $('#update-job_title').val(job.job_title);
                $('#update-job_link').val(job.job_link);
                $('#update-company').val(job.company);
                $('#update-location').val(job.location);
                $('#update-pay').val(job.pay);
                $('#update-bonus_pay').val(job.bonus_pay);
                $('#update-status').val(job.status);
                $('#update-job_type').val(job.job_type);
                $('#update-notes').val(job.notes);
                $('#update-watchlist').prop('checked', job.watchlist == 1);
                $('#update-interview_set').prop('checked', job.interview_set == 1);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }
});
