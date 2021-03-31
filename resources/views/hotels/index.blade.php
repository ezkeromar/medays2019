@extends('layouts.app')

@section('template_title')
    Hotels
@endsection

@section('template_toolbar')
    <div class="btn-toolbar kt-margin-l-20">
        <a href="/hotels/create" class="btn btn-label-success btn-pill kt-add-participant">
            <i class="la la-plus"></i>
        </a>
    </div>
@endsection

@section('content')
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <table class="table table-bordered table-bordered table-hover" id="" width="100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Catégorie de chambre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $hotel)
                        <tr>
                            <td> > {{$hotel->name}}</td>
                            <td>
                                @foreach ($hotel->room_categories as $rc)
                                    <div> -
                                        <span class="kt-badge kt-badge--default kt-badge--dot"></span>
                                        <span class="kt-font-bold kt-font-default">{{ $rc->name }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                <a class="dropdown-item" href="#" onclick="deleteConfirm(this,{{ $hotel->id }})">
                                    <i class="la la-trash"></i>
                                    <div style="display: none">
                                        {!! Form::open(array('url' => 'hotels/' . $hotel->id,'id' => 'delete_from'.$hotel->id ,'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button('<span class="hidden-xs hidden-sm">Delete </span><i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('hotels/' . $hotel->id . '/edit') }}">
                                    <i class="la la-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="10">
                        {{ $hotels->links() }}
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
