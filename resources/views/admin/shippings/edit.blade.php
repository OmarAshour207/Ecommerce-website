@extends('admin.index')
@section('content')

@push('js')
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
 <script type="text/javascript" src="{{ url('design/AdminLTE/dist/js/locationpicker.jquery.js') }}"></script>
<?php
$lat = !empty($shipping->lat) ? $shipping->lat  : '30.034024628931657';
$lng = !empty($shipping->lng) ? $shipping->lng  : '31.24238681793213';
?>
 <script type="text/javascript">
   $('#us1').locationpicker({
    location: {
      latitude: {{ $lat }},
      longitude: {{ $lng }}, 
    },
    radius: 300,
    markerIcon: '{{ url("design/AdminLTE/dist/img/map_marker.png") }}',
    inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
        // radiusInput: $('#us1-radius'),
        locationNameInput: $('#address'),
    }
  });
 </script>
@endpush


<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open([ 'url' => aurl('shippings/'.$shipping->id), 'method' => 'put', 'files' => true]) !!}
      <input type="hidden" name="lat" value="{{ $lat }}" id='lat'>
      <input type="hidden" name="lng" value="{{ $lng }}" id='lng'>      
      <div class="form-group">
        {!! Form::label('shipping_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('shipping_name_ar',$shipping->shipping_name_ar, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('shipping_name_en',trans('admin.name_en')) !!}
        {!! Form::text('shipping_name_en',$shipping->shipping_name_en, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('user_id',trans('admin.owner_id')) !!}
        {!! Form::select('user_id',App\User::where('level','company')->pluck('name','id'), $shipping->user_id, ['class' => 'form-control',
                              'placeholder' => trans('admin.choose_company')]) !!}
      </div>

      <div class="form-group">
        {!! Form::label('address',trans('admin.address')) !!}
        {!! Form::text('address',$shipping->address, ['class' => 'form-control address']) !!}
      </div>

      <div class="form-group">
        <div id="us1" style="width: 100%; height: 400px;"></div>
      </div>
            
      <div class="form-group">
        {!! Form::label('icon',trans('admin.icon')) !!}
        {!! Form::file('icon', ['class' => 'form-control']) !!}
      
      @if(!empty($shipping->icon))
        <img src="{{ Storage::url($shipping->icon) }}"  style="height: 200px;width: 100px;"/>
      @endif
      </div>
      
      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
