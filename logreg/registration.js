$(document).ready(function () {

    // Registration Modal
    $('#registrationModalButton').click(function () { 
        $('#registerModal').modal('show');
    });

    // Register Button & Form Validation
    $('#registerAccountButton').click(function () { 

        var fname = $('#fname').val();
        var mname = $('#mname').val();
        var lname = $('#lname').val();
        var contactNumber = $('#contactNumber').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var birthday = $('#birthday').val();
        var gender = $('#gender').val();

        // Email Validation Regex
        var emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;

        // Form validation
        if(fname === ''){
            $('#fnameError').text('This field is required');
        }else{
            $('#fnameError').text('');
        }

        if(mname === ''){
            $('#mnameError').text('This field is required');
        }else{
            $('#mnameError').text('');
        }

        if(lname === ''){
            $('#lnameError').text('This field is required');
        }else{
            $('#lnameError').text('');
        }

        if(contactNumber === ''){
            $('#contactNumberError').text('This field is required');
        }else{
            $('#contactNumberError').text('');
        }

        if (email === '') {
            $('#emailError').text('This field is required');
        } else if (!emailRegex.test(email)) {
            $('#emailError').text('Invalid email format');
        } else {
            $('#emailError').text('');
        }

        if(password === ''){
            $('#passwordError').text('This field is required');
        }else{
            $('#passwordError').text('');
        }

        if(birthday === ''){
            $('#bdayError').text('This field is required');
        }else{
            $('#bdayError').text('');
        }

        if(gender === ''){
            $('#genderError').text('This field is required');
        }else{
            $('#genderError').text('');
        }

        if (fname && mname && lname && contactNumber &&
            email && password && birthday && gender !== '') {

            if (!emailRegex.test(email)) {
                $('#emailError').text('Invalid email format');
            } else {

                $('#emailError').text('');
                // Passing data to server
                $.ajax({
                    type: "post",
                    url: "logreg/regprocess.php",
                    data: {
                        'fname': fname,
                        'mname': mname,
                        'lname': lname,
                        'contactNumber': contactNumber,
                        'email': email,
                        'password': password,
                        'birthday': birthday,
                        'gender': gender,
                    },
                    success: function (response) {
                        if (response.startsWith('ERROR')) {
                            swal({
                                title: "Oops!",
                                text: response,
                                icon: "warning",
                                button: "I understand",
                            });
                        } else {
                            $('#registerModal').modal('hide');
                            $('#registrationModalForm').trigger('reset');
                            swal({
                                title: "REGISTERED",
                                text: response,
                                icon: "success",
                                button: "ok",
                            });
                        }
                    }
                });
            }
                
        }
    });
});