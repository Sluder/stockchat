@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('components.left-sidebar')

            <div class="col-md-8">
                <div class="home card">

                </div>
            </div>

            @include('components.right-sidebar')
        </div>
    </div>
@endsection
