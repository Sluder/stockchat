@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height new-room center-content">

                    {{-- Join an existing room --}}
                    <div class="row join">
                        <h4 class="subheader">Join a Room</h4>
                        <p class="helper-text">Enter a link of an existing room to join</p>
                        <div class="col-md-12">
                            <form action="{{ route("room.join") }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-room">
                                            <label for="link">Link</label>
                                            {{ Form::text('link', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 45]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn custom-btn">Join</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 suggested-rooms">
                            <p class="suggested-header no-left">Suggested Rooms</p>
                            @foreach (\App\room::getSuggested() as $room)
                                <div class="row suggested-room-item">
                                    <a href="{{ route('room.join', ['key' => $room->key]) }}">
                                        <div class="col-md-6">
                                            <div class="col-md-1">
                                                <div class="room-img">
                                                    <img src="{{ url('images/test2.png') }}" alt=""> {{-- todo: room name for alt --}}
                                                </div>
                                            </div>
                                            <div class="col-md-11">
                                                <p class="room-name">{{ $room->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Create a new room --}}
                    <div class="row create">
                        <div class="col-md-12 no-left">
                            <h4 class="subheader">Create a Room</h4>
                            <p class="helper-text">Create a new room for discussing stocks and sharing new ideas</p>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route("room.create") }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-room">
                                            <label for="name">Room Name <span class="accent">*</span></label>
                                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 45]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-room">
                                            <label for="message">
                                                Message
                                                <i class="fa fa-question-circle accent" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="A short blurb about your room"></i>
                                            </label>
                                            {{ Form::text('message', null, ['class' => 'form-control', 'maxlength' => 100]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($errors->all() as $error)
                                        <div class="col-md-6">
                                            <div class="error">{{ $error }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row field-row">
                                    <div class="col-md-6">
                                        <label for="is_private">
                                            Private Room
                                            <i class="fa fa-question-circle accent" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="Private is invite only"></i>
                                        </label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="switch">
                                                    <input name="is_private" type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row field-row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn custom-btn">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- col-md-3 --}}
                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
