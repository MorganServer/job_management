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

    // Handling click events to open the Edit Modal
    $(document).on('click', '.edit', function() {
        var jobId = $(this).data('job-id');
        fetchJobDetails(jobId);
    });

    function fetchJobDetails(jobId) {
        $.ajax({
            url: 'get_job_details.php',
            method: 'POST',
            data: { job_id: jobId },
            success: function(data) {
                var job = JSON.parse(data);
                $('#edit-job-id').val(job.job_id);
                $('#edit-job_title').val(job.job_title);
                $('#edit-job_link').val(job.job_link);
                $('#edit-company').val(job.company);
                $('#edit-location').val(job.location);
                $('#edit-pay').val(job.pay);
                $('#edit-bonus_pay').val(job.bonus_pay);
                $('#edit-status').val(job.status);
                $('#edit-job_type').val(job.job_type);
                $('#edit-notes').val(job.notes);
                $('#edit-watchlist').prop('checked', job.watchlist == '1');
                $('#edit-interview_set').prop('checked', job.interview_set == '1');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }
});
