$(document).ready(function () {

    // var subjTbody = $('#subjectOutput');

    fetchSubject();

    function fetchSubject(){
        // Data
        var subjectSchoolyear = $('#subjectSchoolYear').val();
        // Ajax
        $.ajax({
            type: "post",
            url: "manageSchoolyear/fetchSubject.php",
            data: {
                'subjectSchoolyear':subjectSchoolyear,
            },
            success: function (response) {
                $('#subjectOutput').html(response);
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed:", status, error);
            }
        });
    }
    
    function insertSubject(subject,schoolyear){
        $.ajax({
            type: "post",
            url: "manageSchoolyear/addSubject.php",
            data: {
                'schoolyear':schoolyear,
                'subject':subject,
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 'success'){
                    $('#addSubjectModal').modal('hide');
                    $('#subjectInput').val('');
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    fetchSubject();
                }
                if(response.status == 'failed'){
                    alert(response.message);
                }
                if(response.status == 'error') {
                    $('#subjError').text(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed:", status, error);
            }
        });
    }

    function deleteSubject(schoolyear,subjectId) {
        $.ajax({
            type: "post",
            url: "manageSchoolyear/deleteSubject.php",
            data: {
                'schoolyear':schoolyear,
                'subjectId':subjectId,
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 'success')
                {
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    $('#deleteSubjectModal').modal('hide');
                    fetchSubject();
                }
                if(response.status == 'error')
                {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed:", status, error);
            }
        });
    }

    function editSubject(subjectName,subjId,schoolyear){
        $.ajax({
            type: "post",
            url: "manageSchoolyear/editSubject.php",
            data: {
                'subjectName':subjectName,
                'subjId':subjId,
                'schoolyear':schoolyear,
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 'success')
                {
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    $('#editSubjModal').modal('hide');
                    fetchSubject();
                }
                if(response.status == 'error')
                {
                    $('#editSubjError').text(response.message);
                }else{
                    $('#editSubjError').text('');
                }

                if(response.status == 'failed')
                {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed:", status, error);
            }
        });
    }

    // Add subject Modal Open
    $('#addSubjBtn').click(function () { 
        var currentActiveSchoolYear = $('#currentActiveSchoolYear').val();
        $('#hiddeActiveSy').val(currentActiveSchoolYear);
        $('#addSubjectModal').modal('show');
    });

    // Submit Subject
    $('#submitSubjBtn').click(function (e) { 
        e.preventDefault();
        var subjVal = $('#subjectInput').val().trim().replace(/\s+/g, " ");
        var addSubje_schoolyear = $('#hiddeActiveSy').val();
        
        // Regular expression to match special characters, numbers, and quotations
        var regex = /[0-9!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]/g;

        // Check if subjVal contains any special characters, numbers, or quotations
        if (subjVal.length === 0 || regex.test(subjVal) || subjVal.length < 4) {
            $('#subjError').text('Invalid Subject name');
            return;
        }else{
            $('#subjError').text('');
            insertSubject(subjVal,addSubje_schoolyear);
        }

    });

    // Delete Subject Modal
    $(document).on('click','.delSubjbtn',function () {
        var subjName = $(this).closest('tr').find('.subject_Name').text();
        $('#hiddenSubjName').val(subjName);
        $('#deleteSubjectModal').modal('show');

        // NAHINTO SA PAG DELETE NG SUBJECT BASED SA SCHOOLYEAR
    })

    // Confirm Delete Subject Button
    $('#confirmDelSubjbtn').click(function () { 
        var delSubjVal = $('#hiddenSubjName').val();
        var delSubjSchoolyear = $('#subjectSchoolYear').val();
        deleteSubject(delSubjSchoolyear,delSubjVal);
    });

    // Edit Subject Modal
    $(document).on('click','.editSubjBtn',function(){
        var editSubjName = $(this).closest('tr').find('.subject_Name').text();
        $('#hiddenEditSubjVal').val(editSubjName);
        $('#editSubjVal').val(editSubjName);
        $('#editSubjModal').modal('show');
    })
    
    $('#submitEditSubj').click(function (e) { 
        e.preventDefault();
        var editSubjReference = $('#hiddenEditSubjVal').val();
        var editSbjSchoolyear = $('#subjectSchoolYear').val();
        var editSubjVal = $('#editSubjVal').val().trim().replace(/\s+/g, " ");
        var regexPattern = /[0-9!"#$%&'()*+,-./:;<=>?@[\\\]^_`{|}~]/g;
        
        if (editSubjVal.length === 0 || regexPattern.test(editSubjVal) || editSubjVal.length < 4) {
            $('#editSubjError').text('Invalid Subject name');
            return;
        }else{
            $('#editSubjError').text('');
            editSubject(editSubjVal,editSubjReference,editSbjSchoolyear);
        }
    });

    // Subject Filter
    $(document).on('change','#subjectSchoolYear', function () {
        fetchSubject();
    });
});
