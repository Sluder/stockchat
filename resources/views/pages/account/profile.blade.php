@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('components.left-sidebar')

                <div class="col-md-8">
                    <div class="profile card">

                    </div>
                </div>

                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
