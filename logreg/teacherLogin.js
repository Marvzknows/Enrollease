$(document).ready(function () {
    // alert('test');
    $('#teacherLoginButton').click(function (e) { 
        e.preventDefault();
        
        // References
        var username = $('#username').val().trim().replace(/\s+/g, " ");
        var password = $('#teacherPassword').val().trim().replace(/\s+/g, " ");
        // Errors
        var usernameError = $('#usernameError');
        var passwordError = $('#passwordErrorMssg');
        // Counter
        var isUsernameValid = false;
        var isPasswrodValid = false;

        if (username.length > 0){
            isUsernameValid = true;
            usernameError.text('');
        }else{
            usernameError.text('Invalid Username');
        }

        if(password.length > 0){
            isPasswrodValid = true;
            passwordError.text('');
        }else{
            passwordError.text('Invalid Password');
        }

        if(isPasswrodValid && isUsernameValid){
            // alert('ajax na');
            $.ajax({
            type: "post",
            url: "logreg/teacherLoginProcess.php",
            data: {
                'username': username,
                'password': password,
            },
            success: function (response) {
                if (response.status == "success") {
                    window.location.href = "TeacherSide/index.php";
                }
                // error here
                if (response.status == "error") {
                    swal({
                        title: response.message,
                        text: "The account you entered does not exist in our records",
                        icon: "error",
                        button: "Ok",
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert(
                "An error occurred while processing your request. Please try again later."
                );
            },
            });
        }
    });

    // Show password
    $(document).on('click','#eyeIcon', function () { 
        var passwordInputField = $('#teacherPassword');
        var showPasswordToggle = $('#showPasswordToggle'); // icon

        if(passwordInputField.attr('type') == 'text') {
            // Change to Password
            passwordInputField.attr('type', 'password');
            $('#eyeIcon').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            // Change to text
            passwordInputField.attr('type', 'text');
            $('#eyeIcon').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });
    
});