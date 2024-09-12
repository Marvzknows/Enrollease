$(document).ready(function(){

    // Fetching Current Enrollment Status
    fetchEnrollmentStatus();

    function fetchEnrollmentStatus() {
        $.ajax({
            url: 'dashboard/enrollmentAPI.php',
            type: 'get',
            success: function (result) {
                if(result.status == 'success')
                {
                    $('#enrollmentStatus').val(result.enollstatus);
                    $('#activeSchoolYear').val(result.schoolyear);
                }

                if(result.status == 'error'){
                    alert(result.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('AJAX request failed: ' + textStatus + ', ' + errorThrown);
            }
        });
    }
    
    
    // Enrollment Update status
    $('#submitEnrollmentStaus').click(function () { 
        // alert('clicked')
        var activeSy = $('#activeSchoolYear').val();
        var status = $('#enrollmentStatus').val();

        $.ajax({
            type: "post",
            url: "dashboard/enrollStatus.php",
            data: {
                'activeSy':activeSy,
                'status':status,
            },
            dataType: 'json',
            success: function (response) {
                // console.log(response.message);
                if(response.status == 'success'){
                    swal({
                    title: response.message,
                    icon: "success",
                    button: "ok",
                    });
                    fetchEnrollmentStatus();
                }

                if(response.status == 'error'){
                    alert(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('AJAX request failed: ' + textStatus + ', ' + errorThrown);
            }
        });
    });

    // $('#submitEnrollmentStaus').on('click', function () {
        
    //     var enrollmentStatus = $('#enrollmentStatus').val();
    //     $.ajax({
    //         type: "post",
    //         url: "dashboard/enrollStatus.php",
    //         data: {
    //             'enrollmentStatus':enrollmentStatus,
    //         },
    //         dataType: 'json', //JSON FORMAT ANG RESPONSE DAPAT
    //         success: function (response) {
    //             if(response.status === 'success'){
    //                 swal({
    //                     title: response.message,
    //                     icon: "success",
    //                     button: "ok",
    //                 });
    //                 fetchEnrollmentStatus();

    //             }

    //             if(response.status === 'failed'){
    //                 swal({
    //                     title: response.message,
    //                     icon: "error",
    //                     button: "ok",
    //                 });
    //                 fetchEnrollmentStatus();
    //             }
    //         }
    //     });
    // });

    
});