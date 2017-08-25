
{{-- User wants to un-follow another user --}}
<div class="modal fade unfollow-account-modal" id="unfollow-account" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p class="modal-title">Unfollow {{ $user->username }}?</p>

                <div class="row">
                    <div class="col-md-10">
                        <button type="button" class="close unfollow-close" data-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('unfollow', ['user' => $user->id]) }}" class="btn custom-btn follow-btn">Unfollow</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>