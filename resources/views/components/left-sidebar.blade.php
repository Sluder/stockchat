
<div class="col-md-2 left-sidebar no-right">
    {{-- Watchlist --}}
    <div class="watchlist">
        <div class="row">
            <div class="side-header">
                WatchList
                <div class="dropdown">
                    <span class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-expanded="true"></span>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""><i class="fa fa-line-chart" aria-hidden="true"></i> Add a Stock</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @for ($i = 0; $i < 5; $i++)
            <a href="">
                <div class="row watch-item">
                    <div class="item-wrapper">
                        <div class="col-md-5">
                            <div class="row symbol">PLUG</div>
                            <div class="row company">Plug Power</div>
                        </div>
                        <div class="col-md-3 current-price">
                            <div class="row current-price">$34.43</div>
                        </div>
                        <div class="col-md-4">
                            <div class="row"></div>
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </a>
        @endfor
    </div>

    {{-- Joined Rooms --}}
    <div class="rooms">
        <div class="row">
            <div class="side-header">
                Rooms
                <div class="dropdown">
                    <span class="fa fa-angle-down dropdown-toggle" data-toggle="dropdown" aria-expanded="true"></span>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route("room.view") }}"><i class="fa fa-comments" aria-hidden="true"></i> Add a Room</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @forelse (Auth::user()->rooms as $room)
            <a href="{{ route("room", ['key' => $room->key]) }}">
                <div class="row room-item">
                    <div class="item-wrapper">
                        <div class="col-md-10 room-name">{{ $room->name }}</div>
                    </div>
                </div>
            </a>
        @empty
            <div class="row room-item">
                <div class="item-wrapper">
                    <div class="empty">You have not joined any rooms</div>
                </div>
            </div>
        @endforelse
    </div>
</div>

