<?php
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'] ;
    // Use $userId as needed
} else {
    // Redirect to login page or handle the case where the user is not logged in
    header('Location: logOut.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Advanced Event Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

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
                <?php
                   echo '<li class="nav-item"><a class="nav-link">Hi ' .$username.'</a></li>';
                ?> 
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link" href="logOut.php">Log Out</a>
                </li>     
            </ul>
        </div>
    </nav>
    
    <!-- Search and Filter Section -->    
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <input type="text" id="searchInput" class="form-control" placeholder="Search events...">
            </div>
            <div class="col-md-2">
                <input type="date" id="filterDate" class="form-control">
            </div>
            <div class="col-md-2">
                <select id="eventCount" class="form-control">
                    <option value="10">10 per page</option>
                    <option value="20">20 per page</option>
                    <option value="30">30 per page</option>
                </select>
            </div>
            <div class="col-md-2">
                <button id="searchEventBtn" class="btn btn-primary btn-block">Search</button>
            </div>
            <div class="col-md-2">
                <button id="addEventButton" class="btn btn-primary btn-block">Add Event</button>
            </div>
        </div>
        <hr class="mt-4">
    </div>



    <!-- Popup Form -->
    <div id="eventFormModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm"  enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="eventTitle">Title</label>
                        <input type="text" class="form-control" id="eventTitle" placeholder="Enter event title" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDescription">Description</label>
                        <textarea class="form-control" id="eventDescription" rows="3" placeholder="Enter event description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" required>
                    </div>
                    <div class="form-group">
                        <label for="eventTime">Event Time</label>
                        <input type="time" class="form-control" id="eventTime" required>
                    </div>
                    <div class="form-group">
                        <label for="eventImage">Upload Image</label>
                        <input type="file" class="form-control-file" id="eventImage" name="image">
                    </div>
                </form>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" id="saveEvent">Save Event</button>
                <button type="button" class="btn btn-secondary" id="updateEvent" style="display: none;">Update Event</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>



    <!-- Upcoming Events List -->
    <div class="container mt-4">
        <div class="row" id="eventsList">
            
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
   
    
</body>
</html>
