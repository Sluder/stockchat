@extends('layouts.base')

@section('styles')
    <style type="text/css">
        body {
            background: url("/images/chart-background-grey.png");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <div class="content welcome">
        <div class="container-fluid">
            <div class="row">
                <p class="welcome-header">Welcome to {{ env("SITE_NAME") }}</p>
                <p class="helper-text">Live message board and room chat</p>
            </div>
            <div class="row account-buttons">
                <button class="btn custom-btn join-btn" data-toggle="collapse" data-target=".join-panel">Join</button>
                <button class="btn custom-btn login-btn" data-toggle="collapse" data-target=".login-panel">Login</button>
                <a href="{{ route('google.login') }}" class="btn custom-btn google-btn">
                    <i class="fa fa-google-plus" aria-hidden="true"></i>
                </a>
            </div>
            {{-- Join panel --}}
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="collapse join-panel">
                        <form action="{{ route("join") }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="panel-header">Join {{ env("SITE_NAME") }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        {{ Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 50]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        {{ Form::text('username', null, ['id' => 'username', 'class' => 'form-control', 'required', 'maxlength' => 20, 'onchange' => "checkInfo('username')"]) }}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="red" id="username-error">Username already exists.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        {{ Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'required', 'maxlength' => 100, 'onchange' => "checkInfo('email')"]) }}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="red" id="email-error">Email already exists.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password<i class="fa fa-question-circle" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="More than 5 characters"></i></label>
                                        {{ Form::password('password', ['class' => 'form-control', 'required', 'autocomplete' => 'off', 'minlength' => 5, 'maxlength' => 100]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="skills_level">Skills Level<i class="fa fa-question-circle" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="Helps determine the content you receive"></i></label>
                                        {{ Form::select('skills_level', \App\User::$skills_level, null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                            @if (!$errors->join_errors->isEmpty())
                                <div class="row">
                                    <div class="col-md-12 error-container join-errors">
                                        @foreach ($errors->join_errors->all() as $error)
                                            <p class="red">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn custom-btn">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>{{-- /join-panel --}}
            {{-- Login panel --}}
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="collapse login-panel">
                        <form action="{{ route("login") }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="panel-header">Login to {{ env("SITE_NAME") }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="login">Username or Email</label>
                                        {{ Form::text('login', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 50]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'maxlength' => 50]) }}
                                    </div>
                                </div>
                            </div>
                            @if (!$errors->login_errors->isEmpty())
                                <div class="row">
                                    <div class="col-md-12 error-container login-errors">
                                        @foreach ($errors->login_errors->all() as $error)
                                            <p class="red">{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn custom-btn">Sign In</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>{{-- /login-panel --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        window.onload = function() {
            $('.join-btn').click(function() {
               if ($('.login-panel').attr('aria-expanded', 'true')) {
                   $('.login-panel').attr('aria-expanded', 'false').removeClass('in');
               }
            });
            $('.login-btn').click(function() {
                if ($('.join-panel').attr('aria-expanded', 'true')) {
                    $('.join-panel').attr('aria-expanded', 'false').removeClass('in');
                }
            });

            // Expand panels on errors
            if ($('.error-container').hasClass('join-errors')){
                $('.join-panel').attr('aria-expanded', 'true').addClass('in');
            }
            if ($('.error-container').hasClass('login-errors')){
                $('.login-panel').attr('aria-expanded', 'true').addClass('in');
            }
        };
    </script>
@endsection