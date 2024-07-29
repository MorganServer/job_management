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

    $(document).on('click', '.view', function() {
        var jobId = $(this).data('job-id');
        fetchJobDetails(jobId);
    
        // Initialize and show the modal
        var modalElement = document.getElementById('jobDetailsModal');
        var modal = new bootstrap.Modal(modalElement);
        modal.show();
    });
    
    function fetchJobDetails(jobId) {
        $.ajax({
            url: 'get_job_details.php',
            type: 'GET',
            data: { job_id: jobId },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    $('#job-details-content').html('<p>Job not found</p>');
                } else {
                    // Populate modal content with job details
                    var contentHtml = `
                        <p><strong>Job Title:</strong> ${data.job_title}</p>
                        <p><strong>Company:</strong> ${data.company}</p>
                        <p><strong>Location:</strong> ${data.location}</p>
                        <p><strong>Pay:</strong> ${data.pay}</p>
                        <p><strong>Bonus Pay:</strong> ${data.bonus_pay}</p>
                        <p><strong>Status:</strong> ${data.status}</p>
                        <p><strong>Job Type:</strong> ${data.job_type}</p>
                        <p><strong>Notes:</strong> ${data.notes}</p>
                    `;
                    $('#job-details-content').html(contentHtml);
                }
            },
            error: function(error) {
                console.error('Error fetching job details:', error);
                $('#job-details-content').html('<p>An error occurred while fetching job details</p>');
            }
        });
    }


});

