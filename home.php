<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Advanced Event Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Advanced Event Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="register.php">Register</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Search and Filter Section -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <input type="text" id="searchInput" class="form-control" placeholder="Search events...">
            </div>
            <div class="col-md-4">
                <input type="date" id="filterDate" class="form-control">
            </div>
        </div>
    </div>

    <!-- Upcoming Events List -->
    <div class="container mt-4">
        <div class="row" id="eventsList">
            <!-- Example of Event Item (this should be populated dynamically) -->
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Event Title</h5>
                        <p class="card-text">Event Description</p>
                        <p class="card-text"><small class="text-muted">Date: 2024-09-01 | Time: 10:00 AM</small></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Event Title</h5>
                        <p class="card-text">Event Description</p>
                        <p class="card-text"><small class="text-muted">Date: 2024-09-01 | Time: 10:00 AM</small></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Event Title</h5>
                        <p class="card-text">Event Description</p>
                        <p class="card-text"><small class="text-muted">Date: 2024-09-01 | Time: 10:00 AM</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
   
    
</body>
</html>
