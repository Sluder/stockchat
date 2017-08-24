
{{-- User wants to follow another user --}}
<div class="modal fade follow-account-modal" id="follow-account" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="modal-title">Follow {{ $user->username }}?</p>

                <div class="row">
                    <div class="col-md-10">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('follow', ['user' => $user->id]) }}" class="btn custom-btn follow-btn">Follow</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>