@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height">
                    <div class="row header">Watchlist Charts</div>

                    {{--<div class="row chart" id="chart"></div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

//        new TradingView.widget({
//            "container_id": "chart",
//            "width": "100%",
//            "symbol": "NASDAQ:AAPL",
//            "interval": "3",
//            "timezone": "Etc/UTC",
//            "theme": "White",
//            "style": "1",
//            "locale": "en",
//            "toolbar_bg": "rgb(36, 38, 45)",
//            "enable_publishing": false,
//            "allow_symbol_change": true,
//            "withdateranges": true,
//            "hideideas": true
//        });
    </script>
@endsection
