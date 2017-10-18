
@extends('layouts.default')

@section('pageTitle','Meteo')

@section('description','Descripción de prueba')

@section('specificScriptOnHeader')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'line']});
        google.charts.setOnLoadCallback(drawBasic);

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
                console.log(prv, parseInt(euro_date.join('')+euro_time.join('')));
                if (prv < parseInt(euro_date.join('')+euro_time.join(''))) continue;
                prv = parseInt(euro_date.join('')+euro_time.join(''));
                //console.log('Time ',euro_date, euro_time);
                var date = [euro_date[0], euro_date[1], euro_date[2], euro_time[0], euro_time[1]];
                //console.log(new Date(euro_date[0], euro_date[1], euro_date[2], euro_time[0], euro_time[1]), '-', parseFloat(target[key]['temp_actual']));
                data.addRows([
                    [new Date(euro_date[0], euro_date[1], euro_date[2], euro_time[0], euro_time[1]),
                        parseFloat(target[key]['temp_actual'])]
                ]);

            }

            var options = {
                hAxis: {
                    title: 'Days',
                    format: "HH:mm",
                },
                vAxis: {
                    title: 'Temperatures'
                },
                curveType: 'function',


                title: 'Temperatura Actual'
            };

            var chart = new google.visualization.LineChart(document.getElementById('linechart'));

            chart.draw(data, options);
        }

    </script>
@stop



@section('content')
    <div id="linechart"></div>

@stop
