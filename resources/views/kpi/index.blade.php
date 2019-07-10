@extends('layouts.app')

@section('template_title')
    Danh sách người dùng (KPI)
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
                                Danh sách người dùng (KPI)
                            </span>
                        </div>
                    </div>

                    <div class="card-body">

                        @if(config('usersmanagement.enableSearchUsers'))
                            @include('partials.search-users-form')
                        @endif

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()]) }}
                                </caption>
                                <thead class="thead">
                                    <tr>
                                        <th>{!! trans('usersmanagement.users-table.id') !!}</th>
                                        <th>{!! trans('usersmanagement.users-table.name') !!}</th>
                                        <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
                                        <th class="hidden-xs">{!! trans('usersmanagement.users-table.fname') !!}</th>
                                        <th class="hidden-xs">{!! trans('usersmanagement.users-table.lname') !!}</th>
                                        <th>{!! trans('usersmanagement.users-table.role') !!}</th>
                                        <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                        <th class="no-search no-sort"></th>
                                    </tr>
                                </thead>
                                <tbody id="users_table">
                                    @foreach($users as $user)
                                        
                                        {{-- Nếu là mod sẽ ẩn nút với admin và mod khác --}}
                                        @php $invisibleAdMod = 0 @endphp
                                        @role('mod')
                                            @foreach ($user->roles as $user_role)
                                                @if ($user_role->slug == 'admin')
                                                    @php $invisibleAdMod = 1 @endphp
                                                    @break
                                                @elseif ($user_role->slug == 'mod' && (Auth::id() !== $user->id))
                                                    @php $invisibleAdMod = 1 @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                        @endrole

                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td class="hidden-xs"><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                                            <td class="hidden-xs">{{$user->first_name}}</td>
                                            <td class="hidden-xs">{{$user->last_name}}</td>
                                            <td>
                                                @foreach ($user->roles as $user_role)
                                                    @if ($user_role->slug == 'user')
                                                        @php $badgeClass = 'primary' @endphp
                                                    @elseif ($user_role->slug == 'admin')
                                                        @php $badgeClass = 'danger' @endphp
                                                    @elseif ($user_role->slug == 'mod')
                                                        @php $badgeClass = 'warning' @endphp
                                                    @else
                                                        @php $badgeClass = 'info' @endphp
                                                    @endif
                                                    <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($invisibleAdMod == 0)
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('kpi/' . $user->id) }}" data-toggle="tooltip" title="Xem KPI">
                                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Xem KPI</span>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('usersmanagement.enableSearchUsers'))
                                    <tbody id="search_results"></tbody>
                                @endif

                            </table>

                            @if(config('usersmanagement.enablePagination'))
                                {{ $users->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    @if ((count($users) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('usersmanagement.enableSearchUsers'))
        @include('scripts.search-users-kpi')
    @endif
@endsection
