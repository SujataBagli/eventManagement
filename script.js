$(document).ready(function() {     
   
    fetchEvents();
    // Handle search button click
    $('#searchEventBtn').click(function() {
        let title = $('#searchInput').val().trim();
        let date = $('#filterDate').val();
        let limit = $('#eventCount').val(); // Assuming there's a dropdown for limit        
        fetchEvents(title, date, limit);
    });

    // Handle pagination dropdown change
    $('#eventCount').change(function() {
        let title = $('#searchInput').val().trim();
        let date = $('#filterDate').val();
        let limit = $(this).val();       
        fetchEvents(title, date, limit);
    });

    function fetchEvents(title = '', date = '', limit = 10) {
        console.log(title, date, limit);
        $.ajax({
            url: 'getAllEvent.php',
            method: 'GET',
            data: {
                title: title,
                date: date,
                limit: limit
            },
            dataType: 'json',
            success: function(response)  {       
                var jsonResponse = JSON.parse(response);
                var hideIcon = jsonResponse.hide;
               
                var events = jsonResponse.getEvents;                 
                let eventsList = $('#eventsList');
                eventsList.empty(); // Clear the current list
                
                if(hideIcon == 1){
                    events.forEach(function(event) {
                        let eventItem = `
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body list d-flex">
                                        <div class="text-content" style="flex: 1;">
                                            <h5 class="card-title">${event.title}</h5>
                                            <p class="card-text">${event.description}</p>
                                            <p class="card-text"><small class="text-muted">Date: ${event.eventDate} | Time: ${event.eventTime}</small></p>
                                        </div>
                                        <div class="image-content" style="flex: 1; background-image: url('${event.image ? event.image : 'uploads/Screenshot 2024-08-11 224925.png'}');"></div>
                                    </div>
                                </div>
                            </div>
                        `;
                        eventsList.append(eventItem);
                    });
                }else{
                    events.forEach(function(event) {
                        let eventItem = `
                            <div class="col-md-6">
                                <div class="card mb-3">
                                    <div class="card-body list d-flex">
                                        <div class="text-content" style="flex: 1;">
                                            <h5 class="card-title">${event.title}</h5>
                                            <p class="card-text">${event.description}</p>
                                            <p class="card-text"><small class="text-muted">Date: ${event.eventDate} | Time: ${event.eventTime}</small></p>
                                            <button class="edit-icon btn" data-id="${event.id}">
                                                <i class="bi bi-pencil" style="font-size: 1.5rem; opacity: 0.8;"></i>
                                            </button>
                                            <button class="delete-icon btn" data-id="${event.id}">
                                                <i class="bi bi-trash" style="font-size: 1.5rem; opacity: 0.8;"></i>
                                            </button>
                                        </div>
                                        <div class="image-content" style="flex: 1; background-image: url('${event.image ? event.image : 'uploads/Screenshot 2024-08-11 224925.png'}');"></div>
                                    </div>
                                </div>
                            </div>
                        `;
                        eventsList.append(eventItem);
                    });

                }                
            },
            error: function(error) {
                console.log("Error fetching events:", error);
            }
        });
    }

    $('#registerForm').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();            
        var confirmPassword = $("#confirmPassword").val();      

        if(password !== confirmPassword){
            alert("password not matching");
            return ;                
        }else{
            $.ajax({
                type: 'POST',
                url: 'authenticate.php',
                data: {
                    username: username,
                    email: email,
                    password: password,
                    confirmPassword: confirmPassword,
                    function: 'registerUser'
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    console.log(jsonResponse);
                    if(jsonResponse.err){
                        alert(jsonResponse.errMsg);
                        return;
                    }else{
                        alert(jsonResponse.successMsg);                                                                
                    }
                    $("#registerForm")[0].reset();                  
                    window.location.href = "login.php";   
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }


    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var username = $("#username").val();        
        var password = $("#password").val();    

        if(username == '' || password == ''){
            alert("Please enter the username and Password");
            return ;                
        }else{
            $.ajax({
                type: 'POST',
                url: 'authenticate.php',
                data: {
                    username: username,
                    password: password,
                    function: 'verifyrUser'
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    console.log(jsonResponse);
                    if(jsonResponse.err){
                        alert(jsonResponse.errMsg);
                        return;
                    }else{
                        //$('#navbarNav .navbar-nav').append(navLinks);
                        //alert(jsonResponse.successMsg);                                             
                    }
                    $("#loginForm")[0].reset();                  
                    window.location.href = "home.php";   
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }


    });
    $('#addEventButton').click(function() {
        editingEventId = null; // Clear any previous event ID
        $('#eventFormModal').modal('show');
        $('#saveEvent').show();
        $('#updateEvent').hide();
    });
    $('#saveEvent').click(function(e) {
        e.preventDefault(); // Prevent default form submission
        e.stopPropagation();
        
        // Check if all required fields are filled
        let isValid = true;
        $('#eventForm input[required], #eventForm textarea[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid'); // Add invalid class to highlight the field
            } else {
                $(this).removeClass('is-invalid'); // Remove invalid class if field is filled
            }
        });

        if (isValid) {
            var formData = new FormData();
            formData.append('title', $('#eventTitle').val());
            formData.append('description', $('#eventDescription').val());
            formData.append('eventDate', $('#eventDate').val());
            formData.append('eventTime', $('#eventTime').val());
            formData.append('image', $('#eventImage')[0].files[0]);            
            $.ajax({
                url: 'createEvent.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    console.log(jsonResponse);
                    if(jsonResponse.err){
                        alert(jsonResponse.errMsg);
                        return;
                    }else{     
                        alert(jsonResponse.successMsg);                                                                               
                    }             
                    $('#eventFormModal').modal('hide');
                    $('#eventForm')[0].reset(); // Reset the form after submission
                    // Optionally, you can refresh the event list here
                    fetchEvents();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            alert("Please fill out all required fields.");
        }
    });

    let editingEventId = null;     

    $(document).on('click', '.edit-icon', function() {
        editingEventId = $(this).data('id');      
        $.ajax({
            url: 'getSingleEvent.php', 
            method: 'GET',
            data: { id: editingEventId },
            dataType: 'json',
            success: function(response) {                
                $('#eventTitle').val(response.title);
                $('#eventDescription').val(response.description);
                $('#eventDate').val(response.eventDate);
                $('#eventTime').val(response.eventTime);
                // Set image if necessary (e.g., show a preview or update an image field)
                $('#eventFormModal').modal('show'); // Show the modal
                $('#saveEvent').hide();
                $('#updateEvent').show().data('id', editingEventId);
                
            },
            error: function() {
                alert('Failed to retrieve event data.');
            }
        });
    });   
    $('#updateEvent').click(function(e) {
        e.preventDefault(); // Prevent default form submission     
        let isValid = true;
        $('#eventForm input[required], #eventForm textarea[required]').each(function() {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass('is-invalid'); // Add invalid class to highlight the field
            } else {
                $(this).removeClass('is-invalid'); // Remove invalid class if field is filled
            }
        });        
        $('#eventFormModal .modal-title').text('Edit Event');
        if (isValid) {
            var formData = new FormData();
            formData.append('id', $(this).data('id'));
            formData.append('title', $('#eventTitle').val());
            formData.append('description', $('#eventDescription').val());
            formData.append('eventDate', $('#eventDate').val());
            formData.append('eventTime', $('#eventTime').val());
            formData.append('image', $('#eventImage')[0].files[0]);
            $.ajax({
                url: 'updateEvent.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    console.log(jsonResponse);
                    if(jsonResponse.err){
                        alert(jsonResponse.errMsg);
                        return;
                    }else{     
                        alert(jsonResponse.successMsg);                                                                               
                    }             
                    $('#eventFormModal').modal('hide');
                    $('#eventForm')[0].reset(); // Reset the form after submission
                    // Optionally, you can refresh the event list here
                    fetchEvents();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });            
        } else {
            alert("Please fill out all required fields.");
        }
    });    
    $(document).on('click', '.delete-icon', function() {
        var eventId = $(this).data('id');
        
        if (confirm('Are you sure you want to delete this event?')) {
            $.ajax({
                url: 'deleteEvent.php', // Your delete endpoint
                method: 'POST',
                data: { id: eventId },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    console.log(jsonResponse);
                    if(jsonResponse.err){
                        alert(jsonResponse.errMsg);
                        return;
                    }else{     
                        alert(jsonResponse.successMsg);                                                                               
                    }     
                    fetchEvents();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Failed to delete the event.');
                }
            });
        }
    });   

});