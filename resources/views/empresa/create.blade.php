@extends('layouts.app')

@section('title', 'empresas create')

@section('content')

@include('common.errors')

{!! Form::open(['route' => 'empresa.store', 'method' => 'POST', 'files' => true ]) !!}
    <div class="form-group">
        {!!Form::label('name','Nombre')!!}
        {!!Form::text('name',null,['class'=>'form-control'])!!}
    </div>

     <div class="form-group">
        {!!Form::label('slug','Slug')!!}
        {!!Form::text('slug',null,['class'=>'form-control'])!!}
     </div>

    <div class="form-group">
            {!!Form::label('bio','Descripcion')!!}
            {!!Form::text('bio',null,['class'=>'form-control'])!!}
    </div>
 
    <div class="form-group">
        {!!Form::label('avatar','Avatar')!!}
        {!!Form::file('avatar')!!}
    </div>

{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

{!! Form::close()!!}

@endsection
