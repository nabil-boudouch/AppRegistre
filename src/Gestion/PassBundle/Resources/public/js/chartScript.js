//
//$(document).ready(function()
//{
//    $('.search input[type="submit"]').hide();
//    $('#search_keywords').keyup(function(key)
//    {
//        if(this.value.length >= 3 || this.value == '') {
//            $('#loader').show();
//            $('#container').load(
//                $(this).parent('form').attr('action'),
//                { query: this.value ? this.value + '*' : this.value },
//                function() {
//                    $('#loader').hide();
//                }
//            );
//        }
//    });
//});

$(function() {
        var chart;
        $(document).ready(function() {
//$('#search_keywords').keyup(function(key)
//    {
$('#highcharts-0').onLoad(
            $('#loader').show(),

                    $.getJSON(varConf, function(json) {

                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'container',
                        type: 'line',
                        marginRight: 130,
                        marginBottom: 40
                    },
                    credits: {
                        enabled: false
                    },
                    title: {
                        text: 'Anomalies par Services',
                        x: -20 //center
                    },
                    subtitle: {
                        text: '',
                        x: -20
                    },
                    xAxis: {
                        categories: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31']
                                , title: {
                            text: 'Jours du mois',
                            x: -20 //center
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Fréquences des Anomalies'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                    },
                    tooltip: {
                        formatter: function() {
                            return '<b>' + this.series.name + '</b><br/>' +
                                    this.x + ': ' + this.y;
                        }
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'top',
                        x: -10,
                        y: 100,
                        borderWidth: 0
                    },
                    series: json
                });
            }),
            function() {
                    $('#loader').hide();
                }
        );

        });

    });
