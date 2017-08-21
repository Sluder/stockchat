@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('components.left-sidebar')

            <div class="col-md-8">
                <div class="error-404 card">
                    <div class="row">
                        <p>404</p>
                    </div>
                </div>
            </div>

            @include('components.right-sidebar')
        </div>
    </div>
@endsection
