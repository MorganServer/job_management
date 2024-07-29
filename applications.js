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

    // Handling click events to open the off-canvas
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

    // Handling click events to open the edit modal
    $(document).on('click', '.edit', function() {
        var jobId = $(this).data('job-id');
        fetchJobDetailsForModal(jobId);

        // Show the edit modal
        var editModal = new bootstrap.Modal(document.getElementById('editApplicationModal'));
        editModal.show();
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

    function fetchJobDetailsForModal(jobId) {
        $.ajax({
            url: 'get_job_details.php',
            method: 'POST',
            data: { job_id: jobId },
            success: function(data) {
                var jobDetails = JSON.parse(data);
                
                $('#edit-job-id').val(jobDetails.job_id);
                $('#edit-job_title').val(jobDetails.job_title);
                $('#edit-job_link').val(jobDetails.job_link);
                $('#edit-company').val(jobDetails.company);
                $('#edit-location').val(jobDetails.location);
                $('#edit-pay').val(jobDetails.pay);
                $('#edit-bonus_pay').val(jobDetails.bonus_pay);
                $('#edit-status').val(jobDetails.status);
                $('#edit-job_type').val(jobDetails.job_type);
                $('#edit-notes').val(jobDetails.notes);
                $('#edit-watchlist').prop('checked', jobDetails.watchlist == 1);
                $('#edit-interview_set').prop('checked', jobDetails.interview_set == 1);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }
});
