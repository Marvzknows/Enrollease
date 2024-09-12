$(document).ready(function () {

    // balik aral radio button
    $('input[type="radio"][name="balik_aral"]').change(function(){
        if($('#yes').is(':checked')){
            // alert('balik aral sya guys');
            $('#last_level_completed').prop('disabled',false);
            $('#last_sy_completed').prop('disabled',false);
            $('#last_school').prop('disabled',false);

        }else if($('#no').is(':checked')){
            $('#last_level_completed').prop('disabled',true);
            $('#last_sy_completed').prop('disabled',true);
            $('#last_school').prop('disabled',true);
            // clear input field
            $('#last_level_completed').val('');
            $('#last_sy_completed').val('');
            $('#last_school').val('');
        }
    });

    // submit form button
    $('#submit_form_btn').click(function () {
        
        // image
        // var form_data = new FormData();
        // var image = $('#image')[0].files;
        // // iamge data to pass
        // form_data.append('my_image',image[0]);

        // balik aral
        var balik_aral = $('input[name="balik_aral"]:checked').length;

        // learner's data
        var schoolyear = $('#sy').val();
        var fname = $('.fname').val();
        var mname = $('.mname').val(); //optional
        var lname = $('.lname').val();

        var level_section = $('.level_section').val();
        var lrn = $('.lrn').val();  //optional
        var mother_tongue = $('.mother_tongue').val();
        var birth_place = $('.birth_place').val();
        var selectedGender = $('input[name="gender"]:checked').length;
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

        // Dynamic Form validation
        // student Data
        if(balik_aral == ''){
            $('#balik_aral_msg').text('This Field is required');
        }else{
            // kung No ang checked at at nag submit dapat clear anf input field at error mssg
            $('#balik_aral_msg').text('');
            var last_level_completed_data = $('#last_level_completed').val();
            var last_sy_completed_data = $('#last_sy_completed').val();
            var last_school_data = $('#last_school').val(); 

            if(last_level_completed_data == '' && $('#yes').is(':checked')){
                $('#last_grade_msg').text('This field is required');
            }else{
                $('#last_grade_msg').text('');
            }

            if(last_sy_completed_data == '' && $('#yes').is(':checked')){
                $('#last_sy_msg').text('This field is required');
            }else{
                $('#last_sy_msg').text('');
            }

            if(last_school_data == '' && $('#yes').is(':checked')){
                $('#last_school_msg').text('This field is required');
            }else{
                $('#last_school_msg').text('');
            }
        }


        if(schoolyear == ''){
            $('#sy_msg').text('Please Select a valid School Year');
        }else{
            $('#sy_msg').text('');
        }
        // fname
        if(fname == ''){
            $('#fname_msg').text('This Field is required');
        }else{
            $('#fname_msg').text('');
        }
        // lname
        if(lname == ''){
            $('#lname_msg').text('This Field is required');
        }else{
            $('#lname_msg').text('');
        }
        // level and section
        if(level_section == ''){
            $('#grade_section_msg').text('Please Select a Valid Option');
        }else{
            $('#grade_section_msg').text('');
        }
        // LRN
        if(lrn == ''){
            $('#lrn_msg').text('This Field is required');
        }else{
            $('#lrn_msg').text('');
        }
        // mother_tongue
        if(mother_tongue == ''){
            $('#motherTongue_msg').text('This Field is required');
        }else{
            $('#motherTongue_msg').text('');
        }
        // birth_place
        if(birth_place == ''){
            $('#pob_msg').text('This Field is required');
        }else{
            $('#pob_msg').text('');
        }
        // b-date
        if(bday == ''){
            $('#bdate_msg').text('This Field is required');
        }else{
            $('#bdate_msg').text('');
        }
        // Gender
        if( selectedGender == 0){
            $('#zxcc').text('This Field is required');
        }else{
            $('#zxcc').text('');
        }
        // ADDRESS
        // house_no
        if(house_no == ''){
            $('#houseNo_msg').text('This Field is required');
        }else{
            $('#houseNo_msg').text('');
        }
         // street_name
        if(street_name == ''){
            $('#streetName_msg').text('This Field is required');
        }else{
            $('#streetName_msg').text('');
        }
        // barangay
        if(barangay == ''){
            $('#barangay_msg').text('This Field is required');
        }else{
            $('#barangay_msg').text('');
        }
        // municipality
        if(municipality == ''){
            $('#municipality_msg').text('This Field is required');
        }else{
            $('#municipality_msg').text('');
        }
        // province
        if(province == ''){
            $('#province_msg').text('This Field is required');
        }else{
            $('#province_msg').text('');
        }
        // country
        if(country == ''){
            $('#country_msg').text('This Field is required');
        }else{
            $('#country_msg').text('');
        }
        // zip code
        if(zip_code == ''){
            $('#zip_msg').text('This Field is required');
        }else{
            $('#zip_msg').text('');
        }
        // PARENT'S / GUARDIAN INFORMATION
        // father_fname
        if(father_fname == ''){
            $('#ff_msg').text('This Field is required');
        }else{
            $('#ff_msg').text('');
        }
        // father_lname
        if(father_lname == ''){
            $('#fl_msg').text('This Field is required');
        }else{
            $('#fl_msg').text('');
        }
        // father_number
        if(father_number == ''){
            $('#fn_msg').text('This Field is required');
        }else{
            $('#fn_msg').text('');
        }
        // mother_fname
        if(mother_fname == ''){
            $('#mf_msg').text('This Field is required');
        }else{
            $('#mf_msg').text('');
        }
        // mother_lname
        if(mother_lname == ''){
            $('#ml_msg').text('This Field is required');
        }else{
            $('#ml_msg').text('');
        }
        // mother_number
        if(mother_number == ''){
            $('#mn_msg').text('This Field is required');
        }else{
            $('#mn_msg').text('');
        }
        // guardian_fname
        if(guardian_fname == ''){
            $('#gf_msg').text('This Field is required');
        }else{
            $('#gf_msg').text('');
        }
        // guardian_lname
        if(guardian_lname == ''){
            $('#gl_msg').text('This Field is required');
        }else{
            $('#gl_msg').text('');
        }
        // guardian_number
        if(guardian_number == ''){
            $('#gn_msg').text('This Field is required');
        }else{
            $('#gn_msg').text('');
        }
        
        //VALIDATION FOR PASSING DATA 
        // DAGDAG MO MAMAYA YUNG DAPAT MAY CHECKED RADIO BUTTON SA BALIK ARAL
        if($('#yes').is(':checked') && last_school_data !== '' && last_sy_completed_data !== '' && last_level_completed_data !== '' && balik_aral !== '' 
           && schoolyear !== '' && fname !== '' && lname !== '' && level_section !== '' && lrn !== '' && mother_tongue !== '' && birth_place !== '' && selectedGender !== '' && bday !== '' && house_no !== ''
           && street_name !== '' && barangay !== '' && municipality !== '' && province !== '' && country !== '' && zip_code !== ''
           && father_fname !== '' && father_lname !== '' && father_number !== '' 
           && mother_fname !== '' && mother_lname !== '' && mother_number !== ''
           && guardian_fname !== '' && guardian_lname !== '' && guardian_number !== '')
        {
           var form = $('#enrollment_form')[0];
           var formData = new FormData(form);

            $.ajax({
                method: 'POST',
                url: 'enrollment/enrollprocess.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.startsWith('Error:')) {
                        // Display SweetAlert with a warning icon
                        swal({
                            title: 'Oops!',
                            icon: "warning",
                            text: 'Section Capacity already on its limit, Select other section.', //may dot
                            button: "OK",
                        });
                    } else {
                        // Display SweetAlert with a success icon
                        swal({
                            title: data,
                            icon: "success",
                            button: "OK",
                        });
                    }
                }
            });
        }else if($('#no').is(':checked') && last_school_data === '' && last_sy_completed_data === '' && last_level_completed_data === '' && balik_aral !== '' 
        && schoolyear !== '' && fname !== '' && lname !== '' && level_section !== '' && lrn !== '' && mother_tongue !== '' && birth_place !== '' && selectedGender !== '' && bday !== '' && house_no !== ''
        && street_name !== '' && barangay !== '' && municipality !== '' && province !== '' && country !== '' && zip_code !== ''
        && father_fname !== '' && father_lname !== '' && father_number !== '' 
        && mother_fname !== '' && mother_lname !== '' && mother_number !== ''
        && guardian_fname !== '' && guardian_lname !== '' && guardian_number !== '')
        {
            var form = $('#enrollment_form')[0];
            var formData = new FormData(form);

            // adding new data to the form
            formData.append('last_level_completed', last_level_completed);
            formData.append('last_sy_completed', last_sy_completed);
            formData.append('last_school', last_school);

            $.ajax({
                method: 'POST',
                url: 'enrollment/enrollprocess.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.startsWith('Error:')) {
                        // Display SweetAlert with a warning icon
                        swal({
                            title: 'Oops!',
                            icon: "warning",
                            text: 'Section Capacity already on its limit, Select other section', //walang dot
                            button: "OK",
                        });
                    } else {
                        // Display SweetAlert with a success icon
                        swal({
                            title: data,
                            icon: "success",
                            button: "OK",
                        });
                    }
                }
            });
        }

      
    })

    // reset form button
    $('.reset_btn').click(function(){
        $('.error_mssg').text('');
    })
});


