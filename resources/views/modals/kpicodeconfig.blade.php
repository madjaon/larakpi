@php 
	if(isset($kpiCode[$key])) {
		$kpiCodeId = $kpiCode[$key][0]->id;
		$kpiCodeConfig = $kpiCode[$key][0]->config;
	} else {
		$kpiCodeId = $value->id;
		$kpiCodeConfig = $value->config;
	}
@endphp
<div class="modal fade modal-info" id="modalKpiCodeConfig{{ $kpiCodeId }}" role="dialog" aria-labelledby="modalKpiCodeConfigLabel" aria-hidden="true">
  	<div class="modal-dialog">
	 	<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cấu hình thang đo điểm</h4>
			  	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<p>Khi chỉ tiêu bằng 0, sử dụng thang đo điểm sau:</p>
				@if(!empty($kpiCodeConfig))
				@php 
					$config = explode('|', $kpiCodeConfig);
					$item = array();
				@endphp
				@if(!empty($config))
				<table class="table table-bordered table-sm">
					<thead>
				      <tr>
				      	<th scope="col">Thực hiện</th>
				       	<th scope="col">Điểm</th>
				      </tr>
				   </thead>
				   <tbody>
				  	@foreach($config as $v)
				  		@php 
							$item = explode('-', $v);
				  		@endphp
				     	<tr>
					      <td>{{ $item[0] }}</td>
					      <td>{{ $item[1] }}</td>
				    	</tr>
			    	@endforeach
				   </tbody>
				</table>
				@endif
				@endif
			</div>
			<div class="modal-footer">
			  	{!! Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('modals.form_modal_default_title'), array('class' => 'btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
			</div>
	 	</div>
  	</div>
</div>