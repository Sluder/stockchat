@extends('layouts.base')

@section('styles')
    <style type="text/css">
        body {
            background: url("/images/chart-background.png");
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

                {{-- Join panel --}}
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="collapse join-panel">
                            <form action="{{ route("join.new") }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="header">Join {{ env("SITE_NAME") }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            {{ Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 40]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            {{ Form::text('username', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 20]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 35]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'maxlength' => 50]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="skills_level">Skills Level</label>
                                            {{ Form::select('skills_level', \App\User::$skills_level, null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn custom-btn">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Login panel --}}
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="collapse login-panel">
                            <form action="{{ route("login") }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="header">Login to {{ env("SITE_NAME") }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="username">Username or Email</label>
                                            {{ Form::text('email', null, ['class' => 'form-control', 'required' => 'required', 'maxlength' => 20]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            {{ Form::password('password', ['class' => 'form-control', 'required' => 'required', 'autocomplete' => 'off', 'maxlength' => 50]) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn custom-btn">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        window.onload = function() {
            $('.join-btn').click(function() {
               if ($('.login-panel').attr('aria-expanded', 'true')) {
                   $('.login-panel').attr('aria-expanded', 'false');
                   $('.login-panel').removeClass('in');
               }
            });
            $('.login-btn').click(function() {
                if ($('.join-panel').attr('aria-expanded', 'true')) {
                    $('.join-panel').attr('aria-expanded', 'false');
                    $('.join-panel').removeClass('in');
                }
            });
        }
    </script>
@endsection