$(document).ready(function() {

    $.ajax({
        data: {


        },
        url: getdashboard,
        type: "POST",
        dataType: 'json',
        // async: false,
        success: function(data) {

            $('#totalploat').text(data[0].saleplots);
            $('#totalclient').text("Total Customer  " + data[0].totalcustomer);
            $('#customerpay').text("₹" + data[0].customerpayment);
            $('#agenttotal').text("Total Agent  " + data[0].totalagent);
            $('#agentpr').text("₹" + data[0].perinfo);


        }
    });


    $.ajax({
        data: {


        },
        url: getagentinfo,
        type: "POST",
        dataType: 'json',
        // async: false,
        success: function(data) {
            var html = '';

            html += '<ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">';
            for (i = 0; i < data.length; i++) {
                if (i <= 4) {
                    html += '<li class="list-group-item">' +
                        '<div class="widget-content p-0">' +
                        '<div class="widget-content-wrapper">' +
                        '<div class="widget-content-left mr-3">' +
                        '<img width="42" class="rounded-circle" src="' + imgurl + '/profile/' + data[i].profilepicture + '" alt="">' +
                        '</div>' +
                        '<div class="widget-content-left">' +
                        '<div class="widget-heading">' + data[i].first_name + "" + data[i].last_name + '</div>' +
                        '<div class="widget-subheading">' + data[i].email + ' </div>' +
                        '</div>' +
                        '<div class="widget-content-right">' +
                        '<div class="font-size-xlg text-muted">' +
                        '<small class="opacity-5 pr-1">₹</small>' +
                        '<span>' + data[i].agensum + '</span>' +
                        '<small class="text-danger pl-2">' +
                        '<i class="fa fa-angle-down"></i>' +
                        '</small>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</li>';
                }
            }
            html += '</ul>';
            $('#divagentinfo').html(html);
        }
    });

    // var ctx = document.getElementById("myChart");
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     data: {
    //         labels: ["2015-01", "2015-02", "2015-03", "2015-04", "2015-05", "2015-06", "2015-07", "2015-08", "2015-09", "2015-10", "2015-11", "2015-12"],
    //         datasets: [{
    //             label: 'Plots Sales',
    //             data: [12, 19, 3, 5, 2, 3, 50, 3, 5, 6, 20, 10],
    //             backgroundColor: [
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)',
    //                 'rgba(255, 99, 132, 0.2)',
    //                 'rgba(54, 162, 235, 0.2)',
    //                 'rgba(255, 206, 86, 0.2)',
    //                 'rgba(75, 192, 192, 0.2)',
    //                 'rgba(153, 102, 255, 0.2)',
    //                 'rgba(255, 159, 64, 0.2)'
    //             ],
    //             borderColor: [
    //                 'rgba(255,99,132,1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)',
    //                 'rgba(255,99,132,1)',
    //                 'rgba(54, 162, 235, 1)',
    //                 'rgba(255, 206, 86, 1)',
    //                 'rgba(75, 192, 192, 1)',
    //                 'rgba(153, 102, 255, 1)',
    //                 'rgba(255, 159, 64, 1)'
    //             ],
    //             borderWidth: 1
    //         }]
    //     },
    //     options: {
    //         responsive: false,
    //         scales: {
    //             xAxes: [{
    //                 ticks: {
    //                     maxRotation: 90,
    //                     minRotation: 80
    //                 }
    //             }],
    //             yAxes: [{
    //                 ticks: {
    //                     beginAtZero: true

    //                 }
    //             }]
    //         }
    //     }
    // });

    $.ajax({
        data: {


        },
        url: getsalesdata,
        type: "POST",
        dataType: 'json',
        // async: false,
        success: function(data) {

            var ctx = document.getElementById("myChart").getContext("2d");
            var result = [];
            var fresult = [];
            var sresult = [];
            for (i = 0; i < data.length; i++) {
                for (j = 0; j < data[i].week_array.length; j++) {
                    var result1 = data[i].week_array[j].ssdate;
                    result.push(result1);
                }
                for (j = 0; j < data[i].firstar.length; j++) {
                    var result2 = data[i].firstar[j].sum1;

                    fresult.push(result2);
                }
                for (k = 0; k < data[i].secondarr.length; k++) {

                    var result3 = data[i].secondarr[k].sum2;

                    sresult.push(result3);
                }
            }

            var data = {
                labels: result,
                datasets: [{
                        label: "Ploat Amount",
                        backgroundColor: "blue",
                        data: fresult
                    },
                    {
                        label: "Customer Pay",
                        backgroundColor: "red",
                        data: sresult
                    },

                ]
            };

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }]
                    }
                }
            });

        }
    });


});