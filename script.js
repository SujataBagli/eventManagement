$(document).ready(function() {   
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




});