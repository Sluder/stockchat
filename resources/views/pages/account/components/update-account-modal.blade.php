
{{-- Update logged in users account --}}
<div class="modal fade update-account-modal" id="update-account" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="modal-title">Update Account</p>
                <form action="{{ route('profile.update') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                {{ Form::text('name', $user->name, ['class' => 'form-control', 'required']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Username <i class="fa fa-question-circle" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="Editable 30 days after last change"></i></label>
                                {{ Form::text('username', $user->username, ['id' => 'username', 'class' => 'form-control', 'required', 'onchange' => "checkInfo('username')", strtotime($user->username_last_changed) < strtotime('-30 days') ? '' : 'readonly']) }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-6">
                            <p class="red" id="username-error">Username already exists.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                {{ Form::text('email', Auth::user()->email, ['id' => 'email', 'class' => 'form-control', 'required', 'maxlength' => 100, 'onchange' => "checkInfo('email')"]) }}
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="red" id="email-error">Email already exists.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="skill_level">Skill Level <i class="fa fa-question-circle" aria-hidden="true" data-toggle="popup" data-trigger="hover" data-content="Helps determine the content you receive"></i></label>
                                {{ Form::select('skill_level', \App\User::$skill_levels, $user->settings->skills_level, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{-- password --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn custom-btn">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>