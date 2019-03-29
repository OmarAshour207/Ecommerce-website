@extends('admin.index')
@section('content')


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open([ 'url' => aurl('weights/'.$weight->id), 'method' => 'put']) !!}

      <div class="form-group">
        {!! Form::label('weight_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('weight_name_ar',$weight->weight_name_ar, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('weight_name_en',trans('admin.name_en')) !!}
        {!! Form::text('weight_name_en',$weight->weight_name_en, ['class' => 'form-control']) !!}
      </div>

      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
