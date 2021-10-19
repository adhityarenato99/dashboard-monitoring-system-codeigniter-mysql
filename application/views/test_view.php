<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Dashboard for Calls Data</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.min.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="container">
        <h1 style="font-size:20pt"><strong>Simple Dashboard for Calls Data</strong></h1>
        <br>
        <div class="panel panel-default">

            <h3>Analyzing Data for every coach</h3>
            <!--
                        <form class="form-inline"> -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="exampleFormControlSelect1">Choose the Coach</label>
                        <select class="form-control" id="filter_coach" name="filter_coach">
                            <option value="1">coach1</option>
                            <option value="2">coach2</option>
                        </select>

                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:10px; margin-bottom:10px;" id="list-data">
                <!--
                <div class="col-sm-4">
                    <div class="card" style="border:1px solid grey; padding-top:10px;padding-bottom:10px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Data</h5>
                            <h2 class="card-text" class="total-data">100</h2>
                            <a href="#" class="btn btn-secondary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="border:1px solid grey; padding-top:10px;padding-bottom:10px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total User</h5>
                            <h2 class="card-text">100</h2>
                            <a href="#" class="btn btn-secondary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="border:1px solid grey; padding-top:10px;padding-bottom:10px;">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Duration</h5>
                            <h2 class="card-text">120</h2>
                            <a href="#" class="btn btn-secondary">Go somewhere</a>
                        </div>
                    </div>
                </div> -->
            </div>


            <div class="panel-heading">
                <h3 class="panel-title">Custom Filter : </h3>
            </div>
            <div class="panel-body">
                <form id="form-filter" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="exampleFormControlSelect1">Choose the Coach</label>
                        <select class="form-control" id="coachId" name="coachId">
                            <option value="coach1">coach 1</option>
                            <option value="coach2">coach 2</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleFormControlSelect1">Choose the Client</label>
                        <select class="form-control" id="clientId" name="clientId">
                            <option value="user1">client 1</option>
                            <option value="user2">client 2</option>
                            <option value="user3">client 3</option>
                            <option value="user4">client 4</option>
                            <option value="user5">client 5</option>
                        </select>
                    </div>
                    <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                    <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>callid</th>
                    <th>coachid</th>
                    <th>clientid</th>
                    <th>ets</th>
                    <th>ts</th>
                    <th>duration</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
                <tr>
                    <th>No</th>
                    <th>callid</th>
                    <th>coachid</th>
                    <th>clientid</th>
                    <th>ets</th>
                    <th>ts</th>

                    <th>duration (minutes)</th>
                </tr>
            </tfoot>
        </table>

        <!-- add chart -->
        <div class="section mt-1 mb-3">
            <h3>Call Graph by Time for each Coach</h3>
            <form id="form-submit" class="form-inline">

                <div class="form-group mb-2">
                    <label for="exampleFormControlSelect1">Choose the Coach</label>
                    <select class="form-control" id="coach_graph" name="coach_graph">
                        <option value="1">coach 1</option>
                        <option value="2">coach 2</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <label for="exampleFormControlSelect1">Filter by Time</label>
                    <select class="form-control" id="time_graph" name="time_graph">
                        <option value="1">Daily</option>
                        <option value="2">Weekly</option>
                        <option value="3">Monthly</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" id="btn-reset" class="btn btn-default" onclick="load_the_chart()">Reset</button>
            </form>
            <div class="card shadow-none bg-transparent" style="margin-top:10px;margin-bottom:15px;">
                <div class="card-body">
                    <div id="chart-calls"></div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?php echo base_url('assets/jquery/jquery-2.2.3.min.js')?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.min.js')?>"></script>

    <!-- highchart -->
    <script src="http://code.highcharts.com/stock/highstock.js"></script>
    <script src="http://code.highcharts.com/stock/modules/exporting.js"></script>

    <script type="text/javascript">
    var coach1 = 'coach1';
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Tests/ajax_list')?>",
                "type": "POST",
                "data": function(data) {
                    data.coachId = $('#coachId').val();
                    data.clientId = $('#clientId').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false, //set not orderable
            }, ],

        });

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(); //just reload table
        });


        load_data(0);

        load_Chart();

    });

    // add new function
    $('#filter_coach').change(function() {
        let filter_coach = $(this).val();
        //alert(filter_coach);
        $('#filter_coach').val(filter_coach);
        load_data(0);
    });

    function load_the_chart() {
        load_Chart();
    }

    function load_data(pagno) {

        let filter_coach = $('#filter_coach').val();

        $.ajax({
            url: '<?php echo site_url("Tests/get_data/")?>' + pagno,
            type: "POST",
            data: {
                filter_coach: filter_coach
            },
            dataType: 'json',
            success: function(response) {
                //alert('success');
                createTableLoad(response.all_data, response.total_client, response.total_hour);
            },
            error: function(data) {
                alert('Fail to send the data');
            }
        });
    }

    function createTableLoad(result, client, hour) {
        $('#list-data').html('');
        let html = '';
        total_calls = result;
        total_clients = client;
        total_hours = hour;

        html += '<div class="col-sm-4">';
        html += '<div class="card" style="border:1px solid grey; padding-top:10px;padding-bottom:10px;">';
        html += '<div class="card-body text-center">';
        html += '<h5 class="card-title">Total Calls</h5>';
        html += '<h2 class="card-text" class="total-data">' + total_calls + '</h2>';
        html += '<h5>times</h5>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-sm-4">';
        html += '<div class="card" style="border:1px solid grey; padding-top:10px;padding-bottom:10px;">';
        html += '<div class="card-body text-center">';
        html += '<h5 class="card-title">Total Clients</h5>';
        html += '<h2 class="card-text">' + total_clients + '</h2>';
        html += '<h5>client</h5>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-sm-4">';
        html += '<div class="card" style="border:1px solid grey; padding-top:10px;padding-bottom:10px;">';
        html += '<div class="card-body text-center">';
        html += '<h5 class="card-title">Total Duration</h5>';
        html += '<h2 class="card-text">' + parseInt(total_hours).toFixed(2) + '</h2>';
        html += '<h5>hours</h5>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        $('#list-data').html(html);
    }

    /*
    $('#coach_graph').change(function() {
        let coach_graph = $(this).val();
        $('#coach_graph').val(coach_graph);
        load_Chart(0);
    }); */ 

    $('#form-submit').submit(function(e) {
        e.preventDefault();

        //let coach_graph = $('#coach_graph').val();
        //let time_graph = $('#time_graph').val();

        $('#chart-calls').empty();

        let url;
        url = '<?php echo site_url("Tests/get_chart")?>';

        $.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {

                console.log(data);

                datas = JSON.parse(data);
                total_transaksi = datas.total_call;
                tgl_transaksi = datas.tgl_call;
                row = datas.total;

                var html = '';
                var count = 1;
                var i;
                console.log(data);

                for (index in row) {

                    $('#chart-calls').highcharts({

                        chart: {
                            backgroundColor: {
                                linearGradient: [0, 0, 500, 500],
                                stops: [
                                    [0, 'rgb(255, 255, 255)'],
                                    [1, 'rgb(200, 200, 255)']
                                ]
                            },
                            polar: 'true',
                            forecolor: "rgba(255,255,255,0.65)",
                            type: 'line',
                            zoom: {
                                enabled: !1
                            },
                            toolbar: {
                                show: !0
                            },
                            dropShadow: {
                                enabled: !0,
                                top: 3,
                                left: 14,
                                blur: 4,
                                opacity: .1
                            },
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            },
                            marginTop: 80
                        },
                        credits: {
                            enabled: false
                        },

                        title: {

                            text: 'Total Calls for all Clients'

                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                shade: "light",
                                gradientToColors: ["#fff"],
                                shadeIntensity: 1,
                                type: "vertical",
                                opacityFrom: .7,
                                opacityTo: .2,
                                stops: [0, 100, 100, 100]
                            }
                        },
                        markers: {
                            size: 5,
                            colors: ["#000"],
                            strokeColors: "#fff",
                            strokeWidth: 2,
                            hover: {
                                size: 7
                            }
                        },
                        grid: {
                            borderColor: 'rgba(255, 255, 255, 0.12)',
                            show: true,
                        },
                        tooltip: {
                            theme: "dark",
                            fixed: {
                                enabled: !1
                            },
                            x: {
                                show: !0
                            },
                            y: {
                                formatter: function(e) {
                                    return " " + e + " "
                                }
                            },
                            marker: {
                                show: !1
                            }
                        },
                        //colors: ["#fff"],
                        stroke: {
                            width: 5,
                            curve: "smooth"
                        },

                        xAxis: {
                            reversed: false,
                            categories: tgl_transaksi,
                            min: 1,
                        },
                        scrollbar: {
                            enabled: true
                        },
                        legend: {
                            enabled: true
                        },
                        plotOptions: {
                            column: {
                                grouping: true,
                                shadow: true,
                                borderWidth: 0,
                                pointPadding: 0.3,
                                pointWidth: 12
                            }
                        },

                        yAxis: {

                            title: {

                                text: 'Quantity of Calls'

                            }

                        },
                        series: [{
                            name: 'Total Calls',
                            data: total_transaksi
                        }],
                        scrollbar: {
                            enabled: true,
                            barBackgroundColor: 'gray',
                            barBorderRadius: 7,
                            barBorderWidth: 0,
                            buttonBackgroundColor: 'gray',
                            buttonBorderWidth: 0,
                            buttonArrowColor: 'yellow',
                            buttonBorderRadius: 7,
                            rifleColor: 'yellow',
                            trackBackgroundColor: 'white',
                            trackBorderWidth: 1,
                            trackBorderColor: 'silver',
                            trackBorderRadius: 7
                        },
                        navigation: {
                            buttonOptions: {
                                enabled: false
                            }
                        },

                    });

                };

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });

    });

    //function load_Chart(datas) {
    function load_Chart(){

        //$('#chart-sales-commerce').empty();
        //let coach_graph = $('#coach_graph').val();

        $.ajax({
            url: '<?php echo site_url("Tests/get_chart_initial"); ?>',
            type: 'POST',
            data: {
                coach_graph: coach1
            },
            success: function(data) {

                console.log(data);

                datas = JSON.parse(data);
                total_transaksi = datas.total_call;
                tgl_transaksi = datas.tgl_call;
                row = datas.total;

                var html = '';
                var count = 1;
                var i;
                console.log(data);

                for (index in row) {

                    $('#chart-calls').highcharts({

                        chart: {
                            backgroundColor: {
                                linearGradient: [0, 0, 500, 500],
                                stops: [
                                    [0, 'rgb(255, 255, 255)'],
                                    [1, 'rgb(200, 200, 255)']
                                ]
                            },
                            polar: 'true',
                            forecolor: "rgba(255,255,255,0.65)",
                            type: 'line',
                            zoom: {
                                enabled: !1
                            },
                            toolbar: {
                                show: !0
                            },
                            dropShadow: {
                                enabled: !0,
                                top: 3,
                                left: 14,
                                blur: 4,
                                opacity: .1
                            },
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            },
                            marginTop: 80
                        },
                        credits: {
                            enabled: false
                        },

                        title: {

                            text: 'Total Calls for all Clients'

                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                shade: "light",
                                gradientToColors: ["#fff"],
                                shadeIntensity: 1,
                                type: "vertical",
                                opacityFrom: .7,
                                opacityTo: .2,
                                stops: [0, 100, 100, 100]
                            }
                        },
                        markers: {
                            size: 5,
                            colors: ["#000"],
                            strokeColors: "#fff",
                            strokeWidth: 2,
                            hover: {
                                size: 7
                            }
                        },
                        grid: {
                            borderColor: 'rgba(255, 255, 255, 0.12)',
                            show: true,
                        },
                        tooltip: {
                            theme: "dark",
                            fixed: {
                                enabled: !1
                            },
                            x: {
                                show: !0
                            },
                            y: {
                                formatter: function(e) {
                                    return " " + e + " "
                                }
                            },
                            marker: {
                                show: !1
                            }
                        },
                        //colors: ["#fff"],
                        stroke: {
                            width: 5,
                            curve: "smooth"
                        },

                        xAxis: {
                            reversed: false,
                            categories: tgl_transaksi,
                            min: 3,
                        },
                        scrollbar: {
                            enabled: true
                        },
                        legend: {
                            enabled: true
                        },
                        plotOptions: {
                            column: {
                                grouping: true,
                                shadow: true,
                                borderWidth: 0,
                                pointPadding: 0.3,
                                pointWidth: 12
                            }
                        },

                        yAxis: {

                            title: {

                                text: 'Quantity of Calls'

                            }

                        },
                        series: [{
                            name: 'Total Calls',
                            data: total_transaksi
                        }],
                        scrollbar: {
                            enabled: true,
                            barBackgroundColor: 'gray',
                            barBorderRadius: 7,
                            barBorderWidth: 0,
                            buttonBackgroundColor: 'gray',
                            buttonBorderWidth: 0,
                            buttonArrowColor: 'yellow',
                            buttonBorderRadius: 7,
                            rifleColor: 'yellow',
                            trackBackgroundColor: 'white',
                            trackBorderWidth: 1,
                            trackBorderColor: 'silver',
                            trackBorderRadius: 7
                        },
                        navigation: {
                            buttonOptions: {
                                enabled: false
                            }
                        },

                    });

                };

            },

        });
    }

    /*
    function load_Chart(datas) {

        $('#chart-sales-commerce').empty();
        //let coach_graph = $('#coach_graph').val();
        let coach_graph = $('#coach_graph').val();


        $.ajax({
            url: '<?php #echo site_url("Tests/get_chart_initial/")?>' + datas,
            type: 'POST',
            data: {
                coach_graph: coach_graph
            },
            success: function(data) {

                console.log(data);

                datas = JSON.parse(data);
                total_transaksi = datas.total_call;
                tgl_transaksi = datas.tgl_call;
                row = datas.total;

                var html = '';
                var count = 1;
                var i;
                console.log(data);

                for (index in row) {

                    $('#chart-sales-commerce').highcharts({

                        chart: {
                            backgroundColor: {
                                linearGradient: [0, 0, 500, 500],
                                stops: [
                                    [0, 'rgb(255, 255, 255)'],
                                    [1, 'rgb(200, 200, 255)']
                                ]
                            },
                            polar: 'true',
                            forecolor: "rgba(255,255,255,0.65)",
                            type: 'line',
                            zoom: {
                                enabled: !1
                            },
                            toolbar: {
                                show: !0
                            },
                            dropShadow: {
                                enabled: !0,
                                top: 3,
                                left: 14,
                                blur: 4,
                                opacity: .1
                            },
                            options3d: {
                                enabled: true,
                                alpha: 45,
                                beta: 0
                            },
                            marginTop: 80
                        },
                        credits: {
                            enabled: false
                        },

                        title: {

                            text: 'Total Calls for all Clients'

                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                shade: "light",
                                gradientToColors: ["#fff"],
                                shadeIntensity: 1,
                                type: "vertical",
                                opacityFrom: .7,
                                opacityTo: .2,
                                stops: [0, 100, 100, 100]
                            }
                        },
                        markers: {
                            size: 5,
                            colors: ["#000"],
                            strokeColors: "#fff",
                            strokeWidth: 2,
                            hover: {
                                size: 7
                            }
                        },
                        grid: {
                            borderColor: 'rgba(255, 255, 255, 0.12)',
                            show: true,
                        },
                        tooltip: {
                            theme: "dark",
                            fixed: {
                                enabled: !1
                            },
                            x: {
                                show: !0
                            },
                            y: {
                                formatter: function(e) {
                                    return " " + e + " "
                                }
                            },
                            marker: {
                                show: !1
                            }
                        },
                        //colors: ["#fff"],
                        stroke: {
                            width: 5,
                            curve: "smooth"
                        },

                        xAxis: {
                            reversed: false,
                            categories: tgl_transaksi,
                            min: 3,
                        },
                        scrollbar: {
                            enabled: true
                        },
                        legend: {
                            enabled: true
                        },
                        plotOptions: {
                            column: {
                                grouping: true,
                                shadow: true,
                                borderWidth: 0,
                                pointPadding: 0.3,
                                pointWidth: 12
                            }
                        },

                        yAxis: {

                            title: {

                                text: 'Quantity of Calls'

                            }

                        },
                        series: [{
                            name: 'Total Calls',
                            data: total_transaksi
                        }],
                        scrollbar: {
                            enabled: true,
                            barBackgroundColor: 'gray',
                            barBorderRadius: 7,
                            barBorderWidth: 0,
                            buttonBackgroundColor: 'gray',
                            buttonBorderWidth: 0,
                            buttonArrowColor: 'yellow',
                            buttonBorderRadius: 7,
                            rifleColor: 'yellow',
                            trackBackgroundColor: 'white',
                            trackBorderWidth: 1,
                            trackBorderColor: 'silver',
                            trackBorderRadius: 7
                        },
                        navigation: {
                            buttonOptions: {
                                enabled: false
                            }
                        },

                    });

                };

            },

        });
    } */
    </script>

</body>

</html>