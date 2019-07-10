@extends('layouts.app')

@section('template_title')
  Chỉnh sửa Mã KPI: {!! $data->name !!}
@endsection

@section('template_linked_css')
	 <style type="text/css">
		  .btn-save,
		  .pw-change-container {
				display: none;
		  }
	 </style>
@endsection

@section('content')

	 <div class="container">
		  <div class="row">
				<div class="col-lg-10 offset-lg-1">
					 <div class="card">
						  <div class="card-header">
								<div style="display: flex; justify-content: space-between; align-items: center;">
									 Chỉnh sửa Mã KPI: {!! $data->name !!}
									 <div class="pull-right">
										  <a href="{{ route('kpicode.index') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Quay lại Danh sách Mã KPI">
												<i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
												Quay lại Danh sách Mã KPI
										  </a>
									 </div>
								</div>
						  </div>
						  <div class="card-body">
								{!! Form::open(array('route' => ['kpicode.update', $data->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

									 {!! csrf_field() !!}

									 <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
										  {!! Form::label('name', 'Mã KPI', array('class' => 'col-md-3 control-label')); !!}
										  <div class="col-md-9">
												<div class="input-group">
													 {!! Form::text('name', $data->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Mã KPI')) !!}
													 <div class="input-group-append">
														  <label class="input-group-text" for="name">
																<i class="fa fa-fw {{ trans('forms.create_user_icon_bio') }}" aria-hidden="true"></i>
														  </label>
													 </div>
												</div>
												@if($errors->has('name'))
													 <span class="help-block">
														  <strong>{{ $errors->first('name') }}</strong>
													 </span>
												@endif
										  </div>
									 </div>

									 <div class="form-group has-feedback row {{ $errors->has('config') ? ' has-error ' : '' }}">
										  {!! Form::label('config', 'Cấu hình thang đo điểm', array('class' => 'col-md-3 control-label')); !!}
										  <div class="col-md-9">
												<div class="input-group">
													 {!! Form::textarea('config', $data->config, array('id' => 'config', 'class' => 'form-control', 'placeholder' => 'Cấu hình thang đo điểm&#13;&#10;Thực hiện-Điểm&#13;&#10;0-5|1-4|2-3|3-2|4-1|5-0', 'rows' => 8)) !!}
													 <div class="input-group-append">
														  <label class="input-group-text" for="config">
																<i class="fa fa-fw fa-cog" aria-hidden="true"></i>
														  </label>
													 </div>
												</div>
												@if($errors->has('config'))
													 <span class="help-block">
														  <strong>{{ $errors->first('config') }}</strong>
													 </span>
												@endif
										  </div>
									 </div>

									 {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 btn-save float-right','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}

									 {!! Form::button('<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;' . trans('forms.form_button_reset_text'), array('class' => 'btn btn-default margin-bottom-1 float-right margin-right-1','type' => 'reset', )) !!}

								{!! Form::close() !!}
						  </div>

					 </div>
				</div>
		  </div>
	 </div>

	 @include('modals.modal-save')
	 @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
@endsection
