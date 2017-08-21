
<div class="holder">
    <div class="row chart" id="chart"></div>
</div>

@section('scripts')
    <script type="text/javascript">
        new TradingView.widget({
            "container_id": "chart",
            "width": "100%",
            "symbol": "NASDAQ:{{ $ticker }}",
            "interval": "3",
            "timezone": "Etc/UTC",
            "theme": "White",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "rgb(82, 82, 82)",
            "enable_publishing": false,
            "allow_symbol_change": true,
            "withdateranges": true,
            "hideideas": true
        });
    </script>
@endsection