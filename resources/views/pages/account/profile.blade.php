@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('components.left-sidebar')

                <?php $owner = $user->id === Auth::id(); ?>
                <div class="col-md-8">
                    <div class="profile">
                        <div class="profile-account card">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="profile-header">Profile</p>
                                    @if ($owner)
                                        <p class="helper-text">Your sensitive information is hidden from other users</p>
                                    @endif
                                </div>
                                @if (!$owner)
                                    <div class="col-md-2">
                                        <div class="dropdown">
                                            <span class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-expanded="true"></span>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href=""><i class="fa fa-ban" aria-hidden="true"></i> Report</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="row account-block">
                                <div class="col-md-1">
                                    <img class="profile-img" src="{{ $user->profile_img }}" alt="{{ $user->name }}"/>
                                </div>
                                <div class="col-md-11 account-info">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="info-label">Name <i class="fa fa-user-o" aria-hidden="true"></i></p>
                                            <p class="info">{{ $user->name }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="info-label">Skill Level <i class="fa fa-bar-chart" aria-hidden="true"></i></p>
                                            <p class="info">{{ $user->settings->skill_level }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="info-label">Followers <i class="fa fa-users" aria-hidden="true"></i></p>
                                            <p class="info">{{ number_format(count($user->followers)) }}</p>
                                        </div>
                                    </div>
                                    <div class="row bottom">
                                        <div class="col-md-3">
                                            <p class="info-label">Username <i class="fa fa-user-secret" aria-hidden="true"></i></p>
                                            <p class="info">{{ $user->username }}</p>
                                        </div>
                                        @if ($owner)
                                            <div class="col-md-3">
                                                <p class="info-label">Email <i class="fa fa-envelope-o" aria-hidden="true"></i></p>
                                                <p class="info">{{ $user->email }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-3">
                                            <p class="info-label">Date Joined <i class="fa fa-calendar-check-o" aria-hidden="true"></i></p>
                                            <p class="info">{{ $user->created_at->toFormattedDateString() }}</p>
                                        </div>
                                    </div>
                                    @if ($owner)
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
                        <div class="password card">
                            <p class="profile-header">Password</p>
                        </div>
                    </div>
                </div>

                @include('components.right-sidebar')
            </div>
        </div>
    </div>
    @include('pages.account.components.update-account-modal')
@endsection
