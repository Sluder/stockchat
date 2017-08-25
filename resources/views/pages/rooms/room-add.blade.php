@extends('layouts.base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('components.left-sidebar')

            <div class="col-md-8">
                <div class="join-room card">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="room-header">Join a Room</p>
                            <p class="helper-text">Enter a link of an existing room to join</p>
                        </div>
                    </div>
                    <div class="row">
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
                    </div>
                </div>
                <div class="create-room card">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="room-header">Create a Room</p>
                            <p class="helper-text">Create a new room for discussing stocks and sharing new ideas</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route("room.create") }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-room">
                                            <label for="name">Room Name <span class="accent">*</span></label>
                                            {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => 45, 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-room">
                                            <label for="message">
                                                Message
                                                <i class="fa fa-question-circle accent" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="A short blurb about your room"></i>
                                            </label>
                                            {{ Form::text('message', null, ['class' => 'form-control', 'maxlength' => 100, 'required']) }}
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
            </div>

            @include('components.right-sidebar')
        </div>
    </div>
@endsection
