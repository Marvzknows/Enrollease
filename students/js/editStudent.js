$(document).ready(function () {
    
    // Fetch Address
    var region;

    $.getJSON("../phaddress/region.json", function (result) {
        $.each(result, function (index, element) { 
            var regionCode = element.region_code;
            var regionName = element.region_name;

            region += "<option value=" + regionCode + ">" + regionName + "</option>";
        });
        $('#region').append(region);
    });


    function fetchSection(schoolYear, gradeLevel) {
        $.ajax({
            type: "post",
            url: "../students/fetchSection.php",
            data: {
                'schoolYear':schoolYear,
                'gradeLevel':gradeLevel
            },
            success: function (response) {
                $('#selectSection').empty();
                $('#selectSection').append(response);
            },
            error: function (xhr, status, error) {
                console.log("Ajax request failed. Status: " + status + ", Error: " + error);
                alert(
                  "Ajax request failed failed. Status: " +
                    status +
                    ", Error: " +
                    error
                );
              }
        });
    }

    // onChange Grade Level
    $(document).on('change','#selectGradeLevel', function () {
        var selectGradeLevelVal = $(this).val();
        var gradeLevelSchoolYearVal = $('#schoolYear').val();
        
        // function 
        fetchSection(gradeLevelSchoolYearVal, selectGradeLevelVal);
    });

    // onChange Student Type
    $(document).on('change','input[name="student_type"]', function () {

        var studentTypeVal = $(this).val();

        if(studentTypeVal == 'Regular') {
            $("#last_gradel_level").prop("disabled", true);
            $("#last_school_year").prop("disabled", true);
            $("#last_school").prop("disabled", true);
            // Clear Input Fields
            $("#last_gradel_level").val('');
            $("#last_school_year").val('');
            $("#last_school").val('');
        }else if(studentTypeVal == 'Returning' || studentTypeVal == 'Transferee') {
            $("#last_gradel_level").prop("disabled", false);
            $("#last_school_year").prop("disabled", false);
            $("#last_school").prop("disabled", false);
            // Clear Input fields
            $("#last_gradel_level").val('');
            $("#last_school_year").val('');
            $("#last_school").val('');
        }
    });

    // onChange Region

    $('#region').change(function () { 
        // Remove 1st elemnt/index ng dropdown list(current selected), kasi wala value yon
        var regionSelectedText = $("#region option:selected").text(); // get the selected text of region
        $('#province').empty(); // Clear the province options
        $('#city').empty(); // Clear the city options
        $('#barangay').empty(); // Clear the barangay options

        $('#province').append("<option value='' selected>- select province -</option>");
        $('#city').append("<option value='' selected>- select province -</option>");
        $('#barangay').append("<option value='' selected>- select province -</option>");

        // Disable City and barangay para mag select muna for province dropdown
        $("#city").prop("disabled", true);
        $("#barangay").prop("disabled", true);

        if(regionSelectedText !== '') {
            var regionVal = $(this).val();
            $.getJSON("../phaddress/province.json", function (result) {
                var provinceOptions = '';
                $.each(result, function (index, element) {
                    if (element.region_code === regionVal) {
                        var provinceCode = element.province_code;
                        var provinceName = element.province_name;
                        provinceOptions += "<option value='" + provinceCode + "'>" + provinceName + "</option>";
                    }
                });
                // Populate the province select element with the new options
                $('#province').append(provinceOptions);
            });
        }
    });

    fetchAddress();

    function fetchAddress() {
      // Global Variables
      var regionCodeReference = ""; //for provinces
      var provinceCodeReference = ""; // for city
      var cityCodeReference = "";

      $.getJSON("../phaddress/region.json", function (data) {
        // Iterate through the JSON data to find the region
        var regionNameToFind = $("#region option:selected").text();
        var regionCode = "";

        $.each(data, function (index, region) {
          if (region.region_name === regionNameToFind) {
            regionCode = region.region_code;
          }
        });
        // Update the global regionCodeReference variable value
        regionCodeReference = regionCode;
      });

      // Get All the Provinces Based on Region (Val)
      $.getJSON("../phaddress/province.json", function (provinceData) {
        // Initialize province_dropdown as an empty string
        var province_dropdown = "";

        // Iterate through the JSON data to find the provinces
        $.each(provinceData, function (index, province) {
            if (province.region_code == regionCodeReference) {
            province_dropdown +="<option value='" +province.province_code +"'>" +province.province_name +"</option>";
            }
        });
            // Append the options to the #province select element
            $("#province").append(province_dropdown);
        });
    
    // Get the province_code base sa selected na text sa province dropdown
    $.getJSON("../phaddress/province.json", function (provinceData) {
        // Iterate through the JSON data to find the region
        var provinceNameToFind = $("#province option:selected").text();
        var provinceCode = "";

        $.each(provinceData, function (index, province) {
            if (province.province_name === provinceNameToFind) {
            provinceCode = province.province_code;
            }
        });
            // Update the global provinceCodeReference variable value
            provinceCodeReference = provinceCode;
        });

      // Get all the city Based on province val (province_code)
        $.getJSON("../phaddress/city.json", function (cityData) {
        
        var city_Dropdown = "";

        $.each(cityData, function (index, city) { 
            if(city.province_code === provinceCodeReference) {
                city_Dropdown +="<option value='" +city.city_code +"'>" +city.city_name +"</option>";
            }
        });
        // output
        $("#city").append(city_Dropdown);

    });

    // Get 'city_code' para gamtin reference kay barangay'
    $.getJSON("../phaddress/city.json", function (cityData) {

        var cityNameToFind = $("#city option:selected").text();
        var cityCode = "";

      $.each(cityData, function (index, city) {
        if (city.city_name === cityNameToFind) {
            cityCode = city.city_code;
        }
      });
        // Update yung global cityCodeReference variable value
        cityCodeReference = cityCode;
        // console.log(cityCodeReference);
    });

    $.getJSON("../phaddress/barangay.json", function (barangayData) {

        var barangay_Dropdown = "";

    $.each(barangayData, function (index, barangay) {
        //brgy_code - city_code
        if (barangay.city_code === cityCodeReference) {
            barangay_Dropdown +="<option value='" +barangay.brgy_code +"'>" +barangay.brgy_name +"</option>";
        }
    });
        //output
        $('#barangay').append(barangay_Dropdown);
    });


    }

    function insertStudent(studentId,hiddenSchoolYear,hiddenGradeLevel,hiddenSection,schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,
        birthDate,age,placeOfBirth,motherTounge,gender,region,province,city,barangay,
        motherFname,motherMname,motherLname,motherNumber,
        fatherFname,fatherMname,fatherLname,fatherNumber,
        guardianFname,guardianMname,guardianLname,guardianNumber,
        lastGradeLevel,lastSchoolYear,lastSchool) {
        $.ajax({
          type: "post",
          url: "../students/editProcess.php",
          data: {
            'studentId':studentId,
            'hiddenSchoolYear':hiddenSchoolYear,
            'hiddenGradeLevel':hiddenGradeLevel,
            'hiddenSection':hiddenSection,
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
              swal({
                title: response.message,
                text: "Student data successfully saved",
                icon: "success",
                button: "ok",
              }).then(function () {
                // location.reload();
                window.location.href = "../students.php"; // Redirect other page
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
              console.log(response.message);
            }
          },
          error: function (xhr, status, error) {
            alert("AJAX request failed : " + status + ", " + error);
            console.log("AJAX request failed : " + status + ", " + error);
        }
        });
      }
    // Province onChange
    $(document).on("change", "#province", function () {
      // Pag nag palit ng province, disabled si barangay
      // reset si city at barangay, tas fetch data for city base sa province_code
        var provinceVal = $(this).val();

        $("#city").empty();
        $("#barangay").empty();
        $("#barangay").prop("disabled", true);
        $("#city").prop("disabled", false);

        if(provinceVal !== '') {
            $.getJSON("../phaddress/city.json", function (cityData) {
                var cityOptions = "<option value='' selected>- select city -</option>";
                $.each(cityData, function (index, city) {
                    if (city.province_code === provinceVal) {
                        var cityValue = city.city_code;
                        var cityName = city.city_name;
                        cityOptions += "<option value='" + cityValue + "'>" + cityName + "</option>";
                    }
                });
                $('#city').append(cityOptions);
            });
        }
    });

    // City onChange
    $(document).on("change", "#city", function () {
    // Pag nag palit ng city, enable si barangay
    // reset si barangay dropdownlist, tas fetch data for baarangay base sa city_code ni city
        var cityVal = $(this).val();

        $("#barangay").empty();
        $("#barangay").prop("disabled", false);

        if(cityVal !== '') {
            $.getJSON("../phaddress/barangay.json", function (barangayData) {
                var brgyOptions = "<option value='' selected>- select barangay -</option>";
                $.each(barangayData, function (index, barangay) {
                    if (barangay.city_code === cityVal) {
                        var barangayValue = barangay.brgy_code;
                        var barangayName = barangay.brgy_name;
                        brgyOptions += "<option value='" + barangayValue + "'>" + barangayName + "</option>";
                    }
                });
                $('#barangay').append(brgyOptions);
            });
        }
    });

    // onChange auto compute Age
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
      if(age <= 13){
        $('#birth_DateError').text('Your age must be 13 years above');
        $("#age").val('0');
        $('#submitFormBtn').prop('disabled',true);
      }else {
        $('#birth_DateError').text('');
        $('#submitFormBtn').prop('disabled',false);
      }
    });

    // Submit Form 
    $("#submitFormBtn").click(function (e) {
        e.preventDefault();
    
        // Hidden Student Id
        var student_id = $('#hiddenStudentId').val();
        var hiddenSchoolYear = $('#hiddenSchoolYear').val();
        var hiddenGradeLevel = $('#hiddenGradeLevel').val();
        var hiddenSection = $('#hiddenSection').val();

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
        var motherTounge = $('#mother_tongue').val().trim().replace(/\s+/g, " ");
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

        if(studentAge == 0 || studentAge == NaN || studentAge == ''){
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
    
        if(motherNumber.length != 11){
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
    
        if(fatherNumber.length != 11){
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
    
        if(guardianNumber.length != 11){
          $('#guardian_numberError').text('Invalid contact number');
          hasErrors = true;
        }else{
          $('#guardian_numberError').text('');
        }
        // TRANSFEREE / RETURNEE
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
            insertStudent(student_id,hiddenSchoolYear,hiddenGradeLevel,hiddenSection,schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,birthDate,studentAge,placeOfBirth,motherTounge,gender,region,province,city,barangay,motherFname,motherMname,motherLname,motherNumber,fatherFname,fatherMname,fatherLname,fatherNumber,guardianFname,guardianMname,guardianLname,guardianNumber,lastGradeLevel,lastSchoolYear,lastSchool);
          }else if($('#transferee').is(':checked') || $('#returnee').is(':checked') && hasErrors != true){
            insertStudent(student_id,hiddenSchoolYear,hiddenGradeLevel,hiddenSection,schoolyear,lrn,gradeLevel,section,studentType,studentFname,studentMname,studentlname,birthDate,studentAge,placeOfBirth,motherTounge,gender,region,province,city,barangay,motherFname,motherMname,motherLname,motherNumber,fatherFname,fatherMname,fatherLname,fatherNumber,guardianFname,guardianMname,guardianLname,guardianNumber,lastGradeLevel,lastSchoolYear,lastSchool);
          }
        }
      });

    // NAHINTO: function for updating data for regular at transferee/returnee
    // SA PAG GET NG DATA NG ADRESS, TEXT GAMITIN WAG VAL, PERO IVALIDATE PARIN IF VAL IS NULL OR NOT
});