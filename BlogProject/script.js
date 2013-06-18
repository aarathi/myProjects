$(document).ready(function() {
    $("#login").click(function()
    {
        $("#loginForm").fadeIn(1000);
    });  
    
    
    
    $("#loginButton").click(function(e) {
        
        var email = $('#email').val();
        var password = $('#password').val();
        
        $.ajax({
            type: 'POST',
            url: "login.php",
            dataType: 'html',
            data: "email=" + email + "&password=" + password,
             success: function(data) {
               alert(data);
               if (data == 'successfully logged in')
               {
                   window.location.href = "index.php";
               }
               else
               {
                   $("#info").html(data);
               }
           }
        });

    });

});

