$(document).ready(function () {
  // NOTE: PAG NAG LOKO DATATABLE ISET MO NA AS VARIABLE PARA YUNG VARIABLE NALNG DEDESTROY
  // FUNCTIONS
  fetchAccounts();
  function fetchAccounts() {
    $.ajax({
      type: "get",
      url: "personnels/fetchAccounts.php",
      success: function (response) {
        $("#acctable").DataTable().destroy();
        $("#tbodyOutput").html(response);
        $("#acctable").DataTable();
        $("#disabledButton").prop("disabled", true);
        $("#enableButton").prop("disabled", true);
        // Reset Select Option
        $("#filterStatus").val("");
      },
      error: function (xhr, status, error) {
        alert("AJAX request error:", error);
      },
    });
  }

  function updateAccountStatus(dataId, accStatus) {
    $.ajax({
      type: "post",
      url: "personnels/updateStatus.php",
      data: {
        dataId: dataId,
        accStatus: accStatus,
      },
      success: function (response) {
        alertify.dismissAll(""); // or alertify.closeAll();
        alertify.set("notifier", "position", "top-right");
        alertify.success(response);
        fetchAccounts();
      },
      error: function (xhr, status, error) {
        alert("AJAX request error:", error);
      },
    });
  }

  // Add Teacher Open Modal
  $("#addteacher_btn").click(function () {
    $("#addteachermodal").modal("show");

    var idInputField = $("#teacherId");

    generateId(idInputField);

    // Functions
    function generateId(inputField) {
      $.ajax({
        type: "get",
        url: "personnels/generateTeacherId.php",
        success: function (response) {
          inputField.val(response);
        },
        error: function (xhr, status, error) {
          alert(xhr + status + error);
        },
      });
    }
  });

  // SAVE BUTTON
  $("#add_teacher_btn").click(function (e) {
    e.preventDefault();

    // Error
    var fnameError = $("#fnameError");
    var lnameError = $("#lnameError");
    var passwordError = $("#passwordError");
    // Counter
    var isPasswordValid = false;
    var isFnameValid = false;
    var isLnameValid = false;
    // Data
    var teacherId = $("#teacherId").val();
    var fname = $("#fname").val().trim().replace(/\s+/g, " ");
    var mname = $("#mname").val().trim().replace(/\s+/g, " ");
    var lname = $("#lname").val().trim().replace(/\s+/g, " ");
    var password = $("#password").val();

    // Validation
    if (fname.length != 0 && fname.length > 2) {
      $("#fnameError").text("");
      isFnameValid = true;
    } else {
      fnameError.text("Please Enter a valid First Name");
    }

    if (lname.length != 0 && lname.length > 2) {
      $("#lnameError").text("");
      isLnameValid = true;
    } else {
      lnameError.text("Please Enter a valid Last Name");
    }

    if (password.length != 0) {
      $("#passwordError").text("");
      isPasswordValid = true;
    } else {
      passwordError.text("Please Enter a valid Password");
    }

    // Register API
    if (isFnameValid && isLnameValid && isPasswordValid) {
      $.ajax({
        type: "post",
        url: "personnels/insert.php",
        data: {
          'teacherId': teacherId,
          'fname': fname,
          'mname': mname,
          'lname': lname,
          'password': password,
        },
        dataType: "JSON",
        success: function (response) {
          if (response.status == "success") {
            swal({
              title: "New Teacher Addded",
              text: response.message,
              icon: "success",
              button: "Ok",
            });
            // Clear the form and Hide the Modal
            fetchAccounts();
            $("#addTeacherForm")[0].reset();
            $("#addteachermodal").modal("hide");
          }

          if (response.status == "failed") {
            swal({
              title: "ERROR",
              text: response.message,
              icon: "error",
              button: "I understand",
            });
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
  });

  // CHECK ALL BUTTON
  $(document).on("change", "#selectAllButton", function () {
    if ($(this).is(":checked")) {
      // $("#acctable").DataTable().rows().select();
      // DT1.rows(  ).select();
      $(".selectData").prop("checked", true);
      $("#disabledButton").prop("disabled", false);
      $("#enableButton").prop("disabled", false);
    } else {
      $(".selectData").prop("checked", false);
      $("#disabledButton").prop("disabled", true);
      $("#enableButton").prop("disabled", true);
    }

    // LOGIC FOR DISABLE BUTTONS IF NO NUMBER OF DATA IS DISPLAYED
    if(!$(".selectData").is(":checked"))
    {
      $("#disabledButton").prop("disabled", true);
      $("#enableButton").prop("disabled", true);
    }
  });

  // MANUAL CHECKBOX BUTTON
  $(document).on("change", ".selectData", function () {

    var anyChecked = $(".selectData:checked").length > 0;
    $("#disabledButton").prop("disabled", !anyChecked);
    $("#enableButton").prop("disabled", !anyChecked);

  });
  

  // DISABLED ACCOUNT BUTTON
  $("#disabledButton").click(function () {
    // alert('clicked')
    var id = [];
    var isDisable = "Disabled";
    $(":checkbox:checked").each(function (index) {
      id[index] = $(this).val();
    });
    updateAccountStatus(id, isDisable);
  });

  // ENABLE ACCOUNT BUTTON
  $("#enableButton").click(function () {
    var id = [];
    var isEnable = "Enable";
    $(":checkbox:checked").each(function (index) {
      id[index] = $(this).val();
    });

    updateAccountStatus(id, isEnable);
  });

  // EDIT MODAL OPEN
  $(document).on("click", ".edit_btn", function () {
    var editId = $(this).closest('tr').find('.selectData').val();
    $('#hiddenId').val(editId);
    $.ajax({
      type: "post",
      url: "personnels/fetchEditData.php",
      data: {
        'editId':editId,
      },
      success: function (response) {
        $('#editForm').html(response);
        $('#editmodal').modal('show');
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:" + status, error);
        alert(
          "An error occurred while processing your request of editing data. Please try again later."
        );
      },

    });
  });
  
  // SAVE CHANGES BUTTON
  $('#submitEditBtn').click(function () { 
    // Reference Variable
    var hiddenIdValue = $('#hiddenId').val();
    var editFnameVal = $('#editFname').val().trim().replace(/\s+/g, " ");
    var editMnameVal = $('#editMname').val().trim().replace(/\s+/g, " ");
    var editLnameVal = $('#editLname').val().trim().replace(/\s+/g, " ");
    var editPasswordVal = $('#editPassword').val().trim().replace(/\s+/g, " ");
    // Counter
    var validFname = false;
    var validMname = false;
    var validLname = false;
    var validPassword = false;
    // Errors
    var editFnameError = $('#editFnameError');
    var editMnameError = $('#editMnameError');
    var editLnameError = $('#editLnameError');
    var editPasswordError = $('#editPasswordError');
    // Fname
    if(editFnameVal.length > 3){
      validFname = true;
      editFnameError.text('');
    }else{
      validFname = false;
      editFnameError.text('Invalid First Name');
    }
    // Mname
    if(editMnameVal.length == 0 || editMnameVal.length >= 2){
      validMname = true;
      editMnameError.text('');
    }else{
      validMname = false;
      editMnameError.text('Invalid Middle Name');
    }
    // Lname
    if(editLnameVal.length > 3){
      validLname = true;
      editLnameError.text('');
    }else{
      validLname = false;
      editLnameError.text('Invalid Last Name');
    }
    // Password
    if(editPasswordVal.length > 2){
      validPassword = true;
      editPasswordError.text('');
    }else{
      validPassword = false;
      editPasswordError.text('Invalid First Name');
    }

    // Success Validation
    if(validFname && validLname && validMname && validPassword){
      $.ajax({
        type: "post",
        url: "personnels/editAccount.php",
        data: {
          'hiddenIdValue':hiddenIdValue,
          'editFnameVal':editFnameVal,
          'editMnameVal':editMnameVal,
          'editLnameVal':editLnameVal,
          'editPasswordVal':editPasswordVal,
        },
        success: function (response) {
          alertify.dismissAll(""); // or alertify.closeAll();
          alertify.set("notifier", "position", "top-right");
          alertify.success(response);
          fetchAccounts();
          $('#editmodal').modal('hide');
        },
        error: function (xhr, status, error) {
          alert("AJAX request error:", error);
        },

      });
    }
  });

  // Filter Status
  $('#filterStatus').change(function () { 
    var statusValue = $('#filterStatus').val();

    if(statusValue.length > 0)
    {
      $.ajax({
        type: "post",
        url: "personnels/filterAccounts.php",
        data: {
          'statusValue':statusValue,
        },
        success: function (response) {
          $("#acctable").DataTable().destroy();
          $("#tbodyOutput").html(response);
          $("#acctable").DataTable();
        }
      });
    }else{
      fetchAccounts();
    }
  });

  // Add teacher Show password
  $(document).on("click", "#addteacher_eyeIcon", function () {
    var passwordInputField = $("#password");
    var showPasswordToggle = $("#showPasswordToggle"); // icon

    if (passwordInputField.attr("type") == "text") {
      // Change to Password
      passwordInputField.attr("type", "password");
      $("#eyeIcon").removeClass("fa-eye-slash").addClass("fa-eye");
    } else {
      // Change to text
      passwordInputField.attr("type", "text");
      $("#eyeIcon").removeClass("fa-eye").addClass("fa-eye-slash");
    }
  });

  // Edit show password
  $(document).on("click", "#eyeIcon", function () {
    var passwordInputField = $("#editPassword");
    var showPasswordToggle = $("#showPasswordToggle"); // icon

    if (passwordInputField.attr("type") == "text") {
      // Change to Password
      passwordInputField.attr("type", "password");
      $("#eyeIcon").removeClass("fa-eye-slash").addClass("fa-eye");
    } else {
      // Change to text
      passwordInputField.attr("type", "text");
      $("#eyeIcon").removeClass("fa-eye").addClass("fa-eye-slash");
    }
  });

});

