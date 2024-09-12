$(document).ready(function () {

    function checkOldPassword(oldPassword,newPassword,teacherId,oldPassErrorField){
        $.ajax({
            type: "post",
            url: "../TeacherPHP/changePassword.php",
            data: {
                'teacherId':teacherId,
                'newPassword':newPassword,
                'oldPassword':oldPassword,
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 'success')
                {
                    swal({
                        title: "YOU'RE ALL SET!",
                        text: response.message,
                        icon: "success",
                        button: "Continue",
                    }).then(function () {
                        window.location.href = "../teacherLogin.php"; //Relogin para itest new pass ng acc
                    });
                    console.log(response.message);
                }
                if(response.status == 'failed') //Pag d same password paren nilagay
                {
                    oldPassErrorField.text(response.message);
                    console.log(response.message);
                }

                if(response.status == 'error')
                {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX Error: " + status + " - " + error);
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    $('#saveChangePassBtn').click(function (e) { 
        e.preventDefault();
        // References
        var teacherId = $('#sessionTeacherId').val();
        var oldPassVal = $('#oldPassword').val();
        var newPassVal = $('#newPassword').val();
        var confirmPassVal = $('#confirmNewPassword').val();
        // Errors
        var oldPassError = $('#oldPassError');
        var newPassError = $('#newPassError');
        var confirmNewPassError = $('#confirmNewPassError');
        // Counter
        var isOldPassValid = false;
        var isNewPasValid = false;
        var isConfirmPassValid = false;

        if(oldPassVal.length > 0){
            isOldPassValid = true;
            oldPassError.text('');
        }else{
            oldPassError.text('Invalid Password');
            isOldPassValid = false;
        }

        if(newPassVal.length > 0){
            if(newPassVal.length < 8){
                isNewPasValid = false;
                newPassError.text('New Password must be at least 8 characters');
            }else{
                isNewPasValid = true;
                newPassError.text('');
            }
        }else{
            isNewPasValid = false;
            newPassError.text('Invalid New Password');
        }

        if(confirmPassVal.length > 0){
            if(confirmPassVal == newPassVal){
                isConfirmPassValid = true;
                confirmNewPassError.text('');
            }else{
                isConfirmPassValid = false;
                confirmNewPassError.text('Password did not match');
            }
        }else{
            isConfirmPassValid = false;
            confirmNewPassError.text('Invalid New Password')
        }

        // PAG MAY TRUE NA LAHAT, CHECK FOR AJAX PASWORD SA BABA
        if(isConfirmPassValid && isNewPasValid && isOldPassValid)
        {
            checkOldPassword(oldPassVal,newPassVal,teacherId,oldPassError);
        }
    });


    // Old password show/hide password
    $('#oldpass_eyeIcon').click(function (e) { 
        var old_passwordInputField = $('#oldPassword');

        if(old_passwordInputField.attr('type') == 'text') {
            // Change to Password
            old_passwordInputField.attr('type', 'password');
            $('#oldpass_eyeIcon').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            // Change to text
            old_passwordInputField.attr('type', 'text');
            $('#oldpass_eyeIcon').removeClass('fa-eye').addClass('fa-eye-slash');
        }        
    });

    // New password show/hide
    $('#newpass_eyeIcon').click(function (e) { 
        var new_passwordInputField = $('#newPassword');

        if(new_passwordInputField.attr('type') == 'text') {
            // Change to Password
            new_passwordInputField.attr('type', 'password');
            $('#newpass_eyeIcon').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            // Change to text
            new_passwordInputField.attr('type', 'text');
            $('#newpass_eyeIcon').removeClass('fa-eye').addClass('fa-eye-slash');
        }        
    });

    // 
    $('#confirmpass_eyeIcon').click(function (e) { 
        var confirmNew_passwordInputField = $('#confirmNewPassword');

        if(confirmNew_passwordInputField.attr('type') == 'text') {
            // Change to Password
            confirmNew_passwordInputField.attr('type', 'password');
            $('#confirmpass_eyeIcon').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            // Change to text
            confirmNew_passwordInputField.attr('type', 'text');
            $('#confirmpass_eyeIcon').removeClass('fa-eye').addClass('fa-eye-slash');
        }        
    });

});