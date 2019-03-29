@extends('admin.index')
@section('content')

@push('js')
 <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
 <script type="text/javascript" src="{{ url('design/AdminLTE/dist/js/locationpicker.jquery.js') }}"></script>
<?php
$lat = !empty(old('lat')) ? old('lat') : '30.034024628931657';
$lng = !empty(old('lng')) ? old('lng') : '31.24238681793213';
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
    },
    enableAutocomplete: true
  });
 </script>
@endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'malls.store','files'=>true]) !!}
      <input type="hidden" name="lat" value="{{ old('lat') }}" id='lat'>
      <input type="hidden" name="lng" value="{{ old('lng') }}" id='lng'>      
      <div class="form-group">
        {!! Form::label('mall_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('mall_name_ar',old('mall_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('mall_name_en',trans('admin.name_en')) !!}
        {!! Form::text('mall_name_en',old('mall_name_en'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('contact_name',trans('admin.contact_name')) !!}
        {!! Form::text('contact_name',old('contact_name'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('mobile',trans('admin.mobile')) !!}
        {!! Form::text('mobile',old('mobile'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('email',trans('admin.email')) !!}
        {!! Form::email('email',old('email'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('country_id',trans('admin.country_id')) !!}
        {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'), 'id') , old('country_id'), ['class' => 'form-control','placeholder'=>trans('admin.choose_country')]) !!}
      </div>
      <div class="form-group">
        {!! Form::label('address',trans('admin.address')) !!}
        {!! Form::text('address',old('address'), ['class' => 'form-control address']) !!}
      </div>

      <div class="form-group">
        <div id="us1" style="width: 100%; height: 400px;"></div>
      </div>

      <div class="form-group">
        {!! Form::label('facebook',trans('admin.facebook_url')) !!}
        {!! Form::text('facebook',old('facebook'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('twitter',trans('admin.twitter_url')) !!}
        {!! Form::text('twitter',old('twitter'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('website',trans('admin.website_url')) !!}
        {!! Form::text('website',old('website'), ['class' => 'form-control']) !!}
      </div>      
            
      <div class="form-group">
        {!! Form::label('icon',trans('admin.mall_icon')) !!}
        {!! Form::file('icon', ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit(trans('admin.create_mall'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection