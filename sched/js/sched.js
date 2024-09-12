$(document).ready(function () {
    // NOTE : TRY MO GAWANG NG CLICK FUNCTION SI CLOSE BTN NG MODA PARA MA CLEAR MGA INPUT FIELDS

    var activeSchoolyear = $('#sySession').text();
    var table = $('#teacherDatatable');
    var tableBody = $('#teacherTableBody');
    var schedFormErrorMsg = $('#schedFormError');

    // Functions
    fetchTeachers(table,tableBody); // Fetch data 
    selectSection(activeSchoolyear,$('#selectSection')); //Select Section Dropdown (PEDE MO IPASOK SA LOOB NG addSchedBtn)

    function fetchTeachers(datatable,tbody) {
        $.ajax({
            type: "get",
            url: "sched/fetchTeachers.php",
            success: function (response) {
                datatable.DataTable().destroy();
                tbody.html(response);
                // datatable.DataTable();
                datatable.DataTable({
                    pageLength: 5,
                    responsive: true, // Add this line for responsiveness

                    // "lengthMenu": [[-1], ["All"]]
                });
            },
            error: function (xhr, status, error) {
                // Handle the Ajax request error here
                alert("Ajax request failed for fetchTeachers Function. Status: " + status + ", Error: " + error);
            }
        });
    }

    function selectSection (schoolYear,selectTagId) {
        
        $.ajax({
            type: "post",
            url: "sched/fetchSection.php",
            data: {
                'schoolYear':schoolYear,
            },
            success: function (response) {
                selectTagId.append(response);
            },
            error: function (xhr, status, error) {
                // Handle the Ajax request error here
                alert("Ajax request failed for selectSection Function. Status: " + status + ", Error: " + error);
            }
        });
    }

    function insertSchedule(teacherId,schoolYear,day,subject,section,startTime,endTime,errorMsg) {
        $.ajax({
            type: "post",
            url: "sched/addSched.php",
            data: {
                'teacherId':teacherId,
                'schoolYear':schoolYear,
                'day':day,
                'subject':subject,
                'section':section,
                'startTime':startTime,
                'endTime':endTime,
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status == 'success')
                {
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    $('#startTime').val('');
                    $('#endTime').val('');
                    $('#selectSection').val('');
                    $('#schedFormError').text('');
                    // PREVIEW TABLE
                    // Converting Time to 12 hour format (START TIME)
                    var startTimeArray = startTime.split(":");
                    var startTimeHours = parseInt(startTimeArray[0]);
                    var startTime_ampm = startTimeHours >= 12 ? ":00 PM" : ":00 AM";
                    startTimeHours = startTimeHours % 12;
                    startTimeHours = startTimeHours ? startTimeHours : 12; // Handle midnight (00:00:00) as 12 AM
                    var convertedStartTime = startTimeHours + "" + startTime_ampm;
                    // Conveting Time to 12 hr format (END TIME)
                    var endTimeArray = endTime.split(":");
                    var endTimeHours = parseInt(endTimeArray[0]);
                    var endTime_ampm = endTimeHours >= 12 ? ":00 PM" : ":00 AM";
                    endTimeHours = endTimeHours % 12;
                    endTimeHours = endTimeHours ? endTimeHours : 12; // Handle midnight (00:00:00) as 12 AM
                    var convertedEndTime = endTimeHours + "" + endTime_ampm;
                    
                    $('#previewTable').removeClass('d-none');
                    $('#previewTable').append('<li class="list-group-item fw-semibold">'+day+'<span class="fw-semibold"> - </span>'+subject+'<span class="fw-semibold"> - </span>'+section+'<span class="fw-semibold"> Time : </span>'+convertedStartTime+'-'+convertedEndTime+'</li>');

                    // Update section schedule
                    fetchSectionSchedule(section,schoolYear);
                }
                if(response.status == 'error')
                {
                    errorMsg.text(response.message);
                }
                // CODE ERROR
                if(response.status == 'failed')
                {
                    alert(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("Ajax request failed for insertSchedule Function. Status: " + status + ", Error: " + error);
                console.log("Ajax request failed for insertSchedule Function. Status: " + status + ", Error: " + error);
            }
        });
    }

    function fetchSectionSchedule(section,schoolYear) {
        $.ajax({
            type: "post",
            url: "sched/sectionSched.php",
            data: {
                'section':section,
                'schoolYear':schoolYear,
            },
            success: function (response) {
                $('#sectionSchedTbody').html(response);
            },
            error: function (xhr, status, error) {
                // Handle the Ajax request error here
                alert("Ajax request failed for fetchTeachers Function. Status: " + status + ", Error: " + error);
            }
        });
    }
    // Add Sched Modal Open
    $(document).on('click','.addSchedBtn',function () {
        // References
        var teacherId = $(this).closest('tr').find('.teacher_id').text(); //Teacher ID
        var teacherName = $(this).closest('tr').find('.l_name').text()+' '+ $(this).closest('tr').find('.f_name').text();
        // Hidden Input field
        $('#hiddenTeacherId').val(teacherId);
        // Header's Data
        $('#schoolYearVal').val(activeSchoolyear);
        $('#teacherFullName').val(teacherName);
        $('#addSchedModal').modal('show');
    })

    // Submit Schedule Button
    $(document).on('click','#submitSchedButton',function (e) {
        e.preventDefault();
        
        var hiddenTeacherIdVal = $('#hiddenTeacherId').val();
        var modalSchoolYearVal = $('#schoolYearVal').val();
        var dayVal = $('#days').val();
        var subjectVal = $('#subject').val();
        var sectionVal = $('#selectSection').val();
        var startTimeVal = $('#startTime').val();
        var endTimeVal = $('#endTime').val();
        var errorDisplay = $('#schedFormError');

        if(dayVal.length != 0 && subjectVal.length != 0 && sectionVal.length != 0 && startTimeVal !== "" && endTimeVal !== ""){
            if(endTimeVal <= startTimeVal){
                $('#schedFormError').text('Invalid Time format');
            }else{
                // alert('Time format is valid');
                insertSchedule(hiddenTeacherIdVal,modalSchoolYearVal,dayVal,subjectVal,sectionVal,startTimeVal,endTimeVal,errorDisplay);            }
        }else{
            $('#schedFormError').text('Incomplete Input fields');
        }
    })

    // Close Modal Button (Clear input fields)
    $(document).on('click','#closeModalBtn',function (e) {
        e.preventDefault();
        $('#subject').val('');
        $('#days').val('');
        $('#startTime').val('');
        $('#endTime').val('');
        $('#selectSection').val('');
        $('#schedFormError').text('');
        $('#previewTable').addClass('d-none');
        $('#sectionSchedPreview').addClass('d-none');
    })

    // Delete Schedule Modal
    $(document).on('click','.delete_sched_btn', function () {
        $('#deleteSchedModal').modal('show');

        var hiddenDelTeacherId = $(this).closest('tr').find('.teacher_id').text();
        var hiddenDelSchoolYear = $('#sySession').text();
        
        $('#hiddenDelTeacherId').val(hiddenDelTeacherId);
        $('#hiddenDelSchoolYear').val(hiddenDelSchoolYear);
    });
    
    // Confirm Delete Sched Button
    $(document).on('click','#confirmDelSched', function () {
        
        var delTeacherId = $('#hiddenDelTeacherId').val();
        var delSchoolYear = $('#hiddenDelSchoolYear').val();

        $.ajax({
            type: "post",
            url: "sched/delete_sched.php",
            data: {
                'delTeacherId':delTeacherId,
                'delSchoolYear':delSchoolYear
            },
            success: function (response) {
                $('#deleteSchedModal').modal('hide');
                swal({
                    title: "Success!",
                    text: response,
                    icon: "success",
                    button: "ok",
                });
            },
            error: function (xhr, status, error) {
                alert("Ajax request. Status: " + status + ", Error: " + error);
                console.log("Ajax request. Status: " + status + ", Error: " + error);
            }
        });
    });

    // onChange Section to display schedule per section
    $(document).on('change','#selectSection', function () {
        var sectionSched = $(this).val();
        var currentSy = $('#schoolYearVal').val();

        if(sectionSched != '') {
            // Fetch Schedule of section function
            $('#sectionSchedPreview').removeClass('d-none');
            $('#sectionNameCaption').text(sectionSched);
            fetchSectionSchedule(sectionSched,currentSy);
        }else{
            // Hide section schedule table
            $('#sectionSchedPreview').addClass('d-none');
            $('#sectionNameCaption').text('');
            console.log('Hide section schedule table');
        }
    });
});