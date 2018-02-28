<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hade Graphs</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/hade.css">

    </head>
    <body>
        <div class="hero-image"></div>
        <main role="main">
            <div class="container">
                <div class="row row-spacing"></div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <button id="bitcoin-btn" class="btn btn-primary">Bitcoin</button>
                    </div>
                    <div class="col">
                        <button id="ethereum-btn" class="btn btn-primary">Ethereum</button>
                    </div>
                    <div class="col">
                        <button id="reset-btn" class="btn btn-danger reset-btn" disabled="disabled">Reset</button>
                    </div>
                    <div class="col"></div>

                </div>
                <div class="row row-spacing"></div>
                <div id="graph-row" class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10" style="text-align: center;">
                        <div class="bitcoin-options" style="display: none;">
                            <form id="bitcoin-form">
                                <lable for="bitcoin-select-range" class="label-spacing">Graph Range</lable>
                                <select id="bitcoin-select-range" name="bitcoin-select-range" class=" option-spacing">
                                    <option value="1dm">1 day by the minute</option>
                                    <option value="1wh">1 week by the hour</option>
                                    <option value="1mh">1 month by the hour</option>
                                    <option value="1md">1 month by the day</option>
                                    <option value="1yd">1 year by the day</option>
                                    <option value="full">Full History by the day</option>
                                </select>
                                <lable for="bitcoin-select-interval" class="label-spacing">Update graph every</lable>
                                <select id="bitcoin-select-interval" name="bitcoin-select-interval" class=" option-spacing graph-interval" class=" option-spacing">
                                    <option value="10">10 Seconds</option>
                                    <option value="30">30 seconds</option>
                                    <option value="60">1 minute</option>
                                    <option value="360">5 minutes</option>
                                    <option value="2160">30 minutes</option>
                                </select>
                                <button id="bitcoin-dispaly-graph" class="btn btn-primary option-btn">Use these options</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <div class="ethereum-options" style="display: none;">
                    <p>here in ethereumethereum</p>
                </div>
                <div id="graph-row" class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div id="loading" class="display-graph-options loading-options" style="display: none;">
                            <img src="/images/loading.gif" />  
                        </div>
                        <div id="graph-container" class="display-graph display-graph-options"></div>
                    </div>
                    <div class="col-md-1"></div>
                </div>

                <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
                <script src="https://code.highcharts.com/stock/highstock.js"></script>
                <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
                <div id="graph-container" style="height: 400px; min-width: 310px"></div> 
                <script src="/js/chart.js"></script>
            </div>
        </main>
    </body>
</html>
