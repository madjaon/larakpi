@extends('layouts.app')

@section('template_title')
	Danh sách Mã KPI
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

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <!-- <div style="display: flex; justify-content: space-between; align-items: center;"> -->
                            
                            Danh sách Mã KPI: {{ count($data) }}/{{ $data->total() }}

                            <a href="{{ URL::to('kpicode/create') }}" class="btn btn-primary btn-xs pull-right mr-1 mb-1">
                                <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                Tạo mới Mã KPI
                            </a>

                        <!-- </div> -->
                    </div>

                    <div class="panel-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-condensed data-table">
                                <thead>
                                    <tr>
                                        <!-- <th><input type="checkbox" id="checkall" onClick="toggle(this)"></th> -->
                                        <th>STT</th>
                                        <th>Mã KPI</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.created') !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.updated') !!}</th>
                                        <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $value)
                                        <tr>
                                            <!-- <td><input type="checkbox" class="id" name="id[]" value="{{-- $value->id --}}"></td> -->
                                            <td>{{ ($key+1) }}</td>
                                            <td>{{$value->name}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$value->created_at}}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{{$value->updated_at}}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'kpicode/' . $value->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Delete</span>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Item', 'data-message' => 'Are you sure you want to delete this item ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                @if(!empty($value->config))
                                                <button class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" title="Xem cấu hình thang đo điểm" target="_blank" onclick="showKpiCodeConfig({!! $value->id !!});">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Xem TĐĐ</span>
                                                </button>
                                                @include('modals.kpicodeconfig', $value)
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('kpicode/' . $value->id . '/edit') }}" data-toggle="tooltip" title="Sửa">
                                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Sửa</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

	@include('scripts.delete-modal-script')
	@include('scripts.save-modal-script')
	@if(config('usersmanagement.tooltipsEnabled'))
	  @include('scripts.tooltips')
	@endif
    @include('scripts.kpicodeconfig-modal-script')
@endsection
