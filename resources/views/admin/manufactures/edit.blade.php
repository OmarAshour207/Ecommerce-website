@extends('admin.index')
@section('content')

@push('js')
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
 <script type="text/javascript" src="{{ url('design/AdminLTE/dist/js/locationpicker.jquery.js') }}"></script>
<?php
$lat = !empty($manufacture->lat) ? $manufacture->lat  : '30.034024628931657';
$lng = !empty($manufacture->lng) ? $manufacture->lng  : '31.24238681793213';
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
    {!! Form::open([ 'url' => aurl('manufactures/'.$manufacture->id), 'method' => 'put', 'files' => true]) !!}
      <input type="hidden" name="lat" value="{{ $lat }}" id='lat'>
      <input type="hidden" name="lng" value="{{ $lng }}" id='lng'>      
      <div class="form-group">
        {!! Form::label('manufacture_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('manufacture_name_ar',$manufacture->manufacture_name_ar, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('manufacture_name_en',trans('admin.name_en')) !!}
        {!! Form::text('manufacture_name_en',$manufacture->manufacture_name_en, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('contact_name',trans('admin.contact_name')) !!}
        {!! Form::text('contact_name',$manufacture->contact_name, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('mobile',trans('admin.mobile')) !!}
        {!! Form::number('mobile',$manufacture->mobile, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',$manufacture->email, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('address',trans('admin.address')) !!}
        {!! Form::text('address',$manufacture->address, ['class' => 'form-control address']) !!}
      </div>

      <div class="form-group">
        <div id="us1" style="width: 100%; height: 400px;"></div>
      </div>

      <div class="form-group">
        {!! Form::label('facebook',trans('admin.facebook_url')) !!}
        {!! Form::text('facebook',$manufacture->facebook, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('twitter',trans('admin.twitter_url')) !!}
        {!! Form::text('twitter',$manufacture->twitter, ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('website',trans('admin.website_url')) !!}
        {!! Form::text('website',$manufacture->website, ['class' => 'form-control']) !!}
      </div>      
            
      <div class="form-group">
        {!! Form::label('icon',trans('admin.manufacture_icon')) !!}
        {!! Form::file('icon', ['class' => 'form-control']) !!}
      
      @if(!empty($manufacture->icon))
        <img src="{{ Storage::url($manufacture->icon) }}"  style="height: 200px;width: 100px;"/>
      @endif
      </div>
      
      {!! Form::submit(trans('admin.save_record'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection
