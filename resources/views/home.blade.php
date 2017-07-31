@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height">
                    <div class="row header">Watchlist Charts</div>

                    @include('components.chart-widget', ['ticker' => "PLUG"])
                </div>
            </div>
        </div>
    </div>
@endsection
