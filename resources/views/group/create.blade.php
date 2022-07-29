@extends('layout/layout')
@section('content')
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns">
                    <a href="" class="panel-minimize tooltips" data-toggle="tooltip" title=""
                       data-original-title="Minimize Panel"><i class="fa fa-minus"></i></a>
                    <a href="" class="panel-close tooltips" data-toggle="tooltip" title=""
                       data-original-title="Close Panel"><i class="fa fa-times"></i></a>
                </div><!-- panel-btns -->
                <h4 class="panel-title">Create New User Groups</h4>
                <p></p>
            </div><!-- panel-heading -->
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('group.store')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="form-body">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Group Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input" value="{{old('groupname')}}"
                                       name="groupname">
                            </div>
                        </div>
                    </div>

                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input" value="{{old('description')}}"
                                       name="description">
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Bank</label>
                            <div class="col-md-9">
                                {!! Form::select('bank',
                                ([' ' => 'Select Bank'] + $banks),
                                null,
                                ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right1">
                        <button type="button" id="btnCreateGroup" class="btn btn-primary">Save</button>
                        <button type="button" id="closeCreate" class="btn btn-danger" data-dismiss="modal">Close
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- panel -->
    </div><!-- col-sm-6 -->
@endsection
