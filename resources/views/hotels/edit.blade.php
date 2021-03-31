@extends('layouts.app')

@section('template_title')
    Modifier Hotel {{$hotel->name}}
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
                            Modifier Hotel {{$hotel->name}}
                            <div class="pull-right">
                                <a href="{{ route('hotels.index') }}" class="btn btn-light btn-sm float-right"
                                   data-toggle="tooltip" data-placement="left"
                                   title="Back Hotels">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back Hotels
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['hotels.update', $hotel->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data','role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error text-danger ' : '' }}">
                            {!! Form::label('name', 'Nom', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name', $hotel->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => 'Nom')) !!}
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group has-feedback row {{ $errors->has('room_categories') ? ' has-error text-danger ' : '' }}">
                            {!! Form::label('Catégorie de chambre', null ,array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('room_categories', implode(',',$hotel->room_categories->pluck('name')->toArray()), array('id' => 'room_categories', 'class' => 'form-control', 'placeholder' => '')) !!}
                                </div>
                                @if ($errors->has('room_categories'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('room_categories') }}</strong>
                                        </span>
                                @endif
                                <small class="text-info"><strong>les catégories séparées avec ","</strong> (ex: Standare,Lux,Normal)</small>
                            </div>
                        </div>

                        {!! Form::button('Mettre à jour', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
@endsection
