@extends('layouts.app')

@section('template_title')
    Danh sách KPI của user: {{ $user->name }}
@endsection

@section('template_linked_css')
    @if(config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                Danh sách KPI của username: {{ $user->name }}
                            </span>
                            @role('admin|mod')
                            <div class="pull-right">
                                <a href="{{ url('kpis') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Quay lại Danh sách KPI người dùng">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Quay lại Danh sách KPI người dùng
                                </a>
                            </div>
                            @endrole
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-8">
                                @role('admin')
                                @include('kpi.create-form')
                                @endrole
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                            </div>
                            <div class="col-md-4 mt-3 pt-3">
                                <div class="float-right">
                                    @role('admin')
                                        <button class="btn btn-secondary btn-xs my-3 mx-1" id="sTarget" onclick="clickTarget();"><i class="fa fa-fw fa-flag" aria-hidden="true"></i> Lưu chỉ tiêu</button>
                                    @endrole
                                    @role('admin|mod')
                                    <div class="d-inline-block" id="btnReviced">
                                        <button class="btn btn-warning btn-xs my-3 mx-1" id="reviced" onclick="reviced();" disabled><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Nhận</button>
                                    </div>
                                    @endrole
                                    <button class="btn btn-success btn-xs my-3 mx-1" id="evaluate" onclick="evaluated();" disabled><i class="fa fa-fw fa-check" aria-hidden="true"></i> Đánh giá</button>
                                </div>
                            </div>
                        </div>
                        

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    Số lượng KPI: {{ $data->count() }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th class="align-middle">STT</th>
                                        <th class="align-middle">Tên KPI</th>
                                        <th class="align-middle text-center">Mã KPI</th>
                                        <th class="align-middle text-center">ĐVT</th>
                                        <th class="align-middle text-center">Chiều hướng tốt</th>
                                        <th class="align-middle text-center" style="width:90px;">Tỷ trọng (%)</th>
                                        <th class="align-middle text-center" style="width:90px;">Chỉ tiêu</th>
                                        <th class="align-middle text-center" style="width:90px;">Thực hiện</th>
                                        <th class="align-middle text-center" style="width:90px;">% Thực hiện</th>
                                        <th class="align-middle text-center" style="width:90px;">Điểm</th>
                                        <th class="align-middle text-center" style="width:90px;">Hiệu suất (%)</th>
                                        @role('admin')
                                        <th class="align-middle text-center">{!! trans('usersmanagement.users-table.actions') !!}</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($data as $key => $value)

                                        @role('admin')
                                            @php 
                                                $disabledTarget = '';
                                            @endphp
                                        @else
                                            @php 
                                                $disabledTarget = 'disabled';
                                            @endphp
                                        @endrole

                                        @role('admin|mod')
                                            @php 
                                                $disabledPercent = '';
                                            @endphp
                                        @else
                                            @php 
                                                $disabledPercent = 'disabled';
                                            @endphp
                                        @endrole

                                        <tr>
                                    		<td class="align-middle">
                                                {{ ($key+1) }}
                                                <input type="hidden" value="{{$value->id}}" name="id[]">
                                        	</td>
                                            <td class="align-middle">{{$value->name}}</td>
                                            <td class="align-middle text-center">
                                                {{ CommonQuery::getNameById('kpi_code', $value->code) }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {{ CommonQuery::getNameById('kpi_unit', $value->unit) }}
                                            </td>
                                            <td class="align-middle text-center">
                                                {!! CommonOption::getTrend($value->trend) !!}
                                                <input type="hidden" value="{{$value->trend}}" name="trend[]">
                                            </td>
                                            <td class="align-middle text-center">
                                        		<input type="text" value="{{$value->percent}}" name="percent[]" style="width:100%;" class="form-control align-middle text-center onlynumber" {{ $disabledPercent }}>
                                            </td>
                                            <td class="align-middle text-center">
                                        		<input type="text" value="{{$value->target}}" name="target[]" style="width:100%;" class="form-control align-middle text-center onlynumber" {{ $disabledTarget }}>
                                            	</td>
                                            <td class="align-middle text-center">
                                        		<input type="text" value="{{$value->perform}}" name="perform[]" style="width:100%;" class="form-control align-middle text-center onlynumber" >
                                            </td>
                                            <td class="align-middle text-center">
                                        		<input type="text" value="{{$value->per_perform}}" name="per_perform[]" style="width:100%;" class="form-control align-middle text-center" disabled>
                                            </td>
                                            <td class="align-middle text-center">
                                        		<input type="text" value="{{$value->score}}" name="scores[]" style="width:100%;" class="form-control align-middle text-center" disabled>
                                            </td>
                                            <td class="align-middle text-center">
                                        		<input type="text" value="{{$value->efficiency}}" name="efficiency[]" style="width:100%;" class="form-control align-middle text-center" disabled>
                                            </td>
                                            @role('admin')
                                            <td class="align-middle text-center">
                                                {!! Form::open(array('url' => 'kpi/' . $value->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::hidden('user_id', $user->id) !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Xóa</span><span class="hidden-xs hidden-sm hidden-md"> KPI</span>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete KPI', 'data-message' => 'Are you sure you want to delete this KPI ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            @endrole
                                            <td class="align-middle text-center">
                                                @php
                                                    $kpiCode[$key][] = CommonQuery::getDataById('kpi_code', $value->code);
                                                @endphp
                                                @if(!empty($kpiCode[$key]) && !empty($kpiCode[$key][0]->config))
                                                <button class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" title="Xem cấu hình thang đo điểm" target="_blank" onclick="showKpiCodeConfig({!! $value->code !!});">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Xem TĐĐ</span>
                                                </button>
                                                @include('modals.kpicodeconfig', $kpiCode[$key])
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                    <tr class="table-light">
                                        <td colspan="5" class="align-middle text-right">Tổng tỷ trọng (%):</td>
                                        <td class="align-middle text-center font-weight-bold" id="tPercent">{{ $totalPercent }}</td>
                                        <td colspan="4" class="align-middle text-right">Hiệu suất tổng (%):</td>
                                        <td class="align-middle text-center" id="tEff">
                                    		@if($dataE)
                                              <strong>{{ $dataE->total }}</strong>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="6" class="align-middle text-right" id="tPercentMsg"></td>
                                        <td colspan="4" class="align-middle text-right">Xếp loại:</td>
                                        <td class="align-middle text-center" id="tRank">
                                            @if($dataE)
                                              <strong class="text-danger">{{ CommonOption::getRank($dataE->rank) }}</strong>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($data) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @include('scripts.kpi-script')
    @include('scripts.kpicodeconfig-modal-script')
@endsection
