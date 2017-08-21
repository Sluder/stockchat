@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('components.left-sidebar')

                <div class="col-md-8">
                    <div class="room card">
                        <div class="room-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="room-name">{{ $room->name }}</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="menu">
                                        <div class="room-settings" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </div>
                                        <ul class="dropdown-menu">
                                            @if (Auth::user()->id === $room->creator_id)
                                                <li>
                                                    <a href=""><i class="fa fa-wrench" aria-hidden="true"></i> Admin Settings</a>
                                                </li>
                                            @endif
                                            @if (!Auth::user()->id === $room->creator_id)
                                                <li>
                                                    <a href="{{ route('room.leave', ['room_id' => $room->id]) }}"><i class="fa fa-times" aria-hidden="true"></i>&nbsp; Leave</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="room-message">{{ $room->message }}</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="joined-users">
                                        <i class="fa fa-users" aria-hidden="true"></i>&nbsp;
                                        {{ number_format($room->joined_users) }}
                                    </div>
                                </div>
                            </div>
                        </div>{{-- /room-header --}}
                        <div class="room-messaging">
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="message-input">
                                        {{ Form::text('message-bar', null, ['class' => 'form-control', 'placeholder' => 'Send a message']) }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn custom-btn send">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
