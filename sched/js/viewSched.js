$(document).ready(function () {
    
    function fetchViewModal(schoolYear,teacherId,teacherName) {
        $.ajax({
            type: "post",
            url: "sched/viewModal.php",
            data: {
                'schoolYear':schoolYear,
                'teacherId':teacherId,
                'teacherName':teacherName,
            },
            success: function (response) {
                // alert(response);
                $('#viewSchedOutput').html(response);
            },
            error: function (xhr, status, error) {
                alert("Ajax request failed for fetchTeachers Function. Status: " + status + ", Error: " + error);
            }
        });
    }

    $(document).on('click','.view_sched_btn',function () {
        var teacher_id = $(this).closest('tr').find('.teacher_id').text();
        var teacher_fullName = $(this).closest('tr').find('.l_name').text() + ' ' + $(this).closest('tr').find('.f_name').text();
        var school_year = $('#sySession').text();
        fetchViewModal(school_year,teacher_id,teacher_fullName)
        $('#viewSchedModal').modal('show');
    })
});