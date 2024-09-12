$(document).ready(function () {

    $('#login_btn').click(function (e) { 
        e.preventDefault();
        
        // alert('clicked login btn');
        var username = $('#username').val();
        var password = $('#password').val();

        // VALIDATION 
        if(username == ''){
            $('#usernameError').text('Invalid Username');
        }else{
            $('#usernameError').text('');
        }
        
        if(password == ''){
            $('#passwordError').text('Invalid Password');
        }else{
            $('#passwordError').text('');
        }

        if (username && password !== '') {
            // AJAX
            $.ajax({
                type: "post",
                url: "logreg/loginprocess.php",
                data: {
                    'username': username,
                    'password': password,
                },
                success: function (response) {
                    if (response === 'success') {
                        window.location.href = "dashboard.php"; // Redirect to the dashboard or any other page
                    } else {
                        swal({
                            title: "Account not Found",
                            text: "The admin account you entered do not exist",
                            icon: "error",
                            button: "ok",
                        });
                    }
                }
            });
        }


    });

    // Showpassword btn
    $(document).on('click','#eyeIcon', function () { 
        var passwordInputField = $('#password');
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