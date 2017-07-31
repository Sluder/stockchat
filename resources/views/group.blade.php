@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height new-group">
                    {{-- Join an existing group --}}
                    <div class="row join">
                        <h4 class="subheader">Join Group</h4>
                        <p class="helper-text">Enter a link of an existing group to join</p>
                        <div class="col-md-12">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            {{ Form::text('link', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Creat a new group --}}
                    <div class="row create">
                        <div class="col-md-12 no-left">
                            <h4 class="subheader">Create Group</h4>
                            <p class="helper-text">Create a new group for others to join</p>
                        </div>
                        <div class="col-md-12">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="group-name">Group Name *</label>
                                            {{ Form::text('group-name', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="objective">Objective</label>
                                            {{ Form::text('objective', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
