@php

    $levelAmount = 'level';

    if (Auth::User()->level() >= 2) {
        $levelAmount = 'levels';

    }

@endphp

<div class="card">
    <div class="card-header @role('admin', true) bg-secondary text-white @endrole">

        Welcome {{ Auth::user()->name }}

        @role('admin', true)
            <span class="pull-right badge badge-danger" style="margin-top:4px">
                Giám đốc
            </span>
        @endrole
        @role('mod', true)
            <span class="pull-right badge badge-warning" style="margin-top:4px">
                Trưởng phòng
            </span>
        @endrole
        @role('user', true)
            <span class="pull-right badge badge-primary" style="margin-top:4px">
                Nhân viên
            </span>
        @endrole

    </div>
    <div class="card-body">
        <h2 class="lead">
            {{ trans('auth.loggedIn') }}
        </h2>

        <hr>

        <p>
            You have
                <strong>
                    @role('admin')
                       Giám đốc
                    @endrole
                    @role('mod')
                       Trưởng phòng
                    @endrole
                    @role('user')
                       Nhân viên
                    @endrole
                </strong>
            Access
        </p>

        <hr>

        <!-- <p>
            You have access to {{ $levelAmount }}:
            @level(5)
                <span class="badge badge-danger margin-half">5</span>
            @endlevel

            @level(4)
                <span class="badge badge-warning margin-half">4</span>
            @endlevel

            @level(3)
                <span class="badge badge-success margin-half">3</span>
            @endlevel

            @level(2)
                <span class="badge badge-primary margin-half">2</span>
            @endlevel

            @level(1)
                <span class="badge badge-info margin-half">1</span>
            @endlevel
        </p> -->

    </div>
</div>
