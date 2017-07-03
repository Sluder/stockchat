@extends('layouts.base')

@section('content')

    <!-- TradingView Widget BEGIN -->
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>

    <script type="text/javascript">
        new TradingView.widget({
            "width": 980,
            "height": 610,
            "symbol": "NASDAQ:AAPL",
            "interval": "5",
            "timezone": "Etc/UTC",
            "theme": "Black",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "allow_symbol_change": true,
            "hideideas": true
        });
    </script>
    <!-- TradingView Widget END -->


@endsection