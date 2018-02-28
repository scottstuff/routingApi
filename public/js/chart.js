
/* globals */
jQuery.noConflict();
var example = 'basic-line', 
    theme = 'default';


(function($){ // encapsulate jQuery   

    /* privates/locals */
    
    /* selectors */
    var $bitcoinButton = $('#bitcoin-btn');
    var $bitcionOptions = $('.bitcoin-options');
    var $ethereumButton = $('#ethereum-btn');
    var $resetButton = $('#reset-btn');
    var $displayBitcoinGraph = $('#bitcoin-dispaly-graph');
    var $graphContainer = $('#graph-container');
    var $displayGraph = $('.display-graph');
    // var $graphRow = $('#graph-row');
    var $bitcoinSelectedInterval = $("#bitcoin-select-interval");
    var $bitcoinSelectedRange = $("#bitcoin-select-range");
    var $loadingDiv = $('#loading');

    /* Parameters, values and variables */
    var $intervalSegment = 0;
    var $intervalPeriod = 0;
    var $rangeSelected = '';
    var $chartTitle = '';
    var $currencySymbol = '';
    var $baseURL =  'https://hade.scogee.com/api/';
    var $baseQuery = '?tsym=USD&aggregate=1&e=CCCAGG&fsym=';
    var $endPoint = '';
    var $customQuery = '';
    var $graphInterval;
    var $rangeButtonSelected = 0;

    /* actions */
    function buildChart(data) {
        $.getJSON(
            $getURL,
            function (data) {

            // split the data set into closingPrice and volume
            var closingPrice = [],
                volume = [],
                dataLength = data.length,
                // set the allowed units for data grouping
                groupingUnits = [[
                    'week',                         // unit name
                    [1]                             // allowed multiples
                ], [
                    'month',
                    [1, 2, 3, 4, 6]
                ]],

                i = 0;

            for (i; i < dataLength; i += 1) {
                closingPrice.push([
                    data[i][0], // the date
                    data[i][1], // closing price
                ]);

                volume.push([
                    data[i][0], // the date
                    data[i][2] // the volume
                ]);
            }

            // create the chart
            Highcharts.stockChart('graph-container', {

                rangeSelector: {
                    allButtonsEnabled: false,
                    selected: $rangeButtonSelected
                },

                title: {
                    text: $chartTitle
                },

                yAxis: [{
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Price'
                    },
                    height: '60%',
                    lineWidth: 2,
                    resize: {
                        enabled: true
                    }
                }, {
                    labels: {
                        align: 'right',
                        x: -3
                    },
                    title: {
                        text: 'Volume'
                    },
                    top: '65%',
                    height: '35%',
                    offset: 0,
                    lineWidth: 2
                }],

                tooltip: {
                    split: true
                },

                series: [{
                    // type: 'spline',
                    name: 'Price',
                    data: closingPrice,
                    tooltip: {
                        valueDecimals: 2
                    }
                    // dataGrouping: {
                    //     units: groupingUnits
                    // }
                }, {
                    type: 'column',
                    name: 'Volume',
                    data: volume,
                    yAxis: 1,
                    tooltip: {
                        valueDecimals: 2
                    }
                    // dataGrouping: {
                    //     units: groupingUnits
                    // }
                }]
            });
        });
    };
    

    /* Hnadlers */
    function handleBitcoinClick() {
        $chartTitle = 'Bitcoin Price';
        $currencySymbol = 'BTC';
        $bitcoinButton.attr('disabled', false);
        $ethereumButton.attr('disabled', true);
        $resetButton.attr('disabled', false);
        clearInterval($graphInterval);
        $bitcionOptions.show();
     }

    function handleBitcoinDisplayClick(event) {
        event.preventDefault();

        $getURL = buildURL();
        $intervalSegment = $bitcoinSelectedInterval.val();
        $intervalPeriod = $intervalSegment * 1000;

        $('#graph-container').show();
        clearInterval($graphInterval);
        $graphContainer.empty();

        executeGraph();
    }

    function executeGraph() {
        $.getJSON($getURL, buildChart);
        $graphInterval = setTimeout(executeGraph, $intervalPeriod);
    }

    function handleEthereumClick() {
        $chartTitle = 'Ethereum Price';
        $currencySymbol = 'ETH';
        $bitcionOptions.show();
        clearInterval($graphInterval);
        $bitcoinButton.attr('disabled', true);
        $ethereumButton.attr('disabled', false);
        $resetButton.attr('disabled', false);
    }

    function handleResetClick() {
        $('#graph-container').hide();
        $bitcionOptions.hide();
        $loadingDiv.hide();
        clearInterval($graphInterval);
        $bitcoinButton.attr('disabled', false);
        $ethereumButton.attr('disabled', false);
        $resetButton.attr('disabled', true);
    }

    function buildURL() {

        $rangeSelected = $bitcoinSelectedRange.val();

        switch($rangeSelected) {
            case "1dm":
                $endPoint = 'histominute';
                $customQuery = $currencySymbol + '&limit=1440';
                $rangeButtonSelected = 3;
                break;
            case "1wh":
                $endPoint = 'histohour';
                $customQuery = $currencySymbol + '&limit=168';
                $rangeButtonSelected = 3;
                break;
            case "1mh":
                $endPoint = 'histohour';
                $customQuery = $currencySymbol + '&limit=720';
                $rangeButtonSelected = 0;
                break;
            case "1md":
                $endPoint = 'histoday';
                $customQuery = $currencySymbol + '&limit=30';
                $rangeButtonSelected = 0;
                break;
            case "1yd":
                $endPoint = 'histoday';
                $customQuery = $currencySymbol + '&limit=366';
                $rangeButtonSelected = 4;
                break;
            case "full":
                $endPoint = 'histoday';
                $customQuery = $currencySymbol + '&allData=true';;
                $rangeButtonSelected = 5;
                break;
            default:
                $endPoint = 'histominute';
                $customQuery = $currencySymbol + '&limit=0';
            }


        $url = $baseURL + $endPoint + $baseQuery + $customQuery;
        return $url;
    }

    /* Listners */

    $bitcoinButton.on('click', handleBitcoinClick);
    $ethereumButton.on('click', handleEthereumClick);
    $resetButton.on('click', handleResetClick);
    $displayBitcoinGraph.on('click', handleBitcoinDisplayClick);

    /* On Loading */
    $bitcionOptions.hide();
    var $loading = $loadingDiv.hide();
    $resetButton.attr('disabled', true);
    $(document)
      .ajaxStart(function () {
        $graphContainer.addClass("dim_div");
        $loading.show();
     })
      .ajaxStop(function () {
        $loading.hide();
        $graphContainer.removeClass("dim_div");
    });

})(jQuery);
