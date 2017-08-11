
<div class="col-md-3 left-sidebar full-height">
    {{-- Watchlist --}}
    <div class="watchlist">
        <div class="row side-header">
            <div class="col-md-10 no-left">
                <h4 class="subheader watch-header">Watchlist</h4>
            </div>
            <div class="col-md-2">
                <div class="material-icon">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        @for ($i = 0; $i < 6; $i++)
            <div class="row watch-item">
                <div class="col-md-5">
                    <div class="row">
                        <div class="ticker">DCTH</div>
                    </div>
                    <div class="row">
                        <div class="company-name">Delcath Pharmaceuticals</div>
                    </div>
                </div>
                <div class="col-md-3 price-holder no-padding">
                    <p class="current-price">
                        $0.26
                    </p>
                </div>
                <div class="col-md-4 no-padding">
                    <p class="percent-change green">$0.03 (23%) <i class="fa fa-chevron-up green" aria-hidden="true"></i></p>
                </div>
            </div>
        @endfor
    </div>

    {{-- Joined Rooms --}}
    <div class="rooms">
        <div class="row side-header">
            <div class="col-md-10 no-left">
                <h4 class="subheader room-header">Rooms</h4>
            </div>
            <div class="col-md-2">
                <a href="{{ route("room.view") }}">
                    <div class="material-icon">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </a>
            </div>
        </div>
        @forelse (\App\User::find(1)->rooms as $room)
            <a href="{{ env('APP_URL') . $room->key }}">
                <div class="row room-item">
                    <div class="col-md-8">
                        <p class="room-name">{{ $room->name }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="row room-item">
                <div class="col-md-12">
                    <p class="empty">You have not joined any groups</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

