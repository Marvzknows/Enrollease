$(document).ready(function () {
    
    var filterBar = $('#filterBar');
    var table = $('#SectionTable');
    var sectionTableBody = $('#SectionOutputData');

    // Functions
    fetchSections(filterBar.val(),sectionTableBody,table);

    function fetchSections(schoolYear,tableBody,tableId) {

        $.ajax({
            type: "post",
            url: "manageSchoolyear/fetchSections.php",
            data: {
                'schoolYear':schoolYear,
            },
            success: function (response) {
                // alert(response);
                tableId.DataTable().destroy();
                tableBody.html(response);
                tableId.DataTable({
                    "paging": true,
                    "pageLength": 5,
                    "lengthChange": false
                });
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed (fetchSections Function): " + status + ", " + error);
            }
        });
    }

    function editSectionFunction(OldGradeLevel,OldSectionName,schoolYear,gradeLevel,sectionName,errorFields,modal) {

        $.ajax({
            type: "post",
            url: "manageSchoolyear/editSection.php",
            data: {
                'OldGradeLevel':OldGradeLevel,
                'OldSectionName':OldSectionName,
                'schoolYear':schoolYear,
                'gradeLevel':gradeLevel,
                'sectionName':sectionName,
            },
            success: function (response) {
                if(response.status == 'error'){
                    errorFields.text(response.message);
                }

                if(response.status == 'success'){
                    fetchSections(filterBar.val(),sectionTableBody,table);
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    modal.modal('hide');
                    
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed (fetchSections Function): " + status + ", " + error);
            }
        });
    }
    
    function submitAddSection(schoolyear, gradeLevel, sectionName) {
      $.ajax({
        type: "post",
        url: "manageSchoolyear/addSection.php",
        data: {
          'schoolyear': schoolyear,
          'gradeLevel': gradeLevel,
          'sectionName': sectionName,
        },
        dataType: "JSON",
        success: function (response) {
          if (response.status == "success") {
            alertify.dismissAll(""); // or alertify.closeAll();
            alertify.set("notifier", "position", "top-right");
            alertify.success(response.message);
            $("#addSectionName").val("");
            $('#addSectionModal').modal('hide');
            fetchSections(filterBar.val(),sectionTableBody,table); // fetch section
          }

          if (response.status == "error") {
            $("#addSectionNameError").text(response.message);//section name alreadt exist
          }

          if (response.status == "failed") {
            alert(response.message);
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
    // Filter TableBody
    $('#filterBar').change(function () { 
        var filterVal = $(this).val();
        fetchSections(filterVal,sectionTableBody,table);
    });

    // Open Edit Modal
    $(document).on('click','.editSectionBtn',function (){
        var hiddenSy = $('#filterBar').val();
        var lvlData = $(this).closest('tr').find('.gradeLevelTxt').text();
        var secData = $(this).closest('tr').find('.sectionTxt').text();
        // Fetch Hidden Data
        $('#hiddenSchoolYear').val(hiddenSy);
        $('#hiddenGradeLevel').val(lvlData);
        $('#hiddenSecName').val(secData);
        // Fetch Data
        $('#editGradeLevel').val(lvlData);
        $('#editSectionName').val(secData);

        $('#editSectionModal').modal('show');
    });

    // Save Edit Button
    $('#saveEditBtn').click(function () { 
        // References
        var editGradeLevelError = $('#editGradeLevelError');
        var editSectioNameError = $('#editSectioNameError');
        var editModal = $('#editSectionModal');
        // Get Hidden Data
        var hiddenSyData = $('#hiddenSchoolYear').val();
        var hiddenGradeLevelData = $('#hiddenGradeLevel').val();
        var hiddenSecNameData = $('#hiddenSecName').val();
        // Get Updated Data
        var newGradeLevel = $('#editGradeLevel').val();
        var newSectionName = $('#editSectionName').val().trim().replace(/\s+/g, " ");
        // Counter
        var isValidNewGradeLevel = false;
        var isValidNewSectionName = false;

        if(newGradeLevel > 10 || newGradeLevel < 7){
            editGradeLevelError.text('Invalid Grade level');
        }else{
            editGradeLevelError.text('');
            isValidNewGradeLevel = true;
        }

        if(newSectionName.length < 3)
        {
            editSectioNameError.text('Invalid Section Name');
        }else{
            editSectioNameError.text('');
            isValidNewSectionName = true;
            // Check section name availability
        }

        // Success Validation
        if(isValidNewGradeLevel && isValidNewSectionName)
        {
            editSectionFunction(hiddenGradeLevelData,hiddenSecNameData,hiddenSyData,newGradeLevel,newSectionName,editSectioNameError,editModal)
        }
    });

    // Cancel Edit Button
    $(document).on('click','.cancelEditBtn',function () {
        $('#editSectioNameError').text('');
        $('#editGradeLevelError').text('');
    })


    // Add Section modal
    $('#addSectionBtn').click(function () { 
        $('#addSectionModal').modal('show');
    });

    // Submit Add Section 
    $('#saveAddSectionBtn').click(function (e) { 
        e.preventDefault();
        // Values
        var hiddenAddSecSy = $('#hiddenAddSectionSchoolYear').val();
        var addGradeLevelVal = $('#addGradeLevel').val();
        var addSectionNameVal = $('#addSectionName').val().trim().replace(/\s+/g, " ");
        addSectionNameVal = addSectionNameVal.charAt(0).toUpperCase() + addSectionNameVal.slice(1);

        var isValidAddGradeLvl = false;
        var isValidAddSectionNameVal = false;
        var sqlInjectPattern = /['";`<>&]/;
        var specialCharValidation = /^[A-Za-z\s]+$/;

        if(addGradeLevelVal.length != 0){
            isValidAddGradeLvl = true;
            $('#addGradeLevelError').text('');
        }else{
            $('#addGradeLevelError').text('Invalid Grade level');
        }
        // SectionName validation
        if(addSectionNameVal.length == 0 || sqlInjectPattern.test(addSectionNameVal) || !specialCharValidation.test(addSectionNameVal)){
            $('#addSectionNameError').text('Invalid Section name');
        }else{
            $('#addSectionNameError').text('');
            isValidAddSectionNameVal = true;
        }

        if(isValidAddGradeLvl && isValidAddSectionNameVal){
            submitAddSection(hiddenAddSecSy, addGradeLevelVal, addSectionNameVal);
        }
    });




    // doc end
});