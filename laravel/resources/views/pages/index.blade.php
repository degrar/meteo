
@extends('layouts.default')

@section('pageTitle','Meteo')

@section('description','Descripción de prueba')

@section('specificScriptOnHeader')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'line', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        google.charts.setOnLoadCallback(weatherDay_rain);

        google.charts.setOnLoadCallback(weatherDay_temp);

        function drawBasic() {
            var target={!! json_encode($current_weather) !!};
            var data = new google.visualization.DataTable();
            data.addColumn({type: 'date', id: 'Time of Day'});
            data.addColumn({type: 'number', id: 'temperature'});


            var prv = 999999999999;
            for (var key in target){

                var euro_date = target[key]['data'].split('-').reverse();
                var euro_time = target[key]['hour'].split(':');
                if(target[key]['hour'] == '00:00') {
                    var fix_date = (parseInt(euro_date[2])+1).toString();
                    if (fix_date.length == 1) fix_date = '0'+fix_date;
                    euro_date[2] = fix_date;
                }
                if (prv < parseInt(euro_date.join('')+euro_time.join(''))) continue;
                prv = parseInt(euro_date.join('')+euro_time.join(''));
                var date = [euro_date[0], euro_date[1], euro_date[2], euro_time[0], euro_time[1]];
                data.addRows([
                    [new Date(euro_date[0], euro_date[1], euro_date[2], euro_time[0], euro_time[1]),
                        parseFloat(target[key]['temp_actual'])]
                ]);

            }

            var options = {
                hAxis: {
                    title: 'Hours',
                    format: 'd/M/yy',
                },
                vAxis: {
                    title: 'Temperatures'
                },
                colors: ['#AB0D06'],
                trendlines: {
                    0: {type: 'exponential', color: '#333', opacity: 1},

                },
                title: 'Temperatura Actual'
            };
            var chart = new google.visualization.LineChart(document.getElementById('linechart'));
            chart.draw(data, options);
        }


        function weatherDay_rain() {
            var day_data={!! json_encode($weather_day) !!};
            var data = new google.visualization.DataTable();
            data.addColumn({type: 'date', id: 'Day'});
            data.addColumn({type: 'number', id: 'mm'});



            for (var key in day_data){
                var euro_date = day_data[key]['data'].split('-').reverse();

                console.log(new Date(euro_date[0], euro_date[1], euro_date[2]),parseFloat(day_data[key]['pluja_max']));

                data.addRows([
                    [new Date(euro_date[0], euro_date[1], euro_date[2]),parseFloat(day_data[key]['pluja_max'])]
                ]);
            }

            var options = {
                hAxis: {
                    title: 'Day',
                    format: 'd/M/yy',
                    gridlines: {count: 5}
                },
                vAxis: {
                    title: 'mm',
                    gridlines: {color: 'none'},
                },
                curveType: 'function',
                title: 'Pluja diaria'
            };
            var chart = new google.visualization.ColumnChart(document.getElementById('charts'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        function weatherDay_temp() {
            var day_data={!! json_encode($weather_day) !!};
            var data = new google.visualization.DataTable();
            data.addColumn({type: 'date', id: 'Day'});
            data.addColumn({type: 'number', id: 'ºC'});
            data.addColumn({type: 'number', id: 'ºC'});



            for (var key in day_data){
                var euro_date = day_data[key]['data'].split('-').reverse();

                data.addRows([
                    [new Date(euro_date[0], euro_date[1], euro_date[2]),parseFloat(day_data[key]['temp_max']), parseFloat(day_data[key]['temp_min'])]
                ]);
            }

            var options = {
                hAxis: {
                    title: 'Day',
                    format: 'd/M/yy',
                    gridlines: {count: 5}
                },
                vAxis: {
                    title: 'ºC',
                    gridlines: {color: 'none'},
                },
                curveType: 'function',
                colors: ['red', 'blue'],
                trendlines: {
                    0: {type: 'exponential', color: 'red', opacity: .5},
                    1: {type: 'linear', color: 'blue', opacity: .5, showR2: true}
                }
            };
            var chart = new google.visualization.LineChart(document.getElementById('charts_temp'));
            chart.draw(data, options);
        }

    </script>
@stop


@section('content')
    <div id="linechart"></div>
    <div id="charts"></div>

    <div id="charts_temp"></div>


@stop
