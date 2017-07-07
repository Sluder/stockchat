
<div class="col-md-2 col-md-offset-1">
    <div class="watchlist">
        <div class="row header">
            <div class="col-md-10 title">
                Watchlist
            </div>
            <div class="col-md-2">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </div>
        </div>
        @for ($i = 0; $i < 7; $i++)
            <div class="row watch-item">
                <div class="col-md-6">
                    <div class="row ticker">OPXAW</div>
                    <div class="row company-name">Opexa Therapeutics, Inc.</div>
                </div>
                <div class="col-md-3 price">.12</div>
                <div class="col-md-3 green">
                    <div class="row price-difference">&#9650; 34.06</div>
                    <div class="row percent-difference">+17%</div>
                </div>
            </div>
        @endfor
    </div>

    <div class="groups">
        <div class="row header">
            <div class="title">
                Groups
            </div>
        </div>
        @for ($i = 0; $i < 5; $i++)
            <div class="row group-item">
                <div class="col-md-6 no-left">
                    <div class="group-name">Day traders Elite</div>
                </div>
            </div>
        @endfor
    </div>
</div>

