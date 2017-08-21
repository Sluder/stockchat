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
                                <div class="col-md-11 account-info">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="info-label">Name</p>
                                            <p class="info">{{ $user->name }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="info-label">Skills Level</p>
                                            <p class="info">{{ $user->settings->skills_level }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="info-label">Followers</p>
                                            <p class="info">{{ number_format(count($user->followers)) }}</p>
                                        </div>
                                    </div>
                                    <div class="row bottom">
                                        <div class="col-md-4">
                                            <p class="info-label">Username</p>
                                            <p class="info">{{ $user->username }}</p>
                                        </div>
                                        @if ($user->id === Auth::id())
                                            <div class="col-md-4">
                                                <p class="info-label">Email</p>
                                                <p class="info">{{ $user->email }}</p>
                                            </div>
                                        @endif
                                    </div>
                                    @if ($user->id === Auth::id())
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn custom-btn" data-toggle="modal" data-target="#update-account">Update Account</button>
                                            </div>
                                        </div>
                                    @else
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if (Auth::user()->isFollowing($user->id))
                                                    <button class="btn custom-btn" data-toggle="modal" data-target="#unfollow-account">Unfollow</button>
                                                    @include('pages.account.components.unfollow-account-modal', ['user' => $user])
                                                @else
                                                    <button class="btn custom-btn" data-toggle="modal" data-target="#follow-account">Follow</button>
                                                    @include('pages.account.components.follow-account-modal', ['user' => $user])
                                                @endif
                                            </div>
                                        </div>
                                    @endif
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
    @include('pages.account.components.update-account-modal')
@endsection
