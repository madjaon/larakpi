{!! Form::open(array('action' => 'KpiController@store', 'id' => 'addKpiForm')) !!}
	<input type="hidden" name="user_id" value="{{ $user->id }}">
 <div class="form-group has-feedback row mt-3 mb-3">

	<div class="col-md-4">
		 <label for="name">Tên KPI</label>
			<div class="input-group">
			  {!! Form::text('name', old('name'), array('id' => 'name', 'class' => 'form-control')) !!}
			</div>
	</div>

	<div class="col-md-2">
		 <label for="code">Mã KPI</label>
			<div class="input-group">
			  <select class="form-control" name="code" id="code">
				 @php
					$codeArray = CommonQuery::getArrayIdName('kpi_code');
				 @endphp
				 @if ($codeArray)
					@foreach($codeArray as $key => $value)
					  <option value="{{ $key }}">{{ $value }}</option>
					@endforeach
				 @endif
			  </select>
			</div>
	</div>

	<div class="col-md-2">
		 <label for="unit">ĐVT</label>
			<div class="input-group">
			  <select class="form-control" name="unit" id="unit">
				 @php
					$unitArray = CommonQuery::getArrayIdName('kpi_unit');
				 @endphp
				 @if ($unitArray)
					@foreach($unitArray as $key => $value)
					  <option value="{{ $key }}">{{ $value }}</option>
					@endforeach
				 @endif
			  </select>
			</div>
	</div>

	<div class="col-md-2">
		 <label for="trend">Chiều hướng tốt</label>
			<div class="input-group">
			  <select class="form-control" name="trend" id="trend">
				 @php
					$trendArray = CommonOption::trendArray();
				 @endphp
				 @if ($trendArray)
					@foreach($trendArray as $key => $value)
					  <option value="{{ $key }}">{{ $value }}</option>
					@endforeach
				 @endif
			  </select>
			</div>
	</div>

	<div class="col-md-2 mt-3 pt-3">
		 {!! Form::button('<i class="fa fa-fw fa-save" aria-hidden="true"></i> Thêm KPI', array('class' => 'btn btn-primary btn-block margin-bottom-1 pull-right','type' => 'submit', 'disabled' => true)) !!}
	</div>

 </div>
 
{!! Form::close() !!}
