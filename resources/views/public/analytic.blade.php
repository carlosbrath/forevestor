@extends('layouts.master')
@section('title', 'Analytics')
@section('content')


<style>
/* left margin on desktop */
.grid-container {
    margin-left: 280px;
    max-width: 1200px;
}

.calender_section {
    width: 100%;
    max-width: 1200px;
    /* desktop max width */
    height: 600px;
    /* desktop height */
    margin-left: 280px;
    /* center horizontally */
    border-radius: 10px;
    overflow: hidden;
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .calender_section {
        height: 400px;
        /* smaller height on mobile */
        margin-left: 0;
    }
}

/* Unique container for this 2x2 grid */
.chart-grid-container {
    margin-left: 280px;
    max-width: 1200px;
}


@media (max-width: 768px) {
    .chart-grid-container {
        margin-left: 0;
        /* no margin on mobile */
    }
}

/* unique box styling */
.chart-grid-box {

    padding: 10px;
    height: 300px;

}

/* mobile: no left margin */
@media (max-width: 768px) {
    .grid-container {
        margin-left: 0px;

    }


}
</style>



<div class="container-fluid grid-container">
    <h1 class="text-center fa-chart-line ">Today's Analytics</h1>

    <div class="row g-2">

        <!-- Box 1 (BTC) -->
        <div class="col-12 col-md-4">
            <div class="grid-box">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "BINANCE:BTCUSDT",
                        "colorTheme": "light",
                        "isTransparent": false,
                        "locale": "en",
                        "width": 380
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Box 2 (ETH) -->
        <div class="col-12 col-md-4">
            <div class="grid-box">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "BINANCE:ETHUSDT",
                        "colorTheme": "light",
                        "isTransparent": false,
                        "locale": "en",
                        "width": 380
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Box 3 (SOL) -->
        <div class="col-12 col-md-4">
            <div class="grid-box">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "BINANCE:SOLUSDT",
                        "colorTheme": "light",
                        "isTransparent": false,
                        "locale": "en",
                        "width": 380
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Box 4 (BNB) -->
        <div class="col-12 col-md-4">
            <div class="grid-box">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "BINANCE:LUNAUSDT",
                        "colorTheme": "light",
                        "isTransparent": false,
                        "locale": "en",
                        "width": 380
                    }
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>
        </div>

        <!-- Box 5 (XRP) -->
        <div class="col-12 col-md-4">
            <div class="grid-box">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "BINANCE:XRPUSDT",
                        "colorTheme": "light",
                        "isTransparent": false,
                        "locale": "en",
                        "width": 380
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Box 6 (DOGE) -->
        <div class="col-12 col-md-4">
            <div class="grid-box">
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-info.js" async>
                    {
                        "symbol": "BINANCE:DOGEUSDT",
                        "colorTheme": "light",
                        "isTransparent": false,
                        "locale": "en",
                        "width": 380
                    }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid chart-grid-container">
    <div class="row g-3">

        <!-- Chart Box 1: XAUUSD -->
        <div class="col-12 col-md-6">
            <div class="chart-grid-box chart-box-1">
                <div class="tv-widget-1" style="height:100%;width:100%">
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "symbol": "OANDA:XAUUSD",
                        "interval": "D",
                        "theme": "light",
                        "autosize": true,
                        "allow_symbol_change": false,
                        "hide_side_toolbar": true
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Chart Box 2: BTCUSD -->
        <div class="col-12 col-md-6">
            <div class="chart-grid-box chart-box-2">
                <div class="tv-widget-2" style="height:100%;width:100%">


                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "symbol": "BINANCE:BTCUSDT",
                        "interval": "D",
                        "theme": "light",
                        "autosize": true
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Chart Box 3: ETHUSD -->
        <div class="col-12 col-md-6">
            <div class="chart-grid-box chart-box-3">
                <div class="tv-widget-3" style="height:100%;width:100%">


                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "symbol": "BINANCE:ETHUSDT",
                        "interval": "D",
                        "theme": "light",
                        "autosize": true
                    }
                    </script>
                </div>
            </div>
        </div>

        <!-- Chart Box 4: SOLUSD -->
        <div class="col-12 col-md-6">
            <div class="chart-grid-box chart-box-4">
                <div class="tv-widget-4" style="height:100%;width:100%">

                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                    {
                        "symbol": "BINANCE:SOLUSDT",
                        "interval": "D",
                        "theme": "light",
                        "autosize": true
                    }
                    </script>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- newssss section -->
<!-- TradingView Widget BEGIN -->
<div class="calender_section">
    <div class="tradingview-widget-container" style="width:100%; height:100%">

        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-events.js" async>
        {
            "colorTheme": "light",
            "isTransparent": false,
            "locale": "en",
            "countryFilter": "ar,au,br,ca,cn,fr,de,in,id,it,jp,kr,mx,ru,sa,za,tr,gb,us,eu",
            "importanceFilter": "-1,0,1",
            "width": "100%",
            "height": "100%"
        }
        </script>
    </div>
</div>

<!-- TradingView Widget END -->
@endsection