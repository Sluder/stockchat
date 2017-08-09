@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height center-content room">
                    <p style="color: white">{{ $room->name }}</p>
                </div>

                {{-- todo: leave button, admin settings --}}

                {{-- col-md-3 --}}
                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
