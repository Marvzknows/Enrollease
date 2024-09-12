$(document).ready(function () {
    $('#submit_form_btn').click(function () {
        // image
        // var form_data = new FormData();
        // var image = $('#image')[0].files;
        // // iamge data to pass
        // form_data.append('my_image',image[0]);

        // learner's data
        var schoolyear = $('.select_school_year').val();
        var fname = $('.fname').val();
        var mname = $('.mname').val(); //optional
        var lname = $('.lname').val();

        var level_section = $('.level_section').val();
        var lrn = $('.lrn').val();  //optional
        var mother_tongue = $('.mother_tongue').val();
        var birth_place = $('.birth_place').val();
        var selectedGender = $('input[name="gender"]:checked').val();
        var bday = $('.bday').val();

        // learner's address
        var house_no = $('.house_no').val();
        var street_name = $('.street_name').val();
        var barangay = $('.barangay').val();
        var municipality = $('.municipality').val();
        var province = $('.province').val();
        var country = $('.country').val();
        var zip_code = $('.zip_code').val();

        // father's data
        var father_fname = $('.father_fname').val();
        var father_mname = $('.father_mname').val(); //optional
        var father_lname = $('.father_lname').val();
        var father_number = $('.father_number').val();

        // mother's data
        var mother_fname = $('.mother_fname').val();
        var mother_mname = $('.mother_mname').val(); //optional
        var mother_lname = $('.mother_lname').val();
        var mother_number = $('.mother_number').val();

        // Guardian's data
        var guardian_fname = $('.guardian_fname').val();
        var guardian_mname = $('.guardian_mname').val(); //optional
        var guardian_lname = $('.guardian_lname').val();
        var guardian_number = $('.guardian_number').val();

        // Form validation
        if(schoolyear == '' || fname == '' || lname == '' || level_section == '' || lrn == '' || mother_tongue == ''|| birth_place == '' || selectedGender == '' || bday == '' || house_no == '' 
        || street_name == '' || barangay == '' || municipality == '' || province == '' || country == '' || zip_code == '' 
        || father_fname == '' || father_lname == '' || father_number == ''
        || mother_fname == '' || mother_lname == '' || mother_number == ''
        || guardian_fname == '' || guardian_lname == '' || guardian_number == '')
        {
            $('.error_mssg').text('Please make sure you fill up all the required requirements');

           
        }else{

            $.ajax({
                type: 'POST',
                url: "enrollment/enrollprocess.php",
                data: {
                    // learner's information
                    'button':true,
                    // 'form_data':form_data,
                    'schoolyear':schoolyear,
                    'fname':fname,
                    'mname':mname,
                    'lname':lname,
                    'level_section':level_section,
                    'lrn':lrn,
                    'mother_tongue':mother_tongue,
                    'birth_place':birth_place,
                    'selectedGender':selectedGender,
                    'bday':bday,
                    // learner's address
                    'house_no':house_no,
                    'street_name':street_name,
                    'barangay':barangay,
                    'municipality':municipality,
                    'province':province,
                    'country':country,
                    'zip_code':zip_code,
                    // father's data
                    'father_fname':father_fname,
                    'father_mname':father_mname,
                    'father_lname':father_lname,
                    'father_number':father_number,
                    // Mother's data
                    'mother_fname':mother_fname,
                    'mother_mname':mother_mname,
                    'mother_lname':mother_lname,
                    'mother_number':mother_number,
                    // guardian's data
                    'guardian_fname':guardian_fname,
                    'guardian_mname':guardian_mname,
                    'guardian_lname':guardian_lname,
                    'guardian_number':guardian_number,
                },
                success: function(result){
                    swal({
                        title: result,
                        icon: "success",
                        button: "ok",
                    });
                    $('.error_mssg').text('');
                }
            });
        }
        
        
        // AJAX


        // console.log('schoolyear');
      
    })

    $('.reset_btn').click(function(){
        $('.error_mssg').text('');
    })
});


