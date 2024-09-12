$(document).ready(function () {
  var activeSchoolYear = $("#schoolYear").val();
  // Functions
  function fetchSection(schoolYear, gradeLevel) {
    $.ajax({
      type: "post",
      url: "../enrollment/fetchSection.php",
      data: {
        schoolYear: schoolYear,
        gradeLevel: gradeLevel,
      },
      success: function (response) {
        $("#selectSection").html(response);
      },
      error: function (xhr, status, error) {
        alert(
          "Ajax request failed for fetchSection Function. Status: " +
            status +
            ", Error: " +
            error
        );
      },
    });
  }

  function insertRegular(schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,
    birthDate,age,placeOfBirth,motherTounge,gender,region,province,city,barangay,
    motherFname,motherMname,motherLname,motherNumber,
    fatherFname,fatherMname,fatherLname,fatherNumber,
    guardianFname,guardianMname,guardianLname,guardianNumber,
    lastGradeLevel,lastSchoolYear,lastSchool) {

      var teacherId = $('#hiddenTeacherId').val(); // For activity Logs

    $.ajax({
      type: "post",
      url: "../TeacherPHP/enrollStudent.php", // change 
      data: {
        'teacherId':teacherId,
        'schoolyear':schoolyear,
        'lrn':lrn,
        'gradeLevel':gradeLevel,
        'section':section,
        'studentType':studentType,
        'studentFname':studentFname,
        'studentMname':studentMname,
        'studentlname':studentlname,
        'birthDate':birthDate,
        'age':age,
        'placeOfBirth':placeOfBirth,
        'motherTounge':motherTounge,
        'gender':gender,
        'region':region,
        'province':province,
        'city':city,
        'barangay':barangay,
        'motherFname':motherFname,
        'motherMname':motherMname,
        'motherLname':motherLname,
        'motherNumber':motherNumber,
        'fatherFname':fatherFname,
        'fatherMname':fatherMname,
        'fatherLname':fatherLname,
        'fatherNumber':fatherNumber,
        'guardianFname':guardianFname,
        'guardianMname':guardianMname,
        'guardianLname':guardianLname,
        'guardianNumber':guardianNumber,
        'lastGradeLevel':lastGradeLevel,
        'lastSchoolYear':lastSchoolYear,
        'lastSchool':lastSchool,
      },
      dataType: 'json',
      success: function (response) {
        if(response.status == 'success')
        {
          // $("#enrollmentForm")[0].reset(); // RESET THE FORM
          swal({
            title: response.message,
            text: "Student successfully enrolled",
            icon: "success",
            button: "ok",
          }).then((value) => {
            if (value) {
              // Reload the page
              location.reload(true); // true means force a reload from the server, bypassing the cache
            }
          });
        }
        // Section Capacity is on its limit
        if(response.status == 'error')
        {
          swal({
            title: "Oops!",
            text: response.message,
            icon: "warning",
            button: "ok",
          });
        }
        // Query failed
        if(response.status == 'failed')
        {
          alert(response.message);
        }
      },
      error: function (xhr, status, error) {
        alert("AJAX request failed (insertRegular Function): " + status + ", " + error);
        console.log("AJAX request failed (insertRegular Function): " + status + ", " + error);
    }
    });
  }

  // Add teacher ID variable For Teacher Activity Logs
  function insertReturnee(schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,
    birthDate,age,placeOfBirth,motherTounge,gender,region,province,city,barangay,
    motherFname,motherMname,motherLname,motherNumber,
    fatherFname,fatherMname,fatherLname,fatherNumber,
    guardianFname,guardianMname,guardianLname,guardianNumber,
    lastGradeLevel,lastSchoolYear,lastSchool) {
      
      // var teacherId = $('#hiddenTeacherId').val(); // For activity Logs

    $.ajax({
      type: "post",
      url: "../enrollment/enrollReturnee.php",
      data: {
        'schoolyear':schoolyear,
        'lrn':lrn,
        'gradeLevel':gradeLevel,
        'section':section,
        'studentType':studentType,
        'studentFname':studentFname,
        'studentMname':studentMname,
        'studentlname':studentlname,
        'birthDate':birthDate,
        'age':age,
        'placeOfBirth':placeOfBirth,
        'motherTounge':motherTounge,
        'gender':gender,
        'region':region,
        'province':province,
        'city':city,
        'barangay':barangay,
        'motherFname':motherFname,
        'motherMname':motherMname,
        'motherLname':motherLname,
        'motherNumber':motherNumber,
        'fatherFname':fatherFname,
        'fatherMname':fatherMname,
        'fatherLname':fatherLname,
        'fatherNumber':fatherNumber,
        'guardianFname':guardianFname,
        'guardianMname':guardianMname,
        'guardianLname':guardianLname,
        'guardianNumber':guardianNumber,
        'lastGradeLevel':lastGradeLevel,
        'lastSchoolYear':lastSchoolYear,
        'lastSchool':lastSchool,
      },
      dataType: 'json',
      success: function (response) {
        if(response.status == 'success')
        {
          // $("#enrollmentForm")[0].reset(); // RESET THE FORM
          swal({
            title: response.message,
            text: "Student successfully enrolled",
            icon: "success",
            button: "ok",
          }).then((value) => {
            if (value) {
              // Reload the page
              location.reload(true); // true means force a reload from the server, bypassing the cache
            }
          });
        }
        // Section Capacity is on its limit
        if(response.status == 'error')
        {
          swal({
            title: "Oops!",
            text: response.message,
            icon: "warning",
            button: "ok",
          });
        }
        // Query failed
        if(response.status == 'failed')
        {
          alert(response.message);
        }
      },
      error: function (xhr, status, error) {
        alert("AJAX request failed (insertRegular Function): " + status + ", " + error);
        console.log("AJAX request failed (insertRegular Function): " + status + ", " + error);
    }
    });
  }

  function fetchSectionCapacity(schoolYear,gradeLevel,section) {

    $.ajax({
      type: "post",
      url: "../enrollment/sectionCapacity.php",
      data: {
        'schoolYear':schoolYear,
        'gradeLevel':gradeLevel,
        'section':section,
      },
      dataType: "json",
      success: function (response) {
        if(response.status == 'success') {
          $('#capacityError').text('');
          $('#capacityError').text('Capacity: ' +response.count);
        }else if(response.status == 'full') {
          $('#capacityError').text('');
          $('#capacityError').html('&#9888; ' + response.count + ' - ' + response.message);
        }else {
          alert(response);
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        alert("AJAX Error: " + status + " - " + error);
        console.error("AJAX Error: " + status + " - " + error);
      }
    });
  }

  function autoComputeAge() {
    var currentBirthDate = $('#birth_Date').val();
    var date_of_brith = new Date(currentBirthDate);
    var returnee_currentDate = new Date();
    var returnee_age = returnee_currentDate.getFullYear() - date_of_brith.getFullYear();

    if (returnee_currentDate.getMonth() < date_of_brith.getMonth() || (returnee_currentDate.getMonth() === date_of_brith.getMonth() && returnee_currentDate.getDate() < date_of_brith.getDate())) {
        returnee_age--;
        $("#age").val('');
    }
    $("#age").val(returnee_age);
    if(returnee_age <= 13){
      $('#birth_DateError').text('Your age must be 13 years above');
      $("#age").val('0');
    }else {
      $('#birth_DateError').text('');
    }
  }

  function checkNumberInput(keyCode, errorField) {

    if (keyCode >= 48 && keyCode <= 57) {
      errorField.text("");
    }
    else if (
      (keyCode >= 65 && keyCode <= 90) ||
      (keyCode >= 97 && keyCode <= 122)
    ) {
      errorField.text("Invalid input type, Enter number type only");
    }
  }

// NAHINTO SA PAG RESET NG ENROLLMENT FOR, PWEDE DIN REFRESH NALNG MISMONG PAGE
  
  function fetchReturneeData(lrn,schoolyear,lastSchoolYear) {
    $.ajax({
      type: "post",
      url: "../enrollment/returneeData.php",
      data: {
        lrn: lrn,
        schoolyear: schoolyear,
        lastSchoolYear: lastSchoolYear,
      },
      dataType: "json",
      success: function (response) {
        if(response.status == 'success') {
          // disabled and show actions for returnee
          $('#resetAddressBtn').removeClass('d-none');
          // Fetch Data
          $("#fname").val(response.fname);
          $("#mname").val(response.mname);
          $("#lname").val(response.lname);
          // $('#selectGradeLevel').val(response.gradeLevel);
          fetchSection($('#schoolYear').val(),$('#selectGradeLevel').val());
          $('#birth_Date').val(response.birthDate);
          autoComputeAge();
          $('#place_of_birth').val(response.placeofBirth);
          $('#mother_tounge').val(response.motherTongue);
          $('input[type="radio"][name="gender"]').each(function () { // GENDER
            if ($(this).val() === response.gender) {
              $(this).prop("checked", true);
            }
          });
          $('#region').html('<option value="'+response.region+'" selected>'+response.region+'</option>');
          $('#province').html('<option value="'+response.province+'" selected>'+response.province+'</option>');
          $('#city').html('<option value="'+response.city+'" selected>'+response.city+'</option>');
          $('#barangay').html('<option value="'+response.barangay+'" selected>'+response.barangay+'</option>');
          // Mother
          $('#mother_fname').val(response.motherFname);
          $('#mother_mname').val(response.motherMname);
          $('#mother_lname').val(response.motherLname);
          $('#mother_number').val(response.motherNumber);
          // Father
          $('#father_fname').val(response.fatherFname);
          $('#father_mname').val(response.fatherMname);
          $('#father_lname').val(response.fatherLname);
          $('#father_number').val(response.fatherNumber);
          // Guardian
          $('#guardian_fname').val(response.guardianFname);
          $('#guardian_mname').val(response.guardianMname);
          $('#guardian_lname').val(response.guardianLname);
          $('#guardian_number').val(response.guardianNumber);
          // Returnee Form
          $('#last_gradel_level').val(response.lastGradeLevel);
          $('#last_school').val(response.lastSchool);
          $('#last_school_year').val(response.lastSchoolYear);

          // NAHINTO SA PAG GAWA NG FUNCTION TO INSERT DATA OF RETURNEE INTO DATABASE (YUNG AGE WAG KALIMUTAN DAGDAG)
        }else if(response.status == 'failed') {
          $("#enrollmentForm")[0].reset();
          $("#enrollmentForm")[0].reset();
          $('#lrn').prop('readonly',false); //Enable Fetch returnee button
          $('#returnee').prop('checked',true); // Set the returnee radio button still checked
          swal({
            title: "NO DATA FOUND",
            text: response.message,
            icon: "warning",
            button: "ok",
          });
        }
      },
      error: function (xhr, status, error) {
        // alert("AJAX Error: " + status + " - " + error);
        console.error("AJAX Error: " + status + " - " + error);
      }
    });
  }

  // -> ADD MO YUNG AGE NA NEW DATA TO BE INSERT SA MGA INSERT FUNCTIONS AT FETCH.
  // -> LOGIC FOR RETURNEE : 

  // Auto Compute Age
  $('#birth_Date').change(function () { 
    var dobVal = $(this).val();
    var dob = new Date(dobVal);
    var currentDate = new Date();
    var age = currentDate.getFullYear() - dob.getFullYear();

    if (currentDate.getMonth() < dob.getMonth() || (currentDate.getMonth() === dob.getMonth() && currentDate.getDate() < dob.getDate())) {
        age--;
        $("#age").val('');
    }
    $("#age").val(age);
    if(age <= 12){
      $('#birth_DateError').text('Your age must be 13 years above');
      $("#age").val('0');
      $('#submitFormBtn').prop('disabled',true);
    }else {
      $('#birth_DateError').text('');
      $('#submitFormBtn').prop('disabled',false);
    }
  });

  // Live search
  // $('#lrn').keyup(function () { 
  //   var searchLrn = $(this).val();
  //   if(searchLrn != '' && $('#returnee').is(':checked')) {
  //     // Fetch results (ajax)
  //     $.ajax({
  //       type: "post",
  //       url: "enrollment/search.php",
  //       data: {
  //         'searchLrn':searchLrn
  //       },
  //       success: function (response) {
  //         $('#lrnList').fadeIn();
  //         $('#lrnList').html(response);
  //       },
  //       error: function (xhr, status, error) {
  //         alert("AJAX Error: " + status + " - " + error);
  //         console.error("AJAX Error: " + status + " - " + error);
  //       }
  //     });

  //   }else {
  //     // clear dropdown list at input fields
  //     $('#lrnList').fadeOut();
  //   }
  // });
  // Display clicked LRN
  // $(document).on('click','.lrnOutput', function () {
  //   // var lrnOutput = $(this).text();
  //   $('#lrn').val($(this).text());
  //   $('#lrnList').fadeOut();
  // });

  // Select Grade Level & Section Dropdown
  $(document).on('change','#selectGradeLevel', function () {
    var fetchSectionVal = $(this).val();
    if(fetchSectionVal == '8' || fetchSectionVal == '9' || fetchSectionVal == '10') {
      // Disable regular student type
      $('#regular').prop('disabled',true);
      $('#regular').prop('checked', false);
    }else {
      $('#regular').prop('disabled',false);
    }
    fetchSection(activeSchoolYear, fetchSectionVal);
  });

  // Student Type Input Field
  $('input[type="radio"][name="student_type"]').change(function () { 
    if($('#transferee').is(':checked'))
    {
      // $("#enrollmentForm")[0].reset();
      $('#returnee_policy').text('');
      $('#transferee').prop('checked',true) // set the transferee radio button to checked
      $('#resetAddressBtn').addClass('d-none');
      $('#returnee_btn').addClass('d-none');
      $('#last_gradel_level').prop('disabled',false);
      $('#last_school_year').prop('disabled',false);
      $('#last_school').prop('disabled',false);
      $('#region').prop('disabled',false);
      $('#lrn').prop('readonly',false);
      // Add clear input field every changes
    }else if($('#regular').is(':checked'))
    {
      // $("#enrollmentForm")[0].reset();
      $('#regular').prop('checked',true) // set the regular radio button to checked
      $('#resetAddressBtn').addClass('d-none');
      $('#region').prop('disabled',false);
      $('#returnee_btn').addClass('d-none');
      $('#last_gradel_level').prop('disabled',true);
      $('#last_school_year').prop('disabled',true);
      $('#last_school').prop('disabled',true);
      $('#last_gradel_level').val('');
      $('#last_school_year').val('');
      $('#last_school').val('');
      $('#lrn').prop('readonly',false);
    }else if ($('#returnee').is(':checked')) {
      // Didisable lahat ng input field, kase feftch nlng through livesearch
      $("#enrollmentForm")[0].reset();
      $('#returnee_policy').text('Please input student LRN to display its data'); // set to display policy
      $('#returnee_btn').removeClass('d-none');
      $('#lrn').val('');
      $('#region').prop('disabled',false);
      // Disable Returnee's Form
      $('#last_gradel_level').prop('disabled',true);
      $('#last_school_year').prop('disabled',true);
      $('#last_school').prop('disabled',true);
      // Reset the Form
      $("#enrollmentForm")[0].reset();
      $('#returnee').prop('checked',true) // set the returnee radio button to checked
      $.each($('small.text-danger'), function (indexInArray, valueOfElement) { 
        $(this).text('');
      });
      console.log('u select returnee');
    }
  });

  // Display Section Capacity
  $(document).on('change','#selectSection', function () {
    var schoolYearValue = $('#schoolYear').val();
    var gradeLevelValue = $("#selectGradeLevel").val();
    var sectionValue = $("#selectSection").val();

    if(gradeLevelValue != '' && sectionValue != '') {
      fetchSectionCapacity(schoolYearValue,gradeLevelValue,sectionValue);
    }else {
      $('#capacityError').text('');
    }
  });


  // FETCH RETURNEE DATA BUTTON
  $(document).on('click','#returnee_btn', function (e) {
    e.preventDefault();
    var studentLrnVal = $('#lrn').val();
    var currentSchoolYear = $('#schoolYear').val();
    var hidden_last_school_year = $('#hidden_last_school_year').val();
    $('#lrn').prop('readonly',true);

    fetchReturneeData(studentLrnVal,currentSchoolYear,hidden_last_school_year);
  });

  // Submit Form Button
  $("#submitFormBtn").click(function (e) {
    e.preventDefault();

    // Regex For Sql Injection
    var regex = /['";`<>&]/;
    var specialChar = /^[A-Za-z\s]+$/;

    let hasErrors = false;
    // References
    var schoolyear = $("#schoolYear").val();
    var lrn = $("#lrn").val();
    var gradeLevel = $("#selectGradeLevel").val();
    var section = $("#selectSection").val();
    var studentType = $("input[name='student_type']:checked").val();
    // Learner Information
    var studentFname = $('#fname').val().trim().replace(/\s+/g, " ");
    var studentMname = $('#mname').val().trim().replace(/\s+/g, " ");
    var studentlname = $('#lname').val().trim().replace(/\s+/g, " ");
    var birthDate = $('#birth_Date').val();
    var studentAge = $('#age').val();
    var placeOfBirth = $('#place_of_birth').val().trim().replace(/\s+/g, " ");
    var motherTounge = $('#mother_tounge').val().trim().replace(/\s+/g, " ");
    var gender = $("input[name='gender']:checked").val();
    // Address
    var region = $('#region option:selected').text();
    var province = $('#province option:selected').text();
    var city = $('#city option:selected').text();
    var barangay = $('#barangay option:selected').text();
    // Parent's Guardian Information
    var motherFname = $('#mother_fname').val().trim().replace(/\s+/g, " ");
    var motherMname = $('#mother_mname').val().trim().replace(/\s+/g, " ");
    var motherLname = $('#mother_lname').val().trim().replace(/\s+/g, " ");
    var motherNumber = $('#mother_number').val();

    var fatherFname = $('#father_fname').val().trim().replace(/\s+/g, " ");
    var fatherMname = $('#father_mname').val().trim().replace(/\s+/g, " ");
    var fatherLname = $('#father_lname').val().trim().replace(/\s+/g, " ");
    var fatherNumber = $('#father_number').val();

    var guardianFname = $('#guardian_fname').val().trim().replace(/\s+/g, " ");
    var guardianMname = $('#guardian_mname').val().trim().replace(/\s+/g, " ");
    var guardianLname = $('#guardian_lname').val().trim().replace(/\s+/g, " ");
    var guardianNumber = $('#guardian_number').val();
    // Transferee And Returnee
    var lastGradeLevel = $('#last_gradel_level').val();
    var lastSchoolYear = $('#last_school_year').val();
    var lastSchool = $('#last_school').val().trim().replace(/\s+/g, " ");

    if(lrn.length != 12){
      $('#lrnError').text('Invalid LRN, (must be 12 digits)');
      hasErrors = true;
    }else{
      $('#lrnError').text('');
    }

    if(gradeLevel.length == 0){
      $('#gradeLvlError').text('Invalid Grade Level');
      hasErrors = true;
    }else{
      $('#gradeLvlError').text('');
    }

    if(section.length == 0){
      $('#selectSectionError').text('Invalid section');
      hasErrors = true;
    }else{
      $('#selectSectionError').text('');
    }
    
    if($("input[name='student_type']:checked").length == 0){
      $('#student_typeError').text('Invalid student type');
      hasErrors = true;
    }else{
      $('#student_typeError').text('');
    }

    if(studentFname.length == 0 || regex.test(studentFname) || !specialChar.test(studentFname)){
      $('#fnameError').text('Invalid First name');
      hasErrors = true;
    }else{
      $('#fnameError').text('');
    }

    if(studentMname.length > 0){
      if(regex.test(studentMname) || !specialChar.test(studentMname))
      {
        $('#mnameError').text('Invalid middle name');
        hasErrors = true;
      }else{
        $('#mnameError').text('');
      }
    }else{
      $('#mnameError').text('');
    }

    if(studentlname.length == 0 || regex.test(studentlname) || !specialChar.test(studentlname)){
      $('#lnameError').text('Invalid last name');
      hasErrors = true;
    }else{
      $('#lnameError').text('');
    }

    if(birthDate.length == 0){
      $('#birth_DateError').text('Invalid Birth Date');
      hasErrors = true;
    }else{
      $('#birth_DateError').text('');
    }

    if(studentAge == 0 || studentAge == NaN || studentAge == '' || studentAge > 99){
      $('#age_Error').text('Invalid age');
      hasErrors = true;
    }else{
      $('#age_Error').text('');
      // $('#submitFormBtn').prop('disable',true);
    }
    
    if(placeOfBirth.length == 0 || regex.test(placeOfBirth) || !specialChar.test(placeOfBirth)){
      $('#place_of_birthError').text('Invalid place of birth');
      hasErrors = true;
    }else{
      $('#place_of_birthError').text('');
    }
    
    if(motherTounge.length == 0 || regex.test(motherTounge) || !specialChar.test(motherTounge)){
      $('#mother_toungeError').text('Invalid mother tounge');
      hasErrors = true;
    }else{
      $('#mother_toungeError').text('');
    }

    if($("input[name='gender']:checked").length == 0){
      $('#genderError').text('Invalid Gender');
      hasErrors = true;
    }else{
      $('#genderError').text('');
    }

    if(region == '- select region -'){
      $('#regionError').text('Invalid region');
      hasErrors = true;
    }else{
      $('#regionError').text('');
    }

    if(province == '- select province -'){
      $('#provinceError').text('Invalid Province');
      hasErrors = true;
    }else{
      $('#provinceError').text('');
    }

    if(city == '- select city -'){
      $('#cityError').text('Invalid City');
      hasErrors = true;
    }else{
      $('#cityError').text('');
    }

    if(barangay == '- select barangay -'){
      $('#barangayError').text('Invalid barangay');
      hasErrors = true;
    }else{
      $('#barangayError').text('');
    }
    // mother
    if(motherFname.length == 0 || regex.test(motherFname) || !specialChar.test(motherFname)){
      $('#mother_fnameError').text('Invalid first name');
      hasErrors = true;
    }else{
      $('#mother_fnameError').text('');
    }

    if(motherMname.length > 0){
      if(regex.test(motherMname) || !specialChar.test(motherMname))
      {
        $('#mother_mnameError').text('Invalid middle name');
        hasErrors = true;
      }else{
        $('#mother_mnameError').text('');
      }
    }else{
      $('#mother_mnameError').text('');
    }

    if(motherLname.length == 0 || regex.test(motherLname) || !specialChar.test(motherLname)){
      $('#mother_lnameError').text('Invalid last name');
      hasErrors = true;
    }else{
      $('#mother_lnameError').text('');
    }

    if(motherNumber.length != 11 || !motherNumber.startsWith('09')){
      $('#mother_numberError').text('Invalid contact number');
      hasErrors = true;
    }else{
      $('#mother_numberError').text('');
    }
    // FATHER
    if(fatherFname.length == 0 || regex.test(fatherFname) || !specialChar.test(fatherFname)){
      $('#father_fnameError').text('Invalid first name');
      hasErrors = true;
    }else{
      $('#father_fnameError').text('');
    }

    if(fatherMname.length > 0){
      if(regex.test(fatherMname) || !specialChar.test(fatherMname))
      {
        $('#father_mnameError').text('Invalid middle name');
        hasErrors = true;
      }else{
        $('#father_mnameError').text('');
      }
    }else{
      $('#father_mnameError').text('');
    }

    if(fatherLname.length == 0 || regex.test(fatherLname) || !specialChar.test(fatherLname)){
      $('#father_lnameError').text('Invalid last name');
      hasErrors = true;
    }else{
      $('#father_lnameError').text('');
    }

    if(fatherNumber.length != 11 || !fatherNumber.startsWith('09')){
      $('#father_numberError').text('Invalid contact number');
      hasErrors = true;
    }else{
      $('#father_numberError').text('');
    }
    // Guardian
    if(guardianFname.length == 0 || regex.test(guardianFname) || !specialChar.test(guardianFname)){
      $('#guardian_fnameError').text('Invalid first name');
      hasErrors = true;
    }else{
      $('#guardian_fnameError').text('');
    }

    if(guardianMname.length > 0){
      if(regex.test(guardianMname) || !specialChar.test(guardianMname))
      {
        $('#guardian_mnameError').text('Invalid middle name');
        hasErrors = true;
      }else{
        $('#guardian_mnameError').text('');
      }
    }else{
      $('#guardian_mnameError').text('');
    }

    if(guardianLname.length == 0 || regex.test(guardianLname) || !specialChar.test(guardianLname)){
      $('#guardian_lnameError').text('Invalid last name');
      hasErrors = true;
    }else{
      $('#guardian_lnameError').text('');
    }

    if(guardianNumber.length != 11 || !guardianNumber.startsWith('09')){
      $('#guardian_numberError').text('Invalid contact number');
      hasErrors = true;
    }else{
      $('#guardian_numberError').text('');
    }
    // TRANSFEREE FORM, dpat mas mataas si gradelevel kesa last gradelvel
    if($('#transferee').is(':checked') || $('#returnee').is(':checked')){

      if(lastGradeLevel < 6 || lastGradeLevel > 10){
        $('#last_gradel_levelError').text('Invalid inputs');
        hasErrors = true;
      }else{
        // if pasado sa condition
        if(parseInt(gradeLevel) < lastGradeLevel)
        {
          $('#last_gradel_levelError').text('Invalid input, Please check your selected Grade level and your inputed last grade level');
          hasErrors = true;
        }else {
          $('#last_gradel_levelError').text('');
        }
      }
      
      if(lastSchoolYear.length == 0 || regex.test(lastSchoolYear)){
        $('#last_school_yearError').text('Invalid input');
        hasErrors = true;
      }else{
        $('#last_school_yearError').text('');
      }

      if(lastSchool.length == 0 || regex.test(lastSchool) || !specialChar.test(lastSchool)){
        $('#last_schoolError').text('Invalid input');
        hasErrors = true;
      }else{
        $('#last_schoolError').text('');
      }


      // if()



// NAHINTO SA VALIDATION NG STUDENT TYPE
    }else if($('#regular').is(':checked')){
      $('#last_gradel_levelError').text('');
      $('#last_school_yearError').text('');
      $('#last_schoolError').text('');
    }
    
    if(hasErrors)
    {
      console.log('SUBMIT FORM FAILED');
      return false;
    }else{

      if($('#regular').is(':checked') && hasErrors != true)
      {
        swal({
          title: "Are you sure?",
          text: "Are you sure you want to enroll this student?",
          icon: "warning",
          buttons: {
            cancel: "No",
            confirm: "Yes"
          },
          dangerMode: false,
        })
        .then((confirmEnrollBtn) => {
          if (confirmEnrollBtn) {
            // Confirm button
            // alert('enroll regular');
            insertRegular(schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,birthDate,studentAge,placeOfBirth,motherTounge,gender,region,province,city,barangay,motherFname,motherMname,motherLname,motherNumber,fatherFname,fatherMname,fatherLname,fatherNumber,guardianFname,guardianMname,guardianLname,guardianNumber,lastGradeLevel,lastSchoolYear,lastSchool);
          } else {
            swal("Please continue"); //or alisin na please continue, return nlng
            return;
          }
        });
      }else if($('#transferee').is(':checked') && hasErrors != true){
        swal({
          title: "Are you sure?",
          text: "Are you sure you want to enroll this student?",
          icon: "warning",
          buttons: {
            cancel: "No",
            confirm: "Yes"
          },
          dangerMode: false,
        })
        .then((confirmEnrollBtn) => {
          if (confirmEnrollBtn) {
            // Confirm button
            insertRegular(schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,birthDate,studentAge,placeOfBirth,motherTounge,gender,region,province,city,barangay,motherFname,motherMname,motherLname,motherNumber,fatherFname,fatherMname,fatherLname,fatherNumber,guardianFname,guardianMname,guardianLname,guardianNumber,lastGradeLevel,lastSchoolYear,lastSchool);
          } else {
            swal("Please continue"); //or alisin na please continue, return nlng
            return;
          }
        });
      }else if($('#returnee').is(':checked') && hasErrors != true) {
        // Insert Returnee data function
        swal({
          title: "Are you sure?",
          text: "Are you sure you want to enroll this student?",
          icon: "warning",
          buttons: {
            cancel: "No",
            confirm: "Yes"
          },
          dangerMode: false,
        })
        .then((confirmEnrollBtn) => {
          if (confirmEnrollBtn) {
            // Confirm button
            insertReturnee(schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,birthDate,studentAge,placeOfBirth,motherTounge,gender,region,province,city,barangay,motherFname,motherMname,motherLname,motherNumber,fatherFname,fatherMname,fatherLname,fatherNumber,guardianFname,guardianMname,guardianLname,guardianNumber,lastGradeLevel,lastSchoolYear,lastSchool);
          } else {
            swal("Please continue"); //or alisin na please continue, return nlng
            return;
          }
        });
      }
    }
  });

  // Reset address button
  $(document).on('click','#resetAddressBtn', function () {
    $('#region').prop('disabled',false);
    $('#region').empty();
    $('#province').empty();
    $('#city').empty();
    $('#barangay').empty();
    
    $('#province').html('<option value="">- select province -');
    $('#city').html('<option value="">- select city -');
    $('#barangay').html('<option value="">- select barangay -');


    var region = "<option value=''>- select region -</option>";

    $.getJSON("phaddress/region.json", function (result) {
        $.each(result, function (index, element) { 
            var regionCode = element.region_code;
            var regionName = element.region_name;

            region += "<option value=" + regionCode + ">" + regionName + "</option>";
        });
        $('#region').append(region);
    });
  });
  


  $('#lrn').on('keypress', function (event) {
    var keyCode = event.which;
    var errorField = $('#lrnError');
    
    checkNumberInput(keyCode,errorField);
  });

  $('#mother_number').on('keypress', function (event) {
    var keyCode = event.which;
    var errorField = $('#mother_numberError');
    
    checkNumberInput(keyCode,errorField);
  });

  $('#father_number').on('keypress', function (event) {
    var keyCode = event.which;
    var errorField = $('#father_numberError');
    
    checkNumberInput(keyCode,errorField);
  });
    
  $('#guardian_number').on('keypress', function (event) {
    var keyCode = event.which;
    var errorField = $('#guardian_numberError');
    
    checkNumberInput(keyCode,errorField);
  });
});