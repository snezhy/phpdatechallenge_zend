/**
 * Created by Snezhana on 16/04/16.
 */
$(function() {
   "use strict";

    $('.date').datepicker({
        format: "yyyy/mm/dd"
    });

    $("#btnCalculate").click(function() {
        calculateDifference();
    });

    function calculateDifference() {

        var dateOne = $("#dateOne").val();
        var dateTwo = $("#dateTwo").val();

        $.ajax({
            url: 'index/get-dates-diff-json',
            type: "GET",
            data: {
                dateOne: dateOne,
                dateTwo: dateTwo
            },

            success: function (data, textStatus, jqXHR) {

                $("#result_div").show();
               if (typeof data == "object") {

                   $("#diff_div").show();
                   $("#error_div").hide();
                   $("#startDate").html(dateOne);
                   $("#endDate").html(dateTwo);
                   $("#endDate").html(dateTwo);
                   $("#years").html(data.years);
                   $("#months").html(data.months);
                   $("#days").html(data.days);

                   if (data.invert == true) {
                       $("#total_days").html(data.total_days);
                   } else {
                       $("#total_days").html(data.total_days);
                   }

               } else {
                   $("#diff_div").hide();
                   $("#error_div").html(data);
                   $("#error_div").show();
               }
            },
            error: function (jqXHR, textStatus, errorThrown) {


            }
        });
    }

});