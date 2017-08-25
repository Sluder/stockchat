
{{-- User wants to report another user --}}
<div class="modal fade report-user-modal" id="report-user" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="modal-title">Report {{ $user->username }}</p>

                <form action="{{ route('report') }}" method="POST">
                    {{ csrf_field() }}
                    {{ Form::hidden('user_id', \Crypt::encrypt($user->id)) }}
                    {{ Form::hidden('username', \Crypt::encrypt($user->username)) }}
                    <div class="form-group">
                        <ul>
                            @foreach(\App\User::$reportReasons as $reason)
                                <li>
                                    <input type="radio" name="reason" value="{{ $reason }}" required>
                                    <label for="reason">{{ $reason }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        <div class="col-md-2">
                            <button class="btn custom-btn follow-btn" type="submit">Report</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>