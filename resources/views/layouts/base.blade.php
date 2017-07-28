<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Stock Chat</title>

        {{-- Styles --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="wrapper">
            <nav class="navbar navbar-fixed-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-1 no-left">
                            <div class="navbar-header">
                                <h4>StockChat</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> Streams</a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Inbox</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3">
                            <div class="search-bar">
                                <form action="" method="GET">
                                    <div class="form-group">
                                        {{ Form::text('search', null, ['class' => 'form-control search-bar', 'placeholder' => 'Symbol']) }}
                                        {{-- todo: typeahead --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p style="color: white">Profile stuff</p>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <div class="body">
            @yield('content')
        </div>

        <div class="footer">
            <div class="container-fluid">

            </div>
        </div>

        {{-- Scripts --}}
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <script type="text/javascript" src="https://d33t3vvu2t2yu5.cloudfront.net/tv.js"></script>

        @yield('scripts')
    </body>
</html>
