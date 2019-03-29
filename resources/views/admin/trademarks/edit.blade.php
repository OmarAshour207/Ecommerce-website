@extends('admin.index')
@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open([ 'url' => aurl('trademarks/'.$trademark->id), 'method' => 'put', 'files' => true]) !!}
      <div class="form-group">
        {!! Form::label('trademark_name_ar',trans('admin.trademark_name_ar')) !!}
        {!! Form::text('trademark_name_ar',$trademark->trademark_name_ar, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('trademark_name_en',trans('admin.trademark_name_en')) !!}
        {!! Form::text('trademark_name_en',$trademark->trademark_name_en, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('icon',trans('admin.trademark_icon')) !!}
        {!! Form::file('icon', ['class' => 'form-control']) !!}

      @if(!empty($trademark->icon))
        <img src="{{ Storage::url($trademark->icon) }}"  style="height: 200px;width: 100px;"/>
      @endif
      </div>
      
      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
