<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>{{ env('SITE_NAME') }}</title>

        {{-- Styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        @yield('styles')
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3 side">
                            <div class="navbar-header">
                                <h4>{{ env('SITE_NAME') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-6 center-content">
                            <div class="row">
                                <div class="col-md-7 no-left">
                                    <ul class="nav navbar-nav">
                                        <li>
                                            <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> Boards</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Inbox</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-5">
                                    <div class="search-bar">
                                        <form action="" method="GET">
                                            <div class="form-group">
                                                {{ Form::text('search', null, ['class' => 'form-control search-bar', 'placeholder' => 'Search']) }}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 side profile">
                            @if (Auth::user())
                                <p class="profile-name">{{ Auth::user()->username }}</p>
                                <div class="dropdown">
                                    <img class="profile-img" src="{{ Auth::user()->profile_img }}" alt="{{ Auth::user()->name }}">
                                    <div class="dropdown-content">
                                        <a href="">
                                            <div class="item bottom">Settings</div>
                                        </a>
                                        <a href="{{ route("logout") }}">
                                            <div class="item">Logout</div>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="buttons">
                                    <a href="{{ route('login.view') }}" class="btn custom-btn login">Login</a>
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

        @yield('scripts')
    </body>
</html>
