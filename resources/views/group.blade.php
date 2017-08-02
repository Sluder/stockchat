@extends('layouts.base')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- col-md-3 --}}
                @include('components.left-sidebar')

                <div class="col-md-6 full-height new-group center-content">
                    {{-- Join an existing group --}}
                    <div class="row join">
                        <h4 class="subheader">Join Group</h4>
                        <p class="helper-text">Enter a link of an existing group to join</p>
                        <div class="col-md-12">
                            <form action="{{ route("join.group") }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="link">Link</label>
                                            {{ Form::text('link', null, ['class' => 'form-control', 'required' => 'required']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn custom-btn">Join</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <p class="helper-text no-left">Suggested Groups</p>
                        </div>
                    </div>

                    {{-- Creat a new group --}}
                    <div class="row create">
                        <div class="col-md-12 no-left">
                            <h4 class="subheader">Create Group</h4>
                            <p class="helper-text">Create a new group for discussing stocks and sharing new ideas</p>
                        </div>
                        <div class="col-md-12">
                            <form action="{{ route("create.group") }}" method="POST">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="group-name">Group Name <span class="accent">*</span></label>
                                            {{ Form::text('group-name', null, ['class' => 'form-control', 'required' => 'required']) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="objective">Objective</label>
                                            {{ Form::text('objective', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button href="" type="submit" class="btn custom-btn">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- col-md-3 --}}
                @include('components.right-sidebar')
            </div>
        </div>
    </div>
@endsection
