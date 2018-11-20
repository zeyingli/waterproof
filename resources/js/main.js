// Dom7
var $$ = Dom7;

// Theme
var theme = 'ios';
if (document.location.search.indexOf('theme=') >= 0) {
    theme = document.location.search.split('theme=')[1].split('&')[0];
}

// Init App
var app = new Framework7({
    id: 'io.framework7.mobileux',
    root: '#mobileux',
    theme: theme,
    data: function () {
        return {
            user: {
                firstName: 'John',
                lastName: 'Doe',
            },
        };
    },
    methods: {
        helloWorld: function () {
            app.dialog.alert('Hello World!');
        },
    },
    routes: routes,
    vi: {
        placementId: 'pltd4o7ibb9rc653x14',
    }
});

/* show hide app loader */
app.preloader.show();
$(window).on('load', function () {
    app.preloader.hide();
})

/* page inside iframe just for demo app */
if (self !== top) {
    $('body').addClass('max-demo-frame')
}


$$(document).on('page:init', '.page[data-name="dashboard"]', function (e) {
    $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
        type: 'bar',
        height: '25',
        barSpacing: 2,
        barColor: '#a9d7fe',
        negBarColor: '#ef4055',
        zeroColor: '#ffffff'
    });
});

$$(document).on('page:init', '.page[data-name="project-list"]', function (e) {
    $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
        type: 'bar',
        height: '25',
        barSpacing: 2,
        barColor: '#a9d7fe',
        negBarColor: '#ef4055',
        zeroColor: '#ffffff'
    });
});

$$(document).on('page:init', '.page[data-name="profile"]', function (e) {
    $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
        type: 'bar',
        height: '25',
        barSpacing: 2,
        barColor: '#a9d7fe',
        negBarColor: '#ef4055',
        zeroColor: '#ffffff'
    });
});

$$(document).on('page:init', '.page[data-name="project-detail"]', function (e) {
    $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
        type: 'bar',
        height: '25',
        barSpacing: 2,
        barColor: '#a9d7fe',
        negBarColor: '#ef4055',
        zeroColor: '#ffffff'
    });

    /* Google chart */
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2013', 1000, 400],
          ['2014', 1170, 460],
          ['2015', 660, 1120],
          ['2016', 1030, 540]
        ]);

        var options = {
            vAxis: {
                minValue: 0
            },
            legend: {
                position: 'top',
                maxLines: 3
            },
            chartArea: {
                left: 38,
                top: 10,
                bottom: 20,
                width: '85%'
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }



});
