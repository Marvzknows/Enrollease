// Nirename mo mga Endpoint ng URL from students/ to advanceStudent/
$(document).ready(function () {
  var activeGradeLevel = $("#gradeLevel").val();
  var lastSchoolYear = $("#lastSchoolYear").val();
  var selectSection = $("#selectSection");

  // Functions
  function getActiveSchoolyear(inputField) {
    $.ajax({
      type: "get",
      url: "../advanceStudent/activeSy.php",
      success: function (response) {
        inputField.val(response);
      },
      error: function (xhr, status, error) {
        alert(
          "Ajax request failed for getActiveSchoolyear Function. Status: " +
            status +
            ", Error: " +
            error
        );
      },
    });
  }

  function fetchSection(schoolyear, gradelevel, htmlElement) {
    $.ajax({
      type: "post",
      url: "../advanceStudent/fetchSection.php",
      data: {
        schoolyear: schoolyear,
        gradelevel: gradelevel,
      },
      success: function (response) {
        // htmlElement.empty();
        htmlElement.html(response);
        // $("#selectSection").html(response);
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

  function fetchStudents(schoolyear, gradelevel, section) {
    $.ajax({
      type: "post",
      url: "../advanceStudent/fetchStudent.php",
      data: {
        schoolyear: schoolyear,
        gradelevel: gradelevel,
        section: section,
      },
      success: function (response) {
        $("#moveStudentBtn").prop("disabled", true);
        $("#completerBtn").prop("disabled", true);
        $("#studentTable").DataTable().destroy();
        $("#studentTbody").html(response);
        $("#studentTable").DataTable({
          pageLength: 5,
          // "lengthMenu": [[-1], ["All"]]
        });
      },
      error: function (xhr, status, error) {
        alert(
          "Ajax request failed for fetchStudents Function. Status: " +
            status +
            ", Error: " +
            error
        );
      },
    });
  }

  // Function Calls
  fetchSection(lastSchoolYear, activeGradeLevel, selectSection);

  // Search Students Button
  $("#viewBtn").on("click", function (e) {
    e.preventDefault();

    var studSchoolYear = $("#lastSchoolYear").val();
    var studGradeLevel = $("#gradeLevel").val();
    var studSection = $("#selectSection").val();

    if (studSection.length > 0) {
      $("#studentTable").removeClass("d-none");
      fetchStudents(studSchoolYear, studGradeLevel, studSection);
      $("#sectionError").text("");
    } else {
      $("#sectionError").text("Please select valid section");
    }
  });

  // Onchange Grade level and section
  $("#gradeLevel").on("change", function () {

    // uncheck lahat ng checked na checkbox pati check all pag nag palit ng gradelevel, pati mga action buttons
    $(".selectData").prop("checked", false);
    $("#selectAllStudentBtn").prop("checked", false);
    $("#moveStudentBtn").prop("disabled", true);
    $("#completerBtn").prop("disabled", true);
    
    var onChangeGradelvl = $(this).val();
    var selectedSyVal = $("#lastSchoolYear").val();
    var sectionDropdown = $("#selectSection");
    fetchSection(selectedSyVal, onChangeGradelvl, sectionDropdown);
  });

  // Check All button
  $("#selectAllStudentBtn").on("change", function () {
    // Old Data
    var selectedData = $('.selectData').val();
    var checkAllOldGradeLevel = $('#gradeLevel').val();
    var old_Section = $('#selectSection').val();

    if ($(this).is(":checked") && $(this).length >= 1 && selectedData.length > 0) {
      $("#studentTable").DataTable().destroy();
      $("#studentTable").DataTable({
        // "pageLength": 10
        lengthMenu: [[-1], ["All"]],
      });
      $(".selectData").prop("checked", true);
      $("#moveStudentBtn").prop("disabled", false);
    } else {
      $("#studentTable").DataTable().destroy();
      $("#studentTable").DataTable({
        pageLength: 10,
        // "lengthMenu": [[-1], ["All"]]
      });
      $(".selectData").prop("checked", false);
      $("#moveStudentBtn").prop("disabled", true);
    }
    
    // Enable or disable the completers button based on the checked checkboxes
    if ($(this).is(":checked") && $(this).length >= 1 && selectedData.length > 0 && checkAllOldGradeLevel === "10") {
      $("#studentTable").DataTable().destroy();
      $("#studentTable").DataTable({
        // "pageLength": 10
        lengthMenu: [[-1], ["All"]],
      });
      $("#completerBtn").prop("disabled", false); // enable completers button
      $("#moveStudentBtn").prop("disabled", true);
    } else {
      $("#studentTable").DataTable().destroy();
      $("#studentTable").DataTable({
        pageLength: 10,
        // "lengthMenu": [[-1], ["All"]]
      });
      $("#completerBtn").prop("disabled", true); // disable completers button
    }

    if(checkAllOldGradeLevel == '10' && old_Section == ''){
      $("#completerBtn").prop("disabled", true);
    }
    
  });

  // Manual Check
  $(document).on("change", ".selectData", function () {
    // Get all checked checkboxes with the class 'selectData'
    var checkedCheckboxes = $(".selectData:checked");
    var oldGradeLevel = $('#gradeLevel').val();
    var oldSection = $('#selectSection').val();
    
    // Check if there are any checked checkboxes
    if (checkedCheckboxes.length > 0 && oldGradeLevel !== "10") {
      $("#moveStudentBtn").prop("disabled", false);
      $("#completerBtn").prop("disabled", true); // disable completers button
    } else {
      $("#moveStudentBtn").prop("disabled", true);
      
      // Enable or disable the completers button based on the checked checkboxes
      if (checkedCheckboxes.length === 0) {
        $("#completerBtn").prop("disabled", true); // disable completers button
      } else {
        $("#completerBtn").prop("disabled", false); // enable completers button
      }

      if(oldGradeLevel == '10' && oldSection == ''){
        $("#completerBtn").prop("disabled", true);
      }else if(checkedCheckboxes.length > 0 && oldSection == '') {
        $("#moveStudentBtn").prop("disabled", true); // disabled Move Student Button
      }
    }
  });
  
  

  // Move Student Grade Level Modal
  $("#moveStudentBtn").click(function () {
    getActiveSchoolyear($("#activeSchoolyear"));

    var selectedLastSchoolYear = $('#lastSchoolYear').val();
    var selectedGradeLevel = $('#gradeLevel').val();
    var selectedSection = $('#selectSection').val();

    $('#hiddenOldSchoolYear').val(selectedLastSchoolYear);
    $('#hiddenGradeLevel').val(selectedGradeLevel);
    $('#hiddenSection').val(selectedSection);

    var gradeLevelOptions = '<option value="" selected>- Select Grade Level -</option>';

    if (selectedGradeLevel == '7') {
      $('#moveGradeLevel').empty();
      gradeLevelOptions += '<option value="8">8</option><option value="9">9</option><option value="10">10</option>';
      $('#moveGradeLevel').append(gradeLevelOptions);
    }else if(selectedGradeLevel == '8') {
      $('#moveGradeLevel').empty();
      gradeLevelOptions += '<option value="9">9</option><option value="10">10</option>';
      $('#moveGradeLevel').append(gradeLevelOptions);
    }else if(selectedGradeLevel == '9') {
      $('#moveGradeLevel').empty();
      gradeLevelOptions += '<option value="10">10</option>';
      $('#moveGradeLevel').append(gradeLevelOptions);
    }

    $("#moveGradelevelModal").modal("show");
  });

  // onChange Move Grade lvl Section dropdown
  $('#moveGradeLevel').on('change', function () {
    var onChangeMoveSchoolYear = $('#activeSchoolyear').val();
    var onChangeMoveGrade = $(this).val();
    var sectionDropdownMoveGrade = $('#moveSection');

    fetchSection(onChangeMoveSchoolYear, onChangeMoveGrade, sectionDropdownMoveGrade);
  });
  // Confirm Move Grade Level Button
  $(document).on("click", "#confirmMovebtn", function () {

    // Modal Hidden Data
    var hiddenOldSchoolYearVal = $('#hiddenOldSchoolYear').val();
    var hiddenGradeLevelVal = $('#hiddenGradeLevel').val();
    var hiddenSectionVal = $('#hiddenSection').val();

    // Ajax Data
    var moveSchoolyearVal = $('#activeSchoolyear').val();
    var moveGradelevelVal = $('#moveGradeLevel').val();
    var moveSectionVal = $('#moveSection').val();

    if(moveGradelevelVal.length > 0 && moveSectionVal.length > 0) {
      $('#moveStudentError').text('');

      var studentId = [];

      $(":checkbox.selectData:checked").each(function (index) {
        studentId[index] = $(this).val();
      });

      $.ajax({
        type: "post",
        url: "../advanceStudent/moveStudents.php",
        data: {
          'hiddenOldSchoolYearVal':hiddenOldSchoolYearVal,
          'hiddenGradeLevelVal':hiddenGradeLevelVal,
          'hiddenSectionVal':hiddenSectionVal,
          'moveSchoolyearVal':moveSchoolyearVal,
          'moveGradelevelVal':moveGradelevelVal,
          'moveSectionVal':moveSectionVal,
          'studentId':studentId,
        },
        success: function (response) {
          if(response.startsWith('success')) {
            swal({
              title: "Enrolled",
              text: "Selected Students successfully Enrolled",
              icon: "success",
              button: "Ok",
            }).then(function () {
              $("#moveGradelevelModal").modal("hide");
              // Uncheck All the checkboxes and disable Advance button
              $(".selectData").prop("checked", false);
              $("#selectAllStudentBtn").prop("checked", false);
              $("#moveStudentBtn").prop("disabled", true);
              // Fetch Students
              var fetchStudSyVal = $("#hiddenOldSchoolYear").val();
              var fetchStudGradelvlVal = $("#hiddenGradeLevel").val();
              var fetchStudSectionVal = $("#hiddenSection").val();

              fetchStudents(fetchStudSyVal, fetchStudGradelvlVal, fetchStudSectionVal);
            });

          }else if(response == 'failed') {
            alert('Action Denied');
          } else {
            alert(response);
          }

        },
        error: function (xhr, status, error) {
          alert(
            "Ajax request failed failed. Status: " +
              status +
              ", Error: " +
              error
          );
        }

      });

    }else {
      $('#moveStudentError').text('Invalid input');
    }

  });




  // Completers Modal open
  $('#completerBtn').click(function () { 

    var compHiddenOldSchoolYear = $('#lastSchoolYear').val();
    var compHiddenGradeLevel = $('#gradeLevel').val();
    var compHiddenSection = $('#selectSection').val();
    var compSchoolYear = $('#lastSchoolYear').val();

    $('#compHiddenOldSchoolYear').val(compHiddenOldSchoolYear);
    $('#compHiddenGradeLevel').val(compHiddenGradeLevel);
    $('#compHiddenSection').val(compHiddenSection);
    $('#compSy').text(compSchoolYear);

    $('#completersModal').modal('show');
  });

  // Confirm Completers Button
  $(document).on('click', '#confirmCompletersBtn', function () {
    // Get Hidden Data Values
    var compHiddenOldSchoolYearVal = $('#compHiddenOldSchoolYear').val();
    var compHiddenGradeLevelVal = $('#compHiddenGradeLevel').val();
    var compHiddenSectionVal = $('#compHiddenSection').val();

    var sid = []; // checkboxes data container
      
    $(":checkbox.selectData:checked").each(function (index) {
      sid[index] = $(this).val();
    });

    $.ajax({
      type: "post",
      url: "../advanceStudent/completers.php",
      data: {
        'sid':sid,
        'compHiddenOldSchoolYearVal':compHiddenOldSchoolYearVal,
        'compHiddenGradeLevelVal':compHiddenGradeLevelVal,
        'compHiddenSectionVal':compHiddenSectionVal,
      },
      success: function (response) {
        if(response.startsWith('success')) {
          console.log('completers');
          swal({
            title: "Finished!",
            icon: "success",
            button: "Ok",
          }).then(function () {
            $("#completersModal").modal("hide");
            // Uncheck All the checkboxes and disable Advance button
            $(".selectData").prop("checked", false);
            $("#selectAllStudentBtn").prop("checked", false);
            $("#moveStudentBtn").prop("disabled", true);
            $("#completerBtn").prop("disabled", true);
            // Fetch Students
            var fetchCompleterStudSyVal = $("#compHiddenOldSchoolYear").val();
            var fetchCompleterStudGradelvlVal = $("#compHiddenGradeLevel").val();
            var fetchCompleterStudSectionVal = $("#compHiddenSection").val();

            fetchStudents(fetchCompleterStudSyVal, fetchCompleterStudGradelvlVal, fetchCompleterStudSectionVal);
          });
        } else if (response.startsWith('failed')) {
          alert('$updateStudentQuery Failed');
        } else {
          alert(response);
          console.log(response);
        }
      },
      error: function (xhr, status, error) {
        alert(
          "Ajax request failed failed. Status: " +
            status +
            ", Error: " +
            error
        );
      }

    });

  });

  
});
