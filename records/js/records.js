$(document).ready(function () {

    // $('#filterTable').DataTable({
    //     responsive: true, // Enable responsive design
    //     scrollX: true,   // Enable horizontal scrolling on small screens
    // });
    var selectedSchoolYear = $('#schoolYear').val();
    var selectedGradeLevel = $('#gradeLevel').val();

    var selectedSection = $('#selectSection').val();
    var selectedGender = $('input[type="radio"][name="gender"]:checked').val();
    var selectedStudentType = $('input[type="radio"][name="studentType"]:checked').val();
    
    function fetchSection(schoolyear,gradeLevel) {
        $.ajax({
            type: "post",
            url: "records/fetchSections.php",
            data: {
                'schoolyear':schoolyear,
                'gradeLevel':gradeLevel
            },
            success: function (response) {
                $('#selectSection').empty();
                $('#selectSection').append(response);
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed : " + status + ", " + error);
                console.log("AJAX request failed : " + status + ", " + error);
            }
        });
    }

    // function fetchData(schoolyear,gradeLevel,section,gender,studentType) {
    //     $.ajax({
    //         type: "post",
    //         url: "records/fetchData.php",
    //         data: {
    //             'schoolyear':schoolyear,
    //             'gradeLevel':gradeLevel,
    //             'section':section,
    //             'gender':gender,
    //             'studentType':studentType,
    //         },
    //         success: function (response) {
    //             $('#filterTable').DataTable().destroy();
    //             $('#tableOutput').html(response);
    //             $('#filterTable').DataTable({
    //                 responsive: true, // Enable responsive design
    //                 scrollX: true,   // Enable horizontal scrolling on small screens
    //             });
    //         },
    //         error: function (xhr, status, error) {
    //             alert("AJAX request failed : " + status + ", " + error);
    //             console.log("AJAX request failed : " + status + ", " + error);
    //         }
    //     });
    // }

    function fetchData(schoolyear, gradeLevel, section, gender, studentType) {
        $.ajax({
            type: "post",
            url: "records/fetchData.php",
            data: {
                'schoolyear': schoolyear,
                'gradeLevel': gradeLevel,
                'section': section,
                'gender': gender,
                'studentType': studentType,
            },
            success: function (response) {
                if ($.fn.DataTable.isDataTable('#filterTable')) {
                    $('#filterTable').DataTable().clear().destroy();
                }
    
                // Update the table content with the new data
                $('#tableOutput').html(response);
    
                // Reinitialize DataTable with the Buttons extension
                $('#filterTable').DataTable({
                    responsive: true,
                    scrollX: true,
                    "pageLength": 10,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                            },
                            text: 'Export as PDF',
                            className: 'btn btn-outline-danger btn-sm fw-semibold border border-2 border-danger mb-1',
                            titleAttr: 'Export the table to PDF',
                            // title: 'Grade '+gradeLevel+' '+section,
                            customize: function (doc) {
                                doc.styles.title = {
                                    fontSize: '20',
                                    bold: true,
                                };

                                // Set landscape orientation and larger paper size (A3)
                                // doc.pageOrientation = 'landscape';
                                // doc.pageMargins = [10, 10, 10, 10];
                                // doc.pageBreakBefore = function(currentNode, followingNodesOnPage, nodesOnNextPage, previousNodesOnPage) {
                                // return currentNode.id === 'footer';
                                // };
                            }
                        },
                        {
                            extend: 'excelHtml5', // Add Excel export
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                            },
                            text: 'Export as Excel', // Customize Excel button text
                            className: 'btn btn-outline-success btn-sm fw-semibold border border-2 border-success mb-1',
                            titleAttr: 'Export the table to Excel',
                            title: 'student_records',
                        }
                    ]
                });
                
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed : " + status + ", " + error);
                console.log("AJAX request failed : " + status + ", " + error);
            }
        });
    }
    fetchSection(selectedSchoolYear,selectedGradeLevel);

    fetchData(selectedSchoolYear,selectedGradeLevel);



    // onChange gradeLevel
    $(document).on('change','#gradeLevel', function () {
        var gradeLevelSectionVal = $(this).val();
        var schoolYearSectionVal = $('#schoolYear').val();

        fetchSection(schoolYearSectionVal,gradeLevelSectionVal);

        if(gradeLevelSectionVal == '10') {
            $('#Completer').prop('disabled',false);
            $('#completer_radioBtn').removeClass('d-none');
        }else {
            $('#Completer').prop('checked', false);
            $('#Completer').prop('disabled',true);
            $('#completer_radioBtn').addClass('d-none');
        }
    });

    // onChange School year
    $(document).on('change','#schoolYear', function () {
        var sy = $(this).val();
        var gradelvl = $('#gradeLevel').val();

        fetchSection(sy,gradelvl);

    });


    $(document).on('click','#filterBtn', function (e) {
        e.preventDefault();
        var schoolYearVal = $('#schoolYear').val();
        var gradeLevelVal = $('#gradeLevel').val();
        var sectionVal = $('#selectSection').val()
        var gender = $("input[name='gender']:checked").val();
        var studentType = $("input[name='studentType']:checked").val();

        fetchData(schoolYearVal,gradeLevelVal,sectionVal,gender,studentType);
    });



    // Reset The form filter
    $('#resetFormBtn').click(function (e) { 
        e.preventDefault();
        $('#filterForm')[0].reset();
        $('#Completers').prop('disabled',true);
    });

    // // onChange School Year
    // $(document).on('change','#schoolYear', function () {
    //     var sy_gradeLevelSectionVal = $('#gradeLevel').val();
    //     var sy_schoolYearSectionVal = $(this).val();

    //     fetchSection(sy_schoolYearSectionVal,sy_gradeLevelSectionVal);
    //     // fetchData(sy_schoolYearSectionVal,sy_gradeLevelSectionVal);
    // });



    // // Dynamic Filter
    // $(document).on('change','.filter_selector', function () {
    //     var schoolYearVal = $('#schoolYear').val();
    //     var gradeLevelVal = $('#gradeLevel').val();
    //     var sectionVal = $('#selectSection').val();
    //     fetchData(schoolYearVal,gradeLevelVal,sectionVal);
        
    // });
});