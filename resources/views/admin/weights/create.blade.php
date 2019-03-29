@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'weights.store','files'=>true]) !!}
   
      <div class="form-group">
        {!! Form::label('weight_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('weight_name_ar',old('weight_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('weight_name_en',trans('admin.name_en')) !!}
        {!! Form::text('weight_name_en',old('weight_name_en'), ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit(trans('admin.create_weight'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection