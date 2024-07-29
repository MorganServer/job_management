$(document).ready(function() {
    console.log('JavaScript loaded');
    // Function to fetch jobs based on the query
    function fetchJobs(query = '') {
        console.log('Fetching jobs with query:', query); // Debug statement
        $.ajax({
            url: 'search_bar_function.php',
            method: 'POST',
            data: { query: query },
            success: function(data) {
                console.log('Jobs fetched successfully'); // Debug statement
                $('#jobs-table-body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    // Initial fetch to load all jobs
    fetchJobs();

    // Fetch jobs as user types in the search input
    $('#search-input').on('input', function() {
        let query = $(this).val();
        if (query.length >= 3) {
            console.log('Search query:', query); // Debug statement
            fetchJobs(query);
        } else {
            fetchJobs(); // Reload all jobs if query is less than 3 characters
        }
    });

    // Handling click events to open the Offcanvas
    $(document).on('click', '.view', function() {
        var jobId = $(this).data('job-id');
        console.log('View button clicked. Job ID:', jobId); // Debug statement
        fetchJobDetails(jobId);

        var targetId = 'app-canvas-' + jobId;
        var existingCanvas = document.getElementById(targetId);

        if (!existingCanvas) {
            console.log('Creating new Offcanvas:', targetId); // Debug statement
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
        console.log('Edit button clicked. Job ID:', jobId); // Debug statement
        fetchUpdateJobDetails(jobId);
    });
});

// Function to fetch and update job details in the Modal
function fetchUpdateJobDetails(jobId) {
    console.log('Fetching update details for Job ID:', jobId); // Debug statement
    $.ajax({
        url: 'update_job_details.php',
        type: 'POST',
        data: { job_id: jobId },
        success: function(data) {
            console.log('Update details fetched successfully'); // Debug statement
            var targetJobId = 'app-modal-' + jobId;
            var existingModal = document.getElementById(targetJobId);

            if (!existingModal) {
                console.log('Creating new Modal:', targetJobId); // Debug statement
                // Create and append Modal dynamically if not exists
                var modalHtml = `
                    <div class='modal fade' id='${targetJobId}' tabindex='-1' aria-labelledby='updateApplicationModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-xl'>
                            <div class='modal-content'>
                                ${data}
                            </div>
                        </div>
                    </div>
                `;
                $('body').append(modalHtml);
            } else {
                console.log('Updating existing Modal content:', targetJobId); // Debug statement
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
