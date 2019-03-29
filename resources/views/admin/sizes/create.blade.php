@extends('admin.index')
@section('content')

@push('js')

<script>
  $(function () { $('#jstree_demo_div').jstree(); });
  $(document).ready(function(){
    $('#jstree').jstree({
    "core" : {
      'data' : {!! load_dep(old('department_id')) !!},
      "themes" : {
        "variant" : "large"
      }
    },
    "checkbox" : {
      "keep_selected_style" : false
    },
    "plugins" : [ "wholerow" ]
    });
});

  $('#jstree').on('changed.jstree', function(e, data){
  var i , j , r = [];
  var name = [];
  for(i = 0, j = data.selected.length; i < j; i++)
  {
    r.push(data.instance.get_node(data.selected[i]).id);
  }
  
  if(r.join(', ') != '') {
    $('.department_id').val(r.join(', '));
  } 
});
</script>
@endpush

<div class="box">
  <div class="box-header">
    <h3 class="box-title"> {{$title}} </h3>
  </div>
  <div class="box-body">
    {!! Form::open(['route' => 'sizes.store','files'=>true]) !!}
   
      <div class="form-group">
        {!! Form::label('size_name_ar',trans('admin.name_ar')) !!}
        {!! Form::text('size_name_ar',old('size_name_ar'), ['class' => 'form-control']) !!}
      </div>
      <div class="form-group">
        {!! Form::label('size_name_en',trans('admin.name_en')) !!}
        {!! Form::text('size_name_en',old('size_name_en'), ['class' => 'form-control']) !!}
      </div>

      <input type="hidden" name="department_id" class="department_id" value="{{ old('department_id') }}">
      <div id="jstree"></div>
      <!-- <div class="form-group">
        {!! Form::label('size_name_en',trans('admin.name_en')) !!}
        {!! Form::select('size_name_en',App\Model\Department::pluck('dep_name_'.session('lang'),'id'),old('size_name_en'), ['class' => 'form-control','placeholder' => trans('admin.choose_size')]) !!}
      </div> -->      

      <div class="form-group">
        {!! Form::label('is_public',trans('admin.is_public')) !!}
        {!! Form::select('is_public',['yes'=> trans('admin.yes'), 'no'=> trans('admin.no')],old('is_public'), ['class' => 'form-control']) !!}
      </div>
      {!! Form::submit(trans('admin.create_size'),['classs' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection