@extends('layouts.app')

@section('template_title')
  Tạo mới Đơn vị tính
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Tạo mới Đơn vị tính
                            <div class="pull-right">
                                <a href="{{ route('kpiunit.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Quay lại Danh sách Đơn vị tính">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Quay lại Danh sách Đơn vị tính
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'kpiunit.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}

                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                {!! Form::label('name', 'Đơn vị tính', array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Đơn vị tính')) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                <i class="fa fa-fw {{ trans('forms.create_user_icon_bio') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {!! Form::button(trans('forms.form_button_create_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}

                            {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;' . trans('forms.form_button_reset_text'), array('class' => 'btn btn-default margin-bottom-1 float-right margin-right-1','type' => 'reset', )) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
