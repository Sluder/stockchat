<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @yield('meta')

        @yield('title')

        {{-- Styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        @yield('styles')
    </head>
    <body>
        <div class="wrapper">
            <nav class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 no-right">
                            <div class="row logo">
                                <div class="col-md-12">
                                    <p style="color:white">Temp</p>
                                </div>
                            </div>
                            <div class="row nav-icons">
                                <div class="col-md-4">
                                    <a href="{{ route('home') }}">
                                        <i class="fa fa-home" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="">
                                        <i class="fa fa-bell" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="search-bar">
                                {{ Form::text('search', null, ['class' => 'form-control search-bar', 'placeholder' => 'Search for stocks, people & rooms']) }}
                            </div>
                        </div>
                        <div class="col-md-2 user-profile">
                            @if (Auth::check())
                                <p class="profile-name">{{ Auth::user()->username }}</p>
                                <div class="dropdown">
                                    <img class="profile-img" src="{{ Auth::user()->profile_img }}" alt="{{ Auth::user()->name }}" data-toggle="dropdown" aria-expanded="true">
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('profile', ['username' => Auth::user()->username]) }}"><i class="fa fa-user" aria-hidden="true"></i>&nbsp; Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="buttons">
                                    <a href="{{ route('login.view') }}" class="btn custom-btn">Login</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="body">
            @yield('content')
        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>

        @if (Auth::check())
            <script type="text/javascript">
                // Checks if username or email is already used
                function checkInfo(field)
                {
                    var field_val = $('#' + field).val();
                    var username = {!! json_encode(Auth::user()->username) !!};

                    if (field_val !== username) {
                        $.ajax({
                            type: "GET",
                            url: "/check/" + field_val,
                            success:function(used)
                            {
                                if (used) {
                                    if (field === "username") {
                                        document.getElementById('username-error').style.display = 'inline-block';
                                    } else if (field === "email") {
                                        document.getElementById('email-error').style.display = 'inline-block';
                                    }
                                } else {
                                    if (field === "username") {
                                        document.getElementById('username-error').style.display = 'none';
                                    } else if (field === "email") {
                                        document.getElementById('email-error').style.display = 'none';
                                    }
                                }
                            }
                        });
                    }
                }
            </script>
        @endif

        @yield('scripts')
    </body>
</html>
