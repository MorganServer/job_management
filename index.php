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
            <a href="/console/application/add-application" class="badge text-bg-success text-decoration-none me-5">Add Application</a>
        </div>
        
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

    <script src="backend/applications.js"></script>

</body>
</html>
