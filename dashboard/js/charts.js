$(document).ready(function () {

    // SECTION CHART
    const sectionChart = document.getElementById('mySectionChart');
    const mySectionChart = new Chart(sectionChart, {
        type: 'polarArea',
        data: {
            labels: [], // Initialize with empty data
            datasets: [{
                label: '% of Students',
                data: [],
                backgroundColor: [
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(153, 102, 255)',
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 3,
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // GENDER CHART
    const genderChart = new Chart(document.getElementById('genderChart'), {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Male',
                data: [], // MALE DATA, datasets[0]
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgb(54, 162, 235)',
                ],
                borderWidth: 3
            },
            {
                label: 'Female',
                data: [], // FEMALE DATA, datasets[0]
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)'
                ],
                borderWidth: 3
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // ======================================================================================================
    
    // Section Reference
    var schoolyear = $('#schoolYear').val();
    var gradeLevel = $('#grade_Level').val();
    // Gender Reference
    var genderGradeLevel = $('#gender_gradelevel').val();
    var genderSchoolYear = $('#gender_schoolyear').val();

    fetchSectionChart (schoolyear,gradeLevel);

    fetchGenderChart(genderSchoolYear,genderGradeLevel)
    
    function fetchSectionChart(schoolyear,gradeLevel) {

        $.ajax({
            type: "post",
            url: "dashboard/sectionChart.php",
            data: {
                'schoolyear':schoolyear,
                'gradeLevel':gradeLevel
            },
            dataType: "json",
            success: function (response) {
                // Clear the Footer
                $('#sectionText').empty();
                
                mySectionChart.data.labels = response.sectionName;
                mySectionChart.data.datasets[0].data = response.percentages;
                mySectionChart.update(); // Update the chart
                // Chart Footer
                var chartFooterText = '';

                for (var i = 0; i < response.sectionName.length; i++) {
                    // Create a div for each section and append it to the #sectionText element
                    var chartFooterText = response.sectionName[i] + ' - ' + response.studentsCount[i];
                    $('#sectionText').append('<div class="col fw-semibold">' + chartFooterText + '</div>');
                }
                
            },
            error: function (xhr, status, error) {
                alert("AJAX request failed : " + xhr + status + ", " + error);
                console.log("AJAX request failed : " + xhr + status + ", " + error);
            }
        });
    }

    function fetchGenderChart(schoolyear,gradeLevel) {

        $.ajax({
            type: "post",
            url: "dashboard/genderChart.php",
            data: {
                'schoolyear':schoolyear,
                'gradeLevel':gradeLevel,
            },
            dataType: "json",
            success: function (response) {
                // Clear footer
                $('#genderText').empty();

                genderChart.data.labels = response.sectionName;
                genderChart.data.datasets[0].data = response.maleCount;
                genderChart.data.datasets[1].data = response.femaleCount;
                genderChart.update(); // Update the chart with new data
                
                for (var i = 0; i < response.sectionName.length; i++) {
                    // Create a div for each section and append it to the #sectionText element
                    var chartFooterText = gradeLevel+' '+response.sectionName[i] + ' - ' + response.maleCount[i]+' Male ,'+ response.femaleCount[i]+' Female ';
                    $('#genderText').append('<div class="col fw-semibold">' + chartFooterText + '</div>');
                }

            },
            error: function (xhr, status, error) {
                alert("request failed : " + xhr + status + ", " + error);
                console.log("request failed : " + xhr + status + ", " + error);
            }
        });
    }

    // Section onChange
    $(document).on('change','.chart_Selector', function () {
        var schoolyearVal = $('#schoolYear').val();
        var gradeLevelVal = $('#grade_Level').val();

        fetchSectionChart (schoolyearVal,gradeLevelVal);

    });

    // Gender onChange
    $(document).on('change','.genderChartSelector', function () {
        var genderSchoolyear_val = $('#gender_schoolyear').val();
        var genderGradeLevel_val = $('#gender_gradelevel').val();

        fetchGenderChart(genderSchoolyear_val,genderGradeLevel_val);
    });
});