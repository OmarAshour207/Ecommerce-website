@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'trademarks.store','files'=>true]) !!}
      <div class="form-group">
        {!! Form::label('trademark_name_ar',trans('admin.trademark_name_ar')) !!}
        {!! Form::text('trademark_name_ar',old('trademark_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('trademark_name_en',trans('admin.trademark_name_en')) !!}
        {!! Form::text('trademark_name_en',old('trademark_name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('icon',trans('admin.trademark_icon')) !!}
        {!! Form::file('icon', ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit(trans('admin.create_trademark'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection