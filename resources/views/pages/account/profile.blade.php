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
                                    @if (Session::has('account-message'))
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="green">{{ Session::get('account-message') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if (!$errors->update_errors->isEmpty())
                                        <div class="row">
                                            <div class="col-md-12">
                                                @foreach ($errors->update_errors->all() as $error)
                                                    <p class="red">{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </div>
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
                                            <p class="info-label"><i class="fa fa-user-o" aria-hidden="true"></i> Name</p>
                                            <p class="info">{{ $user->name }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="info-label"><i class="fa fa-bar-chart" aria-hidden="true"></i>Skill Level</p>
                                            <p class="info">{{ $user->settings->skill_level }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="info-label"><i class="fa fa-users" aria-hidden="true"></i> Followers</p>
                                            <p class="info">{{ number_format(count($user->followers)) }}</p>
                                        </div>
                                    </div>
                                    <div class="row bottom">
                                        <div class="col-md-3">
                                            <p class="info-label"><i class="fa fa-user-secret" aria-hidden="true"></i> Username</p>
                                            <p class="info">{{ $user->username }}</p>
                                        </div>
                                        @if ($owner)
                                            <div class="col-md-3">
                                                <p class="info-label"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</p>
                                                <p class="info">{{ $user->email }}</p>
                                            </div>
                                        @endif
                                        <div class="col-md-3">
                                            <p class="info-label"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Date Joined</p>
                                            <p class="info">{{ $user->created_at->toFormattedDateString() }}</p>
                                        </div>
                                    </div>
                                    @if ($owner)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <button class="btn custom-btn" data-toggle="modal" data-target="#update-account">Update Profile</button>
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
                        @if ($owner)
                            <div class="password card">
                                <p class="profile-header">Password Change</p>
                                @if (Session::has('password-message'))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="green">{{ Session::get('password-message') }}</p>
                                        </div>
                                    </div>
                                @endif
                                <form action="{{ route('password.update') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password <span class="accent required">*</span></label>
                                                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'minlength' => 5, 'required', 'autocomplete' => 'off', 'onchange' => 'comparePasswords()']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password_repeat">Repeat Password <span class="accent required">*</span></label>
                                                {{ Form::password('password_repeat', ['id' => 'password_repeat', 'class' => 'form-control', 'minlength' => 5, 'required', 'autocomplete' => 'off', 'onchange' => 'comparePasswords()']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p id="password-error" class="red">Passwords do not match.</p>
                                        </div>
                                    </div>
                                    @if (!$errors->password_errors->isEmpty())
                                        <div class="row">
                                            <div class="col-md-12">
                                                @foreach ($errors->password_errors->all() as $error)
                                                    <p class="red">{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn custom-btn" id="update-btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="following card">
                            <p class="profile-header">Following</p>
                            <div class="row" id="following-list">
                                <template id="following-template">
                                    <div class="name"></div>
                                </template>
                            </div>
                            <div class="load-more" onclick="loadMore()" id="load-more">Load more</div>
                        </div>
                    </div>
                </div>

                @include('components.right-sidebar')
            </div>
        </div>
    </div>
    @include('pages.account.components.update-account-modal')
@endsection

@section('scripts')
    <script type="text/javascript">
        // Checks change password fields for similarity
        function comparePasswords()
        {
            var password = $('#password').val();
            var password_check = $('#password_repeat').val();

            if (password !== password_check) {
                document.getElementById('password-error').style.display = 'inline-block';
                document.getElementById('update-btn').disabled = true;
            } else {
                document.getElementById('password-error').style.display = 'none';
                document.getElementById('update-btn').disabled = false;
            }
        }

        // Loads more 'following' accounts and creates new list item
        var pageNumber = 1;
        function loadMore()
        {
            $.ajax({
                type : 'GET',
                url: "/following/" + pageNumber,
                success: function(response) {
                    pageNumber += 1;
                    if (response['data'].length == 0){
                        document.getElementById('load-more').style.display = 'none';

                    } else {
                        var followingList = document.getElementById('following-list');

                        for (var i = 0; i < response['data'].length; i++) {
                            var template = document.getElementById('following-template').content.cloneNode(true);

                            template.querySelector('.name').innerText = response['data'][i]['name'];
                            followingList.appendChild(template);
                        }
                    }
                    if ((pageNumber - 1) == response['last_page']) {
                        document.getElementById('load-more').style.display = 'none';
                    }
                }
            });
        }
    </script>
@endsection