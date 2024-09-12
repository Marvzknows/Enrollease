$(document).ready(function () {


    var region;

    $.getJSON("../phaddress/region.json", function (result) {
        $.each(result, function (index, element) { 
            var regionCode = element.region_code;
            var regionName = element.region_name;

            region += "<option value=" + regionCode + ">" + regionName + "</option>";
        });
        $('#region').append(region);
    });


    $(document).on('change','#region', function () {
        $('#province').empty(); // Clear the province options
        $('#city').empty(); // Clear the city options
        $('#barangay').empty(); // Clear the barangay options

        if ($(this).val() === '') {
            $('#province').prop('disabled', true);
            $('#province').empty(); // Clear the province options
            $('#province').append("<option value='' selected>- select province -</option>");
            $('#city').append("<option value='' selected>- select city -</option>");
            $('#barangay').append("<option value='' selected>- select barangay -</option>");

        } else {
            $('#province').prop('disabled', false);
            $('#province').empty(); // Clear the province options
            $('#province').append("<option value='' selected>- select province -</option>");
            $('#city').append("<option value='' selected>- select province -</option>");
            $('#barangay').append("<option value='' selected>- select province -</option>");
            var regionVal = $(this).val();
            $.getJSON("../phaddress/province.json", function (result) {
                var provinceOptions = '';
                $.each(result, function (index, element) {
                    if (element.region_code === regionVal) {
                        var provinceCode = element.province_code;
                        var provinceName = element.province_name;
                        provinceOptions += "<option value='" + provinceCode + "'>" + provinceName + "</option>";
                    }
                });
                // Populate the province select element with the new options
                $('#province').append(provinceOptions);
            });
        }
    });


    $('#province').change(function () {
        if ($(this).val() === '') {
            $('#city').prop('disabled', true);
            $('#city').empty(); // Clear the province options
            // $('#province').append("<option value='' selected>- select province -</option>");
        } else {
            $('#city').prop('disabled', false);
            $('#city').empty(); // Clear the city options
            $('#barangay').empty(); // Clear the barangay options
            $('#city').append("<option value='' selected>- select city -</option>");
            $('#barangay').append("<option value='' selected>- select barangay -</option>");
            var provinceVal = $(this).val();
            $.getJSON("../phaddress/city.json", function (result) {
                var cityOptions = '';
                $.each(result, function (index, element) {
                    if (element.province_code === provinceVal) {
                        var cityCode = element.city_code;
                        var cityName = element.city_name;
                        cityOptions += "<option value='" + cityCode + "'>" + cityName + "</option>";
                    }
                });
                // Populate the province select element with the new options
                $('#city').append(cityOptions);
            });
        }
    });

    $('#city').change(function () {
        if ($(this).val() === '') {
            $('#barangay').prop('disabled', true);
            $('#barangay').empty(); // Clear the province options
            $('#province').append("<option value='' selected>- select province -</option>");
        } else {
            $('#barangay').empty(); // Clear the barangay options
            // $('#barangay').append("<option value='' selected>- select barangay -</option>");
            $('#barangay').prop('disabled', false);
            var barangayVal = $(this).val();
            $.getJSON("../phaddress/barangay.json", function (result) {
                var barangayOptions = '';
                $.each(result, function (index, element) {
                    if (element.city_code === barangayVal) {
                        var barangayCode = element.brgy_code;
                        var barangayName = element.brgy_name;
                        barangayOptions += "<option value='" + barangayCode + "'>" + barangayName + "</option>";
                    }
                });
                // Populate the province select element with the new options
                $('#barangay').append(barangayOptions);
            });
        }
    });

});