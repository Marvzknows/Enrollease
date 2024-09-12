$(document).ready(function () {

    var currentSchoolYear = $('#activeSchoolYear').text();
    var currentGradeLevelVal = $('#selectGradeLevel').val();
    var currentSectionVal = $('#selectSection').val();


    function fetchStudent(schoolYear, gradeLevel, section) {    
        $.ajax({
          type: "post",
          url: "students/fetchStudent.php",
          data: {
            'schoolYear': schoolYear,
            'gradeLevel': gradeLevel,
            'section': section,
          },
          success: function (response) {
            $("#studentTable").DataTable().destroy();
            $("#studentTbody").html(response);
            $("#studentTable").DataTable({
                pageLength: 10,
                // "lengthMenu": [[-1], ["All"]]
            });
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

    function fetchSection(schoolYear, gradeLevel) {
        $.ajax({
            type: "post",
            url: "students/fetchSection.php",
            data: {
              'schoolYear': schoolYear,
              'gradeLevel': gradeLevel,
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
    // Call Functions
    fetchStudent(currentSchoolYear, currentGradeLevelVal, currentSectionVal);
    fetchSection(currentSchoolYear, currentGradeLevelVal);

    // Grade Level onchange fetch section
    $(document).on('change','#selectGradeLevel', function () {

        var sectionGradeLevelVal = $('#selectGradeLevel').val();
        var sectionSchoolYearVal = $('#activeSchoolYear').text();

        fetchSection(sectionSchoolYearVal, sectionGradeLevelVal);
    });

    // Show Button
    $(document).on('click','#showBtn', function () {
        
        var activeSchoolYearVal = $('#activeSchoolYear').text();
        var gradeLevelVal = $('#selectGradeLevel').val();
        var sectionVal = $('#selectSection').val();

        if(activeSchoolYearVal.length > 0 && gradeLevelVal.length > 0 && sectionVal.length > 0) {
            $('#sectionError').text('');
            fetchStudent(activeSchoolYearVal, gradeLevelVal, sectionVal);
        }else {
            $('#sectionError').text('Invalid Input');
        }
    });

    // View Button
    $(document).on('click','.viewButton', function () {

      var viewSchoolyear = $('#activeSchoolYear').text();
      var viewStudLrn = $(this).closest('tr').find('.studentLrn').text();
      var viewGradeLevel = $(this).closest('tr').find('.studentGrade_Level').text();
      var viewSectionName = $(this).closest('tr').find('.student_sectionName').text();
      
      $.ajax({
        type: "post",
        url: "students/viewModal.php",
        data: {
          'viewSchoolyear':viewSchoolyear,
          'viewStudLrn':viewStudLrn,
          'viewGradeLevel':viewGradeLevel,
          'viewSectionName':viewSectionName
        },
        success: function (response) {
          $('#viewModalOutput').html(response);
          $('#viewModal').modal('show');
        },
        error: function (xhr, status, error) {
          alert(
            "Ajax request failed. Status: " +
              status +
              ", Error: " +
              error
          );
        }
      });

    });
    
    // // Unenroll Button
    // $(document).on('click','.unEnrolledBtn', function () {
    //   var unEnrollLrn = $(this).closest('tr').find('.studentLrn').text();
    //   var unEnrollSchoolyear = $('#activeSchoolYear').text();
    //   // alert(unEnrollSchoolyear);
    //   // LOGIC
    //   // SET AS PENDING MO DATA NYA LAST SCHOOLYEAR (WHERE = SHOOLYEAR AT LRN)
    //   //  TAS DELETE YUNG DATA NYA CURRENT YEAR (WHERE = SHOOLYEAR AT LRN)
    // });
});