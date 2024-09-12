$(document).ready(function () {

    // FetchSched Function
    function fetchSchedules() {
        var fetchSyVal = $('#hiddenSchoolYear').val();
        var fetchTchIdVal = $('#hiddenTeacherId').val();
        var fetchDayVal = $('#filterDay').val();

        $.ajax({
            type: "post",
            url: "sched/filterSched.php",
            data: {
                'hiddenSchoolYear':fetchSyVal,
                'hiddenTeacherId':fetchTchIdVal,
                'filterDayVal':fetchDayVal,
            },
            success: function (response) {
                $('#schedTbody').empty();
                $('#schedTbody').html(response);
            },
            error: function (xhr, status, error) {
                alert("Ajax request. Status: " + status + ", Error: " + error);
                console.log("Ajax request. Status: " + status + ", Error: " + error);
            }
        });
    }

    // function convertTo24Hour(time) {
    //     let [hours, minutes] = time.split(":");
    //     let AMorPM = minutes.substr(3, 2);
    //     minutes = minutes.substring(0, 2);
    //     hours = parseInt(hours, 10);

    //     if (AMorPM === "PM" && hours < 12) {
    //     hours += 12;
    //     }

    //     if (AMorPM === "AM" && hours === 12) {
    //     hours -= 12;
    //     }

    //     return `${String(hours).padStart(2, "0")}:${minutes}:${"00"}`;
    // }

    function addNewSched(teacherId,schoolYear,day,subject,section,startTime,endTime) {
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
            dataType: "json",
            success: function (response) {
                if(response.status == 'success') {
                    alertify.dismissAll(""); // or alertify.closeAll();
                    alertify.set("notifier", "position", "top-right");
                    alertify.success(response.message);
                    $('#newSchedError').text('');
                    // Fetch schedule (gawing based sa kung anong day ininsert)
                    fetchSchedules();
                    fetchSectionSchedule(section,schoolYear);
                }else if(response.status == 'error') {
                    $('#newSchedError').text(response.message);
                }else {
                    alert(response);
                    console.log(response);
                    console.log(response.message);
                }
            },
            error: function (xhr, status, error) {
                alert("Ajax request. Status: " + status + ", Error: " + error);
                console.log("Ajax request. Status: " + status + ", Error: " + error);
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
    // Filter Data dropdown
    $(document).on('change','#filterDay', function () {
        var hiddenSchoolYear = $('#hiddenSchoolYear').val();
        var hiddenTeacherId = $('#hiddenTeacherId').val();

        var filterDayVal = $(this).val();
        // alert(hiddenSchoolYear+'-'+hiddenTeacherId+'-'+'-'+filterDayVal);

        $.ajax({
            type: "post",
            url: "sched/filterSched.php",
            data: {
                'hiddenSchoolYear':hiddenSchoolYear,
                'hiddenTeacherId':hiddenTeacherId,
                'filterDayVal':filterDayVal,
            },
            success: function (response) {
                $('#schedTbody').empty();
                $('#schedTbody').html(response);
            },
            error: function (xhr, status, error) {
                alert("Ajax request. Status: " + status + ", Error: " + error);
                console.log("Ajax request. Status: " + status + ", Error: " + error);
            }
        });
    });

    // Delete Schedule Modal
    $(document).on('click','.delSched_btn', function () {
        var deleteIdVal = $(this).closest('tr').find('.edit_id').text();
        $('#hiddenDel_id').val(deleteIdVal);
        $('#delSchedModal').modal('show');
    });

    // Confirm Delete Button
    $(document).on('click','#confirmDelSchedData', function () {
        
        var deleteId = $('#hiddenDel_id').val();

        $.ajax({
            type: "post",
            url: "sched/delSchedule.php",
            data: {
                'deleteId':deleteId
            },
            success: function (response) {
                alertify.dismissAll(""); // or alertify.closeAll();
                alertify.set("notifier", "position", "top-right");
                alertify.success(response);
                // Fetch Sched
                fetchSchedules();
                $('#delSchedModal').modal('hide');
            },
            error: function (xhr, status, error) {
                alert("Ajax request. Status: " + status + ", Error: " + error);
                console.log("Ajax request. Status: " + status + ", Error: " + error);
            }
        });

    });

    // Add New Schedule Modal
    $(document).on('click','#addNewSchedBtn', function () {
        $('#addNewScheduleModal').modal('show');
    });

    // Save New Sched Button
    $(document).on('click','#addNewScheduleButton', function (e) {
        e.preventDefault();
        // teacher id at school year pa
        var newTeacherId = $('#hiddenTeacherId').val();
        var newSchoolyear = $('#hiddenSchoolYear').val();
        var newDay = $('#new_days').val();
        var newSubject = $('#new_subject').val();
        var newSection = $('#new_selectSection').val();
        var newStartTime = $('#new_startTime').val();
        var newEndTime = $('#new_endTime').val();

        if(newStartTime >= newEndTime) {
            $('#newSchedError').text('Invalid time format');
            return
        }else {
            $('#newSchedError').text('');
        }

        if(newDay.length > 0 && newSubject.length > 0 && newSection.length > 0 && newStartTime.length > 0 && newEndTime.length > 0) {
            $('#newSchedError').text('');
            addNewSched(newTeacherId,newSchoolyear,newDay,newSubject,newSection,newStartTime,newEndTime);
        }else {
            $('#newSchedError').text('Incomplete input fields');
        }
    });

    // onChange Section to display schedule per section
    $(document).on('change','#new_selectSection', function () {
        var sectionSched = $(this).val();
        var currentSy = $('#hiddenSchoolYear').val();

        if(sectionSched != '') {
            // Fetch Schedule of section function
            $('#sectionSchedPreview').removeClass('d-none');
            $('#sectionNameCaption').text(sectionSched);
            fetchSectionSchedule(sectionSched,currentSy);
        }else{
            // Hide section schedule table
            $('#sectionSchedPreview').addClass('d-none');
            $('#sectionNameCaption').text('');
            // console.log('Hide section schedule table');
        }
    });

    $(document).on('click','#closeAddSchedModal',function (e) {
        e.preventDefault();
        $('#new_subject').val('');
        $('#new_days').val('');
        $('#new_startTime').val('');
        $('#new_endTime').val('');
        $('#new_selectSection').val('');
        $('#newSchedError').text('');
        $('#previewTable').addClass('d-none');
        $('#sectionSchedPreview').addClass('d-none');
    })

    // // Edit Modal (NAHINTO)
    // $(document).on('click','.editSched_btn', function () {
    //     var editIdVal = $(this).closest('tr').find('.edit_id').text(); //Schedule Id
    //     var editTeacherIdVal = $(this).closest('tr').find('.edit_tchid').text(); //teacher Id
    //     var editSchoolYearVal = $(this).closest('tr').find('.edit_sy').text(); // Current School Year
    //     var editSectionVal = $(this).closest('tr').find('.edit_section').text(); // Section
    //     var editDayVal = $(this).closest('tr').find('.edit_Day').text(); // day
    //     var editSubjectVal = $(this).closest('tr').find('.edit_Subject').text(); // subject
    //     var editStartTimeVal = $(this).closest('tr').find('.edit_StartTime').text(); // start time
    //     var editEndTimeVal = $(this).closest('tr').find('.edit_EndTime').text(); // end time
    //     // Converting Time to 24 hour format
    //     var convertedEditStartTimeVal = convertTo24Hour(editStartTimeVal);
    //     var convertedEditEndTimeVal = convertTo24Hour(editEndTimeVal);

    //     // Display Data
    //     $('#schedEdit_Id').val(editIdVal);
    //     $('#edit_TeacherId').val(editTeacherIdVal);
    //     $('#edit_schoolYearVal').val(editSchoolYearVal);
    //     $('#selectSection').val(editSectionVal);
    //     $('#days').val(editDayVal);
    //     $('#subject').val(editSubjectVal);
    //     $('#startTime').val(convertedEditStartTimeVal);
    //     $('#endTime').val(convertedEditEndTimeVal);

    //     $('#editScheduleModal').modal('show');
    // });

    // Save Changes Button
    // $(document).on('click','#saveEditedSchedBtn', function (e) {
    //     e.preventDefault();
    //     // Hidden Data
    //     var schoolYear_val = $('#edit_schoolYearVal').val();
    //     var teacherId_val = $('#edit_TeacherId').val();
    //     var editId_val = $('#schedEdit_Id').val();
    //     // Edited Data
    //     var day_val = $('#days').val();
    //     var subj_val = $('#subject').val();
    //     var section_val = $('#selectSection').val();
    //     var startTime_val = $('#startTime').val();
    //     var endTime_Val = $('#endTime').val();

    //     $.ajax({
    //         type: "post",
    //         url: "sched/saveEditSched.php",
    //         data: {
    //             'editId_val':editId_val,
    //             'schoolYear_val':schoolYear_val,
    //             'teacherId_val':teacherId_val,
    //             'day_val':day_val,
    //             'subj_val':subj_val,
    //             'section_val':section_val,
    //             'startTime_val':startTime_val,
    //             'endTime_Val':endTime_Val,
    //         },
    //         dataType: "json",
    //         success: function (response) {
    //             if(response.status == 'success') {
    //                 alertify.dismissAll(""); // or alertify.closeAll();
    //                 alertify.set("notifier", "position", "top-right");
    //                 alertify.success(response.message);
    //             }else if(response.status == 'error') {
    //                 alert(response.message);
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             alert("Ajax request. Status: " + status + ", Error: " + error);
    //             console.log("Ajax request. Status: " + status + ", Error: " + error);
    //         }
    //     });
    // });
});