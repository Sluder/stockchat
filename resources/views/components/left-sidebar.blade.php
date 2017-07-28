
<div class="col-md-3 left-sidebar full-height">
    {{-- Watchlist --}}
    <div class="watchlist">
        <h4 class="subheader">Watchlist</h4>

        @for ($i = 0; $i < 6; $i++)
            <div class="row side-item">
                <div class="col-md-12">
                    <div class="col-md-8 no-padding">
                        <div class="ticker">DCTH</div>
                    </div>
                    <div class="col-md-4 no-padding">
                        <p class="current-price">0.26</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-8 no-padding">
                        <div class="company-name">Delcath Pharmaceuticals</div>
                    </div>
                    <div class="col-md-4 no-padding">
                        <p class="change">.03 (23%)</p>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="test"></div>
    {{-- Joined Groups --}}
    <div class="groups">
        <h4 class="subheader">Groups</h4>

        @for ($i = 0; $i < 6; $i++)
            <div class="row group-item">
                <div class="col-md-8">
                    <p class="group-name">Group Name Test</p>
                </div>
            </div>
        @endfor
    </div>
</div>

