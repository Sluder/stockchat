@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('components.left-sidebar')

                <div class="col-md-8">
                    <div class="profile">
                        <div class="profile-account card">
                            <p class="profile-header">Account</p>
                            <div class="row">
                                <div class="col-md-1">
                                    <img class="profile-img" src="{{ $user->profile_img }}" alt="{{ $user->name }}"/>

                                </div>
                                <div class="col-md-5 account-info">
                                    <p class="info-label">Username</p>
                                    <p class="info">{{ $user->username }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="message-history card">
                            <p class="profile-header">Message History</p>
                        </div>
                    </div>
                </div>

                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
