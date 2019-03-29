@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'colors.store','files'=>true]) !!}
   
      <div class="form-group">
        {!! Form::label('color_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('color_name_ar',old('color_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('color_name_en',trans('admin.name_en')) !!}
        {!! Form::text('color_name_en',old('color_name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('color',trans('admin.color')) !!}
        {!! Form::color('color',old('color'), ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit(trans('admin.create_color'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection