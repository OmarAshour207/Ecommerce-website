@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open([ 'url' => aurl('colors/'.$color->id), 'method' => 'put']) !!}

      <div class="form-group">
        {!! Form::label('color_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('color_name_ar',$color->color_name_ar, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('color_name_en',trans('admin.name_en')) !!}
        {!! Form::text('color_name_en',$color->color_name_en, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('color',trans('admin.color')) !!}
        {!! Form::color('color',$color->color, ['class' => 'form-control']) !!}
      </div>

      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
