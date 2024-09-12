$(document).ready(function () {
    // fetchLogs();

    todayLogs();

    // function fetchLogs() {
    //     $.ajax({
    //         type: "get",
    //         url: "../activityLog/fetchLogs.php",
    //         success: function (response) {
    //             $('#logsTable').DataTable().destroy();
    //             $('#tableBodyOutput').html(response);
    //             $('#logsTable').DataTable({
    //                 "pageLength": 5,
    //                 "searching": false, // Disable the search bar
    //                 "order": [[0, "desc"]] // Sort by the first column (id) in descending order
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             alert("AJAX Error: " + status + " - " + error);
    //             console.error("AJAX Error: " + status + " - " + error);
    //         }
    //     });
    // }

    function todayLogs() {
        $.ajax({
            type: "get",
            url: "../activityLog/todayLogs.php",
            success: function (response) {
                $('#logsTable').DataTable().destroy();
                $('#tableBodyOutput').html(response);
                $('#logsTable').DataTable({
                    "pageLength": 5,
                    "searching": false, // Disable the search bar
                    "order": [[0, "desc"]] // Sort by the first column (id) in descending order
                });
            },
            error: function (xhr, status, error) {
                alert("AJAX Error: " + status + " - " + error);
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    function lastWeekLogs() {
        $.ajax({
            type: "get",
            url: "../activityLog/lastWeekLogs.php",
            success: function (response) {
                $('#logsTable').DataTable().destroy();
                $('#tableBodyOutput').html(response);
                $('#logsTable').DataTable({
                    "pageLength": 5,
                    "searching": false, // Disable the search bar
                    "order": [[0, "desc"]] // Sort by the first column (id) in descending order
                });
            },
            error: function (xhr, status, error) {
                alert("AJAX Error: " + status + " - " + error);
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    function betweenDate(startDate, endDate) {
        $.ajax({
            type: "post",
            url: "../activityLog/betweenDate.php",
            data: {
                'startDate':startDate,
                'endDate':endDate,
            },
            success: function (response) {
                $('#logsTable').DataTable().destroy();
                $('#tableBodyOutput').html(response);
                $('#logsTable').DataTable({
                    "pageLength": 5,
                    "searching": false, // Disable the search bar
                    "order": [[0, "desc"]] // Sort by the first column (id) in descending order
                });
            },
            error: function (xhr, status, error) {
                alert("AJAX Error: " + status + " - " + error);
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }

    $(document).on('click','#todayLogsBtn', function () {
        $('#lastWeekLogsBtn').removeClass('active');
        $(this).addClass('active');
        $('.dateFilter').val('');
        todayLogs();
    });

    $(document).on('click','#lastWeekLogsBtn', function () {
        $('#todayLogsBtn').removeClass('active');
        $(this).addClass('active');
        $('.dateFilter').val('');
        lastWeekLogs();
    });

    $(document).on('change','.dateFilter', function () {
        var startDate = $('#startDate').val();
        var endDate = $('#endDate').val();

        if(startDate == '' || endDate == '') {
            todayLogs();
        }else {
            $('#todayLogsBtn').removeClass('active');
            $('#lastWeekLogsBtn').removeClass('active');
            betweenDate(startDate,endDate);
            // alert('both have val');
        }
    });

});
