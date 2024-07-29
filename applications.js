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

// Handling click events to open the Modal
$(document).on('click', '.edit', function() {
    var jobId = $(this).data('job-id');
    fetchUpdateJobDetails(jobId);

    var targetJobId = 'app-modal-' + jobId;
    var existingModal = document.getElementById(targetJobId);

    if (!existingModal) {
        // Create and append Modal dynamically if not exists
        var modalHtml = `
            <div class='modal fade' id='${targetJobId}' tabindex='-1' aria-labelledby='updateApplicationModalLabel' aria-hidden='true'>
                <div class='modal-dialog modal-xl'>
                    <div class='modal-content'>
                        <!-- Content will be dynamically loaded here -->
                    </div>
                </div>
            </div>
        `;
        $('body').append(modalHtml);
    }

    // Initialize and show the Modal
    var modalElement = document.getElementById(targetJobId);
    var modal = new bootstrap.Modal(modalElement);
    modal.show();
});


});

