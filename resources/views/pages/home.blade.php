@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height center-content home-center">
                    <div class="row header">Watchlist Charts</div>

                    @include('components.chart-widget', ['ticker' => "PLUG"])
                </div>

                {{-- col-md-3 --}}
                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
