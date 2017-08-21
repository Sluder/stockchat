
{{-- User wants to follow another user --}}
<div class="modal fade follow-account-modal" id="follow-account" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="modal-title">Follow {{ $user->username }}?</p>

                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('follow', ['user' => $user->id]) }}" class="btn custom-btn follow-btn">Follow</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>