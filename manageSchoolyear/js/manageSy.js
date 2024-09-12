$(document).ready(function () {

    // FUNCTIONS
    selectSchoolYear();
    // Populate select school year option
    function selectSchoolYear(){

        var currentYear = new Date().getFullYear();
        var startYear = $("#startYear");
        var endYear = $("#endYear");
        
        // Populate the select with years
        for (var year = currentYear + 1; year >= 2000; year--) {
            startYear.append($("<option>", {
            value: year,
            text: year
            }));
            endYear.append($("<option>", {
            value: year,
            text: year
            }));
        }
    }

    // Open Add School Year Modal Button
    $('#addSchoolyearButton').click(function () { 
        $('#addSchoolYearModal').modal('show');
    });

    // School Year PHP validation
    $('#startYear, #endYear').on('change', function () { 
        var selectedStartYear = $("#startYear option:selected").val();
        var selectedEndYear = $("#endYear option:selected").val();
        
        if(selectedStartYear.length > 0 && selectedEndYear.length > 0)
        {
            $('#addSyButton').prop("disabled",false);

            if(selectedStartYear - selectedEndYear !== 1)
            {
                $('#confirmButton').addClass('d-none');
                $('#secondInputFields').addClass('d-none');
                $('#previewTable').addClass('d-none');
                // $('#syError').text('Invalid School Year format');
                $('#saveSchoolYearBtn').prop("disabled",true);
            }else{
                $('#syError').text('');
            }

            // AJAX HERE
            $.ajax({
                type: "post",
                url: "manageSchoolyear/checkSy.php",
                data: {
                    'selectedStartYear':selectedStartYear,
                    'selectedEndYear':selectedEndYear,
                },
                success: function (response) {
                    if(response.status == 'success')
                    {
                        $('#syError').text('School Year Already Exist');
                        $('#secondInputFields').addClass('d-none');
                        $('#previewTable').addClass('d-none');
                        $('#saveSchoolYearBtn').prop("disabled",true);
                        $('#addSyButton').prop("disabled",true);
                    }
                    if(response.status == 'none'){
                        $('#syError').text('');
                        console.log(response.message);
                    }
                }
            });
        }else{
            $('#confirmButton').addClass('d-none');
            $('#secondInputFields').addClass('d-none');
            $('#previewTable').addClass('d-none');
            $('#addSyButton').prop("disabled",true);
            $('#saveSchoolYearBtn').prop("disabled",true);
            
        }

    });

    // Add School Year Button
    $('#addSyButton').click(function () { 

        // Reference Variables
        var startYearVal = $('#startYear').val();
        var endYearVal = $('#endYear').val();
        var current_SchoolYear = $('#hiddenActiveSy').val();

        // Splitting the value based on the '-' character
        var schoolYearArray = current_SchoolYear.split('-');

        // Extracting the two parts
        var curent_startYear = schoolYearArray[0];
        var curent_endYear = schoolYearArray[1];
        
        // Error
        var syError = $('#syError');
        // Counter
        var isValidSchoolYear = false;
        // Validation
        if(startYearVal.length == 0 || endYearVal.length == 0){
            syError.text('Incomplete input fields');
        }else{
            syError.text('');
            if (endYearVal - startYearVal !== 1 || startYearVal <= curent_startYear) {
                syError.text('Invalid School Year format');
            } else {
                syError.text('');
                isValidSchoolYear = true;
            }
        }

        // Pass to server side
        if(isValidSchoolYear){
            // Enable Second Input Fields
            $('#secondInputFields').removeClass('d-none');
            $('#confirmButton').removeClass('d-none');
            $('#previewTable').removeClass('d-none');
            $('.schoolYearText').text(startYearVal+'-'+endYearVal);
            $('#saveSchoolYearBtn').prop("disabled",false);

            // SA SECOND INPUT FIELD KA NAHINTO
        }else{
            $('#saveSchoolYearBtn').prop("disabled",true);
            $('#previewTable').addClass('d-none');
            $('#secondInputFields').addClass('d-none');
        }

    
    });
    

    // Save school year button
    $('#saveSchoolYearBtn').click(function (e) { 
        e.preventDefault();
        
        var gradeLevel = $('#selectGradeLevel').val();
        var sectionName = $('#sectionName').val().trim().replace(/\s+/g, " ");
         // To uppercase firstLetter, Burahin mo nalng to pag nag error
        sectionName = sectionName.charAt(0).toUpperCase() + sectionName.slice(1);
        // var schoolyearData = $('#schoolyearData').text();
        var pattern = /^[a-zA-Z0-9\s]+$/;
        // Error
        var gradeLevelError = $('#gradeLevelError');
        var sectionError = $('#sectionError');
        // Counter
        var isGradeLevelValid = false;
        var isSectionNameValid = false;

        // Validation
        if (sectionName.length === 0 || sectionName.length < 3 || !pattern.test(sectionName)) {
            isSectionNameValid = false;
            sectionError.text('Please Input a valid Section name');
        } else {
            isSectionNameValid = true;
            sectionError.text('');
        }
    
        if (gradeLevel.length === 0 || !pattern.test(gradeLevel)) {
            isGradeLevelValid = false;
            gradeLevelError.text('Please Input a valid Grade level');
        } else {
            isGradeLevelValid = true;
            gradeLevelError.text('');
        }
        
        // PASSED THE VALIDATION
        if (isGradeLevelValid && isSectionNameValid) {
            var table = $("#userPreviewTable");
            var isDuplicate = false;
        
            // Checking Appended Data kung existing na or hinde
            table.find("tbody tr").each(function() {
                // td:eq(0) is a jQuery selector that targets the first <td> element within a jQuery object.
                var existingGradeLevel = $(this).find("td:eq(0)").text();
                var existingSectionName = $(this).find("td:eq(1)").text();
        
                // Check for duplicates
                if (existingGradeLevel == gradeLevel && existingSectionName.toLowerCase() == sectionName.toLowerCase()) {
                    sectionError.text('Section Name already exist');
                    isDuplicate = true;
                    return false; // Exit the loop
                }
                // Pag Section Name already exist sa na append na data sa User preview
                if(sectionName.toLowerCase() == existingSectionName.toLowerCase()){
                    sectionError.text('Section Name already exist');
                    isDuplicate = true;
                    return false; // Exit the loop
                }
                
            });
        
            // If it's not a duplicate, append to the table
            if (!isDuplicate) {
                // Check Section AJAX
                $.ajax({
                type: "post",
                url: "manageSchoolyear/checkSection.php",
                data: {
                    'sectionName': sectionName,
                },
                success: function (response) {
                    if (response.status == "error") {
                    sectionError.text(response.message);
                    // isSectionNameValid = false;
                    }
                    if (response.status == "success") {
                    console.log(response.status);
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    $("#sectionName").val("");
                    // fetchModalSection();
                    $('.userPreviewTbody').append("<tr><td class='newGradeLevel text-center'>"+gradeLevel+"</td><td class='newSection text-center'>"+sectionName+"</td><td class='text-center'><button class='removeSecBtn btn btn-danger btn-sm fw-semibold btn-close'></button></td></tr>");      
                    $('#sectionName').val('');
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
        }

    });

    // Remove section button
    $(document).on('click','.removeSecBtn',function () {
        $(this).closest('tr').remove();
    })
    // FETCH SECTION MODAL
    fetchModalSection(); //TRY MO LAGAY MO SA ONCLICK NG MODAL NALANG

    // PREVIEW TABLE
    function fetchModalSection(){
        $.ajax({
            type: "get",
            url: "manageSchoolyear/sectionModal.php",
            success: function (response) {
                $('.previewTableBody').html(response);
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed:", status, error);
            }
        });
    }


    // Confirm School Year Button
    $('#confirmButton').click(function (e) { 
        e.preventDefault();
        
        swal({
        title: "Are you sure?",
        text: "Once you clicked the ok, A new school year will be set",
        icon: "warning",
        buttons: true,
        dangerMode: false,
        }).then((okBtn) => {
        if (okBtn) { //Yes button
            var newSection = [];
            var newGradeLevel = [];
            var newSchoolYear = $('#schoolyearData').text();
    
            $('.newSection').each(function(data){
                newSection[data] = $(this).text();
            });
            $('.newGradeLevel').each(function(data){
                newGradeLevel[data] = $(this).text();
            });
    
            $.ajax({
                type: "post",
                url: "manageSchoolyear/addSchoolyear.php",
                data: {
                    'newSection':newSection,
                    'newGradeLevel':newGradeLevel,
                    'newSchoolYear':newSchoolYear,
                },
                success: function (response) {
                    if(response.startsWith("success"))
                    {
                        swal({
                            title: "New School Year Added",
                            icon: "success",
                            button: "Continue",
                        }).then(function () {
                            // location.reload();
                            window.location.href = "dashboard.php"; // Redirect to the dashboard or any other page
                        });
                    }else{
                        alert(response);
                        console.log(response);
                    }                
                },
                error: function (xhr, status, error) {
                    alert("AJAX request failed:", status, error);
                }
            });
        } else {
            swal("Please continue...");
        }
        });

    });



});

