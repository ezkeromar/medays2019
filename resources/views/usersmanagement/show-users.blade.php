@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection

@section('template_toolbar')
    <div class="btn-toolbar kt-margin-l-20">
        <a href="/users/create" class="btn btn-label-success btn-pill kt-add-participant">
            <i class="la la-user-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <table class="table table-bordered table-bordered table-hover table-responsive" id="" width="100%">
                <thead>
                    <tr>
                        <th > Avatar </th>
                        <th >{!! trans('usersmanagement.users-table.name') !!}</th>
                        <th >{!! trans('usersmanagement.users-table.email') !!}</th>
                        <th >{!! trans('usersmanagement.users-table.fname') !!}</th>
                        <th >{!! trans('usersmanagement.users-table.lname') !!}</th>
                        <th >{!! trans('usersmanagement.users-table.role') !!}</th>
                        <th > Permissions </th>
                        <th >{!! trans('usersmanagement.users-table.created') !!}</th>
                        <th >{!! trans('usersmanagement.users-table.updated') !!}</th>
                        <th >{!! trans('usersmanagement.users-table.actions') !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <img src="{!!  $user->avatar_url  !!}" alt="{!!  $user->name !!}" height="64px"/>
                            </td>
                            <td>{{$user->name}}</td>
                            <td><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>
                                @foreach ($user->getRoles() as $user_role)
                                    <div>
                                        <span class="kt-badge kt-badge--brand kt-badge--dot"></span>
                                        <span class="kt-font-bold kt-font-brand">{{ $user_role->name }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($user->getPermissions() as $user_permission)
                                    <div>
                                        <span class="kt-badge kt-badge--default kt-badge--dot"></span>
                                        <span class="kt-font-bold kt-font-default">{{ $user_permission->name }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td>{{$user->created_at}}</td>
                            <td>{{$user->updated_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                       data-toggle="dropdown">
                                        <i class="flaticon-more-1"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ URL::to('users/' . $user->id) }}">
                                            <i class="la la-check-circle"></i> {!! trans('usersmanagement.buttons.show') !!}
                                        </a>
                                        <a class="dropdown-item" href="{{ URL::to('users/' . $user->id . '/edit') }}">
                                            <i class="la la-edit"></i> {!! trans('usersmanagement.buttons.edit') !!}
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="deleteConfirm(this,{{ $user->id }})">
                                            <i class="la la-trash"></i> {!! trans('usersmanagement.buttons.delete') !!}
                                            <div style="display: none">
                                                {!! Form::open(array('url' => 'users/' . $user->id,'id' => 'delete_from'.$user->id ,'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        {{ $users->links() }}
                    </td>
                </tr>
                </tfoot>
            </table>
            <!--end: Datatable -->
        </div>
    </div>

@endsection

@section('footer_scripts')
{{--    <script src="{{ asset('assets/js/demo1/pages/crud/metronic-datatable/base/html-table.js') }}" type="text/javascript"></script>--}}

    <script>
        function deleteConfirm(el,id) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimez-le!'
            }).then((result) => {
                if (result.value) {
                    $('#delete_from' + id).submit()
                }
            })
        }
    </script>
@endsection
